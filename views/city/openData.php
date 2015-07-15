<?php
/*$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/weather-icons/css/weather-icons.min.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js' , CClientScript::POS_END);
*/
?>
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="row">
	 	<div class="col-sm-6 col-xs-12 statisticPop">
		 	<div class="panel panel-white pulsate">
				<div class="panel-heading border-light ">
					<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Population Section</h4>
					<div class="space5"></div>
				</div>
			</div>
		</div>
	
		<div class="col-sm-6 col-xs-12 statisticEntreprise">
		 	<div class="panel panel-white pulsate">
				<div class="panel-heading border-light ">
					<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Entreprise Section</h4>
					<div class="space5"></div>
				</div>
			</div>
		</div>


	</div>
</div>
<script>
jQuery(document).ready(function() {
	$('.pulsate').pulsate({
            color: '#2A3945', // set the color of the pulse
            reach: 10, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 200, // how long the pause between pulses is in ms
            glow: false, // if the glow should be shown too
            repeat: 10, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });

	getAjax(".statisticPop", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>", 
		function(){
			/*$(".ulline").hide();
			$(".divline").hide();
			$("#titleGraph").html('Population de la commune');*/
		}, "html");

	getAjax(".statisticEntreprise", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>/typeData/entreprise/", 
		function(){
			/*$(".ulline").hide();
			$(".divline").hide();
			$("#titleGraph").html('Entreprise de la commune');*/
		}, "html");

	getAjax(".shareAgendaPod", baseUrl+"/"+moduleId+"/pod/slideragenda/id/<?php echo $_GET["insee"]?>/type/<?php echo City::COLLECTION ?>", function(){
			//initAddEventBtn ();
		}, "html");
		
});

	

</script>