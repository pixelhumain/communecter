<?php if( isset( Yii::app()->session['userId']) )
    {
    	$me = Person::getById(Yii::app()->session['userId']);
      if(isset($me['profilImageUrl']) && $me['profilImageUrl'] != "")
        $urlPhotoProfil = Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$me['profilImageUrl']);
      else
        $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
    ?>
  <style>
  .menu-info-profil{
    right:50px;
    top:10px;
    position: absolute;

  }
  .menu-info-profil.main{
    right:65px;
  }
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
    right: 13px;
    top: 9px;
    padding-right: 15px;
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
  </style>
  
  <div class="menu-info-profil <?php echo isset($type) ? $type : ''; ?>">

    <div class="dropdown">
      <button class="dropdown-toggle menu-name-profil text-dark" data-toggle="dropdown">
        <?php echo $me["name"]; ?>
        <span class="caret"></span>
        <img class="img-circle" id="menu-thumb-profil" width="34" height="34" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
      </button>
      <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="javascript:" id="btn-menu-dropdown-my-profil"><i class="fa fa-user text-dark"></i> Mon profil</a></li>
        <li><a href="javascript:" id="btn-menu-dropdown-my-city"><i class="fa fa-university text-red"></i> Ma commune</a></li>
        <li><a href="javascript:" id="btn-menu-dropdown-add"><i class="fa fa-plus-circle text-green"></i> Créer</a></li>
        <li role="separator" class="divider"></li>
        <li>
          <a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/logout'); ?>" 
             id="btn-menu-dropdown-logout" class="text-red">
            <i class="fa fa-sign-out"></i> Déconnection
          </a>
        </li>  
      </ul>
    </div>

    <a href="javascript:;" onclick="loadByHash( '#person.detail.id.<?php echo Yii::app()->session['userId']; ?>')" 
  		class="menu-icon-profil">
  		<span class="menu-count badge badge-danger animated bounceIn" style="position:absolute;left:8px;"></span>	  
  	</a>


  </div>

  <script>
    jQuery(document).ready(function() {
      // $('#dropdownMenuinMenu').dropdown();
      // $('#dropdownMenumain').dropdown();
      // $('.dropdown-toggle').dropdown();
    });
  </script>


<?php } ?>