
<?php 
    if(isset(Yii::app()->session['userId']))
    	$me = Person::getById(Yii::app()->session['userId']);
    	$newsToModerate = count(News::getNewsToModerate());

    HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/default/menu.css', Yii::app()->theme->baseUrl));
	HtmlHelper::registerCssAndScriptsFiles(array('/js/default/menu.js'), $this->module->assetsUrl);
?>
<?php 
	$inseeCommunexion = "";
	$cpCommunexion = "";
	$cityNameCommunexion = "";

	$inseeCommunexion 	 = isset( Yii::app()->request->cookies['inseeCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['inseeCommunexion'] : "";
	
	$cpCommunexion 		 = isset( Yii::app()->request->cookies['cpCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['cpCommunexion'] : "";
	
	$cityNameCommunexion = isset( Yii::app()->request->cookies['cityNameCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['cityNameCommunexion'] : "";

	if($cpCommunexion != "" && $cityNameCommunexion != "")
	$cityCommunexion = City::getCityByInseeCp($inseeCommunexion->value, $cpCommunexion->value);

	//si l'utilisateur n'est pas connecté
 	if(!isset(Yii::app()->session['userId'])){
		if($cpCommunexion != "" && $cityNameCommunexion != "")
		$myCity = City::getCityByInseeCp($inseeCommunexion->value, $cpCommunexion->value);
	}
	//si l'utilisateur est connecté
	else{
		$me = Person::getById(Yii::app()->session['userId']);
		$inseeCommunexion 	 = isset( $me['address']['codeInsee'] ) ? 
		   			    			  $me['address']['codeInsee'] : "";
		
		$cpCommunexion 		 = isset( $me['address']['postalCode'] ) ? 
		   			    			  $me['address']['postalCode'] : "";
		
		$cityNameCommunexion = isset( $me['address']['addressLocality'] ) ? 
		   			    			  $me['address']['addressLocality'] : "";
		
		$myCity = City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);
	}

	

?>

<style>
	<?php 	//masque les boutons Directory, Agenda, News si l'utilisateur n'est pas communecté
			if(!isset( Yii::app()->request->cookies['inseeCommunexion'] )) {  
	?>
		button.btn-menu2, .btn-menu3, .btn-menu4, .btn-menu9{
			display: none;
		}
	<?php } ?>
</style>

<div class="hover-info col-sm-10 col-sm-offset-1 hidden-xs panel-white padding-20">
	<?php echo $this->renderPartial('explainPanels',array("class"=>"explain")); ?>
</div>


<div class="hover-menu hidden-xs">
	

	<?php /* if(!isset(Yii::app()->session['userId'])){ ?>
		<!-- <button class="menu-button btn-menu btn-login tooltips" data-toggle="tooltip" data-placement="right" title="Se connecter" alt="Se connecter">
				<i class="fa fa-sign-in"></i>
		</button> -->
	<?php }else{ ?>
			<button class="menu-button btn-menu btn-logout bg-red tooltips hidden-sm" data-toggle="tooltip" data-placement="right" title="Déconnection" alt="Se déconnecter">

				<i class="fa fa-sign-out"></i>
		</button>
	<?php } */ ?>

	<button class="menu-button menu-button-left menu-button-title btn-menu bg-red btn-geoloc-auto hidden-sm" id="btn-geoloc-auto-menu">
		<i class="fa fa-university"></i>
		<span class="lbl-btn-menu-name-city">
			<?php if($inseeCommunexion != "" && $cpCommunexion != ""){
					   echo '<span class="lbl-btn-menu-name hidden-sm">'.$cityNameCommunexion . ", </span>" . $cpCommunexion;
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
			<span class="fa-stack">
				<i class="fa fa-university fa-stack-1x"></i>
				<i class="fa fa-search fa-stack-1x stack-right-bottom text-dark" style="font-size:15px;"></i>
			</span>	
			<!--<i class="fa fa-search"></i>-->
			<span class="lbl-btn-menu-name">Recherche <span class="text-dark" style="font-size:12px;">communectée</span></span>
	</button>

	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu3 bg-azure <?php echo ($page == 'agenda') ? 'selected':'';?>">
			<span class="fa-stack">
				<i class="fa fa-university fa-stack-1x"></i>
				<i class="fa fa-calendar fa-stack-1x stack-right-bottom text-dark" style="font-size:15px;"></i>
			</span>	
		<!--<i class="fa fa-calendar"></i>-->
		<span class="lbl-btn-menu-name">L'Agenda <span class="text-dark" style="font-size:12px;">communecté</span></span>
	</button>

	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu4 bg-azure <?php echo ($page == 'news') ? 'selected':'';?>" 
			data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="L'Actu Communectée">
			<span class="fa-stack">
				<i class="fa fa-university fa-stack-1x"></i>
				<i class="fa fa-rss fa-stack-1x stack-right-bottom text-dark" style="font-size:15px;"></i>
			</span>	
			<span class="lbl-btn-menu-name">L'Actualité <span class="text-dark" style="font-size:12px;">communectée</span></span>
	</button>
	
	<?php if(isset($cityCommunexion)) { ?>
	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu11 bg-azure lbh" id="btn-citizen-council-commun" data-hash="#rooms.index.type.cities.id.<?php echo City::getUnikey($cityCommunexion); ?>">
		<span class="fa-stack">
				<i class="fa fa-university fa-stack-1x"></i>
				<i class="fa fa-group fa-stack-1x stack-right-bottom text-dark" style="font-size:15px;"></i>
			</span>	
			<!--<i class="fa fa-group"></i>-->
			<span class="lbl-btn-menu-name">Conseil citoyen <span class="text-dark" style="font-size:12px;">communectée</span></span>
	</button>
	<?php } ?>
	
	<?php echo $this->renderPartial('version'); ?>
	
</div>

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

<div class="hover-menu HM-right-side hidden-xs">
	<div class="main-menu-right">

		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<button class="menu-button menu-button-title btn-menu btn-menu5 bg-dark text-white">
				<i class="fa fa-bookmark fa-rotate-270"></i> 
				<span class="lbl-btn-menu-name">Mon répertoire</span>
		</button>
		<?php } ?>

		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<button class="menu-button menu-button-title btn-menu6 text-red lbh" data-hash="#rooms.index.type.cities.id.<?php echo City::getUnikey($myCity); ?>">
				<i class="fa fa-group"></i>
				<span class="lbl-btn-menu-name"><?php echo  ucfirst(strtolower(Yii::t("common","MY CITIZEN COUNCIL")));?></span>
		</button>
		<?php } ?>

		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<button class="menu-button menu-button-title btn-menu7 text-red lbh" data-hash="#city.detail.insee.<?php echo $inseeCommunexion; ?>.postalCode.<?php echo $cpCommunexion; ?>">
				<i class="fa fa-university"></i>
				<span class="lbl-btn-menu-name"><?php echo ucfirst(strtolower(Yii::t("common","MY CITY")));?></span>
		</button>
		<?php } ?>

		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<button class="menu-button menu-button-title btn-menu8 text-dark lbh" data-hash="#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>">
				<i class="fa fa-rss fa-rotate-270"></i>
				<span class="lbl-btn-menu-name"><?php echo ucfirst(strtolower(Yii::t("common","My News Stream")));?></span>
		</button>
		<?php } ?>

		<button class="menu-button menu-button-title btn-menu btn-menu9 text-dark lbh" data-hash="#news.index.type.pixels">
				<i class="fa fa-bullhorn"></i>
				<span class="lbl-btn-menu-name"><?php echo ucfirst(strtolower(Yii::t("common", "BUGS, IDEAS"))); ?></span></span>
		</button>

		<?php if(isset($me)) if(Role::isSuperAdmin($me['roles'])){?>
	    <button class="menu-button menu-button-title menu-button-title btn-menu btn-menu10 text-dark <?php echo ($page == 'admin') ? 'selected':'';?>" onclick="loadByHash('#admin.index')" >
				<i class="fa fa-cog"></i>
				<span class="lbl-btn-menu-name"><?php echo ucfirst(strtolower(Yii::t("common", "ADMIN"))); ?>
					<?php if(@$newsToModerate){ ?>
						<span class="badge count-to-moderate"><?php echo $newsToModerate; ?></span>
					<?php } ?>
				</span>
		</button>
		<?php } ?>
	</div>


<?php if(isset(Yii::app()->session['userId'])){ ?>
<button class="menu-button menu-button-title btn-menu btn-menu-add hidden-xs" onclick="">
	<span class="lbl-btn-menu-name">Ajouter</span></span>
	<i class="fa fa-plus-circle"></i>
</button>

<div class="drop-up-btn-add">

	<button class="menu-button btn-menu btn-menu-add1 bg-yellow lbh" data-hash="#person.invite" >
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-user"></i>
		<span class="lbl-btn-menu-name-add">inviter quelqu'un</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add2 bg-green lbh" data-hash="#organization.addorganizationform">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-group"></i>
		<span class="lbl-btn-menu-name-add">une organisation</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add3 bg-purple lbh" data-hash="#project.projectsv">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-lightbulb-o"></i>
		<span class="lbl-btn-menu-name-add">un projet</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add4 bg-orange lbh" data-hash="#event.eventsv">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-calendar"></i>
		<span class="lbl-btn-menu-name-add">un événement</span></span>
	</button>
</div>
<?php } ?>



<style>

.count-to-moderate{
	font-weight: 500;
	font-size:16px;
	margin-left:2px;
}

#kkbb-min span.msg{
	top: -3px;
	position: relative;
	color: black !important;
	font-size: 22px;
}
#kkbb-min img.piggy {
    height: 40px;
    top: -7px;
    position: relative;
}
#kkbb-min img.helloasso {
	height: 40px;
	position: absolute;
	top: 0px;
	margin-left: 5px;
}

