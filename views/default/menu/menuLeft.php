
<?php 
    if(isset(Yii::app()->session['userId']))
    	$me = Person::getById(Yii::app()->session['userId']);
    	$newsToModerate = count(News::getNewsToModerate());



    $cssAnsScriptFilesModule = array(
		'/css/default/menu.css',
		'/js/default/menu.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
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

<div class="hover-info col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20">
	<?php //echo $this->renderPartial('explainPanels',array("class"=>"explain")); ?>
</div>


<div class="hidden-xs main-menu-left col-md-2 col-sm-2 padding-10">
	
	<div class="menu-left-container">
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>')" class="menu-button menu-button-left menu-button-title btn-menu 
				<?php echo ($page == 'directory') ? 'selected':'';?>">
				<i class="fa fa-angle-right"></i> <i class="fa fa-rss"></i> Communauté
		</a>
		<hr><br>
		<?php } ?>

		<a href="javascript:" class="menu-button lbl-btn-menu-name-city menu-button-title btn-menu text-red btn-geoloc-auto" 
			id="btn-geoloc-auto-menu">
			<i class="fa fa-crosshairs"></i>
			<span class="">
				<?php if($inseeCommunexion != "" && $cpCommunexion != ""){
						   echo $cityNameCommunexion;// . ", " . $cpCommunexion;
					}else{ echo "Communectez-moi"; } ?>
			</span>
		</a><hr>

		<?php if(!isset(Yii::app()->session['userId']) && false){ ?>
		<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu0 text-red tooltips" 
				data-toggle="tooltip" data-placement="right" title="Accueil" alt="Accueil">
				<i class="fa fa-home"></i>
		</button>
		<?php } ?>
		
		
		<a href="javascript:loadByHash('#default.directory')" class="menu-button-left visible-communected 
				<?php echo ($page == 'directory') ? 'selected':'';?>">
				<i class="fa fa-angle-right"></i> <i class="fa fa-search"></i> Rechercher
		</a><hr class="visible-communected">

		<a href="javascript:loadByHash('#default.agenda')" class="menu-button-left visible-communected 
			<?php echo ($page == 'agenda') ? 'selected':'';?>">
				<i class="fa fa-angle-right"></i> <i class="fa fa-calendar"></i> Agenda
		</a><hr class="visible-communected">

		<a href="javascript:loadByHash('#default.news')" class="menu-button-left visible-communected
				<?php echo ($page == 'news') ? 'selected':'';?>" >
				<!-- data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="L'Actu Communectée" -->
				<i class="fa fa-angle-right"></i> <i class="fa fa-rss"></i> Actualités
		</a><hr class="visible-communected">
		
		<a href="javascript:" class="menu-button-left visible-communected" 
			id="btn-citizen-council-commun">
				<i class="fa fa-angle-right"></i> <i class="fa fa-gavel"></i> Conseil citoyen
		</a><hr class="visible-communected">
	</div>
	<?php echo $this->renderPartial('version'); ?>
	
</div>

<?php 
	if(!isset($me)) $me = "";
 	$this->renderPartial("./menu/menuSmall", array("me"=>$me)); 
?> 

<div class="visible-xs" id="menu-bottom">
	<button class="menu-button menu-button-title bg-red tooltips btn-param-postal-code"
		data-toggle="tooltip" data-placement="bottom" title="modifier communexion" alt="modifier communexion">
		<i class="fa fa-crosshairs"></i>
	</button> 
	<input type="text" class="text-dark input-global-search visible-xs" id="input-global-search-xs" placeholder="rechercher ..."/>
	<?php 
	if(isset(Yii::app()->session['userId']) && false){ ?>
		<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
		<span class="lbl-btn-menu-name">Ajouter</span></span>
		<i class="fa fa-plus-circle"></i>
		</button>
	<?php } ?>
</div>


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


<?php //} ?>
<!-- <button class="menu-button btn-menu btn-menu6 tooltips <?php //echo ($page == 'agenda') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="left" title="Ma messagerie" alt="Ma messagerie">
	<i class="fa fa-envelope"></i>
</button> -->


<script type="text/javascript">

var timeoutCommunexion = setTimeout(function(){}, 0);
var showMenuExplanation = <?php echo (@$me["preferences"]["seeExplanations"] || !@Yii::app()->session["userId"]) ? "true" : "false"; ?>;
var urlLogout = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";
jQuery(document).ready(function() {

	//realTimeKKBB();
	showMenuExplanation = false;
	
	bindEventMenu();
	//$(".menu-button-left .fa-angle-right").hide(100);

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

	<?php if($inseeCommunexion == "" && $cpCommunexion == ""){ ?>
		$(".menu-left-container .visible-communected").hide(400);
	<?php } ?>
});
</script>