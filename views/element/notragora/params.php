<div id="viewParams">
	<div class="modal-header bg-dark">
		<h4 class="modal-title"><i class="fa fa-cog"></i> Paramètres </h4>
	</div>
	<div class="col-sm-4 text-right padding-10 margin-top-10 text-dark">
    	<i class="fa fa-message"></i> <strong>Notifications par mail  :</strong>
	</div>
	<div class="col-sm-8 text-left padding-10">
		<div class="btn-group btn-group-mailNotif inline-block">
			<button class="btn btn-default confidentialitySettings" type="mailNotif" value="true"><i class="fa fa-check"></i> Oui </button>
			<button class="btn btn-default confidentialitySettings" type="mailNotif" value="false"><i class="fa fa-times"></i> Non </button>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php
		//Params Checked
		$typePreferences = array("privateFields", "publicFields");
		$fieldPreferences= array();

		$typePreferencesBool = array("isOpenData", "isOpenEdition", "mailNotif");

		//To checked private or public
		foreach($typePreferences as $typePref){
			foreach ($fieldPreferences as $field => $hidden) {
				if(isset($preferences[$typePref]) && in_array($field, $preferences[$typePref])){
					echo "$('.btn-group-$field > button[value=\'".str_replace("Fields", "", $typePref)."\']').addClass('active');";
					$fieldPreferences[$field] = false;
				} 
			}
		}
		//To checked if there are hidden
		foreach ($fieldPreferences as $field => $hidden) {
			if($hidden) echo "$('.btn-group-$field > button[value=\'hide\']').addClass('active');";
		}

		foreach ($typePreferencesBool as $field => $typePrefB) {
			if(isset($preferences[$typePrefB]) && $preferences[$typePrefB] == true)
				echo "$('.btn-group-$typePrefB > button[value=\'true\']').addClass('active');";	
			else
				echo "$('.btn-group-$typePrefB > button[value=\'false\']').addClass('active');";
		}	

	?>
	


jQuery(document).ready(function() {


	$("#viewParams .confidentialitySettings").click(function(){
    	var param = new Object;
    	param.type = $(this).attr("type");
    	param.value = $(this).attr("value");
    	param.typeEntity = "citoyens";
    	param.idEntity = userId;
    	console.log("modalParams confidentialitySettings", param);
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/updatesettings",
	        data: param,
	       	dataType: "json",
	    	success: function(data){
	    		if(data.result){
		    		toastr.success(data.msg);
		    		if(param.value == "true"){
		    			$('.btn-group-'+param.type+' > button[value="true"]').addClass('active');
		    			$('.btn-group-'+param.type+' > button[value="false"]').removeClass('active');
		    		}else{
		    			$('.btn-group-'+param.type+' > button[value="false"]').addClass('active');
		    			$('.btn-group-'+param.type+' > button[value="true"]').removeClass('active');
		    		}
		    		
	    		}
		    	else
		    		toastr.error(data.msg);
		    }
		});
	});
});
</script>