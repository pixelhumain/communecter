<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/localisationHtml5.js' , CClientScript::POS_END);
//geolocalisation nominatim et byInsee
$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/geoloc.js' , CClientScript::POS_END);

//
$cs->registerScriptFile($this->module->assetsUrl. '/js/communecter.js' , CClientScript::POS_END);	
?>
<style type="text/css">
.container-lbl-info-search{
	position: absolute;
	width: 290px;
	top: -25px;
	background-color: rgba(58, 89, 111, 0.79); /*rgba(76, 98, 117, 0.74);*/	
	border-radius: 50%;
	height: 290px;
	left: 235px;
	display: none;
	-moz-box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    -webkit-box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    -o-box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    box-shadow: 0px 0px 5px 5px rgba(41, 41, 41, 0.56);
    filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}
.container-lbl-info-search .lbl-info-search{
	height: 20px;
	position: absolute;
	width: 100%;
	color: #FFF;
	font-weight: 700;
	font-size: 12px;
	margin-left: 133px;
	margin-top: 65px;
	z-index: 10;
}
.container-lbl-info-search .lbl-info-search span{
	padding:3px 7px;
	background-color: transparent;
	
}

.lbl-info-search.lbl1{
	-ms-transform: rotate(340deg); /* IE 9 */
    -webkit-transform: rotate(340deg); /* Chrome, Safari, Opera */
    transform: rotate(340deg);
    top: -21px !important;
	left: -19px;
}

.lbl-info-search.lbl2{
	-ms-transform: rotate(350deg); /* IE 9 */
    -webkit-transform: rotate(350deg); /* Chrome, Safari, Opera */
    transform: rotate(350deg);
    top: 16px;
	left: 8px;
}

.lbl-info-search.lbl3{
	-ms-transform: rotate(0deg); /* IE 9 */
    -webkit-transform: rotate(0deg); /* Chrome, Safari, Opera */
    transform: rotate(0deg);
    left: 17px;
	top: 65px;
}

.lbl-info-search.lbl4{
	-ms-transform: rotate(10deg); /* IE 9 */
    -webkit-transform: rotate(10deg); /* Chrome, Safari, Opera */
    transform: rotate(10deg);
    top: 113px;
	left: 8px;
}
.lbl-info-search.lbl5{
	-ms-transform: rotate(20deg); /* IE 9 */
    -webkit-transform: rotate(20deg); /* Chrome, Safari, Opera */
    transform: rotate(20deg);
    left: -19px;
	top: 152px;
}



</style>

<h2 class="main-title-public homestead text-dark" id="main-title-public1"></h2>
<h1 class="main-title-public homestead" id="main-title-public2"></h1>



<!-- <div class="pull-right" style="padding:20px;">
	<a href="#" onclick="showHideMenu ()">
		<i class="menuBtn fa fa-bars fa-3x text-white "></i>
	</a>
</div>
 -->
	
<div class="big-button-container">
	<a href="javascript:" class="big-button tooltips btn-1" onclick="initHTML5Localisation('showCityMap');"
		data-toggle="tooltip" data-placement="top" title="Se localiser" alt="">
		<i class="fa fa-crosshairs" style=""></i>
	</a>
	<a href="javascript:" class="big-button searchBar">
		<i class="fa fa-search" style="font-size:25px; padding-top: 16px !important;"></i>
	</a>
	<div class="container-lbl-info-search">
			<label class="lbl-info-search lbl1"><i class="fa fa-circle text-yellow"></i> <span>Une personne ?</span></label>
			<label class="lbl-info-search lbl2"><i class="fa fa-circle text-green"></i> <span>Une organisation ?</span></label>
			<label class="lbl-info-search lbl3"><i class="fa fa-circle text-purple"></i> <span>Un projet ?</span></label>
			<label class="lbl-info-search lbl4"><i class="fa fa-circle text-orange"></i> <span>Un événement ?</span></label>
			<label class="lbl-info-search lbl5"><i class="fa fa-circle text-red"></i> <span>Une commune ?</span></label>
		</div>
	<form class="inner searchBarForm">
		
		<input class='hide' id="searchId" name="searchId"/>
		<input class='hide' id="searchType" name="searchType"/>
		<input id="searchBar" name="searchBar" type="text" placeholder="Que recherchez-vous ?" style="background-color:#58879B; color:white">
		<ul class="dropdown-menu" id="dropdown_searchTop" style="">
		  <ol class="li-dropdown-scope"><?php echo Yii::t("common","Searching",null,Yii::app()->controller->module->id) ?>Recherche en cours</ol>
		</ul>
		
		<!-- </input> -->
	</form>
	
	<a href="javascript:" class="big-button btn2 tooltips" onclick="showDiscover();"
		data-toggle="tooltip" data-placement="right" title="Communecter ?" alt="">
		<img src="<?php echo $this->module->assetsUrl?>/images/Communecter-32x32.svg"/>
		<!-- <i class="fa fa-search" style="font-size:40px"></i>  -->
	</a>
	
	<a href="javascript:" class="big-button btn3 tooltips" onclick="showDiscoverCluster();"
		data-toggle="tooltip" data-placement="right" title="Les Pixels Humains" alt="">
		<img src="<?php echo $this->module->assetsUrl?>/css/sig/marker_cluster.png"/>
		<!-- <i class="fa fa-search" style="font-size:40px"></i>  -->
	</a>
	
	<a href="javascript:" class="big-button btn4 tooltips" onclick="showPanel('box-login');"
		data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t("login","Login") ?>" alt="">
		<i class="fa fa-sign-in"></i> 
	</a>
	
	<a href="javascript:" class="big-button btn5 tooltips register" onclick="showFormRegister();"
		data-toggle="tooltip" data-placement="right" title="S'inscrire" alt="">
		<i class="fa fa-plus-circle"></i> 
	</a>

	<a href="javascript:" class="big-button btn6 tooltips" onclick="showPublicMap();"
		data-toggle="tooltip" data-placement="right" title="Afficher / masquer la carte" alt="">
		<i class="fa fa-map" style="font-size: 25px; padding-top: 17px;"></i> 
	</a>

	<!-- <a href="javascript:" class="big-button btn-corner-top-right tooltips" onclick="updateCitiesGeoFormat();"
		data-toggle="tooltip" data-placement="left" title="Mettre à jour la base de données (Cities)" alt="">
		<i class="fa fa-database"></i> 
	</a> -->
