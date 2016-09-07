
<?php  HtmlHelper::registerCssAndScriptsFiles(array('/css/menus/menuTop.css'), $this->module->assetsUrl); ?>

<div class="col-md-12 col-sm-12 col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">
	
	<?php // BTN MENU LAUNCH // ?>
	<a class="pull-left text-dark" href="javascript:openMenuSmall();"  id="btn-menu-launch">
		<i class="fa fa-bars fa-2x"></i>
	</a>

	<?php // BTN MAP // ?>
	<button class="btn-menu btn-menu-top bg-white text-azure tooltips pull-left" 
			id="btn-toogle-map"
			data-toggle="tooltip" data-placement="bottom" title="Carte" alt="Carte">
			<i class="fa fa-map-marker"></i>
	</button>

	<?php // BTN CO = DOCUMENTATION // ?>
	<a class="pull-left tooltips hidden-xs lbh" href="#default.view.page.index.dir.docs"  id="main-btn-co"
		data-toggle="tooltip" data-placement="bottom" 
		title="Lire la documentation" 
		alt="Lire la documentation">
		<img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
		<i class="fa fa-question-circle hidden" style="margin-top: 20px;margin-left: -14px;margin-right: 10px;"></i>
	</a>

	<?php // MAIN TITLE // ?>
	<h1 class="homestead text-dark no-padding moduleLabel hidden-xs" id="main-title"
		style="font-size:18px;margin-bottom: 0px; display: inline-block;">
	</h1>
	
	<?php // BTN MY COMMUNITY (ONLY LOGED) // ?>
	<?php if(isset(Yii::app()->session['userId'])){ ?>
	<button class="btn-menu btn-menu-top bg-white text-dark tooltips pull-right" id="btn-show-floopdrawer" 
			onclick="showFloopDrawer(true)"
			data-toggle="tooltip" data-placement="bottom" title="Communautés" alt="Afficher mes contacts">
			<i class="fa fa-group"></i>
	</button>
	<?php } ?>

	<?php $this->renderPartial("./menu/short_info_profil", array("me"=>$me)); ?> 

</div>