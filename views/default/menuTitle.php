<script type="text/javascript">
	var  activePanel = "box-login";
	var  bgcolorClass = "bgblack";
	var navHistory = null;
	var prevNav = null;

	function showPanel(box,bgStyle,title,icon){
		
		/*if( navHistory != null)
			prevNav = {
				func : "showPanel",
				box : navHistory.box,
				bgStyle :navHistory.bgStyle ,
				title : navHistory.title ,
				icon : navHistory.icon 
			};
		navHistory = {
			func : "showPanel",
			box : box,
			bgStyle :bgStyle ,
			title : title ,
			icon : icon 
		};*/

		$("body.login").removeClass("bgred bggreen bgblack bgblue");
		console.log("showPanel",box, bgcolorClass );
		$('.'+activePanel+", .panelTitle, .box-ajax").hide();
		$(".byPHRight").fadeOut();
		$("body.login").removeClass("bgred bggreen bgblack bgblue");

		if( !box || box == "box-login" || box == "box-forget" || box == "box-register" || box == "box-add" ){
			$(".byPHRight").fadeIn();
			$(".connectMarker").fadeOut();
			$("body.login").addClass("bgCity");
			bgcolorClass = "bgCity";

			if(box == "box-add"){
				Sig.map.setZoom(2);
			}
		}
		else{
			bgcolorClass = (bgStyle) ? bgStyle : "bgblack";
			$("body.login").removeClass("bgCity").addClass(bgcolorClass);
			$(".connectMarker").fadeIn();
		}
		if( icon || title ){
			icon = (icon) ? " <i class='fa fa-"+icon+"'></i> " : "";
			$(".moduleLabel").html( icon+title );
		}
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
	var hashUrl = null
	function openAjaxPanel (url,title,icon)  { 
		
	}
	function showAjaxPanel (url,title,icon) 
	{ 
		console.log("showAjaxPanel",baseUrl+'/'+moduleId+url,title,icon);
		rand = Math.floor((Math.random() * 8) + 1);
		$.blockUI({message : '<div class="title-processing homestead"><i class="fa fa-spinner fa-spin"></i> Processing... </div>'
			+'<a class="thumb-info" href="'+proverbs[rand]+'" data-title="Proverbs, Culture, Art, Thoughts"  data-lightbox="all">'
			+ '<img src="'+proverbs[rand]+'" style="border:0px solid #666; border-radius:3px;"/></a><br/><br/>'
			});
		$(".ajaxForm").hide();
		$(".ajaxForm").html('<form class="form-login ajaxForm" style="display:none" action="" method="POST"></form>');
		$(".box-ajaxTools").html("");

		getAjax('.ajaxForm',baseUrl+'/'+moduleId+url,function(){ 
			/*if(!userId){
				window.location.href = baseUrl+'/'+moduleId+"/person/login";
			} else{*/
				$(".ajaxForm").slideDown(); 
				$.unblockUI();
			//}
		},"html");

		//show hash
		var urlT = [];
		urlT = url.split("/");
		paramsT = url.split("?");
		hashUrl = urlT[1]+"."+urlT[2];
		if(urlT[3] != undefined)
			hashUrl += "."+urlT[3]+"."+urlT[4];
		if(urlT[5] != undefined)
			hashUrl += "."+urlT[5]+"."+urlT[6];
		/*if( paramsT[1] )
			hashUrl += "?"+paramsT[1];*/

		//adds hash to the url 
		//timeout is a hack : dont understand why the hash is empty in some cases
		//maybe a conflict with some libs that automatically overide the location hash 
		//setTimeout( function(){
			location.hash = hashUrl;
			//history.pushState({hash:baseUrl+'/'+moduleId+"/default/simple#"+hashUrl}, null, baseUrl+'/'+moduleId+"/default/simple#"+hashUrl );
		//},500 );
		
		console.warn("pushState",hashUrl);
		//console.dir({hash:hashUrl}, null, baseUrl+'/'+moduleId+"/default/simple#"+hashUrl);
		/*if( navHistory != null)
			prevNav = {
			func : "showAjaxPanel",
			url : navHistory.url , 
			title : navHistory.title ,
			icon : navHistory.icon };
		navHistory = {
			func : "showAjaxPanel",
			url : url , 
			title : title ,
			icon : icon };*/
		showPanel('box-ajax');
		if( icon && icon != "" && icon.indexOf('fa-') < 0) icon = "fa-"+icon;
		icon = (icon) ? " <i class='fa "+icon+"'></i> " : "";
		$(".moduleLabel").html( icon+title );
		//$(".box-ajaxTitle").html( icon + title );
	}
	function gotToPrevNav()
	{
		console.dir( prevNav );
		if(prevNav != null)
		{
			if( prevNav.func == "showAjaxPanel" )
				showAjaxPanel( prevNav.url, prevNav.title, prevNav.icon );
			else if( prevNav.func == "showPanel" )
				showPanel( prevNav.box, prevNav.bgStyle, prevNav.title, prevNav.icon );
		}
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
		{titleRed:"COMMU",titleWhite:"NECTER",subTitle:"Communautés qui travaillent ensemble"},
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
	<span class="badge badge-danger "> PRE-ALPHA-invites-only ( beta in september, early registration open ) </span>
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
		<li><i class="fa fa-youtube-play"></i> <a href="#" onclick="showVideo('74212373')"><img style="height: 64px;" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a></li>
	</ul>
</div>
<style type="text/css">
	.nextBtns{color:#E33551; font-size:2.5em;}
	.nextBtns:hover{color:white; }
</style>






















