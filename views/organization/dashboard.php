<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
?>

<style type="text/css">
	.panel-tools{
		filter: alpha(opacity=1);
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
		-moz-opacity: 1;
		-khtml-opacity: 1;
		opacity: 1;
	}

</style>
<div class="col-sm-8 col-xs-12">
		<div class="row">
			<div class="col-sm-12 col-xs-12">
	    		<?php $this->renderPartial('../pod/ficheInfo',array( "context" => (isset($organization)) ? $organization : null, "tags" => $tags, "images" => $images)); ?>
	    	</div>
	    	<div class="col-sm-12 col-xs-12 documentPod">
	    		<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Documents Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	    		
	    	</div>
	    	<?php 
		    	if(isset($organization) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], (String) $organization["_id"])) {

		    ?>
			<div class="col-sm-12 col-xs-12">
	    		<?php $this->renderPartial('dashboard/network',array( "organization" => $organization,"members"=>$members)); ?>
	    	</div>
	    	<?php }; ?>
	    	
	    	<div class="col-sm-12 col-xs-12 jobPod">
	    		<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Jobs Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	    		
	    	</div>
	    </div>
	 </div>

	 <div class="col-sm-4 col-xs-12">
	 	<div class="row">
	 		<div class="col-sm-12 col-xs-12">
	 			<?php $this->renderPartial('../pod/photoVideo',array( "context" => (isset($organization)) ? $organization : null, "images" => $images )); ?>
	 		</div>
	 		<div class="col-sm-12 col-xs-12 shareAgendaPod">
	 			<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Shared Agenda Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	 		</div>

	 		<div class="col-sm-12 col-xs-12">
	 			<?php //$this->renderPartial('../pod/news', array("events" => $events, "organizationId" => (isset($organization)) ? (String) $organization["_id"] : null )); ?>
	 		</div>


	 	</div>
	 </div>
</div>


<!-- end: PAGE CONTENT-->
<script>
	var contextMap = { "desc" : [ "organization", "events " ] };
	contextMap = <?php echo json_encode($organization) ?>;
	contextMap.events = <?php echo json_encode($events) ?>;
	images = <?php echo json_encode($images) ?>;

	
	jQuery(document).ready(function() {
		if($(".tooltips").length) {
     		$('.tooltips').tooltip();
   		}
		$('.pulsate').pulsate({
            color: '#2A3945', // set the color of the pulse
            reach: 10, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 200, // how long the pause between pulses is in ms
            glow: false, // if the glow should be shown too
            repeat: 10, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });

		getAjax(".documentPod",baseUrl+"/"+moduleId+"/organization/documents/id/<?php echo $_GET["id"]?>",null,"html");
		getAjax(".jobPod",baseUrl+"/"+moduleId+"/job/list",null,"html");
		getAjax(".shareAgendaPod", baseUrl+"/"+moduleId+"/pod/slideragenda/id/<?php echo $_GET["id"]?>/type/<?php echo Organization::COLLECTION ?>", null, "html");
		
	});

</script>