<div style="display:none" id="joinOrganization">
    <!-- start: PAGE CONTENT -->
    <div class="col-md-8 col-md-offset-2">
    	<h1>Join an organization</h1>
        <p>Ask to become a member of an organization</p>
    	
    	<form id="addMemberForm" style="line-height:40px;">
            <div class="row ">
                <table class="table table-striped table-bordered table-hover newMembersAddedTable hide">
                    <thead>
                        <tr>
                            <th class="hidden-xs">Type</th>
                            <th>Name</th>
                            <th class="hidden-xs center">Email</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="newMembersAdded"></tbody>
                </table>
            </div>
            <div class="row">
    	        <input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo (string)$organization["_id"]; ?>"/>
                <select id="memberType" name="memberType">
                    <option value="organizations">Organisation</option>
                </select>
    	        
    	        <input placeholder="Name" id="memberName" name="memberName" value=""/></td>
                <input placeholder="Email" id="memberEmail" name="memberEmail" value=""/>
    	    </div>
    	    <div class="row">
    	        <button class="btn btn-primary" >Enregistrer</button>
    	    </div>
        </form>
    </div>
</div>
	

