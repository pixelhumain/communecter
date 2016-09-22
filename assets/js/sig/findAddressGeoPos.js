
/*  return { id, cityName, postalCode, street, coordinates } 
	PROCESS GENERAL
*/
function getGeoPosInternational(requestPart, countryCode){

	var countryCodes = new Array("FR", "GP", "GF", "MQ", "YT", "NC", "RE", "PM");
	showMsgListRes("Recherche en cours ...");
	
	if($.inArray(countryCode, countryCodes) >= 0) callCommunecter(requestPart, countryCode);
	else
		callNominatim(requestPart, countryCode);
}

function callCommunecter(requestPart, countryCode){ /*countryCode=="FR"*/
	console.log('callCommunecter');
	showMsgListRes("Recherche en cours<br><small>Communecter</small>");
	callGeoWebService("communecter", requestPart, countryCode,
		function(objs){ /*success nominatim*/
			console.log("SUCCESS Communecter"); 

			if(objs.length != 0){
				console.log('Résultat trouvé chez Communecter !'); console.dir(objs);
				var commonGeoObj = getCommonGeoObject(objs, "communecter");
				var res = addResultsInForm(commonGeoObj, countryCode);
				if(res == 0) 
					callDataGouv(requestPart, countryCode); 
			}else{
				console.log('Aucun résultat chez Communecter');
				callDataGouv(requestPart, countryCode);
			}
		}, 
		function(thisError){ /*error nominatim*/
			console.log("ERROR communecter");
			console.dir(thisError);
		}
	);
}

function callDataGouv(requestPart, countryCode){ /*countryCode=="FR"*/
	console.log('callDataGouv');
	showMsgListRes("Recherche en cours<br><small>Data Gouv</small>");
	callGeoWebService("data.gouv", requestPart, countryCode,
		function(objDataGouv){ /*success nominatim*/
			console.log("SUCCESS DataGouv"); 

			if(objDataGouv.length != 0){
				console.log('Résultat trouvé chez DataGouv !'); console.dir(objDataGouv);
				var commonGeoObj = getCommonGeoObject(objDataGouv.features, "data.gouv");
				var res = addResultsInForm(commonGeoObj, countryCode);
				if(res == 0) 
					callNominatim(requestPart, countryCode);
			}else{
				console.log('Aucun résultat chez DataGouv');
				callNominatim(requestPart, countryCode);
			}
		}, 
		function(thisError){ /*error nominatim*/
			console.log("ERROR DataGouv");
			console.dir(thisError);
		}
	);
}

function callNominatim(requestPart, countryCode){
	console.log('callNominatim');
	showMsgListRes("Recherche en cours<br><small>Nominatim</small>");
	callGeoWebService("nominatim", requestPart, countryCode,
		function(objNomi){ /*success nominatim*/
			console.log("SUCCESS nominatim"); 

			if(objNomi.length != 0){
				console.log('Résultat trouvé chez Nominatim !'); console.dir(objNomi);

				var commonGeoObj = getCommonGeoObject(objNomi, "nominatim");
				var res = addResultsInForm(commonGeoObj, countryCode);

				if(res == 0) 
					callGoogle(requestPart, countryCode);
			}else{
				console.log('Aucun résultat chez Nominatim');
				callGoogle(requestPart, countryCode);
			}
		}, 
		function(thisError){ /*error nominatim*/
			console.log("ERROR nominatim");
			console.dir(thisError);
		}
	);
}

function callGoogle(requestPart, countryCode){
	console.log('callGoogle');
	showMsgListRes("Recherche en cours<br><small>GoogleMap</small>");
	callGeoWebService("google", requestPart, countryCode,
		function(objGoo){ /*success google*/
			console.log("SUCCESS GOOGLE");
			if(objGoo.results.length != 0){
				console.log('Résultat trouvé chez Google !'); console.dir(objGoo);
				var commonGeoObj = getCommonGeoObject(objGoo.results, "google");
				var res = addResultsInForm(commonGeoObj, countryCode);
				if(res == 0) 
					showMsgListRes("Aucun résultat.<br>Précisez votre recherche.");
	
			}else{
				console.log('Aucun résultat chez Google');
				showMsgListRes("Aucun résultat.<br>Précisez votre recherche.");
			}

		}, 
		function(thisError){ /*error google*/
			showMsgListRes("Aucun résultat.<br>Précisez votre recherche.");
			console.log("ERROR GOOGLE"); console.dir(thisError);
		}
	);
}

