
/**
***		FIND PLACE
***/

SigLoader.getSigFindPlace = function (Sig){

	Sig.currentResultResearch = "";
	Sig.nbMaxTentative = 4;
	Sig.fullTextResearch = true;
	//pour effectuer des recherches nominatim à partir d'un form externe (différent de la recherche intégrée)
	Sig.useExternalSearchPlace = false;
	Sig.markerNewData = "";

	//***	
	//initialisation de l'interface et des événements (click, etc)
	/*	>>>>>>>>>>>>>> MAP <<<<<<<<<<<<<<< */
	Sig.initFindPlace = function (){
		console.warn("--------------- initFindPlace ---------------------");
		var thisSig = this;

		//##
		//BTN FIND PLACE
		$(thisSig.cssModuleName + " .btn-find-place").click(function (){ //alert("find place");
			var address = $(thisSig.cssModuleName + " #txt-find-place").val();
			thisSig.findPlace(1);
		});

		//##
		//ON FOCUS TXT FIND PLACE
		//efface la dropDown qui contient le résultat de recheche
		//lorsque l'on click sur le champ de texte,
		//si le champs de texte est vide
		$(thisSig.cssModuleName + ' .txt-find-place').focus(function(event) {
			if($(thisSig.cssModuleName + ' #txt-find-place').val() != "")
			$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'block'});
			else
			$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'none'});
		});

		//##
		//ON KEY UP TXT FIND PLACE
		//lance un timeout de 1 seconde
		//après 1 seconde sans nouvelle lettre, on lance la recherche
		var timeoutFindPlace;
		$(thisSig.cssModuleName + ' .txt-find-place').keyup(function(event) {
				clearTimeout(timeoutFindPlace);
				var action = "Sig.findPlace(1)";//"+$(thisSig.cssModuleName + " #txt-find-place").val()+"')";
				timeoutFindPlace = setTimeout(action, 1000);
			//}
		});

		$(thisSig.cssModuleName + ' #btn-find-more').click(function(event) {
			//console.warn("--------------- findMORE ---------------------");
			if($(thisSig.cssModuleName + ' #full-research').hasClass("hidden")){
				$(thisSig.cssModuleName + ' #full-research').removeClass("hidden");
				$(thisSig.cssModuleName + ' #txt-find-place').addClass("hidden");
				thisSig.fullTextResearch = false;
			}
			else{
				$(thisSig.cssModuleName + ' #full-research').addClass("hidden");
				$(thisSig.cssModuleName + ' #txt-find-place').removeClass("hidden");
				this.fullTextResearch = true;
			}
			//console.log("fullTextResearch = " + this.fullTextResearch);
			//$(thisSig.cssModuleName + ' #full-research').toggle();
		});

		//##
		//ON FOCUS MAP
		//lorsqu'on click sur la carte, la dropdown disparait
		$(thisSig.cssModuleName + ' #mapCanvas' + this.sigKey).focus(function(event) {
			$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'none'});
		});

	};

	//##
	//recherche un lieu par nominatim
	Sig.findPlace = function (nbTentative){ //alert(address);
		console.warn("--------------- findPlace ---------------------");
		var thisSig = this;

		//affiche le message "recherche en cours"
		if(!thisSig.useExternalSearchPlace){
			$(thisSig.cssModuleName + " #list-dropdown-find-place").html('<li style="width:100%;"><a href="#"><i class="fa fa-refresh fa-spin"></i> ('+ nbTentative +') Recherche en cours ...</a></li>');
			$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'block'});
		}
		var urlRequest = this.getNominatimRequest(nbTentative);
		//console.log(urlRequest);
		$.ajax({
			//url: "http://nominatim.openstreetmap.org/search?q=" + address + "&format=json&polygon=0&addressdetails=1",
			url: "//nominatim.openstreetmap.org/search" + urlRequest + "&format=json&polygon=1&addressdetails=1",
			type: 'POST',
    		dataType: 'json',
    		//crossDomain: true,
			complete: function () { },
			success: function (obj)
			{
				if (obj.length > 0) {

					if(thisSig.useExternalSearchPlace) return obj;

					$(thisSig.cssModuleName + " #list-dropdown-find-place").html("");

					thisSig.currentResultResearch = obj;
					var i = 0;

					console.log("reponse nominatim : ");
					console.dir(obj);

					//affichage des résultats de la recherche
					$.each(obj, function (){

						var itemDropbox = thisSig.getItemDropBox(this); //"";
						if(itemDropbox != ""){
							itemDropbox = '<li style="width:100%;"><a id="btn-show-place-'+i+'" num="'+i+'" href="#"><i class="fa fa-map-marker"></i> ' + itemDropbox + '</a></li>';
							$(thisSig.cssModuleName + " #list-dropdown-find-place").append(itemDropbox);
							$(thisSig.cssModuleName + ' #btn-show-place-'+i).click(function(){
								var num = $(this).attr('num');
								thisSig.showPlace(num);
							});
						}
						i++;
					});
					//$('#btn-dropdown-find-place').dropdown('toggle');
					$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'block'});
					$(thisSig.cssModuleName + ' #btn-dropdown-find-place').dropdown('toggle');
				}
				else {
					//alert('no such address.');
					if(nbTentative <= thisSig.nbMaxTentative)
					{
						thisSig.findPlace(nbTentative+1);
					}
					else{
						var itemDropbox = '<li style="width:100%;"><a href="#"><i class="fa fa-exclamation-circle"></i> Aucun résultat n\'a été trouvé</a></li>';
						$(thisSig.cssModuleName + " #list-dropdown-find-place").html(itemDropbox);
						$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'block'});
					}
				}
			},
			error: function (error) {
				var itemDropbox = '<li style="width:100%;"><a href="#"><i class="fa fa-exclamation-circle"></i> Erreur nominatim ajax jquery</a></li>';
				$(thisSig.cssModuleName + " #list-dropdown-find-place").html(itemDropbox);
						
				//alert('erreur nominatim ajax jquery (map_findPlace.js)');
			}
		});
	};

	if(typeof getCountries != "undefined")
	Sig.countryName = getCountries("select2");

	Sig.getNominatimRequest = function(nbTentative){
		
		if(this.fullTextResearch == true){
			if(this.useExternalSearchPlace){
				var str = "";
				
				//recupere le nom de la rue
				if(nbTentative < 1 && nbTentative < 2)
				if($("#fullStreet").length>0 && $("#fullStreet").val() != null){
					str += $("#fullStreet").val();
				}
				
				//recupere le code postal
				if($("#postalCode").length>0 && $("#postalCode").val() != null){
					if(str != "") str += ",";
					str += $("#postalCode").val();
				}
				else if($("#cp").length>0 && $("#cp").val() != null){
					if(str != "") str += ",";
					str += $("#cp").val();
				}
				
				//recupere le nom de la ville
				if($("#city").length>0 && nbTentative < 3){
					var textVal = $("#city option:selected").text();
					//toastr.info(textVal);
					if(typeof textVal != "undefined" && textVal != ""){
						if(textVal != null){
							if(str != "") str += " ";
								str += textVal;
						}
					}
				}
				if(nbTentative < 4){
					var textVal = "";
					if($("#organizationCountry").length)  textVal = $("#organizationCountry").attr("value");
					if($("#projectCountry").length) 	  textVal = $("#projectCountry").attr("value");
					if($("#eventCountry").length) 	  	  textVal = $("#eventCountry").attr("value");
							
					if(typeof textVal != "undefined" && textVal != ""){
						if(textVal != null){
							if(str != "") str += " ";
							//transforme l'id du pays en string pour nominatim
							if(typeof this.countryName != "undefined"){
								$.each(this.countryName, function(key, value){
									if(value.id == textVal) textVal = value.text;
								});
							}
							str += textVal;
						}
					}
				}
				console.log("nominatim external research : " + "?q=" + transform(str));
				return "?q=" + transform(str);
			}
			else{
				return "?q=" + $(this.cssModuleName + " #txt-find-place").val();
			}
		}

		
		function transform(str){ //alert(newValue);
			var res = "";
			//remplace les espaces par des +
			for(var i = 0; i<str.length; i++){
				res += (str.charAt(i) == " ") ? "+" : str.charAt(i);
			}
			return res;
		};

		var num 	= transform($(this.cssModuleName + " #txt-num-place").val());//.replace(" ", "+");
		var street 	= transform($(this.cssModuleName + " #txt-street-place").val());//.replace(" ", "+");
		var city 	= transform($(this.cssModuleName + " #txt-city-place").val());//.replace(" ", "+");
		var cp 		= transform($(this.cssModuleName + " #txt-cp-place").val());//.replace(" ", "+");
		var state 	= transform($(this.cssModuleName + " #txt-state-place").val());//.replace(" ", "+");

		if(num != "") street = num + "+" + street;

		var request = "?";

		//on utilise la street pour la tentative 1 ou 2 (mais pas à la 3)
		if(street != "" && (nbTentative < 3)) 	request += "street=" 	  + street;
		//on utilise toujours la ville et le cp
		if(city != "") 		request += "&city=" 	  + city;
		if(cp != "") 		request += "&postalcode=" + cp;
		//on utilise country pour la tentative 1
		if(state != "" && nbTentative == 1) 	request += "&country=" + state; //"&state=" 	  + state +
		//on utilise country pour la tentative 2
		if(state != "" && nbTentative == 2) 	request += "&state="   + state; //"&state=" 	  + state +
		//pas de state pour la 3

		if(nbTentative == 3){
			request = "?q=";
			if(street != "") 	request += street;
			if(city != "") 		request += ",+" + city;
			if(cp != "") 		request += ",+" + cp;
			if(state != "") 	request += ",+" + state;
		}

		console.warn("--------------- request nominatim ("+nbTentative+") : " + request);

		return request;
	};

	Sig.getItemDropBox = function(thisResult){
		//rajoute une valeur à la string str pour construire l'adresse complète du lieu
		function concat(str, newValue){ //alert(newValue);
			if(str == "" && newValue != undefined) return newValue;
			if(str != "" && newValue != undefined) return str+=", "+newValue;
			return str;
		};

		console.warn("-------" + JSON.stringify(thisResult.address));

		var itemDropbox = "";
		if(thisResult.address !== undefined){
			var city 	= $(this.cssModuleName + " #txt-city-place").val();//.replace(" ", "+");
			var cp 		= $(this.cssModuleName + " #txt-cp-place").val();//.replace(" ", "+");
			var state 	= $(this.cssModuleName + " #txt-state-place").val();//.replace(" ", "+");

			itemDropbox = concat(itemDropbox, thisResult.address.house_number);
			itemDropbox = concat(itemDropbox, thisResult.address.road);

			//ajoute la ville si elle existe
			itemDropbox = concat(itemDropbox, thisResult.address.city);

			//ajoute le code postal s'il existe
			itemDropbox = concat(itemDropbox, thisResult.address.postcode);

			//ajoute le pays s'il existe
			if("undefined" != typeof thisResult.address.state){
				//if(state.toLowerCase() == thisResult.address.state.toLowerCase())
				 	itemDropbox = concat(itemDropbox, thisResult.address.state);
			}else{
				if("undefined" != typeof thisResult.address.country){
					//if(state.toLowerCase() == thisResult.address.country.toLowerCase())
				 		itemDropbox = concat(itemDropbox, thisResult.address.country);
				 }
			}
		}
		return itemDropbox;
	}

	Sig.panMapTo = function (lat, lng){
		var latLng = [lat, lon];
		this.map.panTo(latLng);
		this.map.setZoom(10);
	};

	Sig.showPlace = function (id){ 
		var thisSig = this;
		var bounds = this.currentResultResearch[id].boundingbox;
	   	var southWest = L.latLng(bounds[0], bounds[2]),
    		northEast = L.latLng(bounds[1], bounds[3]),
    		LBounds = L.latLngBounds(southWest, northEast);

		//this.map.fitBounds(LBounds);

		var options = {  id : 0,
						 icon : this.getIcoMarker({'type' : 'markerPlace'}),
						 content : thisSig.getPopupSearchPlace($(thisSig.cssModuleName + ' #btn-show-place-'+id).html())
					  };

		var coordinates = new Array(this.currentResultResearch[id].lat, this.currentResultResearch[id].lon);
		
		//efface le polygone s'il existe
		if(this.markerFindPlace != null) this.map.removeLayer(this.markerFindPlace);

		this.markerFindPlace = this.getMarkerSingle(this.map, options, coordinates);
		this.markerFindPlace.openPopup();

		//efface le polygone s'il existe
		if(this.mapPolygon != null) this.map.removeLayer(this.mapPolygon);

		//si l'élément à afficher est une ville et qu'il y a un polygone dans les données
		//on l'affiche
		if( (this.currentResultResearch[id].type == "city" ||
			this.currentResultResearch[id].type == "town") && 
		   "undefined" != typeof this.currentResultResearch[id].polygonpoints){
			
			var allPolygonpoints = this.currentResultResearch[id].polygonpoints;

			var polygonpoints = new Array();
			$.each(allPolygonpoints, function(index, value){
				polygonpoints.push(new Array(parseFloat(value[1]), parseFloat(value[0])));
			});

			this.showPolygon(polygonpoints);
		}

		//on ferme la dropdown
		$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'none'});
		$(thisSig.cssModuleName + ' #btn-dropdown-find-place').dropdown('toggle');

		this.map.panTo(coordinates);
	};


	Sig.execFullSearchNominatim = function (nbTentative, geoShape){
	/*	var oldFullText = this.fullTextResearch;
		this.fullTextResearch = true;
		this.useExternalSearchPlace = true;
		var res = this.findPlace(0);
		this.fullTextResearch = oldFullText;
		this.useExternalSearchPlace = false;
		return res;
	*/
		console.warn("--------------- execFullSearchNominatim ---------------------");
		var thisSig = this;

		$("#alert-city-found").addClass("hidden");
		
		this.useExternalSearchPlace = true;
		var urlRequest = this.getNominatimRequest(nbTentative);
		if(geoShape != null){
			//viewbox=<left>,<top>,<right>,<bottom>
			//http://wiki.openstreetmap.org/wiki/Nominatim#Parameters
			urlRequest += "&viewbox="+geoShape.getWest()+","+geoShape.getNorth()+","
									 +geoShape.getEast()+","+geoShape.getSouth();
		}
		console.log("urlRequest", urlRequest);
		$.ajax({
			url: "//nominatim.openstreetmap.org/search" + urlRequest + "&format=json&polygon=1&addressdetails=1",
			type: 'POST',
    		dataType: 'json',
    		complete: function () { },
			success: function (obj)
			{
				if (obj.length > 0) {
					//console.log("search success");
					//déclarer cette fonction avant d'executer Sig.execFullSearchNominatim
					callBackFullSearch(obj);
					//return obj;
				}
				else {
					if(nbTentative <= thisSig.nbMaxTentative){
						thisSig.execFullSearchNominatim(nbTentative+1);
					}
				}
			},
			error: function (error) {
				
			}
		});
	};

	Sig.showCityOnMap = function(geoPosition, isNotSV, type){ 
		console.log(geoPosition);
		var thisSig = this;

		var cp = $("#postalCode").val();
		if(typeof cp == "undefined") cp = $("#cp").val();

		console.dir(geoPosition);
		var position = null;
		console.log("typof geoPosition.geo", typeof geoPosition.geo);
		if(typeof geoPosition.lat != "undefined"){
			lat=geoPosition.lat;
			lon=geoPosition.lon;
			latlon = new Object;
			latlon = {"latitude":lat,"longitude":lon};
			geoPosition["geo"]=latlon;
			
		}
		if(typeof geoPosition.geo == "undefined"){
			$.each(geoPosition, function (key, value){

				var addressCp = typeof value.address.postcode != "undefined" ? value.address.postcode : "";
					
				//console.log((citiesByPostalCode));
				//$.each(citiesByPostalCode, function (key2, value2){

					var city =  typeof value.address.city 	 != "undefined" ? value.address.city : 
								typeof value.address.village != "undefined" ? value.address.village : "";
					var countryCode = typeof value.address.country_code != "undefined" ? value.address.country_code : "";
					
					console.log("cp", cp, "addressCp", addressCp);
					if(cp == addressCp && countryCode == "fr" && position == null)  position = value;
					// if(city != "" && value2.text != null){				
					// 	//console.log(value2.text); console.log(value.address.city);
					// 	if(//thisSig.clearStr(value2.text) == thisSig.clearStr(city) 
					// 		//|| 
					// 		cp == addressCp
					// 		&& position == null) 
					// 		position = value;
					// }
				//});
			});
		}else{
			console.log("pos geo found");
			position = { "lat" : geoPosition.geo.latitude,
						 "lon" : geoPosition.geo.longitude
					    };
		}

		console.log('position found ? ', position);
		if(position == null) {
			$("#iconeChargement").hide();
			return false; //position = geoPosition.geo;
		}

		//console.log("position"); console.dir(position);
		 
		$("#geoPosLongitude").attr("value", position["lon"]);
		$("#geoPosLatitude").attr("value", position["lat"]);

		var latlng = [position["lat"], position["lon"]];
		//thisSig.map.setView(latlng, 15);

		thisSig.centerSimple(latlng, 15);
		//console.log("center ok");

		var content = thisSig.getPopupNewData();
		console.log("this type", type);
		if(type=="person") content = thisSig.getPopupNewPerson();

		var properties = { 	id : "0",
							icon : thisSig.getIcoMarkerMap({"type" : type}),
							content: content };

		//console.dir(properties);
		//console.log("before getMarkerSingle");
		thisSig.clearMap(thisSig.map, false);
		var markerNewData = thisSig.getMarkerSingle(thisSig.map, properties, latlng);
		//console.dir(markerNewData);
		thisSig.map.panTo(markerNewData.getLatLng(), {animate:false});
		thisSig.map.setZoom(15, {animate:false});
		Sig.centerSimple(markerNewData.getLatLng(), 15);

		thisSig.markerNewData = markerNewData;
		markerNewData.openPopup();
		markerNewData.dragging.enable();
		
		if(typeof geoPosition.geoShape != "undefined"){
			var geoShape = Sig.inversePolygon(geoPosition.geoShape.coordinates[0]);
			thisSig.showPolygon(geoShape);
			thisSig.map.fitBounds(geoShape);
		}

		var timeout = setTimeout(function() {
				Sig.map.panBy([260, 0]);
			}, 1000);

		$("#btn-validate-geopos").click(function(){
			btnValidateClick(isNotSV);
		});

		thisSig.markerNewData.on('popupopen', function(e){
			$("#btn-validate-geopos").click(function(){
				btnValidateClick(isNotSV);
			});
		});
		
		thisSig.markerNewData.on('dragend', function(e){
			thisSig.markerNewData.openPopup();	
		});

		thisSig.markerNewData.on('dragstart', function(e){
			if(isNotSV) $("#ajaxSV").hide(400);
			else {
					$(".noteWrap").hide(400);
					$(".main-login").hide(400);
			}
			
		});

		$('#btn-show-city').click(function(){
			if(isNotSV) $("#ajaxSV").hide(400);
			else {
					$(".noteWrap").hide(400);
					$(".main-login").hide(400);
			}
			thisSig.map.panTo(thisSig.markerNewData.getLatLng(), {animate:false});
			thisSig.map.setZoom(15, {animate:false});
			
		});

		if(!isNotSV) $(".form-add-data").css("top" , "200px");

		function btnValidateClick(isNotSV){ //alert("yepaé");
			console.log("btnValidateClick");
			Sig.markerNewData.closePopup();
			Sig.map.panTo(Sig.markerNewData.getLatLng());
			Sig.map.panBy([260, 0]);

			if(isNotSV) $("#ajaxSV").show(400);
			else {
					$(".noteWrap").show(400);
					$(".main-login").show(400);
			}
			
			$("#geoPosLongitude").attr("value", Sig.markerNewData.getLatLng().lng);
			$("#geoPosLatitude").attr("value", Sig.markerNewData.getLatLng().lat);
			Sig.map.invalidateSize(false);
			Sig.markerNewData.openPopup();

			showMap(false);
		
		}
		$("#alert-city-found").removeClass("hidden");
		$("#iconeChargement").hide();
		

		return true;
	};


	Sig.markerModifyPosition = null;
	Sig.entityTypeModifyPosition = null;
	Sig.entityIdModifyPosition = null;
	

	Sig.startModifyGeoposition = function (entityId, entityType, entity){
		
		//vérifie si l'entité donné à bien une position geo
		var coordinates = this.getCoordinates(entity, "markerSingle");
		//si elle n'en a pas on sort
		console.log("startModifyGeoposition coordinates", coordinates);
		console.dir(entity);

		if(typeof coordinates == "undefined" || coordinates == null) {
			//findGeoPosByAddress();
			return;
		}
		
		
		//vide la carte
		this.clearMap();
		//supprime myMarker
		this.map.removeLayer(this.myMarker);

		this.entityIdModifyPosition = entityId;
		this.entityTypeModifyPosition = entityType;
		
		//recupere toutes les info pour construire le marker à déplacer
		var profilMarkerImageUrl = typeof entity.profilMarkerImageUrl != "undefined"  ? entity.profilMarkerImageUrl : "";
		var popupContent = this.getPopupModifyPosition(entity);
		var properties = { 	id : "0",
							icon : this.getIcoMarkerMap({type:entityType, profilMarkerImageUrl:profilMarkerImageUrl}),
							type : entityType,
							typeSig : entityType,
							faIcon : this.getIcoByType(entityType),
							content: popupContent//"<h1>Modify the position of this entity in the map</h1><br/>" 
						};
		
		//creation du nouveau marker que l'on va pouvoir déplacer
		this.markerModifyPosition = this.getMarkerSingle(this.map, properties, coordinates);
		//activation du déplacement du marker par la souris
		this.markerModifyPosition.dragging.enable();
		this.markerModifyPosition.openPopup();
		//effet bounce
		this.markerToBounce = this.markerModifyPosition;
		this.bounceMarker(0, { duration: 500, 	//va effectuer un saut pendant 500 miliemes de secondes
							  height: 15,		//d'une hauteur de 15px
							  interval: 5000,	//toutes les 2 secondes
							  occurence:5 });	//5 fois de suite

		//zoom sur le nouveau marker
		//this.map.panTo(coordinates);
		this.map.setView(coordinates, 13);

		//désactive le bounce quand on click sur la marker
		this.markerToBounce.on("click", function(){
			Sig.markerToBounce = null;
			if(typeof Sig.timerbounce != "undefined") clearTimeout(Sig.timerbounce);
		});
		//désactive le bounce quand on le déplace
		this.markerToBounce.on("dragstart", function(){
			Sig.markerToBounce = null;
			if(typeof Sig.timerbounce != "undefined") clearTimeout(Sig.timerbounce);
		});
		//lorsqu'on vient de déplacer le marker, on ré-ouvre la popup
		this.markerToBounce.on("dragend", function(){
			if(Sig.markerModifyPosition != null)
				Sig.markerModifyPosition.openPopup();
				//et on enregistre les coordonnées
				$("#geoPosLongitude").attr("value", Sig.markerModifyPosition.getLatLng().lng);
				$("#geoPosLatitude").attr("value", Sig.markerModifyPosition.getLatLng().lat);
		});
		//lorsqu'on vient de déplacer la map, on ré-ouvre la popup
		this.map.on("dragend", function(){
			if(Sig.markerModifyPosition != null)
				Sig.markerModifyPosition.openPopup();
		});

		//lorsque la popup s'ouvre, on ajoute l'event click sur le bouton de validation
		this.markerToBounce.on("popupopen", function(){
			$("#btn-validate-new-position").click(function(){
				var position = Sig.markerModifyPosition.getLatLng();

				Sig.saveNewGeoposition(	Sig.entityIdModifyPosition, 
										Sig.entityTypeModifyPosition, 
										position.lat, 
										position.lng);
			});
		});
		
		$("#btn-validate-new-position").click(function(){
			var position = Sig.markerModifyPosition.getLatLng();

			Sig.saveNewGeoposition(	Sig.entityIdModifyPosition, 
									Sig.entityTypeModifyPosition, 
									position.lat, 
									position.lng);
			
		});
		
		
	};

	Sig.saveNewGeoposition = function (entityId, entityType, latitude, longitude){
		console.log("start save geopos");
		clearTimeout(Sig.timerbounce);
		$("#lbl-loading-saving").removeClass("hidden");
		$("#lbl-loading-saving").html("<center><i class='fa fa-refresh fa-2x center fa-spin'></i></br>Enregistrement de la nouvelle position...<br>Merci de patienter...</center>");
       	$.ajax({
			url: baseUrl+"/"+moduleId+"/sig/updateentitygeoposition",
			type: 'POST',
			data: "entityType="+entityType+"&entityId="+entityId+"&latitude="+latitude+"&longitude="+longitude,
    		success: function (obj){
    			//alert(entityType);
    			if( (entityType == "citoyens" || entityType == "person") && userId == entityId){
    				//actualise myPosition pour que le bouton "home" de la carto centre sur la nouvelle position
    				Sig.myPosition.position.latitude = latitude;
    				Sig.myPosition.position.longitude = longitude;
    				if(location.hash != "#default.twostepregister"){ 
    					loadByHash(location.hash);
	    			}else{
	    				achiveTSRAddress();
	    			}
    			}
    			else{
    				//recharge la fiche info ouverte
    				loadByHash(location.hash);
    			}

    			Sig.map.removeLayer(Sig.markerModifyPosition);
    			Sig.markerModifyPosition = null;

    			toastr.success("La position a été mise à jour avec succès");
			},
			error: function(error){
				console.log("Une erreur est survenue pendant l'enregistrement de la nouvelle position");
				console.log("entityType="+entityType+"&entityId="+entityId+"&latitude="+latitude+"&longitude="+longitude);
			}
		});
	};

	return Sig;
};
