
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
			}else if(typeof(data.typeSig) != "undefined" && data.typeSig == "url"){
				return this.getPopupSiteUrl(data);
			}else if(typeof(data.typeSig) != "undefined" && data.typeSig == "address"){
				return this.getPopupAddress(data);
			}else{
				return this.getPopupSimple(data);
			}
		};
		
		//##
		//création du contenu de la popup d'un data
		Sig.getPopupSimple = function(data){
			
			var type = typeof data['typeSig'] != "undefined" ? data['typeSig'] : data['type'];
			var id = this.getObjectId(data); 
			var popupContent = "<div class='popup-marker'>";
	
			var ico = this.getIcoByType(data);
			var color = this.getIcoColorByType(data);
			var imgProfilPath =  Sig.getThumbProfil(data);
			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';
			
			var typeElement = type;
			if(type == "people") 		typeElement = "person";
			if(type == "citoyens") 		typeElement = "person";
			if(type == "organizations") typeElement = "organization";
			if(type == "events") 		typeElement = "event";
			if(type == "projects") 		typeElement = "project";
			mylog.log("type", type);
			
			var icon = 'fa-'+ this.getIcoByType(data);

			var onclick = "";
			var url = '#'+typeElement+'.detail.id.'+id;

			if(type == "entry") 		url = "#survey.entry.id."+id;
			if(type == "action") 		url = "#rooms.action.id."+id;
			
			onclick = 'loadByHash("'+url+'");';
			
			if(typeof TPL_IFRAME != "undefined" && TPL_IFRAME==true){
				url = "https://www.communecter.org/"+url;
				popupContent += "<a href='"+url+"' target='_blank' class='item_map_list popup-marker' id='popup"+id+"'>";
			}else{							
				popupContent += "<a href='"+url+"' onclick='"+onclick+"' class='item_map_list popup-marker lbh' id='popup"+id+"'>";
			}
			popupContent += "<div class='main-panel'>"
							+   "<div class='left-col'>"
		    				+ 	   "<div class='thumbnail-profil'><img src='" + imgProfilPath + "' height=50 width=50 class='popup-info-profil-thumb'></div>"						
		    				+ 	   "<div class='ico-type-account'>"+icons+"</div>"					
		    				+   "</div>"
							+   "<div class='right-col'>";
					
			if("undefined" != typeof data['name'])
				popupContent	+= 	"<div class='info_item pseudo_item_map_list'>" + data['name'] + "</div>";
			
			if("undefined" != typeof data['tags'] && data['tags'] != null){
				popupContent	+= 	"<div class='info_item items_map_list'>";
				var totalTags = 0;
				if(data['tags'].length > 0){
					$.each(data['tags'], function(index, value){ 
						totalTags++;
						if(totalTags<4)
							popupContent	+= 	"<div class='tag_item_map_list'>#" + value + " </div>";
					});
				}
				popupContent	+= 	"</div>";
			}
			popupContent += "</div>";
			//Short description
			if ("undefined" != typeof data['shortDescription'] && data['shortDescription'] != "" && data['shortDescription'] != null) {
				popupContent += "<div id='pop-description' class='popup-section'>"
								+ "<div class='popup-subtitle'>Description</div>"
								+ "<div class='popup-info-profil'>" + data['shortDescription'] + "</div>"
							+ "</div>";
			}
			//Contacts information
			popupContent += this.getPopupContactsInformation(data);
			//address
			popupContent += this.getPopupAddressInformation(data);

			popupContent += '</div>';

			var dataType = ("undefined" != typeof data['typeSig']) ? data['typeSig'] : "";

			if(dataType == "event" || dataType == "events"){				
				popupContent += displayStartAndEndDate(data);
			}

			popupContent += '<div class="btn btn-sm btn-more col-md-12"><i class="fa fa-hand-pointer-o"></i> en savoir +</div>';
			popupContent += '</a>';

			return popupContent;
		};
		//##
		//création du contenu de la popup d'un site web
		Sig.getPopupSiteUrl = function(data){
			//console.log("POPUP SITEURL", data);
			var type = typeof data['typeSig'] != "undefined" ? data['typeSig'] : data['type'];
			var id = this.getObjectId(data); //typeof data["_id"]["$id"] != "undefined" ? data['_id']['$id'] : null;
			var popupContent = "<div class='popup-marker'>";
	
			var ico = this.getIcoByType(data);
			var color = this.getIcoColorByType(data);
			var imgProfilPath =  Sig.getThumbProfil(data);
			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';
			//mylog.log("type de donnée sig : ",type);
			
			var typeElement = type;
			
			var icon = 'fa-'+ this.getIcoByType(data);

			var onclick = "";
			var url = data["url"]; //'#'+typeElement+'.detail.id.'+id;

			var address = "";
			if("undefined" != typeof data['address']){
				if("undefined" != typeof data['address']['streetAddress'] || "undefined" != typeof data['address']['addressLocality'])
					address = "<i class='fa fa-map-marker'></i> ";

				address += typeof data['address']['streetAddress'] != "" ? data['address']['streetAddress'] : "";
				
				if(typeof data['address']['streetAddress'] != "undefined" && 
					data['address']['streetAddress'] != "" && 
					"undefined" != typeof data['address']['addressLocality'])
					address+=", ";

				address += data['address']['addressLocality'] ? data['address']['addressLocality'] : "";
			}
			
			popupContent += "<a href='"+url+"' target='_blank' class='item_map_list popup-marker siteurl lbh' id='popup"+id+"'>";
			
			popupContent += 
						//  "<div class='left-col'>"
	    				//+ 	"<div class='thumbnail-profil'><img src='" + imgProfilPath + "' height=50 width=50 class='popup-info-profil-thumb'></div>"						
	    				//+ 	"<div class='ico-type-account'>"+icons+"</div>"					
	    				//+ "</div>"

						"<div class='right-col'>";
						
						if("undefined" != typeof data['title'])
						popupContent	+= 	"<div class='info_item pseudo_item_map_list letter-blue'>" + data['title'] + "</div>";
						if("undefined" != typeof data['url'])
						popupContent	+= 	"<div class='info_item pseudo_item_map_list letter-green'>" + data['url'] + "</div>";
						if("undefined" != typeof data['description'])
						popupContent	+= 	"<div class='info_item siteurl_desc'>" + data['description'] + "</div>";
						
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

						popupContent	+= 	"<div class='col-md-12 no-padding'><hr></div>";

						if(address!="")
						popupContent	+= 	"<div class='info_item siteurl_desc text-dark'>"+address+"</div>";
								
						// if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['streetAddress'] )
						// popupContent	+= 	"<div class='info_item city_item_map_list'>" + data['address']['streetAddress'] + ",</div>";
								
						// if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['addressLocality'] )
						// popupContent	+= 	"<div class='info_item city_item_map_list'>" + data['address']['addressLocality'] + "</div>";
								
						//if("undefined" != typeof data['address'] && "undefined" != typeof data['address']['addressCountry'] )
						//popupContent	+= 	"<div class='info_item country_item_map_list'>" + data['address']['addressCountry'] + "</div>";
								
						
				popupContent += '</div>';

				var dataType = ("undefined" != typeof data['typeSig']) ? data['typeSig'] : "";

			popupContent += '<div class="btn btn-sm btn-more col-md-12"><i class="fa fa-hand-pointer-o"></i> Aller sur le site</div>';
			popupContent += '</a>';



			return popupContent;
		};

		//##
		//création du contenu de la popup d'un data de type News
		Sig.getPopupSimpleNews = function(data){

			var allData = data;
			data = data.author;
			//mylog.log("typeSig : " + allData['typeSig']);
			var type = allData['typeSig'] ? allData['typeSig'] : allData['type'];
			var id = this.getObjectId(allData);
			var popupContent = "<div class='popup-marker'>";
	
			var ico = this.getIcoByType(allData);
			var color = this.getIcoColorByType(allData);
			var imgProfilPath =  Sig.getThumbProfil(data);

			var icons = '<i class="fa fa-'+ ico + ' fa-'+ color +'"></i>';

			//var prop = feature.properties;
			//mylog.log("PROPRIETES : ");
			
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
					
			popupContent += this.getPopupContactsInformation(data);
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

		
		Sig.getPopupCity = function(dataTxt, insee){
			var localActors = "";
			if($("#local-actors-popup-sig").length > 0){ //mylog.log("try to catch local actors");
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
			mylog.log(data);
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
			mylog.log(data);
			var city = data["name"].replace("'", "\'");;
			var cp = data["postalCode"];
			if(typeof(data["countCpByInsee"]) != "undefined"){
				var nbCpByInsee = data["countCpByInsee"];
				var cityInsee = data["cityInsee"];
			}

			//rassemble le nom de la ville au CP
			var place = "";
			if(data['streetNumber'] != null) place += "<span class='letter-blue'>"+data['streetNumber']+"</span>";
			
			if(data['street'] != null) {
				if(place!="") place += " ";
				place += '<b>'+ data['street']+'</b>';
			}

			if(data['cityName'] != null) {
				if(place=="") //place += " ";
				place +=  "<span class='letter-red'>"+data['cityName']+"</span>";
			}

			if(data['postalCode'] != null) {
				//if(place!="") place += " ";
				//place +=  "<span class='letter-'>"+data['postalCode']+"</span>";
			}


			var popupContent = '<div class="pod-local-actors" style="display:inline-block; width:100%;">' +
									"<div class='panel-title text-dark text-center'>"+
										//"<i class='fa fa-map-marker fa-2x text-red'></i> "+
										place+
									"</div>";

			popupContent +=		'</div>';
			return popupContent;
		};

		Sig.getPopupContactsInformation = function(data){
			var popupContent = "";
			//Website URL
			if (typeof data["url"] != "undefined" && data["url"] != null)
				popupContent += "<div class='popup-info-profil'><i class='fa fa fa-desktop fa_url'></i>" + data["url"] + "</div>";

			//email
			if (typeof data["email"] != "undefined" && data["email"] != null)
				popupContent += "<div class='popup-info-profil'><i class='fa fa-envelope fa_email'></i>" + data["email"] + "</div>";

			if(typeof data["telephone"] != "undefined" && data["telephone"] != null){
				var telephone = "" ;
				if(typeof data["telephone"] == "object"){
					if(typeof data["telephone"]["fixe"] != "undefined") {
						$.each(data["telephone"]["fixe"], function(key, value){
							popupContent += "<div class='popup-info-profil'><i class='fa fa-phone fa_telephone'></i>" + value + "</div>";
			  			});
					}
					if(typeof data["telephone"]["mobile"] != "undefined") {
						$.each(data["telephone"]["mobile"], function(key, value){
							popupContent += "<div class='popup-info-profil'><i class='fa fa-mobile fa_telephone_mobile'></i>" + value + "</div>";
			  			});
					}
					if(typeof data["telephone"]["fax"] != "undefined") {
						$.each(data["telephone"]["fax"], function(key, value){
							popupContent += "<div class='popup-info-profil'><i class='fa fa-fax fa_telephone_fax'></i>" + value + "</div>";
			  			});
					}
				} else {
					if(typeof data["telephone"] == "string"){
						popupContent += "<div class='popup-info-profil'>" + data["telephone"] + "</div>";
					}
				}				
			}
			
			if (popupContent != "") {
				popupContent = "<div id='pop-contacts' class='popup-section'>"
								+ "<div class='popup-subtitle'>Contacts</div>"
								+popupContent
								+"</div>";
			}

			return popupContent;
		}

		Sig.getPopupAddressInformation = function(data){
			var popupContent = "";
			if("undefined" != typeof data['address']) { 
				if ("undefined" != typeof data['address']['streetAddress'] )
					popupContent	+= 	"<div class='popup-info-profil'>" + data['address']['streetAddress'] + "</div>";
					
				if("undefined" != typeof data['address']['addressLocality'] ) {
					var cpAndLocality = "";
					if("undefined" != typeof data['address']['postalCode'] ) 
						cpAndLocality	+= 	data['address']['postalCode'] + " ";
					cpAndLocality	+= data['address']['addressLocality'];
					popupContent += "<div class='popup-info-profil'>" + cpAndLocality + "</div>";
				}	
				if("undefined" != typeof data['address']['addressCountry'] ) {
					var country = data['address']['addressCountry'];
					if ("undefined" != typeof tradCountry[country]) country = tradCountry[country];
					popupContent	+= 	"<div class='popup-info-profil'>" + country + "</div>";
				}
			}
			if (popupContent != "") {	
				popupContent = "<div id='pop-address' class='popup-section'>"
								+ "<div class='popup-subtitle'>" + trad["address"] + "</div>"
								+popupContent
								+ "</div>";
			}
			return popupContent;
		}

		Sig.getPopupModifyPosition = function(data){
			//mylog.dir(data);
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
			//mylog.log("type", type);
			
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
				mylog.log(country.id, country.text);
			 	countries += "<option value='"+country.id+"'>"+country.text+"</option>";
			});
			var popupContent = 	"<style>@media screen and (min-width: 768px) {.leaflet-popup-content{width:400px!important;}}" +
								"</style>"+
								"<div class='form-group inline-block padding-15 form-in-map'>"+
									"<h3 class='margin-top-5'><i class='fa fa-angle-down'></i> <i class='fa fa-home'></i> Adresse</h3>"+
									"<div class='text-dark margin-top-5 hidden-xs'><i class='fa fa-circle'></i> Indiquez une adresse pour un placement automatique</div>"+
									"<div class='text-dark margin-top-5 hidden-xs'><i class='fa fa-circle'></i> Déplacez l'icon avec la souris pour un placement plus précis</div>"+
									"<hr class='col-md-12'>"+
									"<select class='form-group col-md-12 col-xs-12' name='newElement_country' id='newElement_country'>"+
									"<option value=''>"+trad.chooseCountry+"</option>"+countries+
									"</select>"+
									"<div id='divCity' class='hidden dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newElement_city' placeholder='Ville, village, commune'>"+
										"<ul class='dropdown-menu col-md-12 col-xs-12' id='dropdown-newElement_city-found'>"+
											"<li><a href='javascript:' class='disabled'>Rechercher une ville, un village, une commune</a></li>"+
										"</ul>"+
							  		"</div>" +
									"<div id='divPostalCode' class='hidden dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newElement_cp' placeholder='Code postal'>"+
										"<ul class='dropdown-menu' id='dropdown-newElement_cp-found'>"+
											"<li><a href='javascript:' class='disabled'>Rechercher un code postal</a></li>"+
										"</ul>"+
							  		"</div>" +
							  		"<div id='divStreetAddress' class='hidden dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
										"<input class='form-group col-md-9 col-xs-9' type='text' style='margin-right:-3px;' name='newElement_streetAddress' placeholder='(n° rue) + Adresse'>"+
										"<button class='col-md-3 col-xs-3 btn btn-default' style='padding:3px;border-radius:0 4px 4px 0;' type='text' id='newElement_btnSearchAddress'><i class='fa fa-search'></i></button>"+
									"</div>" +
									"<div class='dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<ul class='dropdown-menu' id='dropdown-newElement_streetAddress-found'></ul>"+
									"</div>" +
									"<div id='info_insee_latlng' class='text-dark col-md-12 no-padding'></div>"+
									"<input type='hidden' name='newElement_insee'>"+
									"<input type='hidden' name='newElement_lat'>"+
									"<input type='hidden' name='newElement_lng'>"+
									"<input type='hidden' name='newElement_dep'>"+
									"<input type='hidden' name='newElement_region'>"+
									"<hr class='col-md-12 col-xs-12'>"+
									//"<hr style='margin: 5px 0px;padding: 0px;' class='col-md-12'>"+
									"<button class='col-md-8 btn btn-success pull-right' type='text' id='newElement_btnValidateAddress' disabled='disabled'><i class='fa fa-check'></i> Valider <span class='hidden-xs'>l'adresse et la position</span></button>"+
									"<button class='col-md-3 btn btn-danger pull-right' type='text' id='newElement_btnCancelAddress' style='margin-right:5px;'><i class='fa fa-times'></i> Annuler</button>"+
									
								"</div>";

			return popupContent;
		};


		Sig.getPopupConfigPostalCode = function(){
			var allCountries = getCountries("select2");
			countries ="";
			$.each(allCountries, function(key, country){
				mylog.log(country.id, country.text);
			 	countries += "<option value='"+country.id+"'>"+country.text+"</option>";
			});
			var popupContent = 	"<style>@media screen and (min-width: 768px) {.leaflet-popup-content{width:400px!important;}}" +
								"</style>"+
								"<div class='form-group inline-block padding-15 form-in-map'>"+
									"<h3 class='margin-top-5'><i class='fa fa-angle-down'></i> <i class='fa fa-home'></i> Postal Code</h3>"+
									"<div class='text-dark margin-top-5 hidden-xs'><i class='fa fa-circle'></i> Indiquez un code postal pour une commune</div>"+
									"<div class='text-dark margin-top-5 hidden-xs'><i class='fa fa-circle'></i> Déplacez l'icon avec la souris pour un placement plus précis</div>"+
									"<hr class='col-md-12'>"+
									"<div id='divPostalCode' class=' dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newPC_postalCode' placeholder='Code postal'>"+
							  		"</div>" +
							  		"<div id='divCity' class=' dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newPC_name' placeholder='Ville, village, commune, quartier'>"+
							  		"</div>" +
							  		"<div id='divLat' class=' dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newPC_lat' placeholder='Latitude du code postal'>"+
							  		"</div>" +
							  		"<div id='divLat' class=' dropdown pull-left col-md-12 col-xs-12 no-padding'> " +
								  		"<input class='form-group col-md-12 col-xs-12' type='text' name='newPC_lon' placeholder='Longitude du code postal'>"+
							  		"</div>" +
									"<hr class='col-md-12 col-xs-12'>"+
									"<button class='col-md-8 btn btn-success pull-right' type='text' id='newPC_btnValidatePC' disabled='disabled'><i class='fa fa-check'></i> Valider <span class='hidden-xs'>le code postal et la position</span></button>"+
									"<button class='col-md-3 btn btn-danger pull-right' type='text' id='newPC_btnCancelPC' style='margin-right:5px;'><i class='fa fa-times'></i> Annuler</button>"+
								"</div>";

			return popupContent;
		};

		return Sig;
	};
