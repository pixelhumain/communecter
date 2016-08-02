<?php 
  $cssAnsScriptFilesModule = array(
    '/css/default/short_info_profil.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>


<div class="menu-info-profil <?php echo isset($type) ? $type : ''; ?>">
    <input type="text" class="text-dark input-global-search hidden-xs" placeholder="<?php echo Yii::t("common","Search") ?> ..."/>
    <div class="dropdown-result-global-search"></div>
    
    <div class="topMenuButtons pull-right">
    <?php 
    if( isset( Yii::app()->session['userId']) )
      echo $this->renderPartial('./menu/menuProfil',array( "me"=> $me)); 
    else { ?>
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

