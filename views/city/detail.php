 <div class="cityHeadSection"></div>
 <?php /* ?>
 <div class="col-md-12 main-title">
  <h2 class="panel-title">
    <i class="fa fa-university"></i> 
    <?php echo $city["name"]; ?>
    <a href='#' id="btn-center-city"><i class="fa fa-map-marker"></i></a>
  </h2>

 </div>
<?php */
Menu::city($city);
$this->renderPartial('../default/panels/toolbar'); 
?>


<?php 
    //rajoute un attribut typeSig sur chaque donnée pour déterminer quel icon on doit utiliser sur la carte
    //et pour ouvrir le panel info correctement
    foreach($people           as $key => $data) { $people[$key]["typeSig"] = PHType::TYPE_CITOYEN; }
    foreach($organizations    as $key => $data) { $organizations[$key]["typeSig"] = PHType::TYPE_ORGANIZATIONS; }
    foreach($events           as $key => $data) { $events[$key]["typeSig"] = PHType::TYPE_EVENTS; }
    foreach($projects         as $key => $data) { $projects[$key]["typeSig"] = PHType::TYPE_PROJECTS; }
    
    $contextMap = array();
    if(isset($organizations))   $contextMap = array_merge($contextMap, $organizations);
    if(isset($people))          $contextMap = array_merge($contextMap, $people);
    if(isset($events))          $contextMap = array_merge($contextMap, $events);
    if(isset($projects))        $contextMap = array_merge($contextMap, $projects);

    $randomOrganization = findOrgaRandImg($organizations, 1);
    function findOrgaRandImg($organizations, $try){
      $rand = rand(0, sizeof($organizations)-1);
      if(isset($organizations[$rand]) && isset($organizations[$rand]["profilImageUrl"])
           && $organizations[$rand]["profilImageUrl"] != "" || $try>50){
          //error_log("try : " .$try);
        return isset($organizations[$rand]) ? $organizations[$rand] : null;
      }else{
        return findOrgaRandImg($organizations, $try+1);
      }
    }

    //var_dump($randomOrganization);
    //die();
    //var_dump($people);var_dump($projects);
?>


<style type="text/css">

  #cityDetail .col-sm-4,#cityDetail .col-sm-8{
    padding:5px !important;
  }
  #cityDetail .panel{
    margin-bottom:10px !important;
  }

  .panel-title{
    font-family: "Homestead";
  }
  .link-to-directory{
    cursor:pointer;
  }
  .link-to-directory:hover{
    text-decoration: underline;
  }
  .btn-to-directory{
    width:100%;
    margin-top: 10px;
    font-weight: 500;
  }

  #btn-communecter{
    width: auto;
    font-size: 20px;
    border-radius: 10px;
    border: none;
    position: absolute;
    top: 105px;
    right: 5%;
    z-index:1;
    background-color: rgba(255, 255, 255, 0.63);
    padding-bottom: 5px;
    box-shadow: 0px 0px 3px 3px RGBA(114, 114, 114, 0.31);
  }
  #btn-communecter small{
    font-size:16px;
    word-break: normal;
  }
  #btn-communecter:hover{
    background-color: #E33551;
    color:white !important;
  }
  h1.cityName-header{
    background-color: rgba(255, 255, 255, 0.63);
    padding: 30px;
    margin-bottom: -3px;
    font-size: 32px;
  }

  h1.you-live{
    font-size: 18px !important;
    padding: 10px;
    border-radius: 0px;
    margin: -5px -5px 5px;
    font-weight: 300 !important;
    margin-bottom: 0px;
  }
  .why-communect{
    font-size:17px;
    font-weight: 300;
    margin-top:7px;
  }
  .margin-top-20{
    margin-top:20px !important;
  }
  .btn-discover-more {
    font-size:17px;
    white-space: unset;
  }
  .info-why{
    font-weight: 300;
    height: 80px;
  }
  @media screen and (max-width: 1024px) {
    #btn-communecter{
      font-size:17px;
    }
    h1.you-live{
      font-size:26px !important;
    }
    
  }

  #pod-local-actors .list-group-item {
      position: relative;
      padding: 10px 5px;
      margin-bottom: -1px;
      background-color: #FFF;
      border: 1px solid #DDD;
      display: inline-block;
      height: 125px;
      text-align: center;
      font-family: "homestead";
      font-size: 20px;
      border-radius: 0px;
      border-right: 0px;
      border-top: 0px;
      margin-top: 1px;
  }
