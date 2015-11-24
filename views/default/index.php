<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
//FloopDrawer
$cs->registerScriptFile($this->module->assetsUrl. '/js/floopDrawer.js' , CClientScript::POS_END);
$cs->registerCssFile($this->module->assetsUrl. '/css/floopDrawer.css');

//
$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/geoloc.js' , CClientScript::POS_END);

//JQUERY UI
//$cs->registerScriptFile($this->module->assetsUrl. '/js/jquery-ui-1.11.4/jquery-ui.js' , CClientScript::POS_END);
//$cs->registerCssFile($this->module->assetsUrl. '/js/jquery-ui-1.11.4/jquery-ui.css');

//localisation HTML5
$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/localisationHtml5.js' , CClientScript::POS_END);


if( !isset( Yii::app()->session['userId']) ){
    $cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/introjs/introjs.css');
    $cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/introjs/intro.js' , CClientScript::POS_END);
}

?>


<!-- <link href="jquery-ui.css" rel="stylesheet">
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
 -->
<div class="pull-right" style="padding:20px;">
  <a href="javascript:;" onclick="showHideMenu ()">
    <i class="menuBtn fa fa-bars fa-3x text-white "></i>
  </a>
</div>


<div class="row">
  <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 center">
  <a class="byPHRight" href="javascript:;"><img style="height: 39px;position: fixed;left: 0px;bottom: 10px;z-index: 2000;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/DRAPEAU_COMMUNECTER.png"/></a>
    <!-- start: LOGIN BOX -->
    <?php 
    $this->renderPartial('menuTitle',array("topTitleExists"=>false));
    $this->renderPartial('panels/what');
    $this->renderPartial('panels/how');
    $this->renderPartial('panels/why');
    $this->renderPartial('panels/where');
    $this->renderPartial('panels/when');
    $this->renderPartial('panels/who');
    $this->renderPartial('panels/events');
    $this->renderPartial('panels/cities');
    $this->renderPartial('panels/orga');
    $this->renderPartial('panels/people');
    $this->renderPartial('panels/involved');
    $this->renderPartial('panels/projects');
    $this->renderPartial('panels/ph');
    $this->renderPartial('panels/communecter');
    $this->renderPartial('panels/dashboard');    
    ?>
    
  </div>
  <div class="col-xs-12 col-xs-offset-1 main-col">
    <h1 class="panelTitle text-extra-large text-bold" style="display:none"></h1>
    <div class="box-ajax box box-white-round" id="ajaxSV" style="min-height:500px">
      <form class="form-login ajaxForm" style="display:none" action="" method="POST"></form>
    </div>
  </div>
</div>

<?php /* **********************
  ICON MARKER FLOTTANT
**************************** ?>
<div class="eventMarker" style="z-index:1;display:none;position:fixed; bottom:0px; right:50px;cursor:pointer;" >
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/event.png" style="width:72px;" />
  <span class="homestead eventMarkerlabel" style="display:none;color:white;font-size:25px">EVENTS</span>
</div>
<div class="cityMarker" style="z-index:1;display:none;position:absolute; bottom:0px; right:150px;cursor:pointer;" >
  <span class="homestead cityMarkerlabel" style="display:none;color:white;font-size:25px">CITIES</span>
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/mairie.png" style="width:72px;" />
</div>
<div class="projectMarker" style="z-index:1;display:none;position:absolute; bottom:0px; right:250px;cursor:pointer;" >
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/project.png" style="width:72px;" />
  <span class="homestead projectMarkerlabel" style="display:none;color:white;font-size:25px">PROJECTS</span>
</div>
<div class="assoMarker" style="z-index:1;display:none;position:absolute;bottom:0px; right:350px; cursor:pointer;" >
  <span class="homestead assoMarkerlabel" style="display:none;color:white;font-size:25px">ORGANIZATIONS</span>
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/asso.png" style="width:72px;" />
</div>
<div class="userMarker" style="z-index:1;display:none;position:absolute; bottom:0px; right:450px;cursor:pointer;" >
  <span class="homestead userMarkerlabel" style="display:none;color:white;font-size:25px">PEOPLE</span>
  <img src="<?php echo $this->module->assetsUrl?>/images/sig/markers/user.png" style="width:72px;" />
</div>

<?php /* **********************
  LEFT MENU
**************************** */?>



