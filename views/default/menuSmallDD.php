<div class="dropdown pull-left hidden-md hidden-lg hidden-sm " style="margin-top: 10px; margin-right: 10px;">
	<a href="javascript:;" class="dropdown-toggle application-menu text-dark" data-toggle="dropdown">
	  <i class="fa fa-bars fa-2x"></i>
	</a>
	<ul class="dropdown-menu dropdown-menu-left">
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<li>
			<a href="#person.detail.id.<?php echo Yii::app()->session['userId']?>" class='lbh'>
				<img class="img-circle" id="menu-thumb-profil" style="margin-left: -5px; margin-top: 3px; margin-bottom: 5px;" width="27" height="27" src="<?php echo $urlPhotoProfil; ?>" alt="image"> 
				<?php echo $me["name"]; ?>
			</a>
		</li>
		<li role="separator" class="divider"></li>
	  	<li>
			<a href="javascript:" class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
	            data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
		        <i class="fa fa-bell"></i> Notifications
		        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn"  style="position:relative; top:-2px; left:unset;"><?php count($this->notifications); ?></span>
		    </a>
		</li>
		<li role="separator" class="divider"></li>
	  	<?php } ?>
	  	<li><a href="#" class='lbh' ><i class="fa fa-connectdevelop"></i> L'Annuaire communecté</a></li>
		<li><a href="#" class='lbh' ><i class="fa fa-calendar"></i> L'Agenda communecté</a></li>
		<li><a href="#" class='lbh' ><i class="fa fa-rss"></i> L'Actualité communecté</a></li>
	  	<li><a href="#news.index.type.pixels" class='lbh' ><i class="fa fa-bullhorn"></i> Bugs, idées</a></li>
	  	
	  	<?php if(isset(Yii::app()->session['userId'])){ ?>
	  	<li role="separator" class="divider"></li>
	  	<li><a class='lbh' href="#city.detail.insee.<?php echo $me["address"]["codeInsee"]?>" id="btn-menu-dropdown-my-city"><i class="fa fa-university text-dark"></i> Ma commune</a></li>
	  	<li><a class='lbh' href="#rooms.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>"><i class="fa thumbs-up text-dark"></i> Mes Votes / Discussions</a></li>

		<li role="separator" class="divider"></li>
			<?php if(isset($me)) if(Role::isDeveloper($me['roles'])){?>
			<li><a href="#admin.index" class='lbh' ><i class="fa fa-cog"></i> <?php echo Yii::t("common", "Admin"); ?></a></li>
			<?php } ?>
		<li><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" 
			   id="btn-menu-dropdown-logout" class="text-red">
			  <i class="fa fa-sign-out"></i> Déconnection
			</a>
		</li>  
		<?php } ?>
		
	</ul>
</div>