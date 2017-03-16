
/* NE = New Element */
var timeoutAddCity;
var NE_insee = "";
var NE_lat = "";
var NE_lng = "";
var NE_city = "";
var NE_cp = "";
var NE_street = "";

var NE_country = "";
var NE_dep = "";
var NE_region = "";

var PC_postalCode = "";
var	PC_name = "";
var	PC_latitude = "";
var	PC_longitude = "";

var typeSearchInternational = "";
var formType = "";
var updateLocality = false;
var addressesIndex = false;
var saveCities = new Array();
var uncomplete = false;

var modePostalCode = false;

function showMarkerNewElement(modePC){
	var contentSig = Sig.getPopupConfigAddress();
	if(typeof modePC != "undefined" ){
		modePostalCode = true;
		contentSig = Sig.getPopupConfigPostalCode();
	} 
	mylog.log("showMarkerNewElement");
	Sig.clearMap();

	if(typeof Sig.myMarker != "undefined") 
		Sig.map.removeLayer(Sig.myMarker);
	mylog.log("formType", formType);
	var options = {  id : 0,
					 icon : Sig.getIcoMarkerMap({'type' : formType}),
					 content : contentSig
				  };
	mylog.log(options);

	if(NE_country== "" && typeof currentUser != "undefined" && currentUser != null && typeof currentUser.addressCountry != "undefined" && currentUser.addressCountry != null){
		NE_country = currentUser.addressCountry;
		mylog.log("NE_country", NE_country);
	}
	//console.log("coordinatesPreLoadedFormMap", coordinatesPreLoadedFormMap);
	var coordinates = new Array(0, 0);
	if(typeof contextData != "undefined" && contextData != null && typeof contextData.geo != "undefined" && contextData.geo != null && updateLocality == true)
		coordinates = new Array(contextData.geo.latitude, contextData.geo.longitude);
	
	/*if(typeof coordinatesPreLoadedFormMap != "undefined")
		coordinates = coordinatesPreLoadedFormMap;*/
	console.log("coordinates", coordinates);
	
	//efface le marker s'il existe
	if(Sig.markerFindPlace != null) Sig.map.removeLayer(Sig.markerFindPlace);
	Sig.markerFindPlace = Sig.getMarkerSingle(Sig.map, options, coordinates);
	Sig.markerFindPlace.openPopup(); 
	Sig.markerFindPlace.dragging.enable();
	//Sig.centerSimple(coordinates, 12);
	Sig.centerPopupMarker(coordinates, 12);
	/*
	Sig.map.panTo(coordinates, {"animate" : false });
	setTimeout(function(){  Sig.map.setZoom(12); //Sig.map.panBy([0, -50]);
							setTimeout(function(){
								Sig.map.panTo(coordinates, {"animate" : false });
								setTimeout(function(){ Sig.map.panBy([0, -200]);}, 500);
								mylog.log("panBy 200");
							}, 700);
						}, 2000);*/
	showMapLegende("info-circle", "<style>#btn-back, #right_tool_map{display:none;}</style>Définissez l'adresse et la position de l'élément<br>"+
								  "<a href='javascript:backToForm(true)' class='btn no-padding margin-top-10'>"+
								  	"<i class='fa fa-arrow-circle-left'></i> retour"+
								  "</a>");

	$('[name="newElement_country"]').val(NE_country);
	
	if(NE_country != ""){
		$("#divPostalCode").removeClass("hidden");
		$("#divCity").removeClass("hidden");
	}
	if(updateLocality == true){
		$('[name="newElement_insee"]').val(NE_insee);
		$('[name="newElement_lat"]').val(NE_lat);
		$('[name="newElement_lng"]').val(NE_lng);
		$('[name="newElement_city"]').val(NE_city);
		$('[name="newElement_cp"]').val(NE_cp);
		$('[name="newElement_streetAddress"]').val(NE_street.trim());
		$('[name="newElement_dep"]').val(NE_dep);
		$('[name="newElement_region"]').val(NE_region);
		$("#newElement_btnValidateAddress").prop('disabled', (NE_insee==""?true:false));
		if(NE_insee != ""){
			$("#divStreetAddress").removeClass("hidden");
		}
	}

	//lorsque la popup s'ouvre, on ajoute l'event click sur le bouton de validation
	Sig.markerFindPlace.on("popupopen", function(){ mylog.log("popupopen");
		mylog.log("NE_city", NE_city);
		$('[name="newElement_insee"]').val(NE_insee);
		$('[name="newElement_lat"]').val(NE_lat);
		$('[name="newElement_lng"]').val(NE_lng);
		$('[name="newElement_city"]').val(NE_city);
		$('[name="newElement_cp"]').val(NE_cp);
		$('[name="newElement_streetAddress"]').val(NE_street.trim());
		$('[name="newElement_dep"]').val(NE_dep);
		$('[name="newElement_region"]').val(NE_region);
		$('[name="newElement_country"]').val(NE_country);
		$("#newElement_btnValidateAddress").prop('disabled', (NE_insee==""?true:false));
		if(NE_insee != ""){
			$("#divStreetAddress").removeClass("hidden");
			$("#divPostalCode").removeClass("hidden");
			$("#divCity").removeClass("hidden");
		}else if(NE_country != ""){
			$("#divPostalCode").removeClass("hidden");
			$("#divCity").removeClass("hidden");
		}
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
		if($('[name="newElement_city"]').val().length > 0){
			NE_city = $('[name="newElement_city"]').val();
			if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
			timeoutAddCity = setTimeout(function(){ autocompleteFormAddress("city", $('[name="newElement_city"]').val()); }, 500);
		}
	});
	$('[name="newElement_cp"]').keyup(function(){
		mylog.log("uncomplete",uncomplete);
		if(uncomplete == false){
			$("#dropdown-cp-found").show();
			mylog.log("newElement_cp",$('[name="newElement_cp"]').val().length);
			if($('[name="newElement_cp"]').val().length > 0){
				mylog.log("newElement_cp",$('[name="newElement_cp"]').val().length);
				NE_cp = $('[name="newElement_cp"]').val();
				changeSelectCountrytim();
				if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
				timeoutAddCity = setTimeout(function(){ autocompleteFormAddress("cp", $('[name="newElement_cp"]').val()); }, 500);
			}
		}else{
			if($('[name="newElement_cp"]').val().length > 3){
				NE_cp = $('[name="newElement_cp"]').val();
				$("#newElement_btnValidateAddress").prop('disabled', false);
				$('#divPostalCode').addClass("has-success");
				$('#divPostalCode').removeClass("has-error");
			}else{
				$("#newElement_btnValidateAddress").prop('disabled', true);
				$('#divPostalCode').addClass("has-error");
				$('#divPostalCode').removeClass("has-success");
			}
		}
		
	});

	$('[name="newElement_streetAddress"]').keyup(function(){ 
		$("#dropdown-cp-found").show();
		NE_street = $('[name="newElement_streetAddress"]').val().trim();
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
		if(uncomplete == false){
			$(".dropdown-menu").hide();
			$("#dropdown-newElement_cp-found").show();
			if($('[name="newElement_cp"]').val().length > 0){
				autocompleteFormAddress("cp", $('[name="newElement_cp"]').val());
			}
		}
	});
	$('[name="newElement_city"]').focus(function(){
		$(".dropdown-menu").hide();
		$("#dropdown-newElement_city-found").show();
		if($('[name="newElement_city"]').val().length > 0){
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
	
	/*var allCountries = getCountries("select2");
	$.each(allCountries, function(key, country){
		mylog.log(country.id, country.text);
	 	$('[name="newElement_country"]').append("<option value='"+country.id+"'>"+country.text+"</option>");
	});*/

	$('[name="newElement_country"]').change(function(){
		mylog.log("change country");
		NE_country = $('[name="newElement_country"]').val() ;
		NE_insee = "";NE_lat = "";NE_lng = "";NE_city = "";NE_cp = "";NE_street = "";
		$('[name="newElement_insee"]').val(NE_insee);
		$('[name="newElement_city"]').val(NE_city);
		$('[name="newElement_cp"]').val(NE_cp);
		$('[name="newElement_streetAddress"]').val(NE_street);
		$('[name="newElement_dep"]').val(NE_dep);
		$('[name="newElement_region"]').val(NE_region);
		$("#newElement_btnValidateAddress").prop('disabled', true);
		$("#divStreetAddress").addClass("hidden");
		initDropdown();
		mylog.log("NE_country", NE_country, typeof NE_country, NE_country.length);
		if(NE_country != ""){
			$("#divPostalCode").removeClass("hidden");
			$("#divCity").removeClass("hidden");
		}else{
			mylog.log("NE_country", NE_country, typeof NE_country, NE_country.length);
			$("#divPostalCode").addClass("hidden");
			$("#divCity").addClass("hidden");
		}
			
	});

	/*$("#info_insee_latlng").html(
		"<span class='pull-left'><b>Insee : </b>" + NE_insee + "</span> " +
		"<span class='pull-right'><b>lat : </b>" + NE_lat + " <b>lng : </b>" + NE_lng + "</span> "
	);*/
	updateHtmlInseeLatLon();

	$("#newElement_btnCancelAddress").click(function(){
		$('[name="newElement_insee"]').val("");
		$('[name="newElement_lat"]').val("");
		$('[name="newElement_lng"]').val("");
		$('[name="newElement_city"]').val("");
		$('[name="newElement_cp"]').val("");
		$('[name="newElement_dep"]').val("");
		$('[name="newElement_region"]').val("");
		NE_insee = ""; NE_lat =  ""; NE_lng =""; NE_city = ""; NE_cp = "";
		backToForm(true);
	});

	/* TODO TIB */
	$("#newElement_btnValidateAddress").click(function(){
		if(notEmpty(saveCities[NE_insee])){
			var obj = { city : saveCities[NE_insee] }
			obj.city.geoShape = 1;
			console.log(typeof obj.city.postalCodes);
			console.dir(obj.city.postalCodes);
			if(uncomplete == true){
				var postalCode = {};
				
				postalCode.name = obj.city.name;
				postalCode.postalCode = NE_cp;
				postalCode.geo = obj.city.geo;
				postalCode.geoPosition = obj.city.geoPosition;

				mylog.log("saveCities", typeof obj.city.postalCodes, obj.city.postalCodes);

				obj.city.postalCodes.push(postalCode);
			}
			console.log(typeof obj.city.postalCodes);
			console.dir(obj.city.postalCodes);
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/city/save",
		        data: obj,
		       	dataType: "json",
		    	success: function(data){
		    		console.dir(obj.city);
		    		mylog.log("data", data);
		    		if(data.result)
		    			backToForm();
		    	},
				error: function(error){
					mylog.log("error", error);

		    		$("#dropdown-newElement_"+currentScopeType+"-found").html("error");
					mylog.log("Une erreur est survenue pendant l'enregistrement de la commune");
				}
			});
		}else
			backToForm();
	});


	$('[name="newPC_postalCode"]').keyup(function(){
		if($('[name="newPC_postalCode"]').val().length > 3){
			PC_postalCode = $('[name="newElement_cp"]').val();
			checkDataPostalCode();
			$('#divPostalCode').addClass("has-success");
			$('#divPostalCode').removeClass("has-error");
		}else{
			PC_postalCode = "";
			checkDataPostalCode();
			$('#divPostalCode').addClass("has-error");
			$('#divPostalCode').removeClass("has-success");
		}
	});

	$('[name="newPC_name"]').keyup(function(){
		mylog.log("uncomplete",uncomplete);
		if($('[name="newPC_name"]').val().length > 2){
			PC_name = $('[name="newPC_name"]').val();
			checkDataPostalCode();
			$('#divCity').addClass("has-success");
			$('#divCity').removeClass("has-error");
		}else{
			PC_name = "";
			checkDataPostalCode();
			$('#divCity').addClass("has-error");
			$('#divCity').removeClass("has-success");
		}
	});

	$('[name="newPC_lat"]').keyup(function(){
		if(parseFloat($('[name="newPC_lat"]').val()) > -90 && parseFloat($('[name="newPC_lat"]').val()) < 90){
			// -180 and +180 
			PC_latitude = $('[name="newPC_lat"]').val();
			checkDataPostalCode();
			$('#divCity').addClass("has-success");
			$('#divCity').removeClass("has-error");
		}else{
			PC_latitude = "";
			checkDataPostalCode();
			$('#divCity').addClass("has-error");
			$('#divCity').removeClass("has-success");
		}
	});

	$('[name="newPC_lon"]').keyup(function(){
		if(parseFloat($('[name="newPC_lon"]').val()) > -180 && parseFloat($('[name="newPC_lon"]').val()) < 180){
			PC_longitude = $('[name="newPC_lon"]').val();
			checkDataPostalCode();
			$('#divCity').addClass("has-success");
			$('#divCity').removeClass("has-error");
		}else{
			PC_longitude = "";
			checkDataPostalCode();
			$('#divCity').addClass("has-error");
			$('#divCity').removeClass("has-success");
		}
	});

	$("#newPC_btnValidatePC").click(function(){
		PC_postalCode : $("[name='newPC_postalCode']").val();
		PC_name = $("[name='newPC_name']").val();
		PC_latitude = $("[name='newPC_lat']").val();
		PC_longitude = $("[name='newPC_lng']").val();
		backToForm();
		$('#divCity').append("<a href=");
	});
}

function checkDataPostalCode(){
	if(PC_postalCode != "" && PC_name != "" && PC_latitude != "" && PC_longitude != "")
		$("#newPC_btnValidatePC").prop('disabled', false);
	else
		$("#newPC_btnValidatePC").prop('disabled', true);
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
        		geoShape: true,
        		countryCode : $('[name="newElement_country"]').val()
        },
       	dataType: "json",
    	success: function(data){

    		//mylog.dir(data);
    		html="";
    		var allCP = new Array();
    		var allCities = new Array();
    		var inseeGeoSHapes = new Array();
    		saveCities = new Array();
    		$.each(data.cities, function(key, value){
    			var insee = value.insee;
    			var country = value.country;
    			var dep = value.depName;
    			var region = value.regionName;
    			if(notEmpty(value.save))
    				saveCities[insee] = value;

    			if(notEmpty(value.geoShape))
			    	inseeGeoSHapes[insee] = value.geoShape.coordinates[0];

    			if(currentScopeType == "city") { mylog.log("in scope city"); mylog.dir(value);
    				if(value.postalCodes.length > 0){
    					$.each(value.postalCodes, function(key, valueCP){
		    				var val = valueCP.name; 
		    				var lbl = valueCP.postalCode ;
		    				var lat = valueCP.geo.latitude;
		    				var lng = valueCP.geo.longitude;
		    				var lblList = value.name + ", " + valueCP.name + ", " +valueCP.postalCode + ", " + value.osmID ;
		    				html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-dep='"+dep+"' data-region='"+region+"' data-country='"+country+"' data-city='"+val+"' data-cp='"+lbl+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-city-found'>"+lblList+"</a></li>";
		    			});
    				}else{
    					var val = value.name; 
	    				var lat = value.geo.latitude;
	    				var lng = value.geo.longitude;
		    				var lblList = value.name ;
    					html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-dep='"+dep+"' data-region='"+region+"' data-country='"+country+"' data-city='"+val+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-city-found-uncomplete'>"+lblList+"</a></li>";
					}
    				
    			}; 
    			if(currentScopeType == "cp") { 
    				$.each(value.postalCodes, function(key, valueCP){ mylog.log(allCities);
    					if($.inArray(valueCP.name, allCities)<0){ 
	    					allCities.push(valueCP.name);
		    				var val = valueCP.postalCode; 
		    				var lbl = valueCP.name ;
		    				var lblList = valueCP.name + ", " +valueCP.postalCode ;
		    				var lat = valueCP.geo.latitude;
		    				var lng = valueCP.geo.longitude;
		    				//mylog.log("valueCPvalueCPvalueCPvalueCP", valueCP);
		    				html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-dep='"+dep+"' data-region='"+region+"' data-country='"+country+"' data-city='"+lbl+"' data-cp='"+val+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-cp-found'>"+lblList+"</a></li>";
    				}});
    			};
    		});

    		if(html == "") html = "<i class='fa fa-ban'></i> Aucun résultat";
    		$("#dropdown-newElement_"+currentScopeType+"-found").html(html);
    		$("#dropdown-newElement_"+currentScopeType+"-found").show();

    		$(".item-city-found, .item-cp-found").click(function(){
    			add(true, $(this), inseeGeoSHapes);
    			/*$('[name="newElement_insee"]').val($(this).data("insee"));
				$('[name="newElement_lat"]').val($(this).data("lat"));
				$('[name="newElement_lng"]').val($(this).data("lng"));
				$('[name="newElement_city"]').val($(this).data("city"));
				$('[name="newElement_cp"]').val($(this).data("cp"));
				$('[name="newElement_dep"]').val($(this).data("dep"));
				$('[name="newElement_region"]').val($(this).data("region"));
				
				NE_insee = $(this).data("insee");
				NE_lat = $(this).data("lat");
				NE_lng = $(this).data("lng");
				NE_city = $(this).data("city");
				NE_cp = $(this).data("cp");
				NE_country = $(this).data("country");
				NE_dep = $(this).data("dep");
				NE_region = $(this).data("region");
				
				Sig.markerFindPlace.setLatLng([$(this).data("lat"), $(this).data("lng")]);
				Sig.map.panTo([$(this).data("lat"), $(this).data("lng")]);
				
				mylog.log("geoShape", inseeGeoSHapes);
				if(notEmpty(inseeGeoSHapes[NE_insee])){
					var shape = inseeGeoSHapes[NE_insee];
					shape = Sig.inversePolygon(shape);
					Sig.showPolygon(shape);
					setTimeout(function(){
						Sig.map.fitBounds(shape);
						Sig.map.invalidateSize();
					}, 1500);
				}else{
					Sig.centerPopupMarker([NE_lat, NE_lng], 12);
					// timeoutAddCity = setTimeout(function(){ //alert("zoom centerrrrr");
					// 						Sig.centerPopupMarker([NE_lat, NE_lng], 12);
	
					// 						/*Sig.map.panTo([NE_lat, NE_lng]);
					// 						Sig.map.setZoom(14); 
					// 						Sig.map.invalidateSize();*/
					// 				}, 1500);
				//}
				//$("#dropdown-newElement_cp-found, #dropdown-newElement_city-found, #dropdown-newElement_streetAddress-found").hide();

				/*$("#info_insee_latlng").html(
						"<span class='pull-left'><b>Insee : </b>" + NE_insee + "</span> " +
						"<span class='pull-right'><b>lat : </b>" + NE_lat + " <b>lng : </b>" + NE_lng + "</span> "
						);*/
				/*updateHtmlInseeLatLon();
				$("#newElement_btnValidateAddress").prop('disabled', false);
				$("#divStreetAddress").removeClass("hidden");*/
    		});

    		$(".item-city-found-uncomplete").click(function(){

    			add(false, $(this), inseeGeoSHapes);
    		});
	    },
		error: function(error){
    		$("#dropdown-newElement_"+currentScopeType+"-found").html("error");
			mylog.log("Une erreur est survenue pendant autocompleteMultiScope");
		}
	});
}

