
/* NE = New Element */
var timeoutAddCity;
var NE_insee = "";
var NE_lat = "";
var NE_lng = "";
var NE_city = "";
var NE_cp = "";
var NE_street = "";

var typeSearchInternational = "";
var formType = "";

function showMarkerNewElement(){ console.log("showMarkerNewElement");

	Sig.clearMap();
	if(typeof Sig.myMarker != "undefined") 
		Sig.map.removeLayer(Sig.myMarker);

	var options = {  id : 0,
					 icon : Sig.getIcoMarkerMap({'type' : formType}),
					 content : Sig.getPopupConfigAddress()
				  };
	console.log(options);

	var coordinates = new Array(Sig.myPosition.position.latitude, Sig.myPosition.position.longitude);
	console.log("coordinates", coordinates);
	
	//efface le marker s'il existe
	if(Sig.markerFindPlace != null) Sig.map.removeLayer(Sig.markerFindPlace);
	Sig.markerFindPlace = Sig.getMarkerSingle(Sig.map, options, coordinates);
	Sig.markerFindPlace.openPopup(); 
	Sig.markerFindPlace.dragging.enable();
	Sig.centerSimple(coordinates, 12);
	setTimeout(function(){ Sig.map.panBy([0, -150]);  }, 400);
	showMapLegende("info-circle", "Définissez l'adresse et la position de l'élément que vous êtes en train de créer<br>"+
								  "<a href='javascript:backToForm()' class='btn no-padding margin-top-10'>"+
								  	"<i class='fa fa-arrow-circle-left'></i> retour au formulaire"+
								  "</a>");

	//lorsque la popup s'ouvre, on ajoute l'event click sur le bouton de validation
	Sig.markerFindPlace.on("popupopen", function(){ console.log("popupopen");
		$('[name="newElement_insee"]').val(NE_insee);
		$('[name="newElement_lat"]').val(NE_lat);
		$('[name="newElement_lng"]').val(NE_lng);
		$('[name="newElement_city"]').val(NE_city);
		$('[name="newElement_cp"]').val(NE_cp);
		$('[name="newElement_streetAddress"]').val(NE_street);

		bindEventFormSig();
	});

	Sig.markerFindPlace.on('dragend', function(){
		NE_lat = Sig.markerFindPlace.getLatLng().lat;
		NE_lng = Sig.markerFindPlace.getLatLng().lng;
		Sig.markerFindPlace.openPopup();
	});
	
	bindEventFormSig();
	Sig.showRightToolMap(false);
}

function bindEventFormSig(){
	$('[name="newElement_city"]').keyup(function(){ 
		$("#dropdown-city-found").show();
		if($('[name="newElement_city"]').val()!=""){
			NE_city = $('[name="newElement_city"]').val();
			if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
			timeoutAddCity = setTimeout(function(){ autocompleteFormAddress("city", $('[name="newElement_city"]').val()); }, 500);
		}
	});
	$('[name="newElement_cp"]').keyup(function(){ 
		$("#dropdown-cp-found").show();
		if($('[name="newElement_cp"]').val()!=""){
			NE_cp = $('[name="newElement_cp"]').val();
			if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
			timeoutAddCity = setTimeout(function(){ autocompleteFormAddress("cp", $('[name="newElement_cp"]').val()); }, 500);
		}
	});
	$('[name="newElement_streetAddress"]').keyup(function(){ 
		$("#dropdown-cp-found").show();
		NE_street = $('[name="newElement_streetAddress"]').val();
	});

	$('[name="newElement_cp"]').focusout(function(){
		if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
		timeoutAddCity = setTimeout(function(){ $("#dropdown-newElement_cp-found").hide(); }, 200);
	});
	$('[name="newElement_city"]').focusout(function(){
		if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
		timeoutAddCity = setTimeout(function(){ $("#dropdown-newElement_city-found").hide(); }, 200);
	});

	$('[name="newElement_cp"]').focus(function(){
		$(".dropdown-menu").hide();
		$("#dropdown-newElement_cp-found").show();
		if($('[name="newElement_cp"]').val() != ""){
			autocompleteFormAddress("cp", $('[name="newElement_cp"]').val());
		}
	});
	$('[name="newElement_city"]').focus(function(){
		$(".dropdown-menu").hide();
		$("#dropdown-newElement_city-found").show();
		if($('[name="newElement_city"]').val() != ""){
			autocompleteFormAddress("city", $('[name="newElement_city"]').val());
		}
	});

	$('[name="newElement_streetAddress"]').focus(function(){
		$(".dropdown-menu").hide();
	});

	$("#newElement_btnSearchAddress").click(function(){
		$(".dropdown-menu").hide();
		searchAdressNewElement();
	});

	var allCountries = getCountries("select2");
	$.each(allCountries, function(key, country){
	 	$('[name="newElement_country"]').append("<option value='"+country.id+"'>"+country.text+"</option>");
	});

	$("#info_insee_latlng").html(
		"<span class='pull-left'><b>Insee : </b>" + NE_insee + "</span> " +
		"<span class='pull-right'><b>lat : </b>" + NE_lat + " <b>lng : </b>" + NE_lng + "</span> "
	);

	$("#newElement_btnCancelAddress").click(function(){
		$('[name="newElement_insee"]').val("");
		$('[name="newElement_lat"]').val("");
		$('[name="newElement_lng"]').val("");
		$('[name="newElement_city"]').val("");
		$('[name="newElement_cp"]').val("");
		NE_insee = ""; NE_lat =  ""; NE_lng =""; NE_city = ""; NE_cp = "";
		backToForm();
	});

	/* TODO TIB */
	$("#newElement_btnValidateAddress").click(function(){
		backToForm();
	});
}

