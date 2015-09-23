<div class="row">
	<div class="col-sm-12">
		<?php $this->renderPartial('dashboard/description',array(
								"event" => $event,
								"organizer" =>$organizer,
								"itemId" => (string)$event["_id"],
								"eventTypes" => $eventTypes,
								"type" => PHType::TYPE_EVENTS,
								"countries" => $countries)); ?>
		

	</div>
	
	
</div>
<script type="text/javascript">
	
	jQuery(document).ready(function() {
		
	});
</script>
