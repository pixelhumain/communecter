
var timeoutAddCity;
var NE_insee = "";
var NE_lat = "";
var NE_lng = "";
var NE_city = "";
var NE_cp = "";

function showMarkerNewElement(){ console.log("showMarkerNewElement");

	Sig.clearMap();
	if(typeof Sig.myMarker != "undefined") 
		Sig.map.removeLayer(Sig.myMarker);

	var options = {  id : 0,
					 icon : Sig.getIcoMarkerMap({'type' : 'project'}),
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
	showMapLegende("info-circle", "Définissez l'adresse et la position de l'élément que vous êtes en train de créer ...");

	//lorsque la popup s'ouvre, on ajoute l'event click sur le bouton de validation
	Sig.markerFindPlace.on("popupopen", function(){ console.log("popupopen");
		$('[name="newElement_insee"]').val(NE_insee);
		$('[name="newElement_lat"]').val(NE_lat);
		$('[name="newElement_lng"]').val(NE_lng);
		$('[name="newElement_city"]').val(NE_city);
		$('[name="newElement_cp"]').val(NE_cp);
	});

	Sig.markerFindPlace.on('dragend', function(){
		$('[name="newElement_lat"]').val(Sig.markerFindPlace.getLatLng().lat);
		$('[name="newElement_lng"]').val(Sig.markerFindPlace.getLatLng().lng);
		Sig.markerFindPlace.openPopup();
	});

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

	$('[name="newElement_cp"]').focusout(function(){
		if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
		timeoutAddCity = setTimeout(function(){ $("#dropdown-newElement_cp-found").hide(); }, 200);
	});
	$('[name="newElement_city"]').focusout(function(){
		if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
		timeoutAddCity = setTimeout(function(){ $("#dropdown-newElement_city-found").hide(); }, 200);
	});

	$('[name="newElement_cp"]').focus(function(){
		$("#dropdown-newElement_cp-found").show();
	});
	$('[name="newElement_city"]').focus(function(){
		$("#dropdown-newElement_city-found").show();
	});

	$("#newElement_btnSearchAddress").click(function(){
		searchAdressNewElement();
	});

}

function autocompleteFormAddress(currentScopeType, scopeValue){
	//var scopeValue = $('[name="newElement_city"]').val();
	$("#dropdown-newElement_"+currentScopeType+"-found").html("<li><i class='fa fa-refresh fa-spin padding-10'></i></li>");
	$("#dropdown-newElement_"+currentScopeType+"-found").show();
	$.ajax({
        type: "POST",
        url: baseUrl+"/"+moduleId+"/city/autocompletemultiscope",
        data: {
        		type: currentScopeType, 
        		scopeValue: scopeValue
        },
       	dataType: "json",
    	success: function(data){
    		//console.log("autocompleteMultiScope() success");
    		//console.dir(data);
    		$("#dropdown-newElement_"+currentScopeType+"-found").html("Aucun résultat");
    		html="";
    		var allCP = new Array();
    		var allCities = new Array();
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
		    				var val = valueCP.postalCode; 
		    				var lbl = valueCP.name ;
		    				var lblList = valueCP.name + ", " +valueCP.postalCode ;
		    				var lat = valueCP.geo.latitude;
		    				var lng = valueCP.geo.longitude;
		    				html += "<li><a href='javascript:' data-type='"+currentScopeType+"' data-city='"+lbl+"' data-cp='"+val+"' data-lat='"+lat+"' data-lng='"+lng+"' data-insee='"+insee+"' class='item-cp-found'>"+lblList+"</a></li>";
    				}});
    			};
    		});

    		if(html != "")
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
				
				Sig.map.setZoom(10);
				Sig.markerFindPlace.setLatLng([$(this).data("lat"), $(this).data("lng")]);
				Sig.map.panTo([$(this).data("lat"), $(this).data("lng")]);
				
				$("#dropdown-newElement_cp-found, #dropdown-newElement_city-found").hide();
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


	var street 	= ($("#newElement_streetAddress").val()  != "") ? $("#newElement_streetAddress").html() : "";
	var city 	= ($("#newElement_city").val() 	   	  	 != "") ? $("#newElement_city").html() : "";
	var cp 		= ($("#newElement_cp").val() 			 != "") ? $("#newElement_cp").html() : "";
	var countryCode = ($("#newElement_country").val() 	 != "") ? $("#newElement_country").html() : "";
	
	

	if($("#newElement_streetAddress").val() != ""){
		providerName = "nominatim";
		//construction de la requete
		request = addToRequest(request, street);
		request = addToRequest(request, city);
		request = addToRequest(request, cp);
	}else{
		providerName = "communecter"
		//construction de la requete
		if(cp != ""){
			request = addToRequest(request, cp);
		}
	}

	var countryCode = $("#newElement_country").val();
	callGeoWebService(providerName, requestPart, countryCode, 
		function(){
			//success
		}, 
		function(){
			//error
		}
	);
}