
<div class="row box-add  box">
      <div class="space20"></div>
      <div class="col-sm-6">
        <div class="panel core-box">
          <div class="panel-tools">
          <?php /* ?>
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-user icon-big text-yellow"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-yellow">People</h3>
              <span class="subtitle">
                Invite people you know, you like, you met, you want to follow.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <a title="My people" href="#" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Person::COLLECTION ?>', 'PERSON DIRECTORY ','user' )" class="col-xs-4 padding-10 text-center text-yellow tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Invite Someone" href="#" onclick="showAjaxPanel( '/person/invitesv?isNotSV=1', 'INVITE SOMEONE','share-alt' )" class="col-xs-4 padding-10 text-center text-yellow tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-yellow tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <?php /* ?>
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-users icon-big text-green"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-green">Organizations</h3>
              <span class="subtitle">
                Connect organizations you know, you like, you met, you want to follow.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <a title="My organizations" href="#" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Organization::COLLECTION ?>', 'ORGANIZATION DIRECTORY ','users' )" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Add An Organization" href="#" onclick="showAjaxPanel( '/organization/addorganizationform?isNotSV=1', 'ADD AN ORGANIZATION','users' )" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <?php /* ?>
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-calendar icon-big text-orange"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-orange">Events</h3>
              <span class="subtitle">
               Create and Attend local events.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
           <a title="My events" href="#" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Event::COLLECTION ?>', 'EVENT DIRECTORY ','calendar' )" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Add An Event" href="#" onclick="showAjaxPanel( '/event/eventsv?isNotSV=1', 'ADD AN EVENT','calendar' )" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <?php /* ?>
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>*/?>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-lightbulb-o icon-big text-purple"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-purple">Projects</h3>
              <span class="subtitle">
                Promote or contribute to local projects.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <a title="My projects" href="#" onclick="showAjaxPanel( '/person/directory/?tpl=directory2&type=<?php echo Project::COLLECTION ?>', 'PROJECT DIRECTORY ','lightbulb-o' )" class="col-xs-4 padding-10 text-center text-purple tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Add A Project" href="#" onclick="showAjaxPanel( '/project/projectsv/id/<?php echo Yii::app()->session['userId']?>/type/citoyen?isNotSV=1', 'ADD A PROJECT','lightbulb-o' )" class="col-xs-4 padding-10 text-center text-purple tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-purple tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>