function add(complete, data, inseeGeoSHapes){
	console.log("add", complete);
	$('[name="newElement_insee"]').val(data.data("insee"));
	$('[name="newElement_lat"]').val(data.data("lat"));
	$('[name="newElement_lng"]').val(data.data("lng"));
	$('[name="newElement_city"]').val(data.data("city"));
	$('[name="newElement_dep"]').val(data.data("dep"));
	$('[name="newElement_region"]').val(data.data("region"));
	
	NE_insee = data.data("insee");
	NE_lat = data.data("lat");
	NE_lng = data.data("lng");
	NE_city = data.data("city");
	NE_country = data.data("country");
	NE_dep = data.data("dep");
	NE_region = data.data("region");

	if(complete == true){
		$('[name="newElement_cp"]').val(data.data("cp"));
		NE_cp = data.data("cp");
	}else{
		uncomplete = true;
		$('[name="newElement_cp"]').attr( "placeholder", "Vous devez ajouter un code postal" );
		$('#divPostalCode').addClass("has-error");
		
	}
	
	Sig.markerFindPlace.setLatLng([data.data("lat"), data.data("lng")]);
	Sig.map.panTo([data.data("lat"), data.data("lng")]);
	
	mylog.log("geoShape", inseeGeoSHapes);
	if(notEmpty(inseeGeoSHapes[NE_insee])){
		var shape = inseeGeoSHapes[NE_insee];
		shape = Sig.inversePolygon(shape);
		Sig.showPolygon(shape);
		setTimeout(function(){
			Sig.map.fitBounds(shape);
			Sig.map.invalidateSize();
		}, 1500);
	}else{
		Sig.centerPopupMarker([NE_lat, NE_lng], 12);
		// timeoutAddCity = setTimeout(function(){ //alert("zoom centerrrrr");
		// 						Sig.centerPopupMarker([NE_lat, NE_lng], 12);

		// 						/*Sig.map.panTo([NE_lat, NE_lng]);
		// 						Sig.map.setZoom(14); 
		// 						Sig.map.invalidateSize();*/
		// 				}, 1500);
	}
	$("#dropdown-newElement_cp-found, #dropdown-newElement_city-found, #dropdown-newElement_streetAddress-found").hide();

	/*$("#info_insee_latlng").html(
			"<span class='pull-left'><b>Insee : </b>" + NE_insee + "</span> " +
			"<span class='pull-right'><b>lat : </b>" + NE_lat + " <b>lng : </b>" + NE_lng + "</span> "
			);*/
	updateHtmlInseeLatLon();
	$("#newElement_btnValidateAddress").prop('disabled', (complete == true ? false : true));
	$("#divStreetAddress").removeClass("hidden");
	

}

