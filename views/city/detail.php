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
        <a href="javascript:getWiki('<?php echo @$city["wikidataID"]; ?>')" class="pull-right">
          <img width=50 src="<?php echo $this->module->assetsUrl; ?>/images/logos/Wikipedia-logo-en-big.png">
        </a>
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
                <div class="space20"></div>
                <a href="javascript:elementLib.openForm(zonesDynForm)" class="btn btn-default">Zones</a>
                <a href="javascript:cityFinderObj.finder('city','<?php echo $city["name"];?>')" class="btn btn-default">Filiaires locales</a>  <a href="javascript:cityFinderObj.finder('departement','<?php echo $city["depName"];?>')" class="btn btn-default">Filiaires département</a>  <a href="javascript:cityFinderObj.finder('region','<?php echo $city["regionName"];?>')" class="btn btn-default">Filiaires région</a> 
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

<script type="text/javascript" >

var zones =  <?php echo json_encode($zones) ?>;
var postalCodesDynForm =  <?php echo json_encode($postalCodes) ?>;
mylog.log("zones");
mylog.dir(zones);

mylog.log("postalCodesDynForm");
mylog.dir(postalCodesDynForm);

var currentCityZones =  [];
var currentCityPC =  [];

var zonesDynForm = { 
    dynForm : {
        jsonSchema : {
          title : "Zones",
          icon : "question-cirecle-o",
          noSubmitBtns : true,
          properties : {
            custom :{
                  inputType : "custom",
                  html : function() { 
                    return "<div class='menuSmallMenu'><h1>Code postaux</h1>"+js_templates.loop( currentCityPC, "linkList", { classes : "bg-red kickerBtn", parentClass : "col-xs-12 col-sm-4 "} )+"<h1>Quartiers</h1>"+js_templates.loop( currentCityZones, "linkList", { classes : "bg-red kickerBtn", parentClass : "col-xs-12 col-sm-4 "} )+"</div>";
                  }
                }
          }
      }
    }
  }

//var contextMap = {};
contextMap = <?php echo json_encode($contextMap) ?>;
categs = <?php echo json_encode(OpenData::$categ) ?>;

var city = <?php echo json_encode($city) ?>;
//var cityKey = "<?php //echo City::getUnikey($city) ?>";
var images = <?php echo json_encode($images) ?>;
var contentKeyBase = "<?php echo $contentKeyBase ?>";
var events = <?php echo json_encode($events) ?>;
var liveScopeType = "global";


