

<?php

		/* ***************** modifier l'url relative si besoin pour trouver communecter/view/sig/ *******************/
		$relativePath = "../sig/";
		/* ***********************************************************************************/

	   	/* **************** modifier les parametre en fonction des besoins *******************/
		$sigParams = array(
	        "sigKey" => "SV",

	        /* MAP */
	        "mapHeight" => 450,
	        "mapTop" => 50,
	        "mapColor" => '',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
	        "mapOpacity" => 1, //ex : 0.4

	        /* MAP LAYERS (FOND DE CARTE) */
	        "mapTileLayer" 	  => 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
	        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

	        /* MAP BUTTONS */
	        "mapBtnBgColor" => '#E6D414',
	        "mapBtnColor" => '#213042',
	        "mapBtnBgColor_hover" => '#5896AB',

	        /* USE */
	        "usePanel" => true,
	        "titlePanel" => 'TAGS',
	        "useRightList" => true,
	        "useZoomButton" => true,
	        "useHomeButton" => true,
	        "useHelpCoordinates" => false,
	        "useFullScreen" => false,
	        "useResearchTools" => true,
	        /* TYPE NON CLUSTERISÉ (liste des types de données à ne pas inclure dans les clusters sur la carte (marker seul))*/
	        "notClusteredTag" => array("citoyens"),

	        /* COORDONNÉES DE DÉPART (position géographique de la carte au chargement) && zoom de départ */
	        "firstView"		  => array(  "coordinates" => array(-21.13318, 55.5314),
	                       				 "zoom"		   => 9),

	    	/* CHARTS */
	        "useChartsMarkers" => true,

	       /* FeatureCollection = 
			{ 	"type": "FeatureCollection", 
				"features":  [
					{"type": "Feature", "id": 1, "ensoleillement": 80, "précipitations": 20,  "nuages": 20,  "vent": 10,  "température": 30, "geometry": {"type": "Point", "coordinates": [55.43976, -20.90244]}}, 
					{"type": "Feature", "id": 2, "ensoleillement": 10, "précipitations": 340, "nuages": 100, "vent": 100, "température": 20, "geometry": {"type": "Point", "coordinates": [55.6279,  -20.95503]}}, 
					{"type": "Feature", "id": 3, "ensoleillement": 10, "précipitations": 130, "nuages": 80,  "vent": 130, "température": 15, "geometry": {"type": "Point", "coordinates": [55.37521, -21.09475]}}, 
					{"type": "Feature", "id": 4, "ensoleillement": 45, "précipitations": 25,  "nuages": 55,  "vent": 60,  "température": 20, "geometry": {"type": "Point", "coordinates": [55.69794, -21.34183]}}, 
					{"type": "Feature", "id": 5, "ensoleillement": 35, "précipitations": 45,  "nuages": 65,  "vent": 30,  "température": 30, "geometry": {"type": "Point", "coordinates": [55.44113, -21.28298]}} 	]
			};*/

			"chartOptions" 	  => array("Options" => array(  "type" 		=> "BarChartMarker",
															"radius" 	=> 25,
															"maxHeight" => 120 //seulement pour BarChartMarker
														)),

	        "charts"		  => array(  "type" => "FeatureCollection",
	        							 "features" => 
	        							 array(   array(  "type" => "Feature", 
							 							   "id" => 1, 
		 												   "ensoleillement" => 10, 
		 												   "précipitations" => 20, 
		 												   "geometry" => array( "type" => "Point", 
		 												   						"coordinates" => array(55.43976, -20.90244) )),
							 
	           			  							array("type" => "Feature", 
							 							   "id" => 2, 
		 												   "ensoleillement" => 30, 
		 												   "précipitations" => 60, 
		 												   "geometry" => array( "type" => "Point", 
		 												   						"coordinates" => array(55.6279, -20.95503) )),
							 
	           			  							array("type" => "Feature", 
							 							   "id" => 3, 
		 												   "ensoleillement" => 80, 
		 												   "précipitations" => 30, 
		 												   "geometry" => array( "type" => "Point", 
		 												   						"coordinates" => array(55.37521, -20.34183) )),
		                       			  	)	
		        						),
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
		background-color:rgba(255, 255, 255, 0.83) !important;
	}
	.<?php echo $moduleName; ?> .item_panel_map			{
		background-color:rgba(0, 0, 0, 0) !important;
		color:#7A7A7A !important;
	}
	.<?php echo $moduleName; ?> .item_panel_map:hover	{
		background-color:rgba(0, 0, 0, 0.04) !important;
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



	<div class="panel panel-white">
	  <div class="panel-heading border-light">
	    <h4 class="panel-title">MAP</h4>
	    <div class="panel-tools"
	      <a class="btn btn-xs btn-link panel-close" href="#">
	        <i class="fa fa-times"></i>
	      </a>
	    </div>
	  </div>
	  <div class="panel-body no-padding">

	  		<?php /* ********************** CHANGER LE CHEMIN RELATIF SI BESOIN ********************/?>
	   		<?php $this->renderPartial($relativePath.'generic/mapView', array( "sigParams" => $sigParams)); ?>
	   		<?php /* *******************************************************************************/?>

	  </div>
	</div>

<script type="text/javascript">

	var Sig;

	/**************************** DONNER UN NOM DIFFERENT A LA MAP POUR CHAQUE CARTE ******************************/
	//le nom de cette variable doit changer dans chaque vue pour éviter les conflits (+ vérifier dans la suite du script vvvv)
	var mapDashboardOrga;
	/**************************************************************************************************************/

	//mémorise l'url des assets (si besoin)
	var assetPath 	= "<?php echo $this->module->assetsUrl; ?>";

	jQuery(document).ready(function()
	{
		//création de l'objet SIG
		Sig = SigLoader.getSig();

		//affiche l'icone de chargement
		Sig.showIcoLoading(true);

			//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
			var initParams =  <?php echo json_encode($sigParams); ?>;

			//chargement la carte
			mapDashboardOrga = Sig.loadMap("mapCanvas", initParams);
			/**************************** CHANGER LA SOURCE DES DONNEES EN FONCTION DU CONTEXTE ***************************/
			//var mapData = contextMap;
			<?php 
				foreach($events as $event){
					$newEvents[] = $event;
				}
				$contextMap = array("organizations" => $organizations, "events" => $newEvents, "projects" => $projects );
			?>
			var mapData = <?php echo json_encode($contextMap) ?>;//null;//contextMap;
			console.log("contextMap");
			console.dir(mapData);
			/**************************************************************************************************************/
			
			//console.dir(mapData);
			//affichage des éléments sur la carte
			Sig.showMapElements(mapDashboardOrga, mapData);//, elementsMap);

		//masque l'icone de chargement
		Sig.showIcoLoading(false);

	});

</script>
