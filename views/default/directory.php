<?php 
  $cssAnsScriptFilesModule = array(
    //'/css/default/directory.css',
    '/js/default/directory.js',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

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
  .lbl-scope-list{
    top:305px;
  }
  .img-logo {
    height: 290px;
  }
  .btn-filter-type{
    height:44px;
  }
  .btn-scope{
    display: inline;
  }
  @media screen and (max-width: 1024px) {
    #menu-directory-type .hidden-sm{
     display:none;
    }
  }

@media screen and (max-width: 767px) {
  
  .btn-add-to-directory {
      position: absolute;
      right: 0px;
      z-index:9px !important;
  }
}

</style>

<!-- <h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-search"></i> Recherche</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉE</span></h1> -->

<div class="lbl-scope-list text-red"></div>

<!-- <button class="menu-button btn-menu btn-menu-top bg-azure tooltips main-btn-toogle-map"
		data-toggle="tooltip" data-placement="right" title="Carte">
		<i class="fa fa-map-marker"></i>
</button> -->

<div class="img-logo bgpixeltree_little">
	
  <button data-id="explainDirectory" class="explainLink menu-button btn-infos  bg-red tooltips hidden-xs" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>
	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search">
	
  <button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button></br>


  <div class="col-md-12 center" style="margin-top: 6px; margin-bottom: 0px; margin-left: 0px;">
    <div class="btn-group inline-block" id="menu-directory-type">
      <button class="btn btn-default btn-filter-type tooltips text-dark" data-toggle="tooltip" data-placement="top" title="Citoyens" type="persons">
        <i class="fa fa-check-circle-o search_persons"></i> <i class="fa fa-user"></i> <span class="hidden-xs hidden-sm">Citoyens</span>
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
    </div>
  </div>

</div>


<div style="" class="col-md-12" id="dropdown_search"></div>

<?php $this->renderPartial(@$path."first_step_directory"); ?> 

<script type="text/javascript">

var searchType = [ "persons", "organizations", "projects", "events" ];
var allSearchType = [ "persons", "organizations", "projects", "events" ];
var personCOLLECTION = "<?php echo Person::COLLECTION ?>";
var userId = '<?php echo isset( Yii::app()->session["userId"] ) ? Yii::app() -> session["userId"] : null; ?>';

jQuery(document).ready(function() {

  $("#searchBarText").val($(".input-global-search").val());

  selectScopeLevelCommunexion(levelCommunexion);

  searchType = [ "persons", "organizations", "projects", "events" ];
  allSearchType = [ "persons", "organizations", "projects", "events" ];

	topMenuActivated = true;
	hideScrollTop = true; 
  loadingData = false;

	checkScroll();
  var timeoutSearch = setTimeout(function(){ }, 100);
  
  setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

	$(".moduleLabel").html("<i class='fa fa-search'></i> <span id='main-title-menu'>Recherche</span> <span class='text-red'>COMMUNE</span>CTÉE");

	$('.tooltips').tooltip();

	$('.main-btn-toogle-map').click(function(e){ showMap(); });

	$('#searchBarText').keyup(function(e){
      clearTimeout(timeoutSearch);
      timeoutSearch = setTimeout(function(){ startSearch(0, 100); }, 800);
  });
  
  $('#btn-start-search').click(function(e){
      //signal que le chargement est terminé
      loadingData = false;
      startSearch(0, 100);
  });

  $('#link-start-search').click(function(e){
      startSearch(0, 100);
  });

  $(".my-main-container").scroll(function(){
    if(!loadingData && !scrollEnd){
        var heightContainer = $(".my-main-container")[0].scrollHeight;
        var heightWindow = $(window).height();
        
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
 
  //initBtnToogleCommunexion();
  //$(".btn-activate-communexion").click(function(){
  //  toogleCommunexion();
  //});


  //initBtnScopeList();
  //startSearch(0, 100);

});
</script>







