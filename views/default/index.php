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
		'/js/jquery.filter_input.js',
		'/css/search.css',
		'/css/floopDrawerRight.css',
		'/css/sig/sig.css',
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
		
		if(isset($inseeCommunexion) && isset($cpCommunexion)){
			$city=City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);	
			$regionNameCommunexion = isset( $city['regionName'] ) ? 
			   			    			    $city['regionName'] : "";
		}

		$countryCommunexion = isset( $me['address']['addressCountry'] ) ? 
		   			    			  $me['address']['addressCountry'] : "";
		
		if (@$inseeCommunexion){
			$city=SIG::getCityByCodeInsee($inseeCommunexion);
			$nbCpByInsee=count($city["postalCodes"]);
			if($nbCpByInsee > 1){
				$cityInsee=$city["name"];
			}
		}
		
	}

?>
<style>
	.footer-menu-left{
		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/footer_menu_left.png");
	}
</style>

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

    error_log("load IndexDefault");
?>

<?php $this->renderPartial('./menu/menuCommunexion'); ?>

<?php if(!isset($me)) $me=""; 
	  $this->renderPartial('./menu/menuTop', array("me" => $me)); ?>

<?php $this->renderPartial('./menu/menuLeft', array("page" => "accueil", 
												 "inseeCommunexion" => $inseeCommunexion, 
												 "cityNameCommunexion" => $cityNameCommunexion)); ?>


<div class="col-md-12 col-sm-12 col-xs-12 no-padding no-margin my-main-container">

	<div class="footer-menu-left"></div>

	<div class="col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2 col-xs-12 main-col-search">
	</div>

	<div id="floopDrawerDirectory" class="floopDrawer"></div>

	<?php $this->renderPartial("login_register"); ?>

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


  	if(inseeCommunexion != "" && cpCommunexion != ""){
  		$(".btn-menu2, .btn-menu3, .btn-menu4, .btn-menu9 ").show(400);
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
				loadByHash("#news.index.type.citoyens.id."+userId);
			else
				loadByHash("#default.home");
			//}

			//loadByHash("#default.home");
		}
	}
	checkScroll();
});

