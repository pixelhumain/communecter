
<div class="panel-heading border-light center text-dark partition-white radius-10">
    <span class=" text-red homestead tpl_title"> SmarTerre</span>
    <br/>
    <span class="tpl_shortDesc">Territoire Intelligent ouvert, connecté et Experimental <br/>Territoire coopération et transitions </span>
</div>

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

.btn-success.communected{
	width: 50%;
	margin-left: 25%;
	padding: 10px;
	border-radius: 20px;
	background-color:#5cb85c;
	color:white;
}
.contact-map {	background:url(<?php echo $this->module->assetsUrl; ?>/images/people.jpg) bottom center repeat-x; background-size: 80%;background-color:#DFE7E9;  }
.fa-caret-down{font-size:56px;line-height: 10px;}
</style>

<div class="home_page">

	<div class="imageSection center-block imageSectionVideo" style="margin-top: 50px; text-align:center; cursor:pointer; position:relative;" onclick="openVideo()" >
		<div id="homeImg">
			<img src="<?php echo $this->module->assetsUrl; ?>/images/docs/comprendre/smarterre.png"" class="col-sm-12 img-responsive ">
		</div>
		
	</div>

	<div id="dropdown_search" class="col-md-12">

	</div>

	<div class="col-md-12 no-padding" id="whySection" style="max-width:100%;">

		<div class="col-md-12 center" style="background-color:#394B59;width:100%;padding:1px 0px 1px 0%; ">
			<h1 class="homestead text-white">
				<i class="fa fa-question-circle fa-2x" style="color:white;"></i>
				 Territoire ? <br/> Experimental ?
			</h1>

		</div>

		<center>
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>
		<div class="col-sm-12 no-padding">
			<div class="panel-body">
		        <ul class="points">
		        	<li><i class='fa fa-arrow-right'></i> Comment développer une culture partagée qui gagne en visibilité, qui décloisonne et soit reconnue comme un moteur du développement local et des solidarités ?</li>
					<li><i class='fa fa-arrow-right'></i> Quelles nouvelles relations entre acteurs et décideurs ?</li>
					<li><i class='fa fa-arrow-right'></i> Quel rôle donner à une culture du partage et des communs ?</li>
					<li><i class='fa fa-arrow-right'></i> C’est pour échanger autour de ces questions et co-construire des éléments de réponse que nous vous proposons de participer à la session Territoire coopération et transitions  </li>
		        	
		        </ul>
		    </div>
		</div>
	</div>

	<div class="col-md-12 no-padding" id="wwwSection" style="display: inline-block; max-width: 100%;">

		<div class="col-md-12" style="background-color:#394B59;width:100%;padding:8px 0px 3px 0%; ">

				<h1 class="homestead text-white center"><i class="fa fa-users fa-2x"></i>
					Personnes et territoires
				</h1>
		</div>

		<center style="background-color:#fffff;">
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>

		<div class="col-md-12" style="background-color:#fffff;color:#293A46;padding-bottom:40px; float:left; width: 100%;">
			<div class="space20 hidden-xs"></div>
			<div class="panel-body">
		        <ul class="points">
		        	<li><i class='fa fa-arrow-right'></i> Introduire un vrai reseau social citoyen sur internet  </li>
		        	<li><i class='fa fa-arrow-right'></i> Pour faciliter et creer du lien </li>
					<li><i class='fa fa-arrow-right'></i> Revaloriser les dechets </li>
					<li><i class='fa fa-arrow-right'></i> Economie Collaborative</li>
					<li><i class='fa fa-arrow-right'></i> Open Source et Open data</li>
					<li><i class='fa fa-arrow-right'></i> Simplifier le Do it yourself</li>
					<li><i class='fa fa-arrow-right'></i>Transparence et acces a l'information</li>
					<li><i class='fa fa-arrow-right'></i>citoyen contributeur au flux et revalorisation locale</li>
					<li><i class='fa fa-arrow-right'></i> des solutions au manque de budget</li>
					<li><i class='fa fa-arrow-right'></i>Creer une vraie economie locale</li>
					<li><i class='fa fa-arrow-right'></i>Guide de connaissances Ultra Locales</li>
					<li><i class='fa fa-arrow-right'></i>city indicateur </li>
		        </ul>
		    </div>
	</div>
	

	<div class="col-md-12 no-padding" id="valueSection" style="width:100%; float:left;">
		
		<div class="col-md-12" style="background-color:#394B59;width:100%;padding:8px 0px 3px 0%;">
			<a href="#default.view.page.index.dir.docs" class="lbh ">
				<h1 class="homestead text-white center">
					<i class="fa fa-book fa-2x"></i> Coopération et Transition
				</h1>
			</a>
		</div>

		<center>
			<i class="fa fa-caret-down" style="color:#394B59;"></i><br/>
		</center>
			
        <div class="panel-body">
							
	        <ul class="points">
	        	<li><i class='fa fa-arrow-right'></i> Faire des ateliers, des assemblées, des conseils citoyens locaux </li>
				<li><i class='fa fa-arrow-right'></i> Repéré des objectifs tangibles</li>
				<li><i class='fa fa-arrow-right'></i> Créer une vraie dynamique trans thématique collaborative territoriale </li>
				<li><i class='fa fa-arrow-right'></i> Pousser les acteurs locaux au partage</li>
	        </ul>
	    </div>
        <div class="space20"></div>
	</div>

	<div class="col-sm-12 no-padding" style="background-color:#E33551; max-width:100%; float:left;" id="teamSection">
		<div class="col-md-12" style="background-color:#E33551;width:100%;padding:8px 0px 8px 0%;">
			<h1 class="homestead center text-white"> <i class="fa fa-share-alt fa-2x"></i> Expérimentons Ensemble</h1>
		</div>
	</div>

	<div class="col-md-12 contact-map" style="color:#293A46;padding-bottom:75px; float:left; width:100%;" id="contactSection">
		<center>
			<i class="fa fa-caret-down" style="color:#E33551"></i><br/>
		<center>
		<div class="panel-body">
	        <ul class="points">
	        	<li><i class='fa fa-arrow-right'></i> Définir des objectifs ensemble </li>
	        	<li><i class='fa fa-arrow-right'></i> Partager les taches pour accélérer </li>
	        </ul>
	    </div>
	</div>
</div>



