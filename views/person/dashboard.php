<style>

.thumbnail {
    border: 0px;
}
.user-left{
	padding-left: 20px;
	padding-bottom: 25px;
}

.panel-tools{
	filter: alpha(opacity=1);
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
	-moz-opacity: 1;
	-khtml-opacity: 1;
	opacity: 1;
}

#btnTools{
	padding-right: 20px;
	padding-top: 10px;
}
</style>

<div class="row">
	<div class="col-md-3 col-sm-6  col-xs-12">
		<?php $this->renderPartial('dashboard/organizations',array( "organizations" => $organizations, "userId" => new MongoId($person["_id"]))); ?>
	</div>
	<div class="col-md-3 col-sm-6  col-xs-12">
		<?php $this->renderPartial('dashboard/events',array( "events" => $events, "userId" => (string)$person["_id"])); ?>
	</div>
	<div class="col-md-3 col-sm-6  col-xs-12">
		<?php $this->renderPartial('dashboard/projects',array( "projects" => $projects, "userId" => (string)$person["_id"])); ?>
	</div>
	<div class="col-md-3 col-sm-6  col-xs-12">
		<?php $this->renderPartial('dashboard/people',array( "people" => $people, "userId" =>(string)$person["_id"])); ?>
	</div>
</div>

<div class="row">
	<div class ="col-lg-4 col-md-4">
		<?php $this->renderPartial('../pod/sliderPhoto', array("userId" => (string)$person["_id"])); ?>
	</div>

	<div class="col-lg-4 col-md-4">
		<?php $this->renderPartial('dashboard/about', array("person" => $person, "tags" => $tags )); ?>
	</div>

	<div class="col-lg-4 col-md-4">
	   <?php $this->renderPartial('../pod/sliderAgenda', array("events" => $events, "userId" => (string)$person["_id"])); ?>
	</div>
</div>


<script>

var contextMap = {};
contextMap['person'] = <?php echo json_encode($person) ?>;
contextMap['organizations'] = <?php echo json_encode($organizations) ?>;
contextMap['events'] = [];
contextMap['projects'] = <?php echo json_encode($projects) ?>;
var events = <?php echo json_encode($events) ?>;
$.each(events, function(k, v){
	console.log(k, v);
	contextMap['events'].push(v);
});

jQuery(document).ready(function() {
	//initDataTable();
	bindBtnFollow();
	
});

var bindBtnFollow = function(){

	$(".disconnectBtn").off().on("click",function () {
        
        $(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/disconnect/id/<?php echo (string)$person['_id'] ?>/type/<?php echo PHType::TYPE_CITOYEN ?>",
	        dataType : "json"
	    })
	    .done(function (data) 
	    {
	        if ( data && data.result ) {               
	        	toastr.info("LINK DIVORCED SUCCESFULLY!!");
	        	$(".disconnectBtn").fadeOut();
	        	$("#btnTools").empty();
	        	$("#btnTools").html('<a href="javascript:;" class="connectBtn btn btn-red tooltips pull-right btn-xs" data-placement="top" data-original-title="Connect to this person as a relation" ><i class=" connectBtnIcon fa fa-link"></i></a>')
	        	bindBtnFollow();
	        } else {
	           toastr.info("something went wrong!! please try again.");
	           $(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
	        }
	    });
	});

	$(".connectBtn").off().on("click",function () {
		$(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinner fa-spin");
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/connect/id/<?php echo (string)$person['_id'] ?>/type/<?php echo PHType::TYPE_CITOYEN ?>",
	        dataType : "json"
	    })
	    .done(function (data)
	    {
	        if ( data && data.result ) {               
	        	toastr.info("REALTION APPLIED SUCCESFULLY!! ");
	        	$(".connectBtn").fadeOut();
	        	$("#btnTools").empty();
	        	$("#btnTools").html('<a href="javascript:;" class="disconnectBtn btn btn-red tooltips pull-right btn-xs" data-placement="top" data-original-title="Remove this person as a relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>')
	        	bindBtnFollow();
	        } else {
	           toastr.info("something went wrong!! please try again.");
	           $(".connectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-link");
	        }
	    });
        
	});

}


var initDataTable = function() {
	oTableOrganization = $('#organizations').dataTable({
		"aoColumnDefs" : [{
			"aTargets" : [0]
		}],
		/*"oLanguage" : {
			"sLengthMenu" : "Show _MENU_ Rows",
			"sSearch" : "",
			"oPaginate" : {
				"sPrevious" : "",
				"sNext" : ""
			}
		},
		"aaSorting" : [[1, 'asc']],
		"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
		],*/
		// set the initial value
		"iDisplayLength" : 10,
		"scrollY":        "230px",
		"scrollCollapse": true,
        "paging":         false
	});


	oTableEvent = $('#events').dataTable({
		"aoColumnDefs" : [{
			"aTargets" : [0]
		}],
		"oLanguage" : {
			"sLengthMenu" : "Show _MENU_ Rows",
			"sSearch" : "",
			"oPaginate" : {
				"sPrevious" : "",
				"sNext" : ""
			}
		},
		"aaSorting" : [[1, 'asc']],
		"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
		],
		// set the initial value
		"iDisplayLength" : 10,
	});

	oTablePeople= $('#people').dataTable({
		"aoColumnDefs" : [{
			"aTargets" : [0]
		}],
		"oLanguage" : {
			"sLengthMenu" : "Show _MENU_ Rows",
			"sSearch" : "",
			"oPaginate" : {
				"sPrevious" : "",
				"sNext" : ""
			}
		},
		"aaSorting" : [[1, 'asc']],
		"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
		],
		// set the initial value
		"iDisplayLength" : 10,
	});

	oTableProject = $('#projects').dataTable({
		"aoColumnDefs" : [{
			"aTargets" : [0]
		}],
		"oLanguage" : {
			"sLengthMenu" : "Show _MENU_ Rows",
			"sSearch" : "",
			"oPaginate" : {
				"sPrevious" : "",
				"sNext" : ""
			}
		},
		"aaSorting" : [[1, 'asc']],
		"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
		],
		// set the initial value
		"iDisplayLength" : 10,
	});
};

 function updateEvent(newEvent){

	if(typeof updateEventPod != "undefined" && typeof updateEventPod == "function")
			updateEvent(newEvent);

 }
</script>