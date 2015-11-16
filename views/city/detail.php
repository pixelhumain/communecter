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
</style>
<!-- start: PAGE CONTENT -->
<div class="row padding-20" id="cityDetail">

  <div class="col-sm-4 col-xs-12" id="pod-local-actors"  id="cityDetail_numbers">
    <div class="panel panel-white">
      <div id="local-actors-popup-sig">
        <div class="panel-heading border-light">
          <h3 class="panel-title text-blue"><i class="fa fa-connectdevelop"></i> <?php echo Yii::t("common", "LOCAL ACTORS"); ?></h3>
  		    <div class="panel-tools" style="display:block">
          	</div>
        </div>
        <div class="panel-body padding-10 no-padding center">

          <ul class="list-group text-left no-margin">
            <li class="list-group-item text-yellow">
              <div class="link-to-directory" onclick='javascript:showAjaxPanel("/city/directory?isNotSV=1&tpl=directory2&type=citoyens&insee=<?php echo $city["insee"]; ?>", "Commune : <?php echo $city["name"]; ?>", "fa-university");'>
                <?php $cnt= (isset($people)) ? count($people): 0; ?>
                <span class="badge pull-right bg-yellow"><?php echo $cnt;?></span>
                <i class="fa fa-user"></i> <?php echo Yii::t("common", "LOCAL CONNECTED CITIZENS"); ?>
              </div>
            </li>
            <li class="list-group-item text-orange">
              <div class="link-to-directory" onclick='javascript:showAjaxPanel("/city/directory?isNotSV=1&tpl=directory2&type=projects&insee=<?php echo $city["insee"]; ?>", "Commune : <?php echo $city["name"]; ?>", "fa-university");'>
                <?php $cnt= (isset($projects)) ? count($projects): 0; ?>
                <span class="badge pull-right bg-orange"><?php echo $cnt;?></span>
                <i class="fa fa-lightbulb-o"></i> <?php echo Yii::t("common", "LOCAL PROJECTS"); ?>
              </div>
            </li>
            <li class="list-group-item text-azure">
              <div class="link-to-directory" onclick='javascript:showAjaxPanel("/city/directory?isNotSV=1&tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>", "Commune : <?php echo $city["name"]; ?>", "fa-university");'>
                <?php $cnt=0;foreach($organizations as $orga){ if($orga["type"] == Organization::TYPE_BUSINESS )$cnt++; } ?>
                <span class="badge pull-right bg-azure"><?php echo $cnt;?></span>
                <i class="fa fa-industry"></i> <?php echo Yii::t("common", "ENTREPRISES"); ?>
              </div>
            </li>
            <li class="list-group-item text-green">
              <div class="link-to-directory" onclick='javascript:showAjaxPanel("/city/directory?isNotSV=1&tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>", "Commune : <?php echo $city["name"]; ?>", "fa-university");'>
                <?php $cnt=0;foreach($organizations as $orga){if($orga["type"]==Organization::TYPE_NGO )$cnt++;} ?>
                <span class="badge pull-right bg-green"><?php echo $cnt;?></span>
                <i class="fa fa-users"></i> <?php echo Yii::t("common", "ASSOCIATIONS"); ?>
              </div>
            </li>
            <li class="list-group-item text-prune">
              <div class="link-to-directory" onclick='javascript:showAjaxPanel("/city/directory?isNotSV=1&tpl=directory2&type=organizations&insee=<?php echo $city["insee"]; ?>", "Commune : <?php echo $city["name"]; ?>", "fa-university");'>
                <?php $cnt=0;foreach($organizations as $orga){if($orga["type"]==Organization::TYPE_GROUP )$cnt++;} ?>
                <span class="badge pull-right bg-prune"><?php echo $cnt;?></span>
                <i class="fa fa-users"></i> <?php echo Yii::t("common", "GROUPES"); ?>
              </div>
            </li>
            <!-- <li class="list-group-item">
              <span class="badge"><?php echo $cnt;?></span>
              COLLECTIVITÉ
            </li> -->
            <li class="list-group-item text-purple">
              <div class="link-to-directory" onclick='javascript:showAjaxPanel("/city/directory?isNotSV=1&tpl=directory2&type=events&insee=<?php echo $city["insee"]; ?>", "Commune : <?php echo $city["name"]; ?>", "fa-university");'>
                <span class="badge pull-right bg-purple"><?php echo count($events);?></span>
                <i class="fa fa-calendar"></i> <?php echo Yii::t("common", "LOCAL EVENTS"); ?>
              </div>
            </li>
            
          </ul>
          
        </div>
      </div>
      <div class="panel-footer text-right">
        <a class="btn btn-sm btn-default" 
            href='javascript:showAjaxPanel("/city/directory?isNotSV=1&tpl=directory2&insee=<?php echo $city["insee"]; ?>", "Commune : <?php echo $city["name"]; ?>' 
            class="btn btn-sm btn-light-blue" 
            title="<?php echo Yii::t("common","Show Directory") ?>" 
            alt="">
            <i class="fa fa-bookmark fa-rotate-270"></i> <?php echo Yii::t("common","Show Directory") ?>
        </a>
      </div>
    </div>
  </div>
  <div class="col-sm-8 col-xs-12">
        <?php if($randomOrganization != null) $this->renderPartial('../pod/randomOrganization',array( "randomEntity" => (isset($randomOrganization)) ? $randomOrganization : null )); ?>
    </div>
