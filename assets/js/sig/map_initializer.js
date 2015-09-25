
	/**
	***		INITIALIZER
	***/

	SigLoader.getSigInitializer = function (Sig){

		//***
		//initialisation de l'interface et des événements (click, etc)
		Sig.initEnvironnement = function (thisMap, params){

			console.log("initParams");
			console.dir(params);

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
			thisSig.icoMarkersMap = { 		"default" 			: "user",

										  	"citoyen" 			: "user",

											"NGO" 				: "asso",
											"organizations" 	: "asso",

											"event" 			: "event",
											"events" 			: "event",
											"meeting" 			: "event",

											"project" 			: "project",

											"markerPlace" 		: "map-marker",

									  };

			thisSig.icoMarkersTypes = { 	"default" 			: { ico : "circle", color : "yellow" 	},

										  	"citoyen" 			: { ico : "user", color : "yellow" 		},

											"NGO" 				: { ico : "group", color : "green" 		},
											"organizations" 	: { ico : "group", color : "green" 		},

											"event" 			: { ico : "calendar", color : "red" 	},
											"events" 			: { ico : "calendar", color : "red" 	},
											"meeting" 			: { ico : "calendar", color : "white" 	},

											"project" 			: { ico : "lightbulb-o", color : "yellow" },

											"markerPlace" 		: { ico : "map-marker", color : "red" 	},
											"me" 				: { ico : "map-marker", color : "blue" 	},

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
						$("#help-coordinates").html('lat lng : ' + pos.lat + ", " + pos.lng);
				});
			}

			if(params.usePanel){
				
				this.currentFilter = "all";
				
				$(this.cssModuleName + ' #item_panel_map_all').click(function(){
					thisSig.changeFilter('all', thisMap, "tags");
				});

				$("#btn-tags").click(function(){
					thisSig.switchDropDown("panel_map");
				});

				$(thisSig.cssModuleName + ' #mapCanvas' + this.sigKey).focus(function(event) {
					$(thisSig.cssModuleName + ' #panel_map').css({'display':'none'});
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
			}

			if(params.useResearchTools){
				this.initFindPlace();
			}


		};

		
		Sig.switchDropDown = function(panelId){
			if($("#"+panelId).css("display") == "none") {

				//ferme toutes les dropdown
				$(".panel_map").css("display", "none");
				
				$("#"+panelId).css("display", "block");
				$("#"+panelId).css("opacity", "0");

				var el = $('#'+panelId),
				    curHeight = el.height(),
				    autoHeight = el.css('height', 'auto').height();
					el.height(curHeight);
				$("#"+panelId).animate({
					opacity: "1",
					height: autoHeight+30
					}, 300, 
					function() {
				    	$("#"+panelId).css("opacity", "1");
							// Animation complete.
				    		//$("#panel_filter").css("display", "block");
				 		}
				 );
			}
			else{
				$("#"+panelId).animate({
					opacity: "0",
					height: "0"
					}, 300, 
					function() {
				    		// Animation complete.
				    		$("#"+panelId).css("display", "none");
				 		}
				 );
			}

		}
		Sig.initHomeBtn = function(){
			//initialise le bouton home 
			var thisSig = this;
			if(this.initParameters.useHomeButton){ console.log("init btn home " + baseUrl + "/" + moduleId);
				$.ajax({
						url: baseUrl+"/"+moduleId+"/sig/getmyposition",
						type: "POST",
						dataType : "json",
						success: function(data){ 
							
							console.log("my position : ");
							console.dir(data);

							if(data != null){
								var center = [data.position.latitude, data.position.longitude];
								if(center != null){

									var properties = { 	id : "0",
														icon : thisSig.getIcoMarkerMap({"type" : data.type}),
														content: "" };

									var marker = thisSig.getMarkerSingle(thisSig.map, properties, center);

									$( "#btn-home" ).click(function (){ 
											console.log("pan to my position :");
											console.dir(center);
											thisSig.map.panTo(center); 
											thisSig.map.setZoom(16);
									});
								}
							}else{
								toastr.error("Impossible de trouver la position de l'utilisateur connecté");
							}
						}
					})
				
			}
		};

		Sig.getIcoNameByType = function (type){
			if(this.icoMarkersMap[type] != null){
					return this.icoMarkersMap[type];
			}else{  return this.icoMarkersMap['default']; }
		};

		Sig.getIcoByType = function (type){
			if(this.icoMarkersMap[type] != null){
					return this.icoMarkersTypes[type].ico;
			}else{  return this.icoMarkersTypes['default'].ico; }
		};

		Sig.getIcoColorByType = function (type){
			if(this.icoMarkersTypes[type] != null){
					return this.icoMarkersTypes[type].color;
			}else{  return this.icoMarkersTypes['default'].color; }
		};

		Sig.getIcoByType = function (type){
			if(this.icoMarkersTypes[type] != null){
					return this.icoMarkersTypes[type].ico;
			}else{  return this.icoMarkersTypes['default'].ico; }
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
		Sig.getObjectId = function (object){ ////console.dir(object); //alert(object.$id);
			if(object === null) return null; //if(object["type"] == "meeting") alert("trouvé !");
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
