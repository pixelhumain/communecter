
var indexStepInit = 100;
var indexStep = indexStepInit;
var currentIndexMin = 0;
var currentIndexMax = indexStep;
var scrollEnd = false;
var totalData = 0;

var timeout = null;

function startSearch(indexMin, indexMax){
    console.log("startSearch", indexMin, indexMax, indexStep);

    console.log("loadingData", loadingData);
    if(loadingData) return;
    loadingData = true;
    

    console.log("loadingData true");
    indexStep = indexStepInit;

    var name = $('#searchBarText').val();
    //var locality = $('#searchBarPostalCode').val();
    //inseeCommunexion = locality;
    
    //if(communexionActivated)
    //$(".lbl-scope-list").html("<i class='fa fa-check'></i> " + cityNameCommunexion.toLowerCase() + ", " + cpCommunexion);
      
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;

    currentIndexMin = indexMin;
    currentIndexMax = indexMax;

    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array(); 
    }
    else{ if(scrollEnd) return; }
    
    //name = name.replace(/[^\w\s']/gi, '');
    ///locality = locality.replace(/[^\w\s']/gi, '');

    //verification si c'est un nombre
    //if(!isNaN(parseInt(locality))){
    //    if(locality.length == 0 || locality.length > 5) locality = "";
    //}

    if(name.length>=3 || name.length == 0){
      var locality = "";
      if(communexionActivated){
        if(typeof(cityInseeCommunexion) != "undefined"){
			if(levelCommunexion == 1) locality = cpCommunexion;
			if(levelCommunexion == 2) locality = inseeCommunexion;
		}else{
			if(levelCommunexion == 1) locality = inseeCommunexion;
			if(levelCommunexion == 2) locality = cpCommunexion;
		}
        if(levelCommunexion == 3) locality = cpCommunexion.substr(0, 2);
        if(levelCommunexion == 4) locality = inseeCommunexion;
        if(levelCommunexion == 5) locality = "";
      } 
      autoCompleteSearch(name, locality, indexMin, indexMax);
    }else{
      
    }   
}

function addSearchType(type){
  var index = searchType.indexOf(type);
  if (index == -1) {
    searchType.push(type);
    $(".search_"+type).removeClass("fa-circle-o");
    $(".search_"+type).addClass("fa-check-circle-o");
  }
}
function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
}

