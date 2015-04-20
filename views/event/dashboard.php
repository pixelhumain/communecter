<div class="row">
<div class ="col-lg-4 col-md-12">
	<?php $this->renderPartial('../pod/sliderPhoto', array("itemId" => (string)$event["_id"], "type" => PHType::TYPE_EVENTS)) ?>
</div>

<div class="col-lg-4 col-md-12">
	<?php $this->renderPartial('dashboard/description',array( "event" => $event)); ?>
</div>
<div class ="col-lg-4 col-md-12">
	 <?php $this->renderPartial('dashboard/attendees',array( "attending" => $attending)); ?>
</div>

</div>
<script type="text/javascript">
	var contextMap = {};
	contextMap["event"] = <?php echo json_encode($event)?>;
	contextMap["people"] = <?php echo json_encode($people) ?>;
	contextMap["organizations"] = <?php echo json_encode($organizations) ?>;
</script>