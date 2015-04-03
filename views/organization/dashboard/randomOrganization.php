<?php if(isset($randomOrganization)){ ?>
  <div class="panel panel-white">
    <div class="panel-heading border-light">
      <h4 class="panel-title">UNE ASSO AU HASARD </h4>
    </div>
    <div class="panel-body no-padding"  >
      <div class="row">
        <div class="col-xs-6">
          <img class="img-responsive center-block" style="height:250px" src="http://placehold.it/350x180"/>
        </div>
        <div class="col-xs-6">
          <div class="row center">
            <?php echo (isset($randomOrganization['name'])) ? $randomOrganization['name'] : $randomOrganization['_id'] ?>
          </div>
          <div class="row" >
            <img class="img-circle pull-left" src="<?php echo (isset($randomOrganization['image'])) ? $randomOrganization['image'] : 'http://placehold.it/50x50' ?>"/>
          </div>
          <hr>
          <div class="row">
            <?php echo (isset($randomOrganization['description'])) ? $randomOrganization['description'] : "no description" ?>
          </div>
          
        </div>  
      </div>
      </div>
    <div class="panel-footer "  >
      <a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/organization/public/id/".$randomOrganization['_id'])?>">En savoir+ <i class="fa fa-angle-right"></i> </a>
    </div>
  </div>
<?php } ?>