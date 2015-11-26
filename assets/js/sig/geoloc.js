	
	/*
	function findGeoPosByAddress(){
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		//si on a une streetAddress
		}else{
			var request = "";

			//recuperation des données de l'addresse
			var street 			= ($("#streetAddress").html()  != $("#streetAddress").attr("data-emptytext"))  ? $("#streetAddress").html() : "";
			var address 		= ($("#address").html() 	   != $("#address").attr("data-emptytext")) 	   ? $("#address").html() : "";
			var addressCountry 	= ($("#addressCountry").html() != $("#addressCountry").attr("data-emptytext")) ? $("#addressCountry").html() : "";
			
			//construction de la requete
			request = addToRequest(request, street);
			request = addToRequest(request, address);
			request = addToRequest(request, addressCountry);

			request = transformNominatimUrl(request);
			request = "?q=" + request;
			
			findGeoposByNominatim(request);
		}
	
	}

	//quand la recherche nominatim a fonctionné
	function callbackNominatimSuccess(obj){
		console.log("callbackNominatimSuccess");
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//et on affiche le marker sur la carte à cette position
			showGeoposFound(coords, contextId, "organizations", contextData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
		}
	}

	//en cas d'erreur nominatim
	function callbackNominatimError(error){
		console.log("callbackNominatimError");
	}

	//quand la recherche par code insee a fonctionné
	function callbackFindByInseeSuccess(obj){
		console.log("callbackFindByInseeSuccess");
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une geoShape on l'affiche
			if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
			//on affiche le marker sur la carte
			showGeoposFound(coords, contextId, "organizations", contextData);
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		console.log("erreur getlatlngbyinsee");
	}
	
	*/

	//fonctions callback à surcharger
	//nominatim
	function callbackNominatimSuccess(obj){}
	function callbackNominatimError(error){}
	//insee
	function callbackFindByInseeSuccess(obj){}
	function callbackFindByInseeError(error){}

	//ajoute un élément de l'addresse à la requete
	function addToRequest(request, dataStr){
		if(dataStr == "") return request;
		if(request != "") dataStr = " " + dataStr;
		return transformNominatimUrl(request + dataStr);
	}

	//remplace les espaces par des +
	function transformNominatimUrl(str){
		var res = "";
		for(var i = 0; i<str.length; i++){
			res += (str.charAt(i) == " ") ? "+" : str.charAt(i);
		}
		return res;
	};

	//execute la requete nominatim 
	//et appel les fonction callback en cas de success/error
	//il faut définir les callback en fonction du context
	function findGeoposByNominatim(requestPart){
		console.log('findGeoposByNominatim');
		$.ajax({
			url: "//nominatim.openstreetmap.org/search" + requestPart + "&format=json&polygon=0&addressdetails=1",
			type: 'POST',
			dataType: 'json',
			complete: function () {},
			success: function (obj){	
				callbackNominatimSuccess(obj);
			},
			error: function (error) {
				callbackNominatimError(error);
			}
		});
	}

	//execute la requete nominatim 
	//et appel les fonction callback en cas de success/error
	//il faut définir les callback en fonction du context
	function findGeoposByInsee(codeInsee){
		$.ajax({
			url: baseUrl+"/"+moduleId+"/sig/getlatlngbyinsee",
			type: 'POST',
			data: "insee="+codeInsee,
			dataType: "json",
			complete: function () {},
			success: function (obj){
				callbackFindByInseeSuccess(obj);	
			},
			error: function (error) {
				callbackFindByInseeError(error);	
			}
		});
	}

	//affiche le marker à déplacer sur la carte
	function showGeoposFound(coords, contextId, contextType, contextData){
		Sig.startModifyGeoposition(contextId, contextType, contextData);
		Sig.markerModifyPosition.setLatLng(coords);
		Sig.map.panTo(coords);
		Sig.map.setZoom(13);
		showMap(true);
		Sig.map.invalidateSize(false);
		Sig.markerModifyPosition.dragging.enable();
	}