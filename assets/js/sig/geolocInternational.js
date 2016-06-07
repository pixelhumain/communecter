
/* return { id, cityName, postalCode, street, coordinates } */
function getGeoPosInternational(requestPart){
	callNominatimInternational(requestPart, 
		function(objNomi){ /*success nominatim*/
			console.log("SUCCESS nominatim ="); console.dir(objNomi);

			if(objNomi.length != 0){
				console.log('Résultat trouvé chez Nominatim !');
			}else{
				console.log('Aucun résultat chez Nominatim');
				callGoogleMapInternational(requestPart, 
					function(objGoo){ /*success google*/
						console.log("SUCCESS GOOGLE ="); console.dir(objGoo);
						if(objGoo.results.length == 0){
							console.log('Aucun résultat chez Google');
						}else{
							console.log('Résultat trouvé chez Google !');
						}
			
					}, 
					function(thisError){ /*error google*/
						console.log("ERROR GOOGLE ="); console.dir(thisError);
					}, 
				"");
			}
		}, 
		function(thisError){ /*error nominatim*/
			console.log("ERROR nominatim =");
			console.dir(thisError);
		});
}

/**/
function callNominatimInternational(requestPart, success, error){
	console.log('callGoogleMapInternational',"nominatim.openstreetmap.org/search?q=" + requestPart);
	$.ajax({
			url: "//nominatim.openstreetmap.org/search?q=" + requestPart + "&format=json&polygon=0&addressdetails=1",
			type: 'POST',
			dataType: 'json',
			async:false,
			crossDomain:true,
			complete: function () {},
			success: function (obj){
				success(obj);
			},
			error: function (thisError) {
				error(thisError);
			}
		});
}

/**/
function callGoogleMapInternational(requestPart, success, error, keyApp){
	console.log('callGoogleMapInternational',"https://maps.googleapis.com/maps/api/geocode/json?address=" + requestPart); // + "&key="+keyApp);
	$.ajax({
			url: "//maps.googleapis.com/maps/api/geocode/json?address=" + requestPart, // + "&key="+keyApp,
			type: 'POST',
			dataType: 'json',
			async:false,
			crossDomain:true,
			complete: function () {},
			success: function (obj){
				success(obj);
			},
			error: function (thisError) {
				error(thisError);
			}
		});
}

/**/
function findGeoposByDataGouv(requestPart){
	$.ajax({  
		url: "//api-adresse.data.gouv.fr/search/?q=" + requestPart ,
		dataType: 'json',
		async:false,
		complete: function () {},
		success: function (obj){
			//success(obj);
		},
		error: function (error) {
			//error(error);
		}
	});
}