<?php 
  $cssAnsScriptFilesModule = array(
    '/plugins/select2/select2.min.js'
  );
  HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);
?>

<style>
.lbl-title-newsstream{
	display: none;
}
.img-logo{
	height:200px;
}
.btn-scope{
display: inline;
}

.lbl-scope-list {
  top: 200px;
}

#btn-filter-scope-news{
  display:none;
}
.btn-tag{
  font-weight:300;
  padding-left: 0px;
}
.btn-tag.bold{
  font-weight:600;
}
@media screen and (max-width: 1024px) {
  /*button.btn-start-search {
    margin-top: -40px;
    margin-left: 47%;
    color: white;
    border-radius: 30px;
    font-weight: 300;
    font-size: 19px;
    margin-bottom: 20px;
    height: 45px;
    width: 45px;
    padding: 0px;
  }

  .img-logo {
    height: 170px;
  }
  #newsHistory #timeline {
    margin-top: -50px;
  }*/
}
</style>

<div class="lbl-scope-list text-red hidden"></div>

<div class="col-md-12 center">
	
  <div class="col-md-12 no-padding margin-top-15">
  	<div class="input-group col-md-8 col-sm-8 col-xs-12 pull-left">
        <input id="searchBarText" data-searchPage="true" type="text" placeholder="Que recherchez-vous ?" class="input-search form-control">
        <span class="input-group-btn">
              <button class="btn btn-success btn-start-search tooltips" id="btn-start-search"
                      data-toggle="tooltip" data-placement="bottom" title="Actualiser les résultats">
                      <i class="fa fa-refresh"></i>
              </button>
        </span>
    </div>
    <button class="btn btn-sm tooltips hidden-xs pull-left" id="btn-slidup-scopetags" 
            style="margin-left:15px;margin-top:5px;"
            data-toggle="tooltip" data-placement="bottom" title="Afficher/Masquer les filtres">
            <i class="fa fa-minus"></i>
    </button>
    <button data-id="explainNews" class="explainLink btn btn-sm tooltips hidden-xs  pull-left" 
            style="margin-left:7px;margin-top:5px;"
            data-toggle="tooltip" data-placement="bottom" title="Comment ça marche ?">
          <i class="fa fa-question-circle"></i>
    </button>
  </div>
</div>

<div class="col-xs-12" style="margin-top: 10px; margin-bottom: 0px; margin-left: 0px;"  id="list_filters">
  <div class="btn-group inline-block" id="menu-directory-type">
    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Messages" type="news">
      <i class="fa fa-check-circle-o search_news"></i> <i class="fa fa-rss"></i> <span class="hidden-xs hidden-sm">Messages</span>
    </button>
    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Organisations" type="organizations">
      <i class="fa fa-check-circle-o search_organizations"></i> <i class="fa fa-group"></i> <span class="hidden-xs hidden-sm">Organisations</span>
    </button>
    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Projets" type="projects">
      <i class="fa fa-check-circle-o search_projects"></i> <i class="fa fa-lightbulb-o"></i> <span class="hidden-xs hidden-sm">Projets</span>
    </button>
    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Évènements" type="events">
      <i class="fa fa-check-circle-o search_events"></i> <i class="fa fa-calendar"></i> <span class="hidden-xs hidden-sm">Évènements</span>
    </button>
    <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Besoins" type="needs">
      <i class="fa fa-check-circle-o search_needs"></i> <i class="fa fa-cubes"></i> <span class="hidden-xs hidden-sm">Besoins</span>
    </button>
  </div>
  <div class="col-xs-12 margin-top-15 no-padding">
    <div id="list_tags_scopes" class="hidden-xs"></div>
  </div>
</div>

<div class="col-xs-12 no-padding"><hr></div>

<?php //$this->renderPartial("first_step_news"); ?> 
<?php //$this->renderPartial("news/index"); ?> 


<div class="" id="dropdown_search"></div>
<div class="col-xs-12 no-padding" id="newsstream"></div>


<script type="text/javascript">
var searchType = ["organizations", "projects", "events", "needs", "news"];
jQuery(document).ready(function() {
  	topMenuActivated = true;
  	hideScrollTop = true; 
  	checkScroll();
  	var timeoutSearch = setTimeout(function(){ }, 100);

    setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

  	$('.main-btn-toogle-map').click(function(e){ showMap(); });
  	
  	showTagsScopesMin("#list_tags_scopes");
  
    $('#btn-start-search').click(function(e){
        startSearch();
    });
    $('#link-start-search').click(function(e){
        startSearch();
    });
    $(".btn-geolocate").click(function(e){
    	initHTML5Localisation('prefillSearch');
    });

    $("#btn-slidup-scopetags").click(function(){
      if($("#list_filters").hasClass("hidden")){
        $("#list_filters").removeClass("hidden");
        $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
      }
      else{
        $("#list_filters").addClass("hidden");
        $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
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

    $(".btn-activate-communexion").click(function(){
      //toogleCommunexion();
    });
    
    setTitle("<span id='main-title-menu'>L'Actualité</span> <span class='text-red'>COMMUNE</span>CTÉE","rss","L'Actualité COMMUNECTÉE");
	  selectScopeLevelCommunexion(levelCommunexion);
});


var timeout;
function startSearch(){
	//Modif SBAR
  //$(".my-main-container").off();
	var name = $('#searchBarText').val();
	if(inseeCommunexion != ""){
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
	      showNewsStream(name, locality);
	    }else{
	      
	    }   
    }
}


function showNewsStream(name,locality){
	
  var dataNewsSearch = {
      "tagSearch" : name, 
      "searchLocalityCITYKEY" : $('#searchLocalityCITYKEY').val().split(','),
      "searchLocalityCODE_POSTAL" : $('#searchLocalityCODE_POSTAL').val().split(','), 
      "searchLocalityDEPARTEMENT" : $('#searchLocalityDEPARTEMENT').val().split(','),
      "searchLocalityREGION" : $('#searchLocalityREGION').val().split(','),
      "searchType" : searchType,
  };

	$("#newsstream").html("<div class='loader text-dark '>"+
		"<span style='font-size:25px;' class='homestead'>"+
			"<i class='fa fa-spin fa-circle-o-notch'></i> "+
			"<span class='text-dark'>Chargement en cours ...</span>" + 
	"</div>");
	ajaxPost("#newsstream",baseUrl+"/"+moduleId+"/news/index/type/city?isFirst=1",dataNewsSearch, null,"html");
	$("#dropdown_search").hide(300);
}

function addSearchType(type){
  var index = searchType.indexOf(type);
  if (index == -1) {
    searchType.push(type);
    $(".search_"+type).removeClass("fa-circle-o");
    $(".search_"+type).addClass("fa-check-circle-o");
  }
    console.log(searchType);
}
function removeSearchType(type){
  var index = searchType.indexOf(type);
  if (index > -1) {
    searchType.splice(index, 1);
    $(".search_"+type).removeClass("fa-check-circle-o");
    $(".search_"+type).addClass("fa-circle-o");
  }
  console.log(searchType);
}


</script>

