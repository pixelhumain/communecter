
/**
***		FIND PLACE
***/
	
SigLoader.getSigFindPlace = function (Sig){ 
	
	Sig.currentResultResearch = "";
	Sig.nbMaxTentative = 4;

	//***
	//initialisation de l'interface et des événements (click, etc)
	/*	>>>>>>>>>>>>>> MAP <<<<<<<<<<<<<<< */
	Sig.initFindPlace = function (){ 
		console.warn("--------------- initFindPlace ---------------------"); 
		var thisSig = this;

		//##
		//BTN FIND PLACE
		$(thisSig.cssModuleName + " #btn-find-place").click(function (){ //alert("find place");
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
		//lance un timeout de 1 seconde si le txt de recherche fait plus de 3 caractères
		//après 1 seconde sans nouvelle lettre, on lance la recherche
		var timeoutFindPlace;
		$(thisSig.cssModuleName + ' #txt-find-place').keyup(function(event) {
			var length = $(thisSig.cssModuleName + " #txt-find-place").val().length;
			if(length == 0){
				clearTimeout(timeoutFindPlace);
				$(thisSig.cssModuleName + ' #list-dropdown-find-place').css({'display':'none'});	
			}
			if(length >= 3){
				clearTimeout(timeoutFindPlace);
				var action = "Sig.findPlace('')";//"+$(thisSig.cssModuleName + " #txt-find-place").val()+"')";
				timeoutFindPlace = setTimeout(action, 1000);
			}
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
				alert('erreur nominatim ajax jquery (map_finPlace.js)');
			}
		});
	};
	
	Sig.getNominatimRequest = function(nbTentative){
		
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
			if(city.toLowerCase() == thisResult.address.city.toLowerCase()) 	itemDropbox = concat(itemDropbox, thisResult.address.city);
			if(cp.toLowerCase() == thisResult.address.postcode.toLowerCase()) 	itemDropbox = concat(itemDropbox, thisResult.address.postcode);
			if(state.toLowerCase() == thisResult.address.state.toLowerCase()) 	itemDropbox = concat(itemDropbox, thisResult.address.state);
			//itemDropbox = concat(itemDropbox, thisResult.bounds);
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
		[{"place_id":"127732055","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"relation","osm_id":"7444","boundingbox":["48.8155755","48.902156","2.224122","2.4697602"],"lat":"48.8565056","lon":"2.3521334","display_name":"Paris, Île-de-France, France métropolitaine, France","class":"place","type":"city","importance":0.96893459932191,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_city.p.20.png","address":{"city":"Paris","county":"Paris","state":"Île-de-France","country":"France","country_code":"fr"}},{"place_id":"127330920","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"relation","osm_id":"71525","boundingbox":["48.8155755","48.902156","2.224122","2.4697602"],"lat":"48.85881005","lon":"2.32003101155031","display_name":"Paris, Île-de-France, France métropolitaine, France","class":"boundary","type":"administrative","importance":0.96893459932191,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_boundary_administrative.p.20.png","address":{"county":"Paris","state":"Île-de-France","country":"France","country_code":"fr"}},{"place_id":"63292496","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"way","osm_id":"33063046","boundingbox":["35.26725","35.3065029","-93.7618069","-93.6750829"],"lat":"35.2920325","lon":"-93.7299173","display_name":"Paris, Logan County, Arkansas, États-Unis d'Amérique","class":"place","type":"city","importance":0.67385884862688,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_city.p.20.png","address":{"city":"Paris","county":"Logan County","state":"Arkansas","country":"États-Unis d'Amérique","country_code":"us"}},{"place_id":"63211936","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"way","osm_id":"33299478","boundingbox":["33.611853","33.738378","-95.6279279","-95.4354549"],"lat":"33.6617962","lon":"-95.555513","display_name":"Paris, Lamar County, Texas, États-Unis d'Amérique","class":"place","type":"city","importance":0.54374443751163,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_city.p.20.png","address":{"city":"Paris","county":"Lamar County","state":"Texas","country":"États-Unis d'Amérique","country_code":"us"}},{"place_id":"127677348","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"relation","osm_id":"130722","boundingbox":["38.164922","38.238271","-84.3073258","-84.2320888"],"lat":"38.2097987","lon":"-84.2529869","display_name":"Paris, Bourbon County, Kentucky, États-Unis d'Amérique","class":"place","type":"city","importance":0.5108263210417,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_city.p.20.png","address":{"city":"Paris","county":"Bourbon County","state":"Kentucky","country":"États-Unis d'Amérique","country_code":"us"}},{"place_id":"17089121","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"node","osm_id":"1688891876","boundingbox":["36.1119519","36.1120519","-115.1727109","-115.1726109"],"lat":"36.1120019","lon":"-115.1726609","display_name":"Paris, South Las Vegas Boulevard, Hughes Center, Paradise, Clark County, Nevada, 89109, États-Unis d'Amérique","class":"highway","type":"bus_stop","importance":0.4846342182247,"icon":"http://nominatim.openstreetmap.org/images/mapicons/transport_bus_stop2.p.20.png","address":{"bus_stop":"Paris","road":"South Las Vegas Boulevard","suburb":"Hughes Center","town":"Paradise","county":"Clark County","state":"Nevada","postcode":"89109","country":"États-Unis d'Amérique","country_code":"us"}},{"place_id":"710396","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"node","osm_id":"257763716","boundingbox":["43.1532336","43.2332336","-80.4242807","-80.3442807"],"lat":"43.1932336","lon":"-80.3842807","display_name":"Paris, Ontario, Canada","class":"place","type":"town","importance":0.46561345354774,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_town.p.20.png","address":{"town":"Paris","state":"Ontario","country":"Canada","country_code":"ca"}},{"place_id":"127399095","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"relation","osm_id":"140787","boundingbox":["39.469158","39.489278","-92.0214799","-91.9916789"],"lat":"39.4808721","lon":"-92.0012811","display_name":"Paris, Monroe County, Missouri, États-Unis d'Amérique","class":"place","type":"city","importance":0.44025131828771,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_city.p.20.png","address":{"city":"Paris","county":"Monroe County","state":"Missouri","country":"États-Unis d'Amérique","country_code":"us"}},{"place_id":"127752165","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"relation","osm_id":"126166","boundingbox":["39.581423","39.648578","-87.7210459","-87.6505409"],"lat":"39.611146","lon":"-87.6961374","display_name":"Paris, Edgar County, Illinois, États-Unis d'Amérique","class":"place","type":"city","importance":0.43634000491239,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_city.p.20.png","address":{"city":"Paris","county":"Edgar County","state":"Illinois","country":"États-Unis d'Amérique","country_code":"us"}},{"place_id":"127778909","licence":"Data © OpenStreetMap contributors, ODbL 1.0. http://www.openstreetmap.org/copyright","osm_type":"relation","osm_id":"197171","boundingbox":["36.266003","36.329016","-88.3671129","-88.2650669"],"lat":"36.3020023","lon":"-88.3267107","display_name":"Paris, Henry County, Tennessee, États-Unis d'Amérique","class":"place","type":"city","importance":0.43634000491239,"icon":"http://nominatim.openstreetmap.org/images/mapicons/poi_place_city.p.20.png","address":{"city":"Paris","county":"Henry County","state":"Tennessee","country":"États-Unis d'Amérique","country_code":"us"}}]
		*/

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