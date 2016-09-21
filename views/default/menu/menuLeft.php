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
		<?php // TOP // ?>
		<a href="#default.live" id="menu-btn-live"
				class="lbh menu-button-left lbh
				<?php echo ($page == 'live') ? 'selected':'';?>">
			<i class="fa fa-thumbs-up  tooltips"
				data-toggle="tooltip" data-placement="right" title="Live"></i> 
			<span class="lbl-btn-menu">TOP</span>
		</a>
		<hr>

		<?php // LIVE // ?>
		<a href="#default.live" id="menu-btn-live"
				class="lbh menu-button-left lbh
				<?php echo ($page == 'live') ? 'selected':'';?>">
			<i class="fa fa-heartbeat  tooltips"
				data-toggle="tooltip" data-placement="right" title="Live"></i> 
			<span class="lbl-btn-menu">Live</span>
		</a>
		<hr>

		<?php // RECHERCHER // ?>
		<a href="#default.directory" id="menu-btn-directory"
				class="menu-button-left lbh
				<?php echo ($page == 'directory') ? 'selected':'';?>">
			<i class="fa fa-search tooltips"
				data-toggle="tooltip" data-placement="right" title="Rechercher"></i> 
			<span class="lbl-btn-menu">Rechercher</span>
		</a>
		<hr>

		<?php // AGENDA // ?>
		<a href="#default.agenda" id="menu-btn-agenda"
				class="menu-button-left lbh 
				<?php echo ($page == 'agenda') ? 'selected':'';?>">
			<i class="fa fa-calendar tooltips"
				data-toggle="tooltip" data-placement="right" title="Agenda"></i> 
			<span class="lbl-btn-menu">Agenda</span>
		</a>
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:openForm ( 'event' );" class="menu-button-left pull-right lbl-btn-menu">
			<i class="fa text-red fa-plus-circle tooltips" data-toggle="tooltip" data-placement="right" title="Ajouter un évènement"></i> 
		</a>
		<?php } ?>
		<hr>

		<?php // Organisation // ?>
		<a href="#default.directory?type=organization" id="menu-btn-organization"
				class="menu-button-left lbh 
				<?php echo ($page == 'agenda') ? 'selected':'';?>">
			<i class="fa fa-group tooltips"
				data-toggle="tooltip" data-placement="right" title="Organisations"></i> 
			<span class="lbl-btn-menu">Organisations</span>
		</a>
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:openForm ( 'organization' );" class="menu-button-left pull-right lbl-btn-menu">
			<i class="fa text-red fa-plus-circle tooltips" data-toggle="tooltip" data-placement="right" title="Ajouter une organisation"></i> 
		</a>
		<?php } ?>
		<hr>

		<?php // Projet // ?>
		<a href="#default.directory?type=project" id="menu-btn-project"
				class="menu-button-left  lbh
				<?php echo ($page == 'agenda') ? 'selected':'';?>">
			<i class="fa fa-lightbulb-o tooltips"
				data-toggle="tooltip" data-placement="right" title="Projets"></i> 
			<span class="lbl-btn-menu">Projets</span>
		</a>
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:openForm ( 'project' );" class="menu-button-left pull-right lbl-btn-menu">
			<i class="fa text-red fa-plus-circle tooltips" data-toggle="tooltip" data-placement="right" title="Ajouter un projet"></i> 
		</a>
		<?php } ?>
		<hr>

		<?php // People // ?>
		<a href="#default.directory?type=person"  id="menu-btn-people"
				class="menu-button-left  lbh
				<?php echo ($page == 'agenda') ? 'selected':'';?>">
			<i class="fa fa-user tooltips"
				data-toggle="tooltip" data-placement="right" title="Personnes"></i> 
			<span class="lbl-btn-menu">Personnes</span>
		</a>
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:openForm ( 'person' );" class="menu-button-left pull-right lbl-btn-menu">
			<i class="fa text-red fa-plus-circle tooltips" data-toggle="tooltip" data-placement="right" title="Inviter quelqu'un"></i> 
		</a>
		<?php } ?>
		<hr>


		<?php // Débat // ?>
		<a href="#default.directory?type=vote" id="menu-btn-vote"
				class="menu-button-left  lbh
				<?php echo ($page == 'agenda') ? 'selected':'';?>">
			<i class="fa fa-gavel tooltips"
				data-toggle="tooltip" data-placement="right" title="Débats"></i> 
			<span class="lbl-btn-menu">Débats</span>
		</a>
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:openForm ( 'vote' );" class="menu-button-left pull-right lbl-btn-menu">
			<i class="fa text-red fa-plus-circle tooltips" data-toggle="tooltip" data-placement="right" title="Ajouter une proposition"></i> 
		</a>
		<?php } ?>
		<hr>

		<?php // Action // ?>
		<a href="#default.directory?type=action" id="menu-btn-action"
				data-hash="#default.directory"
				class="menu-button-left lbh
				<?php echo ($page == 'agenda') ? 'selected':'';?>">
			<i class="fa fa-cogs tooltips"
				data-toggle="tooltip" data-placement="right" title="Actions"></i> 
			<span class="lbl-btn-menu">Actions</span>
		</a>
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:openForm ( 'action' );" class="menu-button-left pull-right lbl-btn-menu">
			<i class="fa text-red fa-plus-circle tooltips" data-toggle="tooltip" data-placement="right" title="Ajouter une actions"></i> 
		</a>
		<?php } ?>
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