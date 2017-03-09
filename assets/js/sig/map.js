
	//variable qui permet de charger une instance Sig différente à chaque éxecution
	var SigLoader = new Array();

		SigLoader.getSig = function (){
			
			this.Sig = new Array();

			this.Sig.map = null;
			this.Sig.markersLayer = "";
			this.Sig.tileLayer = null;
			this.Sig.roadTileLayer = null;
			this.Sig.geoJsonCollection = "";

			this.Sig.initParameters = "";

			this.Sig.cssModuleName = "";

			this.Sig.currentFilter = "none";

			this.Sig.icoMarkersTypes = {}; //definition dans map_initializar.js
			this.Sig.icoMarkersTags = {}; //definition dans map_initializar.js

			//mémorise les identifiants des éléments de chaque carte
			this.Sig.listId = new Array();
			this.Sig.listPanel = new Array();
			this.Sig.listPanel.tags = new Array();
			this.Sig.listPanel.types = new Array();

			this.Sig.panelFilter = "all";
			this.Sig.panelFilterType = "all";
			this.Sig.dataMap = {};

			//mémorise les éléments
			this.Sig.elementsMap = new Array();

			//##
			//créer un marker sur la carte, en fonction de sa position géographique
			this.Sig.markerSingleList = new Array();
			this.Sig.popupOpen = false;
			this.Sig.currentMarkerPopupOpen = null;

			this.Sig.mapPolygon = null;
			this.Sig.markerFindPlace = null;

			this.Sig.circleAroundMe = null;

			//##
			//créé une donnée GeoJson (pour les cluster)
			this.Sig.getGeoJsonMarker = function (properties/*json*/, coordinates/*array[lat, lng]*/)
			{
				//mylog.warn("--------------- getGeoJsonMarker ---------------------");
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
				mylog.warn("--------------- getMarkerSingle ---------------------");
				var thisSig = this;
				var contentString = options.content;
				if(options.content == null) contentString = "";

				var markerOptions = { icon : options.icon };
				if(typeof options.zIndexOffset != "undefined") 
					markerOptions["zIndexOffset"] = options.zIndexOffset;

				//mylog.log("POPUP CONTENT : " + contentString);
				var marker = L.marker(coordinates, markerOptions)
								.addTo(thisMap)
								.bindPopup(contentString);

				this.markerSingleList.push(marker);

				marker.on('click', function(e) {
						marker.openPopup();
						//Sig.markerToBounce = marker;
						//Sig.bounceMarker(0);
						//https://github.com/hosuaby/Leaflet.SmoothMarkerBouncing : bounce pluggin
						thisSig.currentMarkerPopupOpen = this;							
				});
				marker.on('mouseover', function(e) {
					if(thisSig.map.getZoom() != thisSig.map.getMaxZoom()){
						marker.openPopup();

						//Sig.markerToBounce = marker;
						//Sig.bounceMarker(0);
						//https://github.com/hosuaby/Leaflet.SmoothMarkerBouncing : bounce pluggin
						thisSig.currentMarkerPopupOpen = this;	
					}						
				});mylog.log("MARKER OK");
				
				return marker;
			};

			this.Sig.timerbounce = null;
			// EXEMPLE : 
			// Sig.bounceMarker(0, { duration: 500, 	//va effectuer un saut pendant 500 miliemes de secondes
			// 				  height: 15,				//d'une hauteur de 15px
			// 				  interval: 2000,			//toutes les 2 secondes
			// 				  occurence:5 });			//5 fois de suite
			this.Sig.bounceMarker = function(i, options){
				//Sig.markerToBounce.bounce({duration: 500, height: 30});
				if(typeof Sig.markerToBounce === "undefined" || Sig.markerToBounce === null) {
					if(typeof this.timerbounce != "undefined")
						clearTimeout(this.timerbounce);
					return;
				}

				i++;
				//mylog.log(i);
				if(i < options.occurence){
					this.timerbounce = setTimeout(function(){ 
						if(typeof Sig.markerToBounce != "undefined" && Sig.markerToBounce != null){
							Sig.markerToBounce.bounce({duration: options.duration, height: options.height}); 
							Sig.bounceMarker(i, options); 
						}
					}, options.interval);
				}else{
					clearTimeout(this.timerbounce);
				}
			};

			//##
			//récupère le nom de l'icon en fonction du type de marker souhaité
			this.Sig.getIcoMarkerMap = function(thisData)
			{
				//mylog.warn("--------------- getIcoMarker *** ---------------------");
				//mylog.log(thisData);
				if(typeof thisData.author != "undefined") thisData = thisData.author;

				this.allowMouseoverMaker = true;
				//mylog.log("thisData", thisData);
				var markerName = this.getIcoNameByType(thisData);
				//mylog.log("markerName", markerName);
				var iconUrl = assetPath+'/images/sig/markers/icons_carto/'+markerName+'.png';
				if(typeof thisData.profilMarkerImageUrl !== "undefined" && thisData.profilMarkerImageUrl != ""){ 
					iconUrl = baseUrl + thisData.profilMarkerImageUrl;
				}
				return L.icon({
				    iconUrl: iconUrl,
				    iconSize: [53, 60], //38, 95],
				    iconAnchor: [27, 57],//22, 94],
				    popupAnchor: [0, -55]//-3, -76]
				});
			};

			this.Sig.getIcoMarker = function(thisData)
			{
				//mylog.warn("--------------- getIcoMarker ---------------------");
				var ico = this.getIcoNameByType(thisData);
				var color = this.getIcoColorByType(thisData);

				return L.AwesomeMarkers.icon({icon: ico + " fa-" + color, iconColor:color, prefix: 'fa' });
			};


			//##
			//supprime tous les marker de la carte
			this.Sig.clearMap = function(thisMap, showMe)
			{
				if(typeof showMe == "undefined") showMe = true;

				//mylog.warn("--------------- clearMap ---------------------");
				if(this.markersLayer != "")
					this.markersLayer.clearLayers();

				if(typeof this.myMarker != "undefined") 
					this.map.removeLayer(this.myMarker);
				
				if(this.markerModifyPosition != null) 
					this.map.removeLayer(this.markerModifyPosition);

				if(notEmpty(this.circleAroundMe)) 
						this.map.removeLayer(this.circleAroundMe);

				var thisSig = this;
				if(this.markerSingleList != null)
				$.each(this.markerSingleList, function(){
					thisSig.map.removeLayer(this);
				});

				this.clearPolygon();

				this.listId = new Array();
				this.elementsMap = new Array();
				this.changePagination(1);
				
				$( this.cssModuleName + " #liste_map_element").html("");

				//showMe = false;
				if(showMe)
				this.showMyPosition();

			};

			//##
			//supprime tous les marker de la carte et prépare pour recharger de nouvelles données
			this.Sig.restartMap = function(thisMap)
			{	
				//supprime les item panel (sauf all)
				$.each($(this.cssModuleName + " .item_panel_map"), function(){
					if($(this).attr("id") != "item_panel_map_all" && $(this).attr("id") != "item_panel_filter_all")
						$(this).remove();
				});
				$(this.cssModuleName + " #liste_map_element").html();

				this.listPanel.tags = new Array();
				this.listPanel.types = new Array();
				this.panelFilter = "all";
				this.panelFilterType = "all";
				this.clearMap(thisMap);
				this.currentMarkerPopupOpen = null;
			};

			this.Sig.showMyPosition = function(){
				var thisSig = this;
				if(thisSig.myPosition != null){
					if(thisSig.myPosition.position.latitude != 0 && thisSig.myPosition.position.longitude != 0){
						//mylog.log("MYPOSITION !!");
						//mylog.dir(thisSig.myPosition);
						var center = [thisSig.myPosition.position.latitude, 
									  thisSig.myPosition.position.longitude];

						var popup = Sig.getPopupSimple(Sig.userData);
						var properties = { 	id : "0",
											icon : thisSig.getIcoMarkerMap(thisSig.myPosition),
											type : thisSig.myPosition["type"],
											typeSig : thisSig.myPosition["typeSig"],
											faIcon : this.getIcoByType(thisSig.myPosition),
											zIndexOffset: 10000,
											content: popup };

						if(typeof thisSig.myMarker != "undefined") thisSig.map.removeLayer(thisSig.myMarker);
						thisSig.myMarker = thisSig.getMarkerSingle(thisSig.map, properties, center);
						thisSig.createItemRigthListMap(thisSig.userData, thisSig.myMarker, thisSig.map);

						var objectId = thisSig.getObjectId(thisSig.userData);
						this.listId = new Array(objectId);

						$(this.cssModuleName + " .item_map_list_" + objectId).click(function()
						{	thisSig.map.panTo(center, {"animate" : true });
							thisSig.checkListElementMap(thisSig.map);
							thisSig.myMarker.openPopup();
						});
						
						$( "#btn-home" ).off().click(function (){ 
								thisSig.map.setView(center, thisSig.map.getMaxZoom()-1);
						});
						// $( ".btn-home" ).off().click(function (){ 
						// 		thisSig.centerSimple(center, thisSig.maxZoom-1);
						// });
					}
				}
			}
			//gère les dimensions des différentes parties de la carte (carte, panel, etc) en mode full screen
			this.Sig.setFullScreen = function()
			{
				////mylog.warn("--------------- setFullScreen ---------------------");
				//full screen map
				var mapHeight = $(".subviews.subviews-top").height();// - $(".toolbar").height();
				var rightListHeight = mapHeight - 110;

				$("#mapCanvas" + this.sigKey).css({"height":mapHeight});
				//alert(mapHeight);
				$("#mapCanvas" + this.sigKey).css({"margin-bottom":mapHeight*(-1)});
				$(this.cssModuleName + " #right_tool_map").css({"height":rightListHeight+25});
			
				$(this.cssModuleName + " #liste_map_element").css({"height":rightListHeight - $(this.cssModuleName + " #map_pseudo_filters").height() - 8*2 /*padding*/ - $(this.cssModuleName + " #chk-scope").height() - 33 });
				$(this.cssModuleName + " #liste_map_element").css({"max-height":rightListHeight - $(this.cssModuleName + " #map_pseudo_filters").height() - 8*2 /*padding*/ - $(this.cssModuleName + " #chk-scope").height() - 33  });
				
				$(this.cssModuleName + " #right_tool_map").css(		{"left":$("#mapCanvas" + this.sigKey).width() - $("#right_tool_map").width() - 20 });// - $(this.cssModuleName + " #right_tool_map").width()});
				$(this.cssModuleName + " .input-search-place").css( {"left":$("#mapCanvas" + this.sigKey).width() - $("#right_tool_map").width() - $(this.cssModuleName + " #right_tool_map").width() - 20});// - $(this.cssModuleName + " #right_tool_map").width()});
			
				$(this.cssModuleName + " .panel_map").css({"max-height":rightListHeight - 8*2 /*padding*/ - 33 });
				
			};

			//gère les dimensions des différentes parties de la carte (carte, panel, etc) en mode normal
			this.Sig.setNoFullScreen = function()
			{ 
				var mapHeight = this.initParameters.mapHeight;
				var rightListHeight = mapHeight - 100;

				var left = $(this.cssModuleName + " #right_tool_map").position().left - $(this.cssModuleName + " .input-search-place").width() - 20;
				$(this.cssModuleName + " .input-search-place")	.css({"left": left});// - $(this.cssModuleName + " #right_tool_map").width()});
			};

			//gère les dimensions des différentes parties de la carte (carte, panel, etc) en mode normal
			this.Sig.setFullPage = function()
			{ 
				var mapHeight = $("#mapCanvasBg").height();
				var menuTopHeight = $(".main-top-menu").height();// - $(".toolbar").height();
				var rightPanelHeight = mapHeight - menuTopHeight - 110;
				
				$(this.cssModuleName + " #right_tool_map").css({"height":rightPanelHeight});
				$(this.cssModuleName + " #liste_map_element").css({"height":rightPanelHeight-100});
				$(this.cssModuleName + " #liste_map_element").css({"maxHeight":rightPanelHeight-100});
				
				$(this.cssModuleName + " .panel_map").css({"max-height":rightPanelHeight - 8*2 /*padding*/ - 45 });
				
				var RTM_width =  ($("#right_tool_map").css('display') != 'none') ? $("#right_tool_map").width()+30 : 0;
				var GAM_width =  ($("#right_tool_map").css('display') != 'none') ? RTM_width+30 : RTM_width+30;
				$(this.cssModuleName + " .tools-btn").css({"right": RTM_width });
				$(this.cssModuleName + " .btn-groupe-around-me-km").css({"right": GAM_width });
				
				$(this.cssModuleName + " .input-search-place").css( {"left":90} );

				//var left = $(this.cssModuleName + " .tools-btn").position().left;
				//var top = $(this.cssModuleName + " .btn-group-map").position().top + $(this.cssModuleName + " #btn-filter").height();
	
			};

			//modifie la position et la forme des éléments de l'interface de facon dynamique
			this.Sig.constructUI = function()
			{
				
				if(this.initParameters.useFullScreen){
					this.setFullScreen();
				}
				else{
					this.setNoFullScreen();
				}

				if(this.initParameters.useFullPage){ this.setFullPage(); }

			}

			this.Sig.verifyPanelFilter = function (thisData){
				//mylog.warn("--------------- verifyPanelFilter ---------------------");

				if(this.panelFilter == "all") return true;

				var thisSig = this;
				//mylog.log("PANELFILTER" + this.panelFilterType);
				if(this.panelFilterType == "tags" || this.panelFilterType == "all"){
					if(this.usePanel == false) return true;
					//mylog.log(thisData["tags"] +"=="+ thisSig.panelFilter);
					
					//si thisData n'a pas de tags
					if("undefined" == typeof thisData["tags"]){
						return (this.panelFilter == "all");
					}


					var inArray = false;
					if(typeof thisData["tags"] != "undefined" && thisData["tags"] != null)
					$.each(thisData["tags"], function(index, value){
						if(value == thisSig.panelFilter) inArray = true;
					});

					if(	inArray //$.inArray(this.panelFilter, thisData["tags"]) > -1 //ne fonctionne pas
						||  this.panelFilter == "all") {
							return true;
					}
					else{ return false; }

				}
				
				if(this.panelFilterType == "types" || this.panelFilterType == "all"){
					if(this.useFilterType == false) return true;

					//si thisData n'a pas de tags
					if("undefined" == typeof thisData["type"] && "undefined" == typeof thisData["typeSig"]){
						return (this.panelFilter == "all");
					}
					if(		thisData["type"] == thisSig.panelFilter
						||  thisData["typeSig"] == thisSig.panelFilter
						||  this.panelFilter == "all") {
							return true;
					}
					else{ return false; }

				}
			};

			this.Sig.polygonsCollection = new Array();

			this.Sig.addPolygon = function(polygonPoints, options)
			{
				//mylog.log("addPolygon");
				var poly = L.polygon(polygonPoints, {
										color: '#FFF', 
										opacity:0.7,
										fillColor: '#71A4B4', 
										fillOpacity:0.3,  
										weight:'2px', 
										smoothFactor:0.5}).addTo(this.map);

				this.polygonsCollection.push(poly);
			};

			this.Sig.showCircle = function(center, radius, options)
			{
				mylog.log("showCircle", notEmpty(this.circleAroundMe), radius);
				if(notEmpty(this.circleAroundMe)) this.map.removeLayer(this.circleAroundMe);
				this.circleAroundMe = L.circle(center, radius, {
										color: '#FFF', 
										opacity:0.7,
										fillColor: '#71A4B4', 
										fillOpacity:0.3,  
										weight:'2px', 
										smoothFactor:0.5}).addTo(this.map);

				
			};

			this.Sig.clearPolygon = function()
			{
				var thisSig = this;
				$.each(this.polygonsCollection, function(key, poly){
					thisSig.map.removeLayer(poly);
				});
				this.polygonsCollection = new Array();
			};

			this.Sig.showPolygon = function(polygonPoints, options)
			{
				//mylog.log("showPolygon");
				//mylog.dir(polygonPoints);
				//si le polygone existe déjà on le supprime
				if(this.mapPolygon != null) this.map.removeLayer(this.mapPolygon);
				//puis on charge le nouveau polygone
				this.mapPolygon = L.polygon(polygonPoints, {
										color: '#FFF', 
										opacity:0.7,
										fillColor: '#71A4B4', 
										fillOpacity:0.3,  
										weight:'2px', 
										smoothFactor:0.5}).addTo(this.map);
			};

			this.Sig.inversePolygon = function(polygon){
				var inversedPoly = new Array();
				mylog.log("inversePolygon");
				if(typeof polygon != "undefined" && polygon != null){
					$.each(polygon, function(key, value){
						var lat = value[0];
						var lng = value[1];
						inversedPoly.push(new Array(lng, lat));
					});
				}
				mylog.dir(inversedPoly);
				return inversedPoly;
			};

			this.Sig.getCoordinates = function(thisData, type)
			{
				//mylog.warn("--------------- getCoordinates ---------------------");
				//mylog.dir("getCoordinates" , thisData);
				//si la donnée est une news, on doit afficher la position de l'auteur
				if( typeof thisData.typeSig !== "undefined"){
					if(thisData.typeSig == "news" && typeof thisData.author !== "undefined"){
						thisData = thisData.author;
					}
				}

				if( typeof thisData.geo !== "undefined" && thisData.geo != null && typeof thisData.geo.longitude !== "undefined"){
					
					if(typeof thisData['geo'].latitude == "undefined" || thisData['geo'].latitude == null) return false;
					if(typeof thisData['geo'].longitude == "undefined" || thisData['geo'].longitude == null) return null;
						
					if(type == "markerSingle"){
						return new Array (thisData['geo'].latitude, thisData['geo'].longitude);
					}
					else if(type == "markerGeoJson"){
						return new Array (thisData['geo'].longitude, thisData['geo'].latitude);
					}
				}
				else if(typeof thisData.geoPosition != "undefined"){
					
					if(typeof thisData.geoPosition.coordinates == "undefined" 	 || thisData.geoPosition.coordinates == null) return false;
					if(typeof thisData.geoPosition.coordinates[0] == "undefined" || thisData.geoPosition.coordinates[0] == null) return false;
					if(typeof thisData.geoPosition.coordinates[1] == "undefined" || thisData.geoPosition.coordinates[1] == null) return false;
						
					if(type == "markerSingle"){
						var lat = thisData.geoPosition.coordinates[1];
						var lng = thisData.geoPosition.coordinates[0];
						return new Array (lat, lng);
					} else if(type == "markerGeoJson"){
						return thisData.geoPosition.coordinates;
					}
				}
				else if(typeof thisData.geometry != "undefined"){ //resultat search street on google map
					//mylog.log("thisData.geometry ?");
					//mylog.dir(thisData);
					if(typeof thisData.geometry.location == "undefined" 	|| thisData.geometry.location == null) return false;
					if(typeof thisData.geometry.location.lat == "undefined" || thisData.geometry.location.lat == null) return false;
					if(typeof thisData.geometry.location.lng == "undefined" || thisData.geometry.location.lng == null) return false;
					
					if(type == "markerSingle"){
						var lat = thisData.geometry.location.lat;
						var lng = thisData.geometry.location.lng;
						mylog.dir(new Array (lat, lng));
						return new Array (lat, lng);
					} else if(type == "markerGeoJson"){
						var lat = thisData.geometry.location.lat;
						var lng = thisData.geometry.location.lng;
						return new Array (lng, lat);
					}
					
				}
				else{
					return null;
				}
			};


			this.Sig.showOneElementOnMap = function(thisData, thisMap){
				//mylog.warn("--------------- showOneElementOnMap ---------------------");
				//mylog.dir(thisData);
				//var objectId = thisData._id ? thisData._id.$id.toString() : null;
				var objectId = this.getObjectId(thisData);
							
				//mylog.log("verify id : ", objectId);
				//if(thisData != null && thisData["type"] == "meeting") alert("trouvé !");
				//mylog.log(thisData);
				if(objectId != null)
				{
					if($.inArray(objectId, this.listId) == -1 || thisData.typeSig == "city")
					{	
						if( ("undefined" != typeof thisData['geo'] && thisData['geo'] != null) || 
							("undefined" != typeof thisData['geoPosition'] && thisData['geoPosition'] != null) ||

							("undefined" != typeof thisData['author'] && 
							(("undefined" != typeof thisData['author']['geo'] && thisData['author']['geo'] != null) || 
							("undefined" != typeof thisData['author']['geoPosition'] && thisData['author']['geoPosition'] != null) ))) 
						{
							
							if(this.verifyPanelFilter(thisData))
							{
								var type = (typeof thisData["typeSig"] !== "undefined") ? thisData["typeSig"] : thisData["type"];
								//préparation du contenu de la bulle
								//mylog.log("!!!!!!!!!!!!!!!!!!!!!!showOneElementOnMap", thisData);
								var content = this.getPopup(thisData);
								//création de l'icon sur la carte
								var theIcon = this.getIcoMarkerMap(thisData);
								var properties = { 	id : objectId,
													icon : theIcon,
													type : thisData["type"],
													typeSig : type,
													name : thisData["name"],
													faIcon : this.getIcoByType(thisData),
													content: content };

								var marker;
								var coordinates;
								var thisSig = this;

								//si le tag de l'élément est dans la liste des éléments à ne pas mettre dans les clusters
								//on créé un marker simple
								//TODO : refactor notClusteredTag > notClusteredType
								//mylog.log("getCoordinates");
								//mylog.dir(thisData);
								if($.inArray(type, this.notClusteredTag) > -1){ 
									coordinates = this.getCoordinates(thisData, "markerSingle");
									if(coordinates !== false)
										marker = this.getMarkerSingle(thisMap, properties, coordinates);
								}
								//sinon on crée un nouveau marker pour cluster
								else { 
									coordinates = this.getCoordinates(thisData, "markerGeoJson");
									if(coordinates !== false){
										marker = this.getGeoJsonMarker(properties, coordinates);
										this.geoJsonCollection['features'].push(marker);
									}
								}
								//mylog.log("content POPUT thisAddr : ", thisData);
										
								
								if(notEmpty(thisData["addresses"])){
									$.each(thisData["addresses"], function(key, addr){ 
										var thisAddr = JSON.parse(JSON.stringify(thisData)); //duplicate value, prevent modifying thisData after this line DO NOT REMOVE IT CAN KILL THE WORLLLLLD ! ARE YOU CRAZY ? 
										thisAddr["address"] = addr["address"];
										thisAddr["geo"] = addr["geo"];
										thisAddr["geoPosition"] = addr["geoPosition"];
										var popup = thisSig.getPopup(thisAddr);
										properties.content = popup;
										coordinates = thisSig.getCoordinates(thisAddr, "markerSingle");
										if(coordinates !== false)
											var multimarker = thisSig.getMarkerSingle(thisMap, properties, coordinates);
									});
									properties.content = content;
								}


								if(thisData["type"] == "city"){
									//mylog.log("geoshapes ?");
									//mylog.dir(thisData);	
										
									if(typeof thisData["geoShape"] != "undefined" && typeof thisData["geoShape"]["coordinates"] != "undefined"){
										var geoShape = Sig.inversePolygon(thisData["geoShape"]["coordinates"][0]);
										this.addPolygon(geoShape);
									}
								}
								
								if(coordinates !== false){
									this.elementsMap.push(thisData);
									this.listId.push(objectId);
									this.populatePanel(thisData, objectId); //["tags"]
									this.createItemRigthListMap(thisData, marker, thisMap);
								}else thisSig.addToPanelWithoutGeopos(thisData, objectId);

								//ajoute l'événement click sur l'élément de la liste, pour ouvrir la bulle du marker correspondant
								//si le marker n'est pas dans un cluster (sinon le click est géré dans le .geoJson.onEachFeature)
								if($.inArray(type, this.notClusteredTag) > -1)
								$(this.cssModuleName + " .item_map_list_" + objectId).click(function()
								{	thisMap.panTo(coordinates, {"animate" : true });
									thisSig.checkListElementMap(thisMap);
									marker.openPopup();
								});
								//mylog.log("ok888");


							}
						}
						else{
							this.addToPanelWithoutGeopos(thisData, objectId);
						}
					}
					
					//affiche les MEMBERS
					var thisSig = this;
					if(thisData.links != null){
						if(thisData.links.members != null){ 
							$.each(thisData.links.members, function(i, thisMember)  {
								thisMember._id = { $id : i };
								thisSig.showOneElementOnMap(thisMember, thisMap);
							});
						}
					}

				}else {
					if(thisData == null) return false;

					//mylog.warn("--------------- PAS D'ID ---------------------");
					//mylog.dir(thisData);

					if("undefined" != typeof thisData["chartOptions"]){
						//mylog.warn("--------------- LOAD CHART ---------------------");
						this.addChart(thisData)
					}
					return false;
				}

			};

			this.Sig.addToPanelWithoutGeopos = function(thisData, objectId){
				if(this.verifyPanelFilter(thisData) && typeof thisData.name != "undefined"){
					this.elementsMap.push(thisData);
					this.listId.push(objectId);
					this.populatePanel(thisData, objectId); //["tags"]
					this.createItemRigthListMap(thisData);
					var thisSig = this;	
					$(this.cssModuleName + " .item_map_list_" + objectId).click(function(){	
						//toastr.success('click on element not in map');
						//mylog.dir(thisData);
						thisSig.showModalItemNotLocated(thisData);
					});	
				}
			};

			this.Sig.showFilterOnMap = function(data, thisFilter, thisMap){
				//mylog.warn("--------------- showFilterOnMap ***%%% ---------------------");
				var thisSig = this;
				//mylog.dir(data);
				//mylog.dir(thisFilter);
				var dataFilter = data; //(data != null) ? data[thisFilter] : thisFilter;	alert(JSON.stringify(dataFilter));
				
				if($.isArray(dataFilter)){
					$.each(dataFilter, function(i, thisData)  {
						////mylog.warn("--------------- show each thisData ---------------------");
						////mylog.dir(thisData);
						thisSig.showOneElementOnMap(thisData, thisMap);
					});
				}
				else{
					thisSig.showOneElementOnMap(dataFilter, thisMap);
				}
			};


			this.Sig.showMapElements = function(thisMap, data)
			{
				mylog.warn("--------------- showMapElements ---------------------");
				mylog.log(data);
				if(data == null) return;

				var filterPanelValue = "citoyens";
				//enregistre les dernières données dans une variable locale
				this.dataMap = data;
				//alert("datas : " + JSON.stringify(this.dataMap));
				//efface les elements de la carte si elle n'est pas vide
				if(this.markersLayer != "") this.clearMap(thisMap, false);

				//conteneur de marker cluster
				this.markersLayer = new L.MarkerClusterGroup({"maxClusterRadius" : 40});
				thisMap.addLayer(this.markersLayer);

				//collection de marker geojson
				this.geoJsonCollection = { type: 'FeatureCollection', features: new Array() };

				//this.showIcoLoading(true);

				//on affiche les data filtre par filtre
				var thisSig = this;
				//var array = new Array();

				var len = 0;

				$.each(data, function (key, value){ len++; });//alert("len : " + len);
				if(len >= 1){
					$.each(data, function (key, value){ //mylog.log("type SIG ?"); mylog.dir(value);
						var oneData = value;
						if((value.typeSig == "news" || 
							value.typeSig == "idea" || 
							value.typeSig == "question" || 
							value.typeSig == "announce" || 
							value.typeSig == "information" || 
							value.type == "activityStream"
							) && typeof value.author !== "undefined") {
							oneData = value.author;
						}
						// if(value.type == "activityStream" && typeof value.target !== "undefined") { //mylog.log("newsStream");
						// 	oneData = value.target;
						// }
						thisSig.showFilterOnMap(oneData, key, thisMap);
					});
					
				}else{
					//mylog.log("showOneElementOnMap");
					thisSig.showOneElementOnMap(data, thisMap);
				}
			
				//mylog.log("before onEachFeature");
				//mylog.dir(this.geoJsonCollection);
				var points = L.geoJson(this.geoJsonCollection, {				//Pour les clusters seulement :
						onEachFeature: function (feature, layer) {				//sur chaque marker
							//mylog.log("onEachFeature");
							layer.bindPopup(feature["properties"]["content"]); 	//ajoute la bulle d'info avec les données
							layer.setIcon(feature["properties"]["icon"]);	   	//affiche l'icon demandé
							layer.on('mouseover', function(e) {	
								//si le mouseover n'est pas autorisé
								//ou si le zoom de la carte est = au zoom maximum (== ouverture cluster spiral)
								if(thisSig.allowMouseoverMaker == false  || 
								   thisSig.map.getZoom() == thisSig.map.getMaxZoom()) return;

								layer.openPopup(); 
								thisSig.currentMarkerPopupOpen = layer;
							});
							layer.on('click', function(e) {	
								thisSig.currentMarkerPopupOpen = layer;
								thisMap.panTo(layer.getLatLng());	
								layer.openPopup(); 
							});
						
							//au click sur un element de la liste de droite, on zoom pour déclusturiser, et on ouvre la bulle
							$(thisSig.cssModuleName + " .item_map_list_" + feature.properties.id).click(function(){
								thisSig.allowMouseoverMaker = false;
								var coordinates =  [feature.geometry.coordinates[1], 
													feature.geometry.coordinates[0]];
								thisMap.panTo(coordinates, {"animate" : false });
								
								var visibleOne = null;
								if(typeof layer != "undefined")
									visibleOne = Sig.markersLayer.getVisibleParent(layer);
								
								if(typeof visibleOne != "undefined"){
									if(typeof visibleOne._childCount != "undefined"){
										var i = 0;
										while(typeof visibleOne._childCount != "undefined" && i<5){
											coordinates = visibleOne.getLatLng();
											thisMap.panTo(coordinates, {"animate" : false });
											visibleOne.fire("click");
											if(typeof layer != "undefined")
												visibleOne = Sig.markersLayer.getVisibleParent(layer);
											thisSig.currentParentToOpen = visibleOne;
											i++;
										}
									}
									else{
										if(typeof visibleOne._spiderLeg == "undefined")	{
											thisMap.fire("click");
											thisMap.setZoom(15, {"animate" : false });
											thisMap.panTo(coordinates, {"animate" : false });
											thisSig.currentParentToOpen = null;

										}
									}
								}
								thisSig.checkListElementMap(thisMap);
								thisSig.currentMarkerToOpen = layer;
								thisSig.currentMarkerPopupOpen = layer;
								setTimeout("Sig.openCurrentMarker()", 700);
							});			
						}

					});
					//mylog.warn("--------------- showMapElements  onEachFeature OK ---------------------");

					this.markersLayer.addLayer(points); 		// add it to the cluster group
					thisMap.addLayer(this.markersLayer);		// add it to the map

					$('#ico_reload').removeClass("fa-spin");
					$('#ico_reload').css({"display":"none"});

					if(this.initParameters.usePanel)
						this.updatePanel(thisMap);

					this.checkListElementMap(thisMap); 
					
					mylog.log("fitBounds", typeof noFitBoundAroundMe);
					//mylog.dir(this.markersLayer.getBounds());
					if( typeof noFitBoundAroundMe == "undefined" || noFitBoundAroundMe != true){
						if("undefined" != typeof this.markersLayer.getBounds() &&
						   "undefined" != typeof this.markersLayer.getBounds()._northEast ){
							thisMap.fitBounds(this.markersLayer.getBounds(), { 'maxZoom' : 14, 'animate':false });
							//thisMap.zoomOut();
						}
					}

					/*
					thisMap.setZoom(17, {"animate" : false });
						   thisMap.fitBounds(thisSig.markersLayer.getBounds(), { 'maxZoom' : 14, 'animate':false });
							// setTimeout(function(){
							// 	thisMap.fitBounds(thisSig.markersLayer.getBounds(), { 'maxZoom' : 14, 'animate':false });
							// }, 1500);
							*/
					
					thisSig.constructUI();

					this.showIcoLoading(false);

		};

		//##
		this.Sig.openCurrentMarker = function(){
			if(typeof this.currentParentToOpen != "undefined" && this.currentParentToOpen != null)
				this.currentParentToOpen.fire("click");

			if(typeof this.currentMarkerToOpen != "undefined" && this.currentMarkerToOpen != null)
				this.currentMarkerToOpen.openPopup();

			this.allowMouseoverMaker = true;
		};


		//##
		//##	LOAD MAP	##
		//##

		//##
		//chargement de la carte
	 	this.Sig.loadMap = function(canvasId, initParams)
	 	{
	 		
			mylog.warn("--------------- loadMap ---------------------");
			canvasId += initParams.sigKey;
			if(this.map == null){
				$("#"+canvasId).html("");
				$("#"+canvasId).css({"background-color": this.mapColor});

				mylog.log("initParams", initParams);
				//initialisation des variables de départ de la carte
				//TODO not show accessToken here => use conf file or db
				if(canvasId != ""){

					var options = { "zoomControl" : false,
									"scrollWheelZoom":true,
									"center" : [51.505, -0.09],
									"zoom" : 4,
									"maxZoom" : 17,
									"minZoom" : 3,
									"worldCopyJump" : false };

					if(notEmpty(initParams["mapProvider"]) && initParams.mapProvider == "mapbox"){
						L.mapbox.accessToken = initParams["mapboxToken"];
						var map =  L.mapbox.map(canvasId, 'mapbox.streets', options);
		    						//.setView([51.505, -0.09], 9);
	    			}else if(notEmpty(initParams["mapProvider"]) && initParams.mapProvider == "OSM"){
						var map = L.map(canvasId, options);
						Sig.tileLayer = L.tileLayer(initParams.mapTileLayer, { //'http://{s}.tile.stamen.com/toner/{z}/{x}/{y}.png', {
							//attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
							attribution: 'Map tiles by ' + initParams.mapAttributions, //'Map tiles by <a href="http://stamen.com">Stamen Design</a>',
							//subdomains: 'abc',
							zIndex:1,
							minZoom: 3,
							maxZoom: 17
						});

						Sig.tileLayer.addTo(map).setOpacity(initParams.mapOpacity);
					}
				}
			}else{
				var map = this.map;
			}
			//initialisation de l'interface
			Sig.initEnvironnement(map, initParams);
			if(canvasId == "") return;

			Sig.map.minZoom = 3;
			Sig.map.maxZoom = 17;

			
			
			//rafraichi les tiles après le redimentionnement du mapCanvas
			map.invalidateSize(false);
			return map;
		};

		//show a modal when an item in the right list has no geoLocation on the map
		this.Sig.showModalItemNotLocated = function(data){
			$("#modalItemNotLocated").modal('show');
			$("#modalItemNotLocated .modal-body").html("<i class='fa fa-spin fa-reload'></i>");

			var objectId = this.getObjectId(data);
			var popup = this.getPopupSimple(data);
			$("#modalItemNotLocated .modal-body").html(popup);
			$("#modalItemNotLocated #btn-open-details").click(function(){
				$("#popup"+objectId).click();
			});

			$("#modalItemNotLocated #popup"+objectId).click(function(){
				$("#modalItemNotLocated").modal('hide');
			});
		}

		//##	addContextMap	##
		//Ajouter un élément au contextMap
	 	this.Sig.addContextMap = function(contextMap, element, type)
	 	{
	 		
			mylog.warn("--------------- addContextMap ---------------------", contextMap, element, type);
			var elementMap = {
				name : element.name ,
				username : element.username ,
				address : element.address ,
				geo : element.geo ,
				email : element.email ,
				id : element.id ,
				pending : element.pending ,
				profilImageUrl : element.profilImageUrl ,
				profilMarkerImageUrl : element.profilMarkerImageUrl ,
				profilMediumImageUrl : element.profilMediumImageUrl ,
				profilThumbImageUrl : element.profilThumbImageUrl ,
				tags : element.tags ,
				tobeactivated : element.tobeactivated ,
				type : element.type ,
			}

			if(typeof contextMap[type] == "undefined")
				contextMap[type] = [];
			
			contextMap[type].push(elementMap);
			
			return contextMap;
		};

		this.Sig.modifLocalityContextMap = function(contextMap, element, type)
	 	{
	 		
			mylog.warn("--------------- addContextMap ---------------------", contextMap, element, type);

			if(typeof contextMap[type] == "undefined")
				contextMap[type] = [];

			$.each(contextMap[type], function(key, elt){
				if(elt.id == contextData.id){
					contextMap[type][key]["address"] = element.address;
					contextMap[type][key]["geo"] = element.geo;
				}	
			});
			return contextMap;
		};

		

		this.Sig = this.getSigInitializer(this.Sig);

		//mylog.log("load");

		this.Sig = this.getSigPanel(this.Sig);
		this.Sig = this.getSigRightList(this.Sig);
		this.Sig = this.getSigPopupContent(this.Sig);
		this.Sig = this.getSigFindPlace(this.Sig);
		this.Sig = this.getSigCharts(this.Sig);

		return this.Sig;
	};
