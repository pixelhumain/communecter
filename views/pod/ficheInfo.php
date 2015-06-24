<?php 
	$cs = Yii::app()->getClientScript();
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/css/bootstrap-editable.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css');
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5-editor.css');

	//X-editable...
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/js/bootstrap-editable.js' , CClientScript::POS_END, array(), 2);

	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap3-wysihtml5/wysihtml5x-toolbar.min.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.js' , CClientScript::POS_END, array(), 2);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/wysihtml5.js' , CClientScript::POS_END, array(), 2);

	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END, array(), 2);
	//X-Editable postal Code
	$cs->registerScriptFile($this->module->assetsUrl. '/js/postalCode.js' , CClientScript::POS_END, array(), 2);
?>
<style>

</style>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"> 
			<a href="#" id="type" data-type="select" data-title="Type" data-emptytext="Type" class="editable editable-click required">
			</a>
			<span> - </span>
			<a href="#" id="name" data-type="text" data-title="Name" data-emptytext="Name" class="editable-context editable editable-click required">
				<?php echo (isset($organization)) ? $organization["name"] : null; ?>
			</a>
		</h4>
		
		<div class="panel-tools">
			<?php if (isset($organization["_id"]) && isset(Yii::app()->session["userId"])
				 && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organization["_id"])) { ?>
					<a href="#" id="editFicheInfo" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Editer vos informations" alt=""><i class="fa fa-pencil"></i></a>
			
			<?php } ?>
		</div>
	</div>
	<div class="panel-body border-light" id="organizationDetail">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<?php 
					$this->renderPartial('../pod/fileupload', array("itemId" => (string)$_GET["id"],
																	  "type" => Organization::COLLECTION,
																	  "resize" => "false",
																	  "contentId" => Document::IMG_PROFIL,
																	  "editMode" => Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $organization["_id"]))); 
				?>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row height-155 padding-20">
					<a href="#" id="streetAddress" data-type="text" data-title="Street Address" data-emptytext="Address" class="editable-context editable editable-click">
						<?php echo (isset( $organization["address"]["streetAddress"])) ? $organization["address"]["streetAddress"] : null; ?>
					</a>
					<br>
					<a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom">
					</a>
					<br>
					<a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click">					
					</a>
					<br>
					<a href="#" id="telephone" data-type="text" data-title="Phone" data-emptytext="Phone Number" class="editable-context editable editable-click">
						<?php echo (isset($organization["telephone"])) ? $organization["telephone"] : null; ?>
					</a>
					<br>
					<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-context editable editable-click required">
						<?php echo (isset($organization["email"])) ? $organization["email"] : null; ?>
					</a>
					<br>
					<a href="#" id="url" data-type="text" data-title="Web Site URL" data-emptytext="Website URL" class="editable-context editable editable-click">
						<?php echo (isset($organization["url"])) ? $organization["url"] : null; ?>
					</a>
				</div>
				<div class="row padding-20" style="background-color:#E6E6E6; min-height:155px;">
					<a href="#" id="shortDescription" data-type="wysihtml5" data-showbuttons="true" data-title="Short Description" data-emptytext="Short Description" class="editable-context editable editable-click">
						<?php echo (isset($organization["shortDescription"])) ? $organization["shortDescription"] : null; ?>
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-xs-12 padding-20">
				<a href="#" id="description" data-title="Description" data-type="wysihtml5" data-emptytext="Description" class="editable editable-click">
				</a>
			</div>
		</div>
		<div class="row" style="background-color:#E6E6E6">
			<div class="col-sm-6 col-xs-6">
				<h1> Activités</h1>
			</div>
			<div class="col-sm-6 col-xs-6">
				<h1> Thématiques</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-6 padding-20">
				<a href="#" id="typeIntervention" data-title="Types d'intervention" data-type="checklist" data-emptytext="Type d'intervention" class="editable editable-click">
				</a>
			</div>
			<div class="col-sm-6 col-xs-6 padding-20">
				<a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="editable editable-click">
					
				</a>
			</div>
		</div>
		<div class="row" style="background-color:#E6E6E6">
			<div class="col-sm-6 col-xs-6">
				<h1> Public</h1>
			</div>
			<div class="col-sm-6 col-xs-6">
				<h1> Telechargement</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-6 padding-20">
				<a href="#" id="typeOfPublic" data-title="Public" data-type="checklist" data-emptytext="Type Of Public" class="editable editable-click">
				</a>
			</div>
			<div class="col-sm-6 col-xs-6 padding-20">
				<?php 
					if (isset($plaquette) && $plaquette) {
	                	$this->widget('ext.widgets.documentLink.DocumentLinkWidget', array(
	                		"document" => $plaquette,
	                		"text" => "Plaquette de presentation"));
	                	//echo Document::getDocumentLink($plaquette, "Plaquette de presentation");
					} else { ?>
						<a href="#">N/A</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var contextData = <?php echo json_encode($organization)?>;
	var contextId = "<?php echo isset($organization["_id"]) ? $organization["_id"] : ""; ?>";
	//By default : view mode
	var mode = "view";
	
	var types = <?php echo json_encode($organizationTypes) ?>;
	var countries = <?php echo json_encode($countries) ?>;
	var publics = <?php echo json_encode($publics) ?>;
	var typeInterventionList = <?php echo json_encode($typeIntervention) ?>;

	jQuery(document).ready(function() {
		$("#editFicheInfo").on("click", function(){
			switchMode();
		})
		activateEditableContext();
		manageModeContext();
		debugMap.push(contextData);

		$('#avatar').change(function() {
		  $('#photoAddEdit').submit();
		});

		$("#photoAddEdit").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/organizations/id/"+contextId,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
					if(data.result)
						toastr.success(data.msg);
						if('undefined' != typeof data.imagePath){
							$("#imgView").attr("src", data.imagePath);
						}
					else
						toastr.error(data.msg);
			  },
			});
		}));

		bindFicheInfoBtn();
	});


	function bindFicheInfoBtn(){

		$(".removeMemberBtn").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idMemberOf = $(this).data("memberof-id");
			var idMember = $(this).data("member-id");
			var typeMember = $(this).data("member-type");
			bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> connection ?", 
				function(result) {
					if (!result) {
					$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
					return;
				}

				console.log(idMember);
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/link/removemember/memberId/"+idMember+"/memberType/"+typeMember+"/memberOfId/"+idMemberOf+"/memberOfType/<?php echo Organization::COLLECTION ?>",
					dataType: "json",
					success: function(data){
						if ( data && data.result ) {
							$("#linkBtns").html('<a href="javascript:;" class="connectBtn tooltips " id="addMeAsMemberInfo" data-placement="top" data-original-title="I\'m member of this organization" ><i class=" connectBtnIcon fa fa-link "></i> LINK</a>')           
							bindFicheInfoBtn();
							toastr.info("LINK DIVORCED SUCCESFULLY!!");
							$("#organizations"+idMemberOf).remove();
							if ($("#organizations tr").length == 0) {
								$("#info").show();
							}
						} else {
						   toastr.info("something went wrong!! please try again.");
						}
					}
				});
			});

			$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
		});


		//Add Me as member Of Button
		$('#addMeAsMemberInfo').off().on("click", function(e) {
			e.preventDefault();
			var formData = {
	    		"memberId" : "<?php echo Yii::app()->session["userId"] ?>",
				"memberName" : "",
				"memberEmail" : "",
				"memberType" : '<?php echo PHType::TYPE_CITOYEN ?>', 
				"parentOrganisation" : contextId,
				"memberIsAdmin" : false,
				"memberRoles" : ""
			};
			bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> connection ?", 
				function(result) {
					if (!result) {
						$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
						return;
				}
			
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/link/saveMember",
					data: formData,
					dataType: "json",
					success: function(data) {
						if(data.result){
							$("#linkBtns").html('<a href="javascript:;" class="removeMemberBtn tooltips " data-name="'+contextData.name+'" data-memberof-id="'+contextData["_id"]["$id"]+'" data-member-type="<?php echo Person::COLLECTION ?>" data-member-id="<?php echo Yii::app()->session["userId"] ?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i>UNFOLLOW</a>');
							bindFicheInfoBtn();
							toastr.success("You are now member of the organization : "+contextData.name);
						}
						else
							toastr.error(data.msg);
					},
				});  
			});             
		});	
	}
	function manageModeContext() {
		if (mode == "view") {
			$('.editable-context').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#typeIntervention').editable('toggleDisabled');
			$('#typeOfPublic').editable('toggleDisabled');
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('#description').editable('option', 'pk', contextId);
			$('#type').editable('option', 'pk', contextId);
			$('#address').editable('option', 'pk', contextId);
			$('#addressCountry').editable('option', 'pk', contextId);
			$('#tags').editable('option', 'pk', contextId);
			$('#typeIntervention').editable('option', 'pk', contextId);
			$('#typeOfPublic').editable('option', 'pk', contextId);
			
			$('.editable-context').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#typeIntervention').editable('toggleDisabled');
			$('#typeOfPublic').editable('toggleDisabled');
		}
	}

	function activateEditableContext() {
		$.fn.editable.defaults.mode = 'popup';

		$('.editable-context').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield",
			title : $(this).data("title"),
			onblur: 'submit',
			success: function(response, newValue) {
        		if(! response.result) return response.msg; //msg will be shown in editable form
    		}
		});
		
		//Type Organization
		$('#type').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: '<?php echo (isset($organization)) ? $organization["type"] : ""; ?>',
			source: function() {
				return types;
			},
		});
		//Select2 tags
		$('#tags').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			value: <?php echo (isset($organization["tags"])) ? json_encode(implode(",", $organization["tags"])) : "''"; ?>,
			select2: {
				width: 200,
				tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
				tokenSeparators: [","]
			}
		});

		$('#typeIntervention').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			value: <?php echo (isset($organization["typeIntervention"])) ? json_encode(implode(",", $organization["typeIntervention"])) : "''"; ?>,
			source: function() {
				var result = new Array();
				$.each(typeInterventionList, function(i,value) {
					result.push({"value" : value, "text" : value}) ;
				})
				return result;
			},
		});

		$('#addressCountry').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: '<?php echo (isset( $organization["address"]["addressCountry"])) ? $organization["address"]["addressCountry"] : ""; ?>',
			source: function() {
				return countries;
			},
		});

		$('#address').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield",
			mode: 'popup',
			success: function(response, newValue) {
				console.log("success update postal Code : "+newValue);
			},
			value : {
            	postalCode: '<?php echo (isset( $organization["address"]["postalCode"])) ? $organization["address"]["postalCode"] : null; ?>',
            	codeInsee: '<?php echo (isset( $organization["address"]["codeInsee"])) ? $organization["address"]["codeInsee"] : ""; ?>',
            	addressLocality : '<?php echo (isset( $organization["address"]["addressLocality"])) ? $organization["address"]["addressLocality"] : ""; ?>'
        	}
		});

		$('#typeOfPublic').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: <?php echo (isset($organization["typeOfPublic"])) ? json_encode(implode(",", $organization["typeOfPublic"])) : "''"; ?>,
			source: publics,
			placement: 'right'
		});

		$('#description').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			value: <?php echo (isset($organization["description"])) ? json_encode($organization["description"]) : "''"; ?>,
			placement: 'top',
			wysihtml5: {
				html: true,
				video: false
			}
		});

		//Validation Rules
		//Mandotory field
		$('.required').editable('option', 'validate', function(v) {
			var intRegex = /^\d+$/;
			if (!v)
				return 'Field is required !';
		});
	} 

	function switchMode() {
		if(mode == "view"){
			mode = "update";
			manageModeContext();
		}else{
			mode ="view";
			manageModeContext();
		}
	}

</script>