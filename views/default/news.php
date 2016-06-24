<?php 
$cssAnsScriptFilesModule = array(
  
  '/plugins/select2/select2.min.js'

);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
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

@media screen and (max-width: 1024px) {
  button.btn-start-search {
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
  }


}

.lbl-scope-list{
    top:250px !important;
  }

  #btn-filter-scope-news{
    display:none;
  }

</style>
<div class="lbl-scope-list text-red"></div>

<div class="img-logo bgpixeltree_little">
	<button data-id="explainNews" class="explainLink menu-button btn-infos bg-red tooltips hidden-xs" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>

	<input id="searchBarText" type="text" placeholder="Recherche par tags" class="input-search text-red">
	
	<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>
</div>
<div class="col-md-12 center" style="margin-top: 20px; margin-bottom: 0px; margin-left: 0px;">
    <div class="btn-group inline-block" id="menu-directory-type">
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="News" type="news">
        <i class="fa fa-check-circle-o search_news"></i> <i class="fa fa-rss"></i> <span class="hidden-xs hidden-sm">News</span>
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
	  <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Needs" type="needs">
        <i class="fa fa-check-circle-o search_needs"></i> <i class="fa fa-cubes"></i> <span class="hidden-xs hidden-sm">Needs</span>
      </button>
    </div>
  </div>

<?php //$this->renderPartial("first_step_news"); ?> 
<?php //$this->renderPartial("news/index"); ?> 


<div class="" id="dropdown_search"></div>
<div class="col-md-12" id="newsstream"></div>


<script type="text/javascript">
var searchType = ["organizations", "projects", "events", "needs", "news"];
jQuery(document).ready(function() {
  	topMenuActivated = true;
  	hideScrollTop = true; 
  	checkScroll();
  	var timeoutSearch = setTimeout(function(){ }, 100);

    setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

  	$('.main-btn-toogle-map').click(function(e){ showMap(); });
  	
  	
  	$('#searchBarText').keyup(function(e){
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
    	initHTML5Localisation('prefillSearch');
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
    
    $(".moduleLabel").html("<i class='fa fa-rss'></i> <span id='main-title-menu'>L'Actualité</span> <span class='text-red'>COMMUNE</span>CTÉE");
	selectScopeLevelCommunexion(levelCommunexion);
});


var timeout;
function startSearch(){
	$(".my-main-container").off();
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
	var dataNewsSearch = {"tagSearch" : name, "locality" : locality, "searchType" : searchType, "searchBy" : levelCommunexionName[levelCommunexion]};
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

