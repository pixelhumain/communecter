 <div class="cityHeadSection"></div>
 <?php 

Menu::city($city);
$this->renderPartial('../default/panels/toolbar'); 

 $cssAnsScriptFilesModule = array(
    '/css/city/detail.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
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
?>


<?php 
  $minCount = count($people);
  if(count($organizations) < $minCount) $minCount = count($organizations);
  if(count($projects) < $minCount) $minCount = count($projects);
  $minCount =100;
  $minCountOrga = $minCount;

  $countTotal = count($people) + count($organizations) + count($events);

?>

<style type="text/css">
  
  .cityHeadSection {  
    background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/cityDefaultHead_BW.jpg); 
    /*background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);*/
    background-color: #fff;
    background-repeat: no-repeat;
    background-position: 0px 50px;
    background-size: 100% auto;
  }

</style>
<!-- start: PAGE CONTENT -->

<div class="row padding-20" id="cityDetail">

 <?php //if(!isset(Yii::app()->session["userId"]) ){ // ?>
  <!-- <h1 class="homestead text-dark center you-live">Vous habitez ici ? <?php //echo $city["name"]; ?></h1> -->
  <a href="javascript:;" class="btn homestead text-red no-margin"
     insee-com="<?php echo $city['insee']; ?>" name-com="<?php echo $city['name']; ?>" cp-com="<?php if(@$city['cp']) echo $city['cp']; ?>" 
     id="btn-communecter" onclick="setScopeValue($(this));">
     <i class="fa fa-crosshairs"></i> COMMUNECTER
  </a>
<?php //var_dump(json_encode($city)); //} ?>

<div class="col-sm-12 col-xs-12">

    <h1 class="homestead text-red cityName-header">
      <center><i class="fa fa-university"></i> <?php echo $city["name"]." "; ?></center>
    </h1>
   
</div>



<div class="col-sm-12 col-xs-12" id="pod-local-actors"  id="cityDetail_numbers">

    <div class="panel panel-white">
      <div id="local-actors-popup-sig">
        <div class="panel-heading text-center border-light">
          <h3 class="panel-title text-blue"><i class="fa fa-connectdevelop"></i> <?php echo strtolower (Yii::t("common", "LOCAL ACTORS")); ?></h3>
          <!-- <div class="panel-tools" style="display:block"> </div> -->
        </div>
        <div class="panel-body no-padding center">

          <ul class="list-group text-left no-margin">
            <li class="list-group-item text-yellow col-md-3 col-sm-3 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory.insee.<?php echo $city["insee"]; ?>.postalCode.<?php echo $city["cp"]; ?>.tpl.directory2.type.citoyens");'>
                <i class="fa fa-user fa-2x"></i><br/>
                <?php $cnt= (isset($people)) ? count($people): 0; ?>
                <?php echo strtolower (Yii::t("common", "LOCAL CONNECTED CITIZENS")); ?><br/>
                <span class="badge bg-yellow"><?php echo $cnt;?></span></br> 
                
              </div>
            </li>
            <li class="list-group-item text-purple col-md-3 col-sm-3 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory.insee.<?php echo $city["insee"]; ?>.postalCode.<?php echo $city["cp"]; ?>.tpl.directory2.type.projects");'>
                <i class="fa fa-lightbulb-o fa-2x"></i></br> <?php echo strtolower (Yii::t("common", "LOCAL PROJECTS")); ?><br/>
                <?php $cnt= (isset($projects)) ? count($projects): 0; ?>
                <span class="badge bg-purple"><?php echo $cnt;?></span>
              </div>
            </li>
            <li class="list-group-item text-orange col-md-3 col-sm-3 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory.insee.<?php echo $city["insee"]; ?>.postalCode.<?php echo $city["cp"]; ?>.tpl.directory2.type.events");'>
                <i class="fa fa-calendar fa-2x"></i></br> <?php echo strtolower (Yii::t("common", "LOCAL EVENTS")); ?><br/>
                <span class="badge bg-orange"><?php echo count($events);?></span>
              </div>
            </li>
            <li class="list-group-item text-green col-md-3 col-sm-3 col-xs-6 link-to-directory">
              <div class="" onclick='loadByHash("#city.directory.insee.<?php echo $city["insee"]; ?>.postalCode.<?php echo $city["cp"]; ?>.tpl.directory2.type.organizations");'>
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
      <div class="panel-footer text-right hidden">
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

<div id="podCooparativeSpace"></div>

<div style="" class="col-md-12 " id="div-participate">
    <!-- <h2 class="btn-success communected">Félicitation, vous êtes communecté !</h2> -->
    <h2 class="center text-dark" style="margin-bottom:20px; margin-top:0px;">
      <i class="fa fa-2x fa-angle-down"></i><br/>
      Participer
    </h2>
    <div class="col-md-12 no-padding" style="margin-bottom:40px">
      <div class="col-md-4 col-xs-12 center text-dark" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
        <blockquote><strong>Le conseil citoyen</strong> est un lieu de discussion, de débat, de décision</blockquote>
      </div>
      <div class="col-md-4 col-xs-12 center text-dark" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
         <a href="javascript:;" onclick="loadByHash('#rooms.index.type.cities.id.<?php echo $city['country']."_".$city['insee']."-".$city['cp']; ?>')" class="btn btn-participate bg-red">
          <i class="fa fa-group"></i>
        </a><br>
        <span class='text-red'><strong>Conseil citoyen</strong><br><?php echo $city["name"]." "; ?></span>
      </div>
      <div class="col-md-4 col-xs-12 center text-dark" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
        <blockquote><strong>Tout le monde</strong> peut participer !</blockquote>
    </div>
  </div>

<div style="" class="col-md-12" id="div-discover">
    <!-- <h2 class="btn-success communected">Félicitation, vous êtes communecté !</h2> -->
    <h2 class="center text-dark" style="margin-bottom:20px; margin-top:0px; float: left; width: 100%;">
      <i class="fa fa-2x fa-angle-down"></i><br/>
      Découvrir
    </h2>
    <div class="col-md-12 no-padding" style="margin-bottom:40px">
      <div class="col-md-4 col-sm-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
        <a href="javascript:;" onclick="discover('#default.directory')" class="btn btn-discover bg-azure">
          <i class="fa fa-search"></i>
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

  Sig.showMapElements(Sig.map, contextMap);
  //initCityMap();
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

   // $("#podCooparativeSpace").html("<i class='fa fa-spin fa-refresh text-azure'></i>");
   //  var id = "<?php echo $city['country']."_".$city['insee']."-".$city['cp']; ?>";
   //    getAjax('#podCooparativeSpace',baseUrl+'/'+moduleId+"/rooms/index/type/cities/id/"+id+"/view/pod",
   //      function(){}, "html");
      

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