<?php 
	$cs = Yii::app()->getClientScript();

	$cssAnsScriptFilesModule = array(
		//'js/svg/tonfichier.js'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

?>
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
/*#searchBarPostalCode{
	margin-top: 10px;
	width: 200px;
	margin-left: 0px;
	font-family: "homestead";
	font-size: 22px !important;
	border-radius: 3px !important;
	height: 40px;
}*/
/*input[type="text"].input-search:focus{
	/*border-color: #3C5665 !important;* /
	-moz-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	-webkit-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	-o-box-shadow: 0px 0px 5px -1px #CF3838 !important;
	box-shadow: 0px 0px 5px -1px #CF3838 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
}

#dropdown_search{
	margin-top:30px;
	margin-bottom:30px;
}*/

.btn-success.communected{
	width: 50%;
	margin-left: 25%;
	padding: 10px;
	border-radius: 20px;
	background-color:#5cb85c;
	color:white;
}
/*
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
}*/
.contact-map {	background:url(<?php echo $this->module->assetsUrl; ?>/images/people.jpg) bottom center repeat-x; background-size: 80%;background-color:#DFE7E9;  }
.headSection {	background:url(<?php echo $this->module->assetsUrl; ?>/images/1+1=3.jpg?c=c) bottom center no-repeat; background-size: 80%;background-color:#fff;  }
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
.information{
	font-size:15px;
	color:#8b91a0;
}


.btn-show-video{
	position:absolute;
	bottom:10px;
	right:40%;
}


#img-header{
	display:inline;
	max-height: 700px;
}

.videoWrapper {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
	display: none;
}
.videoWrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}

.flexContainer {
	display: flex;
	align-items: center;
    justify-content: center;
}

.explainLink {
	color: #e33551;
	text-decoration-line: underline !important;;
	text-decoration-style : dotted !important;;
}

.home_page h1{
	margin-top:5px;
}
</style>

<div class="home_page">

<div class="imageSection center-block imageSectionVideo" style="margin-top: 50px; text-align:center; cursor:pointer; position:relative;" onclick="openVideo()" >
	<div id="homeImg">
		<img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/1+1=3.jpg"/>
		<a href="javascript:;" onclick="openVideo()" class="btn-show-video"><i class="fa fa-youtube-play fa-5x"></i></a>
	</div>
	<div class="videoWrapper">
		<iframe width="560" height="349" src="https://player.vimeo.com/video/133636468?api=1&title=0&amp;byline=0&amp;portrait=0&amp;color=57c0d4" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="video" aria-hidden="true" tabindex="-1">
		</iframe>
	</div>
</div>

<!-- <div class="imageSection imageSectionVideo headSection" style="margin-top: 50px;height:600px; cursor:pointer; position:relative;" onclick="openVideo()" > -->

<!-- </div> -->
<?php /* ?>
	<h1 class="homestead text-dark text-center" id="main-title"
	style="font-size:25px;margin-bottom: 0px; margin-left: -112px;"><i class="fa fa-home"></i> Bienvenue <span class="text-red">sur</span></h1>

	<h1 class="homestead text-red no-margin text-center" id="main-title-communect"
		style="font-size:40px; margin-top:0px;">COMMUNE<span class="text-dark">CTER</span></h1>

	<h3 class="text-dark text-center no-margin subtitle">
		Un réseau social citoyen libre
	</h3>
*/?>
	<!-- <hr>  -->

	<!-- <h3 class="text-dark information center" style="margin-top:15px; ">
		<strong><span class="text-red">Communecter</span> c'est simple : un code postal et c'est parti !</strong><br/>
		Je suis communecté : j'ai accès à ma ville !<br/>
	</h3> -->

	<!-- <div class="col-md-6" style="text-align:right;">
		<button class="btn bg-red" id="btn-param-postal-code"><i class="fa fa-cog"></i> Paramétrer mon code postal</button><br/>

		<center class="" style="display:none;" id="div-param-postal-code">
			<i class="fa fa-2x fa-angle-right"></i>
			<input id="searchBarPostalCode" class="input-search text-red" style="margin-left:5px;" type="text" placeholder="...">
		</center>
	</div>
	<div class="col-md-6">
		<button class="btn bg-dark pull-left btn-geoloc-auto" id="btn-geoloc-auto"><i class="fa fa-crosshairs"></i> Localisez-moi automatiquement</button>
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
				<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'#default.directory'); ?>"
					target="_blank" class="btn btn-discover bg-azure">
					<i class="fa fa-connectdevelop"></i>
				</a><br/>L'annuaire<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
			</div>
			<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
				<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'#default.agenda'); ?>"
					target="_blank" class="btn btn-discover bg-azure">
					<i class="fa fa-calendar"></i>
				</a><br/>L'agenda<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
			</div>
			<div class="col-md-4 center text-azure" style="margin-bottom:10px; font-size:20px; font-weight: 300;">
				<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'#default.news'); ?>"
					target="_blank"
					class="btn btn-discover bg-azure">
					<i class="fa fa-rss"></i>
				</a><br/>L'actualité<br/><span class="text-red discover-subtitle">commune<span class="text-dark">cté</span></span>
			</div>
		</div>
	</div>

	<div class="col-md-12 no-padding" id="whySection" style="max-width:100%;">

		<div class="col-md-12 center" style="background-color:#394B59;width:100%;padding:1px 0px 1px 0%; ">
			<h1 class="homestead text-white">
				<i class="fa fa-question-circle fa-2x" style="color:white;"></i>
				 POUR QUI ? <br/> POUR QUOI FAIRE ?
			</h1>

		</div>

		<center>
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>
		<div class="col-sm-12 no-padding">
			<div class="col-sm-4 no-padding hidden-xs">
				<img class="img-responsive "  src="<?php echo $this->module->assetsUrl; ?>/images/bandeauKiss.jpg"/>
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large">POUR MOI ... CITOYEN !</span>
				<br/>
					<span class="text-azure">Déjà <?php echo $stats['global']['citoyens']['total']; ?> citoyens inscrits et <?php echo $stats['global']['projects']['total'] ?> projets référencés</span>
				<br/>
					Etre Acteur ! Participer à la vie de la cité, apprendre, échanger, découvrir ceux qui partagent les mêmes centres d'intérêt que moi.
					<span class="text-red">Créer de la valeur en participant au débat citoyen</span>, favoriser l'émergence d'autres possibles aujourd'hui pour demain.
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large">POUR LES ASSOCIATIONS</span>
				<br/>
					<span class="text-azure">Déjà <?php echo $stats['global']['organizations']['NGO']; ?> associations référencées</span>
				<br/>
					C'est un moyen fantastique de se faire connaitre et d'avoir un vraie visibilité.
					<span class="text-red">Recruter de nouveaux membres, trouver des ressources, de l'aide, promouvoir un évènement...</span>
					Economie solidaire, Fablabs, jardins partagés, biens communs. L'innovation sociale c'est aussi ça.
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large">POUR LES COMMUNES</span>
				<br/>
					<span class="text-azure">Retrouvez toutes les communes de France métropolitaine et des DOM-TOM</span>
				<br/>
					Donner du sens au mot <span class="text-red">lien social</span>, reconnaitre ses administrés, <span class="text-red">comprendre leurs attentes et leur donner les moyens de bâtir le futur</span>.
					Quand les citoyens communiquent et agissent librement en partenariat avec les collectivités.
					<span class="text-red">La ville est un organisme vivant</span> auquel nous pouvons tous nous connecter.
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large" >POUR LES ENTREPRISES</span>
				<br/>
					<span class="text-azure">Déjà <?php echo $stats['global']['organizations']['LocalBusiness']; ?> entreprises référencées</span>
				<br/>
				Etre un <span class="text-red">acteur local</span> au sens vrai du terme, <span class="text-red">se faire reconnaitre comme une ressource</span> en terme de services au citoyen
				avec un vrai respect de la qualité, quel que soit son métier.
				<span class="text-red">Donner de la visibilité à son activité</span> par la force et à la richesse de la plateforme Communecter.
			</div>

			<div class="col-sm-8 information">
				<br/>
				<span class="homestead text-dark text-extra-large" >UN Réseau pour tous</span>
				<br/>
					<span class="text-azure">Déjà <?php echo $stats['global']['events']['total']; ?> événements partagés</span>
				<br/>
					<span class="text-red">Communecter</span> réunit et fédère les principaux acteurs de la vie locale<br/>
					pour valoriser le territoire et le <span class="text-red">bien commun</span>.
			</div>

			<div class="col-md-8 col-sm-12 col-xs-12 pull-right">
				<img id="img-network-for-all" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/network-for-all.png"/>
			</div>

		</div>
	</div>

	<div class="col-md-12 no-padding" id="wwwSection" style="display: inline-block; max-width: 100%;">

		<div class="col-md-12" style="background-color:#394B59;width:100%;padding:8px 0px 3px 0%; ">

				<h1 class="homestead text-white center">
					<i class="fa fa-mobile fa-5x"></i> <i class="fa fa-tablet fa-5x"></i> <i class="fa fa-desktop fa-5x"></i><br/>
					World Wide Web<br/>Personnes et territoires
				</h1>
		</div>

		<center style="background-color:#fffff;">
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>

		<div class="col-md-12" style="background-color:#fffff;color:#293A46;padding-bottom:40px; float:left; width: 100%;">
			<div class="space20 hidden-xs"></div>
			<div class="col-md-6 col-sm-12 information" style="text-align: left; color:#3c5665";>

				En s'appuyant sur un <a href="javascript:;" data-id="explainSocietyNetwork" class="explainLink">réseau sociétal</a> (au service de la société) regroupant les acteurs d'un territoire,
				<a href="javascript:;" data-id="explainCommunecter" class="explainLink">"Communecter"</a> propose des outils numériques innovants et disponibles pour tous afin de créer ensemble
				un <a href="javascript:;" data-id="explainConnectedTerritory" class="explainLink">territoire connecté</a> qui nous ressemble.
				<br/>Tout cela gratuitement, dans le respect des données de chacun, car Communecter est un <a href="javascript:;" data-id="explainCommuns" class="explainLink">bien commun</a>
				fait pour et par chacun d’entre nous, porté par une association à but non lucratif.
				<br/><br/>
				Plus qu'une simple application Communecter se présente sous différentes formes :
				<ul class="information" style="font-weight: normal;">
				<li>Une projet <a href="javascript:;" data-id="explainOpenSource" class="explainLink">open source</a>
				<li>Une communauté riche et diversifiée</li>
				<li>Un site web qui vous tend les bras</li>
				<li>Une application mobile encore en cours </li>
				<li>Des interfaces tierces contribuant ou non à une base de donnée commune</li>
				<li>Des instances indépendantes mais inter-opérantes par leurs <a href="javascript:;" data-id="explainOpenSource" class="explainLink">sémantiques</a> communes </li>
				</ul>
			</div>
			<div class="col-md-6 col-sm-12 flexContainer">
				<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/screens.png"/>
			</div>
		</div>
	</div>

	<div class="col-md-12 no-padding" id="crowfundingSection" style="float:left;">
		<div class="col-md-12" style="background-color:#394B59;width:100%;padding:8px 0px 3px 0%; ">
			<h1 class="homestead text-white center"><i class="fa fa-users fa-2x"></i> CROWDFUNDING</h1>
		</div>

		<center style="background-color:#fff;">
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>
		<div class="col-md-12" style="background-color:#fff; color:#293A46;padding-bottom:40px;  float:left; ">
			<div class="space20 hidden-xs"></div>
			<div class="col-sm-12">
				<a href="http://www.kisskissbankbank.com/communecter--2" target="_blank">
					<img class="img-responsive pull-right" style="width: 60%; border:0px solid #293A46;margin:20px 0px 20px 20px; box-shadow: 0px 0px 4px 3px rgba(84, 82, 82, 0.5);" src="<?php echo $this->module->assetsUrl; ?>/images/crowdfunding.jpg"/>
				</a>

				<div class="information" style="text-align: left; color:#3c5665">
					Et oui ! Ces derniers temps, vous êtes très sollicités par des demandes d'aides ou de participation à des campagnes de <a href="javascript:;" data-id="explainFinancementParticipatif" class="explainLink">financement participatif</a>.
					<br/><span class="text-red">Vous vous demandez pourquoi ?</span> L'état se désengage du financement du milieu associatif. Les mouvements citoyens s'intensifient et prennent de l'ampleur mais se heurtent au nerf de la guerre : où trouver l'argent pour aller plus loin?
					<br/>Pour <span class="text-red">rester indépendant, citoyen et libre, le réseau sociétal Communecter </span>recherche un moyen de financement qui lui correspond le plus. Quoi de plus naturel alors que de se tourner vers ceux qui s'en serviront le plus.
					<br/>A l'heure du numérique et du par-tout-le-temps connecté, nous croyons que la <span class="text-red">démocratie participative et la participation citoyenne</span> sont conditionnées par la construction d'un outil simple et à destination de tous.
					<br/>Dans le contexte actuel, difficile de demander aux collectivités de financer cet outil qui, pensent-elles, risque de leur faire perdre une partie de leur pouvoir.
					<br/>C'est donc vers les citoyens (vers vous) que nous nous tournons : <span class="text-red">participez à la construction de ce projet innovant</span> en choisissant votre contrepartie !
					<?php /* ?>
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
					*/?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 no-padding" id="valueSection" style="width:100%; float:left;">
		<div class="col-md-12" style="background-color:#92BE1F;width:100%;padding:8px 0px 3px 0%;">
			<h1 class="homestead text-white center"><a href="http://www.kisskissbankbank.com/fr/projects/communecter-se-connecter-a-sa-commune/contributors" target="_blank"  class="text-dark">ILS NOUS SOUTIENNENT <i class="fa fa-child fa-2x"></i></h1>
		</div>
		<div class="col-md-12" style="background-color:#fff;width:100%;padding:8px 0px 3px 0%;">
			<h1 class="homestead center"><a href="javascript:loadByHash('#default.view.page.crowdfunding')"  class="text-dark">Aidez Nous</a> réussir la campagne <i class="fa fa-diamond fa-2x"></i></h1>
		</div>
		<center>
			<i class="fa fa-caret-down" style="color:#fff;"></i><br/>
		</center>

		<div class="col-md-12" style="background-color:#394B59;width:100%;padding:8px 0px 3px 0%;">
			<h1 class="homestead text-white center"><i class="fa fa-heart fa-2x"></i> NOS VALEURS</h1>
		</div>

		<center>
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>

            <div class=" col-md-12" style="text-align:center; margin-bottom:24px;">
                <div class=" col-md-1"></div>
                <div class=" col-md-2" style="text-align:center;"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur01.png"/>Open Source</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur02.png"/>Pas de PUB</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur03.png"/>Données Protégées</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur04.png"/>Informations Partagées</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur05.png"/>Linked Data</div>
            </div>
            <div class=" col-md-12 homestead" style="text-align:center;">
                 <div class=" col-md-1"></div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur06.png"/>Territoire Connecté</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur07.png"/>Inteligence Collective</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur08.png"/>Gratuit</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur09.png"/>Société 2.2.main</div>
                <div class=" col-md-2"><img class="img-responsive" style="margin:0 auto;" src="<?php echo $this->module->assetsUrl; ?>/images/home/valeurs/valeur03.png"/>Biens Communs</div>
            </div>
            <div class="space20"></div>
	</div>

	
	<div class="col-sm-12 no-padding" style="background-color:#fff; max-width:100%; float:left;">
		<div class="col-md-12" style="background-color:#293A46;width:100%;padding:8px 0px 8px 0%;">
			<h1 class="homestead center text-white"><a href="javascript:loadByHash('#default.view.page.explain')">Comprendre</a> les gros Mots <i class="fa fa-book fa-2x"></i></h1>
		</div>
		<center>
			<i class="fa fa-caret-down" style="color:#293A46;"></i><br/>
		</center>

		<div class="col-sm-6 col-xs-12 ">
			<center>
				<h1 class="homestead" style="color:#E33551"><i class="fa fa-user "></i> Un AMI</h1>
				<div class="space20"></div>

				<div class="col-sm-12">  
					<a href="javascript:showPeopleTalk(-1);"><i class="nextPerson fa fa-caret-left  fa-5x" style="color:#DFE7E9;margin-right: 20px;"></i></a>
					<img class="img-responsive img-thumbnail peopleTalkImg" style="height:200px;cursor:pointer;" src="" onclick="showPeopleTalk();"/>
					<a href="javascript:showPeopleTalk();"><i class="prevPerson fa fa-caret-right fa-5x" style="color:#DFE7E9;margin-left: 20px;"></i></a>
				</div>
				<div class="space20"></div>
				<span class="peopleTalkName text-extra-large"></span>
				<br/>
				<span class="peopleTalkProject text-extra-large"></span>
			</center>
		</div>
		<div class="col-sm-6 col-xs-12 ">
			<center>
				<h1 class="homestead" style="color:#E33551"><i class="fa fa-comment-o "></i> Une Pensée</h1>
				<div class="space20"></div>
				<div class="text-extra-large peopleTalkComment"></div>
			</center>
		</div>
		<div class="space20"></div>
	</div>

	<div class="col-sm-12 no-padding" style="background-color:#E33551; max-width:100%; float:left;" id="teamSection">
		<div class="col-md-12" style="background-color:#293A46;width:100%;padding:8px 0px 8px 0%;">
			<h1 class="homestead center text-white"><a href="javascript:loadByHash('#default.view.page.partners')">Partenaires & Contributeurs</a> <i class="fa fa-share-alt fa-2x"></i></h1>
		</div>
		<center>
			<i class="fa fa-caret-down" style="color:#293A46;"></i><br/>
		</center>
		<center>
			<i class="fa fa-caret-down" style="color:#fff"></i><br/>
			<h1 class="homestead" style="color:#fff"><i class="fa fa-users headerIcon"></i><br/>Construction collaborative</h1>
			<div class="col-sm-12 text-white">
				Nous sommes en amélioration continue, cette plateforme est open source et construite de façon collaborative.
				<h3 class="homestead">Rejoignez nous : </h3>

				<a href="javascript:loadByHash('#showTagOnMap.tag.developpeur')" data-id="explainDeveloper"  class="btn btn-default text-bold">Développeurs</a>
				<a href="javascript:showTagOnMap ('#communecteur')" data-id="explainCommunecteur" class=" btn btn-default text-bold">Communecteurs</a>
				<a href="javascript:showTagOnMap ('#editeur')" data-id="explainEditor" class=" btn btn-default text-bold">Editeurs </a>
				<a href="javascript:showTagOnMap ('#designeur')" data-id="explainDesigner" class=" btn btn-default text-bold">Designeur </a>
				<a href="javascript:showTagOnMap ('#contributeur')" data-id="explainContributor" class=" btn btn-default text-bold">Contributeurs</a>
				<div class="space20"></div>
				<a href="javascript:loadByHash('#organization.detail.id.<?php echo Yii::app()->params['openatlasId'] ?>');" class=" btn btn-default text-bold">Association Open Atlas</a>
				<a href="javascript:loadByHash('#project.detail.id.<?php echo Yii::app()->params['communecterId'] ?>')"  class="btn btn-default text-bold">Projet Communecter</a>
			</div>
		</center>
		<div class="space20"></div>
	</div>

	<div class="col-md-12 contact-map" style="color:#293A46;padding-bottom:75px; float:left; width:100%;" id="contactSection">
		<center>
			<i class="fa fa-caret-down" style="color:#E33551"></i><br/>
			<h1 class="homestead"><i class="fa fa-map-marker headerIcon"></i><br/>CONTACT</h1>
			+ 262 262 34 36 86<br><a href="#">contact@pixelhumain.com</a>

			<ul class="social-list">
				<li><a target="_blank" href="https://www.facebook.com/communecter" class="btn btn-facebook btn-social"><span class="fa fa-facebook"></span></a></li>
				<li><a target="_blank" href="https://twitter.com/communecter" class="btn btn-twitter btn-social"><span class="fa fa-twitter"></span></a></li>
				<li><a target="_blank" href="https://plus.google.com/communities/111483652487023091469" class="btn btn-google btn-social"><span class="fa fa-google-plus"></span> </a></li>
				<li><a target="_blank" href="https://github.com/pixelhumain/communecter" class="btn btn-github btn-social"><span class="fa fa-github"></span> </a></li>
			</ul>

			<a href="javascript:;" data-id="explainOpenAtlas" class="explainLink">L'association Open Atlas</a>
			<br/><a href="javascript:loadByHash('#default.view.page.mention');" >Mentions Légales</a>
		<center>
	</div>
