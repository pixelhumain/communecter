
	/**
	***		POPUP CONTENT
	***/

	SigLoader.getSigPopupContent = function (Sig){

		//##
		//création du contenu de la popup d'un data
		Sig.getPopup = function(data){
			//console.log("typeSIG POPUP" + data["typeSig"]);
			if(typeof(data.typeSig) != "undefined" && data.typeSig == "news"){
				return this.getPopupSimpleNews(data);
			}else if(typeof(data.typeSig) != "undefined" && data.typeSig == "city"){
				return this.getPopupSimpleCity(data);
			}else{
				return this.getPopupSimple(data);
			}

			/*	if(data["@Type"] == "event" || data["type"] == "event" || data["type"] == "meeting") {
					return this.getPopupEvent(data);
				}
				else{
					return this.getPopupCitoyen(data);
				}*/
		};
		//##
		//création du contenu de la popup d'un data
		Sig.getPopupCitoyen = function(data){

			var type = data['type'] ? data['type'] : "";
			var imgProfilPath =  Sig.getThumbProfil(data);

			var popupContent = "";
			//if(data['thumb_path'] != null)
			popupContent += "<div class='popup-info-profil-thumb-lbl'><img src='" + imgProfilPath + "' height=100 class='popup-info-profil-thumb "+type+"'></div>";
			//else
			//popupContent += "<div class='popup-info-profil-thumb-lbl'><img src='"+assetPath+"/images/thumb/default.png' width=100 class='popup-info-profil-thumb "+type+"'></div>";


			//NOM DE L'UTILISATEUR
			if(data['name'] != null){
				var userUrl = data['publicUrl'] ? data['publicUrl'] : "#";
				popupContent += 	"<div class='popup-info-profil-username'><a href='"+ userUrl +"' class='"+type+"'>" + data['name'] + "</a></div>";
			}

			//TYPE D'UTILISATEUR (data, ASSO, PARTENAIRE, ETC)
			var typeName = data['type'];
			if(typeName == null)  typeName = "data";
			if(data['name'] == null)  typeName += " Anonyme";

			popupContent += 	"<div class='popup-info-profil-usertype'>" + typeName + "</div>";

			//WORK - PROFESSION
			if(data['work'] != null)
			popupContent += 	"<div class='popup-info-profil-work'>" + data['work'] + "</div>";
			//else
			//popupContent += 	"<div class='popup-info-profil-work'>Fleuriste</div>";

			//URL
			if(data['url'] != null)
			popupContent += 	"<div class='popup-info-profil-url'>" + data['url'] + "</div>";
			//else
			//popupContent += 	"<a href='http://www.google.com' class='popup-info-profil-url'>http://www.google.com</a>";

			if(data['address'] != null){
				//CODE POSTAL 
				if(data['address']['postalCode'] != null)
				popupContent += 	"<div class='popup-info-profil'>" + data['address']['postalCode'] + "</div>";
				//else
				//popupContent += 	"<div class='popup-info-profil'>98800</div>";

				//VILLE ET PAYS
				if(data['address']['addressLocality'] != null){
					var place = data['address']['addressLocality'];
					if(place != null && data['address']['addressCountry'] != null) //place += ", ";
					place += ", " + data['address']['addressCountry'];
				}

				if(place != null)
				popupContent += 	"<div class='popup-info-profil'>" + place + "</div>";
				//else
				//popupContent += 	"<div class='popup-info-profil'>St-Denis, La Réunion</div>";
			}

			//NUMÉRO DE TEL
			/*if(data['telephone'] != null)
			popupContent += 	"<div class='popup-info-profil'>" + data['telephone'] + "<div/>";
			//else
			popupContent += 	"<div class='popup-info-profil'>0123456789<div/>";*/

			if(typeof data["telephone"] != "undefined"){
				var telephone = "" ;
				if(typeof data["telephone"] == "object"){

					if(typeof data["telephone"]["fixe"] != "undefined"){
						$.each(data["telephone"]["fixe"], function(key, value){
			  				/*if(telephone != "")
								telephone += ", ";
							telephone += value ;*/
							popupContent += "<div class='popup-info-profil'>" + value + "</div>";
			  			});
					}

					if(typeof data["telephone"]["mobile"] != "undefined")
					{
						$.each(data["telephone"]["mobile"], function(key, value){
			  				/*if(telephone != "")
								telephone += ", ";
							telephone += value ;*/
							popupContent += "<div class='popup-info-profil'>" + value + "</div>";
			  			});
					}
				}
				else
				{
					if(typeof data["telephone"] == "string"){
						popupContent += "<div class='popup-info-profil'>" + data["telephone"] + "</div>";
					}
				}
				//popupContent += "<div class='popup-info-profil'>" + telephone + "<div/>";
			}

			return popupContent;
		};

		//##
		//création du contenu de la popup d'un data
		var action = "detail";
		if(location.hash == "#default.simplydirectory") action = "simply";
		Sig.getPopupSimple = function(data){
			
			var type = typeof data['typeSig'] != "undefined" ? data['typeSig'] : data['type'];
			var id = this.getObjectId(data); //typeof data["_id"]["$id"] != "undefined" ? data['_id']['$id'] : null;
			var popupContent = "<div class='popup-marker'>";
	
			var ico = this.getIcoByType(data);
			var color = this.getIcoColorByType(data);
			var imgProfilPath =  Sig.getThumbProfil(data);
			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';
			//console.log("type de donnée sig : ",type);
			
			var typeElement = "";
			if(type == "people") 		typeElement = "person";
			if(type == "citoyens") 		typeElement = "person";
			if(type == "organizations") typeElement = "organization";
			if(type == "events") 		typeElement = "event";
			if(type == "projects") 		typeElement = "project";
			//console.log("type", type);
			
			
			
			var icon = 'fa-'+ this.getIcoByType(data);

			var onclick = "";
			var url = '#'+typeElement+'.'+action+'.id.'+id;
			onclick = 'loadByHash("'+url+'");';
			

			popupContent += "<button class='item_map_list popup-marker' id='popup"+id+"' onclick='"+onclick+"'>";
										
			popupContent += 
						  "<div class='left-col'>"
	    				+ 	"<div class='thumbnail-profil'><img src='" + imgProfilPath + "' height=50 width=50 class='popup-info-profil-thumb'></div>"						
	    				+ 	"<div class='ico-type-account'>"+icons+"</div>"					
	    				+ "</div>"

						+ "<div class='right-col'>";
						
						if("undefined" != typeof data['name'])
						popupContent	+= 	"<div class='info_item pseudo_item_map_list'>" + data['name'] + "</div>";
						
						if("undefined" != typeof data['tags']){
							popupContent	+= 	"<div class='info_item items_map_list'>";
							var totalTags = 0;
							if(data.length > 0){
								$.each(data['tags'], function(index, value){ totalTags++;
									if(totalTags<4)
									popupContent	+= 	"<div class='tag_item_map_list'>#" + value + " </div>";
								});
							}
							popupContent	+= 	"</div>";
						}

						if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['addressLocality'] )
						popupContent	+= 	"<div class='info_item city_item_map_list'>" + data['address']['addressLocality'] + "</div>";
								
						if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['addressCountry'] )
						popupContent	+= 	"<div class='info_item country_item_map_list'>" + data['address']['addressCountry'] + "</div>";
								
						//if("undefined" != typeof data['telephone'])
						//popupContent	+= 	"<div class='info_item telephone_item_map_list'>" + data['telephone'] + "</div>";
						
						if(typeof data["telephone"] != "undefined"){
							var telephone = "" ;
							if(typeof data["telephone"] == "object"){

								if(typeof data["telephone"]["fixe"] != "undefined"){
									$.each(data["telephone"]["fixe"], function(key, value){
						  				/*if(telephone != "")
											telephone += ", ";
										telephone += value ;*/
										popupContent += "<div class='info_item telephone_item_map_list'>" + value + "</div>";
						  			});
								}

								if(typeof data["telephone"]["mobile"] != "undefined")
								{
									$.each(data["telephone"]["mobile"], function(key, value){
						  				/*if(telephone != "")
											telephone += ", ";
										telephone += value ;*/
										popupContent += "<div class='info_item telephone_item_map_list'>" + value + "</div>";
						  			});
								}
							}
							else
							{
								if(typeof data["telephone"] == "string"){
									popupContent += "<div class='info_item telephone_item_map_list'>" + data["telephone"] + "</div>";
								}
							}
							//popupContent += "<div class='popup-info-profil'>" + telephone + "<div/>";
						}
						
				popupContent += '</div>';

				var dataType = ("undefined" != typeof data['typeSig']) ? data['typeSig'] : "";

				if(dataType == "event" || dataType == "events"){				
					if("undefined" != typeof data['startDate'] && "undefined" == typeof data['endDate'])
					popupContent	+= 	"<div class='info_item startDate_item_map_list'><i class='fa fa-caret-right'></i> " + dateToStr(data['startDate'], "fr", false) + "</div>";
					
					if("undefined" != typeof data['startDate'] && "undefined" != typeof data['endDate']){
						var start = dateToStr(data['startDate'], "fr", true);
						var end = dateToStr(data['endDate'], "fr", true);

						//si la date de debut == la date de fin
						if( start.substr(0, start.indexOf("-")) == end.substr(0, end.indexOf("-"))){
							var date1 = start.substr(0, start.indexOf("-"));
							var hour1 = start.substr(start.indexOf("-")+2, start.length);
							var hour2 = end.substr(end.indexOf("-")+2, end.length);
							popupContent += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Le " + date1;
							//console.log('hour1', hour1, "hour2", hour2);
							if(hour1 == "00h00" && hour2 == "23h59") 
								popupContent += "</br><i class='fa fa-caret-right'></i> Toute la journée";
							else
								popupContent += "</br><i class='fa fa-caret-right'></i> " + hour1 + " - " + hour2;// + "|" + start + "|";

							popupContent += "</div>";
						}else{
							popupContent += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Du " + start + "</div>"
								   +  "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Au " + end + "</div></br>";
						}
					}
				}
				popupContent += '<div class="btn btn-sm btn-more col-md-12"><i class="fa fa-hand-pointer-o"></i> en savoir +</div>';
				popupContent += '</button>';



			return popupContent;
		};

		//##
		//création du contenu de la popup d'un data de type News
		Sig.getPopupSimpleNews = function(data){

			var allData = data;
			data = data.author;
			//console.log("typeSig : " + allData['typeSig']);
			var type = allData['typeSig'] ? allData['typeSig'] : allData['type'];
			var id = this.getObjectId(data);
			var popupContent = "<div class='popup-marker'>";
	
			var ico = this.getIcoByType(allData);
			var color = this.getIcoColorByType(allData);
			var imgProfilPath =  Sig.getThumbProfil(data);

			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

			//var prop = feature.properties;
			//console.log("PROPRIETES : ");
			
			//showMap(false);

			//var type = data.typeSig;
			var typeElement = "";
			if(type == "people") 		typeElement = "person";
			if(type == "citoyens") 		typeElement = "person";
			if(type == "organizations") typeElement = "organization";
			if(type == "events") 		typeElement = "event";
			if(type == "projects") 		typeElement = "project";
			if(type == "news") 			typeElement = "news";
			
			var url = '/'+typeElement+'/detail/id/'+id;
			if(typeElement == "news") url = '/'+typeElement+'/latest/id/'+id;
			
			var title = data.typeSig + ' : ' + data.name;
			title = title.replace("'", "");
			title = title.replace('"', "");

			var icon = 'fa-'+ this.getIcoByType(data);
			popupContent += "<button class='item_map_list popup-marker' id='popup"+id+"' onclick='openMainPanel(\""+url+"\",\"" + title + "\",\"" + icon + "\", \""+id+"\");'>";
										
			popupContent += 
						  "<div class='left-col'>"
	    				+ 	"<div class='thumbnail-profil'><img src='" + imgProfilPath + "' height=50 width=50 class='popup-info-profil-thumb'></div>"						
	    				+ 	"<div class='ico-type-account'>"+icons+"</div>"					
	    				+ "</div>"

						+ "<div class='right-col'>";
						
						if("undefined" != typeof data['name'])
						popupContent	+= 	"<div class='info_item pseudo_item_map_list'>" + data['name'] + "</div>";
						
						if("undefined" != typeof allData['tags']){
							popupContent	+= 	"<div class='info_item items_map_list'>";
							var totalTags = 0;
							$.each(allData['tags'], function(index, value){ totalTags++;
								if(totalTags < 4)
								popupContent	+= 	"<div class='tag_item_map_list'>#" + value + " </div>";
							});
							popupContent	+= 	"</div>";
						}

						if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['addressLocality'] )
						popupContent	+= 	"<div class='info_item city_item_map_list inline'>" + data['address']['addressLocality'] + "</div>";
								
						if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['addressCountry'] )
						popupContent	+= 	"<div class='info_item country_item_map_list inline'>" + data['address']['addressCountry'] + "</div>";
								
						//if("undefined" != typeof data['telephone'])
						//popupContent	+= 	"<div class='info_item telephone_item_map_list inline'>" + data['telephone'] + "</div>";


						if(typeof data["telephone"] != "undefined"){
							var telephone = "" ;
							if(typeof data["telephone"] == "object"){

								if(typeof data["telephone"]["fixe"] != "undefined"){
									$.each(data["telephone"]["fixe"], function(key, value){
						  				/*if(telephone != "")
											telephone += ", ";
										telephone += value ;*/
										popupContent += "<div class='info_item telephone_item_map_list inline'>" + value + "<div/>";
						  			});
								}

								if(typeof data["telephone"]["mobile"] != "undefined")
								{
									$.each(data["telephone"]["mobile"], function(key, value){
						  				/*if(telephone != "")
											telephone += ", ";
										telephone += value ;*/
										popupContent += "<div class='info_item telephone_item_map_list inline'>" + value + "<div/>";
						  			});
								}
							}
							else
							{
								if(typeof data["telephone"] == "string"){
									popupContent += "<div class='info_item telephone_item_map_list inline'>" + data["telephone"] + "<div/>";
								}
							}
							//popupContent += "<div class='popup-info-profil'>" + telephone + "<div/>";
						}
				popupContent += '</div>';

				if("undefined" != typeof allData['text']){
					if("undefined" != typeof allData['name']){
						popupContent	+= 	"<div class='info_item title_news_item_map_list'>" + allData['name'] + "</div>";
					}		
					popupContent	+= 	"<div class='info_item text_item_map_list'>" + allData['text'] + "</div>";
				}
					

				popupContent += '<button class="btn btn-sm btn-info btn-more col-md-12" onclick="' + "loadByHash('#')"+"><i class='fa fa-hand-pointer-o'></i> en savoir +";
				popupContent += '</button>';

			return popupContent;
		};

		Sig.getPopupNewData = function(){
							
			var popupContent = //'<img style="width:100%" class="pull-right" src="'+assetPath+'/images/logoL.jpg"/>' +
							   "<h1>Cette position est-elle exacte ?</h1>" +
				  			   "<h2><i class='fa fa-hand-pointer-o fa-2x'></i><br/>Déplacez l'icon<br>pour un placement plus précis</h2>" +
				  			   "<button class='btn btn-success center-block' id='btn-validate-geopos'><i class='fa fa-check'></i> Valider</button>";

			return popupContent;
		};

		Sig.getPopupNewPerson = function(){
							
			var popupContent = //'<img style="width:100%" class="pull-right" src="'+assetPath+'/images/logoL.jpg"/>' +
							   "<h1>Vous habitez ici ?</h1>" +
				  			   "<h2><i class='fa fa-hand-pointer-o fa-2x'></i><br/>Déplacez l'icon<br>pour un placement plus précis</h2>" +
				  			   "<button class='btn btn-success center-block' id='btn-validate-geopos'><i class='fa fa-check'></i> Valider</button>";

			return popupContent;
		};

		Sig.getPopupSearchPlace = function(dataTxt){
							
			var popupContent = "<h1>"+dataTxt+"</h1></br>";
			return popupContent;
		};

		//##
		//création du contenu de la popup d'un data
		Sig.getPopupEvent = function(data){

			var type = data['type'] ? data['type'] : "";

			var popupContent = "";
			//if(data['thumb_path'] != null)
			//popupContent += "<div class='popup-info-profil-thumb-lbl'><img src='" + data['thumb_path'] + "' height=100 class='popup-info-profil-thumb'></div>";
			//else
			popupContent += "<div class='popup-info-profil-thumb-lbl'><i class='fa fa-calendar fa-3x popup-info-profil-thumb "+type+"'></i></div>";


			//NOM DE L'UTILISATEUR
			if(data['name'] != null){
				var userUrl = data['publicUrl'] ? data['publicUrl'] : "#";
				popupContent += 	"<div class='popup-info-profil-username'><a href='"+ userUrl +"' class='"+type+"'>" + data['name'] + "</a></div>";
			}

			//TYPE D'UTILISATEUR (data, ASSO, PARTENAIRE, ETC)
			var typeName = data['type'];
			if(typeName == null)  typeName = "data";
			if(data['name'] == null)  typeName += " Anonyme";

			popupContent += 	"<div class='popup-info-profil-usertype'>" + typeName + "</div>";

			//WORK - PROFESSION
			if(data['work'] != null)
			popupContent += 	"<div class='popup-info-profil-work'>" + data['work'] + "</div>";
			//else
			//popupContent += 	"<div class='popup-info-profil-work'>Fleuriste</div>";

			//URL
			if(data['url'] != null)
			popupContent += 	"<div class='popup-info-profil-url'>" + data['url'] + "</div>";
			//else
			//popupContent += 	"<a href='http://www.google.com' class='popup-info-profil-url'>http://www.google.com</a>";

			if(data['address'] != null){
				//CODE POSTAL
				if(data['address']['postalCode'] != null)
				popupContent += 	"<div class='popup-info-profil'>" + data['cp'] + "</div>";
				//else
				//popupContent += 	"<div class='popup-info-profil'>98800</div>";

				//VILLE ET PAYS
				var place = data['address']['addressLocality'];
				if(place != null && data['address']['addressCountry'] != null) //place += ", ";
				place += ", " + data['address']['addressCountry'];

				if(place != null)
				popupContent += 	"<div class='popup-info-profil'>" + place + "</div>";
				//else
				//popupContent += 	"<div class='popup-info-profil'>St-Denis, La Réunion</div>";
			}

			//NUMÉRO DE TEL
			/*if(data['telephone'] != null)
			popupContent += 	"<div class='popup-info-profil'>" + data['telephone'] + "<div/>";
			//else
			popupContent += 	"<div class='popup-info-profil'>0123456789<div/>";*/

			if(typeof data["telephone"] != "undefined"){
				var telephone = "" ;
				if(typeof data["telephone"] == "object"){

					if(typeof data["telephone"]["fixe"] != "undefined"){
						$.each(data["telephone"]["fixe"], function(key, value){
			  				/*if(telephone != "")
								telephone += ", ";
							telephone += value ;*/
							popupContent += "<div class='popup-info-profil'>" + value + "<div/>";
			  			});
					}

					if(typeof data["telephone"]["mobile"] != "undefined")
					{
						$.each(data["telephone"]["mobile"], function(key, value){
			  				/*if(telephone != "")
								telephone += ", ";
							telephone += value ;*/
							popupContent += "<div class='popup-info-profile'>" + value + "<div/>";
			  			});
					}
				}
				else
				{
					if(typeof data["telephone"] == "string"){
						popupContent += "<div class='popup-info-profil'>" + data["telephone"] + "<div/>";
					}
				}
				//popupContent += "<div class='popup-info-profil'>" + telephone + "<div/>";
			}

			return popupContent;
		};

		Sig.getPopupCity = function(dataTxt, insee){
			var localActors = "";
			if($("#local-actors-popup-sig").length > 0){ //console.log("try to catch local actors");
				localActors = $("#local-actors-popup-sig").html();
			}
			var showAjaxPanel = 'showAjaxPanel("/city/detail?insee='+insee+'", "Commune : '+dataTxt+'", "fa-university");';
			var popupContent = '<div class="pod-local-actors" style="display:inline-block; width:100%;">' +
									"<h4 class='panel-title text-blue'>"+
										"<i class='fa fa-university'></i> "+dataTxt+
									"</h4>" + 
									localActors +
										"<button class='no-margin btn btn-default btn-more btn-sm col-md-12' onclick='javascript:"+showAjaxPanel+"'>"+
											"<i class='fa fa-plus'></i> En savoir plus"+
										"</button>" +
								'</div>';
			return popupContent;
			
		};

		Sig.getPopupSimpleCity = function(data){
			var cityName = data["name"].replace("'", "\'");;
			var insee = data["insee"];
			var cp = data["cp"];
			var reg = data["regionName"];
			var cntry = data["country"];
			var lat = data["geo"]["latitude"];
			var lng = data["geo"]["longitude"];
			if(typeof(data["countCpByInsee"]) != "undefined"){
				var nbCpByInsee = data["countCpByInsee"];
				var cityInsee = data["cityInsee"];
			}
			var showAjaxPanel = 'loadByHash("#city.detail.insee.'+insee+'");'
			var popupContent = '<div class="pod-local-actors" style="display:inline-block; width:100%;">' +
									"<h4 class='panel-title text-red homestead'>"+
										"<i class='fa fa-university'></i> "+cityName+
									"</h4>" + 
									"<h4 class='panel-title text-red homestead'>"+ cp + "</h4>" + 
									"<button class='btn btn-default btn-communecter-city btn-sm col-md-12 text-red bold' "+
											 "name-com='" + cityName + "' " + "insee-com='" + insee + "' " + "cp-com='" + cp + "'" + "lat-com='" + lat + "'" + "lng-com='" + lng + "'" +  "reg-com='" + reg + "'" +  "ctry-com='" + cntry + "'";
				if (typeof(nbCpByInsee) != "undefined"){
				popupContent += " nbCpByInsee-com='" + nbCpByInsee + "'" + "cityInsee-com='" + cityInsee + "'";
				}						
				popupContent += 			"onclick='javascript:setScopeValue($(this))'>"+
										"<i class='fa fa-crosshairs'></i> Communecter"+
									"</button>";

			if(location.hash != "#default.twostepregister")
			popupContent +=			"<button class='no-margin btn btn-default btn-more btn-sm col-md-12' onclick='javascript:"+showAjaxPanel+"'>"+
										"<i class='fa fa-plus'></i> En savoir plus"+
									"</button>";

			popupContent +=		'</div>';
			return popupContent;
		};

		Sig.getPopupModifyPosition = function(data){
			//console.dir(data);
			var type = typeof data['typeSig'] != "undefined" ? data['typeSig'] : data['type'];
			var id = data["_id"]["$id"];
			var popupContent = "<div class='popup-marker'>";
	
			var ico = this.getIcoByType(data);
			var color = this.getIcoColorByType(data);
			var imgProfilPath =  Sig.getThumbProfil(data);
			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

			var typeElement = "";
			if(type == "people") 		typeElement = "person";
			if(type == "organizations") typeElement = "organization";
			if(type == "events") 		typeElement = "event";
			if(type == "projects") 		typeElement = "project";
			//console.log("type", type);
			
			var icon = 'fa-'+ this.getIcoByType(data);

			var onclick = "";
			var url = '/'+typeElement+'/detail/id/'+id;
			var title = data.typeSig + ' : ' + data.name;
			title = title.replace("'", "");
			title = title.replace('"', "");
			
			popupContent += "<div class='item_map_list popup-marker padding-5'>";
										
			popupContent += "<div class='left-col'>"
	    				 + 	"<div class='thumbnail-profil'><img src='" + imgProfilPath + "' height=50 width=50 class='popup-info-profil-thumb'></div>"						
	    				 + 	"<div class='ico-type-account'>"+icons+"</div>"					
	    				 +  "</div>"

						 + "<div class='right-col'>";
						
						if("undefined" != typeof data['name'])
						popupContent	+= 	"<div class='info_item pseudo_item_map_list'>" + data['name'] + "</div>";
						
						if("undefined" != typeof data['tags']){
							popupContent	+= 	"<div class='info_item items_map_list'>";
							var totalTags = 0;
							$.each(data['tags'], function(index, value){  totalTags++;
								if(totalTags<4)
								popupContent	+= 	"<div class='tag_item_map_list'>#" + value + " </div>";
							});
							popupContent	+= 	"</div>";
						}

						//if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['addressLocality'] )
						//popupContent	+= 	"<div class='info_item city_item_map_list'>" + data['address']['addressLocality'] + "</div>";
						
			popupContent += '</div>'; //right-col

			var hStyle = "margin-bottom: 5px !important; width:100%; font-weight: 500; border:0px solid rgba(0, 0, 0, 0.2); border-top-width:1px; border-radius:0px; margin-top:5px !important;";
			popupContent += "<div id='btn-bounce-marker-modify' class='alert pull-left no-margin padding-10' style='"+hStyle+"'><i class='fa fa-question-circle'></i> Déplacez l'icon sur sa nouvelle position</div>";
			
			popupContent += '<div id="btn-validate-new-position" class="btn btn-sm btn-success center col-md-12" style="width:100% !important;">'+
								'<i class="fa fa-check" style="float:none !important;"></i> Valider'+
							'</div>';

			popupContent += '</div>' +
							'<div id="lbl-loading-saving" class="alert alert-success hidden" style="margin:10px;"></div>';
				

			return popupContent;
		};

		return Sig;
	};
