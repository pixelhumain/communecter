
<div class="panel-heading center text-dark partition-white radius-10" >
    <span class=" text-red homestead tpl_title"><i class='fa fa-calendar fa-2x'></i> agenda</span><br>
    <!-- <h3 class=" text-dark homestead">Publier, </h3> -->
    <br/>
    <span class="tpl_shortDesc">L'activité d'un territoire c'est des évènements provenants de tous les acteurs plus ou moins locaux.<br/>
    Restons informer, partageons au plus grand nombres.<br>
    L'agenda, c'est l'outils incontournable des acteurs d'un territoire.</span>
</div>

<style type="text/css">
    ul li {list-style: none}
    .tpl_title{font-size: 48px;}
     .panel-title {font-size:25px;}
    .points{padding-left:10px;}
    .codeSocial{color:black;}
    .codeSocial h3, .codeSocial h2 {text-decoration: underline;font-weight: bold}
</style>

<div class="col-sm-12 ">   
    <div class="panel-body tpl_content">        
        <div class="col-xs-12">
	        <div class=" col-xs-12 col-md-6 center bg-red">
	        	<div class="text-bold text-extra-large" style="padding: 50px;">
	        		Revenez bientot pour la vidéo
	        	</div>
	        </div>
	        <a class="thumb-info" href="<?php echo $this->module->assetsUrl; ?>/images/docs/agendaGlobal.png" data-title="Schéma notre Open System"  data-lightbox="all">
			<img src="<?php echo $this->module->assetsUrl; ?>/images/docs/agendaGlobal.png" class="col-md-6 col-xs-12 img-responsive ">
	        </a>
        </div>
        <div class="col-sm-12" style="margin-top:30px;margin-bottom:30px; " >

	        <div class="col-sm-12 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead"><i class="fa fa-bullhorn"></i> Rester Informé</h4>
					</div> 
					<div class="panel-body">
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Toute l'activité d'un ou plusieurs territoires  </li>
				        	<li><i class='fa fa-arrow-right'></i> divers type d'évènements</li>
				        	<li><i class='fa fa-arrow-right'></i> recevez des notifications de vos roganisation et de vos projets </li>
				        	<li><i class='fa fa-arrow-right'></i> Filtrer par tag</li>
				        </ul>
				    </div>
				</div>
			</div>

			<div class="col-sm-12 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead"><i class="fa fa-cogs"></i> Organiser</h4>
					</div> 
					<div class="panel-body">
			        <ul class="points">
			        	<li><i class='fa fa-arrow-right'></i> Créer des évènements locaux</li>
						<li><i class='fa fa-arrow-right'></i> partager les massivement</li>
						<li><i class='fa fa-arrow-right'></i> Utiliser le réseau sociétal pour promouvoir </li>
						<li><i class='fa fa-arrow-right'></i> Système d'information temporel</li>
			        </ul>
			    </div>
				</div>
			</div>

			<div class="col-sm-12 ">
		        <div class="panel panel-white user-list ">
					<div class="panel-heading border-light">
						<h4 class="panel-title homestead"><i class="fa  fa-plus"></i> et plus</h4>
					</div> 
					<div class="panel-body">
						
				        <ul class="points">
				        	<li><i class='fa fa-arrow-right'></i> Repéré les zones d'activité</li>
							<li><i class='fa fa-arrow-right'></i> Créer du réseau autour de vos évènements</li>
							<li><i class='fa fa-arrow-right'></i> Vos visteurs reste en contact</li>
							<li><i class='fa fa-arrow-right'></i> Citoyen journaliste d'évènements <span class="text-red">(bientot)</span></li>
				        </ul>
				    </div>
				</div>
			</div>

	    </div>
		<div class="center col-md-12">
			<button data-hash="#event.eventsv" class="btn bg-orange lbh" ><i class="fa fa-calendar-plus-o"></i> Ajouter un événement</button><br>
			<label>Vous organisez un événement ? Partagez-le dans l'agenda ! </label>
		</div>
    </div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
  setTitle("<span class='text-red'>MODULE</span> : Agenda</span>","cube","MODULE : Agenda");
});
</script>