<div class="center text-white no-padding" id="menu-container" >
  <?php  $this->renderPartial('mainMenu'); ?>
</div>

       

<?php /* **********************
  HEADER : CONTEXT TITLE + SEARCH 
**************************** */?>
<div class="center pull-left" id="menu-top-container" style="" >
    <span class="homestead moduleLabel pull-left" style="color:#58879B;font-size:25px"><i class="fa fa-smile"></i><?php echo Yii::t("common","WELCOME",null,Yii::app()->controller->module->id) ?> !!!</span>
    
      <?php if( isset( Yii::app()->session['userId']) ){?>
      <button id="btn-show-notification" class="btn btn-default btn-corner-top-left btn-menu-top pull-right">
        <i class="fa fa-bell-o"></i>
        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn"><?php count($this->notifications); ?>0</span>
      </button>
      <?php } else { ?>
      <a href="#panel.box-communecter" onclick="showPanel('box-communecter',null,null,null);"  class="btn btn-default btn-menu-top pull-right btn-corner-top-left" style="display:block">
          <img src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
      </a>
      <?php } ?>
    
      <form class="inner pull-right">
        <input class='hide' id="searchId" name="searchId"/>
        <input class='hide' id="searchType" name="searchType"/>
        <input id="searchBar" name="searchBar" type="text" placeholder="Que recherchez-vous ?" style="background-color:#58879B; color:white">
        <ul class="dropdown-menu" id="dropdown_searchTop" style="">
          <ol class="li-dropdown-scope"><?php echo Yii::t("common","Searching",null,Yii::app()->controller->module->id) ?>Recherche en cours</ol>
        </ul>
      </input>
      </form>
      <i class="fa fa-search"></i>

      <button class="btn btn-default btn-menu-top pull-left" id="btn-show-map"><i class="fa fa-map"></i></button>  
      
</div>
<style type="text/css">
  .box-ajaxTools .btn.tooltips{
    margin-right: -1px;
    margin-bottom: -1px;
    font-size: 13px;
    height: 46px;
    transition: all 0.1s ease 0s !important;
    padding: 13px;
    color: #315C6E;
    font-weight: 500;
    border-radius: 0px;
    border-top-width: 0px;
    /*border-bottom: 3px solid #337793;*/
    box-shadow: 0px -1px 2px #C3C3C3;
  }
/*
  .box-ajaxTools .text-right .btn.tooltips{
    border-radius: 0px 10px 0px 10px;
    margin-right: 5px;
  }*/

  .box-ajaxTools .btn.tooltips:hover{
    border-bottom: 3px solid #719FAB !important;
    background-color: rgba(49, 92, 110, 1);
    color:white;
    /*height: 45px;*/
  }
  .box-ajaxTools .btn.tooltips.active{
    border-bottom: 3px solid #337793;
    background-color: #315C6E;
    color:white;
  }
  .box-ajaxTools .btnSpacer{
    margin-right: 0px;
  }
  .box-ajaxTools i.fa{
    min-width: 18px;
    width:auto;
    font-size: 17px;
  }
  /*.box-ajaxTools{
    z-index: 1;
    text-align: center;
    float: left !important;
    width: 100%;
    top: 48px;
    left: 0px;
    padding: 0px 20px 0px 20px;
    margin-bottom:20px;
  }*/

  .box-ajaxTools{
    z-index: 1;
    text-align: center;
    float: left !important;
    width: 100%;
    top: 56px;
    max-height: 45px;
    left: -1px;
    padding: 0px 0px 0px 70px;
    position: fixed;
    background-color: white;
    -moz-box-shadow: 0px 2px 3px -2px #656565;
    -webkit-box-shadow: 0px 2px 3px -2px #656565;
    -o-box-shadow: 0px 2px 3px -2px #656565;
    box-shadow: 0px 2px 3px -2px #656565;
    filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=3);
  }

