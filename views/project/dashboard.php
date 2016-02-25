<div class="row">
	<div class="col-md-12 no-padding">
	<div class="col-lg-4 col-md-12">
		<?php 
			$this->renderPartial('pod/description',array( "project" => $project, "tags" => $tags, "countries" => $countries,"isAdmin"=> $admin)); ?>
	</div>
	<div class ="col-lg-4 col-md-12">			
		<?php 
			 $this->renderPartial('../pod/sliderPhoto', array("itemId" => (string)$project["_id"], "type" => PHType::TYPE_PROJECTS, "isAdmin"=> $admin));
		?>
	</div>	
	<div class ="col-lg-4 col-md-12">
		 <?php $this->renderPartial('pod/contributors',array( "contributors" => $contributors, "organizationTypes" => $organizationTypes, "project" => $project, "admin" => $admin)); ?>
	</div>
	
	</div>
	<?php if (!empty($tasks) OR $admin==true){ ?>
	<div class ="col-lg-8 col-md-8 timesheetphp">
	</div>
	
	<?php } 
	 if (!empty($properties) OR $admin==true){ ?>
	<div class ="col-lg-4 col-md-12">
		 <?php $this->renderPartial('pod/projectChart',array("itemId" => (string)$project["_id"], "properties" => $properties, "admin" =>$admin)); ?>
	</div>
	<?php } ?>
	<div class="col-sm-6 col-xs-12 roomsPod">
		<div class="panel panel-white pulsate">
			<div class="panel-heading border-light ">
				<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Rooms Section</h4>
				<div class="space5"></div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 col-xs-12 needsPod">
		<!--<div class="panel panel-white pulsate">
			<div class="panel-heading border-light ">
				<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Something Section</h4>
				<div class="space5"></div>
			</div>
		</div>-->
	</div>
	<div class="col-sm-6 col-xs-12">
		<?php $this->renderPartial('../pod/eventsList',array( "events" => $events, 
																"contextId" => (String) $project["_id"],
																"contextType" => Project::CONTROLLER,
																"authorised" => $admin
															  )); ?>
	</div>
</div>
<?php $this->renderPartial('/sig/generic/mapLibs'); ?>
<script type="text/javascript">
	var contextMap = {};
	contextMap["project"] = <?php echo json_encode($project)?>;
	//contextMap["events"] = <?php //echo json_encode($events) ?>;
	var idToSend = contextMap["project"]["_id"]["$id"]
	contextMap["people"] = <?php echo json_encode($people) ?>;
	contextMap["organizations"] = <?php echo json_encode($organizations) ?>;
	var images = <?php echo json_encode($images) ?>;
	var contentKeyBase = "<?php echo $contentKeyBase ?>";
	jQuery(document).ready(function() {
		bindBtnFollow();
		getAjax(".roomsPod",baseUrl+"/"+moduleId+"/rooms/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $_GET["id"]?>",null,"html");
		getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $_GET["id"]?>/isAdmin/<?php echo $admin?>",null,"html");
		getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $_GET["id"]?>/isAdmin/<?php echo $admin?>",null,"html");
	})
	function bindBtnFollow(){

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
	        var urlToSend = baseUrl+"/"+moduleId+"/person/follows/id/"+idConnect+"/type/<?php echo Project::COLLECTION ?>/ownerLink/"+ownerLink;
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