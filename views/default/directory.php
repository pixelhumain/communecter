<?php 
  $cssAnsScriptFilesModule = array(
    '/css/default/directory.css',
    '/js/default/directory.js',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

  <style>
  	
  </style>
  
  <div class="col-md-12 col-sm-12 col-xs-12 no-padding hidden" id="list_filters">

    <div class="col-md-12 no-padding margin-bottom-15 " style="margin-top: 6px; margin-bottom: 0px; margin-left: 0px;">

      <div class="btn-group inline-block" id="menu-directory-type">
        <button class="btn btn-default btn-filter-type tooltips bg-green search_organizations" 
                data-toggle="tooltip" data-placement="bottom" title="Organisations" type="organizations">
          <!-- <i class="fa fa-check-circle-o search_organizations"></i>  -->
          <i class="fa fa-group"></i> 
          <span class=" hidden-xs">Organisations</span>
        </button>
        <button class="btn btn-default btn-filter-type tooltips bg-purple search_projects" 
                data-toggle="tooltip" data-placement="bottom" title="Projets" type="projects">
          <!-- <i class="fa fa-check-circle-o search_projects"></i>  -->
          <i class="fa fa-lightbulb-o"></i> 
          <span class=" hidden-xs">Projets</span>
        </button>
        <button class="btn btn-default btn-filter-type tooltips bg-yellow search_persons active" 
                data-toggle="tooltip" data-placement="bottom" title="Citoyens" type="persons">
          <!-- <i class="fa fa-check-circle-o search_persons"></i>  -->
          <i class="fa fa-user"></i> 
          <span class=" hidden-xs">Citoyens</span>
        </button>
        <button class="btn btn-default btn-filter-type tooltips bg-azure search_proposals" 
                data-toggle="tooltip" data-placement="bottom" title="Débat" type="proposals">
          <!-- <i class="fa fa-check-circle-o search_events"></i>  -->
          <i class="fa fa-gavel"></i> 

          <span class=" hidden-xs">Débats</span>
        </button>
        <button class="btn btn-default btn-filter-type tooltips bg-lightblue2 search_actions" 
                data-toggle="tooltip" data-placement="bottom" title="Actions" type="actions">
          <!-- <i class="fa fa-check-circle-o search_events"></i>  -->
          <i class="fa fa-cogs"></i> 

          <span class=" hidden-xs">Actions</span>
        </button>
      </div>

      <div class="btn-group inline-block hidden" id="menu-directory-type-city" style="margin-bottom:5px;">
        <button class="btn btn-default btn-filter-type tooltips text-red" 
                data-toggle="tooltip" data-placement="bottom" title="Je cherche une commune" type="cities">
          <i class="fa fa-circle-o search_cities"></i> <i class="fa fa-university"></i> 
          <span class="hidden-xs">Je cherche une commune</span>
        </button>
      </div>
    </div>

  </div>

  <?php if(@$_GET['type']!="") { ?>
      <?php $typeSelected = $_GET['type']; ?>
      <?php if($typeSelected == "persons") $typeSelected = "citoyens" ; ?>
      <?php $spec = Element::getElementSpecsByType($typeSelected); ?>
      <h2 class="text-left pull-left" style="margin-left:10px; margin-top:15px; width:90%;">
        <span class="subtitle-search text-<?php echo $spec["text-color"]; ?> homestead">
          <i class="fa fa-angle-down"></i> 
          <?php 
            $typeName = Yii::t("common",$_GET['type']); 
            if($_GET['type'] == "vote") $typeName = "débats";
          ?>
          <i class="fa fa-<?php echo $spec["icon"]; ?>"></i> Liste des  <?php echo $typeName; ?>
        </span>
      </h2>
     <?php } ?>

  <div class="col-md-12 no-padding pull-left" style="margin-top:0px; width:100%;">

    <div class="input-group margin-bottom-10 col-md-8 col-sm-8 col-xs-8 pull-left">
      <input id="searchBarText" data-searchPage="true" type="text" placeholder="rechercher par #tag ou mots clés..." class="input-search form-control">
      <span class="input-group-btn">
            <button class="btn btn-success btn-start-search tooltips" id="btn-start-search"
                    data-toggle="tooltip" data-placement="top" title="Actualiser les résultats">
                    <i class="fa fa-refresh"></i>
            </button>
      </span>
    </div>
    <select class="pull-left" id="stepSearch" style="margin: 2px 0px 5px 15px; padding: 6px;">
      <option value="30">30</option>
      <option value="100">100</option>
      <option value="500">500</option>
      <option value="1000">1000</option>
      <option value="10000">Tout</option>
    </select>
    <button class="btn btn-sm tooltips hidden-xs" id="btn-slidup-scopetags" 
            style="margin-left:15px;margin-top:5px;"
            data-toggle="tooltip" data-placement="top" title="Afficher/Masquer les filtres">
            <i class="fa fa-minus"></i>
    </button>
    <button data-id="explainDirectory" class="explainLink btn btn-sm tooltips hidden-xs" 
            style="margin-left:7px;margin-top:5px;"
            data-toggle="tooltip" data-placement="top" title="Comment ça marche ?">
          <i class="fa fa-question-circle"></i>
    </button>
  </div>

    
  <div class="col-md-12 col-sm-12 col-xs-12 no-padding" style="margin-bottom: 20px;">

    <div class='city-name-locked homestead text-red'></div>
    <div id="scopeListContainer" class="hidden-xs list_tags_scopes"></div>
    
  </div>
  
 
  <div class="container-result-search">
    <?php  if(@$_GET['type'] == "vote" || @$_GET['type'] == "actions"){ ?>
      <div class="col-md-12 padding-10">
        <i class="fa fa-info-circle"></i> 
        <b>Seuls les résultats auxquels vous avez accès sont affichés</b> 
        (issus de vos <span class="text-green"><b>organisations</b></span>, 
        vos <span class="text-purple"><b>projets</b></span> ou votre <span class="text-red"><b>conseil citoyen</b></span>)
      </div>
    <?php } ?>
    <div style="" class="row no-padding" id="dropdown_search"></div>
  </div>

<?php //$this->renderPartial(@$path."first_step_directory"); ?> 
<?php  $city = @$_GET['lockCityKey'] ? City::getByUnikey($_GET['lockCityKey']) : null; 
       $cityName = ($city!=null) ? $city["name"].", ".$city["cp"] : "";
?>

<script type="text/javascript">

var searchType = [ "persons" ];
var allSearchType = [ "persons", "organizations", "projects", "events", "vote", "cities" ];

var personCOLLECTION = "<?php echo Person::COLLECTION ?>";
var userId = '<?php echo isset( Yii::app()->session["userId"] ) ? Yii::app() -> session["userId"] : null; ?>';
var lockCityKey = <?php echo (@$_GET['lockCityKey']) ? "'".$_GET['lockCityKey']."'" : "null" ?>;
var cityNameLocked = "<?php echo $cityName; ?>";
var typeSelected = <?php echo (@$_GET['type']) ? "'".$_GET['type']."'" : "null" ?>;

jQuery(document).ready(function() {

  $("#searchBarText").val($(".input-global-search").val());

  $("#btn-slidup-scopetags").click(function(){
    slidupScopetagsMin();
  });


  searchType = (typeSelected == null) ? [ "persons" ] : [ typeSelected ];
  allSearchType = [ "persons", "organizations", "projects", "events", "events", "vote", "cities" ];
	topMenuActivated = true;
	hideScrollTop = true; 
  loadingData = false;

	checkScroll();
  var timeoutSearch = setTimeout(function(){ }, 100);
  
  setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

	setTitle("<span id='main-title-menu'>Moteur de recherche</span>","search","Moteur de recherche");
	
  $('.tooltips').tooltip();

  // $("#btn-slidup-scopetags").click(function(){
  //   if($("#list_filters").hasClass("hidden")){
  //     $("#list_filters").removeClass("hidden");
  //     $("#btn-slidup-scopetags").html("<i class='fa fa-minus'></i>");
  //   }
  //   else{
  //     $("#list_filters").addClass("hidden");
  //     $("#btn-slidup-scopetags").html("<i class='fa fa-plus'></i>");
  //   }
  // });

  showTagsScopesMin("#scopeListContainer");

  if(lockCityKey != null){
    lockScopeOnCityKey(lockCityKey, cityNameLocked);
  }else{
    rebuildSearchScopeInput();
  }
  $('#btn-start-search').click(function(e){
      //signal que le chargement est terminé
      loadingData = false;
      startSearch(0, indexStepInit);
  });


  $(".my-main-container").bind('scroll', function(){
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
    //var index = searchType.indexOf(type);
    searchType [ type ];
    // if (index > -1) removeSearchType(type);
    // else addSearchType(type);
    //addSearchType(type);
    loadingData = false;
	  startSearch(0, indexStepInit);


  });

  
    $("#stepSearch").change(function(){ console.log("new stepSearch : " + $("#stepSearch").val());
      indexStepInit = parseInt($("#stepSearch").val());
    });
  
/*  $(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
  $(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");*/
  $('.tooltips').tooltip();
  searchPage = true;


  //initBtnScopeList();
  startSearch(0, 30);
});

function searchCallback() { 
  console.log("searchCallback");
  startSearch(0, indexStepInit);
}

function showResultInCalendar(mapElements){}

</script>







