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
		float: left;
		padding: 1px;
		width: 24px;
		margin-top: 15px;
	}
  .img-logo {
    height: 290px;
  }
  .btn-filter-type{
    height:35px;
  }
  .btn-scope{
    display: inline;
  }
  .lbl-scope-list {
    top: 255px;
  }
  .btn-tag{
    font-weight:300;
    padding-left: 0px;
  }
  .btn-tag.bold{
    font-weight:600;
  }
  
  @media screen and (max-width: 1024px) {
    #menu-directory-type .hidden-sm{
     display:none;
    }
  }

@media screen and (max-width: 767px) {
  .searchEntity{
        /*margin-left: 25px !important;*/
  }
  #searchBarText{
    font-size:13px !important;
    margin-right:-30px;
  }
  /*.btn-add-to-directory {
      position: absolute;
      right: 0px;
      z-index:9px !important;
  }*/
}

</style>

<div class="col-md-12">
  <div class="col-md-12 no-padding margin-top-15">

    <div class="input-group margin-bottom-10 col-md-8 col-sm-8 col-xs-12 pull-left">
      <input id="searchBarText" data-searchPage="true" type="text" placeholder="Que recherchez-vous ?" class="input-search form-control">
      <span class="input-group-btn">
            <button class="btn btn-success btn-start-search tooltips" id="btn-start-search"
                    data-toggle="tooltip" data-placement="bottom" title="Actualiser les résultats">
                    <i class="fa fa-refresh"></i>
            </button>
      </span>
    </div>
    <button class="btn btn-sm tooltips hidden-xs" id="btn-slidup-scopetags" 
            style="margin-left:15px;margin-top:5px;"
            data-toggle="tooltip" data-placement="bottom" title="Afficher/Masquer les filtres">
            <i class="fa fa-minus"></i>
    </button>
    <button data-id="explainDirectory" class="explainLink btn btn-sm tooltips hidden-xs" 
            style="margin-left:7px;margin-top:5px;"
            data-toggle="tooltip" data-placement="bottom" title="Comment ça marche ?">
          <i class="fa fa-question-circle"></i>
    </button>
  </div>

  <div class="col-md-12 col-sm-12 col-xs-12 no-padding " id="list_filters">
    <div class="col-md-12 no-padding margin-bottom-15 " style="margin-top: 6px; margin-bottom: 0px; margin-left: 0px;">
      <div class="btn-group inline-block" id="menu-directory-type">
        <button class="btn btn-default btn-filter-type tooltips text-dark" 
                data-toggle="tooltip" data-placement="top" title="Citoyens" type="persons">
          <i class="fa fa-check-circle-o search_persons"></i> <i class="fa fa-user"></i> 
          <span class="hidden-xs">Citoyens</span>
        </button>
        <button class="btn btn-default btn-filter-type tooltips text-dark" 
                data-toggle="tooltip" data-placement="top" title="Organisations" type="organizations">
          <i class="fa fa-check-circle-o search_organizations"></i> <i class="fa fa-group"></i> 
          <span class="hidden-xs">Organisations</span>
        </button>
        <button class="btn btn-default btn-filter-type tooltips text-dark" 
                data-toggle="tooltip" data-placement="top" title="Projets" type="projects">
          <i class="fa fa-check-circle-o search_projects"></i> <i class="fa fa-lightbulb-o"></i> 
          <span class="hidden-xs">Projets</span>
        </button>
        <button class="btn btn-default btn-filter-type tooltips text-dark" 
                data-toggle="tooltip" data-placement="top" title="Évènements" type="events">
          <i class="fa fa-check-circle-o search_events"></i> <i class="fa fa-calendar"></i> 
          <span class="hidden-xs">Évènements</span>
        </button>
      </div>
      
    </div>
    <div id="list_tags_scopes" class="hidden-xs list_tags_scopes"></div>

  </div>
  
<div class="col-md-12 col-sm-12 col-xs-12 no-padding"><hr></div>

</div>

<div style="" class="col-md-12 col-sm-12 col-xs-12 margin-top-15" id="dropdown_search"></div>

<?php //$this->renderPartial(@$path."first_step_directory"); ?> 

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

	setTitle("<span id='main-title-menu'>Rechercher</span>","search","Rechercher");
	
  $('.tooltips').tooltip();

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

//  if(userId != 'null')
  showTagsScopesMin("#list_tags_scopes");
  
  $('#btn-start-search').click(function(e){
      //signal que le chargement est terminé
      loadingData = false;
      startSearch(0, indexStepInit);
  });

  // $('#link-start-search').click(function(e){
  //     startSearch(0, indexStepInit);
  // });

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
  
  $(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
  $(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");
    $('.tooltips').tooltip();
    searchPage = true;
  //initBtnToogleCommunexion();
  //$(".btn-activate-communexion").click(function(){
  //  toogleCommunexion();
  //});

  //initBtnScopeList();
  //startSearch(0, 100);
});

function searchCallback() { 
  console.log("searchCallback");
  startSearch(0, indexStepInit);
}

function showResultInCalendar(mapElements){}

</script>







