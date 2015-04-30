<?php 
  if(! isset($randomOrganization)){ 
    $randomOrganization["name"] = "Il est temps d'alimenter son réseau !";
    $randomOrganization["description"] = "Trouvez des organisations partenaires !";
    $randomOrganization["publicURL"] = "";
  }
?>
  <div class="panel panel-white">
    <div class="panel-heading border-light">
      <h4 class="panel-title">UNE ASSO AU HASARD </h4>
    </div>
    <div class="panel-body no-padding"  >
      <div class="row">
        <div class="col-xs-6">
          <img class="img-responsive center-block" style="height:250px" src="<?php echo (isset($randomOrganization['imagePath'])) ? $randomOrganization['imagePath'] : 'http://placehold.it/50x50' ?>"/>
        </div>
        <div class="col-xs-6">
          <div class="row center">
            <?php echo (isset($randomOrganization['name'])) ? $randomOrganization['name'] : $randomOrganization['_id'] ?>
          </div>
          <div class="row" >
            <img class="img-circle pull-left" width="50px" height="50px" src="<?php echo (isset($randomOrganization['imagePath'])) ? $randomOrganization['imagePath'] : 'http://placehold.it/50x50' ?>"/>
          </div>
          <hr>
          <div class="row">
            <?php echo (isset($randomOrganization['description'])) ? $randomOrganization['description'] : "no description" ?>
          </div>
          
        </div>  
      </div>
      </div>
    <div class="panel-footer "  >
      <a href="<?php echo (isset($randomOrganization['_id']) ? $Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.(string)$randomOrganization['_id']) : '#')?>">En savoir+ <i class="fa fa-angle-right"></i> </a>
    </div>
  </div>

  <script type="text/javascript">
  	var randomOrganization = <?php echo json_encode($randomOrganization) ?>;
  </script>