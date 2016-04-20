<?php 

 /** PARAMS PATAPOUF **/
// $params['result']['displayType'] = false;
// $params['result']['fullLocality'] = true;
// $params['result']['datesEvent'] = true;

// $params['source']['sourcekey'] = 'patapouf';
$pathParams = Yii::app()->controller->module->viewPath.'/default/dir/';
$json = file_get_contents($pathParams."params.json");
$params = json_decode($json, true);

?>



<div class="my-main-container col-md-10" >
  <div id="dropdown_search" class="container list-group-item"></div>
</div>

<?php $this->renderPartial(@$path."first_step_directory"); ?> 

<script type="text/javascript">

  //********** FILTER TYPE ITEM **********
  <?php if(isset($params['searchType']) && is_array($params['searchType'])){ ?>
    var searchType = <?php echo json_encode($params['searchType']); ?>;
    var allSearchType = <?php echo json_encode($params['searchType']); ?>;
  <?php } ?>
  
  //********** FILTER CATEGORY AND TAG**********
  var searchTag = [];
  var allSearchTag = [];

  //********** FILTER CATEGORY **********
  var searchCategory = [];
  var allsearchCategory = ["Travail"]; 
  <?php if(isset($_GET['category']) && $_GET['category'] != ""){ ?>
    searchCategory = ["<?php echo $_GET['category']; ?>"];
    // addSearchCategory("<?php echo $_GET['category']; ?>");
    // if($('.searchCategory[value="<?php echo $_GET['category']; ?>"]').length)$('.searchCategory[value="<?php echo $_GET['category']; ?>"]').addClass('active');
  <?php } ?> 

  //Par défaut
  location.hash = "#default.simplydirectory"; 

  var allElement = new Array();
  var allTags = new Object();
  var allTypes = new Object();
  var indexStepInit = 100;
  
  //With different pagination params
  <?php if(isset($params['request']['pagination']) && $params['request']['pagination'] > 0){ ?>
    indexStepInit = <?php echo $params['request']['pagination'] ;?>;
  <?php } ?>

  var indexStep = indexStepInit;
  var currentIndexMin = 0;
  var currentIndexMax = indexStep;
  var scrollEnd = false;
  var totalData = 0;

  var timeout = null;


  jQuery(document).ready(function() {

    $('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><label id="countResult" class="text-dark"></label>');

    showMap(true);

    selectScopeLevelCommunexion(levelCommunexion);

    topMenuActivated = true;
    hideScrollTop = true; 
    checkScroll();
    var timeoutSearch = setTimeout(function(){ }, 100);
    
    setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

    $(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>L'Annuaire</span> <span class='text-red'>COMMUNE</span>CTÉ");

    $('.tooltips').tooltip();

    $('.main-btn-toogle-map').click(function(e){ showMap(); });

    <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>

    <?php } else { ?>
      $('#searchBarText').keyup(function(e){
          clearTimeout(timeoutSearch);
          timeoutSearch = setTimeout(function(){ startSearch(0, indexStepInit); }, 800);
      });
    <?php } ?>

    /***** CHANGE THE VIEW PARAMS  *****/
    // $('#dropdown_params').show();

    $('#dropdown_paramsBtn').click(function(event){
      event.preventDefault();
      if($('#dropdown_paramsBtn').hasClass('active')){
        $('#dropdown_params').fadeOut();
        $('#dropdown_params').removeClass('col-md-3');
        $('#dropdown_search').removeClass('col-md-9');
        $('#dropdown_search').addClass('col-md-12');
        $('#dropdown_paramsBtn').removeClass('active');
      }
      else{
        $('#dropdown_params').addClass('col-md-3');
        $('#dropdown_params').fadeIn();
        $('#dropdown_search').addClass('col-md-9');
        $('#dropdown_search').removeClass('col-md-12');
        $('#dropdown_paramsBtn').addClass('active');
      }
     
    });

    /***** CHANGE THE VIEW GRID OR LIST *****/
    $('#grid').hide();

    $('#list').click(function(event){
      event.preventDefault();
      $('#dropdown_search .item').addClass('list-group-item');
      $('.entityTop').removeClass('row');
      $('.entityMiddle').removeClass('row');
      $('.entityBottom').removeClass('row');
      $('.entityTop').addClass('col-md-2');
      $('.entityMiddle').addClass('col-md-12');
      $('.entityBottom').addClass('col-md-4');
      $('#grid').show();
      $('#list').hide();
    });
    $('#grid').click(function(event){
      event.preventDefault();
      $('#dropdown_search .item').removeClass('list-group-item');
      $('#dropdown_search .item').addClass('grid-group-item');
      $('.entityTop').addClass('row');
      $('.entityMiddle').addClass('row');
      $('.entityBottom').addClass('row');
      $('.entityTop').removeClass('col-md-2');
      $('.entityMiddle').removeClass('col-md-12');
      $('.entityBottom').removeClass('col-md-4');
      $('#list').show();
      $('#grid').hide();
    });

    /******** EVENTS ********/
    $(".categoryFilter").click(function(e){
      var category = $(this).attr("value");
      var index = searchCategory.indexOf(category);

      if (index > -1) removeSearchCategory(category);
      else addSearchCategory(category);

      startSearch(0, indexStepInit);
    });

    $('#reset').on('click', function() {
      searchTag = [];
      searchCategory = [];
      $('.tagFilter').removeClass('active');
      $('.categoryFilter').removeClass('active');
      startSearch(0, indexStepInit);
    });



    <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>

        
        //Charger tous les éléments
     


    <?php } else{ ?>
      $(".my-main-container").scroll(function(){
        if(!loadingData && !scrollEnd){
            var heightContainer = $(".my-main-container")[0].scrollHeight;
            var heightWindow = $(window).height();
            //console.log("scroll : ", scrollEnd, heightContainer, $(this).scrollTop() + heightWindow);
            if(scrollEnd == false){
              var heightContainer = $(".my-main-container")[0].scrollHeight;
              var heightWindow = $(window).height();
              if( ($(this).scrollTop() + heightWindow) >= heightContainer-150){
                // console.log("scroll MAX");
                startSearch(currentIndexMin+indexStep, currentIndexMax+indexStep);
              }
            }
        }
      });

      $(".btn-filter-type").click(function(e){
        var type = $(this).attr("type");
        var index = searchType.indexOf(type);

        if(type == "all" && searchType.length > 1){
          $.each(allSearchType, function(index, value){ removeSearchType(value); }); return;
        }
        if(type == "all" && searchType.length == 1){
          $.each(allSearchType, function(index, value){ addSearchType(value); }); return;
        }

        if (index > -1) removeSearchType(type);
        else addSearchType(type);
      });

      initBtnToogleCommunexion();
      $(".btn-activate-communexion").click(function(){
        toogleCommunexion();
      });
    <?php } ?>

    //initBtnScopeList();
    startSearch(0, indexStepInit);

  });


