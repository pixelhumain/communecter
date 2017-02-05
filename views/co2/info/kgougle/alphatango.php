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



        	


<section class="padding-top-70">
    <div class="row main-apropos padding-top-15 padding-bottom-50">
	    
        <div class="col-lg-2 col-md-2 col-sm-2 text-right hidden-xs" id="sub-menu-left">
        	
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

        	<h5 class="pull-left text-azure">
        		<i class="fa fa-angle-down"></i> Alpha Tango
        	</h5>
        		<a href="#co2.web" class="lbh btn btn-default pull-right"><i class="fa fa-arrow-left"></i> retour</a>
        	<br>
        	<hr>
        	<!-- --------------------------------------------------------------------------------- -->
        	


			<div class="col-md-12 text-center">
				<img src="<?php echo $urlTango; ?>" width="450" style="margin-top:-20px;">
			</div>
			<div class="col-md-12 text-left padding-top-60">
				<h1 class="letter-red font-blackoutM" id="koica">
	        		 <span class="letter-azure">Aplha Tango</span>, C ki lui ?!?
	        	</h1>
	        	<h3 class="letter-blue"><i class="fa fa-angle-right"></i> Votre contact Calédonien</h3>
				<b>KGOUGLE</b> a été mis en place par une équipe de développeurs indépendants : <a href="#co2.info.p.ph"><b>les PixelHumains</b></a><br>
				Ce collectif est composée de 8 développeurs répartis sur 3 fuseaux horaires : <b>Nouvelle-Calédonie, île de la Réunion, et métropole.</b><br><br>
				
				<b><span class="letter-azure font-blackoutM">Alpha Tango</span> est notre développeur Calédonien</b>, à l'origine de la création de <b>KGOUGLE</b>, et à votre disposition pour répondre à toutes vos questions.<br>C'est le lien entre les Calédoniens et notre collectif <b>PixelHumain</b>.<br><br>

				<div class="hidden">
					<h3 class="letter-blue"><i class="fa fa-angle-right"></i> Un projet international</h3>
					Notre collectif est réuni depuis ses origines autour d'un objectif commun : créer des outils numériques collaboratifs afin de <b>(re)dynamiser les territoires</b>, en facilitant la <b>communication entre les différents acteurs locaux.</b><br><br>

					Dans cet objectif, nous <b>co-construisons</b> depuis plus de 3 ans, une plateforme numériques dénommée Communecter.org, qui propose un ensemble de fonctionnalités cohérentes aux internautes souhaitant participer plus activement à <b>la vie de leur territoire.</b><br><br>
					
					Aujourd'hui, cette application s'addresse à la fois au territoire métropolitain (FRANCE), aux départements et territoires d'outre-mer, et à l'internationnal (Belgique, Suisse, Canada, etc)<br><br>


					<h3 class="letter-blue"><i class="fa fa-angle-right"></i> S'adapter à chaque territoire</h3>
				</div>

				En Nouvelle-Calédonie, certaines particularités propres à ce territoire isolé d'océanie nous ont poussé à adopter une approche légèrement différente de celle que nous suivons depuis nos débuts : pour répondre au mieux aux <b>besoins réels du pays</b> dans le domaine d'internet.<br><br>

				Motivé et conseillé par notre développeur calédonien <span class="letter-azure font-blackoutM">Alpha Tango</span>, nous espérons faire avancer internet sur le Caillou et en multiplier les usages : d'abord via ce moteur de recherche, pour faciliter votre navigation sur le web d'aujourd'hui, puis par la mise en place d'autres fonctionnalités innovantes.     

				
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