<?php 
  $this->renderPartial("../docs/assets");
  $slide = isset($_GET["slide"]) ? $_GET["slide"] : "";
?>
<style>.btn-nav-in-doc { display: none !important; }</style>

<!-- header -->
<?php $this->renderPartial("../docs/docPattern/docHeader", array(
                          "icon" => "bullhorn",
                          "title" => "Communication",
                          "stitle" => "un bien commun à partager sans modération",
                          "description" => "Merci de nous aider à faire connaître communecter au quotidien !".
                                          "<br/> <span class='text-red text-bold'>* Pixel Humain</span> est le nom initial du projet avant de devenir Communecter ",
)); ?>

<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Round button indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="<?php if($slide=='affiches' || $slide == '') echo "active"; ?>"></li>
    <li data-target="#docCarousel" data-slide-to="1" class="<?php if($slide=='video') echo "active"; ?>"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item <?php if($slide=='affiches' || $slide == '') echo "active"; ?>"><?php $this->renderPartial("../docs/communication/affiches", array("renderPartial"=>true)); ?></div>
    <div class="item <?php if($slide=='video') echo "active"; ?>"><?php $this->renderPartial("../docs/communication/video", array("renderPartial"=>true)); ?></div>
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
<a href="#default.view.page.presentation.dir.docs" class="lbh homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
	<i class="fa fa-arrow-left"></i> Présentation
</a>
<!--<a href="#default.view.page.histoire.dir.docs')"  class="homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
	L'histoire <i class="fa fa-arrow-right"></i>
</a>-->

<a href="#default.view.page.rd.dir.docs"  class="lbh homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
  R&D <i class="fa fa-arrow-right"></i>
</a>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs("bullhorn", "Communication");
});
</script>



