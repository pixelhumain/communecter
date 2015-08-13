<script type="text/javascript">
	var  activePanel = "box-login";
	var  bgcolorClass = "bgblack";

	function showMenu(box,bgStyle){
		
		$("body.login").removeClass("bgred bggreen bgblack bgblue");
		console.log("showMenu",box, bgcolorClass );
		$('.'+activePanel).hide();
		$(".byPHRight").fadeOut();
		$("body.login").removeClass("bgred bggreen bgblack bgblue");
		if( !box || box == "box-login" || box == "box-forget" || box == "box-register" ){
			$(".byPHRight").fadeIn();
			$("body.login").addClass("bgCity");
			bgcolorClass = "bgCity";
		}
		else{
			bgcolorClass = (bgStyle) ? bgStyle : "bgblack";
			$("body.login").removeClass("bgCity").addClass(bgcolorClass);
		}

		if(!box)
			box = "box-login";
		$('.box-menu').slideUp();
		$('.'+box).show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).show().removeClass("animated bounceInRight");
		});
		activePanel = box;
		if( box != "box-ph" ){
			$(".partnerLogosUp,.partnerLogosDown,.partnerLogosRight,.partnerLogosLeft").hide();
			$(".eventMarker").show().addClass("animated slideInDown");
			$(".cityMarker").show().addClass("animated slideInUp");
			$(".projectMarker").show().addClass("animated zoomInRight");
			$(".assoMarker").show().addClass("animated zoomInLeft");
			$(".userMarker").show().addClass("animated zoomInLeft");
		}
	}
	function showHideMenu () { 
		console.log("open showMenu" );
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
                    	showMenu("box-login");
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
<div class="text-white text-extra-large text-bold center topLogoAnim">
	<span class="badge badge-danger "> PRE-ALPHA-invites-only ( beta in september, early registration open ) </span>
	<br/>
	<span class="titleRed text-red homestead" style="font-size:40px">CO</span>
	<span  style="font-size:40px" class="titleWhite homestead">MMU</span>
	<span  style="font-size:40px" class="titleWhite2 text-red homestead">NECTER</span>
	<a href="#" class="text-white" onclick="showVideo('133636468')"><i class="fa fa-2x fa-youtube-play"></i></a>
	
	<div class="subTitle" style="margin-top:-13px;">Se connecter à sa commune.</div>
</div>
<?php } ?>
<div class="box-menu box">
	<ul class="text-white text-bold" style="list-style: none; font-size: 3.1em; margin-top:50px; ">
		<li style="margin-left:50px"><i class="fa fa-share-alt"></i> <a href="#" style="color:white" onclick="showMenu('box-whatisit','bgyellow')">WHAT</a></li>
		<li style="margin-left:50px"><i class="fa fa-heart"></i> <a href="#" style="color:white" onclick="showMenu('box-why','bggreen')">WHY</a></li>
		<li style="margin-left:50px"><i class="fa fa-group"></i> <a href="#" style="color:white" onclick="showMenu('box-4who','bgblue')">WHO</a></li>
		<li style="margin-left:50px"><i class="fa fa-laptop"></i> <a href="#" style="color:white" onclick="showMenu('box-how','bggreen')">HOW</a></li>
		<li style="margin-left:50px"><i class="fa fa-calendar"></i> <a href="#" style="color:white" onclick="showMenu('box-when','bgyellow')">WHEN</a></li>
		<li style="margin-left:50px">&nbsp;<i class="fa fa-map-marker"></i> <a href="#" style="color:white" onclick="showMenu('box-where','bgblue')">WHERE</a></li>
		<li style="margin-left:50px">&nbsp;<i class="fa fa-lightbulb-o"></i> <a href="#" style="color:white" onclick="showMenu('box-help')">HELP US</a></li>
		<li style="margin-left:50px"><i class="fa fa-<?php echo (isset($actionIcon)) ? $actionIcon : "globe" ?>"></i> <a href="#" style="color:white" onclick="showMenu('box-login')"><?php echo (isset($actionTitle)) ? $actionTitle : "CONNECT" ?></a></li>
		<li><i class="fa fa-youtube-play"></i> <a href="#" onclick="showVideo('74212373')"><img style="height: 64px;" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a></li>
	</ul>
