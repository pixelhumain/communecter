<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript">
    $('head').append('<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/jquery-editable/css/jquery-editable.css" rel="stylesheet" />');
    $.fn.poshytip={defaults:null};
</script>
<script>
if($('#breadcum').length)$('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><a href="javascript:;" onclick="reverseToRepertory();">Répertoire</a><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><?php echo addslashes($element["name"]); ?>');
</script>
<?php 
		if($type != City::CONTROLLER && !@$_GET["renderPartial"])
			$this->renderPartial('../pod/headerEntity', array("entity"=>$element, "type" => $type, "openEdition" => $openEdition, "admin" => $admin)); 
		//End isset renderPartial
?>
<div class="row">
	<div class=" col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8 no-padding">
	    		<?php 
	    			$params = array(
	    				"element" => $element,
						"tags" => $tags, 
						"images" => array("profil"=>array($element["profilImageUrl"])),
						"elementTypes" => @$listTypes,
						"countries" => $countries,
						"typeIntervention" => @$typeIntervention,
						"NGOCategories" => @$NGOCategories,
						"localBusinessCategories" => @$localBusinessCategories,
	    				"contextMap" => @$contextMap,
	    				"publics" => @$public,
						"type" => @$type,
						"organizer" =>@$organizer,
	    				"contentKeyBase" => "profil",
	    				"edit" => @$edit,
	    				"isLinked" => @$isLinked
	    			);
	    			$this->renderPartial('../pod/ficheInfoElement',$params); 
	    		?>
	    	</div>
			<div class="col-md-4 no-padding pull-right">
				<?php if($type != Person::COLLECTION){ ?>
				<div class="col-md-12 col-xs-12">
					<?php $this->renderPartial('../pod/usersList', array(  $controller => $element,
															"users" => $members,
															"userCategory" => Yii::t("common","COMMUNITY"), 
															"contentType" => $type,
															"countStrongLinks" => $countStrongLinks,
															"countLowLinks" => $countLowLinks,
															"admin" => $admin, 
															"invitedMe" => @$invitedMe));

					/*$this->renderPartial('../pod/usersList', array(  "event"=> $event,
															"users" => $attending,
															"userCategory" => Yii::t("event","ATTENDEES",null,Yii::app()->controller->module->id), 
															"contentType" => Event::COLLECTION,
															"admin" => $admin,
															"countLowLinks" => $invitedNumber,
															"countStrongLinks"=> $attendeeNumber,
															"invitedMe" => @$invitedMe));*/
					?>
				</div>
				<?php } ?>
		    	<?php if (($type==Project::COLLECTION || $type==Organization::COLLECTION || $type==Event::COLLECTION)){ ?>
				<div class="col-md-12 col-xs-12">
					<?php 
						$organizerImg=false;
						if($type==Event::COLLECTION) $organizerImg=true;
						if(!isset($eventTypes)) $eventTypes = array();
						if(empty($subEvents)) $subEvents = array();
						$this->renderPartial('../pod/eventsList',array( 	"events" => $subEvents, 
																			"contextId" => (String) $element["_id"],
																			"contextType" => $controller,
																			"list" => $eventTypes,
																			"authorised" => $admin,
																			"organiserImgs"=> $organizerImg
																		  ));
					?>						  
				</div>
				<?php } ?>


				<?php if (($type==Project::COLLECTION)){ ?>
				<div class="col-md-12 col-xs-12">
					<?php
						if(empty($element["properties"]["chart"])) $element["properties"]["chart"] = array();
						$this->renderPartial('../project/pod/projectChart',array(
												"itemId" => (string)$element["_id"], 
												"itemName" => $element["name"], 
												"properties" => $element["properties"]["chart"],
												"admin" =>$admin,
												"isDetailView" => 1));
					?>						  
				</div>
				<?php } ?>

	







				<?php if ($type==Organization::COLLECTION){ ?>
				<div class="col-md-12 col-xs-12">
		 			<?php $this->renderPartial('../pod/projectsList',array( "projects" => @$projects, 
															"contextId" => (String) $element["_id"],
															"contextType" => $type,
															"authorised" =>	$admin
					)); ?>
				</div>
				<?php } ?>
				<?php if($type==Project::COLLECTION || $type==Organization::COLLECTION){ ?> 
		    	<div class="col-md-12 col-xs-12 needsPod">	
					<?php $this->renderPartial('../pod/needsList',array( 	"needs" => @$needs, 
																			"parentId" => (String) $element["_id"],
																			"parentType" => $type,
																			"isAdmin" => @$admin,
																			"parentName" => $element["name"]
																		  )); ?>

				</div>
			<?php } ?>
			</div>

			<div class="col-md-8 col-sm-12 no-padding pull-left">
				<?php if($type==Project::COLLECTION || $type==Organization::COLLECTION){ ?> 
				<div class="row padding-15">
					<hr>
					<?php $urlCoop = "#rooms.index.type.".$type.".id.".(String) $element["_id"]; ?>
					<a href='javascript:loadByHash("<?php echo $urlCoop; ?>")'>
			        	<h1 class="text-azure text-left homestead no-margin">
			        		<i class='fa fa-angle-down'></i> <i class='fa fa-connectdevelop'></i> Espace coopératif <i class='fa fa-sign-in'></i> 
			        	</h1>
			        </a>
			    </div>
				<?php 
					/*$rooms = ActionRoom::getAllRoomsByTypeId($type, (String)$element["_id"]);	
					$this->renderPartial('../dda/index',array(    
	   					"parent" => $element, 
	                    "parentId" => (String)$element["_id"], 
	                    "parentType" => $type, 
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

					$rooms = ActionRoom::getAllRoomsActivityByTypeId($type, (string)$element["_id"]);	
					$this->renderPartial('../pod/activityList2',array(    
		   					"parent" => $element, 
		                    "parentId" => (string)$element["_id"], 
		                    "parentType" => $type, 
		                    "title" => "Activité Coop",
                        	"list" => @$rooms, 
		                    "renderPartial" => true
		                    ));
					
				}
				?>
				<?php if($type==Project::COLLECTION){ ?> 
					<div class="row padding-15">
						<hr>
						<h1 class="text-azure pull-left homestead no-margin">
			        		<i class='fa fa-angle-down'></i> <i class='fa fa-thumb-tack'></i> Gestion des tâches
			        	</h1>        
				    	</div>
				    	<div class="timesheetphp">
					</div>
				<?php } ?>
				<?php if($type==Event::COLLECTION){ ?> 
				<div class="col-xs-12 no-padding calendar pull-left"></div>
				<div class="col-xs-12 no-padding timesheetphp pull-left"></div>
				<?php } ?>
			</div>
    	<div class="col-md-8 col-sm-12 no-padding pull-left">
	    	
    	</div>
    	
	</div>
</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	<?php 
		if(empty($element["tasks"])) $element["tasks"] = array();
		if($type == Project::COLLECTION) {//|| $admin==true){ ?>
		getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo 
			$type ?>/id/<?php echo $element["_id"]?>/isAdmin/false/isDetailView/1",null,"html");
	<?php } ?>


	<?php if($type == Event::COLLECTION){ ?>
		getAjax(".calendar",baseUrl+"/"+moduleId+"/event/calendarview/id/<?php echo $element["_id"]?>/pod/1?date=1",null,"html");
	<?php } ?>
});
</script>
