

<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-calendar"></i> L'Agenda</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉ</span></h1>

<div class="lbl-scope-list text-red"></div>

<?php $this->renderPartial("short_info_profil", array("type" => "main")); ?> 

<button class="menu-button btn-menu btn-menu-top bg-azure tooltips main-btn-toogle-map"
		data-toggle="tooltip" data-placement="right" title="Carte">
		<i class="fa fa-map-marker"></i>
</button>

<div class="img-logo bgpixeltree_little">
	<button class="menu-button btn-activate-communexion bg-red tooltips" data-toggle="tooltip" data-placement="left" title="Activer / Désactiver la communection" alt="Activer / Désactiver la communection">
    <i class="fa fa-university"></i>
  </button>
	<button class="menu-button btn-infos bg-red tooltips" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>
	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search"/>
	<?php 
		//$where = isset( Yii::app()->request->cookies['cityName'] ) ? 
	  // 			    Yii::app()->request->cookies['cityName'] : "";
		//if($where == "") 
				 $where = isset( Yii::app()->request->cookies['postalCode'] ) ? 
			   			Yii::app()->request->cookies['postalCode'] : "";
	?>
	<!-- <input id="searchBarPostalCode" type="text" placeholder="Où ?" class="text-red input-search postalCode" 
		   value="<?php echo $where; ?>" > -->

	<?php //$this->renderPartial("dropdown_scope"); ?> 

	<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button><br/>
	<!-- <center><a href="javascript:" class="text-dark" style="padding-left:15px;" id="link-start-search">Rechercher</a></center> -->
</div>


<div class="" id="dropdown_search"></div>


<?php $this->renderPartial("first_step_agenda"); ?> 


<script type="text/javascript">


var searchType = [ "events", "cities" ];
var allSearchType = [ "events" ];


