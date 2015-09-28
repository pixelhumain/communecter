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

<?php $this->renderPartial('/sig/generic/mapLibs'); ?>

<div class="row">
	<div class="col-md-3 col-sm-6  col-xs-12">
		<?php $this->renderPartial('dashboard/organizations',array( "organizations" => $organizations, "userId" => new MongoId($person["_id"]))); ?>
	</div>
	<div class="col-md-3 col-sm-6  col-xs-12">
		<?php $this->renderPartial('../pod/eventsList',array( "events" => $events, 
																"contextId" =>(string)$person["_id"],
																"contextType" => "citoyen",
																"authorised" => ( (string)@$person["_id"] == Yii::app()->session["userId"] ) 
															)); ?>
	</div>
	<div class="col-md-3 col-sm-6  col-xs-12">
		<?php $this->renderPartial('../pod/projectsList',array( "projects" => $projects, 
																"contextId" => (string)$person["_id"],
																"contextType" => "citoyen",
																"authorised" => ( (string)@$person["_id"] == Yii::app()->session["userId"] ) 
														)); ?>
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
		<?php $this->renderPartial('dashboard/profil', array("person" => $person, "tags" => $tags, "countries" => $countries )); ?>
	</div>

	
</div>

<div class="row">
	
	<div class=" col-md-5 newsPod">
		<div class="panel panel-white pulsate">
			<div class="panel-heading border-light ">
				<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading News Section</h4>
				<div class="space5"></div>
			</div>
		</div>
	</div>

	<div class=" col-md-7 shareAgendaPod">
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
contextMap = <?php echo json_encode($person) ?>;
var idToSend = contextMap["_id"]["$id"];
contextMap["person"] = <?php echo json_encode($person) ?>;
contextMap["organizations"] = <?php echo json_encode($organizations) ?>;
contextMap["events"] = <?php echo json_encode($events) ?>;
contextMap["projects"] = <?php echo json_encode($projects) ?>;
contextMap["people"] = <?php echo json_encode($people) ?>;
var images = <?php echo json_encode($images) ?>;
var contentKeyBase = "<?php echo $contentKeyBase ?>";
var events = <?php echo json_encode($events) ?>;

console.warn("contextMap");
console.dir(contextMap);

jQuery(document).ready(function() {
	bindBtnFollow();

	getAjax(".shareAgendaPod", baseUrl+"/"+moduleId+"/event/calendarview/pod/1", function(){}, "html");

	getAjax(".newsPod", baseUrl+"/"+moduleId+"/news/latest/type/<?php echo Person::COLLECTION ?>/id/<?php if(isset($_GET["id"])) echo $_GET["id"]; else if(isset($person["_id"])) echo $person["_id"]; ?>/count/5", function(){}, "html");

	$(".changePasswordBtn").off().on("click",function () {
		openChangePasswordSV();
	})
});

function bindBtnFollow() {
	$(".followBtn").off().on("click", function() {
		console.log($(this).data("id"));
		connectPerson($(this).data("id"), function(user) {
			console.log(user);
			$("#linkBtns").empty();
	        $("#linkBtns").html('<a href="javascript:;" class="unfollowBtn text-red tooltips" data-name="'+user["name"]+'" data-id="'+user["id"]+'" data-type="<?php echo Person::COLLECTION?>" data-ownerlink="knows" data-placement="top" data-original-title="Remove from my contact" ><i class="disconnectBtnIcon fa fa-unlink"></i>UNFOLLOW</a>');
	        bindBtnFollow();
		});
	});

	$(".unfollowBtn").off().on("click", function() {
		var id = $(this).data("id");
		var type = $(this).data("type");
		var name = $(this).data("name");
		console.log(id, type, name);
		disconnectPerson(id,type,name, function(id, type, name) {
			$("#linkBtns").empty();
			$("#linkBtns").html('<a href="javascript:;" class="followBtn tooltips" id="addKnowsRelation" data-id="'+id+'" data-placement="top" data-ownerlink="knows" data-original-title="I know this person" ><i class="connectBtnIcon fa fa-link "></i>FOLLOW</a></li>');
			bindBtnFollow();
		});
	});
}

function openChangePasswordSV(mode, id) {
	console.log("openChangePasswordSV");
	$("#ajaxSV").html("<div class='col-sm-8 col-sm-offset-2 changePasswordContainer'>"+
		  	"</div>");
	$.subview({
		content : "#ajaxSV",
		onShow : function() {
			$.ajax({
	            type: "POST",
	            url: baseUrl+"/"+moduleId+"/person/changepassword",
	            data: {
	            	"mode" : "initSV",
	            	"userId" : userId 
	            },
	            dataType: "json"
	        })
	        .done(function (data) {
	            console.log("yes !");
	            if (data && data.result) {               
	                $(".changePasswordContainer").html(data.content);
	                //Add any callback on success

	            } else {
	              toastr.error((data.msg) ? data.msg : "bug happened");
	              $.hideSubview();
	            }
        	})
		},
		onHide : function() {
			$("#ajaxSV").html('');
			$.hideSubview();
		},
		onSave : function() {
			changePassword();
		}
	});
}

</script>
