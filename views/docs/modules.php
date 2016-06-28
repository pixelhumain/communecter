<?php 
	$cssAnsScriptFilesModule = array('/css/docs/docs.css',  '/js/docs/docs.js');
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

  Menu::docs("comprendre", "presentation");
  $this->renderPartial('../default/panels/toolbar');
?>
<style>.btn-nav-in-doc { display: none !important; }</style>

<!-- header -->
<?php $this->renderPartial("../docs/docPattern/docHeader", array(
                          "icon" => "cube",
                          "title" => "Modules",
                          "stitle" => "Actualités, cartographie, annuaire, agenda ...",
                          "description" => "Communecter c'est plein de fonctionnalités plus utiles les unes que les autres, imbriquées et interconnectées, qui font de communecter un réseau sociétal puissant.",
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
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/modules/index.png" class="img-schemas img-responsive "></div>
    <div class="item"><?php $this->renderPartial("../docs/modules/news", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/modules/news2", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/modules/sig", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/modules/agenda", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/comprendre/dda2", array("renderPartial"=>true)); ?></div>
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
<a href="javascript:loadByHash('#default.view.page.comprendre.dir.docs')" class="homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
	<i class="fa fa-arrow-left"></i> Comprendre
</a>
<a href="javascript:loadByHash('#default.view.presentation.pourquoi.dir.docs')"  class="homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
	Présentation <i class="fa fa-arrow-right"></i>
</a>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs("cube", "Modules");
});
</script>