</div>


	<div class="box-menu box-menu-what box">
		<ul class="text-white text-bold homestead" style="list-style: none; font-size: 3.1em; margin-top:50px; ">
			<li style="margin-left:50px"><a href="#" onclick="showVideo('133636468')"><i class="fa fa-youtube-play"></i> <img style="height: 35px;" src="<?php echo $this->module->assetsUrl?>/images/DRAPEAU_COMMUNECTER.png"/></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-whatisit','bgyellow')"><i class="fa fa-share-alt"></i> <?php echo Yii::t("common","WHAT",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-why','bggreen')"><i class="fa fa-heart"></i> <?php echo Yii::t("common","WHY",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-4who','bgblue')"><i class="fa fa-group"></i> <?php echo Yii::t("common","WHO",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-how','bggreen')"><i class="fa fa-laptop"></i> <?php echo Yii::t("common","HOW",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-when','bgyellow')"><i class="fa fa-calendar"></i> <?php echo Yii::t("common","WHEN",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-where','bgblue')"><i class="fa fa-map-marker"></i> <?php echo Yii::t("common","WHERE",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-help')"><i class="fa fa-lightbulb-o"></i> <?php echo Yii::t("common","GET INVOLVED",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" style="" onclick="showPanel('box-register')"><i class="fa fa-plus-circle"></i> <?php echo Yii::t("common","REGISTER",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px"><a href="#" onclick="showVideo('74212373')"><i class="fa fa-youtube-play"></i> <img style="height: 35px;" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a></li>
		</ul>
	</div>

	<div class="box-menu box-menu-elements box">
		<ul class="text-white text-bold homestead" style="list-style: none; font-size: 3.1em; margin-top:50px; ">
			<li style="margin-left:50px" ><a href="#" onclick="showVideo('133636468')"><i class="fa fa-youtube-play text-dark"></i> <img style="height: 35px;" src="<?php echo $this->module->assetsUrl?>/images/DRAPEAU_COMMUNECTER.png"/></a></li>
			<li style="margin-left:50px" class="bg-yellow"><a href="#" style=""onclick="showPanel('box-people','bgyellow')"><i class="fa fa-user"></i> <?php echo Yii::t("common","PEOPLE",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px" class="bg-green"><a href="#" style="" onclick="showPanel('box-orga','bggreen')"><i class="fa fa-users"></i> <?php echo Yii::t("common","ORGANIZATIONS",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px" class="bg-orange"><a href="#" style="" onclick="showPanel('box-event','bgblue')"><i class="fa fa-calendar"></i> <?php echo Yii::t("common","EVENTS",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px" class="bg-purple"><a href="#" style="" onclick="showPanel('box-projects','bggreen')"><i class="fa fa-lightbulb-o"></i> <?php echo Yii::t("common","PROJECTS",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px" class="bg-red"><a href="#" style="" onclick="showPanel('box-city','bgyellow')"><i class="fa fa-university"></i> <?php echo Yii::t("common","CITIES",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px" class="bg-dark"><a href="#" style="" onclick="showPanel('box-register')"><i class="fa fa-plus-circle"></i> <?php echo Yii::t("common","REGISTER",null,Yii::app()->controller->module->id) ?></a></li>
			<li style="margin-left:50px" ><a href="#" onclick="showVideo('74212373')"><i class="fa fa-youtube-play text-dark"></i> <img style="height: 35px;" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a></li>
		</ul>
	</div>

	<div class="box-discover">
		<!-- start: LOGIN BOX -->
		<?php 
		//$this->renderPartial('../default/menuTitle');
		$this->renderPartial('../default/panels/what');
		$this->renderPartial('../default/panels/how');
		$this->renderPartial('../default/panels/why');
		$this->renderPartial('../default/panels/where');
		$this->renderPartial('../default/panels/when');
		$this->renderPartial('../default/panels/who');
		$this->renderPartial('../default/panels/events');
		$this->renderPartial('../default/panels/cities');
		$this->renderPartial('../default/panels/orga');
		$this->renderPartial('../default/panels/people');
		$this->renderPartial('../default/panels/involved');
		$this->renderPartial('../default/panels/projects');
		$this->renderPartial('../default/panels/ph');
		$this->renderPartial('../default/panels/communecter');
		?>
		</div>
		
	</div>	
<div class="row">
	<div class="main-login col-xs-10 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-4 pull-right">
	<a class="byPHRight" href="#"><img style="" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a>
	
		<div class="box-login box box-white-round no-padding" style="margin-top:-20px !important;">
			<?php 
				$this->renderPartial('../default/menuTitle');
			?>
			<form class="form-login" action="" method="POST">
				<img style="width:100%; border: 10px solid white; border-bottom-width:0px;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoL.jpg"/>
				<br/>
				<?php //echo Yii::app()->session["requestedUrl"]." - ".Yii::app()->request->url; ?>
				<fieldset>
					<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> Je me connecte</h2>
					<div class="form-group">
						<span class="input-icon">		
							<input type="text" class="form-control radius-10" name="email" id="email" placeholder="<?php echo Yii::t("login","Email") ?>" >
							<i class="fa fa-user"></i> </span>
					</div>
					<div class="form-group form-actions">
						
						<span class="input-icon">
							<input type="password" class="form-control password"  name="password" id="password" placeholder="<?php echo Yii::t("login","Password") ?>">
							
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								<?php echo Yii::t("login","Keep me signed in") ?>
							</label>

							<i class="fa fa-lock"></i>
							<a class="forgot pull-right padding-5" href="#"><?php echo Yii::t("login","I forgot my password") ?></a> 
						
						</span>
					</div>
					<div class="form-actions" style="margin-top:-20px;">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
						</div>
						<div class="errorHandler alert alert-danger no-display loginResult">
							<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
						</div>
						<div class="errorHandler alert alert-danger no-display notValidatedEmailResult">
							<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Your account is not validated : please check your mailbox to validate your email address.") ?>
							      <?php echo Yii::t("login","If you didn't receive it or lost it, click") ?>
							      <a class="validate" href="#">here</a> to receive it again.
						</div>
						<div class="errorHandler alert alert-success no-display emailValidated">
							<i class="fa fa-check"></i> <?php echo Yii::t("login","Your account is now validated ! Please try to login.") ?>
						</div>
						<div class="errorHandler alert alert-danger no-display custom-msg">
							<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
						</div>
						
						<br/>
						<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="loginBtn ladda-button center-block">
							<span class="ladda-label"><i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						</button>
					</div>
					
				</fieldset>
				<div class="new-account">
					<!-- <h2 class="text-red  no-margin padding-bottom-5 text-center bg-white"><i class="fa fa-angle-down"></i> Je m'inscris</h2> -->
					<?php //echo Yii::t("login","Don't have an account yet?") ?>
					<a href="javascript:" onclick="showFormRegister();" class="btn btn-default btn-sm register text-dark">
						<i class="fa fa-plus"></i> <i class="fa fa-user"></i> <?php echo Yii::t("login", "Create an account") ?>
					</a>
					
				</div>
			</form>
		</div>
		<!-- end: LOGIN BOX -->
		<!-- start: FORGOT BOX -->
		<div class="box-email box box-white-round">
			<form class="form-email">
				<img style="width:100%; border: 10px solid white;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
				<br/>
				<fieldset>
					<div class="form-group">
						<span class="input-icon">
							<input type="email" class="form-control" id="email2" placeholder="Email">
							<i class="fa fa-envelope"></i> </span>
					</div>
					<div class="form-actions">
						<div class="errorHandler alert alert-danger no-display">
							<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","You have some form errors. Please check below.") ?>
						</div>
						
						<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="forgotBtn ladda-button center center-block">
							<span class="ladda-label"><i class="fa fa-key"></i> <?php echo Yii::t("login","Get my password") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						</button>
					</div>
				</fieldset>
				<div class="new-account">
					<a href="#" class="text-dark btn go-back">
						<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
					</a>	
				</div>
			</form>
		</div>
		<!-- end: FORGOT BOX -->
		<!-- start: REGISTER BOX -->
		<div class="box-register box box-white-round no-padding" style=" margin-top:-25px !important;">
			
			<form class="form-register center" style="background-color:white !important;">
				<img style="width:70%; border: 10px solid white;" class="" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
				
				<fieldset>
					<h2 class="text-red margin-bottom-10 text-center"><i class="fa fa-angle-down"></i> Je crée mon compte</h2>
					<div class="col-md-12 padding-5">
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" id="name" name="name" placeholder="Nom et Prénom">
								<i class="fa fa-user"></i> </span>
						</div>
					</div>
					<div class="col-md-6 padding-5">
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" id="username" name="username" placeholder="<?php echo Yii::t("login","Username") ?>">
								<i class="fa fa-user-secret"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="email" class="form-control" id="email3" name="email3" placeholder="<?php echo Yii::t("login","Email") ?>">
								<i class="fa fa-envelope"></i> </span>
						</div>
					</div>
					<div class="col-md-6 padding-5">
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="password3" name="password3" placeholder="<?php echo Yii::t("login","Password") ?>">
								<i class="fa fa-lock"></i> </span>
						</div>
						<div class="form-group">
							<span class="input-icon">
								<input type="password" class="form-control" id="passwordAgain" name="passwordAgain" placeholder="<?php echo Yii::t("login","Password again") ?>">
								<i class="fa fa-lock"></i> </span>
						</div>
					</div>
					<div class="col-md-12 no-padding no-margin">
						<hr style="margin-top: 0px; margin-bottom: 15px;">
					</div>
					<div class="col-md-6 padding-5">
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="streetAddress" id="fullStreet" placeholder="<?php echo Yii::t("login","Full Street") ?>" value="<?php if(isset($organization["address"])) echo $organization["address"]["streetAddress"]?>" >
								<i class="fa fa-road"></i>
							</span>
						</div>
					</div>
					<div class="col-md-6 padding-5">
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" id="cp" name="cp" placeholder="<?php echo Yii::t("login","Postal Code") ?>">
								<i class="fa fa-home"></i>
							</span>
						</div>
					</div>
					<div class="col-md-6 padding-5">
						<div class="form-group" id="cityDiv" style="display: none;">
							<span class="input-icon col-md-12" style="margin-bottom:7px;">
								<select class="selectpicker form-control" id="city" name="city" title='<?php echo Yii::t("login","Select your City...") ?>'>
								</select>
							</span>
						</div>	
					</div>
					<div class="col-md-6 padding-5 text-center hidden" id="alert-city-found" style="text-align:center;font-family:inherit; border-radius:0px; margin-top:0px;">
						<!-- <span class="pull-left" style="padding:6px;"><i class="fa fa-check"></i> Position géographique</span> -->
						<div class="btn btn-success" id="btn-show-city"><i class="fa fa-map-marker"></i> Personnaliser</div>
						
						<input type="hidden" name="geoPosLatitude" id="geoPosLatitude" style="width: 100%; height:35px;">
						<input type="hidden" name="geoPosLongitude" id="geoPosLongitude" style="width: 100%; height:35px;">
					</div>	
					<div class="form-group pull-left no-margin" style="width:100%;">
						<div>
							<label for="agree" class="checkbox-inline">
								<input type="checkbox" class="grey agree" id="agree" name="agree">
								<?php echo Yii::t("login","I agree to the Terms of") ?> <a href="#" class="bootbox-spp"><?php echo Yii::t("login","Service and Privacy Policy") ?></a>
							</label>
						</div>
					</div>			

					<div class="pull-left" style="width:100%;">
						<button type="submit"  data-size="s" data-style="expand-right" style="background-color:#E33551" class="createBtn ladda-button center-block">
							<span class="ladda-label"><i class="fa fa-plus"></i><i class="fa fa-user"></i>  <?php echo Yii::t("login","Submit") ?></span><span class="ladda-spinner"></span><span class="ladda-spinner"></span>
						</button>
					</div>
					<div class="pull-left form-actions no-margin" style="width:100%; padding:10px;">
						<div class="errorHandler alert alert-danger no-display registerResult pull-left">
							<i class="fa fa-remove-sign"></i> <?php echo Yii::t("login","Please verify your entries.") ?>
						</div>
						<div class="errorHandler alert alert-success no-display pendingProcess">
							<i class="fa fa-check"></i> <?php echo Yii::t("login","Please fill your personal information in order to log in.") ?>
						</div>
					</div>

					
					
					<!-- <label class="center center-block"><?php echo Yii::t("login","Already have an account?") ?></label> -->
					
				</fieldset>
				<div class="new-account">
					<a href="#" class="text-dark btn go-back">
						<i class="fa fa-sign-in"></i> <?php echo Yii::t("login","Login") ?>
					</a>	
				</div>	
			</form>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- end: REGISTER BOX -->
	</div>
	<div class="col-xs-10 col-xs-offset-1 col-sm-9 col-sm-offset-2">
		<h1 class="panelTitle text-extra-large text-bold" style="display:none"></h1>
		<div class="box-ajax box box-white-round">
			<form class="form-login ajaxForm" style="display:none" action="" method="POST"></form>
		</div>
	</div>

</div>

<style type="text/css">
.elementIcons{
  z-index:0;
  display:none;
  position:absolute;
  bottom:0px; 
  cursor:pointer;
}
</style>
<!-- 
<div class="userMarker elementIcons" style="left:60px;" >
	<span class="homestead markerLabels userMarkerlabel text-yellow" style="display:none;color:white;font-size:25px"><?php echo Yii::t("common","PEOPLE",null,Yii::app()->controller->module->id) ?><br/></span>
	<img src="<?php //echo $this->module->assetsUrl?>/images/sig/markers/icons_carto/citizen-marker-default.png" style="width:72px;" />
</div>
<div class="assoMarker elementIcons" style="left:140px; " >
	<span class="homestead markerLabels assoMarkerlabel text-green" style="display:none;color:white;font-size:25px"><?php echo Yii::t("common","ORGANIZATIONS",null,Yii::app()->controller->module->id) ?><br/></span>
	<img src="<?php //echo $this->module->assetsUrl?>/images/sig/markers/icons_carto/ngo-marker-default.png" style="width:72px;" />
</div>
<div class="eventMarker elementIcons " style="left:220px;" >
	<span class="homestead markerLabels eventMarkerlabel text-orange" style="display:none;color:white;font-size:25px"><?php echo Yii::t("common","EVENTS",null,Yii::app()->controller->module->id) ?><br/></span>
	<img src="<?php //echo $this->module->assetsUrl?>/images/sig/markers/icons_carto/event-marker-default.png" style="width:72px;" />
</div>
<div class="projectMarker elementIcons" style="left:300px;" >
	<span class="homestead markerLabels projectMarkerlabel text-purple" style="display:none;color:white;font-size:25px"><?php echo Yii::t("common","PROJECTS",null,Yii::app()->controller->module->id) ?><br/></span>
	<img src="<?php //echo $this->module->assetsUrl?>/images/sig/markers/icons_carto/project-marker-default.png" style="width:72px;" />
</div>
<div class="cityMarker elementIcons" style="left:380px;" >
	<span class="homestead markerLabels cityMarkerlabel text-red" style="display:none;color:white;font-size:25px"><?php echo Yii::t("common","CITIES",null,Yii::app()->controller->module->id) ?><br/></span>
	<img src="<?php //echo $this->module->assetsUrl?>/images/sig/markers/icons_carto/city-marker-default.png" style="width:72px;" />
</div>

<img class="partnerLogosLeft" src="<?php //echo $this->module->assetsUrl?>/images/partners/Logo_Bis-01.png" style="width:90px;position:absolute; top:500px; left:400px;display:none;" />
<img class="partnerLogosLeft" src="<?php //echo $this->module->assetsUrl?>/images/partners/logo-cn.png" style="display:none;position:absolute; top:150px; left:150px;" />
<img class="partnerLogosLeft" src="<?php //echo $this->module->assetsUrl?>/images/partners/logo_lc.png" style="width:120px;display:none;position:absolute; top:350px; right:100px;cursor:pointer;" />

<img class="partnerLogosRight" src="<?php //echo $this->module->assetsUrl?>/images/partners/demosalithia.png" style="display:none;position:absolute; top5:0px; left:50px; cursor:pointer;" />
<img class="partnerLogosRight" src="<?php //echo $this->module->assetsUrl?>/images/partners/ggouv.png" style="display:none;position:absolute; top:600px; right:200px;cursor:pointer;" />
<img class="partnerLogosRight" src="<?php //echo $this->module->assetsUrl?>/images/partners/SENSORICA.jpg" style="width:120px;display:none;position:absolute; top:150px; right:200px; cursor:pointer;" />

<img class="partnerLogosDown" src="<?php //echo $this->module->assetsUrl?>/images/partners/DO.png" style="width:120px;display:none;position:absolute; top:330px; left:100px; cursor:pointer;" />
<img class="partnerLogosDown" src="<?php //echo $this->module->assetsUrl?>/images/partners/fab-lab1.png" style="width:80px;display:none;position:absolute; top:610px; left:90px; cursor:pointer;" />
<img class="partnerLogosDown" src="<?php //echo $this->module->assetsUrl?>/images/partners/smartCitizen.png" style="display:none;position:absolute; top:750px; right:400px; cursor:pointer;" />

<img class="partnerLogosUp" src="<?php //echo $this->module->assetsUrl?>/images/logo_region_reunion.png" style="width:80px;display:none;position:absolute; bottom:20px; left:20px; cursor:pointer;" />
<img class="partnerLogosUp" src="<?php //echo $this->module->assetsUrl?>/images/technopole.jpg" style="display:none;position:absolute; bottom:20px; right:20px; cursor:pointer;" />
<img class="partnerLogosUp" src="<?php //echo $this->module->assetsUrl?>/images/partners/imaginSocial.jpg" style="display:none; position:absolute; top:600px; right:550px; cursor:pointer;" />
 -->
<?php /* ?>
http://habibhadi.com/lab/svgPathAnimation/demo/
http://jonobr1.github.io/two.js/#basic-usage
http://rvlasveld.github.io/blog/2013/07/02/creating-interactive-graphs-with-svg-part-1/

<style type="text/css">
svg.graph {
	position: absolute;
	top:0px;
	left: 0px;
	height: 1000px;
	width: 1000px;
}

svg.graph .line {
  stroke: white;
  stroke-width: 1;
}
</style>

<svg class="graph">
  <circle cx="0" cy="0" stroke="white" fill="white" r="5"></circle>
  <path class="line" d=" M 0 0 L 600 100"></path>
  <path class="line" d=" M 0 0 L 150 150"></path>
  <path class="line" d=" M 0 0 L 330 100"></path>
</svg>
*/?>

<script type="text/javascript">
	var geoPositionCity = null;
	var citiesByPostalCode = null;
	var register = <?php echo isset($_GET["register"]) ? "true" : "false"; ?>;

	var mapIconTop = {
    "default" : "fa-arrow-circle-right",
    "citoyen":"<?php echo Person::ICON ?>", 
    "NGO":"<?php echo Organization::ICON ?>",
    "LocalBusiness" :"<?php echo Organization::ICON_BIZ ?>",
    "Group" : "<?php echo Organization::ICON_GROUP ?>",
    "group" : "<?php echo Organization::ICON ?>",
    "association" : "<?php echo Organization::ICON ?>",
    "GovernmentOrganization" : "<?php echo Organization::ICON_GOV ?>",
    "event":"<?php echo Event::ICON ?>",
    "project":"<?php echo Project::ICON ?>",
    "city": "<?php echo City::ICON ?>"
  };


	jQuery(document).ready(function() {
		userId = null;
		Main.init();
		Login.init();	
		titleAnim ();	
		if (email != "") {
			$(".form-login #email").val( email );
		}

		$("#mapCanvasBg").css("visibility", "visible");
		$("#mapCanvasBg").hide();

		 <?php if(  !isset( Yii::app()->session['userId']) && 
              		isset( Yii::app()->request->cookies['insee']) 
            	 ) { ?>

		 		<?php if(isset( Yii::app()->request->cookies['cityName']) 
            	 ) { ?>
            	 	var onclick = "showAjaxPanel( '/city/detail/insee/"+"<?php echo Yii::app()->request->cookies['insee']->value; ?>"+"?isNotSV=1', '<?php echo Yii::app()->request->cookies['cityName']->value; ?>','university' )";
							
	    			$("#main-title-public2").html('<a href="javascript:" onclick="'+onclick+'">'+"<i class='fa fa-university'></i> "+"<?php echo Yii::app()->request->cookies['cityName']->value; ?></a>");
		 		 	$("#main-title-public2").show(400);
		 		 <?php } ?>

	      		$("#mapCanvasBg").show(400);
	      		showDataByInsee(<?php echo Yii::app()->request->cookies['insee']->value; ?>);
	      		Sig.map.panBy([200, 0]);
	      		locationHTML5Found = true;

	    <?php }else{ ?>
	    		initHTML5Localisation("showCityMap");
	    <?php } ?>
		//$("#main-title-public1").hide(400);
		//Validation of the email
		if (userValidated) {
			//We are in a process of invitation. The user already exists in the db
			if (invitor != null) {
				$(".errorHandler").hide();
				$('.register').click();
				$('.pendingProcess').show();
				$('#email3').val(email);
				$('#email3').prop('disabled', true);
			} else {
				$(".errorHandler").hide();
				$(".emailValidated").show();
				$(".form-login #password").focus();
			}
		}

		if (msgError != "") {
			$(".custom-msg").show();
			$(".custom-msg").text(msgError);
		}

		$(".eventMarker").show().addClass("animated slideInDown").off().on("click",function() { 
			showElements();
			showPanel('box-event');
		}).on('mouseover',function() { 
			$(".eventMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".eventMarkerlabel").hide();
		});
		$(".cityMarker").show().addClass("animated slideInUp").off().on("click",function() { 
			showElements();
			showPanel('box-city');
		}).on('mouseover',function() { 
			$(".cityMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".cityMarkerlabel").hide();
		});
		$(".projectMarker").show().addClass("animated zoomInRight").off().on("click",function() { 
			showElements();
			showPanel('box-projects');
		}).on('mouseover',function() { 
			$(".projectMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".projectMarkerlabel").hide();
		});
		$(".assoMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
			showElements();
			showPanel('box-orga');
		}).on('mouseover',function() { 
			$(".assoMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".assoMarkerlabel").hide();
		});
		$(".userMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
			showElements();
			showPanel('box-people');
		}).on('mouseover',function() { 
			$(".userMarkerlabel").show();
		}).on('mouseout',function() { 
			$(".userMarkerlabel").hide();
		});
		$(".connectMarker").show().addClass("animated zoomInLeft").off().on("click",function() { 
			$(".box-menu").slideUp();
			showPanel('box-login');
		}).on('mouseover',function() { 
			$(".connectlabel").show();
		}).on('mouseout',function() { 
			$(".connectlabel").hide();
		});
		$(".byPHRight").show().addClass("animated zoomInLeft").off().on("click",function() { 
			showElements();
			showPanel('box-ph');
		});
		

		$('#searchBar').keyup(function(e){
	        var name = $('#searchBar').val();
	        $(this).css("color", "#58879B");
	        if(name.length>=3){
	          clearTimeout(timeout);
	          timeout = setTimeout('autoCompleteSearch("'+name+'")', 500);
	        }else{
	          $("#dropdown_searchTop").css("display", "none");
	          $('#notificationPanel').hide("fast");
	        }   
	    });

	    $('#searchBar').focusin(function(e){
	      if($("#searchBar").val() != ""){
	        $('#dropdown_searchTop').css("display" , "inline");
	        $('#notificationPanel').hide("fast");
	      }
	    });

	    $(".searchBar").mouseover(function(){
	    	showSearchBar(true);
	    });

		$(".searchBar").click(function(){
	    	showSearchBar(true);
	    });

		$(".sigModuleBg").mouseover(function(){
	    	showSearchBar(false);
	    });

		// $(".big-button").mousein(function(){
	 //    	Sig.currentMarkerPopupOpen.closePopup();
	 //    });


		if(register == true){
			//masque la box login
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});
			$('#btn-show-city').click(function(){
				//showMap(true);
			});

			activePanel = "box-register";
		}

		$('.form-register #username').keyup(function(e) {
			validateUserName();
		})
	});

var email = '<?php echo @$_GET["email"]; ?>';
var userValidated = '<?php echo @$_GET["userValidated"]; ?>';
var pendingUserId = '<?php echo @$_GET["pendingUserId"]; ?>';
var msgError = '<?php echo @$_GET["msg"]; ?>';
var invitor = <?php echo Yii::app()->session["invitor"] ? json_encode(Yii::app()->session["invitor"]) : '""'?>;

var timeout;
var emailType;
var Login = function() {
	"use strict";
	var runBoxToShow = function() {
		var el = $('.box-login');
		if (getParameterByName('box').length) {
			switch(getParameterByName('box')) {
				case "register" :
					el = $('.box-register');
					break;
				case "email" :
					el = $('.box-email');
					break;
				case "validate" :
					el = $('.box-email');
					break;
				default :
					el = $('.box-login');
					break;
			}
		}
		el.show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated flipInX");
		});
	};
	var runLoginButtons = function() {
		$('.forgot').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-email').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");
			});
			emailType = "password";
			$("#email2").val($("#email").val());
			activePanel = "box-email";
		});
		$('.validate').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-email').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");
			});
			emailType = "validation";
			$("#email2").val($("#email").val());
			activePanel = "box-email";
		});
		$('.register').on('click', function() {
			$('.box-login').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).hide().removeClass("animated bounceOutRight");

			});
			$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInLeft");

			});
			activePanel = "box-register";
		});
		$('.go-back').click(function() {
			var boxToShow;
			if ($('.box-register').is(":visible")) {
				boxToShow = $('.box-register');
				activePanel = "box-register";
			} else {
				boxToShow = $('.box-email');
				activePanel = "box-email";
			}
			boxToShow.addClass("animated bounceOutLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				boxToShow.hide().removeClass("animated bounceOutLeft");

			});
			$('.box-login').show().addClass("animated bounceInRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
				$(this).show().removeClass("animated bounceInRight");

			});
			if(!locationHTML5Found)
			$("#mapCanvasBg").hide(400);
			$(".box-menu").hide(400);
			$(".box-discover").hide(400);
		});
		$('.big-button').click(function() {
			$(".box-ajax").hide(400);
		});
		
	};
	//function to return the querystring parameter with a given name.
	var getParameterByName = function(name) {
		name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"), results = regex.exec(location.search);
		return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
	};
	var runSetDefaultValidation = function() {
		$.validator.setDefaults({
			errorElement : "span", // contain the error msg in a small tag
			errorClass : 'help-block',
			errorPlacement : function(error, element) {// render error placement for each input type
				if (element.attr("type") == "radio" || element.attr("type") == "checkbox") {// for chosen elements, need to insert the error after the chosen container
					error.insertAfter($(element).closest('.form-group').children('div').children().last());
				} else if (element.attr("name") == "card_expiry_mm" || element.attr("name") == "card_expiry_yyyy") {
					error.appendTo($(element).closest('.form-group').children('div'));
				} else {
					error.insertAfter(element);
					// for other inputs, just perform default behavior
				}
			},
			ignore : ':hidden',
			success : function(label, element) {
				label.addClass('help-block valid');
				// mark the current input as valid and display OK icon
				$(element).closest('.form-group').removeClass('has-error');
			},
			highlight : function(element) {
				$(element).closest('.help-block').removeClass('valid');
				// display OK icon
				$(element).closest('.form-group').addClass('has-error');
				// add the Bootstrap error class to the control group
			},
			unhighlight : function(element) {// revert the change done by hightlight
				$(element).closest('.form-group').removeClass('has-error');
				// set error class to the control group
			}
		});
	};
	var runLoginValidator = function() {
		var form = $('.form-login');
		var loginBtn = null;
		Ladda.bind('.loginBtn', {
	        callback: function (instance) {
	            loginBtn = instance;
	        }
	    });
		form.submit(function(e){e.preventDefault() });
		var errorHandler = $('.errorHandler', form);
		
		form.validate({
			rules : {
				email : {
					minlength : 2,
					required : true
				},
				password : {
					minlength : 4,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				loginBtn.start();
				var params = { 
				   "email" : $("#email").val(), 
                   "pwd" : $("#password").val()
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/authenticate",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	var url = "<?php echo (isset(Yii::app()->session["requestedUrl"])) ? Yii::app()->session["requestedUrl"] : null; ?>";
		    		  	if(url) {
		    		  		console.log(url);
		    		  		window.location.href = url;
		        		} else {
		        			window.location.reload();
		        		}
		    		  } else {
		    		  	var msg;
		    		  	if (data.msg == "notValidatedEmail") {
							$('.notValidatedEmailResult').show();
		    		  	} else if (data.msg == "accountPending") {
		    		  		pendingUserId = data.pendingUserId;
		    		  		$(".errorHandler").hide();
							$('.register').click();
							$('.pendingProcess').show();
							$('#email3').val($("#email").val());
							$('#email3').prop('disabled', true);
		    		  	} else{
		    		  		msg = data.msg;
		    		  		$('.loginResult').html(msg);
							$('.loginResult').show();
		    		  	}
						loginBtn.stop();
		    		  }
		    	  },
		    	  error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  	loginBtn.stop();
		    	  },
		    	  dataType: "json"
		    	});
			    return false; // required to block normal submit since you used ajax
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
				loginBtn.stop();
			}
		});
	};
	var runForgotValidator = function() {
		var form2 = $('.form-email');
		var errorHandler2 = $('.errorHandler', form2);
		var forgotBtn = null;
		Ladda.bind('.forgotBtn', {
	        callback: function (instance) {
	            forgotBtn = instance;
	        }
	    });
		form2.validate({
			rules : {
				email2 : {
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler2.hide();
				forgotBtn.start();
				var params = { 
					"email" : $("#email2").val(),
					"type"	: emailType
				};
		        $.ajax({
		          type: "POST",
		          url: baseUrl+"/<?php echo $this->module->id?>/person/sendemail",
		          data: params,
		          success: function(data){
					if (data.result) {
						alert(data.msg);
			            window.location.reload();
					} else if (data.errId == "UNKNOWN_ACCOUNT_ID") {
						if (confirm(data.msg)) {
							$('.box-email').removeClass("animated flipInX").addClass("animated bounceOutRight").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
								$(this).hide().removeClass("animated bounceOutRight");
							});
							$('.box-register').show().addClass("animated bounceInLeft").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
								$(this).show().removeClass("animated bounceInLeft");

							});
						} else {
							window.location.reload();
						}
					}
		          },
		          error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  },
		          dataType: "json"
		        });
		        return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
				forgotBtn.stop();
			}
		});
	};
	var runRegisterValidator = function() {
		var form3 = $('.form-register');
		var errorHandler3 = $('.errorHandler', form3);
		var createBtn = null;
		/*---Other solution for email validation with no space
			$("#email3").keyup(function(event){
			if (event.which==32 || event.which==86){
				var txt=$(this).val();
				$(this).val(txt.trim());
			}
		});*/
		Ladda.bind('.createBtn', {
	        callback: function (instance) {
	            createBtn = instance;
	        }
	    });
		form3.validate({
			rules : {
				cp : {
					required : true,
					rangelength : [5, 5],
					validPostalCode : true
				},
				city : {
					required : true,
					minlength : 1
				},
				name : {
					required : true
				},
				username : {
					required : true,
					validUserName : true,
					rangelength : [8, 20]
				},
				email3 : {
					required : { 
						depends:function(){
							$(this).val($.trim($(this).val()));
							return true;
        				}
        			},
					email : true
				},
				password3 : {
					minlength : 8,
					required : true
				},
				passwordAgain : {
					equalTo : "#password3"
				},
				agree : {
					minlength : 1,
					required : true
				}
			},
			messages: {
				agree: "You must validate the CGU to sign up.",
			},
			submitHandler : function(form) {
				errorHandler3.hide();
				createBtn.start();
				var params = { 
				   "name" : $("#name").val(),
				   "username" : $("#username").val(),
				   "email" : $("#email3").val(),
                   "pwd" : $("#password3").val(),
                   "cp" : $("#cp").val(),
                   "geoPosLatitude" : $("#geoPosLatitude").val(),
                   "geoPosLongitude" : $("#geoPosLongitude").val(),
                   "app" : "<?php echo $this->module->id?>",
                   "city" : $("#city").val(),
                   "pendingUserId" : pendingUserId
                };
			      
		    	$.ajax({
		    	  type: "POST",
		    	  url: baseUrl+"/<?php echo $this->module->id?>/person/register",
		    	  data: params,
		    	  success: function(data){
		    		  if(data.result)
		    		  {
		    		  	$.blockUI({
    		  				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '
    		  			});
		        		toastr.success(data.msg+" , we'll contact you as soon as we open up! Thanks for joining.");
		        		//window.location.reload();
		        		setTimeout(function() { $.unblockUI(); showPanel(); },5000);
		    		  }
		    		  else {
						$('.registerResult').html(data.msg);
						$('.registerResult').show();
						createBtn.stop();
		    		  }
		    	  },
		    	  error: function(data) {
		    	  	toastr.error("Something went really bad : contact your administrator !");
		    	  	createBtn.stop();
		    	  },
		    	  dataType: "json"
		    	});
			    return false;
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler3.show();
				createBtn.stop();
			}
		});
	};
	return {
		//main function to initiate template pages
		init : function() {
			addCustomValidators();
			runBoxToShow();
			runLoginButtons();
			runSetDefaultValidation();
			runLoginValidator();
			runForgotValidator();
			runRegisterValidator();
			bindPostalCodeAction();
		}
	};
}();

