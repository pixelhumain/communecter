<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);
//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);

$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/localisationHtml5.js' , CClientScript::POS_END);
//geolocalisation nominatim et byInsee
$cs->registerScriptFile($this->module->assetsUrl. '/js/sig/geoloc.js' , CClientScript::POS_END);
	
?>
<style>
	fieldset{
		padding: 20px;
		padding-top:0px;
		padding-left:30px;
		background-color: white;
	}
#mapCanvasBg{
	visibility: hidden;
}
.topLogoAnim{
	background-color: rgba(255, 255, 255, 0);
	position: absolute;
	z-index: 10;
	top: 110px !important;
	/*right: 14%;*/
	width: 400px;
	padding-left: 10px;
}
.topLogoAnim .homestead{
	font-size:31px !important;
	font-weight: 100 !important;
}
.box-login, .box-register, .box-email{
	position: absolute; !important;
	top: 0px !important;
	left: 0px !important;
	right: unset !important;
	margin:0px !important;
	width: 400px;
	padding:0px !important;
	-moz-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.35);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.35);
	-o-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.35);
	box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.35);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);

	/*
	-moz-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-o-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
	*/
}
.box-register{
	width:530px;
	margin-left:-100px !important;
}
.titleWhite, .subTitle{
	color:#3C5665 !important;
}
.subTitle{
	font-weight: 300;
	font-size: 15px;
	margin-top: -7px !important;
}
.byPHRight{
	height: 39px;
	left: 300px;
	top: 20px;
	z-index: 2000;
	position: absolute;
}
.byPHRight img{
	height: 39px;
}
.box-white-round{
	border-radius: 15px !important;
}
input.form-control{
	text-align: center;
	border-radius: 6px !important;
	padding:10px;
	height:40px !important;
	font-size:16px;
	border-color:#CECECE;
}

.box-login span.input-icon i.fa{
	display: none;
}
.box-register span.input-icon i.fa{
	padding-top:3px;
}
label.checkbox-inline{
	font-size:12px !important;
}
.form-actions{
	padding-top:0px !important;
}

.loginBtn{
	/*margin-top:-25px;*/
}

.btn.register, a.btn.go-back{
	width:100%;
	margin-top: -1px;
	border-radius: 0px;
	border-color: transparent;
	padding: 7px;
	font-size: 14px;
	border-top: 1px solid rgb(209, 209, 209);
	background-color: white;
}
.btn.register:hover, a.go-back:hover{
	background-color: #D3DDE1;
}
.new-account {
	border:0px !important;
    margin-top: 0px !important;
    padding-top: 0px !important;
}

.big-button{
	position:fixed;
	top:80px;
	left:40px;
	z-index: 100;
}
.big-button.btn-1{
	top: 20px;
	left: 56px;
}
.big-button.btn2{
	top:170px;
}
.big-button.btn3{
	top:260px;
}
.big-button.btn4{
	top:350px;
}
.big-button.btn5{
	top:440px;
}
.big-button.btn6{
	top:530px;
}
.big-button.btn7{
	top:620px;
}
.big-button img, .big-button i{
	height: 67px;
	width: 67px;
	border-radius: 50%;
	padding: 10px;
	font-size:47px;
	text-align:center;
	color:#3C5665;
	background-color: #FFF;
	-moz-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-o-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}
.big-button.btn-1 i{
	height: 34px;
	width: 34px;
	border-radius: 50%;
	padding: 5px;
	font-size: 23px;
}

.big-button img:hover, .big-button i:hover{
	-moz-box-shadow: 0px 0px 5px 7px rgba(54, 210, 94, 0.6);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(54, 210, 94, 0.6);
	-o-box-shadow: 0px 0px 5px 7px rgba(54, 210, 94, 0.6);
	box-shadow: 0px 0px 5px 7px rgba(54, 210, 94, 0.6);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}
.big-button.btn2:hover, .big-button.btn3:hover{
	background-color: transparent !important;
}

.main-title-public{
	display: none;
	position: fixed;
	left: 150px;
	background-color: rgba(255, 255, 255, 0.91);
	padding: 10px 40px;
	z-index: 100;
	border-radius: 50px;
	-moz-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-o-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}
