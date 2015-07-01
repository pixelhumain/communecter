
<?php
		/* ***************** modifier l'url relative si besoin pour trouver communecter/view/sig/ *******************/
		$relativePath = "/sig/";
		/* ***********************************************************************************/

	   	//chargement de toutes les librairies css et js indispensable pour la carto
    	//$this->renderPartial($relativePath.'generic/mapLibs');
			//$this->renderPartial($relativePath.'generic/mapLibs');

	/*		$cssAndScriptFiles = array(

				//css
				'/css/sig/leaflet/leaflet.css',
				'/css/sig/leaflet/leaflet.draw.css',
				'/css/sig/leaflet/leaflet.draw.ie.css',
				'/css/sig/leaflet/MarkerCluster.css',
				'/css/sig/leaflet/MarkerCluster.Default.css',
				'/css/sig/leaflet/leaflet.awesome-markers.css',
				'/css/sig/leaflet/sig.css',

				//js
				'/js/sig/leaflet/leaflet.js',
				'/js/sig/leaflet/leaflet.draw-src.js',
				'/js/sig/leaflet/leaflet.draw.js',
				'/js/sig/leaflet/leaflet.markercluster-src.js',
				'/js/sig/leaflet/leaflet.awesome-markers.js',

				'/js/sig/leaflet/map.js',
				'/js/sig/leaflet/map_initializer.js',
				'/js/sig/leaflet/map_panel.js',
				'/js/sig/leaflet/map_popupContent.js',
				'/js/sig/leaflet/map_rightList.js',
				'/js/sig/leaflet/map_findPlace.js',


			);
			//echo $this->module->assetsUrl; die();
			HtmlHelper::registerCssAndScriptsFiles( $cssAndScriptFiles , $this->module->assetsUrl);*/
?>


<?php
	$moduleName  = "sigModule".$sigParams['sigKey'];
	$this->renderPartial($relativePath.'generic/mapCss', array( "sigParams" => $sigParams));
?>


<?php /* ********************** CHANGER LE STYLE CSS SI BESOIN ********************/?>
<style>
svg{
	height:auto;
	width:auto;
}
	.<?php echo $moduleName; ?> .mapCanvas			{}
	.<?php echo $moduleName; ?> .panel_map			{
		background-color:rgba(255, 255, 255, 0.83) !important;
	}
	.<?php echo $moduleName; ?> .item_panel_map{
		background-color:rgba(0, 0, 0, 0);
		color:#7A7A7A !important;
	}
	.<?php echo $moduleName; ?> .item_panel_map.selected{
		background-color:rgba(23, 58, 75, 0.51);
		color:#FFF !important;
	}
	.<?php echo $moduleName; ?> .item_panel_map:hover	{
		background-color:rgba(0, 0, 0, 0.04);
	}

	.<?php echo $moduleName; ?> #right_tool_map			{}
	.<?php echo $moduleName; ?> #liste_map_element	{}

	.<?php echo $moduleName; ?> #lbl-chk-scope			{}

	.<?php echo $moduleName; ?> .btn-group-map			{}

	/* XS */
	@media screen and (max-width: 768px) {
		.<?php echo $moduleName; ?> .mapCanvas{}
		.<?php echo $moduleName; ?> .btn-group-map{}
	}

</style>


<?php /* ********************** HTML ********************/?>


<?php /* ********************** CHANGER LE CHEMIN RELATIF SI BESOIN ********************/?>
<?php $this->renderPartial($relativePath.'generic/mapView', array( "sigParams" => $sigParams)); ?>
<?php /* *******************************************************************************/?>


<script type="text/javascript">

	var Sig;

	/**************************** DONNER UN NOM DIFFERENT A LA MAP POUR CHAQUE CARTE ******************************/
	//le nom de cette variable doit changer dans chaque vue pour éviter les conflits (+ vérifier dans la suite du script vvvv)
	var mapSV;
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
			mapSV = Sig.loadMap("mapCanvas", initParams);
			console.log("contextMap");
			console.dir(contextMap);
			//alert(JSON.stringify(contextMap.organizations));
			/**************************** CHANGER LA SOURCE DES DONNEES EN FONCTION DU CONTEXTE ***************************/
			var mapData = contextMap;
			/**************************************************************************************************************/

			//affichage des éléments sur la carte
			Sig.showMapElements(mapSV, mapData);//, elementsMap);
			//masque l'icone de chargement
			Sig.showIcoLoading(false);

	});

</script>