function runShowCity(searchValue) {
	citiesByPostalCode = getCitiesByPostalCode(searchValue);
	Sig.citiesByPostalCode = citiesByPostalCode;

	var oneValue = "";
	console.table(citiesByPostalCode);
	$.each(citiesByPostalCode,function(i, value) {
    	$("#city").append('<option value=' + value.value + '>' + value.text + '</option>');
    	oneValue = value.value;
	});
	
	if (citiesByPostalCode.length == 1) {
		$("#city").val(oneValue);
	}

	if (citiesByPostalCode.length >0) {
        $("#cityDiv").slideDown("medium");
      } else {
        $("#cityDiv").slideUp("medium");
      }

    //si l'utilisateur a déjà donné sa fullStreet
    if($('.form-register #fullStreet').val() != ""){
    	//on fait une recherche nominatim
    	clearTimeout(timeout);
		timeout = setTimeout(function() {
			searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
		}, 200);
    }else{ //sinon : on a que le CP et on recherche par le codeInsee de la première ville de la liste
    	findGeoposByInsee(citiesByPostalCode[0].value, callbackFindByInseeSuccessRegister);
    }
}

function bindPostalCodeAction() {
	$('.form-register #cp').change(function(e){
		//searchCity();
	});
	$('.form-register #cp').keyup(function(e){
		searchCity();
	});

	$('.form-register #fullStreet').keyup(function(e){
		if($('.form-register #cp').val() != "") {
			clearTimeout(timeout);
			timeout = setTimeout(function() {
				searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
			}, 500);
		}
	});

	$('.form-register #fullStreet').change(function(e){
		if($('.form-register #cp').val() != "") {
			searchAddressInGeoShape(); //Sig.execFullSearchNominatim(0);
		}
	});

	$('#city').change(function(e){
		//Sig.execFullSearchNominatim(0);
		console.log('findGeoposByInsee', $('#city').val());
		findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessRegister);
	});
}

