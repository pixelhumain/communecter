<?php 
$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/css/bootstrap-editable.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '//assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '//assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/css/datepicker.css');

//X-editable...
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/x-editable/js/bootstrap-editable.js' , CClientScript::POS_END, array(), 2);

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , CClientScript::POS_END, array(), 2);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , CClientScript::POS_END, array(), 2);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/wysihtml5/wysihtml5.js' , CClientScript::POS_END, array(), 2);

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END, array(), 2);
?>
<div class="panel panel-white">
  <div class="panel-heading border-light">
    <h4 class="panel-title">List of Jobs Posting </h4>
    <div class="panel-tools">
		<a href="#new-job" class="new-job btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Create a job Offer"><i class="fa fa-plus"></i> Add Job Offer</a>
      <div class="dropdown">
        <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
          <i class="fa fa-cog"></i>
        </a>
        <ul class="dropdown-menu dropdown-light pull-right" role="menu">
          <li>
            <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
          </li>
          <li>
            <a class="panel-refresh" href="#">
              <i class="fa fa-refresh"></i> <span>Refresh</span>
            </a>
          </li>
          <li>
            <a class="panel-config" href="#panel-config" data-toggle="modal">
              <i class="fa fa-wrench"></i> <span>Configurations</span>
            </a>
          </li>
          <li>
            <a class="panel-expand" href="#">
              <i class="fa fa-expand"></i> <span>Fullscreen</span>
            </a>
          </li>
        </ul>
      </div>
      <a class="btn btn-xs btn-link panel-close" href="#">
        <i class="fa fa-times"></i>
      </a>
    </div>
  </div>
  <div class="panel-body no-padding">
    <div class="tabbable no-margin no-padding partition-dark">
	    <div class="tab-content">
			<div id="#panel_public" class="tab-pane fade in active">
				<div class="row">
					<table class="table table-striped table-bordered table-hover" id="jobList">
						<thead>
							<tr>
								<th>Title</th>
								<th class="hidden-xs">Employment Type</th>
								<th class="hidden-xs">Organization Hiring</th>
								<th></th>
							</tr>
						</thead>
						<tbody class="jobList">
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
				</div>
			</div>
		</div>
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
    $(".jobList").prepend(jobLine);
    bindJobEvents();
}

</script>