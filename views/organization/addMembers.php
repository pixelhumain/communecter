
<!-- start: PAGE CONTENT -->
<div class="col-md-8 col-md-offset-2">
	<h1>Add a Member ( Person, Organization )</h1>
    <p>An Organization can have People as members or Organizations</p>
	
	<form id="addMemberForm" style="line-height:40px;">
        <div class="row">
	        <input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo (string)$organization["_id"]; ?>"/>
	        <input placeholder="Email" id="memberEmail" name="memberEmail" value=""/>
	        <input placeholder="Name" id="memberName" name="memberName" value=""/></td>
	    </div>
	    <div class="row">
	        <button class="btn btn-primary" onclick="$('#addMemberForm').submit();">Enregistrer</button>
	    </div>
    </form>
</div>

<div class="col-md-8 col-md-offset-2 hide">
    <h1>Batch Import </h1>
    <p>import comma sepearated emails to connect people or Organisations</p>
    
    <form id="memberBatchImport" style="line-height:40px;">
        <div class="row">
            <select>
                <option value="Person">People</option>
                <option value="NGO">NGOs</option>
                <option value="LocalBusiness">Local Businesses</option>
                <option value="Groups">Groups</option>
            </select>
            <br/>
            <textarea name="memberBatchImport" id="memberBatchImport" cols="30" rows="10"></textarea>
        </div>
        <div class="row">
            <button class="btn btn-primary" onclick="$('#memberBatchImport').submit();">Enregistrer</button>
        </div>
    </form>
</div>

<div class="col-md-8 col-md-offset-2 hide">
    <h1>Url Import </h1>
    <p>
        import from a PLP ressource or directory, Git Repo... <br/>
        thoughts : <br/>
        could be interesting to have the jsonFromJsonTo conversion tool <br/>
        takes any url, show humanily > the user maps to the PH schema 
    </p>
    
    <form id="memberUrlImport" style="line-height:40px;">
        <div class="row">
            <input placeholder="Url" id="memberUrl" name="memberUrl" value=""/></td>
        </div>
        <div class="row">
            <button class="btn btn-primary" onclick="$('#memberUrlImport').submit();">Enregistrer</button>
        </div>
    </form>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	 $("#addMemberForm").submit( function(event){
    	event.preventDefault();
    	$.ajax({
            type: "POST",
            url: baseUrl+"/communecter/organization/savemember",
            data: $("#addMemberForm").serialize(),
            dataType: "json"
            success: function(data){
        	   toastr.success("delete successfull ");
               window.location.href = baseUrl+"/<?php echo $this->module->id?>/organization/view/id/<?php echo (string)$organization['_id']?>?tabId=panel_members";
            },
            error:function (xhr, ajaxOptions, thrownError){
              toastr.error( thrownError );
            } 
    	});
    });
    $("#memberBatchImport").submit( function(event){
        event.preventDefault();
    });

});
</script>	

