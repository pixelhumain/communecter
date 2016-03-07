

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
.crowfundingSection{
	width:100%;
}
</style>

<div class="home_page">

	<div class="imageSection center-block imageSectionVideo" style="margin-top: 50px; text-align:center; cursor:pointer; position:relative;" onclick="openVideo()" >
		<div id="homeImg">
			<img id="img-header" class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/crowdfunding.jpg"/>
		</div>
		<div class="videoWrapper">
			<iframe width="560" height="349" src="https://player.vimeo.com/video/133636468?api=1&title=0&amp;byline=0&amp;portrait=0&amp;color=57c0d4" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen class="video" aria-hidden="true" tabindex="-1">
			</iframe>
		</div>
	</div>

	<div class="col-md-12 no-padding crowfundingSection" style="float:left;">
		<div class="col-md-12" style="background-color:#394B59;width:100%;padding:0px 0px 3px 0%; ">
			<h1 class="homestead text-white center"><i class="fa fa-users fa-2x"></i> CROWDFUNDING</h1>
		</div>
		<center>
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>

		<div class="col-md-12" style="color:#293A46;padding-bottom:40px;  float:left; ">
			<div class="space20 hidden-xs"></div>
			<div class="col-sm-12">
				<div class="information" style="text-align: left; color:#3c5665">
					Et oui ! Ces derniers temps, vous êtes très sollicités par des demandes d'aides ou de participation à des campagnes de <a href="javascript:;" data-id="explainFinancementParticipatif" class="explainLink">financement participatif</a>.
					<br/><span class="text-red">Vous vous demandez pourquoi ?</span> L'état se désengage du financement du milieu associatif. Les mouvements citoyens s'intensifient et prennent de l'ampleur mais se heurtent au nerf de la guerre : où trouver l'argent pour aller plus loin?
					<br/>Pour <span class="text-red">rester indépendant, citoyen et libre, le réseau sociétal Communecter </span>recherche un moyen de financement qui lui correspond le plus. Quoi de plus naturel alors que de se tourner vers ceux qui s'en serviront le plus.
					<br/>A l'heure du numérique et du par-tout-le-temps connecté, nous croyons que la <span class="text-red">démocratie participative et la participation citoyenne</span> est conditionnée par la construction d'un outil simple et à destination de tous.
					<br/>Dans le contexte actuel, difficile de demander aux collectivités de financer cet outil qui, pensent-elles, risque de leur faire perdre une partie de leur pouvoir.
					<br/>C'est donc vers les citoyens (vers vous) que nous nous tournons : <span class="text-red">participez à la construction de ce projet innovant</span> en choisissant votre contrepartie !
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 no-padding crowfundingSection" style="float:left;">
		<div class="col-md-12 no-padding" style="width:100%; float:left;">
			<div class="col-md-12" style="background-color:#E33551;width:100%;padding:0px 0px 3px 0%;">
				<h1 class="homestead text-white center"><i class="fa fa-share-alt fa-2x"></i> Devenez Crowdfunder</h1>
			</div>
		</div>
		<center>
			<i class="fa fa-caret-down" style="color:#E33551;"></i><br/>
		</center>
	
		<div class="col-md-12" style="color:#293A46;padding-bottom:40px;  float:left; ">
			<div class="space20 hidden-xs"></div>
			<div class="col-sm-12">
				<div class="information" style="text-align: left; color:#3c5665">
					Vous pouvez contribuer au financement participatif mais aussi permettre de distribuer massivement 
					la campagne autour de vous dans vos reseaux. 
					<br/> Si ca vous interresse, vous etes au bon endroit
					<br/> Voici votre cocktail de Crowdfunder actif :  
					<ul style="list-style: none">
						<li><i class="fa fa-angle-right"></i> voici le <a href="http://www.kisskissbankbank.com/fr/projects/communecter-se-connecter-a-sa-commune" target="_blank">lien vers la campagne</a></li>
						<li><i class="fa fa-angle-right"></i> Vous trouverez toutes <b>les documentations</b> décrivant le projet <a href="javascript:;" data-id="explainCommunectorDocs" class="explainLink text-red"><i class="fa fa-upload"></i></a> </li>
						<li><i class="fa fa-angle-right"></i> <b>parlez en</b> autour de vous</li>
						<li><i class="fa fa-angle-right"></i> Tous les matins demandez vous à qui vous n'avez pas <b>transmis la campagne</b></li>
						<li><i class="fa fa-angle-right"></i> <b>Tous les moyens sont bons</b> les rencontres, le téléphone, le fax, le pigeon voyageur, les sms, le courier, les chuchottements doux a l'oreilles</li>
						<li><i class="fa fa-angle-right"></i> Noté votre liste de contact, et relancer au besoin, <b>la campagne dure que 45j</b></li>
						<li><i class="fa fa-angle-right"></i> faite des <a href="javascript:;" data-id="explainMOAC" class="explainLink text-red">MOAC</a> : Massifs Offline ou Online Apéros Citoyens</li>
						<li><i class="fa fa-angle-right"></i> <b>relayer massivement</b> la campagne sur reseau sociaux FaceBook, Twitter, LinkedIn, Ello,...</li>
						<li><i class="fa fa-angle-right"></i> faite des <b>mailing personnaliser</b> avec des <a href="javascript:;" data-id="explainCrowdfundingLetters" class="explainLink text-red">lettres type</a></li>
						<li><i class="fa fa-angle-right"></i> Partagez votre motivation avec les membres de la pages et du groupe</li>
						<li><i class="fa fa-angle-right"></i> soyez créatif et partagez vos idées avec <a href="https://www.facebook.com/groups/1706464852909714/" target="_blank"> vos amis communecteurs</a> </li>
						<li><i class="fa fa-angle-right"></i> partagez aussi vos retours d'experiences et les avis recoltés</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 no-padding crowfundingSection" style="float:left;">
		<div class="col-md-12 no-padding" style="width:100%; float:left;">
			<div class="col-md-12" style="background-color:#92BE1F;width:100%;padding:0px 0px 3px 0%;">
				<h1 class="homestead text-white center"><i class="fa fa-clock-o  fa-2x"></i> Les étapes de la campagne</h1>
			</div>
		</div>
		<center>
			<i class="fa fa-caret-down" style="color:#92BE1F;"></i><br/>
		</center>
	
		<div class="col-md-12" style="color:#293A46;padding-bottom:40px;  float:left; ">
			<div class="space20 hidden-xs"></div>
			<div class="col-sm-12">
				<div class="information" style="text-align: left; color:#3c5665">
					Une campagne, c'est un rythme soutenu de communication, de transmission...
					<ul style="list-style: none">
						<li><i class="fa fa-angle-right"></i> <b>ETAPE 1 PENDANT 48 HEURES</b>
							<br/>Contributeurs actifs sur le projet + Communecteurs 
							<br/>Famille et amis du groupe porteur de projet : on donne (on demande de ne pas relayer)
						</li>
						<li><i class="fa fa-angle-right"></i> <b>ETAPE 2 PENDANT 48 HEURES de plus</b>
						<br/>Familles et amis des Communecteurs : on demande à sa famille et amis de donner
						</li>
						<li><i class="fa fa-angle-right"></i> <b>ETAPE 3 COMMUNICATION MASSIVE ET VIRALE</b>
						<br/> Tous les réseaux sociaux
						<br/> Mailing massif
						<br/> Telephone 24/24 7/7 
						<br/> SMS dans tous les sens 
						<br/> tous les communecteur solicités
						<br/> Modèle de communication distribué et massif et concentré
						<br/> 45 jours sans relache
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 contact-map" style="color:#293A46;padding-bottom:75px; float:left; width:100%;" id="contactSection">	
		<center>
			<i class="fa fa-caret-down" style="color:#fff"></i>
			<br/>
			<h1 class="homestead"><i class="fa fa-tty headerIcon"></i><br/>CONTACT PERSONNALISé</h1>
			0262 34 36 86<br><a href="#">contact@pixelhumain.com</a>

			<ul class="social-list">
				<li><a target="_blank" href="https://www.facebook.com/communecter" class="btn btn-facebook btn-social"><span class="fa fa-facebook"></span></a></li>
				<li><a target="_blank" href="https://twitter.com/communecter" class="btn btn-twitter btn-social"><span class="fa fa-twitter"></span></a></li>
				<li><a target="_blank" href="https://plus.google.com/communities/111483652487023091469" class="btn btn-google btn-social"><span class="fa fa-google-plus"></span> </a></li>
				<li><a target="_blank" href="https://github.com/pixelhumain/communecter" class="btn btn-github btn-social"><span class="fa fa-github"></span> </a></li>
			</ul>

			<a href="javascript:;" data-id="explainOpenAtlas" class="explainLink">L'association Open Atlas</a>
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

</script>