function searchAdressNewElement(){ mylog.log("searchAdressNewElement");
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


	if(countryCode == "NC"){
		mylog.log("countryCode", countryCode);
		countryCode = changeCountryForNominatim(countryCode);
		mylog.log("countryCode", countryCode);
		callNominatim(requestPart, countryCode);
	}else{
		mylog.log("countryCode", countryCode);
		countryCode = changeCountryForNominatim(countryCode);
		mylog.log("countryCode", countryCode);
		callDataGouv(requestPart, countryCode);
	}	
	

	// callGeoWebService(providerName, requestPart, countryCode, 
	// 	function(objs){
	// 		//success
	// 		mylog.log("success callGeoWebService");
	// 		mylog.dir(objs);
	// 		var res = getCommonGeoObject(objs, providerName);
	// 		mylog.dir(res);
	// 		var html = "";
	// 		$.each(res, function(key, value){ //mylog.log(allCities);
 //    			if(notEmpty(value.countryCode)){
 //    				mylog.log("Country Code",value.countryCode.toLowerCase(), countryCode.toLowerCase());
 //    				if(value.countryCode.toLowerCase() == countryCode.toLowerCase()){ 
 //    					html += "<li><a href='javascript:' class='item-street-found' data-lat='"+value.geo.latitude+"' data-lng='"+value.geo.longitude+"'>"+value.name+"</a></li>";
 //    				}
 //    			}
 //    		});
 //    		if(html == "") html = "<i class='fa fa-ban'></i> Aucun résultat";
 //    		$("#dropdown-newElement_streetAddress-found").html(html);
 //    		$("#dropdown-newElement_streetAddress-found").show();

 //    		$(".item-street-found").click(function(){
 //    			Sig.markerFindPlace.setLatLng([$(this).data("lat"), $(this).data("lng")]);
	// 			Sig.map.panTo([$(this).data("lat"), $(this).data("lng")]);
	// 			Sig.map.setZoom(16);
	// 			mylog.log("lat lon", $(this).data("lat"), $(this).data("lng"));
	// 			$("#dropdown-newElement_streetAddress-found").hide();
	// 			$('[name="newElement_lat"]').val($(this).data("lat"));
	// 			$('[name="newElement_lng"]').val($(this).data("lng"));
	// 			NE_lat = $(this).data("lat");
	// 			NE_lng = $(this).data("lng");
	// 			updateHtmlInseeLatLon();
 //    		});
	// 	}, 
	// 	function(){
	// 		//error
	// 	}
	// );
}

