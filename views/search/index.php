<?php 
	$cs = Yii::app()->getClientScript();
	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
	//Data helper
	$cs->registerScriptFile($this->module->assetsUrl. '/js/communecter.js' , CClientScript::POS_END);
	//Validation
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
	//select2
	$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/select2/select2.min.js' , CClientScript::POS_END);

	//$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/localisationHtml5.js' , CClientScript::POS_END);
	//geolocalisation nominatim et byInsee
	//$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/geoloc.js' , CClientScript::POS_END);

	$cssAnsScriptFilesModule = array(
		'/css/search.css',
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

<div class="col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1 main-top-menu">
	
	<img id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>

	<h1 class="homestead text-dark no-padding moduleLabel" id="main-title"
		style="font-size:22px;margin-bottom: 0px; margin-top: 15px; ">
		<i class="fa fa-connectdevelop"></i> <span id="main-title-menu">L'Annuaire</span> <span class="text-red">COMMUNE</span>CTÉ</h1>

	<?php $this->renderPartial("short_info_profil"); ?> 

	<button class="menu-button btn-menu btn-menu-top bg-azure tooltips" id="btn-toogle-map"
			data-toggle="tooltip" data-placement="right" title="Carte" alt="Localisation automatique">
			<i class="fa fa-map-marker"></i>
	</button>

</div>
	
<div class="col-md-12 col-sm-12 col-xs-12 no-padding no-margin my-main-container bgpixeltree">

	<?php $this->renderPartial('menu', array("page" => "accueil")); ?>
			
	<div class="col-md-9 col-md-offset-2 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1 main-col-search">
	</div>


	<?php if(!isset(Yii::app()->session['userId'])) $this->renderPartial("login_register"); ?>

</div>


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

	var proverbs = <?php echo json_encode(random_pic()) ?>;  

	var isNotSV = true;
	var hideScrollTop = true;

	jQuery(document).ready(function() {
		
		$(".my-main-container").css("min-height", $(".sigModuleBg").height());
	    $(".main-col-search").css("min-height", $(".sigModuleBg").height());

	    $('#btn-toogle-map').click(function(e){ showMap();  	});
	    $('.main-btn-toogle-map').click(function(e){ showMap(); });

	    $("#mapCanvasBg").show();
	    
	    $(".my-main-container").scroll(function(){
	    	checkScroll();
	    });
	    
	    console.log("hash", location.hash);
	    if(location.hash != "#search.home" && location.hash != "#" && location.hash != ""){
			loadByHash(location.hash);
			return;
		}
		else{ loadByHash("#search.home");
		}

		checkScroll();
	});

	function checkScroll(){
		//console.log("checkScroll");

		console.log(location.hash);
		if(location.hash == "#search.home") {
			$(".main-top-menu").animate({
	         							top: -60,
	         							opacity:0
								      }, 500 );
			return;
		}

		if($(".my-main-container").scrollTop() < 90 && hideScrollTop){
			if($(".main-top-menu").css("opacity") == 1)
				$(".main-top-menu").animate({
	         							top: -60,
	         							opacity:0
								      }, 500 );
		}else{
			if($(".main-top-menu").css("opacity") == 0)
				$(".main-top-menu").animate({
	         							top: 0,
	         							opacity:1
								      }, 500 );
		}
	}
	function showMap(show){
			console.log("showMap");
			if(show === undefined) show = $("#right_tool_map").css("display") == "none";
			if(show){
			
				showTopMenu(true);
				if(Sig.currentMarkerPopupOpen != null){
					Sig.currentMarkerPopupOpen.fire('click');
				}
				
				$(".btn-group-map").show( 700 );
				$("#right_tool_map").show(700);
				$("#btn-toogle-map").html("<i class='fa fa-list'></i>");
				$(".my-main-container").animate({
	         							top: -1000,
	         							opacity:0
								      }, 'slow' );

				var timer = setTimeout("Sig.constructUI()", 1000);
				
			}else{
				
				$(".btn-group-map").hide( 700 );
				$("#right_tool_map").hide(700);
				$(".panel_map").hide(1);
				$("#btn-toogle-map").html("<i class='fa fa-map-marker'></i>");
				$(".my-main-container").animate({
	         							top: 0,
	         							opacity:1
								      }, 'slow' );

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


    function showPanel(box,bgStyle,title){ 	
	  	$(".box").hide(200);

		console.log("showPanel");
		showTopMenu(false);
		$(".main-col-search").animate({ top: -1500, opacity:0 }, 500 );

		$("."+box).show(500);
    }

    function showAjaxPanel (url,title,icon) { 
		$(".main-col-search").css("opacity", 0);
		
		hideScrollTop = false;

		var rand = Math.floor((Math.random() * 7) + 1); 
		var urlImgRand = proverbs[rand];
		
		setTimeout(function(){

			$(".main-col-search").html(
			"<div class='loader text-dark '>"+
				"<span style='font-size:35px;' class='homestead'>"+
					"<i class='fa fa-spin fa-circle-o-notch'></i> "+
					"<span class='text-red'>COMMUNE</span>CTER.org</span></br></br>" + 
				"<img style='max-width:30%;' src='"+urlImgRand+"'>" +
			"</div>");
	
			$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Chargement en cours ...");

			$(".main-col-search").show();

			$(".main-col-search").animate({ top: 0, opacity:1 }, 300 );
		}, 400);

		showPanel('box-ajax');
		icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
		$(".panelTitle").html(icon+title).fadeIn();
		getAjax('.main-col-search',baseUrl+'/'+moduleId+url,function(){ $(".main-col-search").slideDown(); },"html");
		showTopMenu(true);

		
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

</script>





