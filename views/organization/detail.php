<?php 
	if(!$alone){
		Menu::organization($organization);
		$this->renderPartial('../default/panels/toolbar'); 
	}
?>
<?php if (isset($organization["_id"]) && isset(Yii::app()->session["userId"])
				 && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organization["_id"])) { 
		if(!isset($organization["disabled"]))
			$admin=1;
		else 
			$admin=false;
	}
	else
		$admin=false;
?>

<div class="col-xs-12 infoPanel dataPanel">
		<div class="row">
			<div class="col-sm-12 col-xs-12 col-md-8">
	    		<?php 
	    			$params = array(
	    				"organization" => $organization,
						"tags" => $tags, 
						"images" => $images,
						"plaquette" => $plaquette,
						"organizationTypes" => $organizationTypes,
						"countries" => $countries,
						"typeIntervention" => $typeIntervention,
						"NGOCategories" => $NGOCategories,
						"localBusinessCategories" => $localBusinessCategories,
	    				"contextMap" => $contextMap,
	    				"publics" => $public,
	    				"contentKeyBase" => $contentKeyBase
	    			);
	    			//print_r($params);
	    			$this->renderPartial('../pod/ficheInfo',$params); 
	    		?>
	    	</div>
	    	<div class="col-md-4 no-padding">
		    	<div class="col-md-12 col-xs-12">
					<?php   $this->renderPartial('../pod/usersList', array(  "organization"=> $organization,
															"users" => $members,
															"userCategory" => Yii::t("common","COMMUNITY"), 
															"followers" => $followers,
															"contentType" => Organization::COLLECTION,
															"admin" => $admin	));
					?>
		    	</div>
		    	<?php if (($admin == 1 || !empty($needs)) && ($organization["type"]=="NGO" || $organization["type"]=="Group")){ ?> 
				<div class="col-md-12 col-xs-12 needsPod">	
					<?php $this->renderPartial('../pod/needsList',array( 	"needs" => $needs, 
																			"parentId" => (String) $organization["_id"],
																			"parentType" => Organization::COLLECTION,
																			"isAdmin" => $admin,
																			"parentName" => $organization["name"]
																		  )); ?>

				</div>
				<?php } ?>
				<?php if ($admin == 1 || !empty($events)){ ?>
				<div class="col-md-12 col-xs-12">
					<?php 
						if(!isset($eventTypes)) $eventTypes = array();
						$this->renderPartial('../pod/eventsList',array( 	"events" => $events, 
																			"contextId" => (String) $organization["_id"],
																			"contextType" => Organization::CONTROLLER,
																			"list" => $eventTypes,
																			"authorised" => $admin
																		  )); ?>
				</div>
				<?php } ?>
				<?php if ($admin == 1 || !empty($projects)){ ?>
				<div class="col-md-12 col-xs-12">
		 			<?php $this->renderPartial('../pod/projectsList',array( "projects" => $projects, 
															"contextId" => (String) $organization["_id"],
															"contextType" => "organization",
															"authorised" =>	$admin
					)); ?>
				</div>
				<?php } ?>
			</div>
	    </div>
	 </div>
</div>

<?php if(!$alone){ ?>	
<!-- end: PAGE CONTENT-->
<script>

	jQuery(document).ready(function() {

		$(".moduleLabel").html("<i class='fa fa-circle text-green'></i> <i class='fa fa-users'></i> <?php echo addslashes($organization["name"]) ?> ");
		//if($(".tooltips").length) {
     	//	$('.tooltips').tooltip();
   		//}
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
			 //$(this).html('<i class=" disconnectBtnIcon fa fa-spinner fa-spin"></i>');
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
							
							removeFloopEntity(idMemberOf, "organizations");
							loadByHash(location.hash);
						} else {
						   toastr.error("<?php echo Yii::t('organization','Error deleting the link : ') ?>"+data.msg);
						}
					}
				});
			});

			//$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
		});
		
		
		//Add Me as member Of Button --- A supprimer (refactor links)
		/*$('#addMeAsMemberInfo').off().on("click", function(e) {
			$(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinner fa-spin");
			e.preventDefault();
			var formData = {
				"childId" : "<?php echo Yii::app()->session["userId"] ?>",
				"childType" : '<?php echo Person::COLLECTION ?>', 
				"parentType" : "<?php echo Organization::COLLECTION;?>",
				"parentId" : contextId,
				"connectType" : false
			};
			bootbox.confirm("<?php echo Yii::t('organization','Do you really want to become a member of the organization : ') ?><span class='text-red'>"+contextData.name+"</span> ?", 
			function(result) {
				if (!result) {
					$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
					return;
				}
		
				$.ajax({
					type: "POST",
					url: baseUrl+"/"+moduleId+"/link/connect",
					data: formData,
					dataType: "json",
					success: function(data) {
						if(data.result){
							console.log("saveMembre");
							addFloopEntity(contextData["_id"]["$id"], "organizations", contextData);
							$("#linkBtns").html('<a href="javascript:;" class="removeMemberBtn tooltips " data-name="'+contextData.name+'"'+ 
												'data-memberof-id="'+contextData["_id"]["$id"]+'" data-member-type="<?php echo Person::COLLECTION ?>" data-member-id="<?php echo Yii::app()->session["userId"] ?>" data-placement="left" '+
												'data-original-title="<?php echo Yii::t('organization','Remove from my Organizations') ?>" >'+
												'<i class=" disconnectBtnIcon fa fa-unlink"></i><?php echo Yii::t('organization','NOT A MEMBER') ?></a>');
							bindFicheInfoBtn();
							if (data.notification && data.notification=="toBeValidated")
								toastr.success("<?php echo Yii::t('common','Your request has been sent to other admins.')?>");	
							else
								toastr.success("<?php echo Yii::t('organization','You are now a member of the organization : ') ?>"+contextData.name);
								loadByHash(location.hash);
						}
						else
							toastr.error(data.msg);
					},
				});  
			});             
		});	*/
	}
</script>
<?php } ?>