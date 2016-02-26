
<style>
.lbl-btn-menu-name, .lbl-btn-menu-name-add{
    display: none;
	font-size: 17px;
	text-align: left;
	padding: 2px 2px;
	border-radius: 26px;
	z-index: 0;
	width: 100px;
	font-weight: 300;
	font-family: "homestead";
}
.lbl-btn-menu-name-add{
    display: inline;
}

.text-green-success{
	color:#7ACF5B;
}
.hover-menu{
	width: 17%;
	height: 400px;
	position: fixed;
	top: 0px;
	left: 0px;
	z-index: 1;
	overflow: visible;
}

.explain ul{
	list-style: none;
	font-size: 1.5em;
}


.drop-up-btn-add{
	display:none;
	position: fixed;
	bottom: 75px;
	right: 25px;
	height: 220px;
	background-color: transparent;
	width: 300px;
	z-index:10;
}
.drop-up-btn-add button{
	padding-right:6px;
}	
.btn-menu-add1{
	position:absolute !important;
	top:15px;
	right:15px;
}
.btn-menu-add2{
	position:absolute !important;
	top:65px;
	right:15px;
}
.btn-menu-add3{
	position:absolute !important;
	top:115px;
	right:15px;
}
.btn-menu-add4{
	position:absolute !important;
	top:165px;
	right:15px;
}
.hover-info{
	display: none;
	margin-top: 130px;
	position: fixed !important;
	top: 0px;
	left: 0px;
	z-index: 1;
	overflow: visible;
	border: 0px solid #3C5665;
	border-radius:5px;
	background-color: white;
	-moz-box-shadow: 0px 0px 5px 0px #353535 !important;
	-webkit-box-shadow: 0px 0px 5px 0px #353535 !important;
	-o-box-shadow: 0px 0px 5px 0px #353535 !important;
	box-shadow: 0px 0px 5px 0px #353535 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}
.explain ul{
	list-style: none;
	font-size: 1.3em;
}
.infoVersion{
	display: none;
	position: fixed;
	bottom: 165px;
	left : 20px;
}


.btn-param-postal-code{
	left: 56px;
	bottom: 56px;
	width: 55px !important;
	height: 55px !important;
	border-radius: 50%;
	z-index:2;
	color: #FFF;
	font-size: 19px;
	-moz-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	-webkit-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	-o-box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	box-shadow: 0px 0px 5px 0px rgba(66, 66, 66, 0.79) !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}

#btn-geoloc-auto-menu{
	left: 105px;
	top: 60px;
}

#input-communexion{
	display:none;
	position:fixed;
	bottom:0px;
	left:0px;
	z-index: 1;
}

#searchBarPostalCode{
	position: absolute;
	left: 52px;
	bottom: 52px;
	margin-top: 10px;
	width: 350px;
	margin-left: 0px;
	font-family: "homestead";
	font-size: 22px !important;
	border-radius: 55px !important;
	height: 63px;
	padding-left: 69px !important;
	text-align: left;
}

#input-communexion .search-loader{
	position: absolute;
	left: 75px;
	bottom: 120px;
	width: 350px;
	font-weight: 600;
	font-size: 14px;
}
.homeShortcuts{position:absolute;top:450px;right:20px;}
.homeShortcuts ul{list-style: none; }
.homeShortcuts a{color: #9D9396;}
.homeShortcuts a:hover{	color: #00B8EB;}

<?php 	//masque les boutons Directory, Agenda, News si l'utilisateur n'est pas communecté
		if(!isset( Yii::app()->request->cookies['inseeCommunexion'] )) {  		 
?>
button.btn-menu2, .btn-menu3, .btn-menu4{
	display: none;
}
<?php } ?>


#menu-bottom{
	position:fixed;
	bottom:0px;
	left:0px;
	height:40px;
	width:100%;
	background-color:white;
	z-index: 10;
	-moz-box-shadow: 0px -2px 5px -2px #353535 !important;
	-webkit-box-shadow: 0px -2px 5px -2px #353535 !important;
	-o-box-shadow: 0px -2px 5px -2px #353535 !important;
	box-shadow: 0px -2px 5px -2px #353535 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}

#menu-bottom .btn-menu-add {
	border-radius: 0px;
	right: 0px;
	bottom: 0px;
	height: 40px;
}

#menu-bottom .btn-param-postal-code{
	border-radius: 0px;
	left: 0px;
	bottom: 0px;
	height: 40px !important;
	width: 40px !important;
	font-size: 15px;
}


