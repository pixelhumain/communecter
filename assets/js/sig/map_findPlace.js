
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
			url: "http://nominatim.openstreetmap.org/search" + urlRequest + "&format=json&polygon=1&addressdetails=1",
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

	Sig.getNominatimRequest = function(nbTentative){
		
		if(this.fullTextResearch == true){
			if(this.useExternalSearchPlace){
				var str = "";
				
				if($("#postalCode").length>0 && $("#postalCode").val() != null)
					str += $("#postalCode").val();
				
				if(nbTentative < 1)
				if($("#fullStreet").length>0 && $("#fullStreet").val() != null){
					if(str != "") str += " ";
						str += $("#fullStreet").val();
				}
				
				// var cityInsee = "";
				// console.dir($("#city").attr("city-name"));
				// if($("#city").length>0 && $("#city").val() != null){
				// 	if(str != "") str += " ";
				// 		cityInsee = $("#city").val();
				
				// 	console.dir(this.citiesByPostalCode);
				// 	if(cityInsee != ""){ console.log(" insee : " + cityInsee);
				// 		$.each(this.citiesByPostalCode, function(key, data){
				// 			console.log("item data");
				// 			console.dir(data);
				// 			if(data.value == cityInsee) cityInsee = data.text;
				// 		});
				// 		console.log(" insee : " + cityInsee);
						
				// 	}
				// }

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


	Sig.execFullSearchNominatim = function (nbTentative){
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

		this.useExternalSearchPlace = true;
		var urlRequest = this.getNominatimRequest(nbTentative);
		//console.log(urlRequest);
		$.ajax({
			url: "http://nominatim.openstreetmap.org/search" + urlRequest + "&format=json&polygon=1&addressdetails=1",
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

		var thisSig = this;

		$("#alert-city-found").removeClass("hidden");
		var cp = $("#postalCode").val();

		var position = null;
		$.each(geoPosition, function (key, value){
			//console.log((citiesByPostalCode));
			$.each(citiesByPostalCode, function (key2, value2){

				var addressCp = value.address.postcode ? value.address.postcode : "";
				var city = value.address.city != null ? value.address.city : 
							value.address.village ? value.address.village : "";

				if(city != "" && value2.text != null){
					
					//console.log(value2.text); console.log(value.address.city);
					if(thisSig.clearStr(value2.text) == thisSig.clearStr(city) 
						&& cp == addressCp
						&& position == null) 
						position = value;
				}
			});
		});


		if(position == null) position = geoPosition[0];
		//console.log("position"); console.dir(position);
		 
		$("#geoPosLongitude").attr("value", position["lat"]);
		$("#geoPosLatitude").attr("value", position["lon"]);

		var latlng = [position["lat"], position["lon"]];
		//thisSig.map.setView(latlng, 15);

		thisSig.centerSimple(latlng, 15);
		//console.log("center ok");

		var content = thisSig.getPopupNewData();
		var properties = { 	id : "0",
							icon : thisSig.getIcoMarkerMap({"type" : type}),
							content: content };

		//console.dir(properties);
		//console.log("before getMarkerSingle");
		thisSig.clearMap();
		var markerNewData = thisSig.getMarkerSingle(thisSig.map, properties, latlng);
		//console.dir(markerNewData);
		thisSig.map.panTo(markerNewData.getLatLng(), {animate:false});
		thisSig.map.setZoom(15, {animate:false});
		Sig.centerSimple(markerNewData.getLatLng(), 15);

		thisSig.markerNewData = markerNewData;
		markerNewData.openPopup();
		markerNewData.dragging.enable();
		
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
			else 		$(".noteWrap").hide(400);
		});

		$('#btn-show-city').click(function(){
			if(isNotSV) $("#ajaxSV").hide(400);
			else 		$(".noteWrap").hide(400);
			thisSig.map.panTo(thisSig.markerNewData.getLatLng(), {animate:false});
			thisSig.map.setZoom(15, {animate:false});
			
		});

		if(!isNotSV) $(".form-add-data").css("top" , "200px");

		function btnValidateClick(isNotSV){ //alert("yepaé");
			//console.log("btnValidateClick");
			Sig.markerNewData.closePopup();
			Sig.centerSimple(Sig.markerNewData.getLatLng(), 15);

			if(isNotSV) $("#ajaxSV").show(400);
			else 			$(".noteWrap").show(400);

			$("#geoPosLongitude").attr("value", Sig.markerNewData.getLatLng().lng);
			$("#geoPosLatitude").attr("value", Sig.markerNewData.getLatLng().lat);
			Sig.map.invalidateSize(false);
			Sig.markerNewData.openPopup();
		}
		
		
	};

	return Sig;
};
