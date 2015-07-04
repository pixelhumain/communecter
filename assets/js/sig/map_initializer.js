
	/**
	***		INITIALIZER
	***/

	SigLoader.getSigInitializer = function (Sig){

		//***
		//initialisation de l'interface et des événements (click, etc)
		Sig.initEnvironnement = function (thisMap, params){

	    	var thisSig = this;

	    	//memorise les paramètres dans une variable globale de l'instance SIG
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

				//initialise la position de la carte
				thisMap.setView(params.firstView.coordinates, params.firstView.zoom);

				//TODO : définir les icons et couleurs de chaque type disponoble
				thisSig.icoMarkersTypes = { 	"default" 			: { ico : "circle", color : "yellow" 	},

											  	"citoyen" 			: { ico : "smile-o", color : "yellow" 	},

												"NGO" 				: { ico : "group", color : "green" 		},
												"organizations" 	: { ico : "group", color : "green" 		},

												"events" 			: { ico : "circle", color : "red" 		},
												"meeting" 			: { ico : "calendar", color : "red" 	},

												"project" 			: { ico : "lightbulb-o", color : "blue" },

												"markerPlace" 		: { ico : "map-marker", color : "red" 	},

										  };

				//TODO : définir les icons et couleurs de chaque tag
				thisSig.icoMarkersTags = { 		"default" 		: { ico : "tag", color : "grey" } };/*,
												"citoyens" 		: { ico : "square", color : "green" },
												"organization"  : { ico : "square", color : "blue" },
												"citoyen" 		: { ico : "square", color : "yellow" },

										  };*/

				if(params.useRightList){
					//lorsque la vue de la carte change, on actualise la liste d'élément (rightList)
					thisMap.on('moveend', function(e) { thisSig.checkListElementMap(thisMap); });
					//losque on effectue une recherche dans le champs de texte
					$(this.cssModuleName + " #input_name_filter" ).keyup(function (){ thisSig.checkListElementMap(thisMap); });
					//lorsqu'on active/désactive le filtre par zone
					$(this.cssModuleName + " #chk-scope").click(function (){ thisSig.checkListElementMap(thisMap); });
				}

				//initialise les boutons zoom-in et zoom-out
				if(params.useZoomButton){
					$( this.cssModuleName + " #btn-zoom-in" )	 .click(function (){ thisMap.zoomIn(); });
					$( this.cssModuleName + " #btn-zoom-out" )	 .click(function (){ thisMap.zoomOut(); });
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
							$("#help-coordinates").html('lat lng : ' + pos.lat + ", " + pos.lng);
					});
				}

				if(params.usePanel){
					this.currentFilter = "all";
					$(this.cssModuleName + ' #item_panel_map_all').click(function(){
						thisSig.changeFilter('all', thisMap);
					});
				}

				this.initFindPlace();

		};

		Sig.initHomeBtn = function(){
			//initialise le bouton home
			var thisSig = this;
			if(this.initParameters.useHomeButton){
				var center = this.getCoordinates(this.dataMap, "markerSingle");
				if(center != null)
				$( this.cssModuleName + " #btn-home" )	 .click(function (){ thisSig.map.panTo(center); });
			}
		};

		Sig.getIcoNameByType = function (type){
			if(this.icoMarkersTypes[type] != null){
					return this.icoMarkersTypes[type].ico;
			}else{  return this.icoMarkersTypes['default'].ico; }
		};

		Sig.getIcoColorByType = function (type){
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
		Sig.getObjectId = function (object){ //console.dir(object); //alert(object.$id);
			if(object === null) return null;
			if("undefined" != typeof object._id) 	return object._id.$id.toString();
			if("undefined" != typeof object.$id) 	return object.$id;
			return null;
		};


		//***
		//afficher / masquer l'icone de chargement
		Sig.showIcoLoading = function (loading){
			if(this.cssModuleName == "") return;
			if(loading == true) { $( this.cssModuleName + " #ico_reload").css({"display":"block"});	 }
	    	if(loading == false){ $( this.cssModuleName + " #ico_reload").css({"display":"none"});	 }
	 	};



		return Sig;
	};
