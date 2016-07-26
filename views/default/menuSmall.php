<?php 
	$inseeCommunexion 	 = isset( $me['address']['codeInsee'] ) ? 
	   			    			  $me['address']['codeInsee'] : "";

	$cpCommunexion 		 = isset( $me['address']['postalCode'] ) ? 
	   			    			  $me['address']['postalCode'] : "";

	$myCity = City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);
?>

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
	margin-bottom: 5px;
	font-size: 17px;
	border:2px solid transparent;
	width: 100%;
}
.menuSmallMenu a:hover{
	border:2px solid white;
}
.menuSmallMenu a.btn i{
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
    max-width: 100%;
    /*width: 60px;*/
}

@media screen and (max-width: 1024px) {

	.menuSmallMenu a, .lbl-btn-menu-name-add{
		font-size: 12px;
	}
}
@media screen and (max-width: 767px) {
	.menuSmallBlockUI{
		width: 100% !important;
		left: 0% !important;	
	}
	.menuSmallMenu a.btn i{
		font-size: 1.2em;
	}
}
</style>

<div class="hide menuSmall">
	<div class="menuSmallMenu">

		<?php if(!isset(Yii::app()->session['userId'])){ ?>
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a class="btn bg-red" href="javascript:;" onclick="showPanel('box-login');$.unblockUI();"><i class="fa fa-sign-in"></i></a>
			</br>Se Connecter
		</div> 
		<div class="col-md-6 col-sm-6 col-xs-6">
			<a class="btn bg-green" href="javascript:;" onclick="showPanel('box-register');$.unblockUI();"><i class="fa fa-plus-circle"></i></a>
			</br>S'inscrire
		</div> 
		<?php }  else { ?>
		<div class="col-md-4 col-sm-4 col-xs-4 center no-padding">
			<a class="no-border" href="javascript:" onclick="loadByHash('#person.detail.id.<?php echo Yii::app()->session['userId']?>');">
				<img class="img-responsive thumbnail" id="menu-small-thumb-profil" style="margin-left: -5px; margin-top: 3px; " 
					src="<?php echo $profilThumbImageUrl; ?>" alt="image"> 
				<span class="text-white label text-bold" style="font-size:18px;"><?php echo $me["name"]; ?></span>
			</a>
			<br><br>
			<a class="btn bg-white" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
	            data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
		        <i class="fa fa-bell"></i> 
		        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn" 
	        		  style="position:relative; top:-2px; left:unset;">
	        		<?php count($this->notifications); ?>
		        </span>
		        <br/>Notifications
		    </a>
		    <a class="btn bg-white" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
	            data-toggle="tooltip" data-placement="left" title="Mon journal" alt="Mon journal">
		        <i class="fa fa-newspaper-o"></i> 
		        <br/>Mon journal
		    </a>
		    <hr class="hidden-xs" style="border-top: 1px solid #575656;">
			<a class="btn bg-white hidden-xs" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
	            data-toggle="tooltip" data-placement="left" title="Mon journal" alt="Mon journal">
		        <i class="fa fa-bullhorn"></i> 
		        <br/>Signaler un bug
		    </a>
		    <a class="btn bg-white visible-xs" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
	            data-toggle="tooltip" data-placement="left" title="Mon journal" alt="Mon journal">
		        <i class="fa fa-bullhorn"></i> 
		        <br/>Signaler <br/>un bug
		    </a>
		</div>
		<?php } ?>	
		

	  	<div class="col-md-8 col-sm-8 col-xs-8 no-padding">

			<div class="col-md-12 col-sm-12">
			    
				<?php if(!@$me["address"]["codeInsee"]){?>
					<div class="col-md-12 center">
						<a class="btn bg-red" href="javascript:$('.btn-geoloc-auto').trigger('click');$.unblockUI();">
							<i class="fa fa-university"></i>
							</br>Communectez-moi
						</a>
					</div> 
				<?php } else { ?>
					<div class="col-md-6 col-sm-6 center">
						<a class="btn bg-red" href="javascript:loadByHash('#rooms.index.type.cities.id.<?php echo City::getUnikey($myCity); ?>'')" 
							id="btn-menu-dropdown-my-city">
							<i class="fa fa-university"></i> <br class="hidden-xs">Ma commune
						</a>
					</div>
					<div class="col-md-6 col-sm-6 center">
						<a class="btn bg-red" href="javascript:loadByHash('#rooms.index.type.cities.id.<?php echo City::getUnikey($myCity); ?>'')" 
							id="btn-menu-dropdown-my-city">
							<i class="fa fa-connectdevelop"></i><br class="hidden-xs"><span class="hidden-xs">Mon </span>Conseil citoyen
						</a>
					</div>
				<?php } ?>
					
			</div>

		    <div class="col-md-12 col-sm-12 padding-15">
				<div class="col-md-4 col-sm-4 center">
			    	<a class="btn bg-azure" href="loadByHash('#default.directory')" >
			    	<i class="fa fa-search"></i> <br class="hidden-xs">Rechercher</a>
			    </div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure" href="loadByHash('#default.agenda')" >
					<i class="fa fa-calendar"></i> <br class="hidden-xs">Agenda</a>
				</div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure" href="loadByHash('#default.news')" >
					<i class="fa fa-rss"></i> <br class="hidden-xs">Actualités</a>
				</div>
			</div>

			<div class="col-md-12 col-sm-12 hidden-xs center" id="">
	  			<hr style="border-top: 1px solid #575656;">
				<h1 class="homestead text-white">
					<i class="fa fa-plus-circle"></i> Ajouter<br>
					<i class="fa fa-angle-down"></i> 
				</h1>
				<div class="col-md-6 col-sm-6 center">
					<a href="javascript:" class="btn bg-yellow" onclick="loadByHash('#person.invite');">
						<i class="fa fa-user"></i><br>
						<span class="lbl-btn-menu-name-add">quelqu'un</span>
					</a>
					<a href="javascript:" class="btn bg-green" onclick="loadByHash('#organization.addorganizationform');">
						<i class="fa fa-group"></i><br>
						<span class="lbl-btn-menu-name-add">une organisation</span>
					</a>
				</div>
				<div class="col-md-6 col-sm-6 center">
					<a href="javascript:" class="btn bg-purple" onclick="loadByHash('#project.projectsv');">
						<i class="fa fa-lightbulb-o"></i><br>
						<span class="lbl-btn-menu-name-add">un projet</span>
					</a>
					<a href="javascript:" class="btn bg-orange" onclick="loadByHash('#event.eventsv');">
						<i class="fa fa-calendar"></i><br>
						<span class="lbl-btn-menu-name-add">un événement</span>
					</a>
				</div>
			</div>

		</div>

		<div class="col-xs-12 visible-xs no-padding center">
	  			<hr style="border-top: 1px solid #575656;">
				<div class="col-xs-3 center padding-5">
					<a href="javascript:" class="btn bg-yellow" onclick="loadByHash('#person.invite');">
						<i class="fa fa-plus-circle"></i><i class="fa fa-user"></i>
					</a>
				</div>
				<div class="col-xs-3 center padding-5">
					<a href="javascript:" class="btn bg-green" onclick="loadByHash('#organization.addorganizationform');">
						<i class="fa fa-plus-circle"></i><i class="fa fa-group"></i>
					</a>
				</div>
				<div class="col-xs-3 center padding-5">
					<a href="javascript:" class="btn bg-purple" onclick="loadByHash('#project.projectsv');">
						<i class="fa fa-plus-circle"></i><i class="fa fa-lightbulb-o"></i>
					</a>
				</div>
				<div class="col-xs-3 center padding-5">
					<a href="javascript:" class="btn bg-orange" onclick="loadByHash('#event.eventsv');">
						<i class="fa fa-plus-circle"></i><i class="fa fa-calendar"></i>
					</a>
				</div>
			</div>
		

	</div>

