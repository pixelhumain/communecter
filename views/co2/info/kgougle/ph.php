<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "info",
                            )
                        );
      
      $urlKgou = Yii::app()->theme->baseUrl . "/assets/img/KGOUGLE-logo.png";
?>


<section class="padding-top-70">
    <div class="row padding-20 main-apropos padding-top-15 padding-bottom-50">
	    
        <div class="col-lg-2 col-md-2 col-sm-2 text-right hidden-xs" id=""> 
        		<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGO_PIXEL_HUMAIN.png" class="img-responsive"> 
        	
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

        	<h5 class="pull-left">
        		<i class="fa fa-angle-down"></i> 
        		<a href="https://github.com/pixelhumain" class="tooltips homestead text-dark" target='_blank'
        			data-toggle="tooltip" data-placement="right" title="Découvrir les Pixels sur GitHub">Les pixels humains</a>
        	</h5>
        	
        	<a href="#co2.web" class="lbh btn btn-default pull-right"><i class="fa fa-arrow-left"></i> retour</a>
        	
        	<br>
        	<hr>
        	
        	Porté par l'association Open Atlas et l’agence O.R.D, <b>Pixel Humain</b> est un collectif regroupant différents acteurs qui souhaitent valoriser les <b>communs</b> et développer des outils <b>Open Source</b> afin de faciliter la cartographie et l’interaction des acteurs d’un <b>territoire</b> (citoyens, associations, entreprises et collectivités). <br><br>

			La société <b>O.R.D</b> (Open R&D) regroupe des acteurs du <b>numérique</b> (web, mobile, design, objets connectés). Elle est spécialisée dans les modes de communication innovants et défend depuis toujours l’innovation et la philosophie Open Source comme vecteurs de Collaboration Massive.<br><br>

			<b>L'association Open Atlas</b> est un espace multidisciplinaire d'échanges permettant de développer des projets dans des domaines de l’intérêt général, notamment autour de l’économie de l’information et de la communication.
			Intérêt social et solidaire, l’association s’intéresse à tous les territoires, du local à
			l’international et oeuvre, en toute diversité, dans les champs du développement humanitaire, culturel, artistique et de la communication. L’association se donne également pour objectif d’être un laboratoire et une cellule active de recherche et de développement, défendant le décloisonnement et le partage des compétences, ainsi que la liberté de penser et d’agir.<br><br>

			Open Atlas promeut l’action, <b>l’intelligence collective</b> et l’initiative citoyenne. Elle milite pour
			la conjugaison de l’éthique et de l’efficacité, autour de l’économie numérique dans le
			principe du développement soutenable, durable et solidaire. <br><br>

			<h5>Quelques projets portés et développés par Open Atlas : </h5>
			<ul>
				<li><b>Communecter</b>, un projet de réseau sociétal Open Source :
					<ul><li>Nos adhérants sont : La Possession, Saint Louis, Lilles, Bretagne</li></ul>
				</li>
				<li><b>FabLab.re</b>, un collectif de bidouilleur Réunionais (2012) partenaire avec le Fablab de Barcelone</li>
				<li><b>Cartographie d’acteur et recensement :</b>
					<ul>
						<li>Des acteurs du bien communs de Lilles :</li>
						<li>Des tiers lieux de Lilles avec LA MEL </li>
						<li>Des tiers lieux de Paris avec La ville de PAris</li>
					</ul>
				</li>
				<li><b>Smarterre</b> : Programme de territoire intelligent et son modéle Kiltir Lab  de tiers lieux camp TIC </li>
				<li><b>Kgougle</b> : Un portail web dédié au territoire de la Nouvelle-Calédonie, basé sur le projet Communecter</li>
			</ul>

			<br>

			--------------------------------------------------------------------------------<br>
			<h5>A propos de ORD : </h5>
			La société O.R.D (Open R&D) regroupe des acteurs du numérique (web, mobile, design, objets connectés). Elle est spécialisée dans les modes de communication innovants et défend depuis toujours l’innovation et la philosophie Open Source comme vecteurs de Collaboration Massive.
			<br><br>
			O.R.D regroupe une communauté de talents et d'expertises, bénéficiant de retours d’expérience éprouvés. Son objet est d'accompagner les entreprises et associations dans leur démarche d'innovation. Un clusters dédié à la recherche et au développement sous une forme décentralisé.
			<br><br>
			Nous offrons une gamme de produits et services à forte valeur ajoutée :
			<ul>
			<li>Développement de solutions numériques</li>
			<li>Création Graphique (logo, direction artistique)</li>
			<li>Utilisation de Hardware (Arduino, capteurs, imprimante 3D…)</li>
			<li>Barcamp / Atelier collaboratif + créatif (Brainstorming, Serious game, Hackathon…)</li>
			<li>Formations : outils collaboratifs, organisation projet, développement web, design…</li>
			<li>Hébergement (hosting cloud ou dédié)</li>
			<li>Animation Vidéo (design, motion...)</li>
			<li>E-commerce</li>
			<li>Installation et animation digitale (design intéractif)</li>
			<li>Conseil et Think Tank innovation</li>
			<li>Cartographie (SIG : Système d’information géographique)</li><br><br>
			</ul>

			ORD promeut <b>l’intelligence collective et l’initiative citoyenne</b> en militant pour la conjugaison de l’éthique et de l’efficacité, autour de l’économie numérique et en oeuvrant dans le principe de développement soutenable, durable et solidaire.<br><br>

			<h4 class="pull-left">
        		<a href="#co2.info.p.communecter" class="tooltips homestead text-red"  target='_blank'
        			data-toggle="tooltip" data-placement="right" title="En savoir plus sur le projet Communecter">
        			<i class="fa fa-angle-right"></i> Communecter
        		</a> 
        	</h4>

        </div>

    </div>
</section>


<?php $this->renderPartial($layoutPath.'footer',  array( "subdomain"=>"web" ) ); ?>

<script>

jQuery(document).ready(function() {
    initKInterface();
    location.hash = "#co2.info.p.ph";
});

</script>