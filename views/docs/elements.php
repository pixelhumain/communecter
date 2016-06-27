<?php 
	$cssAnsScriptFilesModule = array('/css/docs/docs.css');
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>.btn-nav-in-doc { display: none !important; }</style>

<div class="panel-heading border-light text-dark partition-white radius-10">
	<span class="text-dark homestead tpl_title">
		<a href="javascript:loadByHash('#default.view.page.index.dir.docs')" class="pull-left">
			<i class="fa fa-arrow-circle-left" style="margin-right:15px;"></i> 
			<i class="fa fa-binoculars"></i> Documentation
		</a>
		<?php $this->renderPartial("../docs/docPattern/docIndex"); ?>
	</span>
    <br>
    <div class="col-md-12 btn-elements hidden">
		<button class="btn btn-default bg-red"></i> <i class="fa fa-university fa-2x"></i></button>
		<button class="btn btn-default bg-yellow"></i> <i class="fa fa-user fa-2x"></i></button>
	    <button class="btn btn-default bg-green"></i> <i class="fa fa-users fa-2x"></i></button>
	    <button class="btn btn-default bg-purple"></i> <i class="fa fa-lightbulb-o fa-2x"></i></button>
	    <button class="btn btn-default bg-orange"></i> <i class="fa fa-calendar fa-2x"></i></button>
    </div>
    <span class="tpl_shortDesc col-md-7">
    	<span class=" text-red homestead tpl_title2"><i class="fa fa-cubes"></i> Les 4 éléments</span><br>
	    <span class=" text-dark homestead">
	    	<span class="text-yellow">Citoyens</span> 
	    	<span class="text-green">organisations</span> 
	    	<span class="text-purple">projets</span> 
	    	<span class="text-orange">événements</span>
	    </span><br>
	    <?php //echo $_GET["slide"]; ?>
	    Communecter s'appuie sur quatres éléments pour mettre en lumière ceux qui imaginent, organisent et mettent en place les solutions de demain ...
    </span><br/><br/>
    
    <br/>
</div>

<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="active bg-red"></li>
    <li data-target="#docCarousel" data-slide-to="1" class="bg-yellow"></li>
    <li data-target="#docCarousel" data-slide-to="2" class="bg-green"></li>
    <li data-target="#docCarousel" data-slide-to="3" class="bg-purple"></li>
    <li data-target="#docCarousel" data-slide-to="4" class="bg-orange"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    
    <div class="item active"><img src="<?php echo $this->module->assetsUrl; ?>/images/docs/elements/index.png" class="img-schemas img-responsive "></div>
    <div class="item"><?php $this->renderPartial("../docs/elements/person", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/elements/organisation", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/elements/projects", array("renderPartial"=>true)); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/elements/events", array("renderPartial"=>true)); ?></div>
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
<a href="javascript:" class="homestead text-extra-large bg-red pull-left tooltips radius-5 padding-10 homestead pull-left btn-carousel-previous">
  <i class="fa fa-arrow-left"></i> Nom du chapitre Précédent
</a>
<a href="javascript:"  class="homestead text-extra-large bg-red pull-right tooltips radius-5 padding-10 homestead btn-carousel-next">
  Nom du chapitre Suivant <i class="fa fa-arrow-right"></i>
</a>

<script type="text/javascript">
jQuery(document).ready(function() {
  initDocJs();
});
</script>
