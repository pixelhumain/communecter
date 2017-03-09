<?php
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-xs-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8 no-padding">
				<?php 
				$this->renderPartial('pod/ficheInfo', array( "project" => $project, 
																	"tags" => $tags, 
																	"countries" => $countries,
																	"isAdmin"=> $admin,
																	"tasks" =>$tasks,
																	"imagesD" => $images,
																	"openEdition"=> $openEdition
																	//"events" => $events
																	));
				?>

				<div class="col-md-12 col-sm-12 col-xs-12 no-padding pull-left">
					<div class="row padding-15">
						<hr>
						<a href='javascript:loadByHash("#rooms.index.type.projects.id.<?php echo (String) $project["_id"]; ?>")'>
				        	<h1 class="text-azure text-left homestead no-margin">
				        		<i class='fa fa-angle-down'></i> <i class='fa fa-connectdevelop'></i> Espace coopératif <i class='fa fa-sign-in'></i> <span class="text-small helvetica">(activité récente)</span>
				        	</h1>
				        </a>
				    </div>
					<?php 
							$list = ActionRoom::getAllRoomsActivityByTypeId(Project::COLLECTION, (string)$project["_id"]);	
							$this->renderPartial('../pod/activityList2',array(    
			   					"parent" => $project, 
			                    "parentId" => (string)$project["_id"], 
			                    "parentType" => Project::COLLECTION, 
			                    "title" => "Activité Coop",
	                        	"list" => @$list, 
			                    "renderPartial" => true
			                    ));
						?>	
				</div>
				
			</div>


			<div class="col-md-4 col-xs-12 no-padding pull-right">
				<div class="col-md-12 col-xs-12">
					<?php  	$this->renderPartial('../pod/usersList', array(  "project"=> $project,
															"users" => $contributors,
															"userCategory" => Yii::t("common","Community"), 
															"countStrongLinks" => $countStrongLinks,
															"countLowLinks" => $countLowLinks,
															"contentType" => Project::COLLECTION,
															"admin" => $admin,
															"openEdition"=> $openEdition));
					?>
					<?php 
						if(!empty($properties) || $admin==true){
							$this->renderPartial('pod/projectChart',array("itemId" => (string)$project["_id"], 
																		"itemName" => $project["name"], 
																		"properties" => $properties, 
																		"admin" =>$admin,
																)); 
						}
					?>
				</div>
				<?php if((@$project["links"]["needs"] && !empty($project["links"]["needs"])) || $admin==true){ ?> 
				<div class="col-md-12 col-xs-12 needsPod">	
					<?php 
					$this->renderPartial('../pod/needsList',array( 	
						"needs" => $needs, 
						"parentId" => (String) $project["_id"],
						"parentType" => Project::COLLECTION,
						"isAdmin" => $admin,
						"parentName" => $project["name"],
						"openEdition" => $openEdition,
					  )); ?>
				</div>
				<?php } 
				if((@$project["links"]["events"] && !empty($project["links"]["events"])) || $admin==true){ ?>
				<div class="col-md-12 col-xs-12">
					<?php 
							if(!isset($eventTypes)) $eventTypes = array();
							$this->renderPartial('../pod/eventsList',array( "events" => $events, 
																	"contextId" => (String) $project["_id"],
																	"contextType" => Project::CONTROLLER,
																	"list" => $eventTypes,
																	"authorised" => $admin,
																	"openEdition"=> $openEdition
																  )); ?>
				</div>
				<?php } ?>
				<div class="col-md-12 col-xs-12">
					<?php   $this->renderPartial('../pod/POIList', array( "parentId" => (String) $project["_id"],
																		"parentType" => Project::CONTROLLER));
					?>
		    	</div>	    	
			</div>
			
			<div class="col-md-8 col-sm-12 no-padding pull-left">
				<!-- <div class="row padding-15">
					<hr>
					<a href='javascript:loadByHash("#rooms.index.type.projects.id.<?php echo (String) $project["_id"]; ?>")'>
			        	<h1 class="text-azure text-left no-margin">
			        		<i class='fa fa-angle-down'></i> <i class='fa fa-connectdevelop'></i> Espace coopératif <i class='fa fa-sign-in'></i> 
			        	</h1>
			        </a>
			    </div> -->
				<?php 
						/*$rooms = ActionRoom::getAllRoomsByTypeId(Project::COLLECTION, (string)$project["_id"]);	
						$this->renderPartial('../dda/index',array(    
		   					"parent" => $project, 
		                    "parentId" => (string)$project["_id"], 
		                    "parentType" => Project::COLLECTION, 
		                    "faTitle" => "connectdevelop",
		                    "colorTitle" => "azure",
		                    "textTitle" => "",
		                    "fromView" => "entity.detail",
                        	"discussions" => @$rooms["discussions"], 
		                    "votes" => @$rooms["votes"], 
		                    "actions" => @$rooms["actions"], 
		                    "history" => @$rooms["history"], 
		                    "renderPartial" => true
		                    ));*/
					?>	
			</div>

			<div class="col-md-8 col-sm-12 no-padding pull-left">
				<!-- <div class="row padding-15">
					<hr>
			    </div> -->
			    <hr>
			    <div class="timesheetphp"></div>
			</div>	
	</div>
</div>
<?php 
	//var_dump($project);
	// $geoProject = $project["geo"];
	// foreach ($contributors as $key => $value) {
	// 	$contributors[$key]["geo"] = $geoProject;
	// }
	$contextMap = array_merge($events, $contributors);
	$contextMap["thisProject"] = array($project);
?>
<script type="text/javascript">
var contextMap = <?php echo json_encode($contextMap)?>;
jQuery(document).ready(function() {
	contextData = {
		name : "<?php echo $project["name"] ?>",
		id : "<?php echo (string)$project["_id"] ?>",
		type : "<?php echo Project::CONTROLLER ?>",
		otags : "<?php echo addslashes($project["name"]).","."projet,communecter,".@implode(",", $project["tags"]) ?>",
		odesc : "Projet : <?php echo addslashes(strip_tags(json_encode(@$project["shortDescription"]))) ?> <?php echo @$project["address"]["streetAddress"] ?> <?php echo @$project["address"]["postalCode"] ?> <?php echo @$project["address"]["addressLocality"] ?> <?php echo @$project["address"]["addressCountry"] ?>"
	}; 
	setTitle("<?php echo addslashes($project["name"]) ?> ","<i class='fa fa-circle text-purple'></i> <i class='fa fa-lightbulb-o'></i>",null,contextData.otags, contextData.odesc);

	//getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>",null,"html");
	
	<?php if((@$project["tasks"] && !empty($project["tasks"])) || $admin==true){ ?>
	getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
	<?php } ?>

	Sig.restartMap();
	Sig.showMapElements(Sig.map, contextMap);		
});

</script>