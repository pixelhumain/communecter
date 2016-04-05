	
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
	//DataGouv
	function callbackDataGouvSuccess(obj){}
	function callbackDataGouvError(error){}

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
		showLoadingMsg("Recherche de la position en cours");
		$("#iconeChargement").css("display", "inline-block");

		$.ajax({
			url: "//nominatim.openstreetmap.org/search?q=" + requestPart + "&format=json&polygon=0&addressdetails=1",
			type: 'POST',
			dataType: 'json',
			async:false,
			crossDomain:true,
			complete: function () {},
			success: function (obj){
				hideLoadingMsg();
				callbackNominatimSuccess(obj);
				// if(result.length > 0){ 
				// 	callbackNominatimSuccess(obj);
				// }else{
				// 	findGeoposByGoogleMaps(requestPart);
				// }
			},
			error: function (error) {
				callbackNominatimError(error);
				$("#iconeChargement").hide();
			}
		});
	}


	//execute la requete nominatim 
	//et appel les fonction callback en cas de success/error
	//il faut définir les callback en fonction du context 
	function findGeoposByInsee(codeInsee, callbackSuccess, postalCode){
		//toastr.info('<i class="fa fa-spin fa-refresh"></i> Recherche de la position en cours...');
		console.log("codeInsee", codeInsee);
		showLoadingMsg("Recherche de la position en cours");
		$("#iconeChargement").css("display", "inline-block");

		$.ajax({
			url: baseUrl+"/"+moduleId+"/sig/getlatlngbyinsee",
			type: 'POST',
			data: "insee="+codeInsee+"&postalCode="+postalCode,
			async:false,
			dataType: "json",
			complete: function () {},
			success: function (obj){
				console.log("success findGeoposByInsee", typeof callbackSuccess);
				obj.insee = codeInsee;
				if(typeof callbackSuccess != "undefined" && callbackSuccess != null){
					callbackSuccess(obj);
				}
				else{
					callbackFindByInseeSuccess(obj);
				}
			},
			error: function (error) {
				console.log("error findGeoposByInsee");
				callbackFindByInseeError(error);	
				$("#iconeChargement").hide();	
			}
		});
	}


	//recupere les citoyen, orga, events, projets de la city par son code insee
	//et affiche les résultat sur la carte
	function showDataByInsee(insee){
		//toastr.success('recherche des éléments de la ville');
				
		$.ajax({
			url: baseUrl+"/"+moduleId+"/city/getcityjsondata",
			type: 'POST',
			data: "insee="+insee,
			async:false,
			dataType: "json",
			complete: function () {},
			success: function (obj){
				console.log("success showDataByInsee");
				console.dir(obj);
				hideLoadingMsg();
				Sig.showMapElements(Sig.map, obj);
				setTimeout(function() { Sig.map.panBy[10,10]; },2000);
			},
			error: function (error) {
				$("#loader-city").html("");
				console.log("error showDataByInsee");
			}
		});
	}

	//affiche le marker à déplacer sur la carte (ne pas utiliser pour créer une nouvelle donnée)
	function showGeoposFound(coords, contextId, contextType, contextData){
		showMap(true);
		toastr.success('position trouvée');
		Sig.startModifyGeoposition(contextId, contextType, contextData);
		Sig.map.setZoom(17);
			// Sig.markerModifyPosition.setLatLng(coords);
		
		setTimeout(function() { 
			Sig.map.panTo(coords);
			Sig.map.setZoom(15);
			Sig.map.invalidateSize(false);
			//toastr.success('mise à jour de la carte ok');
		
		 },2000);
		Sig.markerModifyPosition.dragging.enable();
	}


	function updateCitiesGeoFormat(){
		showLoadingMsg("Mise à jour de la bdd en cours");
		$.ajax({
			url: baseUrl+"/"+moduleId+"/city/updatecitiesgeoformat",
			type: 'POST',
			async:false,
			dataType: "json",
			complete: function () {},
			success: function (obj){
				console.log("success updatecitiesgeoformat");
				console.dir(obj);
				showLoadingMsg("<span class='text-dark'>Votre base de donnée est à jour</span>");
				setTimeout( "hideLoadingMsg()", 3000);
			},
			error: function (error) {
				console.log("error updatecitiesgeoformat");
				showLoadingMsg("<span class='text-green'>Une erreur s'est produite pendant la MAJ</span>");
				setTimeout( "hideLoadingMsg()", 3000);
			}
		});
	}


	function findGeoposByGoogleMaps(requestPart, keyApp){
		//var keyApp = "";
		var objnominatim = {} ;
		console.log('findGeoposByGoogleMaps',"https://maps.googleapis.com/maps/api/geocode/json?address=" + requestPart); // + "&key="+keyApp);
		showLoadingMsg("Recherche de la position en cours");
		$.ajax({
			url: "//maps.googleapis.com/maps/api/geocode/json?address=" + requestPart,// + "&key="+keyApp,
			type: 'POST',
			dataType: 'json',
			async:false,
			crossDomain:true,
			complete: function () {},
			success: function (obj){
				hideLoadingMsg();
				callbackGoogleMapsSuccess(obj);
			},
			error: function (error) {
				callbackGoogleMapsError(error);
			}
		});
		return objnominatim ;
	}


	function findGeoposByDataGouv(requestPart){
		var objDataGouv = {} ;
		$.ajax({  
			url: "//api-adresse.data.gouv.fr/search/?q=" + requestPart ,
			dataType: 'json',
			async:false,
			complete: function () {},
			success: function (obj){
				hideLoadingMsg();
				callbackDataGouvSuccess(obj);
			},
			error: function (error) {
				callbackDataGouvError(error);
			}
		});

		return objDataGouv ;

	}


