
var indexStepInit = 30;
var indexStep = indexStepInit;
var currentIndexMin = 0;
var currentIndexMax = indexStep;
var scrollEnd = false;
var totalData = 0;

var timeout = null;
var searchType = '';

var translate = {"organizations":"Organisations",
                 "projects":"Projets",
                 "events":"Événements",
                 "people":"Citoyens",
                 "followers":"Ils nous suivent"};

function startSearch(indexMin, indexMax, callBack){
    console.log("startSearch", typeof callBack, callBack);
    if(loadingData) return;
    loadingData = true;
    
    //mylog.log("loadingData true");
    indexStep = indexStepInit;

    mylog.log("startSearch", indexMin, indexMax, indexStep);

	  var name = ($('#searchBarText').length>0) ? $('#searchBarText').val() : "";
    
    if(name == "" && searchType.indexOf("cities") > -1) return;  

    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;

    currentIndexMin = indexMin;
    currentIndexMax = indexMax;

    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array(); 
    }
    else{ if(scrollEnd) return; }
    
    if(name.length>=3 || name.length == 0)
    {
      var locality = "";
      if( communexionActivated )
      {
  	    if(typeof(cityInseeCommunexion) != "undefined")
        {
    			if(levelCommunexion == 1) locality = cpCommunexion;
    			if(levelCommunexion == 2) locality = inseeCommunexion;
    		}else{
    			if(levelCommunexion == 1) locality = inseeCommunexion;
    			if(levelCommunexion == 2) locality = cpCommunexion;
    		}
        //if(levelCommunexion == 3) locality = cpCommunexion.substr(0, 2);
        if(levelCommunexion == 3) locality = inseeCommunexion;
        if(levelCommunexion == 4) locality = inseeCommunexion;
        if(levelCommunexion == 5) locality = "";
      } 
      autoCompleteSearch(name, locality, indexMin, indexMax, callBack);
    }  
}


function addSearchType(type){
  $.each(allSearchType, function(key, val){
    removeSearchType(val);
  });

  var index = searchType.indexOf(type);
  if (index == -1) {
    searchType.push(type);
    //$(".search_"+type).removeClass("active"); //fa-circle-o");
    $(".search_"+type).addClass("active"); //fa-check-circle-o");
  }
}


function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1 && searchType.length > 1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("active"); //fa-check-circle-o");
    //$(".search_"+type).addClass("fa-circle-o");
  }
}

var loadingData = false;
var mapElements = new Array(); 


