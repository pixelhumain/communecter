<script type="text/javascript">
	var  activePanel = "box-login";
	var  bgcolorClass = "bgblack";

	function showMenu(box){
		$("body.login").removeClass("bgred bggreen bgblack bgblue");
		if($(".menuBtn").hasClass("fa-times"))
		{
			$(".menuBtn").removeClass("fa-times").addClass("fa-bars");
			console.log("showMenu",box, bgcolorClass );

			$("body.login").removeClass("bgred bggreen bgblack bgblue");
			if( !box || box == "box-login" || box == "box-forget" || box == "box-register" ){
				$(".byPHRight").fadeIn();
				$("body.login").addClass("bgCity");
				bgcolorClass = "bgCity";
			}
			else{
				bgcolorClass = "bgblack";
				if(box == "box-whatisit" || box == "box-when" )
					bgcolorClass = "bgred";
				else if(box == "box-why" || box == "box-how" )
					bgcolorClass = "bggreen";
				else if(box == "box-4who" || box == "box-where" )
					bgcolorClass = "bgblue";
					
				$("body.login").removeClass("bgCity").addClass(bgcolorClass);
			}

			if(!box)
				box = "box-login";
			$('.box-menu').slideUp();
			$('.'+box).show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInRight");
			});
			activePanel = box;
		}
		else 
		{
			//$("body.login").removeClass(bgcolorClass).addClass("bgCity");
			console.log("open showMenu",box, bgcolorClass );

			$("body.login").removeClass("bgred bggreen bgblack bgblue");

			$("body.login").removeClass("bgCity").addClass(bgcolorClass);
			$(".menuBtn").removeClass("fa-bars").addClass("fa-times");
			$('.'+activePanel).hide();
			$('.box-menu').slideDown();
			$(".byPHRight").fadeOut();
		}
	}

	function showVideo(id) { 

		$(".menuBtn").removeClass("fa-times").addClass("fa-bars");
		$("body.login").removeClass("bgred bggreen bgblack bgblue");
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
			$('.loaderDots').html("");
			titleMapIndex = ( titleMapIndex == titleMap.length-1 ) ? 0 : titleMapIndex+1;
			titleAnim ();
		},3000);
	}
	function loaderPoints () { 
		/*setTimeout(function(){
			$('.loaderDots').html($('.loaderDots').html()+".");	
			loaderPoints ();
		},800)*/
	}
	/*var toggleTitleState = -1;
	function  toggleTitle (state) {

		console.log("toggleTitle",toggleTitleState); 
		setTimeout(function(){

			if(state>0)
			{
				$(".titleRed").html("COMMUNE");
				$(".titleWhite").html("CTER");
				$(".titleWhite2").html("");
			}
			else
			{
				$(".titleRed").html("CO");
				$(".titleWhite").html("MMU");
				$(".titleWhite2").html("NECTER");
			}
			toggleTitleState = -toggleTitleState; 
		},500);
	}*/
</script>

<div class="text-white text-extra-large text-bold center topLogoAnim">
	<span class="badge badge-danger "> PRE-ALPHA-invites-only ( beta in september, early registration open ) </span>
	<br/>
	<span class="titleRed text-red homestead" style="font-size:40px">CO</span>
	<span  style="font-size:40px" class="titleWhite homestead">MMU</span>
	<span  style="font-size:40px" class="titleWhite2 text-red homestead">NECTER</span>
	<a href="#" class="text-white" onclick="showVideo('133632604')"><i class="fa fa-2x fa-youtube-play"></i></a>
	
	<div class="subTitle" style="margin-top:-13px;">Se connecter à sa commune.</div>
</div>
<div class="box-menu box">
	<ul class="text-white text-bold" style="list-style: none; font-size: 3.1em; margin-top:50px; ">
		<li style="margin-left:50px"><i class="fa fa-share-alt"></i> <a href="#" style="color:white" onclick="showMenu('box-whatisit')">WHAT IS IT</a></li>
		<li style="margin-left:50px"><i class="fa fa-heart"></i> <a href="#" style="color:white" onclick="showMenu('box-why')">WHY</a></li>
		<li style="margin-left:50px"><i class="fa fa-group"></i> <a href="#" style="color:white" onclick="showMenu('box-4who')">FOR WHO</a></li>
		<li style="margin-left:50px"><i class="fa fa-laptop"></i> <a href="#" style="color:white" onclick="showMenu('box-how')">HOW</a></li>
		<li style="margin-left:50px"><i class="fa fa-calendar"></i> <a href="#" style="color:white" onclick="showMenu('box-when')">WHEN</a></li>
		<li style="margin-left:50px">&nbsp;<i class="fa fa-map-marker"></i> <a href="#" style="color:white" onclick="showMenu('box-where')">WHERE</a></li>
		<li style="margin-left:50px">&nbsp;<i class="fa fa-lightbulb-o"></i> <a href="#" style="color:white" onclick="showMenu('box-help')">HELP US</a></li>
		<li style="margin-left:50px"><i class="fa fa-<?php echo (isset($actionIcon)) ? $actionIcon : "globe" ?>"></i> <a href="#" style="color:white" onclick="showMenu('box-login')"><?php echo (isset($actionTitle)) ? $actionTitle : "CONNECT" ?></a></li>
		<li><i class="fa fa-youtube-play"></i> <a href="#" onclick="showVideo('74212373')"><img style="height: 67px;" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a></li>
	</ul>
</div>

<div class="box-whatisit box">
	<a href="<?php echo Yii::app()->createUrl( $this->module->id.'/login' ) ?> "><img  src="<?php echo $this->module->assetsUrl?>/images/logoSMclean.png"/></a>
	<h1><i class="fa fa-share-alt"></i> WHAT IS IT</h1>
	<section>
		a new way to live in society
		<br/> together to make it better
		<br/> It's sociatel network
	</section>
</div>

<div class="box-why box">
	<h1><i class="fa fa-heart"></i> WHY</h1>
	<section class="homestead">
		Because We Love you
	</section>
</div>

<div class="box-4who box">

	<h1><i class="fa fa-group"></i> FOR WHO</h1>
	<section>
		For the people 
		<br/> by the people 
	</section>
	<h1><i class="fa fa-group"></i> BY WHO</h1>
	<section>
		by builders , architects, thinkers, artists
		connecters, inventors, travellers, makers
	</section>
</div>

<div class="box-how box">
	<h1><i class="fa fa-laptop"></i> HOW</h1>
	<section>
		Computer and people 
		<br/>make a good mix 
		<br/> Build Great Things
	</section>
</div>

<div class="box-when box">
	<h1><i class="fa fa-calendar"></i> WHEN</h1>
	
	<section>
		If it's not 
		<br/>now it's never
	</section>
</div>

<div class="box-where box">
	<h1><i class="fa fa-map-marker"></i> WHERE</h1>
	<section>
		Every where there are people 
		<br/> with ideas
		<br/> motivation to change
	</section>
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
</div>