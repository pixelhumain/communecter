<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.css');
//$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/bootstrap/bootstrap-typeahead.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/autosize/jquery.autosize.min.js' , CClientScript::POS_END);
?>

<div style="display:none" id="addOrganization" >
	<!-- start: PAGE CONTENT -->
	<div class="noteWrap col-md-8 col-md-offset-2">
	    <div class="panel panel-white">
        	<div class="panel-heading border-light">
				<h1>Référencer votre organization</h1>
			    
			    <p>Si vous gérer une ou plusieurs organisations ou etes simplement membre d'une organization :
			    <br/>vous êtes au bon endroit pour la valoriser, la diffuser, l'aider à la faire vivre.
			    <br/>Vérifier l'existance de l'organisation en saisissant son nom ou son email dans le champs de recherche.</p>

			</div>
		</div>
		<div class="panel-body">
			<form id="organizationForm" role="form">
				<div class="row">
					<div class="col-md-12">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
						</div>
						<div class="successHandler alert alert-success no-display">
							<i class="fa fa-ok"></i> Your form validation is successful!
						</div>
					</div>
					<div class="form-group" id="searchOrganizationSection">
		    	    	<div class='row'>
							<div class="col-md-1">	
				           		<i class="fa fa-search fa-2x"></i> 	
				           	</div>
				           	<div class="col-md-11">
				           		<span class="input-icon input-icon-right">
						           	<input class="organization-search form-control" placeholder="Search by name or email" autocomplete = "off" id="organizationSearch" name="organizationSearch" value="">
						           		<i id="iconeChargement" class="fa fa-spinner fa-spin pull-left"></i>
						        		<ul class="dropdown-menu" id="dropdown_search" style="">
											<li class="li-dropdown-scope">-</li>
										</ul>
									</input>
								</span>
							</div>
						</div>
					</div>
					<div id="formNewOrganization">
						<div class="col-md-6 col-sd-6" >
							<input id="organizationId" type="hidden" name="organizationId">
							<div class="form-group">
								<label class="control-label">
									Nom (Raison Sociale) <span class="symbol required"></span>
								</label>
								<input id="organizationName" class="form-control" name="organizationName" value="<?php if($organization && isset($organization['name']) ) echo $organization['name']; else $organization["name"]; ?>"/>
							</div>

							<div class="form-group">
								<label class="control-label">
									Type <span class="symbol required"></span>
								</label>
								<select name="type" id="type" class="form-control" >
									<option value=""></option>
									<?php
									foreach ($types as $key=>$value) 
									{
									?>
									<option value="<?php echo $key?>" <?php if(($organization && isset($organization['type']) && $key == $organization['type']) ) echo "selected"; ?> ><?php echo $value?></option>
									<?php 
									}
									?>
								</select>
							</div>
							
							<div class="form-group">
								<label class="control-label">
									Email <span class="symbol required"></span>
								</label>
								<input id="organizationEmail" class="form-control" name="organizationEmail" value="<?php if($organization && isset($organization['email']) ) echo $organization['email']; else echo Yii::app()->session['userEmail']; ?>"/>
							</div>
						</div>
						<div class="col-md-6 col-sd-6 ">
							
							<div class="form-group">
								<label class="control-label">
									Pays <span class="symbol required"></span>
								</label>
								<select name="organizationCountry" id="organizationCountry" class="form-control">
									<option></option>
									<?php 
									foreach (OpenData::$phCountries as $key => $value) 
									{
									?>
									<option value="<?php echo $key?>" <?php if(($organization["address"] && isset($organization["address"]['addressCountry']) && $key == $organization["address"]['addressCountry']) ) echo "selected"; else if ($key == "Réunion") echo "selected"; ?> ><?php echo $key?></option>
									<?php 
									}
									?>
								</select>
								
							</div>

							<div class="form-group">
								<label class="control-label">
									Code postal <span class="symbol required"></span>
								</label>
								<input class="form-control" placeholder="12345" type="text" name="postalCode" id="postalCode" value="<?php if(isset($organization["address"]))echo $organization["address"]["postalCode"]?>" >
							</div>

							<div class="form-group">
								<label class="control-label">
									Centres d'interet 
								</label>
								
			        		    <input id="tagsOrganization" type="hidden" name="tagsOrganization" value="<?php echo ($organization && isset($organization['tags']) ) ? implode(",", $organization['tags']) : ""?>" style="display: none;">
			        		    
							</div>

						</div>
						<div class="col-md-12">
						<div class="form-group">
								<div>
									<label for="form-field-24" class="control-label"> Description <span class="symbol required"></span> </label>
									<textarea  class="form-control" name="description" id="description" class="autosize form-control" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 60px;"><?php if($organization && isset($organization['description']) ) echo $organization['description']; else $organization["description"]; ?></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div>
									<span class="symbol required"></span>Required Fields
									<hr>
								</div>
							</div>
						</div>
						<button class="btn btn-primary" id="btnSaveNewOrganization">Save</button>
						<button class="btn btn-primary" id="btnAddMeAsMemberOf">Add Me as member Of</button>
						<a href="javascript:showSearch()"><i class="fa fa-search"></i>Back to Seach</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">

