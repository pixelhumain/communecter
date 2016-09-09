<?php 

    if(isset(Yii::app()->session['userId']))
    	$me = Person::getById(Yii::app()->session['userId']);
    
    $newsToModerate = count(News::getNewsToModerate());

    $cssAnsScriptFilesModule = array(
		'/css/default/menu.css',
		'/css/menus/menuLeft.css',
		'/js/default/menu.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>
.footer-menu-left{
	/*background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/footer_menu_left.png");*/
	background-image: url("<?php echo $this->module->assetsUrl; ?>/images/people.jpg");
}
</style>

<div class="hover-info col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20" >
	<?php echo $this->renderPartial('explainPanels',array("class"=>"explain")); ?>
</div>

<div class="hover-info2 col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20"></div>


<div class="hidden-xs main-menu-left col-md-2 col-sm-2 padding-10"  data-tpl="menuLeft">
	
	<div class="menu-left-container">

		<?php // MON PROFIL // ?>
		
		<?php if (isset(Yii::app()->session['userId']) && !empty($me)) {
		          $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
		} ?>
		
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="#person.detail.id.<?php echo Yii::app()->session['userId'] ?>"
				class="menu-button menu-button-left menu-button-title btn-menu lbh
				<?php echo ($page == 'myProfil') ? 'selected':'';?>">
				<img class="img-circle tooltips" id="menu-left-thumb-profil" width="24" height="24"
					 data-toggle="tooltip" data-placement="right" 
					 title="Mon profil : <?php echo $me["name"]; ?>"
					 src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
    
				<i class="fa fa-user tooltips hidden"
					data-toggle="tooltip" data-placement="right" 
					title="Mon profil : <?php echo $me["name"]; ?>"></i> 
				<span class="lbl-btn-menu"><?php echo $me["name"]; ?></span>
		</a>
		<hr>
		<?php } ?>

		<?php // MA COMMUNE / COMMUNECTEZ VOUS
		
			$cityExists = (isset($myCity) && $myCity != "" && isset($myCity["cp"]) && isset($myCity["insee"]));
			$title = $cityExists ? $myCity["name"] : "Communectez-vous";
			$hash = "javascript:"; //$cityExists ? "#city.detail.insee.".$myCity["insee"].".postalCode.".$myCity["cp"] : "";
			$onclick = $cityExists ? "loadByHash('#city.detail.insee.".$myCity["insee"].".postalCode.".$myCity["cp"] + "')" 
								   : "openDropdownMultiscope()";
		?>
		
		<a href="<?php echo $hash; ?>" onclick="<?php echo $onclick; ?>"
			class="menu-button-left lbl-btn-menu-name-city menu-button-title btn-menu text-red btn-geoloc-auto" 
			id="btn-geoloc-auto-menu">
			
			<i class="fa fa-home tooltips"
					data-toggle="tooltip" data-placement="right" title="Ma commune : <?php echo $title; ?>"></i>
			<span class="lbl-btn-menu">
				<?php echo $title; ?>
			</span>
		</a>
		<hr>
		
		<br>
		<?php // LIVE // ?>
		<a href="#default.live" id="menu-btn-live"
				data-hash="#default.live"
				class="lbh menu-button-left
				<?php echo ($page == 'live') ? 'selected':'';?>">
				<i class="fa fa-heartbeat  tooltips"
					data-toggle="tooltip" data-placement="right" title="Live"></i> 
				<span class="lbl-btn-menu">Live</span>
		</a>
		<hr>

		<?php // RECHERCHER // ?>
		<a href="javascript:loadByHash('#default.directory')" id="menu-btn-directory"
				data-hash="#default.directory"
				class="menu-button-left  
				<?php echo ($page == 'directory') ? 'selected':'';?>">
				<i class="fa fa-search tooltips"
					data-toggle="tooltip" data-placement="right" title="Rechercher"></i> 
				<span class="lbl-btn-menu">Rechercher</span>
		</a>
		<hr>

		<?php // AGENDA // ?>
		<a href="javascript:loadByHash('#default.agenda')" id="menu-btn-agenda"
				data-hash="#default.agenda"
				class="menu-button-left 
				<?php echo ($page == 'agenda') ? 'selected':'';?>">
				<i class="fa fa-calendar tooltips"
					data-toggle="tooltip" data-placement="right" title="Agenda"></i> 
				<span class="lbl-btn-menu">Agenda</span>
		</a>
		<hr>
		
		<br>

		<?php // FAIRE UN DON // ?>
		<a style="margin-bottom:5px;float:left;" 
			href="https://www.helloasso.com/associations/open-atlas" target="_blank"
			class="menu-button-left">
				<i class="fa fa-gift tooltips"
					data-toggle="tooltip" data-placement="right" title="Faire un don"></i> 
					<!-- <i class="fa fa-gift"></i> -->
					<span class="lbl-btn-menu">Faire un don</span>
		</a>
		<br>

		<hr style="float: left; width: 100%; border-color: transparent ! important; margin: 0px;">

		<a href="https://www.helloasso.com/associations/open-atlas/adhesions/soutenez-et-adherez-a-open-atlas" 
			target="_blank" class="helloasso tooltips pull-left"
			data-toggle="tooltip" data-placement="right" title="soutenir communecter">
			<img class="lbl-btn-menu" src="<?php echo $this->module->assetsUrl?>/images/helloasso-logo.png"/>
		</a>

	</div>

	<?php echo $this->renderPartial('version'); ?>
	
</div>

<?php 
	if(!isset($me)) $me = "";
 	$this->renderPartial("./menu/menuSmall", 
 					array(  "me"=>$me,
 			 				"myCity" => $myCity)); 
?> 

<?php // ?>
<div class="visible-xs" id="menu-bottom">
	<input type="text" class="text-dark input-global-search visible-xs" id="input-global-search-xs" placeholder="rechercher ..."/>
	<?php 
	if(isset(Yii::app()->session['userId']) && false){ ?>
		<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
		<span class="lbl-btn-menu-name">Ajouter</span></span>
		<i class="fa fa-plus-circle"></i>
		</button>
	<?php } ?>
</div>


<script type="text/javascript">

var timeoutCommunexion = setTimeout(function(){}, 0);
var showMenuExplanation = <?php echo (@$me["preferences"]["seeExplanations"] || !@Yii::app()->session["userId"]) ? "true" : "false"; ?>;
var urlLogout = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";
jQuery(document).ready(function() {

	showMenuExplanation = false;
	
	bindEventMenu();
	
	$(".menu-button-left").mouseenter(function(){
		$(this).addClass("active");
	});
	$(".menu-button-left").mouseout(function(){
		$(this).removeClass("active");
	});
	$(".menu-button-left").click(function(){
		$(".menu-button-left").removeClass("selected");
		$(this).addClass("selected");
	});

	<?php if($myCity == null){ ?>
		$(".visible-communected").hide(400);
		$(".hide-communected").show(400);
	<?php } ?>
});
</script>