function backToForm(cancel){
	mylog.log("backToForm");
	if(modePostalCode == false ){
		if(updateLocality == false ){
			if(notEmpty($("[name='newElement_lat']").val())){
				locationObj = {
					address : {
						"@type" : "PostalAddress",
						addressCountry : $("[name='newElement_country']").val(),
						streetAddress : $("[name='newElement_streetAddress']").val(),
						addressLocality : $("[name='newElement_city']").val(),
						postalCode : $("[name='newElement_cp']").val(),
						codeInsee : $("[name='newElement_insee']").val(),
						depName : $("[name='newElement_dep']").val(),
						regionName : $("[name='newElement_region']").val()
					},
					geo : {
						"@type" : "GeoCoordinates",
						latitude : $("[name='newElement_lat']").val(),
						longitude : $("[name='newElement_lng']").val()
					},
					geoPosition : {
						"type" : "Point",
						"coordinates" : [ parseFloat($("[name='newElement_lng']").val()), parseFloat($("[name='newElement_lat']").val()) ]
					}
				};
				copyMapForm2Dynform(locationObj);
				addLocationToForm(locationObj);
			}
			$("#form-street").val($("[name='newElement_streetAddress']").val());
			showMap(false);
			Sig.clearMap();
			$('#ajax-modal').modal("show");
		}else{
			if(typeof cancel == "undefined" || cancel == false)
				updateLocalityElement();
			showMap(false);
			if(typeof contextMap != "undefined")
				Sig.showMapElements(Sig.map, contextMap);
		}	
	}else{
		if(notEmpty($("[name='newPC_lat']").val())){
				postalCodeObj = {
					postalCode : $("[name='newPC_postalCode']").val(),
					name : $("[name='newPC_name']").val(),
					latitude : $("[name='newPC_lat']").val(),
					longitude : $("[name='newPC_lon']").val()
				};
				copyPCForm2Dynform(postalCodeObj);
				addPostalCodeToForm(postalCodeObj);
			}
			showMap(false);
			Sig.clearMap();
			$('#ajax-modal').modal("show");
	}


}

