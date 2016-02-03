<?php
	
$cssAnsScriptFilesModule = array(
	'/assets/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/assets/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);
?>
<style>
	#dropdown_search{
		padding: 0px 15px; 
		margin-left:2%; 
		width:96%;
	}
	#dropdown_search .li-dropdown-scope ol {
    	color: #155869;
    	padding: 5px 5px 5px 15px !important;
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
	}
	#addMembers{
		display: block;
		float: left;
		padding: 10px;
		background-color: rgba(242, 242, 242, 0.9);
		width: 100%;
		box-shadow: 1px 1px 5px 3px #CFCFCF;
	}
	.li-dropdown-scope a{
		padding:15px 25px !important;
	}
</style>
<?php 
$visible = "";
if( isset($_GET["isNotSV"])) {
	Menu::organization($organization);
	$this->renderPartial('../default/panels/toolbar'); 
} else
	$visible = ' style="display:none" ';

?>
<div <?php echo $visible; ?> id="addMembers" >
    <!-- start: PAGE CONTENT -->
    <?php if( isset($_GET["isNotSV"])){?>
	<h2 class='radius-10 padding-10 text-bold text-dark'> 
		<i class="fa fa-plus"></i> <i class="fa fa-2x fa-user"></i> 
		<?php echo Yii::t("organisation","Add a member to this organization",null,Yii::app()->controller->module->id) ?>
	</h2>
	<?php
	} 
	$size = ( !@$isNotSV ) ? " col-md-6 col-md-offset-3" : "col-md-12"
	?>
	<div class="<?php echo $size ?> " >  
    	
       
        <div class="panel panel-white">
        	<div class="panel-heading border-light">
        	<?php if( !isset($_GET["isNotSV"])){?>
        		<h1>Add a Member ( Person, Organization )</h1>
        	<?php } ?>
        		<blockquote>
        			<?php echo Yii::t("organisation","An Organization can have People as members or Organizations",null,Yii::app()->controller->module->id) ?>
        		</blockquote>
        	</div>
        	<div class="panel-body">
		    	<form id="addMemberForm" style="line-height:40px; padding:0px;" autocomplete="off" submit='false'>
		    		<input type="hidden" id="parentOrganisation" name="parentOrganisation" value="<?php echo (string)$organization["_id"]; ?>"/>
		    	    <input type="hidden" id="memberId" name="memberId" value=""/>
		    	    <div class="form-group" id="searchMemberSection" style="margin:0px;">
		    	    	<div class='row'>
							<div class="col-md-1">	
				           		<i class="fa fa-search fa-2x"></i> 
				           	</div>
				           	<div class="col-md-11">
				           		<span class="input-icon input-icon-right">
						           	<input class="member-search form-control" placeholder="<?php echo Yii::t("organisation","Search by name, email",null,Yii::app()->controller->module->id) ?>" autocomplete = "off" id="memberSearch" name="memberSearch" value="">
						           		<i id="iconeChargement" class="fa fa-spinner fa-spin pull-left"></i>
						        		<ul class="dropdown-menu" id="dropdown_search" style="max-height:200px;overflow:scroll;">
											<li class="li-dropdown-scope">-</li>
										</ul>
									</input>
								</span>
							</div>
						</div>
					</div>
		            <div class="form-group" id="addMemberSection">
		            	<div class='row center'>
		            		<h4>Est-ce un citoyen ou une association ?</h4>
		            		<input type="hidden" id="memberType"/>
		            		<div class="btn-group ">
								<a id="btnCitoyen" href="javascript:;" onclick="switchType('citoyens')" class="btn btn-default btn-green">
									Citoyen
								</a>
								<a id="btnOrganization" href="javascript:;" onclick="switchType('organizations')" class="btn btn-default btn-green">
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
			               	<div class="row">
								<div class="center">
									<div id="divAdmin" class="form-group">
						    	    	<label class="control-label">
											Administrateur :
										</label><br>
										<input class="hide" id="memberIsAdmin" name="memberIsAdmin"></input>
										<input type="checkbox" data-on-text="<?php echo Yii::t("common","Yes") ?>" data-off-text="<?php echo Yii::t("common","No") ?>" name="my-checkbox"></input>
									</div>
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
				               	<div class="col-md-10  col-md-offset-1 padding-10">	
									<button class="btn btn-primary pull-right" style="margin-left:10px;">Enregistrer</button>
									<a href="javascript:showSearch()" class="btn btn-default pull-right" style="margin-left:10px;"><i class="fa fa-search"></i> Search</a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
					    	        
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
    

    
</div>
<script type="text/javascript">
	var timeout;
	var organization = <?php echo json_encode($organization) ?>;
	jQuery(document).ready(function() {
		$(".moduleLabel").html("<i class='fa fa-users'></i> ORGANIZATION : <?php echo $organization["name"] ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
		 /*$(window).keydown(function(event){
		    if(event.keyCode == 13) {
		      event.preventDefault();
		      return false;
		    }
		  });*/
		<?php if( isset($_GET["isNotSV"])){?>
		initFormAddMember();
		<?php
		} else { ?>
		bindOrganizationSubViewAddMember();
		<?php } ?>
		
		


	});
	

	var mapIcon = {
		"citoyens":"fa-user", 
		"NGO":"fa-users",
		"LocalBusiness" :"fa-industry",
		"Group" : "fa-circle-o",
		"GovernmentOrganization" : "fa-university"
 	};

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
			console.log("state = "+state );
			if (state == true) {
				$("#addMembers #memberIsAdmin").val(1);
			} else {
				$("#addMembers #memberIsAdmin").val(0);
			}
			
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
			console.log(params);
			
			connectTo(parentType, parentId, userId, userType, connectType, parentName,actionAdmin);

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
		                $('#addMembers #organizationType').val("");
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

	function setMemberInputAddMember(id, name, email, type, organizationType){
		$("#iconeChargement").css("visibility", "hidden")
		$("#addMembers #memberSearch").val(name);
		$("#addMembers #memberName").val(name);
		$("#addMembers #memberId").val(id);
		$('#addMembers #memberEmail').val(email);
		
		$('#addMembers #memberEmail').attr("disabled", 'disabled');
		$("#addMembers #memberName").attr("disabled", 'disabled');

		if(type=="citoyens"){
			$("#addMembers #btnCitoyen").trigger("click");
			$("#addMembers #btnOrganization").addClass("disabled");
		}else{
			$("#addMembers #btnOrganization").trigger("click");
			$("#addMembers #btnCitoyen").addClass("disabled");
			$('#addMembers #organizationType').val(organizationType);
			$('#addMembers #organizationType').attr("disabled", 'disabled');
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
	        url: baseUrl+"/communecter/search/searchmemberautocomplete",
	        data: data,
	        dataType: "json",
	        success: function(data){
	        	if(!data){
	        		toastr.error(data.content);
	        	}else{
	        		var icon = "fa-question-circle";
					str = "<li class='li-dropdown-scope'><a href='javascript:openNewMemberForm()'><i class='fa fa-plus'></i> Non trouvé ? Envoyer une invitation.</a></li>";
		 			$.each(data, function(key, value) {
		 			
		 				$.each(value, function(i, v){
		 					if (v.address != null) {
            			      city = v.address.addressLocality;
                			}
                
                			if("undefined" != typeof v.profilThumbImageUrl && v.profilThumbImageUrl != ""){
                  				var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+v.profilThumbImageUrl+"'/>"
                			}

							if (key == "citoyens") {
		 						icon = mapIcon[key];
		 					} else if (key == "organizations") {
		 						icon = mapIcon[v.type];
		 					}

                			var insee = v.insee ? v.insee : "";
                			var postalCode = v.cp ? v.cp : v.address.postalCode ? v.address.postalCode : "";
                			str +=  //"<div class='searchList li-dropdown-scope' >"+
                          		"<a href='javascript:;' data-id='"+ v.id +"' data-key='"+key+"' data-type='"+v.type+"' data-name='"+ v.name +"' data-email='"+v.email+"' data-icon='"+ icon +"' data-insee='"+ insee +"' class='searchEntry searchList li-dropdown-scope selectAddMember'>"+
                          		"<ol>";
                          	
                          	if ("undefined" != typeof htmlIco) {
                          		str += "<span>"+ htmlIco +"</span>  " + v.name;
                          	} else {
								str += '<span><i class="fa '+icon +' fa-2x"></i>' + v.name + '</span>';
                          	}

                          	str +=  "</ol></a>";

		  					//str += '<li class="li-dropdown-scope"><a href="javascript:;"  ><i class="fa '+icon+'"></i> '+v.name +'</a></li>';
		  				});
		  			}); 

		  			$("#addMembers #dropdown_search").html(str);
		  			$(".selectAddMember").off().on('click',function() { 
		  				var id = $(this).data('id');
		  				var name = $(this).data('name');
		  				var email = $(this).data('email');
		  				var key = $(this).data('key');
		  				var type = $(this).data('type');
		  				setMemberInputAddMember(id,name,email,key,type);
		  			});
		  			$("#addMembers #dropdown_search").css({"display" : "inline" });
	  			}
			}	
		})
	}

	function openNewMemberForm(){
		$("#addMembers #addMemberSection").css("display", "block");
		$("#addMembers #searchMemberSection").css("display", "none");
		$("#addMembers #memberName").val("");
		$("#addMembers #memberName").removeAttr("disabled");
		$("#addMembers #memberId").val("");
		$('#addMembers #memberEmail').val("");
		$('#addMembers #memberEmail').removeAttr("disabled");
		$('#addMembers #organizationType').removeAttr("disabled");
		$("#addMembers #memberRole").val("");
		$("#addMembers #memberIsAdmin").val("0");
		$("[name='my-checkbox']").bootstrapSwitch('state', false);
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  		if(emailReg.test( $("#addMembers #memberSearch").val() )){
  			$('#addMembers #memberEmail').val( $("#addMembers #memberSearch").val());
  		}else{
  			$("#addMembers #memberName").val($("#addMembers #memberSearch").val());
  		}
	}
	function showSearch(){
		$("#addMembers #btnCitoyen").removeClass("disabled btn-dark-green").addClass("btn-green");
		$("#addMembers #btnOrganization").removeClass("disabled btn-dark-green").addClass("btn-green");
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
			$("#addMembers #btnCitoyen").removeClass("btn-green").addClass("btn-dark-green");
			$("#addMembers #btnOrganization").removeClass("btn-dark-green").addClass("btn-green");
		}else{
			$("#addMembers #divAdmin").css("display", "none");
			$("#addMembers #divOrganizationType").css("display", "block");
			$("#addMembers #iconUser").html('<i class="fa fa-group fa-2x"></i>');
			$("#addMembers #btnOrganization").removeClass("btn-green").addClass("btn-dark-green");
			$("#addMembers #btnCitoyen").removeClass("btn-dark-green").addClass("btn-green");
		}
		$("#addMembers #memberType").val(str);
	}

	function setValidationTable(){
		var admin= "";
		var type="";
		if($("#addMembers #memberType").val()=="citoyens"){
			type = "Personne";
		}else{
			type = "Organisation"
		}
		if($("#addMembers #memberIsAdmin").val()=="1"){
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
	

