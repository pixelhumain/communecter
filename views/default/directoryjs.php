<?php 
 $cssAnsScriptFilesModule = array(
    '/js/default/directory.js',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

  HtmlHelper::registerCssAndScriptsFiles( array('/css/default/directory.css', ) , 
                                          Yii::app()->theme->baseUrl. '/assets');

?>  
  
  <?php if(@$_GET['type']!="") { ?>
      <?php $typeSelected = $_GET['type']; ?>
      <?php if($typeSelected == "persons") $typeSelected = "citoyens" ; ?>
      <?php $spec = Element::getElementSpecsByType($typeSelected); ?>
      <h2 class="text-left pull-left" style="margin-left:10px; margin-top:15px; width:90%;">
        <span class="subtitle-search text-<?php echo $spec["text-color"]; ?> homestead">
          <i class="fa fa-angle-down"></i> 
          <?php 
            $typeName = Yii::t("common",$_GET['type']); 
            if($_GET['type'] == "vote") $typeName = "propositions";
            if($_GET['type'] == "cities") $typeName = "communes";
          ?>
          <i class="fa fa-<?php echo $spec["icon"]; ?>"></i> Liste des  <?php echo $typeName; ?>
        </span>
      </h2>
     <?php } ?>

  <div class="container-result-search">

	  	<div class="col-md-12 padding-10 margin-bottom-5 lbl-info-search">
		    <div class="lbl-info lbl-info-vote lbl-info-actions pull-left hidden col-xs-9 no-padding margin-bottom-10">
		      <i class="fa fa-chevron-down"></i> 
		      <i class="fa fa-info-circle"></i> 
		      <b>Seuls les résultats auxquels vous avez accès sont affichés</b> <br>
		      (issus de vos <span class="text-green"><b>organisations</b></span>, 
		      vos <span class="text-purple"><b>projets</b></span> ou votre <span class="text-red"><b>conseil citoyen</b></span>)
		    </div>

		    <div class="lbl-info lbl-info-organizations lbl-info-projects lbl-info-persons pull-left hidden col-xs-9 no-padding margin-bottom-10">
		      <i class="fa fa-chevron-down"></i> 
		      <i class="fa fa-info-circle"></i> 
		      <b>Résultats triés en fonction de l'activité la plus récente des éléments recherchés</b> 
		    </div>

		    <div class="lbl-info lbl-info-cities pull-left hidden col-xs-9 no-padding margin-bottom-10">
		      <i class="fa fa-info-circle"></i> Indiquez le nom d'une commune, ou un code postal, pour lancer la recherche
		    </div> 

		    <button class="btn btn-default pull-right text-azure" onclick="showMap(true)" style="margin-bottom: -15px;margin-top: -10px;">
		      <i class="fa fa-map-marker"></i>
		      <span class="hidden-xs"> Afficher <span class="hidden-sm hidden-xs">sur</span> la carte</span>
		    </button>
	  	</div>
		<div id="listTags" class="hide col-sm-2 hide"></div>
		<div style="" class="row no-padding" id="dropdown_search"></div>

  </div>

<?php //$this->renderPartial(@$path."first_step_directory"); ?> 
<?php $city = (@$_GET['lockCityKey'] ? City::getByUnikey($_GET['lockCityKey']) : null);

      if($city == null && @$_GET['insee'])
        $city = City::getCityByInsee($_GET['insee']);
      
      $cityName = (($city!=null) ? $city["name"]. (@$city["cp"]? ", ".$city["cp"] : "") : "");
?>

<script type="text/javascript">

var headerParams = {
  "persons"       : { color: "yellow",  icon: "user",         name: "citoyens" },
  "organizations" : { color: "green",   icon: "group",        name: "organisations" },
  "NGO"           : { color: "green",   icon: "group",        name: "associations" },
  "LocalBusiness" : { color: "azure",   icon: "industry",     name: "entreprises" },
  "Group"         : { color: "black",   icon: "circle-o",     name: "Groupes" },
  "projects"      : { color: "purple",  icon: "lightbulb-o",  name: "projets" },
  "events"        : { color: "orange",  icon: "calendar",     name: "événements" },
  "vote"          : { color: "azure",   icon: "gavel",        name: "Propositions, Questions, Votes" },
  "actions"       : { color: "lightblue2",    icon: "cogs",   name: "actions" },
  "cities"        : { color: "red",     icon: "university",   name: "communes" },
  "poi"       	  :	{ color: "black",   icon: "map-marker",   name: "points d'intérêts" },
  "classified"    : { color: "lightblue2",   icon: "bullhorn",   name: "Annonces" }
}

if( notNull(theme) && notNull(theme.headerParams) )
{
  $.each(theme.headerParams,function(k,v) 
  { 
    headerParams[k] = v;
  });
}

function setHeaderDirectory(type){
 
  var params = new Array();
  if(typeof headerParams[type] == "undefined") return;
  params = headerParams[type];
  $(".subtitle-search").html( '<span class="text-'+params.color+' homestead">'+
                                '<i class="fa fa-angle-down"></i> <i class="fa fa-'+params.icon+'"></i> '+
                                params.name+
                                " <i class='fa fa-angle-right'></i> <a href='javascript:directory.showFilters()' class='btn btn-default'> <i class='fa fa-search'></i> <i class='fa fa-tags'></i> </a>"+
                              '</span>' );

  $(".lbl-info-search .lbl-info").addClass("hidden");
  $(".lbl-info-search .lbl-info.lbl-info-"+type).removeClass("hidden");

  $("#dropdown_search").html("");

  if(type == "cities") { 
    $("#searchBarText").attr("placeholder", "rechercher une ville, un code postal..."); 
    $("#scopeListContainer, #btn-slidup-scopetags").hide(200);
  }else{ 
    $("#searchBarText").attr("placeholder", "rechercher par #tag ou mots clés..."); 
    $("#scopeListContainer, #btn-slidup-scopetags").show(200);
  }

  $(".menu-left-container #menu-extend .menu-button-left").removeClass("selected");
  $(".menu-left-container #menu-extend #menu-btn-"+type).addClass("selected");

  $(".my-main-container").scrollTop(0);

  Sig.clearMap();

}

var searchType = [ "persons" ];
var allSearchType = [ "persons", "organizations", "projects", "events", "vote", "cities" ];

var personCOLLECTION = "<?php echo Person::COLLECTION ?>";
var userId = '<?php echo isset( Yii::app()->session["userId"] ) ? Yii::app() -> session["userId"] : null; ?>';
var lockCityKey = <?php echo (@$_GET['lockCityKey']) ? "'".$_GET['lockCityKey']."'" : "null" ?>;
var cityNameLocked = "<?php echo $cityName; ?>";
var typeSelected = <?php echo (@$_GET['type']) ? "'".$_GET['type']."'" : "null" ?>;

jQuery(document).ready(function() {

	
	currentTypeSearchSend = "search";


  $("#btn-slidup-scopetags").click(function(){
    slidupScopetagsMin();
  });


  searchType = (typeSelected == null) ? [ "persons" ] : [ typeSelected ];
  allSearchType = [ "persons", "organizations", "projects", "events", "events", "vote", "cities","poi" ];
	topMenuActivated = true;
	hideScrollTop = true; 
  loadingData = false;

	checkScroll();
  var timeoutSearch = setTimeout(function(){ }, 100);
  
  setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

	setTitle("<span id='main-title-menu'>Moteur de recherche</span>","search","Moteur de recherche");
	
  $('.tooltips').tooltip();

  setHeaderDirectory(typeSelected);  

  showTagsScopesMin("#scopeListContainer");

  if(lockCityKey != null){
    lockScopeOnCityKey(lockCityKey, cityNameLocked);
  }else{
    rebuildSearchScopeInput();
  }


  $(".my-main-container").bind('scroll', function(){
    if(!loadingData && !scrollEnd){
        var heightContainer = $(".my-main-container")[0].scrollHeight;
        var heightWindow = $(window).height();
        
        if(scrollEnd == false){
          var heightContainer = $(".my-main-container")[0].scrollHeight;
          var heightWindow = $(window).height();
          if( ($(this).scrollTop() + heightWindow) >= heightContainer-150){
            mylog.log("scroll MAX");
            startSearch(currentIndexMin+indexStep, currentIndexMax+indexStep,searchCallback);
          }
        } 
    }
  });

  
/*  $(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
  $(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");*/
  $('.tooltips').tooltip();
  searchPage = true;


  //initBtnScopeList();
  indexStepInit = 100;
  startSearch(0, indexStepInit, searchCallback);
});

function searchCallback() { 
  directory.elemClass = '.searchEntityContainer ';
  directory.filterTags(true);
  $(".btn-tag").off().on("click",function(){ directory.toggleEmptyParentSection(null,"."+$(this).data("tag-value"),".searchEntityContainer",1)});
  $("#searchBarTextJS").off().on("keyup",function() { 
    directory.search ( null, $(this).val() );
  });
}

</script>







