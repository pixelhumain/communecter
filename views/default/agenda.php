<?php 
  $cssAnsScriptFilesModule = array(
    //'/css/default/directory.css',
    '/css/default/responsive-calendar.css',
    '/js/default/responsive-calendar.js',
    '/js/default/agenda.js',
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
  
  .btn-scope{
    display: inline;
  }


  .btn-month-before{
    position:absolute !important;
    top:160px;
    left:0%;
    font-size:19px;
    -moz-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
  }
  .btn-month-next{
    position:absolute !important;
    top:160px;
    right:0%;
    font-size: 19px;
    -moz-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    -webkit-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    -o-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
    filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
  }


@media screen and (max-width: 1024px) {
  .btn-month-before{
    position:absolute !important;
    top:100px;
    left:0%;
    font-size:19px;
  }
  .btn-month-next{
    position:absolute !important;
    top:100px;
    right:0%;
    font-size: 19px;
  }
  .lbl-scope-list {
      /*left: 53%;*/
      top: 210px !important;
      font-size: 20px;
    }
    .img-logo {
      height: 195px !important;
    }
  
}

@media screen and (max-width: 767px) {
  .img-logo {
    height: 125px !important;
  }
  .lbl-scope-list {
    top: 150px !important;
  }
  .responsive-calendar .open > .dropdown-menu {

    margin-left: -80px;
  }
}
</style>

<!-- <h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-calendar"></i> L'Agenda</h1>

<h1 class="homestead text-red  text-center" id="main-title-communect"
	style="font-size:50px; margin-top:0px;">COMMUNE<span class="text-dark">CTÉ</span></h1> -->

<div class="lbl-scope-list text-red"></div>

<div class="img-logo bgpixeltree_little">
	<!-- <button class="menu-button btn-activate-communexion bg-red tooltips" data-toggle="tooltip" data-placement="left" title="Activer / Désactiver la communection" alt="Activer / Désactiver la communection">
    <i class="fa fa-university"></i>
  </button> -->
	<button data-id="explainAgenda" class="explainLink menu-button btn-infos bg-red tooltips hidden-xs" data-toggle="tooltip" data-placement="left" title="Comment ça marche ?" alt="Comment ça marche ?">
		<i class="fa fa-question-circle"></i>
	</button>
	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="input-search"/>

	<button class="btn btn-primary btn-start-search" id="btn-start-search"><i class="fa fa-search"></i></button><br/>

  <button class="btn-month-before menu-button bg-dark tooltips" data-toggle="tooltip" data-placement="right" title="Mois précédent" alt="Mois précédent">
    <i class="fa fa-arrow-left"></i>
  </button>
  
  <button class="btn-month-next menu-button bg-dark tooltips" data-toggle="tooltip" data-placement="left" title="Mois suivant" alt="Mois suivant">
    <i class="fa fa-arrow-right"></i>
  </button>
  

</div>


<?php //$this->renderPartial("first_step_agenda"); ?> 

<div class="col-md-12 calendar">

</div>


<div class="responsive-calendar-init hidden"> 
  <div class="responsive-calendar col-md-8 col-md-offset-2">
      <div class="controls ">
        <a id="btn-month-before" class="hidden" data-go="prev"><div class="btn bg-dark"><i class="fa fa-arrow-left"></i></div></a>
        <h4 class="text-dark"><span data-head-month></span> <span data-head-year></span></h4>
        <a id="btn-month-next" class="hidden" data-go="next"><div class="btn bg-dark"><i class="fa fa-arrow-right"></i></div></a>
    </div>
      <hr/>
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
    </div>
    <!-- Responsive calendar - END -->
  </div>
</div>

<div style="" id="dropdown_search"></div>


<?php $this->renderPartial("first_step_agenda"); ?> 


<script type="text/javascript">


var searchType = [ "events" ];
var allSearchType = [ "events" ];
var personCOLLECTION = "<?php echo Person::COLLECTION ?>";
var userId = '<?php echo isset( Yii::app()->session["userId"] ) ? Yii::app() -> session["userId"] : null; ?>';


jQuery(document).ready(function() {
  
  selectScopeLevelCommunexion(levelCommunexion);
  
  searchType = [ "events" ];
  allSearchType = [ "events" ];

  topMenuActivated = true;
  hideScrollTop = true; 
  checkScroll();


  /*$(".responsive-calendar").responsiveCalendar({
          time: '2013-05',
          events: {
            "2013-04-30": {"number": 5, "url": "http://w3widgets.com/responsive-slider"},
            "2013-04-26": {"number": 1, "url": "http://w3widgets.com"}, 
            "2013-05-03":{"number": 1}, 
            "2013-06-12": {}}
        });
  */
  var timeoutSearch = setTimeout(function(){ }, 100);
  
  setTimeout(function(){ $("#input-communexion").hide(300); }, 300);
  
  $(".moduleLabel").html("<i class='fa fa-calendar'></i> <span id='main-title-menu'>L'Agenda</span> <span class='text-red'>COMMUNE</span>CTÉ");

  $(".btn-month-next").click(function(){
    $("#btn-month-next").click();
  });

  $(".btn-month-before").click(function(){
    $("#btn-month-before").click();
  });

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
      //signal que le chargement est terminé
      loadingData = false;
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

});

var calendarInit = false;
function showResultInCalendar(mapElements){
  console.log("showResultInCalendar");
  console.dir(mapElements);

  var events = new Array();
  $.each(mapElements, function(key, thisEvent){
    
    var startDate = thisEvent["startDate"].substr(0, 10);
    var endDate = thisEvent["endDate"].substr(0, 10);

    var position = thisEvent["address"]["postalCode"] + " " + thisEvent["address"]["addressLocality"];

    var name = (typeof thisEvent["name"] != "undefined") ? thisEvent["name"] : "";
    var thumb_url = (typeof thisEvent["profilThumbImageUrl"] != "undefined" && thisEvent["profilThumbImageUrl"] != "") ? baseUrl+thisEvent["profilThumbImageUrl"] : "";
    
    if(typeof events[startDate] == "undefined") events[startDate] = new Array();
    events[startDate].push({  "id" : thisEvent["_id"]["$id"],
                              "thumb_url" : thumb_url, 
                              "startDate": startDate,
                              "endDate": endDate,
                              "name" : name,
                              "position" : position });
  });

  console.dir(events);

  if(calendarInit == true) {
    $(".calendar").html("");
  }

  $(".calendar").html($(".responsive-calendar-init").html());
  $(".responsive-calendar").responsiveCalendar({
          time: '2016-04',
          events: events
        });


  $(".responsive-calendar").show();

  calendarInit = true;
}




</script>