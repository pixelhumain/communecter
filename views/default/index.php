<?php 
	$cs = Yii::app()->getClientScript();

	$cssAnsScriptFilesModule = array(
		'/assets/plugins/jquery-validation/dist/jquery.validate.min.js',
		'/assets/plugins/jquery-validation/localization/messages_fr.js',
		'/assets/plugins/lightbox2/css/lightbox.css',
		'/assets/plugins/lightbox2/js/lightbox.min.js',
		'/assets/plugins/jquery-validation/dist/jquery.validate.min.js',
		'/assets/plugins/select2/select2.min.js',

		'/assets/css/search.css',
		'/assets/css/floopDrawerRight.css',
		'/assets/css/sig/sig.css',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule);

	$cssAnsScriptFilesModule = array(
		'/js/default/index.js',
		'/js/dataHelpers.js',
		'/js/sig/localisationHtml5.js',
		'/js/floopDrawerRight.js',
		'/js/sig/geoloc.js',
		'/js/default/formInMap.js',
		'/js/default/globalsearch.js',
		'/js/sig/findAddressGeoPos.js',
		'/js/jquery.filter_input.js',
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
		   			    			  Yii::app()->request->cookies['inseeCommunexion']->value : "";
		
		$cpCommunexion 		 = isset( Yii::app()->request->cookies['cpCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['cpCommunexion']->value : "";
		
		$cityNameCommunexion = isset( Yii::app()->request->cookies['cityNameCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['cityNameCommunexion']->value : "";

		$regionNameCommunexion = isset( Yii::app()->request->cookies['regionNameCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['regionNameCommunexion']->value : "";

		$countryCommunexion = isset( Yii::app()->request->cookies['countryCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['countryCommunexion']->value : "";
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
		
		$regionNameCommunexion = ""; /*not important now => multilevel is dead*/

		$countryCommunexion = isset( $me['address']['addressCountry'] ) ? 
		   			    			 $me['address']['addressCountry'] : "";	
	}

	if (@$inseeCommunexion){
		if(@$cpCommunexion){
			$city=City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);	
		}else{
			$city=SIG::getCityByCodeInsee($inseeCommunexion);
		}

		if(@$me)
		$regionNameCommunexion = @$city['regionName'] ? 
			   			    	 $city['regionName'] : "";

		$nbCpByInsee=count(@$city["postalCodes"]);
		if($nbCpByInsee > 1){
			$cityInsee=$city["name"];
		}
	}else{
		$city = null;
	}

?>


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

   // error_log("load IndexDefault");
?>

<?php $this->renderPartial('./menu/menuCommunexion'); ?>

<?php if(!isset($me)) $me=""; 
	  $this->renderPartial('./menu/menuTop', array("me" => $me)); ?>

<?php $this->renderPartial('./menu/menuLeft', array("page" => "accueil", 
												    "myCity" => $city)); ?>


<div class="col-xs-12 no-padding no-margin my-main-container">

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
	    "organizations" : "<?php echo Organization::ICON ?>",
	    "GovernmentOrganization" : "<?php echo Organization::ICON_GOV ?>",
	    "event":"<?php echo Event::ICON ?>",
	    "project":"<?php echo Project::ICON ?>",
	    "projects":"<?php echo Project::ICON ?>",
	    "city": "<?php echo City::ICON ?>",
	    "entry": "fa-gavel",
	    "action": "fa-cogs",
	    "actions": "fa-cogs"
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
	    "organizations" : "green",
	    "GovernmentOrganization" : "green",
	    "event":"orange",
	    "project":"purple",
	    "projects":"purple",
	    "city": "red",
	    "entry": "azure",
	    "action": "lightblue2",
	    "actions": "lightblue2"
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

//used in communecter.js dynforms
var tagsList = <?php echo json_encode(Tags::getActiveTags()) ?>;
var eventTypes = <?php echo json_encode( Event::$types ) ?>;
var organizationTypes = <?php echo json_encode( Organization::$types ) ?>;
var currentUser = <?php echo isset($me) ? json_encode(Yii::app()->session["user"]) : null?>;
var rawOrganizerList = <?php echo json_encode(Authorisation::listUserOrganizationAdmin(Yii::app() ->session["userId"])) ?>;
var organizerList = {};
var poiTypes = <?php echo json_encode( Poi::$types ) ?>;

//console.warn("isMapEnd 1",isMapEnd);
jQuery(document).ready(function() {

	if(currentUser)
		organizerList["currentUser"] = currentUser.name + " (You)";

	$.each(rawOrganizerList, function(optKey, optVal) {
		organizerList[optKey] = optVal.name;
	});
	
	<?php if(isset(Yii::app()->session['userId']) && //et que le two_step est terminé
			(!isset($me["two_steps_register"]) || $me["two_steps_register"] != true)){ ?>
		
		//if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";
		setCookies(location.pathname);
		
	<?php } ?>


  	if(inseeCommunexion != "" && cpCommunexion != ""){
  		$(".btn-menu2, .btn-menu3, .btn-menu4, .btn-menu9 ").show(400);
  	}
  	
  	$('#btn-toogle-map').click(function(e){ showMap();  	});
    $('.main-btn-toogle-map').click(function(e){ showMap(); });

    $("#mapCanvasBg").show();

    $(".my-main-container").bind("scroll", function(){
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

	if(userConnected != null && userConnected != "" && typeof userConnected != "undefined" && !location.hash){
		loadByHash("#person.detail.id."+userId);
		return;
	} 
	else{ //si l'utilisateur est déjà passé par le two_step_register
 		if(/*location.hash != "#default.live" &&*/ location.hash != "#" && location.hash != ""){
			loadByHash(location.hash);
			return;
		}
		else{ 
			//console.log("userConnected", userConnected);
			if(userConnected != null && userId != null  && userId != "" && typeof userId != "undefined")
				loadByHash("#default.live");//news.index.type.citoyens.id."+userId);
			else
				loadByHash("#default.live");
			//}

			//loadByHash("#default.home");
		}
	}
	checkScroll();
});

</script>