function initUpdateLocality(address, geo, type, index){
	mylog.log("initUpdateLocality", address, geo, type, index);
	if(address != null && geo != null ){
		NE_insee = address.codeInsee;
		NE_lat = geo.latitude;
		NE_lng = geo.longitude;
		NE_city = address.addressLocality;
		NE_cp = address.postalCode;
		NE_street = address.streetAddress.trim();
		NE_country = address.addressCountry;
		NE_dep = address.depName;
		NE_region = address.regionName;
		if(index)
			addressesIndex = index ;
		initDropdown();
		getDepAndRegion();
	}else{
		NE_insee = "";NE_lat = "";NE_lng = "";NE_city = "";
		NE_cp = "";NE_street = "";NE_country = "";NE_dep = "";NE_region = "";
		if(index)
			addressesIndex = index ;
	}
	formType = type ;
	updateLocality = true;
	if(typeof contextMap == "undefined")
		contextMap = [];
	showMarkerNewElement();
}

function getDepAndRegion(){
	if(typeof NE_dep == "undefined" || NE_dep == "" || typeof NE_region == "undefined" || NE_region == ""){
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/city/getDepAndRegion/",
	        data: {insee : NE_insee},
	       	dataType: "json",
	    	success: function(data){
	    		mylog.log("getDepAndRegion", data);
		    	
		    	if(data.depName){
		    		NE_dep = data.depName;
					
		    	}else{
		    		NE_dep = "";
		    	}

		    	if(data.regionName){
		    		NE_region = data.regionName;
				}else{
		    		NE_region = "";
		    	}
		    }
		});
	}
}

