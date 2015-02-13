<?php 
		$cs = Yii::app()->getClientScript();
		$cs->registerCssFile($this->module->assetsUrl. '/css/sig.css');
?>

<style type="text/css">
 .mapCanvasSlider{
 	width:75%;
 	height:730px;
 	margin-bottom:-730px;
 	background-color:#2A3945;
 	color:black;
 }
 #carto{
 	width: 100%;
	height: 730px !important;
	margin: 0px auto;
	color: #FFF;
 }

 /* legende / panel */
 
 .panel_map{
 	position:relative;
 	max-width:250px;
 	left:10px;
 	top:10px;
 	background-color:rgba(82, 103, 119, 0.78);
 	padding:15px 0px;
 }
 .item_panel_map{
	text-align:left !important;
	padding-left:15px;
	padding-bottom:3px;
	padding-top:3px;
 	color:white !important;
 } 
 .item_panel_map:hover{
  background-color:rgba(194, 203, 222, 0.4);
 }
 .item_panel_map.selected{
 	background-color:rgba(194, 203, 222, 0.6);
 }
 .item_panel_map.selected a{
 	text-decoration:none !important;
 	color:white !important;
 }
 .item_panel_map img{
 	padding:8px;
 	margin-top:-4px;
 }
 p.item_panel_map {
 	margin-bottom:3px;
 }
.chk_panel_map{
	margin-top:10px !important;
	float:left;
}

/* boutons */
 
.btn-group-map{
	float:left;
 	top:0px;
 	left:270px;
/*  	margin-right:2%; */
/*  	margin-bottom:10px; */
}
.btn-map{
	background-color:#E6D414;
	color:#213042 !important;
	font-size:22px !important;
}
.btn-map.playing{
	background-color:#5CB85C;
	color:white !important;
}
.btn-map:hover{
	background-color:#5896AB;
}
.btn-start-animation{
	background-color:#E6D414;
	color:#213042 !important;
}
.btn-start-animation:hover{
	background-color:#5CB85C;	
	color:white !important;
}

/* icon rechargement de la carte */
#ico_reload{
	display:inline;
	color:#E6D414;
	padding:13px;
	float:left;
	border-radius:5px;
}

/* 
#spin_loading_map{
	margin-bottom:0px;
	text-align:center !important;
	padding:0px;
	font-size:24px;
	width:100%;
	display:none;
}
  i.fa.fa-user{ color:yellow; }
  i.fa.fa-circle.red{ color:red; }
  i.fa.fa-circle.yellow{ color:yellow; }
  i.fa.fa-caret-up{ color:green; font-size:30px; }
  i.fa.fa-stop{ color:blue; }
  i.fa.fa-lightbulb-o{ color:yellow; }
  i.fa.fa-rocket{ color:yellow; }
 */
 
 .panel_map i.fa { padding:8px; }
 
 
  
/* labels msg */

#lbl_msg_animation{
	position:relative;
	width:25%;
 	max-height:500px;
 	top:-1121px;
 	float:left;
 	text-align:center;
 	background-color:rgba(82, 103, 119, 0.8);
 	padding:10px;
/*  	color:#E6D414; */
 	overflow:hidden;
 	margin-left:73%;
	display:none;
}
#lbl_msg_animation h3{
	font-size:16px;
}
#lbl_msg_animation h1{
	color:white;
	font-size:22px;
	margin-top:5px;
}

/* progress bar */

