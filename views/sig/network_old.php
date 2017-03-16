
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
		initMap("ShowMyNetwork", myInfos, myPosition);	
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
	
</script>

<style>
.subviews-top{
	//background-color:#d5d5d5;
}
#more_info_news{
	float:right;
	width:45%;
	background-color:#5F8295;
}
div.timeline{ margin-right:0px; }
</style>



<script type="text/javascript">
	
	/*
	//importer les données News
	$('#btn_import_data').click(function(event) { 
		ajaxPost("", '<?php echo Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id?>/sig/ImportData', null,
			function (data){ //alert(JSON.stringify(data));				
				$("#resImportData").html(data);
		});	
	});
	*/
	
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