var loadingData = false;
var mapElements = new Array(); 
function autoCompleteSearch(name, locality, indexMin, indexMax){
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
    console.log("levelCommunexionName", levelCommunexionName[levelCommunexion]);
    var data = {"name" : name, "locality" : locality, "searchType" : searchType, "searchBy" : levelCommunexionName[levelCommunexion], 
                "indexMin" : indexMin, "indexMax" : indexMax  };


    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    $(".btn-start-search").removeClass("bg-dark");
    //$("#dropdown_search").css({"display" : "inline" });

    if(indexMin > 0)
    $("#btnShowMoreResult").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
    $("#dropdown_search").html("<center><span class='search-loader text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></center>");
      
    if(isMapEnd)
        $.blockUI({
          message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Commune<span class='text-dark'>xion en cours ...</span></h1>"
        });

    $(".responsive-calendar").hide();

    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error"); console.dir(data);          
          },
          success: function(data){
            if(!data){ toastr.error(data.content); }
            else
            {
              var countData = 0;
              $.each(data, function(i, v) { if(v.length!=0){ countData++; } });
              
              totalData += countData;
            
              str = "";
              var city, postalCode = "";
              
              //parcours la liste des résultats de la recherche
              $.each(data, function(i, o) {
                  var typeIco = i;
                  var ico = mapIconTop["default"];
                  var color = mapColorIconTop["default"];

                  mapElements.push(o);

                  typeIco = o.type;
                  ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                  color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
                  
                  htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
                  if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                    var htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                  }

                  city="";

                  var postalCode = o.cp
                  if (o.address != null) {
                    city = o.address.addressLocality;
                    postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                  }
                  
                  //console.dir(o);
                  var id = getObjectId(o);
                  var insee = o.insee ? o.insee : "";
                  type = o.type;
                  if(type=="citoyen") type = "person";
                  var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                  var onclick = 'loadByHash("#' + type + '.detail.id.' + id + '");';
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
                  if(typeof o.tags != "undefined" && o.tags != null){
                    $.each(o.tags, function(key, value){
                      if(value != "")
                      tags +=   "<a href='javascript:' class='badge bg-red btn-tag'>#" + value + "</a>";
                    });
                  }

                  var name = typeof o.name != "undefined" ? o.name : "";
                  var postalCode = (typeof o.address != "undefined" &&
                            typeof o.address.postalCode != "undefined") ? o.address.postalCode : "";
                  
                  if(postalCode == "") postalCode = typeof o.cp != "undefined" ? o.cp : "";
                  var cityName = (typeof o.address != "undefined" &&
                          typeof o.address.addressLocality != "undefined") ? o.address.addressLocality : "";
                  
                  var fullLocality = postalCode + " " + cityName;

                  var description = (typeof o.shortDescription != "undefined" &&
                            o.shortDescription != null) ? o.shortDescription : "";
                  if(description == "") description = (typeof o.description != "undefined" &&
                                     o.description != null) ? o.description : "";
           
                  var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                  var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;

                  //template principal
                  str += "<div class='col-md-12 searchEntity'>";
                    str += "<div class='col-md-5 col-sm-4 entityLeft'>";
                      if(userId != null){
                        isFollowed=false;
                        if(typeof o.isFollowed != "undefined" )
                          isFollowed=true;
                        if(type!="city" && id != userId)
                        str += "<a href='javascript:;' class='btn btn-default btn-sm btn-add-to-directory bg-white tooltips followBtn'" + 
                              'data-toggle="tooltip" data-placement="left" data-original-title="Participer"'+
                              " data-ownerlink='participate' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"' data-isFollowed='"+isFollowed+"'>"+
                                  "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                                "</a>";
                      }
                      str += tags;
              
                    str += "</div>";

                    str += "<div class='col-md-2 col-sm-2 entityCenter'>";
                    str += "<a href='"+url+"' onclick='"+onclick+"'>" + htmlIco + "</a>";
                    str += "</div>";
                     target = "";
                    str += "<div class='col-md-5 col-sm-5 entityRight no-padding'>";
                      str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName text-dark'>" + name + "</a>";
                      if(fullLocality != "" && fullLocality != " ")
                      str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+ ' data-id="' + dataId + '"' + "  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a>";
                      if(startDate != null)
                      str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</a>";
                      if(endDate != null)
                      str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</a>";
                      if(description != "")
                      str += "<div onclick='"+onclick+"'"+target+"  class='entityDescription'>" + description + "</div>";
                    str += "</div>";
                              
                  str += "</div>";
              }); //end each

              if(str == "") { 
				  $.unblockUI();
	              showMap(false);

                  $(".btn-start-search").html("<i class='fa fa-search'></i>"); 
                  if(indexMin == 0){
                    //ajout du footer       
                    var msg = "Aucun résultat";    
                    if(name == "" && locality == "") msg = "<h3 class='text-dark'><i class='fa fa-3x fa-keyboard-o'></i><br> Préciser votre recherche pour plus de résultats ...</h3>"; 
                    str += '<div class="center" id="footerDropdown">';
                    str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>"+msg+"</label><br/>";
                    str += "</div>";
                    $("#dropdown_search").html(str);
                    $("#searchBarText").focus();
                  }
              }
              else
              {       
                //ajout du footer       
                str += '<div class="center" id="footerDropdown">';
                str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>" + totalData + " résultats</label><br/>";
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
                  //on scroll pour coller le haut de l'arbre au menuTop
                  //$(".my-main-container").scrollTop(95);
                }
                //remet l'icon "loupe" du bouton search
                $(".btn-start-search").html("<i class='fa fa-search'></i>");
                $.unblockUI();
				        showMap(false);
                
                //affiche la dropdown
                //$("#dropdown_search").css({"display" : "inline" });

                //active le chargement de la suite des résultat au survol du bouton "afficher plus de résultats"
                //(au cas où le scroll n'ait pas lancé le chargement comme prévu)
                $("#btnShowMoreResult").mouseenter(function(){
                  // if(!loadingData){
                  //   startSearch(indexMin+indexStep, indexMax+indexStep);
                  //   $("#btnShowMoreResult").mouseenter(function(){});
                  // }
                });
                
                //initialise les boutons pour garder une entité dans Mon répertoire (boutons links)
                initBtnLink();

              } //end else (str=="")

              //signal que le chargement est terminé
              console.log("loadingData false");
              loadingData = false;

              //quand la recherche est terminé, on remet la couleur normal du bouton search
              $(".btn-start-search").removeClass("bg-azure");
            }
			 $('.tooltips').tooltip();
            console.log("scrollEnd ? ", scrollEnd, indexMax, countData , indexMin);
            //si le nombre de résultat obtenu est inférieur au indexStep => tous les éléments ont été chargé et affiché
            if(indexMax - countData > indexMin){
              $("#btnShowMoreResult").remove(); 
              scrollEnd = true;
            }else{
              scrollEnd = false;
            }

            showResultInCalendar(mapElements);
            //affiche les éléments sur la carte
            Sig.showMapElements(Sig.map, mapElements);
          }
    });

                    
  }

  function addEventOnSearch() {
    $('.searchEntry').off().on("click", function(){
      
      //toastr.success($("#dropdown_search").position().top);
      var top = $(this).position().top;// + $("#dropdown_search").position().top;

      setSearchInput($(this).data("id"), $(this).data("type"),
                     $(this).data("insee"), top );
    });
  }

  function initBtnLink(){

    //parcours tous les boutons link pour vérifier si l'entité est déjà dans mon répertoire
    $.each($(".followBtn"), function(index, value){
      var id = $(value).attr("data-id");
      var type = $(value).attr("data-type");
	  type = type + "s";

      //console.log("#floopItem-"+type+"-"+id);
      if($("#floopItem-"+type+"-"+id).length){
        //console.log("I FOLLOW THIS");
        $(value).html("<i class='fa fa-unlink text-green'></i>");
		$(value).attr("data-ownerlink","unparticipate");
        $(value).attr("data-original-title","Ne plus participer à l\'évènement");
      }
    });
    //on click sur les boutons link
    $(".followBtn").click(function(){
      formData = new Object();
   		formData.parentId = $(this).attr("data-id");
   		formData.parentType = $(this).attr("data-id");
   		formData.childId = userId;
   		formData.childType = personCOLLECTION;
   		var type = $(this).attr("data-type");
   		var name = $(this).attr("data-name");
   		var id = $(this).attr("data-id");
   		//traduction du type pour le floopDrawer
   		var typeOrigine = type + "s";
   		formData.parentType = typeOrigine;
   		type = type + "s";
		var thiselement = this;
		$(this).html("<i class='fa fa-spin fa-circle-o-notch text-azure'></i>");
		console.log(formData);
		if ($(this).attr("data-ownerlink")=="participate"){
			formData.connectType =  "attendee";
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/connect",
				data: formData,
				dataType: "json",
				success: function(data) {
					if(data.result){
						//addFloopEntity(data.parent["_id"]["$id"], data.parentType, data.parent);
						toastr.success(data.msg);	
						$(thiselement).html("<i class='fa fa-unlink text-green'></i>");
						$(thiselement).attr("data-ownerlink","unparticipate");
						$(thiselement).attr("data-original-title", "Ne plus particper à l'évènement");
						addFloopEntity(id, type, data.parent);
						showFloopDrawer(true);
					}
					else
						toastr.error(data.msg);
				},
			});
		} else if ($(this).attr("data-ownerlink")=="unparticipate"){
			formData.connectType =  "attendees";
			console.log(formData);
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/disconnect",
				data : formData,
				dataType: "json",
				success: function(data){
					if ( data && data.result ) {
						$(thiselement).html("<i class='fa fa-link'></i>");
						$(thiselement).attr("data-ownerlink","participate");
						$(thiselement).attr("data-original-title", "Suivre");
						removeFloopEntity(data.parentId, type);
						toastr.success(trad["leaveeventsuccess"]);	
					} else {
					   toastr.error("You leave succesfully");
					}
				}
			});
		}
    });

    $(".btn-tag").click(function(){
      setSearchValue($(this).html());
    });
  }


  function setSearchValue(value){
    $("#searchBarText").val(value);
    startSearch();
  }