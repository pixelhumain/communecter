
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

	//if($cpCommunexion != "" && $cityNameCommunexion != "")
	//$cityCommunexion = City::getCityByInseeCp($inseeCommunexion->value, $cpCommunexion->value);
	
	//error_log("1---menuLeft Cookie address : ". $cityNameCommunexion);
	
	//si l'utilisateur n'est pas connecté
 	if(!isset(Yii::app()->session['userId'])){
		if($cpCommunexion != "" && $cityNameCommunexion != "")
		$myCity = City::getCityByInseeCp($inseeCommunexion->value, $cpCommunexion->value);
		//error_log("user not connected, address : ". $cityNameCommunexion);
	}
	//si l'utilisateur est connecté
	else if(isset($me['address']) && !empty($me['address']['codeInsee'])){ 
		//error_log("user connected with own address : ". (string)$me['address']['addressLocality']);
		
		$me = Person::getById(Yii::app()->session['userId']);
		$inseeCommunexion 	 = isset( $me['address']['codeInsee'] ) ? 
		   			    			  $me['address']['codeInsee'] : $inseeCommunexion;
		
		$cpCommunexion 		 = isset( $me['address']['postalCode'] ) ? 
		   			    			  $me['address']['postalCode'] : $cpCommunexion;
		
		$cityNameCommunexion = isset( $me['address']['addressLocality'] ) ? 
		   			    			  $me['address']['addressLocality'] : $cityNameCommunexion;
		
		$myCity = City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);
	}else{
		//error_log("user connected without address : cookie [insee:". $inseeCommunexion ." cp:". $cpCommunexion. "]");
		if(isset($inseeCommunexion->value) && isset($cpCommunexion->value))
		$myCity = City::getCityByInseeCp($inseeCommunexion->value, $cpCommunexion->value);

	}
?>

<style>
	<?php 	//masque les boutons Directory, Agenda, News si l'utilisateur n'est pas communecté
			//if(!isset( Yii::app()->request->cookies['inseeCommunexion'] )) {  
	?>
		button.btn-menu2, .btn-menu3, .btn-menu4, .btn-menu9{
			display: none;
		}
	<?php //} ?>

	.hidden-xs.main-menu-left.inSig{
		display:inline !important;
	}

	.main-menu-left.inSig hr{
		border-top: 1px solid transparent !important;
	}
	.main-menu-left.inSig .fa-angle-right, 
	.main-menu-left.inSig .lbl-btn-menu{
		display:none;
	}
	.main-menu-left.inSig .fa{
		/*margin-left:5px;*/
	}
	.main-menu-left.inSig hr{
		max-width:5px!important;
	}

	.menu-left-container i.fa{
		padding: 5px;
		border-radius: 30px;
		width: 24px;
		text-align: center;
		font-size: 18px;
		height: 24px;
	}

</style>

<div class="hover-info col-md-7 col-md-offset-3 col-sm-6 col-sm-offset-5 hidden-xs panel-white padding-20">
	<?php echo $this->renderPartial('explainPanels',array("class"=>"explain")); ?>
</div>


