<div class="row">
	<?php $this->renderPartial('/sig/generic/mapLibs'); ?>

	<div class="col-md-8 col-sm-12">
		<?php $this->renderPartial('dashboard/description',array(
								"event" => $event,
								"organizer" =>$organizer,
								"itemId" => (string)$event["_id"],
								"eventTypes" => $eventTypes,
								"type" => PHType::TYPE_EVENTS,
								"countries" => $countries)); ?>
		<div class="col-md-12 newsPod">
			<div class="panel panel-white pulsate">
				<div class="panel-heading border-light ">
					<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading News Section</h4>
					<div class="space5"></div>
				</div>
			</div>
		</div>

	</div>
	<div class ="col-md-4 col-sm-12">
		 <div class="col-sm-12">
		 	<?php $this->renderPartial('dashboard/attendees',array( "event" => $event, "attending" => $attending)); ?>
		 </div>
		 <div class="col-sm-12">
			<?php $this->renderPartial('../pod/sliderPhoto', array("itemId" => (string)$event["_id"], "type" => PHType::TYPE_EVENTS)) ?>
		</div>
	</div>
	
</div>
<script type="text/javascript">
	contextMap= <?php echo json_encode($event)?>;
	contextMap["event"] = contextMap;
	idToSend = contextMap["_id"]["$id"];
	var images = <?php echo json_encode($images) ?>;
	var contentKeyBase = "<?php echo $contentKeyBase ?>";
	jQuery(document).ready(function() {
		bindBtnFollow();

		getAjax(".newsPod", baseUrl+"/"+moduleId+"/news/latest/type/<?php echo Event::COLLECTION ?>/id/<?php echo $_GET["id"];?>/count/5", function(){}, "html");
	})


	var bindBtnFollow = function(){
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
				        	$("#attendee"+attendeeId).remove();
				        	$("#linkBtns").empty();
		        			$("#linkBtns").html("<a href='javascript:;' class='attendeeMeBtn tooltips ' id='addAttendingRelation' data-placement='top' data-attendee-id='<?php echo Yii::app()->session["userId"];?>' data-original-title='I attendee to this event' ><i class='connectBtnIcon fa fa-link '></i>ATTENDING</a></li>");
		        			bindBtnFollow();
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
	        var urlToSend = baseUrl+"/"+moduleId+"/event/saveattendees/eventId/"+idEvent+"/attendeeId/"+idAttendee;
			$.ajax({
		        type: "POST",
		        url: urlToSend,
		        dataType : "json"
		    })
		    .done(function (data)
		    {
		        if ( data && data.result ) {
		        	toastr.info(data.msg);
		        	$(".attendeeMeBtn").fadeOut();
		        	$("#linkBtns").empty();
		        	$("#linkBtns").html("<a href='javascript:;' class='disconnectBtn text-red tooltips' data-name='"+contextMap["name"]+" 'data-id='"+contextMap["_id"]["$id"]+"' data-type='<?php echo Event::COLLECTION ?>' data-attendee-id='"+idAttendee+"' data-placement='top' data-original-title='I no more attending' ><i class='disconnectBtnIcon fa fa-unlink'></i>NO ATTENDING</a>")
		        	bindBtnFollow();
		        	addAttendeeToTabe(idAttendee,data.attendee);
		        } else {
		           toastr.info("something went wrong!! please try again.");
		           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
		        }
		    });
		});
	}
	var addAttendeeToTabe = function(id,attendee){
		trHtml='<tr id="attendee'+id+'">'+
					'<td class="center">';
					if (attendee.length > 0 && typeof(attendee.imagePath) != "undefined")
						trHtml += '<img width="50" height="50"  alt="image" class="img-circle" src="'+attendee.imagePath+'">';
					else 
						trHtml += '<i class="fa fa-smile-o fa-2x"></i>';
					trHtml += '</td>'+
					'<td>'+
						'<span class="text-large">'+attendee.name+'</span><a href="'+baseUrl+'/'+moduleId+'/person/dashboard/id/'+id+'" class="btn"><i class="fa fa-chevron-circle-right"></i></a>'+
					'</td>'+
				'</tr>';
		$("#attendeeTable").append(trHtml);
	}
</script>
