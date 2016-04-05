
	/**
	***		INITIALIZER
	***/

	SigLoader.getSigInitializer = function (Sig){

		//***
		//initialisation de l'interface et des événements (click, etc)
		Sig.initEnvironnement = function (thisMap, params){

			////console.log("initParams");
			////console.dir(params);

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
				$( this.cssModuleName + " #btn-zoom-in" )	 .click(function (){ 
					if(thisMap.getZoom() < thisSig.maxZoom) thisMap.zoomIn(); 
				});
				$( this.cssModuleName + " #btn-zoom-out" )	 .click(function (){ 
					if(thisMap.getZoom() > thisSig.minZoom) thisMap.zoomOut(); 
				});
			}

			//initialise les boutons zoom-in et zoom-out
			if(params.useHomeButton){
				this.initHomeBtn();
			}


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
						thisSig.tileLayer = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', 
														{maxZoom:17,
														 minZoom:3}).addTo(Sig.map);
						thisSig.map.minZoom = 0;
						thisSig.map.maxZoom = 17;
					}else if(thisSig.tileMode == "satellite"){
						thisSig.tileMode = "terrain";
						if(thisSig.tileLayer != null) thisSig.map.removeLayer(thisSig.tileLayer);
						thisSig.tileLayer = L.tileLayer(thisSig.initParameters.mapTileLayer, 
												{maxZoom:20,
												 minZoom:3}).addTo(Sig.map);
						thisSig.map.minZoom = 0;
						thisSig.map.maxZoom = 20;
					}
					if(thisSig.map.getZoom() > thisSig.map.getMaxZoom()) 
						thisSig.map.setZoom(thisSig.map.getMaxZoom());
				});
			}
		};

		Sig.loadIcoParams = function(){
			//TODO : définir les icons et couleurs de chaque type disponoble
			this.icoMarkersMap = { 		"default" 			: "CITOYEN_A",

										  	"city" 				: "COLLECTIVITE_A",
											
											"news" 				: "NEWS_A",

											"citoyen" 			: "CITOYEN_A",
											"citoyens" 			: "CITOYEN_A",
											"people" 			: "CITOYEN_A",

											"NGO" 				: "ASSO_A",
											"organizations" 	: "ASSO_A",
											"organization" 		: "ASSO_A",

											"event" 			: "EVENEMENTS_A",
											"events" 			: "EVENEMENTS_A",
											"meeting" 			: "EVENEMENTS_A",

											"project" 			: "PROJET_A",
											"projects" 			: "PROJET_A",

											"markerPlace" 		: "map-marker",

									  };

			this.icoMarkersTypes = { 		"default" 			: { ico : "circle", color : "yellow" 	},

										  	"news" 				: { ico : "rss", color : "blue" 	},

										  	"city" 				: { ico : "university", color : "red" 	},

										  	"citoyen" 			: { ico : "user", color : "yellow" 		},
										  	"citoyens" 			: { ico : "user", color : "yellow" 		},
										  	"people" 			: { ico : "user", color : "yellow" 		},

											"NGO" 				: { ico : "group", color : "green" 		},
											"organizations" 	: { ico : "group", color : "green" 		},
											"organization" 		: { ico : "group", color : "green" 		},

											"event" 			: { ico : "calendar", color : "orange" 	},
											"events" 			: { ico : "calendar", color : "orange" 	},
											"meeting" 			: { ico : "calendar", color : "orange" 	},

											"project" 			: { ico : "lightbulb-o", color : "purple" },
											"projects" 			: { ico : "lightbulb-o", color : "purple" },

											"markerPlace" 		: { ico : "map-marker", color : "red" 	},
											"me" 				: { ico : "map-marker", color : "blue" 	},

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
			$("#"+panelId).show(400);
		}

		Sig.vMarker = 1;
		Sig.initHomeBtn = function(){
			//initialise le bouton home 
			var thisSig = this;
			if(this.initParameters.useHomeButton){ //console.log("init btn home " + baseUrl + "/" + moduleId);
				$.ajax({
						url: baseUrl+"/"+moduleId+"/sig/getmyposition",
						type: "POST",
						dataType : "json",
						success: function(data){ 
							
							if(data != null){
								if(data.profilMarkerExists == true)
								data.profilMarkerImageUrl = "/upload/" + moduleId + data.profilMarkerImageUrl;// + "?v="+thisSig.vMarker;
								thisSig.vMarker++;
								thisSig.myPosition = data;

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

		Sig.getIcoByType = function (data){
			var type = this.getTypeSigOfData(data);
			if(this.icoMarkersTypes[type] != null){
					return this.icoMarkersTypes[type].ico;
			}else{  return this.icoMarkersTypes['default'].ico; }
		};

		Sig.getIcoColorByType = function (data){
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
		Sig.getObjectId = function (object){ //////console.dir(object); //alert(object.$id);
			if(object === null) return null; //if(object["type"] == "meeting") alert("trouvé !");
			if("undefined" != typeof object._id) 	return object._id.$id.toString();
			if("undefined" != typeof object.$id) 	return object.$id;
			if("undefined" != typeof object.id) 	return object.id;
			return null;
		};
		Sig.getThumbProfil = function (element){
			var imgProfilPath =  assetPath + "/images/news/profile_default_l.png";
			if(typeof element.author !== "undefined" && typeof element.author.profilImageUrl !== "undefined" && element.author.profilImageUrl != "") 
				imgProfilPath = baseUrl + "/" + moduleId + "/document/resized/50x50" + element.author.profilImageUrl;
			if(typeof element.profilImageUrl !== "undefined" && element.profilImageUrl != "") 
				imgProfilPath =  baseUrl + "/" + moduleId + "/document/resized/50x50" + element.profilImageUrl;
			if( typeof element.typeSig !== "undefined" && element.typeSig == "city")
				imgProfilPath =  assetPath + "/images/city/city_default_l.png";
			return imgProfilPath;
		};

		Sig.centerSimple = function(center, zoom){
			this.map.panTo(center, {"animate" : false });
			//this.map.setZoom(zoom);
			var height = $("#mapCanvasBg").height();
			//console.log("height" + height);
			var center = height / 2;
			var pan = center - 160;
			//console.log("pan" + pan);
			//alert("yo");
			//this.map.panBy([0, pan], {"animate" : false });
			this.map.invalidateSize(false);
		};

		//***chargement
		//afficher / masquer l'icone de 
		Sig.showIcoLoading = function (loading){
			if(this.cssModuleName == "") return;
			if(loading == true) { $( this.cssModuleName + " #ico_reload").css({"display":"block"});	 }
	    	if(loading == false){ $( this.cssModuleName + " #ico_reload").css({"display":"none"});	 }
	 	};

	 	Sig.clearStr = function(str) {
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
