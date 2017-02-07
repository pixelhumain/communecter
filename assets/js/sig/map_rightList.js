
	/**
	***		RIGHT LIST MAP ELEMENT
	***/

	SigLoader.getSigRightList = function (Sig){

		Sig.paginationNumPage = 1;
		Sig.paginationBy = 15;
		Sig.paginationNumPageMax = 0;

		Sig.changePagination = function (numPage){
			this.paginationNumPage = parseInt(numPage);
			this.paginationMin = (this.paginationNumPage - 1) * this.paginationBy;
			this.paginationMax = this.paginationMin + this.paginationBy;
			this.checkListElementMap(this.map);
			//mylog.log("change pagination : " + this.paginationMin + " - " + this.paginationMax + " - by : " + this.paginationBy + " - max : " + this.paginationNumPageMax);
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
				var objectId = thisSig.getObjectId(this);//mylog.log(objectId);
				$(thisSig.cssModuleName + " #element-right-list-" + objectId).css({ "display" : "none" });
			});

			var showElementOutOfMapView = true; // !$(this.cssModuleName + " #chk-scope").is(':checked');
			
			//var paginationIndex = this.paginationMin;
			var nbElement = 0;
			var nbVisible = 0;
			//rend visible tous les éléments qui se trouve dans le bound visible de la carte
			$.each(thisSig.elementsMap,
				function() {
					var bounds = thisMap.getBounds();
							
						if( //(this.geo.longitude > bounds.getSouthWest().lng && this.geo.longitude < bounds.getNorthEast().lng &&
							//this.geo.latitude > bounds.getSouthWest().lat && this.geo.latitude < bounds.getNorthEast().lat)
							//|| 
							showElementOutOfMapView)
							{
								var showThis = false;
								//si le champ de recherche par userName est rempli (n'est pas vide)
								if(this.name != null && $(thisSig.cssModuleName + ' #input_name_filter').val() != "") {
									//on affiche l'élément seulement s'il correspond à la recherche
										
										//mylog.log("SEARCH IN RIGHT LIST", nbVisible, nbElement);
										//mylog.dir(this);

										if(this.name.search(new RegExp($(thisSig.cssModuleName + ' #input_name_filter').val(), "i")) >= 0){
											showThis = true;
										}

										if(typeof this.address != "undefined")
										if(typeof this.address.addressLocality != "undefined")
										if(this.address.addressLocality.search(new RegExp($(thisSig.cssModuleName + ' #input_name_filter').val(), "i")) >= 0){
											showThis = true;
										}

										if(typeof this.tags != "undefined" && this.tags != null){
											$.each(this.tags, function() {
												var tag = this;
												if(tag.search(new RegExp($(thisSig.cssModuleName + ' #input_name_filter').val(), "i")) >= 0){
													showThis = true;
												}		
											});
										}

										//mylog.log("showThis", showThis);

										if(showThis == true){
											if(thisSig.inPagination(nbElement)){
												$(thisSig.cssModuleName + " #element-right-list-" + Sig.getObjectId(this)).css({ "display" : "inline" });							
												nbVisible++;
											}
											nbElement++;
										}
																	
								}
								else //si le champs de recherche est vide, on affiche l'élément
								{
									if(thisSig.inPagination(nbElement)){
										$(thisSig.cssModuleName + " #element-right-list-" + thisSig.getObjectId(this)).css({"display" : "inline" });
										nbVisible++;
									}	
									nbElement++;
								}
							 }
					
					
				});

			var maxPaginationBtn = 5;
			var nbTotal = nbElement; //thisSig.elementsMap.length;
			$(".right_tool_map_header_info").html(nbVisible + " / " + nbTotal);
			//mylog.log("nbTotalEment : " + nbTotal);
			if(nbTotal > this.paginationBy){

				var nbPage = nbTotal / this.paginationBy;
				this.paginationNumPageMax = nbPage;

				$("#pagination").html(
					"<li>"+
				      "<a href='javascript:' id='btn_pagination_previous' aria-label='Previous'>"+
				        "<span aria-hidden='true'>&laquo;</span>"+
				      "</a>"+
				    "</li>"
				);

				var dep = this.paginationNumPage - maxPaginationBtn;
				if(dep < 0) dep = 0;
				for(var i=dep; i<nbPage && i < dep+maxPaginationBtn; i++){
					
					var classe="";
					if(i+1 == this.paginationNumPage) classe="active";

					$("#pagination").append(
						'<li class="'+classe+'"><a href="javascript:" id="btn_pagination_'+i+'" page="'+(i+1)+'">'+(i+1)+'</a></li>'
						);

					$("#btn_pagination_"+i).click(function(){
						thisSig.changePagination($(this).attr("page"));
					});				
				}

				if(nbPage > maxPaginationBtn){
					$("#pagination").append('<li><a href="javascript:" class="'+classe+'">...</a></li>');
				}

				$("#pagination").append(
					"<li>"+
				      "<a href='javascript:' id='btn_pagination_next' aria-label='Next'>"+
				        "<span aria-hidden='true'>&raquo;</span>"+
				      "</a>"+
				    "</li>"
				);

				$("#btn_pagination_previous").click(function(){ thisSig.previousPagination(); });
				$("#btn_pagination_next").click(function(){ thisSig.nextPagination(); });

				//$("#lbl-chk-scope").removeClass("hidden");

			}else{
				$("#pagination").html("");
				this.paginationNumPage = 1;
				//$("#lbl-chk-scope").addClass("hidden");
			}
		};


		//***
		//renvoi un item (html) pour la liste de droite
		Sig.createItemRigthListMap = function(element, thisMarker, thisMap){

			var elemType = ("undefined" != typeof element['typeSig']) ? element['typeSig'] : "";

			if(elemType == "url") return this.createItemRigthListMapSiteurl(element, thisMarker, thisMap);
			if(elemType == "address") return this.createItemRigthListMapAddress(element, thisMarker, thisMap);
			//mylog.dir(element);

			var thisSig = this;
			var objectId = thisSig.getObjectId(this);
			var allElement = element;
			var element = (typeof element.author != "undefined") ? element.author : element;

			//rassemble le nom de la ville au CP
			var place = "";
			if(element['city'] != null) place += element['city'];
			if(element['city'] != null && element['cp'] != null) place += ", ";
			if(element['cp'] != null) place += element['cp'];

			//prépare le nom (ou "anonyme")
			var name = (element['name'] != null) ? element['name'] : (element['title'] != null) ? element['title'] : "Anonyme";

			//récupère l'url de l'icon a afficher
			var ico = thisSig.getIcoByType(allElement);
			var color = thisSig.getIcoColorByType(allElement);

			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';


			//recuperation de l'image de profil (ou image par defaut)
			var imgProfilPath =  Sig.getThumbProfil(element);


			//return l'élément html
		    var button = '<div class="element-right-list" id="element-right-list-'+thisSig.getObjectId(allElement)+'">' +
		    				'<button class="item_map_list item_map_list_'+ thisSig.getObjectId(allElement) +'">'
		    					+ "<div class='left-col'>"
		    					+ 	"<div class='thumbnail-profil'><img height=50 width=50 src='" + imgProfilPath + "'></div>"						
		    					+ 	"<div class='ico-type-account'>"+icons+"</div>"
		    					
		    					+ "</div>"
								+ "<div class='right-col'>";
						
						if("undefined" != typeof name)
						button	+= 	"<div class='info_item pseudo_item_map_list'>" + name + "</div>";
						
						
						if("undefined" != typeof allElement['tags'] && allElement['tags'] != null){
							button	+= 	"<div class='info_item items_map_list'>";
							var totalTags = 0;
							if(typeof allElement['tags'] != "undefined" && allElement['tags'] != null){
								$.each(allElement['tags'], function(index, value){ totalTags++;
									if(totalTags<4)
									button	+= 	"<a href='javascript:' class='tag_item_map_list'>#" + value + " </a>";
								});
							}
							button	+= 	"</div>";
						}

						if("undefined" != typeof element['address'] && "undefined" != typeof element['address']['addressLocality'] )
						button	+= 	"<div class='info_item city_item_map_list inline'>" + element['address']['addressLocality'] + "</div>";
								
						if("undefined" != typeof element['address'] && "undefined" != typeof element['address']['addressCountry'] )
						button	+= 	"<div class='info_item country_item_map_list inline'>" + element['address']['addressCountry'] + "</div>";
						
						if("undefined" != typeof element['cp'] )
						button	+= 	"<div class='info_item country_item_map_list inline' style='font-size: 15px; font-weight: 300;'>" + element['cp'] + "</div>";
								
						//if("undefined" != typeof element['telephone'])
						//button	+= 	"<div class='info_item telephone_item_map_list inline'>" + element['telephone'] + "</div>";
						
						
				button += 	'</div>';

				
				if(elemType == "event" || elemType == "events"){				
					button += displayStartAndEndDate(element);
				}

				if("undefined" != typeof allElement['text']){
					if("undefined" != typeof allElement['name']){
						button	+= 	"<div class='info_item title_news_item_map_list'>" + allElement['name'] + "</div>";
					}		
					button	+= 	"<div class='info_item text_item_map_list'>" + allElement['text'] + "</div>";
				}
				
				button += '<div class="separation"></div>';
				

				button += 	'</button>' +
						 '<div>';

			$(this.cssModuleName + " #liste_map_element").append(button);


			//toastr.success(JSON.stringify(name + " " + markerPosition));
		};

		//***
		//renvoi un item (html) pour la liste de droite
		Sig.createItemRigthListMapSiteurl = function(element, thisMarker, thisMap){

			var elemType = ("undefined" != typeof element['typeSig']) ? element['typeSig'] : "";

			//mylog.dir(element);

			var thisSig = this;
			var objectId = thisSig.getObjectId(this);
			var allElement = element;
			var element = (typeof element.author != "undefined") ? element.author : element;

			//rassemble le nom de la ville au CP
			var place = "";
			if(element['city'] != null) place += element['city'];
			if(element['city'] != null && element['cp'] != null) place += ", ";
			if(element['cp'] != null) place += element['cp'];

			//prépare le nom (ou "anonyme")
			var name = (element['name'] != null) ? element['name'] : (element['title'] != null) ? element['title'] : "Anonyme";
			
			//prépare l'url
			var url = (element['url'] != null) ? element['url'] : "";

			//prépare l'url
			var description = (element['description'] != null) ? element['description'] : "";

			//récupère l'url de l'icon a afficher
			var ico = thisSig.getIcoByType(allElement);
			var color = thisSig.getIcoColorByType(allElement);

			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';


			//recuperation de l'image de profil (ou image par defaut)
			var imgProfilPath =  Sig.getThumbProfil(element);

			//return l'élément html
		    var button = '<div class="element-right-list siteurl" id="element-right-list-'+thisSig.getObjectId(allElement)+'">' +
		    				'<button class="item_map_list item_map_list_'+ thisSig.getObjectId(allElement) +'">'
		    					
								+ "<div class='right-col'>";
						
						if("" != name)
						button	+= 	"<div class='info_item siteurl_title letter-blue'>" + name + "</div>";
						if("" != url)
						button	+= 	"<div class='info_item siteurl_url letter-green'>" + url + "</div>";
						if("" != description)
						button	+= 	"<div class='info_item siteurl_desc'>" + description + "</div>";
						
						var address = "";
						if("undefined" != typeof element['address']){
							if("undefined" != typeof element['address']['streetAddress'] || "undefined" != typeof element['address']['addressLocality'])
								address = "<i class='fa fa-map-marker' style='margin-left:-6px;'></i> ";

							address += element['address']['streetAddress'] ? element['address']['streetAddress'] : "";
							
							if(typeof element['address']['streetAddress'] != "undefined" && 
									element['address']['streetAddress'] != "" && 
									"undefined" != typeof element['address']['addressLocality'])
									address+=", ";

							address += element['address']['addressLocality'] ? element['address']['addressLocality'] : "";
						}
						
						if(address!="")
						button	+= 	"<div class='info_item siteurl_desc pull-left text-dark'>" + address + "</div>";
								
						
						
				button += 	'</div>';

				
				button += '<div class="separation"></div>';
				

				button += 	'</button>' +
						 '<div>';

			$(this.cssModuleName + " #liste_map_element").append(button);
			//toastr.success(JSON.stringify(name + " " + markerPosition));
		};

		//***
		//renvoi un item (html) pour la liste de droite
		Sig.createItemRigthListMapAddress = function(element, thisMarker, thisMap){

			var elemType = ("undefined" != typeof element['typeSig']) ? element['typeSig'] : "";

			//mylog.dir(element);

			var thisSig = this;
			var objectId = thisSig.getObjectId(this);
			var allElement = element;
			var element = (typeof element.author != "undefined") ? element.author : element;

			//rassemble le nom de la ville au CP
			var place = "";
			if(element['streetNumber'] != null) place += "<span class='letter-blue'>"+element['streetNumber']+"</span>";
			
			if(element['street'] != null) {
				if(place!="") place += " ";
				place += '<b>'+ element['street']+'</b>';
			}

			if(element['cityName'] != null) {
				if(place!="") place += " ";
				place +=  "<span class='letter-red'>"+element['cityName']+"</span>";
			}

			if(element['postalCode'] != null) {
				//if(place!="") place += " ";
				//place +=  "<span class='letter-'>"+element['postalCode']+"</span>";
			}

			
			//récupère l'url de l'icon a afficher
			var ico = thisSig.getIcoByType(allElement);
			var color = thisSig.getIcoColorByType(allElement);

			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

			//recuperation de l'image de profil (ou image par defaut)
			var imgProfilPath =  Sig.getThumbProfil(element);

			//return l'élément html
		    var button = '<div class="element-right-list siteurl" id="element-right-list-'+thisSig.getObjectId(allElement)+'">' +
		    				'<button class="item_map_list item_map_list_'+ thisSig.getObjectId(allElement) +'">'
		    				+ "<div class='padding-10 text-left'>";
						
						if(place != "")
						button	+= 	"<div class='info_item text-dark' style='font-size:14px;'>"+
										"<i class='fa fa-map-marker fa-2x letter-red' style='margin-left:-6px;'></i> " + 
										place + 
									"</div>";
						//if("" != url)
						//button	+= 	"<div class='info_item siteurl_url letter-green'>" + url + "</div>";
						//if("" != description)
						//button	+= 	"<div class='info_item siteurl_desc'>" + description + "</div>";
						
						// var address = "";
						// if("undefined" != typeof element['address']){
						// 	if("undefined" != typeof element['address']['streetAddress'] || "undefined" != typeof element['address']['addressLocality'])
						// 		address = "<i class='fa fa-map-marker' style='margin-left:-6px;'></i> ";

						// 	address += element['address']['streetAddress'] ? element['address']['streetAddress'] : "";
							
						// 	if(typeof element['address']['streetAddress'] != "undefined" && "undefined" != typeof element['address']['addressLocality'])
						// 		address+=", ";

						// 	address += element['address']['addressLocality'] ? element['address']['addressLocality'] : "";
						// }
						
						// if(address!="")
						// button	+= 	"<div class='info_item siteurl_desc pull-left text-dark'>" + address + "</div>";
														
						
				button += 	'</div>';

				
				button += '<div class="separation"></div>';
				
				button += 	'</button>' +
						 '<div>';

			$(this.cssModuleName + " #liste_map_element").append(button);
			//toastr.success(JSON.stringify(name + " " + markerPosition));
		};

		
		Sig.changePagination(1);

		return Sig;
	};