function startSearch(indexMin, indexMax){
    // console.log("startSearch", indexMin, indexMax, indexStep);
    
    $("#listTagClientFilter").html('spiner');

    if(loadingData) return;
    loadingData = true;
    
    // console.log("loadingData true");
    indexStep = indexStepInit;

    var name = $('#searchBarText').val();

    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;

    currentIndexMin = indexMin;
    currentIndexMax = indexMax;

    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array(); 
    }

    // if(name.length>=3 || name.length == 0){
      var locality = "";
      if(communexionActivated){
        if(levelCommunexion == 1) locality = inseeCommunexion;
        if(levelCommunexion == 2) locality = cpCommunexion;
        if(levelCommunexion == 3) locality = cpCommunexion.substr(0, 2);
        if(levelCommunexion == 4) locality = inseeCommunexion;
        if(levelCommunexion == 5) locality = "";
      } 
      autoCompleteSearch(name, locality, indexMin, indexMax);
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

function addSearchCategory(category){
  console.log('add'+category+' dans '+searchCategory);;
  var index = searchCategory.indexOf(category);
  if (index == -1) {
    searchCategory.push(category);
    $('.categoryFilter[value="'+category+'"]').addClass('active');
    // console.log($('.checkbox[data-parent="'+category+'"]'));
    $('.checkbox[data-parent="'+category+'"]').prop( "checked", true );
  }
}

function removeSearchCategory(category){
  console.log('remove '+category+' dans '+searchCategory);
  var index = searchCategory.indexOf(category);
  if (index > -1) {
    searchCategory.splice(index, 1);
    $('.categoryFilter[value="'+category+'"]').removeClass('active');
    $('.checkbox[data-parent="'+category+'"]').prop( "checked", false );
  }
}


