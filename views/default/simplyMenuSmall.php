<div class="dropdown pull-left hidden-md hidden-lg hidden-sm " style="margin-top: 3px; margin-right: 10px;">
<!-- 	<div style="display: inline-block;">
		<a href="javascript:openMenuSmall();" class=" application-menu text-dark" >
		  <i class="fa fa-bars fa-2x"></i>
		</a>
	</div> -->
	<div style="display: inline-block;">
	<?php if(isset($params['skin']['iconeAdd']) && $params['skin']['iconeAdd']) { ?>
		<!--             <div class="pull-left">
		  <div class="dropdown pull-right hidden-xs"> -->
		    <button class="dropdown-toggle menu-name-profil btn-menu-global-search text-dark" data-toggle="dropdown">
		       <i class="fa fa-plus fa-2x"></i>
		    </button>
		    <ul class="dropdown-menu dropdown-menu-right">
		      <?php if(isset($params['add']['organization']) && $params['add']['organization']) { ?>
		     <li>
		      <a onclick="loadByHash('#organization.addorganizationform');">
		        <i class="fa fa-group fa-2x text-green"></i>
		        <span class="add-title">une organisation</span>
		      </a>
		    </li>
		    <?php } ?>
		    <?php if(isset($params['add']['project']) && $params['add']['project']) { ?>
		    <li>
		      <a onclick="loadByHash('#project.projectsv');">
		        <i class="fa fa-lightbulb-o fa-2x text-purple"></i>
		        <span class="add-title">un projet</span>
		      </a>
		    </li>
		    <?php } ?>
		    <?php if(isset($params['add']['event']) && $params['add']['event']) { ?>
		    <li>
		      <a onclick="loadByHash('#event.eventsv');">
		        <i class="fa fa-calendar fa-2x text-orange"></i>
		        <span class="add-title">un événement</span>
		      </a>
		    </li>
		    <?php } ?>
		    </ul>
		  <!-- </div> -->
		<?php } ?>
	</div>
	<!-- <div style="display: inline-block;">
		<form class="filters" role="recherche">
	    	<input id="searchBarText" type="text" placeholder="Que recherchez-vous ?" class="form-control">
	    </form>
	</div> 
	<div style="display: inline-block;">
	    <button class="menu-button btn-menu btn-default btn-menu-global-search text-dark btn-start-search" 
	          data-toggle="tooltip" data-placement="left" title="Rechercher quelque chose" alt="Rechercher quelque chose">
	       <i class="fa fa-search fa-2x"></i>
	    </button>
    </div>-->
</div>
<style type="text/css">
.menuSmallMenu{
width: 100%;
}
.menuSmallMenu div.item{
	width: 49%;
	height: 65px;
	text-align: center;
	display: inline-block;
	margin: 0px;
	margin-bottom: 20px;
}
.menuSmallMenu a{
	display: inline-block;
	border-radius: 26px;
	border:2px solid white;
	margin-bottom: 5px;
}
.menuSmallMenu a:hover{
	border:2px solid grey;
}
.menuSmallMenu i{
	padding: 3px;
	font-size: 2em;
}
.menuSmallBlockUI .blockMsg {
    left: 10% !important;
    top: 6% !important;
    width: 82% !important;
}
.menuSmallBlockUI img {
    height: auto;
    max-width: 70%;
    width: 60px;
}
</style>
<div class="hide menuSmall">
	<div class="menuSmallMenu">

	  	<?php if(!@$me["address"]["codeInsee"]){?>
		<div class="item">
			<a class="btn bg-red" href="javascript:;" onclick="$('.btn-geoloc-auto').trigger('click');$.unblockUI();"><i class="fa fa-university"></i></a>
			</br>Communectez
		</div> 
		<?php } else {?>
			<div class="item"><a class="btn bg-white" href="javascript:;" onclick="loadByHash('#city.detail.insee.<?php echo $me["address"]["codeInsee"]?>');" id="btn-menu-dropdown-my-city"><i class="fa fa-university text-red"></i> </a><br/>Ma commune</div>
		<?php } ?>

	  	<div class="item"><a class="btn bg-azure" href="javascript:;" onclick="$('.btn-menu2').trigger('click');$.unblockUI();" ><i class="fa fa-connectdevelop"></i> </a><br/>L'Annuaire</div>
		<div class="item"><a class="btn bg-azure" href="javascript:;" onclick="$('.btn-menu3').trigger('click');$.unblockUI();" ><i class="fa fa-calendar"></i> </a><br/>L'Agenda </div>
		<div class="item"><a class="btn bg-azure" href="javascript:;" onclick="$('.btn-menu4').trigger('click');$.unblockUI();" ><i class="fa fa-rss"></i> </a><br/>L'Actualité </div>
	  	<div class="item" id="btn-small-home" ><a class="btn bg-white" href="javascript:;" onclick="$('.btn-menu0').trigger('click');$.unblockUI();" ><i class="fa fa-home text-red"></i> </a><br/>Accueil</div>
	  	<div class="item"><a class="btn bg-white" href="javascript:;" onclick="$('.btn-menu6').trigger('click');$.unblockUI();" ><i class="fa fa-bullhorn text-red"></i> </a><br/>Bugs, idées</div>
	  	
	  	<?php if(isset(Yii::app()->session['userId'])){ ?>
			<?php if( isset($me) && Role::isDeveloper($me['roles']) ){?>
			<div class="item"><a class="btn bg-red" href="javascript:;" onclick="loadByHash('#admin.index')" ><i class="fa fa-cog"></i> </a><br/><?php echo Yii::t("common", "Admin"); ?></div>
			<?php } ?>
			<div class="item"><a class="btn bg-red" href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" 
				   id="btn-menu-dropdown-logout" class="text-red">
				  <i class="fa fa-sign-out"></i> 
				</a>
				<br/>Déconnection
			</div>  
		<?php } ?>
	</div>
</div>