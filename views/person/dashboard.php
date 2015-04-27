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
	<div class="col-md-3">
		<?php $this->renderPartial('dashboard/organizations',array( "organizations" => $organizations, "userId" => new MongoId($person["_id"]))); ?>
	</div>
	<div class="col-md-3">
		<?php $this->renderPartial('dashboard/events',array( "events" => $events, "userId" => (string)$person["_id"])); ?>
	</div>
	<div class="col-md-3">
		<?php $this->renderPartial('dashboard/projects',array( "projects" => $projects, "userId" => (string)$person["_id"])); ?>
	</div>
	<div class="col-lg-3 col-md-3">
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

	<div class="col-lg-4 col-md-4 shareAgendaPod">
		<div class="panel panel-white pulsate">
			<div class="panel-heading border-light ">
				<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Shared Agenda Section</h4>
				<div class="space5"></div>
			</div>
		</div>
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
	bindBtnFollow();
	getAjax(".shareAgendaPod", baseUrl+"/"+moduleId+"/pod/slideragenda/id/<?php echo $_GET["id"]?>/type/<?php echo person::COLLECTION ?>", null, "html");
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
		var idConnect = "<?php echo (string)$person['_id'] ?>";
		if(typeof($("#inviteId"))!="undefined" && $("#inviteId").val()!= ""){
			idConnect = $("#inviteId").val();
		}

		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/connect/id/"+idConnect+"/type/<?php echo PHType::TYPE_CITOYEN ?>",
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

	
</script>