function addSearchTag(tag){
  var index = searchTag.indexOf(tag);
  if (index == -1) {
    searchTag.push(tag);
    $('.tagFilter[value="'+tag+'"]').addClass('active');
  }
}

function removeSearchTag(tag){
  var index = searchTag.indexOf(tag);
  if (index > -1) {
    searchTag.splice(index, 1);
    $('.tagFilter[value="'+tag+'"]').removeClass('active');
  }
}

var loadingData = false;
var mapElements = new Array(); 
var tagsFilter = new Array();
var mix = "";
<?php if(isset($params['mode']) && $params['mode'] == 'client') { ?>
  mix = "mix";
<?php } ?>

function autoCompleteSearch(name, locality, indexMin, indexMax){
    var levelCommunexionName = { 1 : "INSEE",
                             2 : "CODE_POSTAL_INSEE",
                             3 : "DEPARTEMENT",
                             4 : "REGION"
                           };
    // console.log("levelCommunexionName", levelCommunexionName[levelCommunexion]);
    locality = "";
    console.log("searchTag : ",searchTag);
    console.log("searchCategory : ",searchCategory);
    var searchTagGlobal = [];
    if (undefined !== searchTag && searchTag.length)$.merge(searchTagGlobal,searchTag);
    if (undefined !== searchCategory && searchCategory.length)$.unique($.merge(searchTagGlobal,searchCategory));
    console.log("searchhGlobal : "+searchTagGlobal);

    var data = {"name" : name, "locality" : locality, "searchType" : searchType, "searchTag" : searchTagGlobal, "searchBy" : levelCommunexionName[levelCommunexion], 
                "indexMin" : indexMin, "indexMax" : indexMax, 
                "sourceKey" : "<?php echo (isset($params['request']['sourcekey'])) ? $params['request']['sourcekey'] : false;?>"  };

    //console.log("loadingData true");
    loadingData = true;
    
    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    $(".btn-start-search").removeClass("bg-dark");
    //$("#dropdown_search").css({"display" : "inline" });

    if(indexMin > 0)
    $("#btnShowMoreResult").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
    $("#dropdown_search").html("<center><span class='search-loaderr text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></center>");
      
    if(isMapEnd)
      $.blockUI({
        message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i><span class='text-dark'> En cours ...</span></h1>"
      });

    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error");
             console.dir(data);          
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
              var mapElements = new Array();
              allTags = new Object();

              //parcours la liste des résultats de la recherche
              $.each(data, function(i, o) {
                  var typeIco = i;
                  var ico = mapIconTop["default"];
                  var color = mapColorIconTop["default"];

                  mapElements.push(o);
                  allElement.push(o);

                  typeIco = o.type;
                  ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                  color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
                  
                  htmlIco ="<i class='fa "+ ico +" text-"+color+"'></i>";
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
                  var tagsClasses = "";
                  var insee = o.insee ? o.insee : "";

                  type = o.type;
                  if(type=="citoyen") type = "person";
                  
                  //Consolidate types
                  if(type != "undefined" && type != null){
                    if(typeof allTypes[type] != "undefined"){
                      allTypes[type] = allTypes[type] + 1;
                    }
                    else{
                      allTypes[type] = 1;
                    }
                  }

                  var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                  var url = baseUrl+'/'+moduleId+ "/default/dir#" + type + ".simply.id." + id;
                  var onclick = 'loadByHash("#' + type + '.simply.id.' + id + '");';
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
                      if(value != ""){

                        //Display info in item
                        tags +=   "<a href='javascript:' class='badge bg-red btn-tag tagFilter' value='"+ value +"'>#" + value + "</a>";
                        // manageTagFilter("#"+value); 

                        //Consolidate tags
                        if(typeof allTags[value] != "undefined"){
                          allTags[value] = allTags[value] + 1;
                        }
                        else{
                          allTags[value] = 1;
                        } 

                        //Filter Client (Attention erreur firefox js)
                        // tagsClasses += ' '+value.replace("/[^A-Za-z0-9]/", "", value) ;
                      }
                    });
                  }
                  // console.log(tagsClasses);

                  var name = typeof o.name != "undefined" ? o.name : "";
                  var website = typeof o.url != "undefined" ? o.url : "";
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
                  description = "";

                  var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                  var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;

                  /***** VERSION SIMPLY *****/
                  str += "<div id='"+id+"' class='row list-group-item item searchEntity "+mix+" "+tagsClasses+" "+fullLocality+"' >";
                    <?php if(isset($params['result']['displayImage']) && $params['result']['displayImage']) { ?>
                    str += "<div class='entityTop col-md-2' onclick='"+onclick+"'>";
                        str += "<img class='image' src='http://paniersdumarais.weebly.com/uploads/1/4/6/5/1465996/5333680.jpg' />";
                    str += "</div>";
                   <?php } ?>
                    str += "<div class='entityMiddle col-md-5 name' onclick='"+onclick+"'>";
                        str += "<a class='entityName text-dark'>" + name + "</a><br/>";
                        // if(website != "" && website != " ")
                        str += "<i class='fa fa-desktop fa_url'></i><a href='"+website+"' target='_blank'>"+website+"url à recup</a><br/>";
                        <?php if(isset($params['result']['fullLocality']) && $params['result']['fullLocality']) { ?>
                          if(fullLocality != "" && fullLocality != " ")
                          str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+ ' data-id="' + dataId + '"' + "  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a><br/>";
                        <?php } ?>
                    str += "</div>";
                    
                    <?php if(isset($params['result']['displayType']) && $params['result']['displayType']) { ?>
                      str += "<div class='entityMiddle col-md-2 type '>";
                        typeIco = "";
                         str += htmlIco+"" + typeIco + "";
                      str += "</div>";
                    <?php } ?>
                   
                    target = "";
                    // str += "<div class='row entityMiddle fullLocality'>";
                      
                    //   <?php if(isset($params['result']['datesEvent']) && $params['result']['datesEvent']) { ?>
                    //     // str += "<hr>";
                    //     str += "<div class='row entityMiddle datesEvent'>";
                    //     if(startDate != null)
                    //     str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</a>";
                    //     if(endDate != null)
                    //     str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</a>";
                    //     str += "</div>";
                    //   <?php } ?>


                    // str += "</div>";
                    str += "<div class='entityBottom col-md-5'>";
                      <?php if( isset( Yii::app()->session['userId'] ) ) { ?>
                      isFollowed=false;
                      if(typeof o.isFollowed != "undefined" )
                        isFollowed=true;
                      if(type!="city" && id != "<?php echo Yii::app()->session['userId']; ?>")
                      str += "<a href='javascript:;' class='btn btn-default btn-sm btn-add-to-directory bg-white tooltips followBtn'" + 
                            'data-toggle="tooltip" data-placement="left" data-original-title="Suivre"'+
                            " data-ownerlink='follow' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"' data-isFollowed='"+isFollowed+"'>"+
                                "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                              "</a>";
                      <?php } ?>
                      str += "<hr>";
                      if(tags=="") tags = "<a href='#' class='badge bg-red btn-tag'>#</a>";
                      str += tags;


                    str += "</div>";          
                  str += "</div>";

              }); //end each

              if(str == "") { 
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
              
                  str += '</div><div class="center col-md-12" id="footerDropdown">';
                  str += "<hr style='float:left; width:100%;'/><label id='countResult' class='text-dark'></label><br/>";
                  <?php if(isset($params['mode']) && $params['mode'] != "client"){ ?>
                    str += '<button class="btn btn-default" id="btnShowMoreResult"><i class="fa fa-angle-down"></i> Afficher plus de résultat</div></center>';
                    str += "</div>";
                  <?php } ?>

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
    
                //si on est sur une première recherche
                }else{
                  //on affiche le résultat à l'écran
                  $("#dropdown_search").html(str);
                  //on scroll pour coller le haut de l'arbre au menuTop
                  // $(".my-main-container").scrollTop(95);
                }

                //on affiche le nombre de résultat en bas
                var s = "";
                var length = ($( "div.searchEntity" ).length);
                if(length > 1) s = "s";
                $("#countResult").html(length+" résultat"+s);

                //On met à jour les filtres
                <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
                  loadClientFilters(allTypes, allTags);
                <?php } else{ ?>
                  loadServerFilters(allTypes, allTags);
                <?php } ?>                


                //on affiche par liste par défaut
                $('#list').click();


                //remet l'icon "loupe" du bouton search
                $(".btn-start-search").html("<i class='fa fa-search'></i>");
                $.unblockUI();

                //active le chargement de la suite des résultat au survol du bouton "afficher plus de résultats"
                //(au cas où le scroll n'ait pas lancé le chargement comme prévu)
                $("#btnShowMoreResult").mouseenter(function(){
                  if(!loadingData){
                    startSearch(indexMin+indexStep, indexMax+indexStep);
                    $("#btnShowMoreResult").mouseenter(function(){});
                  }
                });
                
                //initialise les boutons pour garder une entité dans Mon répertoire (boutons links)
                // initBtnLink();

              } //end else (str=="")

              //signal que le chargement est terminé
              // console.log("loadingData false");
              loadingData = false;

              <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
               loadClientFeatures();
              <?php } else{ ?>
                loadServerFeatures();
              <?php } ?>

              //quand la recherche est terminé, on remet la couleur normal du bouton search
              $(".btn-start-search").removeClass("bg-azure");
            }

            // console.log("scrollEnd ? ", scrollEnd, indexMax, countData , indexMin);
            
            //si le nombre de résultat obtenu est inférieur au indexStep => tous les éléments ont été chargé et affiché
            if(indexMax - countData > indexMin){
              $("#btnShowMoreResult").remove(); 
              scrollEnd = true;
            }else{
              scrollEnd = false;
            }

            //affiche les éléments sur la carte
            Sig.showMapElements(Sig.map, mapElements);
          }
    });               
  }

  // function initBtnLink(){
  //   $('.tooltips').tooltip();
  //   //parcours tous les boutons link pour vérifier si l'entité est déjà dans mon répertoire
  //   $.each($(".followBtn"), function(index, value){
  //     var id = $(value).attr("data-id");
  //     var type = $(value).attr("data-type");
  //     if(type == "person") type = "people";
  //     else type = type + "s";
  //     //console.log("#floopItem-"+type+"-"+id);
  //     if($("#floopItem-"+type+"-"+id).length){
  //       //console.log("I FOLLOW THIS");
  //       if(type=="people"){
  //         $(value).html("<i class='fa fa-unlink text-green'></i>");
  //         $(value).attr("data-original-title", "Ne plus suivre cette personne");
  //         $(value).attr("data-ownerlink","unfollow");
  //       }
  //       else{
  //         $(value).html("<i class='fa fa-user-plus text-green'></i>");
          
  //         if(type == "organizations")
  //           $(value).attr("data-original-title", "Vous êtes membre de cette organization");
  //         else if(type == "projects")
  //           $(value).attr("data-original-title", "Vous êtes contributeur de ce projet");
          
  //         //(value).attr("onclick", "");
  //         $(value).removeClass("followBtn");
  //       }
  //     }
  //     if($(value).attr("data-isFollowed")=="true"){
  //       $(value).html("<i class='fa fa-unlink text-green'></i>");
  //       $(value).attr("data-original-title", "Ne plus suivre");
  //       $(value).attr("data-ownerlink","unfollow");
  //       $(value).addClass("followBtn");
  //     }
  //   });

    //on click sur les boutons link
  //   $(".followBtn").click(function(){
  //     formData = new Object();
  //     formData.parentId = $(this).attr("data-id");
  //     formData.childId = "<?php echo Yii::app() -> session["userId"] ?>";
  //     formData.childType = "<?php echo Person::COLLECTION ?>";
  //     var type = $(this).attr("data-type");
  //     var name = $(this).attr("data-name");
  //     var id = $(this).attr("data-id");
  //     //traduction du type pour le floopDrawer
  //     var typeOrigine = type + "s";
  //     if(typeOrigine == "persons"){ typeOrigine = "<?php echo Person::COLLECTION ?>";}
  //     formData.parentType = typeOrigine;
  //     if(type == "person") type = "people";
  //     else type = type + "s";

  //   var thiselement = this;
  //   $(this).html("<i class='fa fa-spin fa-circle-o-notch text-azure'></i>");
  //   //console.log(formData);
  //   if ($(this).attr("data-ownerlink")=="follow"){
  //     $.ajax({
  //       type: "POST",
  //       url: baseUrl+"/"+moduleId+"/link/follow",
  //       data: formData,
  //       dataType: "json",
  //       success: function(data) {
  //         if(data.result){
  //           //addFloopEntity(data.parent["_id"]["$id"], data.parentType, data.parent);
  //           toastr.success(data.msg); 
  //           $(thiselement).html("<i class='fa fa-unlink text-green'></i>");
  //           $(thiselement).attr("data-ownerlink","unfollow");
  //           $(thiselement).attr("data-original-title", "Ne plus suivre");
  //           //if(type=="people"){
  //             addFloopEntity(id, type, data.parentEntity);
  //           //}
  //         }
  //         else
  //           toastr.error(data.msg);
  //       },
  //     });
  //   } else if ($(this).attr("data-ownerlink")=="unfollow"){
  //     formData.connectType =  "followers";
  //     // console.log(formData);
  //     $.ajax({
  //       type: "POST",
  //       url: baseUrl+"/"+moduleId+"/link/disconnect",
  //       data : formData,
  //       dataType: "json",
  //       success: function(data){
  //         if ( data && data.result ) {
  //           $(thiselement).html("<i class='fa fa-chain'></i>");
  //           $(thiselement).attr("data-ownerlink","follow");
  //           $(thiselement).attr("data-original-title", "Suivre");
  //           removeFloopEntity(data.parentId, type);
  //           toastr.success("<?php echo Yii::t("common","You are not following") ?> "+data.parentEntity.name); //+" <?php echo Yii::t("common","anymore") ?>");  
  //         } else {
  //            toastr.error("You leave succesfully");
  //         }
  //       }
  //     });
  //   }
  //   });
  // }

  function setSearchValue(value){
    $("#searchBarText").val(value);
    startSearch(0, 100);
  }


  function manageTagFilter(tag){
    var index = tagsFilter.indexOf(tag);

    if (index > -1) {
      tagsFilter.splice(index, 1);
    }
    else{
      tagsFilter.push(tag);
    }
  }

  // function loadClientFeatures(){

  //   /*** EXTEND FUNCTION FOR CASE SENSITIVE ***/
  //   $.expr[":"].contains = $.expr.createPseudo(function (arg) {
  //       return function (elem) {
  //           return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
  //       };
  //   });


  //   // To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "multiFilter".
  //   var multiFilter = {
      
  //     // Declare any variables we will need as properties of the object
  //     $filterGroups: null,
  //     $filterUi: null,
  //     $reset: null,
  //     groups: [],
  //     outputArray: [],
  //     outputString: '',
      
  //     // The "init" method will run on document ready and cache any jQuery objects we will need.
      
  //     init: function(){
  //       var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.
        
  //       self.$filterUi = $('#Filters');
  //       self.$filterGroups = $('.filter-group');
  //       self.$reset = $('#Reset');
  //       self.$container = $('#dropdown_search');
        
  //       self.$filterGroups.each(function(){
  //         self.groups.push({
  //           $inputs: $(this).find('input'),
  //           active: [],
  //           tracker: false
  //         });
  //       });
        
  //       self.bindHandlers();
  //     },
      
  //     // The "bindHandlers" method will listen for whenever a form value changes. 
  //     bindHandlers: function(){
  //       var self = this,
  //           typingDelay = 300,
  //           typingTimeout = -1,
  //           resetTimer = function() {
  //             clearTimeout(typingTimeout);
              
  //             typingTimeout = setTimeout(function() {
  //               self.parseFilters();
  //             }, typingDelay);
  //           };
        
  //       self.$filterGroups
  //         .filter('.checkboxes')
  //         .on('change', function() {
  //           self.parseFilters();
  //         });
        
  //       self.$filterGroups
  //         .filter('.search')
  //         .on('keyup change', resetTimer);
        
  //       self.$reset.on('click', function(e){
  //         e.preventDefault();
  //         self.$filterUi[0].reset();
  //         self.$filterUi.find('input[type="text"]').val('');
  //         self.parseFilters();
  //       });
  //     },
      
  //     // The parseFilters method checks which filters are active in each group:
      
  //     parseFilters: function(){
  //       var self = this;
     
  //       // loop through each filter group and add active filters to arrays
        
  //       for(var i = 0, group; group = self.groups[i]; i++){
  //         group.active = []; // reset arrays
  //         group.$inputs.each(function(){
  //           var searchTerm = '',
  //               $input = $(this),
  //               minimumLength = 3;
            
  //           if ($input.is(':checked')) {
  //             group.active.push(this.value);
  //           }
            
  //           if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
  //             searchTerm = this.value
  //               .trim()
  //               .toLowerCase()
  //               .replace(' ', '-');
              
  //             group.active[0] = '[class*="' + searchTerm + '"]'; 

  //             //To add content search
  //             group.active[1] = ".item:contains('"+$( "#searchBarText" ).val()+"')"; 
  //           }
  //         });
  //         group.active.length && (group.tracker = 0);
  //       }
        
  //       self.concatenate();
  //     },
      
  //     // The "concatenate" method will crawl through each group, concatenating filters as desired:
      
  //     concatenate: function(){
  //       var self = this,
  //         cache = '',
  //         crawled = false,
  //         checkTrackers = function(){
  //           var done = 0;
            
  //           for(var i = 0, group; group = self.groups[i]; i++){
  //             (group.tracker === false) && done++;
  //           }

  //           return (done < self.groups.length);
  //         },
  //         crawl = function(){
  //           for(var i = 0, group; group = self.groups[i]; i++){
  //             group.active[group.tracker] && (cache += group.active[group.tracker]);

  //             if(i === self.groups.length - 1){
  //               self.outputArray.push(cache);
  //               cache = '';
  //               updateTrackers();
  //             }
  //           }
  //         },
  //         updateTrackers = function(){
  //           for(var i = self.groups.length - 1; i > -1; i--){
  //             var group = self.groups[i];

  //             if(group.active[group.tracker + 1]){
  //               group.tracker++; 
  //               break;
  //             } else if(i > 0){
  //               group.tracker && (group.tracker = 0);
  //             } else {
  //               crawled = true;
  //             }
  //           }
  //         };
        
  //       self.outputArray = []; // reset output array

  //       do{
  //         crawl();
  //       }
  //       while(!crawled && checkTrackers());

  //       self.outputString = self.outputArray.join();
        
  //       // If the output string is empty, show all rather than none:
        
  //       !self.outputString.length && (self.outputString = 'all'); 
        
  //       console.log(self.outputString); 
        
  //       // ^ we can check the console here to take a look at the filter string that is produced
  //       // Send the output string to MixItUp via the 'filter' method: 
  //       if(self.$container.mixItUp('isLoaded')){
  //         self.$container.mixItUp('filter', self.outputString);
  //       }
  //     }
  //   };


    // On document ready, initialise our code
    // if(execute == true){
  //     $(function(){
            
  //       // Initialize multiFilter code
  //       multiFilter.init();
            
  //       // Instantiate MixItUp 
  //       $('#dropdown_search').mixItUp({
  //         controls: {
  //           enable: false // we won't be needing these
  //         },
  //         animation: {
  //           // easing: 'cubic-bezier(0.86, 0, 0.07, 1)',
  //           // queueLimit: 3,
  //           // duration: 600
  //           enable: false
  //         }
  //       });

  //       $('#dropdown_search').on('mixEnd', function(e, state){
  //         //on met à jour le nombre de résultat
  //         $("#countResult").html(state.totalShow+" résultats");

  //         //On met à jour la map et les filtres
  //         var mapData = new Array();
  //         var tagsData = typesData = new Object();
  //         $.each(state.$show, function(index, value){
  //           $.each(allElement, function(index2, value2){
  //             //Display
  //             if(value['id'] == getObjectId(value2)){
                
  //               //map
  //               mapData.push(value2);

  //               //filtre
  //               // if(typeof typesData[value2.type] == "undefined"){
  //               //   typesData[value2.type] = 1;
  //               // }else{
  //               //   typesData[value2.type] = typesData[value2.type] + 1;
  //               // }

  //               //tags
  //               // $.each(value2.tags, function(index3, value3){
  //               //     // console.log(value3);
  //               //     if(typeof tagsData[value3] == "undefined"){
  //               //       tagsData[value3] = 1;
  //               //     }else{
  //               //       tagsData[value3] = tagsData[value3] + 1;
  //               //     }
  //               // });
  //             }
  //           });
  //         });
  //         // Sig.restartMap();
  //         Sig.showMapElements(Sig.map, mapData);
  //         // console.log(typesData);
  //         // loadClientFilters(typesData,tagsData);
          
  //         //On remonte
  //         $(".my-main-container").scrollTop(99);
  //       });
  //     });
  //   // }
  // }

  function loadServerFeatures(){
    //on active les filtres
    // $('.typeFilter').on('click', function() {
    //   var type = $(this).data("value");
    //   var index = searchType.indexOf(type);

    //   if(type == "all" && searchType.length > 1){
    //     $.each(allSearchType, function(index, value){ removeSearchType(value); }); return;
    //   }
    //   if(type == "all" && searchType.length == 1){
    //     $.each(allSearchType, function(index, value){ addSearchType(value); }); return;
    //   }

    //   if (index > -1) {
    //     removeSearchType(type);
    //     $(this).css( "background-color", "gray" );
    //   }
    //   else{
    //     addSearchType(type);
    //     $(this).css( "background-color", "#2497d0" );
    //   }

    //   startSearch(0,indexStepInit);
    // });

    //on click sur les boutons link
    // $(".btn-tag").click(function(){
    //   setSearchValue($(this).data("value"));
    // });
  }


  function loadServerFilters(types,tags){
    var displayLimit = 10;
    var classToHide = "";
    var i = 0;

    $("#listTypesFilter").html(' ');
    $.each(types, function(index, value){
      $("#listTypesFilter").append('<a href="#default.simplydirectory" class="typeFilter" data-value="'+index+'s">'+index+' ('+value+')</a>');
    });
    
    i=0;
    classToHide = "";
    $("#listTagFilter").html(' ');
    $.each(tags, function(index, value){
      i+=1;
      $("#listTagFilter").append('<a href="javascript:;" class="tagFilter tagHidden '+classToHide+'" value="'+index+'">#'+index+' ('+value+')</a>');
      if(i == displayLimit)classToHide = "hidden";
    });
    if(i > 10)$("#listTagFilter").append('<div id="moreTag"><i class="fa fa-plus fa-2x"></i></div>');
    $("#moreTag").click(function(){
       $(".tagHidden").removeClass("hidden");
       $("#moreTag").hide();
    });

    //Display active
    $.each(searchTag, function(index, value){
      $('.tagFilter[value="'+value+'"]').addClass('active');
      $('.tagFilter[value="'+value+'"]').prop("checked", true );
      manageCollapse(value,true);

    });
    $.each(searchCategory, function(index, value){
      $('.categoryFilter[value="'+value+'"]').addClass('active')
      $('.categoryFilter[value="'+value+'"]').prop( "checked", true );
      manageCollapse(value,true);
    });
    

    $(".tagFilter").click(function(e){

      var tag = $(this).attr("value");
      var index = searchTag.indexOf(tag);

      if(tag == "all"){
        searchTag = [];
        $('.tagFilter[value="all"]').addClass('active');
        startSearch(0, indexStepInit);
        return;
      }
      else{
        $('.tagFilter[value="all"]').removeClass('active');
      }

      if (index > -1) removeSearchTag(tag);
      else addSearchTag(tag);
      startSearch(0, indexStepInit);
    });



  }

  // function loadClientFilters(types, tags){
  //   var displayLimit = 10;
  //   var classToHide = "";

  //   var i = 0;
  //   $("#listTypesClientFilter").html(' ');
  //   $.each(types, function(index, value){
  //     i+=1;
  //     $("#listTypesClientFilter").append('<div class="checkbox typeHidden '+classToHide+'"><input type="checkbox" value=".'+index+'"/><label>'+index+' ('+value+')</label></div>');
  //     if(i == displayLimit)classToHide = "hidden";
  //   });
  //   if(i > 10)$("#listTypesClientFilter").append('<div id="moreTypes"><i class="fa fa-plus fa-2x"></i></div>');
  //   $("#moreTypes").click(function(){
  //      $(".typeHidden").removeClass("hidden");
  //      $("#moreTypes").hide();
  //   });

  //   i=0;
  //   classToHide = "";
  //   $("#listTagClientFilter").html(' ');
  //   $.each(tags, function(index, value){
  //     i+=1;
  //     $("#listTagClientFilter").append('<div class="checkbox tagHidden '+classToHide+'"><input type="checkbox" value=".'+index+'"/><label>#'+index+' ('+value+')</label></div>');
  //     if(i == displayLimit)classToHide = "hidden";
  //   });
  //   if(i > 10)$("#listTagClientFilter").append('<div id="moreTag"><i class="fa fa-plus fa-2x"></i></div>');
  //   $("#moreTag").click(function(){
  //      $(".tagHidden").removeClass("hidden");
  //      $("#moreTag").hide();
  //   });
  //   loadClientFeatures();

  // }




</script>