//Création de l'object wikipedia qui contiendra toutes les informations des villes dynamiquement
var wikipedia = {

            "prefixe" : { 

                "dbpedia" : "http://fr.dbpedia.org/",
                "dbpedia_resource" : "http://fr.dbpedia.org/resource",
                "dbpedia_owl" : "http://fr.dbpedia.org/ontology",
                "dbpedia_property" : "http://fr.dbpedia.org/property"

            },
            
            "fr" : { 

                "depiction" : { 

                    "uri" : "",
                    "property" : "dbpedia_property:depiction",  
                    "source" : "dbpedia"

                },


                "item" : { 

                    "uri" : "",
                    "property" : "dbpedia_property:depiction",  
                    "source" : "dbpedia"

                },

                "abstract" : { 

                    "value" : "",
                    "ontology" : "dbpedia_owl:abstract", 
                    "source" : "dbpedia"

                },

                "country" : {

                    "value" : "",
                    "ontology" : "dbpedia_owl:country",
                    "uri" : "",
                    "property" : "dbpedia_property:country",
                    "source" : "dbpedia"

                },

                "countryLabel" : {

                    "value" : "",
                    "uri" : "",
                    "property" : "dbpedia_property:country",
                    "source" : "dbpedia"

                },

                "region" :  { 

                    "value" : "",
                    "ontology" : "dbpedia_owl:region",
                    "uri" : "",
                    "source" : "dbpedia"
                },

                "regionLabel" :  { 

                    "value" : "",
                    "uri" : "",
                    "source" : "dbpedia"
                },


                "department" : {

                    "value ": "",
                    "ontology" : "dbpedia_owl:department",
                    "uri" : "",
                    "source" : "dbpedia"

                },


                "departmentLabel" : {

                    "value ": "",
                    "uri" : "",
                    "source" : "dbpedia"

                },

                "maire" : { 

                    "value" : "",
                    "uri" : "",
                    "property" : "dbpedia_property:maire",
                    "source" : "dbpedia"
                },


                "maireLabel" : { 

                    "value" : "",
                    "property" : "dbpedia_property:maire",
                    "source" : "dbpedia"
                },

                "postalCode" : { 

                    "value" : 97400,
                    "ontology" : "dbpedia_owl:postalCode",
                    "source" : "dbpedia"

                },

                "inseeCode" : { 

                    "value" : 97411,
                    "ontology" : "dbpedia_owl:inseeCode",
                    "property" : "dbpedia_property:insee",
                    "source" : "dbpedia"

                },

                "gentile": { 

                    "value" : "",
                    "property" : "dbpedia_property:gentilé",
                    "source" : "dbpedia"

                },

                "populationAglomeration" : { 

                    "value" : 197464,
                    "property" : "dbpedia_property:populationAgglomération",
                    "source" : "dbpedia"

                },


                "populationTotal" : { 

                    "value" : 145238 ,
                    "ontology" : "dbpedia_owl:populationTotal",
                    "source" : "dbpedia"

                },

                
                


                "superficie" : {

                    "value" : 142.790000,
                    "property" : "dbpedia_property:superficie",
                    "source" : "dbpedia"

                },  


                "siteweb" : { 

                    "value": "",
                    "property" : "dbpedia_resource:siteweb",
                    "source" : "dbpedia"

                }


            }


        }


initCurrentCityZones();
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
		mylog.log(window.scrollY+" // "+lastValue );
		
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
  
  mylog.log("city");
  mylog.dir(city.geo);
  
  Sig.showMapElements(Sig.map, contextMap);
  var latlng = [parseFloat(city.geo.latitude)+0.0003, parseFloat(city.geo.longitude)+0.0003];
   mylog.dir(latlng);
 
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
  mylog.log("geoShape");
  mylog.dir(city["geoShape"]);
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


//wget("https://wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q90&property=P18") 
// https://wikidata.org/w/api.php?action=wbgetentities&format=json&ids=Q90&props=claims&languages=fr 
// https://wikidata.org/w/api.php?action=wbgetclaims&format=json&entity=Q90&property=P18
var wikidata = null;
var data_dbpedia = null;

