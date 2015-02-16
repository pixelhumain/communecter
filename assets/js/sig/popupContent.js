
	//##
	//création du contenu de la popup d'un citoyen
	function getPopupCitoyen(citoyen){
		
		var popupContent = "";
		if(citoyen['thumb_path'] != null)   
		popupContent += 	"<div class='popup-info-profil-thumb-lbl'><img src='" + citoyen['thumb_path'] + "' height=190 class='popup-info-profil-thumb'></div>";
		else
		popupContent += 	"<div class='popup-info-profil-thumb-lbl'><img src='"+assetPath+"/images/thumb/default.png' width=190 class='popup-info-profil-thumb'></div>";

		
		//NOM DE L'UTILISATEUR
		if(citoyen['name'] != null)   
		popupContent += 	"<div class='popup-info-profil-username'>" + citoyen['name'] + "</div>";

		//TYPE D'UTILISATEUR (CITOYEN, ASSO, PARTENAIRE, ETC)
		var typeName = citoyen['tag'];
		if(typeName == null)  typeName = "Citoyen";
		if(citoyen['name'] == null)  typeName += " Anonyme";

		popupContent += 	"<div class='popup-info-profil-usertype'>" + typeName + "</div>";

		//WORK - PROFESSION
		if(citoyen['work'] != null)     
		popupContent += 	"<div class='popup-info-profil-work'>" + citoyen['work'] + "</div>";
		else
		popupContent += 	"<div class='popup-info-profil-work'>Fleuriste</div>";
		
		//URL
		if(citoyen['url'] != null)     
		popupContent += 	"<div class='popup-info-profil-url'>" + citoyen['url'] + "</div>";
		else
		popupContent += 	"<a href='http://www.google.com' class='popup-info-profil-url'>http://www.google.com</a>";
		
		//CODE POSTAL
		//if(citoyen['cp'] != null)     
		//popupContent += 	"<div class='popup-info-profil'>" + citoyen['cp'] + "</div>";
		//else
		//popupContent += 	"<div class='popup-info-profil'>98800</div>";
		
		//VILLE ET PAYS
		var place = citoyen['city'];
		if(citoyen['city'] != null && citoyen['country'] != null) place += ", ";
		place += citoyen['country'];

		if(citoyen['city'] != null)     
		popupContent += 	"<div class='popup-info-profil'>" + place + "</div>";
		else
		popupContent += 	"<div class='popup-info-profil'>St-Denis, La Réunion</div>";
		
		//NUMÉRO DE TEL
		if(citoyen['phoneNumber'] != null)     
		popupContent += 	"<div class='popup-info-profil'>" + citoyen['phoneNumber'] + "<div/>";
		else
		popupContent += 	"<div class='popup-info-profil'>0123456789<div/>";
		
		return popupContent;
	}