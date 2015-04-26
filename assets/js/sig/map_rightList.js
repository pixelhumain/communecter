	
	/**
	***		RIGHT LIST MAP ELEMENT
	***/
		
	SigLoader.getSigRightList = function (Sig){ 
		
		//***
		//affiche dans la liste de droite seulement les éléments visibles sur la carte
		Sig.checkListElementMap = function (thisMap){ 	
	    	
	    	//rend invisible tous les éléments de la liste (mais ne les supprime pas)
			$.each(this.elementsMap, function() { 
				$("#item_map_list_" + this._id.$id.toString()).css({ "display" : "none" });				
			});
			
			var showElementOutOfMapView = !$("#chk-scope").is(':checked');
			var thisSig = this;		
			//rend visible tous les éléments qui se trouve dans le bound visible de la carte
			$.each(thisSig.elementsMap, 
				function() { 	
					var bounds = thisMap.getBounds();
					thisSig.currentFilter = "all";
					if( this.type == thisSig.currentFilter || thisSig.currentFilter == "all"){								
					if( (this.geo.longitude > bounds.getSouthWest().lng && this.geo.longitude < bounds.getNorthEast().lng && 
						this.geo.latitude > bounds.getSouthWest().lat && this.geo.latitude < bounds.getNorthEast().lat) 
						|| showElementOutOfMapView)
						{	
							//si le champ de recherche par userName est rempli (n'est pas vide)
							if(this.name != null && $('#input_name_filter').val() != "") {
								//on affiche l'élément seulement s'il correspond à la recherche
								if(this.name.search(new RegExp($('#input_name_filter').val(), "i")) >= 0){
									$("#item_map_list_" + this._id.$id.toString()).css({ "display" : "inline" });	
								}	
							}
							else //si le champs de recherche est vide, on affiche l'élément
							{
								$("#item_map_list_" + this._id.$id.toString()).css({"display" : "inline" });	
						 	}
						 }
					}
				});
					
		};
		
		
		//***
		//renvoi un item (html) pour la liste de droite
		Sig.createItemRigthListMap = function(element, marker){
			
			var thisSig = this;
			//rassemble le nom de la ville au CP
			var place = "";
			if(element['city'] != null) place += element['city'];
			if(element['city'] != null && element['cp'] != null) place += ", ";	
			if(element['cp'] != null) place += element['cp'];
			
			//prépare le nom (ou "anonyme")
			var name = (element['name'] != null) ? element['name'] : "Anonyme";
			
			//récupère l'url de l'icon a afficher
			//var iconUrl = this.getIcoMarker(element['type']).options.iconUrl;
			
			var ico = thisSig.getIcoNameByType(element["type"]);
			var color = thisSig.getIcoColorByType(element["type"]);
				
			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';
			
			if("undefined" != typeof element["tags"]){
				$.each(element["tags"], function(){
					ico = thisSig.getIcoNameByTag(this);
					color = thisSig.getIcoColorByTag(this);
					
					icons += '<i class="fa fa-'+ ico + ' fa-'+ color +' pull-right"></i>';
				});
			}
			//return l'élément html
				return '<button id="item_map_list_'+ element._id.$id.toString() +'" class="item_map_list">' 
								+ icons
								+  ' <div class="pseudo_item_map_list">' +	name + "</div>"	
								+  ' <div class="city_item_map_list">' +	place + "</div>"	+
					   '</button>';	
			
		};	
		
		return Sig;
	};
		