	
	/*
	function findGeoPosByAddress(){
		//toastr.success($("#entity-insee-value").html());
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			if($("#entity-insee-value").html() != "")
				findGeoposByInsee($("#entity-insee-value").attr("insee-val"));
		}else{
			var request = "";

			//recuperation des données de l'addresse 
			var street 			= ($("#streetAddress").html()  != $("#streetAddress").attr("data-emptytext"))  ? $("#streetAddress").html() : "";
			var address 		= ($("#address").html() 	   != $("#address").attr("data-emptytext")) 	   ? $("#address").html() : "";
			var addressCountry 	= ($("#addressCountry").html() != $("#addressCountry").attr("data-emptytext")) ? $("#addressCountry").html() : "";
			
			//construction de la requete
			request = addToRequest(request, street);toastr.info(street+"|");
			request = addToRequest(request, address);toastr.success(request+"|");
			request = addToRequest(request, addressCountry);toastr.error(request+"|" + " - " + addressCountry);

			request = transformNominatimUrl(request);
			toastr.success(request);
		
			request = "?q=" + request;
			findGeoposByNominatim(request);
		}
	}
	*/


	function addToRequest(request, dataStr){
		if(dataStr == "") return request;
		if(request != "") dataStr = " " + dataStr;
		return transformNominatimUrl(request + dataStr);
	}

	function transformNominatimUrl(str){
		var res = "";
		//remplace les espaces par des +
		for(var i = 0; i<str.length; i++){
			res += (str.charAt(i) == " ") ? "+" : str.charAt(i);
		}
		return res;
	};

	function findGeoposByNominatim(requestPart){
		$.ajax({
			url: "//nominatim.openstreetmap.org/search" + requestPart + "&format=json&polygon=1&addressdetails=1",
			type: 'POST',
			dataType: 'json',
			complete: function () { },
			success: function (obj){	
				//toastr.info("nominatim search success");
				if (obj.length > 0) {
					var coords = L.latLng(obj[0].lat, obj[0].lon);
					showGeoposFound(coords);
				}
				else {
					//toastr.error("nominatim search error : address not found");
					if($("#entity-insee-value").html() != "")
					findGeoposByInsee($("#entity-insee-value").attr("insee-val"));
				}
			},
			error: function (error) {
				//toastr.error("nominatim search error");
			}
		});
	}

	function findGeoposByInsee(codeInsee){ //alert(codeInsee);
		$.ajax({
			url: baseUrl+"/"+moduleId+"/sig/getlatlngbyinsee",
			type: 'POST',
			data: "insee="+codeInsee,
			dataType: "json",
			complete: function () { },
			success: function (obj){
				if (typeof obj != "undefined" && obj != "") {
					var coords = Sig.getCoordinates(obj, "markerSingle");
					if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
					showGeoposFound(coords);
				}
				else {
					console.log("erreur getlatlngbyinsee vide");
				}
			},
			error: function (error) {
				console.log("erreur getlatlngbyinsee");
			}
		});
	}

	function showGeoposFound(coords){
		Sig.startModifyGeoposition(contextId, "organizations", contextData);
		Sig.markerModifyPosition.setLatLng(coords);
		Sig.map.setView(coords, 13);
		Sig.map.panTo(coords);
		showMap(true);
		Sig.map.invalidateSize(false);
		Sig.markerModifyPosition.dragging.enable();
	}