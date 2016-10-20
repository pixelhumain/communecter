<?php  HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuTop.css')); ?>
<div class="col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">
	
	<?php // BTN CO = Live // ?>
	<a class="pull-left tooltips hidden-xs lbh" href="#default.live"  id="main-btn-co"
		data-toggle="tooltip" data-placement="bottom" 
		title="Live'n'direct" 
		alt="Live'n'direct">
		<img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
	</a>
	<?php // BTN Doc = Doc // ?>
	<button class="btn-menu btn-menu-top bg-white text-dark tooltips pull-left" 
			id="btn-documentation" data-hash="#default.view.page.index.dir.docs"
			data-toggle="tooltip" data-placement="bottom" title="Lire la documentation" alt="Lire la documentation">
			<i class="fa fa-book"></i>
	</button>

	<?php // BTN MAP // ?>
	<button class="btn-menu btn-menu-top bg-white text-azure tooltips pull-left" 
			id="btn-toogle-map"
			data-toggle="tooltip" data-placement="bottom" title="Carte" alt="Carte">
			<i class="fa fa-map-marker"></i>
	</button>

	<?php // MAIN TITLE // ?>
	<h1 class="homestead text-dark no-padding moduleLabel hidden-xs	
			    <?php if(!isset(Yii::app()->session['userId'])) echo 'offline'; ?>" id="main-title"
		style="font-size:18px;margin-bottom: 0px; display: inline-block;">
	</h1>
	
	<?php // BTN MY COMMUNITY (ONLY LOGED) // ?>
	<?php if(isset(Yii::app()->session['userId'])){ ?>
	<button class="btn-menu btn-menu-top bg-white text-dark tooltips pull-right" id="btn-show-floopdrawer" 
			onclick="showFloopDrawer(true)"
			data-toggle="tooltip" data-placement="bottom" title="Communautés" alt="Afficher mon réseau">
			<i class="fa fa-group"></i>
	</button>
	<?php } ?>

	<?php $this->renderPartial("./menu/short_info_profil", array("me"=>$me)); ?> 

</div>
