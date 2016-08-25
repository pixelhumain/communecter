<?php 
  $cssAnsScriptFilesModule = array(
    '/css/default/short_info_profil.css',
  );
  HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style type="text/css">
  .searchIcon{
    cursor: pointer;
  }
  #basic-addon1{
    background-color: white !important;
    border-radius: 4px 0 0 4px !important;
    height: 36px;
    border-color: #C8C8C8;
  }
</style>
<div class="menu-info-profil <?php echo isset($type) ? $type : ''; ?> " 
     data-tpl="default.menu.short_info_profil">
    
    <?php
    //<div class="label label-inverse">new <span class="badge animated bounceIn bg-red">1</span></div>
    
    //if(isset(Yii::app()->session['userId'])) 
    $this->renderPartial('../default/menu/multi_tag_scope', array("me"=>$me)); ?>
    
    <div class="input-group group-globalsearch inline hidden-xs">
      <span class="input-group-addon" id="basic-addon1">
        <i class="fa fa-search text-dark searchIcon tooltips" 
           data-toggle="tooltip" data-placement="bottom" title="Recherche Globale"></i>
      </span>
      <input type="text" class="text-dark input-global-search" 
             placeholder="<?php echo Yii::t("common","Search") ?> ..."/>
    </div>
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
  var searchPage = false;
  jQuery(document).ready(function() {

    $('.dropdown-toggle').dropdown();
    $(".menu-name-profil").click(function(){
      showNotif(false);
    });

    $('.input-global-search').keyup(function(e){
        clearTimeout(timeoutGS);
        if($(".newsTL")){
          $(".newsTL").html("");
          $("#nowListevents,#nowListDDA,#nowListprojects,#nowListorga").html("");
        }
        if($('*[data-searchPage]').length > 0 && searchPage ){
          $('#searchBarText').val( $('.input-global-search').val() );
          timeoutGS = setTimeout(function(){startSearch(false); }, 800);
        }
        else {
          timeoutGS = setTimeout(function(){ startGlobalSearch(0, indexStepGS); }, 800);
        }
    });

    $('.searchIcon').click(function(e){
       if($('*[data-searchPage]').length > 0 && $('.searchIcon').hasClass('fa-search')){
          $(".dropdown-result-global-search").html('<span class="padding-10 text-bold">Cette recherche ne concerne que cette page.</span>');
          showDropDownGS(true);
          searchPage = true;
          $(".searchIcon").removeClass("fa-search").addClass("fa-file-text-o");
          $(".searchIcon").attr("title","Mode Recherche ciblé (ne concerne que cette page)");
          $('.tooltips').tooltip();
          if( $("input-global-search").val() != "")
            timeoutGS = setTimeout(function(){startSearch(false); }, 800);
       }else{
          $(".searchIcon").removeClass("fa-file-text-o").addClass("fa-search");
          $(".dropdown-result-global-search").html('<span class="padding-10 text-bold">Cette recherche sera globale.</span>');
          $(".searchIcon").attr("title","Mode Recherche Globale");
          $('.tooltips').tooltip();
          showDropDownGS(true);
          searchPage = false;
          if( $("input-global-search").val() != "")
            timeoutGS = setTimeout(function(){ startGlobalSearch(0, indexStepGS); }, 800);
       }

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