@media screen and (max-width: 768px) {
	#searchBarPostalCode{
		position: relative;
		left: 2% !important;
		bottom: 45px;
		margin-top: 10px;
		width: 96%;
		margin-left: 0px;
		font-family: "homestead";
		font-size: 22px !important;
		border-radius: 0px !important;
		height: 50px;
		text-align: center;
		padding-left: 15px !important;
	}

	#input-communexion {
	    width: 100%;
	}

	#input-communexion .search-loader {
	    position: absolute;
	    left: 2%;
	    bottom: 95px;
	    width: 96%;
	    font-weight: 600;
	    font-size: 12px;
	    background-color: rgb(255, 255, 255);
	    padding: 5px;
	    border-radius:5px 5px 0px 0px;
	    text-align: center;
	}

	#menu-bottom .input-global-search{
		left: 44px;
		height: 40px;
		position: relative;
		width: 74%;
		border: 0px;
	}
	.main-top-menu .dropdown-result-global-search {
	    bottom: 40px;
		right: 5%;
		width: 90%;
		top: unset;
		border-radius: 10px 10px 0px 0px;
		-moz-box-shadow: 0px -9px 12px 3px rgba(66, 66, 66, 0.37) !important;
		-webkit-box-shadow: 0px -9px 12px 3px rgba(66, 66, 66, 0.37) !important;
		-o-box-shadow: 0px -9px 12px 3px rgba(66, 66, 66, 0.37) !important;
		box-shadow: 0px -9px 12px 3px rgba(66, 66, 66, 0.37) !important;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;		
	}

	.drop-up-btn-add {
	    bottom: 40px;
	    right: 0px;
	    background-color: rgba(255, 255, 255, 0.8);
	}
}


</style>


<?php 
    if(isset(Yii::app()->session['userId']))
    $me = Person::getById(Yii::app()->session['userId']);
   	echo $this->renderPartial('explainPanels');
?>


<div class="hover-menu hidden-xs">
	

	<?php if(!isset(Yii::app()->session['userId'])){ ?>
	<!-- <button class="menu-button btn-menu btn-login tooltips" data-toggle="tooltip" data-placement="right" title="Se connecter" alt="Se connecter">
			<i class="fa fa-sign-in"></i>
	</button> -->
	<?php }else{ ?>
	<button class="menu-button btn-menu btn-logout tooltips" data-toggle="tooltip" data-placement="right" title="Déconnection" alt="Se déconnecter">
			<i class="fa fa-sign-out"></i>
	</button>
	<?php } ?>

	<button class="menu-button menu-button-left menu-button-title btn-menu bg-red btn-geoloc-auto" id="btn-geoloc-auto-menu">
		<i class="fa fa-crosshairs"></i>
		<span class="lbl-btn-menu-name">Communectez-moi</span>
	</button>

	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu0 bg-red tooltips" 
			data-toggle="tooltip" data-placement="right" title="Accueil" alt="Accueil">
			<i class="fa fa-home"></i>
	</button>
	<?php if(!isset(Yii::app()->session['userId'])){ ?>
	<!-- <button class="menu-button menu-button-title btn-register btn-menu btn-menu1  <?php echo ($page == 'add') ? 'selected':'';?>" 
			data-toggle="tooltip" data-placement="right" title="S'inscrire" alt="S'inscrire">
			<i class="fa fa-plus-circle"></i>
			<span class="lbl-btn-menu-name">S'inscrire</span>
	</button> -->
	<?php } ?>
	<button class="menu-button menu-button-left menu-button-title btn-menu btn-menu2 bg-azure <?php echo ($page == 'directory') ? 'selected':'';?>">
			<i class="fa fa-connectdevelop"></i>
			<span class="lbl-btn-menu-name">L'Annuaire <span class="text-dark" style="font-size:12px;">communecté</span></span>
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

	<?php if(isset($me)) if(Role::isDeveloper($me['roles'])){?>
    <button class="menu-button menu-button-left menu-button-title btn-menu btn-menu7 bg-red <?php echo ($page == 'admin') ? 'selected':'';?>" onclick="loadByHash('#admin.index?isNotSV=1')" >
			<i class="fa fa-cog"></i>
			<span class="lbl-btn-menu-name"><?php echo Yii::t("common", "ADMIN"); ?></span>
	</button>
	<?php } ?>
	
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
	</div>

	<div class="infoVersion">
		update <?php echo $this->versionDate ?>
		<br/>
		<span class="homestead" style="font-size: 1.5em">version <a href="javascript:;" data-id="explainBeta" class="explainLink text-red">Béta</a></span>
		<br/><span >Tests et améliorations en continu</span>
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


