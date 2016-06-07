<?php
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/sig/geolocInternational.js'
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>

.main-col-search{
	background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/tango-circle-bg-orange.png");
	background-size:100%;
	background-repeat: no-repeat;
	background-color: #ffc694 !important;
}


#newEvent{
	display: block;
	float: left;
	padding: 10px;
	background-color: rgba(242, 242, 242, 0.6);
	width: 100%;
	-moz-box-shadow: 0px 0px 3px -1px #747474;
	-webkit-box-shadow: 0px 0px 3px -1px #747474;
	-o-box-shadow: 0px 0px 3px -1px #747474;
	box-shadow: 0px 0px 3px -1px #747474;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#cfcfcf, Direction=134, Strength=5);
}

.noteWrap .panel-white{
	background-color: rgba(0, 0, 0, 0);
	color: white;
	font-size: 15px;
	font-weight: 300;
}
.noteWrap .control-label{
	font-size:15px;
	font-weight:600;
}

</style>


<div id="newEvent">
	<div class="row">
		<div class="col-md-12">
			<form class="form-event">
				<input type="hidden" value="FR">
				<input type="text" id="inputText-geolocInternational">
				<button class="btn btn-default" id="btn-geolocInternational">Rechercher</button>
			</form>
			<div class="result"></div>
		</div>
	</div>
</div>


<script type="text/javascript">

	jQuery(document).ready(function() {
	 	$(".moduleLabel").html("<i class='fa fa-plus'></i> <i class='fa fa-calendar'></i> Créer un événement");
	
	 	$("#btn-geolocInternational").click(function(){
	 		var requestPart = $("#inputText-geolocInternational").val();
	 		var geoPos = getGeoPosInternational(requestPart);
	 	});
	});

</script>