#pod-local-actors .list-group-item:hover {
  z-index: 1;
  text-decoration: none !important;
  -moz-box-shadow: 0px 0px 5px -1px #656565;
  -webkit-box-shadow: 0px 0px 5px -1px #656565;
  -o-box-shadow: 0px 0px 5px -1px #656565;
  box-shadow: 0px 0px 5px -1px #656565;
  filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5);
}
  #pod-local-actors .list-group-item .badge {
    font-size: 14px;
    font-family: Helvetica;
    width: 50px;
    height: 20px;
    border-radius: 20px;
    padding-top: 5px;
    top: 11px;
    right: 20px;
    text-align: center;
  }


  .pod-local-actors .list-group-item .badge {
    font-size: 14px;
    font-family: Helvetica;
    width: 50px;
    height: 20px;
    border-radius: 20px;
    padding-top: 5px;
    top: 11px;
    right: 20px;
    text-align: center;
  }

  .leaflet-popup-content .pod-local-actors .list-group-item {
      position: relative;
      display: block;
      padding: 10px 5px;
      margin-bottom: -1px;
      background-color: #FFF;
      width: 50%;
      text-align: center;
      height: 60px;
      border: 1px solid #DDD;
      font-weight: 500;
  }
  /*view randomOrga*/

.cityHeadSection {  
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/cityDefaultHead_BW.jpg); 
  background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);
  background-color: #fff;
  background-repeat: no-repeat;
  background-position: 0px 50px;
  background-size: 100% auto;
}


#div-discover .btn-discover{
  border-radius: 60px;
  font-size: 50px;
  font-weight: 200;
  border: 1px solid transparent;
  width: 90px;
  height: 90px;
}
#div-discover .btn-discover:hover{
  background-color: white !important;
  border-color: #2BB0C6 !important;
  color: #2BB0C6 !important;
}


@media screen and (max-width: 768px) {
 h1.cityName-header{
  margin-top:-30px;
 }
 #pod-local-actors .list-group-item{
  height:90px;
  font-size:14px;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-weight: 300;
  text-transform: capitalize;
 }
 #btn-communecter{
    top:60px;
 }
}
</style>

<?php 
  $minCount = count($people);
  if(count($organizations) < $minCount) $minCount = count($organizations);
  if(count($projects) < $minCount) $minCount = count($projects);
  $minCount =100;
  $minCountOrga = $minCount;
  //if($minCount>6) $minCount=6;

  $countTotal = count($people) + count($organizations) + count($events);
?>
<!-- start: PAGE CONTENT -->

<div class="row padding-20" id="cityDetail">

 <?php //if(!isset(Yii::app()->session["userId"]) ){ // ?>
  <!-- <h1 class="homestead text-dark center you-live">Vous habitez ici ? <?php //echo $city["name"]; ?></h1> -->
  <a href="javascript:;" class="btn homestead text-red no-margin"
     insee-com="<?php echo $city['insee']; ?>" name-com="<?php echo $city['name']; ?>" cp-com="<?php if(@$city['cp']) echo $city['cp']; ?>" 
     id="btn-communecter" onclick="setScopeValue($(this));">
     <i class="fa fa-crosshairs"></i> COMMUNECTER
  </a>
<?php //} ?>

<div class="space20"></div>
<div class="col-sm-12 col-xs-12">

    <h1 class="homestead text-red cityName-header">
      <center><i class="fa fa-university"></i> <?php echo $city["name"]." "; ?></center>
    </h1>
   
    
    <!-- <h2 class="">
      <?php if(@$city["communected"]){ ?>
          <a href="javascript:;" onclick="loadByHash('#panel.box-connectedCity')" class="btn btn-azure homestead no-margin">
            EST COMMUNECTÉ <i class="fa fa-thumbs-o-up"></i>
          </a>
          <?php } else { ?>
          <a href="javascript:;" onclick="loadByHash('#panel.box-connectedCity')" class="btn homestead text-red no-margin">
            N'EST PAS ENCORE COMMUNNECTÉ <i class="fa fa-thumbs-o-down"></i>
          </a>
      <?php } ?>
    </h2> -->
