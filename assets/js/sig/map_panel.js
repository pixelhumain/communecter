
	/**
	***		PANEL
	***/

	SigLoader.getSigPanel = function (Sig){

		//***
		//evenement click sur un item du panel
		this.Sig.changeFilter = function (val, thisMap)
		{
			var tagSelected = this.panelFilter.replace(/\s/g,"");
			if(this.panelFilter != "")
				$(this.cssModuleName + ' #item_panel_map_' + tagSelected).removeClass("selected");

			this.panelFilter = val;
			tagSelected = this.panelFilter.replace(/\s/g,"");

			$(this.cssModuleName + ' #item_panel_map_' + tagSelected).addClass("selected");

			this.showMapElements(thisMap, this.dataMap);
			this.zoomOnAllElements(thisMap);
		};

		//***
		//dé-zoom la carte pour afficher tous les éléments visibles
		this.Sig.zoomOnAllElements = function(thisMap){
			//alert(this.markersLayer.getBounds());
			thisMap.fitBounds(this.markersLayer.getBounds(), { 'maxZoom' : 14 });
			thisMap.zoomOut();
		};
		//***
		//memorise la liste de tags de tous les éléments affiché sur la carte (à partir des tags qu'on lui passe en paramètre)
		this.Sig.populatePanel = function(tags, objectId){
			var thisSig = this;
			if("undefined" == typeof tags) tags = new Array("all");
			//alert("tags : " + tags);
			$.each(tags, function(){
				thisSig.listPanel.push(this); //new Array(objectId);
			});
		};


		//***
		//affiche la liste des items dans le panel
		//et initialise l'événement click pour chaque item
		this.Sig.updatePanel = function(thisMap){ //alert("updatePanel : " + JSON.stringify(this.listPanel));
			var thisSig = this;
			$.each(this.listPanel, function(key, value){

				var valueId = value.replace(/\s/g,"");
				var ico = thisSig.getIcoNameByTag(value);
				var color = thisSig.getIcoColorByTag(value);

				//si l'item n'existe pas deja
				if(!$(thisSig.cssModuleName + ' #item_panel_map_' + valueId).length){ //on le rajoute...
					var newItem = "<button class='item_panel_map' id='item_panel_map_" + valueId + "'>" +
											     "<i class='fa fa-"+ ico + ' fa-'+ color + "'></i> " + value + //hidden-xs
											  "</button>";

					$(thisSig.cssModuleName + ' .panel_map').append(newItem);

					$(thisSig.cssModuleName + ' #item_panel_map_' + valueId).click(function(){
						thisSig.changeFilter(value, thisMap);
					});

				}

			});
		};


		return this.Sig;
	};