function autocompleteFormAddress(currentScopeType, scopeValue){
	//var scopeValue = $('[name="newElement_city"]').val();
	$("#dropdown-newElement_"+currentScopeType+"-found").html("<li><a href='javascript:'><i class='fa fa-refresh fa-spin'></i></a></li>");
	$("#dropdown-newElement_"+currentScopeType+"-found").show();
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/city/autocompletemultiscope",
        data: {
        		type: currentScopeType, 
        		scopeValue: scopeValue,
        		geoShape: true
        },
       	dataType: "json",
    	success: function(data){
    		//console.log("autocompleteMultiScope() success");
    		//console.dir(data);
    		html="";
    		var allCP = new Array();
    		var allCities = new Array();
    		var inseeGeoSHapes = new Array();
    		$.each(data.cities, function(key, value){
    			if(currentScopeType == "city") { console.log("in scope city"); console.dir(value);
    				// val = value.country + '_' + value.insee; 
		    		// lbl = (typeof value.name!= "undefined") ? value.name : ""; //value.name ;
		    		// var cp = (typeof value.postalCode!= "undefined") ? value.postalCode : ""; //value.name ;
		    		// lblList = lbl + " (" +value.depName + ")";
		    		// html += "<li><a href='javascript:' onclick='selectThisAdressElement(\""+currentScopeType+"\", \""+val+"\",\""+cp+"\" )'>"+lblList+"</a></li>";
    				var insee = value.insee;
		    		$.each(value.postalCodes, function(key, valueCP){
    					if($.inArray(valueCP.postalCode, allCP)<0){ 
	    					allCP.push(valueCP.postalCode);
	    					if(notEmpty(value.geoShape))
		    				inseeGeoSHapes[value.insee] = value.geoShape.coordinates[0];
		    				var val = valueCP.name; 
		    				var lbl = valueCP.postalCode ;
		    				var lat = valueCP.geo.latitude;
		    				var lng = valueCP.geo.longitude;
		    				var lblList = value.name + ", " + valueCP.name + ", " +valueCP.postalCode ;
		    				html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-city='"+val+"' data-cp='"+lbl+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-city-found'>"+lblList+"</a></li>";
	    			}
	    			});
    			}; 
    			if(currentScopeType == "cp") { 
    				var insee = value.insee;
		    		$.each(value.postalCodes, function(key, valueCP){ console.log(allCities);
    					if($.inArray(valueCP.name, allCities)<0){ 
	    					allCities.push(valueCP.name);
		    				if(notEmpty(value.geoShape))
		    				inseeGeoSHapes[value.insee] = value.geoShape.coordinates[0];
		    				var val = valueCP.postalCode; 
		    				var lbl = valueCP.name ;
		    				var lblList = valueCP.name + ", " +valueCP.postalCode ;
		    				var lat = valueCP.geo.latitude;
		    				var lng = valueCP.geo.longitude;
		    				html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-city='"+lbl+"' data-cp='"+val+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-cp-found'>"+lblList+"</a></li>";
    				}});
    			};
    		});

    		if(html == "") html = "<i class='fa fa-ban'></i> Aucun résultat";
    		$("#dropdown-newElement_"+currentScopeType+"-found").html(html);
    		$("#dropdown-newElement_"+currentScopeType+"-found").show();

    		$(".item-city-found, .item-cp-found").click(function(){

    			$('[name="newElement_insee"]').val($(this).data("insee"));
				$('[name="newElement_lat"]').val($(this).data("lat"));
				$('[name="newElement_lng"]').val($(this).data("lng"));
				$('[name="newElement_city"]').val($(this).data("city"));
				$('[name="newElement_cp"]').val($(this).data("cp"));
				
				NE_insee = $(this).data("insee");
				NE_lat = $(this).data("lat");
				NE_lng = $(this).data("lng");
				NE_city = $(this).data("city");
				NE_cp = $(this).data("cp");
				
				Sig.markerFindPlace.setLatLng([$(this).data("lat"), $(this).data("lng")]);
				Sig.map.panTo([$(this).data("lat"), $(this).data("lng")]);
				
				
				
				if(notEmpty(inseeGeoSHapes[NE_insee])){
					var shape = inseeGeoSHapes[NE_insee];
					shape = Sig.inversePolygon(shape);
					Sig.showPolygon(shape);
					Sig.map.fitBounds(shape);
				}else{
					timeoutAddCity = setTimeout(function(){ Sig.map.setZoom(14); }, 500);
				}
				$("#dropdown-newElement_cp-found, #dropdown-newElement_city-found, #dropdown-newElement_streetAddress-found").hide();

				$("#info_insee_latlng").html(
						"<span class='pull-left'><b>Insee : </b>" + NE_insee + "</span> " +
						"<span class='pull-right'><b>lat : </b>" + NE_lat + " <b>lng : </b>" + NE_lng + "</span> "
						);
    		});
    		
    		
	    },
		error: function(error){
    		$("#dropdown-newElement_"+currentScopeType+"-found").html("error");
			console.log("Une erreur est survenue pendant autocompleteMultiScope");
		}
	});
}


