<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

?>
<style>
/*#menu-top-container{
  z-index:1;
  position:absolute; 
  top:15px; 
  left:25px;
}*/
#menu-top-container{
  z-index:1;
  position:fixed; 
  top:0px; 
  left:0px;
  padding: 10px 0px 10px 18px;
  width:100%;    
  background-color: rgba(255, 255, 255, 0.56);
}

#menu-container{
  background-color: rgba(255, 255, 255, 0.58) !important;
  padding: 10px;
  border-radius: 0px 0px 10px 0px;
  z-index: 1;
  position: fixed;
  top: 56px;
  left: 0px;
  border: none;
}
#menu-container a.text-white {
    color: rgba(17, 97, 104, 0.69);
}
#menu-container a.text-white:hover {
    color: #FFF;
}
#searchBar{
  height: 56px;
  top: 0px;
  position: absolute;
  right: 60px;
  border: 0;
  background-color: rgba(255, 255, 255, 0.63) !important;
  color: #116168 !important;
  padding: 0px 20px;
  width: 272px;
}

.box-white-round{
  background-color:rgba(255, 255, 255, 0.5) !important;
  border-radius:10px !important;
}

li.mix{
  background:rgba(255, 255, 255, 0.7) !important;
  border-radius: 2px;
  box-shadow: none;
  border: 1px solid rgba(187, 187, 187, 0.49);
}
.panel-body{
  background:rgba(255, 255, 255, 0.6) !important;
}
#dropdown_searchTop .li-dropdown-scope ol{
  padding:3px !important;
  color:#155869;
}

#dropdown_searchTop .li-dropdown-scope ol a{
  color:inherit !important;
}
#dropdown_searchTop .li-dropdown-scope ol:hover{
  background-color:#88BBC8;
  color:white !important;
}
.timeline-scrubber{
  z-index:1 !important;
}
#menu-top-container .dropdown-menu {
    position: absolute;
    top: 96%;
    left: unset;
    z-index: 1000;
    display: none;
    float: left;
    min-width: 153px;
    padding: 5px 0px;
    margin: 2px 0px 0px;
    font-size: 14px;
    text-align: left;
    list-style: outside none none;
    background-color: #FFF;
    background-clip: padding-box;
    border: 0px solid rgba(0, 0, 0, 0.15);
    border-radius: 1px;
    box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.176);
    width: 333px;
    padding: 10px 5px;
    right: -1px !important;
}

#menu-top-container .fa-search{
  right: 332px;
  position: absolute;
  font-size: 18px;
  padding: 8px 6px;
  color: rgba(17, 97, 104, 0.66) !important;
}

#menu-top-container .btn-show-map{
  right: 0px;
  height: 56px;
  width: 60px;
  top: 0px;
  position: absolute;
  font-size: 18px;
  padding: 8px 6px;
  color: rgba(255, 255, 255, 0.7) !important;
  background-color: rgba(38, 88, 108, 0.73);
  border: none;
  border-radius: 0px;
}
.nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
    color: #FFF;
    background-color: #7BA4B1;
}
</style>

<div class="pull-right" style="padding:20px;">
  <a href="#" onclick="showHideMenu ()">
    <i class="menuBtn fa fa-bars fa-3x text-white "></i>
  </a>
</div>


