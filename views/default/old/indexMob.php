<?php
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/weather-icons/css/weather-icons.min.css');
$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/nv.d3.min.css');

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/lib/d3.v3.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/nv.d3.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/src/models/historicalBar.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/src/models/historicalBarChart.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/src/models/stackedArea.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/nvd3/src/models/stackedAreaChart.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.sparkline/jquery.sparkline.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/easy-pie-chart/dist/jquery.easypiechart.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/index.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="row">

  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel panel-default panel-white core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="partition-green padding-20 text-center core-icon">
          <i class="fa fa-users fa-3x icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Association</h3>
          <span class="subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </span>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <div class=""></div>
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="Vos Associations"><i class="fa fa-cog"></i></a>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/organization/addorganizationform/type/NGO");?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Ajouter une Association"><i class="fa fa-plus"></i></a>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/organization/index/type/association")?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="Découvrir"><i class="fa fa-chevron-right"></i></a>
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
        <div class="partition-blue padding-20 text-center core-icon">
          <i class="fa fa-institution fa-3x icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Entreprise</h3>
          <span class="subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </span>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="More Options"><i class="fa fa-cog"></i></a>
        <a href="javascript:getModal('assoForm', '/<?php echo $this->module->id?>/organization/addorganizationform/type/entreprise',null);" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add Content"><i class="fa fa-plus"></i></a>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/organization/index/type/entreprise")?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="View More"><i class="fa fa-chevron-right"></i></a>
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
        <div class="partition-red padding-20 text-center core-icon">
          <i class="fa fa-child  fa-5x icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Périscolaire</h3>
          <span class="subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </span>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="More Options"><i class="fa fa-cog"></i></a>
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add Content"><i class="fa fa-plus"></i></a>
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="View More"><i class="fa fa-chevron-right"></i></a>
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
        <div class="partition-azure padding-20 text-center core-icon">
          <i class="fa fa-comments fa-3x icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Information</h3>
          <span class="subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </span>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="More Options"><i class="fa fa-cog"></i></a>
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add Content"><i class="fa fa-plus"></i></a>
        <a href="#" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="View More"><i class="fa fa-chevron-right"></i></a>
      </div>
    </div>
  </div>

</div>

<!-- end: PAGE CONTENT-->
<script>
  jQuery(document).ready(function() {
    Index.init();
  });
title = "Edit Form";

</script>