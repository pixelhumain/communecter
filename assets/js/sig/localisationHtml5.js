
/* géolocalisation HTML5 */
var currentRoleLoc = "";
var locationHTML5Found = false;
var positionFound = false;

function initHTML5Localisation(role){ return;

}


function getCityInseeByGeoPos(coords){
	//toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Recherche des données de votre commune");
	//showLoadingMsg("Identification de votre commune");
	// coords = { latitude : -20.9190923,
	// 		   longitude : 55.4859363
	// 		};
	// mylog.log("getCityInseeByGeoPos !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");			
	// mylog.log(coords);			
	$.ajax({
		url: baseUrl + "/" + moduleId+"/sig/getinseebylatlng",
		type: 'POST',
		dataType: 'json',
		data:{"latitude" : coords.latitude, "longitude" : coords.longitude },
		complete: function () {},
		success: function (obj) {
			if (obj != null) {
				
					
				if(currentRoleLoc == "showCityMap" && typeof obj.insee != "undefined"){
					mylog.log("donne city : ");
					mylog.dir(obj);
					//toastr.success("Mapping des acteurs par code insee : " + obj.insee);
					if($("#main-title-public1").length){
						showLoadingMsg("Chargement des données en cours");
						var onclick = "showAjaxPanel( '/city/detail/insee/"+obj.insee+"?isNotSV=1', '"+obj.name+"','university' )";
						$("#main-title-public2").html('<a href="javascript:" onclick="'+onclick+'">'+"<i class='fa fa-university'></i> "+obj.name+"</a>");
						$("#main-title-public2").show(400);	
						if(typeof obj.cp != "undefined")
							$(".form-group #cp").val(obj.cp);
					}
					
					$("#mapCanvasBg").show(400);
	      			setTimeout(function() { showDataByInsee(obj.insee) }, 1000);
				}
				else if(currentRoleLoc == "showCity" && typeof obj.insee != "undefined"){
					toastr.success("Vous allez être redirigé vers la page de votre commune ...");
					showAjaxPanel("/city/detail/insee/" + obj.insee + "?isNotSV=1", 'Details', 'university');
					
				}
				else if(currentRoleLoc == "prefill" && typeof obj.cp != "undefined"){
					toastr.success("Nous avons trouvé votre code postal : "+obj.cp);
					$(".form-group #cp").val(obj.cp);
					searchCity();
				}
				else if(currentRoleLoc == "prefillSearch"){ // && typeof obj.name != "undefined"){
					//toastr.success("Nous avons trouvé votre position actuelle : "+obj.name);
					//$("#searchBarPostalCode").val(obj.name);
					//$.cookie("HTML5CityName", 	 obj.name, 	   { path : '/ph/' });
					//startSearch();
					//searchCity();
					showModalSelectScope(obj);
				}
				else if(currentRoleLoc == "communexion"){ // && typeof obj.name != "undefined"){
					//toastr.success("Nous avons trouvé votre position actuelle : "+obj.name);
					//$("#searchBarPostalCode").val(obj.name);
					//$.cookie("HTML5CityName", 	 obj.name, 	   { path : '/ph/' });
					//startSearch();
					//searchCity();
					//showModalSelectScope(obj);
					$.each(obj, function(key, value){ obj[key]["typeSig"] = "city"; });
					mylog.log("cities found : ");
					mylog.dir(obj);
				
					$(".search-loader").html("<i class='fa fa-crosshairs'></i> Sélectionnez une commune en cliquant sur <b>Communecter</b> ...");
		        	Sig.showMapElements(Sig.map, obj);
				}
				else if(currentRoleLoc == "communexion_tsr"){ // && typeof obj.name != "undefined"){
					$.each(obj, function(key, value){ obj[key]["typeSig"] = "city"; });
					mylog.log("cities found : ");
					mylog.dir(obj);
					showMap(true);
					//$(".search-loader").html("<i class='fa fa-crosshairs'></i> Sélectionnez une commune ...");
		        	showMapLegende("crosshairs", "Sélectionnez votre commune en cliquant sur <b>Communecter</b> ...");

  					Sig.showMapElements(Sig.map, obj);
				}
			}else{
				toastr.info("Nous n'avons pas trouvé votre code postal");// : merci de vous localiser manuellement en remplissant le formulaire.");
				//getCityByLatLngNominatim(coords.latitude, coords.longitude);
			}

			$.unblockUI();
		        	
		},
		error: function (error) {
			mylog.dir(error);
			toastr.error(error.responseText);
		}
	});
}

