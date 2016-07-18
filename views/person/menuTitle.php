<script type="text/javascript">
	var  activePanel = "box-login";
	var  bgcolorClass = "bgblack";

	function showPanel(box,bgStyle,title){
		
		$("body.login").removeClass("bgred bggreen bgblack bgblue");
		console.log("showPanel",box, bgcolorClass );
		$('.'+activePanel+", .panelTitle").hide();
		$(".byPHRight").fadeOut();
		$("body.login").removeClass("bgred bggreen bgblack bgblue");

		if( !box || box == "box-login" || box == "box-forget" || box == "box-register" ){
			$(".byPHRight").fadeIn();
			$(".connectMarker").fadeOut();
			$("body.login").removeClass("bggreen bgblack bgblue bgyellow bgCity").addClass("bgCity");
			bgcolorClass = "bgCity";
		}
		else{
			bgcolorClass = (bgStyle) ? bgStyle : "bgblack";
			$("body.login").removeClass("bgCity").addClass(bgcolorClass);
			$(".connectMarker").fadeIn();
		}
		$(".moduleLabel").html( ( (title) ? title : "") );
		if(!box)
			box = "box-login";
		$('.box-menu').slideUp();
		$('.'+box).show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).show().removeClass("animated bounceInRight");
		});
		activePanel = box;
		if( box != "box-ph" && box != "box-who" ){
			$(".partnerLogosUp,.partnerLogosDown,.partnerLogosRight,.partnerLogosLeft").hide();
			$(".eventMarker").show().addClass("animated slideInDown");
			$(".cityMarker").show().addClass("animated slideInUp");
			$(".projectMarker").show().addClass("animated zoomInRight");
			$(".assoMarker").show().addClass("animated zoomInLeft");
			$(".userMarker").show().addClass("animated zoomInLeft");
		}else{
			$(".eventMarker, .cityMarker, .projectMarker, .assoMarker, .userMarker").fadeOut();
			$(".partnerLogosLeft").show().addClass("animated zoomInLeft");
			$(".partnerLogosRight").show().addClass("animated zoomInRight");
			$(".partnerLogosDown").show().addClass("animated zoomInDown");
			$(".partnerLogosUp").show().addClass("animated zoomInUp");
		}
	}
	function showAjaxPanel (url,title,icon) { 
		$(".ajaxForm").hide();
		showPanel('box-ajax');
		icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
		$(".panelTitle").html(icon+title).fadeIn();
		getAjax('.ajaxForm',baseUrl+'/'+moduleId+url,function(){ $(".ajaxForm").slideDown(); },"html");
	}
	function showHideMenu () { 
		console.log("open showHideMenu" );
		$("body.login").removeClass("bggreen bgblack bgblue bgyellow bgCity").addClass(bgcolorClass);
		//$(".menuBtn").removeClass("fa-bars").addClass("fa-times");
		$('.'+activePanel).hide();
		$('.box-menu').slideDown();
		$(".byPHRight").fadeOut();
		$(".partnerLogosUp,.partnerLogosDown,.partnerLogosRight,.partnerLogosLeft").hide();
		$(".eventMarker").show().addClass("animated slideInDown");
		$(".cityMarker").show().addClass("animated slideInUp");
		$(".projectMarker").show().addClass("animated zoomInRight");
		$(".assoMarker").show().addClass("animated zoomInLeft");
		$(".userMarker").show().addClass("animated zoomInLeft");
	}

	function showVideo(id) { 
		$('.'+activePanel+",.byPHRight, .eventMarker, .cityMarker, .projectMarker, .assoMarker, .userMarker,.partnerLogos ").fadeOut();
		$(".menuBtn").removeClass("fa-times").addClass("fa-bars");
		$("body.login").removeClass("bggreen bgblack bgblue bgyellow");
		$('.box-menu,.topLogoAnim').slideUp();
		$.okvideo({ source: id,
                    volume: 10,
                    loop: false,
                    //hd:true,
                    //adproof: true,
                    //annotations: false,
                    onFinished: function() { 
                    	$('.topLogoAnim').slideDown();
                    	showPanel("box-login");
                    },
                    /*unstarted: function() { console.log('unstarted') },
                    onReady: function() { console.log('onready') },
                    onPlay: function() { console.log('onplay') },
                    onPause: function() { console.log('pause') },
                    buffering: function() { console.log('buffering') },
                    cued: function() { console.log('cued') },*/
                 });
	}
	var titleMapIndex = 1;
	var titleMap = [
		{titleRed:"CO",titleWhite:"MMU",titleWhite2:"NECTER",subTitle:"Se connecter à sa commune"},
		{titleRed:"COMMUNE",titleWhite:"CTER",subTitle:"Se connecter à sa commune"},
		{titleRed:"CO",titleWhite:"MMUNECTER",subTitle:"Coopérer et Collaborer"},
		{titleRed:"COMM",titleWhite:"UNECTER",subTitle:"Communiquons mieux localement"},
		{titleRed:"COMMU",titleWhite:"NECTER",subTitle:"Communautés qui travail ensemble"},
		{titleRed:"COMMUN",titleWhite:"ECTER",subTitle:"Pour le bien commun"},
		{titleRed:"COMMUNE",titleWhite:"CTER",subTitle:"Pour améliorer la ville 2.2.main"}
		
	];
	function titleAnim () 
	{ 
		setTimeout(function()
		{
			//console.log("titleAnim",titleMapIndex);
			var map = titleMap[titleMapIndex];
			$(".titleRed").html(map.titleRed);
			$(".titleWhite").html(map.titleWhite);
			if(map.titleWhite2){
				$(".titleWhite2").html(map.titleWhite2);
				//toggleTitle ();
			}
			else
				$(".titleWhite2").html("");
			$(".subTitle").html(map.subTitle);
			titleMapIndex = ( titleMapIndex == titleMap.length-1 ) ? 0 : titleMapIndex+1;
			titleAnim ();
		},3000);
	}
