<?php
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-md-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8 no-padding">
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
			</div>


			<div class="col-md-4 no-padding pull-right">
				<div class="col-md-12 col-xs-12">
					<?php  //print_r($attending); 
						$this->renderPartial('../pod/usersList', array(  "project"=> $project,
															"users" => $contributors,
															"userCategory" => Yii::t("common","COMMUNITY"), 
															"followers" => $followers,																													"contentType" => Project::COLLECTION,
															"admin" => $admin	));
					?>
					<?php 
						if(!empty($properties) || $admin==true){
							$this->renderPartial('pod/projectChart',array("itemId" => (string)$project["_id"], "itemName" => $project["name"], "properties" => $properties, "admin" =>$admin,"isDetailView" => 1)); 
						}
					?>
				</div>
				<?php if((@$project["links"]["needs"] && !empty($project["links"]["needs"])) || $admin==true){ ?> 
				<div class="col-md-12 col-xs-12 needsPod">	
					<?php $this->renderPartial('../pod/needsList',array( 	
						"needs" => $needs, 
						"parentId" => (String) $project["_id"],
						"parentType" => Project::COLLECTION,
						"isAdmin" => $admin,
						"parentName" => $project["name"]
					  )); ?>
				</div>
				<?php } 
					if((@$project["links"]["events"] && !empty($project["links"]["events"])) || $admin==true){ ?>
				<div class="col-md-12 col-xs-12">
					<?php $this->renderPartial('../pod/eventsList',array( "events" => $events, 
																	"contextId" => (String) $project["_id"],
																	"contextType" => Project::CONTROLLER,
																	"authorised" => $admin
																  )); ?>
				</div>
				<?php } ?>
			</div>

			<div class="col-md-8 col-sm-12 no-padding timesheetphp pull-left"></div>
		</div>	
	</div>
</div>
<?php 
	//var_dump($project);
	$contextMap = array_merge($events, $contributors);
	$contextMap["thisProject"] = array($project);
?>
<script type="text/javascript">
var contextMap = <?php echo json_encode($contextMap)?>;
jQuery(document).ready(function() {
	//bindBtnFollow();
	$(".moduleLabel").html("<i class='fa fa-lightbulb-o'></i> <?php echo addslashes($project["name"]) ?> ");
	//getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>",null,"html");
	<?php if((@$project["tasks"] && !empty($project["tasks"])) || $admin==true){ ?>
	getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
	<?php } ?>
	<?php //if((@$project["links"]["needs"] && !empty($project["links"]["needs"])) || $admin==true){ ?>
	//getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>/isDetailView/1",null,"html");
	<?php //} ?>
	Sig.restartMap();
	Sig.showMapElements(Sig.map, contextMap);		
});


/*function bindBtnFollow(){

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
				        	toastr.success("<?php echo Yii::t("common", "Link divorced succesfully") ?>!!");
				        	removeFloopEntity(idToDisconnect, "projects");
								loadByHash(location.hash);
				        	
				        } else {
					        console.log(data);
				           toastr.error("<?php echo Yii::t("common", "Something went wrong!")." ".Yii::t("common","Please try again")?>.");
				          $(".disconnectBtn").removeClass("fa-spinner fa-spin").addClass("fa-link");
				        }
				    });

			});
			
		});

		$(".connectBtn").off().on("click",function () {
			$(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinner fa-spin");
			var idConnect = "<?php echo (string)$project['_id'] ?>";
			var ownerLink = $(this).data("ownerlink");
				newContributor = new Object;
				newContributor.id = idConnect;
				newContributor.type = "citoyens";
				newContributor.contribId = "<?php echo Yii::app() -> session["userId"]; ?>";
				newContributor.email = "<?php echo Yii::app() -> session["userEmail"]; ?>";
				console.log(newContributor);
				//newContibutor.name = $(".form-contributor .contributor-name").val();
				//newContibutor.email = $('.form-contributor .contributor-email').val();
				//newContibutor.organizationType=$('.form-contributor #organizationType').val();
				//newContibutor.contributorIsAdmin = $("#newContributors #contributorIsAdmin").val();
			//var data =
			var urlToSend = "/project/savecontributor";
	        //var urlToSend = baseUrl+"/"+moduleId+"/person/follows/id/"+idConnect+"/type/<?php echo Project::COLLECTION ?>/ownerLink/"+ownerLink;
	        //if("undefined" != typeof $(this).data("targetlink")){
	        	//var targetLink = $(this).data("targetlink");
	        	//urlToSend += "/targetLink/"+targetLink;
	        //}
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/"+urlToSend,
		        dataType : "json",
		        data : newContributor,
		    })
		    .done(function (data)
		    {
		        if ( data && data.result ) {               
		        	toastr.success("<?php echo Yii::t("common", "Relation applied successfully") ?> !!");
		        	
		        		addFloopEntity(idConnect, "projects", contextMap["thisProject"][0]);
						loadByHash(location.hash);
		        	
		        } else {
		           toastr.error("<?php echo Yii::t("common", "Something went wrong!")." ".Yii::t("common","Please try again")?>.");
		           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
		        }
		    });       
		});
	}*/
</script>