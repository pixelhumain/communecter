
<div class="panel-heading border-light center text-dark partition-white radius-10">
    <span class=" text-red homestead tpl_title">Documentation</span>
    <br/>
    <span class="tpl_shortDesc"> Tout ce qu'il faut savoir sur le réseau Communecter ...
     </span>
</div>

<style type="text/css">
    ul li {list-style: none}
    .tpl_title{font-size: 38px;}
     .panel-title {font-size:25px;}
    .points{padding-left:10px;}
    .col-sm-4{min-height: 300px}
    .tpl_shortDesc{font-size:17px; font-weight: 300;}
</style>
<div class="col-sm-12 ">

    <div class=" ">
        <div class="col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 no-padding">
        	<?php $this->renderPartial("../docs/player"); ?>
        </div>
        <div class="tpl_content">
           
        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >
	        <div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> <a href="javascript:loadByHash('#default.view.page.elements.dir.docs');">Les 4 Elements</a></h4>
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
						<h4 class="panel-title homestead text-red"><i class="fa fa-cogs"></i> Pour faire quoi ?</h4>
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
			<div class="col-sm-6 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> Charabiat technique</h4>
					</div> 
					<div class="panel-body">
			        <ul class="points">
			        	<li><i class='fa fa-arrow-right'></i> OCDB : Open Common Database </li>
						<li><i class='fa fa-arrow-right'></i> Open System</li>
						<li><i class='fa fa-arrow-right'></i> Import Export</li>
						<li><i class='fa fa-arrow-right'></i> Open API</li>
						<li><i class='fa fa-arrow-right'></i> Web sématique</li>
						<li><i class='fa fa-arrow-right'></i> <a href="javascript:loadByHash('#default.view.page.dda.dir.docs');">DDA : Discuter, Décider, Agir</a></li>
			        </ul>
			    </div>
				</div>
			</div>

			<div class="col-sm-6 ">
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

			
			<div class="hidden">
				<div class="col-sm-4 ">
			        <div class="panel panel-white user-list ">
						<div class="panel-heading border-light">
							<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> SlideShow</h4>
						</div> 
						<div class="panel-body">
							
					        <ul class="points">
					        	<li><i class='fa fa-arrow-right'></i> une action peut avoir 5 états différents : </li>
								<li><i class='fa fa-arrow-right'></i> "A Faire" : aucune date de début n'a été assigné</li>
								<li><i class='fa fa-arrow-right'></i> "En cours" : une date de début, et une personne est assignée</li>
								<li><i class='fa fa-arrow-right'></i> "En retard": la date de fin est assigné mais dépassé.</li>
								<li><i class='fa fa-arrow-right'></i> "Terminer" : une tache qui a été cloturé</li>
								<li><i class='fa fa-arrow-right'></i> "Non Assignée" : une tache qui n'a pas encore de responsable </li>
								<li><i class='fa fa-arrow-right'></i> Plusieurs personne peuvent etre assignées à une action</li>
					        </ul>
					    </div>
					</div>
				</div>

				<div class="col-sm-4 ">
			        <div class="panel panel-white user-list ">
						<div class="panel-heading border-light">
							<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> SlideShow</h4>
						</div> 
						<div class="panel-body">
							
					        <ul class="points">
					        	<li><i class='fa fa-arrow-right'></i> une action peut avoir 5 états différents : </li>
								<li><i class='fa fa-arrow-right'></i> "A Faire" : aucune date de début n'a été assigné</li>
								<li><i class='fa fa-arrow-right'></i> "En cours" : une date de début, et une personne est assignée</li>
								<li><i class='fa fa-arrow-right'></i> "En retard": la date de fin est assigné mais dépassé.</li>
								<li><i class='fa fa-arrow-right'></i> "Terminer" : une tache qui a été cloturé</li>
								<li><i class='fa fa-arrow-right'></i> "Non Assignée" : une tache qui n'a pas encore de responsable </li>
								<li><i class='fa fa-arrow-right'></i> Plusieurs personne peuvent etre assignées à une action</li>
					        </ul>
					    </div>
					</div>
				</div>

				<div class="col-sm-4 ">
			        <div class="panel panel-white user-list ">
						<div class="panel-heading border-light">
							<h4 class="panel-title homestead text-red"><i class="fa fa-comments"></i> SlideShow</h4>
						</div> 
						<div class="panel-body">
							
					        <ul class="points">
					        	<li><i class='fa fa-arrow-right'></i> une action peut avoir 5 états différents : </li>
								<li><i class='fa fa-arrow-right'></i> "A Faire" : aucune date de début n'a été assigné</li>
								<li><i class='fa fa-arrow-right'></i> "En cours" : une date de début, et une personne est assignée</li>
								<li><i class='fa fa-arrow-right'></i> "En retard": la date de fin est assigné mais dépassé.</li>
								<li><i class='fa fa-arrow-right'></i> "Terminer" : une tache qui a été cloturé</li>
								<li><i class='fa fa-arrow-right'></i> "Non Assignée" : une tache qui n'a pas encore de responsable </li>
								<li><i class='fa fa-arrow-right'></i> Plusieurs personne peuvent etre assignées à une action</li>
					        </ul>
					    </div>
					</div>
				</div>
			</div>
	    </div>
        <br>
        <div class="col-sm-12 "><a style="display: block;" class="text-extra-large bg-dark pull-left tooltips radius-5 padding-10 homestead" href="javascript:window.history.back();"><i class="fa fa-arrow-left"></i>  Retour </a><a style="display: block;" class="text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead" href="javascript:loadByHash('#default.view.page.dda.dir.docs');">c'est Parti <i class="fa fa-arrow-right"></i> </a></div></div>
    </div>
</div>