function getWiki(q){
  //url = "https://wikidata.org/w/api.php?action=wbgetentities&format=json&ids="+q+"&props=claims&languages=fr";
  url ="https://www.wikidata.org/wiki/Special:EntityData/"+q+".json" 
  $.ajax({
        url:url,
        type:"GET",
        dataType: "json",
        /*data: {
            q: "select title,abstract,url from search.news where query=\"cat\"",
            format: "json"
        },*/
        success:function(data) {
          if( notNull(data) ){
            mylog.log('il rentre dans le premier AJAX')

            wikidata = data;
            //name = wikidata.entities[q].claims.P373[0].mainsnak.datavalue.value;
            //imgName = wikidata.entities[q].claims.P18[0].mainsnak.datavalue.value;
            /*$.ajax({
                url:"https://www.wikidata.org/w/api.php?action=query&prop=imageinfo&iiprop=url&titles=File:"+imgName,
                type:"GET",
                dataType: "jsonp",
                success:function(data) {
                  console.dir(data)
                },
                error:function (xhr, ajaxOptions, thrownError){
                  alert("error 2");
                } 
            });*/

            label_dbpedia = wikidata.entities[q].sitelinks.frwiki.title;

            url_final = "http://fr.dbpedia.org/sparql?default-graph-uri=&query=prefix+dbo%3A+%3Chttp%3A%2F%2Fdbpedia.org%2Fontology%2F%3E%0D%0Aprefix+dbr%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+wikidb%3A+%3Chttp%3A%2F%2Fwikidata.dbpedia.org%2Fresource%2F%3E%0D%0APREFIX+dbp%3A+%3Chttp%3A%2F%2Ffr.dbpedia.org%2Fproperty%2F%3E%0D%0A+%0D%0A%0D%0ASELECT+DISTINCT+*+where+%7B%0D%0A%0D%0A%0D%0A%0D%0A++%3Fitem+a+dbo%3ASettlement+.+%0D%0A++%3Fitem+rdfs%3Alabel+%22"+label_dbpedia+"%22%40fr+.%0D%0A%0D%0A++%3Fitem+dbo%3Aabstract+%3Fabstract+.+%0D%0A%0D%0A+%3Fitem+dbo%3Acountry+%3Fcountry+.+%0D%0A++%3Fcountry+rdfs%3Alabel+%3FcountryLabel+.%0D%0A%0D%0A+%3Fitem+dbo%3Aregion+%3Fregion+.+%0D%0A+%3Fregion+rdfs%3Alabel+%3FregionLabel+.++%0D%0A%0D%0A++%3Fitem+dbo%3Adepartment+%3Fdepartment++.+%0D%0A+++%3Fdepartment+rdfs%3Alabel+%3FdepartmentLabel+.+%0D%0A%0D%0A+OPTIONAL+%7B%3Fitem+dbo%3ApostalCode+%3FpostalCode++.%7D%0D%0A+OPTIONAL+%7B%3Fitem+dbo%3AinseeCode+%3FinseeCode++.+%7D%0D%0A%0D%0A%0D%0A+OPTIONAL+%7B%3Fitem+dbp%3Agentil%C3%A9+%3Fgentile+.+%7D%0D%0A+OPTIONAL+%7B%3Fitem+dbo%3ApopulationTotal+%3FpopulationTotal+.%7D%0D%0A%0D%0A+OPTIONAL+%7B%3Fitem+dbp%3Asuperficie+%3Fsuperficie+.+%7D%0D%0A+OPTIONAL+%7B%3Fitem+dbp%3Asiteweb+%3Fsiteweb+.+%7D%0D%0A+OPTIONAL+%7B+%3Fitem+foaf%3Adepiction+%3Fpicture+.+%7D%0D%0A%0D%0A++OPTIONAL+%7B+%3Fitem+dbp%3Amaire+%3Fmaire++.+%7D%0D%0A++OPTIONAL+%7B+%3Fitem+rdfs%3Alabel+%3FmaireLabel+.+%7D%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0A%0D%0AFILTER%28LANG%28%3FcountryLabel%29+%3D%22fr%22%29%0D%0AFILTER%28LANG%28%3FregionLabel%29+%3D%22fr%22%29%0D%0AFILTER%28LANG%28%3FdepartmentLabel%29+%3D%22fr%22%29%0D%0AFILTER%28LANG%28%3Fabstract%29+%3D+%22fr%22%29+%0D%0A%0D%0A%0D%0A+%0D%0A++%0D%0A+%7D%0D%0A&format=application%2Fsparql-results%2Bjson&CXML_redir_for_subjs=121&CXML_redir_for_hrefs=&timeout=100000000&debug=on"

            $.ajax({
                url:url_final,
                type:"GET",
                dataType: "jsonp",
                success:function(data) {
                  mylog.log('il rentre dans le second AJAX')
                  console.dir(data)
                  data_dbpedia = data;
              

            var prefixe = data_dbpedia.results.bindings[0];

            var test = ["item", "abstract", "country", "countryLabel", "region", "regionLabel", "department", "departmentLabel", "maire", "maireLabel", "postalCode", "inseeCode", "gentile", "populationTotal", "superficie", "siteweb"];

            mylog.dir(prefixe);
            $.each(test, function( index, value ) {

              //mylog.log(value, typeof prefixe[value]);
              if (typeof prefixe[value] == "undefined") {


                //mylog.log('il rentre dans le if ')
                wikipedia.fr[value].value = "Il manque cette information" ; 

                } else { 

                //mylog.log('il rentre dans le else')  
                wikipedia.fr[value].value = prefixe[value].value;
              }

            });       

            /*wikipedia.fr.abstract = data_dbpedia.results.bindings[0].abbstract.value;
            wikipedia.fr.country = data_dbpedia.results.bindings[0].country.value;
            wikipedia.fr.countryLabel = data_dbpedia.results.bindings[0].countryLabel.value;
            wikipedia.fr.region = data_dbpedia.results.bindings[0].region.value;
            wikipedia.fr.regionLabel = data_dbpedia.results.bindings[0].regionLabel.value;

            wikipedia.fr.department = data_dbpedia.results.bindings[0].department.value;
            wikipedia.fr.departmentLabel = data_dbpedia.results.bindings[0].departmentLabel.value;

            wikipedia.fr.maire = data_dbpedia.results.bindings[0].maire.value;
            wikipedia.fr.maireLabel = data_dbpedia.results.bindings[0].maireLabel.value;                
            wikipedia.fr.postalCode = data_dbpedia.results.bindings[0].postalCode.value;
            wikipedia.fr.inseeCode = data_dbpedia.results.bindings[0].inseeCode.value;
            
            if (typeof data_dbpedia.results.bindings[0].gentile === "undefined") {
              wikipedia.fr.gentile = "Il manque cette information " ;
            } else {
            wikipedia.fr.gentile = data_dbpedia.results.bindings[0].gentile;
          }
            //wikipedia.fr.populationAgglomeration = data_dbpedia.results.bindings[0].populationAgglomeration.value;
            //wikipedia.fr.latitude = data_dbpedia.results.bindings[0].latitude.value;
            //wikipedia.fr.longitude = data_dbpedia.results.bindings[0].longitude.value;
            //wikipedia.fr.altMaxi = data_dbpedia.results.bindings[0].altMaxi.value;
            //wikipedia.fr.altMini = data_dbpedia.results.bindings[0].altMini.value;
            wikipedia.fr.populationTotal = data_dbpedia.results.bindings[0].populationTotal.value;

            wikipedia.fr.superficie = data_dbpedia.results.bindings[0].superficie.value;

            if (typeof data_dbpedia.results.bindings[0].siteweb === "undefined") {
              wikipedia.fr.siteweb = "Il manque cette information " ;
            } else { 
            wikipedia.fr.siteweb = data_dbpedia.results.bindings[0].siteweb.value;

            }

            */
            wikipedia.fr.depiction = data_dbpedia.results.bindings[0].picture.value;
            

            $("#ajax-modal-modal-title").html("<img width=40 src='<?php echo $this->module->assetsUrl; ?>/images/logos/Wikipedia-logo-en-big.png'> <h1 align='center'>  <a target='_blank' href='"+wikipedia.fr.item.value+"'> "+label_dbpedia)+"</a></h1>";
              $("#ajax-modal-modal-body").html( "<div class='row bg-white'>"+

                                "<div class='col-sm-10 col-sm-offset-1'> <h2> Infobox Wikipédia </h2>"+
                                      //"<div id='P18'>image : "+wikidata.entities[q].claims.P18[0].mainsnak.datavalue.value+"</div>"+

                                      "<div id='abstract'>Abstract Wikipédia : "+wikipedia.fr.abstract.value+"</div>"+

                                    
                                      
                                      "<div id='country'> Pays : " +wikipedia.fr.countryLabel.value+" ===> URI de la ressource dbpédia : <a target='_blank' href='"+wikipedia.fr.country.value+"'> "+wikipedia.fr.country.value+"</a></div>"+

                                      
                                      "<div id='region'> Région : "+wikipedia.fr.regionLabel.value+" ===> URI vers la ressource dbpédia : <a target='_blank' href='"+wikipedia.fr.region.value+"'> "+wikipedia.fr.region.value+"</a></div>"+


                                      
                                      "<div id='department'> Département : " +wikipedia.fr.departmentLabel.value+" ===> URI vers la ressource dbpédia : <a target='_blank' href='"+ wikipedia.fr.department.value+"'> "+ wikipedia.fr.department.value+"</a></div>"+ 


                                      
                                      "<div id='maire'> Maire de la ville : " +wikipedia.fr.maire.value+"</div>"+
              

                                      "<div id='postalCode'> Code postal : " +wikipedia.fr.postalCode.value +"</div>"+

                                      "<div id='inseeCode'> Code INSEE : " +wikipedia.fr.inseeCode.value +"</div>"+

                                      "<div id='gentile'> Gentilé : " +wikipedia.fr.gentile.value +"</div>"+

                                      //"<div id='populationAgglomeration'> Population de l'Agglomération : " +wikipedia.fr.populationAgglomeration +"</div>"+

                                      "<div id='populationTotal'> Population municipale : " +wikipedia.fr.
populationTotal.value +"</div>"+
                                      //"<div id='latitude'> Lalitude : " +wikipedia.fr.latitude +"</div>"+

                                      //"<div id='longitude'> Longitude : " +wikipedia.fr.longitude +"</div>"+

                                      //"<div id='altMaxi'> Altitude Maximum : " +wikipedia.fr.altMaxi +"</div>"+

                                      //"<div id='altMini'> Altitude Minimum : " +wikipedia.fr.altMini +"</div>"+

                                      "<div id='superficie'> Superficie : " +wikipedia.fr.superficie.value +"</div>"+

                                      "<div id='siteweb'> Site Web : " +wikipedia.fr.siteweb.value +"</div>"+

                                      "<div id='depiction'> " +
                                      "<img id='photo_ville' src="+ wikipedia.fr.depiction+" alt='Photo de la ville' title='Cliquez pour agrandir' width='40%' height='40%' /> " + 


                                      // Faudrait mettrele blazon ici 

                                      "</div>"+


                                      //"<div id='P94'>coat of arms image : "+wikidata.entities[q].claims.P94[0].mainsnak.datavalue.value+"</div>"+


                                      //"<div id='P94'>located in time zone : "+wikidata.entities[q].claims.P421[0].mainsnak.datavalue.value+"</div>"+


                                      //"<div id='P94'>area : "+wikidata.entities[q].claims.P2046[0].mainsnak.datavalue.value+"</div>"+


                                      //"<div id='P94'>shared borders : "+wikidata.entities[q].claims.P47[0].mainsnak.datavalue.value+"</div>"+


                                      //"<div id='P94'>lien insee : "+wikidata.entities[q].claims.P374[0].mainsnak.datavalue.value+"</div>"+


                                      "</div>"+
                                    "</div>");
              $('.modal-footer').show();
              $('#ajax-modal').modal("show");

                },
                error:function (xhr, ajaxOptions, thrownError){
                  alert("error 2");
                } 
                }); 
          }
        },
        error:function (xhr, ajaxOptions, thrownError){
          alert("error");
        } 
    });
}

