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
<div class ="col-lg-4 col-md-12">
	<?php $this->renderPartial('../pod/sliderPhoto', array("person" => $person, "photos"=> $photos)); ?>
</div>

<div class="col-lg-4 col-md-12">
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title"><i class="fa fa-user fa-2x text-blue"></i>  About me</h4>
		</div>
		<div class="panel-tools">
			
			<div class="dropdown">
				<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
					<i class="fa fa-cog"></i>
				</a>
				<ul role="menu" class="dropdown-menu dropdown-light pull-right">
					<li>
						<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
					</li>
					<li>
						<a href="#" class="panel-refresh">
							<i class="fa fa-refresh"></i> <span>Refresh</span>
						</a>
					</li>
					<li>
						<a data-toggle="modal" href="#panel-config" class="panel-config">
							<i class="fa fa-wrench"></i> <span>Configurations</span>
						</a>
					</li>
					<li>
						<a href="#" class="panel-expand">
							<i class="fa fa-expand"></i> <span>Fullscreen</span>
						</a>
					</li>
				</ul>
			</div>
			<a href="#" class="btn btn-xs btn-link panel-close">
				<i class="fa fa-times"></i>
			</a>
		</div>
		<div class="panel-body no-padding">
			<div id='btnTools'>
				<?php 
				//connected user isn't allready connected with page User
				if( Yii::app()->session['userId'] != (string)$person["_id"]) 
				{
					//if connected user and pageUser are allready connected
					if( Link::isConnected( Yii::app()->session['userId'] , PHType::TYPE_CITOYEN , (string)$person["_id"] , PHType::TYPE_CITOYEN ) ){  ?>
						<a href="javascript:;" class="disconnectBtn btn btn-xs btn-red  pull-right tooltips " data-placement="top" data-original-title="Remove this person as a relation" ><i class=" disconnectBtnIcon fa fa-unlink "></i></a>
					<?php } else { ?>
						<a href="javascript:;" class="connectBtn btn btn-red btn-xs pull-right tooltips " data-placement="top" data-original-title="Connect to this person as a relation" ><i class=" connectBtnIcon fa fa-link "></i></a>
					<?php }
				}else{ ?>
					<a href="#panel_edit_account" class="show-tab" id="editBtn"><i class="fa fa-pencil edit-user-info pull-right"></i></a>
				<?php } ?>
			</div>
			<div class="user-left">
				<h4><?php //echo Yii::app()->session["user"]["name"]?></h4>
				<!---->
				<table class="table table-condensed table-hover" >
					<thead>
						<tr>
							<th colspan="3">Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>DummyData</td>
							<td>
								<?php 
								if( !Admin::checkInitData( PHType::TYPE_CITOYEN, "personNetworkingAll" ) ){ ?>
									<a href="<?php echo Yii::app()->createUrl("/communecter/person/InitDataPeopleAll") ?>" class="btn btn-xs btn-red  pull-right" ><i class="fa fa-plus"></i> InitData : Dummy People</a>
								<?php } else { ?>
									<a href="<?php echo Yii::app()->createUrl("/communecter/person/clearInitDataPeopleAll") ?>" class="btn btn-xs btn-red  pull-right" ><i class="fa fa-plus"></i> Remove Dummy People</a>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td>url</td>
							<td><a href="#"><?php if(isset($person["url"]))echo $person["url"];?></a></td>
						</tr>
						<tr>
							<td>email</td>
							<td><a href=""><?php echo Yii::app()->session["userEmail"];?></a></td>
						</tr>
						<tr>
							<td>phone</td>
							<td><?php if(isset($person["phoneNumber"]))echo $person["phoneNumber"];?></td>
						</tr>
						<tr>
							<td>skype</td>
							<td><?php if(isset($person["skype"]))echo $person["skype"];?></td>
						</tr>
					</tbody>
				</table>
				<hr>
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th colspan="3">General information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Position</td>
							<td>UI Designer</td>
						</tr>
						<tr>
							<td>Position</td>
							<td>Senior Marketing Manager</td>
						</tr>
						<tr>
							<td>Supervisor</td>
							<td>
							<a href="#">
								<?php if(isset($person["supervisor"]))echo $person["supervisor"];?>
							</a></td>
						</tr>
					</tbody>
				</table>
				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th colspan="3">Additional information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Birth</td>
							<td><?php if(isset($person["birth"]))echo $person["birth"];?></td>
							
						</tr>
						<tr>
							<td>Tags</td>
							<td><?php if(isset($person["tags"]))echo implode(",", $person["tags"]);?></td>
						</tr>
						<!--<tr>
							<td>Groups</td>
							<td>New company web site development, HR Management</td>
							<td><a href="#panel_edit_account" class="show-tab"><i class="fa fa-pencil edit-user-info"></i></a></td>
						</tr>-->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="col-lg-4 col-md-12">
	<?php $this->renderPartial('dashboard/people',array( "people" => $people, "userId" => new MongoId($person["_id"]))); ?>
</div>
</div>
<div class="row">
	<div class="col-md-4">
		<?php $this->renderPartial('dashboard/organizations',array( "organizations" => $organizations, "userId" => new MongoId($person["_id"]))); ?>
	</div>
	<div class="col-md-4">
		<?php $this->renderPartial('dashboard/events',array( "events" => $events)); ?>
	</div>
	<div class="col-md-4">
		<?php $this->renderPartial('dashboard/projects',array( "projects" => $projects, "userId" => new MongoId($person["_id"]))); ?>
	</div>
</div>

<div class="row">
	<div class="col-sm-5 col-xs-12">
	   <?php $this->renderPartial('../pod/sliderAgenda', array("events" => $events, "userId" => new MongoId($person["_id"]))); ?>
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
var listPhotos = <?php echo json_encode($photos)?>;


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
</script>