
			<!-- START PROJECT SECTION -->
			<div id="carto" class="section mapProject" >

			        	<div class="mapCanvas" id="mapCanvas">
			        		<center><img style="margin-top:50px;" src="<?php echo $this->module->assetsUrl; ?>/images/world_pixelized.png"></center>
			            </div>
			        	
			        	<div class="panel_map">
			        		<p class="item_panel_map" id="item_panel_map_'.$tag["name"].'">
			        			<span>
			        			<center><i>NetworkMapping 
			        			</br>Collection Groups
			        			</br>Name = "Asso1"
			        			</i><center>
			        			</span>
			        		</p>
			        		<?php 
			        				$where = array(	'name'  => "asso1" );
									$assos = PHDB::find(PHType::TYPE_GROUPS, $where);
									
									foreach($assos as $asso){
										foreach($asso["tags_rangement"] as $tag)
										echo '<a href="javascript:changeFilter(\''.$tag["name"].'\')">
			        							<p class="item_panel_map" id="item_panel_map_'.$tag["name"].'">
			        							<i class="fa fa-'.$tag["ico"].' fa-'.$tag["color"].'"></i><span class="filter_name"> '.$tag["name"].'</span>
			        							</p>
			        						  </a>';			        						  
									}
			        		?>

			        		<button type="button" class="btn btn-default" id="btn-init-data"><i class="fa fa-database"></i>Initialiser les données</button>
			        		
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
								<input style="" value="" style="margin-left:0px;" type="checkbox" id="chk-scope"> Filtrer dans la zone visible
							</label>
						</div>
						
			        	<div class="btn-group btn-group-lg btn-group-map">
			        		<button type="button" class="btn btn-map" id="btn-zoom-out"><i class="fa fa-search-minus"></i></button>
			        		<button type="button" class="btn btn-map" id="btn-zoom-in"><i class="fa fa-search-plus"></i></button>
			        	</div>
			        	<div class="btn-group btn-group-lg btn-group-map" style="left:390px">
			        		<i class="fa fa-refresh fa-spin fa-2x" id="ico_reload"></i>
			        	</div>
			        	
			        	
			</div>
			<!-- END PROJECT SECTION -->
		
<script type="text/javascript">

