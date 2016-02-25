<style>
	.btn-add-to-directory{
		font-size: 14px;
		margin-right: 0px;
		border-radius: 6px;
		color: #666;
		border: 1px solid rgba(188, 185, 185, 0.69);
		margin-left: 3px;
		float: right;
		padding: 1px;
		width: 24px;
		margin-top: 4px;
	}


  .btn-filter-type{
    height:44px;
  }
</style>


<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-connectdevelop"></i> L'Annuaire</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉ</span></h1>

<div class="lbl-scope-list text-red"></div>

<?php //$this->renderPartial("short_info_profil", array("type" => "main")); ?> 

<button class="menu-button btn-menu btn-menu-top bg-azure tooltips main-btn-toogle-map"
		data-toggle="tooltip" data-placement="right" title="Carte">
		<i class="fa fa-map-marker"></i>
</button>

<div class="img-logo bgpixeltree_little">
	<button class="menu-button btn-activate-communexion bg-red tooltips" data-toggle="tooltip" data-placement="left" title="Activer / Désactiver la communection" alt="Activer / Désactiver la communection">
    <i class="fa fa-university"></i>
  </button>
	<button data-id="explainDirectory" class="explainLink menu-button btn-infos  bg-red tooltips" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>
	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search">
	

  <div class="col-md-12 center" style="margin-top: 6px; margin-bottom: 0px; margin-left: 0px;">
    <div class="btn-group inline-block" id="menu-directory-type">
      <!-- <button class="btn btn-default bg-dark"><i class="fa fa-angle-right fa-2x"></i> Filtrer</button> -->
     <!--  <button class="btn btn-default btn-filter-type tooltips text-azure" data-toggle="tooltip" data-placement="top" title="Tous" type="all">
        <i class="fa fa-asterisk"></i>
      </button> -->
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Citoyens" type="persons">
        <i class="fa fa-check-circle-o search_persons"></i> <i class="fa fa-user"></i> Citoyens
      </button>
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Organisations" type="organizations">
        <i class="fa fa-check-circle-o search_organizations"></i> <i class="fa fa-group"></i> Organisations
      </button>
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Projets" type="projects">
        <i class="fa fa-check-circle-o search_projects"></i> <i class="fa fa-lightbulb-o"></i> Projets
      </button>
    </div>
  </div>


  <button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>

</div>



<div style="margin-top:0px;" class="col-md-12" id="dropdown_search"></div>

<?php $this->renderPartial(@$path."first_step_directory"); ?> 

<script type="text/javascript">

var searchType = [ "persons", "organizations", "projects" ];
var allSearchType = [ "persons", "organizations", "projects" ];