<!-- ------------------------------------------------------ -->

	<div class="menuSmallMenu hidden">
		
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
				<img class="img-circle" id="menu-small-thumb-profil" style="margin-left: -5px; margin-top: 3px; " width="40" height="40" src="<?php echo $profilThumbImageUrl; ?>" alt="image"> 
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
			<div class="item"><a class="btn bg-white" href="javascript:;" onclick="loadByHash('#city.detail.insee.<?php echo $me["address"]["codeInsee"]?>.postalCode.<?php echo $me["address"]["postalCode"]?>');" id="btn-menu-dropdown-my-city"><i class="fa fa-university text-red"></i> </a><br/>Ma commune</div>
		<?php } ?>

	  	<div class="item"><a class="btn bg-azure" href="javascript:;" onclick="$('.btn-menu2').trigger('click');$.unblockUI();" ><i class="fa fa-connectdevelop"></i> </a><br/>L'Annuaire</div>
		<div class="item"><a class="btn bg-azure" href="javascript:;" onclick="$('.btn-menu3').trigger('click');$.unblockUI();" ><i class="fa fa-calendar"></i> </a><br/>L'Agenda </div>
		<div class="item"><a class="btn bg-azure" href="javascript:;" onclick="$('.btn-menu4').trigger('click');$.unblockUI();" ><i class="fa fa-rss"></i> </a><br/>L'Actualité </div>
	  	<div class="item" id="btn-small-home" ><a class="btn bg-white" href="javascript:;" onclick="$('.btn-menu0').trigger('click');$.unblockUI();" ><i class="fa fa-home text-red"></i> </a><br/>Accueil</div>
	  	<div class="item"><a class="btn bg-white" href="javascript:;" onclick="$('.btn-menu6').trigger('click');$.unblockUI();" ><i class="fa fa-bullhorn text-red"></i> </a><br/>Bugs, idées</div>
	  	
	  	<?php if(isset(Yii::app()->session['userId'])){ ?>
			<div><a href="javascript:;" onclick="loadByHash('#rooms.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>');" id="btn-menu-dropdown-add"><i class="fa fa-eye text-dark"></i> <i class="fa fa-thumbs-up text-dark"></i></a></div>
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