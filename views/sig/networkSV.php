<?php
		/* ***************** modifier l'url relative si besoin pour trouver communecter/view/sig/ *******************/
		$relativePath = "/sig/";
		/* ***********************************************************************************/

	   	//chargement de toutes les librairies css et js indispensable pour la carto
    	//HtmlHelper::registerCssAndScriptsFiles( $cssAndScriptFiles , $this->module->assetsUrl);
		$this->renderPartial($relativePath.'generic/mapLibs');
		$this->renderPartial($relativePath.'generic/mapCss', array("sigParams" => $sigParams));
		//var_dump($sigParams); //die();
		$moduleName = "sigModule".$sigParams['sigKey'];
?>

<?php /* ********************** CHANGER LE STYLE CSS SI BESOIN ********************/?>

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
