
<?php 
	//modifier l'url relative si besoin pour trouver communecter/view/sig/
	$relativePath = "../sig/";
	
   	//modifier les parametre en fonction des besoins de la carte
	$sigParams = array(
        "sigKey" => "Bg",

        /* MAP */
        "mapHeight" => 235,
        "mapTop" => 0,
        "mapColor" => '',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
        "mapOpacity" => 1, //ex : 0.4

        /* MAP LAYERS (FOND DE CARTE) */
        "mapTileLayer" 	  => '//{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

        /* MAP BUTTONS */
        //"mapBtnBgColor" => '#4C727E', //'rgba(76, 114, 126, 0.65)', //'#E6D414',
        //"mapBtnColor" => 'rgba(76, 114, 126, 0.65)', //'#213042',
        //"mapBtnBgColor_hover" => 'rgba(76, 114, 126, 0.65)', //'#5896AB',

        /* USE */
        "titlePanel" 		 => '',
        "usePanel" 			 => false,
        "useFilterType" 	 => false,
        "useRightList" 		 => false,
        "useZoomButton" 	 => true,
        "useSatelliteTiles"	 => true,
        "useHomeButton" 	 => false,
        "useFullScreen" 	 => true,
        "useFullPage" 	 	 => false,
        "useResearchTools" 	 => false,
        "useChartsMarkers" 	 => false,
        "useHelpCoordinates" => false,
        
        "notClusteredTag" 	 => array(),
        "firstView"		  	 => array(  "coordinates" => array(-21.219343584637794, 55.54756164550781),
									 	"zoom"		  => 11),
    );
 
	/* ***********************************************************************************/
	//chargement de toutes les librairies css et js indispensable pour la carto
	$this->renderPartial($relativePath.'generic/mapLibs', array("sigParams" => $sigParams)); 
	$moduleName = "sigModule".$sigParams['sigKey'];

	/* ***************** modifier l'url si besoin pour trouver ce fichier *******************/
   	//chargement de toutes les librairies css et js indispensable pour la carto
  	$this->renderPartial($relativePath.'generic/mapCss', array("sigParams" => $sigParams));
	$this->renderPartial($relativePath.'generic/mapView', array("sigParams" => $sigParams));
	//$this->renderPartial('addOrganizationMap'); var_dump($sigParams); die();
?>

<style>
	.noteWrap {
	    padding-top: 10px;
	    padding-bottom: 10px;
	    position: relative;
	    background-color: rgba(255, 255, 255, 0.84);
	    top: 30px;
	    border-radius:3px;
	}

</style>

<script type="text/javascript">

		var Sig;
		var mapBg;
		var assetPath 	= "<?php echo $this->module->assetsUrl; ?>";

		jQuery(document).ready(function()
		{
			Sig = SigLoader.getSig();
			Sig.showIcoLoading(true);
			
			mapBg = Sig.loadMap("mapCanvas", <?php echo json_encode($sigParams); ?>);
			mapBg.scrollWheelZoom.disable();

			Sig.showIcoLoading(false);
			$("#mapCanvasBg").css("height", "1000px");
			$("#mapCanvasBg").css("margin-bottom", "-1000px");
		});


</script>