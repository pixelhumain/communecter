<?php 

	$inseeCommunexion = "";
	$cpCommunexion = "";

	if( isset( Yii::app()->session['userId']) && !empty($me) ){
		$inseeCommunexion 	 = isset( $me['address']['codeInsee'] ) ? 
		   			    			  $me['address']['codeInsee'] : "";

		$cpCommunexion 		 = isset( $me['address']['postalCode'] ) ? 
		   			    			  $me['address']['postalCode'] : "";
	}else{
		$inseeCommunexion 	 = isset( Yii::app()->request->cookies['inseeCommunexion'] ) ? 
	   			    			  Yii::app()->request->cookies['inseeCommunexion']->value : "";
	
		$cpCommunexion 		 = isset( Yii::app()->request->cookies['cpCommunexion'] ) ? 
		   			    			  Yii::app()->request->cookies['cpCommunexion']->value : "";
	}
//var_dump($cpCommunexion); return;
	if($cpCommunexion != "" && $inseeCommunexion != "")
	$myCity = City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);
?>

<!-- <div class="dropdown pull-left hidden-md hidden-lg hidden-sm " style="margin-top: 10px; margin-right: 10px;">
	<a href="javascript:openMenuSmall();" class=" application-menu text-dark" >
	  <i class="fa fa-bars fa-2x"></i>
	</a>
</div> -->
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