</script>
<?php if(!isset($topTitleExists)){ ?>
<div class="text-white text-extra-large text-bold center topLogoAnim " style="cursor: pointer" onclick="showPanel('box-communecter')">
	<span class="badge badge-danger "> PRE-ALPHA-invites-only ( beta in febuary, early registration open ) </span>
	<br/>
	<span class="titleRed text-red homestead" style="font-size:40px">CO</span>
	<span  style="font-size:40px" class="titleWhite homestead">MMU</span>
	<span  style="font-size:40px" class="titleWhite2 text-red homestead">NECTER</span>
	
	
	<div class="subTitle" style="margin-top:-13px;">Se connecter à sa commune.</div>
</div>
<?php } ?>
<div class="box-menu box">
	<ul class="text-white text-bold" style="list-style: none; font-size: 3.1em; margin-top:50px; ">
		<li style="margin-left:50px"><i class="fa fa-share-alt"></i> <a href="#" style="color:white" onclick="showPanel('box-whatisit','bgyellow')">WHAT</a></li>
		<li style="margin-left:50px"><i class="fa fa-heart"></i> <a href="#" style="color:white" onclick="showPanel('box-why','bggreen')">WHY</a></li>
		<li style="margin-left:50px"><i class="fa fa-group"></i> <a href="#" style="color:white" onclick="showPanel('box-4who','bgblue')">WHO</a></li>
		<li style="margin-left:50px"><i class="fa fa-laptop"></i> <a href="#" style="color:white" onclick="showPanel('box-how','bggreen')">HOW</a></li>
		<li style="margin-left:50px"><i class="fa fa-calendar"></i> <a href="#" style="color:white" onclick="showPanel('box-when','bgyellow')">WHEN</a></li>
		<li style="margin-left:50px">&nbsp;<i class="fa fa-map-marker"></i> <a href="#" style="color:white" onclick="showPanel('box-where','bgblue')">WHERE</a></li>
		<li style="margin-left:50px">&nbsp;<i class="fa fa-lightbulb-o"></i> <a href="#" style="color:white" onclick="showPanel('box-help')">HELP US</a></li>
		<li style="margin-left:50px"><i class="fa fa-<?php echo (isset($actionIcon)) ? $actionIcon : "globe" ?>"></i> <a href="#" style="color:white" onclick="showPanel('box-login')"><?php echo (isset($actionTitle)) ? $actionTitle : "CONNECT" ?></a></li>
		<li style="margin-left:50px"><i class="fa fa-youtube-play"></i> <a href="#" onclick="showVideo('74212373')"><img style="height: 64px;" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a></li>
	</ul>
</div>
<style type="text/css">
	.nextBtns{color:#E33551; font-size:2.5em;}
	.nextBtns:hover{color:white; }
</style>






















