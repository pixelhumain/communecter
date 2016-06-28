<?php 
	$cssAnsScriptFilesModule = array('/css/docs/docs.css');
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<div class="panel-heading border-light center text-dark partition-white radius-10">
    <span class=" text-red homestead tpl_title"><i class="fa fa-binoculars"></i> Documentation</span>
    <br/>
    <span class="tpl_shortDesc"> Tout ce qu'il faut savoir sur le réseau Communecter ...
     </span>
</div>

<style type="text/css">
    .tpl_title{font-size: 38px!important;}
</style>
<div class="col-sm-12 ">

    <div class="panel panel-white ">
        
        <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 no-padding">
        	<?php $this->renderPartial("../docs/docPattern/player"); ?>
        </div>
        
        <div class="panel-body tpl_content">
           
        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >
	        <div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.elements.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-cubes"></i> 4 Elements</h4>
						</a>
					</div> 
					<div class="panel-body">
						<b>Communecter</b> est construit sur 4 éléments clefs, permettant de modéliser les acteurs et l'acitivté d'un territoire 
						<br/>
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.person.dir.docs');">Citoyen</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.organisation.dir.docs');">Organisation</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.events.dir.docs');">Evènnement</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.projects.dir.docs');">Projet</a></li>
				        </ul>
				    </div>
				</div>
			</div>
			<div class="col-sm-6 hidden">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.pourquoi.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-cogs"></i> Pour quoi faire ?</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Connaître les alternatives locales </li>
				        	<li><i class='fa fa-arrow-right'></i> Discuter et débattre localement </li>
				        	<li><i class='fa fa-arrow-right'></i> Participer au conseil citoyen </li>
				        	<li><i class='fa fa-arrow-right'></i> Faire connaître ses projets, et trouver du soutient</li>
				        	<li><i class='fa fa-arrow-right'></i> Devenir un acteur responsable de son territoire</li>
				        </ul>
				    </div>
				</div>
			</div>
			
			<div class="col-sm-6">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.modules.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-cube"></i> Modules</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.news.dir.docs');">Fil d'actualités</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.sig.dir.docs');">Système d'Information Géographique (SIG)</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.annuaire.dir.docs');">Annuaire</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.agenda.dir.docs');">Agenda</a></li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.dda.dir.docs');">Espace coopératif</a></li>
				        </ul>
				    	<a href="javascript:loadByHash('#news.index.type.pixels');" class="btn btn-default"><i class='fa fa-lightbulb-o'></i> Proposer une idée de module</a>
				    </div>
				</div>
			</div>

		</div>
		<div class="col-sm-12">
			
			
			<div class="col-sm-6 hidden">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.comprendre.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-question-circle"></i> Comprendre </h4>
						</a>
					</div> 
					<div class="panel-body">
			        <ul class="points">
			        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.ocdb.dir.docs');">OCDB : Open Common Database</a> </li>
						<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.openSystem.dir.docs');">Open System (Code Social)</a></li>
						<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.import.dir.docs');">Import Export API</a></li>
						<i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.explain');">Les gros mots</a>
			        </ul>
			    </div>
				</div>
			</div>
			
			
			
			<div class="col-sm-12 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.presentation.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-tv"></i> Présentation</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Outils au service d'une villle intelligente et citoyenne V.0.1.pdf"> Outils au service d'une villle intelligente et citoyenne V.0.1</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Présentation Courte de Communecter - OPEN ATLAS.pdf"> Présentation Courte</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Présentation simplifiée de Communecter - OPEN ATLAS.pdf"> Présentation simplifiée</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Innovation Sociétale.pdf"> Innovation Sociétale</a> </li>
				        	<li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Plaquette Offre Carrefour des communes.pdf"> Plaquette Offre Carrefour des communes</a> </li>
				        </ul>
				    </div>
				</div>
			</div>

		</div>
		<div class="col-sm-12">
		
			<div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.communication.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-bullhorn"></i> Communication </h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.video.dir.docs');">Nos Vidéos</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.affiches.dir.docs');">Nos Affiches</a> </li>
				        </ul>
				    </div>
				</div>
			</div>

		<!-- </div>
		<div class="col-sm-12"> -->
			
			<div class="col-sm-6">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.rd.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> R&D</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.roadmap.dir.docs');">Roadmap</a>  </li>
				        	<li class="hidden"><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.firstPitch.dir.docs|slides');">en 2012</a> </li>
				        	<li class="hidden"><i class='fa fa-arrow-right'></i> L'équipe </li>
				        	<li class="hidden"><i class='fa fa-arrow-right'></i> La structure </li>
				        	<li class="hidden"><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.fin.dir.docs|slides');">Wish Liste</a> </li>
				        </ul>
				    </div>
				</div>
			</div>

			<div class="col-sm-6 hidden">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<a class="btn-chapter" href="javascript:loadByHash('#default.view.page.histoire.dir.docs');">
							<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> L'Histoire</h4>
						</a>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Avant </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.firstPitch.dir.docs|slides');">en 2012</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> L'équipe et les communecteurs</li>
				        	<li><i class='fa fa-arrow-right'></i> La structure </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.fin.dir.docs|slides');">des chiffres</a> </li>
				        </ul>
				    </div>
				</div>
			</div>
	    </div>

        <br>
        <div class="col-sm-12 "><a style="display: block;" class="text-extra-large bg-dark pull-left tooltips radius-5 padding-10 homestead" href="javascript:window.history.back();"><i class="fa fa-arrow-left"></i>  Retour </a><a style="display: block;" class="text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead" href="javascript:loadByHash('#default.view.page.dda.dir.docs');">c'est Parti <i class="fa fa-arrow-right"></i> </a></div></div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
  $(".moduleLabel").html(
  			"<i class='fa fa-connectdevelop'></i> "+
  			"<span class='text-red'>Commune<span class='text-dark'>cter</span> : la doc</span>");
});
</script>

