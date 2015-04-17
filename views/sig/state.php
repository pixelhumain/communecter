
<?php include ("html_map.php")?> 

<script type="text/javascript" src="<?php echo $this->module->assetsUrl.'/js/sigCommunecter.js';?>" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready( function() 
{ 	
	//récupère les coordonnées de ma position
	//et lance la création de la carte
	ajaxPost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true).'/'.$this->module->id?>/sig/GetMyPosition', null,
		function (data){ //alert(JSON.stringify(data));
			var myInfos;
			$.each(data, function() { 
				myInfos = this;
				myPosition = new Array( this.geo.latitude, this.geo.longitude );
			});
		initMap("ShowLocalState", myInfos, myPosition);
		//findPlace();
	});		
});

	
	//transmet le chemin vers les asset au fichier sigCommunecterJs (sinon les icons n'apparaissent pas sur la carte)
	var assetPath = "<?php echo $this->module->assetsUrl;?>";
	
	//déclare les variables et fonction dans le scope global,
	//pour y accéder pendant les événements (moveend, click, etc)
	var map = "";
	var myPosition = "";
	var circlePosition = "";
	var listIdElementMap = new Array();
	var listDataElementMap = new Array();
	
	
	function setPosListElementMap(){
		var width = $("#right_tool_map").css("width");
		width = width.substring(0, width.length-2);
		var widthMap = $("#mapCanvas").css("width");
		widthMap = widthMap.substring(0, widthMap.length-2);
		$("#right_tool_map").css({"left" : widthMap - width - 10});
	}
		
	$( window ).resize(function() {
		setPosListElementMap();
	});
	
	setPosListElementMap();

	
	
</script>
<h2>State</h2>