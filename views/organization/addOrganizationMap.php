<?php

		//modifier l'url relative si besoin pour trouver communecter/view/sig/
		$relativePath = "../sig/";
		
	   	//modifier les parametre en fonction des besoins de la carte
		$sigParams = array(
	        "sigKey" => "CityOrga",

	        /* MAP */
	        "mapHeight" => 90,
	        "mapTop" => 50,
	        "mapColor" => '',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
	        "mapOpacity" => 0.6, //ex : 0.4

	        /* MAP LAYERS (FOND DE CARTE) */
	        "mapTileLayer" 	  => 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
	        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

	        /* MAP BUTTONS */
	        //"mapBtnBgColor" => '#E6D414',
	        //"mapBtnColor" => '#213042',
	        //"mapBtnBgColor_hover" => '#5896AB',

	        /* USE */
	        "usePanel" => false,
	        "useFilterType" => false,
	        "titlePanel" => 'TAGS',
	        "useRightList" => false,
	        "useZoomButton" => true,
	        "useHomeButton" => false,
	        "useHelpCoordinates" => false,
	        "useFullScreen" => false,
	        "useResearchTools" => false,
	        "useChartsMarkers" => false,

	        /* TYPE NON CLUSTERISÉ (liste des types de données à ne pas inclure dans les clusters sur la carte (marker seul))*/
	        //"notClusteredTag" => array("citoyens"),

	        /* COORDONNÉES DE DÉPART (position géographique de la carte au chargement) && zoom de départ */
	        //"firstView"		  => array(  "coordinates" => array($city["geo"]["latitude"], $city["geo"]["longitude"]),//array(-21.137453135590444, 55.54962158203125),
	        //							 "zoom"		   => 14),
	    );
	 
		/* ***********************************************************************************/

		
		//chargement de toutes les librairies css et js indispensable pour la carto
    	$this->renderPartial($relativePath.'generic/mapLibs', array("sigParams" => $sigParams)); 
    	$moduleName = "sigModule".$sigParams['sigKey'];

		/* ***************** modifier l'url si besoin pour trouver ce fichier *******************/
	   	//chargement de toutes les librairies css et js indispensable pour la carto
	  	$this->renderPartial($relativePath.'generic/mapCss', array("sigParams" => $sigParams));


?>

<?php /* ********************** CHANGER LE STYLE CSS SI BESOIN ********************/ ?>


<style>

	.<?php echo $moduleName; ?> .mapCanvas			{}
	.<?php echo $moduleName; ?> .panel_map			{
	}
	.<?php echo $moduleName; ?> .item_panel_map			{
	}
	.<?php echo $moduleName; ?> .item_panel_map:hover	{
	}

	.<?php echo $moduleName; ?> #right_tool_map		{}
	.<?php echo $moduleName; ?> #liste_map_element	{}

	.<?php echo $moduleName; ?> #lbl-chk-scope		{}

	.<?php echo $moduleName; ?> .btn-group-map		{}
	

	/* XS */
	@media screen and (max-width: 768px) {
		.<?php echo $moduleName; ?> .mapCanvas{}
		.<?php echo $moduleName; ?> .btn-group-map{}
	}
</style>
<?php /* ********************** HTML ********************/?>



	<?php $this->renderPartial($relativePath.'generic/mapView', array( "sigParams" => $sigParams)); ?>


<script type="text/javascript">

	var Sig = null;

	/**************************** DONNER UN NOM DIFFERENT A LA MAP POUR CHAQUE CARTE ******************************/
	//le nom de cette variable doit changer dans chaque vue pour éviter les conflits (+ vérifier dans la suite du script)
	var mapCityOrga;
	/**************************************************************************************************************/

	function showMap(geoPosition){ 

		if(sig != null) return;
		alert("showMAP");

		//création de l'objet SIG
		Sig = SigLoader.getSig();
		//affiche l'icone de chargement
		Sig.showIcoLoading(true);
		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		var initParams =  <?php echo json_encode($sigParams); ?>;
		mapCityOrga = Sig.loadMap("mapCanvasOrga", initParams);
	}

	//mémorise l'url des assets (si besoin)
	var assetPath 	= "<?php echo $this->module->assetsUrl; ?>";
/*	jQuery(document).ready(function()
	{
		//création de l'objet SIG
		//Sig = SigLoader.getSig();
		/*
		//affiche l'icone de chargement
		Sig.showIcoLoading(true);

		//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
		var initParams =  <?php echo json_encode($sigParams); ?>;

		//chargement de la carte
		mapCityOrga = Sig.loadMap("mapCanvasOrga", initParams);
	
	*/	

		

		<?php 
			//transforme l'array des events pour pouvoir les parser correctement
		/*	foreach($events as $event){ $newEvents[] = $event; }
			$contextMap = array(//"organizations" => $organizations, 
								//"events" 		=> $newEvents, 
								//"projects" 		=> $projects,
								"null"		=> null,
								"charts"	=> $charts
								 );
								 */
		?>

		
		//var mapData = <?php //echo json_encode($contextMap) ?>; //null;//contextMap;
		//console.log("contextMap");
		//console.dir(mapData);
		/**************************************************************************************************************/
		
		//console.dir(mapData);
		//affichage des éléments sur la carte
		//Sig.showMapElements(mapCity, mapData);//, elementsMap); 

		//var boundingBox = <?php if(isset($city["geo"]["boundingbox"])) echo json_encode($city["geo"]["boundingbox"]); else echo "false"; ?>;

	/*	console.dir(boundingBox);
		if(boundingBox != false){
			var latMin = boundingBox[0];
	    	var latMax = boundingBox[1];
	    	var lngMin = boundingBox[2];
	    	var lngMax = boundingBox[3];
	    	mapCity.fitBounds([[latMin, lngMin],[latMax, lngMax]], { 'maxZoom' : 14 });
	    	//var rec = new L.Rectangle([[latMin, lngMin],[latMax, lngMax]]).addTo(mapCity);
	    }*/
		//mapCity.panTo([-21.06912308335471, 55.34912109375]);
		//masque l'icone de chargement
	//	Sig.showIcoLoading(false);

	});

</script>
