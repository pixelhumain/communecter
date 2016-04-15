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
  
<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/2.1.11/jquery.mixitup.min.js"></script>


<style>

.container{
  width:99%;
  /*background-color: white;*/
}

.simply-button{
    padding-top: 10px;
    padding-bottom: 10px;
    color: #666;
    background-color: #ccc;
    border: 0px solid #666;
}

.navbar{
  background-color: #CCC;
}

.panel-filter{
  border-right:2px solid grey;
}

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

.btn-scope{
  display: inline;
}

.simply-nav{
  border:0px;
  padding-right: 0px;
  padding-left: 0px;
}

.searchEntity hr{
  margin:3px; 
}

fieldset{
  width: 99%;
  border: 10px solid white;
}
 
</style>
<div class="my-main-container">
  <div  class="col-md-3" id="dropdown_params" style="display: block;padding-left: 0px;padding-right: 0px;">
    
      <form class="controls" id="Filters" style="background-color:white">
        <!-- We can add an unlimited number of "filter groups" using the following format: -->
        <?php if(isset($params['mode']) && $params['mode'] == 'client') { ?>
          <center><button id="Reset" class="btn btn-default" onclick="$('#dropdown_search').mixItUp('filter','')">Initialiser filtre</button></center><br>
        <?php } ?>
        <?php if(isset($params['filter']['types']) && $params['filter']['types']){ ?>
          <b>Statut juridique : </b>
          <?php if(isset($params['mode']) && $params['mode'] == 'client') { ?>
            <fieldset class="filter-group checkboxes" style="padding: 0px;" id="listTypesClientFilter"></fieldset>
          <?php }else{ ?>
             <fieldset class="filter-group" style="padding: 0px;">
                <ul class="input-group type-list-filter sidebar-filters ng-scope" id="listTypesFilter" style="padding-left: 0px;"></ul>
            </fieldset>
          <?php } ?>
        <?php } ?>
        <?php if(isset($params['filter']['tags']) && $params['filter']['tags']){ ?>
          <b>Tag : </b>
          <?php if(isset($params['mode']) && $params['mode'] == 'client') { ?>
            <fieldset class="filter-group checkboxes" style="padding: 0px;" id="listTagClientFilter"></fieldset>
          <?php }else{ ?>
            <fieldset class="filter-group" style="padding: 0px;">             
              <ul class="input-group type-list-filter sidebar-filters ng-scope" id="listTagFilter" style="padding-left: 0px;"></ul>
            </fieldset>
          <?php } ?>
        <?php } ?>
      </form>
  </div>
  <div class="col-md-9" id="dropdown_search" class="container"></div>
</div>

<?php $this->renderPartial(@$path."first_step_directory"); ?> 

<script type="text/javascript">

var searchType = [ "persons", "organizations", "projects" ];
var allSearchType = [ "persons", "organizations", "projects" ];
var allElement = new Array();
var allTags = new Array();
var allTypes = new Array();


jQuery(document).ready(function() {

  selectScopeLevelCommunexion(levelCommunexion);

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

  <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>

  <?php } else { ?>
    $('#searchBarText').keyup(function(e){
        clearTimeout(timeoutSearch);
        timeoutSearch = setTimeout(function(){ startSearch(0, indexStepInit); }, 800);
    });
  <?php } ?>
    // $('#searchBarPostalCode').keyup(function(e){
    //     clearTimeout(timeoutSearch);
    //     timeoutSearch = setTimeout(function(){ startSearch(0, 100); }, 800);
    // });



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
    $('.entityMiddle').addClass('col-md-2');
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
    $('.entityMiddle').removeClass('col-md-2');
    $('.entityBottom').removeClass('col-md-4');
    $('#list').show();
    $('#grid').hide();
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
  <?php } ?>

  //initBtnScopeList();
  startSearch(0, indexStepInit);

});

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

