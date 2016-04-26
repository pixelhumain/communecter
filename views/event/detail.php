<?php 
		//Menu::event($event);
		$this->renderPartial('../default/panels/toolbar'); 
?>

<?php
$admin = false;
	if(isset(Yii::app()->session["userId"]) && isset($event["_id"]))
		$admin = Authorisation::canEditItem(Yii::app()->session["userId"], Event::COLLECTION, (string)$event["_id"]);
?>
<div class="row">
	<div class="col-md-8 col-sm-12">
		<?php $this->renderPartial('dashboard/description',array(
								"event" => $event,
								"organizer" =>$organizer,
								"itemId" => (string)$event["_id"],
								"eventTypes" => $eventTypes,
								"type" => Event::COLLECTION,
								"countries" => $countries,
								"imagesD" => $images ));
								?>
		

	</div>
	<div class="col-md-4 col-sm-12">
		<?php  //print_r($attending); 
			$this->renderPartial('../pod/usersList', array(  "event"=> $event,
															"users" => $attending,
															"userCategory" => Yii::t("event","ATTENDEES",null,Yii::app()->controller->module->id), 
															"contentType" => Event::COLLECTION,
															"admin" => $admin));
					?>
	</div>
</div>
<script type="text/javascript">
	<?php $attending[] = $event; ?>
	<?php $attending[] = $organizer; ?>
	
	var contextMap = <?php echo json_encode($attending)?>;
	var thisEvent = <?php echo json_encode($event)?>;
	
	jQuery(document).ready(function() {
		$(".moduleLabel").html("<i class='fa fa-circle text-orange'></i> <i class='fa fa-calendar'></i> <?php echo addslashes($event["name"]) ?> ");
		console.dir(contextMap);
		
		Sig.restartMap();
		Sig.showMapElements(Sig.map, contextMap);
	});
</script>