var cityFinderObj = {
  title1 : "<i class='fa fa-map-marker text-yellow'></i> <?php echo $city["name"];?>",
  title2 : "Thèmatique <i class='fa fa-asterisk text-yellow'></i> ",
  menu : {
    content : {
        label  : "Contenu",
        icon   : "fa-pencil-square-o",
        action : "javascript:alert('Link')" },
    followers : {
        label  : "Popularité",
        icon   : "fa-users",
        action : "javascript:alert('Link')" },
    latest : { 
        label  : "Activité",
        icon   : "fa-clock-o",
        action : "javascript:alert('Link')" }
  },
  list : {
    <?php foreach (OpenData::$categ as $key => $value) 
    {
      if( @$value["icon"] )
      {
      ?>
        "<?php echo @$value["name"]?>" : { label  : "<?php echo @$value["name"]?>", 
                                            labelCount : 0,
                                            icon   : "<?php echo @$value["icon"]?>", 
                                            key : "<?php echo @$value["name"]?>", 
                                            //color : "dark",
                                            classes : slugify("<?php echo @$value["name"]?>")+"Btn kickerBtn",
                                            action : "javascript:;",
                                            click : function(){
                                                cityFinderObj.search( scopeType, "<?php echo @$value["name"]?>", "<?php echo @$value["icon"]?>", <?php echo json_encode( @$value["tags"] );?> ) 
                                            }
      }, 
    <?php }
    } ?>
  },
  finder : function (type,where)
  {
    scopeType = type;
    if( type == "region" ) 
        scopeName = 'region : <?php echo $city["regionName"];?>';
    else if( type == "departement" ) 
        scopeName = "dep : <?php echo $city["depName"];?>";
    else 
        scopeName = '<?php echo $city["name"];?>';

    cityFinderObj.title1 = "<i class='fa fa-map-marker text-yellow'></i> "+scopeName; 

    smallMenu.build( cityFinderObj, 
                    function(params){return js_templates.leftMenu_content(params);},
                    function(){
                        $(".labelCount").html('(0)');
                        $.each(categs,function (i,c){c.count = 0;});
                        $.each( contextMap,function(k,v){
                          var tagList = [];
                          $.each(v.tags,function (i,t){
                            tagList.push( t.toLowerCase() );
                          });
                          $.each(categs,function (i,c)
                          {
                            var common = intersection_destructive(tagList, c.tags);
                            var isIn = (common.length > 0) ? true : false;
                            if(isIn){
                              c.count++;
                              $("."+slugify(c.name)+"Btn").addClass('bg-red');
                              $("."+slugify(c.name)+"Btn .labelCount").html('('+c.count+')');
                            }
                          })
                        });
                        $(".kickerBtn").on("click",function() { 
                          cityFinderObj.list[$(this).data('key')].click()  
                        });
                        $(".menuSmallLeftMenu").prepend("<h2 class='homestead'>Trier</h2>")
                    });
  },
  search : function  ( type, what, icon, tags ) 
  { 
      searchTypes = ["events","projects","organizations"];
      var params = {
          name : "",
          searchTag : tags,
          searchBy : "CODE_POSTAL_INSEE",
          indexMax : 200,
          indexMin : 0,
          searchType : searchTypes,
          tpl : "list",
          otherCollectionList : function() {
            var strHTML = "<h2 class='homestead'>Thématiques</h2>"+
                  js_templates.loop( cityFinderObj.list,"linkList",{ classes : "menuThemeBtn" });
            $("#listCollections").append(strHTML);
            $(".menuThemeBtn").on("click",function() { 
              cityFinderObj.list[ $(this).data('key') ].click();
            }); 
          }
      };

      delete params.searchLocalityCODE_POSTAL;
      delete params.searchLocalityREGION;
      delete params.searchLocalityDEPARTEMENT;
      if( type == "region" ) 
          params.searchLocalityREGION = ['<?php echo $city["regionName"];  ?>'];
      if( type == "departement" ) 
          params.searchLocalityDEPARTEMENT = ["<?php echo $city["depName"];  ?>"];
      else 
          params.searchLocalityCODE_POSTAL = postalCodes;
      
      console.dir(params);
      smallMenu.openAjax( baseUrl+'/'+moduleId+'/search/globalautocomplete',
                     what, icon, 'yellow',
                     '<a href="javascript:cityFinderObj.finder(scopeType,scopeName)"><i class="fa fa-th text-grey"></i></a> <i class="fa fa-angle-right"></i> <i class="fa fa-map-marker text-yellow"></i> '+scopeName ,
                     params );
  } 
};

<?php 
$cps = array();
foreach ($city["postalCodes"] as $key => $value) {
  $cps[] = $value["postalCode"];
}
?>

var postalCodes = <?php echo json_encode( $cps);?>;
var cityRegion = "<?php echo $city["region"];?>";
var cityDep = "<?php echo $city["dep"];?>";
var scopeType = null;
var scopeName = null;

function  initCurrentCityZones() { 
    $.each(postalCodesDynForm,function (i,c){
        if(typeof c.complement == "undefined"){
          var pc = {
              label : c.postalCode + " - " +c.name,
              classes:"bg-"+typeObj["cities"].color,
              icon:"fa-"+typeObj["cities"].icon,
              action : "#city.detail.insee."+city["insee"]+".postalCode."+c.postalCode
          }
          currentCityPC.push(pc);
        }
        
    });
    $.each(zones,function (i,z){
        var zone = {
            label : z.name,
            classes:"bg-"+typeObj["event"].color,
            icon:"fa-map",
            action : "" 
        }
        currentCityZones.push(zone);
    });
}

</script>