</div>


  <!-- <div class="col-sm-12 col-xs-12">

    <?php if(!isset(Yii::app()->session["userId"]) ){ // ?>
        
    <div class="panel panel-white">
      <div>
        <div class="panel-heading border-light padding-5">
          <h2 class="homestead text-left text-blue"><i class="fa fa-info-circle"></i> Pourquoi se communecter ?</h2>
        </div>
      </div>
      <div class="panel-body">
        <div class="" style="padding:0px 40px 0px 40px; text-align:center;">
         
          <label class="margin-top-20 info-why col-md-6"><span class="why-communect homestead text-dark"><i class="fa fa-bookmark fa-rotate-270"></i> RÉPERTOIRE</span></br> Retrouvez facilement tous vos contacts grace à votre <b>répertoire personnel</b>.</label>
         
          <label class="margin-top-20 info-why col-md-6"><span class="why-communect homestead text-dark"><i class="fa fa-rss"></i> ACTUS</span></br> Ne ratez rien de l'actualité de vos contacts grace au <b>fil d'actualités</b>.</br>Participez aux discussions locales, proposez vos idées ...</label>
         
          <label class="margin-top-20 info-why col-md-6"><span class="why-communect homestead text-dark"><i class="fa fa-university"></i> MA COMMUNE</span> 
            
            </br> Gardez un oeil sur l'actualité de votre <b>commune</b> à chaque instant.
          </label>
          
          <label class="margin-top-20 info-why col-md-6"><span class="why-communect homestead text-dark"><i class="fa fa-lightbulb-o"></i> PROJETS</span></br> Faites connaître vos <b>projets personnels</b>, et découvrez ceux qui existent autour de vous.</label>
        
        </div>
      </div>
    </div>
    <?php } ?>
  </div> -->

<div class="col-sm-12 col-xs-12" id="pod-local-actors"  id="cityDetail_numbers">

    <div class="panel panel-white">
      <div id="local-actors-popup-sig">
        <div class="panel-heading text-center border-light">
          <h3 class="panel-title text-blue"><i class="fa fa-connectdevelop"></i> <?php echo strtolower (Yii::t("common", "LOCAL ACTORS")); ?></h3>
          <!-- <div class="panel-tools" style="display:block"> </div> -->
        </div>
        <div class="panel-body no-padding center">

          <ul class="list-group text-left no-margin">
            <li class="list-group-item text-yellow col-md-6 col-sm-6 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory?tpl=directory2&type=citoyens&insee=<?php echo $city["insee"]; ?>");'>
                <i class="fa fa-user fa-2x"></i><br/>
                <?php $cnt= (isset($people)) ? count($people): 0; ?>
                <?php echo strtolower (Yii::t("common", "LOCAL CONNECTED CITIZENS")); ?><br/>
                <span class="badge bg-yellow"><?php echo $cnt;?></span></br> 
                
              </div>
            </li>
            <li class="list-group-item text-purple col-md-6 col-sm-6 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory?tpl=directory2&type=projects&insee=<?php echo $city["insee"]; ?>");'>
                <i class="fa fa-lightbulb-o fa-2x"></i></br> <?php echo strtolower (Yii::t("common", "LOCAL PROJECTS")); ?><br/>
                <?php $cnt= (isset($projects)) ? count($projects): 0; ?>
                <span class="badge bg-purple"><?php echo $cnt;?></span>
              </div>
            </li>
            <li class="list-group-item text-orange col-md-6 col-sm-6 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory?tpl=directory2&type=events&insee=<?php echo $city["insee"]; ?>");'>
                <i class="fa fa-calendar fa-2x"></i></br> <?php echo strtolower (Yii::t("common", "LOCAL EVENTS")); ?><br/>
                <span class="badge bg-orange"><?php echo count($events);?></span>
              </div>
            </li>
            <li class="list-group-item text-green col-md-6 col-sm-6 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory?tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>");'>
                <i class="fa fa-users fa-2x"></i></br> <?php echo strtolower (Yii::t("common", "ORGANIZATIONS")); ?><br/>
                <?php $cnt=0;foreach($organizations as $orga){/*if($orga["type"]==Organization::TYPE_NGO )*/$cnt++;} ?>
                <span class="badge bg-green"><?php echo $cnt;?></span>
              </div>
            </li>
            <!-- <li class="list-group-item text-prune col-md-4 col-sm-6 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory?tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>");'>
                <i class="fa fa-male"></i><i class="fa fa-male fa-2x"></i><i class="fa fa-male"></i></br> <?php echo strtolower (Yii::t("common", "GROUPES")); ?>
                <?php $cnt=0;foreach($organizations as $orga){if($orga["type"]==Organization::TYPE_GROUP )$cnt++;} ?>
                <span class="badge bg-prune"><?php echo $cnt;?></span>
              </div>
            </li>
            <li class="list-group-item text-azure col-md-4 col-sm-6 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory?tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>");'>
                <i class="fa fa-industry fa-2x"></i></br> <?php echo strtolower (Yii::t("common", "ENTREPRISES")); ?>
                <?php $cnt=0;foreach($organizations as $orga){ if($orga["type"] == Organization::TYPE_BUSINESS )$cnt++; } ?>
                <span class="badge bg-azure"><?php echo $cnt;?></span>
              </div>
            </li> -->
            <!-- <li class="list-group-item">
              <span class="badge"><?php echo $cnt;?></span>
              COLLECTIVITÉ
            </li> -->
            
          </ul>
          
        </div>
      </div>
      <div class="panel-footer text-right">
        <a class="btn btn-sm btn-default" 
            href='javascript:loadByHash("#city.directory?tpl=directory2&insee=<?php echo $city["insee"]; ?>")',
            class="btn btn-sm btn-light-blue" 
            title="<?php echo Yii::t("common","Show Directory") ?>" 
            alt="">
            <i class="fa fa-bookmark fa-rotate-270"></i> <?php echo Yii::t("common","Show Directory") ?>
        </a>
      </div>
  
    </div>
  </div>


