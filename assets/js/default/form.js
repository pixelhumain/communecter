
var timeoutAddCity;
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

	$('[name="newElement_city"]').keyup(function(){ 
		$("#dropdown-city-found").show();
		if($('[name="newElement_city"]').val()!=""){
			if(typeof timeoutAddCity != "undefined") clearTimeout(timeoutAddCity);
			timeoutAddCity = setTimeout(function(){ autocompleteFormAddress("city", $('[name="newElement_city"]').val()); }, 500);
		}
	});
	$('[name="newElement_cp"]').keyup(function(){ 
		$("#dropdown-cp-found").show();
		if($('[name="newElement_cp"]').val()!=""){
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
    				$.each(value.postalCodes, function(key, valueCP){
    					if($.inArray(valueCP.postalCode, allCP)<0){ 
	    					allCP.push(valueCP.postalCode);
		    				val = valueCP.name; 
		    				lbl = valueCP.postalCode ;
		    				lblList = value.name + ", " + valueCP.name + ", " +valueCP.postalCode ;
		    				html += "<li><a href='javascript:' onclick='selectThisAdressElement(\""+currentScopeType+"\",\""+val+"\",\""+lbl+"\" )'>"+lblList+"</a></li>";
	    			}
	    			});
    			}; 
    			if(currentScopeType == "cp") { 
    				$.each(value.postalCodes, function(key, valueCP){ console.log(allCities);
		    			if($.inArray(valueCP.name, allCities)<0){ 
	    					allCities.push(valueCP.name);
		    				val = valueCP.postalCode; 
		    				lbl = valueCP.name ;
		    				lblList = valueCP.name + ", " +valueCP.postalCode ;
		    				html += "<li><a href='javascript:' onclick='selectThisAdressElement(\""+currentScopeType+"\",\""+val+"\",\""+lbl+"\" )'>"+lblList+"</a></li>";
    				}});
    			}; 
    		
    		});
    		if(html != "")
    		$("#dropdown-newElement_"+currentScopeType+"-found").html(html);
    		$("#dropdown-newElement_"+currentScopeType+"-found").show();
    		
	    },
		error: function(error){
    		$("#dropdown-newElement_"+currentScopeType+"-found").html("error");
			console.log("Une erreur est survenue pendant autocompleteMultiScope");
		}
	});
}

function selectThisAdressElement(currentScopeType, val, lbl){
	$('[name="newElement_'+currentScopeType+'"]').val(val);

	if(currentScopeType == "cp"){
		$('[name="newElement_'+"city"+'"]').val(lbl);
	}

	if(currentScopeType == "city"){
		$('[name="newElement_'+"cp"+'"]').val(lbl);
	}
	$("#dropdown-newElement_cp-found, #dropdown-newElement_city-found").hide();
}