</style>
<?php /* **********************
  PARTNER LOGOS
**************************** ?>
<img class="partnerLogosLeft" src="<?php echo $this->module->assetsUrl?>/images/partners/Logo_Bis-01.png" style="width:90px;position:absolute; top:500px; left:400px;display:none;" />
<img class="partnerLogosLeft" src="<?php echo $this->module->assetsUrl?>/images/partners/logo-cn.png" style="display:none;position:absolute; top:150px; left:150px;" />
<img class="partnerLogosLeft" src="<?php echo $this->module->assetsUrl?>/images/partners/logo_lc.png" style="width:120px;display:none;position:absolute; top:350px; right:100px;cursor:pointer;" />

<img class="partnerLogosRight" src="<?php echo $this->module->assetsUrl?>/images/partners/demosalithia.png" style="display:none;position:absolute; top5:0px; left:50px; cursor:pointer;" />
<img class="partnerLogosRight" src="<?php echo $this->module->assetsUrl?>/images/partners/ggouv.png" style="display:none;position:absolute; top:600px; right:200px;cursor:pointer;" />
<img class="partnerLogosRight" src="<?php echo $this->module->assetsUrl?>/images/partners/SENSORICA.jpg" style="width:120px;display:none;position:absolute; top:150px; right:200px; cursor:pointer;" />

<img class="partnerLogosDown" src="<?php echo $this->module->assetsUrl?>/images/partners/DO.png" style="width:120px;display:none;position:absolute; top:330px; left:100px; cursor:pointer;" />
<img class="partnerLogosDown" src="<?php echo $this->module->assetsUrl?>/images/partners/fab-lab1.png" style="width:80px;display:none;position:absolute; top:610px; left:90px; cursor:pointer;" />
<img class="partnerLogosDown" src="<?php echo $this->module->assetsUrl?>/images/partners/smartCitizen.png" style="display:none;position:absolute; top:750px; right:400px; cursor:pointer;" />

<img class="partnerLogosUp" src="<?php echo $this->module->assetsUrl?>/images/logo_region_reunion.png" style="width:80px;display:none;position:absolute; bottom:20px; left:20px; cursor:pointer;" />
<img class="partnerLogosUp" src="<?php echo $this->module->assetsUrl?>/images/technopole.jpg" style="display:none;position:absolute; bottom:20px; right:20px; cursor:pointer;" />
<img class="partnerLogosUp" src="<?php echo $this->module->assetsUrl?>/images/partners/imaginSocial.jpg" style="display:none; position:absolute; top:600px; right:550px; cursor:pointer;" />

*/?>

