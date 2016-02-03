

<style>
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

		.home_page #img-video-communecter{
			/*max-height: 440px;*/
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
</style>

<div class="home_page">

<?php if(!isset( Yii::app()->session['userId'] )) { ?>
	<div class="menu-home-btn-ins text-right">
		<button class="btn-top btn btn-success" style="margin-bottom:5px;" onclick="showPanel('box-register');"><i class="fa fa-plus-circle"></i> S'inscrire</button>
		</br><button class="btn-top btn bg-red" onclick="showPanel('box-login');"><i class="fa fa-sign-in"></i> Se connecter</button>
	</div>
<?php }else{
		$this->renderPartial("short_info_profil", array("type" => "main")); 
	}
?> 


	<center>
		<img id="main-logo-home" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/main-logo-home2.png"/></br>
	</center>

	
	<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-home"></i> Bienvenue <span class="text-red">sur</span></h1>

	<h1 class="homestead text-red no-margin text-center" id="main-title-communect"
		style="font-size:40px; margin-top:0px;">COMMUNE<span class="text-dark">CTER</span></h1>

	<h3 class="text-dark text-center no-margin subtitle">
		Le réseau social citoyen libre 
		<a href="/ph/vitrine" target="_blank"><img id="" class="" src="<?php echo $this->module->assetsUrl; ?>/images/byPH.png"/></a>
	</h3>


	<h2 class="center text-dark" style="margin-bottom:20px; margin-top:30px;">
		<i class="fa fa-2x fa-angle-down"></i></br>
		Découvrir
	</h2>

	<div class="col-md-12" style="margin-bottom:40px">
		<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
			<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/search#search.directory'); ?>" 
				target="_blank" class="btn btn-discover bg-azure">
				<i class="fa fa-connectdevelop"></i>
			</a></br>L'annuaire</br><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
		</div>
		<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
			<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/search#search.agenda'); ?>" 
				target="_blank" class="btn btn-discover bg-azure">
				<i class="fa fa-calendar"></i>
			</a></br>L'agenda</br><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
		</div>
		<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
			<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/search#search.news'); ?>" 
				target="_blank" 
				class="btn btn-discover bg-azure">
				<i class="fa fa-rss"></i>
			</a></br>L'actualité</br><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
		</div>
	</div>

	<h3 class="text-dark information center" style="margin-top:30px; ">
		<i class="fa fa-2x fa-angle-down"></i></br>
		<strong><span class="text-red">Communecter</span> c'est simple : un email, un code postal et c'est parti !</strong></br>
		Je suis communecté : j'ai accès à ma ville et à tout mon réseau !
	</h3>

	
	
	<div class="section-content section-no-top-padding section-video">
		<div class="textProjectSlider">
		</div>
		<div class="imageSection imageSectionVideo text-center">
			<img id="img-video-communecter" class="img-responsive img-thumbnail" src="<?php echo $this->module->assetsUrl; ?>/images/video2.jpg" onclick="openVideo()"/>
		</div>
	</div>

	


	<div class="col-md-10 col-md-offset-1">
		<h3 class="text-dark information center" style="margin-bottom:20px; padding-left:10px; font-weight:500;">
			<i class="fa fa-2x fa-angle-down"></i></br>
			Quelques exemples d’actions concrètes réalisables grace à <span class="text-red">Communecter.org</span> : 
		</h3>
		<div class="row">
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Périscolaire :</strong></span></br> Outils d’informations pour découvrir et utiliser les activités périscolaires locales</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Associatif :</strong></span></br> Donner aux associations une vitrine et un outil de valorisation de leurs actions. Utiliser un outil de cartographie des compétence au sein d’un groupe ...</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Economie :</strong></span></br> Référencement des entreprises et des compétences locales. La valorisation des circuits courts de distribution favorise l'économie locale ...</div>
		</div>
		<div class="row">
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Territoire :</strong></span></br> Cartographie des compétences, des ressources, des projets, des acteurs d’un territoire, d’un groupe, d’une association ou d’une entreprise ...</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Tourisme :</strong></span></br> Les habitants d’une commune sont ceux qui la connaissent et la valorisent le mieux ...</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Alimentation :</strong></span></br> Liens étroits avec les associations locales (permaculture…), créations de projets de fermes pédagogiques ...</div>
		</div>
		<div class="row">
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Agriculture :</strong></span></br> Mise en évidence des producteurs locaux, potager à la maison, création de projets de maraîchages collectifs / jardins participatifs ...</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Culture :</strong></span></br> Partage d'information sur l'animation du territoire, création d'événements, échange de services (ex : cours de guitare contre des cours de chant) ...</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Emploi :</strong></span></br> Identification des manques d’offre de services pour favoriser des initiatives pouvant déboucher sur  des d'emplois et d'entreprises ...</div>
		</div>
		<div class="row">
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Transport :</strong></span></br> Facilitateur de  covoiturage, changements de comportements, débats sur les transports et recueil des besoins des administrés ...</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Logement :</strong></span></br> Service d'annonces interactives, recueil des besoins des administrés, interactions avec les collectivités locales, débats citoyens agrégés ...</div>
			<div class="col-md-4 list-action text-dark"><span class="text-azure"><strong><i class="fa fa-circle"></i> Énergie :</strong></span></br> Sensibilisation à la dépense énergétique, consommation produits HQE, partage d'information, débats sur la consommation plus durable / biens énergivores et non durables …</div>
		</div>
	</div>

	<div class="col-md-12" style="margin-bottom:40px">
		<h2 class="center text-dark">
			<i class="fa fa-2x fa-angle-down"></i></br>
			Un réseau pour tous !
		</h2>

		<h3 class="text-dark information center" style="margin-bottom:20px; padding-left:10px; font-weight:500;">
			<span class="text-red">Communecter</span> réunit et fédère les principaux acteurs de la vie locale</br>
			pour valoriser le territoire et le bien commun.  
		</h3>

		<center><img id="img-network-for-all" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/network-for-all.png"/></center>
	</div>

	<?php if(!isset(Yii::app()->session['userId'])){ ?>
	<div class="col-lg-6 col-md-12" style="margin-bottom:20px">
		<h2 class="center text-dark">
			<i class="fa fa-2x fa-angle-down"></i></br>
			<button class="btn btn-lg btn-register btn-success" style="border-radius:30px;"><i class="fa fa-plus-circle"></i> S'inscrire</button>
		</h2>
		<h3 class="text-dark information center" style="margin-bottom:20px; padding-left:10px; font-weight:300;">
			Vous êtes un <strong>citoyen, une association, une collectivité, une entreprise</strong> ?</br>
			Vous rêvez d'un territoire <strong>connecté, interactif et dynamique</strong> ?</br>
			Le réseau <span class="text-red"><strong>Communecter</strong></span> est fait pour vous !
		</h3>
	</div>
	<?php } ?>

	<div class="col-lg-6 col-md-12" style="margin-bottom:40px">
		<h2 class="center text-dark">
			<i class="fa fa-2x fa-angle-down"></i></br>
			<a href="/ph/vitrine" target="_blank"><img id="" class="" src="<?php echo $this->module->assetsUrl; ?>/images/byPH.png"/></a>
		</h2>

		<h3 class="text-dark information center" style="margin-bottom:20px; padding-left:10px; font-weight:500;">
			<a href="/ph/vitrine" target="_blank" class="text-red">Pixel Humain</a> est un collectif qui regroupe des acteurs réunionnais
et métropolitains partageant les valeurs d'open innovation et de partage, pour le bien commun.</br></br>
			<a href="/ph/vitrine" target="_blank" class="text-red btn btn-default">En savoir <i class="fa fa-plus-circle"></i></a> 
		</h3>
	</div>

</div>


<script type="text/javascript">
jQuery(document).ready(function() {
	
	topMenuActivated = false;
	hideScrollTop = true; 
	checkScroll();
	
	$(".moduleLabel").html("<i class='fa fa-connectdevelop'></i> <span id='main-title-menu'>Bienvenue sur</span> <span class='text-red'>COMMUNE</span>CTER.Org");

	$('.tooltips').tooltip();
    
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

</script>