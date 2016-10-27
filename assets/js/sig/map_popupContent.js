
	/**
	***		POPUP CONTENT
	***/

	SigLoader.getSigPopupContent = function (Sig){

		//##
		//création du contenu de la popup d'un data
		Sig.getPopup = function(data){
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
		Sig.getPopupSimple = function(data){
			
			var type = typeof data['typeSig'] != "undefined" ? data['typeSig'] : data['type'];
			var id = this.getObjectId(data); //typeof data["_id"]["$id"] != "undefined" ? data['_id']['$id'] : null;
			var popupContent = "<div class='popup-marker'>";
	
			var ico = this.getIcoByType(data);
			var color = this.getIcoColorByType(data);
			var imgProfilPath =  Sig.getThumbProfil(data);
			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';
			//console.log("type de donnée sig : ",type);
			
			var typeElement = type;
			if(type == "people") 		typeElement = "person";
			if(type == "citoyens") 		typeElement = "person";
			if(type == "organizations") typeElement = "organization";
			if(type == "events") 		typeElement = "event";
			if(type == "projects") 		typeElement = "project";
			console.log("type", type);
			
			var icon = 'fa-'+ this.getIcoByType(data);

			var onclick = "";
			var url = '#'+typeElement+'.detail.id.'+id;
			onclick = 'loadByHash("'+url+'");';
			
			if(typeof TPL_IFRAME != "undefined" && TPL_IFRAME==true){
				url = "https://www.communecter.org/"+url;
				popupContent += "<a href='"+url+"' target='_blank' class='item_map_list popup-marker' id='popup"+id+"'>";
			}else{							
				popupContent += "<a href='"+url+"' class='item_map_list popup-marker lbh' id='popup"+id+"'>";
			}
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
					
					//si on a bien les dates
					if("undefined" != typeof data['startDate'] && "undefined" != typeof data['endDate']){
						var start = dateToStr(data['startDate'], "fr", true);
						var end = dateToStr(data['endDate'], "fr", true);

						var startDate = start.substr(0, start.indexOf("-"));
						var endDate = end.substr(0, end.indexOf("-"));

						var hour1 = "Toute la journée";
						var hour2 = "Toute la journée";
						if(data["allDay"] == false) { 	
							hour1 = start.substr(start.indexOf("-")+2, start.length);
							hour2 = end.substr(end.indexOf("-")+2, end.length);
						}
						//si la date de debut == la date de fin
						if( startDate == endDate ){
							popupContent += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Le " + startDate;
							
							if(data["allDay"] == true) 
							{ 		popupContent += "</br><i class='fa fa-caret-right'></i> " + hour1;
							} else  popupContent += "</br><i class='fa fa-caret-right'></i> " + hour1 + " - " + hour2;// + "|" + start + "|";

							popupContent += "</div>";
						}else{
							popupContent += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Du " + 
												startDate + " - " + hour1 +
											"</div>" +
								   		  	"<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Au " + 
								   		  		endDate +  " - " + hour2 +
								   		  	"</div></br>";
						}
					}

					// if("undefined" != typeof data['startDate'] && "undefined" != typeof data['endDate']){
					// 	var start = dateToStr(data['startDate'], "fr", true);
					// 	var end = dateToStr(data['endDate'], "fr", true);

					// 	//si la date de debut == la date de fin
					// 	if( start.substr(0, start.indexOf("-")) == end.substr(0, end.indexOf("-"))){
					// 		var date1 = start.substr(0, start.indexOf("-"));
					// 		var hour1 = start.substr(start.indexOf("-")+2, start.length);
					// 		var hour2 = end.substr(end.indexOf("-")+2, end.length);
					// 		popupContent += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Le " + date1;
					// 		//console.log('hour1', hour1, "hour2", hour2);
					// 		if(data["allDay"] == true) {
					// 			popupContent += "</br><i class='fa fa-caret-right'></i> Toute la journée";
					// 		}
					// 		else
					// 			popupContent += "</br><i class='fa fa-caret-right'></i> " + hour1 + " - " + hour2;// + "|" + start + "|";

					// 		popupContent += "</div>";
					// 	}else{
					// 		popupContent += "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Du " + start + "</div>"
					// 			   +  "<div class='info_item startDate_item_map_list double'><i class='fa fa-caret-right'></i> Au " + end + "</div></br>";
					// 	}
					// }
				}
				popupContent += '<div class="btn btn-sm btn-more col-md-12"><i class="fa fa-hand-pointer-o"></i> en savoir +</div>';
				popupContent += '</a>';



			return popupContent;
		};

		//##
		//création du contenu de la popup d'un data de type News
		Sig.getPopupSimpleNews = function(data){

			var allData = data;
			data = data.author;
			//console.log("typeSig : " + allData['typeSig']);
			var type = allData['typeSig'] ? allData['typeSig'] : allData['type'];
			var id = this.getObjectId(allData);
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
			popupContent += "<button class='item_map_list popup-marker lbh' id='popup"+id+"' data-hash='#news.detail.id."+id+"'>";
										
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
				  			   "<h2><i class='fa fa-hand-pointer-o fa-2x'></i><br/>Déplacez l'icône<br>pour un placement plus précis</h2>" +
				  			   "<button class='btn btn-success center-block' id='btn-validate-geopos'><i class='fa fa-check'></i> Valider</button>";

			return popupContent;
		};

		Sig.getPopupNewPerson = function(){
							
			var popupContent = //'<img style="width:100%" class="pull-right" src="'+assetPath+'/images/logoL.jpg"/>' +
							   "<h1>Vous habitez ici ?</h1>" +
				  			   "<h2><i class='fa fa-hand-pointer-o fa-2x'></i><br/>Déplacez l'icône<br>pour un placement plus précis</h2>" +
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
			console.log(data);
			var city = data["name"].replace("'", "\'");;
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
			var showAjaxPanel = 'loadByHash("#city.detail.insee.'+insee+'.postalCode.'+cp+'");'
			var popupContent = '<div class="pod-local-actors" style="display:inline-block; width:100%;">' +
									"<h4 class='panel-title text-red homestead'>"+
										"<i class='fa fa-university'></i> "+city+
									"</h4>" + 
									"<h4 class='panel-title text-red homestead'>"+ cp + "</h4>";/* + 
									"<button class='btn btn-default btn-communecter-city btn-sm col-md-12 text-red bold' "+
											 "name-com='" + city + "' " + "insee-com='" + insee + "' " + "cp-com='" + cp + "'" + "lat-com='" + lat + "'" + "lng-com='" + lng + "'" +  "reg-com='" + reg + "'" +  "ctry-com='" + cntry + "'";
				if (typeof(nbCpByInsee) != "undefined"){
				popupContent += " nbCpByInsee-com='" + nbCpByInsee + "'" + "cityInsee-com='" + cityInsee + "'";
				}						
				popupContent += 			"onclick='javascript:setScopeValue($(this))'>"+
										"<i class='fa fa-crosshairs'></i> Communecter"+
									"</button>";*/

			if(location.hash != "#default.twostepregister")
			popupContent +=			"<button class='no-margin btn btn-default btn-more btn-sm col-md-12' onclick='javascript:"+showAjaxPanel+"'>"+
										"<i class='fa fa-plus'></i> En savoir plus"+
									"</button>";

			popupContent +=		'</div>';
			return popupContent;
		};

		Sig.getPopupAddress = function(data, label){
			console.log(data);
			var city = data["name"].replace("'", "\'");;
			var cp = data["postalCode"];
			if(typeof(data["countCpByInsee"]) != "undefined"){
				var nbCpByInsee = data["countCpByInsee"];
				var cityInsee = data["cityInsee"];
			}
			var popupContent = '<div class="pod-local-actors" style="display:inline-block; width:100%;">' +
									"<div class='panel-title text-dark center'>"+
										"<i class='fa fa-map-marker'></i> "+city+
									"</div>" + 
									"<button class='btn btn-success btn-communecter-city btn-sm col-md-12 bold' cp-com='" + cp + "'";					
				popupContent += 		">"+
										"<i class='fa fa-check'></i> "+ label +
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
			popupContent += "<div id='btn-bounce-marker-modify' class='alert pull-left no-margin padding-10' style='"+hStyle+"'><i class='fa fa-question-circle'></i> Déplacez l'icône sur sa nouvelle position</div>";
			
			popupContent += '<div id="btn-validate-new-position" class="btn btn-sm btn-success center col-md-12" style="width:100% !important;">'+
								'<i class="fa fa-check" style="float:none !important;"></i> Valider'+
							'</div>';

			popupContent += '</div>' +
							'<div id="lbl-loading-saving" class="alert alert-success hidden" style="margin:10px;"></div>';
				

			return popupContent;
		};

		Sig.getPopupConfigAddress = function(){
			var allCountries = getCountries("select2");
			countries ="";
			$.each(allCountries, function(key, country){
				console.log(country.id, country.text);
			 	countries += "<option value='"+country.id+"'>"+country.text+"</option>";
			});
			var popupContent = 	"<style>@media screen and (min-width: 768px) {.leaflet-popup-content{width:400px!important;}}" +
								"</style>"+
								"<div class='form-group inline-block padding-15'>"+
									"<h3 class='margin-top-5'><i class='fa fa-angle-down'></i> <i class='fa fa-home'></i> Adresse</h3>"+
									"<div class='text-dark margin-top-5 hidden-xs'><i class='fa fa-circle'></i> Indiquez une adresse pour un placement automatique</div>"+
									"<div class='text-dark margin-top-5 hidden-xs'><i class='fa fa-circle'></i> Déplacez l'icon avec la souris pour un placement plus précis</div>"+
									"<hr class='col-md-12'>"+
									"<select class='form-group col-md-12 col-xs-12' name='newElement_country'>"+countries+
									"</select>"+
									"<div class='dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newElement_city' placeholder='Ville, village, commune'>"+
										"<ul class='dropdown-menu col-md-12 col-xs-12' id='dropdown-newElement_city-found'>"+
											"<li><a href='javascript:' class='disabled'>Rechercher une ville, un village, une commune</a></li>"+
										"</ul>"+
							  		"</div>" +
									"<div class='dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newElement_cp' placeholder='Code postal'>"+
										"<ul class='dropdown-menu' id='dropdown-newElement_cp-found'>"+
											"<li><a href='javascript:' class='disabled'>Rechercher un code postal</a></li>"+
										"</ul>"+
							  		"</div>" +
									"<input class='form-group col-md-9 col-xs-9' type='text' style='margin-right:-3px;' name='newElement_streetAddress' placeholder='(n° rue) + Adresse'>"+
									"<button class='col-md-3 col-xs-3 btn btn-default' style='padding:3px;border-radius:0 4px 4px 0;' type='text' id='newElement_btnSearchAddress'><i class='fa fa-search'></i></button>"+
									"<div class='dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<ul class='dropdown-menu' id='dropdown-newElement_streetAddress-found'></ul>"+
									"</div>" +
									"<div id='info_insee_latlng' class='text-dark col-md-12 no-padding'></div>"+
									"<input type='hidden' name='newElement_insee'>"+
									"<input type='hidden' name='newElement_lat'>"+
									"<input type='hidden' name='newElement_lng'>"+
									"<input type='hidden' name='newElement_dep'>"+
									"<input type='hidden' name='newElement_region'>"+
									"<input type='hidden' name='update' value='false'>"+
									"<hr class='col-md-12 col-xs-12'>"+
									//"<hr style='margin: 5px 0px;padding: 0px;' class='col-md-12'>"+
									"<button class='col-md-8 btn btn-success pull-right' type='text' id='newElement_btnValidateAddress' disabled='disabled'><i class='fa fa-check'></i> Valider <span class='hidden-xs'>l'adresse et la position</span></button>"+
									"<button class='col-md-3 btn btn-danger pull-right' type='text' id='newElement_btnCancelAddress' style='margin-right:5px;'><i class='fa fa-times'></i> Annuler</button>"+
									
								"</div>";

			return popupContent;
		};

		return Sig;
	};