function initAddLocality(type, index){
	mylog.log("initUpdateLocality", address, geo, type, index);
	NE_insee = "";NE_lat = "";NE_lng = "";NE_city = "";
	NE_cp = "";NE_street = "";NE_country = "";NE_dep = "";NE_region = "";
	formType = type ;
	addLocality = true;
	if(typeof contextMap == "undefined")
		contextMap = [];
	showMarkerNewElement();
}

function updateLocalityElement(){
	mylog.log("updateLocalityElement");
	var unikey = NE_country + "_" + NE_insee + "-" + NE_cp; 
	var locality = {
		address : {
			"@type" : "PostalAddress",
			codeInsee : NE_insee,
			streetAddress : NE_street.trim(),
			postalCode : NE_cp,
			addressLocality : NE_city,
			depName : NE_dep,
			regionName : NE_region,
			addressCountry : NE_country
		},
		geo : {
			"@type" : "GeoCoordinates",
			latitude : NE_lat,
			longitude : NE_lng
		},
		geoPosition : {
			"type" : "Point",
			"coordinates" : [ parseFloat($("[name='newElement_lng']").val()), parseFloat($("[name='newElement_lat']").val()) ]
		},
		
		unikey : unikey
	};
	if(addressesIndex)
		locality["addressesIndex"] = addressesIndex ;
	
	if(typeof globalTheme == "undefined" || globalTheme != "network"){
		currentScopeType = "city";
		addScopeToMultiscope(unikey, locality.address.addressLocality);
		
		currentScopeType = "cp";
		addScopeToMultiscope(locality.address.postalCode, locality.address.postalCode);
		
		currentScopeType = "dep";
		addScopeToMultiscope(locality.address.depName, locality.address.depName);
		
		currentScopeType = "region";
		addScopeToMultiscope(locality.address.regionName, locality.address.regionName);
	}
	params = new Object;
	params.name = ((addressesIndex)?"addresses":"locality");
	params.value = locality;
	params.pk = contextData.id;
	params.type = contextData.type;
	if(userId != ""){
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+params.type,
	        data: params,
	       	dataType: "json",
	    	success: function(data){
	    		mylog.log("data", data);
		    	
		    	if(data.result){
		    		var inMap = true ;
		    		if(data.firstCitizen == true)
		    			getAjax(null, baseUrl+'/'+moduleId+'/rooms/index/type/cities/id/'+locality.unikey, null,"norender");

		    		if(contextData != null){
		    			if(contextData.address == null){
		    				inMap =false ;
			    		}
			    		contextData.address = locality.address;
						contextData.geo = locality.geo;
			    		contextData.geoPosition = locality.geoPosition;
		    		}
					
					if(!addressesIndex){
						//Header && ficheInfoElement
						console.log("locality.address.streetAddress", locality.address.streetAddress);
						$("#detailStreetAddress").html(locality.address.streetAddress);
						$("#detailCity").html(((locality.address.postalCode)?locality.address.postalCode : "")+" "+((locality.address.addressLocality) ? locality.address.addressLocality : ""));
						//$("#detailCity").html(locality.address.addressLocality+", "+locality.address.postalCode);
						$("#detailCountry").html(" "+tradCountry[locality.address.addressCountry]);
						$('#localityHeader').html(locality.address.addressLocality);
						$('#pcHeader').html(locality.address.postalCode);
						$('#countryHeader').html(tradCountry[locality.address.addressCountry]);
						$('#iconLocalityyHeader').removeClass("hidden");
						$('#addressHeader').removeClass("hidden");
						$(".detailMyCity").attr("href", "#city.detail.insee."+locality.address.codeInsee+".postalCode."+locality.address.postalCode);
						$("#detailMyCity").parent().find(".discover-subtitle").text("Ma commune");
						$(".detailMyCity").attr("onclick", "");
						$(".detailMyCity").removeClass("detailMyCity");
						$("#detailMyCity").addClass("lbh");
						$(".cobtn,.whycobtn,.cobtnHeader,.whycobtnHeader").hide();

						toastr.success(data.msg);
						initData();
						if(contextData.id != userId){
							var typeMap = ((typeof contextData == "undefined" || contextData == null)?"citoyens":contextData.type) ;
							if(typeMap == "citoyens")
								typeMap = "people";
							if(inMap == false)
								contextMap = Sig.addContextMap(contextMap, contextData, typeMap);
							else{
								contextMap = Sig.modifLocalityContextMap(contextMap, contextData, typeMap);
							}
							Sig.restartMap();
							Sig.showMapElements(Sig.map, contextMap);
							loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
						}else{

							changeMenuCommunextion(locality);
							currentUser.addressCountry = locality.address.addressCountry;
							currentUser.postalCode = locality.address.postalCode;
							currentUser.codeInsee = locality.address.codeInsee;
							Sig.myPosition.position.latitude = locality.geo.latitude;
							Sig.myPosition.position.longitude = locality.geo.longitude;
							var url = window.location.href ;
							$('.showIfCommucted').removeClass("hidden");
							if(url.indexOf("#person.detail.id."+userId) == -1) {
								loadByHash("#person.detail.id."+userId);
							}else{
								Sig.restartMap();
								Sig.showMapElements(Sig.map, contextMap);
								loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
							}

						}
					}else{
						initData();
						toastr.success(data.msg);
						loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
					}
					
		    	}else{
		    		toastr.error(data.msg);
		    	}
		    }
		});
	}else{
		changeMenuCommunextion(locality);
		inseeCommunexion = locality.address.codeInsee ;
		cityNameCommunexion = locality.address.addressLocality ;
		cpCommunexion = locality.address.postalCode ;
		countryCommunexion = locality.address.addressCountry ;
		setCookies("/");
		initData();
	}
	
}

