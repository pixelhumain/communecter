<?php 
	$cssAnsScriptFilesModule = array('/css/default/docs.css');
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<div class="panel-heading border-light text-dark partition-white radius-10">
    <span class=" text-dark homestead tpl_title"><i class="fa fa-binoculars"></i> Documentation</span><br>
    <div class="col-md-12 btn-elements hidden">
		<button class="btn btn-default bg-yellow"></i> <i class="fa fa-user fa-2x"></i></button>
	    <button class="btn btn-default bg-green"></i> <i class="fa fa-users fa-2x"></i></button>
	    <button class="btn btn-default bg-purple"></i> <i class="fa fa-lightbulb-o fa-2x"></i></button>
	    <button class="btn btn-default bg-orange"></i> <i class="fa fa-calendar fa-2x"></i></button>
    </div>
    <span class="tpl_shortDesc col-md-12">
    	<span class=" text-red homestead tpl_title2">1- Les 4 éléments</span><br>
	    <span class=" text-dark homestead">Citoyens, organisations, projets, événements</span><br>
	    Communecter s'appuie sur quatres éléments pour mettre en lumière ceux qui imaginent, organisent et mettent en place les solutions de demain ...
    </span><br/><br/>
    
    <br/>
</div>

<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#docCarousel" data-slide-to="1"></li>
    <li data-target="#docCarousel" data-slide-to="2"></li>
    <li data-target="#docCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    
    <div class="item active"><?php $this->renderPartial("../docs/person"); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/organisation"); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/projects"); ?></div>
    <div class="item"><?php $this->renderPartial("../docs/events"); ?></div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#docCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#docCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<script type="text/javascript">
jQuery(document).ready(function() {
  $(".moduleLabel").html(
  			"<i class='fa fa-connectdevelop'></i> "+
  			"<span class='text-red'>Commune<span class='text-dark'>cter</span> : la doc</span>");
});
</script>



