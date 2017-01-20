 <div class="cityHeadSection"></div>
 <?php 

Menu::zone($zone);
$this->renderPartial('../default/panels/toolbar'); 

 $cssAnsScriptFilesModule = array(
    '/assets/css/city/detail.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, Yii::app()->theme->baseUrl);
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
<div class="row padding-20" id="zoneDetail">
  <div class="col-xs-12 col-md-12" style="margin-bottom:-10px;">

      <h1 class="homestead text-red text-center zoneName-header">
        <span class="margin-bottom-10" style="">
          <a href="javascript:getWiki('<?php echo @$zone["wikidataID"]; ?>')" class="pull-right">
            <img width=50 src="<?php echo $this->module->assetsUrl; ?>/images/logos/Wikipedia-logo-en-big.png">
          </a>
          <i class="fa fa-university"></i><?php echo $zone["name"]; ?>
        </span>

        <div id="div-discover" class="col-md-12 col-sm-12 col-lg-12 col-xs-12">
          <div class="col-md-12 no-padding" style="margin-top:20px">
            <?php
              //$lockCityKey = ($cityGlobal == true) ? $city["country"].'_'.$city["insee"] : City::getUnikey($city) ;
            ?>
              <div class="col-xs-3 center no-padding hidden-xs" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                  <a href="#default.agenda?id=<?php echo (String)$zone["_id"]; ?>"" class="lbh btn btn-discover bg-orange">
                    <i class="fa fa-calendar"></i>
                  </a>
                  <?php $cnt= (isset($events)) ? count($events): 0; ?>
                  <span class="badge nb-localactors bg-orange"><?php echo $cnt; ?></span>
                  <br>
                  <span class="text-orange discover-subtitle">
                    <?php echo Yii::t("common", "Agenda") ;?>
                  </span>
              </div>
              <div class="col-xs-4 col-sm-2 col-md-2 center no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                  <a href="#default.directory?type=projects" class="lbh btn btn-discover bg-purple">
                    <i class="fa fa-lightbulb-o"></i>
                  </a>
                  <?php $cnt= (isset($projects)) ? count($projects): 0; ?>
                  <span class="badge nb-localactors bg-purple"><?php echo $cnt; ?></span>
                  <!-- <br/>Rechercher des -->
                  <br/>
                  <span class="text-purple discover-subtitle homestead">
                   <?php echo Yii::t("common", "LOCAL PROJECTS") ;?> 
                  </span>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 center no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                  <a href="#default.directory?type=persons" class="lbh btn btn-discover bg-yellow">
                    <i class="fa fa-user"></i>
                  </a>
                  <?php $cnt= (isset($people)) ? count($people): 0; ?>
                  <span class="badge nb-localactors bg-yellow"><?php echo $cnt; ?></span>
                  <!-- <br/>Rechercher des -->
                  <br/>
                  <span class="text-yellow discover-subtitle homestead">

                   <?php echo Yii::t("common", "LOCAL CONNECTED CITIZENS") ;?> 
                  </span>
              </div>

              <div class="col-xs-4 col-sm-2 col-md-2 center no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                  <a href="#default.directory?type=organizations" " class="lbh btn btn-discover bg-green">
                    <i class="fa fa-group"></i>
                  </a>
                  <?php $cnt= (isset($organizations)) ? count($organizations): 0; ?>
                  <span class="badge nb-localactors bg-green"><?php echo $cnt; ?></span>
                  <!-- <br/>Rechercher des -->
                  <br/>
                  <span class="text-green discover-subtitle homestead">
                   <?php echo Yii::t("common", "ORGANIZATIONS") ;?> 
                  </span>
              </div>
                    
              <div class="col-xs-6 col-sm-3 col-md-3 center text-red no-padding" style="margin-bottom:10px; font-size:17px; font-weight: 300;">
                  <label class="btn btn-discover bg-red"><i class="fa fa-group"></i></label>
                  <br/><span class='text-red discover-subtitle'>Conseil citoyen<br/>
                  <select id="selectRoom" class="text-red">
                      <option value="">Choisir</option>
                      <?php 
                        foreach ($zone["postalCodes"] as $key => $value) {
                          $zoneUniKey = array("country" => $zone["country"],
                                                "insee" => $zone["insee"],
                                                "cp" => $value["postalCode"]);
                          echo '<option value="#rooms.index.type.cities.id.'.City::getUnikey($zoneUniKey).'">'.$value["name"].' ('. $value["postalCode"].')</option>';
                        }
                      ?>
                  </select> 
                  </span> 
              </div>
          </div>
          <div class="space20"></div>
          <a href="javascript:elementLib.openForm(zonesDynForm)" class="btn btn-default">Zones</a>
          <a href="javascript:cityFinder('city','<?php echo $zone["name"];?>')" class="btn btn-default">Filiaires locales</a>  <a href="javascript:cityFinder('departement','<?php echo $zone["depName"];?>')" class="btn btn-default">Filiaires département</a>  <a href="javascript:cityFinder('region','<?php echo $zone["regionName"];?>')" class="btn btn-default">Filiaires région</a> 
        </div>
      </h1>
  </div>
</div> 
<div class="col-xs-12">
  <?php $this->renderPartial('../default/live'/*, array("lockCityKey" => City::getUnikey($city))*/); ?>
</div>

<!-- end: PAGE CONTENT-->

<script >
var contextData =  <?php echo json_encode($zone) ?>;
var contextMap = <?php echo json_encode($contextMap) ?>;
var categs = <?php echo json_encode(OpenData::$categ) ?>;


jQuery(document).ready(function() {
  $(".main-col-search").addClass("cityHeadSection");
  var iconCity = "<i class='fa fa-university'></i>";
  var mine = (contextData["insee"] == inseeCommunexion && contextData["cp"] == cpCommunexion) ? " MA" : "";
  var mineCity = (contextData["insee"] == inseeCommunexion && contextData["cp"] == cpCommunexion) ? true : false;

  <?php if( @$contextData["communected"] ){ ?>
  iconCity = "<span class='fa-stack'>"+
                  "<i class='fa fa-university fa-stack-1x'></i>"+                
                  "<i class='fa fa-circle-thin fa-stack-2x' style='color:#93C020'></i>"+
                "</span>";
  <?php } ?>
  setTitle(mine + " COMMUNE : "+contextData.name+" ("+contextData.country+")", iconCity);

  initMap();
  

});


function initMap(){
  Sig.showMapElements(Sig.map, contextMap);
  var geoShape = Sig.inversePolygon(contextData.geoShape.coordinates["0"]);
  Sig.showPolygon(geoShape);
}

</script>