</div>

<div style="" class="col-md-12" id="div-discover">
    <!-- <h2 class="btn-success communected">Félicitation, vous êtes communecté !</h2> -->
    <h2 class="center text-dark" style="margin-bottom:20px; margin-top:0px;">
      <i class="fa fa-2x fa-angle-down"></i><br/>
      Découvrir
    </h2>
    <div class="col-md-12 no-padding" style="margin-bottom:40px">
      <div class="col-md-4 col-sm-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
        <a href="javascript:;" onclick="discover('#default.directory')" class="btn btn-discover bg-azure">
          <i class="fa fa-connectdevelop"></i>
        </a><br/>Recherche<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
      </div>
      <div class="col-md-4 col-sm-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
        <a href="javascript:;" onclick="discover('#default.agenda')" class="btn btn-discover bg-azure">
          <i class="fa fa-calendar"></i>
        </a><br/>L'agenda<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
      </div>
      <div class="col-md-4 col-sm-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
        <a href="javascript:;" onclick="discover('#default.news')" class="btn btn-discover bg-azure">
          <i class="fa fa-rss"></i>
        </a><br/>L'actualité<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
      </div>
    </div>
  </div>


<div class="row">

	<div class="col-sm-7 col-xs-12">
		<?php //$this->renderPartial('../pod/sliderPhoto', array("userId" => (string)$person["_id"])); ?>
	</div>

    

</div>



<!-- end: PAGE CONTENT-->

<script>

//var contextMap = {};
contextMap = <?php echo json_encode($contextMap) ?>;
var city = <?php echo json_encode($city) ?>;
var images = <?php echo json_encode($images) ?>;
var contentKeyBase = "<?php echo $contentKeyBase ?>";
var events = <?php echo json_encode($events) ?>;

//  console.log("contextMap");
//  console.dir(contextMap);


