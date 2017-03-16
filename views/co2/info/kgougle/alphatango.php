<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "info",
                            )
                        );
      
      $urlKgou = Yii::app()->theme->baseUrl . "/assets/img/KGOUGLE-logo.png";
      $urlTango = Yii::app()->theme->baseUrl . "/assets/img/alphatango.png";
?>


<style type="text/css">
	.txt-mail{
		min-height: 300px;
		max-height: 700px;
		max-width: 100%;
		min-width: 60%;
	}
</style>
        	


<section class="padding-top-70">
    <div class="row main-apropos padding-top-15 padding-bottom-50">
	    
        <div class="col-lg-2 col-md-2 col-sm-2 text-right hidden-xs" id="">
        	<img src="<?php echo $urlTango; ?>" class="img-responsive col-md-12">
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

        	<h5 class="pull-left text-azure">
        		<i class="fa fa-angle-down"></i> Alpha Tango
        	</h5>
        	
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
        	<!-- --------------------------------------------------------------------------------- -->
        	


			<!-- <div class="col-md-12 text-center">
				<img src="<?php echo $urlTango; ?>" width="450" style="margin-top:-20px;">
			</div> -->
			<div class="col-md-12 text-left padding-top-60">
				<h1 class="letter-red font-blackoutM" id="koica">
	        		 <span class="letter-azure">Aplha Tango</span>, C ki lui ?!?
	        	</h1>
	        	<h3 class="letter-blue"><i class="fa fa-angle-right"></i> Votre contact Calédonien</h3>
				<b>KGOUGLE</b> a été mis en place par une équipe de développeurs indépendants : <a class="letter-yellow lbh" href="#co2.info.p.ph"><b>les PixelHumains</b></a><br>
				Ce collectif est composée de 5 développeurs répartis sur 3 fuseaux horaires : <b>Nouvelle-Calédonie, île de la Réunion, et métropole.</b><br><br>
				
				<b><span class="letter-azure font-blackoutM">Alpha Tango</span> est notre développeur Calédonien</b>, à l'origine de la création de <b>KGOUGLE</b>, et à votre disposition pour répondre à toutes vos questions.<br>C'est le lien entre les Calédoniens et notre collectif <b>PixelHumain</b>.
				<br><br>
				<hr>
				<br>				
			</div>

			<div class="col-md-10 text-left padding-top-60 form-group">
				<h3>
					<i class="fa fa-chevron-down"></i> <i class="fa fa-send"></i> 
					Contacter <span class="letter-azure font-blackoutM">Alpha Tango</span> par e-mail
				</h3>
				<br><br>
				<div class="col-md-6">
					<label for="email"><i class="fa fa-angle-down"></i> Votre addresse e-mail*</label>
	 				<input class="form-control" placeholder="votre addresse e-mail : exemple@mail.com" id="email">
					<br>
				</div>
				<div class="col-md-6">
					<label for="name"><i class="fa fa-angle-down"></i> Nom / Prénom</label>
	 				<input class="form-control" placeholder="comment vous appelez-vous ?" id="name">
					<br>
				</div>
				<div class="col-md-12">
					<label for="objet"><i class="fa fa-angle-down"></i> Objet de votre message</label>
	 				<input class="form-control" placeholder="c'est à quel sujet ?" id="objet">
				</div>
			</div>
			<div class="col-md-11 text-left form-group">
				<div class="col-md-12">
					<label for="message"><i class="fa fa-angle-down"></i> Votre message</label>
	 				<textarea placeholder="Votre message..." class="form-control txt-mail" id="message"></textarea>
	 				<br>
					<button class="btn btn-success pull-right" id="btn-send-mail">
						<i class="fa fa-send"></i> Envoyer le message
					</button>
				</div>
			</div>
        </div>
    </div>
</section>


<?php $this->renderPartial($layoutPath.'footer',  array( "subdomain"=>"web" ) ); ?>

<script>

var currentCategory = "";

jQuery(document).ready(function() {
    initKInterface();
    location.hash = "#co2.info.p.alphatango";

    $(".dropdown-onepage-main-menu li a").click(function(e){
		e.stopPropagation();
		var target = $(this).data("target");
		console.log(target);
		KScrollTo(target);
	});

	$("#btn-onepage-main-menu").trigger("click");

});

</script>