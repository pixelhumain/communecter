
/**
***		FIND PLACE
***/

SigLoader.getSigFindPlace = function (Sig){

	Sig.currentResultResearch = "";
	Sig.nbMaxTentative = 4;
	Sig.fullTextResearch = true;

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
				this.fullTextResearch = false;
			}
			else{
				$(thisSig.cssModuleName + ' #full-research').addClass("hidden");
				$(thisSig.cssModuleName + ' #txt-find-place').removeClass("hidden");
				this.fullTextResearch = true;
			}
			console.log(this.fullTextResearch);
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
		$("#list-dropdown-find-place").html('<li style="width:100%;"><a href="#"><i class="fa fa-refresh fa-spin"></i> ('+ nbTentative +') Recherche en cours ...</a></li>');
		$('#list-dropdown-find-place').css({'display':'block'});

		var urlRequest = this.getNominatimRequest(nbTentative);

		$.ajax({
			//url: "http://nominatim.openstreetmap.org/search?q=" + address + "&format=json&polygon=0&addressdetails=1",
			url: "http://nominatim.openstreetmap.org/search" + urlRequest + "&format=json&polygon=1&addressdetails=1",
			type: 'POST',
			complete: function () { },
			success: function (obj)
			{
				if (obj.length > 0) {

					$(thisSig.cssModuleName + " #list-dropdown-find-place").html("");

					thisSig.currentResultResearch = obj;
					var i = 0;
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
				alert('erreur nominatim ajax jquery (map_findPlace.js)');
			}
		});
	};

	Sig.getNominatimRequest = function(nbTentative){

		if(this.fullTextResearch == true){
			return "?q=" + $(this.cssModuleName + " #txt-find-place").val();
		}

		function transform(str){ //alert(newValue);
			var res = "";
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
			//on utilise la street pour la tentative 1 ou 2 (mais pas à la 3)
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
		var thisSig = this; //alert(id);
		//alert(JSON.stringify(this.currentResultResearch[id]));
	   	var bounds = this.currentResultResearch[id].boundingbox;
	   	var southWest = L.latLng(bounds[0], bounds[2]),
    		northEast = L.latLng(bounds[1], bounds[3]),
    		LBounds = L.latLngBounds(southWest, northEast);

		this.map.fitBounds(LBounds);

		/*
		if(rectangleScope != ""){
			rectangleScope.editing.disable();
			rectangleScope.setBounds(LBounds);
			rectangleScope.editing.enable();
			theMap.zoomOut();
		}*/

		/*rectangleScope.bindPopup('<h4><i class="fa fa-map-marker"></i> '+
									currentResultResearch[id].address.city+
								 '</h4>').openPopup();*/

		//in map.js

		var options = {  id : 0,
						 icon : this.getIcoMarker({'type' : 'markerPlace'}),
						 content : "<span class='popup-result-find-place'>"+$(thisSig.cssModuleName + ' #btn-show-place-'+id).html()+"</span>" }; //,
						//"lat" : this.currentResultResearch[id].lat ,
						//"lng" : this.currentResultResearch[id].lon };

		var coordinates = new Array(this.currentResultResearch[id].lat, this.currentResultResearch[id].lon);
		var marker = this.getMarkerSingle(this.map, options, coordinates);
		marker.openPopup();

		$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'none'});
		$(thisSig.cssModuleName + ' #btn-dropdown-find-place').dropdown('toggle');
	};


	return Sig;
};