<div class="hidden-xs main-menu-left col-md-2 col-sm-2 padding-10">
	
	<div class="menu-left-container">

		<?php 
			$cityExists = (isset($myCity) && $myCity != "");
			$title = $cityExists ? $cityNameCommunexion : "Communectez-moi";
			$hash = $cityExists ? "#city.detail.insee.".$myCity["insee"].".postalCode.".$myCity["cp"] : "";
			$onclick = $cityExists ? "javascript:loadByHash('#city.detail.insee.".$myCity["insee"].".postalCode.".$myCity["cp"]."')": "javascript:";
		?>
		<a href="<?php echo $onclick; ?>" 
			class="menu-button-left lbl-btn-menu-name-city menu-button-title btn-menu text-red btn-geoloc-auto" 
			data-hash="<?php echo $hash; ?>"
			id="btn-geoloc-auto-menu">
			
			<i class="fa fa-home tooltips"
					data-toggle="tooltip" data-placement="right" title="Ma commune : <?php echo $title; ?>"></i>
			<span class="lbl-btn-menu">
				<?php echo $title; ?>
			</span>
		</a><hr>
		
		<?php if (isset(Yii::app()->session['userId']) && !empty($me)) {
		          $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
		      }
		?>
		<?php //var_dump($me);
		 if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:loadByHash('#person.detail.id.<?php echo Yii::app()->session['userId'] ?>')" 
				data-hash="#person.detail.id.id.<?php echo Yii::app()->session['userId'] ?>"
				class="menu-button menu-button-left menu-button-title btn-menu 
				<?php echo ($page == 'myProfil') ? 'selected':'';?>">
				<img class="img-circle tooltips" id="menu-left-thumb-profil" width="24" height="24"
					 data-toggle="tooltip" data-placement="right" 
					 title="Mon profil : <?php echo $me["name"]; ?>"
					 src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
    
				<i class="fa fa-user tooltips hidden"
					data-toggle="tooltip" data-placement="right" 
					title="Mon profil : <?php echo $me["name"]; ?>"></i> <span class="lbl-btn-menu"><?php echo $me["name"]; ?></span>
		</a>
		<hr><br>
		<?php } ?>

		<a href="#default.live" id="menu-btn-directory"
				data-hash="#default.live"
				class="lbh menu-button-left visible-communected 
				<?php echo ($page == 'live') ? 'selected':'';?>">
				<i class="fa fa-heartbeat  tooltips"
					data-toggle="tooltip" data-placement="right" title="Live"></i> <span class="lbl-btn-menu">Live</span>
		</a><hr class="visible-communected">
		<a href="#default.live.type.dda" id="menu-btn-directory"
				data-hash="#default.live"
				class="lbh menu-button-left visible-communected 
				<?php echo ($page == 'live') ? 'selected':'';?>">
				<i class="fa fa-archive  tooltips"
					data-toggle="tooltip" data-placement="right" title="Propositions"></i> <span class="lbl-btn-menu">DDA</span>
		</a><hr class="visible-communected">
		
		
		<?php //var_dump($me);
		 if(isset(Yii::app()->session['userId'])){ ?>
		<a href="javascript:loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>')" 
				id="menu-btn-news-network"
				data-hash="#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>"
				class="menu-button menu-button-left menu-button-title btn-menu 
				<?php echo ($page == 'directory') ? 'selected':'';?>">
				<i class="fa fa-rss tooltips"
					data-toggle="tooltip" data-placement="right" title="Actu réseau"></i> <span class="lbl-btn-menu">Actu réseau</span>
		</a>
		<hr>
		<?php } ?>
		<br>
		

		<a href="javascript:loadByHash('#default.directory')" id="menu-btn-directory"
				data-hash="#default.directory"
				class="menu-button-left  
				<?php echo ($page == 'directory') ? 'selected':'';?>">
				<i class="fa fa-search tooltips"
					data-toggle="tooltip" data-placement="right" title="Rechercher"></i> <span class="lbl-btn-menu">Rechercher</span>
		</a><hr class="">

		<a href="javascript:loadByHash('#default.agenda')" id="menu-btn-agenda"
				data-hash="#default.agenda"
				class="menu-button-left 
			<?php echo ($page == 'agenda') ? 'selected':'';?>">
				<i class="fa fa-calendar tooltips"
					data-toggle="tooltip" data-placement="right" title="Agenda"></i> <span class="lbl-btn-menu">Agenda</span>
		</a><hr class="">

		<a href="javascript:loadByHash('#default.news')" id="menu-btn-news"
				data-hash="#default.news"
				class="menu-button-left 
				<?php echo ($page == 'news') ? 'selected':'';?>" >
				<!-- data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="L'Actu Communectée" -->
				<i class="fa fa-rss tooltips"
					data-toggle="tooltip" data-placement="right" title="Actualités"></i> <span class="lbl-btn-menu">Actualités</span>
		</a><hr class=""><br>
		
		<a style="margin-bottom:5px;float:left;" href="https://www.helloasso.com/associations/open-atlas" target="_blank"
				class="menu-button-left">
				<i class="fa fa-gift tooltips"
					data-toggle="tooltip" data-placement="right" title="Faire un don"></i> 
					<!-- <i class="fa fa-gift"></i> -->
					<span class="lbl-btn-menu">Faire un don</span>
		</a><br><hr style="float: left; width: 100%; border-color: transparent ! important; margin: 0px;">

		<a href="https://www.helloasso.com/associations/open-atlas" target="_blank" class="helloasso tooltips pull-left"
				data-toggle="tooltip" data-placement="right" title="soutenir communecter">
			<img style="" src="<?php echo $this->module->assetsUrl?>/images/helloasso-logo.png"/>
		</a>

		<?php //if(!isset(Yii::app()->session['userId']) && false){ ?>
		<a href="javascript:loadByHash('#rooms.index.type.cities.id.<?php 
			if(@$myCity) echo City::getUnikey($myCity); ?>')" 
			data-hash="#rooms.index.type.cities.id.<?php 
			if(@$myCity) echo City::getUnikey($myCity); ?>"
			class="hidden menu-button-left" 
			id="btn-citizen-council-commun">
				<i class="fa fa-connectdevelop tooltips"
					data-toggle="tooltip" data-placement="right" title="Conseil citoyen"></i> <span class="lbl-btn-menu">Conseil citoyen</span>
		</a><hr class="hidden ">
		<?php //} ?>

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

.helloasso{
	/*position: fixed;
	bottom: 161px;
	left: 10px;
	z-index: 10;*/
	border-radius:10px;
}
.helloasso img{
	width:120px; 
	border-radius:10px;
	-moz-box-shadow: 0px 0px 5px -3px #353535 !important;
	-webkit-box-shadow: 0px 0px 5px -3px #353535 !important;
	-o-box-shadow: 0px 0px 5px -3px #353535 !important;
	box-shadow: 0px 0px 5px -3px #353535 !important;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}

</style>

<a href="https://www.helloasso.com/associations/open-atlas" target="_blank" class="helloasso tooltips"
		data-toggle="tooltip" data-placement="top" title="faire un don pour soutenir communecter">
	<img style="" src="<?php echo $this->module->assetsUrl?>/images/helloasso-logo.png"/>
</a>

<div class="globale-announce text-dark hidden-xs hidden">
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
		$(".visible-communected").hide(400);
	<?php } ?>
});
</script>