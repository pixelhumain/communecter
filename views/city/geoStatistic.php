<?php

		/* ***************** modifier l'url relative si besoin pour trouver communecter/view/sig/ *******************/
		$relativePath = "../sig/";
		/* ***********************************************************************************/

	   	/* **************** modifier les parametre en fonction des besoins *******************/
		$sigParams = array(
	        "sigKey" => "city",

	        /* MAP */
	        "mapHeight" => 470,
	        "mapTop" => 50,
	        "mapColor" => '',  //ex : '#456074', //'#5F8295', //'#955F5F', rgba(69, 116, 88, 0.49)
	        "mapOpacity" => 1, //ex : 0.4

	        /* MAP LAYERS (FOND DE CARTE) */
	        "mapTileLayer" 	  => 'http://{s}.tile.thunderforest.com/landscape/{z}/{x}/{y}.png', //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png'
	        "mapAttributions" => '<a href="http://www.opencyclemap.org">OpenCycleMap</a>',	 	//'Map tiles by <a href="http://stamen.com">Stamen Design</a>'

	        /* MAP BUTTONS */
	        //"mapBtnBgColor" => '#E6D414',
	        //"mapBtnColor" => '#213042',
	        //"mapBtnBgColor_hover" => '#5896AB',

	        /* USE */
	        "usePanel" => true,
	        "useFilterType" => true,
	        "titlePanel" => 'TAGS',
	        "useRightList" => true,
	        "useZoomButton" => true,
	        "useHomeButton" => false,
	        "useHelpCoordinates" => false,
	        "useFullScreen" => false,
	        "useResearchTools" => true,
	        "useChartsMarkers" => true,

	        /* TYPE NON CLUSTERISÉ (liste des types de données à ne pas inclure dans les clusters sur la carte (marker seul))*/
	        "notClusteredTag" => array("citoyens"),

	        /* COORDONNÉES DE DÉPART (position géographique de la carte au chargement) && zoom de départ */
	        "firstView"		  => array(  "coordinates" => array($city["geo"]["latitude"], $city["geo"]["longitude"]),//array(-21.137453135590444, 55.54962158203125),
	        							 "zoom"		   => 14),
	    );
	 
	 	$populationTotalCity = City::getPopulationTotalInsee($_GET['insee'],'2011');
	 	$populationTotalHommesCity = City::getPopulationHommesInsee($_GET['insee'],'2011');
	 	$populationTotalFemmesCity = City::getPopulationFemmesInsee($_GET['insee'],'2011');
	 	$params = array("insee" => $_GET['insee']);
	 	$fields = array('geo');
	 	$city = City::getWhere($params, $fields);
	 	foreach ($city as $key => $value) {
	 		$geo = $value['geo'];
	 	}
	 	
	 	//$populationTotalDepartement = City::getPopulationTotalInseeDepartement($_GET['insee'],'2011');
		/*var_dump($populationTotalCity);
		var_dump($populationTotalDepartement);
		$res = (($populationTotalHommesCity * 100) / $populationTotalCity);
		var_dump($res);*/
	 	$charts =  array(/* 1ER GROUPE	*/
	 					array(  "name" => "Population",
								"name_text" => "Population",
								    /* options d'affichage de chaque donnée */
								"chartOptions"=> array( "type" => "PieChartMarker",
														  "radius" 	=> 25,
														  "maxHeight" => 120, //seulement pour BarChartMarker
														  "options" => array('populationhommes' => array(
												                                "fillColor" => '#F0AD4E',
												                                "minValue" => 0,
												                                "maxValue" => 100,
												                                "unity" => "%",
												                                "title" => "<i class='fa fa-sun-o'></i> Population hommes"
												                            ),
																		  'populationfemmes' => array(
																                                "fillColor" => '#27B128',
																                                "minValue" => 0,
																                                "maxValue" => 100,
																                                "unity" => "%",
																                                "title" => "<i class='fa fa-sun-o'></i> Population femmes"
																                            )
												                        )

														),
								/* valeurs données à afficher */
								"chart" =>	array("type" => "FeatureCollection",
			        							  "features" => 
			        							 array(   array(  "type" => "Feature", 
									 							   "id" => 4, 
				 												   "populationhommes" => (($populationTotalHommesCity * 100) / $populationTotalCity),
				 												   "populationfemmes" => (($populationTotalFemmesCity * 100) / $populationTotalCity), 
				 												   "geometry" => array( "type" => "Point", 
				 												   						"coordinates" => array($geo['longitude'], $geo['latitude']) )), //lng 1er, lat 2em
									 
			           			  					)	
				        					),
						),
						array(  "name" => "Graph1",
								"name_text" => "Mon graphique 1",
								    /* options d'affichage de chaque donnée */
								"chartOptions"=> array( "type" => "PieChartMarker",
														  "radius" 	=> 25,
														  "maxHeight" => 120, //seulement pour BarChartMarker
														  "options" => array('ensoleillement' => array(
												                                "fillColor" => '#F0AD4E',
												                                "minValue" => 0,
												                                "maxValue" => 100,
												                                "unity" => "%",
												                                "title" => "<i class='fa fa-sun-o'></i> ensoleillement"
												                            ),
												                            'précipitations' => array(
												                                "fillColor" => '#27B128',
												                                "minValue" => 0,
												                                "maxValue" => 200,
												                                "unity" => "mm",
												                                "title" => "<i class='fa fa-umbrella'></i> précipitations"
												                            ),
												                            'vitesse du vent' => array(
												                                "fillColor" => '#1991D2',
												                                "minValue" => 0,
												                                "maxValue" => 200,
												                                "unity" => "km/h",
												                                "title" => "<i class='fa fa-sun-o'></i> vitesse du vent"
												                            )
												                        )
														),
								/* valeurs données à afficher */
								"chart" =>	array("type" => "FeatureCollection",
			        							  "features" => 
			        							 array(   array(  "type" => "Feature", 
									 							   "id" => 4, 
				 												   "ensoleillement" => 100, 
				 												   "précipitations" => 60, 
				 												   "vitesse du vent" => 60, 
				 												   "geometry" => array( "type" => "Point", 
				 												   						"coordinates" => array(55.4940, -21.34214) )), //lng 1er, lat 2em
									 
			           			  							array("type" => "Feature", 
									 							   "id" => 5, 
				 												   "ensoleillement" => 30, 
				 												   "précipitations" => 136, 
				 												   "vitesse du vent" => 150, 
				 												   "geometry" => array( "type" => "Point", 
				 												   						"coordinates" => array(55.3182, -21.06015) )), //lng 1er, lat 2em
									 
			           			  							array("type" => "Feature", 
									 							   "id" => 6, 
				 												   "ensoleillement" => 80, 
				 												   "précipitations" => 190, 
				 												   "vitesse du vent" => 200, 
				 												   "geometry" => array( "type" => "Point", 
				 												   						"coordinates" => array(55.7279, -20.95503) )), //lng 1er, lat 2em
				                       			  	)	
				        					),
				        	),
							/* 2EME GROUPE	*/
							array("name" => "Graph2",
								  "name_text" => "Mon graphique 2",
								  /* options d'affichage de chaque donnée */
								  "chartOptions"=> array( "type" => "RadialBarChartMarker",
														  "radius" 	=> 25,
														  "options" => array('ensoleillement' => array(
												                                "fillColor" => '#F0AD4E',
												                                "minValue" => 0,
												                                "maxValue" => 100,
												                                "unity" => "%",
												                                "title" => "<i class='fa fa-sun-o'></i> ensoleillement"
												                            ),
												                            'précipitations' => array(
												                                "fillColor" => '#5BC0DE',
												                                "minValue" => 0,
												                                "maxValue" => 400,
												                                "unity" => "mm",
												                                "title" => "<i class='fa fa-umbrella'></i> précipitations"
												                            )
												                        )
														),
								/* valeurs données à afficher */
								"chart" =>	array("type" => "FeatureCollection",
			        							  "features" => 
			        							 array(   array(  "type" => "Feature", 
									 							   "id" => 4, 
				 												   "ensoleillement" => 40, 
				 												   "précipitations" => 120, 
				 												   "geometry" => array( "type" => "Point", 
				 												   						"coordinates" => array(55.4940, -21.34214) )), //lng 1er, lat 2em
									 
			           			  							array("type" => "Feature", 
									 							   "id" => 5, 
				 												   "ensoleillement" => 30, 
				 												   "précipitations" => 60, 
				 												   "geometry" => array( "type" => "Point", 
				 												   						"coordinates" => array(55.3408, -21.248422) )), //lng 1er, lat 2em
									 
			           			  							array("type" => "Feature", 
									 							   "id" => 6, 
				 												   "ensoleillement" => 80, 
				 												   "précipitations" => 30, 
				 												   "geometry" => array( "type" => "Point", 
				 												   						"coordinates" => array(55.5935, -20.90756) )), //lng 1er, lat 2em
				                       			  	)	
				        					),
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

	  		<?php $this->renderPartial($relativePath.'generic/mapView', array( "sigParams" => $sigParams)); ?>

	  </div>
	</div>

<script type="text/javascript">

	var Sig;

	/**************************** DONNER UN NOM DIFFERENT A LA MAP POUR CHAQUE CARTE ******************************/
	//le nom de cette variable doit changer dans chaque vue pour éviter les conflits (+ vérifier dans la suite du script)
	var mapCity;
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

		//chargement de la carte
		mapCity = Sig.loadMap("mapCanvas", initParams);
		/**************************** CHANGER LA SOURCE DES DONNEES EN FONCTION DU CONTEXTE ***************************/
		//var mapData = contextMap;
		
		<?php 
			//transforme l'array des events pour pouvoir les parser correctement
			foreach($events as $event){ $newEvents[] = $event; }
			$contextMap = array(//"organizations" => $organizations, 
								//"events" 		=> $newEvents, 
								//"projects" 		=> $projects,
								"null"		=> null,
								"charts"	=> $charts
								 );
		?>

		/*
			$.mockjax({
				url : '/city/data',
				dataType : 'json',
				responseTime : 2000,
				responseText : {
					data : {"madata":{}}
				}
			});
		*/

		var contextMap = <?php echo json_encode($contextMap) ?>; //null;//contextMap;
		console.log("contextMap");
		console.dir(contextMap);
		/**************************************************************************************************************/
		
		//console.dir(mapData);
		//affichage des éléments sur la carte
		Sig.showMapElements(mapCity, contextMap);//, elementsMap); 

		//masque l'icone de chargement
		Sig.showIcoLoading(false);

	});

</script>