#main-title-public1{
	font-size: 20px;
	top: -20px;
	border-radius: 0px 0px 10px 10px;
}
#main-title-public2{
	font-size: 45px;
	top: 40px;
}

.box-discover{
	position: absolute;
	top: 60px;
	left: 530px;
	display: block;
}

.box-discover .box{
	padding: 30px;
	background-color: rgba(35, 35, 35, 0.9);
	border-radius: 10px;
	padding-bottom: 90px;
	max-width: 500px;
	-moz-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-o-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}

.box-discover .box .nextBtns {
    color: #E33551;
    background-color: rgba(0, 0, 0, 0.5);
    font-size: 2.5em;
    margin-top: 40px;
    padding: 15px;
    border-radius: 0px 0px 10px 10px;
    width:100%;
    position: absolute;
    bottom:0px;
    left:0px;
    text-align: right;
}
.box-discover .box .nextBtns:hover {
	/*color: #FFF;*/
    background-color: rgba(0, 0, 0, 0.2);
    
}
body.login .box h1{
	color:#E33551;
	font-size:40px;
}
.box-discover .box h1 {
	color:#E33551;
    font-weight: 100;
    font-family: "homestead";
    font-size: 40px;
}
/*.box-discover .box h1.person {color:<?php //echo Person::COLOR; ?> !important;}
.box-discover .box h1.orga {color:<?php //echo Organization::COLOR; ?> !important;}
.box-discover .box h1.event {color:<?php //echo Event::COLOR; ?> !important;}
.box-discover .box h1.project {color:<?php //echo Project::COLOR; ?> !important;}
.box-discover .box h1.city {color:<?php //echo City::COLOR; ?> !important;}*/

.box-discover .box section {
    color: #FFF !important;
    font-size: 25px;
    font-weight: 300 !important;
}
.box.box-menu{
	display:hidden;
	position: absolute !important;
	left: 160px !important;
	top: 10px !important;
	background-color: transparent;
}
.box.box-menu ul{
	list-style: outside none none;
	font-size: 3.1em;
	margin-top: 50px;
	border-radius: 20px !important;
	overflow: hidden;
	padding-left: 0px;
	-moz-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-o-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}
.box.box-menu ul li{
	font-size: 0.8em !important;
	font-weight: 100 !important;
	font-family: "homestead";
	padding: 2px 10px;
	background-color: rgba(230, 230, 230, 0.92);
	color: #3C5665;
	border-bottom: 1px solid rgba(45, 99, 117, 0.35);
	margin-left: 0px !important;
}
.box.box-menu ul li a i.fa{
	text-align: center;
	width: 35px;
}
.box.box-menu ul li a{
	color:#3C5665;
	width:100%;
	display: block;
}
.box.box-menu ul li:hover{
	color: #608092 !important;
}
.box.box-menu ul li a:hover{
	color: inherit;
}

.box.box-menu-elements li a{
	color:white !important;
}
.box.box-menu-elements li a:hover{
	color:white !important;
}
.box.box-menu ul li{
	padding: 5px 25px 5px 15px;
	color:white !important;
	-moz-box-shadow: 0px 2px 5px 5px rgba(24, 24, 24, 0.5);
	-webkit-box-shadow: 0px 2px 5px 5px rgba(24, 24, 24, 0.5);
	-o-box-shadow: 0px 2px 5px 5px rgba(24, 24, 24, 0.5);
	box-shadow: 0px 2px 5px 5px rgba(24, 24, 24, 0.5);
}
.box.box-menu ul li:hover{
	color:rgba(207, 1, 1, 0.62) !important;
	-moz-box-shadow: 0px 2px 5px 4px rgba(207, 1, 1, 0.62);
	-webkit-box-shadow: 0px 2px 5px 4px rgba(207, 1, 1, 0.62);
	-o-box-shadow: 0px 2px 5px 4px rgba(207, 1, 1, 0.62);
	box-shadow: 0px 2px 5px 4px rgba(207, 1, 1, 0.62);
}
.box.box-menu-elements ul li:hover{
	color:white !important;
	-moz-box-shadow: 0px 2px 5px 7px rgba(255, 255, 255, 0.5);
	-webkit-box-shadow: 0px 2px 5px 7px rgba(255, 255, 255, 0.5);
	-o-box-shadow: 0px 2px 5px 7px rgba(255, 255, 255, 0.5);
	box-shadow: 0px 2px 5px 7px rgba(255, 255, 255, 0.5);
}
</style>

