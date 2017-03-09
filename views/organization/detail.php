<?php 
	if(!$alone){
		Menu::organization($organization);
		$this->renderPartial('../default/panels/toolbar'); 
	}
?>
<?php 
	if (isset($organization["_id"]) && isset(Yii::app()->session["userId"])) {
		if(!isset($organization["disabled"])) {
			$admin=Authorisation::canEditItem(Yii::app()->session["userId"], Organization::COLLECTION, $organization["_id"]);
		}else 
			$admin=false;
	}
	else
		$admin=false;
?>

<div class="col-xs-12 infoPanel dataPanel">
		<div class="row">
			<div class="col-xs-12 col-md-8">
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
	    				"edit" => $admin,
	    				"openEdition"=> $openEdition
	    			);
	    			//print_r($params);
	    			$this->renderPartial('../pod/ficheInfo',$params); 
	    		?>


    			<div class="col-md-12 col-sm-12 col-xs-12 no-padding pull-left">
					<div class="row padding-15">
						<hr>
						<a href='javascript:loadByHash("#rooms.index.type.organizations.id.<?php echo (String) $organization["_id"]; ?>")'>
				        	<h1 class="text-azure text-left homestead no-margin">
				        		<i class='fa fa-angle-down'></i> <i class='fa fa-connectdevelop'></i> Espace coopératif <i class='fa fa-sign-in'></i> <span class="text-small helvetica">(activité récente)</span>
				        	</h1>
				        </a>

				    </div>
					<?php 
							$list = ActionRoom::getAllRoomsActivityByTypeId(Organization::COLLECTION, (string)$organization["_id"]);	
							$this->renderPartial('../pod/activityList2',array(    
			   					"parent" => $organization, 
			                    "parentId" => (string)$organization["_id"], 
			                    "parentType" => Organization::COLLECTION, 
			                    "title" => "Activité Coop",
	                        	"list" => @$list, 
			                    "renderPartial" => true
			                    ));
						?>	
				</div>
	    	</div>

	    	
	    	<div class="col-md-4 no-padding">
		    	<div class="col-md-12 col-xs-12">
					<?php   $this->renderPartial('../pod/usersList', array(  "organization"=> $organization,
															"users" => $members,
															"userCategory" => Yii::t("common","Community"), 
															"contentType" => Organization::COLLECTION,
															"countStrongLinks" => $countStrongLinks,
															"countLowLinks" => $countLowLinks,
															"admin" => $admin,
															"openEdition" => $openEdition));
					?>
		    	</div>
		    	<div class="col-md-12 col-xs-12">
					<?php  
							$this->renderPartial('../pod/POIList', array( "parentId" => (String) $organization["_id"],
																		"parentType" => Organization::CONTROLLER));
					?>
		    	</div>
		    	<?php
		    	if ( $admin == 1 || !empty($needs) || $openEdition == true ){ ?> 
				<div class="col-md-12 col-xs-12 needsPod">	
					<?php $this->renderPartial('../pod/needsList',array( 	"needs" => $needs, 
																			"parentId" => (String) $organization["_id"],
																			"parentType" => Organization::COLLECTION,
																			"isAdmin" => $admin,
																			"parentName" => $organization["name"],
																			"openEdition" => $openEdition
																		  )); ?>

				</div>
				<?php } ?>
				<?php if ($admin == 1 || !empty($organizations) || $openEdition == true){ ?>
				<div class="col-md-12 col-xs-12">
					<?php 
						if(!isset($eventTypes)) $eventTypes = array();
						$this->renderPartial('../pod/eventsList',array( 	"events" => $events, 
																			"contextId" => (String) $organization["_id"],
																			"contextType" => Organization::CONTROLLER,
																			"list" => $eventTypes,
																			"authorised" => $admin,
																			"openEdition" => $openEdition
																		  )); ?>
				</div>
				<?php } ?>
				<?php if ($admin == 1 || !empty($projects) || $openEdition == true){ ?>
				<div class="col-md-12 col-xs-12">
		 			<?php $this->renderPartial('../pod/projectsList',array( "projects" => $projects, 
															"contextId" => (String) $organization["_id"],
															"contextType" => Organization::COLLECTION,
															"authorised" =>	$admin,
															"openEdition" => $openEdition
					)); ?>
				</div>
				<?php } ?>
			</div>

	    </div>
	 </div>
</div>

<?php if(!$alone){ ?>	
<!-- end: PAGE CONTENT-->
<script type="text/javascript" >


	jQuery(document).ready(function() {
		contextData = {
			name : "<?php echo $organization["name"] ?>",
			id : "<?php echo (string)$organization["_id"] ?>",
			type : "<?php echo Organization::CONTROLLER ?>",
			otags : "<?php echo addslashes($organization["name"]).",organisation,communecter,".$organization["type"].",".@implode(",", $organization["tags"]) ?>",
			odesc : "Organisation :  <?php echo $organization["type"].", ".addslashes( strip_tags(json_encode(@$organization["shortDescription"]))).",".addslashes(@$organization["address"]["streetAddress"]).",".@$organization["address"]["postalCode"].",".@$organization["address"]["addressLocality"].",".@$organization["address"]["addressCountry"] ?>"
		}; 
		setTitle( "<?php echo addslashes($organization["name"]) ?>" , "<i class='fa fa-circle text-green'></i> <i class='fa fa-users'></i>" ,null,contextData.otags, contextData.odesc);
	});
	
	function bindFicheInfoBtn(){
		$("#disableOrganization").off().on("click",function () {
			mylog.warn("disableOrganization",$(this).data("id"));
			var id = $(this).data("id");
			bootbox.confirm("<?php echo Yii::t('organization','This action is permanent and will close this Organization (Removed from search engines, and lists) !')." " ?><span class='text-red'>"+$(this).data("name")+"</span> ?", 
				function(result) {
					if (!result) {
						return;
					} else {
						$.ajax({
							url: baseUrl+"/"+moduleId+"/organization/disabled/id/"+id ,
							type: "POST",
							success: function(data)
							{
								if(data.result){
									loadByHash(location.hash);
									toastr.success(data.msg);
								}
								else{
									toastr.error(data.msg);
								}
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

				mylog.log(idMember);
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
		})
	}
</script>
<?php } ?>