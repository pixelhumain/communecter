
	/**
	***		RIGHT LIST MAP ELEMENT
	***/

	SigLoader.getSigRightList = function (Sig){

		//***
		//affiche dans la liste de droite seulement les éléments visibles sur la carte
		Sig.checkListElementMap = function (thisMap){ 	//alert("yo");
    	var thisSig = this;
    	//rend invisible tous les éléments de la liste (mais ne les supprime pas)
			$.each(this.elementsMap, function() {
				var objectId = thisSig.getObjectId(this);//console.log(objectId);
				$(thisSig.cssModuleName + " #element-right-list-" + objectId).css({ "display" : "none" });
			});

			var showElementOutOfMapView = !$(this.cssModuleName + " #chk-scope").is(':checked');
			//rend visible tous les éléments qui se trouve dans le bound visible de la carte
			$.each(thisSig.elementsMap,
				function() {
					var bounds = thisMap.getBounds();
					if( (this.geo.longitude > bounds.getSouthWest().lng && this.geo.longitude < bounds.getNorthEast().lng &&
						this.geo.latitude > bounds.getSouthWest().lat && this.geo.latitude < bounds.getNorthEast().lat)
						|| showElementOutOfMapView)
						{
							//si le champ de recherche par userName est rempli (n'est pas vide)
							if(this.name != null && $(thisSig.cssModuleName + ' #input_name_filter').val() != "") {
								//on affiche l'élément seulement s'il correspond à la recherche
								if(this.name.search(new RegExp($(thisSig.cssModuleName + ' #input_name_filter').val(), "i")) >= 0){
									$(thisSig.cssModuleName + " #element-right-list-" + this._id.$id.toString()).css({ "display" : "inline" });
								}
							}
							else //si le champs de recherche est vide, on affiche l'élément
							{
								$(thisSig.cssModuleName + " #element-right-list-" + thisSig.getObjectId(this)).css({"display" : "inline" });
						 	}
						 }
				});

		};


		//***
		//renvoi un item (html) pour la liste de droite
		Sig.createItemRigthListMap = function(element, thisMarker, thisMap){

			var thisSig = this;
			var objectId = thisSig.getObjectId(this);
			//rassemble le nom de la ville au CP
			var place = "";
			if(element['city'] != null) place += element['city'];
			if(element['city'] != null && element['cp'] != null) place += ", ";
			if(element['cp'] != null) place += element['cp'];

			//prépare le nom (ou "anonyme")
			var name = (element['name'] != null) ? element['name'] : "Anonyme";

			//récupère l'url de l'icon a afficher
			//var iconUrl = this.getIcoMarker(element['type']).options.iconUrl;

			var ico = thisSig.getIcoByType(element["type"]);
			var color = thisSig.getIcoColorByType(element["type"]);

			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

			/*var dropDown  = '';
			if("undefined" != typeof element["tags"])
			{
				dropDown  = '<a class="btn btn-xs dropdown-toggle btn-transparent-grey pull-right" data-toggle="dropdown"><i class="fa fa-tag"></i> <i class="fa fa-angle-down"></i> </a>';
				dropDown += '<ul role="menu" class="dropdown-menu dropdown-light pull-right dropdown-item-right-list">';

				$.each(element["tags"], function(){
					ico = thisSig.getIcoNameByTag(this);
					color = thisSig.getIcoColorByTag(this);

					dropDown += '<li><a href="#"> <i class="fa fa-'+ ico + ' fa-'+ color +'"></i> <span>'+element["tags"]+'</span> </a></li>';
					//dropDown += '<i class="fa fa-'+ ico + ' fa-'+ color +' pull-right"></i>';
				});

				dropDown += '</ul>';
			}*/

		/*	var dropDown = '<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown"><i class="fa fa-cog"></i> </a>
				            <ul role="menu" class="dropdown-menu dropdown-light pull-right">
				              <li><a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a></li>
				              <li><a href="#" class="panel-refresh"> <i class="fa fa-refresh"></i> <span>Refresh</span> </a></li>
				              <li><a data-toggle="modal" href="#panel-config" class="panel-config"> <i class="fa fa-wrench"></i> <span>Configurations</span></a></li>
				              <li><a href="#" class="panel-expand"> <i class="fa fa-expand"></i> <span>Fullscreen</span></a></li>
				            </ul>';
		*/

			//return l'élément html
		    var button = '<div class="element-right-list" id="element-right-list-'+thisSig.getObjectId(element)+'">' +
		    				'<button id="item_map_list_'+ thisSig.getObjectId(element) +'" class="item_map_list">'
		    					+ "<div class='left-col'>"
		    					+ 	"<div class='thumbnail-profil'></div>"						
		    					+ 	"<div class='ico-type-account'>"+icons+"</div>"
		    					
		    					+ "</div>"
								+ "<div class='right-col'>";
						
						if("undefined" != typeof name)
						button	+= 	"<div class='info_item pseudo_item_map_list'>" + name + "</div>";
						
						if("undefined" != typeof element['tags']){
							button	+= 	"<div class='info_item items_map_list'>";
							$.each(element['tags'], function(index, value){
								button	+= 	"<a href='#' class='tag_item_map_list'>#" + value + " </a>";
							});
							button	+= 	"</div>";
						}

						if("undefined" != typeof element['address'] && "undefined" != typeof element['address']['addressLocality'] )
						button	+= 	"<div class='info_item city_item_map_list'>" + element['address']['addressLocality'] + "</div>";
								
						if("undefined" != typeof element['address'] && "undefined" != typeof element['address']['addressCountry'] )
						button	+= 	"<div class='info_item country_item_map_list'>" + element['address']['addressCountry'] + "</div>";
								
						if("undefined" != typeof element['telephone'])
						button	+= 	"<div class='info_item telephone_item_map_list'>" + element['telephone'] + "</div>";
						
						/*if("undefined" != typeof element['links']){
							button	+= 	"<div class='items_map_list'>";
							$.each(element['tags'], function(index, value){
								button	+= 	"<div class='link_item_map_list'>" + value + "</div>";
							});
							button	+= 	"</div>";
						}*/

				button += 	'</button>' +
						 '<div>';

			$(this.cssModuleName + " #liste_map_element").append(button);


			//toastr.success(JSON.stringify(name + " " + markerPosition));
		};

		return Sig;
	};