var oldCp = "";
function searchCity() { 
	console.log("searchCity");
	var searchValue = $('.form-register #cp').val();
	if(searchValue.length == 5) {
		if(oldCp != searchValue){
			$("#city").empty();
			clearTimeout(timeout);
			timeout = setTimeout($("#iconeChargement").css("visibility", "visible"), 500);
			clearTimeout(timeout);
			timeout = setTimeout('runShowCity("'+searchValue+'")', 500); 
		}
	} else {
		$("#cityDiv").slideUp("medium");
		$("#city").val("");
		$("#city").empty();
	}
	oldCp = searchValue;
}

function validateUserName() {
	var username = $('.form-register #username').val();
	if(username.length >= 8) {
		clearTimeout(timeout);
		timeout = setTimeout(function() {
				console.log("bing !");
				if (! isUniqueUsername(username)) {
					var validator = $( '.form-register' ).validate();
					validator.showErrors({
  						"username": "The user name is not unique : please change it."
					});
				}
			}, 200);
	}
}

function callBackFullSearch(resultNominatim){
	console.log("callback ok");
	var ok = Sig.showCityOnMap(resultNominatim, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "person");
	if(!ok){
		if($('#city').val() != "") {
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessRegister);
		}
	}
	//$(".topLogoAnim").hide();

	//setTimeout("setMapPositionregister();", 1000);
}
// function setMapPositionregister(){ console.log("setMapPositionregister");
// 	Sig.map.panTo(Sig.markerNewData.getLatLng(), {animate:false}); 
// 	Sig.map.panBy([300, 0]);
// }

