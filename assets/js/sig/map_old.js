	
	var markersLayer = "";
	var geoJsonCollection = "";
	var currentFilter = "none";
	var listId = new Array();
	//mémorise les identifiants des éléments de chaque carte
	var elementsMap = new Array();
	
								

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
	function getIcoMarker(ico, color){			
		return L.AwesomeMarkers.icon({icon: ico + " fa-" + color, iconColor:color, prefix: 'fa' });	
	}


	//##
	//supprime tous les marker de la carte
	function clearMap(theMap){
		if(markersLayer != "")
			markersLayer.clearLayers();
		
		$.each(markerSingleList, function(){
			theMap.removeLayer(this);
		});
	}
	
	
	//##
	//gère les dimensions des différentes parties de la carte (carte, panel, etc)
	function resizeMap(){
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
		
	}
		
	