<?php 
	$actionBtnMyCity = "";
	if($inseeCommunexion != ""){
		$actionBtnMyCity = "loadByHash('#city.detail.insee.".$inseeCommunexion."');";
	}
?>
<div class="visible-xs" id="menu-bottom">
	<button class="menu-button menu-button-title bg-red tooltips btn-param-postal-code" onclick="<?php echo $actionBtnMyCity; ?>"
		<?php if($actionBtnMyCity != ""){ ?>data-toggle="tooltip" data-placement="bottom" title="<?php echo $cityNameCommunexion; ?> en détails" alt="<?php echo $cityNameCommunexion; ?> en détails" <?php } ?> >
		<i class="fa fa-university"></i>
	</button> 
	<input type="text" class="text-dark input-global-search visible-xs" id="input-global-search-xs" placeholder="rechercher ..."/>
	<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
		<span class="lbl-btn-menu-name">Ajouter</span></span>
		<i class="fa fa-plus-circle"></i>
	</button>
</div>


<style>
.globale-announce{
	position: fixed;
	bottom: 0px;
	background-color: rgb(255, 255, 255);
	z-index: 1;
	width: 400px;
	margin-left: 20%;
	padding-top: 10px !important;
	font-size: 16px;
	border-radius: 10px 10px 0px 0px;
	padding: 10px;
	border-radius: 10px 10px 0px 0px;
	-moz-box-shadow: 0px -2px 5px -2px #353535 !important;
	-webkit-box-shadow: 0px -2px 5px -2px #353535 !important;
	-o-box-shadow: 0px -2px 5px -2px #353535 !important;
	box-shadow: 0px -2px 5px -2px #353535 !important;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#2BB0C6, Direction=NaN, Strength=5) !important;
}