function autoCompleteSearch(name, locality, indexMin, indexMax, callBack){
  console.log("autoCompleteSearch", typeof callBack, callBack);
	if(typeof(cityInseeCommunexion) != "undefined"){
	    var levelCommunexionName = { 1 : "CODE_POSTAL_INSEE",
	                             2 : "INSEE",
	                             3 : "DEPARTEMENT",
	                             4 : "REGION"
	                           };
	}else{
		var levelCommunexionName = { 1 : "INSEE",
	                             2 : "CODE_POSTAL_INSEE",
	                             3 : "DEPARTEMENT",
	                             4 : "REGION"
	                           };
	}
    //mylog.log("levelCommunexionName", levelCommunexionName[levelCommunexion]);
    var data = {
      "name" : name, 
      "locality" : "",//locality, 
      "searchType" : searchType, 
      "searchTag" : ($('#searchTags').length ) ? $('#searchTags').val().split(',') : [] , //is an array
      "searchLocalityCITYKEY" : ($('#searchLocalityCITYKEY').length ) ? $('#searchLocalityCITYKEY').val().split(',') : [],
      "searchLocalityCODE_POSTAL" : ($('#searchLocalityCODE_POSTAL').length ) ? $('#searchLocalityCODE_POSTAL').val().split(',') : [], 
      "searchLocalityDEPARTEMENT" : ($('#searchLocalityDEPARTEMENT').length ) ?  $('#searchLocalityDEPARTEMENT').val().split(',') : [],
      "searchLocalityREGION" : ($('#searchLocalityREGION').length ) ? $('#searchLocalityREGION').val().split(',') : [],
      "searchBy" : levelCommunexionName[levelCommunexion], 
      "indexMin" : indexMin, 
      "indexMax" : indexMax  };
				
    loadingData = true;
    
    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    $(".btn-start-search").removeClass("bg-dark");
    
    if(indexMin > 0)
      $("#btnShowMoreResult").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
      $("#dropdown_search").html("<span class='search-loader text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span>");
      
    if(isMapEnd)
      $.blockUI({
        message : "<h3 class='text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></h3>"
      });
   
    $.ajax({
        type: "POST",
        url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
        data: data,
        dataType: "json",
        error: function (data){
             mylog.log("error autocomplete search"); mylog.dir(data);     
             //signal que le chargement est terminé
            loadingData = false;     
        },
        success: function(data){ mylog.log("success autocomplete search"); //mylog.dir(data);
            if(!data){ toastr.error(data.content); }
            else
            {
              var countData = 0;
            	$.each(data, function(i, v) { if(v.length!=0){ countData++; } });
              
              totalData += countData;
            
              str = "";
              var city, postalCode = "";

              //parcours la liste des résultats de la recherche
              //mylog.dir(data);
              str = directory.showResultsDirectoryHtml(data);
              
              if(str == "") { 
	              $.unblockUI();
	              showMap(false);
                  $(".btn-start-search").html("<i class='fa fa-refresh'></i>"); 
                  if(indexMin == 0){
                    //ajout du footer   
                    var msg = "<i class='fa fa-ban'></i> Aucun résultat";    
                    if(name == "" && locality == "") msg = "<h3 class='text-dark padding-20'><i class='fa fa-keyboard-o'></i> Préciser votre recherche pour plus de résultats ...</h3>"; 
                    str += '<div class="pull-left col-md-12 text-left" id="footerDropdown" style="width:100%;">';
                    str += "<hr style='float:left; width:100%;'/><h3 style='margin-bottom:10px; margin-left:15px;' class='text-dark'>"+msg+"</h3><br/>";
                    str += "</div>";
                    $("#dropdown_search").html(str);
                    $("#searchBarText").focus();
                  }
                     
              }
              else
              {       
                //ajout du footer      	
                str += '<div class="pull-left col-md-12 text-center" id="footerDropdown" style="width:100%;">';
                str += "<hr style='float:left; width:100%;'/><h3 style='margin-bottom:10px; margin-left:15px;' class='text-dark'>" + totalData + " résultats</h3><br/>";
                str += '<button class="btn btn-default" id="btnShowMoreResult"><i class="fa fa-angle-down"></i> Afficher plus de résultat</div></center>';
                str += "</div>";

                //si on n'est pas sur une première recherche (chargement de la suite des résultat)
                if(indexMin > 0){
                    //on supprime l'ancien bouton "afficher plus de résultat"
                    $("#btnShowMoreResult").remove();
                    //on supprimer le footer (avec nb résultats)
                    $("#footerDropdown").remove();

                    //on calcul la valeur du nouveau scrollTop
                    var heightContainer = $(".my-main-container")[0].scrollHeight - 180;
                    //on affiche le résultat à l'écran
                    $("#dropdown_search").append(str);
                    //on scroll pour afficher le premier résultat de la dernière recherche
                    $(".my-main-container").animate({"scrollTop" : heightContainer}, 1700);
                    //$(".my-main-container").scrollTop(heightContainer);

                //si on est sur une première recherche
                }else{
                    //on affiche le résultat à l'écran
                    $("#dropdown_search").html(str);

                    if(typeof myMultiTags != "undefined"){
                    $.each(myMultiTags, function(key, value){ //mylog.log("binding bold "+key);
                      $("[data-tag-value='"+key+"'].btn-tag").addClass("bold");
                    });
                    }
                  
                  //on scroll pour coller le haut de l'arbre au menuTop
                  //$(".my-main-container").scrollTop(95);
                }
                //remet l'icon "loupe" du bouton search
                $(".btn-start-search").html("<i class='fa fa-refresh'></i>");
                //active les link lbh
                bindLBHLinks();

                $.unblockUI();
				        //showMap(false);
                
                //active le chargement de la suite des résultat au survol du bouton "afficher plus de résultats"
                //(au cas où le scroll n'ait pas lancé le chargement comme prévu)
               	//$("#btnShowMoreResult").mouseenter(function(){
                  // if(!loadingData){
                  //   startSearch(indexMin+indexStep, indexMax+indexStep);
                  //   $("#btnShowMoreResult").mouseenter(function(){});
                  // }
                //});
                
                //initialise les boutons pour garder une entité dans Mon répertoire (boutons links)
                initBtnLink();

                

    	        } //end else (str=="")

              //signal que le chargement est terminé
              loadingData = false;

              //quand la recherche est terminé, on remet la couleur normal du bouton search
    	        $(".btn-start-search").removeClass("bg-azure");
        	  }

            //mylog.log("scrollEnd ? ", scrollEnd, indexMax, countData , indexMin);
            //si le nombre de résultat obtenu est inférieur au indexStep => tous les éléments ont été chargé et affiché
            //mylog.log("SHOW MORE ?", indexMax, indexMin, indexMax - indexMin, countData);
            mylog.log("SHOW MORE ?", countData, indexStep);
            //if(indexMax - countData > indexMin){ 
            if(countData < indexStep){
              $("#btnShowMoreResult").remove(); 
              scrollEnd = true;
            }else{
              scrollEnd = false;
            }

            if(typeof showResultInCalendar != "undefined")
              showResultInCalendar(mapElements);

            //affiche les éléments sur la carte
            if(CoSigAllReadyLoad)
            Sig.showMapElements(Sig.map, mapElements);
            else{
              setTimeout(function(){ 
                Sig.showMapElements(Sig.map, mapElements);
              }, 4000);
            }
            

            if(typeof callBack == "function")
                callBack();
        }
    });


  }


  function initBtnLink(){ mylog.log("initBtnLink");
      
    $('.tooltips').tooltip();
  	//parcours tous les boutons link pour vérifier si l'entité est déjà dans mon répertoire
  	$.each( $(".followBtn"), function(index, value){
    	var id = $(value).attr("data-id");
   		var type = $(value).attr("data-type");
      mylog.log("error type :", type);
   		if(type == "person") type = "people";
   		else type = typeObj[type].col;
      //mylog.log("#floopItem-"+type+"-"+id);
   		if($("#floopItem-"+type+"-"+id).length){
   			//mylog.log("I FOLLOW THIS");
   			if(type=="people"){
	   			$(value).html("<i class='fa fa-unlink text-green'></i>");
	   			$(value).attr("data-original-title", "Ne plus suivre cette personne");
	   			$(value).attr("data-ownerlink","unfollow");
   			}
   			else{
	   			$(value).html("<i class='fa fa-user-plus text-green'></i>");
	   			
          if(type == "organizations")
	   				$(value).attr("data-original-title", "Vous êtes membre de cette organization");
	   			else if(type == "projects")
	   				$(value).attr("data-original-title", "Vous êtes contributeur de ce projet");
	   			
          //(value).attr("onclick", "");
	   			$(value).removeClass("followBtn");
	   		}
   		}
   		if($(value).attr("data-isFollowed")=="true"){

	   		$(value).html("<i class='fa fa-unlink text-green'></i>");
	   		$(value).attr("data-original-title", (type == "events") ? "Ne plus participer" : "Ne plus suivre" );
			  $(value).attr("data-ownerlink","unfollow");
        $(value).addClass("followBtn");
   		}
   	});

  	//on click sur les boutons link
   	$(".followBtn").click(function(){
	   	formData = new Object();
   		formData.parentId = $(this).attr("data-id");
   		formData.childId = userId;
   		formData.childType = personCOLLECTION;
   		var type = $(this).attr("data-type");
   		var name = $(this).attr("data-name");
   		var id = $(this).attr("data-id");
   		//traduction du type pour le floopDrawer
   		var typeOrigine = typeObj[type].col;
      if(typeOrigine == "persons"){ typeOrigine = personCOLLECTION;}
   		formData.parentType = typeOrigine;
   		if(type == "person") type = "people";
   		else type = typeObj[type].col;

		var thiselement = this;
		$(this).html("<i class='fa fa-spin fa-circle-o-notch text-azure'></i>");
		//mylog.log(formData);
    var linkType = (type == "events") ? "connect" : "follow";
		if ($(this).attr("data-ownerlink")=="follow"){
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/"+linkType,
				data: formData,
				dataType: "json",
				success: function(data) {
					if(data.result){
						toastr.success(data.msg);	
						$(thiselement).html("<i class='fa fa-unlink text-green'></i>");
						$(thiselement).attr("data-ownerlink","unfollow");
						$(thiselement).attr("data-original-title", (type == "events") ? "Ne plus participer" : "Ne plus suivre");
						addFloopEntity(id, type, data.parentEntity);
					}
					else
						toastr.error(data.msg);
				},
			});
		} else if ($(this).attr("data-ownerlink")=="unfollow"){
			formData.connectType =  "followers";
			//mylog.log(formData);
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/disconnect",
				data : formData,
				dataType: "json",
				success: function(data){
					if ( data && data.result ) {
						$(thiselement).html("<i class='fa fa-chain'></i>");
						$(thiselement).attr("data-ownerlink","follow");
						$(thiselement).attr("data-original-title", (type == "events") ? "Participer" : "Suivre");
						removeFloopEntity(data.parentId, type);
						toastr.success(trad["You are not following"]+data.parentEntity.name);
					} else {
					   toastr.error("You leave succesfully");
					}
				}
			});
		}
   	});
   	//on click sur les boutons link
    $(".btn-tag").click(function(){
      setSearchValue($(this).html());
    });
  }



  function setSearchValue(value){
    $("#searchBarText").val(value);
    startSearch(0, indexStepInit);
  }

  
  
