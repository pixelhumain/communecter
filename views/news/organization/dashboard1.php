
<div class="row">
	<?php $this->renderPartial('../pod/ficheOrganization',array( "context" => (isset($organization)) ? $organization : null )); ?>
</div>
<div class="row">
	<div class="col-sm-8 col-xs-12">
		<div class="row">
			<div class="col-sm-12 col-xs-12 documentPod">
	    		<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Documents Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	    		
	    	</div>
		</div>
		<div class="row">
			<div class="panel panel-white">
				<div class="panel-heading border-light">
					<h4 class="panel-title"> EMPLOIS ET FORMATIONS </h4>
				</div>
				<div class="panel-body no-padding">
					<div class="panel-scroll height-230 ps-container">
						<table class="table table-striped table-hover" id="organizations">
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4 col-xs-12">
		<div class="col-sm-12 col-xs-12 photoVideoPod">
 			<div class="panel panel-white pulsate">
				<div class="panel-heading border-light ">
					<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Media Section</h4>
					<div class="space5"></div>
				</div>
			</div>
 			
 		</div>
	</div>
</div>

<script type="text/javascript">
	var contextMap= <?php echo json_encode($contextMap) ?>;
	var images = <?php echo json_encode($images) ?>;
	var contentKeyBase = "<?php echo $contentKeyBase ?>";
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
		getAjax(".documentPod",baseUrl+"/"+moduleId+"/document/list/id/<?php echo $_GET["id"]?>/type/<?php echo Organization::COLLECTION?>",null,"html");
		getAjax(".photoVideoPod", baseUrl+"/"+moduleId+"/pod/photovideo/id/<?php echo $_GET["id"]?>/type/<?php echo Organization::COLLECTION ?>", function(){bindPhotoSubview();}, "html");
	});
</script>
