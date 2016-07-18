
	var typeSelected = new Array("contact", "geo");
	var HASHTAGS_LIST = new Array();
	var idPlace = new Array("contact", "geo");
	var timeout = setTimeout('', 1000);
	var countrycodes = "fr";
	var dataContact;	
	
	//gère la correspondance entre les btn et les icons
	var listIcoScope = {	"contact" 		: "user",
							"groupe" 		: "users",
							"organisation" 	: "university",
							"tous" 			: "asterisk",
							"quartier"  	: "home",
							"ville" 		: "building",
							"departement" 	: "puzzle-piece",
							"pays" 			: "globe" };
							
	//initialisation des valeurs par defaut
	function initFormScope(scope){
	
		typeSelected["contact"] = "contact";
		typeSelected["geo"] = "ville";
		HASHTAGS_LIST = new Array();
		idPlace = new Array("contact", "geo");
		timeout = setTimeout('', 1000);
		countrycodes = "fr";
		
		initDestTools("contact");
		initDestTools("geo");
		
		showDestInput("contact", "contact");
		showDestInput("geo", "ville");
		
		initScope(scope);
		initDataContact();
		
		//initialise la taille des champs de texte
		$("#input-group-contact").css({"width" : $("#btn-group-contact").width()});
		$("#input-group-geo").css({"width" : $("#btn-group-geo").width()});
	
	}
	
	function initScope(scope){
		//alert(JSON.stringify(scope));
		
		HASHTAGS_LIST = scope;
		//$("#hashtags_list_json").html(JSON.stringify(HASHTAGS_LIST));		
		
		$.each(HASHTAGS_LIST, function(){ //alert("value : "+JSON.stringify(this.scopeType));
			var ico = getIcoScope(this.scopeType);
			var display = this.at;
			if(this.scopeType == "ville") display = "ma ville";
			if(this.scopeType == "departement") display = "mon département";
			
			$("#hashtags_list").append("<span class='tag' id='idPlace"+this.id+"'><span><a href='javascript:removeHashtag(\""+this.id+"\")'>x </a> <i class='fa fa-"+ ico +"'></i> @" + display + "</span></span>");
		});
		
	}
	
	function initDataContact(){
			ajaxPost("", baseUrl + "/" + moduleId + '/news/initDataContact', null, //ShowMapByOrigine', params,
			function (data){ //alert(JSON.stringify(data));
				dataContact = data;
			});
	}
	
	
	// ------- INITIALISATION DES OUTILS DE SELECTION DES DESTINATAIRES / SCOPE (CONTACT + GEO)
	function initDestTools(type){
		$("#scope_news_"+type).focusout( function (){
			//$("#dropdown_"+type).css({"display" : "none" });
		});
		
		$("#scope_news_"+type).focus( function (){
			//$("#dropdown_"+type).css({"display" : "block" });
			
		});
		
		$("#scope_news_"+type).click( function (){
			if($("#scope_news_"+type).val() == "")
			$("#scope_news_"+type).val("@");
			if(type == "contact") findContact();
		});
		
		$("#scope_news_"+type).keyup( function (){
			var length = $("#scope_news_"+type).val().length;
			if(length == 0){
				$("#scope_news_"+type).val("@");
			}
			if(length <= 1){
				if($("#dropdown_"+type).css("display") != "none")
				$("#dropdown_"+type).css({"display" : "none" });
			}
			if(length == 1){
				//if($("#dropdown_"+type).css("display") != "block")
				//$("#dropdown_"+type).css({"display" : "block" });
				if(type == "contact") findContact();
			}
			if(length >= 3){
				//alert("lancement de la recherche en BD");	
				var action = "";
				if(type == "contact") 	action = "findContact()";
				if(type == "geo") 		action = "findPlace()";
				
				clearTimeout(timeout);
				timeout = setTimeout(action, 1000);
				//findPlace();
			}
			$("#btn_add_"+type).removeClass('btn-green').addClass('btn-blue');						
		});
		
		$("#select_state").change( function (){
			countrycodes = $("#select_state").val();
		});
	}	
	
	//ON CLICK BTN_GROUP type = CONTACT/GEO, val |= contact, groupe, tous, quartier, ville, departement, pays
	//CHOIX D'UN TYPE DE SCOPE
	function showDestInput(type, val){
	
		//raz champs texte
		$("#scope_news_" + type).val("");
		$("#scope_news_" + type).attr("placeholder", "@" + val);
		
		$("#btn_group_" + type + "_" + typeSelected[type]).removeClass('btn-blue').addClass('btn-default');
		$("#btn_group_" + type + "_" + val).removeClass('btn-default').addClass('btn-blue');
		
		//masque la dropdown
		if($("#dropdown_"+type).css("display") != "none"){
			$("#dropdown_"+type).css({"display" : "none" });
			$("#dropdown_"+type).html("<li class='li-dropdown-scope'>-</li>");
		}
		
		//desactive le bouton +
		//activateBtnAdd(false, type);
		
		//memorise le nouveau choix (dans le tableau qui correspond à Contact ou Geo (type))
		typeSelected[type] = val;
				
		if(type == "contact"){
			if(val == "contact"){
			}
			if(val == "groupe"){
			}
			if(val == "tous"){
			}
			
		}
		else if(type == "geo"){
			if(val == "quartier"){
			}
			if(val == "ville"){ //$("#scope_news_" + type).attr("placeholder", "@" + val + " (code postal)");
			}
			if(val == "departement"){ $("#scope_news_" + type).attr("placeholder", "@" + val + " (code postal)");		
			}
			if(val == "region"){ $("#scope_news_" + type).attr("placeholder", "@" + val + " (code postal / nom)");
			}
			if(val == "pays"){
			}
			
		}
	}
	
	//ON CLICK ELEMENT DROPDOWN
	function setChoice(value, type, placeId){
	
	
		//remplace le contenu du champs de texte
		$("#scope_news_" + type).val("@");
		
		//ferme la liste déroulante
		$("#dropdown_" + type).css({"display" : "none" });
		
		//idPlace[type] = placeId;
		//change la couleur du bouton + ("ajouter") en vert
		//activateBtnAdd(true, type);
	
		//récupère le contenu du champs de texte
		//var value = $("#scope_news_" + type).val(); //alert(value);
		
		//récupère l'icon correspondant au type de scope choisi (contact, groupe, departement, etc)
		var ico = getIcoScope(typeSelected[type]); //alert(ico);
		
		//memorise le hashtag
		if(type=="geo")
		HASHTAGS_LIST.push({	"scopeType" : typeSelected[type], 
								"at" : value, 
								"id" : placeId,
								"countrycodes" : countrycodes });
		if(type=="contact")
		HASHTAGS_LIST.push({	"scopeType" : typeSelected[type], 
								"at" : value, 
								"id" : placeId });
								
		//$("#hashtags_list_json").html(JSON.stringify(HASHTAGS_LIST));		
		//rajoute l'élément dans la liste des destinataires
		//$("#hashtags_list").append("<div class='label label-info'><i class='fa fa-"+ ico +"'></i> " + value + "</span>");
		$("#hashtags_list").append("<span class='tag' id='idPlace"+idPlace[type]+"'><span><a href='javascript:removeHashtag(\""+idPlace[type]+"\")'>x </a> <i class='fa fa-"+ ico +"'></i> " + value + "</span></span>");
		$("#scope_news_" + type).val("@");
		
		//activateBtnAdd(false, type);
	}
	
	
	function findPlace(){
	
		//récupère le contenu du champs de texte GEO
		var lieu = $("#scope_news_geo").val(); 
		lieu = lieu.substring(1, lieu.length); //supprime le @
	
		//récupère le type de scope choisi
		var type = typeSelected["geo"];
		
		//initialisation de la requete Nominatim
		var request = "";
		request += "limit=10";
		request += "&format=json";
	
		//limite la recherche par pays (sauf si le scope choisi est le pays)
		if(type != "pays") 
			request += "&countrycodes=" + countrycodes;
	
		var address = "";
		
		//si on cherche une ville
		if(type == "ville"){
			//si le lieu fourni est sous forme numérique : recherche par code postal
			if($.isNumeric(lieu)){ 
				if(lieu.length == 5)
				address += "&postalcode=" + lieu; 
				else address = "";
			} //si le lieu n'est pas numérique : recherche par nom de ville
			else { address += "&city=" + lieu; }
		}
	
		//si on cherche un département
		if(type == "departement"){
			//on utilise toujours le code numérique du département (pas de nom de dep)
			if($.isNumeric(lieu)){
				//l'utilisateur n'indique que 2 chiffres, on rajoute 3 zéro pour que la recherche fonctionne
				if(lieu.length == 2) lieu += "000";
				address += "&postalcode=" + lieu; 
			}
			//else { address += "&county=" + lieu; }
		}
	
		//si on cherche un département
		if(type == "region"){
			//on utilise toujours le code numérique du département (pas de nom de dep)
			if($.isNumeric(lieu)){
				//l'utilisateur n'indique que 2 chiffres, on rajoute 3 zéro pour que la recherche fonctionne
				if(lieu.length == 2) lieu += "000";
				address += "&postalcode=" + lieu; 
			}
			else { address += "&state=" + lieu;  }
		}
	
		//si on cherche un pays
		if(type == "pays") 
			address += "&country=" + lieu;//+"&state=" + lieu;
	
		//si la requette est vide, il y a eu un pb
		if(address == "") {
			if($("#dropdown_geo").css("display") != "block")
			$("#dropdown_geo").css({"display" : "block" });
			$("#dropdown_geo").html("<li class='li-dropdown-scope'>aucune recherche possible</li>");
			return;
		}
		
		request += address;
		
		//affiche le chargement en cours
		$("#dropdown_geo").html('<i class="fa fa-circle-o-notch fa-spin" style="padding:4px;"></i> Recherche en cours');
		if($("#dropdown_geo").css("display") != "block")
		$("#dropdown_geo").css({"display" : "block" });
		
		//requête auprès du service Nominatim
		$.ajax({
			url: "http://nominatim.openstreetmap.org/search?" + request + "&format=json&polygon=0&addressdetails=1",
			type: 'POST',
			complete: function () { },
			success: function (obj) { 	//alert(JSON.stringify(obj));
										//$("#hashtags_list").html(JSON.stringify(obj));
			if (obj.length > 0) {
			//initialise le contenu de la dropdown
			var dropdown_content = "";
				$.each(obj, 
				function() { //alert(request + " ");
				
					//cas du quartier à définir
					//if(type == "quartier")
					
					//cas ou on recherche une ville par son nom
					if(type == "ville")
					if(request.indexOf("city") > 0){ //alert(JSON.stringify(this));
						
						var cityName = "";
						var cp = "";
					
						//le nom de la ville peut être défini dans l'attribut Town ou City
						if(this.address.town != undefined)			{ cityName = this.address.town; }
						else if(this.address.city != undefined) 	{ cityName = this.address.city; }
						else if(this.address.hamlet != undefined) 	{ cityName = this.address.hamlet; 
																	  if(this.address.county != undefined)  cityName += ", " + this.address.county; 
																	}
					
						//on utilise le CP seulement s'il est unique, ex : 17100. 
						//Pour les grandes ville comme Marseille qui ont des arrondissements => 13001, 13002, etc, on utilise le nom de la ville
						if(this.address.postcode != undefined && this.address.postcode.length == 5) 
							 cp = this.address.postcode;
						else cp = cityName;
				
						var placeName = cp;
						if(cp != cityName) placeName += ", " + cityName;
					
						if(placeName != ""){// && this.address.postcode != undefined)
							var display = placeName+', '+this.address.state+', '+this.address.country_code;
							dropdown_content += getDropdownElement(display, "geo", this.place_id, display);
						}
					}
					//cas ou on recherche une ville par son Code Postal
					if(type == "ville")
					if(request.indexOf("postalcode") > 0){ //alert(JSON.stringify(this));
						var cityName = "";
						if(this.address.town != undefined) cityName = ', '+this.address.town;
						if(this.address.city != undefined) cityName = ', '+this.address.city;
						
						var display = this.address.postcode + cityName+', '+this.address.state+', '+this.address.country_code;					
						dropdown_content += getDropdownElement(display, "geo", this.place_id, display);	
					}
				
				
					if(type == "departement")
					if($.isNumeric(lieu)){
						if(lieu.length == 5){ //alert(JSON.stringify(this));
							var departementName = this.display_name;//getDepName(this.display_name);
							var display = departementName;					
							dropdown_content += getDropdownElement(lieu, "geo", this.place_id, display);	
						}
					} else {
							var display = this.address.county;					
							dropdown_content += getDropdownElement(lieu, "geo", this.place_id, display);	
					}
					
					if(type == "region"){
						//if($.isNumeric(lieu)){
							var display = this.address.state;					
							dropdown_content += getDropdownElement(display, "geo", this.place_id, display);
						//}
						//else { //alert(JSON.stringify(this)); 
							//var departementName = getDepName(this.display_name);
						//	var display = this.display_name;//getRegionName(this.display_name);					
						//	dropdown_content += getDropdownElement(display, "geo", this.place_id, display);	
						//}
					}
					
					if(type == "pays"){ 
						var state = "";
						if(this.address.country != undefined)
						if(lieu.toLowerCase() == this.address.country.toLowerCase()) state = this.address.country;
					
						if(this.address.state != undefined)
						if(lieu.toLowerCase() == this.address.state.toLowerCase()) state = this.address.state;
					
						if(state != ""){
							var display = state;					
							dropdown_content += getDropdownElement(state, "geo", this.place_id, display);	
						}
					}
				});
				$("#dropdown_geo").html(dropdown_content);
			}
			else {
				$("#dropdown_geo").html("<li class='li-dropdown-scope'>aucun résultat</li>");
			}
			},
			error: function (error) {
				$("#dropdown_geo").html("<li class='li-dropdown-scope'>Erreur</li>");
			}
		});
	}
	
	
	
	function findContact(){ //initDataContact();
		//récupère le contenu du champs de texte CONTACT
		var searchString = $("#scope_news_contact").val(); 
		searchString = searchString.substring(1, searchString.length); //supprime le @
	
		//récupère le type de scope choisi
		var type = typeSelected["contact"];
		var action = "searchContact";
		var dropdownContent = "";
		
		if(type != "groupe")
		dropdownContent += getDropdownElement("tous", "contact", "all_"+type, "tous");
			
		if(type == "contact"){	
			showContactLoading();
			$.each(dataContact["knows"], function(){ //alert("1 " +addslashes(this["name"])) ;
				var currentGroupName = this["name"];
				$.each(this["members"], function(){ //alert(addslashes("2 "+this["name"])) ;
					if( this["name"].toLowerCase().indexOf(searchString.toLowerCase()) >= 0 ){
						var display = this["name"];
						if(currentGroupName != "*") display += " (" + currentGroupName + ")";
						dropdownContent += getDropdownElement(this["name"], "contact", this["id"]["$id"], display);
					}
				});
			});	
			//alert(dropdownContent);
		}
		if(type == "groupe"){
			showContactLoading();
			$.each(dataContact["knows"], function(){ //alert("1 " +addslashes(this["name"])) ;
				var currentGroupName = this["name"];
					if( currentGroupName != "*")
					if( currentGroupName.toLowerCase().indexOf(searchString.toLowerCase()) >= 0){
						dropdownContent += getDropdownElement(currentGroupName, "contact", currentGroupName, currentGroupName);
					}
			});	
		}
		if(type == "organisation"){	
			showContactLoading();
			$.each(dataContact["organizations"], function(){ //alert(JSON.stringify(this)) ;
				if( this["name"].toLowerCase().indexOf(searchString.toLowerCase()) >= 0 )
				dropdownContent += getDropdownElement(this["name"], "contact", this["_id"]["$id"], this["name"]);
			});					
		}
		if(type == "tous"){ 
		}
		
		
		$("#dropdown_contact").html(dropdownContent);
		
	}
	
	//var genreSelected = "free_msg";
	function saveNews(){
		
		var name = $("#title_news").val();
		var text = $("#txt_news").html();
		
		//récupère les valeurs des checkbox "about"
		/*var about = new Array();
		for(var i=1;i<21;i++){
			if($("#chk_about_"+i).is(':checked'))
				about.push($("#chk_about_"+i).val());
		}*/
		
		
		//récupère la valeur du genre (radio btn) (free_msg, idea, true_information, rumor, question, help)
		var genre = genreSelected; 
		
		var news = { "name" : name,
					 "text" : text,
					 "genre" : genre,
					 "about" : aboutList,
					 "scope" : HASHTAGS_LIST
					};
		//alert(JSON.stringify(news));
		ajaxPost("", baseUrl + "/" + moduleId + '/news/saveNews', "json="+JSON.stringify(news), //ShowMapByOrigine', params,
			function (data){ 
				$("#hashtags_list_json").html("VOTRE MESSAGE A BIEN ÉTÉ PUBLIÉ</br>");// +  JSON.stringify(data));
				
			});
	}
	function openListGenre(genre){
		$("#").removeClass('btn-blue').addClass('btn-info');
		$("#btn_group_" + type + "_" + val).removeClass('btn-info').addClass('btn-blue');
		
	}
	
	function showContactLoading(){
		//affiche le chargement en cours
		$("#dropdown_contact").html('<i class="fa fa-circle-o-notch fa-spin" style="padding:4px;"></i> Recherche en cours');
		if($("#dropdown_contact").css("display") != "block")
		$("#dropdown_contact").css({"display" : "block" });
		
	}
	//retourne le nom du département à partir du display_name (après la 2eme virgule)
	function getDepName(display_name){ //alert(display_name);
		var depName = "";
		var x = 0;
		for(var i = 0; i<2; i++){
			x = display_name.indexOf(",", x+1); 
			//alert(x);
		}
		var x2 = display_name.indexOf(",", x+1); 
		depName = display_name.substring(x+2, x2);
		return depName;
	}
	//retourne le nom du département à partir du display_name (après la 3eme virgule)
	function getRegionName(display_name){ //alert(display_name);
		var depName = "";
		var x = 0;
		for(var i = 0; i<3; i++){
			x = display_name.indexOf(",", x+1); 
			//alert(x);
		}
		var x2 = display_name.indexOf(",", x+1); 
		depName = display_name.substring(x+1, x2);
		return depName;
	}
	
	function getIcoScope(value){
		return listIcoScope[value];
	}
	
	//retourne un élément de la dropdown
	function getDropdownElement(HTag, type, place_id, display_content){
		return '<li class="li-dropdown-scope">'+
				'<a class="item_dropdown" href="javascript:setChoice(\'@'+addslashes(HTag)+'\', \''+type+'\', \''+addslashes(place_id)+'\')">@'+display_content+'</a></li>';	
	}

	function removeHashtag(refId){
		$("#idPlace"+refId).remove();
		$.each(HASHTAGS_LIST, function(index){
			if(this.refId == refId) HASHTAGS_LIST.splice(index, 1);	
		});
		//$("#hashtags_list_json").html(JSON.stringify(HASHTAGS_LIST));
	}

	function addslashes(str) {
	  //  discuss at: http://phpjs.org/functions/addslashes/
	  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  // improved by: Ates Goral (http://magnetiq.com)
	  // improved by: marrtins
	  // improved by: Nate
	  // improved by: Onno Marsman
	  // improved by: Brett Zamir (http://brett-zamir.me)
	  // improved by: Oskar Larsson Högfeldt (http://oskar-lh.name/)
	  //    input by: Denny Wardhana
	  //   example 1: addslashes("kevin's birthday");
	  //   returns 1: "kevin\\'s birthday"

	  return (str + '')
		.replace(/[\\"']/g, '\\$&')
		.replace(/\u0000/g, '\\0');
	}

	
	/*
	
$note = $(".form-note .summernote");
$note.summernote({

oninit: function() {
if ($note.code() == "" || $note.code().replace(/(<([^>]+)>)/ig, "") == "") {
$note.code($note.attr("placeholder"));
}
}, onfocus: function(e) {
if ($note.code() == $note.attr("placeholder")) {
$note.code("");
}
}, onblur: function(e) {
if ($note.code() == "" || $note.code().replace(/(<([^>]+)>)/ig, "") == "") {
$note.code($note.attr("placeholder"));
}
}, onkeyup: function(e) {
$("span[for='noteEditor']").remove();
},


toolbar: [
['style', ['bold', 'italic', 'underline', 'clear']],
['color', ['color']],
['para', ['ul', 'ol', 'paragraph']],
]
});
};

	*/	