function searchCallback() { 
  directory.elemClass = '.searchEntityContainer ';
  directory.filterTags(true);
  $(".btn-tag").off().on("click",function(){ directory.toggleEmptyParentSection(null,"."+$(this).data("tag-value"), directory.elemClass, 1)});
  $("#searchBarTextJS").off().on("keyup",function() { 
    directory.search ( null, $(this).val() );
  });
}

var directory = {

    elemClass : smallMenu.destination+' .searchEntityContainer ',
    path : 'div'+smallMenu.destination+' div.favSection',
    tagsT : [],
    scopesT :[],
    multiTagsT : [],
    multiScopesT :[],

    showResultsDirectoryHtml : function ( data, contentType, size ){ //size == null || min || max
      mylog.log("-----------showResultsDirectoryHtml",data, contentType, size)
        var str = "";

        if(typeof data == "object" && data!=null)
        $.each(data, function(i, o) {
            itemType=(contentType) ? contentType :o.type;
            if( itemType )
            {
              //mylog.log("showResultsDirectoryHtml", o);
              var typeIco = i;
              
              mapElements.push(o);

              if(typeof(typeObj[itemType]) == "undefined")
                itemType="poi";
              typeIco = itemType;

              if(typeof(o.typeOrga) != "undefined")
                typeIco = o.typeOrga;

              var ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
              var color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
              var parentIcon = ("undefined" != typeof mapIconTop[o.parentType]) ? mapIconTop[o.parentType] : mapIconTop["default"];
              var parentColor = ("undefined" != typeof mapColorIconTop[o.parentType]) ? mapColorIconTop[o.parentType] : mapColorIconTop["default"];
              
             // var urlImg = "/upload/communecter/color.jpg";
             // o.profilImageUrl = urlImg;
             var useMinSize = typeof size != "undefined" && size == "min";
                var imgProfil = ""; 
                if(!useMinSize)
                  imgProfil = "<i class='fa fa-image fa-2x'></i>";
                
                if("undefined" != typeof o.profilImageUrl && o.profilImageUrl != ""){
                  imgProfil= "<img class='img-responsive' src='"+baseUrl+o.profilImageUrl+"'/>";
                }
                if(typeObj[itemType] && typeObj[itemType].col == "poi" && typeof o.medias != "undefined" && typeof o.medias[0].content.image != "undefined")
                  imgProfil= "<img class='img-responsive' src='"+o.medias[0].content.image+"'/>";
                
                var htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
              

              // if("undefined" != typeof o.profilImageUrl && o.profilImageUrl != ""){
              //   htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilImageUrl+"'/>"
              // }

              city="";

              var postalCode = "";
              if (o.address != null) {
                city = o.address.addressLocality;
                postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
              }
              
              //mylog.dir(o);
              var id = getObjectId(o);
              var insee = o.insee ? o.insee : "";
              mylog.log(itemType);
              type = typeObj[itemType].col;
              // var url = "javascript:"; // baseUrl+'/'+moduleId+ "/default/simple#" + type + ".detail.id." + id;
              //type += "s";

                var urlParent = (notEmpty(o.parentType) && notEmpty(o.parentId)) ? 
                              '#element.detail.type.'+o.parentType+'.id.' + o.parentId : "";

              var url = '#element.detail.type.'+type+'.id.' + id;
              if(type == "citoyens") url += '.viewer.' + userId;

              if(typeof globalTheme != "undefined" && globalTheme=="CO2")
                url = '#co2.page.type.'+type+'.id.' + id;

              //else if(type == "poi")    url = '#element.detail.type.poi.id.' + id;
              else if(type == "cities") url = "#city.detail.insee."+o.insee+".postalCode."+o.cp;
              else if(type == "surveys") url = "#survey.entry.id."+id;
              else if(type == "actions") url = "#rooms.action.id."+id;

              //if(type=="citoyen") type = "person";
             
              var onclick = 'loadByHash("' + url + '");';

              var onclickCp = "";
              var target = " target='_blank'";
              var dataId = "";
              if(type == "city"){
                url = "javascript:"; //#main-col-search";
                onclick = 'setScopeValue($(this))'; //"'+o.name.replace("'", "\'")+'");';
                onclickCp = 'setScopeValue($(this));';
                target = "";
                dataId = o.name; //.replace("'", "\'");
              }

              var tags = "";
              var elTagsList = "";
              if(typeof o.tags != "undefined" && o.tags != null){
                $.each(o.tags, function(key, value){
                  if(value != ""){
                    tags +=   "<a href='javascript:' class='badge bg-transparent text-red btn-tag tag' data-tag-value='"+slugify(value)+"'>#" + value + "</a> ";
                    elTagsList += slugify(value)+" ";
                  }

                });
              }

              var name = notEmpty(o.name) ? o.name : "";

              var address = notEmpty(o.address) ? o.address : "";

              var postalCode = notEmpty(address) && notEmpty(address.postalCode) ? address.postalCode : "";
              if(postalCode == "") postalCode = notEmpty(o.cp) ? o.cp : "";
              
              var cityName = notEmpty(address) && notEmpty(address.addressLocality) ? address.addressLocality : "";


              var fullLocality = postalCode + " " + cityName;

              var description = notEmpty(o.shortDescription) ? o.shortDescription : "";
              //if(description == "") description = (notEmpty(o.description)) ? o.description : "";
              if(description == "") description = (notEmpty(o.message)) ? o.message : "";
       
              //mylog.dir(o);
              //mylog.log(typeof o.startDate);
              //console.log("/////////////////////////// directory.js",o);
              //moment.locale("fr");
              var startDate = notEmpty(o.startDate) ? moment(o.startDate).local().locale("fr").format("DD MMMM YYYY - HH:mm") : null;
              var endDate   = notEmpty(o.endDate) ? moment(o.endDate).local().locale("fr").format("DD MMMM YYYY - HH:mm") : null;
              
              if(type!="surveys" && type!="actions"){
                startDate = notEmpty(startDate) ? "Du " + startDate : startDate;
                endDate = notEmpty(endDate) ? "Au " + endDate : endDate;
              }
              else{                   
                startDate = notEmpty(startDate) ? "Du " + startDate : startDate;
                endDate = notEmpty(endDate) ? "jusqu'au " + endDate : endDate;
              }

              var updated   = notEmpty(o.updatedLbl) ? o.updatedLbl : null; 
              
              //template principal
              str += "<div class='col-lg-4 col-md-6 col-sm-6 col-xs-12 searchEntityContainer "+type+" "+elTagsList+" '>";
              str +=    "<div class='searchEntity'>";

              if(itemType!="city" && (useMinSize))
                  str += "<div class='imgHover'>" + imgProfil + "</div>"+
                          "<div class='contentMin'>";

                if(userId != null){
                        isFollowed=false;
                        if(typeof o.isFollowed != "undefined" ) isFollowed=true;
                        if(type!="cities" && type!="poi" && type!="surveys" && type!="actions" && id != userId && userId != null && userId != ""){
                          tip = (type == "events") ? "Participer" : 'Suivre';
                          str += "<a href='javascript:;' class='btn btn-default btn-sm btn-add-to-directory bg-white tooltips followBtn'" + 
                                'data-toggle="tooltip" data-placement="left" data-original-title="'+tip+'"'+
                                " data-ownerlink='follow' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"' data-isFollowed='"+isFollowed+"'>"+
                                    "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                                  "</a>";
                        }
                      }


                  if(updated != null && !useMinSize)
                    str += "<div class='dateUpdated'><i class='fa fa-flash'></i> <span class='hidden-xs'>actif </span>" + updated + "</div>";

                  if(itemType!="city" && (typeof size == "undefined" || size == "max"))
                    str += "<a href='"+url+"' class='container-img-profil lbh add2fav'>" + imgProfil + "</a>";

                  str += "<div class='padding-10 informations'>";


                  if(!useMinSize){
                    if(startDate != null)
                    str += "<div class='entityDate dateFrom bg-"+color+" transparent badge'>" + startDate + "</div>";
                    if(endDate != null)
                    str += "<div  class='entityDate dateTo  bg-"+color+" transparent badge'>" + endDate + "</div>";
                    
                    if(typeof size == "undefined" || size == "max"){
                      str += "<div class='entityCenter no-padding'>";
                      str +=    "<a href='"+url+"' class='lbh add2fav'>" + htmlIco + "</a>";
                      str += "</div>";
                    }
                  }  
                      
                    str += "<div class='entityRight no-padding'>";
                                     
                      
                    if(notEmpty(o.parent) && notEmpty(o.parent.name))
                      str += "<a href='"+urlParent+"' class='entityName text-"+parentColor+" lbh add2fav text-light-weight margin-bottom-5'>" +
                                "<i class='fa "+parentIcon+"'></i> "
                                + o.parent.name + 
                              "</a>";

                    var iconFaReply = notEmpty(o.parent) ? "<i class='fa fa-reply fa-rotate-180'></i> " : "";
                    str += "<a  href='"+url+"' class='"+size+" entityName text-dark lbh add2fav'>"+
                              iconFaReply + name + 
                           "</a>";
                    
                    var thisLocality = "";
                    if(fullLocality != "" && fullLocality != " ")
                         thisLocality = "<a href='"+url+'\' data-id="' + dataId + '"' + "  class='entityLocality lbh add2fav'>"+
                                          "<i class='fa fa-home'></i> " + fullLocality + 
                                        "</a>";
                    else thisLocality = "<br>";
                    
                    //debat / actions
                    if(notEmpty(o.parentRoom)){
                      parentUrl = "";
                      parentIco = "";
                      if(type == "surveys"){ parentUrl = "#survey.entries.id."+o.survey; parentIco = "archive"; }
                      else if(type == "actions") {parentUrl = "#rooms.actions.id."+o.room;parentIco = "cogs";}
                      str += "<div class='entityDescription text-dark'><i class='fa fa-" + parentIco + "'></i><a href='" + parentUrl + "' class='lbh add2fav'> " + o.parentRoom.name + "</a></div>";
                      if(notEmpty(o.parentRoom.parentObj)){
                        var typeIcoParent = o.parentRoom.parentObj.typeSig;
                        //mylog.log("typeIcoParent", o.parentRoom);
                        var icoParent = ("undefined" != typeof mapIconTop[typeIcoParent]) ? mapIconTop[typeIcoParent] : mapIconTop["default"];
                        var colorParent = ("undefined" != typeof mapColorIconTop[typeIcoParent]) ? mapColorIconTop[typeIcoParent] : mapColorIconTop["default"];
                        

                        var thisLocality = notEmpty(o.parentRoom) && notEmpty(o.parentRoom.parentObj) && 
                                      notEmpty(o.parentRoom.parentObj.address) ? 
                                      o.parentRoom.parentObj.address : null;

                        var postalCode = notEmpty(thisLocality) && notEmpty(thisLocality.postalCode) ? thisLocality.postalCode : "";
                        var cityName = notEmpty(thisLocality) && notEmpty(thisLocality.addressLocality) ? thisLocality.addressLocality : "";

                        thisLocality = postalCode + " " + cityName;
                        if(thisLocality != " ") thisLocality = ", <small> " + thisLocality + "</small>";
                        else thisLocality = "";

                        var ctzCouncil = typeIcoParent=="city" ? "Conseil citoyen de " : "";
                        str += "<div class='entityDescription text-"+colorParent+"'> <i class='fa "+icoParent+"'></i> <b>" + ctzCouncil + o.parentRoom.parentObj.name + "</b>" + thisLocality+ "</div>";
                      

                      }
                    }else{
                      str += thisLocality;
                    }
                    
                    
                    if(itemType == "entry"){
                      var vUp   = notEmpty(o.voteUpCount)       ? o.voteUpCount.toString()        : "0";
                      var vMore = notEmpty(o.voteMoreInfoCount) ? o.voteMoreInfoCount.toString()  : "0";
                      var vAbs  = notEmpty(o.voteAbstainCount)  ? o.voteAbstainCount.toString()   : "0";
                      var vUn   = notEmpty(o.voteUnclearCount)  ? o.voteUnclearCount.toString()   : "0";
                      var vDown = notEmpty(o.voteDownCount)     ? o.voteDownCount.toString()      : "0";
                      str += "<div class='pull-left margin-bottom-10 no-padding'>";
                        str += "<span class='bg-green lbl-res-vote'><i class='fa fa-thumbs-up'></i> " + vUp + "</span>";
                        str += " <span class='bg-blue lbl-res-vote'><i class='fa fa-pencil'></i> " + vMore + "</span>";
                        str += " <span class='bg-dark lbl-res-vote'><i class='fa fa-circle'></i> " + vAbs + "</span>";
                        str += " <span class='bg-purple lbl-res-vote'><i class='fa fa-question-circle'></i> " + vUn + "</span>";
                        str += " <span class='bg-red lbl-res-vote'><i class='fa fa-thumbs-down'></i> " + vDown + "</span>";
                      str += "</div>";
                    }

                    str += "<div class='entityDescription'>" + description + "</div>";
                 
                    str += "<div class='tagsContainer text-red'>"+tags+"</div>";

                    if(useMinSize){
                      if(startDate != null)
                      str += "<div class='entityDate dateFrom bg-"+color+" transparent badge'>" + startDate + "</div>";
                      if(endDate != null)
                      str += "<div  class='entityDate dateTo  bg-"+color+" transparent badge'>" + endDate + "</div>";
                      
                      if(typeof size == "undefined" || size == "max"){
                        str += "<div class='entityCenter no-padding'>";
                        str +=    "<a href='"+url+"' class='lbh add2fav'>" + htmlIco + "</a>";
                        str += "</div>";
                      }
                    }  

                if(o.type!="city" && (useMinSize))
                  str += "</div>";
                  str += "</div>";
                str += "</div>";
              str += "</div>";

                
                          
              str += "</div>";
          }
        }); //end each
        return str;
    },

    //builds a small sized list
    buildList : function(list) {
      $(".favSectionBtnNew,.favSection").remove();

      $.each( list, function(key,list)
      {
        var subContent = directory.showResultsDirectoryHtml ( list, key /*,"min"*/); //min == dark template 
        if( notEmpty(subContent) ){
          favTypes.push(typeObj[key].col);
          
          var color = (typeObj[key] && typeObj[key].color) ? typeObj[key].color : "dark";
          var icon = (typeObj[key] && typeObj[key].icon) ? typeObj[key].icon : "circle";
          $(smallMenu.destination + " #listDirectory").append("<div class='"+typeObj[key].col+"fav favSection '>"+
                                            "<div class=' col-xs-12 col-sm-12'>"+
                                            "<h4 class='text-left text-"+color+"'><i class='fa fa-angle-down'></i> "+trad[key]+"</h4><hr>"+
                                            subContent+
                                            "</div>");
          $(".sectionFilters").append(" <a class='text-black btn btn-default favSectionBtn favSectionBtnNew  bg-"+color+"'"+
                                      " href='javascript:directory.showAll(\".favSection\",directory.elemClass);toggle(\"."+typeObj[key].col+"fav\",\".favSection\",1)'> "+
                                          "<i class='fa fa-"+icon+" fa-2x'></i><br>"+trad[key]+
                                        "</a>");
        }
      });

      initBtnLink();
      bindLBHLinks();
      directory.filterList();
      $(directory.elemClass).show();
      //bindTags();
    },

    //build list of unique tags based on a directory structure
    //on click hides empty parent sections
    filterList : function  (elClass,dest) { 
        directory.tagsT = [];
        directory.scopesT = [];
        $("#listTags").html("");
        $("#listScopes").html("<h4><i class='fa fa-angle-down'></i> Où</h4>");
        mylog.log("tagg", directory.elemClass);
        $.each($(directory.elemClass),function(k,o){
          
          var oScope = $(o).find(".entityLocality").text();
          //mylog.log("tags count",$(o).find(".btn-tag").length);
          $.each($(o).find(".btn-tag"),function(i,oT){
            var oTag = $(oT).data('tag-value');
            if( notEmpty( oTag ) && !inArray( oTag,directory.tagsT ) ){
              directory.tagsT.push(oTag);
              $("#listTags").append("<a class='btn btn-xs btn-link btn-anc-color-blue text-left w100p favElBtn "+slugify(oTag)+"Btn' data-tag='"+slugify(oTag)+"' href='javascript:directory.toggleEmptyParentSection(\".favSection\",\"."+slugify(oTag)+"\",directory.elemClass,1)'><i class='fa fa-tag'></i> "+oTag+"</a><br/>");
            }
          });
          if( notEmpty( oScope ) && !inArray( oScope,directory.scopesT ) ){
            directory.scopesT.push(oScope);
            $("#listScopes").append("<a class='btn btn-xs btn-link btn-anc-color-blue text-left w100p favElBtn "+slugify(oScope)+"Btn' href='javascript:directory.searchFor(\""+oScope+"\")'><i class='fa fa-map-marker'></i> "+oScope+"</a><br/>");
          }
        })
        //mylog.log("tags count", directory.tagsT.length, directory.scopesT.length);
    },

    //todo add count on each tag
    filterTags : function (withSearch,open) 
    { 
        directory.tagsT = [];
        $("#listTags").html('');
        if(withSearch){
            $("#listTags").append("<h5 class=''><i class='fa fa-search'></i> Filtrer</h5>");
            $("#listTags").append('<input id="searchBarTextJS" data-searchPage="true" type="text" class="input-search form-control">');
        }
       // alert(directory.elemClass);
       // $("#listTags").append("<h4 class=''> <i class='fa fa-tags'></i> trier </h4>");
        $("#listTags").append("<a class='btn btn-anc-color-blue favElBtn favAllBtn' href='javascript:directory.toggleEmptyParentSection(\".favSection\",null,directory.elemClass,1)'> <b>Tout voir</b> </a><br/>");
        $.each( $(directory.elemClass),function(k,o){
            $.each($(o).find(".btn-tag"),function(i,oT){
                var oTag = $(oT).data('tag-value').toLowerCase();
                if( notEmpty( oTag ) && !inArray( oTag,directory.tagsT ) ){
                  directory.tagsT.push(oTag);
                  //mylog.log(oTag);
                  $("#listTags").append("<a class='btn btn-link favElBtn btn-anc-color-blue "+slugify(oTag)+"Btn' "+
                                            "data-tag='"+slugify(oTag)+"' "+
                                            "href='javascript:directory.toggleEmptyParentSection(\".favSection\",\"."+slugify(oTag)+"\",directory.elemClass,1)'>"+
                                              "#"+oTag+
                                        "</a><br> ");
                }
            });
        });
        if( directory.tagsT.length && open ){
            directory.showFilters();
        }
        //$("#btn-open-tags").append("("+$(".favElBtn").length+")");
    },
    
    showFilters : function () { 
      if($("#listTags").hasClass("hide")){
        $("#listTags").removeClass("hide");
        $("#dropdown_search").removeClass("col-md-offset-1");
      }else{
        $("#listTags").addClass("hide");
        $("#dropdown_search").addClass("col-md-offset-1");
      }
      $("#listTags").removeClass("hide");
      $("#dropdown_search").removeClass("col-md-offset-1");
    },

    addMultiTagsAndScope : function() { 
      directory.multiTagsT = [];
      directory.multiScopesT = [];
      $.each(myMultiTags,function(oTag,oT){
        if( notEmpty( oTag ) && !inArray( oTag,directory.multiTagsT ) ){
          directory.multiTagsT.push(oTag);
          //mylog.log(oTag);
          $("#listTags").append("<a class='btn btn-xs btn-link btn-anc-color-blue  text-left w100p favElBtn "+slugify(oTag)+"Btn' data-tag='"+slugify(oTag)+"' href='javascript:directory.searchFor(\"#"+oTag+"\")'><i class='fa fa-tag'></i> "+oTag+"</a><br/>");
        }
      });
      $.each(myMultiScopes,function(oScope,oT){
        var oScope = oT.name;
        if( notEmpty( oScope ) && !inArray( oScope,directory.multiScopesT ) ){
          directory.multiScopesT.push(oScope);
          $("#listScopes").append("<a class='btn btn-xs btn-link text-white text-left w100p favElBtn "+slugify(oScope)+"Btn' data-tag='"+slugify(oScope)+"' href='javascript:directory.searchFor(\""+oScope+"\")'><i class='fa fa-tag'></i> "+oScope+"</a><br/>");
        }
      });
    },

    //show hide parents when empty
    toggleEmptyParentSection : function ( parents ,tag ,children ) { 
        mylog.log("toggleEmptyParentSection('"+parents+"','"+tag+"','"+children+"')");
        var showAll = true;
        if(tag){
          $(".favAllBtn").removeClass("active");
          //apply tag filtering
          $(tag+"Btn").toggleClass("btn-link text-white").toggleClass("active text-white");

          if( $( ".favElBtn.active" ).length > 0 ) 
          {
            showAll = false;
            tags = "";
            $.each( $( ".favElBtn.active" ) ,function( i,o ) { 
              tags += "."+$(o).data("tag")+",";
            });
            tags = tags.replace(/,\s*$/, "");
            mylog.log(tags)
            toggle(tags,children,1);
            
            directory.toggleParents(directory.elemClass);
          }
        }
        
        if( showAll )
          directory.showAll(parents,children);

        $(".my-main-container").scrollTop(0);
    },

    showAll: function(parents,children,path,color) 
    {
      //show all
      if(!color)
        color = "text-white";
      $(".favElBtn").removeClass("active btn-dark-blue").addClass("btn-link ");//+color+" ");
      $(".favAllBtn").addClass("active");
      $(parents).removeClass('hide');
      $(children).removeClass('hide');
    },
    //be carefull with trailing spaces on elemClass
    //they break togglePArents and breaks everything
    toggleParents : function (path) { 
        //mylog.log("toggleParents",parents,children);
        $.each( favTypes, function(i,k)
        {
          if( $(path.trim()+'.'+k).length == $(path.trim()+'.'+k+'.hide ').length )
            $('.'+k+'fav').addClass('hide');
          else
            $('.'+k+'fav').removeClass('hide');
        });
    },

    //fait de la recherche client dans les champs demandé
    search : function(parentClass, searchVal) { 
        mylog.log("searchDir searchVal",searchVal);           
        if(searchVal.length>2 ){
            $.each( $(directory.elemClass) ,function (i,k) { 
                      var found = null;
              if( $(this).find(".entityName").text().search( new RegExp( searchVal, "i" ) ) >= 0 || 
                  $(this).find(".entityLocality").text().search( new RegExp( searchVal, "i" ) ) >= 0 || 
                  $(this).find(".tagsContainer").text().search( new RegExp( searchVal, "i" ) ) >= 0 )
                {
                  //mylog.log("found");
                  found = 1;
                }

                if(found)
                    $(this).removeClass('hide');
                else
                    $(this).addClass('hide');
            });

            directory.toggleParents(directory.elemClass);
        } else
            directory.toggleEmptyParentSection(parentClass,null, directory.elemClass ,1);
    },

    searchFor : function (str) { 
      $(".searchSmallMenu").val(str).trigger("keyup");
     }
}