/* fonction pour appeler le web service de géoloc de sont choix */
function callGeoWebService(providerName, requestPart, countryCode, success, error){
	var url = "";
	var data = {};

	if(providerName == "nominatim") {
		if(typeSearchInternational == "address")
		url = "//nominatim.openstreetmap.org/search?q=" + requestPart + "," + countryCode + "&format=json&polygon=0&addressdetails=1";
		else if(typeSearchInternational == "city")
		url = "//nominatim.openstreetmap.org/search?city=" + requestPart + "&country=" + countryCode + "&format=json&polygon=0&addressdetails=1";
	}
	
	if(providerName == "google") {
		if(typeSearchInternational == "address")
		url = "//maps.googleapis.com/maps/api/geocode/json?address=" + requestPart + "," + countryCode;
		else if(typeSearchInternational == "city")
		url = "//maps.googleapis.com/maps/api/geocode/json?locality=" + requestPart + "&country=" + countryCode;
	}	
	if(providerName == "data.gouv") {
		if(typeSearchInternational == "address")
		url = "//api-adresse.data.gouv.fr/search/?q=" + requestPart;
		else if(typeSearchInternational == "city")
		url = "//api-adresse.data.gouv.fr/search/?q=" + requestPart + "&type=city";
	}
	if(providerName == "communecter") {
		url = baseUrl+"/"+moduleId+"/search/globalautocomplete";
		data = {"name" : requestPart, "country" : countryCode, "searchType" : [ "cities" ], "searchBy" : "ALL"  };
	}

	console.log("calling : " + url);
	if(url != ""){
		if(providerName != "communecter"){
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
				async:false,
				crossDomain:true,
				complete: function () {},
				success: function (obj){
					success(obj);
				},
				error: function (thisError) {
					error(thisError);
				}
			});
		}else{
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data:data,
				complete: function () {},
				success: function (obj){
					success(obj);
				},
				error: function (thisError) {
					error(thisError);
				}
			});
		}
	}else{
		toastr.error('provider inconnu');
		return false;
	}
}


