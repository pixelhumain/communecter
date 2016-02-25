<?php 
	$cs = Yii::app()->getClientScript();

	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
	$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
	//$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/flexSlider/js/jquery.flexSlider-min.js' , CClientScript::POS_END);

	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/communecter.js' , CClientScript::POS_END);
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


		if(isset($me['profilImageUrl']) && $me['profilImageUrl'] != "")
          $urlPhotoProfil = Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$me['profilImageUrl']);
        else
          $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	}

?>

<?php 
		$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		$this->renderPartial($layoutPath.'mainMap');
?>

<?php //get all my link to put in floopDrawer
	if(isset(Yii::app()->session['userId'])){
      $myContacts = Person::getPersonLinksByPersonId(Yii::app()->session['userId']);
      $myFormContact = $myContacts; 
      $getType = (isset($_GET["type"]) && $_GET["type"] != "citoyens") ? $_GET["type"] : "citoyens";
    }else{
      $myFormContact = null;

    }
?>

<?php 
	$actionBtnMyCity = "";
	if($inseeCommunexion != ""){
		$actionBtnMyCity = "loadByHash('#city.detail.insee.".$inseeCommunexion."');";
	}
?>
<button class="menu-button menu-button-title bg-red tooltips hidden-xs btn-param-postal-code" onclick="<?php echo $actionBtnMyCity; ?>"
		<?php if($actionBtnMyCity != ""){ ?>data-toggle="tooltip" data-placement="bottom" title="<?php echo $cityNameCommunexion; ?> en détails" alt="<?php echo $cityNameCommunexion; ?> en détails" <?php } ?> >
	<i class="fa fa-university"></i>
</button> 
<div id="input-communexion">
	<span class="search-loader text-red">Communection : <span style='font-weight:300;'>un code postal et c'est parti !</span></span>
	<input id="searchBarPostalCode" class="input-search text-red" type="text" placeholder="un code postal ?">
</div>
<?php //} ?>



