
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

var typeSearchInternational = "";
var formType = "";
var updateLocality = false;


function showMarkerNewElement(){ console.log("showMarkerNewElement");

	Sig.clearMap();
	//$("#newElement_btnValidateAddress").prop('disabled', true);
	if(typeof Sig.myMarker != "undefined") 
		Sig.map.removeLayer(Sig.myMarker);
	console.log("formType", formType);
	var options = {  id : 0,
					 icon : Sig.getIcoMarkerMap({'type' : formType}),
					 content : Sig.getPopupConfigAddress()
				  };
	console.log(options);

	if(typeof currentUser != "undefined" && currentUser != null && typeof currentUser.addressCountry != "undefined" && currentUser.addressCountry != null){
		NE_country = currentUser.addressCountry;
		console.log("NE_country", NE_country);
	}

	var coordinates = new Array(0, 0);
	if(typeof contextData != "undefined" && contextData != null && typeof contextData.geo != "undefined" && contextData.geo != null && updateLocality == true)
		var coordinates = new Array(contextData.geo.latitude, contextData.geo.longitude);
	
	//efface le marker s'il existe
	if(Sig.markerFindPlace != null) Sig.map.removeLayer(Sig.markerFindPlace);
	Sig.markerFindPlace = Sig.getMarkerSingle(Sig.map, options, coordinates);
	Sig.markerFindPlace.openPopup(); 
	Sig.markerFindPlace.dragging.enable();
	Sig.centerSimple(coordinates, 12);
	setTimeout(function(){ Sig.map.panBy([0, -150]);  }, 400);
	showMapLegende("info-circle", "Définissez l'adresse et la position de l'élément<br>"+
								  "<a href='javascript:backToForm(true)' class='btn no-padding margin-top-10'>"+
								  	"<i class='fa fa-arrow-circle-left'></i> retour au formulaire"+
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
		$('[name="newElement_streetAddress"]').val(NE_street);
		$('[name="newElement_dep"]').val(NE_dep);
		$('[name="newElement_region"]').val(NE_region);
		$("#newElement_btnValidateAddress").prop('disabled', (NE_insee==""?true:false));
		if(NE_insee != ""){
			$("#divStreetAddress").removeClass("hidden");
		}
	}

	//lorsque la popup s'ouvre, on ajoute l'event click sur le bouton de validation
	Sig.markerFindPlace.on("popupopen", function(){ console.log("popupopen");
		console.log("NE_city", NE_city);
		$('[name="newElement_insee"]').val(NE_insee);
		$('[name="newElement_lat"]').val(NE_lat);
		$('[name="newElement_lng"]').val(NE_lng);
		$('[name="newElement_city"]').val(NE_city);
		$('[name="newElement_cp"]').val(NE_cp);
		$('[name="newElement_streetAddress"]').val(NE_street);
		$('[name="newElement_dep"]').val(NE_dep);
		$('[name="newElement_region"]').val(NE_region);
		$('[name="newElement_country"]').val(NE_country);
		$("#newElement_btnValidateAddress").prop('disabled', (NE_country==""?true:false));
		if(NE_insee != ""){
			$("#divStreetAddress").removeClass("hidden");
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
		$("#dropdown-cp-found").show();
		console.log("newElement_cp",$('[name="newElement_cp"]').val().length);
		if($('[name="newElement_cp"]').val().length > 0){
			console.log("newElement_cp",$('[name="newElement_cp"]').val().length);
			NE_cp = $('[name="newElement_cp"]').val();
			changeSelectCountrytim();
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
		if($('[name="newElement_cp"]').val().length > 0){
			autocompleteFormAddress("cp", $('[name="newElement_cp"]').val());
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
		console.log(country.id, country.text);
	 	$('[name="newElement_country"]').append("<option value='"+country.id+"'>"+country.text+"</option>");
	});*/

	$('[name="newElement_country"]').change(function(){
		console.log("change country");
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
		console.log("NE_country", NE_country, typeof NE_country, NE_country.length);
		if(NE_country != ""){
			$("#divPostalCode").removeClass("hidden");
			$("#divCity").removeClass("hidden");
		}else{
			console.log("NE_country", NE_country, typeof NE_country, NE_country.length);
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
        		geoShape: true,
        		countryCode : $('[name="newElement_country"]').val()
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
    			var insee = value.insee;
    			var country = value.country;
    			var dep = value.depName;
    			var region = value.regionName;
    			if(currentScopeType == "city") { console.log("in scope city"); console.dir(value);
    				// val = value.country + '_' + value.insee; 
		    		// lbl = (typeof value.name!= "undefined") ? value.name : ""; //value.name ;
		    		// var cp = (typeof value.postalCode!= "undefined") ? value.postalCode : ""; //value.name ;
		    		// lblList = lbl + " (" +value.depName + ")";
		    		// html += "<li><a href='javascript:' onclick='selectThisAdressElement(\""+currentScopeType+"\", \""+val+"\",\""+cp+"\" )'>"+lblList+"</a></li>";
    				
		    		$.each(value.postalCodes, function(key, valueCP){
    					if($.inArray(valueCP.postalCode, allCP)<0){ 
	    					allCP.push(valueCP.postalCode);
	    					if(notEmpty(value.geoShape))
		    				inseeGeoSHapes[insee] = value.geoShape.coordinates[0];
		    				var val = valueCP.name; 
		    				var lbl = valueCP.postalCode ;
		    				var lat = valueCP.geo.latitude;
		    				var lng = valueCP.geo.longitude;
		    				var lblList = value.name + ", " + valueCP.name + ", " +valueCP.postalCode ;
		    				html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-dep='"+dep+"' data-region='"+region+"' data-country='"+country+"' data-city='"+val+"' data-cp='"+lbl+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-city-found'>"+lblList+"</a></li>";
	    			}
	    			});
    			}; 
    			if(currentScopeType == "cp") { 
    				$.each(value.postalCodes, function(key, valueCP){ console.log(allCities);
    					if($.inArray(valueCP.name, allCities)<0){ 
	    					allCities.push(valueCP.name);
		    				if(notEmpty(value.geoShape))
		    				inseeGeoSHapes[insee] = value.geoShape.coordinates[0];
		    				var val = valueCP.postalCode; 
		    				var lbl = valueCP.name ;
		    				var lblList = valueCP.name + ", " +valueCP.postalCode ;
		    				var lat = valueCP.geo.latitude;
		    				var lng = valueCP.geo.longitude;
		    				//console.log("valueCPvalueCPvalueCPvalueCP", valueCP);
		    				html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-dep='"+dep+"' data-region='"+region+"' data-country='"+country+"' data-city='"+lbl+"' data-cp='"+val+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-cp-found'>"+lblList+"</a></li>";
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
				
				console.log("geoShape", inseeGeoSHapes);
				if(notEmpty(inseeGeoSHapes[NE_insee])){
					var shape = inseeGeoSHapes[NE_insee];
					shape = Sig.inversePolygon(shape);
					Sig.showPolygon(shape);
					Sig.map.fitBounds(shape);
				}else{
					timeoutAddCity = setTimeout(function(){ //alert("zoom");
											Sig.map.panTo([NE_lat, NE_lng]);
											Sig.map.setZoom(14); 
									}, 500);
				}
				$("#dropdown-newElement_cp-found, #dropdown-newElement_city-found, #dropdown-newElement_streetAddress-found").hide();

				/*$("#info_insee_latlng").html(
						"<span class='pull-left'><b>Insee : </b>" + NE_insee + "</span> " +
						"<span class='pull-right'><b>lat : </b>" + NE_lat + " <b>lng : </b>" + NE_lng + "</span> "
						);*/
				updateHtmlInseeLatLon();
				$("#newElement_btnValidateAddress").prop('disabled', false);
				$("#divStreetAddress").removeClass("hidden");
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
	countryCode = changeCountryForNominatim(countryCode);
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
    				console.log("Country Code",value.countryCode.toLowerCase(), countryCode.toLowerCase());
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
				console.log("lat lon", $(this).data("lat"), $(this).data("lng"));
				$("#dropdown-newElement_streetAddress-found").hide();
				$('[name="newElement_lat"]').val($(this).data("lat"));
				$('[name="newElement_lng"]').val($(this).data("lng"));
				NE_lat = $(this).data("lat");
				NE_lng = $(this).data("lng");
				updateHtmlInseeLatLon();
    		});
		}, 
		function(){
			//error
		}
	);
}

function backToForm(cancel){
	console.log("backToForm");
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
	

}

function initUpdateLocality(address, geo, type){
	console.log("initUpdateLocality", address, geo, type);
	if(address != null && geo != null ){
		NE_insee = address.codeInsee;
		NE_lat = geo.latitude;
		NE_lng = geo.longitude;
		NE_city = address.addressLocality;
		NE_cp = address.postalCode;
		NE_street = address.streetAddress;
		NE_country = address.addressCountry;
		NE_dep = address.depName;
		NE_region = address.regionName;
		initDropdown();
	}else{
		NE_insee = "";NE_lat = "";NE_lng = "";NE_city = "";
		NE_cp = "";NE_street = "";NE_country = "";NE_dep = "";NE_region = "";
	}
	formType = type ;
	updateLocality = true;
	if(typeof contextMap == "undefined")
		contextMap = [];
	showMarkerNewElement();
}

function updateLocalityElement(addressesIndex){
	console.log("updateLocalityElement");
	var unikey = NE_country + "_" + NE_insee + "-" + NE_cp; 
	var locality = {
		address : {
			"@type" : "PostalAddress",
			codeInsee : NE_insee,
			streetAddress : NE_street,
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
		locality[addresses] = addressesIndex ;
	
	addScopeToMultiscope(unikey, locality.address.addressLocality);
	
	params = new Object;
	params.name = "locality";
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
	    		console.log("data", data);
		    	
		    	if(data.result){
		    		var inMap = true ;
		    		if(contextData != null){
		    			if(contextData.address == null){
		    				inMap =false ;
			    		}
			    		contextData.address = locality.address;
						contextData.geo = locality.geo;
			    		contextData.geoPosition = locality.geoPosition;
		    		}
					
					//Header && ficheInfoElement
					$("#detailStreetAddress").html(locality.address.streetAddress);
					$("#detailCity").html(locality.address.addressLocality+", "+locality.address.postalCode);
					$("#detailCountry").html(locality.address.addressCountry);
					$('#localityHeader').html(locality.address.addressLocality);
					$('#pcHeader').html(locality.address.postalCode);
					$('#countryHeader').html(locality.address.addressCountry);
					$('#iconLocalityyHeader').removeClass("hidden");
					$('#addressHeader').removeClass("hidden");
					$(".detailMyCity").attr("href", "#city.detail.insee."+locality.address.codeInsee+".postalCode."+locality.address.postalCode);
					$(".detailMyCity").attr("onclick", "");
					$(".detailMyCity").removeClass("detailMyCity");
					$(".detailMyCity").addClass("lbh");
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
					}else{

						changeMenuCommunextion(locality);

						Sig.myPosition.position.latitude = locality.geo.latitude;
						Sig.myPosition.position.longitude = locality.geo.longitude;
						var url = window.location.href ;
						if(url.indexOf("#person.detail.id."+userId) == -1) {
							loadByHash("#person.detail.id."+userId);
						}else{
							Sig.restartMap();
							Sig.showMapElements(Sig.map, contextMap);
						}
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
	codeCountry = {
		"FR" : ["RE"]
	}
	$.each(codeCountry, function(key, countries){
		if(countries.indexOf(country) != -1)
	 		country = key;
	});
	return country ;
	
}

function changeSelectCountrytim(){
	console.log("NE_cp.substring(0, 3)",NE_cp.substring(0, 3));
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
	console.log("initData");
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