#btn-close-globale-announce{
	width: 30px;
	height: 30px;
	border-radius: 20px;
	position: absolute;
	right: 5px;
	top: 4px;
	text-align: center;
	padding: 0px;
}
</style>
<div class="globale-announce text-dark hidden-xs">
	<div id="kkbb-min" style="display:none; margin-bottom: -12px;">
		<img style="height: 25px; margin-top: -18px;" src="<?php echo $this->module->assetsUrl?>/images/announce-kkbb1.png"/>
		<img style="height: 25px; margin-top: -18px;" src="<?php echo $this->module->assetsUrl?>/images/announce-kkbb2.png"/>
	</div>
	<div id="kkbb-big">
		<button class="btn btn-default" id="btn-close-globale-announce"><i class="fa fa-times"></i></button>
		<a href="javascript:" target="_blank"><img class="pull-left" style="width:20%;" 
			 src='<?php echo $this->module->assetsUrl?>/images/piggybank.png'/></a>
		
		<div class="pull-left homestead text-red" style="width:50%; font-size: 23px; margin-left: 10px; margin-top: 15px; line-height: 28px;">
			Du 26 février<br/>
			Au 15 avril
		</div>

		
		<a href="javascript:" target="_blank">
			<img class="pull-right" style="width:42%; margin-top: -33px;" src='<?php echo $this->module->assetsUrl?>/images/crowdfoundez.png'/>
		</a>

		<div class="progress" style="width: 63%; position: absolute; bottom: 25px;">
		  <div class="progress-bar bg-red" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: 40%;">
		    40%
		  </div>
		</div>

		<div class="pull-left" style="width:100%; margin-top:5px;">
		<div class="pull-left" style="width:50%; font-weight: 600; font-size: 16px; padding-right: 24px; color:black;">Objectif : 20 000€</div>
		<div class="pull-right text-right" style="width:50%; font-weight: 600; font-size: 16px; padding-right: 24px; color:black;">Collecté : 0€</div>
		</div>
	</div>
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

	setTimeout(function(){ 
		$(".globale-announce").css("width", 250);
		$("#kkbb-big").hide(400);
		$("#kkbb-min").show(400);
	}, 15000);

	$('#btn-close-globale-announce').click( function(e){ 
		$(".globale-announce").css("width", 250);
		$("#kkbb-big").hide(400);
		$("#kkbb-min").show(400);
		//var path = "/";
		//if(location.hostname.indexOf("localhost") >= 0) path = "/ph/";

		//$.cookie('kkbbok',  true, { expires: 365, path: path });
	});
	$('#kkbb-min').mouseenter( function(e){ 
		$(".globale-announce").css("width", 400);
		$("#kkbb-min").hide(400);
		$("#kkbb-big").show(400);
		
	});

	$('.btn-menu0').click( function(e){ loadByHash("#default.home")} ).mouseenter(function(e){ 
		if(showMenuExplanation){
			toggle(".explainHome",".explain");
			$(".removeExplanation").parent().show();
		}
	});

    $('.btn-menu2')
    .click(function(e){ 
    	if(location.hash != "#default.directory" || isMapEnd == false) 
    		loadByHash("#default.directory"); 
    	else showMap(false);  
    })
    .mouseenter(function(e){ 
	    if(showMenuExplanation){
		    toggle(".explainDirectory",".explain");
			$(".removeExplanation").parent().show();
		}
	});

    $('.btn-menu3')
    .click(function(e){ 
    	if(location.hash != "#default.agenda" || isMapEnd == false) 
    		loadByHash("#default.agenda"); 
    	else showMap(false);  
    })
    .mouseenter(function(e){ 
	    if(showMenuExplanation){
		    toggle(".explainAgenda",".explain");
			$(".removeExplanation").parent().show();
		}
	});

    $('.btn-menu4')
    .click(function(e){ 
    	if(location.hash != "#default.news" || isMapEnd == false) 
    		loadByHash("#default.news"); 
    	else showMap(false);  
    })
    .mouseenter(function(e){ 
	    if(showMenuExplanation){
	    	$(".removeExplanation").parent().show();
	    	toggle(".explainNews",".explain")
	    }
	 });



   // $('.btn-menu3').click(function(e){ loadByHash("#default.agenda"); 		 }).mouseenter(function(e){ toggle(".explainAgenda",".explain")});
   //$('.btn-menu4').click(function(e){ loadByHash("#default.news");	 }).mouseenter(function(e){ toggle(".explainNews",".explain")} );
    $('.btn-menu5').click(function(e){ showFloopDrawer(true);	 		 }).mouseenter(function(e){ 
	    if(showMenuExplanation)	
	    	toggle(".explainMyDirectory",".explain")
	    });
    $('.btn-menu6').mouseenter(function(e){ 
	    if(showMenuExplanation){
	    	$(".removeExplanation").parent().show();
	    	toggle(".explainHelpUs",".explain")
	    }
	});
    
    $(".btn-menu-add").mouseenter(function(){
    	$(".drop-up-btn-add").show(400);
    	$(".drop-up-btn-add .lbl-btn-menu-name").css("display","inline");
    	$(".btn-menu-add .lbl-btn-menu-name").css("display", "inline");
    });
    
    $(".btn-login").click(function(){
		console.log("btn-login");
		showPanel("box-login");
		//$(".main-col-search").html("");
	}).mouseenter(function(e){ 
		if(showMenuExplanation){
			$(".removeExplanation").parent().show();
			toggle(".explainConnect",".explain");
		}
	});

    $(".btn-register").click(function(){
    	console.log("btn-register");
		showPanel("box-register");
		//$(".main-col-search").html("");
	}).mouseenter(function(e){ 
		if(showMenuExplanation){
			$(".removeExplanation").parent().show();
			toggle(".explainRegister",".explain");
		}
	});

	$(".btn-logout").click(function(){
    	console.log("btn-logout");
		window.location.href = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";
	});

	$(".btn-param-postal-code").mouseenter(function(e){
		showInputCommunexion();
		if(showMenuExplanation){
			$(".removeExplanation").parent().show();
			showDefinition("explainCommunectMe");
		}
	});

	$("#searchBarPostalCode").mouseenter(function(e){
		clearTimeout(timeoutCommunexion);
	});

	var timeoutSearch = setTimeout(function(){}, 0);
	$('#searchBarPostalCode').keyup(function(e){
		//if(location.hash == "#default.home"){
	        clearTimeout(timeoutSearch);
      		timeoutSearch = setTimeout(function(){ startNewCommunexion(); }, 1200);
	    //}
    });
    
    $(".btn-geoloc-auto").click(function(e){
		if(geolocHTML5Done == false){
			//$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Géolocalisation en cours ...");		
			showMap(true);
    		initHTML5Localisation('communexion');
		}
    	else{
    		$("#modal-select-scope").modal("show");
    	}
    }).mouseenter(function(e){
		if(showMenuExplanation){
			showDefinition("explainCommunectMe");
			$(".removeExplanation").parent().show();
		}
	});;
	


	var timeoutHover = setTimeout(function(){}, 0);
	var hoverPersist = false;
	var positionMouseMenu = "out";

	$(".hover-menu").mouseenter(function(){
		//console.log("enter all");
		positionMouseMenu = "in";
		$(".main-col-search").animate({ opacity:0.3 }, 400 );
		$(".lbl-btn-menu-name").show(200);
		$(".lbl-btn-menu-name").css("display", "inline");
		$(".menu-button-title").addClass("large");

		//showInputCommunexion();

		
	});


	$(".hover-menu .btn-menu").mouseenter(function(){
		//console.log("enter btn, loginRegister", isLoginRegister());
		if(!isLoginRegister()){
			positionMouseMenu = "inBtn";
			$(".main-col-search").animate({ opacity:0.3 }, 200 );
			$(".menu-button-title").addClass("large");

			/*hoverPersist = false;
			clearTimeout(timeoutHover);
			timeoutHover = setTimeout(function(){
				hoverPersist = true;*/
				if(showMenuExplanation)
				$(".lbl-btn-menu-name, .hover-info, .infoVersion").css("display" , "inline");
			//}, 1500);
		}
	});

	$(".main-col-search, .mapCanvas").click(function(){
		//permet de savoir si l'utilisateur est en train de se logguer ou de s'inscrire
	    if(!isLoginRegister()){
	    	hoverPersist = false;
			positionMouseMenu = "out";
			$(".main-col-search").animate({ opacity:1 }, 200 );
			$(".lbl-btn-menu-name").hide();
			$(".menu-button").removeClass("large");
		}
		$(".hover-info, .infoVersion").hide();
		$(".drop-up-btn-add").hide(400);
		$("#notificationPanelSearch").hide();
		//console.log("hide communexion");
		//timeoutCommunexion = setTimeout(function(){ console.log("HIDE HIDE"); $("#input-communexion").hide(200); clearTimeout(timeoutCommunexion); }, 800);
		//console.log("HIDE HIDE");
		//$("#input-communexion").hide(200); 
		$("#input-communexion").hide(400);
		clearTimeout(timeoutHover);
	});

	$(".main-col-search, .mapCanvas").mouseenter(function(){
			//permet de savoir si l'utilisateur est en train de se logguer ou de s'inscrire
		    if(!hoverPersist){
				if(!isLoginRegister()){
					positionMouseMenu = "out";
					$(".main-col-search").animate({ opacity:1 }, 200 );
					hoverPersist = false;
					$(".lbl-btn-menu-name").hide();
					$(".menu-button").removeClass("large");
					timeoutCommunexion = setTimeout(function(){ console.log("HIDE HIDE"); $("#input-communexion").hide(200); clearTimeout(timeoutCommunexion); }, 300);
				}
				$(".hover-info").hide();
				$(".drop-up-btn-add").hide(400);
				$("#notificationPanelSearch").hide();
				clearTimeout(timeoutHover);
				//$("#input-communexion").hide(400);
			}
	});

	$(".menu-button").click(function(){
		//console.log("login display", !isLoginRegister());
		//permet de savoir si l'utilisateur est en train de se logguer ou de s'inscrire
	    var login_register = isLoginRegister();
	    
	    console.log(isLoginRegister());
	    if(!isLoginRegister()){
			positionMouseMenu = "out";
			$(".main-col-search").animate({ opacity:1 }, 200 );
			hoverPersist = false;
			$(".lbl-btn-menu-name").hide();
			$(".menu-button").removeClass("large");
		}
		$(".hover-info, .infoVersion").hide();
		//$(".drop-up-btn-add").hide(400);
	});

	$(".btn-menu-add").click(function(){
    	$(".btn-menu-add .lbl-btn-menu-name").show(200);
		$(".btn-menu-add .lbl-btn-menu-name").css("display", "inline");;
    });

	
	function isLoginRegister(){
		if($(".box-login").length <= 0) return false;
		return ($(".box-login").css("display") != "none" || $(".box-register").css("display") != "none");
	}

});

// function showInputCommunexion(){
// 		clearTimeout(timeoutCommunexion);
// 		console.log("showCommunexion");
// 		$("#searchBarPostalCode").css("width", "0px");
// 		$("#searchBarPostalCode").animate({ width:"350px" }, 200 );
// 		$("#input-communexion").show(300);
// 		$(".main-col-search").animate({ opacity:0.3 }, 200 );
// 		$(".hover-info").hide();
// 	}

</script>