#progress-bar-anim{
	float:left;
	width:25%;
	margin-left:73%;
 	top:-1100px;
 	position:relative;
 	display:none;
}
#lbl-chk-scope{
	height:42px;
	padding-left:4% !important;
	padding-top:8px;
	width:100%;
	font-size:1.1em;
	-moz-box-shadow: inset 0px 3px 2px 0px #c0c0c0;
	-webkit-box-shadow: inset 0px 3px 2px 0px #c0c0c0;
	-o-box-shadow: inset 0px 3px 2px 0px #c0c0c0;
	box-shadow: inset 0px 3px 2px 0px #c0c0c0;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#c0c0c0, Direction=180, Strength=2);
}
</style>


			<!-- START PROJECT SECTION -->
			<div id="carto" class="section mapProject" >

			        	<div class="mapCanvasSlider" id="mapCanvasSlide1">
			        		<center><img style="margin-top:50px;" src="<?php echo $this->module->assetsUrl; ?>/images/world_pixelized.png"></center>
			            </div>
			        	
			        	<div class="panel_map">
			        	
			        			
			        		<a href="javascript:playMapAnimation('projectLeader')">
			        			<p class="item_panel_map" id="item_panel_map_projectLeader">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_PORTEUR_PROJET.png"><span class="filter_name"> Porteurs du projet</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('pixelActif')">
			        			<p class="item_panel_map" id="item_panel_map_pixelActif">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_PIXEL_ACTIF.png"><span class="filter_name"> Pixels actifs</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('commune')">
			        			<p class="item_panel_map" id="item_panel_map_commune">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_COMMUNES.png"><span class="filter_name"> Communes inscrites</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('association')">
			        			<p class="item_panel_map" id="item_panel_map_association">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_ASSOCIATIONS.png"><span class="filter_name"> Associations</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('entreprise')">
			        			<p class="item_panel_map" id="item_panel_map_entreprise">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_ENTREPRISES.png"><span class="filter_name"> Entreprises inscrites</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('citoyen')">
			        			<p class="item_panel_map" id="item_panel_map_citoyen">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_CITOYENS.png"><span class="filter_name"> Citoyens communectés</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('partnerPH')">
			        			<p class="item_panel_map" id="item_panel_map_parnerPH">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_PARTENAIRES.png"><span class="filter_name"> Partenaires & soutiens</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('artiste')">
			        			<p class="item_panel_map" id="item_panel_map_artiste">
			        			<img src="<?php echo $this->module->assetsUrl; ?>/images/markers/02_ICON_ARTISTES.png"><span class="filter_name"> Artistes actifs</span>
			        			</p>
			        		</a>
			        		<a href="javascript:playMapAnimation('all')">
			        			<p class="item_panel_map" id="item_panel_map_all">
			        			<i class="fa fa-asterisk"></i><span class="filter_name"> Tous</span>
			        			</p>
			        		</a>
			        		
			        	</div>
			        	
			        	<div id="right_tool_map">
							<!-- 	PSEUDO SEARCH -->	
							<div id="map_pseudo_filters">
								
								<div class="input-group">
										<span class="input-group-addon"> <i class="fa fa-search"></i> </span>
										<input class="form-control date-range active" type="text" id="input_name_filter" placeholder="recherche par nom">
								</div>
							</div>
							<!-- 	PSEUDO SEARCH -->	
							<!-- 	LIST ELEMENT -->	
							<div id="liste_map_element">
							</div>
							
							<label id="lbl-chk-scope">
								<input style="" value="" style="margin-left:0px;" type="checkbox" id="chk-scope" checked> Filtrer dans la zone visible
							</label>
						</div>
						
			        	<div class="btn-group btn-group-lg btn-group-map">
			        		<button type="button" class="btn btn-map" id="btn-zoom-out"><i class="fa fa-search-minus"></i></button>
			        		<button type="button" class="btn btn-map" id="btn-zoom-in"><i class="fa fa-search-plus"></i></button>
			        	</div>
			        	<div class="btn-group btn-group-lg btn-group-map">
			        		<i class="fa fa-refresh fa-spin fa-2x" id="ico_reload"></i>
			        	</div>
			        	
			        	
			</div>
			<!-- END PROJECT SECTION -->
		
<script type="text/javascript">

jQuery(document).ready(function()
{ 	
	timerLoader = setTimeout('startLoadingAnimation()', 1000); 
	//startLoadingAnimation();
	$( "#btn-play-anim" ).click(function (){ startPlaying(); });
	$( window ).resize(function() { resizeMap(); });
});



var nbScriptTotal = 4;
var nbScriptLoaded = 0;	
var timerLoader; 
function startLoadingAnimation(){
/*	
	if(nbScriptLoaded < nbScriptTotal) {
		clearTimeout(timerLoader);
		timerLoader = setTimeout('startLoadingAnimation()', 2000); 
	}
	
	nbScriptLoaded = 0;
	//$.getScript("http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js", 	function( data, textStatus, jqxhr ) { });
	$.getScript(assetPath+"/js/leaflet.js", 						function( ) {  checkLoadLib(); });
	$.getScript(assetPath+"/js/leaflet.draw-src.js", 				function( ) {  checkLoadLib(); });	
	$.getScript(assetPath+"/js/leaflet.draw.js", 					function( ) {  checkLoadLib(); });	
	$.getScript(assetPath+"/js/leaflet.markercluster-src.js", 		function( ) {  checkLoadLib(); });
	
	
}
function checkLoadLib(){ 	
	nbScriptLoaded++; 
*/
	nbScriptLoaded = 4;				
	if(nbScriptLoaded >= nbScriptTotal) {
		clearTimeout(timerLoader);
		initAll();
		$("#progress-bar-anim").css({"display":"none"});
	} 
	else { $("#progress-bar-anim").css({"display":"inline"}); }
	
	$("#progress-bar-animation").attr('aria-valuenow', (nbScriptLoaded*25) + "%");
	$("#progress-bar-animation").css({"width": (nbScriptLoaded*25) + "%" });	
}