<!-- ---__________________________---__________________________---__________________________ -->

<!-- ---__________________________---__________________________---__________________________ -->

<style type="text/css">
.box-ajax{
	top: 40px !important;
	background-color: rgba(255, 255, 255, 0.83) !important;
	-moz-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-webkit-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	-o-box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	box-shadow: 0px 0px 5px 7px rgba(41, 41, 41, 0.56);
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=5);
}
  .box-ajaxTools .btn.tooltips{
    margin-right: 5px;
	margin-bottom: -1px;
	font-size: 13px;
	height: 46px;
	transition: all 0.1s ease 0s !important;
	padding: 13px;
	color: #315C6E;
	font-weight: 500;
	border-radius: 30px;
	border-top-width: 0px;
	border-color: transparent;
  }
/*
  .box-ajaxTools .text-right .btn.tooltips{
    border-radius: 0px 10px 0px 10px;
    margin-right: 5px;
  }*/

  .box-ajaxTools .btn.tooltips:hover{
    border-bottom: 3px solid #719FAB !important;
    background-color: rgba(49, 92, 110, 1);
    color:white;
    /*height: 45px;*/
  }
  .box-ajaxTools .btn.tooltips.active{
    border-bottom: 3px solid #337793;
    background-color: #315C6E;
    color:white;
  }
  .box-ajaxTools .btnSpacer{
    margin-right: 0px;
  }
  .box-ajaxTools i.fa{
    min-width: 18px;
    width:auto;
    font-size: 17px;
  }
  /*.box-ajaxTools{
    z-index: 1;
    text-align: center;
    float: left !important;
    width: 100%;
    top: 48px;
    left: 0px;
    padding: 0px 20px 0px 20px;
    margin-bottom:20px;
  }*/

  .box-ajaxTools{
    z-index: 1;
	text-align: center;
	float: left !important;
	width: 100%;
	top: 56px;
	max-height: 45px;
	left: -1px;
	margin-bottom: 20px;
  }

  .searchBarForm{
  	left: 25px !important;
	background-color: rgba(255, 255, 255, 0.86) !important;
	height: 90px;
	border-radius: 50px !important;
	width: 400px;
	position: fixed;
	top: 68px !important;
	display: none;
  }

  #searchBar{
  	background-color: transparent !important;
	border: 10px solid #FFF !important;
	height: 90px;
	border-radius: 50px !important;
	padding-left: 90px;
	font-size: 21px;
	left: 0px;
	right: unset;
	width: 400px;
  }

  #dropdown_searchTop{
  	margin-left: 65px;
	width: 700px;
	background-color: transparent;
	box-shadow: none;
	border: medium none;
	max-height: 320px;
	overflow-y: hidden;
	padding-right: 20px;
	margin-top: -4px;
	padding-left: 30px;
  }

  #dropdown_searchTop .li-dropdown-scope ol {
    padding: 5px 25px 5px 15px !important;
	color: #155869;
	border-radius: 30px;
	background-color: #FFF;
	margin-top: 3px;
	float: left;
	margin-right: 5px;
  }

  #dropdown_searchTop .li-dropdown-scope ol img.img-circle {
	  margin-left: -10px;
	}
  #dropdown_searchTop .li-dropdown-scope ol i.fa {
	 margin-left: -10px;
	 background-color: #155869;
	 color:white;
	 border-radius: 30px;
	vertical-align: middle;
	margin-top: 0px;
	font-size: 23px;
	padding: 13px 12px;
	margin-right: 6px;
	width: 50px;
	height: 50px;
	text-align: center;
	}
  .searchEntry i.fa {
    border-radius: 30px;
    padding: 5px 6px;
    vertical-align: middle;
    margin-top: -5px;
    font-size: 25px;
  }

  .bgcity {
	background-attachment: fixed;
  }

  .markerLabels{
  	font-size: 25px;
    display: none;
    background-color: rgba(39, 39, 39, 0.63);
    padding: 4px 15px;
    border-radius: 30px;
  }