#kkbb-big .msg {
width: 40%;
font-size: 17px;
margin-left: 0px;
margin-top: 5px;
line-height: 20px;
text-align: center;
}

.globale-announce {
    width: 360px;
}

#btn-close-globale-announce {
    z-index: 2;
}

</style>
<div class="globale-announce text-dark hidden-xs">
	<div id="kkbb-min" style="margin-bottom: -12px;">
		<span class="homestead msg hidden">Soutenez-nous</span>
		<img class="piggy" style="height:30px;" src='<?php echo $this->module->assetsUrl?>/images/piggybank.png'/>
		<img class="helloasso" src="<?php echo $this->module->assetsUrl?>/images/helloasso-logo.png"/>
		<!-- <img style="height: 25px; margin-top: -18px;" src="<?php echo $this->module->assetsUrl?>/imasges/announce-kkbb2.png"/> -->
	</div>
	<div id="kkbb-big" style="display:none;">
		<button class="btn btn-default" id="btn-close-globale-announce"><i class="fa fa-times"></i></button>
		<a href="https://www.helloasso.com/associations/open-atlas" target="_blank">
			<img class="pull-left" style="width:20%;" src='<?php echo $this->module->assetsUrl?>/images/piggybank.png'/>
		</a>
		
		<a href="https://www.helloasso.com/associations/open-atlas" target="_blank">
		<div class="pull-left homestead text-red msg">
			Soutenez-nous<br/>
			à prix libre<br/>
			sur
		</div>
		</a>
		
		<a href="https://www.helloasso.com/associations/open-atlas" target="_blank">
			<img class="pull-right" style="height:40px; position:relative; top:20px;" src='<?php echo $this->module->assetsUrl?>/images/helloasso-logo.png'/>
		</a>
