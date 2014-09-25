<!-- Modal addCommune-->
<div id="addCommune" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="true">
  <div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 id="myModalLabel">Ajouter une Commune </h4>
  </div>
  
	
  <div class="modal-body">
				
	<div class="tab-content">
	  <div class="tab-pane active" id="you">
		<h6>Ouvrez votre commune</h6>
		<form id="communeForm" action="saveCommune.php" method="POST">
			
			<div class="controls-row">
				<input type="text" class="span3" id="wikipage" placeholder="Nom de la page wikipedia"/> 
				<input type="text" class="span3" id="imgGeo" placeholder="image Geographique URL"/> 
				<br/>
				<input type="text" class="span2" id="imgLogo" placeholder="image, Blason ou Logo URL"/>
				<input type="text" class="span3" id="imgValo" placeholder="belle image locale URL"/> 
				<br/>
				<select id="geoPosition" class="span5" placeholder="Position dans la region">
					<option value="northwest">Nord-Ouest</option>
					<option value="northeast">Nord-Est</option>
					<option value="center">Centre</option>
					<option value="southwest">Sud-Ouest</option>
					<option value="southeast">Sud-Est</option>
				</select>
				<br/><br/>
				<select id="activities" class="span5" multiple  placeholder="Une ou plusieurs activités qu'on peut faire localement">
					<?php
					$cursorActivities = Yii::app()->mongodb->activities->findOne( array(), array('list'));
					foreach ($cursorActivities['list'] as $a)
					    echo '<option value="'.$a.'">'.$a.'</option>';
					?>
				</select>
				<br/><br/>
				<?php 
				/*$this->widget('bootstrap.widgets.TbSelect2', array(
                	'asDropDownList' => false,
                	'name' => 'natures',
                	'options' => array(
                		'tags' => array('clever','is', 'better', 'clevertech'),
                		'placeholder' => 'disciplines',
                		'width' => '40%',
                		'tokenSeparators' => array(',', ' ')
                )));*/
				?>
				<select id="natures" class="span5" multiple  placeholder="Décriver la nature locale à visiter">
					<?php
					$cursorNature = Yii::app()->mongodb->natures->findOne( array(), array('list'));
					foreach ($cursorNature['list'] as $a)
					    echo '<option value="'.$a.'">'.$a.'</option>';
					?>
				</select>
			</div>
		</form>
		</div>
	</div>
  </div>
  <div class="modal-footer">
	<button id="modal1Close" class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
	<a href="javascript:;" class="btn btn-primary" id="submitCommune">Enregistrer</a>
  </div>
  
</div>
<!-- Modal addCommune -->