function searchAdressNewElement(){
	var providerName = "";
	var requestPart = "";

	var street 	= ($('[name="newElement_streetAddress"]').val()  != "") ? $('[name="newElement_streetAddress"]').val() : "";
	var city 	= ($('[name="newElement_city"]').val() 	   	  	 != "") ? $('[name="newElement_city"]').val() : "";
	var cp 		= ($('[name="newElement_cp"]').val() 			 != "") ? $('[name="newElement_cp"]').val() : "";
	var countryCode = ($('[name="newElement_country"]').val() 	 != "") ? $('[name="newElement_country"]').val() : "";

	if($('[name="newElement_streetAddress"]').val() != ""){
		providerName = "nominatim";
		typeSearchInternational = "address";
		//construction de la requete
		requestPart = addToRequest(requestPart, street);
		requestPart = addToRequest(requestPart, city);
		requestPart = addToRequest(requestPart, cp);
	}else{
		providerName = "communecter"
		typeSearchInternational = "city";
		//construction de la requete
		if(cp != ""){
			requestPart = addToRequest(requestPart, cp);
		}
	}


	$("#dropdown-newElement_streetAddress-found").html("<li><a href='javascript:'><i class='fa fa-spin fa-refresh'></i> recherche en cours</a></li>");
	$("#dropdown-newElement_streetAddress-found").show();

	callGeoWebService(providerName, requestPart, countryCode, 
		function(objs){
			//success
			console.log("success callGeoWebService");
			console.dir(objs);
			var res = getCommonGeoObject(objs, providerName);
			console.dir(res);
			var html = "";
			$.each(res, function(key, value){ //console.log(allCities);
    			if(notEmpty(value.countryCode)){
    				if(value.countryCode.toLowerCase() == countryCode.toLowerCase()){ 
    					html += "<li><a href='javascript:' class='item-street-found' data-lat='"+value.geo.latitude+"' data-lng='"+value.geo.longitude+"'>"+value.name+"</a></li>";
    				}
    			}
    		});
    		if(html == "") html = "<i class='fa fa-ban'></i> Aucun résultat";
    		$("#dropdown-newElement_streetAddress-found").html(html);
    		$("#dropdown-newElement_streetAddress-found").show();

    		$(".item-street-found").click(function(){
    			Sig.markerFindPlace.setLatLng([$(this).data("lat"), $(this).data("lng")]);
				Sig.map.panTo([$(this).data("lat"), $(this).data("lng")]);
				Sig.map.setZoom(16);
				$("#dropdown-newElement_streetAddress-found").hide();
    		});
		}, 
		function(){
			//error
		}
	);
}

function backToForm(){
	showMap(false);
	$('#ajax-modal').modal("show");
}