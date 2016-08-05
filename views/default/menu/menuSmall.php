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

	if($cpCommunexion != "" && $inseeCommunexion != "")
	$myCity = City::getCityByInseeCp($inseeCommunexion, $cpCommunexion);
?>


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
.bg-dark-red {
    color: white !important;
    background-color: #653C3C !important;
}

@media screen and (max-width: 1024px) {

	.menuSmallMenu a, .lbl-btn-menu-name-add{
		font-size: 14px;
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
          $profilThumbImageUrl = Element::getImgProfil($me, "profilMediumImageUrl", $this->module->assetsUrl);
      }
?>

<div class="hide menuSmall">
	<div class="menuSmallMenu">

		<?php if(!isset(Yii::app()->session['userId'])){ ?>
		<div class="col-md-3 col-sm-3 col-xs-12 center no-padding margin-bottom-15">
			<div class="col-md-12 col-sm-12 col-xs-6">
				<a class="btn bg-red" href="javascript:;" onclick="showPanel('box-login');$.unblockUI();">
					<i class="fa fa-sign-in"></i>
					</br>Se Connecter
				</a>
			</div> 
			<div class="col-md-12 col-sm-12 col-xs-6">
				<a class="btn bg-green" href="javascript:;" onclick="showPanel('box-register');$.unblockUI();">
					<i class="fa fa-plus-circle"></i>
					</br>S'inscrire
				</a>
			</div> 
		</div> 
		<?php }  else { ?>
		<div class="col-md-3 col-sm-3 col-xs-12 center margin-top-15">
			<div class="col-md-12 col-sm-12 no-padding">
				<a class="no-border" href="javascript:" onclick="loadByHash('#person.detail.id.<?php echo Yii::app()->session['userId']?>');">
					<img class="img-responsive thumbnail" id="menu-small-thumb-profil" 
						src="<?php echo $profilThumbImageUrl; ?>" alt="image"> 
					<span class="text-white label text-bold" style="font-size:18px;"><?php echo $me["name"]; ?></span>
				</a>
			</div>


		    <?php if(isset($me)) if(Role::isSuperAdmin($me['roles'])){?>
			<div class="col-md-12 col-sm-12 col-xs-6 center padding-5">
			    <a class="btn bg-dark-red" 
			    	href="javascript:loadByHash('#admin.index')">
			        <i class="fa fa-user-secret" style="font-size: 1em!important;"></i> 
			        Admin
			    </a>
		    </div>
			<?php } ?>	
			<div class="col-md-12 col-sm-12 col-xs-6 center padding-5">
				<a class="btn bg-dark visible-xs" href="javascript:$('.btn-menu-notif').trigger('click');$.unblockUI();">
			        <i class="fa fa-bell" style="font-size: 1em!important;"></i> 
			        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn" 
		        		  style="position:relative; top:-2px; left:unset;">
		        		<?php count($this->notifications); ?>
			        </span>
			        Notifications
			    </a>
			</div>
		    <div class="col-md-12 col-sm-12 col-xs-6 center padding-5">
			    <a class="btn bg-dark" href="javascript:loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>.viewer.<?php echo Yii::app()->session['userId']?>')">
			        <i class="fa fa-newspaper-o" style="font-size: 1em!important;"></i> 
			        Mon journal
			    </a>
		    </div>
		     <div class="col-md-12 col-sm-12 col-xs-6 center padding-5">
			    <a class="btn bg-dark" href="javascript:loadByHash('#person.directory.id.<?php echo Yii::app()->session['userId'] ?>?tpl=directory2')">
			        <i class="fa fa-group" style="font-size: 1em!important;"></i> 
			        Mon répertoire
			    </a>
		    </div>
		    <div class="col-md-12 col-sm-12 col-xs-6 center padding-5">
			    <a class="btn bg-dark" href="javascript:loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>')">
			        <i class="fa fa-rss" style="font-size: 1em!important;"></i> 
			        Actus réseau
			    </a>
		    </div>
		    <div class="col-md-12 col-sm-12 col-xs-6 center padding-5">
			    <a class="btn bg-dark" 
			    	href="javascript:loadByHash('#rooms.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>')">
			        <i class="fa fa-comments" style="font-size: 1em!important;"></i> 
			        <i class="fa fa-gavel" style="font-size: 1em!important;"></i> 
			        <i class="fa fa-cogs" style="font-size: 1em!important;"></i> 
			        <br>Coopération
			    </a>
		    </div>
			   
		</div>
		<?php } ?>	
		

	  	<div class="col-md-9 col-sm-9 col-xs-12 no-padding">

	  		<div class="col-md-12 col-sm-12 margin-15 visible-communected">
				<div class="col-md-4 col-sm-4 center">
			    	<a class="btn bg-azure" href="javascript:loadByHash('#default.directory')" >
			    	<i class="fa fa-search"></i> <br class="hidden-xs">Rechercher</a>
			    </div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure" href="javascript:loadByHash('#default.agenda')" >
					<i class="fa fa-calendar"></i> <br class="hidden-xs">Agenda</a>
				</div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure" href="javascript:loadByHash('#default.news')" >
					<i class="fa fa-rss"></i> <br class="hidden-xs">Actualités</a>
				</div>
			</div>
			

			<div class="col-md-12 col-sm-12 padding-15">
			    
				<?php if(!isset($myCity)){?>
					<div class="col-md-12 center hide-communected">
						<a class="btn bg-red" href="javascript:$('.btn-geoloc-auto').trigger('click');$.unblockUI();">
							<i class="fa fa-university"></i>
							</br>Communectez-moi
						</a>
					</div> 
				<?php } ?>

				<div class="col-md-6 col-sm-6 col-xs-12 center visible-communected">
					<a class="btn bg-red" 
						href="javascript:loadByHash('#city.detail.insee.<?php 
							 if(@$myCity) echo $myCity["insee"]; ?>.postalCode.<?php  if(@$myCity) echo $myCity["cp"]; 
							?>')" 
						id="btn-menuSmall-mycity">
						<i class="fa fa-university"></i> <br class="hidden-xs">Ma commune
					</a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 center visible-communected">
					<a class="btn bg-red" 
						href="javascript:loadByHash('#rooms.index.type.cities.id.<?php if(@$myCity) echo City::getUnikey($myCity); ?>')" 
						id="btn-menuSmall-citizenCouncil">
						<i class="fa fa-connectdevelop"></i><br class="hidden-xs">
						<span class="hidden-xs">Mon c</span><span class="hidden-sm hidden-md hidden-lg">C</span>onseil citoyen
					</a>
				</div>
				
				<?php if(isset(Yii::app()->session['userId'])){ ?>
					<div class="col-md-12 col-sm-12  col-xs-12 no-padding">
						<hr style="border-top: 1px solid transparent; margin:7px;">
						<h2 class="homestead text-white">
							<i class="fa fa-plus-circle"></i> Ajouter 
							<i class="fa fa-angle-down"></i> 
						</h2>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
						<a href="javascript:loadByHash('#person.invite');" class="btn bg-yellow">
							<i class="fa fa-user"></i><br>
							<span class="lbl-btn-menu-name-add">Quelqu'un</span>
						</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
						<a href="javascript:loadByHash('#organization.addorganizationform');" class="btn bg-green">
							<i class="fa fa-group"></i><br>
							<span class="lbl-btn-menu-name-add">
								<span class="hidden-xs">Une o</span><span class="hidden-sm hidden-md hidden-lg">O</span>rganisation
							</span>
						</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
						<a href="javascript:loadByHash('#project.projectsv');" class="btn bg-purple">
							<i class="fa fa-lightbulb-o"></i><br>
							<span class="lbl-btn-menu-name-add">
								<span class="hidden-xs">Un p</span><span class="hidden-sm hidden-md hidden-lg">P</span>rojet
							</span>
						</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
						<a href="javascript:loadByHash('#event.eventsv');" class="btn bg-orange">
							<i class="fa fa-calendar"></i><br>
							<span class="lbl-btn-menu-name-add">
								<span class="hidden-xs">Un é</span><span class="hidden-sm hidden-md hidden-lg">É</span>vénement
							</span>
						</a>
					</div>
				<?php } ?>

				<div class="col-md-12 col-sm-12 col-xs-12  no-padding">
					<hr style="border-top: 1px solid transparent; margin:7px;">
					<h2 class="homestead text-white">
						Comprendre<?php if(isset(Yii::app()->session['userId'])) echo " et aider"; ?>
						<i class="fa fa-angle-down"></i> 
					</h2>
				</div>
				<?php if(isset(Yii::app()->session['userId'])) $colDoc="6";// else $colDoc="12"; ?>
				<div class="col-xs-<?php echo $colDoc;?> col-sm-<?php echo $colDoc;?> col-md-<?php echo $colDoc;?> center padding-5">
					<a class="btn bg-grey" href="javascript:loadByHash('#default.view.page.index.dir.docs')" 
						class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="Documentation">
				        <i class="fa fa-file"></i> 
				        <br/>Documentation
				    </a>
			    </div>
			   <?php //if(isset(Yii::app()->session['userId'])){ ?>
			    <div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
					<a class="btn bg-grey" href="javascript:loadByHash('#news.index.type.pixels')" 
						class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
			            data-toggle="tooltip" data-placement="left" title="Signaler un bug">
				        <i class="fa fa-bullhorn"></i> 
				        <br/>Signaler un bug
				    </a>
			    </div>
			    <?php //} ?>

			    
			</div>
			
	   	</div>
	</div>
</div>