//reverse geocoding
function getCityByLatLngNominatim(latitude, longitude){
	mylog.log(latitude, longitude);
	toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Recherche approfondie");
	$.ajax({
		url: "//nominatim.openstreetmap.org/reverse?lat=" + latitude + "&lon=" + longitude + "&format=json&addressdetails=1",
		type: 'POST',
		dataType: 'json',
		complete: function () { },
		success: function (obj)
		{
			if(typeof obj.address.city != "undefined")		{ getInseeByCityName(obj.address.city);
			}else if(typeof obj.address.town != "undefined"){ getInseeByCityName(obj.address.town);
			}else{ toastr.error("Impossible de trouver le nom de votre commune"); }
		},
		error: function(error){
			mylog.dir("error", error);
		}
	});
}

function getInseeByCityName(cityName){
	toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Merci de patienter ...");
	$.ajax({
		url: baseUrl + "/" + moduleId+"/sig/getcodeinseebycityname",
		type: 'POST',
		dataType: 'json',
		contentType: "application/x-www-form-urlencoded; charset=UTF-8",
		data:{ "cityName" : cityName },
		complete: function () { },
		success: function (obj)
		{
			mylog.log("getInseeByCityName ok");
			mylog.dir(obj);

			if (typeof obj != "undefined"){
				if (currentRoleLoc == "showCity"){
					if(typeof obj.insee != "undefined") {
						toastr.success("<i class='fa fa-circle-o-notch fa-spin'></i> Vous allez être redirigé vers la page de votre commune ... ");
						showAjaxPanel("/city/detail/insee/" + obj.insee + "?isNotSV=1", 'Details', 'university');
					}else{
						toastr.error("Impossible d'identifier votre commune ... ");
					}
				}
				else if (currentRoleLoc == "prefill"){
					if(typeof obj.cp != "undefined") {
						toastr.success("Nous avons trouvé votre code postal à partir de notre bdd+nominatim name (getcodeinseebycityname) : "+obj.cp);
						$(".form-group #cp").val(obj.cp);
						searchCity();
					}else{
						toastr.error("Impossible d'identifier votre commune ... ");
					}
				}
			}
		},
		error: function(error){
			toastr.error("Erreur : Impossible d'identifier votre commune ... ");
		}
	});
}

var geolocHTML5Done = false;
function showModalSelectScope(obj){
	var HTML = "";

	if(typeof obj["@type"] != "undefined"){
		HTML += "<button class='btn bg-red btn-scope-list' val='"+obj.cp+"' data-dismiss='modal' style='margin: 0px 4px 4px 0px; border-radius:30px;'>"+obj.cp+ " " +obj.name+"</button>";
	}else{
		$.each(obj, function(key, value){
			HTML += "<button class='btn bg-red btn-scope-list' val='"+value.cp+"' data-dismiss='modal' style='margin: 0px 4px 4px 0px; border-radius:30px;'>"+value.cp+ " " +value.name+"</button>";
		});
	}
	$("#main-title-modal-scope").html('<i class="fa fa-angle-right"></i> Dans quelle commune vous situez-vous en ce moment ?'); 
    $("#modal-select-scope #list-scope").html(HTML); initBtnScopeList();
	$("#modal-select-scope").modal("show");
	$(".search-loader").html("Communection : <span style='font-weight:300;'>un code postal et c'est parti !</span>");
	geolocHTML5Done = true;
}

/* géolocalisation HTML5 */