/* retourne un obj address commun à partir des données des différents webservices */
function getCommonGeoObject(objs, providerName){

	var commonObjs = new Array();
	var multiCpName = new Array();
	$.each(objs, function(key, obj){

		var commonObj = {};
		if(providerName == "nominatim"){
			var address = obj["address"];
			commonObj = addAttObjNominatim(commonObj, address, "streetNumber", "house_number");
			
			commonObj = addAttObjNominatim(commonObj, address, "street", "road");
			if(typeof commonObj["street"] == "undefined")
			commonObj = addAttObjNominatim(commonObj, address, "street", "locality");
			
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "county");
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "city");
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "village");
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "town");
			commonObj = addAttObjNominatim(commonObj, address, "country", "country");
			commonObj = addAttObjNominatim(commonObj, address, "countryCode", "country_code");
			commonObj = addAttObjNominatim(commonObj, address, "postalCode", "postcode");
			commonObj = addAttObjNominatim(commonObj, obj, "placeId", "place_id");

		}else 
		if(providerName == "google"){
			$.each(obj.address_components, function(addressKey, component){
				commonObj = addAttObjGoogle(commonObj, component, "streetNumber", "street_number", "long_name");
				commonObj = addAttObjGoogle(commonObj, component, "street", "route", "long_name");
				commonObj = addAttObjGoogle(commonObj, component, "cityName", "locality", "short_name");
				commonObj = addAttObjGoogle(commonObj, component, "country", "country", "long_name");
				commonObj = addAttObjGoogle(commonObj, component, "countryCode", "country", "short_name");
				commonObj = addAttObjGoogle(commonObj, component, "postalCode", "postal_code", "long_name");
			});
			commonObj = addAttObjNominatim(commonObj, obj, "placeId", "place_id");
		}else 
		if(providerName == "data.gouv"){
			console.log("details result data.gouv");
			console.dir(obj);
			var address = obj["properties"];
			commonObj = addAttObjNominatim(commonObj, address, "street", "name");
			commonObj = addAttObjNominatim(commonObj, address, "cityName", "city");
			commonObj = addAttObjNominatim(commonObj, address, "country", "country");
			commonObj = addAttObjNominatim(commonObj, address, "postalCode", "postcode");
			commonObj = addAttObjNominatim(commonObj, address, "insee", "citycode");
			commonObj["countryCode"] = "FR";
			commonObj = addAttObjNominatim(commonObj, address, "placeId", "id");
		
		}else 
		if(providerName == "communecter"){
			console.log("details result communecter");
			console.dir(obj);
			commonObj = addAttObjNominatim(commonObj, obj, "cityName", "name");
			commonObj = addAttObjNominatim(commonObj, obj, "countryCode", "country");
			commonObj = addAttObjNominatim(commonObj, obj, "postalCode", "cp");
			commonObj = addAttObjNominatim(commonObj, obj, "insee", "insee");
			commonObj = addAttObjNominatim(commonObj, obj, "geoShape", "geoShape");
			commonObj["placeId"] = obj["country"]+"_"+obj["insee"]+"-" + obj["cp"];
		
		}

		commonObj = addCoordinates(commonObj, obj, providerName);
		commonObj["type"] = "addressEntity";
		commonObj["typeSig"] = formType;
		commonObj["name"] = getFullAddress(commonObj);

		if(typeof commonObj["postalCode"] != "undefined" && commonObj["postalCode"].indexOf(";") >= 0){
			var CPS = commonObj["postalCode"].split(";");
			$.each(CPS, function(index, value){
				var oneCity = commonObj;
				oneCity["postalCode"] = value;
				oneCity["name"] = oneCity["cityName"] + ", " + value + ", " + oneCity["country"];

				if($.inArray(oneCity["name"], multiCpName) < 0){
					multiCpName.push(oneCity["name"]);
					commonObjs.push(oneCity);
				}
			});
		}else{
			commonObjs.push(commonObj);
		}
	});

	

	return commonObjs;
}


//ajoute les attribut s'ils existent
function addAttObjNominatim(obj1, obj2, att1, att2){
	if(typeof obj2[att2] != "undefined") obj1[att1] = obj2[att2];
	return obj1;
}

function addAttObjGoogle(obj1, obj2, att1, att2, nameLength){
	
	if($.inArray(att2, obj2.types) >= 0){
		obj1[att1] = obj2[nameLength];
	}
	return obj1;
}

//récupère les coordonnées et transforme la data dans notre format geo
function addCoordinates(commonObj, obj, providerName){

	var lat = null; var lng = null; var geoShape = null;

	if(providerName == "nominatim"){
		lat = (typeof obj["lat"] != "undefined") ? obj["lat"] : null;
		lng = (typeof obj["lon"] != "undefined") ? obj["lon"] : null;
		geoShape = (typeof obj["boundingbox"] != "undefined") ? obj["boundingbox"] : null;
	}else 
	if(providerName == "google"){ console.log("coordinates google"); console.dir(obj);
		if(typeof obj["geometry"] != "undefined" && typeof obj["geometry"]["location"] != "undefined"){
			lat = (typeof obj["geometry"]["location"]["lat"] != "undefined") ? obj["geometry"]["location"]["lat"] : null;
			lng = (typeof obj["geometry"]["location"]["lng"] != "undefined") ? obj["geometry"]["location"]["lng"] : null;
			//geoShape = (typeof obj["boundingbox"] != "undefined") ? obj["boundingbox"] : null; 
			//TODO : rajouter le boundingbox (transfoormer format google to leaflet polygon)
		}
	}else 
	if(providerName == "data.gouv"){
		if(typeof obj["geometry"] != "undefined" && typeof obj["geometry"]["coordinates"] != "undefined"){
			lat = (typeof obj["geometry"]["coordinates"][1] != "undefined") ? obj["geometry"]["coordinates"][1] : null;
			lng = (typeof obj["geometry"]["coordinates"][0] != "undefined") ? obj["geometry"]["coordinates"][0] : null;
			//TODO : geoshape
		}
	}
	else 
	if(providerName == "communecter"){
		if(typeof obj["geo"] != "undefined") commonObj["geo"] = obj["geo"];
		if(typeof obj["geoPosition"] != "undefined") commonObj["geoPosition"] = obj["geoPosition"];
		return commonObj;
	}

	if(lat != null && lng != null){
		commonObj["geo"] = { "@type" : "GeoCoordinates", 
							 "latitude" : lat,  "longitude" : lng };

		commonObj["geoPosition"] = { "type" : "Point", "float" : true, 
									 "coordinates" : new Array(lat, lng) };
	}

	if(geoShape != null){
		commonObj["geoShape"] = { "type" : "Polygon", 
							 "coordinates" : geoShape };
	}

	return commonObj;
}