</div>

<!-- <div class="row"  >
  <div class="col-md-4 col-sm-12 col-xs-12" id="cityDetail_events" data-position="top" data-intro="Find Local Events">
    <?php //$this->renderPartial('../pod/eventsList',array( "events" => $events, "userId" => (string)$person["_id"])); ?>
  </div>
  <div class="col-md-4 col-sm-6  col-xs-12"  id="cityDetail_organizations" data-position="top" data-intro="Find Local  Organizations" >
    <?php //$this->renderPartial('../person/dashboard/organizations',array( "organizations" => $organizations, "userId" => new MongoId($person["_id"]))); ?>
  </div>
  <div class="col-md-4 col-sm-6 col-xs-12"  id="cityDetail_projects" data-position="top" data-intro="Find Local Projects">
    <?php //$this->renderPartial('../pod/projectsList',array( "projects" => $projects, 
          //"userId" => (string)$person["_id"])); ?>
  </div>
</div> -->

<div class="row">

	<div class="col-sm-7 col-xs-12">
		<?php //$this->renderPartial('../pod/sliderPhoto', array("userId" => (string)$person["_id"])); ?>
	</div>

    

</div>

<!-- <div class="row">
	 <div class="col-sm-12 col-xs-12 statisticPop">
		 <div class="panel panel-white pulsate">
			<div class="panel-heading border-light ">
				<h4 class="panel-title"> <i class='fa fa-cog fa-spinn fa-2x icon-big text-center'></i> Loading Shared Agenda Section</h4>
				<div class="space5"></div>
			</div>
		 </div>
	</div>
</div> -->




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
	bindBtnFollow();
  $(".moduleLabel").html("<i class='fa fa-university'></i> <?php echo Yii::t('common', 'MY CITY'); ?> : <?php echo $city["name"] ?>  <a href='#' id='btn-center-city'><i class='fa fa-map-marker'></i></a>");
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

		//getAjax(".photoVideoPod", baseUrl+"/"+moduleId+"/pod/photovideo/insee/<?php echo $_GET["insee"]?>/type/<?php echo City::COLLECTION ?>", function(){bindPhotoSubview();}, "html");

		//getAjax(".statisticPop", baseUrl+"/"+moduleId+"/city/statisticpopulation/insee/<?php echo $_GET["insee"]?>", function(){bindBtnAction();}, "html")
		
});


