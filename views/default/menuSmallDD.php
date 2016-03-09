<div class="dropdown pull-left hidden-md hidden-lg hidden-sm " style="margin-top: 10px; margin-right: 10px;">
	<a href="javascript:;" class="dropdown-toggle application-menu text-dark" data-toggle="dropdown">
	  <i class="fa fa-bars fa-2x"></i>
	</a>
	<ul class="dropdown-menu dropdown-menu-left">
		<?php if(isset(Yii::app()->session['userId'])){ ?>
		<li>
			<a href="javascript:" onclick="loadByHash('#person.detail.id.<?php echo Yii::app()->session['userId']?>');">
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
	  	<li><a href="javascript:;" onclick="loadByHash('#')" ><i class="fa fa-connectdevelop"></i> L'Annuaire communecté</a></li>
		<li><a href="javascript:;" onclick="loadByHash('#')" ><i class="fa fa-calendar"></i> L'Agenda communecté</a></li>
		<li><a href="javascript:;" onclick="loadByHash('#')" ><i class="fa fa-rss"></i> L'Actualité communecté</a></li>
	  	<li><a href="javascript:;" onclick="loadByHash('#news.index.type.pixels?isSearchDesign=1')" ><i class="fa fa-bullhorn"></i> Bugs, idées</a></li>
	  	
	  	<?php if(isset(Yii::app()->session['userId'])){ ?>
	  	<li role="separator" class="divider"></li>
	  	<li><a href="javascript:;" onclick="loadByHash('#city.detail.insee.<?php echo $me["address"]["codeInsee"]?>');" id="btn-menu-dropdown-my-city"><i class="fa fa-university text-dark"></i> Ma commune</a></li>
		<!-- <li role="separator" class="divider"></li>
		<li><a href="javascript:;" onclick="loadByHash('#person.invitesv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-yellow"></i> <i class="fa fa-item-menu fa-user text-yellow"></i> Inviter quelqu'un</a></li>
		<li><a href="javascript:;" onclick="loadByHash('#event.eventsv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-orange"></i> <i class="fa fa-calendar text-orange"></i> Créer un événement</a></li>
		<li><a href="javascript:;" onclick="loadByHash('#project.projectsv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-purple"></i> <i class="fa fa-lightbulb-o text-purple"></i> Créer un projet</a></li>
		<li role="separator" class="divider"></li>
		<li><a href="javascript:;" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-green"></i> <i class="fa fa-users text-green"></i> Référencer mon association</a></li>
		<li><a href="javascript:;" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-azure"></i> <i class="fa fa-industry text-azure"></i> Référencer mon entreprise</a></li>
		<li><a href="javascript:;" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-dark"></i> <i class="fa fa-asterisk text-dark"></i> Référencer ...</a></li>
		 -->
		<li role="separator" class="divider"></li>
			<?php if(isset($me)) if(Role::isDeveloper($me['roles'])){?>
			<li><a href="javascript:;" onclick="loadByHash('#admin.index')" ><i class="fa fa-cog"></i> <?php echo Yii::t("common", "Admin"); ?></a></li>
			<?php } ?>
		<li><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" 
			   id="btn-menu-dropdown-logout" class="text-red">
			  <i class="fa fa-sign-out"></i> Déconnection
			</a>
		</li>  
		<?php } ?>
		
	</ul>
</div>