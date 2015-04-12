
	//variable qui permet de charger une instance Sig différente à chaque éxecution
	var SigLoader = new Array();
	
		SigLoader.getSig = function (){ 
			
			this.Sig = new Array();
			
			this.Sig.markersLayer = "";
			
			this.Sig.geoJsonCollection = "";
			
			this.Sig.initParmerters = "";
			
			this.Sig.cssModuleName = "";
			
			this.Sig.currentFilter = "none";
			
			//mémorise les identifiants des éléments de chaque carte
			this.Sig.listId = new Array();
			
			//mémorise les éléments
			this.Sig.elementsMap = new Array();
			
			//##
			//créer un marker sur la carte, en fonction de sa position géographique
			this.Sig.markerSingleList = new Array();
			this.Sig.popupOpen = false;
										
		
			//##
			//créé une donnée GeoJson (pour les cluster)
			this.Sig.getGeoJsonMarker = function (properties/*json*/, coordinates/*array[lat, lng]*/) 
			{
				properties.visible = false;
				//alert(JSON.stringify(properties));
				return { "type": 'Feature',
						 "properties": properties,
						 "geometry": { type: 'Point',
									 coordinates: coordinates } };
			};
		
			
			//##
			//créé un objet L.Marker (sans cluster)
			this.Sig.getMarkerSingle = function(thisMap, options, coordinates)
			{ 
				var contentString = options.content;
				if(options.content == null) contentString = "info window"; 
		
				var markerOptions = { icon : options.icon };
		
				var marker = L.marker(coordinates, markerOptions).addTo(thisMap)
																 .bindPopup(contentString);
				
				this.markerSingleList.push(marker);
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
			};
			
			//##
			//récupère le nom de l'icon en fonction du type de marker souhaité
			this.Sig.getIcoMarker = function(thisData)
			{	
				if(thisData != undefined) 
				{
					var ico 	= thisData['ico'] ? thisData['ico'] : "circle";
					var color 	= thisData['color'] ? thisData['color'] : "blue";
				}
				else{
					var ico 	= "circle";
					var color 	= "yellow";
				}
				
				return L.AwesomeMarkers.icon({icon: ico + " fa-" + color, iconColor:color, prefix: 'fa' });	
			};
		
		
			//##
			//supprime tous les marker de la carte
			this.Sig.clearMap = function(thisMap)
			{
				if(this.markersLayer != "")
					this.markersLayer.clearLayers();
				
				$.each(this.markerSingleList, function(){
					thisMap.removeLayer(this);
				});
			};
			
			
			//##
			//gère les dimensions des différentes parties de la carte (carte, panel, etc)
			this.Sig.resizeMap = function()
			{
				return;
				//full screen map
				var mapHeight = $("body").height() - $(".topbar").height() - $(".toolbar").height() - $("footer").height() - 1;
				$("#mapCanvas").css({"height":mapHeight});
				$("#mapCanvas").css({"margin-bottom":mapHeight*(-1)});
				$("#right_tool_map").css({"height":mapHeight});
				$("#liste_map_element").css({"height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ - $("#chk-scope").height() - 33 });
				$("#liste_map_element").css({"max-height":mapHeight - $("#map_pseudo_filters").height() - 8*2 /*padding*/ });
				$("#right_tool_map").css({"left":$("#carto").width() - $("#right_tool_map").width()});
				$(".btn-group-map").css({"margin-top":$(".panel_map").height()*(-1) - 20});
				
			};
			
			this.Sig.showMapElements = function(thisMap, data)//, elementsMap)
			{ 
				//alert(JSON.stringify(data));
				//efface les elements de la carte si elle n'est pas vide
				if(this.markersLayer != "") this.clearMap(thisMap);
				
				//conteneur de marker cluster	
				this.markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 40});
				thisMap.addLayer(this.markersLayer);
		
				//collection de marker geojson
				this.geoJsonCollection = { type: 'FeatureCollection', features: new Array() };
				
				//récupère les bounds de la carte
				var bounds = thisMap.getBounds();
				//et créé les paramètres 
				var params = {
					"latMinScope" :  bounds.getSouthWest().lat,
					"lngMinScope" :  bounds.getSouthWest().lng,
					"latMaxScope" :  bounds.getNorthEast().lat,
					"lngMaxScope" :  bounds.getNorthEast().lng,
					"types"		  :  new Array()			
				};
				
				if(this.currentFilter != "all")  params["types"].push(this.currentFilter); 
				else 							 params["types"] = allTagFilter;
				//alert(JSON.stringify(params)); //return;
				
				$('#ico_reload').addClass("fa-spin");
				$('#ico_reload').css({"display":"inline-block"});
				//alert("data : " + JSON.stringify(data));
				
				var thisSig = this;				
				//alert("data : " + JSON.stringify(data));	
				$.each(data, function(i, thisData) 
				{ 	
					//alert("element : " + JSON.stringify(thisData));	
					if(thisData._id != null)
					{ 
						//recupere l'id de l'élément à afficher
						var objectId = thisData._id.$id.toString();
						
						//si on a une position geo						 	
						if(thisData['geo'] != null || thisData['geoPosition'] != null){
									
							//préparation du contenu de la bulle
							var content = thisSig.getPopupCitoyen(thisData);
						
							//définition du type de marker a afficher
							var tag;
							if(thisData['type'] != null) tag = thisData['type'];
							else tag = "citoyen";
						
							//création de l'icon sur la carte
							//alert(JSON.stringify(thisData));
							var theIcon = thisSig.getIcoMarker(thisData);
							var properties = { 	id : objectId,
												icon : theIcon,
												content: content };
					
							var coordinates;
							if( thisData['geo']['longitude'] != null ){
								coordinates = new Array (thisData['geo']['longitude'], thisData['geo']['latitude']);
							}
							else{
								coordinates = thisData['geoPosition']['coordinates'];
							}
							
							var marker;
							//si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
							//on créé un marker simple
							if($.inArray(tag, thisSig.notClusteredTag) > -1){ 
								
								marker = thisSig.getMarkerSingle(thisMap, properties, coordinates);
						
								//si l'élément n'est pas déjà dans la liste, on recrée le marker et on l'enregistre
								if($.inArray(objectId, thisSig.listId) == -1){	
									thisSig.elementsMap.push(thisData);		
									thisSig.listId.push(objectId);		
									
									//affiche l'éléments dans la liste de droite
									$("#liste_map_element").append(thisSig.createItemRigthListMap(thisData, marker));
									//alert(objectId);														
									//ajoute l'événement click sur l'élément de la liste, pour ouvrir la bulle du marker correspondant
									$("#item_map_list_" + objectId).click(function(){
										thisMap.panTo(marker.getLatLng(), {"animate" : true });
										this.checkListElementMap(thisMap);
										marker.openPopup();
									});
								}
							} 
							//sinon on crée un nouveau marker pour cluster
							else{
								
								marker = thisSig.getGeoJsonMarker(properties, coordinates);
								thisSig.geoJsonCollection['features'].push(marker);	
																
								//si l'élément n'est pas déjà dans la liste, on l'enregistre
								if($.inArray(objectId, thisSig.listId) == -1){	
									
									thisSig.elementsMap.push(thisData);	
									thisSig.listId.push(objectId);
									
									//affiche l'éléments dans la liste de droite
									$(thisSig.cssModuleName + " #liste_map_element").append(thisSig.createItemRigthListMap(thisData, marker));							
								}
																	
							} 								

						}
					}	
					var points = L.geoJson(thisSig.geoJsonCollection, {			//Pour les clusters seulement :
						onEachFeature: function (feature, layer) {				//sur chaque marker
							layer.bindPopup(feature["properties"]["content"]); 	//ajoute la bulle d'info avec les données
							layer.setIcon(feature["properties"]["icon"]);	   	//affiche l'icon demandé
							layer.on('mouseover', function(e) {	layer.openPopup(); });
							
							//au click sur un element de la liste de droite, on zoom pour déclusturiser, et on ouvre la bulle
							$(thisSig.cssModuleName + " #item_map_list_" + feature.properties.id).click(function(){
								thisMap.setView([feature.geometry.coordinates[1], 
											  feature.geometry.coordinates[0]], 
											  13, {"animate" : true });
							    
								thisSig.checkListElementMap(thisMap); //alert("check");
								layer.openPopup();
							});
						}
					});
					
					thisSig.markersLayer.addLayer(points); 		// add it to the cluster group
					thisMap.addLayer(thisSig.markersLayer);		// add it to the map
					//thisMap.fitBounds(thisSig.markersLayer.getBounds());					
					//thisMap.panTo(thisSig.markersLayer.getBounds().getCenter());					
					
					//$('#spin_loading_map').css({"display":"none"});
					$('#ico_reload').removeClass("fa-spin");
					$('#ico_reload').css({"display":"none"});
			
					thisSig.checkListElementMap(thisMap);
				});
				
				
									
		};
		
			
		//##
		//##	PANEL FILTER	##
		//##
		
		this.Sig.changeFilter = function (val, thisMap)
		{ 
			/*	A RE TESTER !!
			 

			if(this.currentFilter != "")
				$('#item_panel_map_' + this.currentFilter).removeClass("selected");	
					
			$('#item_panel_map_' + val).addClass("selected");
			this.currentFilter = val;	
			this.showMapElements(thisMap, this.elementsMap);	
			*/
		};	
		
		
		//##
		//chargement de la carte 
	 	this.Sig.loadMap = function(canvasId)
	 	{ 
			$("#"+canvasId).html("");
			$("#"+canvasId).css({"background-color": "#456074"});

			//initialisation des variables de départ de la carte
			var map = L.map(canvasId, { "zoomControl" : false, 
										"scrollWheelZoom":true, 
										"center" : [51.505, -0.09],
										"zoom" : 4,
										"worldCopyJump" : false });
	
			var tileLayer = L.tileLayer('http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
				attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
				subdomains: 'abcd',
				minZoom: 0,
				maxZoom: 20
			}).setOpacity(0.4).addTo(map);
						
			return map;
		};	
		
		


		//alert((this.Sig));
		this.Sig = this.getSigInitializer(this.Sig);
		this.Sig = this.getSigRightList(this.Sig);
		this.Sig = this.getSigPopupContent(this.Sig);
			
		return this.Sig;	
	};
	