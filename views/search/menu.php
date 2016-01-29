
<?php if(!isset(Yii::app()->session['userId'])){ ?>
<button class="menu-button btn-login tooltips" data-toggle="tooltip" data-placement="right" title="Se connecter" alt="Se connecter">
		<i class="fa fa-sign-in"></i>
</button>
<?php }else{ ?>
<button class="menu-button btn-logout tooltips" data-toggle="tooltip" data-placement="right" title="Se déconnecter" alt="Se déconnecter">
		<i class="fa fa-sign-out"></i>
</button>
<?php } ?>

<button class="menu-button btn-menu btn-menu0 bg-red tooltips" 
		data-toggle="tooltip" data-placement="right" title="Accueil" alt="Accueil">
		<i class="fa fa-home"></i>
</button>
<?php if(!isset(Yii::app()->session['userId'])){ ?>
<button class="menu-button btn-register btn-menu btn-menu1 tooltips <?php echo ($page == 'add') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="right" title="S'inscrire" alt="Localisation automatique">
		<i class="fa fa-plus-circle"></i>
</button>
<?php } ?>
<button class="menu-button btn-menu btn-menu2 bg-azure tooltips <?php echo ($page == 'directory') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="right" title="L'Annuaire Communecté" alt="Localisation automatique">
		<i class="fa fa-connectdevelop"></i>
</button>

<button class="menu-button btn-menu btn-menu3 bg-azure tooltips <?php echo ($page == 'news') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="right" title="L'Actu Communectée" alt="Localisation automatique">
		<i class="fa fa-rss"></i>
</button>

<button class="menu-button btn-menu btn-menu4 bg-azure tooltips <?php echo ($page == 'agenda') ? 'selected':'';?>" 
		data-toggle="tooltip" data-placement="right" title="L'Agenda Communecté" alt="Localisation automatique">
	<i class="fa fa-calendar"></i>
</button>


<script type="text/javascript">
jQuery(document).ready(function() {
	
	$('.btn-menu0').click(function(e){ loadByHash("#search.home");  	 });
    $('.btn-menu2').click(function(e){ loadByHash("#search.directory");  });
    $('.btn-menu3').click(function(e){ loadByHash("#search.news"); 		 });
   	$('.btn-menu4').click(function(e){ loadByHash("#search.agenda");	 });
    
    $(".btn-login").click(function(){
		showPanel("box-login");
	});
    $(".btn-register").click(function(){
		showPanel("box-register");
	});


});
</script>