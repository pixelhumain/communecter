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
	    				"publics" => $public
	    			);
	    			//print_r($params);
	    			$this->renderPartial('../pod/ficheInfo',$params); 
	    		?>

    			<div id="podCooparativeSpace">
    				<div id="pod-room" class="panel panel-white">

						<div class="panel-heading border-light bg-azure">
							<h4 class="panel-title">
									<i class="fa fa-connectdevelop"></i> 
									<span class="homestead"><?php echo Yii::t("rooms","COOPERATIVE SPACE",null,Yii::app()->controller->module->id); ?></span>
							</h4>		
						</div>

						<div class="panel-body no-padding">
							<blockquote>
							Pour accéder à cet espace, connectez-vous !<br>
							<span class="text-azure">
				   				<i class="fa fa-check-circle"></i> Discuter<br>
				   				<i class="fa fa-check-circle"></i> Débattre<br>
				   				<i class="fa fa-check-circle"></i> Proposer<br>
				   				<i class="fa fa-check-circle"></i> Voter<br>
				   				<i class="fa fa-check-circle"></i> Agir
				   			</span>
				   			</blockquote>
						</div>   
							
					</div>
    			</div>
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
															"contextType" => Organization::COLLECTION,
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

		<?php if(isset($organization["citizenType"]) && $organization["citizenType"] == "citizenAssembly") { ?>
			$(".moduleLabel").html("<i class='fa fa-circle text-red'></i> <i class='fa fa-users text-red'></i> <?php echo addslashes($organization["name"]) ?> ");
		<?php }else{ ?>
			$(".moduleLabel").html("<i class='fa fa-circle text-green'></i> <i class='fa fa-users'></i> <?php echo addslashes($organization["name"]) ?> ");
		<?php } ?>
		//if($(".tooltips").length) {
     	//	$('.tooltips').tooltip();
   		//}
   		bindFicheInfoBtn();

   		<?php if (isset(Yii::app()->session["userId"])) { ?>
	   		$("#podCooparativeSpace").html("<i class='fa fa-spin fa-refresh text-azure'></i>");
				var id = "<?php echo (String) $organization['_id']; ?>";
		   		getAjax('#podCooparativeSpace',baseUrl+'/'+moduleId+"/rooms/index/type/organizations/id/"+id+"/view/pod",
		   			function(){}, "html");
	   	<?php } ?>
	});
	
	function bindFicheInfoBtn(){
		$("#disableOrganization").off().on("click",function () {
			console.warn("disableOrganization",$(this).data("id"));
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
		})
	}
</script>
<?php } ?>