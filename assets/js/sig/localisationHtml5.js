
/* géolocalisation HTML5 */
var currentRoleLoc = "";
var locationHTML5Found = false;
function initHTML5Localisation(role){
	if (navigator.geolocation)
	{
	  if(!locationHTML5Found)
	  navigator.geolocation.getCurrentPosition(
		function(position){ //success
			//toastr.success('<i class="fa fa-refresh fa-spin"></i> Recherche de votre position... Merci de patienter...');
	  		//$("#main-title-public1").html("<i class='fa fa-refresh fa-spin'></i> Recherche de votre position. Merci de patienter");
			//$("#main-title-public1").show(400);
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
	}
	else{
	  toastr.error("Votre navigateur ne prend pas en compte la géolocalisation HTML5");
	}
}


function getCityInseeByGeoPos(coords){
	//toastr.info("<i class='fa fa-circle-o-notch fa-spin'></i> Recherche des données de votre commune");
	showLoadingMsg("Position trouvée");
				
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
						$("#main-title-public2").html("<i class='fa fa-university'></i> "+obj.name);
						$("#main-title-public2").show(400);	
						if(typeof obj.cp != "undefined")
							$(".form-group #cp").val(obj.cp);
					}
					
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
			}else{
				toastr.info("Nous n'avons pas trouvé votre code postal");// : merci de vous localiser manuellement en remplissant le formulaire.");
				//getCityByLatLngNominatim(coords.latitude, coords.longitude);
			}
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
/* géolocalisation HTML5 */