
<style>
	.lbl-btn-menu-name{
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
	.hover-info{
		margin-top: 100px;
		position: fixed;
		top: 0px;
		left: 0px;
		z-index: 1;
		overflow: visible;
		display: none;
		border: 4px solid #3C5665;
	}
	.explain ul{
		list-style: none;
		font-size: 1.5em;
	}
</style>
<div class="hover-info col-md-6 col-md-offset-4 col-sm-9 col-sm-offset-2 col-xs-10 col-xs-offset-1 panel-white padding-20 radius-15">
	<div class="explainHome explain hide">
		<h1 class="homestead">En Savoir plus ?</h1>
		<h1 class="homestead">Qui Sommes Nous ? </h1>
		<h1 class="homestead">Pourquoi Communecter ?</h1>
	</div>
	<div class="explainDirectory explain hide">
		<h1 class="homestead">L'annuaire : comment ca marche ?</h1>
		<h1 class="homestead">Créer son popre répertoire</h1>
	</div>
	<div class="explainMyDirectory explain hide">
		<h1 class="homestead">L'annuaire : comment ca marche ?</h1>

		<h1 class="homestead">Créer son propre répertoire</h1>
	</div>
	<div class="explainNews explain hide">
		<h1 class="homestead">L'actualité : comment ca marche ? </h1>
	</div>
	<div class="explainAgenda explain hide">
		<h1 class="homestead">Les évennements : comment ca marche ? </h1>
	</div>
	<div class="explainHelpUs explain hide">

		<h1 class="homestead">Pour un meilleur outil </h1>
		<ul>
			<li><a href="">Vous avez trouvé un bug ?</a></li>
			<li><a href="">Vous avez une idée géniale ?</a></li>
			<li><a href="">Vous voulez devenir Référant ? </a></li>
			<li><a href="">Une communauté active ?</a></li>
		</ul>
	</div>
	<div class="explainConnect explain hide">

		<h1 class="homestead">En me logguant :</h1>
		<ul>
			<li>Je peux créer mon annuaire</li>
			<li>des évennements</li>
			<li>Créer mon réseau</li>
			<li><a href="">Me Logguer</a></li>
			<li><a href="">Créer un compte</a></li>
		</ul>
	</div>
	<div class="explainRegister explain hide">

		<h1 class="homestead">Pourquoi créer un compte </h1>
		<ul>
			<li>Parce j'ai des choses à partager localement</li>
			<li>Je fait des évennements</li>
			<li>J'ai des Projet a partager</li>
			<li>Je suis membres ou je gère des associtions, des entreprises, de groupe locaux </li>
			<li><a href="javascript:;" onclick='toggle(".explainLinking",".explain")'>Je veux me connecter à mon entourage</a></li>
			<li>Plus on sera nombreux dans nos communes plus nos projets auront du point</li>
			<li><a href="">Créer un compte</a></li>
		</ul>
	</div>
	<div class="explainLinking explain hide">

		<h1 class="homestead">Créer du lien localement :</h1>
		<ul>
			<li>C'est valoriser les acteurs de mon térritoire</li>
			<li>C'est participer à construire un annuaire à <a href="javascript:;" onclick='toggle(".explainValueUsage",".explain")'>valeur par l'usage</a></li>
			<li>C'est créer un térritoire connecté</li>
		</ul>
	</div>
</div>
<div class="hover-menu">
	

	<?php if(!isset(Yii::app()->session['userId'])){ ?>
	<button class="menu-button btn-menu btn-login tooltips" data-toggle="tooltip" data-placement="right" title="Se connecter" alt="Se connecter">
			<i class="fa fa-sign-in"></i>
	</button>
	<?php }else{ ?>
	<button class="menu-button btn-menu btn-logout tooltips" data-toggle="tooltip" data-placement="right" title="Déconnection" alt="Se déconnecter">
			<i class="fa fa-sign-out"></i>
	</button>
	<?php } ?>

	<button class="menu-button menu-button-title btn-menu btn-menu0 bg-red tooltips" 
			data-toggle="tooltip" data-placement="right" title="Accueil" alt="Accueil">
			<i class="fa fa-home"></i>
	</button>
	<?php if(!isset(Yii::app()->session['userId'])){ ?>
	<button class="menu-button menu-button-title btn-register btn-menu btn-menu1  <?php echo ($page == 'add') ? 'selected':'';?>" 
			data-toggle="tooltip" data-placement="right" title="S'inscrire" alt="S'inscrire">
			<i class="fa fa-plus-circle"></i>
			<span class="lbl-btn-menu-name">S'inscrire</span>
	</button>
	<?php } ?>
	<button class="menu-button menu-button-title btn-menu btn-menu2 bg-azure <?php echo ($page == 'directory') ? 'selected':'';?>">
			<i class="fa fa-connectdevelop"></i>
			<span class="lbl-btn-menu-name">L'Annuaire <span class="text-dark" style="font-size:12px;">communecté</span></span>
	</button>

	<button class="menu-button menu-button-title btn-menu btn-menu3 bg-azure <?php echo ($page == 'agenda') ? 'selected':'';?>">
		<i class="fa fa-calendar"></i>
			<span class="lbl-btn-menu-name">L'Agenda <span class="text-dark" style="font-size:12px;">communecté</span></span>
	</button>

	<button class="menu-button menu-button-title btn-menu btn-menu4 bg-azure <?php echo ($page == 'news') ? 'selected':'';?>" 
			data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="L'Actu Communectée">
			<i class="fa fa-rss"></i>
			<span class="lbl-btn-menu-name">L'Actualité <span class="text-dark" style="font-size:12px;">communectée</span></span>
	</button>

	<button class="menu-button menu-button-title btn-menu btn-menu5 bg-dark">
			<i class="fa fa-bookmark fa-rotate-270"></i>
			<span class="lbl-btn-menu-name">Mon répertoire</span></span>
	</button>

	<button class="menu-button menu-button-title btn-menu btn-menu6 bg-dark" onclick="loadByHash('#news.index.type.pixels?isNewsDesign=1')">
			<i class="fa fa-bullhorn"></i>
			<span class="lbl-btn-menu-name">Bugs, idées</span></span>
	</button>

	<?php if(isset($me)) if(Role::isDeveloper($me['roles'])){?>
    <button class="menu-button menu-button-title btn-menu btn-menu7 bg-dark <?php echo ($page == 'admin') ? 'selected':'';?>" onclick="loadByHash('#admin.index?isNotSV=1')" >
			<i class="fa fa-cog"></i>
			<span class="lbl-btn-menu-name"><?php echo Yii::t("common", "ADMIN"); ?></span>
	</button>
	<?php } ?>
	
	<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
			<i class="fa fa-plus-circle"></i>
			<span class="lbl-btn-menu-name">Ajouter</span></span>
	</button>

	
	<!-- <a  href="javascript:;" onclick="loadByHash('#news.index.type.pixels?isNotSV=1')"
        class="menuIcon btn-main-menu hoverRed no-floop-item">
        <i class="fa fa-bullhorn fa-2x"></i><span class="menuline hide homestead " style="color:inherit !important;"> <?php echo Yii::t("common","HELP US : BUGS, IDEAS"); ?></span>
    </a>

    <?php if(isset($me)) if(Role::isDeveloper($me['roles'])){?>
    <a  href="javascript:;" onclick="loadByHash('#admin.index?isNotSV=1')" 
        class="menuIcon btn-main-menu hoverRed no-floop-item">
        <i class="fa fa-cog fa-2x text-red"></i><span class="menuline hide homestead " style="color:inherit !important;"> <?php echo Yii::t("common", "ADMIN"); ?></span>
    </a>
    <?php } ?> -->
	
</div>



<?php if(isset($me)) if(isset(Yii::app()->session['userId'])){ ?>
<button class="menu-button btn-menu btn-menu5 tooltips " 
		data-toggle="tooltip" data-placement="left" title="Mon répertoire" alt="Mon répertoire">
	<i class="fa fa-bookmark fa-rotate-270"></i>
</button>
<?php } ?>


<!-- <button class="menu-button btn-menu btn-menu6 tooltips <?php echo ($page == 'agenda') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="left" title="Ma messagerie" alt="Ma messagerie">
	<i class="fa fa-envelope"></i>
</button> -->


<script type="text/javascript">
jQuery(document).ready(function() {
	
	$('.btn-menu0').click( function(e){ loadByHash("#search.home")} ).mouseenter(function(e){ toggle(".explainHome",".explain")});
    $('.btn-menu2').click(function(e){ loadByHash("#search.directory");  }).mouseenter(function(e){ toggle(".explainDirectory",".explain")});
    $('.btn-menu3').click(function(e){ loadByHash("#search.agenda"); 		 }).mouseenter(function(e){ toggle(".explainAgenda",".explain")});
   	$('.btn-menu4').click(function(e){ loadByHash("#search.news");	 }).mouseenter(function(e){ toggle(".explainNews",".explain")} );
    $('.btn-menu5').click(function(e){ showFloopDrawer(true);	 		 }).mouseenter(function(e){ toggle(".explainMyDirectory",".explain")});
    $('.btn-menu6').mouseenter(function(e){ toggle(".explainHelpUs",".explain")});
    
    $(".btn-login").click(function(){
		console.log("btn-login");
		showPanel("box-login");
		$(".main-col-search").html("");
	}).mouseenter(function(e){ toggle(".explainConnect",".explain");});

    $(".btn-register").click(function(){
    	console.log("btn-register");
		showPanel("box-register");
		$(".main-col-search").html("");
	}).mouseenter(function(e){ toggle(".explainRegister",".explain");});

	$(".btn-logout").click(function(){
    	console.log("btn-logout");
		window.location.href = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";
	});

	var positionMouseMenu = "out";
	$(".hover-menu").mouseenter(function(){
		//console.log("enter all");
		positionMouseMenu = "in";
		$(".main-col-search").animate({ opacity:0.3 }, 400 );
		$(".lbl-btn-menu-name").show(200);
		setTimeout(function(){$(".lbl-btn-menu-name").css("display", "inline");}, 200);
		$(".menu-button-title").addClass("large");
	});

	$(".hover-menu").mouseout(function(){
		//console.log("out all");
		//permet de savoir si l'utilisateur est en train de se logguer ou de s'inscrire
		console.log(isLoginRegister());
	    if(positionMouseMenu != "inBtn" && !isLoginRegister()){
			$(".main-col-search").animate({ opacity:1 }, 0 );
			$(".lbl-btn-menu-name, .hover-info").hide();
			$(".menu-button-title").removeClass("large");
		}else{
			positionMouseMenu = "in";
			$(".hover-info").hide();
		}
	});

	$(".hover-menu .btn-menu").mouseenter(function(){
		//console.log("enter btn");
		positionMouseMenu = "inBtn";
		$(".main-col-search").animate({ opacity:0.3 }, 0 );
		$(".lbl-btn-menu-name, .hover-info").css("display", "inline");
		$(".menu-button-title").addClass("large");
	});

	$(".main-col-search").mouseenter(function(){
		console.log("login display", !isLoginRegister());
		//permet de savoir si l'utilisateur est en train de se logguer ou de s'inscrire
	    var login_register = isLoginRegister();
	    
	    console.log(isLoginRegister());
	    if(!isLoginRegister()){
			positionMouseMenu = "out";
			$(".main-col-search").animate({ opacity:1 }, 0 );
			$(".lbl-btn-menu-name").hide();
			$(".menu-button").removeClass("large");
		}
	});

	function isLoginRegister(){
		if($(".box-login").length <= 0) return false;
		return ($(".box-login").css("display") != "none" || $(".box-register").css("display") != "none");
	}


});
</script>