</div>
<style type="text/css">
	.nextBtns{color:#E33551; font-size:2.5em;}
	.nextBtns:hover{color:white; }
</style>
<div class="box-whatisit box">
	
	<h1><i class="fa fa-share-alt"></i> WHAT</h1>
	<section>
		A new way to live in society
		<br/> Together to make it better
		<br/> It's a societal network
		<br/> Connected to your city 
		<br/> Building for the commons
		<br/> Thinking Collectively
		<br/> Collaborative Economy
		<br/> Communities drive societies 
		<br/> 
	</section>
	<hl/>
	<a href="#" onclick="showMenu('box-why','bggreen')" class="homestead nextBtns pull-right">WHY <i class="fa fa-arrow-circle-o-right"></i> </a>
</div>

<div class="box-why box">
	<h1><i class="fa fa-heart"></i> WHY</h1>
	<section class="">
		Because We Love you
		<br/> Because Nothings Happens just like that
		<br/> Create the future you want to live in
		<br/> Because of the state of things
		<br/> The Passed is a lesson
		<br/> A collaborative experiment
		<br/> To Give a voice to the silent 99%
		<br/> Sharing not owning
		<br/> Copy Freely and make it better
		<br/> Cooperate to Distribute Massively 
		<br/> Get Together not hide alone
		<br/> Discover and not Ignore
		<br/> 
	</section>
	<a href="#" onclick="showMenu('box-4who','bgblue')" class="homestead nextBtns pull-right">WHO <i class="fa fa-arrow-circle-o-right"></i></a>
</div>

<div class="box-4who box">

	<h1><i class="fa fa-group"></i> FOR WHO</h1>
	<section>
		For the people 
		<br/> by the people 
	</section>
	<h1><i class="fa fa-group"></i> BY WHO</h1>
	<section>
		Builders 
		<br/> Architects
		<br/> Thinkers
		<br/> Artists
		<br/> Connecters
		<br/> Inventors
		<br/> Travellers
		<br/> Makers
	</section>
	<a href="#" onclick="showMenu('box-how','bggreen')" class="homestead nextBtns pull-right">HOW <i class="fa fa-arrow-circle-o-right"></i></a>
	
</div>

<div class="box-how box">
	<h1><i class="fa fa-laptop"></i> HOW</h1>
	<section>
		People, Organizations, Cities and Projects
		<br/> By The numbers
		<br/> Computers and more people 
		<br/> Make a good mix 
		<br/> Build Great Things
		<br/> Societal Innovation
		<br/> Collective Imagination
		<br/> Open source 
	</section>
	<a href="#" onclick="showMenu('box-when','bgyellow')" class="homestead nextBtns pull-right">WHEN <i class="fa fa-arrow-circle-o-right"></i></a>
</div>

<div class="box-when box">
	<h1><i class="fa fa-calendar"></i> WHEN</h1>
	
	<section>
		If it's not now
		<br/> it's never
		<br/> First Beta opening in september 2015
		<br/> Crowd Funding launches in August 2015
	</section>
	<a href="#" onclick="showMenu('box-where','bgblue')" class="homestead nextBtns pull-right">WHERE <i class="fa fa-arrow-circle-o-right"></i></a>
</div>

<div class="box-where box">
	<h1><i class="fa fa-map-marker"></i> WHERE</h1>
	<section>
		Every where there are people 
		<br/> With ideas
		<br/> Motivation to change
		<br/> And anyone can start 
		<br/> Anywhere 
		<br/> Anytime
		<br/> Remember you are never alone 
	</section>

	<a href="#" onclick="showMenu('box-help')" class="homestead nextBtns pull-right">GET INVOLVED <i class="fa fa-arrow-circle-o-right"></i></a>

</div>

<div class="box-help box">
	<h1><i class="fa fa-lightbulb-o"></i> GET INVOLVED</h1>
	<section>
		To Build 
		<br/> Communicate
		<br/> Design
		<br/> Finance
		<br/> Translate
		<br/> Innovate
	</section>
	<a href="#" class="homestead nextBtns pull-right" onclick="showMenu('box-login')"><?php echo (isset($actionTitle)) ? $actionTitle : "CONNECT" ?></a>
</div>


<div class="box-event box">
	<h1><i class="fa fa-calendar"></i> EVENTS</h1>
	<section>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
	</section>
	<a href="#" class="homestead nextBtns pull-right" onclick="showMenu('box-orga')"><?php echo (isset($actionTitle)) ? $actionTitle : "ORGANISATIONS" ?></a>
</div>

<div class="box-orga box">
	<h1><i class="fa fa-users"></i> ORGANIZATIONS</h1>
	<section>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
	</section>
	<a href="#" class="homestead nextBtns pull-right" onclick="showMenu('box-city')"><?php echo (isset($actionTitle)) ? $actionTitle : "CITY" ?></a>
</div>

<div class="box-city box">
	<h1><i class="fa fa-university"></i> CITIES</h1>
	<section>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
	</section>
	<a href="#" class="homestead nextBtns pull-right" onclick="showMenu('box-projects')"><?php echo (isset($actionTitle)) ? $actionTitle : "PROJECTS" ?></a>
</div>

<div class="box-projects box">
	<h1><i class="fa fa-lightbulb-o"></i> PROJECTS</h1>
	<section>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
	</section>
	<a href="#" class="homestead nextBtns pull-right" onclick="showMenu('box-event')"><?php echo (isset($actionTitle)) ? $actionTitle : "PEOPLE" ?></a>
</div>

<div class="box-people box">
	<h1><i class="fa fa-user"></i> PEOPLE </h1>
	<section>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.
	</section>
	<a href="#" class="homestead nextBtns pull-right" onclick="showMenu('box-login')"><?php echo (isset($actionTitle)) ? $actionTitle : "CONNECT" ?></a>
</div>

<div class="box-ph box">
	<h1><i class="fa fa-cubes"></i> PIXEL HUMAIN </h1>
	<section>
		Un collectif magnifique
		Innovation au service des biens communs
		Respectant un CODE SOCIAL ET LOGICIEL ouvert

	</section>
	<a href="#" class="homestead nextBtns pull-right" onclick="showMenu('box-login')"><?php echo (isset($actionTitle)) ? $actionTitle : "CONNECT" ?></a>
</div>