var formValidator = function() {
	var form = $('#organizationForm');
	var errorHandler = $('.errorHandler');
	form.validate({
		rules : {
			organizationCountry : {
				required : true
			},
			description : {
				required : true
			},
			organizationEmail : {
				required : true
			},
			organizationName : {
				required : true
			},
			type : {
				required : true
			},
			postalCode : {
				minlength : 5,
				required : true
			}
		},
		submitHandler : function(form) {
			$("#organizationForm").modal('hide');
	        $.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/organization/savenew",
		    	  data: $("#organizationForm").serialize(),
		    	  success: function(data){
		    			if(!data.result)
	                        toastr.error(data.msg);
	                    else { 
	                        toastr.success(data.msg);
	                        if(updateMyOrganization != undefined && typeof updateMyOrganization == "function")
		        				updateMyOrganization(data.newOrganization, data.id);
							$.hideSubview()
	                    }
		    	  },
		    	  dataType: "json"
		    });
	       	return false; // required to block normal submit since you used ajax
		},
		invalidHandler : function(event, validator) {//display error alert on form submit
			errorHandler.show();
		}
	});
}

jQuery(document).ready(function() {
	var timeout;
	var organizationList;
	
	//very strange BUg this only works when declaring it twice, no idea and no time to loose
	$('#tagsOrganization').select2({ tags: <?php echo $tags?> });
	$('#tagsOrganization').select2({ tags: <?php echo $tags?> });

	$("textarea.autosize").autosize();

	formValidator();
	initForm();
	showSearch();

 });  

	function initForm() {
		$('#organizationForm #organizationSearch').keyup(function(e){
		    var searchValue = $('#organizationForm #organizationSearch').val();
		    if(searchValue.length>2){
		    	clearTimeout(timeout);
			    timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 500);
			    clearTimeout(timeout);
			    timeout = setTimeout('autoCompleteOrganizationName("'+searchValue+'")', 500); 
		    }else{
		    	$("#organizationSearch #dropdown_search").css({"display" : "none" });
		    	$("#iconeChargement").css("visibility", "hidden")
		    }		       		
		});

		//Add Me as member Of Button
		$('#btnAddMeAsMemberOf').click(function(e) {
			e.preventDefault();
			var formData = {
	    		"memberId" : "<?php echo Yii::app()->session["userId"] ?>",
				"memberName" : "",
				"memberEmail" : "",
				"memberType" : '<?php echo PHType::TYPE_CITOYEN ?>', 
				"parentOrganisation" : $("#addOrganization #organizationId").val(),
				"memberIsAdmin" : false,
				"memberRoles" : ""
			};
			console.log("Data saveMember : "+formData);
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/organization/saveMember",
				data: formData,
				dataType: "json",
				success: function(data) {
					if(data.result){
						toastr.success(data.content);
						organization = {"id" : formData.parentOrganization, 
										"name": $("#addOrganization #organizationName").val(),
										"type" : $("#addOrganization #type").val(),
									}
						if(updateMyOrganization != undefined && typeof updateMyOrganization == "function")
		        				updateMyOrganization(organization, organization.id);
						$.hideSubview();
					}
					else
						toastr.error(data.content);
				},
			});               
		});	
	}	
	
	function autoCompleteOrganizationName(searchValue){
		var data = {"name" : searchValue, "email" : searchValue};
		$.ajax({
			type: "POST",
	        url: baseUrl+"/communecter/organization/searchOrganizationByCriteria",
	        data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data.result){
	        		toastr.error(data.content);
	        	}else{
					organizationList = data.list;
					str = "<li class='li-dropdown-scope'><a href='javascript:showNewOrganizationForm()'>Non trouvé ? Cliquez ici.</a></li>";
		 			$.each(data.list, function(key, value) {
		  				str += "<li class='li-dropdown-scope'><a href='javascript:initAddMeAsMemberOrganizationForm(\""+key+"\")'>" + value.name + "</a></li>";
		  			}); 
		  			$("#addOrganization #dropdown_search").html(str);
		  			$("#addOrganization #dropdown_search").css({"display" : "inline" });
	  			}
			}	
		})
	}

	function showSearch(){
		organizationList = "";
		$("#addOrganization").css("display", "block");
		$("#addOrganization #formNewOrganization").css("display", "none");
		$("#searchOrganizationSection").css("display", "block");

		$("#iconeChargement").css("visibility", "hidden")
		$("#organizationForm #organizationSearch").val("");
		$("#addOrganization #dropdown_search").css({"display" : "none" });
	}

	function showNewOrganizationForm(){
		//Manage Button
		$("#addOrganization #btnSaveNewOrganization").css("display", "block");
		$("#addOrganization #btnAddMeAsMemberOf").css("display", "none");

		$("#addOrganization #formNewOrganization").css("display", "block");
		$("#searchOrganizationSection").css("display", "none");
		
		initNewOrganizationForm();
		$("#addOrganization #organizationName").val($('#organizationForm #organizationSearch').val());
	}

	function initNewOrganizationForm() {
		$('#formNewOrganization input, #formNewOrganization select, #formNewOrganization select2, #formNewOrganization textarea').each(
		    function(){
		        $(this).val("");
		        $(this).removeAttr("disabled");
		    }
		);
		//cas particulier du select2
		$("#addOrganization #tagsOrganization").select2('val', "");
	}

	function initAddMeAsMemberOrganizationForm(organizationId) {
		showNewOrganizationForm();
		setOrganizationForm(organizationId);

		//Manage Button
		$("#addOrganization #btnSaveNewOrganization").css("display", "none");
		$("#addOrganization #btnAddMeAsMemberOf").css("display", "block");
		
		//TODO disable the inputs
		$('#formNewOrganization input, #formNewOrganization select, #formNewOrganization select2, #formNewOrganization textarea').each(
		    function(){
		        $(this).attr("disabled", 'disabled');
		    }
		);
	}

	function setOrganizationForm(organizationId) {
		organization = organizationList[organizationId];
		$("#addOrganization #organizationId").val(organizationId);
		$("#addOrganization #organizationName").val(organization.name);
		$("#addOrganization #type").val(organization.type);
		$("#addOrganization #organizationEmail").val(organization.email);
		$("#addOrganization #tagsOrganization").select2('val', organization.tags);
		$("#addOrganization #description").val(organization.description);
		if (organization.adress != undefined) {
			if (organization.adress.country != undefined) $('#addOrganization #organizationCountry').val(organization.adress.country);
			if (organization.adress.postalCode != undefined) $("#addOrganization #postalCode").val(organization.adress.postalCode);
		}
	}

</script>	

