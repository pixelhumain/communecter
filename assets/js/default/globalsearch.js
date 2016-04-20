  

/* GLOBAL SEARCH JS */
function showDropDownGS(show){
  if(typeof show == "undefined") show = true;

  if(show){
    if($(".dropdown-result-global-search").css("display") == "none"){
      $(".dropdown-result-global-search").css("maxHeight", "0px");
      $(".dropdown-result-global-search").show();
      $(".dropdown-result-global-search").animate({"maxHeight" : "80%"}, 300);
    }
  }else{
    if(!loadingDataGS){
      $(".dropdown-result-global-search").animate({"maxHeight" : "0%"}, 300);
      $(".dropdown-result-global-search").hide(300);
    }
  }
}

var searchTypeGS = [ "persons", "organizations", "projects", "events", "cities" ];
var allSearchTypeGS = [ "persons", "organizations", "projects", "events" ];

var loadingDataGS = false;
var indexStepGS = 20;
var currentIndexMinGS = 0;
var currentIndexMaxGS = indexStepGS;
var scrollEndGS = false;
var totalDataGS = 0;
var mapElementsGS = new Array(); 

function startGlobalSearch(indexMin, indexMax){
    console.log("startGlobalSearch", indexMin, indexMax, indexStepGS, loadingDataGS);

    if(loadingDataGS) return;

    setTimeout(function(){ loadingDataGS = false; }, 10000);

    console.log("loadingDataGS true");
    loadingDataGS = true;
    
    var search = $('.input-global-search').val();
    if(search == "") search = $('#input-global-search-xs').val();
      
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStepGS;

    currentIndexMinGS = indexMin;
    currentIndexMaxGS = indexMax;

    if(indexMin == 0) {
      totalDataGS = 0;
      mapElementsGS = new Array(); 
    }
    else{ console.log("scrollEndGS ? ", scrollEndGS); if(scrollEndGS) return; }
    
    if(search.length>=3){
      autoCompleteSearchGS(search, indexMin, indexMax);
    }else{
      var str = '<div class="center" id="footerDropdownGS">';
      str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>Aucun résultat</label><br/>";
      str += "</div>";
      $(".dropdown-result-global-search").html(str);
      loadingDataGS = false;
      scrollEndGS = false;
    }   
}


