<div class="row">

  <div class="col-sm-12 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">Documents </h4>
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
        <div class="panel-scroll height-230">
          <table class="table table-striped table-hover">
            <tbody>
            	<?php foreach ($documents as $doc) { ?>
              <tr>
                <td class="center"><img src="http://placehold.it/50x50" class="img-circle" alt="image"/></td>
                <td><span class="text-small block text-light">Person</span><span class="text-large"><?php echo $doc['name'] ?> </span><a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/person/public/id/".$doc['_id'])?>" class="btn"><i class="fa fa-chevron-circle-right"></i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
        
    </div>
  </div>

</div>