</style>

<h2 class="main-title-public homestead text-dark" id="main-title-public1"></h2>
<h1 class="main-title-public homestead text-red" id="main-title-public2"></h1>



<!-- <div class="pull-right" style="padding:20px;">
	<a href="#" onclick="showHideMenu ()">
		<i class="menuBtn fa fa-bars fa-3x text-white "></i>
	</a>
</div>
 -->
	
	<a href="javascript:" class="big-button btn-1" onclick="initHTML5Localisation();"
		data-toggle="tooltip" data-placement="right" title="Se localiser" alt="">
		<i class="fa fa-crosshairs" style=""></i>
	</a>
	<a href="javascript:" class="big-button searchBar">
		<i class="fa fa-search" style="font-size:30px; padding-top: 16px !important;"></i>
	</a>
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
		data-toggle="tooltip" data-placement="right" title="Afficher/Masquer la carte" alt="">
		<i class="fa fa-map" style="font-size: 30px; padding-top: 20px;"></i> 
	</a>

	<a href="javascript:" class="big-button btn7 tooltips" onclick="updateCitiesGeoFormat();"
		data-toggle="tooltip" data-placement="right" title="Mettre à jour la base de données (Cities)" alt="">
		<i class="fa fa-database" style="font-size: 30px; padding-top: 20px;"></i> 
	</a>

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
	<div class="main-login col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-2 col-md-4 col-md-offset-4 pull-right">
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
						<i class="fa fa-plus"></i> <i class="fa fa-user"></i> <?php echo Yii::t("login","Create an account") ?>
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
		<div class="box-register box box-white-round no-padding">
			
			<form class="form-register">
				<img style="width:100%; border: 10px solid white;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/logoLTxt.jpg"/>
				
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
	    			$("#main-title-public2").html("<i class='fa fa-university'></i> "+"<?php echo Yii::app()->request->cookies['cityName']->value; ?>");
		 		 	$("#main-title-public2").show(400);
		 		 <?php } ?>

	      		showDataByInsee(<?php echo Yii::app()->request->cookies['insee']->value; ?>);
	      		Sig.map.panBy([200, 0]);
	      		$("#mapCanvasBg").show(400);
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

		$(".sigModuleBg").mouseover(function(){
	    	showSearchBar(false);
	    });


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
			Sig.execFullSearchNominatim(0);
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
				Sig.execFullSearchNominatim(0);
			}, 500);
		}
	});

	$('.form-register #fullStreet').change(function(e){
		if($('.form-register #cp').val() != "") {
			Sig.execFullSearchNominatim(0);
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
	
	
}
function showDiscover(){
	$(".box-discover .box").hide();
	$("#main-title-public2").hide();
	showSearchBar(false);
	showPanel('box-whatisit');
	$(".box-discover").show(400);
	$(".box-login").hide(400);
	if( $(".box-menu-elements").is(':visible') )
		$(".box-menu-elements").slideUp();
	$(".box-menu-what").slideDown();
}
function showDiscoverCluster(){
	$(".box").hide();
	$("#main-title-public2").hide(400);
	$(".box-menu-elements").show(400);
	$(".box-discover").show(400);
	showPanel('box-people','bgyellow');

}
function showElements(){
	$(".box-discover .box").hide();
	$("#main-title-public2").hide();
	showSearchBar(false);
	$(".box-login").hide(400);
	if( !$(".box-menu-elements").is(':visible') ){
		$(".box-menu-what").slideUp();
		$(".box-menu-elements").slideDown();
	}
}
function showSearchBar(show){
	if(show && !$(".searchBarForm").is(":visible")){
		$("#main-title-public2").hide(400);
		$(".box-discover").hide(400);
		$(".box-menu").hide(400);
		$(".searchBarForm").show(400);
	}else if(!show && $(".searchBarForm").is(":visible")){
		$(".searchBarForm").hide(400);
		if($("#main-title-public2").html() != "") $("#main-title-public2").show(400);
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