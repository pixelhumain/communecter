

<style>

.main-col-search{
	padding:0px !important;
}
.home_page h3.subtitle{
	font-weight: 300;
	font-size:20px;
}
.home_page h3.information{
	/*font-weight: 500;*/
	font-size:16px;
}

.home_page #main-logo-home{
	max-height: 290px;
	margin-top:30px;
}

.home_page .imageSectionVideo{
	width:80%;
	margin-left:10%;
}
.home_page .section-video{
	margin-top: 40px;
}

.home_page .btn-top{
	border-radius: 50px;
}

.home_page .btn-discover{
	border-radius: 60px;
	font-size: 50px;
	font-weight: 200;
	border: 1px solid transparent;
	width: 90px;
	height: 90px;
}
.home_page .btn-discover:hover{
	background-color: white !important;
	border-color: #2BB0C6 !important;
	color: #2BB0C6 !important;
}

.home_page .discover-subtitle{
	font-size:13px; 
	margin-top: -6px; 
	display: block;
}

.home_page .pastille{
	height: 100%;
	width: 100%;
	border-radius: 50px;
	font-size: 45px;
	padding: 13px 32px;
}

.list-action{
	/*width: 100%;*/
	/*padding: 5px 10px;*/
	margin-bottom:40px;
	font-size: 15px;
	font-weight: 300;
}

#img-network-for-all{
	/*max-width: 800px;*/
	padding:25px;
}
.menu-home-btn-ins{
	position: fixed;
	top: 0px;
	padding: 5px;
	right: 2%;
	z-index: 30;
	border-radius: 30px 30px 30px 30px;
}
#searchBarPostalCode{
	margin-top: 10px;
	width: 200px;
	margin-left: 0px;
	font-family: "homestead";
	font-size: 22px !important;
	border-radius: 3px !important;
	height: 40px;
}
input[type="text"].input-search:focus{
	/*border-color: #3C5665 !important;*/
	-moz-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	-webkit-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	-o-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	box-shadow: 0px 0px 5px -1px #CF3838 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}

#dropdown_search{
	margin-top:30px;
	margin-bottom:30px;
}

.btn-success.communected{
	width: 50%;
	margin-left: 25%;
	padding: 10px;
	border-radius: 20px;
	background-color:#5cb85c;
	color:white;
}

.searchEntity{
	margin-bottom:10px;
	margin-left:5px;
	display: inline-block;
}
.searchEntity .entityRight{
	text-align: center;
	padding: 6px 16px !important;
	margin-left: -1%;
	border-radius: 30px;
}
.searchEntity .entityRight .entityLocality{
	color:white !important;
	display: inline;
}
.searchEntity .entityRight .entityName{
	color:white !important;
	display: inline;
}
.contact-map {	background:url(<?php echo $this->module->assetsUrl; ?>/images/contact-map.jpg) top center no-repeat; background-size: 160% }
.keyword,.keyword1{margin-bottom: 3px;font-size:1.3em;}
.keywordExplain,.usageExplain{font-size:1.3em;}
.fa-caret-down{font-size:56px;line-height: 10px;}
.headerIcon{font-size: 1.6em;}

