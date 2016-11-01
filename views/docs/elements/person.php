<?php 
	if(!isset($renderPartial) || $renderPartial != true){
		Menu::docs();
		Menu::entry("right", 'onclick', 
		            Yii::t( "common", 'Organisation Documentation'),
		            Yii::t( "common", 'Organisation'), 
		            'chevron-circle-right',
		            "loadByHash('#default.view.page.organisation.dir.docs')","closeActionBtn",null);
		$this->renderPartial('../default/panels/toolbar');
	}
?>
<div class="panel-heading border-light center text-dark partition-white radius-10">
    <span class=" text-red homestead tpl_title"><i class="fa fa-user"></i> Les Citoyens</span>
    <br/>
    <span class="tpl_shortDesc"> Le citoyen est au centre de ce réseau sociétal,<br>
    	tout est fait pour lui, par lui, et amplifié par le nombres de citoyens participant.<br>
    	Le projet est concu comme un bien commun pour le bien commun </span>
</div>

<style type="text/css">
    ul li {list-style: none}
    .tpl_title{font-size: 48px;}
     .panel-title {font-size:25px;}
    .points{padding-left:10px;}
    .tpl_shortDesc{font-size:17px; font-weight: 300;}
</style>

           
        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >
        <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/person.png" class="img-schemas img-responsive" style="margin-bottom:15px;">
        
	        <div class="col-sm-12 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-yellow"><i class="fa fa-comments"></i> PARTAGER</h4>
					</div> 
					<div class="panel-body">
				        <ul class="points">
				        	<li><strong><i class='fa fa-arrow-right'></i> Chaque citoyen peut ajouter : </strong></li>
				        	<li><i class='fa fa-arrow-right'></i> Ses amis ou connaissances</li>
				        	<li><i class='fa fa-arrow-right'></i> Ses organisations</li>
				        	<li><i class='fa fa-arrow-right'></i> Ses évenements</li>
				        	<li><i class='fa fa-arrow-right'></i> Ses projets</li>
				        	<li><i class='fa fa-arrow-right'></i> Le partage est le 1er acte social</li>
				        </ul>
				    </div>
				</div>
			</div>

			<div class="col-sm-12 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead text-yellow"><i class="fa fa-comments"></i> ORGANISER</h4>
					</div> 
					<div class="panel-body">
			        <ul class="points">
			        	<li><i class='fa fa-arrow-right'></i> Mon répertoire personnel </li>
			        	<li><i class='fa fa-arrow-right'></i> Faire des propositions</li>
						<li><i class='fa fa-arrow-right'></i> Partager vos évènements</li>
						<li><i class='fa fa-arrow-right'></i> Partager vos projet</li>
			        </ul>
			    </div>
				</div>
			</div>

			<div class="col-sm-12 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light text-yellow">
						<h4 class="panel-title homestead"><i class="fa fa-comments"></i> PARTICIPER</h4>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Voir l'activité de ma commune</li>
							<li><i class='fa fa-arrow-right'></i> Faire des propositions sur un territoire</li>
							<li><i class='fa fa-arrow-right'></i> Découvrir les acteurs locaux</li>
							<li><i class='fa fa-arrow-right'></i> Avoir une vision d'ensemble local pour mieux agir</li>
							<li><i class='fa fa-arrow-right'></i> Echanger directement entre citoyen et avec la collectivité</li>
				        </ul>
				    </div>
				</div>
			</div>
		</div>
		
<script type="text/javascript">
jQuery(document).ready(function() {
  setTitle("<span class='text-red'>Commune<span class='text-dark'>cter</span> : la doc</span>","connectdevelop","Communecter Documentation");
});
</script>