// Pour effectuer une recherche a la Réunion avec Nominatim, il faut choisir le code de la France, pas celui de la Réunion
function changeCountryForNominatim(country){
	var codeCountry = {
		"FR" : ["RE", "GP", "GF", "MQ", "YT", "NC", "PM"]
	};
	$.each(codeCountry, function(key, countries){
		if(countries.indexOf(country) != -1)
	 		country = key;
	});
	return country ;
	
}

function changeSelectCountrytim(){
	mylog.log("NE_cp.substring(0, 3)",NE_cp.substring(0, 3));
	countryFR = ["FR","GP","MQ","GF","RE","PM","YT"];

	if(countryFR.indexOf($('[name="newElement_country"]').val()) != -1){
		if(NE_cp.substring(0, 3) == "971")
			$('[name="newElement_country"]').val("GP");
		else if(NE_cp.substring(0, 3) == "972")
			$('[name="newElement_country"]').val("MQ");
		else if(NE_cp.substring(0, 3) == "973")
			$('[name="newElement_country"]').val("GF");
		else if(NE_cp.substring(0, 3) == "974")
			$('[name="newElement_country"]').val("RE");
		else if(NE_cp.substring(0, 3) == "975")
			$('[name="newElement_country"]').val("PM");
		else if(NE_cp.substring(0, 3) == "976")
			$('[name="newElement_country"]').val("YT");
		else
			$('[name="newElement_country"]').val("FR");
	}
	
}

