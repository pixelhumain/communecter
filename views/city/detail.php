 <div class="cityHeadSection"></div>
 <?php 

Menu::city($city, $cityGlobal);
$this->renderPartial('../default/panels/toolbar'); 

 $cssAnsScriptFilesModule = array(
    '/assets/css/city/detail.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
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
    background-position: 0px 0px;
    background-size: 100% auto;
  }
  .bborder{
    border-bottom: 1px solid #ccc;
  }
  .scope-global-community{
    display: none;
  }

  .town {  
    font-size:12px;
    color: #3c5665;
  }

  .cityGlobal {  
    font-size:16px;
    color: #3c5665;
  }

  .cityGlobal:hover {
    color: #2bb0c6;
  }

  .header-home{
    display:none; 
  }

  #pod-local-actors .text-extra-large{
    font-size:15px;
  }

</style>
<!-- start: PAGE CONTENT -->
<div class="row padding-20" id="cityDetail">

   <?php if(false){ //if(!isset(Yii::app()->session["userId"]) ){ // ?>
    <!-- <h1 class="homestead text-dark center you-live">Vous habitez ici ? <?php //echo $city["name"]; ?></h1> -->
    <a href="javascript:;" class="btn homestead text-red no-margin tooltips"
       ctry-com="<?php echo $city['country']; ?>" 
       insee-com="<?php echo $city['insee']; ?>" 
       name-com="<?php echo $city['name']; ?>" 
       cp-com="<?php if(@$city['cp']) echo $city['cp']; ?>" 
       id="btn-communecter" onclick="setScopeValue($(this));"
       data-toggle="tooltip" data-placement="bottom"
       >
       <i class="fa fa-crosshairs"></i> COMMUNECTER
    </a>
  <?php } ?>
  <div class="col-xs-12 col-md-12" style="margin-bottom:-10px;">
      <h1 class="homestead text-red text-center cityName-header">
        <span class="margin-bottom-10" style="">

        <i class="fa fa-university"></i><br>
        <?php if($cityGlobal == false) echo $city["cp"]; ?> 
        <?php
          if($cityGlobal == true)
            echo $city["name"]; 
          else{
            echo $city["namePc"];
            if(count($city["postalCodes"]) > 1 ){
        ?>
              <div class="town">
                <?php echo Yii::t("common", "Access to all common information of") ; ?>
                <a href="#city.detail.insee.<?php echo $city['insee']; ?>" class="lbh cityGlobal">
                  <?php echo $city["name"];  ?>
                </a> 
              </div>       
      <?php } 
          } ?>
        </span>

         <div id="div-discover" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
        <!-- <div class="panel panel-white padding-10">
            <div id="local-actors-popup-sig">
              <div class="panel-heading text-center border-light">
                <h3 class="panel-title text-blue"> <i class="fa fa-search"></i> Découvrir - Participer</h3>
              </div>
              <div class="panel-body no-padding "> -->

                <div class="col-md-12 no-padding" style="margin-top:20px">
                    <?php
                      $lockCityKey = ($cityGlobal == true) ? $city["country"].'_'.$city["insee"] : City::getUnikey($city) ;

                    ?>

                    <div class="col-xs-3 center no-padding hidden-xs" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="#default.agenda?lockCityKey=<?php echo $lockCityKey; ?>" class="lbh btn btn-discover bg-orange">
                          <i class="fa fa-calendar"></i>
                        </a>
                        <?php $cnt= (isset($events)) ? count($events): 0; ?>
                        <span class="badge nb-localactors bg-orange"><?php echo $cnt; ?></span>
                        <br>
                        <span class="text-orange discover-subtitle">
                          Agenda
                         <?php //echo ($cityGlobal == true) ? $city["name"] : $city["namePc"] ?> 
                        </span>
                    </div>
                    
                    <div class="col-xs-4 col-sm-2 col-md-2 center no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="#default.directory?type=projects&lockCityKey=<?php echo $lockCityKey; ?>" " class="lbh btn btn-discover bg-purple">
                          <i class="fa fa-lightbulb-o"></i>
                        </a>
                        <?php $cnt= (isset($projects)) ? count($projects): 0; ?>
                        <span class="badge nb-localactors bg-purple"><?php echo $cnt; ?></span>
                        <!-- <br/>Rechercher des -->
                        <br/>
                        <span class="text-purple discover-subtitle homestead">
                         <?php echo Yii::t("common", "LOCAL PROJECTS") ;
                         //echo ($cityGlobal == true) ? $city["name"] : $city["namePc"] ?> 
                        </span>
                    </div>

                    <div class="col-xs-4 col-sm-2 col-md-2 center no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="#default.directory?type=persons&lockCityKey=<?php echo $lockCityKey; ?>" class="lbh btn btn-discover bg-yellow">
                          <i class="fa fa-user"></i>
                        </a>
                        <?php $cnt= (isset($people)) ? count($people): 0; ?>
                        <span class="badge nb-localactors bg-yellow"><?php echo $cnt; ?></span>
                        <!-- <br/>Rechercher des -->
                        <br/>
                        <span class="text-yellow discover-subtitle homestead">

                         <?php echo Yii::t("common", "LOCAL CONNECTED CITIZENS") ;
                         //echo ($cityGlobal == true) ? $city["name"] : $city["namePc"] ?> 
                        </span>
                    </div>

                    <div class="col-xs-4 col-sm-2 col-md-2 center no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="#default.directory?type=organizations&lockCityKey=<?php echo $lockCityKey; ?>" " class="lbh btn btn-discover bg-green">
                          <i class="fa fa-group"></i>
                        </a>
                        <?php $cnt= (isset($organizations)) ? count($organizations): 0; ?>
                        <span class="badge nb-localactors bg-green"><?php echo $cnt; ?></span>
                        <!-- <br/>Rechercher des -->
                        <br/>
                        <span class="text-green discover-subtitle homestead">
                         <?php echo Yii::t("common", "ORGANIZATIONS") ;
                         //echo ($cityGlobal == true) ? $city["name"] : $city["namePc"] ?> 
                        </span>
                    </div>
                    
                    <div class="col-xs-6 col-sm-3 col-md-3 center no-padding visible-xs" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="#default.agenda?lockCityKey=<?php echo $lockCityKey; ?>" class="lbh btn btn-discover bg-orange">
                          <i class="fa fa-calendar"></i>
                        </a><br/>
                        <span class="text-orange discover-subtitle">
                          Agenda
                         <?php //echo ($cityGlobal == true) ? $city["name"] : $city["namePc"] ?> 
                        </span>
                    </div>
                    
                    <!-- <div class="col-xs-3 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
                        <a href="#default.news?city=<?php echo City::getUnikey($city); ?>" class="lbh btn btn-discover bg-azure">
                          <i class="fa fa-rss"></i>
                        </a><br/>L'actualité<br/><span class="text-red discover-subtitle">commune<span class="text-dark">ctée</span></span>
                    </div> -->
                    <?php if($cityGlobal != true){ ?>
                    <div class="col-xs-6 col-sm-3 col-md-3 center text-red no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                        <a href="#rooms.index.type.cities.id.<?php echo City::getUnikey($city); ?>" class="lbh btn btn-discover bg-red">
                          <i class="fa fa-group"></i>
                        </a>
                        <br/>
                        <span class='text-red discover-subtitle'>Conseil citoyen
                        <!-- <br><?php //echo ($cityGlobal == true) ? $city["name"] : $city["namePc"] ?> -->
                        </span>
                    </div>
                   <?php }else{?>
                      <div class="col-xs-6 col-sm-3 col-md-3 center text-red no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                          <label class="btn btn-discover bg-red"><i class="fa fa-group"></i></label>
                          <br/><span class='text-red discover-subtitle'>Conseil citoyen<br/>
                          <select id="selectRoom" class="text-red">
                              <option value="">Choisir</option>
                              <?php 
                                foreach ($city["postalCodes"] as $key => $value) {
                                  $cityUniKey = array("country" => $city["country"],
                                                        "insee" => $city["insee"],
                                                        "cp" => $value["postalCode"]);
                                  echo '<option value="#rooms.index.type.cities.id.'.City::getUnikey($cityUniKey).'">'.$value["name"].' ('. $value["postalCode"].')</option>';
                                }
                              ?>
                          </select> 
                          </span> 
                      </div>
                    <?php } ?>
                    
                    <?php /*
                    <div class="col-xs-6 center text-dark" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
                        <strong>Le conseil citoyen</strong> est un lieu de discussion, de débat, de décision
                    </div>
                    <div class="col-xs-6 center text-dark" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
                        <strong>Tout le monde</strong> peut participer !
                    </div>
                    */?>
                </div>

        <!--       </div>
            </div>
           
        </div> -->
    </div>
      </h1>
     
  </div>

    <div id="pod-local-actors" class="col-lg-4 col-md-4 col-sm-4 col-xs-12 hidden">
        <div class="panel panel-white padding-10">
            <div id="local-actors-popup-sig">
              <div class="panel-heading text-center border-light">
                <h3 class="panel-title text-blue"><i class="fa fa-connectdevelop"></i> <?php echo strtolower (Yii::t("common", "LOCAL ACTORS")); ?></h3>
                <!-- <div class="panel-tools" style="display:block"> </div> -->
              </div>
              <div class="panel-body ">

                    <?php
                    $baseUrlPc = ($cityGlobal == false)?".postalCode.".$city["cp"]:"" ;
                    $baseUrlDirectory = "#city.directory.insee.".$city["insee"].$baseUrlPc.".tpl.directory2.type" ;
                    ?>

                    <a href="<?php echo $baseUrlDirectory; ?>.citoyens" 
                      class="lbh text-yellow homestead col-xs-12 text-extra-large padding-5 bborder"'>
                      <i class="fa fa-user"></i>
                      <?php $cnt= (isset($people)) ? count($people): 0; ?>
                      <?php echo strtolower (Yii::t("common", "LOCAL CONNECTED CITIZENS")); ?>
                      <span class="badge bg-yellow pull-right helvetica"><?php echo $cnt;?></span>
                    </a>
                      <a href="#city.directory.insee.<?php echo $city["insee"]; ?>.postalCode.<?php echo $city["cp"]; ?>.tpl.directory2.type.projects"   class="lbh text-purple homestead col-xs-12 text-extra-large padding-5 bborder"'>
                        <i class="fa fa-lightbulb-o"></i> <?php echo strtolower (Yii::t("common", "LOCAL PROJECTS")); ?>
                        <?php $cnt= (isset($projects)) ? count($projects): 0; ?>
                        <span class="badge bg-purple pull-right helvetica"><?php echo $cnt;?></span>
                      </a>
                    <?php //echo Yii::t('common','Search a projects of your city.');?>

                    <a href="#city.directory.insee.<?php echo $city["insee"]; ?>.postalCode.<?php echo $city["cp"]; ?>.tpl.directory2.type.events" 
                       class="lbh text-orange homestead col-xs-12 text-extra-large padding-5 bborder"'>
                      <i class="fa fa-calendar"></i> <?php echo strtolower (Yii::t("common", "LOCAL EVENTS")); ?>
                      <span class="badge bg-orange pull-right helvetica"><?php echo count($events);?></span>
                    </a>
                    

                    <a href="#city.directory.insee.<?php echo $city["insee"]; ?>.postalCode.<?php echo $city["cp"]; ?>.tpl.directory2.type.organizations" 
                      class="lbh text-green homestead col-xs-12 text-extra-large padding-5 bborder"'>
                      <i class="fa fa-users"></i> <?php echo strtolower (Yii::t("common", "ORGANIZATIONS")); ?>
                      <?php $cnt=0;foreach($organizations as $orga){/*if($orga["type"]==Organization::TYPE_NGO )*/$cnt++;} ?>
                      <span class="badge bg-green pull-right helvetica"><?php echo $cnt;?></span>
                    </a>
                    
                    <?php /*
                    <div class="text-prune" onclick='loadByHash("#city.directory?tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>");'>
                      <i class="fa fa-male"></i><i class="fa fa-male"></i><i class="fa fa-male"></i><?php echo strtolower (Yii::t("common", "GROUPES")); ?>
                      <?php $cnt=0;foreach($organizations as $orga){if($orga["type"]==Organization::TYPE_GROUP )$cnt++;} ?>
                      <span class="badge bg-prune"><?php echo $cnt;?></span>
                    </div>

                    <div class="text-azure" onclick='loadByHash("#city.directory?tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>");'>
                      <i class="fa fa-industry"></i> <?php echo strtolower (Yii::t("common", "ENTREPRISES")); ?>
                      <?php $cnt=0;foreach($organizations as $orga){ if($orga["type"] == Organization::TYPE_BUSINESS )$cnt++; } ?>
                      <span class="badge bg-azure"><?php echo $cnt;?></span>
                    </div>
                    */ ?>

              </div>
            </div>
           
        </div>
    </div>

   