function startSearch(indexMin, indexMax){
    console.log("startSearch", indexMin, indexMax, indexStep);

    if(loadingData) return;
    loadingData = true;
    
    console.log("loadingData true");
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
    console.log("levelCommunexionName", levelCommunexionName[levelCommunexion]);
    locality = "";
    var data = {"name" : name, "locality" : locality, "searchType" : searchType, "searchBy" : levelCommunexionName[levelCommunexion], 
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
        message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Commune<span class='text-dark'>xion en cours ...</span></h1>"
      });

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
            	$.each(data['res'], function(i, v) { if(v.length!=0){ countData++; } });
              
              totalData += countData;
            
              str = "";
              var city, postalCode = "";
              var mapElements = new Array();

              //parcours la liste des résultats de la recherche
              $.each(data['res'], function(i, o) {
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
          						if(value != "")
  		                tags +=   "<a href='javascript:' class='badge bg-red btn-tag'>#" + value + "</a>";
                      manageTagFilter("#"+value); 
                      tagsClasses += ' '+value.replace("/[^A-Za-z0-9]/", "", value) ;
  		              });
                  }
                  // console.log(tagsClasses);

                  var name = typeof o.name != "undefined" ? o.name : "";
                  var type = typeof o.type != "undefined" ? o.type : "";
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
                  str += "<div id='"+id+"' class='col-md-3 col-lg-3 item searchEntity "+mix+" "+tagsClasses+" "+fullLocality+" "+type+"' >";
                    <?php if(isset($params['result']['displayImage']) && $params['result']['displayImage']) { ?>
                    str += "<div class='row entityTop' onclick='"+onclick+"'>";
                        str += "<img class='image' src='http://paniersdumarais.weebly.com/uploads/1/4/6/5/1465996/5333680.jpg' />";
                    str += "</div>";
                   <?php } ?>
                    str += "<div class='row entityMiddle name' onclick='"+onclick+"'>";
                       str += "<a href='"+url+"' class='entityName text-dark'>" + name + "</a>";
                    str += "</div>";
                    
                    <?php if(isset($params['result']['displayType']) && $params['result']['displayType']) { ?>
                      str += "<div class='row entityMiddle type'>";
                        typeIco = "";
                         str += htmlIco+"" + typeIco + "";
                      str += "</div>";
                    <?php } ?>
                   
                    target = "";
                    str += "<div class='row entityMiddle fullLocality'>";
                      <?php if(isset($params['result']['fullLocality']) && $params['result']['fullLocality']) { ?>
                      // str += "<hr>";
                      // str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName text-dark'>" + name + "</a>";
                      if(fullLocality != "" && fullLocality != " ")
                      str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+ ' data-id="' + dataId + '"' + "  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a>";
                      <?php } ?>
                      <?php if(isset($params['result']['datesEvent']) && $params['result']['datesEvent']) { ?>
                        // str += "<hr>";
                        str += "<div class='row entityMiddle datesEvent'>";
                        if(startDate != null)
                        str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</a>";
                        if(endDate != null)
                        str += "<a href='"+url+"' onclick='"+onclick+"'"+target+"  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</a>";
                        str += "</div>";
                      <?php } ?>


                    str += "</div>";
                    str += "<div class='row entityBottom'>";
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
                $("#countResult").html($( "div.searchEntity" ).length+" résultats");

                //On met à jour les filtres
                <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
                  allTags = data['filters']['tags'];
                  loadClientFilters(data['filters']['types'], data['filters']['tags']);
                <?php } else{ ?>
                  allTypes = data['filters']['types'];
                  loadServerFilters(data['filters']['types'], data['filters']['tags']);
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
                initBtnLink();

    	        } //end else (str=="")

              //signal que le chargement est terminé
              console.log("loadingData false");
              loadingData = false;

              <?php if(isset($params['mode']) && $params['mode'] == "client"){ ?>
               loadClientFeatures();
              <?php } else{ ?>
                loadServerFeatures();
              <?php } ?>

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
	   			
          //(value).attr("onclick", "");
	   			$(value).removeClass("followBtn");
	   		}
   		}
   		if($(value).attr("data-isFollowed")=="true"){
	   		$(value).html("<i class='fa fa-unlink text-green'></i>");
	   		$(value).attr("data-original-title", "Ne plus suivre");
			  $(value).attr("data-ownerlink","unfollow");
        $(value).addClass("followBtn");
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
		//console.log(formData);
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
						//if(type=="people"){
							addFloopEntity(id, type, data.parentEntity);
						//}
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
						toastr.success("<?php echo Yii::t("common","You are not following") ?> "+data.parentEntity.name); //+" <?php echo Yii::t("common","anymore") ?>");	
					} else {
					   toastr.error("You leave succesfully");
					}
				}
			});
		}
   	});
  }

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

  function loadClientFeatures(){

    /*** EXTEND FUNCTION FOR CASE SENSITIVE ***/
    $.expr[":"].contains = $.expr.createPseudo(function (arg) {
        return function (elem) {
            return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
        };
    });


    // To keep our code clean and modular, all custom functionality will be contained inside a single object literal called "multiFilter".
    var multiFilter = {
      
      // Declare any variables we will need as properties of the object
      $filterGroups: null,
      $filterUi: null,
      $reset: null,
      groups: [],
      outputArray: [],
      outputString: '',
      
      // The "init" method will run on document ready and cache any jQuery objects we will need.
      
      init: function(){
        var self = this; // As a best practice, in each method we will asign "this" to the variable "self" so that it remains scope-agnostic. We will use it to refer to the parent "checkboxFilter" object so that we can share methods and properties between all parts of the object.
        
        self.$filterUi = $('#Filters');
        self.$filterGroups = $('.filter-group');
        self.$reset = $('#Reset');
        self.$container = $('#dropdown_search');
        
        self.$filterGroups.each(function(){
          self.groups.push({
            $inputs: $(this).find('input'),
            active: [],
            tracker: false
          });
        });
        
        self.bindHandlers();
      },
      
      // The "bindHandlers" method will listen for whenever a form value changes. 
      bindHandlers: function(){
        var self = this,
            typingDelay = 300,
            typingTimeout = -1,
            resetTimer = function() {
              clearTimeout(typingTimeout);
              
              typingTimeout = setTimeout(function() {
                self.parseFilters();
              }, typingDelay);
            };
        
        self.$filterGroups
          .filter('.checkboxes')
          .on('change', function() {
            self.parseFilters();
          });
        
        self.$filterGroups
          .filter('.search')
          .on('keyup change', resetTimer);
        
        self.$reset.on('click', function(e){
          e.preventDefault();
          self.$filterUi[0].reset();
          self.$filterUi.find('input[type="text"]').val('');
          self.parseFilters();
        });
      },
      
      // The parseFilters method checks which filters are active in each group:
      
      parseFilters: function(){
        var self = this;
     
        // loop through each filter group and add active filters to arrays
        
        for(var i = 0, group; group = self.groups[i]; i++){
          group.active = []; // reset arrays
          group.$inputs.each(function(){
            var searchTerm = '',
                $input = $(this),
                minimumLength = 3;
            
            if ($input.is(':checked')) {
              group.active.push(this.value);
            }
            
            if ($input.is('[type="text"]') && this.value.length >= minimumLength) {
              searchTerm = this.value
                .trim()
                .toLowerCase()
                .replace(' ', '-');
              
              group.active[0] = '[class*="' + searchTerm + '"]'; 

              //To add content search
              group.active[1] = ".item:contains('"+$( "#searchBarText" ).val()+"')"; 
            }
          });
          group.active.length && (group.tracker = 0);
        }
        
        self.concatenate();
      },
      
      // The "concatenate" method will crawl through each group, concatenating filters as desired:
      
      concatenate: function(){
        var self = this,
          cache = '',
          crawled = false,
          checkTrackers = function(){
            var done = 0;
            
            for(var i = 0, group; group = self.groups[i]; i++){
              (group.tracker === false) && done++;
            }

            return (done < self.groups.length);
          },
          crawl = function(){
            for(var i = 0, group; group = self.groups[i]; i++){
              group.active[group.tracker] && (cache += group.active[group.tracker]);

              if(i === self.groups.length - 1){
                self.outputArray.push(cache);
                cache = '';
                updateTrackers();
              }
            }
          },
          updateTrackers = function(){
            for(var i = self.groups.length - 1; i > -1; i--){
              var group = self.groups[i];

              if(group.active[group.tracker + 1]){
                group.tracker++; 
                break;
              } else if(i > 0){
                group.tracker && (group.tracker = 0);
              } else {
                crawled = true;
              }
            }
          };
        
        self.outputArray = []; // reset output array

        do{
          crawl();
        }
        while(!crawled && checkTrackers());

        self.outputString = self.outputArray.join();
        
        // If the output string is empty, show all rather than none:
        
        !self.outputString.length && (self.outputString = 'all'); 
        
        console.log(self.outputString); 
        
        // ^ we can check the console here to take a look at the filter string that is produced
        // Send the output string to MixItUp via the 'filter' method: 
        if(self.$container.mixItUp('isLoaded')){
          self.$container.mixItUp('filter', self.outputString);
        }
      }
    };


    // On document ready, initialise our code
    $(function(){
          
      // Initialize multiFilter code
      multiFilter.init();
          
      // Instantiate MixItUp 
      $('#dropdown_search').mixItUp({
        controls: {
         
          toggleLogic: 'and'
        }
      });

      $('#dropdown_search').on('mixEnd', function(e, state){
        //on met à jour le nombre de résultat
        $("#countResult").html(state.totalShow+" résultats");

        //On met à jour la map et les filtres
        var mapData = new Array();
        var tagsData = new Object();
        var typesData = new Object();
        console.log(state);
        $.each(state.$show, function(index, value){
          $.each(allElement, function(index2, value2){
            //Display
            if(value['id'] == getObjectId(value2)){
              
              //map
              mapData.push(value2);

              //filtre
              if(typeof typesData[value2.type] == "undefined"){
                typesData[value2.type] = 1;
              }else{
                typesData[value2.type] = typesData[value2.type] + 1;
              }

              //tags
              $.each(value2.tags, function(index3, value3){
                  // console.log(value3);
                  if(typeof tagsData[value3] == "undefined"){
                    tagsData[value3] = 1;
                  }else{
                    tagsData[value3] = tagsData[value3] + 1;
                  }
              });
            }
          });
        });
        Sig.restartMap();
        Sig.showMapElements(Sig.map, mapData);
        updateClientFilters(typesData, tagsData);
        
        //On remonte
        $(".my-main-container").scrollTop(100);
      });
    });
  }

  function loadServerFeatures(){
    //on active les filtres
    $('.typeFilter').on('click', function() {
      var type = $(this).data("value");
      var index = searchType.indexOf(type);

      if(type == "all" && searchType.length > 1){
        $.each(allSearchType, function(index, value){ removeSearchType(value); }); return;
      }
      if(type == "all" && searchType.length == 1){
        $.each(allSearchType, function(index, value){ addSearchType(value); }); return;
      }

      if (index > -1) {
        removeSearchType(type);
        $(this).css( "background-color", "gray" );
      }
      else{
        addSearchType(type);
        $(this).css( "background-color", "#2497d0" );
      }

      startSearch(0,indexStepInit);
    });

    //on click sur les boutons link
    $(".btn-tag").click(function(){
      setSearchValue($(this).data("value"));
    });
  }


  function loadServerFilters(types,tags){
    var displayLimit = 10;
    var classToHide = "";
    var i = 0;
    if($(".typeFilter").length == 0){
      $("#listTypesFilter").html(' ');
      $.each(types, function(index, value){
        $("#listTypesFilter").append('<a href="#default.simplydirectory" class="typeFilter" data-value="'+index+'s">'+index+' ('+value+')</a>');
      });
      
      i=0;
      classToHide = "";
      $("#listTagFilter").html(' ');
      $.each(tags, function(index, value){
        i+=1;
        $("#listTagFilter").append('<a href="javascript:;" class="tagFilter btn-tag tagHidden '+classToHide+'" data-value="#'+index+'">#'+index+' ('+value+')</a>');
        if(i == displayLimit)classToHide = "hidden";
      });
      if(i > 10)$("#listTagFilter").append('<div id="moreTag"><i class="fa fa-plus fa-2x"></i></div>');
      $("#moreTag").click(function(){
         $(".tagHidden").removeClass("hidden");
         $("#moreTag").hide();
      });
    }
  }

  function loadClientFilters(types,tags){
    var displayLimit = 10;
    var classToHide = check = "";
    var i = 0;
    i=0;
    classToHide = "";
    $("#listTypesClientFilter").empty();
    $.each(types, function(index, value){
      i+=1;
      $("#listTypesClientFilter").append('<div class="checkbox typeHidden '+classToHide+'" id="checkbox_'+index+'"><input type="checkbox" value=".'+index+'" /><label>#'+index+' ('+value+')</label></div>');
      if(i == displayLimit)classToHide = "hidden";
    });
    if(i > 10)$("#listTypesClientFilter").append('<div id="moreTypes"><i class="fa fa-plus fa-2x"></i></div>');
    $("#moreTypes").click(function(){
       $(".typeHidden").removeClass("hidden");
       $("#moreTypes").hide();
    });
    // $("#listTypesClientFilter").html(' ');
    // $.each(types, function(index, value){
    //   i+=1;
    //   $("#listTypesClientFilter").append('<div class="checkbox typeHidden '+classToHide+'"><input type="checkbox" value=".'+index+'"/><label>'+index+' ('+value+')</label></div>');
    //   if(i == displayLimit)classToHide = "hidden";
    // });
    // if(i > 10)$("#listTypesClientFilter").append('<div id="moreTypes"><i class="fa fa-plus fa-2x"></i></div>');
    // $("#moreTypes").click(function(){
    //    $(".typeHidden").removeClass("hidden");
    //    $("#moreTypes").hide();
    // });

    i=0;
    classToHide = "";
    $("#listTagClientFilter").empty();
    $.each(tags, function(index, value){
      i+=1;
      $("#listTagClientFilter").append('<div class="checkbox tagHidden '+classToHide+'" id="checkbox_'+index+'"><input type="checkbox" value=".'+index+'" /><label>#'+index+' ('+value+')</label></div>');
      if(i == displayLimit)classToHide = "hidden";
    });
    if(i > 10)$("#listTagClientFilter").append('<div id="moreTag"><i class="fa fa-plus fa-2x"></i></div>');
    $("#moreTag").click(function(){
       $(".tagHidden").removeClass("hidden");
       $("#moreTag").hide();
    });

  }

  function updateClientFilters(types,tags){
    var displayLimit = 10;
    var classToHide = "";
    var i = index = 0;

    $.each(allTypes, function(index, value){
      if(index!="ubiquitaire-&-iot" && index!="calcul-d'itinéraire"){
        $("#checkbox_"+index).hide();
      }
    });

    $.each(types, function(index, value){
      if(index!="ubiquitaire-&-iot" && index!="calcul-d'itinéraire"){
        $("#checkbox_"+index+" >label").text('#'+index+' ('+value+')');
        $("#checkbox_"+index).show();
      }
    });

    $.each(allTags, function(index, value){
      if(index!="ubiquitaire-&-iot" && index!="calcul-d'itinéraire"){
        $("#checkbox_"+index).hide();
      }
    });

    $.each(tags, function(index, value){
      if(index!="ubiquitaire-&-iot" && index!="calcul-d'itinéraire"){
        $("#checkbox_"+index+" >label").text('#'+index+' ('+value+')');
        $("#checkbox_"+index).show();
      }
    });
  }
</script>
  