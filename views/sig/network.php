
<?php 
	
		/* ***************** modifier l'url relative si besoin pour trouver communecter/view/sig/ *******************/
		$relativePath = "./";
		/* ***********************************************************************************/
	   	
	   	//chargement de toutes les librairies css et js indispensable pour la carto 
    	$this->renderPartial($relativePath.'generic/mapLibs');
		
		
	
		/* **************** modifier les parametre en fonction des besoins *******************/
		$sigParams = array(
				"sigKey" => "SV",
				"mapHeight" => 550,
				"mapTop" => 0,
				"useFullScreen" => true,
				"usePanel" => false,
				"useRightList" => true,
				"useZoomButton" => true,
				"useHelpCoordinates" => false,
				"firstView"			 => array(  "coordinates" => array(-21.13318, 55.5314),
												"zoom"		  => 9),
				);
		/* ***********************************************************************************/
	   	
	   	
		$moduleName = "sigModule".$sigParams['sigKey'];
		
		/* ***************** modifier l'url si besoin pour trouver ce fichier *******************/
	   	//chargement de toutes les librairies css et js indispensable pour la carto 
    	$this->renderPartial($relativePath.'generic/mapCss', array("sigParams" => $sigParams));
?>


<?php /* ********************** CHANGER LE STYLE CSS PRINCIPAL SI BESOIN ********************/?>
<style>

	.<?php echo $moduleName; ?> .mapCanvas{
	}
	
	.<?php echo $moduleName; ?> .panel_map{
	}
	
	.<?php echo $moduleName; ?> #right_tool_map{
	}
	
	.<?php echo $moduleName; ?> #lbl-chk-scope{
	}
	
	.<?php echo $moduleName; ?> #liste_map_element{
	}
	
	.<?php echo $moduleName; ?> .btn-group-map{
	}
	
	/* XS */
	@media screen and (max-width: 768px) {
		
		.<?php echo $moduleName; ?> .mapCanvas{
		}
		
		.<?php echo $moduleName; ?> .btn-group-map{
		}
	}
	
</style>
<?php /* ********************** HTML ********************/?>



<div class="<?php echo $moduleName; ?>">	
	
	  		<?php /* ********************** CHANGER LE CHEMIN RELATIF SI BESOIN ********************/?>
	   		<?php $this->renderPartial($relativePath.'generic/mapView', array( "sigParams" => $sigParams)); ?>
	   		<?php /* *******************************************************************************/?>
	 
</div>

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
			mapSV = Sig.loadMap("mapCanvas" + initParams.sigKey);
			
			//initialisation de l'interface
			Sig.initEnvironnement(mapSV, initParams);
			
			
			/**************************** CHANGER LA SOURCE DES DONNEES EN FONCTION DU CONTEXTE ***************************/
			//var mapData = contextMap.members.citoyens;
			/**************************************************************************************************************/
	
			//affichage des éléments sur la carte
			//Sig.showMapElements(mapSV, mapData);//, elementsMap);

		//masque l'icone de chargement
		Sig.showIcoLoading(false);
				
	});
	
</script>