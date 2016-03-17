
/* géolocalisation HTML5 */
var currentRoleLoc = "";
var locationHTML5Found = false;
var positionFound = false;

function initHTML5Localisation(role){

	if(!locationHTML5Found)
	$.blockUI({
		message : 	"<h1 class='homestead text-dark padding-20'><i class='fa fa-hand-pointer-o'></i> Merci d'autoriser le partage de localisation</span></h1>" +
					"<button class='btn btn-info margin-bottom-15' onclick='$.unblockUI();showMap(false);'>Annuler</button>"
	});
	

	if (navigator.geolocation)
	{
	  if(!locationHTML5Found){
	  navigator.geolocation.getCurrentPosition(
		function(position){ //success
			//toastr.success('<i class="fa fa-refresh fa-spin"></i> Recherche de votre position... Merci de patienter...');
	  		//$("#main-title-public1").html("<i class='fa fa-refresh fa-spin'></i> Recherche de votre position. Merci de patienter");
			//$("#main-title-public1").show(400);
			positionFound = position;
			$.blockUI({
				message : "<h1 class='homestead text-dark'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche de votre position ...</span></h1>"
			});
			
			$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Géolocalisation en cours ...");		
			locationHTML5Found = true;
			$(".box-discover").hide(400);
			$(".box-menu").hide(400);
			// var position = {
			// 		coords : {
			// 		 latitude : -20.9190923,
			// 		 longitude : 55.4859363
			// 		}
			// 	};
			// console.log(position.coords);
		    mapBg.panTo([position.coords.latitude, position.coords.longitude], {animate:false});
		    mapBg.setZoom(13, {animate:false});
		    
		    //toastr.info("Votre position géographique a été trouvée");
		    currentRoleLoc = role;
		    getCityInseeByGeoPos(position.coords);
		},
		function (error){	//error
			var info = "Erreur lors de la géolocalisation : ";
		    switch(error.code) {
			    case error.TIMEOUT:
			    	info += "Timeout !";
			    break;
			    case error.PERMISSION_DENIED:
			    info += "Vous n’avez pas donné la permission";
			    break;
			    case error.POSITION_UNAVAILABLE:
			    	info += "La position n’a pu être déterminée";
			    break;
			    case error.UNKNOWN_ERROR:
			    	info += "Erreur inconnue";
			    break;
			}
			toastr.error(info);
		});
		}else{
			$.blockUI({
				message : "<h1 class='homestead text-dark'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche de votre position ...</span></h1>"
			});
			
			$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Géolocalisation en cours ...");		
			$(".box-discover").hide(400);
			$(".box-menu").hide(400);
			// var position = {
			// 		coords : {
			// 		 latitude : -20.9190923,
			// 		 longitude : 55.4859363
			// 		}
			// 	};
			// console.log(position.coords);
		    mapBg.panTo([positionFound.coords.latitude, positionFound.coords.longitude], {animate:false});
		    mapBg.setZoom(13, {animate:false});
		    
		    //toastr.info("Votre position géographique a été trouvée");
		    currentRoleLoc = role;
		    getCityInseeByGeoPos(positionFound.coords);
		}
	}
	else{
	  toastr.error("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
	}
}


function getCityInseeByGeoPos(coords){
	//toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Recherche des données de votre commune");
	//showLoadingMsg("Identification de votre commune");
				
	$.ajax({
		url: baseUrl + "/" + moduleId+"/sig/getinseebylatlng",
		type: 'POST',
		dataType: 'json',
		data:{"latitude" : coords.latitude, "longitude" : coords.longitude },
		complete: function () {},
		success: function (obj) {
			if (obj != null) {
				
					
				if(currentRoleLoc == "showCityMap" && typeof obj.insee != "undefined"){
					console.log("donne city : ");
					console.dir(obj);
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
					console.log("cities found : ");
					console.dir(obj);
				
					$(".search-loader").html("<i class='fa fa-crosshairs'></i> Sélectionnez une commune en cliquant sur <b>Communecter</b> ...");
		        	Sig.showMapElements(Sig.map, obj);
				}
				else if(currentRoleLoc == "communexion_tsr"){ // && typeof obj.name != "undefined"){
					$.each(obj, function(key, value){ obj[key]["typeSig"] = "city"; });
					console.log("cities found : ");
					console.dir(obj);
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
			console.dir(error);
			toastr.error(error.responseText);
		}
	});
}

//reverse geocoding
function getCityByLatLngNominatim(latitude, longitude){
	console.log(latitude, longitude);
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
			console.dir("error", error);
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
			console.log("getInseeByCityName ok");
			console.dir(obj);

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