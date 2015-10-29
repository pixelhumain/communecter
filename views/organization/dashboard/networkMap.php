

<?php

		/* ***************** modifier l'url relative si besoin pour trouver communecter/view/sig/ *******************/
		$relativePath = "../sig/";
		/* ***********************************************************************************/

	   	//chargement de toutes les librairies css et js indispensable pour la carto
    	$this->renderPartial($relativePath.'generic/mapLibs');


		/* **************** modifier les parametre en fonction des besoins *******************/
		if(!isset($sigParams)){
			//var_dump($sigParams);
			$sigParams = array(

					"sigKey" => "DashOrga",

					/* MAP */
					"mapHeight" => ( isset($sigParams) && isset($sigParams["mapHeight"]) ) ? $sigParams["mapHeight"] : 450,
					"mapTop" => ( isset($sigParams) && isset($sigParams["mapTop"]) ) ? $sigParams["mapTop"] : 0,
					"mapColor" => ( isset($sigParams) && isset($sigParams["mapColor"]) ) ? $sigParams["mapColor"] :'',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
					"mapOpacity" => ( isset($sigParams) && isset($sigParams["mapOpacity"]) ) ? $sigParams["mapOpacity"] : 1 , //ex : 0.4

					/* *
					 * Provider de fond de carte
					 * http://leaflet-extras.github.io/leaflet-providers/preview/index.html
					 * */

					/* MAP LAYERS (FOND DE CARTE) */
					"mapTileLayer" 	  => ( isset($sigParams) && isset($sigParams["mapTileLayer"]) ) ? $sigParams["mapTileLayer"] : 'http://toolserver.org/tiles/hikebike/{z}/{x}/{y}.png',
					"mapAttributions" => ( isset($sigParams) && isset($sigParams["mapAttributions"]) ) ? $sigParams["mapAttributions"] : '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

					/* MAP BUTTONS */
					"mapBtnBgColor" => ( isset($sigParams) && isset($sigParams["mapBtnBgColor"]) ) ? $sigParams["mapBtnBgColor"] :'#E6D414',
					"mapBtnColor" => ( isset($sigParams) && isset($sigParams["mapBtnColor"]) ) ? $sigParams["mapBtnColor"] :'#213042',
					"mapBtnBgColor_hover" => ( isset($sigParams) && isset($sigParams["mapBtnBgColor_hover"]) ) ? $sigParams["mapBtnBgColor_hover"] :'#5896AB',

					/* USE */
					"usePanel" => ( isset($sigParams) && isset($sigParams["usePanel"]) ) ? $sigParams["usePanel"] :false,
					"titlePanel" => ( isset($sigParams) && isset($sigParams["titlePanel"]) ) ? $sigParams["titlePanel"] :'Thèmes',
					"useRightList" => ( isset($sigParams) && isset($sigParams["useRightList"]) ) ? $sigParams["useRightList"] :false,
					"useZoomButton" => ( isset($sigParams) && isset($sigParams["useZoomButton"]) ) ? $sigParams["useZoomButton"] :true,
					"useHomeButton" => ( isset($sigParams) && isset($sigParams["useHomeButton"]) ) ? $sigParams["useHomeButton"] :true,
					"useHelpCoordinates" => ( isset($sigParams) && isset($sigParams["useHelpCoordinates"]) ) ? $sigParams["useHelpCoordinates"] :false,
					"useFullScreen" => ( isset($sigParams) && isset($sigParams["useFullScreen"]) ) ? $sigParams["useFullScreen"] :false,
					"useExternalRightList" => ( isset($sigParams) && isset($sigParams["useExternalRightList"]) ) ? $sigParams["useExternalRightList"] :false,

					"notClusteredTag" => ( isset($sigParams) && isset($sigParams["notClusteredTag"]) ) ? $sigParams["notClusteredTag"] : array("citoyens"),

					"firstView"		  => ( isset($sigParams) && isset($sigParams["firstView"]) ) ? $sigParams["firstView"] :array(  "coordinates" => array(-21.13318, 55.5314),
																															  "zoom"		  => 9),
					"mapPoints"		  => ( isset($sigParams) && isset($sigParams["mapPoints"]) ) ? $sigParams["mapPoints"] :null,
					);
	}
		/* ***********************************************************************************/


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
	    <h4 class="panel-title">Annuaire Cartographique</h4>
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
		console.log("load map from networkMap");
		Sig = SigLoader.getSig();

		//affiche l'icone de chargement
		Sig.showIcoLoading(true);

			//chargement des paramètres d'initialisation à partir des params PHP definis plus haut
			var initParams =  <?php echo json_encode($sigParams); ?>;

			//chargement la carte
			mapDashboardOrga = Sig.loadMap("mapCanvas", initParams);
			console.log("contextMap");
			console.dir(contextMap);
			/**************************** CHANGER LA SOURCE DES DONNEES EN FONCTION DU CONTEXTE ***************************/
			var mapData = contextMap;
			//var mapData = ;
			//alert("liste des différents éléments des données : " + JSON.stringify(contextMap));
			/**************************************************************************************************************/

			//alert(JSON.stringify(mapData));
			//console.dir(mapData);
			//affichage des éléments sur la carte
			Sig.showMapElements(mapDashboardOrga, mapData);//, elementsMap);

		//masque l'icone de chargement
		Sig.showIcoLoading(false);

	});

</script>
