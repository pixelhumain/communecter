<div class="dropdown pull-left hidden-md hidden-lg hidden-sm " style="margin-top: 10px; margin-right: 10px;">
	<a href="javascript:openMenuSmall();" class=" application-menu text-dark" >
	  <i class="fa fa-bars fa-2x"></i>
	</a>
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
		
		<?php if(!isset(Yii::app()->session['userId'])){ ?>
		<div class="item">
			<a class="btn bg-red" href="javascript:;" onclick="showPanel('box-login');$.unblockUI();"><i class="fa fa-sign-in"></i></a>
			</br>Se Connecter
		</div> 
		<div class="item">
			<a class="btn bg-green" href="javascript:;" onclick="showPanel('box-register');$.unblockUI();"><i class="fa fa-plus-circle"></i></a>
			</br>S'inscrire
		</div> 
		<?php }  else { ?>
		<div class="item">
			<a class="btn bg-white" href="javascript:" onclick="loadByHash('#person.detail.id.<?php echo Yii::app()->session['userId']?>');">
				<img class="img-circle" id="menu-thumb-profil" style="margin-left: -5px; margin-top: 3px; " width="40" height="40" src="<?php echo $urlPhotoProfil; ?>" alt="image"> 
			</a>
			<br/><?php echo $me["name"]; ?>
		</div>
	  	<div class="item">
			<a class="btn bg-white" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
	            data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
		        <i class="fa fa-bell"></i> 
		        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn"  style="position:relative; top:-2px; left:unset;"><?php count($this->notifications); ?></span>
		    </a>
		    <br/>Notifications
		</div>
	  	<?php } ?>

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
			<!-- <li role="separator" class="divider"></div>
			<div><a href="javascript:;" onclick="loadByHash('#person.invitesv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-yellow"></i> <i class="fa fa-item-menu fa-user text-yellow"></i> Inviter quelqu'un</a></div>
			<div><a href="javascript:;" onclick="loadByHash('#event.eventsv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-orange"></i> <i class="fa fa-calendar text-orange"></i> Créer un événement</a></div>
			<div><a href="javascript:;" onclick="loadByHash('#project.projectsv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-purple"></i> <i class="fa fa-lightbulb-o text-purple"></i> Créer un projet</a></div>
			<li role="separator" class="divider"></div>
			<div><a href="javascript:;" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-green"></i> <i class="fa fa-users text-green"></i> Référencer mon association</a></div>
			<div><a href="javascript:;" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-azure"></i> <i class="fa fa-industry text-azure"></i> Référencer mon entreprise</a></div>
			<div><a href="javascript:;" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-dark"></i> <i class="fa fa-asterisk text-dark"></i> Référencer ...</a></div>
			 -->
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