function initAll(){
		
	$( "#btn-play" ).tooltip({ content: "lancer l'animation" });
	$( "#btn-stop" ).tooltip({ content: "arrêter l'animation" });
	
	$( "#btn-play" )		.click(function (){ startPlaying(); });
	$( "#btn-stop" )		.click(function (){ stopMapAnimation(); });
	$( "#btn-zoom-in" )		.click(function (){ zoomIn(); });
	$( "#btn-zoom-out" )	.click(function (){ zoomOut(); });
	
	$( "#input_name_filter" )	.keyup(function (){ checkListElementMap(); });

	$("#mapCanvasSlide1").html("");
	$("#mapCanvasSlide1").css({"background-color": "#456074"});

	$("#progress-bar-anim").css({"display":"none"});
	
	$("#chk-scope" ).click(function (){ checkListElementMap(); });	
	
	//charge la carte
	map1 = loadMap("mapCanvasSlide1");
	map1.setView([-21.13318, 55.5314], 10);//[30.29702, -21.97266], 3);
	elementsMap["ShowNetworkMapping"] = new Array("init");
	
	map1.on('dragend', function(e) {
    		//showMapElements(map1, "ShowNetworkMapping", elementsMap);
		});
		
	map1.on('zoomend', function(e) {
    		//showMapElements(map1, "ShowNetworkMapping", elementsMap);
		}); showMapElements(map1, "ShowNetworkMapping", elementsMap);
	
	//récupérer la position du centre de la carte, et la valeur du zoom	
	//pour établir la liste des Places de l'animation (animationPlan)
	map1.on('click', function(e) {
    		//alert(map1.getCenter() + " - " + map1.getZoom());
		}); 
	
	//lorsque la carte bouge, on vérifie la liste de droite,
	//pour n'afficher que les éléments qui sont visible sur la carte dans le nouveau bound
	map1.on('moveend', function(e) {
		checkListElementMap();
	}); 
		
			
	initAnimation();
	resizeMap();
	
	//startPlaying();
}
	
	
	//##
	//##	MAP	##
	//##
		
	var assetPath = "<?php echo $this->module->assetsUrl; ?>";
	
	//mémorise les identifiants des éléments de chaque carte
	var elementsMap = new Array();//, "getCommunected" );
	
	//liste de tous les filtres du panel
	var allTagFilter = new Array("projectLeader", "pixelActif", "commune", "association", "entreprise", "citoyen", "parnerPH", "artiste");		
	
	//gère la liste des tags à ne pas clusteriser
	var notClusteredTag = new Array("commune", "association", "projectLeader");
		
	var map1;
	function zoomIn(){ map1.zoomIn(); }
	function zoomOut(){ map1.zoomOut(); }
	
	//##
	//réduit la taille du panel d'option de la carte
	//si la largeur de l'écran est inférieur à 700px
	function resizeMap(){
		if($( "body" ).width() < 700){
			$(".filter_name").css({"display":"none"});
			$(".panel_map").css({"max-width":"60px"});
			$("#lbl_msg_animation").css({"width":"45%", "margin-left":"53%"});
			$("#progress-bar-anim").css({"width":"45%", "margin-left":"53%"});
			//$("#h3MsgAnim").css({"display":"none"});
		}
		else{
			$(".filter_name").css({"display":"inline"});
			$(".panel_map").css({"max-width":"250px"});
			$("#lbl_msg_animation").css({"width":"25%", "margin-left":"73%"});
			$("#progress-bar-anim").css({"width":"25%", "margin-left":"73%"});
			//$("#h3MsgAnim").css({"display":"inline"});
		
		}
		
		
		//full screen map
		var mapHeight = $("body").height() - $(".topbar").height() - $(".toolbar").height() - $("footer").height() - 1;
		$("#mapCanvasSlide1").css({"height":mapHeight});
		$("#mapCanvasSlide1").css({"margin-bottom":mapHeight*(-1)});
		$("#right_tool_map").css({"height":mapHeight});
		$("#liste_map_element").css({"height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ - $("#chk-scope").height() - 33 });
		$("#liste_map_element").css({"max-height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ });
		$("#right_tool_map").css({"left":$("#carto").width() - $("#right_tool_map").width()});
		$(".btn-group-map").css({"margin-top":$(".panel_map").height()*(-1) - 20});
		
	}
		
	function loadMap(canvasId){
		//initialisation des variables de départ de la carte
		var map = L.map(canvasId, { "zoomControl" : false, 
									"scrollWheelZoom":false, 
									"center" : [51.505, -0.09],
									"zoom" : 4,
									"worldCopyJump" : true });

		L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
			attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
			subdomains: 'abcd',
			minZoom: 0,
			maxZoom: 20
		}).setOpacity(0.4).addTo(map);
	
		return map;
	}								
															
	
	//##
	//affiche les citoyens qui possèdent des attributs geo.latitude, geo.longitude, depuis la BD
	var markersLayer = "";
	var geoJsonCollection = "";
	var currentFilter = "none";
	var listId = new Array();
	function showMapElements(mapClusters, origine, elementsMap){ 
			
		if(markersLayer != "")
			clearMap(mapClusters);
			
		markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 40});
		mapClusters.addLayer(markersLayer);

		geoJsonCollection = { type: 'FeatureCollection', features: new Array() };
				
		var bounds = mapClusters.getBounds();
		var params = {
			"latMinScope" :  bounds.getSouthWest().lat,
			"lngMinScope" :  bounds.getSouthWest().lng,
			"latMaxScope" :  bounds.getNorthEast().lat,
			"lngMaxScope" :  bounds.getNorthEast().lng,
			"types"		  :  new Array()			
		};
		
		if(currentFilter != "all")  params["types"].push(currentFilter); 
		else 						params["types"] = allTagFilter;
		//alert(JSON.stringify(params)); //return;
		
		$('#ico_reload').addClass("fa-spin");
		$('#ico_reload').css({"display":"inline-block"});
		
		$.ajax({
			//url:'/ph/<?php echo $this::$moduleKey?>/api/' + origine,
			url:baseUrl+'/communecter/sig/' + origine,
			data:params,
			type:"POST",
			dataType:"json",
			success:function(data) { 		//alert(JSON.stringify(data));
				$.each(data, function() { 			
					if(this._id != null){
				
						var origineName = data["origine"]; //alert(origineName);
						var objectId = this._id.$id.toString();
					
						//verifie si l'element a déjà été affiché sur la carte
						//if($.inArray(objectId, listId) == -1){							 	
							if(this['geo'] != null || this['geoPosition'] != null){
										
								//préparation du contenu de la bulle
						
								//THUMB PHOTO PROFIL
								var content = "";
								if(this['thumb_path'] != null)   
								content += 	"<div class='popup-info-profil-thumb-lbl'><img src='" + this['thumb_path'] + "' height=190 class='popup-info-profil-thumb'></div>";
								else
								content += 	"<div class='popup-info-profil-thumb-lbl'><img src='<?php echo $this->module->assetsUrl; ?>/images/thumb/default.png' width=190 class='popup-info-profil-thumb'></div>";
						
								
								//NOM DE L'UTILISATEUR
								if(this['name'] != null)   
								content += 	"<div class='popup-info-profil-username'>" + this['name'] + "</div>";
						
								//TYPE D'UTILISATEUR (CITOYEN, ASSO, PARTENAIRE, ETC)
								var typeName = this['tag'];
								if(typeName == null)  typeName = "Citoyen";
								if(this['name'] == null)  typeName += " Anonyme";
						
								content += 	"<div class='popup-info-profil-usertype'>" + typeName + "</div>";
						
								//WORK - PROFESSION
								if(this['work'] != null)     
								content += 	"<div class='popup-info-profil-work'>" + this['work'] + "</div>";
								else
								content += 	"<div class='popup-info-profil-work'>Fleuriste</div>";
								
								//URL
								if(this['url'] != null)     
								content += 	"<div class='popup-info-profil-url'>" + this['url'] + "</div>";
								else
								content += 	"<a href='http://www.google.com' class='popup-info-profil-url'>http://www.google.com</a>";
								
								//CODE POSTAL
								//if(this['cp'] != null)     
								//content += 	"<div class='popup-info-profil'>" + this['cp'] + "</div>";
								//else
								//content += 	"<div class='popup-info-profil'>98800</div>";
								
								//VILLE ET PAYS
								var place = this['city'];
								if(this['city'] != null && this['country'] != null) place += ", ";
								place += this['country'];
						
								if(this['city'] != null)     
								content += 	"<div class='popup-info-profil'>" + place + "</div>";
								else
								content += 	"<div class='popup-info-profil'>St-Denis, La Réunion</div>";
								
								//NUMÉRO DE TEL
								if(this['phoneNumber'] != null)     
								content += 	"<div class='popup-info-profil'>" + this['phoneNumber'] + "<div/>";
								else
								content += 	"<div class='popup-info-profil'>0123456789<div/>";
								
						
								//création de l'icon sur la carte
								var tag;
								if(this['type'] != null) tag = this['type'];
								else tag = "citoyen";
							
								var theIcon = getIcoMarker(tag);
								var properties = { 	//name : this['name'], 
													id : this._id.$id.toString(),
													icon : theIcon,
													content: content };
						
								var coordinates;
								if( this['geo']['longitude'] != null ){
									coordinates = new Array (this['geo']['longitude'], this['geo']['latitude']);
								}
								else{
									coordinates = this['geoPosition']['coordinates'];
								}
						
								var marker;
								//si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
								//on créé un marker simple
								if($.inArray(tag, notClusteredTag) > -1){ 
									
										coordinates = new Array (this['geo']['latitude'], this['geo']['longitude']);
										marker = getMarkerSingle(mapClusters, properties, coordinates);
							
									//si l'élément n'est pas déjà dans la liste, on recrée le marker et on l'enregistre
									if($.inArray(objectId, listId) == -1){	
										elementsMap.push(this);		
										listId.push(objectId);		
										
										//affiche l'éléments dans la liste de droite
										$("#liste_map_element").append(createItemRigthListMap(this, origineName, marker));														
										$("#item_map_list_" + this._id.$id.toString()).click(function(){
											map1.panTo(marker.getLatLng(), 
											   {"animate" : true });
											marker.openPopup();
										});
									}
								} 
								//sinon on crée un nouveau marker pour cluster
								else{
									coordinates = new Array (this['geo']['longitude'], this['geo']['latitude']);
									marker = getGeoJsonMarker(properties, coordinates);
									geoJsonCollection['features'].push(marker);	
									
									//si l'élément n'est pas déjà dans la liste, on l'enregistre
									if($.inArray(objectId, listId) == -1){	
										elementsMap.push(this);	
 										listId.push(objectId);
 										
 										//affiche l'éléments dans la liste de droite
										$("#liste_map_element").append(createItemRigthListMap(this, origineName, marker));											
	 									
	 								}
																		
								} 
								
								
							}
					}
					
				});
				
				var points = L.geoJson(geoJsonCollection, {					   //Pour les clusters seulement :
					onEachFeature: function (feature, layer) {				   //sur chaque marker
							layer.bindPopup(feature["properties"]["content"]); //ajoute la bulle d'info avec les données
							layer.setIcon(feature["properties"]["icon"]);	   //affiche l'icon demandé
							layer.on('mouseover', function(e) {	if(!layer.getPopup()._isOpen) layer.openPopup(); });
							
							//au click sur un element de la liste de droite, on zoom pour déclusturiser, et on ouvre la bulle
							$("#item_map_list_" + feature.properties.id).click(function(){
								map1.setView([feature.geometry.coordinates[1], 
											  feature.geometry.coordinates[0]], 
											  13, {"animate" : true });
								layer.openPopup();
							});
						}
					});
					
				markersLayer.addLayer(points); 			// add it to the cluster group
				mapClusters.addLayer(markersLayer);		// add it to the map
				
				//mapClusters.fitBounds(markersLayer.getBounds());					
				//mapClusters.panTo(markersLayer.getBounds().getCenter());					
				
				//$('#spin_loading_map').css({"display":"none"});
				$('#ico_reload').removeClass("fa-spin");
				$('#ico_reload').css({"display":"none"});
		
				checkListElementMap();
			},
			error:function (xhr, ajaxOptions, thrownError){
			  //toastr.error(thrownError);
			  
			} 
		  });
						
	}
	
	//##
	//créé une donnée geoJson
	function getGeoJsonMarker(properties/*json*/, coordinates/*array[lat, lng]*/) {
		properties.visible = false;
		return { "type": 'Feature',
				 "properties": properties,
				 "geometry": { type: 'Point',
							 coordinates: coordinates } };
	}

	//##
	//créer un marker sur la carte, en fonction de sa position géographique
	var markerSingleList = new Array();
	var popupOpen = false;
	function getMarkerSingle(thisMap, options, coordinates){ //ex : lat = -34.397; lng = 150.644;

		var contentString = options.content;
		if(options.content == null) contentString = "info window"; 

		var markerOptions = { icon : options.icon };

		var marker = L.marker(coordinates, markerOptions).addTo(thisMap)
		.bindPopup(contentString);
		
		markerSingleList.push(marker);
		//markersLayer.addLayer(marker);
		
		marker.on('mouseover', function(e) { 
			//if(!popupOpen) 
				marker.openPopup(); 
			//popupOpen = true;
		});
		marker.on('mouseout',  function(e) { 
			//marker.closePopup(); 
			//popupOpen = false;
		});
		
		return marker;
	}
	
	//##
	//récupère le nom de l'icon en fonction du type de marker souhaité
	function getIcoMarker(tag){
			
  		if(tag == "citoyen") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_CITOYENS.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7, 7],
												popupAnchor: 	[0, -14] });
													
		if(tag == "pixelActif") return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_PIXEL_ACTIF.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });	
																								
		if(tag == "partnerPH") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_PARTENAIRES.png'; ?>",
												iconSize: 		[14, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -14] });		
													
		if(tag == "commune") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_COMMUNES.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });		
		
		if(tag == "association") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_ASSOCIATIONS.png'; ?>",
												iconSize: 		[15, 13],
												iconAnchor: 	[7,  13],
												popupAnchor: 	[0, -13] });		
		
		if(tag == "entreprise") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_ENTREPRISES.png'; ?>",
												iconSize: 		[15, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -16] });		
		
		if(tag == "projectLeader") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_PORTEUR_PROJET.png'; ?>",
												iconSize: 		[15, 16],
												iconAnchor: 	[7,  16],
												popupAnchor: 	[0, -16] });		
		
		if(tag == "artiste") 	return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_ARTISTES.png'; ?>",
												iconSize: 		[17, 19],
												iconAnchor: 	[8,  19],
												popupAnchor: 	[0, -19] });		
		
		return L.icon({ iconUrl: "<?php echo $this->module->assetsUrl.'/images/markers/02_ICON_CITOYENS.png'; ?>",
												iconSize: 		[14, 14],
												iconAnchor: 	[7,  14],
												popupAnchor: 	[0, -14] });			  						
	}

	//##
	//recharge les marker de la carte
	function reloadMap(){ showMapElements(map1, "ShowNetworkMapping", elementsMap);  }
	
	//##
	//supprime tous les marker de la carte
	function clearMap(theMap){
		if(markersLayer != "")
			markersLayer.clearLayers();
		
		$.each(markerSingleList, function(){
			theMap.removeLayer(this);
		});
	}
	
	
	
	/**
	***		RIGHT LIST MAP ELEMENT
	***/
	//affiche dans la liste de droite seulement les éléments visibles sur la carte
	function checkListElementMap(){ 	
		//rend invisible tous les éléments de la liste (mais ne les supprime pas)
		$.each(elementsMap, function() { 
			$("#item_map_list_" + this._id.$id.toString()).css({ "display" : "none" });				
		});
		
		var showElementOutOfMapView = !$("#chk-scope").is(':checked');
				
		//rend visible tous les éléments qui se trouve dans le bound visible de la carte
		$.each(elementsMap, 
			function() { 	
				var bounds = map1.getBounds();
				
				if( this.type == currentFilter || currentFilter == "all"){								
				if( (this.geo.longitude > bounds.getSouthWest().lng && this.geo.longitude < bounds.getNorthEast().lng && 
					this.geo.latitude > bounds.getSouthWest().lat && this.geo.latitude < bounds.getNorthEast().lat) 
					|| showElementOutOfMapView)
					{	
						//si le champ de recherche par userName est rempli (n'est pas vide)
						if(this.name != null && $('#input_name_filter').val() != "") {
							//on affiche l'élément seulement s'il correspond à la recherche
							if(this.name.search(new RegExp($('#input_name_filter').val(), "i")) >= 0){
								$("#item_map_list_" + this._id.$id.toString()).css({ "display" : "inline" });	
							}	
						}
						else //si le champs de recherche est vide, on affiche l'élément
						{
							$("#item_map_list_" + this._id.$id.toString()).css({"display" : "inline" });	
					 	}
					 }
				}
			});
				
	}
	
	//***
	//renvoi un item (html) pour la liste de droite
	function createItemRigthListMap(element, origine, marker){
		
		//joint le nom de la ville au CP
		var place = "";
		if(element['city'] != null) place += element['city'];
		if(element['city'] != null && element['cp'] != null) place += ", ";	
		if(element['cp'] != null) place += element['cp'];
		
		//prépare le nom (ou "anonyme")
		var name = (element['name'] != null) ? element['name'] : "Anonyme";
		
		//récupère l'url de l'icon a afficher
		var iconUrl = getIcoMarker(element['type']).options.iconUrl;
		
		//return l'élément html
		return '<a id="item_map_list_'+ element._id.$id.toString() +'" href="#" class="item_map_list">' 
						+  '<img class="ico_item_map_list" src="' + iconUrl + '" height=14>'
						+  '<div class="pseudo_item_map_list">' +	name + "</div>"	
						+  '<div class="city_item_map_list">' +	place + "</div>"	
				+  '</a>';	
		
		
	}
	
	
	
	
	//##
	//##	PANEL FILTER	##
	//##
	
	function changeFilter(val){ 	
		
		//if(val == currentFilter) return;
	
		if(currentFilter != "")
			$('#item_panel_map_' + currentFilter).removeClass("selected");	
				
		$('#item_panel_map_' + val).addClass("selected");
		currentFilter = val;	
		showMapElements(map1, "ShowNetworkMapping", elementsMap);	
	}		
	
	
	//##
	//##	MAP PLAYER	##
	//##
	
	
	var timerMapPlay;// = setTimeout('playMapAnimation()', 5000); 
	var allowToPlay = false;
	//##
	//liste de lieux à utiliser pendant l'animation
	var animationPlaces = { 
			"france" : 			{ "latlng" : [47.72454, -0.57129], 		"zoom" : 5 }, 
			"reunion" : 		{ "latlng" : [-21.20874, 55.49057], 	"zoom" : 10 },  
			"caledonie" : 		{ "latlng" : [-20.94092, 165.75623], 	"zoom" : 7 },  
			"new_zeland" : 		{ "latlng" : [-42.1634, 171.67236], 	"zoom" : 5 },   
			"australia" : 		{ "latlng" : [-30.90222, 133.5498], 	"zoom" : 6 },   
			"north_america" : 	{ "latlng" : [40.9799, -87.80273], 		"zoom" : 4 },   
			"south_america" : 	{ "latlng" : [-22.1874, -56.7334], 		"zoom" : 4 },   
			"world" : 			{ "latlng" : [33.72434, 18.10547], 		"zoom" : 2 },  
	};
	
	//##
	//liste des étapes de l'animation
	var animationPlan = {
		"projectLeader" : 	{ 	"places" : [ { "place" : animationPlaces.reunion,  
							  					"msg" : "Message pour les porteurs de projets de la Réunion" }	
											],
								"title" : "Les porteurs du projet",
								"icon" : { "color" : "#E6D414",
										   "name" : "user" }
							},
		"pixelActif" : 		{ 	"places" : [ { "place" : animationPlaces.reunion, 
											   "msg" : "Message pour les pixels actifs de la réunion..." },
											 { "place" : animationPlaces.france, 
											   "msg" : "Message pour les pixels actifs de France" } ,
											 { "place" : animationPlaces.caledonie, 
											   "msg" : "Message pour les pixels actifs de Nouvelle-Calédonie" } 
											], 
								"title" : "Les Pixels actifs",
								"icon" : { "color" : "#E6D414",
										   "name" : "circle" }
							},	
		"commune" : 		{ 	"places" : [  { "place" : animationPlaces.france,
												"msg" : "Message pour les communes de France" },
											  { "place" :  animationPlaces.reunion ,
											    "msg" : "Message pour les communes de la Réunion" }
											],
								"title" : "Les communes",
								"icon" : { "color" : "#BD3232",
										   "name" : "circle" }
							},
		"association" : 	{ 	"places" : [ { "place" : animationPlaces.france, 
												"msg" : "Message pour les associations de France" },
											 {  "place" : animationPlaces.reunion, 
											    "msg" : "Message pour les associations de la Réunion" },
											{  "place" : animationPlaces.new_zeland, 
											   "msg" : "Message pour les associations de Nouvelle-Zélande" }
											],
								"title" : "Les associations",
								"icon" : { "color" : "#92BE1F",
										   "name" : "play fa-rotate-270" }
							},	
		"entreprise" : 	{ 		"places" : [ { 	"place" : animationPlaces.france, 
												"msg" : "Message pour les entrerprises de France" },
										 	{ 	"place" : animationPlaces.australia, 
												"msg" : "Message pour les entrerprises d'Australie" }
										],
								"title" : "Les entreprises",
								"icon" : { "color" : "#04B8EC",
										   "name" : "stop" }
							},	
		"citoyen" : 	{ 	"places" : [ { 	"place" : animationPlaces.south_america, 
											"msg" : "Message pour les citoyens communectés en Amérique du Sud" },
										 { 	"place" : animationPlaces.north_america, 
											"msg" : "Message pour les citoyens communectés en Amérique du Nord" }
										],
							"title" : "Les citoyens communectés",
							"icon" : {  "color" : "#E6D414",
										"name" : "circle" }
							},	
		"partnerPH" : 	{ 	"places" : [ { 	"place" : animationPlaces.france, 
											"msg" : "Message pour les partenaires de France" },
										 { 	"place" : animationPlaces.world, 
											"msg" : "Message pour les partenaires du monde entier" }
										],
							"title" : "Nos partenaires et soutiens",
							"icon" : {  "color" : "#E6D414",
										"name" : "lightbulb-o" }
							},	
		"artiste" : 	{ 	"places" : [ { 	"place" : animationPlaces.france, 
											"msg" : "Message pour les artistes de France" },
										 { 	"place" : animationPlaces.world, 
											"msg" : "Message pour les artistes du monde entier" }
										],
								"title" : "Les artistes",
								"icon" : { "color" : "#E6D414",
										   "name" : "rocket" }
							},	
		"all" : 	{ 	"places" : [ { 	"place" : animationPlaces.world, 
										"msg" : "Message final pour le monde entier" },
									 {	"place" : animationPlaces.world, 
										"msg" : "Message final pour le monde entier" },
										
									],
									"title" : "Tous",
									"icon" : { "color" : "white",
										   "name" : "asterisk" }
							},	
	
	}
	
	//##
	//initialisation de l'animation
	var allTagAnimation = new Array();
	function initAnimation(){
		$.each(animationPlan, function (key){
			allTagAnimation.push(key);
		});
		//timerMapPlay = setTimeout('playMapAnimation()', 10000); 
	}
	
	function startPlaying(){
		//si les script js ne sont pas encore chargé, il faut les charger d'abord
		if(nbScriptLoaded < nbScriptTotal) 
			{ startLoadingAnimation(); return; }
		
		
		if(allowToPlay == false){
			allowToPlay = true;	
						
			map1.scrollWheelZoom.enable();
			
			cntTime = 10;
			playMapAnimation();
		}
	}
	
	//##
	//fonction appelé par timeout pour faire avancer l'animation d'une étape à chaque fois
	var cntTime = 10;	 //compteur de temps, pour faire défiler l'animation et la progress-bar (init 10 pour lancer l'anim tout de suite)
	var cntTimeMax = 10; //nombre de secondes entre chaque étape de l'animation
	
	var cntTag = 0;		//pour changer les filtres pendant l'animation
	var cntPlaces = 0;	//pour changer de lieu pendant l'animation
	
	var currentTag = "";
	
	function playMapAnimation(newTag)
	{
		
		//si le temps n'est pas écoulé ET qu'on ne change pas de filtre
		if(cntTime < cntTimeMax && newTag == null) { 
			//avance le temps
			cntTime++; 
			//éteint le timer
			clearTimeout(timerMapPlay);
			//relance le timer 
			timerMapPlay = setTimeout('playMapAnimation()', 1000); 
			//fait avancer la progress-bar
			$("#progress-bar-animation").attr('aria-valuenow', (cntTime*10) + "%");
			$("#progress-bar-animation").css({"width": (cntTime*10) + "%"});
			//et stop ici
			return; 
		} 
		
		//remet à zéro le compteur de temps
		cntTime = 0;
		//récupère le nom du tag correspondant à la valeur du 	
		currentTag = allTagAnimation[cntTag];
		
		//si on change de filtre
		if(newTag != null) { 
			//actualise le nom du filtre courant
			currentTag = newTag;
			//lance le nouveau filtre sur le premier lieu de la liste (!)
			cntPlaces = 0; 
			//récupère la valeur numérique du nouveau filtre
			var i=0;
			$.each(allTagAnimation, function(){
				if(this == newTag) cntTag = i;
				i++;
			});
		} //alert(cntTag + " - " + currentTag + " - " + cntPlaces);
		
		//récupère les données du lieu à afficher
		var currentPlace = animationPlan[currentTag].places[cntPlaces].place;
		
		//récupère la valeur du zoom à afficher	
		var zoom = currentPlace.zoom
		//si la fenêtre mesure moins de 700px de large, on recule le zoom de 1 niveau
		if($( "body" ).width() < 700) zoom = zoom-1;
		
		//si l'utilisateur n'a pas cliqué sur pause : allowToPlay = true
		if(allowToPlay){
			
			//active le bouton play (vert)
			$("#btn-play").addClass("playing");
		
			//affiche le message et la progress-bar
			$("#lbl_msg_animation").css({"display":"inline"});
			$("#progress-bar-anim").css({"display":"inline"});
			
			//modifie la valeur du zoom de la carte (sans animation pour éviter quelques bugs)
			map1.setZoom(zoom, { "animate" : false });
			//déplace le centre de la carte jusqu'au lieu en cours
			map1.panTo(currentPlace.latlng);
		
			//création du header du message à afficher
			var txtMsg = "<h1><i class='fa fa-" + animationPlan[currentTag].icon.name + " fa-3x' "+
								 "style='color:"+animationPlan[currentTag].icon.color+"'>"+
							  "</i>" + 
							  "</br>" + 
							  animationPlan[currentTag].title + 
						 "</h1>";
			
			var style = "";
			//si la fenêtre mesure moins de 700px de large, efface le message
			if($( "body" ).width() < 700) style = "style='display:none;'";
			
			//création du corp du message (invisible si width() < 700)
			txtMsg += "<h3 id='h3MsgAnim' "+style+">"+
						animationPlan[currentTag].places[cntPlaces].msg +
						"</h3>" + 
						"<br> <br>";
					 
			//affiche le message		 
			$("#lbl_msg_animation").html(txtMsg);
			$("#lbl_msg_animation").css({"display":"inline"});
			
			//demande l'actualisation des markers de la carte (avec le filtre en cours)
			changeFilter(currentTag);
		
			//avance d'un lieu
			cntPlaces++;
			//si c'est le dernier lieu de la liste pour le filtre en cours
			if(cntPlaces >= animationPlan[currentTag].places.length){
				//réinitialise le compteur de lieu
				cntPlaces = 0;
				//avance d'un filtre
				cntTag++;
			}
			//si c'est le dernier compteur de filtre
			if(cntTag >= allTagAnimation.length){
				//réinitialise tout
				cntPlaces = 0;
				cntTag = 0;
				//arrête l'animation
				stopMapAnimation();
				//et quitte
				return;
			}
		
			//relance le timer
			clearTimeout(timerMapPlay);
			timerMapPlay = setTimeout('playMapAnimation()', 1000); 
		}
		else{ 
			//demande l'actualisation des markers de la carte (avec le filtre en cours)
			changeFilter(currentTag);
		}
	}
	
	function stopMapAnimation(){ 
		allowToPlay = false;
		clearTimeout(timerMapPlay);
		 
		$("#btn-play").removeClass("playing");
		$("#lbl_msg_animation").css({"display":"none"});
		
		$("#progress-bar-anim").css({"display":"none"});
		$("#progress-bar-animation").attr('aria-valuenow',  "10%");
		$("#progress-bar-animation").css({"width": "10%"});
	}
</script>		