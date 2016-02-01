<?php if( isset( Yii::app()->session['userId']) )
    {
    	$me = Person::getById(Yii::app()->session['userId']);
      if(isset($me['profilImageUrl']) && $me['profilImageUrl'] != "")
        $urlPhotoProfil = Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$me['profilImageUrl']);
      else
        $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
    ?>
  <style>
  .menu-info-profil.main{
    right:60px;
    top:10px;
    position: absolute;
  }
  /*.menu-info-profil.main{
    right:65px;
  }*/
  .menu-icon-profil{
    padding: 2px 15px 0px 7px;
  }
  .menu-name-profil{
    font-size: 15px;
    font-weight: 300;
    background: transparent;
    border: none;
  }

  .main-top-menu .menu-info-profil{
    /*right: 20px;
    top: 9px;
    */
    margin-top:10px;
    padding-right: 15px;
    position:relative;
    float:right;
  }

  .menu-info-profil .dropdown-menu{
    top: 114%;
    margin-right: -15px;
    border-radius: 0px 0px 4px 4px;
    /*border-top-color: transparent;*/
  }
  .menu-info-profil.main .dropdown-menu{
    top: 114%;
    margin-right: -5px;
    border-radius: 0px 0px 4px 4px;
    /*border-top-color: transparent;*/
  }

  .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus{
    background-color: #d2e7f2;
  }
  .dropdown-menu .fa{
    width:20px;
    text-align: center;
  }
  </style>
  

  <div class="menu-info-profil <?php echo isset($type) ? $type : ''; ?>">

     
    <div class="dropdown pull-right">
      <button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown">
        <img class="img-circle" id="menu-thumb-profil" width="34" height="34" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
        <?php echo $me["name"]; ?>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="javascript:" id="btn-menu-dropdown-my-profil"><i class="fa fa-user text-dark"></i> Mon profil</a></li>
        <li><a href="javascript:" id="btn-menu-dropdown-my-city"><i class="fa fa-university text-red"></i> Ma commune</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="javascript:" onclick="loadByHash('#person.invitesv');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-yellow"></i> <i class="fa fa-item-menu fa-user text-yellow"></i> Inviter quelqu'un</a></li>
        <li><a href="javascript:" onclick="loadByHash('#event.addeventform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-orange"></i> <i class="fa fa-calendar text-orange"></i> Créer un événement</a></li>
        <li><a href="javascript:" onclick="loadByHash('#project.addprojectform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-purple"></i> <i class="fa fa-lightbulb-o text-purple"></i> Créer un projet</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="javascript:" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-green"></i> <i class="fa fa-users text-green"></i> Référencer mon association</a></li>
        <li><a href="javascript:" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-azure"></i> <i class="fa fa-industry text-azure"></i> Référencer mon entreprise</a></li>
        <li><a href="javascript:" onclick="loadByHash('#organization.addorganizationform');" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-dark"></i> <i class="fa fa-asterisk text-dark"></i> Référencer ...</a></li>
        <li role="separator" class="divider"></li>
        <li>
          <a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" 
             id="btn-menu-dropdown-logout" class="text-red">
            <i class="fa fa-sign-out"></i> Déconnection
          </a>
        </li>  
      </ul>
    </div>

     <button class="menu-button btn-menu btn-menu-notif tooltips text-dark" 
          data-toggle="tooltip" data-placement="left" title="Notifications" alt="Notifications">
      <i class="fa fa-bell"></i>
    </button>

  </div>

 

  <script>
    jQuery(document).ready(function() {
      // $('#dropdownMenuinMenu').dropdown();
      // $('#dropdownMenumain').dropdown();
      $('.dropdown-toggle').dropdown();
    });
  </script>


<?php } ?>