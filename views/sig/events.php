
<?php include ("html_map.php")?> 

<script type="text/javascript" src="<?php echo $this->module->assetsUrl.'/js/sigCommunecter.js';?>" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready( function() 
{ 	
	//récupère les coordonnées de ma position
	//et lance la création de la carte
	testitpost("", '/ph/communecter/sig/GetMyPosition', null,
		function (data){ //alert(JSON.stringify(data));
			var myInfos;
			$.each(data, function() { 
				myInfos = this;
				myPosition = new Array( this.geo.latitude, this.geo.longitude );
			});
		initMap("ShowLocalEvents", myInfos, myPosition);
		//findPlace();
	});	
	
});

	//transmet le chemin vers les asset au fichier sigCommunecterJs (sinon les icons n'apparaissent pas sur la carte)
	var assetPath = "<?php echo $this->module->assetsUrl;?>";
	
	//déclare les variables et fonction dans le scope global,
	//pour y accéder pendant les événements (moveend, click, etc)
	var map, myPosition;
	var listIdElementMap = new Array();
	var listDataElementMap = new Array();
	
	
	
	
</script>
<h2>Events</h2>