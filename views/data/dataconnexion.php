<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2,h3 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
.grid a{
display:block;
font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
}
.grid {
  border: 1px dashed #CCC;
  position: relative;
}

.grid > div {
  background: #AAA;
  position: absolute;
  height: 150px;
  width: 100px;
  color:#555;
  border:1px solid #666;
  text-align:center;
  padding:5px;
}

.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
        <h2> Preuve de concept : Dataconnexion</h2>
        
        
        <p> 
        Peu de communes (Paris, Bordeaux…) proposent des données en libre exploitation (open data). Ce n’est malheureusement pas le cas de l’ensemble des communes. De plus, elles ne s’accordent pas sur le format des données échangé.
        Le Pixel Humain (PH) dans sa partie Open Data, propose d’élaborer un format de fichier de données ouvert, libre et générique utilisable par toutes les communes. Une simple adhésion de la commune à l’association Open Atlas lui donnera accès à une collection d’outils citoyens l’accompagnant vers une ouverture numérique.
        Cette dynamique guidera les communes dans leur objectif de transparence et de modernisation tout en proposant une valorisation et un développement durable du territoire. La plateforme  acceueillera citoyens, associations et entreprises locales qui veulent bien adhérer a 
         l’initiative pour former le 1er réseau social citoyen libre. Le dispositif est gratuit, déployé en France et les Doms via internet et des applications mobiles.

		<h3>Quelques POC</h3>
     	 Pour la demo concours voici quelques données réutilisé dans le PH 
     	<div class="grid">
     		<div data-ss-colspan="2">Démo Commune<br/><a target="_blank" href="<?php echo Yii::app()->createUrl('index.php/commune/view/cp/97400')?>" >97400</a> <a  target="_blank" href="<?php echo Yii::app()->createUrl('index.php/commune/view/cp/97480')?>" >97480</a> </div>
            <div  data-ss-colspan="2"><a  target="_blank" href="<?php echo Yii::app()->createUrl('index.php/commune')?>">Distribution des Communectés</a>Inscrit connecté par departement</div>
            <div data-ss-colspan="2"><a target="_blank" href="<?php echo Yii::app()->createUrl('index.php/opendata/commune/ci/97411')?>" ><i class="icon-plus"></i> Modèle Open Data Locales</a> une commune </div>
            <div data-ss-colspan="2"><a href="#loginForm"   target="_blank" role="button" data-toggle="modal"><i class="icon-plus"></i> Inscrivez Vous</a> on vous tiendra informé </div>
       </div>

<br/>
        Actuellement en phase d’étude et POC, le Pixel Humain est actuellement disponible en version alpha. Par la suite, la plateforme utilise les dernières techniques et technologies web (temps reel, SVG, 3D, geoloc).
        L’alimentation du fichier de données Commune s’appuie sur deux principes : agréger un maximum de fichiers de données existants, en provenance de sources validées (data.gouv, insee…). Puis, alimenter les données manquantes ou inexactes via une interface par la commune elle même, par les citoyens, associations ou entreprises. Ce crowdsourcing sera accompagné d’outils de validation (historique, versioning, origine de la donnée). Les données du fichier couvrent divers thèmes : organisation du conseil municipal (élus, calendrier des conseils), structure de la mairie (services, horaires, coordonnées…), culturel, associatif… Partager de l’information, débattre, coopérer dans l’intérêt public, valoriser le territoire, privilégier l’économie locale restent les principaux objectifs du PH

    	
       
    
        </p>
     	
       
       <h3>Plus d'infos</h3>
       <ul>
       	<li><a target="_blank" href="http://www.pixelhumain.com/tmp/pptComplet.pdf">Présentation Power Point ( 23 Slides )</a></li>
       	<li><a target="_blank" href="http://www.pixelhumain.com/tmp/PRESENTATION_PH_02092013_BD.pdf">Présentation Détaillée ( 20 pages )</a></li>
       </ul>
   		
   
	</div>
</div>



<script type="text/javascript"		>
initT['animInit'] = function(){
	$(".grid").shapeshift({
	    minColumns: 3
	  });
        (function ani(){
        	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
        })();
};
</script>			