<!-- 
		<div class="progress" style="width: 63%; position: absolute; bottom: 25px;">
			<div class="progress-bar bg-red" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em;">
			    <span id="amount"></span>
			</div>
		</div>

		<div class="pull-left" style="width:100%; margin-top:5px;">
		<div class="pull-left" style="width:50%; font-weight: 600; font-size: 16px; padding-right: 24px; color:black;">Objectif : 20 000€</div>
		<div class="pull-right text-right" style="width:50%; font-weight: 600; font-size: 16px; padding-right: 24px; color:black;">Collecté : <span id="collected"></span></div>
		 -->
		</div>
	</div>
</div>

<div id="iframe-kkbb" class="hidden">
	<?php 
		// $kkbb_html = file_get_contents("http://www.kisskissbankbank.com/fr/projects/communecter-se-connecter-a-sa-commune/widget"); 
		// $start = strpos($kkbb_html, "<div class='widget'>");
		// $end = strpos($kkbb_html, "<div class='goal'>", $start);
		// $kkbb_html = substr($kkbb_html, $start, $end-$start)."</div>";
		// echo $kkbb_html;
	?>
</div>



<?php //} ?>
<!-- <button class="menu-button btn-menu btn-menu6 tooltips <?php echo ($page == 'agenda') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="left" title="Ma messagerie" alt="Ma messagerie">
	<i class="fa fa-envelope"></i>
</button> -->


<script type="text/javascript">

var timeoutCommunexion = setTimeout(function(){}, 0);
var showMenuExplanation = <?php echo (@$me["preferences"]["seeExplanations"] || !@Yii::app()->session["userId"]) ? "true" : "false"; ?>;
var urlLogout = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";
jQuery(document).ready(function() {

	//realTimeKKBB();
	
	
	bindEventMenu();

});
</script>