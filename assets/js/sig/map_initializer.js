
	/**
	***		INITIALIZER
	***/

	SigLoader.getSigInitializer = function (Sig){

		//***
		//initialisation de l'interface et des événements (click, etc)
		Sig.initEnvironnement = function (thisMap, params){

			////mylog.log("initParams");
			////mylog.dir(params);

	    	var thisSig = this;
	    	thisSig.userData = null;

	    	//memorise les paramètres dans une variable globale de l'instance SIG
	    	if(params != "restart")
	    	thisSig.initParameters = params;

	    	//memorise la carte
	    	thisSig.map = thisMap;

	    	//mémorise le nom (identifiant css classe) utilisé pour cette instance
	    	thisSig.cssModuleName = ".sigModule" + params.sigKey;

			//mémorise la clé utilisé pour cette instance
	    	thisSig.sigKey = params.sigKey;

			//mémorise le nom (identifiant css classe) utilisé pour cette instance
	    	thisSig.mapColor = params.mapColor;

			//mémorise la liste des éléments non clusturisés
			thisSig.notClusteredTag = params.notClusteredTag;

			thisSig.tileMode = "terrain";

			//initialise la position de la carte
			thisMap.setView(params.firstView.coordinates, params.firstView.zoom);
			
			thisSig.maxZoom = 20;
			thisSig.minZoom = 3;

			this.loadIcoParams();
			

			if(params.useRightList){
				//lorsque la vue de la carte change, on actualise la liste d'élément (rightList)
				//thisMap.on('moveend', function(e) { thisSig.checkListElementMap(thisMap); });
				//losque on effectue une recherche dans le champs de texte
				$(this.cssModuleName + " #input_name_filter" ).keyup(function (){ thisSig.checkListElementMap(thisMap); });
				//lorsqu'on active/désactive le filtre par zone
				$(this.cssModuleName + " #chk-scope").click(function (){ thisSig.checkListElementMap(thisMap); });
			}

			//initialise les boutons zoom-in et zoom-out
			if(params.useZoomButton){
				$( this.cssModuleName + " #btn-zoom-in" )	 .click(function (){ mylog.log(thisMap.getZoom(), "max : ", thisMap.getMaxZoom(), "min : ", thisSig.map.getMinZoom());
					if(thisMap.getZoom() < thisSig.maxZoom) thisMap.zoomIn(); 
				});
				$( this.cssModuleName + " #btn-zoom-out" )	 .click(function (){ mylog.log(thisMap.getZoom(), "max : ", thisMap.getMaxZoom(), "min : ", thisSig.map.getMinZoom());
					if(thisMap.getZoom() > thisSig.minZoom) thisMap.zoomOut(); 
				});
			}

			//initialise les boutons zoom-in et zoom-out
			if(params.useHomeButton){
				this.initHomeBtn();
			}

			$("#btn-back").click(function(){
				showMap(false);
			})
			//if(params.useFullScreen){
				//$( this.cssModuleName + " #btn-full-screen" ).click(function (){ thisMap.setFullScreen(); });
				$( window ).resize(function() {
				  thisSig.constructUI();
				});
				thisSig.constructUI();
			//}



			//affiche les coordonnées d'un click , dans une zone sous la carte (utile pour récupérer des coordonnées rapidement)
			if(params.useHelpCoordinates){
				thisMap.on('click', function(e) {
						var pos = e.latlng;
						if(typeof pos != "undefined")
						$("#help-coordinates").html('lat lng : ' + pos.lat + ", " + pos.lng);
				});
			}

			if(params.usePanel){
				
				this.currentFilter = "all";
				
				$(this.cssModuleName + ' #item_panel_map_all').click(function(){
					thisSig.changeFilter('all', thisMap, "tags");
				});

				$(thisSig.cssModuleName + " #btn-panel").click(function(){
					thisSig.switchDropDown("panel_map");
				});

				$(thisSig.cssModuleName + ' #mapCanvas' + this.sigKey).focus(function(event) {
					$(thisSig.cssModuleName + ' #panel_map').css({'display':'none'});
				});
				$(thisSig.cssModuleName + ' #right_tool_map').focus(function(event) {
					$(thisSig.cssModuleName + ' #panel_map').css({'display':'none'});
				});

				$(thisSig.cssModuleName + ' .item_map_list').focus(function(event) {
					$(thisSig.cssModuleName + ' #panel_map').css({'display':'none'});
				});

				$(thisSig.cssModuleName + ' #right_tool_map').mouseleave(function(event) {
					$(thisSig.cssModuleName + ' #panel_map').hide(200);
				});

				$(thisSig.cssModuleName + ' .dropdown-menu.panel_map').mouseleave(function(event) {
					$(thisSig.cssModuleName + ' #panel_map').hide(200);
				});

			}

			if(params.useFilterType){
				
				this.currentFilterType = "all";
				
				$(this.cssModuleName + ' #item_panel_filter_all').click(function(){
					thisSig.changeFilter('all', thisMap, "types");
				});

				$("#btn-filters").click(function(){ 
					thisSig.switchDropDown("panel_filter");
				});

				$(thisSig.cssModuleName + ' #mapCanvas' + this.sigKey).focus(function(event) {
					$(thisSig.cssModuleName + ' #panel_filter').css({'display':'none'});
				});

				$(thisSig.cssModuleName + ' #right_tool_map').focus(function(event) {
					$(thisSig.cssModuleName + ' #panel_filter').css({'display':'none'});
				});

				$(thisSig.cssModuleName + ' .item_map_list').focus(function(event) {
					$(thisSig.cssModuleName + ' #panel_filter').css({'display':'none'});
				});

				$(thisSig.cssModuleName + ' #right_tool_map').mouseleave(function(event) {
					$(thisSig.cssModuleName + ' #panel_filter').hide(200);
				});
				$(thisSig.cssModuleName + ' .dropdown-menu.panel_map').mouseleave(function(event) {
					$(thisSig.cssModuleName + ' #panel_filter').hide(200);
				});
			}

			if(params.useResearchTools){
				this.initFindPlace();
			}

			if(params.useSatelliteTiles){
				$(this.cssModuleName + " #btn-satellite").click(function(){
					if(thisSig.tileMode == "terrain"){
						thisSig.tileMode = "satellite";
						
						if(thisSig.tileLayer != null) thisSig.map.removeLayer(thisSig.tileLayer);

						/* chargement fond de carte SATELLITE */
						if(params.mapProvider == "OSM"){
							thisSig.tileLayer = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', //http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', 
															{maxZoom:17, minZoom:3}).addTo(Sig.map);
						}else if(params.mapProvider == "mapbox"){
							thisSig.tileLayer = L.mapbox.tileLayer('mapbox.satellite',{maxZoom:17, minZoom:3}).addTo(thisSig.map);
						}	

						/* chargement des routes */
						thisSig.roadTileLayer = L.tileLayer('//stamen-tiles-{s}.a.ssl.fastly.net/toner-lines/{z}/{x}/{y}.{ext}', {
							ext: 'png',
							attribution: 'Tiles Courtesy of <a href="http://www.mapquest.com/">MapQuest</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
							subdomains: 'abcd',
							zIndex:2,
							opacity: 0.7,
							minZoom:3,
							maxZoom: 17
						});
						thisSig.roadTileLayer.addTo(thisSig.map);
						
						/* chargement des noms */
						thisSig.StamenTonerLabels = L.tileLayer('http://stamen-tiles-{s}.a.ssl.fastly.net/toner-labels/{z}/{x}/{y}.{ext}', {
												attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
												subdomains: 'abcd',
												opacity: 0.7,
												zIndex:3,
												minZoom: 3,
												maxZoom: 17,
												ext: 'png'
											});
						thisSig.StamenTonerLabels.addTo(thisSig.map);


					}else if(thisSig.tileMode == "satellite"){
						thisSig.tileMode = "terrain";

						if(thisSig.tileLayer != null) thisSig.map.removeLayer(thisSig.tileLayer);

						/* chargement fond de carte TERRAIN */
						if(params.mapProvider == "OSM"){
							thisSig.tileLayer = L.tileLayer(thisSig.initParameters.mapTileLayer, 
													{maxZoom:17,
													 minZoom:3}).setOpacity(thisSig.initParameters.mapOpacity).addTo(thisSig.map);
						}else if(params.mapProvider == "mapbox"){
							/* mapBox fourni le fond de carte, les rues et les noms en même temps */
							thisSig.tileLayer = L.mapbox.tileLayer('mapbox.streets',{maxZoom:17, minZoom:3}).addTo(thisSig.map);
						}

						/* efface les routes */
						if(thisSig.roadTileLayer != null) {
							if(thisSig.roadTileLayer != null) thisSig.map.removeLayer(thisSig.roadTileLayer);
						}

						/* efface les noms */
						if(thisSig.StamenTonerLabels != null) {
							if(thisSig.StamenTonerLabels != null) thisSig.map.removeLayer(thisSig.StamenTonerLabels);
						}
					}
					mylog.log("maxZoom", thisSig.map.getZoom(), 17);
					if(thisSig.map.getZoom() > thisSig.map.maxZoom )
						thisSig.map.setZoom(thisSig.tileLayer.maxZoom);
				});
			}

			
		};
		
		Sig.showIframeSig = function(){
			
			var hash = "?tpl=iframesig"+location.hash+"?tpl=iframesig";
				$("#ajax-modal").removeClass("bgEvent bgOrga bgProject bgPerson bgDDA");
				$("#ajax-modal-modal-title").html("<i class='fa fa-share-square-o'></i> Partager cette carte.");
				$(".modal-header").removeClass("bg-purple bg-green bg-orange bg-yellow bg-lightblue ");
			  	$("#ajax-modal-modal-body").html(   "<div class='row'>"+
			  										  "<div class='col-md-3'>"+
				  										"<div class='form-group'>"+
  															"<label>Largeur</label>"+
  															"<input class='form-control' type='text' name='width' value='500'>"+
											            "</div>"+
  													  "</div>"+
  													  "<div class='col-md-3'>"+
				  										"<div class='form-group'>"+
  															"<label>Hauteur</label>"+
  															"<input class='form-control' type='text' name='height' value='500'>"+
											            "</div>"+
  													  "</div>"+
  													  "<div class='col-md-6'>"+
				  										"<h4 class='text-left no-margin padding-5'>Forme :</h4>"+
											            "<div class='radio-inline'>"+
  															"<label><input type='radio' name='forme' value='square' checked> Carré</label>"+	
											            "</div>"+
											            "<div class='radio-inline'>"+
  															"<label><input type='radio' name='forme' value='circle'> Cercle</label>"+	
											            "</div>"+										            
										              "</div>"+
										              "<div class='col-md-12'>"+
				  										"<h2 class='text-left text-dark'><i class='fa fa-angle-down'></i> Copiez / collez ce code dans la page de votre site web :</h2>" +
			  										  	"<textarea class='form-control' rows='3' id='txtarea_iframe'>"+
				  											"<iframe height='500' width='500'"+
				  													" src='https://www.communecter.org"+hash+"'></iframe>"+
				  										"</textarea>"+
										              "</div>" +
										              
										            "</div>");
			  	$('#ajax-modal').modal("show");

			  	$("input[name='forme'], input[name='width'], input[name='height']").change(function(){
			  		var height=$("input[name='height']").val();
			  		var width=$("input[name='width']").val();
			  		var forme=$("input[name='forme']:checked").val();
			  		var radius = (forme == "circle") ? "style='border-radius:50%'" : "";

			  		$("#txtarea_iframe").html("<iframe height='"+height+"' width='"+width+"' "+radius+
				  								" src='https://www.communecter.org"+hash+"'></iframe>")
			  	});
			};
		Sig.loadIcoParams = function(){
			//TODO : définir les icons et couleurs de chaque type disponoble
			this.icoMarkersMap = { 			"default" 			: "",

										  	"city" 				: "city-marker-default",
											
											"news" 				: "NEWS_A",
											"idea" 				: "NEWS_A",
											"question" 			: "NEWS_A",
											"announce" 			: "NEWS_A",
											"information" 		: "NEWS_A",

											"citoyen" 			: "citizen-marker-default",
											"citoyens" 			: "citizen-marker-default",
											"people" 			: "citizen-marker-default",

											"NGO" 				: "ngo-marker-default",
											"organizations" 	: "ngo-marker-default",
											"organization" 		: "ngo-marker-default",

											"event" 			: "event-marker-default",
											"events" 			: "event-marker-default",
											"meeting" 			: "event-marker-default",

											"project" 			: "project-marker-default",
											"projects" 			: "project-marker-default",

											"markerPlace" 		: "map-marker",

											"poi" 				: "poi-marker-default",
											"poi.video" 		: "poi-video-marker-default",
											"poi.link" 			: "poi-marker-default",
											"poi.geoJson" 		: "poi-marker-default",
											"poi.compostPickup" : "poi-marker-default",
											"poi.sharedLibrary" : "poi-marker-default",
											"poi.artPiece" 		: "poi-marker-default",
											"poi.recoveryCenter": "poi-marker-default",
											"poi.trash" 		: "poi-marker-default",
											"poi.history" 		: "poi-marker-default",
											"poi.something2See" : "poi-marker-default",
											"poi.funPlace" 		: "poi-marker-default",
											"poi.place" 		: "poi-marker-default",
											"poi.streetArts" 	: "poi-marker-default",
											"poi.openScene" 	: "poi-marker-default",
											"poi.stand" 		: "poi-marker-default",
											"poi.parking" 		: "poi-marker-default",

											"entry" 			: "entry-marker-default",
											"action" 			: "action-marker-default",

											"url" 				: "url-marker-default",

											"address" 			: "MARKER",

									  };

			this.icoMarkersTypes = { 		"default" 			: { ico : "circle", color : "yellow" 	},

										  	"news" 				: { ico : "rss", 			 color : "blue" 	},
										  	"idea" 				: { ico : "info-circle",	 color : "white" 	},
										  	"question" 			: { ico : "question-circle", color : "white" 	},
										  	"announce" 			: { ico : "ticket", 		 color : "white" 	},
										  	"information" 		: { ico : "newspaper-o", 	 color : "white" 	},

										  	"city" 				: { ico : "university", color : "red" 	},

										  	"citoyen" 			: { ico : "user", color : "yellow" 		},
										  	"citoyens" 			: { ico : "user", color : "yellow" 		},
										  	"people" 			: { ico : "user", color : "yellow" 		},
											"person" 			: { ico : "user", color : "yellow" 		},

											"NGO" 				: { ico : "group", color : "green" 		},
											"organizations" 	: { ico : "group", color : "green" 		},
											"organization" 		: { ico : "group", color : "green" 		},

											"event" 			: { ico : "calendar", color : "orange" 	},
											"events" 			: { ico : "calendar", color : "orange" 	},
											"meeting" 			: { ico : "calendar", color : "orange" 	},

											"project" 			: { ico : "lightbulb-o", color : "purple" },
											"projects" 			: { ico : "lightbulb-o", color : "purple" },

											"need" 				: { ico : "cubes", color : "white" },
											"needs" 			: { ico : "cubes", color : "white" },

											"markerPlace" 		: { ico : "map-marker", color : "red" 	},
											"me" 				: { ico : "map-marker", color : "blue" 	},

											"poi" 				: { ico : "info-circle", color : "dark" 	},
											"poi.video" 		: { ico : "video-camera", color : "dark" 	},

											"entry" 			: { ico : "gavel", color : "azure" 	},
											"action" 			: { ico : "cogs", color : "lightblue2" 	},

											"url" 				: { ico : "desktop", color : "blue" 	},

											"address" 			: { ico : "map-marker", color : "red" 	},

									  };

			//TODO : définir les icons et couleurs de chaque tag
			this.icoMarkersTags = { 		"default" 		: { ico : "tag", color : "grey" } };/*,
											"citoyens" 		: { ico : "square", color : "green" },
											"organization"  : { ico : "square", color : "blue" },
											"citoyen" 		: { ico : "square", color : "yellow" },
									  };*/
		}
		
		Sig.switchDropDown = function(panelId){		
			$(".panel_map").hide();
			$("#"+panelId).show(100);
		}

		Sig.vMarker = 1;
		Sig.initHomeBtn = function(){
			//initialise le bouton home 
			var thisSig = this;
			if(this.initParameters.useHomeButton){ //mylog.log("init btn home " + baseUrl + "/" + moduleId);
				$.ajax({
						url: baseUrl+"/"+moduleId+"/sig/getmyposition",
						type: "POST",
						dataType : "json",
						success: function(data){ 
							
							if(data != null){
								if(data.profilMarkerExists == true)
								data.profilMarkerImageUrl = "/upload/" + moduleId + data.profilMarkerImageUrl;// + "?v="+thisSig.vMarker;
								thisSig.vMarker++;
								var lng =  parseFloat(data.position.longitude);
								//mylog.log("MYPOSITION", data, lng);
								lng += 0.0004;
								data.position.longitude = new String(lng);
								thisSig.myPosition = data;
								//mylog.log("MYPOSITION", data, lng);
								thisSig.showMyPosition();
							}
							else{
								toastr.error("Impossible de trouver la position de l'utilisateur connecté");
							}
						}
					})
				
			}
		};

		Sig.getTypeSigOfData = function (data){
			var type = data["typeSig"] ?  data["typeSig"] :  data["type"];
			return type;
		};

		Sig.getIcoNameByType = function (data){
			var type = this.getTypeSigOfData(data);
			if(this.icoMarkersMap[type] != null){
					return this.icoMarkersMap[type];
			}else{  return this.icoMarkersMap['default']; }
		};

		Sig.getIcoByType = function (data){ //console.log("erzer", data);
			var type = this.getTypeSigOfData(data);
			if(this.icoMarkersTypes[type] != null){
					return this.icoMarkersTypes[type].ico;
			}else{  return this.icoMarkersTypes['default'].ico; }
		};

		Sig.getIcoColorByType = function (data){ //console.log("erzer", data);
			var type = this.getTypeSigOfData(data);
			if(this.icoMarkersTypes[type] != null){
					return this.icoMarkersTypes[type].color;
			}else{  return this.icoMarkersTypes['default'].color; }
		};

		Sig.getIcoNameByTag = function (tag){
			if(this.icoMarkersTags[tag] != null){
					return this.icoMarkersTags[tag].ico;
			}else{  return this.icoMarkersTags['default'].ico; }
		};

		Sig.getIcoColorByTag = function (tag){
			if(this.icoMarkersTags[tag] != null){
					return this.icoMarkersTags[tag].color;
			}else{  return this.icoMarkersTags['default'].color; }
		};
		Sig.getObjectId = function (object){ //mylog.dir(object); //alert(object.$id);
			if(object === null) return null; //if(object["type"] == "meeting") alert("trouvé !");
			if(typeof object == "undefined") return null; //if(object["type"] == "meeting") alert("trouvé !");

			var objectName = (typeof object.name != "undefined") ? this.clearStr(object.name) : "";

			if(object.type == "city") { return object.cp + object.insee + objectName; }
			if(object["@type"] == "city") { return object.cp + object.insee + objectName; }
			if(object.typeSig == "city") { return object.cp + object.insee + objectName; }
			if("undefined" != typeof object._id) 	return object._id.$id.toString();
			if("undefined" != typeof object.$id) 	return object.$id;
			if("undefined" != typeof object.id) 	return object.id;
			return null;
		};

		Sig.getThumbProfil = function (element){ 
			defaultType=this.getTypeSigOfData(element);
			if(element['typeSig']=="people")
				defaultType="citoyens";
			else if(notEmpty(element['typeSig']) && element['typeSig'].indexOf("poi.") >= 0){
				defaultType=element['typeSig'].split(".");
				defaultType=defaultType[1];
			}
			var imgProfilPath =  assetPath + "/images/thumb/default_"+defaultType+".png";
			if(typeof element.author !== "undefined" && typeof element.author.profilImageUrl !== "undefined" && element.author.profilImageUrl != "") 
				imgProfilPath = baseUrl + element.author.profilImageUrl;
			if(typeof element.profilThumbImageUrl !== "undefined" && element.profilThumbImageUrl != "") 
				imgProfilPath =  baseUrl + element.profilThumbImageUrl;
			if(typeof element.profilExternImageUrl !== "undefined" && element.profilExternImageUrl != "") 
				imgProfilPath = element.profilExternImageUrl;
			if( typeof element.typeSig !== "undefined" && element.typeSig == "city")
				imgProfilPath =  assetPath + "/images/city/city_default_l.png";
			return imgProfilPath;
		};

		Sig.centerSimple = function(center, zoom){
			this.map.panTo(center, {"animate" : false });
			//this.map.setZoom(zoom);
			var height = $("#mapCanvasBg").height();
			//mylog.log("height" + height);
			var center = height / 2;
			var pan = center - 160;
			//mylog.log("pan" + pan);
			//alert("yo");
			//this.map.panBy([0, pan], {"animate" : false });
			this.map.invalidateSize(false);
		};

		Sig.centerPopupMarker = function(coordinates, zoom){
			var thisSig = this;
			thisSig.map.panTo(coordinates, {"animate" : false });
			setTimeout(function(){  thisSig.map.setZoom(zoom); //Sig.map.panBy([0, -50]);
									setTimeout(function(){
										thisSig.map.panTo(coordinates, {"animate" : false });
										setTimeout(function(){ thisSig.map.panBy([0, -200]);}, 500);
										mylog.log("panBy 200");
									}, 700);
								}, 2000);
		};

		Sig.showRightToolMap = function(bool){
			if(bool){
				$("#right_tool_map").show();
			}else{
				$("#right_tool_map").hide();
			}
		};

		//***chargement
		//afficher / masquer l'icone de 
		Sig.showIcoLoading = function (loading){
			if(this.cssModuleName == "") return;
			if(loading == true) { $( this.cssModuleName + " #ico_reload").css({"display":"block"});	 }
	    	if(loading == false){ $( this.cssModuleName + " #ico_reload").css({"display":"none"});	 }
	 	};

	 	Sig.clearStr = function(str) { if(str == "" || str == null) return "";
 	 	  str = str.toLowerCase();
		  str = str.replace(/^\s+|\s+$/g, ''); // trim
		  str = str.toLowerCase();
		  
		  // remove accents, swap ñ for n, etc
		  var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
		  var to   = "aaaaeeeeiiiioooouuuunc------";
		  for (var i=0, l=from.length ; i<l ; i++) {
		    str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
		  }

		  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		    .replace(/\s+/g, '-') // collapse whitespace and replace by -
		    .replace(/-+/g, '-'); // collapse dashes

		  return str;
		};

		Sig.hideTools = function(){
			$(".sigModuleBg .tools-btn").hide();
			$(".sigModuleBg #right_tool_map").hide();

		};

		Sig.hidePopupContent = function(id){
			$("#popup"+id+" .city_item_map_list").hide(100);
			$("#popup"+id+" .country_item_map_list").hide(100);
			$("#popup"+id+" .btn-more").hide(100);
			$("#popup"+id+" .title_news_item_map_list").hide(100);
			$("#popup"+id+" .text_news_item_map_list").hide(100);
		}

		Sig.translation = {
			"people" 	: "Citoyens",
			"People" 	: "Citoyens",
			"Citoyen" 	: "Citoyen",
			"Citoyens" 	: "Citoyens",
			"citoyen" 	: "Citoyen",
			"citoyens" 	: "Citoyens",
			"CITOYEN" 	: "Citoyen",
			"CITOYENS" 	: "Citoyens",

			"organization"  : "Organisation",
			"organizations" : "Organisations",
			"Organization"  : "Organisation",
			"Organizations" : "Organisations",
			"ORGANIZATION"  : "Organisation",
			"ORGANIZATIONS" : "Organisations",

			"event"   : "Événement",
			"events"  : "Événements",
			"Event"   : "Événement",
			"Events"  : "Événements",
			"EVENT"   : "Événement",
			"EVENTS"  : "ÉvénementS",
			
			"project"   : "Projet",
			"projects"  : "Projets",
			"Project"   : "Projet",
			"Projects"  : "Projets",
			"PROJECT"   : "Projet",
			"PROJECTS"  : "Projets",
			
			"news"   : "Actualités",
			"News"   : "Actualités",
			"NEWS"   : "Actualités",
			
		}

		//translation
		Sig.t = function(string){
			return typeof this.translation[string] != "undefined" ? this.translation[string] : string;
		};




		return Sig;
	};
