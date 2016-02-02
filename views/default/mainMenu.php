<div class="center text-white pull-left menuContainer" >
<?php if( isset( Yii::app()->session['userId']) )
    {
      $me = Person::getById(Yii::app()->session['userId']);
      if(isset($me['profilImageUrl']) && $me['profilImageUrl'] != "")
        $urlPhotoProfil = Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$me['profilImageUrl']);
      else
        $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
    ?>

    <a href="javascript:;" onclick="loadByHash( '#person.detail.id.<?php echo Yii::app()->session['userId']?>')" class="menuIcon no-floop-item" style="padding: 2px 15px;"><span class="menu-count badge badge-danger animated bounceIn" style="position:absolute;left:8px;"></span>
      <img class="img-circle" id="menu-thumb-profil" width="40" height="40" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
      <span  class="menuline hide homestead" style="padding-top:7px;"> <?php echo Yii::t("common", 'MY DETAIL'); ?></span>
    </a>


    <?php if(Role::isDeveloper($me['roles'])){?>
    <a  href="#person.invitecontact" onclick="loadByHash('#person.invitecontact.id.<?php echo Yii::app()->session['userId']?>')" 
        class="menuIcon btn-main-menu hoverRed no-floop-item">
        <i class="fa fa-cog fa-2x text-red"></i><span class="menuline hide homestead " style="color:inherit !important;"> <?php echo Yii::t("common", "INVITECONTACT"); ?></span>
    </a>
    <?php
    }
    ?>

    <a  href="javascript:;" onclick="loadByHash( '#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>?isNotSV=1' )" 
        class=" menuIcon btn-main-menu no-floop-item">
        <i class="fa fa-rss fa-2x "></i><span class="menuline hide homestead"> <?php echo Yii::t("common", 'NEWS'); ?></span>
    </a>

    <a  href="javascript:;" 
        onclick="loadByHash( '#person.directory?isNotSV=1&tpl=directory2&type=<?php echo Person::COLLECTION ?>', '<?php echo Yii::t("common", 'MY PEOPLE'); ?>','user' )"                   
        class=" menuIcon btn-main-menu floop-item" id="btn-scroll-type-people" >
        <i class="fa fa-user fa-2x"></i><span class="menuline hide homestead"> <?php echo Yii::t("common", "MY PEOPLE"); ?>
    </a>

    <a  href="javascript:;" 
        onclick="loadByHash( '#person.directory?isNotSV=1&tpl=directory2&type=<?php echo Organization::COLLECTION ?>', '<?php echo Yii::t("common", 'MY ORGANIZATIONS'); ?>','users' )"    
        class=" menuIcon btn-main-menu floop-item" id="btn-scroll-type-organizations" >
        <i class="fa fa-users fa-2x"></i><span class="menuline hide homestead"> <?php echo Yii::t("common", "MY ORGANIZATIONS"); ?></span>
    </a>

    <a href="javascript:;" onclick="loadByHash( '#person.directory?isNotSV=1&tpl=directory2&type=<?php echo Project::COLLECTION ?>', '<?php echo Yii::t("common", 'MY PROJECTS'); ?>','calender' )"            
        class=" menuIcon btn-main-menu floop-item" id="btn-scroll-type-projects" >
        <i class="fa fa-lightbulb-o fa-2x"></i><span class="menuline hide homestead"> <?php echo Yii::t("common", "MY PROJECTS"); ?></span>
    </a>

    <a href="javascript:;" onclick="loadByHash( '#person.directory?isNotSV=1&tpl=directory2&type=<?php echo Event::COLLECTION ?>', '<?php echo Yii::t("common", 'MY EVENTS'); ?>','calender' )"               
        class=" menuIcon btn-main-menu floop-item" id="btn-scroll-type-events" >
        <i class="fa fa-calendar fa-2x"></i><span class="menuline hide homestead"> <?php echo Yii::t("common", "MY EVENTS"); ?></span>
    </a>

    <a  href="javascript:;" id="menu-city"
        onclick="loadByHash( '#city.detail.insee.<?php echo Yii::app()->session['user']['codeInsee']?>?isNotSV=1', '<?php echo Yii::t("common", 'MY CITY'); ?>','university' )" 
        class="menuIcon btn-main-menu no-floop-item" >
        <i class="fa fa-university fa-2x"></i><span class="menuline hide homestead"><?php echo Yii::t("common", "MY CITY"); ?></span>
    </a>

    <a  href="#panel.box-add" 
        onclick="loadByHash('#panel.box-add')" 
        class="menuIcon btn-main-menu no-floop-item" >
        <i class="fa fa-plus fa-2x "></i><span class="menuline hide homestead"> <?php echo Yii::t("common", "ADD SOMETHING"); ?></span>
    </a>

    <a  href="#news.index.type.pixels" onclick="loadByHash('#news.index.type.pixels?isNotSV=1')"
        class="menuIcon btn-main-menu hoverRed no-floop-item">
        <i class="fa fa-bullhorn fa-2x"></i><span class="menuline hide homestead " style="color:inherit !important;"> <?php echo Yii::t("common","HELP US : BUGS, IDEAS"); ?></span>
    </a>

    <a  href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout') ?>" 
        class="menuIcon btn-main-menu hoverRed no-floop-item">
        <i class="fa fa-sign-out fa-2x"></i><span class="menuline hide homestead " style="color:inherit !important;"> <?php echo Yii::t("common", "LOGOUT"); ?></span>
    </a> 
    
    <?php if(Role::isDeveloper($me['roles'])){?>
    <a  href="javascript:;" onclick="loadByHash('#admin.index?isNotSV=1')" 
        class="menuIcon btn-main-menu hoverRed no-floop-item">
        <i class="fa fa-cog fa-2x text-red"></i><span class="menuline hide homestead " style="color:inherit !important;"> <?php echo Yii::t("common", "ADMIN"); ?></span>
    </a>
    <?php } ?>
</div>
<div class="floopDrawer" id="floopDrawerDirectory"></div>
<?php } else {?>
    <?php /* ?><a href="#panel.box-communecter" onclick="showPanel('box-communecter',null,null,null);" class=" menuIcon btn-main-menu" ><i class="fa fa-home fa-2x"></i><span class="menuline hide homestead"> HOME</a>*/?>
    <a  href="#panel.box-whatisit" 
        onclick="showPanel('box-whatisit');" 
        class=" menuIcon btn-main-menu" >
        <i class="fa fa-question-circle fa-2x"></i><span class="menuline hide homestead"> WHAT IS IT
    </a>
    <a  href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/login') ?>" 
        class="menuIcon btn-main-menu hoverRed no-floop-item">
        <i class="fa fa-sign-in fa-2x"></i><span class="menuline hide homestead " style="color:inherit !important;"> LOGIN</span>
    </a>
</div>
<?php } ?>


