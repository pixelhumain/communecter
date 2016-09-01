<style>
	@media screen and (min-width: 767px) and (max-width: 920px){
	.main-top-menu .moduleLabel {
    	max-width: 19% !important;
	}

}
@media screen and (min-width: 920px) and (max-width: 1130px) {
	.main-top-menu .moduleLabel {
    	max-width: 32% !important;
	}
}

#btn-menu-launch{
	padding: 12px;
	margin-left: 1px;
	box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
}
#btn-toogle-map{
	margin-right: 10px;
	padding-top: 8px !important;
	box-shadow: 0px -1px 4px -1px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 0px -1px 4px -1px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 0px -1px 4px -1px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 0px -1px 4px -1px rgba(66, 66, 66, 0.79) !important;
}

#btn-toogle-map:hover{
	box-shadow: 0px -1px 4px 0px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 0px -1px 4px 0px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 0px -1px 4px 0px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 0px -1px 4px 0px rgba(66, 66, 66, 0.79) !important;
}
#main-btn-co{
	margin-right:5px;
	box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 4px 0px 5px -4px rgba(66, 66, 66, 0.79) !important;
}
#main-btn-co:hover{
	box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
}

#logo-main-menu{
	float:left;
	font-size: 24px;
	width: 45px;
	height: 50px;
	padding: 5px;
	top: 0px;
	z-index: 15;
	background-color: rgb(255, 255, 255);
	display: inline;
	margin-right: 10px;
}
#logo-main-menu{

}
#btn-menu-launch:hover{
	box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 4px 0px 5px -2px rgba(66, 66, 66, 0.79) !important;
}

.mainLabel {
    font-size: 21px;
	margin-bottom: 0px;
	margin-left: -17px;
	margin-top: 16px;
	display: inline-block;
}
#main-title {
    margin-top: 16px !important;
}


@media screen and (max-width: 767px){
	#notificationPanelSearch{
		position: fixed;
		top: 51px;
		right: 50px;
		width: 300px;
		/*max-height: 80%;
		overflow-y: auto;
		background-color: white;
		padding-top: 10px;
		padding-bottom: 10px;
		border-radius: 0px 0px 10px 10px;*/
	}
	#main-btn-co{
		margin-right:0px;
	}
	button.btn-menu-notif{
		margin-right: -10px;
	}
}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 main-top-menu no-padding"  data-tpl="default.menu.menuTop">
	
	<a class="pull-left text-dark" href="javascript:openMenuSmall();"  id="btn-menu-launch">
		<i class="fa fa-bars fa-2x"></i>
	</a>

	<button class="btn-menu btn-menu-top bg-white text-azure tooltips pull-left" 
			id="btn-toogle-map"
			data-toggle="tooltip" data-placement="bottom" title="Carte" alt="Carte">
			<i class="fa fa-map-marker"></i>
	</button>

	<a class="pull-left tooltips hidden-xs lbh" href="#default.view.page.index.dir.docs"  id="main-btn-co"
		data-toggle="tooltip" data-placement="bottom" 
		title="Lire la documentation" 
		alt="Lire la documentation">
		<img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
		<i class="fa fa-question-circle hidden" style="margin-top: 20px;margin-left: -14px;margin-right: 10px;"></i>
	</a>

	<h1 class="homestead text-dark no-padding moduleLabel hidden-xs" id="main-title"
		style="font-size:18px;margin-bottom: 0px; display: inline-block;">
	</h1>
	


	<?php if(isset(Yii::app()->session['userId'])){ ?>
	<button class="btn-menu btn-menu-top bg-white text-dark tooltips pull-right" id="btn-show-floopdrawer" 
			onclick="showFloopDrawer(true)"
			data-toggle="tooltip" data-placement="bottom" title="Communautés" alt="Afficher mes contacts">
			<i class="fa fa-group"></i>
	</button>
	<?php } ?>

	<?php $this->renderPartial("./menu/short_info_profil", array("me"=>$me)); ?> 

	
</div>