<div class="col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-12 main-top-menu">
	
	<a href="javascript:loadByHash('#default.home')" class="hidden-xs" ><img  class="hidden-xs" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/></a>
	<?php $this->renderPartial("menuSmall"); ?> 
	
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

	<?php if(!isset(Yii::app()->session['userId'])) $this->renderPartial("login_register"); ?>

	
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
	/* variables globales communexion */
	
	var myContacts = <?php echo ($myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
	var myId = "<?php echo isset( Yii::app()->session['userId']) ? Yii::app()->session['userId'] : "" ?>"; 

var myContacts = <?php echo ($myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
var myId = "<?php echo isset( Yii::app()->session['userId']) ? Yii::app()->session['userId'] : "" ?>"; 

var proverbs = <?php echo json_encode(random_pic()) ?>;  

var isNotSV = true;
var hideScrollTop = true;
var lastUrl = null;
var isMapEnd = <?php echo (isset( $_GET["map"])) ? "true" : "false" ?>;
console.warn("isMapEnd 1",isMapEnd);
	jQuery(document).ready(function() {

		
		<?php if(isset(Yii::app()->session['userId'])){ ?>
			var path = "/";
			if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";

			$.cookie('inseeCommunexion',   	inseeCommunexion,  	{ expires: 365, path: path });
			$.cookie('cityNameCommunexion', cityNameCommunexion,{ expires: 365, path: path });
			$.cookie('cpCommunexion',   	cpCommunexion,  	{ expires: 365, path: path });
			
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
	    
	    initNotifications();
		initFloopDrawer();
	    
	    $(window).resize(function(){
	      resizeInterface();
	    });

	    resizeInterface();
	    showFloopDrawer();

	    if(cityNameCommunexion != ""){
			$('#searchBarPostalCode').val(cityNameCommunexion);
			$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
		}

		toogleCommunexion();

		//manages the back button state 
		//every url change (loadByHash) is pushed into history.pushState 
		//onclick back btn popstate is launched
		//
	    $(window).bind("popstate", function(e) {
	      //console.dir(e.originalEvent);
	      //console.log("history.state",$.isEmptyObject(history.state),history.state);
	      if( lastUrl && "onhashchange" in window && location.hash  ){
	        if( $.isEmptyObject( history.state ) ){
		        //console.warn("poped state",location.hash);
		        loadByHash(location.hash,true);
		    } /*else { //pas necessaire de stocké le navigateur le fait tout seul
		      	history.pushState( { "hash" :location.hash} , null, location.hash ); //changes the history.state
	    		console.warn("pushState",location.hash);
		    }*/
	      }
	      lastUrl = location.hash;
	    });
	    //console.log("hash", location.hash);
	    console.warn("isMapEnd 3",isMapEnd);
	    if(location.hash != "#default.home" && location.hash != "#" && location.hash != ""){
			loadByHash(location.hash);
			return;
		}
		else{ 
			loadByHash("#default.home");
		}

		checkScroll();
	});

	function startNewCommunexion(){
		var locality = $('#searchBarPostalCode').val();
		locality = locality.replace(/[^\w\s']/gi, '');

		$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");

		var data = {"name" : name, "locality" : locality, "searchType" : [ "cities" ], "searchBy" : "ALL"  };
	    var countData = 0;
	    var oneElement = null;
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
		console.log("showMap");
		console.warn("showMap");
		if(show === undefined) show = !isMapEnd;
		if(show){
			isMapEnd =true;
			showNotif(false);
			showTopMenu(true);
			if(Sig.currentMarkerPopupOpen != null){
				Sig.currentMarkerPopupOpen.fire('click');
			}
			
			$(".btn-group-map").show( 700 );
			$("#right_tool_map").show(700);
			$(".btn-menu5, .btn-menu-add").hide();
			$("#btn-toogle-map").html("<i class='fa fa-list'></i>");
			$("#btn-toogle-map").attr("data-original-title", "Tableau de bord");
			$(".my-main-container").animate({
         							top: -1000,
         							opacity:0,
							      }, 'slow' );

			setTimeout(function(){ $(".my-main-container").hide(); }, 1000);
			var timer = setTimeout("Sig.constructUI()", 1000);
			
		}else{
			isMapEnd =false;
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

			//definit le path du cookie selon si on est en local, ou en prod
			var path = "/";
			if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";

			
			<?php if(!isset(Yii::app()->session['userId'])){ ?>
			
				$.cookie('inseeCommunexion',   	inseeCommunexion,  	{ expires: 365, path: path });
				$.cookie('cityNameCommunexion', cityNameCommunexion,{ expires: 365, path: path });
				$.cookie('cpCommunexion',   	cpCommunexion,  	{ expires: 365, path: path });
				
				$(".btn-param-postal-code").attr("data-original-title", cityNameCommunexion + " en détail");
				$(".btn-param-postal-code").attr("onclick", "loadByHash('#city.detail.insee."+inseeCommunexion+"')");
				$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);

			<?php } ?>

			$("#searchBarPostalCode").val(cityNameCommunexion);
			
	  		$(".btn-menu2, .btn-menu3, .btn-menu4 ").show(400);
		
			Sig.clearMap();

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
				startSearch();
				showMap(false);
			}else{
				if(inseeCommunexion != "")
				toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
				//$("#cityDetail #btn-communecter").html("<i class='fa fa-check'></i> Communecté");
				showMap(false);
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
	            	console.dir(data);
	            	Sig.showMapElements(Sig.map, data);
	            	$(".moduleLabel").html("<i class='fa fa-connect-develop'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
					$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
					toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
					$.unblockUI();
	            }
	          }
	 	});

  	}

  	

    function showPanel(box,bgStyle,title){ 

		$(".my-main-container").scrollTop(0);

	  	$(".box").hide(200);
	  	showNotif(false);
				
		console.log("showPanel");
		//showTopMenu(false);
		$(".main-col-search").animate({ top: -1500, opacity:0 }, 500 );

		$("."+box).show(500);
    }

    function showAjaxPanel (url,title,icon) { 
		//$(".main-col-search").css("opacity", 0);
		
		hideScrollTop = false;

		var rand = Math.floor((Math.random() * 7) + 1); 
		var urlImgRand = proverbs[rand];
		
		showNotif(false);
				
		$(".main-col-search").animate({ top: -1500, opacity:0 }, 800 );

		setTimeout(function(){
			$(".main-col-search").html("");
			 $.blockUI({
			 	message : '<h2 class="homestead text-dark padding-10"><i class="fa fa-spin fa-circle-o-notch"></i> Chargement en cours...</h2>' +
			 	//"<h2 class='text-red homestead'>Lancement du crowdfouding : lundi 22 février</h2>" +
			 	"<img style='max-width:60%;' src='"+urlImgRand+"'><br/>" +
			 	"<img src='<?php echo $this->module->assetsUrl?>/images/crowdfoundez.png'/>"
			 	//"<h2 class='text-red homestead'>ouverture du site : lundi 29 février</h2>"
			 	

			 });
			$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i>"); //" Chargement en cours ...");

			//$(".main-col-search").show();

			
			showMap(false);
			
		}, 800);
		//
		//

		$(".box").hide(200);
		//showPanel('box-ajax');
		icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
		$(".panelTitle").html(icon+title).fadeIn();
		console.log("GETAJAX");
		
		showTopMenu(true);

		setTimeout(function(){
			getAjax('.main-col-search',baseUrl+'/'+moduleId+url,function(){ 
				$(".main-col-search").slideDown(); initNotifications(); 
				$.unblockUI();
				$(".explainLink").click(function() {  
				    showDefinition( $(this).data("id") );
				    return false;
				 });
			},"html");
		}, 800);
		
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
		console.dir(myContacts);
		if(myContacts != null){
	      var floopDrawerHtml = buildListContactHtml(myContacts, myId);
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
	    $(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
					
	   // $("#searchBarPostalCode").animate({"width" : "0px !important", "padding-left" : "51px !important;"}, 200);
	    $(".lbl-scope-list").html("<i class='fa fa-check'></i> " + cityNameCommunexion.toLowerCase() + ", " + cpCommunexion);
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

</script>