function initCityMap(){
  
  Sig.restartMap();
  Sig.map.setZoom(2, {animate:false});
  
  Sig.showMapElements(Sig.map, contextMap);
  var latlng = [city.geo.latitude, city.geo.longitude];

  var content = Sig.getPopupCity(city.name, city.insee);
  var properties = {  id : "0",
                      icon : Sig.getIcoMarkerMap({"type" : "city"}),
                      content: content };

  var markerCity = Sig.getMarkerSingle(Sig.map, properties, latlng);
  Sig.allowMouseoverMaker = false;
  
  markerCity.openPopup();
  Sig.map.setZoom(13, {animate:false});
  Sig.map.panTo(latlng, {animate:false});
  Sig.map.panBy([0, -150]);
  //Sig.centerSimple(latlng, 13);
  Sig.currentMarkerPopupOpen = markerCity;  
  
  if(typeof city["geoShape"] != "undefined"){
    var geoShape = Sig.inversePolygon(city["geoShape"]["coordinates"][0]);
    Sig.showPolygon(geoShape);
    Sig.map.setZoom(20, {animate:false});
    Sig.map.fitBounds(geoShape);
   
  }

  $("#btn-center-city").click(function(){
    Sig.currentMarkerPopupOpen = null;//markerCity;  
    //markerCity.openPopup();
    showMap();
    markerCity.closePopup();
    Sig.map.setZoom(13, {animate:false});
    Sig.map.panTo(latlng, {animate:true});
    Sig.map.panBy([0, -100]);
    //Sig.centerSimple(latlng, 13);
  });
  
  markerCity.closePopup();
  showMap(false);
  
  Sig.allowMouseoverMaker = true;
}

function bindBtnFollow(){

	$(".disconnectBtn").off().on("click",function () {
        
        $(this).empty();
        $(this).html('<i class=" disconnectBtnIcon fa fa-spinnner fa-spinn"></i>');
        var btnClick = $(this);
        var idToDisconnect = $(this).data("id");
        var typeToDisconnect = $(this).data("type");
        bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> connection ?",
        	function(result) {
				if (!result) {
					btnClick.empty();
			        btnClick.html('<i class=" disconnectBtnIcon fa fa-unlink"></i>');
					return;
				}
				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/person/disconnect/id/"+idToDisconnect+"/type/"+typeToDisconnect,
			        dataType : "json"
			    })
			    .done(function (data) 
			    {
			        if ( data && data.result ) {               
			        	toastr.info("LINK DIVORCED SUCCESFULLY!!");
			        	$("#"+typeToDisconnect+idToDisconnect).remove();
			        } else {
			           toastr.info("something went wrong!! please try again.");
			           btnClick.empty();
			           btnClick.html('<i class=" disconnectBtnIcon fa fa-unlink"></i>');
			        }
			    });
		});
	});

	$(".connectBtn").off().on("click",function () {
		$(".connectBtnIcon").removeClass("fa-link").addClass("fa-spinnner fa-spinn");
		var idConnect = "<?php echo (string)$person['_id'] ?>";
		if('undefined' != typeof $("#inviteId") && $("#inviteId").val()!= ""){
			idConnect = $("#inviteId").val();
		}

		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/connect/id/"+idConnect+"/type/<?php echo PHType::TYPE_CITOYEN ?>",
	        dataType : "json"
	    })
	    .done(function (data)
	    {
	        if ( data && data.result ) {               
	        	toastr.info("REALTION APPLIED SUCCESFULLY!! ");
	        	$(".connectBtn").fadeOut();
	        	$("#btnTools").empty();
	        	$("#btnTools").html('<a href="javascript:;" class="disconnectBtn btn btn-red tooltips pull-right btn-xs" data-placement="top" data-original-title="Remove this person as a relation" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>');
	        	bindBtnFollow();
	        } else {
	           toastr.info("something went wrong!! please try again.");
	           $(".connectBtnIcon").removeClass("fa-spinnner fa-spinn").addClass("fa-link");
	        }
	    });
        
	});
};

	
</script>