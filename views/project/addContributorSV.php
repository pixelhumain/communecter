<?php 
if (@$isNotSV){
	$cssAnsScriptFilesModule = array(
		//Data helper
		'/js/dataHelpers.js'
		);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
	$cssAnsScriptFilesModule = array(
	'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , 
	'/plugins/moment/min/moment.min.js' , 
	'/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
	'/plugins/bootstrap-daterangepicker/daterangepicker.js' , 
	//'/plugins/bootstrap-select/bootstrap-select.min.css',
	//'/plugins/bootstrap-select/bootstrap-select.min.js'
	'/plugins/autosize/jquery.autosize.min.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
}
?>
<style>
<?php if (!@$isNotSV){ ?>
#newContributors{
	display: none;
}
<?php } else{ ?>
#newContributors{
	min-height: 300px;
}
.dropdown-menu{
	height:200px;
	overflow:scroll;
}
<?php } ?>
.li-dropdown-scope{
	padding: 8px 3px;
}
#iconeChargement{
	visibility: hidden;
}
#addContributorSection{
	display: none;
}
#formNewContributor{
	display: none;
}
</style>
<div id="newContributors">
	<?php if( @$isNotSV ){ ?>
		<h2 class='radius-10 padding-10 partition-blue text-bold'> <?php echo Yii::t("project","Add contributor",null,Yii::app()->controller->module->id) ?></h2>
	<?php } ?>
	<div class="noteWrap col-md-8 col-md-offset-2">
		<?php if (!@$isNotSV){ ?>
			<h1><?php echo Yii::t("project","Add contributor",null,Yii::app()->controller->module->id) ?></h1>
		<?php } ?>
		<form class="form-contributor" autocomplete="off">
			<input  class="contributor-id"  id="projectID" name="projectID" type="hidden" value='<?php if (!@$isNotSV) echo (string)$project["_id"]; else echo $id; ?>'>
			<div class="form-group" id="searchMemberSection" style="z-index:1000000;">
    	    	<div class='row'>
					<div class="col-md-1">	
		           		<i class="fa fa-search fa-2x"></i> 
		           	</div>
		           	<div class="col-md-11">
		           		<span class="input-icon input-icon-right">
				           	<input class="contributor-search form-control" placeholder="<?php echo Yii::t("common", "Search By name, email") ?>" autocomplete = "off" id="contributorSearch" name="contributorSearch" value="">
				           		<i id="iconeChargement" class="fa fa-spinner fa-spin pull-left"></i>
				        		<ul class="dropdown-menu" id="dropdown_search" style="">
									<li class="li-dropdown-scope">-</li>
								</ul>
							</input>
						</span>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group"  id="addContributorSection">
						<div class='row center'>
		            		<input type="hidden" id="contributorType"/>
		            		<input type="hidden" id="contributorId"/>
		            		<div class="btn-group ">
								<a id="btnCitoyen" href="javascript:;" onclick="switchTypeContributor('citoyens')" class="btn btn-green">
									Citoyen
								</a>
								<a id="btnOrganization" href="javascript:;" onclick="switchTypeContributor('organizations')" class="btn btn-green">
									Organisation
								</a>
							</div>
			            </div><br>
		                <div id="formNewContributor">
			    	        <div class="row form-group">
			    	        	<div class="col-md-1" id="iconUser">	
					           		
					           	</div>
					           	<div class="col-md-10">
			    	        		<input class="contributor-name form-control" placeholder="Name" id="contributorName" name="contributorName" value=""/>
								</div>		    	        
			    	        </div>
			    	        <div class="row form-group" id="divOrganizationType">
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
			    	        <div class ="row form-group">
			    	        	<div class="col-md-1">	
					           		<i class="fa fa-envelope-o fa-2x"></i>
					           	</div>
			    	        	<div class="col-md-10">
			               			<input class="contributor-email form-control" placeholder="Email" autocomplete = "off" id="contributorEmail" name="contributorEmail" value=""/>
			               		</div>
			               	</div>
			               	<div class="row form-group">
								<div class="col-md-5">
									<div id="divAdmin" class="form-group">
						    	    	<label class="control-label">
											Administrateur :
										</label>
										<input class="hide" id="contributorIsAdmin" name="contributorIsAdmin"></input>
										<input type="checkbox" data-on-text="YES" data-off-text="NO" name="my-checkbox"></input>
									</div>
								</div>
							</div>
			               	<div class ="row">
				               	<div class="col-md-10  col-md-offset-1">	
									<a href="javascript:showSearchContributor()"><i class="fa fa-search"></i> <?php echo Yii::t("common","Search") ?></a>
								</div>
							</div>
							
							<div class="form-group">
								<div class="row">
					    	        <button class="btn btn-primary" ><?php echo Yii::t("common","SAVE") ?></button>
					    	    </div>
					    	</div>
				    	</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
	 	bindprojectSubViewcontributor();
	 	runContributorFormValidation();
	 	$('#contributorEmail').keyup(function(e){
		    var email = $('#contributorEmail').val();
		    clearTimeout(timeout);
		    timeout = setTimeout('autoCompleteEmailAddContributor("'+email+'")', 500);		
		});
		$('#contributorEmail').focusout(function(e){
		});
	});
	
	var mapIcon = {"citoyens":"fa-smile-o", "organizations":" fa-building-o"};
	
	function bindprojectSubViewcontributor() {	
		$(".new-contributor").off().on("click", function() {
			subViewElement = $(this);
			//$(".form-contributor .contributor-id").val($(this).data("id"));
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					editContributor();
				},
				onHide : function() {
					hideEditContributor();
					showSearchContributor();
				},
				onSave: function() {
					hideEditContributor();
					showSearchContributor();
				}
			});
		});

		$(".close-subview-button").off().on("click", function(e) {
			$(".close-subviews").trigger("click");
			e.prinviteDefault();
		});
		$('#newContributors #contributorSearch').keyup(function(e){
		    var searchValue = $('#newContributors #contributorSearch').val();
		    if(searchValue.length>2){
		    	clearTimeout(timeout);
			    timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 500);
			    clearTimeout(timeout);
			    timeout = setTimeout('autoCompleteEmailAddContributor("'+searchValue+'")', 500); 
		    }else{
		    	$("#newContributors #dropdown_search").css({"display" : "none" });
		    	$("#iconeChargement").css("visibility", "hidden")
		    }
		       		
		});
		$('#contributorEmail').focusout(function(e){
			//$("#ajaxSV #dropdown_city").css({"display" : "none" });
		});
	};

	var subViewElement, subViewContent, subViewIndex;
	var timeout;

	function runContributorFormValidation(el) {
		var formProject = $('.form-contributor');
		var errorHandler2 = $('.errorHandler', formProject);
		var successHandler2 = $('.successHandler', formProject);
		$("[name='my-checkbox']").bootstrapSwitch();
		$("[name='my-checkbox']").on("switchChange.bootstrapSwitch", function (event, state) {
			console.log("state = "+state );
			if (state == true) {
				$("#newContributors #contributorIsAdmin").val(1);
			} else {
				$("#newContributors #contributorIsAdmin").val(0);
			}
		});
		formProject.validate({
			errorElement : "span", // contain the error msg in a span tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.parent().hasClass("input-icon")) {

					error.insertAfter($(element).parent());
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : "",
			rules : {
				contributorName : {
					minlength : 2,
					required : true
				},
				contributorType : {
					required : true
				},
				contributorEmail: {
					required : true
				}
			},
			messages : {
				contributorName : "* <?php echo Yii::t("common","Please specify your first name") ?>",
				contributorType : "* <?php echo Yii::t("common","Please select a type") ?>",
				contributorEmail : "* <?php echo Yii::t("common","Please enter an email") ?>"

			},
			invalidHandler : function(contributor, validator) {//display error alert on form submit
				successHandler2.hide();
				errorHandler2.show();
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			},
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error').find('.symbol').removeClass('required').addClass('ok');
			},
			submitHandler : function(form) {
				successHandler2.show();
				errorHandler2.hide();
				id=$("#projectID").val();
				newProject = new Object;
				newProject.id = $(".form-contributor #projectID").val();
				newProject.type = $(".form-contributor #contributorType").val();
				newProject.contribId = $("#newContributors #contributorId").val();
				newProject.name = $(".form-contributor .contributor-name").val();
				newProject.email = $('.form-contributor .contributor-email').val();
				newProject.organizationType=$('.form-contributor #organizationType').val();
				newProject.contributorIsAdmin = $("#newContributors #contributorIsAdmin").val();
				$.blockUI({
					message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
		            '<blockquote>'+
		              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
		              '<cite title="Hegel">Hegel</cite>'+
		            '</blockquote> '
				});
				if ($(".form-contributor .contributor-id").val() !== "") {
					el = $(".form-contributor .contributor-id").val();
					//mockjax simulates an ajax call
					$.mockjax({
						url : '/contributor/edit/webservice',
						dataType : 'json',
						responseTime : 1000,
						responseText : {
							say : 'ok'
						}
					});
								
					$.ajax({
				        type: "POST",
				        url: baseUrl+"/"+moduleId+'/project/savecontributor',
				        dataType : "json",
				        data:newProject,
						type:"POST",
				    })
				    .done(function (data) 
				    {
				    	$.unblockUI();
				        if (data &&  data.result) {  
							if(typeof updateContributor != "undefined" && typeof updateContributor == "function")
		        				updateContributor( data.member,  $("#newContributors #contributorType").val());            
				        	toastr.success('Invatation to project success');
				        	$.hideSubview();
				        		
				        } else {
				           toastr.error('Something Went Wrong : '+data.content);
				        }
				    });

				}
			}
		});
	};
	function setMemberInputAddContributor(id, name, email, type, organizationType){
		name = name.replace("ACCENT","'");
		$("#iconeChargement").css("visibility", "hidden")
		$("#newContributors #contributorSearch").val(name);
		$("#newContributors #contributorName").val(name);
		$("#newContributors #contributorId").val(id);
		$('#newContributors #contributorEmail').val(email);
		$('#newContributors #contributorEmail').attr("disabled", 'disabled');
		$("#newContributors #contributorName").attr("disabled", 'disabled');

		if(type=="citoyens"){
			$("#newContributors #btnCitoyen").trigger("click");
			$("#newContributors #btnOrganization").addClass("disabled");
		}else{
			$("#newContributors #btnOrganization").trigger("click");
			$("#newContributors #btnCitoyen").addClass("disabled");
			$('#newContributors #organizationType').val(organizationType);
			$('#newContributors #organizationType').attr("disabled", 'disabled');
		}
		$("#newContributors #dropdown_search").css({"display" : "none" });
		$("#newContributors #addContributorSection").css("display", "block");
		$("#newContributors #searchMemberSection").css("display", "none");
	}
	function autoCompleteEmailAddContributor(searchValue){
		//console.log("autoCompleteEmailAddMember");
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
					str = "<li class='li-dropdown-scope'><a href='javascript:openNewContributorForm()'><?php echo Yii::t("common","Not find ? Click here.")?></a></li>";
		 			$.each(data, function(key, value) {
		 				$.each(value, function(i, v){
			 				name = (v.name) ? v.name.replace("'","ACCENT") : "";
		  					str += "<li class=\"li-dropdown-scope\"><a href='javascript:setMemberInputAddContributor(\""+v._id["$id"]+"\",\""+name+"\",\""+v.email+"\",\""+key+"\",\""+v.type+"\")'><i class=\"fa "+mapIcon[key]+"\"></i>"+v.name +"</a></li>";
		  				});
		  			}); 
		  			$("#newContributors #dropdown_search").html(str);
		  			$("#newContributors #dropdown_search").css({"display" : "inline" });
	  			}
			}	
		})
	}
	function openNewContributorForm(){
		$("#newContributors #addContributorSection").css("display", "block");
		$("#newContributors #searchMemberSection").css("display", "none");
		$("#newContributors #contributorName").val("");
		$("#newContributors #contributorName").removeAttr("disabled");
		$("#newContributors #contributorId").val("");
		$('#newContributors #contributorEmail').val("");
		$('#newContributors #contributorEmail').removeAttr("disabled");
		$('#newContributors #organizationType').removeAttr("disabled");
		$("#newContributors #contributorRole").val("");
		$("#newContributors #contributorIsAdmin").val("0");
		$("[name='my-checkbox']").bootstrapSwitch('state', false);
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  		if(emailReg.test( $("#newContributors #contributorSearch").val() )){
  			$('#newContributors #contributorEmail').val( $("#newContributors #contributorSearch").val());
  		}else{
  			$("#newContributors #contributorName").val($("#newContributors #contributorSearch").val());
  		}
	}
	function showSearchContributor(){
		$("#newContributors #btnOrganization").removeClass("disabled");
		$("#newContributors #btnCitoyen").removeClass("disabled");
		$("#newContributors #btnCitoyen").removeClass("btn-dark-green");
		$("#newContributors #btnCitoyen").addClass("btn-green");
		$("#newContributors #btnOrganization").removeClass("btn-dark-green");
		$("#newContributors #btnOrganization").addClass("btn-green");
		$("#newContributors #formNewContributor").css("display", "none");
		$("#newContributors #addContributorSection").css("display", "none");
		$("#newContributors #searchMemberSection").css("display", "block");
		$("#newContributors #divAdmin").css("display", "none");
		$("#iconeChargement").css("visibility", "hidden")
		$("#newContributors .contributor-search").val("");
		$("#newContributors #dropdown_search").css({"display" : "none" });
	}
	
	function switchTypeContributor(str){
		$("#newContributors #formNewContributor").css("display", "block");
		$("#newContributors #iconUser").empty();
		if(str=="citoyens"){ 
			$("#newContributors #divAdmin").css("display", "block");
			$("#newContributors #iconUser").html('<i class="fa fa-user fa-2x"></i>');
			$("#newContributors #divOrganizationType").css("display", "none");
			$("#newContributors #btnCitoyen").removeClass("btn-green");
			$("#newContributors #btnCitoyen").addClass("btn-dark-green");
			$("#newContributors #btnOrganization").removeClass("btn-dark-green");
			$("#newContributors #btnOrganization").addClass("btn-green");
		}else{
			$("#newContributors #divAdmin").css("display", "none");
			$("#newContributors #divOrganizationType").css("display", "block");
			$("#newContributors #iconUser").html('<i class="fa fa-group fa-2x"></i>');
			$("#newContributors #btnOrganization").removeClass("btn-green");
			$("#newContributors #btnOrganization").addClass("btn-dark-green");
			$("#newContributors #btnCitoyen").removeClass("btn-dark-green");
			$("#newContributors #btnCitoyen").addClass("btn-green");
		}
		$("#newContributors #contributorType").val(str);
	}


	// on hide contributor's form destroy summernote and bootstrapSwitch plugins
	function hideEditContributor() {
		$.hideSubview();
	};
	// enables the edit form 
	function editContributor(el) {
		$(".close-new-contributor").off().on("click", function() {
			$(".back-subviews").trigger("click");
		});
		$(".form-contributor .help-block").remove();
		$(".form-contributor .form-group").removeClass("has-error").removeClass("has-success");
	};
</script>