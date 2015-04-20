<?php
	// echo CHtml::scriptFile(Yii::app()->theme->baseUrl."/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js");
?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title">List of Jobs Posting </h4>
	</div>
	<div class="panel-tools">
		<a href="#new-job" class="new-job btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Create a job Offer"><i class="fa fa-plus"></i></a>
		<div class="dropdown">
			<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
				<i class="fa fa-cog"></i>
			</a>
			<ul class="dropdown-menu dropdown-light pull-right" role="menu">
				<li>
					<a class="panel-refresh" href="#">
						<i class="fa fa-refresh"></i> <span>Refresh</span>
					</a>
				</li>
				<li>
					<a class="panel-expand" href="#">
						<i class="fa fa-expand"></i> <span>Fullscreen</span>
					</a>
				</li>
			</ul>
		</div>
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
						<td><?php if(isset($jobValue["title"])) echo $jobValue["title"]?></td>
						<td><?php if(isset($jobValue["employmentType"])) echo $jobValue["employmentType"] ?></td>
						<td><?php if(isset($jobValue["hiringOrganization"]) && isset($jobValue["hiringOrganization"]["name"])) echo $jobValue["hiringOrganization"]["name"] ?></td>
						<td class="center">
						<div class="visible-md visible-lg hidden-sm hidden-xs">
							<a href="#" data-id="<?php echo $jobId;?>" class="btn btn-light-blue tooltips viewButton" data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a>
							<a href="#" data-id="<?php echo $jobId;?>" class="btn btn-light-blue tooltips editButton" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a>
							<a href="#" class="btn btn-red tooltips delBtn" data-id="<?php echo $jobId;?>" data-name="<?php echo (string)$jobValue["title"];?>" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>
						</div>
						</td>
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

	$(".viewButton").off().on("click", function() {
		console.log($(this).data('id'));
		openJobSV("view", $(this).data('id'));
	});

	$(".editButton").off().on("click", function() {
		console.log($(this).data('id'));
		openJobSV("update", $(this).data('id'));
	});

	$(".delButton").off().on("click", function() {
		console.log($(this).data('id'));
		openJobSV("update", $(this).data('id'));
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
			$.hideSubview();
		},
	});
}

function updateJob(njob, jobId) {
    console.log("updateJob func");
    var jobLine  = '<tr id="job'+jobId+'">'+
                '<td>'+njob.title+'</td>'+
                '<td>'+njob.employmentType+'</td>'+
                '<td>'+njob.hiringOrganization.name+'</td>'+
                '<td class="center">'+
                '<div class="visible-md visible-lg hidden-sm hidden-xs">'+
                    '<a href="#" data-id="'+jobId+'" class="btn btn-light-blue tooltips viewButton" data-placement="top" data-original-title="View"><i class="fa fa-search"></i></a> '+
                    '<a href="#" data-id="'+jobId+'" class="btn btn-light-blue tooltips editButton" data-placement="top" data-original-title="Edit"><i class="fa fa-pencil-square-o"></i></a> '+
                    '<a href="#" class="btn btn-red tooltips delButton" data-id="'+jobId+'" data-name="'+njob.title+'" data-placement="top" data-original-title="Remove"><i class="fa fa-times fa fa-white"></i></a>'+
                '</div>'+
                "</td>"+
            "</tr>";
    $("#jobList").prepend(jobLine);
    bindJobEvents();
}

function initTableStyle() {
	console.log("toto");
	// function to enable panel scroll with perfectScrollbar (because of ajax loading mode)
	if($(".panel-scroll").length && $body.hasClass("isMobile") == false) {
		$('.panel-scroll').perfectScrollbar({
			wheelSpeed: 50,
			minScrollbarLength: 20,
			suppressScrollX: true
		});
	}
	/*tableJob = $('#jobList').dataTable({
		"aoColumnDefs" : [{
			"aTargets" : [0]
		}],
		// set the initial value
		"iDisplayLength" : 10,
		"scrollY":        "230px",
		"scrollCollapse": true,
	    "paging":         false
	});*/
}

</script>