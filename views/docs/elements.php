<?php 
$this->renderPartial("../docs/assets");

  $slide = isset($_GET["slide"]) ? $_GET["slide"] : "";
?>
<style>.btn-nav-in-doc { display: none !important; }</style>

<!-- header -->
<?php $this->renderPartial("../docs/docPattern/docHeader", array(
                          "icon" => "cubes",
                          "title" => "Les 4 éléments",
                          "stitle" => 
                           '<span class="text-yellow">Citoyens</span> 
                            <span class="text-green">organisations</span> 
                            <span class="text-purple">projets</span> 
                            <span class="text-orange">événements</span>',
                          "description" => "Communecter s'appuie sur quatres éléments pour mettre en lumière ceux qui imaginent, organisent et mettent en place les solutions de demain ...",
)); ?>

<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="bg-red    <?php if($slide=='') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="1" class="bg-yellow <?php if($slide=='person') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="2" class="bg-green  <?php if($slide=='organisation') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="3" class="bg-purple <?php if($slide=='projects') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="4" class="bg-orange <?php if($slide=='events') echo "active"; ?>"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    
    <div class="item <?php if($slide=='') echo "active"; ?>"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/elements/index.png" class="img-schemas img-responsive "></div>
    <div class="item <?php if($slide=='person') echo "active"; ?>"><?php $this->renderPartial("../docs/elements/person", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='organisation') echo "active"; ?>"><?php $this->renderPartial("../docs/elements/organisation", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='projects') echo "active"; ?>"><?php $this->renderPartial("../docs/elements/projects", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='events') echo "active"; ?>"><?php $this->renderPartial("../docs/elements/events", array("renderPartial"=>true)); ?></div>
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

<!-- <a href="javascript:"  class="homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
  Pour quoi faire ? <i class="fa fa-arrow-right"></i>
</a> -->
<a href="#default.view.page.modules.dir.docs"  class="lbh homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
  Modules <i class="fa fa-arrow-right"></i>
</a>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs("cubes", "Les 4 éléments");
});
</script>
