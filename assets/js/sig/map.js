	
	var markersLayer = "";
	var geoJsonCollection = "";
	var currentFilter = "none";
	var listId = new Array();
	//mémorise les identifiants des éléments de chaque carte
	var elementsMap = new Array();
	
	
	//##
	//chargement de la carte 
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
	
	
	
	