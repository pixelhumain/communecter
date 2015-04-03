<style>
	#dropdown_email{
		padding: 0px 15px; 
		margin-left:2%; 
		width:96%;
	}
	.li-dropdown-scope{
		padding: 8px 3px;
	}
</style>
<!-- start: PAGE CONTENT -->
<div id ="inviteSome">
	<div class="noteWrap col-md-8 col-md-offset-2">
		<h1>Invite Someone</h1>
	    <p>  local or that might be interested by the platform</p>
		
		<form id="inviteForm" style="line-height:40px;">
	        <div class="row">
		        <input type="hidden" id="sponsorPA" name="sponsorPA" value="<?php echo Yii::app()->session["userId"]; ?>"/>
		        <input placeholder="Email" id="inviteEmail" name="inviteEmail" value="">
			        <ul class="dropdown-menu" id="dropdown_email" style="">
						<li class="li-dropdown-scope">-</li>
					</ul>
				</input>
		        <input placeholder="Name" id="inviteName" name="inviteName" value=""/></td>
		    </div>
		    <div class="row">
		        <button class="btn btn-primary" id="submitInvite" onclick="$('#inviteForm').submit();">Enregistrer</button>
		    </div>
	    </form>
	</div>
</div>
<script type="text/javascript">
var timeout;
jQuery(document).ready(function() {
	
	 $("#inviteForm").submit( function(event){
    	event.preventDefault();
    	$.ajax({
    	  type: "POST",
    	  url: baseUrl+"/communecter/person/invitation",
    	  data: $("#inviteForm").serialize(),
    	  success: function(data){
    			  $("#flashInfo .modal-body").html(data.msg);
    			  $("#flashInfo").modal('show');
    	  },
    	  dataType: "json"
    	});
    });

	$('#inviteEmail').keyup(function(e){
	    var email = $('#inviteEmail').val();
	    clearTimeout(timeout);
	    timeout = setTimeout('autoCompleteEmail("'+email+'")', 500);		
	});
	$('#inviteEmail').focusout(function(e){
		//$("#ajaxSV #dropdown_city").css({"display" : "none" });
	});
    
});
function autoCompleteEmail(email){
		var data = { "email" : email};
		testitpost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id?>/person/RecueilinfoEmailAutoComplete', data,
		function (data){
			var str = ""; var limit=0;
 			$.each(data, function() { limit++;
 				if(limit < 9) 
  				str += "<li class='li-dropdown-scope'><a href='javascript:setEmailInput(\""+ this.email +"\")'>" + this.email + "</li>";
  			}); 
  			if(str == "") str = "<li class='li-dropdown-scope'>Aucun résultat</li>";
  			$("#ajaxSV #dropdown_email").html(str);
  			$("#ajaxSV #dropdown_email").css({"display" : "inline" });
		});	
	}

function setEmailInput(email){
	$('#inviteEmail').val(email);
	$("#dropdown_email").css({"display" : "none" });	
}
</script>	

