
	/**
	***		RIGHT LIST MAP ELEMENT
	***/

	SigLoader.getSigRightList = function (Sig){

		Sig.paginationNumPage = 1;
		Sig.paginationBy = 10;
		Sig.paginationNumPageMax = 0;

		Sig.changePagination = function (numPage){
			this.paginationNumPage = parseInt(numPage);
			this.paginationMin = (this.paginationNumPage - 1) * this.paginationBy;
			this.paginationMax = this.paginationMin + this.paginationBy;
			this.checkListElementMap(this.map);
			console.log("change pagination : " + this.paginationMin + " - " + this.paginationMax + " - by : " + this.paginationBy + " - max : " + this.paginationNumPageMax);
			//alert("stop");
		};
		Sig.previousPagination = function (){
			if(this.paginationNumPage > 1)
			this.changePagination(this.paginationNumPage-1);
		};
		Sig.nextPagination = function (){ //alert(this.paginationNumPage);
			if(this.paginationNumPage < this.paginationNumPageMax)
			this.changePagination(this.paginationNumPage+1);
		};
		//permet de savoir si un element doit être affiché ou non dans la liste
		//en fonction de la pagination courante.
		Sig.inPagination = function(nbElement){
			return (nbElement >= this.paginationMin && nbElement < this.paginationMax);
		};

		//***
		//affiche dans la liste de droite seulement les éléments visibles sur la carte
		Sig.checkListElementMap = function (thisMap){
    	var thisSig = this;
    	//rend invisible tous les éléments de la liste (mais ne les supprime pas)
			$.each(this.elementsMap, function() {
				var objectId = thisSig.getObjectId(this);//console.log(objectId);
				$(thisSig.cssModuleName + " #element-right-list-" + objectId).css({ "display" : "none" });
			});

			var showElementOutOfMapView = !$(this.cssModuleName + " #chk-scope").is(':checked');
			
			//var paginationIndex = this.paginationMin;
			var nbElement = 0;
			//rend visible tous les éléments qui se trouve dans le bound visible de la carte
			$.each(thisSig.elementsMap,
				function() {
					var bounds = thisMap.getBounds();
					
					if(thisSig.inPagination(nbElement)){
							
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
					}
					else{

					}
					nbElement++;
				});

			var maxPaginationBtn = 5;
			if(nbElement > this.paginationBy){

				var nbPage = nbElement / this.paginationBy;
				this.paginationNumPageMax = nbPage;

				$("#pagination").html(
					"<li>"+
				      "<a href='#' id='btn_pagination_previous' aria-label='Previous'>"+
				        "<span aria-hidden='true'>&laquo;</span>"+
				      "</a>"+
				    "</li>"
				);

				var dep = this.paginationNumPage - maxPaginationBtn;
				if(dep < 0) dep = 0;
				for(var i=dep; i<nbPage && i < dep+maxPaginationBtn; i++){
					//alert("index : "+i);
					var classe="";
					if(i+1 == this.paginationNumPage) classe="active";
					$("#pagination").append(
						'<li class="'+classe+'"><a href="#" id="btn_pagination_'+i+'" page="'+(i+1)+'">'+(i+1)+'</a></li>'
						);

					$("#btn_pagination_"+i).click(function(){
						thisSig.changePagination($(this).attr("page"));
					});				
				}

				if(nbPage > maxPaginationBtn){
					$("#pagination").append('<li><a href="#" class="'+classe+'">...</a></li>');
				}

				$("#pagination").append(
					"<li>"+
				      "<a href='#' id='btn_pagination_next' aria-label='Next'>"+
				        "<span aria-hidden='true'>&raquo;</span>"+
				      "</a>"+
				    "</li>"
				);

				$("#btn_pagination_previous").click(function(){ thisSig.previousPagination(); });
				$("#btn_pagination_next").click(function(){ thisSig.nextPagination(); });

				$("#lbl-chk-scope").removeClass("hidden");

			}else{
				$("#lbl-chk-scope").addClass("hidden");
			}
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
			var ico = thisSig.getIcoByType(element["type"]);
			var color = thisSig.getIcoColorByType(element["type"]);

			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

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
						
				button += 	'</div><div class="separation"></div>';
				
				button += 	'</button>' +
						 '<div>';

			$(this.cssModuleName + " #liste_map_element").append(button);


			//toastr.success(JSON.stringify(name + " " + markerPosition));
		};

		
		Sig.changePagination(1);

		return Sig;
	};
