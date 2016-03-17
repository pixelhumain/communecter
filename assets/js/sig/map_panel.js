
	/**
	***		PANEL
	***/

	SigLoader.getSigPanel = function (Sig){

		//***
		//evenement click sur un item du panel
		this.Sig.changeFilter = function (val, thisMap, filterType)
		{
			//console.dir(this.panelFilter);
			var tagSelected = ""; //this.panelFilter.replace(/\s/g,"");
			
			this.panelFilterType = filterType;

			if(filterType == "tags"){
				if(this.panelFilter != "")
					$(this.cssModuleName + ' .item_panel_map').removeClass("selected");

				this.panelFilter = val;
				tagSelected = this.panelFilter.replace(/[^A-Za-z0-9]/g,"");

				$(this.cssModuleName + ' #item_panel_map_' + tagSelected).addClass("selected");
			}

			if(filterType == "types"){
				if(this.panelFilter != "")
					$(this.cssModuleName + ' .item_panel_map').removeClass("selected");

				this.panelFilter = val;
				tagSelected = this.panelFilter.replace(/[^A-Za-z0-9]/g,"");

				$(this.cssModuleName + ' #item_panel_filter_' + tagSelected).addClass("selected");
			}
			this.showMapElements(thisMap, this.dataMap);
			this.zoomOnAllElements(thisMap);
		};

		//***
		//dé-zoom la carte pour afficher tous les éléments visibles
		this.Sig.zoomOnAllElements = function(thisMap){
			////console.dir(this.markersLayer.getBounds());
			if(this.markersLayer.getBounds() != null){
				thisMap.fitBounds(this.markersLayer.getBounds(), { 'maxZoom' : 14 });
				thisMap.zoomOut();
				thisMap.invalidateSize(false);
			}
		};
		//***
		//memorise la liste de tags de tous les éléments affiché sur la carte (à partir des tags qu'on lui passe en paramètre)
		this.Sig.populatePanel = function(data, objectId){
			var thisSig = this;

			var tags = new Array();
			var types = new Array();
			var typeSig = new Array();
			
			if("undefined" != typeof data["tags"]) tags = data["tags"];
			//if("undefined" != typeof data["type"]) types = new Array(data["type"]);
			if("undefined" != typeof data["typeSig"]) typeSig = new Array(data["typeSig"]);
			else typeSig = new Array(data["type"]);

			
			if("undefined" != typeof tags && tags != null)
			$.each(tags, function(index, value){
				//console.log(value);
				thisSig.listPanel["tags"].push(value); //new Array(objectId);
			});
			
			//if("undefined" != typeof typeSig)
			$.each(typeSig, function(index, value){
				thisSig.listPanel["types"].push(value); //new Array(objectId);
			});

			//thisSig.listPanel["types"].push(typeSig);
			//console.dir(thisSig.listPanel);
			
		};


		//***
		//affiche la liste des items dans le panel
		//et initialise l'événement click pour chaque item
		this.Sig.updatePanel = function(thisMap){ //alert("updatePanel : " + JSON.stringify(this.listPanel));
			console.warn("--------------- updatePanel ---------------------");
			////console.log(this.listPanel);
			var thisSig = this;
			////console.log(thisSig.listPanel["tags"].length);
			if("undefined" != typeof thisSig.listPanel["tags"] && thisSig.listPanel["tags"] != null)
				$.each(thisSig.listPanel["tags"], function(key, value){
				////console.warn("--------------- each tags ---------------------" + value);
			
				var valueId = value.replace(/[^A-Za-z0-9]/g,"");
				var ico = thisSig.getIcoNameByTag(value);
				var color = thisSig.getIcoColorByTag(value);

				//si l'item n'existe pas deja
				if(!$(thisSig.cssModuleName + ' #item_panel_map_' + valueId).length){ //on le rajoute...
					var newItem = "<button class='item_panel_map' id='item_panel_map_" + valueId + "'>" +
								     "<i class='fa fa-"+ ico + ' fa-'+ color + "'></i> " + value + //hidden-xs
								  "</button>";

					$(thisSig.cssModuleName + ' #panel_map').append(newItem);

					$(thisSig.cssModuleName + ' #item_panel_map_' + valueId).click(function(){
						thisSig.changeFilter(value, thisMap, "tags");
					});

				}

			});

			$.each(thisSig.listPanel["types"], function(key, value){

				//console.warn("--------------- each types ---------------------" + value);
				var valueId = value;//.replace(/\s/g,"");
				var ico = thisSig.getIcoByType({typeSig:value});
				var color = "white"; //thisSig.getIcoColorByType({typeSig:value});
				
				//si l'item n'existe pas deja
				if(!$(thisSig.cssModuleName + ' #item_panel_filter_' + valueId).length){ //on le rajoute...
					var newItem = "<button class='item_panel_map' id='item_panel_filter_" + valueId + "'>" +
											     "<i class='fa fa-"+ ico + ' fa-'+ color + "'></i> " + Sig.t(value) + //hidden-xs
											  "</button>";

					$(thisSig.cssModuleName + ' #panel_filter').append(newItem);

					$(thisSig.cssModuleName + ' #item_panel_filter_' + valueId).click(function(){
						thisSig.changeFilter(value, thisMap, "types");
					});

				}

			});
		};


		return this.Sig;
	};
