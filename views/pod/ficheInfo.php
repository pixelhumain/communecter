<?php 
$cssAnsScriptFilesModule = array(
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5-editor.css',
	'/plugins/x-editable/js/bootstrap-editable.js',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/wysihtml5x-toolbar.min.js',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.js',
	'/plugins/wysihtml5/wysihtml5.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");

$cssAnsScriptFilesModule = array(
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule , $this->module->assetsUrl);
?>
<style>
	.fileupload, .fileupload-preview.thumbnail, 
	.fileupload-new .thumbnail, 
	.fileupload-new .thumbnail img, 
	.fileupload-preview.thumbnail img {
	    width: 100%;
	}
	.panelDetails .row{
		margin:0px !important;
	}
	.info-coordonnees a{
		font-size:14px;
		font-weight: 500;
	}
	.info-shortDescription a{
		font-size:14px;
		font-weight: 500;
	}

</style>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"> 
			<a href="#" id="type" data-type="select" data-title="Type" data-emptytext="Type" class="editable editable-click required">
			</a>
			<span> - </span>
			<a href="#" id="name" data-type="text" data-title="<?php echo Yii::t("common","Name") ?>" data-emptytext="<?php echo Yii::t("common","Name") ?>" 
				class="editable-context editable editable-click required">
				<?php echo (isset($organization)) ? $organization["name"] : null; ?>
			</a>
		</h4>
		
		<div class="panel-tools">
			<?php if (isset($organization["_id"]) && isset(Yii::app()->session["userId"])
				 && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organization["_id"])) { 
					if(!isset($organization["disabled"])){
				 	?>
					<a href="javascript:" id="editFicheInfo" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="left" title="Editer vos informations" alt=""><i class="fa fa-pencil"></i> <span class="hidden-sm hidden-xs"> Editer</span></a>
					<a href="javascript:" id="editGeoPosition" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="left" title="Modifiez la position sur la carte" alt=""><i class="fa fa-map-marker"></i><span class="hidden-sm hidden-xs"> Déplacer</span></a>
					<a href="javascript:" id="disableOrganization" class="btn btn-xs btn-red tooltips" data-id="<?php echo $organization["_id"] ?>" data-toggle="tooltip" data-placement="top" title="Disable this organization" alt=""><i class=" text-red fa fa-times"></i> <span class="hidden-sm hidden-xs"> Disable</span></a>
			<?php } else {?>
					<span class="label label-danger">DISABLED</span>
			<?php }} ?>
		</div>
	</div>
	<div class="panel-body border-light panelDetails" id="organizationDetail">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<?php 
					$this->renderPartial('../pod/fileupload', array("itemId" => $organization["_id"],
																	  "type" => Organization::COLLECTION,
																	  "resize" => false,
																	  "contentId" => Document::IMG_PROFIL,
																	  "editMode" => Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $organization["_id"]))); 
				?>
			</div>
			<div class="col-sm-6 col-xs-6">
				<div class="row padding-20 info-coordonnees">
					<a href="#" id="streetAddress" data-type="text" data-title="<?php echo Yii::t("common","Street Address") ?>" data-emptytext="<?php echo Yii::t("common","Street Address") ?>" class="editable-context editable editable-click">
						<?php echo (isset( $organization["address"]["streetAddress"])) ? $organization["address"]["streetAddress"] : null; ?>
					</a>
					<br>
				
					<a href="#" id="address" data-type="postalCode" data-title="<?php echo Yii::t("common","Postal code") ?>" 
						data-emptytext="<?php echo Yii::t("common","Postal code") ?>" class="editable editable-click" data-placement="bottom">	
					</a>
					<br>
					<a href="#" id="addressCountry" data-type="select" data-title="<?php echo Yii::t("common","Country") ?>" 
						data-emptytext="<?php echo Yii::t("common","Country") ?>" data-original-title="" class="editable editable-click">
					</a>
					<br>
				
					<a href="#" id="telephone" data-type="text" data-title="<?php echo Yii::t("common","Phone number") ?>" 
						data-emptytext="<?php echo Yii::t("common","Phone number") ?>" class="editable-context editable editable-click">
						<?php echo (isset($organization["telephone"])) ? $organization["telephone"] : null; ?>
					</a>
					<br>
				
					<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-context editable editable-click required">
						<?php echo (isset($organization["email"])) ? $organization["email"] : null; ?>
					</a>
					<br>
				
					<a href="#" id="url" data-type="text" data-title="<?php echo Yii::t("common","Website URL") ?>" 
						data-emptytext="<?php echo Yii::t("common","Website URL") ?>" class="editable-context editable editable-click">
						<?php echo (isset($organization["url"])) ? $organization["url"] : null; ?>
					</a>
				</div>
				<div class="row padding-20 info-shortDescription" style="background-color:#E6E6E6;">
					<a href="#" id="shortDescription" data-type="wysihtml5" data-showbuttons="true" data-title="<?php echo Yii::t("common","Short Description") ?>" 
						data-emptytext="<?php echo Yii::t("common","Short Description") ?>" class="editable-context editable editable-click">
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
		<div class="row">
			<div class="col-sm-6 col-xs-6 padding-20">
				<h3><i class="fa fa-angle-down"></i> Activités</h3>
				<a href="#" id="category" data-title="Categories" data-type="checklist" data-emptytext="Catégories" class="editable editable-click"></a>
			</div>
			<div class="col-sm-6 col-xs-6 padding-20">
				<h3><i class="fa fa-angle-down"></i> Thématiques</h3>
				<a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="editable editable-click">
				</a>
			</div>
		</div>
		
	</div>
