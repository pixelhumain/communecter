<?php 
  $this->renderPartial("../docs/assets");
?>
<style>.btn-nav-in-doc { display: none !important; }</style>

<!-- header -->
<?php $this->renderPartial("../docs/docPattern/docHeader", array(
                          "icon" => "question-circle",
                          "title" => "Comprendre",
                          "stitle" => "OCDB, API, DDA, etc",
                          "description" => "Communecter c'est plein de concept un peu barbare qu'on va vous expliquer simplement ...",
)); ?>

<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Round button indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#docCarousel" data-slide-to="1" class=""></li>
    <li data-target="#docCarousel" data-slide-to="2" class=""></li>
    <li data-target="#docCarousel" data-slide-to="3" class=""></li>
    <li data-target="#docCarousel" data-slide-to="4" class=""></li>
    <li data-target="#docCarousel" data-slide-to="5" class=""></li>
    <li data-target="#docCarousel" data-slide-to="6" class=""></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/comprendre/index.png" class="img-schemas img-responsive "></div>
    <div class="item"><?php $this->renderPartial("../docs/comprendre/ocdb", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/comprendre/openSystem", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/comprendre/import", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/comprendre/dda", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/comprendre/financement", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/comprendre/smarterre", array("renderPartial"=>true)); ?></div>
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

<div class="space20"></div>

<!-- Left and right CHAPTER controls -->
<a href="#default.view.page.pourquoi.dir.docs" class="lbh homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
  <i class="fa fa-arrow-left"></i> Pour quoi faire ?
</a>
<a href="#default.view.page.modules.dir.docs"  class="lbh homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
  Les modules <i class="fa fa-arrow-right"></i>
</a>
<div class="space20"></div>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs("question-circle", "comprendre");
});
</script>



