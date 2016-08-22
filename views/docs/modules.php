<?php 
	$cssAnsScriptFilesModule = array('/css/docs/docs.css',  '/js/docs/docs.js');
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

  $slide = isset($_GET["slide"]) ? $_GET["slide"] : "";
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
    <li data-target="#docCarousel" data-slide-to="0" class="<?php if($slide=='') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="1" class="<?php if($slide=='news') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="2" class="<?php if($slide=='sig') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="3" class="<?php if($slide=='agenda') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="4" class="<?php if($slide=='annuaire') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="5" class="<?php if($slide=='dda') echo "active"; ?>"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item <?php if($slide=='') echo "active"; ?>"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/modules/index.png" class="img-schemas img-responsive "></div>
    <div class="item <?php if($slide=='news') echo "active"; ?>"><?php $this->renderPartial("../docs/modules/news", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='sig') echo "active"; ?>">      <?php $this->renderPartial("../docs/modules/sig", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='agenda') echo "active"; ?>">   <?php $this->renderPartial("../docs/modules/agenda", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='annuaire') echo "active"; ?>"> <?php $this->renderPartial("../docs/modules/annuaire", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='dda') echo "active"; ?>">      <?php $this->renderPartial("../docs/comprendre/dda2", array("renderPartial"=>true)); ?></div>
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
<!--<a href="javascript:loadByHash('#default.view.page.comprendre.dir.docs')" class="homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
	<i class="fa fa-arrow-left"></i> Comprendre
</a>-->
<a href="#default.view.page.elements.dir.docs" class="lbh homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
  <i class="fa fa-arrow-left"></i> 4 Elements
</a>

<a href="#default.view.page.presentation.dir.docs"  class="lbh homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
	Présentation <i class="fa fa-arrow-right"></i>
</a>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs("cube", "Modules");
});
</script>