</div>


<script type="text/javascript">

<?php $this->renderPartial("peopleTalk"); ?>
var peopleTalkCt = 0;
jQuery(document).ready(function() {

	topMenuActivated = false;
	hideScrollTop = true;
	checkScroll();

	peopleTalkCt = getRandomInt(0,peopleTalk.length);
	showPeopleTalk();

	setTimeout(function(){ $("#input-communexion").hide(300); }, 300);

	$(".moduleLabel").html("<span class='text-red'>COMMUNE</span>CTER.org");

	$('.tooltips').tooltip();

	$("#btn-param-postal-code").click(function(){
		$("#div-param-postal-code").show(400);
	});

	// $('#searchBarPostalCode').keyup(function(e){
 //        clearTimeout(timeoutSearchHome);
 //        timeoutSearchHome = setTimeout(function(){ startSearch(); }, 800);
 //    });


    $(".explainLink").click(function() {
	    $(".removeExplanation").parent().hide();
		showDefinition( $(this).data("id") );
		return false;
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
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function showPeopleTalk(step)
{
	if(!step)
		step = 1;
	peopleTalkCt = peopleTalkCt+step;
	if( undefined == peopleTalk[ peopleTalkCt ]  )
		peopleTalkCt = 0;
	person = peopleTalk[ peopleTalkCt ];
	$(".peopleTalkName").html( person.name );
	$(".peopleTalkImg").attr("src",person.image);
	$(".peopleTalkComment").html("<i class='fa fa-quote-left'></i> "+person.comment+"<i class='fa fa-quote-right'></i> ");
	$(".peopleTalkProject").html( "<a target='_blank' href='"+person.url+"'>"+person.project+"</a>" );

}

function openVideo(){
	$("#homeImg").fadeOut("slow",function() {
		$(".videoWrapper").fadeIn('slow');
	});
}

var timeoutSearchHome = null;

function showTagOnMap (tag) {

	console.log("showTagOnMap",tag);

	var data = { 	 "name" : tag,
		 			 "locality" : "",
		 			 "searchType" : [ "persons" ],
		 			 //"searchBy" : "INSEE",
            		 "indexMin" : 0,
            		 "indexMax" : 500
            		};

        //$(".moduleLabel").html("<i class='fa fa-spin fa-circle-o-notch'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");

		$.blockUI({
			message : "<h1 class='homestead text-red'><i class='fa fa-spin fa-circle-o-notch'></i> Recherches des collaborateurs ...</h1>"
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
	            	//$(".moduleLabel").html("<i class='fa fa-connect-develop'></i> Les acteurs locaux : <span class='text-red'>" + cityNameCommunexion + ", " + cpCommunexion + "</span>");
					//$(".search-loader").html("<i class='fa fa-check'></i> Vous êtes communecté : " + cityNameCommunexion + ', ' + cpCommunexion);
					//toastr.success('Vous êtes communecté !<br/>' + cityNameCommunexion + ', ' + cpCommunexion);
					$.unblockUI();
	            }
	          }
	 	});

	//loadByHash('#project.detail.id.56c1a474f6ca47a8378b45ef',null,true);
	//Sig.showFilterOnMap(tag);
}
</script>
