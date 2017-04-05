    <?php 
  $cssAnsScriptFilesModule = array(
    '/assets/css/default/responsive-calendar.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
  
  $cssAnsScriptFilesModule = array(
    '/js/default/directory.js',
    '/js/default/responsive-calendar.js',
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
  #scopeListContainer span.text-red.disabled{
    color:#DBBCC1 !important;
    font-weight:300 !important;
  }
  @media screen and (max-width: 1024px) {
    #menu-directory-type .hidden-sm{
     display:none;
    }
  }

/*responsive calendar*/



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


<div class="row calendar"></div>
<div class="responsive-calendar-init hidden"> 
  <div class="responsive-calendar col-md-12 no-padding">   
      <div class="day-headers">
        <div class="day header">Lun</div>
        <div class="day header">Mar</div>
        <div class="day header">Mer</div>
        <div class="day header">Jeu</div>
        <div class="day header">Ven</div>
        <div class="day header">Sam</div>
        <div class="day header">Dim</div>
      </div>
      <div class="days" data-group="days"></div>   
      <div class="controls">
          <a id="btn-month-before" class="" data-go="prev"><div class="btn"><i class="fa fa-arrow-left"></i></div></a>
          <h4 class="text-white"><span data-head-month></span> <span data-head-year></span></h4>
          <a id="btn-month-next" class="" data-go="next"><div class="btn"><i class="fa fa-arrow-right"></i></div></a>
          <a href="javascript:loadByHash('#event.eventsv');" class="btn text-white pull-right" style="margin-top:3px;">
            <i class="fa fa-plus"></i> <i class="fa fa-calendar"></i> ajouter un événement
          </a>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="col-md-12 no-padding margin-top-15 ">

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
  
  <div class="col-xs-12 no-padding " id="list_filters">
    <div id="scopeListContainer" class="hidden-xs list_tags_scopes inline-block"></div>
    <div class='city-name-locked homestead text-red'></div>
  </div>
  
<div class="col-xs-12 no-padding"><hr></div>

</div>

<div style="" class="col-xs-12 no-padding no-margin" id="dropdown_search"></div>

<?php //$this->renderPartial(@$path."first_step_directory"); ?> 
<?php  $city = @$_GET['lockCityKey'] ? City::getByUnikey($_GET['lockCityKey']) : null; 
       //$cityName = ($city!=null) ? $city["name"].", ".$city["cp"] : "";
       $cityName = (($city!=null) ? $city["name"]. (@$city["cp"]? ", ".$city["cp"] : "") : "");
?> 

<script type="text/javascript">

var searchType = [ "events" ];
var allSearchType = [ "events" ];
var personCOLLECTION = "<?php echo Person::COLLECTION ?>";
var userId = '<?php echo isset( Yii::app()->session["userId"] ) ? Yii::app() -> session["userId"] : null; ?>';
var lockCityKey = <?php echo (@$_GET['lockCityKey']) ? "'".$_GET['lockCityKey']."'" : "null" ?>;
var cityNameLocked = "<?php echo $cityName; ?>";

jQuery(document).ready(function() {

  $("#searchBarText").val($(".input-global-search").val());

  //selectScopeLevelCommunexion(levelCommunexion);  
  searchType = [ "events" ];
  allSearchType = [ "events" ];

  topMenuActivated = true;
  hideScrollTop = true; 
  loadingData = false;

  checkScroll();
  var timeoutSearch = setTimeout(function(){ }, 100);
  
  setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

  setTitle("<span id='main-title-menu'>Agenda</span>","calendar","Agenda");
  
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

  // $('#link-start-search').click(function(e){
  //     startSearch(0, indexStepInit);
  // });

  $(".my-main-container").bind('scroll', function(){
    if(!loadingData && !scrollEnd){
        var heightContainer = $(".my-main-container")[0].scrollHeight;
        var heightWindow = $(window).height();
        
        if(scrollEnd == false){
          var heightContainer = $(".my-main-container")[0].scrollHeight;
          var heightWindow = $(window).height();
          if( ($(this).scrollTop() + heightWindow) >= heightContainer-150){
            mylog.log("scroll MAX");
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
 
  //$(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
  //$(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");
  $('.tooltips').tooltip();
  searchPage = true;

  //initBtnToogleCommunexion();
  //$(".btn-activate-communexion").click(function(){
  //  toogleCommunexion();
  //});

  //initBtnScopeList();
  startSearch(0, 30);
});


var calendarInit = false;
function showResultInCalendar(mapElements){
  //mylog.log("showResultInCalendar");
  //mylog.dir(mapElements);

  var events = new Array();
  $.each(mapElements, function(key, thisEvent){
    
    var startDate = exists(thisEvent["startDate"]) ? thisEvent["startDate"].substr(0, 10) : "";
    var endDate = exists(thisEvent["endDate"]) ? thisEvent["endDate"].substr(0, 10) : "";
    var cp = "";
    var loc = "";
	if(thisEvent["address"] != null){
    	var cp = exists(thisEvent["address"]["postalCode"]) ? thisEvent["address"]["postalCode"] : "" ;
		var loc = exists(thisEvent["address"]["addressLocality"]) ? thisEvent["address"]["addressLocality"] : "";
	}
    var position = cp + " " + loc;

    var name = exists(thisEvent["name"]) ? thisEvent["name"] : "";
    var thumb_url = notEmpty(thisEvent["profilThumbImageUrl"]) ? baseUrl+thisEvent["profilThumbImageUrl"] : "";
    
    if(typeof events[startDate] == "undefined") events[startDate] = new Array();
    events[startDate].push({  "id" : thisEvent["_id"]["$id"],
                              "thumb_url" : thumb_url, 
                              "startDate": startDate,
                              "endDate": endDate,
                              "name" : name,
                              "position" : position });
  });

  //mylog.dir(events);

  if(calendarInit == true) {
    $(".calendar").html("");
  }

  $(".calendar").html($(".responsive-calendar-init").html());

  var aujourdhui = new Date();
  var  month = (aujourdhui.getMonth()+1).toString();
  if(aujourdhui.getMonth() < 10) month = "0" + month;
  var date = aujourdhui.getFullYear().toString() + "-" + month;
  
  $(".responsive-calendar").responsiveCalendar({
          time: date,
          events: events
        });


  $(".responsive-calendar").show();

  calendarInit = true;
}



function searchCallback() { 
  mylog.log("searchCallback");
  startSearch(0, indexStepInit);
}
</script>







