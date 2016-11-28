<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "subdomain"=>$subdomain,
                                "mainTitle"=>$mainTitle,
                                "placeholderMainSearch"=>$placeholderMainSearch) ); 
?>

<div class="container">
  <div class="page-header text-center">
      <h3 id="timeline"><i class="fa fa-angle-down"></i><br>L'Actu locale en direct</h3>
  </div>
  <ul class="timeline">
      
      <li>
        <div class="timeline-badge"><i class="glyphicon glyphicon-check"></i></div>
        <div class="timeline-panel">
          <div class="timeline-heading">
            <h4 class="timeline-title">Mussum ipsum cacilds</h4>
            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11/09/2014</small></p>
          </div>
          <div class="timeline-body">
            <p>Mussum ipsum cacilds, vidis litro abertis. Consetis adipiscings elitis. Pra lá , depois divoltis porris, paradis. Paisis, filhis, espiritis santis. Mé faiz elementum girarzis, nisi eros vermeio, in elementis mé pra quem é amistosis quis leo. Manduma pindureta quium dia nois paga. Sapien in monti palavris qui num significa nadis i pareci latim. Interessantiss quisso pudia ce receita de bolis, mais bolis eu num gostis.</p>
             <div>
              <div class="pull-right">
                <span class="label label-default">alice</span>
                <span class="label label-primary">story</span>
                <span class="label label-success">blog</span>
                <span class="label label-info">personal</span>
                <span class="label label-warning">Warning</span>
                <span class="label label-danger">Danger</span>
              </div>
            </div>     
          </div>
          
        </div>
      </li>
      <li class="timeline-inverted">
        <div class="timeline-badge warning"><i class="glyphicon glyphicon-credit-card"></i></div>
        <div class="timeline-panel">
          <div class="timeline-heading">
            <h4 class="timeline-title">Mussum ipsum cacilds</h4>
            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 11/09/2014</small></p>
          </div>
          <div class="timeline-body">
            <p>Suco de cevadiss, é um leite divinis, qui tem lupuliz, matis, aguis e fermentis. Interagi no mé, cursus quis, vehicula ac nisi. Aenean vel dui dui. Nullam leo erat, aliquet quis tempus a, posuere ut mi. Ut scelerisque neque et turpis posuere pulvinar pellentesque nibh ullamcorper. Pharetra in mattis molestie, volutpat elementum justo. Aenean ut ante turpis. Pellentesque laoreet mé vel lectus scelerisque interdum cursus velit auctor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam ac mauris lectus, non scelerisque augue. Aenean justo massa.</p>
             <div>
             <div class="pull-right"><span class="label label-default">alice</span> <span class="label label-primary">story</span> <span class="label label-success">blog</span> <span class="label label-info">personal</span> <span class="label label-warning">Warning</span>
              <span class="label label-danger">Danger</span></div>
            </div>     
          </div>
          <hr>
          <div class="timeline-footer">
              <div class="panel panel-primary">
                  <div class="panel-heading" id="accordion">
                      <span class="label label-danger">5</span>
                      <span class="glyphicon glyphicon-comment"></span> Chat
                      <div class="btn-group pull-right">
                          <a type="button" class="btn btn-default btn-xs" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                              <span class="glyphicon glyphicon-chevron-down"></span>
                          </a>
                      </div>
                  </div>
              <div class="panel-collapse collapse" id="collapseOne">
                  <div class="panel-body">
                      <ul class="chat">
                          <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                          <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                  </div>
                                  <p>
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                      dolor, quis ullamcorper ligula sodales.
                                  </p>
                              </div>
                          </li>
                          <li class="right clearfix"><span class="chat-img pull-right">
                              <img src="http://placehold.it/50/FA6F57/fff&text=RGB" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                      <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                  </div>
                                  <p>
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                      dolor, quis ullamcorper ligula sodales.
                                  </p>
                              </div>
                          </li>
                          <li class="left clearfix"><span class="chat-img pull-left">
                              <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                          <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
                                  </div>
                                  <p>
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                      dolor, quis ullamcorper ligula sodales.
                                  </p>
                              </div>
                          </li>
                          <li class="right clearfix"><span class="chat-img pull-right">
                              <img src="http://placehold.it/50/FA6F57/fff&text=RGB" alt="User Avatar" class="img-circle" />
                          </span>
                              <div class="chat-body clearfix">
                                  <div class="header">
                                      <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
                                      <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                  </div>
                                  <p>
                                      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                      dolor, quis ullamcorper ligula sodales.
                                  </p>
                              </div>
                          </li>
                      </ul>
                  </div>
                  <div class="panel-footer">
                      <div class="input-group">
                          <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                          <span class="input-group-btn">
                              <button class="btn btn-warning btn-sm" id="btn-chat">
                                  Send</button>
                          </span>
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </li>
  </ul>
</div>



<?php $this->renderPartial($layoutPath.'footer'); ?>

<script>
jQuery(document).ready(function() {
    initKInterface();
});
</script>