.social-list{	padding: 0;}
.social-list li{	list-style-type: none;	display:inline;margin-right:10px;}
.social-list li a{ font-size:20px;}
.social-list .btn{	margin-top: 15px;}
a.btn.btn-social{	color: #FFF;	background-color: #2a3945; }
a.btn.btn-social:hover{	background: none;}
a.btn.btn-facebook:hover{	color: #3b5998;}
a.btn.btn-twitter:hover{	color: #00a0d1;	border-color: #00a0d1;}
a.btn.btn-google:hover{	color: #dd4b39;	border-color: #dd4b39;}
a.btn.btn-github:hover{	color: #4078C0;	border-color: #4078C0;}
.yellowph{color:#F6E201;}
.information{font-size:15px;}

</style>

<div class="home_page">

<?php if(!isset( Yii::app()->session['userId'] )) { ?>
	<div class="menu-home-btn-ins text-right" style="margin-right:8%;">
		<button class="btn-top btn bg-red" onclick="showPanel('box-login');"><i class="fa fa-sign-in"></i> Se connecter</button> 
		<button class="btn-top btn btn-success" onclick="showPanel('box-register');"><i class="fa fa-plus-circle"></i> S'inscrire</button>
		
	</div>
<?php }else{
		$this->renderPartial("short_info_profil", array("type" => "main")); 
	}
?> 
		

	<center class="imageSection imageSectionVideo">
		<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/1+1=3.jpg?c=cl" style="width:70%;cursor: pointer" onclick="openVideo()"/>
	</center>
<?php /* ?>
	<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-home"></i> Bienvenue <span class="text-red">sur</span></h1>

	<h1 class="homestead text-red no-margin text-center" id="main-title-communect"
		style="font-size:40px; margin-top:0px;">COMMUNE<span class="text-dark">CTER</span></h1>

	<h3 class="text-dark text-center no-margin subtitle">
		Un réseau social citoyen libre 
	</h3>
*/?>
	<hr> 

	<h3 class="text-dark information center" style="margin-top:15px; ">
		<!-- <i class="fa fa-2x fa-angle-down"></i><br/> -->
		<strong><span class="text-red">Communecter</span> c'est simple : un code postal et c'est parti !</strong><br/>
		Je suis communecté : j'ai accès à ma ville !<br/>
	</h3>

	<!-- <div class="col-md-6" style="text-align:right;">
		<button class="btn bg-red" id="btn-param-postal-code"><i class="fa fa-cog"></i> Paramétrer mon code postal</button><br/>
		
		<center class="" style="display:none;" id="div-param-postal-code">	
			<i class="fa fa-2x fa-angle-right"></i> 
			<input id="searchBarPostalCode" class="input-search text-red" style="margin-left:5px;" type="text" placeholder="...">
		</center>
	</div>
	<div class="col-md-6">
		<button class="btn bg-dark pull-left" id="btn-geoloc-auto"><i class="fa fa-crosshairs"></i> Localisez-moi automatiquement</button>
	</div> -->

	<div id="dropdown_search" class="col-md-12">
		
	</div>

	<div style="display:none;" class="col-md-12" id="div-discover">
		<!-- <h2 class="btn-success communected">Félicitation, vous êtes communecté !</h2> -->
		<h2 class="center text-dark" style="margin-bottom:20px; margin-top:0px;">
			<i class="fa fa-2x fa-angle-down"></i><br/>
			Découvrir
		</h2>
		<div class="col-md-12 no-padding" style="margin-bottom:40px">
			<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
				<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/search#search.directory'); ?>" 
					target="_blank" class="btn btn-discover bg-azure">
					<i class="fa fa-connectdevelop"></i>
				</a><br/>L'annuaire<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
			</div>
			<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
				<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/search#search.agenda'); ?>" 
					target="_blank" class="btn btn-discover bg-azure">
					<i class="fa fa-calendar"></i>
				</a><br/>L'agenda<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
			</div>
			<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
				<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/search#search.news'); ?>" 
					target="_blank" 
					class="btn btn-discover bg-azure">
					<i class="fa fa-rss"></i>
				</a><br/>L'actualité<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
			</div>
		</div>
	</div>
	
	<hr>

	<div class="col-md-12">
		
		<div class="col-md-12" style="background-color:#394B59;width:100%;padding:1px 0px 1px 34%; ">
			<h1 class="homestead text-white">POUR QUI ? <br/> POUR QUOI FAIRE ?</h1>
		</div>
		<center>
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>
		<div class="col-sm-12">
			<div class="col-sm-4">
				<img class="img-responsive"  src="<?php echo $this->module->assetsUrl; ?>/images/bandeauKiss.jpg"/>
			</div>
			
			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large">POUR MOI... CITOYEN !</span>
				<br/>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			</div>
			
			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large">POUR LES ASSOCIATIONS</span>
				<br/>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large">POUR LES COMMUNES</span>
				<br/>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large" >POUR LES ENTREPRISES</span>
				<br/>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large" >UN Réseau pour tous</span>
				<br/>
					<a href="javascript:;" data-id="explainCommunecter" class="explainLink text-red">Communecter</a> réunit et fédère les principaux acteurs de la vie locale<br/>
					pour valoriser le territoire et le bien commun.  
			</div>
			
			<div class="col-sm-8">
				<img id="img-network-for-all" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/network-for-all.png"/>
			</div>
			
		</div>
	</div>
	
	<div class="col-md-12"  style="background-color:#DFE5E7;color:#293A46;padding-bottom:40px">
		<center>
			<i class="fa fa-caret-down" style="color:#fff;"></i><br/>
			<h1 class="homestead" style="color:#293A46"><i class="fa fa-mobile headerIcon"></i> <i class="fa fa-tablet headerIcon"></i> <i class="fa fa-desktop headerIcon"></i><br/>World Wide Web</h1>
			<div class="space20"></div>
			<div class="col-md-6 col-sm-12">
				Plus qu'une simple application Communecter se présente sous differente forme :
				<br/>Une projet open source
				<br/>Une communauté riche et diversifié
				<br/>Un site web qui vous tend les bras
				<br/>Une application mobile encore en court 
				<br/>Des interfaces tiers contribuant ou pas à une Base de donnée commune
				<br/>Des instances indépendantes mais interopérantes par leurs sémantiques communes 
			</div>
			<div class="col-md-6 col-sm-12">
				<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/screens.png"/>
			</div>
		</center>
	</div>

	
	<div class="col-md-12" style="background-color:#92BE1F; color:#293A46;padding-bottom:40px ">
		<center>
			<i class="fa fa-caret-down" style="color:#DFE5E7"></i><br/>
			<h1 class="homestead"><i class="fa fa-users headerIcon"></i><br/>CROWDFUNDING</h1>
		</center>
		<div class="space20"></div>
		<div class="col-md-6 col-sm-12">
			<a href="http://www.kisskissbankbank.com/communecter--2" target="_blank">
				<img class="img-responsive" style="border:4px solid #293A46;margin-top:40px" src="<?php echo $this->module->assetsUrl; ?>/images/crowdfunding.jpg"/>
			</a>
		</div>
		<div class="col-md-6 col-sm-12">
			<center>
				Lancement d'une opération de crowdfunding sur la plate-forme KissKissBankBank.
				<br/><br/>
				Aujourd'hui pour pouvoir faire évoluer notre plate forme avec toutes les idées, les 
				fonctionnalités chaque citoyen souhaite y apporter et pour pouvoir l'offrir gratuitement au 
				plus grand nombre, nous souhaitons passer à l’étape suivante... Cette étape nécessite 40 000 € et
				 nous l’atteindrons en gardant la philosophie du projet : c’est à dire avec un financement citoyen pour un projet citoyen !
				<br/><br/>
				Nous avons choisi la plateforme KissKissbankBank pour nous aider à atteindre notre objectif.
				http://www.kisskissbankbank.com/fr/users/association-open-atlas/projects/created
				<br/><br/>
				Notre campagne de crowdfounding va donc démarrer le ......
			<center>
		</div>
	</div>

	<div class="col-md-12" style="color:#E33551;padding-bottom:40px " >	
		<center>
			<i class="fa fa-caret-down" style="color:#92BE1F"></i><br/>
			<h1 class="homestead"><i class="fa fa-heart headerIcon"></i><br/>NOS VALEURS</h1>
			<div class="space20"></div>
			<img class="img-responsive"  src="<?php echo $this->module->assetsUrl; ?>/images/nosValeurs.png"/>
		<center>	
	</div>

	<div class="col-md-12" style="background-color:#293A46;color:white;padding-bottom:40px ">
		<div class="col-md-6 col-sm-12">
			<center>
				
				<div class="keysUsages">
					<i class="fa fa-caret-down" style="color:#fff;"></i><br/>
					<h1 class="homestead" style="color:#F6E200"><i class="fa fa-camera " ></i> USAGES</h1>
					<div class="space20"></div>
					<div class="buttonArea">
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainPeriscolaire" >Périscolaire</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainAssociatif" >Associatif</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainEconomie" > Economie</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainTerritoire" >Territoire</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainTourisme" > Tourisme</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainAlimentation" >Alimentation</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainAgriculture" > Agriculture</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainCulture" > Culture</a>
						<a class="keyword1 text-azure" href="javascript:;" data-id="explainEmploi" > Emploi</a>
					</div>
				</div>
				<div class="keywordExplain" style="margin-top:40px"></div>
			</center>
		</div>
		<div class="col-md-6 col-sm-12">
			<center>
				<div class="usageExplain"></div>
				<div class="keysKeyWords">
					<i class="fa fa-caret-down" style="color:#fff;"></i><br/>
					<h1 class="homestead" style="color:#F6E200"><i class="fa fa-key "></i> MOTS CLEFS</h1>
					<div class="space20"></div>
					<div class="buttonArea">
						<a class="keyword text-azure" href="javascript:;" data-id="explainCommunecter" > Communecter</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCommunecteur" > Communecteur</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainOpendata" > OpenData</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainDemoPart" > Démocratie participative</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainOpenSource" > OpenSource</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainProxicity" > Proxicité</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCodeLogiciel" > Code Logiciel</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCartographiedeReseau" > Cartographie de réseau</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainConnectedTerritory" > Territoire Connecté</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainLocalActors" > Acteurs locaux</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainLiveTogether" > Vivre ensemble</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCollabEco" > Economie collaborative</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCommons" > Biens communs</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCitoyens" > Citoyens</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainAssociation" > Association</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainSocietyNetwork" > Réseau sociétal</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCTK" > Citizen Tool Kit</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainCodeSocial" > Code Social</a>
						<a class="keyword text-azure" href="javascript:;" data-id="explainGlocal" > Glocal</a>
					</div>
				</div>
			</center>
		</div>
	</div>

	<div class="col-md-12" style="margin-bottom:40px ">
		
		<div class="col-md-6 col-sm-12">
			
			<center>
				<h1 class="homestead" style="color:#E33551"><i class="fa fa-user "></i> Un AMI</h1>
				<div class="space20"></div>
				<img class="img-responsive" style="height:150px;" src="<?php echo $this->module->assetsUrl; ?>/images/testamonials/simon.PNG"/>
				<br/>Sylvain Barbot
			</center>
		</div>
		<div class="col-md-6 col-sm-12">
			<center>
				<h1 class="homestead" style="color:#E33551"><i class="fa fa-comment-o "></i> Une Pensée</h1>
				<div class="space20"></div>
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</center>
		</div>
		
	</div>
	
	<hr>

	<div class="col-md-12" style="color:#293A46;padding-bottom:40px " >	
		<center>
			<i class="fa fa-caret-down" style="color:#fff"></i><br/>
			<h1 class="homestead"><i class="fa fa-map-marker headerIcon"></i><br/>CONTACT</h1>
			+ 262 692 38 32 58<br><a href="#">contact@pixelhumain.com</a>
			<ul class="social-list">
				<li><a target="_blank" href="https://www.facebook.com/groups/pixelhumain/" class="btn btn-facebook btn-social"><span class="fa fa-facebook"></span></a></li>
				<li><a target="_blank" href="https://twitter.com/communecter" class="btn btn-twitter btn-social"><span class="fa fa-twitter"></span></a></li>
				<li><a target="_blank" href="https://plus.google.com/communities/111483652487023091469" class="btn btn-google btn-social"><span class="fa fa-google-plus"></span> </a></li>
				<li><a target="_blank" href="https://github.com/pixelhumain/communecter" class="btn btn-github btn-social"><span class="fa fa-github"></span> </a></li>
			</ul>
		<center>	
	</div>

	

</div>


<script type="text/javascript">
jQuery(document).ready(function() {
	
	topMenuActivated = false;
	hideScrollTop = true; 
	checkScroll();
	
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>Bienvenue sur</span> <span class='text-red'>COMMUNE</span>CTER.Org");

	$('.tooltips').tooltip();

	$("#btn-param-postal-code").click(function(){
		$("#div-param-postal-code").show(400);
	});

	$('#searchBarPostalCode').keyup(function(e){
        startSearch();
    });
    
     $("#btn-geoloc-auto").click(function(e){
		if(geolocHTML5Done == false){
			$("#search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Géolocalisation en cours ...");		
    		initHTML5Localisation('prefillSearch');
		}
    	else{
    		$("#modal-select-scope").modal("show");
    	}
    });
    
    $(".explainLink").click(function() {  
		showDefinition( $(this).data("id") );
	});
    
    $(".keyword").click(function() { 
    	$(".keysUsages").hide();
    	link = "<br/><a href='javascript:;' class='showUsage homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Usages</a>";
    	$(".keywordExplain").html( $("."+$(this).data("id")).html()+link ).fadeIn(400);
    	 $(".showUsage").off().on("click",function() { $(".keywordExplain").slideUp(); $(".keysUsages").slideDown();}); 
    });

    $(".keyword1").click(function() { 
    	$(".keysKeyWords").hide();
    	link = "<br/><a href='javascript:;' class='showKeywords homestead yellow'><i class='fa fa-toggle-up' style='color:#fff'></i> Mots Clefs</a>";
    	$(".usageExplain").html( $("."+$(this).data("id")).html()+link ).slideDown();
    	 $(".showKeywords").off().on("click",function() { $(".usageExplain").slideUp(); $(".keysKeyWords").slideDown();}); 
    });

    
});

function openVideo(){
	var width = $(".imageSectionVideo").width();
	var height = $(".imageSectionVideo").height();
	console.log(width, height);
	$(".imageSectionVideo").empty();
	$(".imageSectionVideo").html('<iframe  class="img-responsive img-thumbnail" src="http://player.vimeo.com/video/133636468?api=1&title=0&amp;byline=0&amp;portrait=0&amp;color=57c0d4" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="video" aria-hidden="true" tabindex="-1"></iframe>')
	$("iframe").css("width", width);
	$("iframe").css("height", height);
}



var timeout = null;
function startSearch(){
	var name = $('#autoGeoPostalCode').val();
    var locality = $('#autoGeoPostalCode').val();

    name = name.replace(/[^\w\s']/gi, '');
    locality = locality.replace(/[^\w\s']/gi, '');

    //verification si c'est un nombre
    if(!isNaN(parseInt(locality))){
        if(locality.length == 0 || locality.length > 5) locality = "";
    }

    if(name.length>=3 || name.length == 0){
      clearTimeout(timeout);
      timeout = setTimeout('autoCompleteSearch("'+name+'", "'+locality+'")', 500);
    }else{
      
    }   
}


function autoCompleteSearch(name, locality){
    var data = {"name" : name, "locality" : locality, "searchType" : [ "cities" ]  };
    var countData = 0;
    var oneElement = null;
    $("#shortDetailsEntity").hide();
    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          error: function (data){
             console.log("error");
          	console.dir(data);
            
          },
          success: function(data){
          	console.log("success, try to load sig");
          	console.dir(data);
            if(!data){
              toastr.error(data.content);
            }else{

            $.each(data, function(i, v) {
	            if(v.length!=0){
	              $.each(v, function(k, o){
	              	oneElement = o;
	              	countData++;
	              });
	            }
	        });

	        if(countData == 0){
	        	$(".search-loader").html("<i class='fa fa-ban'></i> Aucun résultat");
	        }else{
	        	$(".search-loader").html("<i class='fa fa-check'></i> Code postal validé : "+locality+"  <br/>Vous êtes communecté !");
    			//$("#dropdown_search").show();
    			validatePostalcode(locality);
	        }

	      /*
          var mapElements = new Array();  	
          
          str = "<div class='col-md-12 center'>";
          str += "<h3 class='text-dark' style='margin-top:0px;'><i class='fa fa-angle-down fa-2x'></i><br/> Sélectionnez la commune recherchée ...</h3>";
          var city, postalCode = "";
          $.each(data, function(i, v) {
            var typeIco = i;
            var ico = mapIconTop["default"];
            var color = mapColorIconTop["default"];

            
            if(v.length!=0){
              $.each(v, function(k, o){

               mapElements.push(o);

				typeIco = o.type;
                ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
                
                htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
               	if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                  var htmlIco= "<img width='80' height='80' alt='image' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                }

                city="";

                var postalCode = o.cp
                if (o.address != null) {
                  city = o.address.addressLocality;
                  postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                }
                
                
                var id = getObjectId(o);
                var insee = o.insee ? o.insee : "";
                type = o.type;
                if(type=="citoyen") type = "person";
                var url = "javascript:"; //baseUrl+'/'+moduleId+ "/default/simple#" + o.type + ".detail.id." + id;
                var	onclick = 'validatePostalcode("'+o.cp+'");';
                var	onclickCp = 'validatePostalcode("'+o.cp+'");';
                var	target = "";
                

                var tags = "";
                if(typeof o.tags != "undefined" && o.tags != null){
					$.each(o.tags, function(key, value){
						if(value != "")
		                tags +=   "<span class='badge bg-red'>#" + value + "</span>";
		            });
                }

                var name = typeof o.name != "undefined" ? o.name : "";
                var postalCode = (typeof o.address != "undefined" &&
                				  typeof o.address.postalCode != "undefined") ? o.address.postalCode : "";
                
                if(postalCode == "") postalCode = typeof o.cp != "undefined" ? o.cp : "";
                var cityName = (typeof o.address != "undefined" &&
                				typeof o.address.addressLocality != "undefined") ? o.address.addressLocality : "";
                
                var fullLocality = postalCode + " " + cityName;

                var description = (typeof o.shortDescription != "undefined" &&
                					o.shortDescription != null) ? o.shortDescription : "";
                if(description == "") description = (typeof o.description != "undefined" &&
                									 o.description != null) ? o.description : "";
         
                var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;

                //template principal
                str += "<div class='searchEntity'>";
	     			target = "";
	                str += "<div class='entityRight bg-red badge'>";
	                	if(fullLocality != "" && fullLocality != " ")
	                	str += "<a href='"+url+"' onclick='"+onclickCp+"'"+target+"  class='entityLocality'><i class='fa fa-home'></i> " + fullLocality + "</a> ";
	                	str += "<a href='"+url+"' onclick='"+onclick+"'"+target+" class='entityName'>" + name + "</a> ";
	                	
	                str += "</div>";
	                					
				str += "</div>";

			
              })
            }

			

            }); 
			*/
			/*
            if(str == "") {
            	//$("#dropdown_search").html("");
            	$(".btn-start-search").html("<i class='fa fa-ban'></i>");
            	//$("#dropdown_search").css({"display" : "none" });	             
            }else{
            	//str += '<div class="col-md-5 no-padding" id="shortDetailsEntity"></div>';
            	str += '</div>';
	            $("#dropdown_search").html(str);
	            $(".btn-start-search").html("<i class='fa fa-search'></i>");
	            $("#dropdown_search").css({"display" : "inline" });
	           	$(".my-main-container").scrollTop(95);
	           	$("#link-start-search").html("Rechercher");
	            //$("#link-start-search").removeClass("badge");

	             if(countData == 1){
	            	console.log("only one");
	            	//$("#dropdown_search").css({"display" : "none" });
	            	//setScopeValue(oneElement.name, oneElement.insee);
	            }
	        }
	        $(".btn-start-search").removeClass("bg-azure");
    		//$(".btn-start-search").addClass("bg-dark");
    		*/
          }

          /*console.log("ALL MAP ELEMTN");
          console.dir(mapElements);
          Sig.showMapElements(Sig.map, mapElements);
          */

          
      }
    });

    str = "<i class='fa fa-circle-o-notch fa-spin'></i>";
    $(".btn-start-search").html(str);
    $(".btn-start-search").addClass("bg-azure");
    //$("#link-start-search").html("Recherche en cours ...");
    $(".btn-start-search").removeClass("bg-dark");
    $(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Recherche en cours ...");
    //$("#dropdown_search").css({"display" : "inline" });
                    
  }

  	function validatePostalcode(postalCode){
  		var path = "/";
		//console.log(location.hostname.indexOf("localhost") );
		//console.dir(location);
		if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";
	    console.log("mise à jour du cookie postalCode", path);
		$.cookie('postalCode',   postalCode,  { expires: 365, path: path });
		$("#div-discover").show(500);
		$(".my-main-container").animate({"scrollTop" : "840px"}, 1700);
  	}

	function setScopeValue(valText, insee){
		$("#searchBarPostalCode").val(valText);
		if(insee != "")
		  	showNewsStream(insee);
		else
			startSearch();
	}

</script>