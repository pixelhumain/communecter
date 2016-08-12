<?php 
	$cssAnsScriptFilesModule = array('/css/docs/docs.css',  '/js/docs/docs.js');
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

?>
<style>.btn-nav-in-doc { display: none !important; }</style>

<!-- header -->
<?php $this->renderPartial("../docs/docPattern/docHeader", array(
                          "icon" => "cogs",
                          "title" => "Pour quoi faire ?",
                          "stitle" => "Communecter c'est fait pour mille et une choses !",
                          "description" => "",
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
    <div class="item active"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/pourquoi/index.png" class="img-schemas img-responsive "></div>
    <div class="item"><?php //$this->renderPartial("../docs/pourquoi/alternatives", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php //$this->renderPartial("../docs/pourquoi/discuter", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php //$this->renderPartial("../docs/pourquoi/participer", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php //$this->renderPartial("../docs/pourquoi/projets", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php //$this->renderPartial("../docs/pourquoi/acteurs", array("renderPartial"=>true)); ?></div>
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
<a href="#default.view.page.elements.dir.docs" class="lbh homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
	<i class="fa fa-arrow-left"></i> Les 4 éléments
</a>
<a href="#default.view.page.comprendre.dir.docs"  class="lbh homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
	Comprendre <i class="fa fa-arrow-right"></i>
</a>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs("cogs", "pour quoi faire ?");
});
</script>