function startNewCommunexion(country){ 

	clearTimeout(timeoutSearch);

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
  var heightDif = $("#search-contact").height() + $("#floopHeader").height() + 60 /* top */ + 0 /* bottom */;
  //console.log("heightDif", heightDif);
  $(".floopScroll").css({"minHeight" : height-heightDif});
  $(".floopScroll").css({"maxHeight" : height-heightDif});
  $(".my-main-container").css("min-height", $(".sigModuleBg").height());
  $(".my-main-container").css("max-height", $(".sigModuleBg").height());
   $(".my-main-container").css("height", $(".sigModuleBg").height());
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
		$(".btn-menu5, .btn-menu6, .btn-menu7, .btn-menu8, .btn-menu9, .btn-menu10, .btn-menu-add").hide();
		$("#btn-toogle-map").html("<i class='fa fa-list'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Tableau de bord");
		$("#btn-toogle-map").css("display","inline !important");
		$("#btn-toogle-map").show();
		//$(".lbl-btn-menu").hide(400);
		//$(".fa-angle-right").hide(400);
		//$(".menu-left-container hr").css({opacity:0});
		$(".main-menu-left").addClass("inSig");
		$("body").addClass("inSig");

		$(".my-main-container").animate({
     							top: -1000,
     							opacity:0,
						      }, 'slow' );

		setTimeout(function(){ $(".my-main-container").hide(); }, 100);
		var timer = setTimeout("Sig.constructUI()", 1000);
		
	}else{
		isMapEnd =false;
		hideMapLegende();

		$(".btn-group-map").hide( 700 );
		$("#right_tool_map").hide(700);
		$(".btn-menu5, .btn-menu6, .btn-menu7, .btn-menu8, .btn-menu9, .btn-menu10, .btn-menu-add").show();
		$(".panel_map").hide(1);
		$("#btn-toogle-map").html("<i class='fa fa-map-marker'></i>");
		$("#btn-toogle-map").attr("data-original-title", "Carte");
		$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
		//$(".lbl-btn-menu").show(400);
		//$(".fa-angle-right").show(400);		
		//$(".menu-left-container hr").css({opacity:1} );
		$(".main-menu-left").removeClass("inSig");
		$("body").removeClass("inSig");
		$(".my-main-container").animate({
     							top: 50,
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


function setScopeValue(btn){ console.log("setScopeValue");
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
		
		setCookies(location.pathname);
		
		$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté à " + cityNameCommunexion + ', ' + cpCommunexion);
		$(".lbl-btn-menu-name-city .lbl-btn-menu").html(cityNameCommunexion);// + ", " + cpCommunexion);
		
		$("#btn-geoloc-auto-menu .fa-crosshairs").attr("data-original-title", cityNameCommunexion);
		$("#btn-geoloc-auto-menu .fa-crosshairs").attr("title", cityNameCommunexion);
		$("#btn-geoloc-auto-menu").off();//.click(function(){ loadByHash("#city.detail.insee." + inseeCommunexion+"."+"postalCode."+cpCommunexion) });
		$("#btn-geoloc-auto-menu").attr("href", 'javascript:loadByHash("#city.detail.insee.' + inseeCommunexion+'.'+'postalCode.'+cpCommunexion + '")');
		$("#btn-geoloc-auto-menu").data("hash", "#city.detail.insee." + inseeCommunexion+"."+"postalCode."+cpCommunexion);
		console.log("HASHHHHHHHHHHHHHHHHHHHH", $("#btn-geoloc-auto-menu").data("hash"));
		$("#btn-menuSmall-mycity").attr("href", 'javascript:loadByHash("#city.detail.insee.' + inseeCommunexion+"."+"postalCode."+cpCommunexion + '")');
				
		$("#btn-citizen-council-commun").attr("href", 'javascript:loadByHash("#rooms.index.type.cities.id.' + countryCommunexion+'_' + inseeCommunexion+'-'+cpCommunexion+'")');

		$("#btn-citizen-council-commun").data("hash", "#rooms.index.type.cities.id." + countryCommunexion+"_" + inseeCommunexion+"-"+cpCommunexion);
				
		$("#btn-menuSmall-citizenCouncil").attr("href", 'javascript:loadByHash("#rooms.index.type.cities.id.' + countryCommunexion+'_' + inseeCommunexion+'-'+cpCommunexion+'")');
				
		
		if(location.hash.indexOf("#default.twostepregister") == -1)
		$("#searchBarPostalCode").val(cityNameCommunexion);

		selectScopeLevelCommunexion(levelCommunexion);

  		$(".menu-left-container .visible-communected, .menuSmall .visible-communected").show(400);
  		$(".menu-left-container .hide-communected, .menuSmall .hide-communected").hide(400);
  		
  		if(!userId)
  		$(".btn-geoloc-auto").attr("onclick", 
  			"loadByHash('#rooms.index.type.cities.id.' + countryCommunexion + '_'+ inseeCommunexion + '-'+ cpCommunexion)");

  		//loadByHash('#rooms.index.type.cities.id.<?php if(isset($myCity)) echo $myCity['country']."_".$myCity['insee']."-".$myCity['cp']; ?>'
	
		Sig.clearMap();
		console.log("hash city ? ", location.hash.indexOf("#default.city"));
		if(location.hash == "#default.home"){
			//showLocalActorsCityCommunexion();
			loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
		}else
		if(location.hash == "#default.directory"){
			startSearch();
		}else
		if(location.hash == "#default.agenda"){
			startSearch();
		}else
		if(location.hash == "#default.news"){
			startSearch();
			showMap(false);
		}else
		if(location.hash.indexOf("#city.detail") >= 0) {
			//showLocalActorsCityCommunexion();
			if(location.hash != "#city.detail.insee." + inseeCommunexion+"."+"postalCode."+cpCommunexion){
				loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
			}else{
				$("#btn-communecter").html("<i class='fa fa-check'></i> COMMUNECTÉ");
	    		$("#btn-communecter").attr("onclick", "");
	    		toastr.success('Vous êtes communecté à ' + cityNameCommunexion);
    		}
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
			$(".lbl-btn-menu-name-city .lbl-btn-menu").html(cityNameCommunexion);
			setTimeout(function(){ showTwoStep("street");  }, 2000);
			//showMap(false);
		}else{
			//showLocalActorsCityCommunexion();
			loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
		}
	}
	
  	console.log("setScopeValue", inseeCommunexion, cityNameCommunexion, cpCommunexion);
}

function showLocalActorsCityCommunexion(){

	loadByHash("#city.detail.insee."+inseeCommunexion+".postalCode."+cpCommunexion);
	return;

	console.log("showLocalActorsCityCommunexion");
	var data = { "name" : "", 
 			 "locality" : inseeCommunexion,
 			 "searchType" : [ "persons", "organizations", "projects", "events", "cities" ], 
 			 "searchBy" : "INSEE",
    		 "indexMin" : 0, 
    		 "indexMax" : 500  
    		};

	setTitle("Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>","spin fa-circle-o-notch","Les acteurs locaux : " + cityNameCommunexion + ", " + cpCommunexion);

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
				setTitle("Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>","connect-develop","Les acteurs locaux : " + cityNameCommunexion + ", " + cpCommunexion );
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
	//$(".main-col-search").animate({ opacity:0.3 }, 200 );
	$(".hover-info").hide();
}

//niv 1 : city
//niv 2 : CP
//niv 3 : department
//niv 4 : region
//niv 4 : pays / global / tout
var levelCommunexion = 1;
function selectScopeLevelCommunexion(level){

	//var department = "";
	var department = inseeCommunexion;
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
	//if(level == 3) endMsg = "au département ";
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
	//if(level == 3) endMsg = "Département " + department;
	if(level == 3) endMsg = "Département " + department;
	if(level == 4) endMsg = "Votre région " + regionNameCommunexion;
	if(level == 5) endMsg = "Tout le réseau";
	
	if(!communexionActivated)
    toogleCommunexion();

	$(".lbl-scope-list").html("<i class='fa fa-check'></i> " + endMsg);

	$(".btn-scope-niv-5").attr("data-original-title", "Niveau 5 - Tout le réseau");
	$(".btn-scope-niv-4").attr("data-original-title", "Niveau 4 - Région " + regionNameCommunexion);
	$(".btn-scope-niv-3").attr("data-original-title", "Niveau 3 - Département " + department);
	//$(".btn-scope-niv-3").attr("data-original-title", "Niveau 3 - Département ");
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