<?php 
    //rajoute un attribut typeSig sur chaque donnée pour déterminer quel icon on doit utiliser sur la carte
    //et pour ouvrir le panel info correctement
    $contextMap = array();
    if( isset( Yii::app()->session['userId']) ){
      foreach($people           as $key => $data) { $people[$key]["typeSig"] = PHType::TYPE_CITOYEN; }
      foreach($organizations    as $key => $data) { $organizations[$key]["typeSig"] = PHType::TYPE_ORGANIZATIONS; }
      foreach($events           as $key => $data) { $events[$key]["typeSig"] = PHType::TYPE_EVENTS; }
      foreach($projects         as $key => $data) { $projects[$key]["typeSig"] = PHType::TYPE_PROJECTS; }
      
      
      if(isset($organizations))   $contextMap = array_merge($contextMap, $organizations);
      if(isset($people))          $contextMap = array_merge($contextMap, $people);
      if(isset($events))          $contextMap = array_merge($contextMap, $events);
      if(isset($projects))        $contextMap = array_merge($contextMap, $projects);
    }

    function random_pic()
    {
        if(file_exists ( "../../modules/communecter/assets/images/proverb" )){
          $files = glob('../../modules/communecter/assets/images/proverb/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
          $res = array();
          for ($i=0; $i < 8; $i++) { 
            array_push( $res , str_replace("../../modules/communecter/assets", Yii::app()->controller->module->assetsUrl, $files[array_rand($files)]) );
          }
          return $res;
        } else
          return array();
    }

    if(isset(Yii::app()->session['userId'])){
      $myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
      $myFormContact = $myContacts; 
      $getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
    }else{
      $myFormContact = null;

    }
?>
<script type="text/javascript">
var timeout;
var mapIconTop = {
    "default" : "fa-arrow-circle-right",
    "citoyen":"<?php echo Person::ICON ?>", 
    "NGO":"<?php echo Organization::ICON ?>",
    "LocalBusiness" :"<?php echo Organization::ICON_BIZ ?>",
    "Group" : "<?php echo Organization::ICON_GROUP ?>",
    "group" : "<?php echo Organization::ICON ?>",
    "association" : "<?php echo Organization::ICON ?>",
    "GovernmentOrganization" : "<?php echo Organization::ICON_GOV ?>",
    "event":"<?php echo Event::ICON ?>",
    "project":"<?php echo Project::ICON ?>",
    "city": "<?php echo City::ICON ?>"
  };
var images = []; 
var mapData = <?php echo json_encode($contextMap) ?>;
var isNotSV = true;
var proverbs = <?php echo json_encode(random_pic()) ?>;
var myContacts = <?php echo ($myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
var myId = "<?php echo isset( Yii::app()->session['userId']) ? Yii::app()->session['userId'] : "" ?>"; 
var lastUrl = null;
jQuery(document).ready(function() {
    console.dir(proverbs);
    
    if($(".tooltips").length) {
      $('.tooltips').tooltip();
    }
    <?php if( !isset( Yii::app()->session['userId']) && 
              !isset( Yii::app()->request->cookies['user_geo_latitude']) 
            ) { ?>
      initHTML5Localisation("showCity");
    <?php } ?>
    
    bindEvents();
    

    //preload directory data
    /*$(window).on("popstate", function(e) {
      if( lastUrl && "onhashchange" in window && location.hash){
        console.log("popstate",location.hash);
        loadByHash(location.hash);
      }
      lastUrl = location.hash;
    });*/
    if( userId == "" || ("onhashchange" in window && location.hash ) ){
      loadByHash(location.hash);
    }
    else
      showAjaxPanel( '/news?isNotSV=1', 'KESS KISS PASS ','rss' ); 
    

    initMap();
    resizeInterface();
    $(window).resize(function(){
      resizeInterface();
    })
});

var typesLabels = {
  "<?php echo Organization::COLLECTION ?>":"Organization",
  "<?php echo Event::COLLECTION ?>":"Event",
  "<?php echo Project::COLLECTION ?>":"Project",
};

function loadByHash( hash ) { 
    console.log("loadByHash",hash);

    params = ( hash.indexOf("?") < 0 ) ? '?tpl=directory2&isNotSV=1' : "";
    if( hash.indexOf("#person.directory") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PERSON DIRECTORY ','share-alt' );
    else if( hash.indexOf("#organization.directory") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'ORGANIZATION MEMBERS ','users' );
    else if( hash.indexOf("#project.directory") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PROJECT CONTRIBUTORS ','users' );
    else if( hash.indexOf("#panel") >= 0 ){
        if(hash.substr(7) == "box-add")
            title = 'ADD SOMETHING TO MY NETWORK';
        else
            title = "WELCOM MUNECT HEY !!!";
        showPanel(hash.substr(7),null,title);
    }
    
    else if( hash.indexOf("#person.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PERSON DETAIL ','user' );
    else if( hash.indexOf("#event.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'EVENT DETAIL ','calendar' );
    else if( hash.indexOf("#project.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'PROJECT DETAIL ','lightbulb-o' );
    else if( hash.indexOf("#organization.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'ORGANIZATION DETAIL ','users' );
    else if( hash.indexOf("#city.detail") >= 0 )
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+params, 'CITY ','university' );
    
    else if( hash.indexOf("#organization.addorganizationform") >= 0 )
        showAjaxPanel( '/organization/addorganizationform?isNotSV=1', 'ADD AN ORGANIZATION','users' );
    else if( hash.indexOf("#person.invitesv") >= 0 )
        showAjaxPanel( '/person/invitesv?isNotSV=1', 'INVITE SOMEONE','share-alt' );
    else if( hash.indexOf("#event.eventsv") >= 0 )
        showAjaxPanel( '/event/eventsv?isNotSV=1', 'ADD AN EVENT','calendar' );
    else if( hash.indexOf("#project.projectsv") >= 0 )    
        showAjaxPanel( '/project/projectsv/id/<?php echo Yii::app()->session['userId']?>/type/citoyen?isNotSV=1', 'ADD A PROJECT','lightbulb-o' );
    else if( hash.indexOf("#project.addcontributorsv") >= 0 )    
        showAjaxPanel( '/project/projectsv/id/<?php echo Yii::app()->session['userId']?>/type/citoyen?isNotSV=1', 'ADD A PROJECT','lightbulb-o' );

    else if( hash.indexOf("#rooms.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'ACTIONS in this '+typesLabels[hashT[3]],'rss' );
    } else if ( hash.indexOf("#survey.entry.id") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'VOTE LOCAL ','legal' );
    }  else if ( hash.indexOf("#rooms") >= 0 ) {
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'ACTION ROOMS ','cubes' );
    }   


    else if( hash.indexOf("#news.index.type") >= 0 ){
        hashT = hash.split(".");
        showAjaxPanel( '/'+hash.replace( "#","" ).replace( /\./g,"/" )+'?&isNotSV=1', 'KESS KISS PASS in this '+typesLabels[hashT[3]],'rss' );
    } else if(userId != "")
        showAjaxPanel( '/news?isNotSV=1', 'KESS KISS PASS ','rss' );
    else
        showPanel('box-communecter',null,"WELCOM MUNECT HEY !!!",null);

    location.hash = hash;
    history.pushState({hash:hashUrl}, null, baseUrl+'/'+moduleId+hash );
}

function runShowCity(searchValue) {
  var citiesByPostalCode = getCitiesByPostalCode(searchValue);
  var oneValue = "";
  console.table(citiesByPostalCode);
  $.each(citiesByPostalCode,function(i, value) {
      $("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
      oneValue = value.value;
  });
  
  if (citiesByPostalCode.length == 1) {
    $("#city").val(oneValue);
  }

  if (citiesByPostalCode.length >0) {
        $("#cityDiv").slideDown("medium");
      } else {
        $("#cityDiv").slideUp("medium");
      }
}

function bindPostalCodeAction() {
  $('.form-register #cp').change(function(e){
    searchCity();
  });
  $('.form-register #cp').keyup(function(e){
    searchCity();
  });
}

function searchCity() {
  var searchValue = $('.form-register #cp').val();
  if(searchValue.length == 5) {
    $("#city").empty();
    clearTimeout(timeout);
    timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 100);
    clearTimeout(timeout);
    timeout = setTimeout('runShowCity("'+searchValue+'")', 100); 
  } else {
    $("#cityDiv").slideUp("medium");
    $("#city").val("");
    $("#city").empty();
  }
}

function autoCompleteSearch(name){
    var data = {"name" : name};
    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          success: function(data){
            if(!data){
              toastr.error(data.content);
            }else{
          str = "";
          var city, postalCode = "";
          $.each(data, function(i, v) {
            var typeIco = i;
            var ico = mapIconTop["default"];
            if(v.length!=0){
              $.each(v, function(k, o){
                
                typeIco = o.type;
                ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                htmlIco ="<i class='fa "+ ico +" fa-2x'></i>"
               
                //console.dir(o);
                  
                if (o.address != null) {
                  console.dir(o.address);
                  city = o.address.addressLocality;
                  //postalCode = o.address.postalCode;
                  //insee = o.address.insee;
                }
                
                if("undefined" != typeof o.profilImageUrl && o.profilImageUrl != ""){
                  var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+o.profilImageUrl+"'/>"
                }

                var insee      = o.insee ? o.insee : "";
                var postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                str +=  //"<div class='searchList li-dropdown-scope' >"+
                          "<a href='javascript:;' data-id='"+ o.id +"' data-type='"+ i +"' data-name='"+ o.name +"' data-icon='"+ ico +"' data-insee='"+ insee +"' class='searchEntry searchList li-dropdown-scope'>"+
                          "<ol>"+
                          "<span>"+ htmlIco +"</span>  " + o.name;

                var cityComplete = "";
                //console.log("POSTAL CODE : " + postalCode + " - " + insee + " - " + city);
                if("undefined" != typeof city && city != "Unknown") cityComplete += city;
                if("undefined" != typeof postalCode && postalCode != "Unknown" && cityComplete != "") cityComplete += " ";
                if("undefined" != typeof postalCode) cityComplete += postalCode;
                str +=   "<span class='city-search'> "+cityComplete+"</span>";

                str +=  "</ol></a>";//</div>";
              })
            }
            }); 
            if(str == "") str = "<ol class='li-dropdown-scope'><i class='fa fa-ban'></i> Aucun résultat</ol>";
            $("#dropdown_searchTop").html(str);
            $("#dropdown_searchTop").css({"display" : "inline" });
            $('#notificationPanel').hide("fast");

 
            addEventOnSearch(); 
          }
      } 
    });

    str = "<ol class='li-dropdown-scope'><i class='fa fa-circle-o-notch fa-spin'></i> Recherche en cours</ol>";
    $("#dropdown_searchTop").html(str);
    $("#dropdown_searchTop").css({"display" : "inline" });
                    
  }

  function addEventOnSearch() {
    $('.searchEntry').off().on("click", function(){
      setSearchInput($(this).data("id"), $(this).data("type"),
                     $(this).data("name"), $(this).data("icon"), 
                     $(this).data("insee") );

      $('#dropdown_searchTop').css("display" , "none");
    });
  }

  function setSearchInput(id, type,name,icon, insee){
    if(type=="citoyen"){
      type = "person";
    }
    url = "/"+type+"/detail/id/"+id;
    
    if(type=="cities")
        url = "/city/detail/insee/"+insee+"?isNotSV=1";
    //showAjaxPanel( '/'+type+'/detail/id/'+id, type+" : "+name,icon);
    openMainPanelFromPanel( url, type+" : "+name,icon, id);
    /*
    $("#searchBar").val(name);
    $("#searchId").val(id);
    $("#searchType").val(type);
    $("#dropdown_searchTop").css({"display" : "none" });*/  
  }


  function initMap(){
    var mapData = <?php echo json_encode($contextMap) ?>;
     
    //affichage des éléments sur la carte
    Sig.clearMap();
    Sig.showMapElements(mapBg, mapData);
    //alert("stop !");

    $("li.filter .label-danger").click(function(){
      $("#right_tool_map").hide("false");
      var mapData = <?php echo ( isset($projects) ) ? json_encode($projects) : "{}" ?>;
      Sig.showMapElements(mapBg, mapData);
    });
    //EVENT MENU PANEL
    // $(".filterorganizations").click(function(){
    //   $("#right_tool_map").hide("false");
    //   thisSig.currentMarkerPopupOpen = null;  
    //   Sig.changeFilter("organizations", Sig.map, "types");
    // });
    // $(".filterpersons").click(function(){
    //   $("#right_tool_map").hide("false");
    //   thisSig.currentMarkerPopupOpen = null;  
    //   Sig.changeFilter("people", Sig.map, "types");
    // });
    // $(".filterevents").click(function(){
    //   $("#right_tool_map").hide("false");
    //   thisSig.currentMarkerPopupOpen = null;  
    //   Sig.changeFilter("events", Sig.map, "types");
    // });
    // $(".filterprojects").click(function(){
    //   $("#right_tool_map").hide("false");
    //   thisSig.currentMarkerPopupOpen = null;  
    //   Sig.changeFilter("projects", Sig.map, "types");
    // });
    //EVENT MENU PANEL - ALL
    $(".filter").click(function(){
      if($(this).attr("data-filter") == "all"){
        $("#right_tool_map").hide("false");
        var mapData = <?php echo ( isset($contextMap) ) ? json_encode($contextMap) : "{}" ?>;
        thisSig.currentMarkerPopupOpen = null;  
        Sig.showMapElements(mapBg, mapData);
      }
    });

    $.each($(".item_map_list_panel"), function(){
      actions.push({ "id" : $(this).attr('data-id'), 
               "onclick" : $(this).attr('onclick')
             });
    });

  }

function togglePanel(activeClass) { 
  console.log("togglePanel",activeClass);
  $(".dataPanel").slideUp();
  $(activeClass).slideDown();
}

function resizeInterface(){
  var height = $("#mapCanvasBg").height() - 55;
  $("#ajaxSV").css({"minHeight" : height});
  $("#menu-container").css({"minHeight" : height});
  var heightDif = $("#search-contact").height();
  console.log("heightDif", heightDif);
  $(".floopScroll").css({"minHeight" : height-heightDif});
  $(".floopScroll").css({"maxHeight" : height-heightDif});
  $("ul.notifList").css({"maxHeight" : height-heightDif});

}

function bindEvents() { 
    $(".menuContainer,#menu-container,.menuIcon,.menuline").mouseover(function() {
      $(".menuline").removeClass("hide");
    });
   

    $(".menuContainer,#menu-container").mouseout(function() { 
      $(".menuline").addClass("hide");
    });
    
    //console.log("myContacts");
    //console.dir(myContacts);
    if(myContacts != null){
      var floopDrawerHtml = buildListContactHtml(myContacts, myId);
      $("#floopDrawerDirectory").html(floopDrawerHtml);
      $("#floopDrawerDirectory").hide();
      if($(".tooltips").length) {
        $('.tooltips').tooltip();
      }
      
      bindEventFloopDrawer();
    }

    $(".eventMarker").show().addClass("animated slideInDown").off().on("click",function() { 
      showPanel('box-event',null,"EVENTS");
    });
    $(".cityMarker").show().addClass("animated slideInUp").off().on("click",function() { 
      showPanel('box-city',null,"CITY");
    });
    $(".projectMarker").show().addClass("animated zoomInRight").off().on("click",function() { 
      showPanel('box-projects',null,"PROJECTS");
    });
    $(".assoMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
      showPanel('box-orga',null,"ORGANIZATIONS");
    });
    $(".userMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
      showPanel('box-people',null,"PEOPLE");
    });
    $(".byPHRight").show().addClass("animated zoomInLeft").off().on("click",function() { 
      showPanel('box-communecter');
    });

    //efface les outils SIG à chaque fois que l'on click sur un bouton du menu principal
    $(".btn-main-menu").click(function(){
      showMap(false);
    });

    $('#searchBar').keyup(function(e){
        var name = $('#searchBar').val();
        $(this).css("color", "#58879B");
        if(name.length>=3){
          clearTimeout(timeout);
          timeout = setTimeout('autoCompleteSearch("'+name+'")', 500);
        }else{
          $("#dropdown_searchTop").css("display", "none");
          $('#notificationPanel').hide("fast");
        }   
    });

    $('#searchBar').focusin(function(e){
      if($("#searchBar").val() != ""){
        $('#dropdown_searchTop').css("display" , "inline");
        $('#notificationPanel').hide("fast");
      }
    });
    
    $('.mapCanvas').click(function(e){
      $("#dropdown_searchTop").css("display", "none");
      $('#notificationPanel').hide("fast");
    });
    
    $('#ajaxSV').click(function(e){
      $("#dropdown_searchTop").css("display", "none");
      $('#notificationPanel').hide("fast");
    });
    
    $('#btn-show-notification').click(function(){
      if($("#notificationPanel").css("display") == "none")
        $('#notificationPanel').show("fast");
      else
        $('#notificationPanel').hide("fast");
        
    });

    $('#btn-show-map').click(function(e){
      showMap();
    });

    $("#searchForm").off().on("click", function(){
      $("#dropdown_searchTop").css("display", "none");
    });

    
    $('#communectMe').keyup(function(e){
        $("#searchBar").val( $('#communectMe').val() );
        var name = $('#communectMe').val();
        $(this).css("color", "#58879B");
        if(name.length>=3){
          clearTimeout(timeout);
          timeout = setTimeout('autoCompleteSearch("'+name+'")', 500);
        }else{
          $("#dropdown_searchTop").css("display", "none");
          $('#notificationPanel').hide("fast");
        }   
    });

}

function startIntro(){
    loadByHash("#city.detail.insee.97414");
var intro = introJs();
  intro.setOptions({
    showProgress : true,
    showBullets:false,
    scrollToElement:true,
    steps: [
      {
        element: '#menu-container',
        intro: "<b> Menu </b>: Access everything easily.",
        position: 'right'
      },
      {
        element: '#searchBar',
        intro: "<b>Your Search</b> "+
                "<br/>direct access to everything that's on your mind"+
                "<br/>Search People, Organizations, Events, Projects, Cities",
        position: 'bottom'
      },
      /*{
        element: '#dropdown_searchTop',
        intro: "<h1>Click here <i class='fa fa-arrow-up'></i></h1> ",
        position: 'bottom'
      },*/
      
      {
        element: '.moduleLabel',
        intro: '<h1>Discover a city </h1>',
        position: 'bottom'
      },
      {
        element: '#cityDetail_events ',
        intro: "<h1>Local Events </h1> ",
        position: 'right'
      },
      {
        element: '#cityDetail_organizations ',
        intro: "<h1>Local Organizations </h1> ",
        position: 'right'
      },
      {
        element: '#cityDetail_projects ',
        intro: "<h1>Local Projects </h1> ",
        position: 'left'
      },
       
      {
        element: '#btn-center-city',
        intro: "<h1>Click here </h1> ",
        position: 'bottom'
      },
      {
        element: '#btn-show-map',
        intro: "<h1>Click here </h1> ",
        position: 'bottom'
      },
      /*{
        element: '#right_tool_map',
        intro: "Search and find stuff in the map "+
                "People, Organizations, Events, Projects",
        position: 'left'
      },*/
      {
        element: '.pod-local-actors',
        intro: "<h1>See your city on the the Map</h1> ",
        position: 'left'
      },
      
      
      /*,
      {
        intro: "The Background Map always shows what is in the foreground",
        onbeforechange(function(targetElement) {
          showMap();
        }),
      },
      {
        intro: "Visit a city's activity",
        onbeforechange(function(targetElement) {
          showMap();
        }),
      },*/
      
    ]/*,
    onbeforechange(function(targetElement) {
          console.dir(targetElement);
        })*/
  });

  intro.onbeforechange( function(targetElement) {
        console.dir(targetElement);
        $(".box-whatisit").hide();
        /*if(targetElement.id == "searchBar")
        {
            $("#searchBar").val("97421").trigger("keyup");
            //loadByHash("#city.detail.insee.97414");
        } 
        else */
        if(targetElement.id == "btn-center-city" || targetElement.id == "btn-show-map"){
            showMap();
        }
    }).start();
}
</script>