jQuery(document).ready(function() {
  $(".main-col-search").addClass("cityHeadSection");

  var iconCity = "<i class='fa fa-university'></i>";
  var mine = (city["insee"] == inseeCommunexion) ? " MA" : "";
  var mineCity = (city["insee"] == inseeCommunexion) ? true : false;

  <?php if( @$city["communected"] ){ ?>
  iconCity = "<span class='fa-stack'>"+
                  "<i class='fa fa-university fa-stack-1x'></i>";                  
                  "<i class='fa fa-circle-thin fa-stack-2x' style='color:#93C020'></i>"+
                "</span>";
  <?php } ?>

  $(".moduleLabel").html(iconCity + mine + " COMMUNE : <?php echo $city["name"] ?>");
  
  //si on est sur la page de MA commune, on change le texte du bouton "communecter"
  if(mineCity){
    $("#btn-communecter").html("<i class='fa fa-check'></i> COMMUNECTÉ");
    $("#btn-communecter").tooltip({
        title: 'Vous êtes communecté à cette commune.'
    });
    $("#btn-communecter").attr("onclick", "");
  }

  initCityMap();
/*  $('.pulsate').pulsate({
            color: '#2A3945', // set the color of the pulse
            reach: 10, // how far the pulse goes in px
            speed: 1000, // how long one pulse takes in ms
            pause: 200, // how long the pause between pulses is in ms
            glow: false, // if the glow should be shown too
            repeat: 10, // will repeat forever if true, if given a number will repeat for that many times
            onHover: false // if true only pulsate if user hovers over the element
        });
	*/	
		getAjax(".shareAgendaPod", baseUrl+"/"+moduleId+"/pod/slideragenda/id/<?php echo $_GET["insee"]?>/type/<?php echo City::COLLECTION ?>", function(){
			//initAddEventBtn ();
		}, "html");
    getAjax(".votingPod", baseUrl+"/"+moduleId+"/survey/index/type/<?php echo City::COLLECTION ?>/id/<?php echo $_GET["insee"]?>?tpl=indexPod", function(){
      //initAddEventBtn ();
    }, "html");

	var lastValue=0;
	$(window).on("scroll", function(e) {
		var scroller_anchor = $("#pod-local-actors").offset().top;
		scroller_anchor += $("#pod-local-actors").height();
		topScroll=$(this).scrollTop();
		console.log(window.scrollY+" // "+lastValue );
		
		if (topScroll > (scroller_anchor-100)) {
			$("#pod-local-actors").css("margin-bottom","550px");
			//$("#cityDetail").fadeOut();
	    	$("#newsHistory").addClass("fixedTop").children().addClass("col-md-12");
	    	$(".timeline-scrubber").addClass("fixScrubber");
	    	lastValue=window.scrollY;
	    	//$(window).off('scroll');
		} 
		if (window.scrollY < lastValue-1) { 
			lastValue=0;
			//$("#cityDetail").fadeIn();
			//	    	$(window).on('scroll');
			$("#pod-local-actors").css("margin-bottom","0px");
			$(".timeline-scrubber").removeClass("fixScrubber");
			$("#newsHistory").removeClass("fixedTop").children().removeClass("col-md-12");
		}
	});

		//getAjax(".photoVideoPod", baseUrl+"/"+moduleId+"/pod/photovideo/insee/<?php echo $_GET["insee"]?>/type/<?php echo City::COLLECTION ?>", function(){bindPhotoSubview();}, "html");

		//getAjax(".statisticPop", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>", function(){bindBtnAction();}, "html")
		
});


function communecter(){ //toastr.info('TODO : redirect to form register || OR || slide to form register');

    var cp = "<?php if(@$city['cp']) echo $city['cp']; ?>";
    $(".form-register #cp").val(cp);
    
    // $('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
    //   $(this).show().removeClass("animated bounceInLeft");

    // });

    // $(".main-col-search").animate({ top: -1500, opacity:0 }, 800 );

    // $(".box-ajax").hide(400);
    showPanel("box-register");
    activePanel = "box-register";

}

var markerCity;
function initCityMap(){
  
  Sig.restartMap();
  Sig.map.setZoom(2, {animate:false});
  
  console.log("city");
  console.dir(city.geo);
  
  Sig.showMapElements(Sig.map, contextMap);
  var latlng = [parseFloat(city.geo.latitude)+0.0003, parseFloat(city.geo.longitude)+0.0003];
   console.dir(latlng);
 
  var content = Sig.getPopupSimpleCity(city);
  var properties = {  id : "0",
                      icon : Sig.getIcoMarkerMap({"type" : "city"}),
                      zIndexOffset: 100001,
                      content: content };
  
  markerCity = Sig.getMarkerSingle(Sig.map, properties, latlng);
  Sig.allowMouseoverMaker = false;
  
  markerCity.openPopup();
  
  Sig.map.setView(latlng, 13, {animate:false});
  Sig.map.panBy([0, -150]);
  //Sig.centerSimple(latlng, 13);
  Sig.currentMarkerPopupOpen = markerCity;  
  console.log("geoShape");
  console.dir(city["geoShape"]);
  if(typeof city["geoShape"] != "undefined"){
    var geoShape = Sig.inversePolygon(city["geoShape"]["coordinates"][0]);
    Sig.showPolygon(geoShape);
    Sig.map.setZoom(20, {animate:false});
    Sig.map.fitBounds(geoShape);
   
  }

  $("#btn-center-city").click(function(){
    Sig.currentMarkerPopupOpen = markerCity;  
    //markerCity.openPopup();
    showMap(true);
    markerCity.openPopup();
    Sig.map.setZoom(13, {animate:false});
    Sig.map.panTo(latlng, {animate:true});
    Sig.map.panBy([0, -150]);
    //Sig.centerSimple(latlng, 13);
  });
  
  markerCity.closePopup();
  showMap(false);
  
  Sig.allowMouseoverMaker = true;
}

function discover(hash){
  $("#btn-communecter").click();
  loadByHash(hash);
}

	
</script>