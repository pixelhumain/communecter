<div class="row">
<div class ="col-lg-4 col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading border-light"></div>
		<div class="panel-body">
			<div class="center">

				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new thumbnail">
						<img src="<?php if ($project && isset($project["imagePath"])) echo $project["imagePath"]; ?>" alt="">	
					</div>
					<div class="fileupload-preview fileupload-exists thumbnail"></div>
				</div>
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

</div>
<script type="text/javascript">
	var contextMap = {};
	contextMap["project"] = <?php echo json_encode($project)?>;
	contextMap["people"] = <?php echo json_encode($people) ?>;
	contextMap["organizations"] = <?php echo json_encode($organizations) ?>;
</script>