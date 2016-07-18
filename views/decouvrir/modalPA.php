<div class="container" id="accueil">
		
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="hero-unit">
		
	 
		
		<a href="#pixelsactifs1" role="button" class="btn btn-primary" data-toggle="modal"> PIXELS ACTIFS<i class="icon-forward "></i></a>

		<!-- Modal 1-->
		<div id="pixelsactifs1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel">Pixel Actif, Parlez de vous </h4>
		  </div>
		  
			
		  <div class="modal-body">
						
			<div class="tab-content">
			  <div class="tab-pane active" id="you">
				<div class="p10 step-by-step">
					<ul class="unstyled clearfix">
						<li class="step-current"><span>Identité</span></li>
						<li class=""><span>Action</span></li>
						<li class="last-step"><span>Contact</span></li>
					</ul>
				</div>
				<br/>
				<h6> Objectif : Construction participative, partage et collaboration</h6>
				<form id="register1" action="save.php" method="POST">
					
					
					<div class="controls">
						<div class="controls controls-row">
							<select id="genreType" class="span3">
								<option value="">Sélectionner un type</option>
								<?php
								// curseur de type tableau de valeurs avec 1 clé (findOne)  where array() (je prends tout) qui a plusieurs valeurs array('list')
								$cursorTypes = $connection->pixelhumain->types->findOne( array(), array('list'));
								
								// Affichage d'un curseur de type tableau de valeurs. Je parcours le cursor, la clé est $c et la valeur est $type
								foreach ($cursorTypes['list'] as $c=>$type):
								?>
									<option value="<?php echo $c ?>" ><?php echo $type ?></option>
								<?php endforeach;?>
							</select>
						</div>						
						<div class="controls controls-row">
							<input type="text" class="span3" id="name" placeholder="Nom"/> 
							<input type="text" class="span2" id="pilot" placeholder="Représentant"/>
						</div>
						<div class="controls controls-row">
							<textarea id = "objet" placeholder="objet" class="span5"></textarea>
						</div>
					</div>
				</form>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button id="modal1Close" class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
			<a href="#pixelsactifs2" class="modalNext btn btn-primary" data-toggle="modal">Suivant<i class="icon-forward "></i></a>
		  </div>
		  
		</div>
		<!-- Modal 1 -->
		
		<!-- Modal 2-->
		<div id="pixelsactifs2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel">Pixel Actif, Parlez de votre action </h4>
		  </div>
		  <div class="modal-body">
			
			<div class="tab-content">
			  <div class="tab-pane active" id="action">
				<div class="p10 step-by-step">
					<ul class="unstyled clearfix">
						<li class="step-ok"><span>Identité</span></li>
						<li class="step-current"><span>Action</span></li>
						<li class="last-step"><span>Contact</span></li>
					</ul>
				</div>
				<br/>
				<h6> Objectif : Construction participative, partage et collaboration</h6>
				<form id="register2" action="save.php" method="POST">
					<div class="controls">				
						
						<div class="controls controls-row">
							<select id="actionType" class="span3" multiple  placeholder="Sélectionner une ou plusieurs thématique(s)">
								<?php
								// curseur de type tableau de valeurs avec 1 clé (findOne)  where array() (je prends tout) qui a plusieurs valeurs array('list')
								$cursorTags = $connection->pixelhumain->tags->findOne( array(), array('list'));
								
								// Affichage d'un curseur de type tableau de valeurs. Je parcours le cursor, la clé est $c et la valeur est $tag
								foreach ($cursorTags['list'] as $tag):
								?>
									<option value="<?php echo $tag ?>"><?php echo $tag ?></option>
								<?php endforeach;?>
							</select>
							<!-- Nom action-->
							<input type="text" class="span2" id="actionName" placeholder="Nom action"/>						 																
						</div>
						<div class="controls controls-row">
							<textarea id = "actionDesc" class="span5" placeholder = "Description de l'action"></textarea>
						</div>
						<div class="controls controls-row">
							<input type="text" class="span1" id="website" placeholder="Site web"/> 																
						</div>
						<div class="controls controls-row">
							<label class="span2" for="area">territoire de l'action</label>
							<!-- bouton radio -->						
							<input type="hidden" id="area" value=''/> 	
							<div class="span3 btn-group btnArea" data-toggle="buttons-radio">
								<button type="button" class="btn btn-primary">locale</button>
								<button type="button" class="btn btn-primary">nationale</button>
								<button type="button" class="btn btn-primary">internationale</button>
							</div>
						</div>
						<div class="controls controls-row">
							<!-- bouton checkbox -->						
							<label class="span4" for="OrigineActionCheckbox1">Êtes vous à l'origine de cette action ?<input class="span1" type="checkbox" id="origineActionCheckbox"></label>
						</div>
					</div>
				</form>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button id="modal2Close" class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
			<a id="modal2Prec" href="#pixelsactifs1" role="button" class="modalNext btn btn-primary" data-toggle="modal">Précédant<i class="icon-backward "></i></a>
			<a id="modal2Suiv" href="#pixelsactifs3" role="button" class="modalNext btn btn-primary" data-toggle="modal">Suivant<i class="icon-forward "></i></a>
		  </div>
		</div>
		<!-- Modal 2-->
		<!-- Modal 3-->
		<div id="pixelsactifs3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel">Pixel Actif, donnez nous votre contact </h4>
		  </div>
		  <div class="modal-body">
			
			<div class="tab-content">
			  <div class="tab-pane active" id="action">
				<div class="p10 step-by-step">
					<ul class="unstyled clearfix">
						<li class="step-ok"><span>Identité</span></li>
						<li class="step-ok"><span>Action</span></li>
						<li class="step-current last-step"><span>Contact</span></li>
					</ul>
				</div>
				<br/>
				<h6> Objectif : Construction participative, partage et collaboration</h6>
				<form id="register3" action="save.php" method="POST">
					<div class="controls">				
						<div class="controls controls-row">
							<div class="controls controls-row">
								<input type="text" class="span2" id="email" placeholder="Email"/>
								<input type="text" class="span2" id="tel" placeholder="Téléphone"/>
							</div>
							<input type="text" class="span5"  id="adress" placeholder="Adresse"/> 
							<div class="controls controls-row">
								<input type="text" class="span1"  id="cp" placeholder="CP"/> 
								<input type="text" class="span2" id="city" placeholder="Ville"/>
								<input type="text" class="span2" id="country" value="Réunion" placeholder="Pays"/>
							</div>
						</div>
					</div>
				</form>
				<p class="fss">
				Devenir un Pixel Actif, vous permet de vous référencer, vous tenir au courant, mais surtout de donner votre avis et transmettre vos idées 
				permettant de mieux construire l'application. On aimerait motiver le partage et la collaboration 
				avec des Allers / Retours fréquents, pour se rapprocher au mieux de la réalité. 
				Les données saisies seront visibles au sein du projet PH. L'utilisation des données sera à but non lucratif
				</p>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button id="modal3Close" class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
			<a id="modal3Prec" href="#pixelsactifs2" role="button" class="modalNext btn btn-primary" data-toggle="modal">Précédant<i class="icon-backward "></i></a>
			<a href="javascript:;" class="btn btn-primary" id="newPA">Enregistrer</a>
		  </div>
		</div>
		<!-- Modal 3-->
		
		
		<!-- Modal Explication-->
		<div id="demarche" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h4 id="myModalLabel">Pixel Actif, la démarche </h4>
		  </div>
		  <div class="modal-body">		
			<div class="tab-content">
				<div class="tab-pane active" id="you">
					<h6> Un Pixel actif est une association, un citoyen, une entreprise ou une collectivité qui agissent sur des thèmes d'intérêt général. La démarche d'inscription en tant que Pixel Actif est à la fois de référencer ses actions, leur donner de la visibilité et d'interagir avec le projet PH </h6>
				</div>
			</div>
		  </div>
		  <div class="modal-footer">
			<button id="modal1Close" class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
			<a href="#pixelsactifs1" class="modalNext btn btn-primary" data-toggle="modal">S'inscrire<i class="icon-forward "></i></a>
		  </div>
		</div>
		<!-- Modal Explication -->
		
		
	</div>
</div> <!-- /container -->