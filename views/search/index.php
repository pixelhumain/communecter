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
		$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		$this->renderPartial($layoutPath.'mainMap');
	 	//$this->renderPartial("login_register"); 

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

<div class="col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1 main-top-menu">
	
	<img id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>

	<h1 class="homestead text-dark no-padding moduleLabel" id="main-title"
		style="font-size:22px;margin-bottom: 0px; margin-top: 15px; display: inline-block;">
		<i class="fa fa-connectdevelop"></i> <span id="main-title-menu">L'Annuaire</span> <span class="text-red">COMMUNE</span>CTÉ</h1>

	<?php $this->renderPartial("short_info_profil"); ?> 

	<button class="menu-button btn-menu btn-menu-top bg-azure tooltips" id="btn-toogle-map"
			data-toggle="tooltip" data-placement="right" title="Carte" alt="Carte">
			<i class="fa fa-map-marker"></i>
	</button>

</div>

<div class="col-md-12 col-sm-12 col-xs-12 no-padding no-margin my-main-container bgpixeltree">

	<?php $this->renderPartial('menu', array("page" => "accueil")); ?>
			
	<div class="col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1 main-col-search">
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

<div class="modal fade" id="modal-select-scope" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title homestead"><i class="fa fa-crosshairs"></i> Communection</h4>
      </div>
      <div class="modal-body text-dark">
      	<h3 style="margin-top:0px;" id="main-title-modal-scope"></h3>
        <div id="list-scope"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

	<?php 
		$where = isset( Yii::app()->request->cookies['cityName'] ) ? 
		   			    Yii::app()->request->cookies['cityName'] : "";
		if($where == "") 
				 $where = isset( Yii::app()->request->cookies['postalCode'] ) ? 
			   			  		 Yii::app()->request->cookies['postalCode'] : "";
	?>
	var where = "<?php echo $where; ?>";

	var myContacts = <?php echo ($myFormContact != null) ? json_encode($myFormContact) : "null"; ?>;
	var myId = "<?php echo isset( Yii::app()->session['userId']) ? Yii::app()->session['userId'] : "" ?>"; 

	var proverbs = <?php echo json_encode(random_pic()) ?>;  

	var isNotSV = true;
	var hideScrollTop = true;
	var lastUrl = null;

	jQuery(document).ready(function() {
		
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

	    console.log("WHERE ? ", where);
		//alert("ha");
		setScopeValue(where);
		
	    $(window).bind("popstate", function(e) {
	      console.warn("--------------------- pop",e);
	      if( lastUrl && "onhashchange" in window && location.hash){
	        console.warn("poped state",location.hash);
	        loadByHash(location.hash,true);
	      }
	      lastUrl = location.hash;
	    });
	    //console.log("hash", location.hash);
	    if(location.hash != "#search.home" && location.hash != "#" && location.hash != ""){
			loadByHash(location.hash);
			return;
		}
		else{ loadByHash("#search.home");
		}

		checkScroll();
	});

	function startSearch(){}

	function resizeInterface(){
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
			if($("#notificationPanel").css("display") == "none") show = true; 
	    	else show = false;
	    }

	    if(show) $('#notificationPanel').show("fast");
		else 	 $('#notificationPanel').hide("fast");
	}

	function checkScroll(){
		// if(location.hash == "#search.home") {
		// 	$(".main-top-menu").animate({
	 //         							top: -60,
	 //         							opacity:0
		// 						      }, 500 );
		// 	return;
		// }

		//console.log("checkScroll" , $(".my-main-container").scrollTop() , hideScrollTop);
		if($(".my-main-container").scrollTop() < 90 && hideScrollTop){
			if($(".main-top-menu").css("opacity") == 1){
				$(".main-top-menu").animate({
	         							top: -60,
	         							opacity:0
								      }, 500 );
			}
		}else{
			if($(".main-top-menu").css("opacity") == 0){
				$(".main-top-menu").animate({
	         							top: 0,
	         							opacity:1
								      }, 500 );
			}
		}
	}
	function showMap(show){
			console.log("showMap");
			if(show === undefined) show = $("#right_tool_map").css("display") == "none";
			if(show){
				showNotif(false);
				showTopMenu(true);
				if(Sig.currentMarkerPopupOpen != null){
					Sig.currentMarkerPopupOpen.fire('click');
				}
				
				$(".btn-group-map").show( 700 );
				$("#right_tool_map").show(700);
				$("#btn-toogle-map").html("<i class='fa fa-list'></i>");
				$("#btn-toogle-map").attr("data-original-title", "Tableau de bord");
				$(".my-main-container").animate({
	         							top: -1000,
	         							opacity:0,
								      }, 'slow' );

				setTimeout(function(){ $(".my-main-container").hide(); }, 1000);
				var timer = setTimeout("Sig.constructUI()", 1000);
				
			}else{
				
				$(".btn-group-map").hide( 700 );
				$("#right_tool_map").hide(700);
				$(".panel_map").hide(1);
				$("#btn-toogle-map").html("<i class='fa fa-map-marker'></i>");
				$("#btn-toogle-map").attr("data-original-title", "Carte");
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

				checkScroll();
			}
			
	}


    function setScopeValue(value){
	  	$("#searchBarPostalCode").val(value);
	  	startSearch();
    }
    function setSearchValue(value){
	  	$("#searchBarText").val(value);
	  	startSearch();
    }


    function showPanel(box,bgStyle,title){ 	
	  	$(".box").hide(200);
	  	showNotif(false);
				
		console.log("showPanel");
		showTopMenu(false);
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
			$(".main-col-search").html(
			"<div class='loader text-dark '>"+
				"<span style='font-size:35px;' class='homestead'>"+
					"<i class='fa fa-spin fa-circle-o-notch'></i> "+
					"<span class='text-red'>COMMUNE</span>CTER.org</span></br></br>" + 
				"<img style='max-width:30%;' src='"+urlImgRand+"'>" +
			"</div>");
	
			$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Chargement en cours ...");

			//$(".main-col-search").show();

			$(".main-col-search").animate({ top: 0, opacity:1 }, 800 );
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

	function initBtnScopeList(){
		$(".btn-scope-list").click(function(){
			setInputPlaceValue(this);
		});
	}

	function setInputPlaceValue(thisBtn){
		//if(location.hash == "#search.home"){
			//$("#autoGeoPostalCode").val($(thisBtn).attr("val"));
		//}else{
			$("#searchBarPostalCode").val($(thisBtn).attr("val"));
			
		//}
		//$.cookie("HTML5CityName", 	 $(thisBtn).attr("val"), 	   { path : '/ph/' });
		startSearch();
	}

</script>





