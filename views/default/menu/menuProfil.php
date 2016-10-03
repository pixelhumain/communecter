
<?php if (isset(Yii::app()->session['userId']) && !empty($me)) {
          $profilThumbImageUrl = Element::getImgProfil($me, "profilThumbImageUrl", $this->module->assetsUrl);
      }
?>

<button class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
      data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
  <i class="fa fa-bell hidden-xs"></i>
  <span class="notifications-count topbar-badge badge badge-danger animated bounceIn"><?php count($this->notifications); ?></span>
</button>
<div class="dropdown pull-right" data-tpl="default.menu.menuProfile">

  <?php // IMAGE PROFIL // ?>
  <button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown">
    <img class="img-circle" id="menu-thumb-profil" width="34" height="34" src="<?php echo $profilThumbImageUrl; ?>" alt="image" >
    <?php //echo $me["name"]; ?>
    <span class="caret"></span>
  </button>
  

  <?php // DROPDOWN MENU PERSO // ?>
  <ul class="dropdown-menu dropdown-menu-right">
    <li>
      <a class="lbh" href="#person.detail.id.<?php echo Yii::app()->session['userId']?>" id="btn-menu-dropdown-my-profil">
        <i class="fa fa-user text-dark"></i><?php echo Yii::t("person","My space"); ?> 
        <span class="badge badge-warning"><i class="fa fa-bookmark"></i>
        <?php echo Gamification::badge( Yii::app()->session['userId'] ) ?> 
        <?php echo (isset($me["gamification"]['total'])) ? $me["gamification"]['total'] : 0; ?> pts</span> 
      </a>
    </li>
    <li>
      <a href="#city.detail.insee.<?php echo $me["address"]["codeInsee"]?>.postalCode.<?php echo $me["address"]["postalCode"]?>" 
        class="lbh" id="btn-menu-dropdown-my-city">
        <i class="fa fa-university text-dark"></i><?php echo Yii::t("person","My city"); ?>
      </a>
    </li>
    <?php if (true) { ?>
      <li class="hidden-xs">
        <a href="#rooms.index.type.citoyens.id.<?php echo Yii::app()->session['userId'] ?>" 
          class="lbh" >
          <i class="fa fa-thumbs-up text-dark"></i><?php echo Yii::t("person","My Votes / Discussions"); ?>
        </a>
      </li>

      <li role="separator" class="divider hidden-xs"></li>

      <li class="hidden-xs">
        <a href="#person.invite" class="lbh" >
          <i class="fa fa-plus-circle text-yellow"></i> <i class="fa fa-item-menu fa-user text-yellow"></i>
          <?php echo Yii::t("person","Invite someone"); ?>
        </a>
      </li>
      <li class="hidden-xs">
        <a href="#event.eventsv" class="lbh" >
          <i class="fa fa-plus-circle text-orange"></i> <i class="fa fa-calendar text-orange"></i>
          <?php echo Yii::t("person","Create an event"); ?>
        </a>
      </li>
      <li class="hidden-xs">
        <a href="#project.projectsv" class="lbh" >
        <i class="fa fa-plus-circle text-purple"></i> 
          <i class="fa fa-lightbulb-o text-purple"></i><?php echo Yii::t("person","Create a project"); ?>
        </a>
      </li>
      
      <li role="separator" class="divider hidden-xs"></li>
      <li class="hidden-xs">
        <a href="#organization.addorganizationform" class="lbh" >
          <i class="fa fa-plus-circle text-green"></i> <i class="fa fa-users text-green"></i>
          <?php echo Yii::t("person","Create an organization"); ?>
        </a>
      </li>
      <li role="separator" class="divider hidden-xs"></li>
      <li class="hidden-xs">
        <a href="#default.view.page.index.dir.docs" class="lbh" >
          <i class="fa fa-file text-dark"></i> <?php echo Yii::t("common","Documentation", null, Yii::app()->controller->module->id); ?>
        </a>
      </li>
    <?php } ?>
    <li role="separator" class="divider"></li>
    <?php
      if(Role::isSourceAdmin(Role::getRolesUserId(Yii::app()->session["userId"]))){
        $sourceAdmin = Person::getSourceAdmin(Yii::app()->session['userId']);
        foreach ($sourceAdmin as $key => $value) { ?>
            <li>
              <a href="#adminpublic.index?key=<?php echo $value ;?>" class="lbh" >
                <i class="fa fa-cog text-blue"></i> <?php echo $value ; ?>
              </a>
            </li>
        <?php } ?>
        <li role="separator" class="divider"></li>
      <?php } ?>
    <li>
      <a href="javascript:;" onclick="window.location.href='<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>'" class="text-red">
        <i class="fa fa-sign-out"></i><?php echo Yii::t("person","Sign out"); ?>
      </a>
    </li>  
  </ul>
</div>