.fa-small i.fa{
	font-size:1em !important;
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

<?php if (isset(Yii::app()->session['userId']) && !empty($me)) {
          $profilThumbImageUrl = Person::getImgProfil($me, "profilMediumImageUrl", $this->module->assetsUrl);
      }
?>

<div class="hide menuSmall">
	<div class="menuSmallMenu">

		<?php if(!isset(Yii::app()->session['userId'])){ ?>
		<div class="col-md-3 col-sm-3 col-xs-3 center no-padding">
			<div class="col-xs-12">
				<a class="btn bg-red" href="javascript:;" onclick="showPanel('box-login');$.unblockUI();">
					<i class="fa fa-sign-in"></i>
					</br>Se Connecter
				</a>
			</div> 
			<div class="col-xs-12">
				<a class="btn bg-green" href="javascript:;" onclick="showPanel('box-register');$.unblockUI();">
					<i class="fa fa-plus-circle"></i>
					</br>S'inscrire
				</a>
			</div> 
		</div> 
		<?php }  else { ?>
		<div class="col-md-3 col-sm-3 col-xs-4 center margin-top-15">
			<div class="col-md-12 col-sm-12 no-padding">
				<a class="no-border lbh" href="#person.detail.id.<?php echo Yii::app()->session['userId']?>" >
					<img class="img-responsive thumbnail" id="menu-small-thumb-profil" 
						src="<?php echo $profilThumbImageUrl; ?>" alt="image"> 
					<span class="text-white label text-bold" style="font-size:18px;"><?php echo $me["name"]; ?></span>
				</a>
			</div>
		</div>
		<?php } ?>	
		

	  	<div class="col-md-9 col-sm-9 col-xs-8 no-padding">

	  		<?php if(isset($myCity)){?>
		    <div class="col-md-12 col-sm-12 margin-15 hidden-xs">
				<div class="col-md-4 col-sm-4 center">
			    	<a class="btn bg-azure lbh" href="#default.directory"  >
			    	<i class="fa fa-search"></i> <br class="hidden-xs">Rechercher</a>
			    </div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure lbh" href="#default.agenda" >
					<i class="fa fa-calendar"></i> <br class="hidden-xs">Agenda</a>
				</div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure lbh" href="#default.news"  >
					<i class="fa fa-rss"></i> <br class="hidden-xs">Actualités</a>
				</div>
			</div>
			<?php } ?>

			<div class="col-md-12 col-sm-12 padding-15">
			    
				<?php if(!isset($myCity)){?>
					<div class="col-md-12 center">
						<a class="btn bg-red" href="javascript:$('.btn-geoloc-auto').trigger('click');$.unblockUI();">
							<i class="fa fa-university"></i>
							</br>Communectez-moi
						</a>
					</div> 
				<?php } else { ?>
					<div class="col-md-6 col-sm-6 center">
						<a class="btn bg-red lbh" href="#rooms.index.type.cities.id.<?php echo City::getUnikey($myCity); ?>" 
							id="btn-menu-dropdown-my-city">
							<i class="fa fa-university"></i> <br class="hidden-xs">Ma commune
						</a>
					</div>
					<div class="col-md-6 col-sm-6 center">
						<a class="btn bg-red lbh" href="#rooms.index.type.cities.id.<?php echo City::getUnikey($myCity); ?>"  
							id="btn-menu-dropdown-my-city">
							<i class="fa fa-connectdevelop"></i><br class="hidden-xs"><span class="hidden-xs">Mon </span>Conseil citoyen
						</a>
					</div>
				<?php } ?>
					
			</div>

			
		</div>
		<div class="col-xs-12 no-padding">
			
			<?php if(isset($myCity)){?>
		    <div class="col-md-12 col-sm-12 padding-15 visible-xs">
				<div class="col-md-4 col-sm-4 center">
			    	<a class="btn bg-azure lbh" href="#default.directory" >
			    	<i class="fa fa-search"></i> <br class="hidden-xs">Rechercher</a>
			    </div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure lbh" href="#default.agenda" >
					<i class="fa fa-calendar"></i> <br class="hidden-xs">Agenda</a>
				</div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure lbh" href="#default.news" >
					<i class="fa fa-rss"></i> <br class="hidden-xs">Actualités</a>
				</div>
			</div>
			<?php } ?>
			<div class="col-md-12 col-sm-12 padding-10">
				<div class="col-xs-12 center padding-5">
					<a class="btn bg-dark visible-xs" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="Notifications">
				        <i class="fa fa-bell"></i> 
				        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn" 
			        		  style="position:relative; top:-2px; left:unset;">
			        		<?php count($this->notifications); ?>
				        </span>
				        <br/>Notifications
				    </a>
				</div>
			    <div class="col-md-4 col-sm-4 col-xs-4 center padding-5">
				    <a class="btn bg-dark" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="Mon journal">
				        <i class="fa fa-rss"></i> 
				        <br/>Mon journal
				    </a>
			    </div>
			    <div class="col-md-4 col-sm-4 col-xs-4 center padding-5">
				    <a class="btn bg-dark" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="L'actualité de mon réseau">
				        <i class="fa fa-rss"></i> 
				        <br/>Actu communautés
				    </a>
			    </div>
			    <div class="col-md-4 col-sm-4 col-xs-4 center padding-5">
				    <a class="btn bg-dark" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="L'actualité de mon réseau">
				        <i class="fa fa-comments"></i> <i class="fa fa-gavel"></i> <i class="fa fa-cogs"></i> 
				        <br/>Coopération
				    </a>
			    </div>
			    <div class="col-md-6 col-sm-6 col-xs-6 center padding-5">
					<a class="btn bg-dark" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="Signaler un bug">
				        <i class="fa fa-bullhorn"></i> 
				        <br/>Signaler un bug
				    </a>
			    </div>
			    <div class="col-md-6 col-sm-6 col-xs-6 center padding-5">
					<a class="btn bg-dark" href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="Documentation">
				        <i class="fa fa-file"></i> 
				        <br/>Documentation
				    </a>
			    </div>
		    </div>
		    
			<div class="col-md-12 col-sm-12 hidden center" id="">
	  			<div class="col-md-6 col-sm-6 center">
					<a href="#person.invite" class="btn bg-yellow lbh">
						<i class="fa fa-user"></i><br>
						<span class="lbl-btn-menu-name-add">quelqu'un</span>
					</a>
					<a href="#organization.addorganizationform" class="btn bg-green lbh">
						<i class="fa fa-group"></i><br>
						<span class="lbl-btn-menu-name-add">une organisation</span>
					</a>
				</div>
				<div class="col-md-6 col-sm-6 center">
					<a href="#project.projectsv" class="btn bg-purple lbh">
						<i class="fa fa-lightbulb-o"></i><br>
						<span class="lbl-btn-menu-name-add">un projet</span>
					</a>
					<a href="#event.eventsv" class="btn bg-orange lbh">
						<i class="fa fa-calendar"></i><br>
						<span class="lbl-btn-menu-name-add">un événement</span>
					</a>
				</div>
			</div>

		</div>

		<div class="col-xs-12 no-padding center fa-small">
	  			<hr style="border-top: 1px solid #575656;">
				<h1 class="homestead text-white">
					<i class="fa fa-plus-circle"></i> Ajouter<br>
					<i class="fa fa-angle-down"></i> 
				</h1>
				<div class="col-xs-6 col-sm-3 col-md-3 center padding-5">
					<a href="#person.invite" class="btn bg-yellow lbh">
						<i class="fa fa-user"></i><br>
						<span class="lbl-btn-menu-name-add">quelqu'un</span>
					</a>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3 center padding-5">
					<a href="#organization.addorganizationform" class="btn bg-green lbh">
						<i class="fa fa-group"></i><br>
						<span class="lbl-btn-menu-name-add">une organisation</span>
					</a>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3 center padding-5">
					<a href="#project.projectsv" class="btn bg-purple lbh">
						<i class="fa fa-lightbulb-o"></i><br>
						<span class="lbl-btn-menu-name-add">un projet</span>
					</a>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3 center padding-5">
					<a href="#event.eventsv" class="btn bg-orange lbh">
						<i class="fa fa-calendar"></i><br>
						<span class="lbl-btn-menu-name-add">un événement</span>
					</a>
				</div>
			</div>
		

	</div>

</div>