function autoCompleteSearchGS(search, indexMin, indexMax){
    console.log("autoCompleteSearchGS");

    var data = {"name" : search, "locality" : "", "searchType" : searchTypeGS, "searchBy" : "ALL",
                "indexMin" : indexMin, "indexMax" : indexMax  };

    showDropDownGS(true);

    if(indexMin > 0)
    $("#btnShowMoreResultGS").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
    $(".dropdown-result-global-search").html("<h3 class='text-dark center'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</h3>");
      

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
              console.log("DATA GS");
              console.dir(data);

              var countData = 0;
              $.each(data, function(i, v) { if(v.length!=0){ countData++; } });
              
              totalDataGS += countData;
            
              str = "";
              var city, postalCode = "";
              
              //parcours la liste des résultats de la recherche
              $.each(data, function(i, o) {
                  var typeIco = i;
                  var ico = mapIconTop["default"];
                  var color = mapColorIconTop["default"];

                  mapElementsGS.push(o);

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
                    onclick = 'loadByHash("#city.detail.insee.' + insee + '");'; //"'+o.name.replace("'", "\'")+'");';
                    onclickCp = 'loadByHash("#city.detail.insee.' + insee + '");';
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

                    target = "";

                    str += "<div class='col-md-12 col-sm-12 col-xs-12 no-padding searchEntity'>";
                    str += "<div class='col-md-2 col-sm-2 col-xs-2 no-padding entityCenter'>";
                    str +=   "<a href='"+url+"' onclick='"+onclick+"'>" + htmlIco + "</a>";
                    str += "</div>";
                    str += "<div class='col-md-10 col-sm-10 col-xs-10 entityRight'>";

                    str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName text-dark'>" + name + "</a>";
                      if(fullLocality != "" && fullLocality != " ")
                      str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+ ' data-id="' + dataId + '"' + "  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a>";
                    str += "</div>";
                    str += "</div>";
                              
                  //str += "</div>";
              }); //end each

              if(str == "") { 
                  if(indexMin == 0){
                    //ajout du footer       
                    str += '<div class="center" id="footerDropdownGS">';
                    str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>Aucun résultat</label><br/>";
                    str += "</div>";
                    $(".dropdown-result-global-search").html(str);
                  }
              }
              else
              {       
                //ajout du footer   
                if(!scrollEndGS){    
                 
                  str += '<div class="center" id="footerDropdownGS">';
                  str += "<hr style='margin-top: 5px; margin-top: 10px; float:left; width:100%;'/><label style='margin-top:0px; margin-bottom:5px;' class='text-dark'>" + totalDataGS + " résultats</label><br/>";
                  str += '<button class="btn btn-default" id="btnShowMoreResultGS"><i class="fa fa-angle-down"></i> Afficher plus de résultat</div></center>';
                  str += '</div>';
                }
                //si on n'est pas sur une première recherche (chargement de la suite des résultat)
                if(indexMin > 0){
                  //on supprime l'ancien bouton "afficher plus de résultat"
                  $("#btnShowMoreResultGS").remove();
                  //on supprimer le footer (avec nb résultats)
                  $("#footerDropdownGS").remove();

                  //on calcul la valeur du nouveau scrollTop
                  var heightContainer = $(".dropdown-result-global-search")[0].scrollHeight - 140;
                  //on affiche le résultat à l'écran
                  $(".dropdown-result-global-search").append(str);
                  //on scroll pour afficher le premier résultat de la dernière recherche
                  $(".dropdown-result-global-search").animate({"scrollTop" : heightContainer}, 1000);
                  
                  
                //si on est sur une première recherche
                }else{
                  //on ajoute le texte dans le html
                  $(".dropdown-result-global-search").html(str);
                  //on scroll pour coller le haut de l'arbre au menuTop
                  $(".dropdown-result-global-search").scrollTop(0);
                  //on affiche la dropdown
                  showDropDownGS(true);
                }
                //remet l'icon "loupe" du bouton search
                //$(".btn-start-search").html("<i class='fa fa-search'></i>");
                //affiche la dropdown
                //$(".dropdown-result-global-search").css({"display" : "inline" });

                //active le chargement de la suite des résultat au survol du bouton "afficher plus de résultats"
                //(au cas où le scroll n'ait pas lancé le chargement comme prévu)
                $("#btnShowMoreResultGS").click(function(){
                  if(!loadingDataGS){
                    //startGlobalSearch(indexMin+indexStepGS, indexMax+indexStepGS);
                    selectScopeLevelCommunexion(5);
                    loadByHash("#default.directory");
                  }
                });
                
                //initialise les boutons pour garder une entité dans Mon répertoire (boutons links)
                //initBtnLinkGS();

              } //end else (str=="")

              //signal que le chargement est terminé
              console.log("loadingDataGS false");
              loadingDataGS = false;

              //quand la recherche est terminé, on remet la couleur normal du bouton search
              //$(".btn-start-search").removeClass("bg-azure");
            }

            //console.log("scrollEndGS ? ", scrollEnd, indexMax, countData , indexMin);
            //si le nombre de résultat obtenu est inférieur au indexStep => tous les éléments ont été chargé et affiché
            if(indexMax - countData > indexMin){
              $("#btnShowMoreResultGS").remove(); 
              scrollEndGS = true;
            }else{
              scrollEndGS = false;
            }

            if(isMapEnd){
              //affiche les éléments sur la carte
              showDropDownGS(false);
              Sig.showMapElements(Sig.map, mapElementsGS);
            }

            //$("#footerDropdownGS").append("<br><a class='btn btn-default' href='javascript:' onclick='loadByHash("+'"#default.directory"'+")'><i class='fa fa-plus'></i></a>");
          }
    });

                    
  }