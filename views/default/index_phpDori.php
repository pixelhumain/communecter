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
    <div class="panel core-box">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-20 text-center core-icon">
          <i class="fa fa-users icon-big text-pink"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin text-pink">Citoyens</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
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
          <h3 class="title block no-margin text-green">Associations</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
      </div>
      <div class="panel-footer clearfix no-padding">
        <div class=""></div>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person?tabId=panel_organisations")?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-green" data-toggle="tooltip" data-placement="top" title="my NGOs" ><i class="fa fa-user"></i></a>
        <a href="#" onclick="openSubView($(this).attr('alt'), '/<?php echo $this->module->id?>/organization/addorganizationform/type/NGO',null);" class="col-xs-4 padding-10 text-center text-white tooltips partition-blue" data-toggle="tooltip" data-placement="top" title="Add an NGO" alt="Add an NGO"><i class="fa fa-plus"></i></a>
        <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/organization/index/type/NGO")?>" class="col-xs-4 padding-10 text-center text-white tooltips partition-red" data-toggle="tooltip" data-placement="top" title="all NGOs"><i class="fa fa-chevron-right"></i></a>
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
          <i class="fa fa-users icon-big text-azure"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin text-azure">Entreprises</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
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
          <i class="fa fa-users icon-big text-orange"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin text-orange">Collectivités</h3>
          <span class="subtitle">
            Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper.
          </span>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3 col-sm-6">
    <div class="panel core-box small">
      <div class="panel-tools">
        <a href="#" class="btn btn-xs btn-link panel-close">
          <i class="fa fa-times"></i>
        </a>
      </div>
      <div class="panel-body no-padding">
        <div class="text-center core-icon panel-blue">
          <i class="fa fa-users icon-big"></i>
        </div>
        <div class="padding-20 core-content">
          <h3 class="title block no-margin">Thématique</h3>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-7 col-lg-4">
    <div class="panel panel-dark">
      <div class="panel-heading">
        <h4 class="panel-title">Évennement</h4>
        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-white">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
              <li>
                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
              </li>
              <li>
                <a class="panel-refresh" href="#">
                  <i class="fa fa-refresh"></i> <span>Refresh</span>
                </a>
              </li>
              <li>
                <a class="panel-config" href="#panel-config" data-toggle="modal">
                  <i class="fa fa-wrench"></i> <span>Configurations</span>
                </a>
              </li>
              <li>
                <a class="panel-expand" href="#">
                  <i class="fa fa-expand"></i> <span>Fullscreen</span>
                </a>
              </li>
            </ul>
          </div>
          <a class="btn btn-xs btn-link panel-close" href="#">
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>
      <div class="panel-body no-padding">
        <div class="partition-green padding-15 text-center">
          <h4 class="no-margin">Activité Locale</h4>
          <span class="text-light">crowd sourcé</span>
        </div>
        <div id="accordion" class="panel-group accordion accordion-white no-margin">
          <div class="panel no-radius">
            <div class="panel-heading">
              <h4 class="panel-title">
              <a href="#collapseOne" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15">
                <i class="icon-arrow"></i>
                Ce mois ci <span class="label label-danger pull-right">4</span>
              </a></h4>
            </div>
            <div class="panel-collapse collapse in" id="collapseOne">
              <div class="panel-body no-padding partition-light-grey">
                <table class="table">
                  <tbody>
                    <tr>
                      <td class="center">1</td>
                      <td>Festival musique africaine</td>
                      <td class="center">4909</td>
                      <td><i class="fa fa-caret-down text-red"></i></td>
                    </tr>
                    <tr>
                      <td class="center">2</td>
                      <td>Exposition Photo</td>
                      <td class="center">3857</td>
                      <td><i class="fa fa-caret-up text-green"></i></td>
                    </tr>
                    <tr>
                      <td class="center">3</td>
                      <td>Concert Local</td>
                      <td class="center">1789</td>
                      <td><i class="fa fa-caret-up text-green"></i></td>
                    </tr>
                    <tr>
                      <td class="center">4</td>
                      <td>Journée Porte ouverte</td>
                      <td class="center">612</td>
                      <td><i class="fa fa-caret-down text-red"></i></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="panel no-radius">
            <div class="panel-heading">
              <h4 class="panel-title">
              <a href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15 collapsed">
                <i class="icon-arrow"></i>
                Dans 1 mois
              </a></h4>
            </div>
            <div class="panel-collapse collapse" id="collapseTwo">
              <div class="panel-body no-padding partition-light-grey">
                <table class="table">
                  <tbody>
                    <tr>
                      <td class="center">1</td>
                      <td>Google Chrome</td>
                      <td class="center">5228</td>
                      <td><i class="fa fa-caret-up text-green"></i></td>
                    </tr>
                    <tr>
                      <td class="center">2</td>
                      <td>Mozilla Firefox</td>
                      <td class="center">2853</td>
                      <td><i class="fa fa-caret-up text-green"></i></td>
                    </tr>
                    <tr>
                      <td class="center">3</td>
                      <td>Safari</td>
                      <td class="center">1948</td>
                      <td><i class="fa fa-caret-up text-green"></i></td>
                    </tr>
                    <tr>
                      <td class="center">4</td>
                      <td>Internet Explorer</td>
                      <td class="center">456</td>
                      <td><i class="fa fa-caret-down text-red"></i></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="panel no-radius">
            <div class="panel-heading">
              <h4 class="panel-title">
              <a href="#collapseThree" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle padding-15 collapsed">
                <i class="icon-arrow"></i>
                Dans 2 mois
              </a></h4>
            </div>
            <div class="panel-collapse collapse" id="collapseThree">
              <div class="panel-body no-padding partition-light-grey">
                <table class="table">
                  <tbody>
                    <tr>
                      <td class="center">1</td>
                      <td>Google Chrome</td>
                      <td class="center">4256</td>
                      <td><i class="fa fa-caret-down text-red"></i></td>
                    </tr>
                    <tr>
                      <td class="center">2</td>
                      <td>Mozilla Firefox</td>
                      <td class="center">3557</td>
                      <td><i class="fa fa-caret-up text-green"></i></td>
                    </tr>
                    <tr>
                      <td class="center">3</td>
                      <td>Safari</td>
                      <td class="center">1435</td>
                      <td><i class="fa fa-caret-up text-green"></i></td>
                    </tr>
                    <tr>
                      <td class="center">4</td>
                      <td>Internet Explorer</td>
                      <td class="center">423</td>
                      <td><i class="fa fa-caret-down text-red"></i></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-5">
    <div class="row">
      <div class="col-md-6">
        <div class="panel panel-blue">
          <div class="panel-body padding-20 text-center">
            <div class="space10">
              <h5 class="text-white semi-bold no-margin p-b-5">Aujourd'hui</h5>
              <h3 class="text-white no-margin"><span class="text-small">&euro;</span>1,450</h3>
              25 Echanges
            </div>
            <div class="sparkline-4 space10">
              <span ></span>
            </div>
            <span class="text-light"><i class="fa fa-clock-o"></i> 1 hour ago</span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="panel panel-green">
          <div class="panel-body padding-20 text-center">
            <div class="space10">
              <h5 class="text-white semi-bold no-margin p-b-5">Hier</h5>
              <h3 class="text-white no-margin"><span class="text-small">&euro;</span>1,250</h3>
              18 Echanges
            </div>
            <div class="sparkline-5 space10">
              <span></span>
            </div>
            <span class="text-light"><i class="fa fa-clock-o"></i> 1 hour ago</span>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel">
          <div class="panel-body">
            <div class="easy-pie-chart">
              <span class="cpu number appear" data-percent="82" data-plugin-options='{"barColor": "#ff0000"}'> <span class="percent"></span> </span>
              <div class="label-chart">
                <h4 class="no-margin">Population <br/>Communnecté</h4>
              </div>
            </div>
            <div class="small-text text-center space15">
              <span class="block">Objectif</span><span class="label label-danger vertical-align-bottom">85%</span>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel">
          <div class="panel-body">
            <div class="easy-pie-chart">
              <span class="bounce number appear" data-percent="44" data-plugin-options='{"barColor": "#35aa47"}'> <span class="percent"></span> </span>
              <div class="label-chart">
                <h4 class="no-margin">Utilisateur <br/>Connecté</h4>
              </div>
            </div>
            <div class="text-center space15">
              <span class="block">Objectif</span><span class="label label-danger vertical-align-bottom">58%</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">Mon Réseau</h4>
        <div class="panel-tools">
          <div class="dropdown">
            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
              <i class="fa fa-cog"></i>
            </a>
            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
              <li>
                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
              </li>
              <li>
                <a class="panel-refresh" href="#">
                  <i class="fa fa-refresh"></i> <span>Refresh</span>
                </a>
              </li>
              <li>
                <a class="panel-config" href="#panel-config" data-toggle="modal">
                  <i class="fa fa-wrench"></i> <span>Configurations</span>
                </a>
              </li>
              <li>
                <a class="panel-expand" href="#">
                  <i class="fa fa-expand"></i> <span>Fullscreen</span>
                </a>
              </li>
            </ul>
          </div>
          <a class="btn btn-xs btn-link panel-close" href="#">
            <i class="fa fa-times"></i>
          </a>
        </div>
      </div>
      <div class="panel-body no-padding">
        <div class="padding-10">
          <img width="50" height="50" alt="" class="img-circle pull-left" src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-1-big.jpg">
          <h4 class="no-margin inline-block padding-5">Peter Clark <span class="block text-small text-left">UI Designer</span></h4>
          <div class="pull-right padding-15">
            <span class="text-small text-bold text-green"><i class="fa fa-dot-circle-o"></i> on-line</span>
          </div>
        </div>
        <div class="clearfix padding-5 space5">
          <div class="col-xs-4 text-center no-padding">
            <div class="border-right border-dark">
              <a href="#" class="text-dark">
                <i class="fa fa-heart-o text-red"></i> 250
              </a>
            </div>
          </div>
          <div class="col-xs-4 text-center no-padding">
            <div class="border-right border-dark">
              <a href="#" class="text-dark">
                <i class="fa fa-bookmark-o text-green"></i> 20
              </a>
            </div>
          </div>
          <div class="col-xs-4 text-center no-padding">
            <a href="#" class="text-dark"><i class="fa fa-comment-o text-azure"></i> 544</a>
          </div>
        </div>
        <div class="tabbable no-margin no-padding partition-dark">
          <ul class="nav nav-tabs" id="myTab">
            <li class="active">
              <a data-toggle="tab" href="#users_tab_example1">
                All
              </a>
            </li>
            <li class="">
              <a data-toggle="tab" href="#users_tab_example2">
                View and Edit
              </a>
            </li>
            <li class="">
              <a data-toggle="tab" href="#users_tab_example3">
                View Only
              </a>
            </li>
          </ul>
          <div class="tab-content partition-white">
            <div id="users_tab_example1" class="tab-pane padding-bottom-5 active">
              <div class="panel-scroll height-230">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-1.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">UI Designer</span><span class="text-large">Peter Clark</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-2.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Content Designer</span><span class="text-large">Nicole Bell</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div id="users_tab_example2" class="tab-pane padding-bottom-5">
              <div class="panel-scroll height-230">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div id="users_tab_example3" class="tab-pane padding-bottom-5">
              <div class="panel-scroll height-230">
                <table class="table table-striped table-hover">
                  <tbody>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-2.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Content Designer</span><span class="text-large">Nicole Bell</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-3.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Visual Designer</span><span class="text-large">Steven Thompson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-5.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Senior Designer</span><span class="text-large">Kenneth Ross</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                    <tr>
                      <td class="center"><img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/avatar-4.jpg" class="img-circle" alt="image"/></td>
                      <td><span class="text-small block text-light">Web Editor</span><span class="text-large">Ella Patterson</span><a href="#" class="btn"><i class="fa fa-pencil"></i></a></td>
                      <td class="center">
                      <div>
                        <div class="btn-group">
                          <a class="btn btn-transparent-grey dropdown-toggle btn-sm" data-toggle="dropdown" href="#">
                            <i class="fa fa-cog"></i> <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu dropdown-dark pull-right">
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-edit"></i> Edit
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-share"></i> Share
                              </a>
                            </li>
                            <li role="presentation">
                              <a role="menuitem" tabindex="-1" href="#">
                                <i class="fa fa-times"></i> Remove
                              </a>
                            </li>
                          </ul>
                        </div>
                      </div></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end: PAGE CONTENT-->
<script>
  jQuery(document).ready(function() {
   
   //Index.init();
  });

</script>