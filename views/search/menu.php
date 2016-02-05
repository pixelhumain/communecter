
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
	
	.drop-up-btn-add{
		display:none;
		position: fixed;
		bottom: 75px;
		right: 25px;
		height: 200px;
		background-color: transparente;
		width: 300px;
		z-index:10;
	}
	.drop-up-btn-add button{
		padding-right:6px;
	}	
	.btn-menu-add1{
		position:absolute !important;
		top:0px;
		right:15px;
	}
	.btn-menu-add2{
		position:absolute !important;
		top:50px;
		right:15px;
	}
	.btn-menu-add3{
		position:absolute !important;
		top:100px;
		right:15px;
	}
	.btn-menu-add4{
		position:absolute !important;
		top:150px;
		right:15px;
	}

</style>

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
			<span class="lbl-btn-menu-name">L'Annuaire <span class="text-dark" style="font-size:12px;">communecté</span>
	</button>

	<button class="menu-button menu-button-title btn-menu btn-menu3 bg-azure <?php echo ($page == 'agenda') ? 'selected':'';?>">
		<i class="fa fa-calendar"></i>
			<span class="lbl-btn-menu-name">L'Agenda <span class="text-dark" style="font-size:12px;">communecté</span>
	</button>

	<button class="menu-button menu-button-title btn-menu btn-menu4 bg-azure <?php echo ($page == 'news') ? 'selected':'';?>" 
			data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="L'Actu Communectée">
			<i class="fa fa-rss"></i>
			<span class="lbl-btn-menu-name">L'Actualité <span class="text-dark" style="font-size:12px;">communectée</span>
	</button>

	<button class="menu-button menu-button-title btn-menu btn-menu5 bg-dark">
			<span class="lbl-btn-menu-name">Mon répertoire</span>
			<i class="fa fa-bookmark fa-rotate-270"></i>
			
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

</div>


<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
		<span class="lbl-btn-menu-name">Ajouter</span></span>
		<i class="fa fa-plus-circle"></i>
</button>

<div class="drop-up-btn-add">
	<button class="menu-button menu-button-title btn-menu btn-menu-add1 bg-green" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-group"></i>
		<span class="lbl-btn-menu-name">une organisation</span></span>
	</button>
	<button class="menu-button menu-button-title btn-menu btn-menu-add2 bg-purple" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-lightbulb-o"></i>
		<span class="lbl-btn-menu-name">un projet</span></span>
	</button>
	<button class="menu-button menu-button-title btn-menu btn-menu-add3 bg-orange" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-calendar"></i>
		<span class="lbl-btn-menu-name">un événement</span></span>
	</button>
	<button class="menu-button menu-button-title btn-menu btn-menu-add4 bg-yellow" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-user"></i>
		<span class="lbl-btn-menu-name">inviter quelqu'un</span></span>
	</button>
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
	
	$('.btn-menu0').click(function(e){ loadByHash("#search.home");  	 });
    $('.btn-menu2').click(function(e){ loadByHash("#search.directory");  });
    $('.btn-menu3').click(function(e){ loadByHash("#search.agenda"); 		 });
   	$('.btn-menu4').click(function(e){ loadByHash("#search.news");	 });
    $('.btn-menu5').click(function(e){ showFloopDrawer(true);	 		 });
    
    $(".btn-menu-add").mouseenter(function(){
    	$(".drop-up-btn-add").show(400);
    	$(".drop-up-btn-add .lbl-btn-menu-name").css("display","inline");
    	$(".btn-menu-add .lbl-btn-menu-name").css("display", "inline");
    	//$(".lbl-btn-menu-name-add").css("display", "inline");
    });

    
    $(".btn-login").click(function(){
		console.log("btn-login");
		showPanel("box-login");
		$(".main-col-search").html("");
	});
    $(".btn-register").click(function(){
    	console.log("btn-register");
		showPanel("box-register");
		$(".main-col-search").html("");
	});

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
			$(".lbl-btn-menu-name").hide();
			$(".menu-button-title").removeClass("large");
		}else{
			positionMouseMenu = "in";
		}
	});

	$(".hover-menu .btn-menu").mouseenter(function(){
		//console.log("enter btn");
		positionMouseMenu = "inBtn";
		$(".main-col-search").animate({ opacity:0.3 }, 0 );
		$(".lbl-btn-menu-name").css("display", "inline");
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
		$(".drop-up-btn-add").hide(400);
	});

	function isLoginRegister(){
		if($(".box-login").length <= 0) return false;
		return ($(".box-login").css("display") != "none" || $(".box-register").css("display") != "none");
	}


});
</script>