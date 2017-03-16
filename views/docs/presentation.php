<?php 
$this->renderPartial("../docs/assets");
?>
<style>.btn-nav-in-doc { display: none !important; }</style>

<!-- header -->
<?php $this->renderPartial("../docs/docPattern/docHeader", array(
                          "icon" => "tv",
                          "title" => "Présentation",
                          "stitle" => "Ressources PDF",
                          "description" => "",
)); ?>

<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Round button indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="active"></li>
    <!-- <li data-target="#docCarousel" data-slide-to="1" class=""></li>
    <li data-target="#docCarousel" data-slide-to="2" class=""></li>
    <li data-target="#docCarousel" data-slide-to="3" class=""></li>
    <li data-target="#docCarousel" data-slide-to="4" class=""></li> -->
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <div class="panel panel-white user-list ">
          <div class="panel-heading border-light">
            <a class="btn-chapter" href="javascript:loadByHash('#default.view.page.presentation.dir.docs');">
              <h4 class="panel-title homestead text-red"><i class="fa fa-tv"></i> Présentation</h4>
            </a>
          </div> 
          <div class="panel-body">
            
                <ul class="points">
                  <li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Outils au service d'une villle intelligente et citoyenne V.0.1.pdf"> Outils au service d'une villle intelligente et citoyenne V.0.1</a> </li>
                  <li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Présentation Courte de Communecter - OPEN ATLAS.pdf"> Présentation Courte</a> </li>
                  <li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Présentation simplifiée de Communecter - OPEN ATLAS.pdf"> Présentation simplifiée</a> </li>
                  <li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Innovation Sociétale.pdf"> Innovation Sociétale</a> </li>
                  <li><i class='fa fa-arrow-right'></i><a target="_blank" href="https://www.communecter.org/doc/Plaquette Offre Carrefour des communes.pdf"> Plaquette Offre Carrefour des communes</a> </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- <div class="item"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/elements/index.png" class="img-schemas img-responsive "></div>
    <div class="item"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/elements/index.png" class="img-schemas img-responsive "></div>
    <div class="item"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/elements/index.png" class="img-schemas img-responsive "></div>
    <div class="item"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/elements/index.png" class="img-schemas img-responsive "></div> -->
  </div>

  <!-- Left and right SLIDER controls -->
  <a class="left carousel-control" href="#docCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Précédent</span>
  </a>
  <a class="right carousel-control" href="#docCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Suivant</span>
  </a>
</div>

<!-- Left and right CHAPTER controls -->
<a href="javascript:loadByHash('#default.view.page.modules.dir.docs')" class="homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
	<i class="fa fa-arrow-left"></i> Modules
</a>
<a href="javascript:loadByHash('#default.view.page.communication.dir.docs')"  class="homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
	Communication <i class="fa fa-arrow-right"></i>
</a>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs("tv", "présentation");
});
</script>