jQuery(document).ready(function() {
  

  searchType = [ "events", "cities" ];
  allSearchType = [ "events" ];

  topMenuActivated = true;
  hideScrollTop = true; 
  checkScroll();
  var timeoutSearch = setTimeout(function(){ }, 100);
  
  $(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>L'Agenda</span> <span class='text-red'>COMMUNE</span>CTÉ");

  $('.tooltips').tooltip();

  $('.main-btn-toogle-map').click(function(e){ showMap(); });

  $('#searchBarText').keyup(function(e){
      clearTimeout(timeoutSearch);
      timeoutSearch = setTimeout(function(){ startSearch(); }, 800);
  });
  $('#searchBarPostalCode').keyup(function(e){
      clearTimeout(timeoutSearch);
      timeoutSearch = setTimeout(function(){ startSearch(); }, 800);
  });
  $('#btn-start-search').click(function(e){
      startSearch();
  });
  $('#link-start-search').click(function(e){
      startSearch();
  });

  $(".btn-geolocate").click(function(e){
    if(geolocHTML5Done == false){
        initHTML5Localisation('prefillSearch');
        $("#modal-select-scope").modal("show");
        $("#main-title-modal-scope").html('<i class="fa fa-spin fa-circle-o-notch"></i> Recherche de votre position ... Merci de patienter ...'); 
        //<i class="fa fa-angle-right"></i> Dans quelle commune vous situez-vous en ce moment ?
    } else{
        $("#modal-select-scope").modal("show");
    }
  });

  $(".my-main-container").scroll(function(){
    if(!loadingData && !scrollEnd){
        var heightContainer = $(".my-main-container")[0].scrollHeight;
        var heightWindow = $(window).height();
        //console.log("scroll : ", scrollEnd, heightContainer, $(this).scrollTop() + heightWindow);
        if(scrollEnd == false){
          var heightContainer = $(".my-main-container")[0].scrollHeight;
          var heightWindow = $(window).height();
          if( ($(this).scrollTop() + heightWindow) == heightContainer){
            console.log("scroll MAX");
            startSearch(currentIndexMin+indexStep, currentIndexMax+indexStep);
          }
        }
    }
  });

  $(".btn-activate-communexion").click(function(){
    toogleCommunexion();
  });


  // $(".btn-filter-type").click(function(e){
  //   var type = $(this).attr("type");
  //   var index = searchType.indexOf(type);

  //   if(type == "all" && searchType.length > 1){
  //     $.each(allSearchType, function(index, value){ removeSearchType(value); }); return;
  //   }
  //   if(type == "all" && searchType.length == 1){
  //     $.each(allSearchType, function(index, value){ addSearchType(value); }); return;
  //   }

  //   if (index > -1) removeSearchType(type);
  //   else addSearchType(type);
  // });
 
  initBtnScopeList();
  startSearch();
});

var indexStep = 15;
var currentIndexMin = 0;
var currentIndexMax = indexStep;
var scrollEnd = false;
var totalData = 0;

function setScopeValue(value){
  value = value.replace("#", "'");
  $("#searchBarPostalCode").val(value);
  startSearch();
}


var timeout = null;

function startSearch(indexMin, indexMax){
    console.log("startSearch", indexMin, indexMax, indexStep);

    if(loadingData) return;

    console.log("loadingData true");
    loadingData = true;
    indexStep = 15;

    var name = $('#searchBarText').val();
    var locality = $('#searchBarPostalCode').val();
    where = locality;
    
    $(".lbl-scope-list").html("<i class='fa fa-check'></i> " + locality.toLowerCase());
    
    if(typeof indexMin == "undefined") indexMin = 0;
    if(typeof indexMax == "undefined") indexMax = indexStep;

    currentIndexMin = indexMin;
    currentIndexMax = indexMax;

    if(indexMin == 0 && indexMax == indexStep) {
      totalData = 0;
      mapElements = new Array(); 
    }
    else{ if(scrollEnd) return; }
    
    name = name.replace(/[^\w\s']/gi, '');
    ///locality = locality.replace(/[^\w\s']/gi, '');

    //verification si c'est un nombre
    if(!isNaN(parseInt(locality))){
        if(locality.length == 0 || locality.length > 5) locality = "";
    }

    if(name.length>=3 || name.length == 0){
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
    
    var data = {"name" : name, "locality" : locality, "searchType" : searchType, 
                "indexMin" : indexMin, "indexMax" : indexMax  };


    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    $(".btn-start-search").removeClass("bg-dark");
    $("#dropdown_search").css({"display" : "inline" });

    if(indexMin > 0)
    $("#btnShowMoreResult").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    else
    $("#dropdown_search").html("<center><span class='search-loader text-dark' style='font-size:20px;'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></center>");
      

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
                  
                  
                  var id = getObjectId(o);
                  var insee = o.insee ? o.insee : "";
                  type = o.type;
                  if(type=="citoyen") type = "person";
                  var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                  var onclick = 'loadByHash("#' + type + '.detail.id.' + id + '");';
                  var onclickCp = "";
                  var target = " target='_blank'";
                  if(type == "city"){
                    url = "javascript:";
                    onclick = 'setScopeValue("'+o.name.replace("'", "#")+'");';
                    onclickCp = 'setScopeValue("'+o.cp+'");';
                    target = "";
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
                    str += "<div class='col-md-5 entityLeft'>";
                      
                      <?php if( isset( Yii::app()->session['userId']) ) { ?>
                      if(type!="city")
                      str += "<a href='javascript:' class='followBtn btn btn-sm btn-add-to-directory bg-white tooltips'" + 
                            'data-toggle="tooltip" data-placement="left" title="Ajouter dans votre répertoire"'+
                            " data-ownerlink='knows' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"'>"+
                                "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                              "</a>";
                      <?php } ?>
                      str += tags;
              
                    str += "</div>";

                    str += "<div class='col-md-2 entityCenter'>";
                    str += "<a href='"+url+"' target='_blank' >" + htmlIco + "</a>";
                    str += "</div>";
                     target = "";
                    str += "<div class='col-md-5 entityRight no-padding'>";
                      str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName text-dark'>" + name + "</a>";
                      if(fullLocality != "" && fullLocality != " ")
                      str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+"  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a>";
                      if(startDate != null)
                      str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</a>";
                      if(endDate != null)
                      str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</a>";
                      if(description != "")
                      str += "<div onclick='"+onclick+"'"+target+"  class='entityDescription'>" + description + "</div>";
                    str += "</div>";
                              
                  str += "</div>";
              }); //end each

              if(str == "") { $(".btn-start-search").html("<i class='fa fa-search'></i>"); }
              else
              {       
                //ajout du footer       
                str += '<div class="center" id="footerDropdown">';
                str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;'>" + totalData + " résultats</label><br/>";
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
                  $(".my-main-container").scrollTop(115);
                }
                //remet l'icon "loupe" du bouton search
                $(".btn-start-search").html("<i class='fa fa-search'></i>");
                //affiche la dropdown
                $("#dropdown_search").css({"display" : "inline" });

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

            console.log("scrollEnd ? ", scrollEnd, indexMax, countData , indexMin);
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
      if(type == "person") type = "people";
      else type = type + "s";

      //console.log("#floopItem-"+type+"-"+id);
      if($("#floopItem-"+type+"-"+id).length){
        //console.log("I FOLLOW THIS");
        $(value).html("<i class='fa fa-chain text-green'></i>");
        $(value).attr("title", "Supprimer de votre répertoire");
      }
    });

    //on click sur les boutons link
    $(".followBtn").click(function(){
      var id = $(this).attr("data-id");
      var type = $(this).attr("data-type");
      var name = $(this).attr("data-name");

      //traduction du type pour le floopDrawer
      var typeOrigine = type + "s";
      if(typeOrigine != "person") typeOrigine + "s";
      
      if(type == "person") type = "people";
      else type = type + "s";

      //si l'entité n'existe pas dans le floopDrawer == on l'ajoute
      if(!$("#floopItem-"+type+"-"+id).length){
        //cas du type people
        if(type == "people"){
          var thiselement = this;
          $(this).html("<i class='fa fa-spin fa-circle-o-notch text-azure'></i>");
            connectPerson(id, function(entityValue){
                //console.log("connecting entity");
                //console.log(entityValue);
                $(thiselement).html("<i class='fa fa-chain text-green'></i>")
                addFloopEntity(id, type, entityValue);
                showFloopDrawer(true);
              });
      }
      //cas du type orga
      else if(type == "organizations"){
        toastr.info('TODO : link with orga');
      }
      //cas du type project
      else if(type == "projects"){
        toastr.info('TODO : link with projects');
      }
    }
    //si l'entité existe déjà dans le floopDrawer == on la supprime
    else{
      disconnectPerson(id, typeOrigine, name, function(entityValue){
            //console.log("disconnect");
            //console.log(entityValue);
            removeFloopEntity(id, type, entityValue);
            showFloopDrawer(true);
          });
    }
    });

    $(".btn-tag").click(function(){
      setSearchValue($(this).html());
    });
  }
</script>