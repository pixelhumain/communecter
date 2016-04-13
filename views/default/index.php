<?php 
	$cs = Yii::app()->getClientScript();

	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/localization/messages_fr.js' , CClientScript::POS_END);
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
	//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/flexSlider/js/jquery.flexSlider-min.js' , CClientScript::POS_END);

	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
	//Data helper
	//$cs->registerScriptFile($this->module->assetsUrl. '/js/communecter.js' , CClientScript::POS_END);
	//Validation
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
	//select2
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.min.js' , CClientScript::POS_END);

	//FloopDrawer
	$cs->registerScriptFile($this->module->assetsUrl. '/js/floopDrawerRight.js' , CClientScript::POS_END);
	
	$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/localisationHtml5.js' , CClientScript::POS_END);
	//geolocalisation nominatim et byInsee
	$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/geoloc.js' , CClientScript::POS_END);

	$cssAnsScriptFilesModule = array(
		'/js/default/globalsearch.js',
		'/css/search.css',
		'/css/floopDrawerRight.css',
		'/css/sig/sig.css'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

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
?>

<?php 
	//si l'utilisateur n'est pas connecté
 	if(!isset(Yii::app()->session['userId'])){
		$inseeCommunexion 	 = isset( Yii::app()->request->cookies['inseeCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['inseeCommunexion'] : "";
		
		$cpCommunexion 		 = isset( Yii::app()->request->cookies['cpCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['cpCommunexion'] : "";
		
		$cityNameCommunexion = isset( Yii::app()->request->cookies['cityNameCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['cityNameCommunexion'] : "";

		$regionNameCommunexion = isset( Yii::app()->request->cookies['regionNameCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['regionNameCommunexion'] : "";

		$countryCommunexion = isset( Yii::app()->request->cookies['countryCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['countryCommunexion'] : "";
		/*if(@$inseeCommunexion && !empty($inseeCommunexion)){
			$city=Sig::getCityByCodeInsee($inseeCommunexion);
			$nbCpByInsee=count($city["postalCodes"]);
			if($nbCpByInsee > 1){
				$cityInsee=$city["name"];
			}
		}else{
			$nbCpByInsee=0;
		}*/

	}
	//si l'utilisateur est connecté
	else{
		$me = Person::getById(Yii::app()->session['userId']);
		$inseeCommunexion 	 = isset( $me['address']['codeInsee'] ) ? 
		   			    			  $me['address']['codeInsee'] : "";
		
		$cpCommunexion 		 = isset( $me['address']['postalCode'] ) ? 
		   			    			  $me['address']['postalCode'] : "";
		
		$cityNameCommunexion = isset( $me['address']['addressLocality'] ) ? 
		   			    			  $me['address']['addressLocality'] : "";
		
		$regionNameCommunexion = isset( $me['address']['regionName'] ) ? 
		   			    			  $me['address']['regionName'] : "";
		
		$countryCommunexion = isset( $me['address']['country'] ) ? 
		   			    			  $me['address']['country'] : "";
		if (@$inseeCommunexion){
			$city=SIG::getCityByCodeInsee($inseeCommunexion);
			$nbCpByInsee=count($city["postalCodes"]);
			if($nbCpByInsee > 1){
				$cityInsee=$city["name"];
			}
		}
		if(isset($me['profilImageUrl']) && $me['profilImageUrl'] != "")
          $urlPhotoProfil = Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$me['profilImageUrl']);
        else
          $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	}

?>

<div id="mainMap">
	<?php 
		$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		$this->renderPartial($layoutPath.'mainMap');
	?>
</div>

<?php //get all my link to put in floopDrawer
	if(isset(Yii::app()->session['userId'])){
      $myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
      $myFormContact = $myContacts; 
      $getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
    }else{
      $myFormContact = null;

    }
?>
<style>

	#menu-bottom .btn-param-postal-code{
		border-radius: 0px;
		left: 0px;
		bottom: 0px;
		height: 40px !important;
		width: 40px !important;
		font-size: 23px;
	}

	.btn-scope{
		display: none;
		position: fixed;
		border-radius: 50%;
		z-index: 1;
		border: none;
		background-color: rgba(255, 255, 255, 0.45) !important;
		box-shadow: 0px 0px 3px 3px rgba(114, 114, 114, 0.1);
	} 
	.btn-scope.selected{
		background-color: rgb(233, 96, 118) !important;
	}
	.btn-scope:hover{
		background-color: rgb(233, 96, 118) !important;
	}
	.btn-scope-niv-2{
		bottom: 43px;
		width: 74px;
		height: 73px;
		left: 46px;
	}
	.btn-scope-niv-3{
		bottom: 29px;
		width: 105px;
		height: 104px;
		left: 31px;
	}
	.btn-scope-niv-4{
		bottom: 15px;
		width: 136px;
		height: 135px;
		left: 16px;
	}
	
	.btn-scope-niv-5{
		bottom: 0px;
		width: 167px;
		height: 166px;
		left: 0px;
		border-radius: 50% 50% 50% 0%;
		background-color: rgb(177, 194, 204) !important;
	}
	/*.btn-scope-niv-5:hover{
		background-color: rgb(109, 120, 140) !important;
	}
	.btn-scope-niv-5.selected{
		background-color: rgb(109, 120, 140) !important;
	}*/


	.my-main-container{
		min-height:1000px;
	}

	.main-col-search{
		min-height:1000px;
	}

	#logo-main-menu:hover{
		box-shadow: -3px 0px 5px 1px rgba(66, 66, 66, 0.79) !important;
	}


@media screen and (min-width: 900px) and (max-width: 1120px) {
	.box-ajaxTools{
		width:95%;
		margin-left:5%;
	}
}

@media screen and (min-width: 767px) and (max-width: 900px) {
	.box-ajaxTools{
		width:88%;
		margin-left:12%;
	}
}

@media screen and (max-width: 767px) {
	.btn-scope{
		display: none;
		left:0px !important;
		width:40px !important;
		margin-bottom:40px !important;
		border-radius: 0px 40px 0px 0px !important;
		bottom:0px !important;
		position: fixed;
		z-index: 1;
		border: none;
		box-shadow: 0px 0px 3px 3px rgba(114, 114, 114, 0.1);
	} 
	.btn-scope-niv-2{
		height: 43px;
	}
	.btn-scope-niv-3{
		height: 83px;
	}
	.btn-scope-niv-4{
		height: 123px;
	}
	
	.btn-scope-niv-5{
		height: 163px;
	}

}
	
</style>
<button class="btn-scope btn-scope-niv-5 tooltips" level="5"
		data-toggle="tooltip" data-placement="top" title="Niveau 5 : Global" alt="Niveau 5 : Global" ></button>
<button class="bg-red btn-scope btn-scope-niv-4 tooltips" level="4"
		data-toggle="tooltip" data-placement="top" title="Niveau 4 : Région" alt="Niveau 4 : Région" ></button>
<button class="bg-red btn-scope btn-scope-niv-3 tooltips" level="3"
		data-toggle="tooltip" data-placement="top" title="Niveau 3 : Déparement" alt="Niveau 3 : Département" ></button>
<button class="bg-red btn-scope btn-scope-niv-2 tooltips" level="2"
		data-toggle="tooltip" data-placement="top" title="Niveau 2 : Code postal" alt="Niveau 2 : Code postal" ></button>

<button class="menu-button menu-button-title bg-red tooltips hidden-xs btn-param-postal-code btn-scope-niv-1"
		data-toggle="tooltip" data-placement="top" title="Niveau 1 :  Commune" alt="Niveau 1 : Commune" >
	<i class="fa fa-crosshairs"></i>
</button> 
<div id="input-communexion">
	<span class="search-loader text-red">Communexion : <span style='font-weight:300;'>un code postal et c'est parti !</span></span>
	<input id="searchBarPostalCode" class="input-search text-red" type="text" placeholder="un code postal ?">
</div>


<div class="col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-12 main-top-menu">
	
	<?php if(isset(Yii::app()->session['userId'])) { ?>
	<a href="javascript:loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>?isSearchDesign=1')" class="hidden-xs" >
		<img class="hidden-xs" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
	</a>
	<?php }else{ ?> 
	<a href="javascript:loadByHash('#default.home')" class="hidden-xs" >
		<img class="hidden-xs" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
	</a>
	<?php } ?>

	<?php 
		if(!isset($urlPhotoProfil)) $urlPhotoProfil = "";
	 	if(!isset($me)) $me = "";
	 	$this->renderPartial("menuSmall", array("me"=>$me,"urlPhotoProfil"=>$urlPhotoProfil)); 
	?> 
	
	<h1 class="homestead text-dark no-padding moduleLabel" id="main-title"
		style="font-size:22px;margin-bottom: 0px; margin-top: 15px; display: inline-block;">
		<i class="fa fa-connectdevelop"></i> <span id="main-title-menu">L'Annuaire</span> <span class="text-red">COMMUNE</span>CTÉ</h1>

	<?php $this->renderPartial("short_info_profil"); ?> 

	<button class="menu-button btn-menu btn-menu-top bg-azure tooltips" id="btn-toogle-map"
			data-toggle="tooltip" data-placement="right" title="Carte" alt="Carte">
			<i class="fa fa-map-marker"></i>
	</button>

</div>

<?php $this->renderPartial('menu', array("page" => "accueil", "inseeCommunexion" => $inseeCommunexion, "cityNameCommunexion" => $cityNameCommunexion)); ?>

<div class="col-md-12 col-sm-12 col-xs-12 no-padding no-margin my-main-container bgpixeltree">

	<div class="col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-12 main-col-search">
	</div>

	<div id="floopDrawerDirectory" class="floopDrawer"></div>

	<?php //if(!isset(Yii::app()->session['userId'])) 
			$this->renderPartial("login_register"); 
			?>

	
</div>

<?php  
	if(isset(Yii::app()->session['userId'])) {
		$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		$this->renderPartial($layoutPath.'notifications2');
	}
?>



<script type="text/javascript">
	

	var mapIconTop = {
	    "default" : "fa-arrow-circle-right",
	    "citoyen":"<?php echo Person::ICON ?>", 
	    "NGO":"<?php echo Organization::ICON ?>",
	    "LocalBusiness" :"<?php echo Organization::ICON_BIZ ?>",
	    "Group" : "<?php echo Organization::ICON_GROUP ?>",
	    "group" : "<?php echo Organization::ICON ?>",
	    "association" : "<?php echo Organization::ICON ?>",
	    "organization" : "<?php echo Organization::ICON ?>",
	    "GovernmentOrganization" : "<?php echo Organization::ICON_GOV ?>",
	    "event":"<?php echo Event::ICON ?>",
	    "project":"<?php echo Project::ICON ?>",
	    "city": "<?php echo City::ICON ?>"
	  };
	var mapColorIconTop = {
	    "default" : "dark",
	    "citoyen":"yellow", 
	    "NGO":"green",
	    "LocalBusiness" :"green",
	    "Group" : "green",
	    "group" : "green",
	    "association" : "green",
	    "organization" : "green",
	    "GovernmentOrganization" : "green",
	    "event":"orange",
	    "project":"purple",
	    "city": "red"
	  };


var typesLabels = {
  "<?php echo Organization::COLLECTION ?>":"Organization",
  "<?php echo Event::COLLECTION ?>":"Event",
  "<?php echo Project::COLLECTION ?>":"Project",
};


/* variables globales communexion */
var inseeCommunexion = "<?php echo $inseeCommunexion; ?>";
var cpCommunexion = "<?php echo $cpCommunexion; ?>";
var cityNameCommunexion = "<?php echo $cityNameCommunexion; ?>";
var regionNameCommunexion = "<?php echo $regionNameCommunexion; ?>";
var countryCommunexion = "<?php echo $countryCommunexion; ?>";
<?php if(@$nbCpByInsee && $nbCpByInsee > 1){ ?>
	nbCpbyInseeCommunexion = "<?php echo $nbCpByInsee; ?>";
	cityInseeCommunexion = "<?php echo $cityInsee; ?>";
<?php } ?>
var latCommunexion = 0;
var lngCommunexion = 0;

/* variables globales communexion */	
var myContacts = <?php echo ($myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
var userConnected = <?php echo isset($me) ? json_encode($me) : "null"; ?>;

var proverbs = <?php echo json_encode(random_pic()) ?>;  

var hideScrollTop = true;
var lastUrl = null;
var isMapEnd = <?php echo (isset( $_GET["map"])) ? "true" : "false" ?>;

//console.warn("isMapEnd 1",isMapEnd);
jQuery(document).ready(function() {

	
	<?php if(isset(Yii::app()->session['userId']) && //et que le two_step est terminé
			(!isset($me["two_steps_register"]) || $me["two_steps_register"] != true)){ ?>
		
		//if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";
		setCookies(location.pathname);
		
	<?php } ?>


  	if(inseeCommunexion != ""){
  		$(".btn-menu2, .btn-menu3, .btn-menu4 ").show(400);
  	}

  	$(".my-main-container").css("min-height", $(".sigModuleBg").height());
    $(".main-col-search").css("min-height", $(".sigModuleBg").height());

    $('#btn-toogle-map').click(function(e){ showMap();  	});
    $('.main-btn-toogle-map').click(function(e){ showMap(); });

    $("#mapCanvasBg").show();
    
    $(".my-main-container").scroll(function(){
    	//console.log("scrolling my-container");
    	checkScroll();
    });

    $(".btn-scope").click(function(){
    	var level = $(this).attr("level");
    	selectScopeLevelCommunexion(level);
    });
    $(".btn-scope").mouseenter(function(){
    	$(".btn-scope").removeClass("selected");
    });
    $(".btn-scope").mouseout(function(){
    	$(".btn-scope-niv-"+levelCommunexion).addClass("selected");
    });
    
    initNotifications();
	initFloopDrawer();
    
    $(window).resize(function(){
      resizeInterface();
    });

    resizeInterface();
    showFloopDrawer();

    if(cityNameCommunexion != ""){
		$('#searchBarPostalCode').val(cityNameCommunexion);
		$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
	}

	toogleCommunexion();

	//manages the back button state 
	//every url change (loadByHash) is pushed into history.pushState 
	//onclick back btn popstate is launched
	//
    $(window).bind("popstate", function(e) {
      //console.dir(e);
      console.log("history.state",$.isEmptyObject(history.state),location.hash);
      console.warn("popstate history.state",history.state);
      if( lastUrl && "onhashchange" in window && location.hash  ){
        if( $.isEmptyObject( history.state ) && allReadyLoad == false ){
	        //console.warn("poped state",location.hash);
	        //alert("popstate");
	        loadByHash(location.hash,true);
	    } 
	    allReadyLoad = false;
      }

      lastUrl = location.hash;
    });


	//console.log("start timeout MAIN MAP LOOOOOL");
	//$("#btn-toogle-map").hide();
	


    //console.log("hash", location.hash);
    //console.warn("isMapEnd 3",isMapEnd);
    console.log("userConnected");
	console.dir(userConnected);
	//si l'utilisateur doit passer par le two_step_register
	if(userConnected != null && typeof userConnected["two_steps_register"] != "undefined" && userConnected["two_steps_register"] == true){
		loadByHash("#default.twostepregister");
		return;
	} 
	else{ //si l'utilisateur est déjà passé par le two_step_register
 		if(location.hash != "#default.home" && location.hash != "#" && location.hash != ""){
			loadByHash(location.hash);
			return;
		}
		else{ 
			//console.log("userConnected", userConnected);
			if(userConnected != null && userId != null  && userId != "" && typeof userId != "undefined")
				loadByHash("#news.index.type.citoyens.id."+userId + "?isSearchDesign=1");
			else
				loadByHash("#default.home");
			//}

			//loadByHash("#default.home");
		}
	}
	checkScroll();
});

function startNewCommunexion(country){
	var locality = $('#searchBarPostalCode').val();
	locality = locality.replace(/[^\w\s-']/gi, '');

	$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");

	var data = {"name" : name, "locality" : locality, "country" : country, "searchType" : [ "cities" ], "searchBy" : "ALL"  };
    var countData = 0;
    var oneElement = null;
	console.log(data);
    $.blockUI({
		message : "<h1 class='homestead text-dark'><i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...</span></h1>"
	});

    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
            console.log("error");
          	console.dir(data);
            $(".search-loader").html("<i class='fa fa-ban'></i> Aucun résultat");
          },
          success: function(data){
          	console.log("success, try to load sig");
          	console.dir(data);
            if(!data){
              toastr.error(data.content);
            }else{


            $.each(data, function(i, v) {
	            if(v.length!=0){
	              $.each(v, function(k, o){ countData++; });
	            }
	        });

	        if(countData == 0){
	        	$(".search-loader").html("<i class='fa fa-ban'></i> Aucun résultat");
	        }else{
	        	$(".search-loader").html("<i class='fa fa-crosshairs'></i> Sélectionnez une commune ...");
	        	showMap(true);
	        	Sig.showMapElements(Sig.map, data);
	        	
	        }

	        $.unblockUI();

          }
          
      }
    });
}

function resizeInterface()
{
  //console.log("resize");
  var height = $("#mapCanvasBg").height() - 55;
  $("#ajaxSV").css({"minHeight" : height});
  //$("#menu-container").css({"minHeight" : height});
  var heightDif = $("#search-contact").height() + $("#floopHeader").height() + 77 /* top */ + 30 /* bottom */;
  //console.log("heightDif", heightDif);
  $(".floopScroll").css({"minHeight" : height-heightDif});
  $(".floopScroll").css({"maxHeight" : height-heightDif});
  $(".my-main-container").css("min-height", $(".sigModuleBg").height());
  $(".main-col-search").css("min-height", $(".sigModuleBg").height());
  //$("ul.notifList").css({"maxHeight" : height-heightDif});

}

function initNotifications(){
	
	$('.main-top-menu .btn-menu-notif').off().click(function(){
	  console.log("click notification main-top-menu");
      showNotif();
    });
    $('.my-main-container .btn-menu-notif').off().click(function(){
	  console.log("click notification my-main-container");
      showNotif();
    });
}
function showNotif(show){
	if(typeof show == "undefined"){
		if($("#notificationPanelSearch").css("display") == "none") show = true; 
    	else show = false;
    }

    if(show) $('#notificationPanelSearch').show("fast");
	else 	 $('#notificationPanelSearch').hide("fast");
}

function checkScroll(){
	// if(location.hash == "#default.home") {
	// 	$(".main-top-menu").animate({
 //         							top: -60,
 //         							opacity:0
	// 						      }, 500 );
	// 	return;
	// }

	//console.log("checkScroll" , $(".my-main-container").scrollTop() , hideScrollTop);
	// if($(".my-main-container").scrollTop() < 90 && hideScrollTop){
	// 	if($(".main-top-menu").css("opacity") == 1){
	// 		$(".main-top-menu").animate({
 //         							top: -60,
 //         							opacity:0
	// 						      }, 500 );
	// 	}
	// }else{
		//if($(".main-top-menu").css("opacity") == 0){
			$(".main-top-menu").animate({
         							top: 0,
         							opacity:1
							      }, 500 );
		//}
	//}
}

function showMap(show)
{

	//if(typeof Sig == "undefined") { alert("Pas de SIG"); return; } 
	console.log("typeof SIG : ", typeof Sig);
	if(typeof Sig == "undefined") show = false;

	console.log("showMap");
	console.warn("showMap");
	if(show === undefined) show = !isMapEnd;
	if(show){
		isMapEnd =true;
		showNotif(false);

		$("#mapLegende").html("");
		$("#mapLegende").hide();

		showTopMenu(true);
		if(Sig.currentMarkerPopupOpen != null){
			Sig.currentMarkerPopupOpen.fire('click');
		}
		
		$(".btn-group-map").show( 700 );
		$("#right_tool_map").show(700);
		$(".btn-menu5, .btn-menu-add").hide();
		$("#btn-toogle-map").html("<i class='fa fa-list'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Tableau de bord");
		$("#btn-toogle-map").css("display","inline !important");
		$("#btn-toogle-map").show();
		$(".my-main-container").animate({
     							top: -1000,
     							opacity:0,
						      }, 'slow' );

		setTimeout(function(){ $(".my-main-container").hide(); }, 1000);
		var timer = setTimeout("Sig.constructUI()", 1000);
		
	}else{
		isMapEnd =false;
		hideMapLegende();

		$(".btn-group-map").hide( 700 );
		$("#right_tool_map").hide(700);
		$(".btn-menu5, .btn-menu-add").show();
		$(".panel_map").hide(1);
		$("#btn-toogle-map").html("<i class='fa fa-map-marker'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Carte");
		$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
		$(".my-main-container").animate({
     							top: 0,
     							opacity:1
						      }, 'slow' );
		setTimeout(function(){ $(".my-main-container").show(); }, 100);

		if(typeof Sig != "undefined")
		if(Sig.currentMarkerPopupOpen != null){
			Sig.currentMarkerPopupOpen.closePopup();
		}

		if($(".box-add").css("display") == "none" && <?php echo isset(Yii::app()->session['userId']) ? "true" : "false"; ?>)
			$("#ajaxSV").show( 700 );

		showTopMenu(true);	
		checkScroll();
	}
		
}


function setScopeValue(btn){
	if( typeof btn === "object" ){
		//récupère les valeurs
		inseeCommunexion = btn.attr("insee-com");
		cityNameCommunexion = btn.attr("name-com");
		cpCommunexion = btn.attr("cp-com");
		regionNameCommunexion = btn.attr("reg-com");
		countryCommunexion = btn.attr("ctry-com");
		latCommunexion = btn.attr("lat-com");
		lngCommunexion = btn.attr("lng-com");
		if(typeof(btn.attr("nbCpByInsee-com")) != "undefined"){
			nbCpbyInseeCommunexion = btn.attr("nbCpByInsee-com");
			cityInseeCommunexion = btn.attr("cityInsee-com");
		} else {
			nbCpbyInseeCommunexion = undefined;
			cityInseeCommunexion = undefined;

		}
		//var path = location.pathname;
		setCookies();
		//definit le path du cookie selon si on est en local, ou en prod
		

		
		<?php if(!isset(Yii::app()->session['userId'])){ ?>
		
			setCookies(location.pathname);
			
			//$(".btn-param-postal-code").attr("data-original-title", cityNameCommunexion + " en détail");
			//$(".btn-param-postal-code").attr("onclick", "loadByHash('#city.detail.insee."+inseeCommunexion+"')");
			$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
			$(".btn-geoloc-auto .lbl-btn-menu-name-city").html("<span class='lbl-btn-menu-name'>" + cityNameCommunexion + ", </span>" + cpCommunexion);
			//$(".btn-geoloc-auto").off().click(function(){ loadByHash("#city.detail.insee." + inseeCommunexion) });

				
		<?php } ?>

		if(location.hash.indexOf("#default.twostepregister") == -1)
		$("#searchBarPostalCode").val(cityNameCommunexion);

		selectScopeLevelCommunexion(levelCommunexion);

  		$(".btn-menu2, .btn-menu3, .btn-menu4 ").show(400);
	
		Sig.clearMap();
		console.log("hash city ? ", location.hash.indexOf("#default.city"));
		if(location.hash == "#default.home"){
			showLocalActorsCityCommunexion();
		}else
		if(location.hash == "#default.directory"){
			startSearch();
		}else
		if(location.hash == "#default.agenda"){
			startSearch();
		}else
		if(location.hash == "#default.news"){
			//startSearch();
			showMap(false);
		}else
		if(location.hash.indexOf("#city.detail") >= 0) {
			showLocalActorsCityCommunexion();
			$("#btn-communecter").html("<i class='fa fa-check'></i> COMMUNECTÉ");
    		$("#btn-communecter").attr("onclick", "");
			//showMap(false);
		}else
		if(location.hash.indexOf("#default.twostepregister") >= 0) {
			
			showMap(false);
			$("#tsr-commune-name-cp").html(cityNameCommunexion + ", " + cpCommunexion);

			$("#conf-commune").html(cityNameCommunexion + ", " + cpCommunexion);

			$("#TSR-load-conf-communexion").html("<h1><i class='fa fa-spin fa-circle-o-notch text-white'></i></h1>");
			showTwoStep("load-conf-communexion");
			setCookies();
			$(".btn-param-postal-code").attr("data-original-title", cityNameCommunexion + " en détail");
			//$(".btn-param-postal-code").attr("onclick", "loadByHash('#city.detail.insee."+inseeCommunexion+"')");
			$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
			$(".lbl-btn-menu-name-city").html('<span class="lbl-btn-menu-name">'+cityNameCommunexion + ", </span>" + cpCommunexion);
			setTimeout(function(){ showTwoStep("street");  }, 2000);
			//showMap(false);
		}else{
			if(inseeCommunexion != ""){
				showLocalActorsCityCommunexion();
				//toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
				//$("#cityDetail #btn-communecter").html("<i class='fa fa-check'></i> Communecté");
				//showMap(false);
			}
		}
	}
	
  	console.log("setScopeValue", inseeCommunexion, cityNameCommunexion, cpCommunexion);
}

function showLocalActorsCityCommunexion(){
	console.log("showLocalActorsCityCommunexion");
	var data = { "name" : "", 
 			 "locality" : inseeCommunexion,
 			 "searchType" : [ "persons", "organizations", "projects", "events", "cities" ], 
 			 "searchBy" : "INSEE",
    		 "indexMin" : 0, 
    		 "indexMax" : 500  
    		};

    $(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
	
	$.blockUI({
		message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> " + cpCommunexion + " : Commune<span class='text-dark'>xion en cours ...</span></h1>"
	});

	showMap(true);
	
	$.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error"); console.dir(data);          
          },
          success: function(data){
            if(!data){ toastr.error(data.content); }
            else{
            	//console.dir(data);
            	Sig.showMapElements(Sig.map, data);
            	$(".moduleLabel").html("<i class='fa fa-connect-develop'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
				$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
				
				toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
				$.unblockUI();
            }
          }
 	});

	}


var topMenuActivated = true;
function showTopMenu(show){ 

	if(typeof show == "undefined") 
		show = $("#main-top-menu").css("opacity") == 1;
	
	if(show){
		$(".main-top-menu").animate({ top: 0, opacity:1 }, 500 );
	}
	else{
		$(".main-top-menu").animate({ top: -60, opacity:0 }, 500 );
	}
}


function initFloopDrawer(){
	console.log("initFloopDrawer");
	//console.dir(myContacts);
	if(myContacts != null){
      var floopDrawerHtml = buildListContactHtml(myContacts, userId);
      $("#floopDrawerDirectory").html(floopDrawerHtml);
      initFloopScrollByType();

      //$("#floopDrawerDirectory").hide();
      if($(".tooltips").length) {
        $('.tooltips').tooltip();
      }
      $("#btnFloopClose").click(function(){
      	showFloopDrawer(false);
      });
      $(".main-col-search").mouseenter(function(){
      	showFloopDrawer(false);
      });

      bindEventFloopDrawer();
    }
}

// function initBtnScopeList(){
// 	$(".btn-scope-list").click(function(){
// 		setInputPlaceValue(this);
// 	});
// }

function setInputPlaceValue(thisBtn){
	//if(location.hash == "#default.home"){
		//$("#autoGeoPostalCode").val($(thisBtn).attr("val"));
	//}else{
		$("#searchBarPostalCode").val($(thisBtn).attr("val"));
		
		console.log("setInputPlaceValue")
		$("#input-communexion").show();
		//$("#searchBarPostalCode").animate({"width" : "350px !important", "padding-left" : "70px !important;"}, 200);
		setTimeout(function(){ $("#input-communexion").hide(300); }, 300);
	  	
	//}
	//$.cookie("HTML5CityName", 	 $(thisBtn).attr("val"), 	   { path : '/ph/' });
	startNewCommunexion();
}

var communexionActivated = false;
function toogleCommunexion(init){ //this = jQuery Element
  
  if(init != true)
  communexionActivated = !communexionActivated;
	
  console.log("communexionActivated", communexionActivated);
  if(communexionActivated){
    //btn.removeClass("text-red");
    //btn.addClass("bg-red");
    $(".btn-activate-communexion, .btn-param-postal-code").removeClass("text-red");
    $(".btn-activate-communexion, .btn-param-postal-code").addClass("bg-red");
    $("#searchBarPostalCode").val(cityNameCommunexion);

    if(inseeCommunexion != "")
    $(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
				
   // $("#searchBarPostalCode").animate({"width" : "0px !important", "padding-left" : "51px !important;"}, 200);
    //$(".lbl-scope-list").html("<i class='fa fa-check'></i> " + cityNameCommunexion.toLowerCase() + ", " + cpCommunexion);
    selectScopeLevelCommunexion(levelCommunexion);
    $(".lbl-scope-list").show(400);
    console.log("inseeCommunexion", inseeCommunexion);
    //setScopeValue(inseeCommunexion);
    //showInputCommunexion();
  }else{
    $(".btn-activate-communexion, .btn-param-postal-code").addClass("text-red");
    $(".btn-activate-communexion, .btn-param-postal-code").removeClass("bg-red");
    //$("#searchBarPostalCode").animate({"width" : "350px !important", "padding-left" : "70px !important;"}, 200);
    
    $(".search-loader").html("<i class='fa fa-times'></i> Communection désactivée (" + cityNameCommunexion + ', ' + cpCommunexion + ")");
				
    $(".lbl-scope-list").hide(400);
    $("#searchBarPostalCode").val("");
  }
}

function initBtnToogleCommunexion(){
	toogleCommunexion(true);
}

function showInputCommunexion(){
	clearTimeout(timeoutCommunexion);
	console.log("showCommunexion");
	$("#searchBarPostalCode").css({"width" : "0px !important", "padding-left" : "51px !important;"}, 200);

	if(communexionActivated)
	$("#searchBarPostalCode").animate({"width" : "350px !important", "padding-left" : "70px !important;"}, 200 );
	
	$("#input-communexion").show(300);
	$(".main-col-search").animate({ opacity:0.3 }, 200 );
	$(".hover-info").hide();
}

//niv 1 : city
//niv 2 : CP
//niv 3 : department
//niv 4 : region
//niv 4 : pays / global / tout
var levelCommunexion = 1;
function selectScopeLevelCommunexion(level){

	var department = "";
	console.log("selectScopeLevelCommunexion", countryCommunexion, $.inArray(countryCommunexion, ["RE", "NC","GP","GF","MQ","YT","PM"]));

	if($.inArray(countryCommunexion, ["RE", "NC","GP","GF","MQ","YT","PM"]) >= 0){
		department = cpCommunexion.substr(0, 3);
	}else{
		department = cpCommunexion.substr(0, 2);
	}

	var change = (level != levelCommunexion);

	$(".btn-scope").removeClass("selected");
	$(".btn-scope-niv-"+level).addClass("selected");
	levelCommunexion = level;

	if(level == 1) endMsg = "à " + cityNameCommunexion + ", " + cpCommunexion;
	if(level == 2) {
		if(typeof(cityInseeCommunexion)!="undefined")
			endMsg = "à la ville de " + cityInseeCommunexion;
		else
			endMsg = "au code postal " + cpCommunexion;
	}
	if(level == 3) endMsg = "au département " + department;
	if(level == 4) endMsg = "à votre région " + regionNameCommunexion;
	if(level == 5) endMsg = "à l'ensemble du réseau";

	if(change){
		toastr.success('Les données sont maintenant filtrées par rapport ' + endMsg);
		$('.search-loader').html("<i class='fa fa-check'></i> Vous êtes connecté " + endMsg)
	}

	
	if(level == 1) endMsg = cityNameCommunexion + ", " + cpCommunexion;
	if(level == 2){ 
		if(typeof(cityInseeCommunexion)!="undefined")
			endMsg = cityInseeCommunexion;
		else
			endMsg = cpCommunexion;
	}
	if(level == 3) endMsg = "Département " + department;
	if(level == 4) endMsg = "Votre région " + regionNameCommunexion;
	if(level == 5) endMsg = "Tout le réseau";
	
	if(!communexionActivated)
    toogleCommunexion();

	$(".lbl-scope-list").html("<i class='fa fa-check'></i> " + endMsg);

	$(".btn-scope-niv-5").attr("data-original-title", "Niveau 5 - Tout le réseau");
	$(".btn-scope-niv-4").attr("data-original-title", "Niveau 4 - Région " + regionNameCommunexion);
	$(".btn-scope-niv-3").attr("data-original-title", "Niveau 3 - Département " + department);
	if(typeof(cityInseeCommunexion)!="undefined"){
		$(".btn-scope-niv-2").attr("data-original-title", "Niveau 2 - Ville entière : " + cityInseeCommunexion);
	}
	else{
		$(".btn-scope-niv-2").attr("data-original-title", "Niveau 2 - Code postal : " + cpCommunexion);
	}
	$(".btn-scope-niv-1").attr("data-original-title", "Niveau 1 - " + cityNameCommunexion + ", " + cpCommunexion);
	$('.tooltips').tooltip();

	if(typeof startSearch == "function")
	startSearch();
}
function setCookies(path){
	$.cookie('inseeCommunexion',   	inseeCommunexion,  	{ expires: 365, path: path });
	$.cookie('cityNameCommunexion', cityNameCommunexion,{ expires: 365, path: path });
	$.cookie('cpCommunexion',   	cpCommunexion,  	{ expires: 365, path: path });		
	$.cookie('regionNameCommunexion',   regionNameCommunexion,  { expires: 365, path: path });
	$.cookie('countryCommunexion',   	countryCommunexion,  	{ expires: 365, path: path });
	if(typeof(nbCpbyInseeCommunexion) != "undefined"){
		$.cookie('nbCpbyInseeCommunexion',   	nbCpbyInseeCommunexion,  	{ expires: 365, path: path });
		$.cookie('cityInseeCommunexion',   	cityInseeCommunexion,  	{ expires: 365, path: path });
	}
}
</script>





