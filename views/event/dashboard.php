<div class="row">
<div class ="col-lg-4 col-md-12">
	<?php $this->renderPartial('../pod/sliderPhoto', array("itemId" => (string)$event["_id"], "type" => PHType::TYPE_EVENTS)) ?>
</div>

<div class="col-lg-4 col-md-12">
	<?php $this->renderPartial('dashboard/description',array( 
							"event" => $event, 
							"organizer" =>$organizer, 
							"itemId" => (string)$event["_id"], 
							"eventTypes" => $eventTypes,
							"type" => PHType::TYPE_EVENTS,
							"countries" => $countries)); ?>
</div>
<div class ="col-lg-4 col-md-12">
	 <?php $this->renderPartial('dashboard/attendees',array( "event" => $event, "attending" => $attending)); ?>
</div>

</div>
<script type="text/javascript">
	contextMap= <?php echo json_encode($event)?>;
	idToSend = contextMap["_id"]["$id"];
	var images = <?php echo json_encode($images) ?>;
	var contentKeyBase = "<?php echo $contentKeyBase ?>";
	jQuery(document).ready(function() {
		bindBtnFollow();
	})


	var bindBtnFollow = function(){
		$(".disconnectBtn").off().on("click",function () {
	        
	        $(this).empty();
	        $(this).html('<i class=" disconnectBtnIcon fa fa-spinner fa-spin"></i>');
	        var btnClick = $(this);
	        var idToDisconnect = $(this).data("id");
	        var typeToDisconnect = $(this).data("type");
	        var ownerLink = $(this).data("ownerlink");
	        var urlToSend = baseUrl+"/"+moduleId+"/person/disconnect/id/"+idToDisconnect+"/type/"+typeToDisconnect+"/ownerLink/"+ownerLink;
	        if("undefined" != typeof $(this).data("targetlink")){
	        	var targetLink = $(this).data("targetlink");
	        	urlToSend += "/targetLink/"+targetLink;
	        }

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
				        	$("#"+typeToDisconnect+idToDisconnect).remove();
				        	$("#linkBtns").empty();
		        			$("#linkBtns").html("<a href='javascript:;' class='connectBtn tooltips ' id='addAttendingRelation' data-placement='top' data-ownerlink='"+ownerLink+"' data-original-title='I attendee to this event' ><i class=' connectBtnIcon fa fa-link '></i>ATTENDING</a></li>");
		        			bindBtnFollow();
				        } else {
				           toastr.info("something went wrong!! please try again.");
				          $(".disconnectBtn").removeClass("fa-spinner fa-spin").addClass("fa-link");
				        }
				    });

			});
			
		});

		$(".connectBtn").off().on("click",function () {
			$(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinner fa-spin");
			var idConnect = "<?php echo (string)$event['_id'] ?>";
			var ownerLink = $(this).data("ownerlink");
	        var urlToSend = baseUrl+"/"+moduleId+"/person/connect/id/"+idConnect+"/type/<?php echo Event::COLLECTION ?>/ownerLink/"+ownerLink;
	        if("undefined" != typeof $(this).data("targetlink")){
	        	var targetLink = $(this).data("targetlink");
	        	urlToSend += "/targetLink/"+targetLink;
	        }

			$.ajax({
		        type: "POST",
		        url: urlToSend,
		        dataType : "json"
		    })
		    .done(function (data)
		    {
		        if ( data && data.result ) {               
		        	toastr.info("REALTION APPLIED SUCCESFULLY!! ");
		        	$(".connectBtn").fadeOut();
		        	$("#linkBtns").empty();
		        	$("#linkBtns").html("<a href='javascript:;' class='disconnectBtn text-red tooltips' data-name='"+contextMap["name"]+" 'data-id='"+contextMap["_id"]["$id"]+"' data-type='<?php echo Event::COLLECTION ?>' data-ownerlink='"+ownerLink+"' data-placement='top' data-original-title='I no more attending' ><i class='disconnectBtnIcon fa fa-unlink'></i>NO ATTENDING</a>")
		        	bindBtnFollow();
		        } else {
		           toastr.info("something went wrong!! please try again.");
		           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
		        }
		    });       
		});
	}
</script>