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
																  "isDetailView" => 1	));
					?>
	</div>
</div>
<script type="text/javascript">
	<?php $attending[] = $event; ?>
	var contextMap = <?php echo json_encode($attending)?>;
	
	jQuery(document).ready(function() {
		bindBtnFollow();
		$(".moduleLabel").html("<i class='fa fa-calendar'></i> EVENT : <?php echo $event["name"] ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
		
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
				        	toastr.info("LINK DIVORCED SUCCESFULLY!!");
				        	if( isNotSV )
								loadByHash(location.hash);
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
		        	if( isNotSV )
						loadByHash(location.hash);
		        } else {
		           toastr.info("something went wrong!! please try again.");
		           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
		        }
		    });
		});
	}
</script>
