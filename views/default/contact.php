<?php	
		/**
		* 	LIB SIG
		**/
		/*
		$cs = Yii::app()->getClientScript();

		$cs->registerCssFile(Yii::app()->request->baseUrl. '/css/vis.css');
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
		$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/vis.min.js' , CClientScript::POS_END);

		$cs->registerCssFile("http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
		//$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.draw.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.draw.ie.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/MarkerCluster.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/MarkerCluster.Default.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/leaflet/leaflet.awesome-markers.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/sig.css');
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig/sig_contacts.css');
		
		//$cs->registerScriptFile('http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.draw-src.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.draw.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.markercluster-src.js' , CClientScript::POS_END);
		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/leaflet/leaflet.awesome-markers.min.js' , CClientScript::POS_END);

		$cs->registerScriptFile($this->module->assetsUrl.'/js/sig/map.js' , CClientScript::POS_END);
		*/
?>

<style>
	.container{
		padding:0px;
	}
	.toolbar{
	margin:0px;
	}
	.leaflet-marker-pane i{
 	font-size:35px;
 	}
 
</style>
<!--
<div class="mapCanvas" id="mapCanvas" style="background-color:white;">
	<center><img style="margin-top:50px;" src="<?php echo $this->module->assetsUrl; ?>/images/world_pixelized.png"></center>
</div> 

<div class="btn-group btn-group-lg btn-group-map">
	<button type="button" class="btn btn-map" id="btn-zoom-out"><i class="fa fa-search-minus"></i></button>
	<button type="button" class="btn btn-map" id="btn-zoom-in"><i class="fa fa-search-plus"></i></button>
</div>
-->			        	
<script type="text/javascript">
/*
//var organizationName = "asso1";
var map1;
var assetPath = "<?php echo $this->module->assetsUrl; ?>";

jQuery(document).ready(function()
{ 		
	$.getScript(assetPath+"/js/sig/map.js", function( ) { 
		$.getScript(assetPath+"/js/sig/popupContent.js", function( ) { 
			$.getScript(assetPath+"/js/sig/rightList.js", function( ) { 
			
			$( "#btn-zoom-in" )		.click(function (){ zoomIn(); });
			$( "#btn-zoom-out" )	.click(function (){ zoomOut(); });
	
			$( "#btn-init-data" )	.click(function (){ initDataNetworkMapping(); });
	
			$( "#input_name_filter" ).keyup(function (){ checkListElementMap(map1); });

			$("#mapCanvas").html("");
			$("#mapCanvas").css({"background-color": "#456074"});

			$("#chk-scope" ).click(function (){ checkListElementMap(map1); });	
	
			$( window ).resize(function() { resizeMap(); });
	
			//charge la carte
			map1 = loadMap("mapCanvas");
			//map1.setView([14.60485, 15.46875], 2);
			elementsMap = new Array();
	
			map1.on('dragend', function(e) {
					//showMapElements(map1, elementsMap);
				});
		
			map1.on('zoomend', function(e) {
					//showMapElements(map1, elementsMap);
				}); 
			//showMapElements(map1, elementsMap);
	
			//récupérer la position du centre de la carte, et la valeur du zoom	
			//pour établir la liste des Places de l'animation (animationPlan)
			map1.on('click', function(e) {
					//alert(map1.getCenter() + " - " + map1.getZoom());
				}); 
	
			//lorsque la carte bouge, on vérifie la liste de droite,
			//pour n'afficher que les éléments qui sont visible sur la carte dans le nouveau bound
			map1.on('moveend', function(e) {
				checkListElementMap(map1);
			}); 
	
			resizeMap();
			showContactsOnMap();
			
			$("#ico_reload").css({"display":"none"});
		});
		}); 
	}); 
	
});
	
	
	//##
	//##	MAP	##
	//##
		
		
	var map1;
	function zoomIn(){ map1.zoomIn(); }
	function zoomOut(){ map1.zoomOut(); }
	
	//##
	//chargement de la carte 
	function loadMap(canvasId){
		//initialisation des variables de départ de la carte
		var map = L.map(canvasId, { "zoomControl" : false, 
									"scrollWheelZoom":false, 
									"center" : [39.90974, 6.85547],
									"zoom" : 3,
									"worldCopyJump" : true });


		tileLayer = L.tileLayer('http://a{s}.acetate.geoiq.com/tiles/acetate-base/{z}/{x}/{y}.png', {
			attribution: '&copy;2012 Esri & Stamen, Data from OSM and Natural Earth',
			subdomains: '0123',
			minZoom: 3,
			maxZoom: 18
		}).addTo(map);



		return map;
	}								

	//##
	//gère les dimensions des différentes parties de la carte (carte, panel, etc)
	function resizeMap(){
	
		/*
		//quand la taille de la fenetre est inférieur à 700px, on réduit la taille du panel
		if($( "body" ).width() < 700){
			$(".filter_name").css({"display":"none"});
			$(".panel_map").css({"max-width":"60px"});
		}
		else{
			$(".filter_name").css({"display":"inline"});
			$(".panel_map").css({"max-width":"250px"});
		}
		* /
				
		//full screen map
		var mapHeight = $("body").height() - $(".top-navbar").height() - $(".toolbar").height() - $("footer").height() - 1;
		
		$("#mapCanvas").css({"height":mapHeight});
		$("#mapCanvas").css({"margin-bottom":mapHeight*(-1)});
		//$("#right_tool_map").css({"height":mapHeight});
		//$("#liste_map_element").css({"height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding* / - $("#chk-scope").height() - 33 });
		//$("#liste_map_element").css({"max-height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding* / });
		// $("#right_tool_map").css({"left":$("#carto").width() - $("#right_tool_map").width()});
		//$(".btn-group-map").css({"margin-top":$(".panel_map").height()*(-1) - 20});
		
	}
	
	
	
	//liste de tous les contacts
	var contactsPH = [ { 	"name" : "Tibor", 
							"geo" : {	"longitude" : -21.2857 ,
										"latitude" : 55.50945
									},
							"phoneNumber" : "+262 692 34 56 78",
							"mail" : "contact@pixelhumain.com",
							"city" : "La Réunion",
							"ico" : "map-marker",
							"color" : "red"
						},
						{ 	"name" : "Luc", 
							"geo" : {	"longitude" : 43.21318 ,
										"latitude" : 3.43872 , 
									},
							"phoneNumber" : "+262 692 34 56 78",
							"mail" : "contact@pixelhumain.com",
							"city" : "Montpellier",
							"ico" : "map-marker",
							"color" : "red"
						}
					 ];
					 
	function showContactsOnMap(){
		$.each(contactsPH, function(){
			
			var content = getPopupCitoyen(this);
			var theIcon = getIcoMarker(this['ico'], this['color']);
			
			var properties = { 	icon : theIcon,
								content: content };
	
			var coordinates = new Array (this['geo']['longitude'], this['geo']['latitude']);
		
			
			var marker = getMarkerSingle(map1, properties, coordinates);
			
		});
	}
	
	*/
</script>