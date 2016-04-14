
<?php 
    if(isset(Yii::app()->session['userId']))
    	$me = Person::getById(Yii::app()->session['userId']);

    $cssAnsScriptFilesModule = array(
		'/css/default/menu.css',
		'/js/default/menu.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<div class="hover-info col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20">
	<?php echo $this->renderPartial('explainPanels',array("class"=>"explain")); ?>
</div>


<div class="hover-menu hidden-xs">
	

	<?php if(!isset(Yii::app()->session['userId'])){ ?>
		<!-- <button class="menu-button btn-menu btn-login tooltips" data-toggle="tooltip" data-placement="right" title="Se connecter" alt="Se connecter">
				<i class="fa fa-sign-in"></i>
		</button> -->
	<?php }else{ ?>
		<button class="menu-button btn-menu btn-logout bg-red tooltips visible-md" data-toggle="tooltip" data-placement="right" title="Déconnection" alt="Se déconnecter">
				<i class="fa fa-sign-out"></i>
		</button>
	<?php } ?>

	<button class="menu-button menu-button-left menu-button-title btn-menu bg-red btn-geoloc-auto" id="btn-geoloc-auto-menu">
		<i class="fa fa-university"></i>
		<span class="lbl-btn-menu-name-city">
			<?php if(isset( Yii::app()->request->cookies['cityNameCommunexion']) && isset( Yii::app()->request->cookies['cpCommunexion'] )){
					   echo '<span class="lbl-btn-menu-name">'.Yii::app()->request->cookies['cityNameCommunexion'] . ", </span>" . Yii::app()->request->cookies['cpCommunexion'];
				}else{ echo "<span class='lbl-btn-menu-name'>Communectez-moi</span>"; } ?>
		</span>
	</button>

	<?php if(!isset(Yii::app()->session['userId'])){ ?>
	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu0 bg-red tooltips" 
			data-toggle="tooltip" data-placement="right" title="Accueil" alt="Accueil">
			<i class="fa fa-home"></i>
	</button>
	<?php } ?>
	
	<?php if(!isset(Yii::app()->session['userId'])){ ?>
	<!-- <button class="menu-button menu-button-title btn-register btn-menu btn-menu1  <?php echo ($page == 'add') ? 'selected':'';?>" 
			data-toggle="tooltip" data-placement="right" title="S'inscrire" alt="S'inscrire">
			<i class="fa fa-plus-circle"></i>
			<span class="lbl-btn-menu-name">S'inscrire</span>
	</button> -->
	<?php } ?>
	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu2 bg-azure <?php echo ($page == 'directory') ? 'selected':'';?>">
			<i class="fa fa-search"></i>
			<span class="lbl-btn-menu-name">Recherche <span class="text-dark" style="font-size:12px;">communectée</span></span>
	</button>

	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu3 bg-azure <?php echo ($page == 'agenda') ? 'selected':'';?>">
		<i class="fa fa-calendar"></i>
		<span class="lbl-btn-menu-name">L'Agenda <span class="text-dark" style="font-size:12px;">communecté</span></span>
	</button>

	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu4 bg-azure <?php echo ($page == 'news') ? 'selected':'';?>" 
			data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="L'Actu Communectée">
			<i class="fa fa-rss"></i>
			<span class="lbl-btn-menu-name">L'Actualité <span class="text-dark" style="font-size:12px;">communectée</span></span>
	</button>

	<?php if(isset(Yii::app()->session['userId'])){ ?>
	<button class="menu-button menu-button-title btn-menu btn-menu5 bg-dark">
			<span class="lbl-btn-menu-name">Mon répertoire</span>
			<i class="fa fa-bookmark fa-rotate-270"></i>
			
	</button>
	<?php } ?>

	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu6 bg-dark" onclick="loadByHash('#news.index.type.pixels?isSearchDesign=1')">
			<i class="fa fa-bullhorn"></i>
			<span class="lbl-btn-menu-name">Bugs, idées</span></span>
	</button>

	<?php if(isset($me)) if(Role::isSuperAdmin($me['roles'])){?>
    <button class="menu-button menu-button-left menu-button-title btn-menu btn-menu7 bg-dark <?php echo ($page == 'admin') ? 'selected':'';?>" onclick="loadByHash('#admin.index')" >
			<i class="fa fa-cog"></i>
			<span class="lbl-btn-menu-name"><?php echo Yii::t("common", "ADMIN"); ?></span>
	</button>
	<?php } /*?>
	
	<div class="homeShortcuts hide menuShortcuts">
		<ul>
		<li><a href="javascript:scrollTo('#whySection')" title="POURQUOI POURQUI" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		<li><a href="javascript:scrollTo('#wwwSection')" title="UN BIEN COMMUN" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		<li><a href="javascript:scrollTo('#crowfundingSection')" title="CROWDFUNDER" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		<li><a href="javascript:scrollTo('#valueSection')" title="DES VALEURS" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		<li><a href="javascript:scrollTo('#dicoSection')" title="DES MOTS CLEFS" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		<li><a href="javascript:scrollTo('#friendsSection')" title="DES AMIS" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		<li><a href="javascript:scrollTo('#teamSection')" title="COLLABORATIFS" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		<li><a href="javascript:scrollTo('#contactSection')" title="CONTACT" class="tooltips" data-toggle="tooltip" data-placement="right" ><i class="fa fa-dot-circle-o"></i></a></li>
		</ul>
	</div>*/?>

	<div class="infoVersion">
		<a href="javascript:loadByHash('#default.view.page.explain')"><i class="fa fa-book fa-2x text-red"></i></a>
		<?php /*if (isset(Yii::app()->session["userId"])){ ?>
			<span><input type="checkbox" class="removeExplanation" onclick="removeExplainations();"/> Ne plus afficher les panneaux d'explications</span>
		<?php }*/ ?>
		<br/>
		update <?php echo $this->versionDate ?>
		<br/>
		<span class="homestead" style="font-size: 1.5em">version <a href="javascript:;" data-id="explainBeta" class="explainLink text-red">Béta</a></span>
		<br/><span >Tests et améliorations continu</span>
		<br/>
		<?php 
			$lang = 'fr';
			$msglang = '';
			if( Yii::app()->language == 'fr' ){
				$lang = 'en';  
				$msglang = '( 70% translated )';
			}
		?>
    	lang : <a class="homestead text-red" href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/default/switch/lang/'.$lang) ?>" title="switch to <?php echo strtoupper($lang) ?>"><?php echo strtoupper($lang) ?></a> <?php echo $msglang ?>
    
	</div>
</div>
<!-- 
<button class="menu-button menu-button-title bg-red" id="btn-param-postal-code">
	<i class="fa fa-university"></i>
</button> 
<div id="input-communexion">
	<span class="search-loader text-red">Communection : un code postal et c'est parti !</span>
	<input id="searchBarPostalCode" class="input-search text-red" type="text" placeholder="un code postal ?">
</div>
<button class="menu-button menu-button-title btn-menu bg-dark btn-geoloc-auto" id="btn-geoloc-auto-menu">
	<i class="fa fa-crosshairs"></i>
</button> -->



<?php if(isset(Yii::app()->session['userId'])){ ?>
<button class="menu-button menu-button-title btn-menu btn-menu-add hidden-xs" onclick="">
	<span class="lbl-btn-menu-name">Ajouter</span></span>
	<i class="fa fa-plus-circle"></i>
</button>

<div class="drop-up-btn-add">

	<button class="menu-button btn-menu btn-menu-add1 bg-yellow" onclick="loadByHash('#person.invite');" >
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-user"></i>
		<span class="lbl-btn-menu-name-add">inviter quelqu'un</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add2 bg-green" onclick="loadByHash('#organization.addorganizationform');">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-group"></i>
		<span class="lbl-btn-menu-name-add">une organisation</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add3 bg-purple" onclick="loadByHash('#project.projectsv');">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-lightbulb-o"></i>
		<span class="lbl-btn-menu-name-add">un projet</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add4 bg-orange" onclick="loadByHash('#event.eventsv');">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-calendar"></i>
		<span class="lbl-btn-menu-name-add">un événement</span></span>
	</button>
</div>
<?php } ?>



<div class="visible-xs" id="menu-bottom">
	<button class="menu-button menu-button-title bg-red tooltips btn-param-postal-code"
		data-toggle="tooltip" data-placement="bottom" title="modifier communexion" alt="modifier communexion">
		<i class="fa fa-crosshairs"></i>
	</button> 
	<input type="text" class="text-dark input-global-search visible-xs" id="input-global-search-xs" placeholder="rechercher ..."/>
	<?php 
	if(isset(Yii::app()->session['userId'])){ ?>
		<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
		<span class="lbl-btn-menu-name">Ajouter</span></span>
		<i class="fa fa-plus-circle"></i>
		</button>
	<?php } ?>
</div>

<style>



</style>
<div class="globale-announce text-dark">
	<div id="kkbb-min" style="margin-bottom: -12px;">
		<img style="height: 25px; margin-top: -18px;" src="<?php echo $this->module->assetsUrl?>/images/announce-kkbb1.png"/>
		<img style="height: 25px; margin-top: -18px;" src="<?php echo $this->module->assetsUrl?>/images/announce-kkbb2.png"/>
	</div>
	<div id="kkbb-big" style="display:none;">
		<button class="btn btn-default" id="btn-close-globale-announce"><i class="fa fa-times"></i></button>
		<a href="http://www.kisskissbankbank.com/fr/projects/communecter-se-connecter-a-sa-commune" target="_blank"><img class="pull-left" style="width:20%;" 
			 src='<?php echo $this->module->assetsUrl?>/images/piggybank.png'/></a>
		
		<div class="pull-left homestead text-red" style="width:50%; font-size: 23px; margin-left: 10px; margin-top: 15px; line-height: 28px;">
			Du 2 Mars<br/>
			Au 16 avril
		</div>

		
		<a href="http://www.kisskissbankbank.com/fr/projects/communecter-se-connecter-a-sa-commune" target="_blank">
			<img class="pull-right" style="width:42%; margin-top: -33px;" src='<?php echo $this->module->assetsUrl?>/images/crowdfoundez.png'/>
		</a>

		<div class="progress" style="width: 63%; position: absolute; bottom: 25px;">
			<div class="progress-bar bg-red" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">
			    <span id="amount"></span>
			</div>
		</div>

		<div class="pull-left" style="width:100%; margin-top:5px;">
		<div class="pull-left" style="width:50%; font-weight: 600; font-size: 16px; padding-right: 24px; color:black;">Objectif : 20 000€</div>
		<div class="pull-right text-right" style="width:50%; font-weight: 600; font-size: 16px; padding-right: 24px; color:black;">Collecté : <span id="collected"></span></div>
		</div>
	</div>
</div>

<div id="iframe-kkbb" class="hidden">
	<?php 
		$kkbb_html = file_get_contents("http://www.kisskissbankbank.com/fr/projects/communecter-se-connecter-a-sa-commune/widget"); 
		$start = strpos($kkbb_html, "<div class='widget'>");
		$end = strpos($kkbb_html, "<div class='goal'>", $start);
		$kkbb_html = substr($kkbb_html, $start, $end-$start)."</div>";
		echo $kkbb_html;
	?>
</div>



<?php //} ?>
<!-- <button class="menu-button btn-menu btn-menu6 tooltips <?php echo ($page == 'agenda') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="left" title="Ma messagerie" alt="Ma messagerie">
	<i class="fa fa-envelope"></i>
</button> -->


<script type="text/javascript">

var timeoutCommunexion = setTimeout(function(){}, 0);
var showMenuExplanation = <?php echo (@$me["preferences"]["seeExplanations"] || !@Yii::app()-> session["userId"]) ? "true" : "false"; ?>;
jQuery(document).ready(function() {

	realTimeKKBB();
	
	var urlLogout = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";
	bindEventMenu();

});
</script>