<div class="row">
  <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 center">
  <a class="byPHRight" href="#"><img style="height: 39px;position: fixed;left: 0px;bottom: 10px;z-index: 2000;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/DRAPEAU_COMMUNECTER.png"/></a>
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
  <div class="col-xs-10 col-xs-offset-1  center">

    
    <style type="text/css">
      #ajaxSV{top:0px;}
      @media screen and (max-width: 768px) {
        #ajaxSV,.box{top:-100px;}
      }
    </style>
    <h1 class="panelTitle text-extra-large text-bold" style="display:none"></h1>
    <div class="box-ajax box box-white-round" id="ajaxSV">
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
<div class="center text-white" id="menu-container" style="" >
    <div class="center text-white pull-left">
        <img class="img-circle" width="40" height="40" src="<?php echo Yii::app()->session['user']['profilImageUrl']?>" alt="image">
        <br/><br/><a href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/detail/id/<?php echo Yii::app()->session['userId']?>', '<?php echo Yii::app()->session['user']['name']?>','user' )" class="text-white btn-home btn-main-menu"><i class="fa fa-home fa-2x"></i></a>
        <br/><br/><a href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/news/index/type/citoyens?isNotSV=1', 'KESS KISS PASS ','rss' )" class="text-white btn-main-menu"><i class="fa fa-rss fa-2x"></i></a>
        <br/><br/><a href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&isNotSV=1', 'MY WORLD ','share-alt' )" class="text-white btn-main-menu"><i class="fa fa-share-alt fa-2x"></i></a>
        <br/><br/><a href="#" onclick="showPanel('box-add',null,'ADD SOMETHING TO MY NETWORK')" class="text-white"><i class="fa fa-plus fa-2x btn-main-menu"></i></a>
        <?php /* ?>
        /ph/communecter/news/index/type/citoyens/id/520931e2f6b95c5cd3003d6c
        <br/><br/><a href="#" id="filter-menu-persons" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'PERSON DIRECTORY ','user' )" class="text-white"><i class="fa fa-user fa-2x"></i></a>
        <?php //onclick="showPanel('box-people',null,'PEOPLE','user')" ?>
        <br/><br/><a href="#" id="filter-menu-organizations" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Organization::COLLECTION ?>', 'ORGANIZATION DIRECTORY ','users' )" class="text-white"><i class="fa fa-users fa-2x"></i></a>
        <?php //showPanel('box-orga',null,'ORGANIZATIONS','users') ?>
        <br/><br/><a href="#" id="filter-menu-events" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Event::COLLECTION ?>', 'EVENT DIRECTORY ','calender' )" class="text-white"><i class="fa fa-calendar fa-2x"></i></a>
        <?php //showPanel('box-event',null,'EVENTS','calendar') ?>
        <br/><br/><a href="#" id="filter-menu-projects" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&type=<?php echo Project::COLLECTION ?>', 'PROJECT DIRECTORY ','calender' )" class="text-white"><i class="fa fa-lightbulb-o fa-2x"></i></a>
        <?php //showPanel('box-projects',null,'PROJECTS','lightbulb-o') ?>
        */?>
        <!-- <br/><br/><a href="#" onclick="showMap()" class="text-white"><i class="fa fa-map-marker fa-2x"></i></a> -->
        <br/><br/><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout') ?>" class="text-white"><i class="fa fa-sign-out fa-2x"></i></a>
    </div>
</div>

<?php /* **********************
  HEADER : CONTEXT TITLE + SEARCH 
**************************** */?>
<div class="center pull-left" id="menu-top-container" style="" >
    <span class="homestead moduleLabel pull-left" style="color:#58879B;font-size:25px"></span>
    
      <button class="btn btn-default btn-show-map pull-right"><i class="fa fa-map-marker"></i></button>  
      <form class="inner pull-right">
        <input class='hide' id="searchId" name="searchId"/>
        <input class='hide' id="searchType" name="searchType"/>
        <input id="searchBar" name="searchBar" type="text" placeholder="Que recherchez-vous ?" style="background-color:#58879B; color:white">
        <ul class="dropdown-menu" id="dropdown_searchTop" style="">
          <ol class="li-dropdown-scope">-</ol>
        </ul>
      </input>
      </form>
      <i class="fa fa-search"></i>
</div>

<?php /* **********************
  PARTNER LOGOS
**************************** */?>
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