</div>

<div class="col-xs-12">
	<?php $this->renderPartial('../default/live', array("lockCityKey" => City::getUnikey($city))); ?>
</div>


<!-- end: PAGE CONTENT-->

<script>

//var contextMap = {};
contextMap = <?php echo json_encode($contextMap) ?>;
var city = <?php echo json_encode($city) ?>;
//var cityKey = "<?php //echo City::getUnikey($city) ?>";
var images = <?php echo json_encode($images) ?>;
var contentKeyBase = "<?php echo $contentKeyBase ?>";
var events = <?php echo json_encode($events) ?>;
var liveScopeType = "global";

jQuery(document).ready(function() {

  $(".main-col-search").addClass("cityHeadSection");


  var iconCity = "<i class='fa fa-university'></i>";
  var mine = (city["insee"] == inseeCommunexion && city["cp"] == cpCommunexion) ? " MA" : "";
  var mineCity = (city["insee"] == inseeCommunexion && city["cp"] == cpCommunexion) ? true : false;

  <?php if( @$city["communected"] ){ ?>
  iconCity = "<span class='fa-stack'>"+
                  "<i class='fa fa-university fa-stack-1x'></i>"+                
                  "<i class='fa fa-circle-thin fa-stack-2x' style='color:#93C020'></i>"+
                "</span>";
  <?php } ?>

  setTitle(mine + " COMMUNE : <?php echo $city["name"] ?>",iconCity);
  
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


  $('#selectRoom').change(function(){
    if($('#selectRoom').val() != "")
      loadByHash($('#selectRoom').val());
      
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

	
</script>