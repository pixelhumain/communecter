

<?php 
	
		/* ***************** modifier l'url relative si besoin pour trouver communecter/view/sig/ *******************/
		$relativePath = "../sig/";
		/* ***********************************************************************************/
	  	
	   	//chargement de toutes les librairies css et js indispensable pour la carto 
    	$this->renderPartial($relativePath.'generic/mapLibs');
		
		
		/* **************** modifier les parametre en fonction des besoins *******************/
		$sigParams = array(
				"sigKey" => "DashOrga",
				"mapHeight" => 450,
				"mapTop" => 50,
				"useFullScreen" => true,
				"usePanel" => true,
				"useRightList" => true,
				"useZoomButton" => true,
				"useHelpCoordinates" => true,
				"firstView"			 => array(  "coordinates" => array(-21.13318, 55.5314),
												"zoom"		  => 9),
				);
		/* ***********************************************************************************/
	   	
	   	
		$moduleName = "sigModule".$sigParams['sigKey'];
		
		/* ***************** modifier l'url si besoin pour trouver ce fichier *******************/
	   	//chargement de toutes les librairies css et js indispensable pour la carto 
    	$this->renderPartial($relativePath.'generic/mapCss', array("sigParams" => $sigParams));
		
?>

<?php /* ********************** CHANGER LE STYLE CSS SI BESOIN ********************/?>
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
			mapDashboardOrga = Sig.loadMap("mapCanvas" + initParams.sigKey);
			
			//initialisation de l'interface
			Sig.initEnvironnement(mapDashboardOrga, initParams);
			
			
			/**************************** CHANGER LA SOURCE DES DONNEES EN FONCTION DU CONTEXTE ***************************/
			//var mapData = contextMap.members;
			//var mapData = ;
			/**************************************************************************************************************/
	
			//alert("organizationMembers");
			//alert(JSON.stringify(organizationMembers));
			//affichage des éléments sur la carte
			//Sig.showMapElements(mapDashboardOrga, mapData);//, elementsMap);

		//masque l'icone de chargement
		Sig.showIcoLoading(false);
				
	});
	
</script>