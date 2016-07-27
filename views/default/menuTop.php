<style>
	@media screen and (min-width:: 767px) and (max-width: 920px){
	.main-top-menu .moduleLabel {
    	max-width: 42% !important;
	}

}
@media screen and (min-width: 900px) and (max-width: 1130px) {
	.main-top-menu .moduleLabel {
    	max-width: 50% !important;
	}


	/*.box-ajaxTools{
		width:95%;
		margin-left:5%;
	}*/
}

#btn-menu-launch{
	padding: 12px;
	margin-right: 10px;
	margin-left: 1px;
	box-shadow: 1px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 1px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 1px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 1px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
}


#logo-main-menu{
	float:left;
	font-size: 24px;
	width: 45px;
	height: 50px;
	padding: 5px;
	top: 0px;
	z-index: 15;
	/*margin-left: -40px;
	border-radius: 0px 0px 0px 10px !important;*/
	background-color: rgb(255, 255, 255);
	display: inline;
	margin-right: 10px;
	/*box-shadow: -3px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: -3px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: -3px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;
	box-shadow: -3px 0px 5px -1px rgba(66, 66, 66, 0.79) !important;*/
}
#logo-main-menu{

}
#btn-menu-launch:hover{
	box-shadow: 1px 0px 5px 1px rgba(66, 66, 66, 0.79) !important;
}

.mainLabel {
    font-size: 21px;
	margin-bottom: 0px;
	margin-left: -17px;
	margin-top: 16px;
	display: inline-block;
}
</style>

<div class="col-md-12 col-sm-12 col-xs-12 main-top-menu no-padding">
	
	
	<a class="pull-left text-dark" href="javascript:openMenuSmall();"  id="btn-menu-launch">
		<!-- <i class="fa fa-bars"></i> -->
		<i class="fa fa-bars fa-2x"></i>
	</a>

	<a class="pull-left" href="javascript:loadByHash('#default.view.page.index.dir.docs')"  id="main-btn-co">
		<!-- <i class="fa fa-bars"></i> -->
		<img class="" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
	</a>

	<h1 class="homestead text-dark no-padding mainLabel" >
		<span id="main-title-menu"></span> <span class="text-red">MMUNE</span>CTER 
		<a href="javascript:loadByHash('#default.home')"><i class="fa fa-question-circle"></i></a>
	</h1>
	
	<?php if(isset(Yii::app()->session['userId'])) { ?>
	<a class="pull-left hidden" href="javascript:loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>')" class="hidden-xs" id="main-btn-co">
		<!--<h1 class="homestead text-dark no-margin padding-15"><span class="text-red">COMMUNE</span>CTER</h1>-->
		<img class="hidden-xs" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
	</a>
	<?php }else{ ?> 
	<a class="pull-left hidden"  href="javascript:loadByHash('#default.home')" class="hidden-xs" >
		<img class="hidden-xs" id="logo-main-menu" src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
	</a>
	<?php } ?>

	<?php 
		if(!isset($me)) $me = "";
	 	$this->renderPartial("menuSmall", array("me"=>$me)); 
	?> 
	
	


	<button class="btn-menu btn-menu-top bg-white text-azure tooltips pull-right" id="btn-toogle-map"
			data-toggle="tooltip" data-placement="bottom" title="Carte" alt="Carte">
			<i class="fa fa-map-marker"></i>
	</button>
	<?php if(isset(Yii::app()->session['userId'])){ ?>
	<button class="btn-menu btn-menu-top bg-white text-dark tooltips pull-right" id="btn-show-floopdrawer" 
			onclick="showFloopDrawer(true)"
			data-toggle="tooltip" data-placement="bottom" title="Communautés" alt="Afficher mes contacts">
			<i class="fa fa-group"></i>
	</button>
	<?php } ?>

	<?php $this->renderPartial("short_info_profil", array("me"=>$me)); ?> 


</div>