//quand la recherche par code insee a fonctionné
function callbackFindByInseeSuccessRegister(obj){
	console.log("callbackFindByInseeSuccess");
	//si on a bien un résultat
	if (typeof obj != "undefined" && obj != "") {
		//récupère les coordonnées
		var coords = Sig.getCoordinates(obj, "markerSingle");
		//si on a une geoShape on l'affiche
		if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
		//on affiche le marker sur la carte
		$("#alert-city-found").show();
		//console.log("verification contenue obj");
		//console.dir(obj);
		Sig.showCityOnMap(obj, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "person");

		if(typeof obj.name != "undefined"){
			$("#main-title-public2").html("<i class='fa fa-university'></i> "+obj.name);
			$("#main-title-public2").show();
		}

		hideLoadingMsg();
				
		//showGeoposFound(coords, projectId, "projects", projectData);
	}
	else {
		console.log("Erreur getlatlngbyinsee vide");
	}
}
	function searchAddressInGeoShape(){
		if($('#cp').val() != "" && $('#cp').val() != null){
			findGeoposByInsee($('#city').val(), callbackFindByInseeSuccessAdd);
		}
	}

	function callbackFindByInseeSuccessAdd(obj){
		console.log("callbackFindByInseeSuccessAdd");
		console.dir(obj);
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			currentCityByInsee = obj;
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une street dans le form
			if($('#fullStreet').val() != "" && $('#fullStreet').val() != null){
				//si on a une geoShape dans la reponse obj
				if(typeof obj.geoShape != "undefined") {
					//on recherche avec une limit bounds
					var polygon = L.polygon(obj.geoShape.coordinates);
					var bounds = polygon.getBounds();
					Sig.execFullSearchNominatim(0, bounds);
				}
				else{
					//on recherche partout
					Sig.execFullSearchNominatim(0);
				}
			}
			else{
				Sig.showCityOnMap(obj, <?php echo isset($_GET["isNotSV"]) ? "true":"false" ; ?>, "person");
			}

			if(typeof obj.name != "undefined"){
				$("#main-title-public2").html("<i class='fa fa-university'></i> "+obj.name);
				$("#main-title-public2").show();
			}
			hideLoadingMsg();
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}
//quand la recherche par code insee n'a pas fonctionné
function callbackFindByInseeError(){
	console.log("erreur getlatlngbyinsee");
}

