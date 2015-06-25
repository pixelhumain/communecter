<div class="row">
	<div class="col-lg-4 col-md-12">
		<?php 
			$this->renderPartial('dashboard/description',array( "project" => $project, "tags" => $tags, "countries" => $countries)); ?>
	</div>
	<div class ="col-lg-4 col-md-12">			
		<?php 
			 $this->renderPartial('../pod/sliderPhoto', array("itemId" => (string)$project["_id"], "type" => PHType::TYPE_PROJECTS));
		?>
	</div>	
	<div class ="col-lg-4 col-md-12">
		 <?php $this->renderPartial('dashboard/contributors',array( "contributors" => $contributors, "organizationTypes" => $organizationTypes, "project" => $project)); ?>
	</div>
	<div class ="col-lg-4 col-md-12">
		 <?php $this->renderPartial('dashboard/projectChart',array("itemId" => (string)$project["_id"], "properties" => $properties)); ?>
	</div>
	<div class ="col-lg-12 col-md-12">
		 <?php $this->renderPartial('dashboard/timesheet',array("itemId" => (string)$project["_id"])); ?>
	</div>

</div>
<script type="text/javascript">
	var contextMap = {};
	contextMap["project"] = <?php echo json_encode($project)?>;
	contextMap["people"] = <?php echo json_encode($people) ?>;
	contextMap["organizations"] = <?php echo json_encode($organizations) ?>;
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
		        			$("#linkBtns").html("<a href='javascript:;' class='connectBtn tooltips ' id='addAttendingRelation' data-placement='top' data-ownerlink='"+ownerLink+"' data-original-title='I contribute to this event' ><i class=' connectBtnIcon fa fa-link '></i>CONTRIBUTE</a></li>");
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
			var idConnect = "<?php echo (string)$project['_id'] ?>";
			var ownerLink = $(this).data("ownerlink");
	        var urlToSend = baseUrl+"/"+moduleId+"/person/connect/id/"+idConnect+"/type/<?php echo Project::COLLECTION ?>/ownerLink/"+ownerLink;
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
		        	$("#linkBtns").html("<a href='javascript:;' class='disconnectBtn text-red tooltips' data-name='"+contextMap["project"]["name"]+" 'data-id='"+contextMap["project"]["_id"]["$id"]+"' data-type='<?php echo Project::COLLECTION ?>' data-ownerlink='"+ownerLink+"' data-placement='top' data-original-title='I no more contributing' ><i class='disconnectBtnIcon fa fa-unlink'></i>UNCONTRIBUTE</a>")
		        	bindBtnFollow();
		        } else {
		           toastr.info("something went wrong!! please try again.");
		           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
		        }
		    });       
		});
	}

</script>