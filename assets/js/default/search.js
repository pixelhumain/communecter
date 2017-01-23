var localitySearch = [];

function startSearch(indexMin, indexMax, callBack){
    mylog.log("startSearch2", typeof callBack, callBack);
    if(loadingData) return;
    loadingData = true;
    
    indexStep = indexStepInit;

    mylog.log("startSearch2", indexMin, indexMax, indexStep);

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
    
    if(name.length>=3 || name.length == 0){
      autoCompleteSearch(name, indexMin, indexMax, callBack);
    }
}


function createLocalityForSearch(zone) {
  mylog.log("createLocalityForSearch");
  mylog.dir(zone);
  var locality = {}; 
  if(zone["@type"] == "City"){
    locality.id = zone._id.$id;
    locality.type = zone.type;
    locality.insee = zone.insee;
    locality.cp = zone.cp;
    locality.country = zone.country;
    localitySearch.push(locality);
  }
  
}

function autoCompleteSearch(name, indexMin, indexMax, callBack){
  mylog.log("autoCompleteSearch2", typeof callBack, callBack);
  mylog.log(name, indexMin, indexMax);
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
      "locality" : localitySearch,//locality, 
      "searchType" : searchType, 
      "searchTag" : $('#searchTags').val().split(','), //is an array
      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
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
        message : "<h3 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></h3>"
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
            Sig.showMapElements(Sig.map, mapElements);

            if(typeof callBack == "function")
                callBack();
        }
    });


  }