function showFormRegister(){
	initHTML5Localisation('prefill');
	$("#mapCanvasBg").show(900);
	$(".box-discover").hide(400);
	$(".box-menu").hide(400);
	$(".box-ajax").hide(400);
	if($(".form-group #cp").val() != "")
		searchCity();
	if(Sig.currentMarkerPopupOpen != null) Sig.currentMarkerPopupOpen.closePopup();
}

function showDiscover(){
	$(".box-discover .box").hide();
	//$("#main-title-public2").hide();
	showSearchBar(false);
	showPanel('box-whatisit');
	$(".box-discover").show(400);
	$(".box-login").hide(400);
	if( $(".box-menu-elements").is(':visible') )
		$(".box-menu-elements").slideUp();
	$(".box-menu-what").slideDown();
	if(Sig.currentMarkerPopupOpen != null) Sig.currentMarkerPopupOpen.closePopup();
}
function showDiscoverCluster(){
	$(".box").hide();
	//$("#main-title-public2").hide(400);
	$(".box-menu-elements").show(400);
	$(".box-discover").show(400);
	showPanel('box-people','bgyellow');
	if(Sig.currentMarkerPopupOpen != null) Sig.currentMarkerPopupOpen.closePopup();
}
function showElements(){
	$(".box-discover .box").hide();
	//$("#main-title-public2").hide();
	showSearchBar(false);
	$(".box-login").hide(400);
	if( !$(".box-menu-elements").is(':visible') ){
		$(".box-menu-what").slideUp();
		$(".box-menu-elements").slideDown();
	}
}
function showSearchBar(show){
	if(show && !$(".searchBarForm").is(":visible")){
		//$("#main-title-public2").hide(400);
		//$(".box-discover").hide(400);
		$(".box").hide(400);
		$(".searchBarForm").show(400);

		if($("#dropdown_searchTop").css("display") == "none")
		$(".container-lbl-info-search").show(400);

		if(Sig.currentMarkerPopupOpen != null) Sig.currentMarkerPopupOpen.closePopup();
	}else if(!show && $(".searchBarForm").is(":visible")){
		$(".searchBarForm").hide(400);
		$(".container-lbl-info-search").hide(400);
		if($("#main-title-public2").html() != "") $("#main-title-public2").show(400);
		if(Sig.currentMarkerPopupOpen != null) Sig.currentMarkerPopupOpen.openPopup();
	}
}

