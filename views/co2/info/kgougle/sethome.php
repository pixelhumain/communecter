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
<style>
  #iframevideo{
    width:640px;
    height:480px;
  }

@media screen and (max-width: 1024px) {
  #iframevideo{
    width:480px;
    height:360px;
  }
}

@media (max-width: 768px) {
  #iframevideo{
    width: 320px;
    height: 180px;
    margin-left: -15px;
  }

  footer{
    position: absolute;
    bottom: 0px;
  }
}
</style>
<section class="padding-top-70">
    <div class="row col-md-12 main-apropos padding-top-15 padding-bottom-50">
      
        <div class="col-lg-2 col-md-2 col-sm-2 text-right hidden-xs" id="sub-menu-left">
          
        </div>
      
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">

          <h5 class="pull-left">
            <i class="fa fa-angle-down"></i> Définir 
            <span class="letter-blue">K</span><span class="letter-yellow">GOU</span><span class="letter-green">GLE</span> 
            en page d'accueil
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
          <p class="hidden-xs"><b>Comment changer la page d'accueil de votre navigateur ?</b></p>
          <span>Suivez les conseils de cette vidéo de <a class="letter-blue" href="http://www.commentcamarche.net/faq/16919-comment-changer-la-page-d-accueil-de-son-navigateur-web">commentcamarche.net</a> pour configurer votre navigateur : <b>(PC & Mac)</b><br>
          <small class="hidden-xs"><a class="letter-green" href="http://www.commentcamarche.net/faq/16919-comment-changer-la-page-d-accueil-de-son-navigateur-web">http://www.commentcamarche.net/faq/16919-comment-changer-la-page-d-accueil-de-son-navigateur-web</a></small>
          </span>
          <!-- --------------------------------------------------------------------------------- -->
          <br>
          <ul class="hidden-xs">
            <li><b>0 min 16 sec :</b> Internet Explorer</li>
            <li><b>0 min 35 sec :</b> Google Chrome</li>
            <li><b>1 min 31 sec :</b> Mozilla Firefox</li>
            <li><b>1 min 57 sec :</b> Opera</li>
          </ul>
          <iframe width='740' height='480' frameborder='0' allowfullscreen id="iframevideo"
                  src='//player.ooyala.com/static/v4/stable/4.11.13/skin-plugin/iframe.html?ec=Vkazg4dzqp4NzPY7U_vhShMwTKIPJFnt&pbid=69cb820a85749509efca96fb36853ca&pcode=M4azMxOmZFabvRouis6TdYXWR9uR'>
          </iframe>
        
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