function changeMenuCommunextion(locality){
	//Menu Left
	$("#btn-geoloc-auto-menu").attr("href", "#city.detail.insee."+locality.address.codeInsee+".postalCode."+locality.address.postalCode);
	$('#btn-geoloc-auto-menu > span.lbl-btn-menu').html(locality.address.addressLocality);
	$("#btn-geoloc-auto-menu").attr("onclick", "");
	$("#btn-geoloc-auto-menu").addClass("lbh");
	bindLBHLinks();

	//Dashbord
	$("#btn-menuSmall-mycity").attr("href", "#city.detail.insee."+locality.address.codeInsee+".postalCode."+locality.address.postalCode);
	$("#btn-menuSmall-citizenCouncil").attr("href", "#rooms.index.type.cities.id."+locality.unikey);
	//Multiscope
	$(".msg-scope-co").html("<i class='fa fa-home'></i> Vous êtes communecté à " + locality.address.addressLocality);
	//MenuSmall
	$(".hide-communected").hide();
	$(".visible-communected").show();
}

function initDropdown(){
	$("#dropdown-newElement_cp-found").html("<li><a href='javascript:' class='disabled'>Rechercher un code postal</a></li>");
	$("#dropdown-newElement_city-found").html("<li><a href='javascript:' class='disabled'>Rechercher une ville, un village, une commune</a></li>");
}

function initData(){
	mylog.log("initData");
	timeoutAddCity;
	NE_insee = "";
	NE_lat = "";
	NE_lng = "";
	NE_city = "";
	NE_cp = "";
	NE_street = "";
	NE_country = "";
	NE_dep = "";
	NE_region = "";
	typeSearchInternational = "";
	formType = "";
	updateLocality = false;
	addressesIndex = false;
	initDropdown();
	$("#divStreetAddress").addClass("hidden");
	$("#divPostalCode").addClass("hidden");
	$("#divCity").addClass("hidden");
}


function updateHtmlInseeLatLon(){
	$("#info_insee_latlng").html(
		"<span class='pull-left'><b>Insee : </b>" + NE_insee + "</span> " +
		"<span class='pull-right'><b>lat : </b>" + NE_lat + " <b>lng : </b>" + NE_lng + "</span> "
	);
}

function preLoadAddress(hide, country, insee, city, postalCode, lat, lng, street){

	if(country != "") 	{ NE_country = country; }
	if(insee != "") 	{ NE_insee = insee; }
	if(city != "") 		{ NE_city = city; }
	if(postalCode != ""){ NE_cp = postalCode; }
	if(lat != "") 		{ NE_lat = lat; }
	if(lng != "")		{ NE_lng = lng; }
	if(street != "")	{ NE_street = street.trim(); }


	if(country == "NC"){
		NE_dep = "Nouvelle-Calédonie";
		NE_region = "Nouvelle-Calédonie";
	}

	$('[name="newElement_country"]').val(NE_country);
	$('[name="newElement_insee"]').val(NE_insee);
	$('[name="newElement_city"]').val(NE_city);
	$('[name="newElement_cp"]').val(NE_cp);
	$('[name="newElement_dep"]').val(NE_dep);
	$('[name="newElement_region"]').val(NE_region);
	$('[name="newElement_lat"]').val(NE_lat);
	$('[name="newElement_lng"]').val(NE_lng);
	$('[name="newElement_streetAddress"]').val(NE_street);

	$("#divStreetAddress").removeClass("hidden");
	$("#divPostalCode").removeClass("hidden");
	$("#divCity").removeClass("hidden");

	$("#newElement_btnValidateAddress").prop('disabled', (NE_insee==""?true:false));

	Sig.markerFindPlace.setLatLng([NE_lat, NE_lng]);
}


function getAddressObj(){ console.log("GET ADDRESS OBJ INSEE : ", NE_insee);
	if(notEmpty(NE_insee)){
		var	locationObj = {
				address : {
					"@type" : "PostalAddress",
					addressCountry : NE_country,
					addressLocality : NE_city,
					streetAddress : NE_street.trim(),
					postalCode : NE_cp,
					codeInsee : NE_insee,
					depName : NE_dep,
					regionName : NE_region
				},
				geo : {
					"@type" : "GeoCoordinates",
					latitude : NE_lat,
					longitude : NE_lng
				},
				geoPosition : {
					"type" : "Point",
					"coordinates" : [ parseFloat(NE_lat), parseFloat(NE_lng) ]
				}
			};
		return locationObj;
	}
	return false;
}