<?php 
	$cssAnsScriptFilesModule = array('/css/default/docs.css');
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
        	<?php $this->renderPartial("../docs/player"); ?>
        </div>
        
        <div class="panel-body tpl_content">
           
        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >
	        <div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red pull-left">
							<i class="fa fa-cubes"></i> 4 Elements	
						</h4>
						<div class="btn-group pull-right">
							<a class="btn btn-default btn-sm" href="javascript:loadByHash('#default.view.page.elements.dir.docs');">+</a>
						</div>
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
			<div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-cogs"></i> Pour quoi faire ?</h4>
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
		</div>
		<div class="col-sm-12">
			<div class="col-sm-6">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-question-circle"></i> Comprendre </h4>
					</div> 
					<div class="panel-body">
			        <ul class="points">
			        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.ocdb.dir.docs');">OCDB : Open Common Database</a> </li>
						<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.openSystem.dir.docs');">Open System</a></li>
						<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.import.dir.docs');">Import Export API</a></li>
						<li><i class='fa fa-arrow-right'></i> Web sématique</li>
						<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.dda.dir.docs');">DDA : Discuter, Décider, Agir</a></li>
			        </ul>
			    </div>
				</div>
			</div>

			<div class="col-sm-6">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> L'Histoire</h4>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Avant </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.firstPitch.dir.docs|slides');">en 2012</a> </li>
				        	<li><i class='fa fa-arrow-right'></i> L'équipe </li>
				        	<li><i class='fa fa-arrow-right'></i> La structure </li>
				        	<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.fin.dir.docs|slides');">des chiffres</a> </li>
				        </ul>
				    </div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">

			<div class="col-sm-4 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-tv"></i> Présentation</h4>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> </li>
				        </ul>
				    </div>
				</div>
			</div>
			<div class="col-sm-4 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-copy"></i> Offres </h4>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> </li>
				        </ul>
				    </div>
				</div>
			</div>

			<div class="col-sm-4 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-bullhorn"></i> Communication </h4>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i>  </li>
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

