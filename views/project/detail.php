<?php 
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-md-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8">
				<?php 
				$this->renderPartial('pod/ficheInfo', array( "project" => $project, 
																	"tags" => $tags, 
																	"countries" => $countries,
																	"isAdmin"=> $admin,
																	"tasks" =>$tasks,
																	"imagesD" => $images
																	//"events" => $events
																	));
				?>
				<div class="timesheetphp">
				</div>
			</div>
			<div class="col-md-4 no-padding">
				<div class="col-md-12">
					<?php $this->renderPartial('pod/contributors', array( "project" => $project, 
																	
																	"admin"=> $admin,
																	
																	"contributors" => $contributors,
	
																	"isDetailView" => 1																));
					?>
					<?php $this->renderPartial('pod/projectChart',array("itemId" => (string)$project["_id"], "itemName" => $project["name"], "properties" => $properties, "admin" =>$admin,"isDetailView" => 1)); ?>
				</div>
				<div class="col-md-12 needsPod">
				</div>
				<div class="col-md-12 col-xs-12">
					<?php $this->renderPartial('../pod/eventsList',array( "events" => $events, 
																	"contextId" => (String) $project["_id"],
																	"contextType" => Project::CONTROLLER,
																	"authorised" => $admin,
																	"isNotSV" => 1
																  )); ?>
				</div>
			</div>
		</div>	
	</div>
</div>

<script type="text/javascript">
	
jQuery(document).ready(function() {
	 bindBtnFollow();
	$(".moduleLabel").html("<i class='fa fa-lightbulb-o'></i> PROJECT : <?php echo $project["name"] ?>  <a href='javascript:showMap()' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
	//getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>",null,"html");
	getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
	getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
});


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
				        	if( isNotSV )
								loadByHash(location.hash);
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
		        	toastr.info("RELATION APPLIED SUCCESFULLY!! ");
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