<?php 
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/communecter.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
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
															"admin" => $admin,
															"isNotSV" => 1	));
					?>
	</div>
</div>
<script type="text/javascript">
	<?php $attending[] = $event; ?>
	var contextMap = <?php echo json_encode($attending)?>;
	var thisEvent = <?php echo json_encode($event)?>;
	
	jQuery(document).ready(function() {
		bindBtnFollow();
		$(".moduleLabel").html("<i class='fa fa-calendar'></i> EVENT : <?php echo $event["name"] ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
		console.dir(contextMap);
		
		Sig.restartMap();
		Sig.showMapElements(Sig.map, contextMap);
	});

	function bindBtnFollow(){
		$(".disconnectBtn").off().on("click",function () {

	        $(this).empty();
	        $(this).html('<i class=" disconnectBtnIcon fa fa-spinner fa-spin"></i>');
	        var btnClick = $(this);
	        var idToDisconnect = $(this).data("id");
	        var typeToDisconnect = $(this).data("type");
	        var attendeeId = $(this).data("attendee-id");
	        var urlToSend = baseUrl+"/"+moduleId+"/event/removeattendee/id/"+idToDisconnect+"/type/"+typeToDisconnect+"/attendeeId/"+attendeeId;
	        
	        bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> connection ?",
	        	function(result) {
					if (!result) {
						btnClick.empty();
				        btnClick.html('<i class=" disconnectBtnIcon fa fa-unlink"></i>');
						return;
					}
					$.ajax({
				        type: "POST",
				        url: urlToSend,
				        dataType : "json"
				    })
				    .done(function (data)
				    {
				        if ( data && data.result ) {
				        	toastr.info("Vous ne participez plus à cet événement");
				        	if( isNotSV ){
								removeFloopEntity(idToDisconnect, "events");
								loadByHash(location.hash);
				        	}
				        } else {
				           toastr.info("something went wrong!! please try again.");
				          $(".disconnectBtn").removeClass("fa-spinner fa-spin").addClass("fa-link");
				        }
				    });

			});

		});

		$(".attendeeMeBtn").off().on("click",function () {
			$(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinner fa-spin");
			var idEvent = "<?php echo (string)$event['_id'] ?>";
			var idAttendee = $(this).data("attendee-id");
	        var urlToSend = baseUrl+"/"+moduleId+"/event/saveattendees/idEvent/"+idEvent+"/attendeeId/"+idAttendee;
			$.ajax({
		        type: "POST",
		        url: urlToSend,
		        dataType : "json"
		    })
		    .done(function (data)
		    {
		        if ( data && data.result ) {
		        	toastr.info(data.msg);
		        	if( isNotSV ){
		        		addFloopEntity(idEvent, "events", thisEvent);
						loadByHash(location.hash);
		        	}
		        } else {
		           toastr.info("something went wrong!! please try again.");
		           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
		        }
		    });
		});
	}
</script>
