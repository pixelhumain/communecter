<?php 
//if( isset($_GET["isNotSV"])) 
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class="col-md-8 col-sm-12">
		<?php $this->renderPartial('dashboard/description',array(
								"event" => $event,
								"organizer" =>$organizer,
								"itemId" => (string)$event["_id"],
								"eventTypes" => $eventTypes,
								"type" => PHType::TYPE_EVENTS,
								"countries" => $countries,
								"imagesD" => $images ));
								?>
		

	</div>
	<div class="col-md-4 col-sm-12">
		<?php $this->renderPartial('dashboard/attendees', array(  "event"=> $event,
																	
																	"attending" => $attending,
	
																	"isDetailView" => 1																));
					?>
	</div>
</div>
<script type="text/javascript">
	
	jQuery(document).ready(function() {
		
	});
</script>