function showPublicMap(){
	var show = $("#mapCanvasBg").css("display") == "none";
	if(show){
		if($("#main-title-public2").html() != "") $("#main-title-public2").show(400);
		$(".box-discover").hide(400);
		$(".box-menu").hide(400);
		$(".searchBarForm").hide(400);
		$("#mapCanvasBg").show(400);
	}else{
		$("#main-title-public2").hide(400);
		$("#mapCanvasBg").hide(400);
	}
}

/*SEARCH BAR*/


function autoCompleteSearch(name){
    var data = {"name" : name};
    $.ajax({
      type: "POST",
          url: baseUrl+"/" + moduleId + "/search/globalautocomplete",
          data: data,
          dataType: "json",
          success: function(data){
            if(!data){
              toastr.error(data.content);
            }else{
          str = "";
          var city, postalCode = "";
          $.each(data, function(i, v) {
            var typeIco = i;
            var ico = mapIconTop["default"];
            if(v.length!=0){
              $.each(v, function(k, o){
                
                typeIco = o.type;
                ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                htmlIco ="<i class='fa "+ ico +" fa-2x'></i>"
               
                //console.dir(o);
                  
                if (o.address != null) {
                  console.dir(o.address);
                  city = o.address.addressLocality;
                  //postalCode = o.address.postalCode;
                  //insee = o.address.insee;
                }
                
                if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                  var htmlIco= "<img width='50' height='50' alt='image' class='img-circle' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                }

                var insee      = o.insee ? o.insee : "";
                var postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                str +=  //"<div class='searchList li-dropdown-scope' >"+
                          "<a href='javascript:;' data-id='"+ o.id +"' data-type='"+ i +"' data-name='"+ o.name +"' data-icon='"+ ico +"' data-insee='"+ insee +"' class='searchEntry searchList li-dropdown-scope'>"+
                          "<ol>"+
                          "<span>"+ htmlIco +"</span>  " + o.name;

                var cityComplete = "";
                //console.log("POSTAL CODE : " + postalCode + " - " + insee + " - " + city);
                if("undefined" != typeof city && city != "Unknown") cityComplete += city;
                if("undefined" != typeof postalCode && postalCode != "Unknown" && cityComplete != "") cityComplete += " ";
                if("undefined" != typeof postalCode) cityComplete += postalCode;
                str +=   "<span class='city-search'> "+cityComplete+"</span>";

                str +=  "</ol></a>";//</div>";
              })
            }
            }); 
            if(str == "") str = "<div class='li-dropdown-scope'><ol><i class='fa fa-ban'></i> Aucun résultat</ol></div>";
            
            $(".container-lbl-info-search").hide(400);
            $("#dropdown_searchTop").html(str);
            $("#dropdown_searchTop").css({"display" : "inline" });
            $('#notificationPanel').hide("fast");

 
            addEventOnSearch(); 
          }
      } 
    });

    str = "<div class='li-dropdown-scope'><ol><i class='fa fa-circle-o-notch fa-spin'></i> Recherche en cours</ol></div>";
    $("#dropdown_searchTop").html(str);
    $("#dropdown_searchTop").css({"display" : "inline" });
                    
  }

  function addEventOnSearch() {
    $('.searchEntry').off().on("click", function(){
      setSearchInput($(this).data("id"), $(this).data("type"),
                     $(this).data("name"), $(this).data("icon"), 
                     $(this).data("insee") );

      $('#dropdown_searchTop').css("display" , "none");
    });
  }

  function setSearchInput(id, type,name,icon, insee){
    if(type=="citoyen"){
      type = "person";
    }
    url = "/"+type+"/detail/id/"+id;
    
    if(type=="cities")
        url = "/city/detail/insee/"+insee+"?isNotSV=1";

    
    //showAjaxPanel( '/'+type+'/detail/id/'+id, type+" : "+name,icon);
    openMainPanelFromPanel( url, type+" : "+name,icon, id);
    /*
    $("#searchBar").val(name);
    $("#searchId").val(id);
    $("#searchType").val(type);
    $("#dropdown_searchTop").css({"display" : "none" });*/  
  }

  


</script>