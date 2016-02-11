
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
	height: 100%;
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
	height: 200px;
	background-color: transparent;
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
.hover-info{
	display: none;
	margin-top: 130px;
	position: fixed;
	top: 0px;
	left: 0px;
	z-index: 1;
	overflow: visible;
	border: 0px solid #3C5665;
	border-radius:5px;
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
	bottom: 5px;
	left : 90px;
}


#btn-param-postal-code{
	left: 56px;
	bottom: 56px;
	width: 55px !important;
	height: 55px !important;
	border-radius: 50%;
}

#btn-geoloc-auto{
	left: 38px;
	bottom: 14px;
}

#input-communexion{
	display:none;
}

#autoGeoPostalCode{
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

.search-loader{
	position: absolute;
	left: 75px;
	bottom: 120px;
	width: 350px;
	font-weight: 600;
	font-size: 14px;
}

</style>
<?php 
    echo $this->renderPartial('explainPanels');
?>
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

	<?php if(isset(Yii::app()->session['userId'])){ ?>
	<button class="menu-button menu-button-title btn-menu btn-menu5 bg-dark">
			<span class="lbl-btn-menu-name">Mon répertoire</span>
			<i class="fa fa-bookmark fa-rotate-270"></i>
			
	</button>
	<?php } ?>

	<button class="menu-button menu-button-title btn-menu btn-menu6 bg-dark" onclick="loadByHash('#news.index.type.pixels?isSearchDesign=1')">
			<i class="fa fa-bullhorn"></i>
			<span class="lbl-btn-menu-name">Bugs, idées</span></span>
	</button>

	<?php if(isset($me)) if(Role::isDeveloper($me['roles'])){?>
    <button class="menu-button menu-button-title btn-menu btn-menu7 bg-dark <?php echo ($page == 'admin') ? 'selected':'';?>" onclick="loadByHash('#admin.index?isNotSV=1')" >
			<i class="fa fa-cog"></i>
			<span class="lbl-btn-menu-name"><?php echo Yii::t("common", "ADMIN"); ?></span>
	</button>
	<?php } ?>


	<button class="menu-button menu-button-title btn-menu bg-red" id="btn-param-postal-code">
		<i class="fa fa-university"></i>
	</button> 
	<div id="input-communexion">
		<span class="search-loader text-red">Communection : un code postal et c'est parti !</span>
		<input id="autoGeoPostalCode" class="input-search text-red" type="text" placeholder="un code postal ?">
	</div>
	<button class="menu-button menu-button-title btn-menu bg-dark" id="btn-geoloc-auto">
		<i class="fa fa-crosshairs"></i>
	</button>


	<div class="infoVersion">
		update <?php echo $this->versionDate ?>
	</div>
</div>


<?php if(isset(Yii::app()->session['userId'])){ ?>
<button class="menu-button menu-button-title btn-menu btn-menu-add" onclick="">
		<span class="lbl-btn-menu-name">Ajouter</span></span>
		<i class="fa fa-plus-circle"></i>
</button>

<div class="drop-up-btn-add">

	<button class="menu-button btn-menu btn-menu-add1 bg-yellow" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-user"></i>
		<span class="lbl-btn-menu-name-add">inviter quelqu'un</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add2 bg-green" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-group"></i>
		<span class="lbl-btn-menu-name-add">une organisation</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add3 bg-purple" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-lightbulb-o"></i>
		<span class="lbl-btn-menu-name-add">un projet</span></span>
	</button>
	<button class="menu-button btn-menu btn-menu-add4 bg-orange" onclick="">
		<i class="fa fa-plus-circle" style="margin-left: 6px;"></i>
		<i class="fa fa-calendar"></i>
		<span class="lbl-btn-menu-name-add">un événement</span></span>
	</button>
</div>
<?php } ?>

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
    
    $(".btn-menu-add").mouseenter(function(){
    	$(".drop-up-btn-add").show(400);
    	$(".drop-up-btn-add .lbl-btn-menu-name").css("display","inline");
    	$(".btn-menu-add .lbl-btn-menu-name").css("display", "inline");
    });
    
    $(".btn-login").click(function(){
		console.log("btn-login");
		showPanel("box-login");
		//$(".main-col-search").html("");
	}).mouseenter(function(e){ toggle(".explainConnect",".explain");});

    $(".btn-register").click(function(){
    	console.log("btn-register");
		showPanel("box-register");
		//$(".main-col-search").html("");
	}).mouseenter(function(e){ toggle(".explainRegister",".explain");});

	$(".btn-logout").click(function(){
    	console.log("btn-logout");
		window.location.href = "<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>";
	});

	$("#btn-param-postal-code").mouseenter(function(e){
		$("#autoGeoPostalCode").css("width", "0px");
		$("#autoGeoPostalCode").animate({ width:"350px" }, 200 );
		$("#input-communexion").show(400);
	});

	$('#autoGeoPostalCode').keyup(function(e){
        startSearch();
    });
    
    $("#btn-geoloc-auto").click(function(e){
		if(geolocHTML5Done == false){
			$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Géolocalisation en cours ...");		
    		initHTML5Localisation('prefillSearch');
		}
    	else{
    		$("#modal-select-scope").modal("show");
    	}
    });
	


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

		hoverPersist = false;
		clearTimeout(timeoutHover);
		timeoutHover = setTimeout(function(){
			hoverPersist = true;
		}, 1000);
	});


	$(".hover-menu .btn-menu").mouseenter(function(){
		//console.log("enter btn");
		if(!isLoginRegister()){
			positionMouseMenu = "inBtn";
			$(".main-col-search").animate({ opacity:0.3 }, 200 );
			$(".lbl-btn-menu-name, .hover-info, .infoVersion").css("display" , "inline");
			$(".menu-button-title").addClass("large");
		}
	});

	$(".main-col-search").click(function(){
		//permet de savoir si l'utilisateur est en train de se logguer ou de s'inscrire
	    if(!isLoginRegister()){
			positionMouseMenu = "out";
			$(".main-col-search").animate({ opacity:1 }, 200 );
			$(".lbl-btn-menu-name").hide();
			$(".menu-button").removeClass("large");
		}
		$(".hover-info, .infoVersion").hide();
		$(".drop-up-btn-add").hide(400);
		$("#input-communexion").hide(700);
	});

	$(".main-col-search").mouseenter(function(){
			//permet de savoir si l'utilisateur est en train de se logguer ou de s'inscrire
		    if(!hoverPersist){
				if(!isLoginRegister()){
					positionMouseMenu = "out";
					$(".main-col-search").animate({ opacity:1 }, 200 );
					$(".lbl-btn-menu-name").hide();
					$(".menu-button").removeClass("large");
				}
				$(".hover-info").hide();
				$(".drop-up-btn-add").hide(400);
				$("#input-communexion").hide(700);
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
</script>