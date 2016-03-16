<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title">List of Jobs Posting </h4>
	</div>
	<div class="panel-tools">
		<?php if(isset($id) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $id)){ ?>
			<a href="#new-job" class="new-job btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Create a job Offer"><i class="fa fa-plus"></i></a>
		<?php }; ?>
	</div>
	<div class="panel-body no-padding">
		<div class="panel-scroll height-230 ps-container">
			<table class="table table-striped table-hover" id="jobList">
				<tbody>
					<?php
					if(isset($jobList)) {
					foreach ($jobList as $jobValue) {
						if ( isset($jobValue["_id"]) ) {
							$jobId = $jobValue["_id"];
					?>
					<tr id="job<?php echo $jobId;?>">
						<td class="center">
							<a href="#" class="viewJobButton" data-id="<?php echo $jobId;?>" data-original-title="View">
								<?php if ($jobValue && isset($jobValue["imagePath"])){ ?>
									<img width="50" height="50" alt="image" class="img-circle" src="<?php echo $jobValue["imagePath"]; ?>">
								<?php } else { ?>
									<i class="fa fa-briefcase fa-2x"></i>
								<?php } ?>
							</a>
						</td>
						<td><a href="#" class="viewJobButton" data-id="<?php echo $jobId;?>" data-original-title="View"><?php if(isset($jobValue["title"])) echo $jobValue["title"]?></a></td>
						<td><?php if(isset($jobValue["employmentType"])) echo $jobValue["employmentType"] ?></td>
						<td><?php if(isset($jobValue["hiringOrganization"]) && isset($jobValue["hiringOrganization"]["name"])) echo $jobValue["hiringOrganization"]["name"] ?></td>
						<?php if (Authorisation::isJobAdmin($jobId, Yii::app()->session["userId"])) {?>
						<td class="center">
							<div class="visible-md visible-lg hidden-sm hidden-xs">
								<a href="#" class="btn btn-red tooltips delJobButton" data-id="<?php echo $jobId;?>" data-name="<?php echo isset($jobValue["title"]) ? $jobValue["title"] : "";?>" data-placement="left" data-original-title="Remove"><i class="fa fa-times"></i></a>
							</div>
						</td>
						<?php }?>
					</tr>
					<?php
							}
						}
					}
					?>
				</tbody>
			</table>
			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;">
			<div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div>
			<div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;">
			<div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
		</div>
	</div>
</div>

<script type="text/javascript">

jQuery(document).ready(function() {
	
	<?php $contextMap = array("jobList"=>$jobList); ?>
	bindJobEvents();
 	var contextMap = <?php echo json_encode($contextMap)?>;
 	console.log(contextMap);
 	debugMap.push(contextMap);
 	initTableStyle();
});

function bindJobEvents() {
	$(".new-job").off().on("click", function() {
		openJobSV("insert", "newJobId");
	});

	$(".viewJobButton").off().on("click", function() {
		console.log($(this).data('id'));
		openJobSV("view", $(this).data('id'));
	});

	$(".delJobButton").off().on("click", function() {
		console.log("Delete the jobId : "+$(this).data('id'));
		var id = $(this).data('id');
		bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> Job Offer ?", 
			function(result) {
				if (result) {
					$.ajax({
				            type: "POST",
				            url: baseUrl+"/"+moduleId+"/job/delete/id/"+id,
				            dataType: "json"
				        })
				    	.done(function (data) {
				            if (data && data.result) {               
				                toastr.success("The job offer has been removed successfully!!");
								console.log("Remove the line "+"#job"+id);
								$("#job"+id).remove();
				            } else {
				              toastr.error((data.msg) ? data.msg : "bug happened");
				            }
				        });
				}
			}
		)
	});
}

function openJobSV(mode, id) {
	console.log("openJobSV");
	$("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2 jobContainer'>"+
		  	"</div>");
	$.subview({
		content : "#ajaxSV",
		onShow : function() 
		{
			$.ajax({
	            type: "POST",
	            url: baseUrl+"/"+moduleId+"/job/public/id/"+id,
	            data: { 
	              "mode" : mode
	            },
	             dataType: "json"
	        })
	        .done(function (data) 
	        {
	            if (data && data.result) {               
	                $(".jobContainer").html(data.content);
	                //Add any callback on success

	            } else {
	              toastr.error((data.msg) ? data.msg : "bug happened");
	              $.hideSubview();
	            }
	        });
		},
		onHide : function() {
			$("#ajaxSV").html('');
			//$.hideSubview();
		},
		onSave : function() {
			saveJob();
		}
	});
}

function updateJob(njob, jobId) {
    console.log("updateJob func");
    var jobLink = '<a href="#" class="viewJobButton" data-id="'+jobId+'" data-original-title="View">';
    var jobLine  = '<tr id="job'+jobId+'">'+
                '<td class="center">'+jobLink+'<i class="fa fa-briefcase fa-2x"></i></a></td>'+
                '<td>'+jobLink+njob.title+'</a></td>'+
                '<td>'+njob.employmentType+'</td>'+
                '<td>'+njob.hiringOrganization.name+'</td>'+
                '<td class="center">'+
                '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
                    '<a href="#" class="btn btn-red tooltips delJobButton" data-id="'+jobId+'" data-name="'+njob.title+'" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'+
                '</div>'+
                "</td>"+
            "</tr>";
    $("#jobList").prepend(jobLine);
    bindJobEvents();
}

function initTableStyle() {
	// function to enable panel scroll with perfectScrollbar (because of ajax loading mode)
	if($(".panel-scroll").length && $body.hasClass("isMobile") == false) {
		$('.panel-scroll').perfectScrollbar({
			wheelSpeed: 50,
			minScrollbarLength: 20,
			suppressScrollX: true
		});
	}
}

</script>