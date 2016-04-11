<?php 
  $cssAnsScriptFilesModule = array(
    '/css/default/short_info_profil.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<?php if( isset( Yii::app()->session['userId']) )
  {
  	$me = Person::getById(Yii::app()->session['userId']);
    if(isset($me['profilImageUrl']) && $me['profilImageUrl'] != "")
      $urlPhotoProfil = Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$me['profilImageUrl']);
    else
      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
  }
?>

<div class="menu-info-profil <?php echo isset($type) ? $type : ''; ?>">
    <input type="text" class="text-dark input-global-search hidden-xs" placeholder="<?php echo Yii::t("common","Search") ?> ..."/>
    <div class="dropdown-result-global-search"></div>
    
    <div class="topMenuButtons pull-right">
    <?php if( isset( Yii::app()->session['userId']) ){ ?>
      <div class="dropdown pull-right hidden-xs">
        <button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown">
          <img class="img-circle" id="menu-thumb-profil" width="34" height="34" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
          <?php //echo $me["name"]; ?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="javascript:;" onclick="loadByHash('#person.detail.id.<?php echo Yii::app()->session['userId']?>');"            id="btn-menu-dropdown-my-profil"><i class="fa fa-user text-dark"></i> Mon profil <span class="badge badge-warning"><i class="fa fa-bookmark"></i>  <?php echo Gamification::badge( Yii::app()->session['userId'] ) ?></span> </a></li>
          <li><a href="javascript:;" onclick="loadByHash('#person.directory.id.<?php echo Yii::app()->session['userId']?>?tpl=directory2');"         id="btn-menu-dropdown-my-directory"><i class="fa fa-bookmark fa-rotate-270 text-dark"></i> Mon répertoire</a></li>
          <li><a href="javascript:;" onclick="loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>?isSearchDesign=1');"         id="btn-menu-dropdown-my-news"><i class="fa fa-rss text-dark"></i> Mon fil d'actualité</a></li>
          <!-- <li><a href="javascript:" onclick="loadByHash('#news.index.type.citoyens.id.<?php echo Yii::app()->session['userId']?>');" id="btn-menu-dropdown-my-news"><i class="fa fa-rss text-dark"></i> Mon fil d'actualité</a></li> -->
          <li><a href="javascript:;" onclick="loadByHash('#city.detail.insee.<?php echo $me["address"]["codeInsee"]?>');"             id="btn-menu-dropdown-my-city"><i class="fa fa-university text-dark"></i> Ma commune</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="javascript:;" onclick="loadByHash('#person.invite');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-yellow"></i> <i class="fa fa-item-menu fa-user text-yellow"></i> Inviter quelqu'un</a></li>
          <li><a href="javascript:;" onclick="loadByHash('#event.eventsv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-orange"></i> <i class="fa fa-calendar text-orange"></i> Créer un événement</a></li>
          <li><a href="javascript:;" onclick="loadByHash('#project.projectsv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-purple"></i> <i class="fa fa-lightbulb-o text-purple"></i> Créer un projet</a></li>
          <li role="separator" class="divider"></li>
          <li><a href="javascript:;" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-green"></i> <i class="fa fa-users text-green"></i> Référencer une organisation</a></li>
          <li role="separator" class="divider"></li>
          <?php
            if(Role::isSourceAdmin(Role::getRolesUserId(Yii::app()->session["userId"]))){
              $sourceAdmin = Person::getSourceAdmin(Yii::app()->session['userId']);
              foreach ($sourceAdmin as $key => $value) {
                ?>
                  <li><a href="javascript:;" onclick="loadByHash('#adminpublic.index?key=<?php echo $value ;?>');" id="btn-menu-dropdown-add"><i class="fa fa-cog text-blue"></i> <?php echo $value ; ?></a></li>
              <?php } ?>
              <li role="separator" class="divider"></li>
              <?php } ?>
          <li>
            <a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" 
               id="btn-menu-dropdown-logout" class="text-red">
              <i class="fa fa-sign-out"></i> Déconnexion
            </a>
          </li>  
        </ul>
      </div>
      
      <button class="menu-button btn-menu btn-menu-notif tooltips text-dark hidden-xs" 
            data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
        <i class="fa fa-bell"></i>
        <span class="notifications-count topbar-badge badge badge-danger animated bounceIn"><?php count($this->notifications); ?></span>
      </button>
    
    <?php }else{ ?>
      <button class="btn-top btn btn-success  hidden-xs" onclick="showPanel('box-register');"><i class="fa fa-plus-circle"></i> <span class="hidden-sm hidden-md hidden-xs">S'inscrire</span></button>
      <button class="btn-top btn bg-red  hidden-xs" style="margin-right:10px;" onclick="showPanel('box-login');"><i class="fa fa-sign-in"></i> <span class="hidden-sm hidden-md hidden-xs">Se connecter</span></button> 
    <?php } ?>
    </div>
  </div>


<script>

  /* global search code is in assets/js/default/globalsearch.js */

  var timeoutGS = setTimeout(function(){ }, 100);
  var timeoutDropdownGS = setTimeout(function(){ }, 100);
  jQuery(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    $(".menu-name-profil").click(function(){
      showNotif(false);
    });

    $('.input-global-search').keyup(function(e){
        clearTimeout(timeoutGS);
        timeoutGS = setTimeout(function(){ startGlobalSearch(0, indexStepGS); }, 800);
    });

    $('.input-global-search').click(function(e){
        if($(".dropdown-result-global-search").html() != ""){
          showDropDownGS(true);
        }

    });

    $('.dropdown-result-global-search').mouseenter(function(e){
        clearTimeout(timeoutDropdownGS);
    });
    $('.main-col-search, .mapCanvas, .main-menu-top').mouseenter(function(e){
        clearTimeout(timeoutDropdownGS);
        timeoutDropdownGS = setTimeout(function(){ 
            showDropDownGS(false);
        }, 300);
    });

    $('.moduleLabel').click(function(e){
        clearTimeout(timeoutDropdownGS);
        timeoutDropdownGS = setTimeout(function(){ 
            showDropDownGS(false);
        }, 300);
    });

    showDropDownGS(false);
  });




  </script>

