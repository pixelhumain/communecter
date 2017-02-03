<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "info",
                            )
                        );
      
      $urlKgou = Yii::app()->theme->baseUrl . "/assets/img/KGOUGLE-logo.png";
?>
<section class="padding-top-70">
    <div class="row main-apropos padding-top-15 padding-bottom-50">
      
        <div class="col-lg-1 col-md-1 col-sm-1 text-right hidden-xs" id="sub-menu-left">
          
        </div>
      
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">

          <h5 class="pull-left">
            <i class="fa fa-angle-down"></i> Définir KGOUGLE comme page d'accueil
          </h5>
            <a href="#co2.web" class="lbh btn btn-default pull-right"><i class="fa fa-arrow-left"></i> retour</a>
          <br>
          <hr>
          <!-- --------------------------------------------------------------------------------- -->
          
          <div class="zippy-container">
            <h3 class="letter-blue"><i class="fa fa-angle-right"></i> Firefox </h3>
          </div>
          <div class="zippy-overflow">
            <div class="zippy-content">
              <ol>
                <li>Lancez le navigateur, puis accédez à la page <a href="http://www.kgougle.nc" target="_blank">www.kgougle.nc</a>.</li>
                <li>Faites glisser l'onglet sur le bouton d'accueil dans l'angle supérieur droit du navigateur.&nbsp;</li>
                <li>Cliquez sur <strong>Oui</strong>.</li>
              </ol>
            </div>
          </div>

          
          
          <!-- --------------------------------------------------------------------------------- -->
          
          <h3 class="letter-blue"><i class="fa fa-angle-right"></i> Google Chrome</h3>
          
          <div class="zippy-overflow">
            <div class="zippy-content">
              <p><strong>Remarque</strong>&nbsp;: Vous ne pouvez pas définir de page d'accueil dans Google&nbsp;Chrome sur une tablette ou un téléphone.</p>

              <ol>
                <li>Dans le coin supérieur droit du navigateur de votre ordinateur, cliquez sur Plus&nbsp;<img src="//storage.googleapis.com/support-kms-prod/5C6FB52C8BBB2C12DC89B5F42F16B9B5E9CF" alt="Plus" title="Plus" width="18" height="18">&nbsp;<img src="//lh3.googleusercontent.com/79Ix2eMNX9FsFPayc5EmffxVhi9hOZlVSVYs2E3oQcV__X4QUGrXlVL4JpC6J_rzEbdy=w13-h18" alt="puis" title="puis" width="13" height="18"> <strong>Paramètres</strong>.</li>
                <li>Dans la section "Apparence", cochez la case <strong>Afficher le bouton Accueil</strong>.&nbsp;Lorsque la case est cochée, une adresse Web figure en dessous.</li>
                <li>Cliquez sur <strong>Modifier</strong>.</li>
                <li>Cliquez sur <strong>Ouvrir cette page</strong>, puis saisissez <strong><code>www.kgougle.nc</code></strong> dans la zone de texte.</li>
                <li>Cliquez sur <strong>OK</strong>.</li>
              </ol>
            </div>

          </div>

          <!-- --------------------------------------------------------------------------------- -->
          
          <div class="zippy-container">
            <h3 class="letter-blue"><i class="fa fa-angle-right"></i> Microsoft&nbsp;Edge</h3>
          </div>

          <div class="zippy-overflow">
            <div class="zippy-content">
              <ol>
                <li>Dans le coin supérieur droit du navigateur, sélectionnez <strong>Plus (...)&nbsp;</strong><img src="//lh3.googleusercontent.com/79Ix2eMNX9FsFPayc5EmffxVhi9hOZlVSVYs2E3oQcV__X4QUGrXlVL4JpC6J_rzEbdy=w13-h18" alt="puis" title="puis" width="13" height="18"> <strong>Paramètres</strong>.</li>
                <li>Faites défiler l'écran jusqu'à "Ouvrir Microsoft&nbsp;Edge avec", puis sélectionnez <strong>Une ou des pages spécifiques</strong>.</li>
                <li>Ouvrez la liste, puis sélectionnez <strong>Personnalisé</strong>.&nbsp;Sélectionnez ensuite la croix "X" à côté de la page d'accueil actuelle de l'appareil.</li>
                <li>Dans "Indiquer une URL", saisissez <strong><code>www.kgougle.nc</code></strong> et sélectionnez la <strong>disquette</strong>.</li>
              </ol>
            </div>
          </div>

          <!-- --------------------------------------------------------------------------------- -->
          
          <div class="zippy-container">
            <h3 class="letter-blue"><i class="fa fa-angle-right"></i> Internet&nbsp;Explorer&nbsp; </h3>
          </div>

          <div class="zippy-overflow">
            <div class="zippy-content">
              <ol>
                <li>Dans la barre de menus située en haut du navigateur, cliquez sur <strong>Outils</strong>.</li>
                <li>Sélectionnez <strong>Options Internet</strong>.</li>
                <li>Cliquez sur l'onglet <strong>Général</strong>.</li>
                <li>Dans la section "Page de démarrage", saisissez <strong><code>//www.kgougle.nc</code></strong> dans la zone de texte.</li>
                <li>Cliquez sur <strong>OK</strong>.</li>
              </ol>

              <p>Une fois les étapes ci-dessus terminées, redémarrez le navigateur afin d'afficher votre nouvelle page d'accueil.</p>
            </div>
          </div>

          <!-- --------------------------------------------------------------------------------- -->
          
          <div class="zippy-container">
            <h3 class="letter-blue"><i class="fa fa-angle-right"></i> Safari </h3>
          </div>
          <div class="zippy-overflow">
            <div class="zippy-content">
              <ol>
                <li>Dans le coin supérieur gauche de votre écran, choisissez <strong>Safari</strong>&nbsp;<img src="//lh3.googleusercontent.com/79Ix2eMNX9FsFPayc5EmffxVhi9hOZlVSVYs2E3oQcV__X4QUGrXlVL4JpC6J_rzEbdy=w13-h18" alt="puis" title="puis" width="13" height="18"> <strong>Préférences</strong>.</li>
                <li>Dans le menu déroulant "Les nouvelles fenêtres s'ouvrent avec" et "Les nouveaux onglets s'ouvrent avec", sélectionnez <strong>Page d'accueil</strong>.&nbsp;</li>
                <li>Dans la section "Page d'accueil", saisissez <strong><code>www.kgougle.nc</code></strong> dans la zone de texte.</li>
              </ol>
            </div>
          </div>

          <!-- --------------------------------------------------------------------------------- -->
          
          <div class="zippy-container zippy-last">
            <h3 class="letter-blue"><i class="fa fa-angle-right"></i> Navigateur Android</h3>
          </div>

          <div class="zippy-overflow">
            <div class="zippy-content">
              <ol>
                <li>Ouvrez votre navigateur. Cette application peut être intitulée Internet ou Navigateur.</li>
                <li>Appuyez sur le bouton <strong>Menu</strong> de votre téléphone ou dans le coin supérieur droit du navigateur.</li>
                <li>Appuyez sur <strong>Paramètres</strong>&nbsp;<img src="//lh3.googleusercontent.com/79Ix2eMNX9FsFPayc5EmffxVhi9hOZlVSVYs2E3oQcV__X4QUGrXlVL4JpC6J_rzEbdy=w13-h18" alt="puis" title="puis" width="13" height="18"> <strong>Général</strong>&nbsp;<img src="//lh3.googleusercontent.com/79Ix2eMNX9FsFPayc5EmffxVhi9hOZlVSVYs2E3oQcV__X4QUGrXlVL4JpC6J_rzEbdy=w13-h18" alt="puis" title="puis" width="13" height="18"> <strong>Configurer la page d'accueil</strong>.</li>
                <li>Saisissez <code><strong>www.kgougle.nc</strong></code>.</li>
              </ol>
            </div>
          </div>

          </section>


        </div>
      </div>
    </div>
</section>


<?php $this->renderPartial($layoutPath.'footer',  array( "subdomain"=>"web" ) ); ?>



<script>

var currentCategory = "";

jQuery(document).ready(function() {
    initKInterface();
    location.hash = "#co2.info.p.sethome";
});

</script>