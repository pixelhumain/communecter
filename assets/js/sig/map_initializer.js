	
	/**
	***		RIGHT LIST MAP ELEMENT
	***/
		
	SigLoader.getSigInitializer = function (Sig){ 
		
		//***
		//initialisation de l'interface et des événements (click, etc)
		Sig.initEnvironnement = function (thisMap, params){ 	
	    	
	    	var thisSig = this;
	    	
	    	//memorise les paramètres dans une variable globale de l'instance SIG
	    	thisSig.initParmerters = params;
	    	
	    	//mémorise le nom (identifiant css classe) utilisé pour cette instance
	    	thisSig.cssModuleName = ".sigModule" + params.sigKey;
	
			//mémorise la liste des éléments non clusturisés
			thisSig.notClusteredTag = params.notClusteredTag;		
			
			//initialise la position de la carte
			thisMap.setView(params.firstView.coordinates, params.firstView.zoom);
		
			
			if(params.useRightList){
				//lorsque la vue de la carte change, on actualise la liste d'élément (rightList)
				thisMap.on('moveend', function(e) { thisSig.checkListElementMap(thisMap); }); 
				//losque on effectue une recherche dans le champs de texte
				$(this.cssModuleName + " #input_name_filter" ).keyup(function (){ thisSig.checkListElementMap(thisMap); });
				//lorsqu'on active/désactive le filtre par zone
				$(this.cssModuleName + " #chk-scope")		 .click(function (){ thisSig.checkListElementMap(thisMap); });	
			}
			
			//initialise les boutons zoom-in et zoom-out
			if(params.useZoomButton){
				$( this.cssModuleName + " #btn-zoom-in" )	 .click(function (){ thisMap.zoomIn(); });
				$( this.cssModuleName + " #btn-zoom-out" )	 .click(function (){ thisMap.zoomOut(); });
			}
			
			//affiche les coordonnées d'un click , dans une zone sous la carte (utile pour récupérer des coordonnées rapidement)				
			if(params.useHelpCoordinates){
				thisMap.on('click', function(e) {
						var pos = e.latlng;
						$("#help-coordinates").html('lat lng : ' + pos.lat + ", " + pos.lng);
				}); 
			}
			
			//quand on veut une map full screen, il est nécessaire de la resizer "à la main"
			if(params.useFullScreen){
				thisSig.resizeMap();		
			}
		};
		
		//***
		//afficher / masquer l'icone de chargement
		Sig.showIcoLoading = function (loading){ if(this.cssModuleName == "") return;
			if(loading == true) { $( this.cssModuleName + " #ico_reload").css({"display":"block"});	 }
	    	if(loading == false){ $( this.cssModuleName + " #ico_reload").css({"display":"none"});	 }
	 	};
	 	
		return Sig;
	};
		