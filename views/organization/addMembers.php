<style>
	#dropdown_search{
		padding: 0px 15px; 
		margin-left:2%; 
		width:96%;
	}
	.li-dropdown-scope{
		padding: 8px 3px;
	}
	#addMemberSection{
		display: none;
	}

	#iconeChargement{
		visibility: hidden;
	}
	#divAdmin{
		display: none;
	}
	#addMemberForm{
		padding: 20px;
	}
	#formNewMember{
		display: none;
	};
</style>

<div style="display:none" id="addMembers" >
    <!-- start: PAGE CONTENT -->
    <div class="col-md-6 col-md-offset-3">
    	
       
        <div class="panel panel-white">
        	<div class="panel-heading border-light">
        		<h1>Add a Member ( Person, Organization )</h1>
        		<p>An Organization can have People as members or Organizations</p>
        	</div>
        	<div class="panel-body">
		    	<form id="addMemberForm" style="line-height:40px;" autocomplete="off">
		    		<input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo (string)$organization["_id"]; ?>"/>
		    	    <input type="hidden" id="memberId" name="memberId" value=""/>
		    	    <div class="form-group" id="searchMemberSection">
		    	    	<div class='row'>
							<div class="col-md-1">	
				           		<i class="fa fa-search fa-2x"></i> 
				           	</div>
				           	<div class="col-md-11">
				           		<span class="input-icon input-icon-right">
						           	<input class="member-search form-control" placeholder="Search By name, email" autocomplete = "off" id="memberSearch" name="memberSearch" value="">
						           		<i id="iconeChargement" class="fa fa-spinner fa-spin pull-left"></i>
						        		<ul class="dropdown-menu" id="dropdown_search" style="">
											<li class="li-dropdown-scope">-</li>
										</ul>
									</input>
								</span>
							</div>
						</div>
					</div>
		            <div class="form-group" id="addMemberSection">
		            	<div class='row center'>
		            		<input type="hidden" id="memberType"/>
		            		<div class="btn-group ">
								<a id="btnCitoyen" href="javascript:;" onclick="switchType('citoyens')" class="btn btn-green">
									Citoyen
								</a>
								<a id="btnOrganization" href="javascript:;" onclick="switchType('organizations')" class="btn btn-green">
									Organisation
								</a>
							</div>
			            </div><br>
			            <div id="formNewMember">
			    	        <div class="row">
			    	        	<div class="col-md-1" id="iconUser">	
					           		
					           	</div>
					           	<div class="col-md-10">
			    	        		<input class="form-control" placeholder="Name" id="memberName" name="memberName" value=""/>
								</div>		    	        
			    	        </div>
			    	        <div class="row" id="divOrganizationType">
			    	        	<div class="col-md-1">
			    	        		<i class="fa fa-crosshairs fa-2x"></i>
					           	</div>
					           	<div class="col-md-10">
			    	        		<select class="form-control" placeholder="Organization Type" id="organizationType" name="organizationType">
									<option value=""></option>
									<?php foreach ($organizationTypes as $key => $value) { ?>
										<option value="<?php echo $key ?>"><?php echo $value?></option>
									<?php }	?>
								</select>
								</div>		    	        
			    	        </div>
			    	        <div class ="row">
			    	        	<div class="col-md-1">	
					           		<i class="fa fa-envelope-o fa-2x"></i>
					           	</div>
			    	        	<div class="col-md-10">
			               			<input class="member-email form-control" placeholder="Email" autocomplete = "off" id="memberEmail" name="memberEmail" value=""/>
			               		</div>
			               	</div>
			               	<div class ="row">
			    	        	<div class="col-md-1">	
					           		<i class="fa fa-tags fa-2x"></i>
					           	</div>
			    	        	<div class="col-md-10">
			               			<input type="hidden" style="min-width:100%" placeholder="Role" autocomplete = "off" id="memberRole" name="memberRole" value=""/>
			               		</div>
			               	</div>
			               	<div class ="row">
				               	<div class="col-md-10  col-md-offset-1">	
									<a href="javascript:showSearch()"><i class="fa fa-search"></i> Search</a>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-5">
									<div id="divAdmin" class="form-group">
						    	    	<label class="control-label">
											Administrateur :
										</label>
										<input class="hide" id="memberIsAdmin" name="memberIsAdmin"></input>
										<input type="checkbox" data-on-text="YES" data-off-text="NO" name="my-checkbox"></input>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
					    	        <button class="btn btn-primary" >Enregistrer</button>
					    	    </div>
					    	</div>
				    	</div>
		    	    </div>	    	   
		        </form>
	        </div>
        </div>
    </div>
	<div class="row ">
	 	<div class="col-md-8 col-md-offset-2">
	        <table class="table table-striped table-bordered table-hover newMembersAddedTable hide">
	            <thead>
	                <tr>
	                    <th class="hidden-xs">Type</th>
	                    <th>Name</th>
	                    <th class="hidden-xs center">Email</th>
	                    <th>Roles</th>
	                    <th>Admin</th>
	                    <th>Status</th>
	                </tr>
	            </thead>
	            <tbody class="newMembersAdded"></tbody>
	        </table>
	    </div>
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
                <button class="btn btn-primary" >Enregistrer</button>
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
                <button class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
	var timeout;
	var organization = <?php echo json_encode($organization) ?>;
	jQuery(document).ready(function() {
		
		bindOrganizationSubViewAddMember();
	});
	

	var mapIcon = {"citoyens":"fa-smile-o", "organizations":" fa-building-o"};


	function bindOrganizationSubViewAddMember() {	
		$(".addMembersBtn").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					initFormAddMember();
				},
				onHide : function() {
					hideFormAddMember();
				}
			});
		});

		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.prinviteDefault();
		});
	};
	function initFormAddMember(){
		if(typeof(organization["roles"])!="undefined"){
			$('#memberRole').select2({ tags: organization["roles"]});
			//$('#memberRole').select2({ tags: organization["roles"]});
		}else{
			$('#memberRole').select2({ tags: []});
		}
		$("#addMembers #memberIsAdmin").val("false");
		$("[name='my-checkbox']").bootstrapSwitch();
		$("[name='my-checkbox']").on("switchChange.bootstrapSwitch", function (event, state) {
			$("#addMembers #memberIsAdmin").val(""+state);
		}); 
		$("#addMemberForm").off().on("submit",function(event){
	    	event.preventDefault();
	    	var params = { 
	    		"memberId" : $("#addMembers #memberId").val(),
				"memberName" : $("#addMembers #memberName").val(),
				"memberEmail" : $("#addMembers #memberEmail").val(),
				"memberType" : $("#addMembers #memberType").val(),
				"organizationType" : $("#addMembers #organizationType").val(),
				"parentOrganisation" : $("#addMembers #parentOrganisation").val(),
				"memberIsAdmin" : $("#addMembers #memberIsAdmin").val(),
				"memberRoles" : $("#addMembers #memberRole").val() 
			};
	    	$.ajax({
	            type: "POST",
	            url: baseUrl+"/communecter/link/savemember",
	            data: params,
	            dataType: "json",
	            success: function(data){
	            	if(!data.result){
	            		toastr.error(data.msg);
	            	}else{
	            		toastr.success("Member added successfully ");
	            		if(typeof updateOrganisation != "undefined" && typeof updateOrganisation == "function")
		        			updateOrganisation( data.member,  $("#addMembers #memberType").val());
		               	setValidationTable();
		               if($("#addMembers #memberRole").val() != ""){
			               	if(typeof(organization["roles"])!="undefined"){
			               		var tabStrRole = $("#addMembers #memberRole").val().split(",");
			               		for(var i = 0; i<tabStrRole.length; i++){
			               			if($.inArray(tabStrRole[i], organization["roles"])==-1){
			               				organization["roles"].push(tabStrRole[i]);
			               			}
			               		}
			               		
								$('#memberRole').select2({ tags: organization["roles"]});
								//$('#memberRole').select2({ tags: organization["roles"]});
							}else{
								var tabStrRole = $("#addMembers #memberRole").val().split(",");
								$('#memberRole').select2({ tags: tabStrRole});
							}
		               }
		               
		                $("#addMembers #memberType").val("");
		                $("#addMembers #memberName").val("");
		                $("#addMembers #memberEmail").val("");
		                $("#addMembers #memberIsAdmin").val("");
		                $("#addMembers #memberRole").val("");
						$("#addMembers #memberIsAdmin").val("false");
						$("#memberRole").select2("val", "");
						$("[name='my-checkbox']").bootstrapSwitch('state', false);
		                showSearch();

		                
	            	}
	            	console.log(data.result);   
	            },
	            error:function (xhr, ajaxOptions, thrownError){
	              toastr.error( thrownError );
	            } 
	    	});
	    });

		$('#addMembers #memberSearch').keyup(function(e){
		    var searchValue = $('#addMembers #memberSearch').val();
		    if(searchValue.length>2){
		    	clearTimeout(timeout);
			    timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 500);
			    clearTimeout(timeout);
			    timeout = setTimeout('autoCompleteEmailAddMember("'+searchValue+'")', 500); 
		    }else{
		    	$("#addMembers #dropdown_search").css({"display" : "none" });
		    	$("#iconeChargement").css("visibility", "hidden")
		    }
		       		
		});
		$('#memberEmail').focusout(function(e){
			//$("#ajaxSV #dropdown_city").css({"display" : "none" });
		});
	}

	function hideFormAddMember(){
		$(".newMembersAdded").empty();
		$(".newMembersAddedTable").removeClass('animated bounceIn').addClass('hide');
		openNewMemberForm();
		showSearch();
		
	}

	function setMemberInputAddMember(id, name,email,type){
		$("#iconeChargement").css("visibility", "hidden")
		$("#addMembers #memberSearch").val(name);
		$("#addMembers #memberName").val(name);
		$("#addMembers #memberId").val(id);
		$('#addMembers #memberEmail').val(email);
		if(type=="citoyens"){
			$("#addMembers #btnCitoyen").trigger("click");
			$("#addMembers #btnOrganization").addClass("disabled");
		}else{
			$("#addMembers #btnOrganization").trigger("click");
			$("#addMembers #btnCitoyen").addClass("disabled");
		}
		
		$("#addMembers #dropdown_search").css({"display" : "none" });
		$("#addMembers #addMemberSection").css("display", "block");
		$("#addMembers #searchMemberSection").css("display", "none");

	}

	function autoCompleteEmailAddMember(searchValue){
		console.log("autoCompleteEmailAddMember");
		var data = {"search" : searchValue};
		$.ajax({
			type: "POST",
	        url: baseUrl+"/communecter/person/GetUserAutoComplete",
	        data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data){
	        		toastr.error(data.content);
	        	}else{
	        	
					str = "<li class='li-dropdown-scope'><a href='javascript:openNewMemberForm()'>Non trouvé ? Cliquez ici.</a></li>";
		 			$.each(data, function(key, value) {
		 			
		 				$.each(value, function(i, v){
		 					
			 				console.log(v.type);
		  					str += "<li class='li-dropdown-scope'><a href='javascript:setMemberInputAddMember(\""+ v._id["$id"] +"\", \""+v.name+"\",\""+v.email+"\", \""+key+"\")'><i class='fa "+mapIcon[key]+"'></i> "+ v.name + "</a></li>";
		  				});
		  			}); 

		  			$("#addMembers #dropdown_search").html(str);
		  			$("#addMembers #dropdown_search").css({"display" : "inline" });
	  			}
			}	
		})
	}
	function openNewMemberForm(){
		$("#addMembers #addMemberSection").css("display", "block");
		$("#addMembers #searchMemberSection").css("display", "none");
		$("#addMembers #memberName").val("");
		$("#addMembers #memberId").val("");
		$('#addMembers #memberEmail').val("");
		$("#addMembers #memberRole").val("");
		$("#addMembers #memberIsAdmin").val("false");
		$("[name='my-checkbox']").bootstrapSwitch('state', false);
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  		if(emailReg.test( $("#addMembers #memberSearch").val() )){
  			$('#addMembers #memberEmail').val( $("#addMembers #memberSearch").val());
  		}else{
  			$("#addMembers #memberName").val($("#addMembers #memberSearch").val());
  		}
	}
	function showSearch(){
		$("#addMembers #btnOrganization").removeClass("disabled");
		$("#addMembers #btnCitoyen").removeClass("disabled");
		$("#addMembers #btnCitoyen").removeClass("btn-dark-green");
		$("#addMembers #btnCitoyen").addClass("btn-green");
		$("#addMembers #btnOrganization").removeClass("btn-dark-green");
		$("#addMembers #btnOrganization").addClass("btn-green");
		$("#addMembers #formNewMember").css("display", "none");
		$("#addMembers #addMemberSection").css("display", "none");
		$("#addMembers #searchMemberSection").css("display", "block");
		$("#addMembers #divAdmin").css("display", "none");
		$("#iconeChargement").css("visibility", "hidden")
		$("#addMembers #memberSearch").val("");
		$("#addMembers #dropdown_search").css({"display" : "none" });
	}

	function switchType(str){
		$("#addMembers #formNewMember").css("display", "block");
		$("#addMembers #iconUser").empty();
		if(str=="citoyens"){
			$("#addMembers #divAdmin").css("display", "block");
			$("#addMembers #iconUser").html('<i class="fa fa-user fa-2x"></i>');
			$("#addMembers #divOrganizationType").css("display", "none");
			$("#addMembers #btnCitoyen").removeClass("btn-green");
			$("#addMembers #btnCitoyen").addClass("btn-dark-green");
			$("#addMembers #btnOrganization").removeClass("btn-dark-green");
			$("#addMembers #btnOrganization").addClass("btn-green");
		}else{
			$("#addMembers #divAdmin").css("display", "none");
			$("#addMembers #divOrganizationType").css("display", "block");
			$("#addMembers #iconUser").html('<i class="fa fa-group fa-2x"></i>');
			$("#addMembers #btnOrganization").removeClass("btn-green");
			$("#addMembers #btnOrganization").addClass("btn-dark-green");
			$("#addMembers #btnCitoyen").removeClass("btn-dark-green");
			$("#addMembers #btnCitoyen").addClass("btn-green");
		}
		$("#addMembers #memberType").val(str);
	}

	function setValidationTable(){
		var admin= "";
		var type="";
		if($("#addMembers #memberType").val()=="citoyens"){
			type= "Personne";
		}else{
			type = "Organisation"
		}
		if($("#addMembers #memberIsAdmin").val()=="true"){
			admin="Oui";
		}else{
			admin = "Non";
		}
		strHTML = "<tr><td>"+type+"</td><td>"
       						+$("#addMembers #memberName").val()+"</td><td>"
       						+$("#addMembers #memberEmail").val()+"</td><td>"
       						+$("#addMembers #memberRole").val()+"</td><td>"
       						+admin+"</td><td>"+
       						"<span class='label label-info'>added</span></td> <tr>";
        $(".newMembersAdded").append(strHTML);
        if($(".newMembersAddedTable").hasClass("hide"))
            $(".newMembersAddedTable").removeClass('hide').addClass('animated bounceIn');
	}
</script>
	

