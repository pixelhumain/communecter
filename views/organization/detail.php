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
		$(".moduleLabel").html("<i class='fa fa-users'></i> <?php echo addslashes($organization["name"]) ?> ");
   	});

</script>
<?php } ?>