<div class="space20"></div>
<div class="row box-login">
      <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel core-box">
          <div class="panel-tools">
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-user icon-big text-pink"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-pink">People</h3>
              <span class="subtitle">
                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <a title="My people" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/directory?type=".Person::COLLECTION)?>" class="col-xs-4 padding-10 text-center text-red tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Invite Someone" href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/person/invitesv?isNotSV=1', 'INVITE SOMEONE','share-alt' )" class="col-xs-4 padding-10 text-center text-red tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-red tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-users icon-big text-green"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-green">Organizations</h3>
              <span class="subtitle">
                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <a title="My organizations" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/directory?type=".Organization::COLLECTION)?>" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Add An Organization" href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/organization/addorganizationform?isNotSV=1', 'ADD AN ORGANIZATION','users' )" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-green tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-calendar icon-big text-azure"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-azure">Events</h3>
              <span class="subtitle">
                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
           <a title="My events" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/directory?type=".Event::COLLECTION)?>" class="col-xs-4 padding-10 text-center text-azure tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Add An Event" href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/event/eventsv?isNotSV=1', 'ADD AN EVENT','calendar' )" class="col-xs-4 padding-10 text-center text-azure tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-azure tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-3 col-sm-6">
        <div class="panel panel-default panel-white core-box">
          <div class="panel-tools">
            <a href="#" class="btn btn-xs btn-link panel-close">
              <i class="fa fa-times"></i>
            </a>
          </div>
          <div class="panel-body no-padding">
            <div class="padding-20 text-center core-icon">
              <i class="fa fa-lightbulb-o icon-big text-orange"></i>
            </div>
            <div class="padding-20 core-content">
              <h3 class="title block no-margin text-orange">Projects</h3>
              <span class="subtitle">
                Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
              </span>
            </div>
          </div>
          <div class="panel-footer partition-white clearfix no-padding">
            <a title="My projects" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/directory?type=".Project::COLLECTION)?>" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top"  ><i class="fa fa-bars"></i></a>
            <a title="Add A Project" href="#" onclick="showAjaxPanel( baseUrl+'/'+moduleId+'/project/projectsv?isNotSV=1', 'ADD A PROJECT','lightbulb-o' )" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top"><i class="fa fa-plus"></i></a>
            <a title="My dashboard" href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/dashboard")?>" class="col-xs-4 padding-10 text-center text-orange tooltips" data-toggle="tooltip" data-placement="top" ><i class="fa fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>