var organizationName = "asso1";
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
			map1.setView([-21.13318, 55.5314], 10);
			elementsMap = new Array();
	
			map1.on('dragend', function(e) {
					//showMapElements(map1, elementsMap);
				});
		
			map1.on('zoomend', function(e) {
					//showMapElements(map1, elementsMap);
				}); showMapElements(map1, elementsMap);
	
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
			$("#ico_reload").css({"display":"none"});
		});
	}); 
	}); 
	
});
	
	
	//##
	//##	MAP	##
	//##
		
	
	//liste de tous les filtres du panel
	//var allTagFilter = new Array("projectLeader", "pixelActif", "commune", "association", "entreprise", "citoyen", "parnerPH", "artiste");		
	
	//gère la liste des tags à ne pas clusteriser
	var notClusteredTag = new Array("commune", "association", "projectLeader");
		
	var map1;
	function zoomIn(){ map1.zoomIn(); }
	function zoomOut(){ map1.zoomOut(); }
	
	//##
	//gère les dimensions des différentes parties de la carte (carte, panel, etc)
	function resizeMap(){
	
		//quand la taille de la fenetre est inférieur à 700px, on réduit la taille du panel
		if($( "body" ).width() < 700){
			$(".filter_name").css({"display":"none"});
			$(".panel_map").css({"max-width":"60px"});
		}
		else{
			$(".filter_name").css({"display":"inline"});
			$(".panel_map").css({"max-width":"250px"});
		}
				
		//full screen map
		var mapHeight = $("body").height() - $(".topbar").height() - $(".toolbar").height() - $("footer").height() - 1;
		$("#mapCanvas").css({"height":mapHeight});
		$("#mapCanvas").css({"margin-bottom":mapHeight*(-1)});
		$("#right_tool_map").css({"height":mapHeight});
		$("#liste_map_element").css({"height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ - $("#chk-scope").height() - 33 });
		$("#liste_map_element").css({"max-height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ });
		$("#right_tool_map").css({"left":$("#carto").width() - $("#right_tool_map").width()});
		$(".btn-group-map").css({"margin-top":$(".panel_map").height()*(-1) - 20});
		
	}
		
												
	
	//##
	//affiche les citoyens qui possèdent des attributs geo.latitude, geo.longitude, depuis la BD	
	function showMapElements(mapClusters, elementsMap){ 
			
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
			"assoName"	  :  organizationName,
			"types"		  :  new Array()			
		};
		
		if(currentFilter != "all")  params["types"].push(currentFilter); 
		else 						params["types"] = allTagFilter;
		//alert(JSON.stringify(params)); //return;
		
		$('#ico_reload').addClass("fa-spin");
		$('#ico_reload').css({"display":"inline-block"});
		
		$.ajax({
			//url:'/ph/<?php echo $this::$moduleKey?>/api/',
			url:baseUrl+'/communecter/sig/ShowNetworkMapping',
			data:params,
			type:"POST",
			dataType:"json",
			success:function(data) {  			//alert(JSON.stringify(data));
				$.each(data, function() { 		//alert(JSON.stringify(this._id));
						
					if(this._id != null){
				
						var objectId = this._id.$id.toString();
								
						//verifie si l'element a déjà été affiché sur la carte
						//if($.inArray(objectId, listId) == -1){							 	
						if(this['geo'] != null || this['geoPosition'] != null){
									
							//préparation du contenu de la bulle
					
							//THUMB PHOTO PROFIL
							var content = getPopupCitoyen(this);
						
							//création de l'icon sur la carte
							var tag;
							if(this['type'] != null) tag = this['type'];
							else tag = "citoyen";
						
							//alert(JSON.stringify(this));
							var theIcon = getIcoMarker(this['ico'], this['color']);
							var properties = { 	//name : this['name'], 
												id : objectId,
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
								
								marker = getMarkerSingle(mapClusters, properties, coordinates);
						
								//si l'élément n'est pas déjà dans la liste, on recrée le marker et on l'enregistre
								if($.inArray(objectId, listId) == -1){	
									elementsMap.push(this);		
									listId.push(objectId);		
									
									//affiche l'éléments dans la liste de droite
									$("#liste_map_element").append(createItemRigthListMap(this, marker));														
									//ajoute l'événement click sur l'élément de la liste, pour ouvrir la bulle du marker correspondant
									$("#item_map_list_" + objectId).click(function(){
										map1.panTo(marker.getLatLng(), {"animate" : true });
										marker.openPopup();
									});
								}
							} 
							//sinon on crée un nouveau marker pour cluster
							else{
								
								marker = getGeoJsonMarker(properties, coordinates);
								geoJsonCollection['features'].push(marker);	
																
								//si l'élément n'est pas déjà dans la liste, on l'enregistre
								if($.inArray(objectId, listId) == -1){	
									
									elementsMap.push(this);	
									listId.push(objectId);
									
									//affiche l'éléments dans la liste de droite
									$("#liste_map_element").append(createItemRigthListMap(this, marker));							
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
				
				mapClusters.fitBounds(markersLayer.getBounds());					
				mapClusters.panTo(markersLayer.getBounds().getCenter());					
				
				//$('#spin_loading_map').css({"display":"none"});
				$('#ico_reload').removeClass("fa-spin");
				$('#ico_reload').css({"display":"none"});
		
				checkListElementMap(mapClusters);
			},
			error:function (xhr, ajaxOptions, thrownError){
			  //toastr.error(thrownError);
			  
			} 
		  });
						
	}
	
	
		
	//##
	//##	PANEL FILTER	##
	//##
	
	function changeFilter(val){ 
		if(currentFilter != "")
			$('#item_panel_map_' + currentFilter).removeClass("selected");	
				
		$('#item_panel_map_' + val).addClass("selected");
		currentFilter = val;	
		showMapElements(map1, elementsMap);	
	}		
	
	
	//##
	//##	INIT DATA	##
	//##	
	function initDataNetworkMapping(){
		var params = new Array();
		$.ajax({
			url:baseUrl+'/communecter/sig/InitDataNetworkMapping',
			data:params,
			type:"POST",
			dataType:"json",
			success:function(data) { 	
				toastr.success(data);
			}
		});
	}
</script>		