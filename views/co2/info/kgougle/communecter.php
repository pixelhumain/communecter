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
<style>
</style>

<section class="padding-top-70">
    <div class="row padding-20 main-apropos padding-top-15 padding-bottom-50">
	    
        <div class="col-lg-2 col-md-2 col-sm-2 text-right hidden-xs" id=""> 
        		<img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" class="img-responsive"> 
        	
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

        	<h4 class="pull-left">
        		<a href="https://www.communecter.org/" class="tooltips homestead text-red"  target='_blank'
        			data-toggle="tooltip" data-placement="right" title="Cliquer pour visiter le site">
        			<i class="fa fa-angle-down"></i> Communecter
        		</a> 
        	</h4>

        	<a href="#co2.web" class="lbh btn btn-default pull-right margin-left-5 btn-submenu tooltips"
        		data-toggle="tooltip" data-placement="top" title="Retourner vers le moteur de recherche">
        		<b>Quitter cette page <i class="fa fa-arrow-right"></i></b>
        	</a> 
        	<a href="#co2.info.p.apropos" class="lbh btn btn-danger pull-right btn-submenu tooltips"
        		data-toggle="tooltip" data-placement="top" title='Retourner vers la page de présentation "A propos"'>
				<b><i class="fa fa-arrow-left"></i> À propos</b>
			</a>

			<br>
        	<hr>

			<b><span class="letter-red">Communecter</span></b> est un dispositif de réseau sociétal local catalyseur d'une synergie régionale, collective et solidaire reliant tous types d’acteurs (Entreprises, Associations, Collectivités et citoyens), tous domaines et objectifs confondus.
			<br>
			<ul>
				<li>La plateforme est un service d'aide à la population pour améliorer la valorisation des acteurs locaux pour produire un térritoire connecté.</li>
				<li>Un outil de communication entre citoyens et collectivités.</li>
				<li>Un outil de production et de visualisation d'open data pour mieux analyser et décider sur un térritoire.</li>
				<li>Une boite outil citoyenne pour encourager , faciliter et dynamiser l'implication citoyenne.</li>
				<li>le CTK : Citizen Tool Kit , Un socle technique et modulaire pour construire toutes sorte d'outils citoyens et administratifs spécialisés</li>
			</ul>

			<br>

			<span class="letter-red">Communecter</span> c’est une plateforme web portée par le collectif <a href="#co2.info.p.ph" class="lbh letter-yellow">Pixel Humain</a> dans lequel les citoyens sont connectés a leur commune.
			Ils sont informés en quasi temps réel de ce qui se passe localement et participent à l'activité locale (dialogue facilité avec les collectivités, regroupement de citoyens pour réfléchir ou débattre...)
			Connectés à la commune, ils le sont aussi avec leurs voisins pour partager des intérêts communs, avec des associations locales qui proposent des initiatives sociales et solidaires, des entreprises et producteurs qui fabriquent localement des produits.
			<br><br>
			A l’heure d’internet, de la simplification de la communication et du partage de l’information, tout est réuni pour fédérer et organiser cette dynamique. L’essence de <span class="letter-red">Communecter</span> est de créer cette synergie collective et solidaire reliant tous types d’acteurs, tous domaines et objectifs confondus.
			<br><br>
			A cet effet, <span class="letter-red">Communecter</span> souhaite être un catalyseur d’initiatives locales, un réseau social, libre de droit et d’accès, traitant de thématiques d’intérêt général. Cette plateforme internet de concertation est destinée à réunir et faire interagir les citoyens, le tissu associatif local, les entreprises locales et les pouvoirs publics.
			<br><br>
			Les objectifs sont de permettre à tous ces acteurs de ne plus agir chacun de leur côté mais de créer un territoire connecté et interactif.
			La finalité de <span class="letter-red">Communecter</span> est d’apporter aux collectivités les réflexions individuelles et de donner aux individus l’intelligence collective.
			<span class="letter-red">Communecter</span> met la recherche et l’experimentation au service de la société dans un contexte web 3.0 en proposant une boite à outils pour une Société 2.0.
			<br><br>
			Appliqué au monde de l’entreprise, un réseau social spécifique permet :

			<ul>
				<li>de cartographier l’activité d’un territoire et voir facilement Qui fait quoi, donc trouver une entreprise</li>
				<li>de créer des groupes d’entreprise et des sous groupes à l’interieur d’un groupe</li>
				<li>de communiqué avec un groupe ou un sous groupe (module discussion : brainstorm, sondage, feedback...)</li>
				<li>de reférencer une entreprise sur le territoire</li>
				<li>créér l’organigramme de l’entreprise</li>
				<li>d’élaborer des projets au sein d’un groupe (module projet)</li>
				<li>divers mode de visualisation</li>
				<li>pour une vue d’ensemble de structure et contenu de groupe</li>
				<li>par thématique ou mot clef</li>
				<li>par localité</li>
				<li>par geolocalité</li>
				<li>informer ou sonder l’ensemble des citoyens interressés à une thématique</li>
			</ul>
			<br><br>
			La plateforme aborde des sujets d’innovation technique et d’usage social et sociétal. L’objectif est de proposer un réél outil d’experimentation pour les acteurs locaux oeuvrant sur des thématiques d’intérêt général afin d’obtenir des résultats concrets. Le projet regroupe des acteurs de la Recherche et Développement locale (dont des sociétés incubés), le LIM (Laboratoire d’Iinformatique et de Mathématique), des développeurs agréés par le Ministere de la recherche, des acteurs du changement, conscients de l’opportunité que peut leur apporter <span class="letter-red">Communecter</span>.

        </div>

    </div>
</section>


<?php $this->renderPartial($layoutPath.'footer',  array( "subdomain"=>"web" ) ); ?>

<script>

jQuery(document).ready(function() {
    initKInterface();
    location.hash = "#co2.info.p.communecter";
});

</script>