/* affiche les résultat de la recherche dans la div #result (à placer dans l'interface au préalable) */
var markerListEntity = null;
function addResultsInForm(commonGeoObj, countryCode){
	
	//clear map
	var thisSig = Sig;
	if(markerListEntity != null)
	$.each(markerListEntity, function(){
		mapEntity.removeLayer(this);
	});
	markerListEntity = new Array();

	Sig.clearPolygon();
	Sig.listId = new Array();
	
	//clear list
	showMsgListRes("");

	//show objs in map && list
	var totalShown = 0;
	$.each(commonGeoObj, function(key, obj){
		console.log("obj.countryCode > " + obj.countryCode.toLowerCase() 
					+ " == " + countryCode.toLowerCase() + " < countryCode");

		//verifie que le countryCode correspond au choix dans le formulaire, 
		//et que la donnée a au moins un nom ou un code postal
		if(obj.countryCode.toLowerCase() == countryCode.toLowerCase() && 
		   (//typeof obj.cityName != "undefined" || 
		   typeof obj.postalCode != "undefined")){ totalShown++;
				showOneElementOnMap(obj, mapEntity);
		}
	});
	//var markersLayerAddress = L.featureGroup(markerListEntity);
	if(totalShown>0){
		mapEntity.fitBounds(L.featureGroup(markerListEntity).getBounds(), { 'maxZoom' : 14 });
		mapEntity.zoomOut();
	}
	console.log("total : " + totalShown);
	return totalShown;
}

function getFullAddress(obj){
	var strResult = "";
	if(typeof obj.street != "undefined") strResult += obj.street;
	if(typeof obj.cityName != "undefined") strResult += (strResult != "") ? ", " + obj.cityName : obj.cityName;
	//if(typeof obj.village != "undefined") strResult += (strResult != "") ? ", " + obj.village : obj.village;
	if(typeof obj.postalCode != "undefined") strResult += (strResult != "") ? ", " + obj.postalCode : obj.postalCode;
	if(typeof obj.country != "undefined") strResult += (strResult != "") ? ", " + obj.country : obj.country;
	return strResult;
}


function checkCityExists(addressData, btn){
	var data = "";
	if(typeof addressData.placeId != "undefined")
		data = "insee=" + addressData.placeId;
	if(typeof addressData.postalCode != "undefined"){ if(data != "") data += "&";
		data += "postalCode=" + addressData.postalCode;
	}
	if(typeof addressData.cityName != "undefined"){ if(data != "") data += "&";
		data += "cityName=" + addressData.cityName;
	}
	if(typeof addressData.country != "undefined"){ if(data != "") data += "&";
		data += "country=" + addressData.countryCode;
	}

	console.log("start verify city exists  : " + data);

	$.ajax({
			url: baseUrl+"/"+moduleId+"/city/cityExists",
			type: 'POST',
			data: data,
			async:false,
			dataType: "json",
			complete: function () {},
			success: function (thisSuccess){
				if(thisSuccess.res == true){
					console.log("cityExists : TRUE");
					console.dir(thisSuccess.obj);
					$(".item_map_list").removeClass("bg-success text-white");
					$(".item_map_list").removeClass("bg-red text-white");
					$(btn).addClass("bg-success text-white");
				}else{
					console.log("cityExists : FLASE");
					$(".item_map_list").removeClass("btn-success text-white");
					$(".item_map_list").removeClass("bg-red text-white");
					$(btn).addClass("bg-red text-white");
				}
			},
			error: function (thisError) {
				console.log("cityExists : ERROR");
				console.dir(thisError);
				$(btn).addClass("bg-red text-white");
			}
		});
}