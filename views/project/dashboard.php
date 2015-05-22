<div class="row">
<div class ="col-lg-4 col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading border-light"></div>
		<div class="panel-body">
			<div class="center">

				
				<?php 
					/*if(isset($userId)){
						$itemId = $userId;
						$type = Project::COLLECTION;
					}
					$this->renderPartial('../pod/flexSlider', array("userId" => $itemId,
																	  "type" => $type,
																	  "containerSlider" => "sliderPhotoPod")); */?>	
					
				
			</div>
		</div>
	</div>
</div>

<div class="col-lg-4 col-md-12">
	<?php $this->renderPartial('dashboard/description',array( "project" => $project)); ?>
</div>
<div class ="col-lg-4 col-md-12">
	 <?php $this->renderPartial('dashboard/contributors',array( "contributors" => $contributors)); ?>
</div>
<div class ="col-lg-4 col-md-12">
	 <?php $this->renderPartial('dashboard/projectChart',array( "properties" => $properties)); ?>
</div>
</div>
<script type="text/javascript">
	var contextMap = {};
	contextMap["project"] = <?php echo json_encode($project)?>;
	contextMap["people"] = <?php echo json_encode($people) ?>;
	contextMap["organizations"] = <?php echo json_encode($organizations) ?>;
	
</script>