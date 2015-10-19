<?php 
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-md-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8">
				<?php 
				$this->renderPartial('pod/ficheInfo', array( "project" => $project, 
																	"tags" => $tags, 
																	"countries" => $countries,
																	"isAdmin"=> $admin,
																	"tasks" =>$tasks,
																	"imagesD" => $images
																	//"events" => $events
																	));
				?>
				<div class="timesheetphp">
				</div>
			</div>
			<div class="col-md-4 no-padding">
				<div class="col-md-12">
					<?php $this->renderPartial('pod/contributors', array( "project" => $project, 
																	
																	"admin"=> $admin,
																	
																	"contributors" => $contributors,
	
																	"isDetailView" => 1																));
					?>
					<?php $this->renderPartial('pod/projectChart',array("itemId" => (string)$project["_id"], "itemName" => $project["name"], "properties" => $properties, "admin" =>$admin,"isDetailView" => 1)); ?>
				</div>
				<div class="col-md-12 needsPod">
				</div>
				<div class="col-md-12 col-xs-12">
					<?php $this->renderPartial('../pod/eventsList',array( "events" => $events, 
																	"contextId" => (String) $project["_id"],
																	"contextType" => Project::CONTROLLER,
																	"authorised" => $admin,
																	"isNotSV" => 1
																  )); ?>
				</div>
			</div>
		</div>	
	</div>
</div>

<script type="text/javascript">
	
jQuery(document).ready(function() {


//getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>",null,"html");
getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
});
getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
</script>