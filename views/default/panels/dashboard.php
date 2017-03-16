<style>
  
  .box-add .fa{
    margin-bottom:7px;
  }
  .box-add{
    padding-left:50px;
  }

  .btn-add-something{
    padding: 5px !important;
    margin-top: 5px;
    margin-bottom: 5px;
    width: 96%;
    border-radius: 3px;
    border: 2px solid transparent;
  }
  .btn-add-something:hover{
    background-color: white !important;
  }
  .btn-add-something.bg-green:hover{
    border: 2px solid #93C020 !important;
    color: #93C020 !important;
  }
  .btn-add-something.bg-yellow:hover{
    border: 2px solid #FFC600 !important;
    color: #FFC600 !important;
  }
  .btn-add-something.bg-purple:hover{
    border: 2px solid #8C5AA1 !important;
    color: #8C5AA1 !important;
  }
  .btn-add-something.bg-orange:hover{
    border: 2px solid #FFA200 !important;
    color: #FFA200 !important;
  }
</style>
<div class="row box-add  box">
      <div class="space20"></div>
      <div class="col-sm-6">
        <div class="panel core-box">
          <div class="panel-tools">
          <?php /* ?>
            <a href="javascript:;" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <!-- <div class="padding-20 text-center core-icon">
              <i class="fa fa-user icon-big text-yellow"></i>
            </div> -->
            <div class="padding-10 padding-top-20">
              <i class="fa fa-2x fa-user icon-big text-yellow"></i>
              <h3 class="title block no-margin text-yellow homestead"><?php echo Yii::t("common","A person") ?></h3>
              <!-- <span class="subtitle">
                <?php echo Yii::t("common","Invite people you know, you like, you met, you want to follow") ?>.
              </span> -->
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <!-- <a title="My people" href="javascript:;" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'PERSON DIRECTORY ','user' )" class="col-xs-4 padding-10 text-center text-yellow tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a> -->
            <a title="Invite Someone" href="javascript:;" onclick="showAjaxPanel( '/person/invite', 'INVITE SOMEONE','share-alt' )" 
               class="btn btn-default btn-add-something text-center bg-yellow" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <!-- <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-yellow tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a> -->
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <?php /* ?>
            <a href="javascript:;" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <!-- <div class="padding-20 text-center core-icon">
              <i class="fa fa-users icon-big text-green"></i>
            </div> -->
            <div class="padding-10 padding-top-20">
              <i class="fa fa-2x fa-users icon-big text-green"></i>
              <h3 class="title block no-margin text-green homestead"><?php echo Yii::t("common","An organization") ?></h3>
              <!-- <span class="subtitle">
                <?php echo Yii::t("common","Connect organizations you know, you like, you met, you want to follow") ?>.
              </span> -->
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <!-- <a title="My organizations" href="javascript:;" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Organization::COLLECTION ?>', 'ORGANIZATION DIRECTORY ','users' )" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a> -->
            <a title="Add An Organization" href="javascript:;" onclick="showAjaxPanel( '/organization/addorganizationform', 'ADD AN ORGANIZATION','users' )" 
               class="btn btn-default btn-add-something text-center bg-green" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <!-- <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a> -->
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <?php /* ?>
            <a href="javascript:;" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <!-- <div class="padding-20 text-center core-icon">
              <i class="fa fa-calendar icon-big text-orange"></i>
            </div> -->
            <div class="padding-10 padding-top-20">
              <i class="fa fa-2x fa-calendar icon-big text-orange"></i>
              <h3 class="title block no-margin text-orange homestead"><?php echo Yii::t("common","An event") ?></h3>
              <!-- <span class="subtitle">
               <?php echo Yii::t("common","Create and Attend local events") ?>.
              </span> -->
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
           <!-- <a title="My events" href="javascript:;" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Event::COLLECTION ?>', 'EVENT DIRECTORY ','calendar' )" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a> -->
            <a title="Add An Event" href="javascript:;" onclick="showAjaxPanel( '/event/eventsv', 'ADD AN EVENT','calendar' )" 
               class="btn btn-default btn-add-something text-center bg-orange" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <!-- <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a> -->
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <?php /* ?>
            <a href="javascript:;" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <!-- <div class="padding-20 text-center core-icon">
              <i class="fa fa-lightbulb-o icon-big text-purple"></i>
            </div> -->
            <div class="padding-10 padding-top-20">
              <i class="fa fa-2x fa-lightbulb-o icon-big text-purple"></i>
              <h3 class="title block no-margin text-purple homestead"><?php echo Yii::t("common","A project") ?></h3>
              <!-- <span class="subtitle">
                <?php echo Yii::t("common","Promote or contribute to local projects") ?>.
              </span> -->
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <!-- <a title="My projects" href="javascript:;" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Project::COLLECTION ?>', 'PROJECT DIRECTORY ','lightbulb-o' )" class="col-xs-4 padding-10 text-center text-purple tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a> -->
            <a title="Add A Project" href="javascript:;" onclick="showAjaxPanel( '/project/projectsv/id/<?php echo Yii::app()->session['userId']?>/type/citoyen', 'ADD A PROJECT','lightbulb-o' )" 
               class="btn btn-default btn-add-something text-center bg-purple" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <!-- <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-purple tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a> -->
          </div>
        </div>
      </div>
    </div>