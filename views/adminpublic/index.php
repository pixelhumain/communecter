<?php
$cs = Yii::app()->getClientScript();

?>
<!-- start: PAGE CONTENT -->
<div class="col-xs-12" id="">
  <div class="panel panel-white">
      <div class="panel-heading text-center border-light">
        <h3 class="panel-title text-blue"><i class="fa fa-connectdevelop"></i> Admin Public</h3>
      </div>

      <div class="panel-body no-padding center">
        <ul class="list-group text-left no-margin">

          <li class="list-group-item text-purple col-md-4 col-sm-6 link-to-directory">
            <div class="" style="cursor:pointer;" onclick="loadByHash('#adminpublic.createfile')">
              <i class="fa fa-upload fa-2x"></i> 
              <?php echo Yii::t("admin", "IMPORT DATA", null, Yii::app()->controller->module->id); ?>
            </div>
          </li>
          <li class="list-group-item text-red col-md-4 col-sm-6 link-to-directory">
            <div class="" style="cursor:pointer;" onclick="loadByHash('#adminpublic.adddata')">
              <i class="fa fa-plus fa-2x"></i>
                
              <?php echo Yii::t("admin", "ADD DATA", null, Yii::app()->controller->module->id); ?>

            </div>
          </li>
          <?php if( Role::isSourceAdmin(Role::getRolesUserId(Yii::app()->session["userId"]) ) ){ ?>
             <li class="list-group-item text-red col-md-4 col-sm-6 link-to-directory">
              <div class="" style="cursor:pointer;" onclick="loadByHash('#stat.chart')">
                <i class="fa fa-plus fa-2x"></i>
                  
                <?php echo Yii::t("admin", "SOURCE ADMIN", null, Yii::app()->controller->module->id); ?>
                
              </div>
            </li>
          <?php 
            }
          ?>
        </ul>
      </div>
  </div>
</div>
</div>-->
<!-- end: PAGE CONTENT-->
<script>

  jQuery(document).ready(function() {
    setTitle("Espace administrateur","cog");
   //Index.init();
  });

</script>