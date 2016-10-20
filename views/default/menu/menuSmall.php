

<?php  
HtmlHelper::registerCssAndScriptsFiles(array('/assets/css/menus/menuSmall.css')); 

if (isset(Yii::app()->session['userId']) && !empty($me)) {
          $profilMediumImageUrl = Element::getImgProfil($me, "profilMediumImageUrl", $this->module->assetsUrl);
      }
?>

<div class="hide menuSmall">
	<div class="menuSmallMenu">

		<?php if(!isset(Yii::app()->session['userId'])){ ?>
		<div class="col-md-3 col-sm-3 col-xs-12 center no-padding margin-bottom-15">
			<div class="col-md-12 col-sm-12 col-xs-6">
				<a class="btn bg-green" href="javascript:;" onclick="showPanel('box-login');$.unblockUI();">
					<i class="fa fa-sign-in"></i>
					</br>Se Connecter
				</a>
			</div> 
			<div class="col-md-12 col-sm-12 col-xs-6">
				<a class="btn bg-grey" href="javascript:;" onclick="showPanel('box-register');$.unblockUI();">
					<i class="fa fa-plus-circle"></i>
					</br>S'inscrire
				</a>
			</div> 
		</div> 
		<?php }  else { ?>
		<div class="col-md-3 col-sm-3 col-xs-12 center margin-top-15 margin-bottom-5">
			<div class="col-md-12 col-sm-12 no-padding" id="menu-my-profil">
				<span class="text-white label text-bold" style="font-size:16px !important;"><?php echo $me["name"]; ?></span>
				<div id="img-my-profil">
					<a class="no-border lbh" href="#person.detail.id.<?php echo Yii::app()->session['userId']?>" >
						<img class="img-responsive thumbnail" id="menu-small-thumb-profil" 
						src="<?php echo $profilMediumImageUrl; ?>" alt="image">
						<span id="menu-my-profil-text">Mon profil</span>
					</a>
				</div>
			</div>


		    <?php if(isset($me)) if(Role::isSuperAdmin($me['roles'])){?>
			<div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark-red lbh" href="#admin.index">
			        <i class="fa fa-user-secret" style="font-size: 1em!important;"></i> 
			        Admin
			    </a>
		    </div>
			<?php } ?>	
			<div class="col-xs-12 center no-padding">
				<a class="btn bg-dark visible-xs padding-5" href="javascript:$('.btn-menu-notif').trigger('click');$.unblockUI();">
			        <i class="fa fa-bell" style="font-size: 1em!important;"></i> 
			        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn" 
		        		  style="position:relative; top:-2px; left:unset;">
		        		<?php count($this->notifications); ?>
			        </span>
			        Notifications
			    </a>
			</div>
		    <div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark lbh padding-5" href="#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>.viewer.<?php echo Yii::app()->session['userId']?>"  >
			        <i class="fa fa-newspaper-o" style="font-size: 1em!important;"></i> 
			        Mon journal
			    </a>
		    </div>
		    <div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark lbh padding-5" href="#person.directory.id.<?php echo Yii::app()->session['userId'] ?>?tpl=directory2">
			        <i class="fa fa-group" style="font-size: 1em!important;"></i> 
			        Mon répertoire
			    </a>
		    </div>
		    <div class="col-xs-12 center no-padding">
			    <a class="btn bg-dark lbh padding-5" 
			    	href="#rooms.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>">
			        <i class="fa fa-comments" style="font-size: 1em!important;"></i> 
			        <i class="fa fa-gavel" style="font-size: 1em!important;"></i> 
			        <i class="fa fa-cogs" style="font-size: 1em!important;"></i> 
			        <br>Coopération
			    </a>
		    </div>
		    
		    <div class="col-xs-12 center no-padding">
			    <a class="btn bg-red padding-5" 
			    	href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>">
			        <i class="fa fa-sign-out"></i>
			        <br><?php echo Yii::t("person","Sign out"); ?>
			    </a>
		    </div>
			   
		</div>
		<?php } ?>	
		

	  	<div class="col-md-9 col-sm-9 col-xs-12 no-padding">

	  		<div class="col-md-12 col-sm-12 margin-15">
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure lbh" href="#default.live"  >
					<i class="fa fa-heartbeat"></i> <br class="hidden-xs">Live</a>
				</div>
				<div class="col-md-4 col-sm-4 center">
			    	<a class="btn bg-azure lbh" href="#default.directory" >
			    	<i class="fa fa-search"></i> <br class="hidden-xs">Recherche</a>
			    </div>
				<div class="col-md-4 col-sm-4 center">
					<a class="btn bg-azure lbh" href="#default.agenda"  >
					<i class="fa fa-calendar"></i> <br class="hidden-xs">Agenda</a>
				</div>
			</div>
			

			<div class="col-md-12 col-sm-12 padding-15">
			    
				<?php if(!isset($myCity)){?>
					<div class="col-md-12 center hide-communected">
						<a class="btn bg-red" href="javascript:;" onclick="communecterUser()">
							<i class="fa fa-university"></i>
							</br>Communectez-moi
						</a>
					</div> 
				<?php } ?>

				<div class="col-md-6 col-sm-6 col-xs-12 center visible-communected">
					<a class="btn bg-red lbh" 
						href="#city.detail.insee.<?php 
							 if(@$myCity) echo $myCity["insee"]; ?>.postalCode.<?php  if(@$myCity) echo $myCity["cp"]; 
							?>" id="btn-menuSmall-mycity">
						<i class="fa fa-university"></i> <br class="hidden-xs">Ma commune
					</a>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 center visible-communected">
					<a class="btn bg-red lbh" 
						href="#rooms.index.type.cities.id.<?php if(@$myCity) echo City::getUnikey($myCity); ?>" 
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

						<a href="javascript:openForm('person')" class="btn bg-yellow">

							<i class="fa fa-user"></i><br>
							<span class="lbl-btn-menu-name-add">Quelqu'un</span>
						</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">

						<a href="javascript:openForm('organization')" class="btn bg-green">

							<i class="fa fa-group"></i><br>
							<span class="lbl-btn-menu-name-add">
								<span class="hidden-xs">Une o</span><span class="hidden-sm hidden-md hidden-lg">O</span>rganisation
							</span>
						</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">

						<a href="javascript:openForm('project')" class="btn bg-purple">

							<i class="fa fa-lightbulb-o"></i><br>
							<span class="lbl-btn-menu-name-add">
								<span class="hidden-xs">Un p</span><span class="hidden-sm hidden-md hidden-lg">P</span>rojet
							</span>
						</a>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 center padding-5">

						<a href="javascript:openForm('event')" class="btn bg-orange">

							<i class="fa fa-calendar"></i><br>
							<span class="lbl-btn-menu-name-add">
								<span class="hidden-xs">Un é</span><span class="hidden-sm hidden-md hidden-lg">É</span>vénement
							</span>
						</a>
					</div>
				<?php } ?>

				<div class="col-xs-12  no-padding">
					<hr style="border-top: 1px solid transparent; margin:7px;">
					<h2 class="homestead text-white">
						Comprendre<?php if(isset(Yii::app()->session['userId'])) echo " et aider"; ?>
						<i class="fa fa-angle-down"></i> 
					</h2>
				</div>
				<?php if(isset(Yii::app()->session['userId'])) $colDoc="6"; else $colDoc="6"; ?>
				<div class="col-xs-<?php echo $colDoc;?> col-sm-<?php echo $colDoc;?> col-md-<?php echo $colDoc;?> center padding-5">
					<a href="#default.view.page.index.dir.docs" 
						class="btn bg-grey lbh menu-button btn-menu btn-menu-notif tooltips text-white" 
			            data-toggle="tooltip" data-placement="left" title="Documentation">
				        <i class="fa fa-file"></i> 
				        <br/>Documentation
				    </a>
			    </div>
			   <?php //if(isset(Yii::app()->session['userId'])){ ?>
			    <div class="col-xs-6 col-sm-6 col-md-6 center padding-5">
					<a  href="#news.index.type.pixels" 
						class="btn bg-grey lbh menu-button btn-menu btn-menu-notif tooltips text-white" 
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