jQuery(document).ready(function() {

  searchType = [ "persons", "organizations", "projects" ];
  allSearchType = [ "persons", "organizations", "projects" ];

	topMenuActivated = true;
	hideScrollTop = true; 
	checkScroll();
  var timeoutSearch = setTimeout(function(){ }, 100);
  
  setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>L'Annuaire</span> <span class='text-red'>COMMUNE</span>CTÉ");

	$('.tooltips').tooltip();

	$('.main-btn-toogle-map').click(function(e){ showMap(); });

	$('#searchBarText').keyup(function(e){
      clearTimeout(timeoutSearch);
      timeoutSearch = setTimeout(function(){ startSearch(); }, 800);
  });
  // $('#searchBarPostalCode').keyup(function(e){
  //     clearTimeout(timeoutSearch);
  //     timeoutSearch = setTimeout(function(){ startSearch(); }, 800);
  // });
  $('#btn-start-search').click(function(e){
      startSearch();
  });
  $('#link-start-search').click(function(e){
      startSearch();
  });
  // $(".btn-geolocate").click(function(e){
		// if(geolocHTML5Done == false){
  //   		initHTML5Localisation('prefillSearch');
  //       $("#modal-select-scope").modal("show");
  //       $("#main-title-modal-scope").html('<i class="fa fa-spin fa-circle-o-notch"></i> Recherche de votre position ... Merci de patienter ...'); 
  //       //<i class="fa fa-angle-right"></i> Dans quelle commune vous situez-vous en ce moment ?
  //   }	else{
  //   		$("#modal-select-scope").modal("show");
  //   }
  // });

  $(".my-main-container").scroll(function(){
    if(!loadingData && !scrollEnd){
        var heightContainer = $(".my-main-container")[0].scrollHeight;
        var heightWindow = $(window).height();
        //console.log("scroll : ", scrollEnd, heightContainer, $(this).scrollTop() + heightWindow);
        if(scrollEnd == false){
          var heightContainer = $(".my-main-container")[0].scrollHeight;
          var heightWindow = $(window).height();
          if( ($(this).scrollTop() + heightWindow) >= heightContainer-150){
            console.log("scroll MAX");
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

  //initBtnScopeList();
  startSearch();

});

var indexStepInit = 100;
var indexStep = indexStepInit;
var currentIndexMin = 0;
var currentIndexMax = indexStep;
var scrollEnd = false;
var totalData = 0;

// function setScopeValue(value){
//       value = value.replace("#", "'");
//       $("#searchBarPostalCode").val(value);
//       startSearch();
//     }


var timeout = null;

function startSearch(indexMin, indexMax){
    console.log("startSearch", indexMin, indexMax, indexStep);

    if(loadingData) return;

    console.log("loadingData true");
    indexStep = indexStepInit;

	  var name = $('#searchBarText').val();
    //var locality = $('#searchBarPostalCode').val();
    //inseeCommunexion = locality;
    
    if(communexionActivated)
    $(".lbl-scope-list").html("<i class='fa fa-check'></i> " + cityNameCommunexion.toLowerCase() + ", " + cpCommunexion);
      
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
      var locality = communexionActivated ? inseeCommunexion : "";
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
    
    var data = {"name" : name, "locality" : locality, "searchType" : searchType, "searchBy" : "INSEE", 
                "indexMin" : indexMin, "indexMax" : indexMax  };

    console.log("loadingData false");
    loadingData = true;
    
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
                  
                  console.dir(o);
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
                  $(".btn-start-search").html("<i class='fa fa-search'></i>"); 
                  if(indexMin == 0){
                    //ajout du footer       
                    str += '<div class="center" id="footerDropdown">';
                    str += "<hr style='float:left; width:100%;'/><label style='margin-bottom:10px; margin-left:15px;' class='text-dark'>Aucun résultat</label><br/>";
                    str += "</div>";
                    $("#dropdown_search").html(str);
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
                  $(".my-main-container").scrollTop(95);
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

  // function addEventOnSearch() {
  //   $('.searchEntry').off().on("click", function(){
      
  //     //toastr.success($("#dropdown_search").position().top);
  //     var top = $(this).position().top;// + $("#dropdown_search").position().top;

  //     setSearchInput($(this).data("id"), $(this).data("type"),
  //                    $(this).data("insee"), top );
  //   });
  // }

  function initBtnLink(){
    $('.tooltips').tooltip();
  	//parcours tous les boutons link pour vérifier si l'entité est déjà dans mon répertoire
  	$.each($(".followBtn"), function(index, value){
    	var id = $(value).attr("data-id");
   		var type = $(value).attr("data-type");
   		if(type == "person") type = "people";
   		else type = type + "s";
   		//console.log("#floopItem-"+type+"-"+id);
   		if($("#floopItem-"+type+"-"+id).length){
   			//console.log("I FOLLOW THIS");
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
	   			$(value).attr("onclick", "");
	   			$(value).removeClass("followBtn");
	   		}
   		}
   		if($(value).attr("data-isFollowed")=="true"){
	   		$(value).html("<i class='fa fa-unlink text-green'></i>");
	   		$(value).attr("data-original-title", "Ne plus suivre");
			$(value).attr("data-ownerlink","unfollow");
   		}
   	});

  	//on click sur les boutons link
   	$(".followBtn").click(function(){
	   	formData = new Object();
   		formData.parentId = $(this).attr("data-id");
   		formData.childId = "<?php echo Yii::app() -> session["userId"] ?>";
   		formData.childType = "<?php echo Person::COLLECTION ?>";
   		var type = $(this).attr("data-type");
   		var name = $(this).attr("data-name");
   		var id = $(this).attr("data-id");
   		//traduction du type pour le floopDrawer
   		var typeOrigine = type + "s";
   		if(typeOrigine == "persons"){ typeOrigine = "<?php echo Person::COLLECTION ?>";}
   		formData.parentType = typeOrigine;
   		if(type == "person") type = "people";
   		else type = type + "s";

		var thiselement = this;
		$(this).html("<i class='fa fa-spin fa-circle-o-notch text-azure'></i>");
		console.log(formData);
		if ($(this).attr("data-ownerlink")=="follow"){
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/follow",
				data: formData,
				dataType: "json",
				success: function(data) {
					if(data.result){
						//addFloopEntity(data.parent["_id"]["$id"], data.parentType, data.parent);
						toastr.success(data.msg);	
						$(thiselement).html("<i class='fa fa-unlink text-green'></i>");
						$(thiselement).attr("data-ownerlink","unfollow");
						$(thiselement).attr("data-original-title", "Ne plus suivre");
						if(type=="people"){
							addFloopEntity(id, type, data.parentEntity);
							showFloopDrawer(true);
						}
					}
					else
						toastr.error(data.msg);
				},
			});
		} else if ($(this).attr("data-ownerlink")=="unfollow"){
			formData.connectType =  "followers";
			console.log(formData);
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+"/link/disconnect",
				data : formData,
				dataType: "json",
				success: function(data){
					if ( data && data.result ) {
						$(thiselement).html("<i class='fa fa-chain'></i>");
						$(thiselement).attr("data-ownerlink","follow");
						$(thiselement).attr("data-original-title", "Suivre");
						removeFloopEntity(data.parentId, type);
						toastr.success("<?php echo Yii::t("common","You are not following") ?> "+data.parentEntity.name+" <?php echo Yii::t("common","anymore") ?>");	
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
    startSearch();
  }

</script>