<?php
// $this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-md-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8 no-padding">
				<?php 
				$this->renderPartial('pod/simplyFicheInfo', array( "project" => $project, 
																	"tags" => $tags, 
																	"countries" => $countries,
																	"isAdmin"=> $admin,
																	"tasks" =>$tasks,
																	"imagesD" => $images
																	//"events" => $events
																	));
				?>
			</div>



			<div class="col-md-8 col-sm-12 no-padding timesheetphp pull-left"></div>
		</div>	
	</div>
</div>
<?php 
	//var_dump($project);
	$contextMap = array_merge($events, $contributors);
	$contextMap["thisProject"] = array($project);
?>
<script type="text/javascript">
var contextMap = <?php echo json_encode($contextMap)?>;
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-lightbulb-o'></i> <?php echo addslashes($project["name"]) ?> ");
	//getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>",null,"html");
	<?php if((@$project["tasks"] && !empty($project["tasks"])) || $admin==true){ ?>
	getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
	<?php } ?>
	<?php //if((@$project["links"]["needs"] && !empty($project["links"]["needs"])) || $admin==true){ ?>
	//getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
	<?php //} ?>
	Sig.restartMap();
	Sig.showMapElements(Sig.map, contextMap);		
});

 if(window.location.hash != "#default.simplydirectory") {
 	$("#grid").hide();
 	$("#list").hide();
 	$("#dropdown_paramsBtn").hide();
 }

</script>