<div class="row">
	<div class="col-lg-4 col-md-12">
		<?php 
			$this->renderPartial('dashboard/description',array( "project" => $project, "tags" => $tags, "countries" => $countries)); ?>
	</div>
	<div class ="col-lg-4 col-md-12">			
		<?php 
			 $this->renderPartial('../pod/sliderPhoto', array("itemId" => (string)$project["_id"], "type" => PHType::TYPE_PROJECTS));
		?>
	</div>	
	<div class ="col-lg-4 col-md-12">
		 <?php $this->renderPartial('dashboard/contributors',array( "contributors" => $contributors, "organizationTypes" => $organizationTypes, "project" => $project, "admin" => $admin)); ?>
	</div>
	<?php if (!empty($tasks) OR $admin==true){ ?>
	<div class ="col-lg-8 col-md-8">
		 <?php $this->renderPartial('dashboard/timesheet',array("itemId" => (string)$project["_id"], "tasks" => $tasks, "admin" =>$admin)); ?>
	</div>
	<?php } 
	 if (!empty($properties) OR $admin==true){ ?>
	<div class ="col-lg-4 col-md-12">
		 <?php $this->renderPartial('dashboard/projectChart',array("itemId" => (string)$project["_id"], "properties" => $properties, "admin" =>$admin)); ?>
	</div>
	<?php } ?>
	
</div>
<script type="text/javascript">
	var contextMap = {};
	contextMap["project"] = <?php echo json_encode($project)?>;
	contextMap["people"] = <?php echo json_encode($people) ?>;
	contextMap["organizations"] = <?php echo json_encode($organizations) ?>;
	var images = <?php echo json_encode($images) ?>;
	var contentKeyBase = "<?php echo $contentKeyBase ?>";

</script>