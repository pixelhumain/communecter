
<!-- start: PAGE CONTENT -->
<div class="noteWrap col-md-8 col-md-offset-2">
	<h1>Add a Member ( Person, Organization )</h1>
    <p>An Organization can have People as members or Organizations</p>
	
	<form id="inviteForm" style="line-height:40px;">
        <div class="row">
	        <input type="hidden" id="sponsorPA" name="sponsorPA" value="<?php echo Yii::app()->session["userId"]; ?>"/>
	        <input placeholder="Email" id="inviteEmail" name="inviteEmail" value=""/>
	        <input placeholder="Name" id="inviteName" name="inviteName" value=""/></td>
	    </div>
	    <div class="row">
	        <button class="btn btn-primary" id="submitInvite" onclick="$('#inviteForm').submit();">Enregistrer</button>
	    </div>
    </form>
</div>

<script type="text/javascript">
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
    
});
</script>	