</div>

<script type="text/javascript">
	var contextData = <?php echo json_encode($organization)?>;
	var contextId = "<?php echo isset($organization["_id"]) ? $organization["_id"] : ""; ?>";
	var contentKeyBase = "<?php echo isset($contentKeyBase) ? $contentKeyBase : ""; ?>";
	//By default : view mode
	var mode = "view";
	var images = <?php echo json_encode($images) ?>;
	var types = <?php echo json_encode($organizationTypes) ?>;
	var countries = <?php echo json_encode($countries) ?>;
	var publics = <?php echo json_encode($publics) ?>;
	var NGOCategoriesList = <?php echo json_encode($NGOCategories) ?>;
	var localBusinessCategoriesList = <?php echo json_encode($localBusinessCategories) ?>;

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

		$("#editGeoPosition").click(function(){
			Sig.startModifyGeoposition(contextId, "organizations", contextData);
			showMap(true);
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

		
		$("#disableOrganization").off().on("click",function () {
			console.warn("disableOrganization",$(this).data("id"));
			var id = $(this).data("id");
			bootbox.confirm("<?php echo Yii::t('organization','This action is permanent and will close this Organization (Removed from search engines, and lists)') ?><span class='text-red'>"+$(this).data("name")+"</span> ?", 
				function(result) {
					if (!result) {
						return;
					} else {
						$.ajax({
							url: baseUrl+"/"+moduleId+"/organization/disabled/id/"+id ,
							type: "POST",
							success: function(data)
							{
								if(data.result)
									toastr.success(data.msg);
								else
									toastr.error(data.msg);
						  	},
						});
					}
			});
		});
		$(".removeMemberBtn").off().on("click",function () {
			$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
			
			var idMemberOf = $(this).data("memberof-id");
			var idMember = $(this).data("member-id");
			var typeMember = $(this).data("member-type");
			bootbox.confirm("<?php echo Yii::t('organization','Are you sure you want to remove the connection with ') ?><span class='text-red'>"+$(this).data("name")+"</span> ?", 
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
							$("#linkBtns").html('<a href="javascript:;" class="connectBtn tooltips " id="addMeAsMemberInfo" data-placement="top"'+
												'data-original-title="<?php echo Yii::t('organization','Become a member of this organization') ?>" >'+
												'<i class=" connectBtnIcon fa fa-link "></i> <?php echo Yii::t('organization','I AM A MEMBER') ?></a>');
							bindFicheInfoBtn();
							toastr.success("<?php echo Yii::t('organization','The link has been removed successfully.') ?>");
							$("#organizations"+idMemberOf).remove();
							if ($("#organizations tr").length == 0) {
								$("#info").show();
							}
							if( isNotSV )
								loadByHash(location.hash);
						} else {
						   toastr.error("<?php echo Yii::t('organization','Error deleting the link : ') ?>"+data.msg);
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
			bootbox.confirm("<?php echo Yii::t('organization','Do you really want to become a member of the organization : ') ?><span class='text-red'>"+contextData.name+"</span> ?", 
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
							$("#linkBtns").html('<a href="javascript:;" class="removeMemberBtn tooltips " data-name="'+contextData.name+'"'+ 
												'data-memberof-id="'+contextData["_id"]["$id"]+'" data-member-type="<?php echo Person::COLLECTION ?>" data-member-id="<?php echo Yii::app()->session["userId"] ?>" data-placement="left" '+
												'data-original-title="<?php echo Yii::t('organization','Remove from my Organizations') ?>" >'+
												'<i class=" disconnectBtnIcon fa fa-unlink"></i><?php echo Yii::t('organization','NOT A MEMBER') ?></a>');
							bindFicheInfoBtn();
							toastr.success("<?php echo Yii::t('organization','You are now a member of the organization : ') ?>"+contextData.name);
							if( isNotSV )
								loadByHash(location.hash);
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
			$('#category').editable('toggleDisabled');
			$('#typeOfPublic').editable('toggleDisabled');
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('#description').editable('option', 'pk', contextId);
			$('#type').editable('option', 'pk', contextId);
			$('#address').editable('option', 'pk', contextId);
			$('#addressCountry').editable('option', 'pk', contextId);
			$('#tags').editable('option', 'pk', contextId);
			$('#category').editable('option', 'pk', contextId);
			$('#typeOfPublic').editable('option', 'pk', contextId);
			
			$('.editable-context').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#category').editable('toggleDisabled');
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
				tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
				tokenSeparators: [","],
				width: 200
			}
		});

		$('#category').editable({
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			mode: 'popup',
			value: <?php echo (isset($organization["category"])) ? json_encode(implode(",", $organization["category"])) : "''"; ?>,
			source: function() {
				var result = new Array();
				var categorySource;
				console.log("contextData.type",contextData.type);
				if (contextData.type == "<?php echo Organization::TYPE_NGO ?>") categorySource = NGOCategoriesList;
				if (contextData.type == "<?php echo Organization::TYPE_BUSINESS ?>") categorySource = localBusinessCategoriesList;
				console.log(categorySource);
				$.each(categorySource, function(i,value) {
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