<?php /* ?>

http://habibhadi.com/lab/svgPathAnimation/demo/
http://jonobr1.github.io/two.js/#basic-usage
http://rvlasveld.github.io/blog/2013/07/02/creating-interactive-graphs-with-svg-part-1/

<style type="text/css">
svg.graph {
  position: absolute;
  top:0px;
  left: 0px;
  height: 1000px;
  width: 1000px;
}

svg.graph .line {
  stroke: white;
  stroke-width: 1;
}
</style>

<svg class="graph">
  <circle cx="0" cy="0" stroke="white" fill="white" r="5"></circle>
  <path class="line" d=" M 0 0 L 600 100"></path>
  <path class="line" d=" M 0 0 L 150 150"></path>
  <path class="line" d=" M 0 0 L 330 100"></path>
</svg>
*/?>
<script type="text/javascript">
var timeout;
var mapIconTop = {
    "citoyen":"php", 
    "NGO":"fa-users",
    "LocalBusiness" :"fa-industry",
    "Group" : "fa-circle-o",
    "GovernmentOrganization" : "fa-university",
    "event":"fa-calendar",
    "project":"fa-lightbulb-o"
  };
  jQuery(document).ready(function() {

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
      showPanel('box-menu');
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
        }   
    });

    $('#searchBar').focusout(function(e){
      $('#dropdown_searchTop').css("display" , "none");
    });
    
    $('#searchBar').focusin(function(e){
      if($("#searchBar").val() != "")
      $('#dropdown_searchTop').css("display" , "inline");
    });
    
    $('.btn-show-map').click(function(e){
      showMap();
    });

    $("#searchForm").off().on("click", function(){
      $("dropdown_searchTop").css("display", "none");
    });

    if( "onhashchange" in window && location.hash){
      loadByHash(location.hash);
    }
    else
      showAjaxPanel( baseUrl+'/'+moduleId+'/news?isNotSV=1', 'KESS KISS PASS ','rss' ); ///index/type/citoyens/id/<?php echo Yii::app()->session['userId']?>

  });

function loadByHash( hash ) { 
  switch( hash ) {
    case "communecter.person.directory" :
        showAjaxPanel( baseUrl+'/'+moduleId+'/person/directory/?tpl=directory2&isNotSV=1', 'MY WORLD ','share-alt' );
        break;
    case "communecter.person.detail" :
        showAjaxPanel( baseUrl+'/'+moduleId+'/person/detail/?tpl=directory2&isNotSV=1', 'MY WORLD ','share-alt' );
        break;
    default:
        showAjaxPanel( baseUrl+'/'+moduleId+'/news?isNotSV=1', 'KESS KISS PASS ','rss' );
}
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
            console.log(v, v.length, v.size);
            var typeIco = i;
            if(v.length!=0){
              $.each(v, function(k, o){
                city = "";
                postalCode = "";
                if(o.type){
                  typeIco = o.type;
                }
                if (o.address != null) {
                  city = o.address.addressLocality;
                  postalCode = o.address.postalCode;
                }
                str +=  "<div class='searchList li-dropdown-scope' ><ol>"+
                    "<a href='#' data-id='"+ o._id["$id"] +"' data-type='"+ i +"' data-icon='"+ mapIconTop[typeIco] +"' data-name='"+ o.name +"' class='searchEntry'>"+
                    "<span><i class='fa "+mapIconTop[typeIco]+"'></i></span>  " + o.name +
                    "<span class='city-search'> "+postalCode+" "+city+"</span>"+
                    "</a></ol></div>";
              })
            }
            }); 
            if(str == "") str = "<ol class='li-dropdown-scope'>Aucun résultat</ol>";
            $("#dropdown_searchTop").html(str);
            $("#dropdown_searchTop").css({"display" : "inline" });
            
            $(".searchEntry").off().on("click", function(){
              
            });
            
            addEventOnSearch(); 
          }
      } 
    })
  }

  function addEventOnSearch() {
    $('.searchEntry').off().on("click", function(){
      setSearchInput($(this).data("id"), $(this).data("type"),$(this).data("name"), $(this).data("icon") );
    });
  }

  function setSearchInput(id, type,name,icon){
    if(type=="citoyen"){
      type = "person";
    }
    url = baseUrl+"/" + moduleId + "/"+type+"/detail/id/"+id;
    console.log($(this).data("type"),$(this).data("id") );
    showAjaxPanel( baseUrl+'/'+moduleId+'/'+type+'/detail/id/'+id, type+" : "+name,icon);
    /*
    $("#searchBar").val(name);
    $("#searchId").val(id);
    $("#searchType").val(type);
    $("#dropdown_searchTop").css({"display" : "none" });*/  
  }

</script>
