<?php 
  if(! isset($randomOrganization)){ 
    $randomOrganization["name"] = "Il est temps d'alimenter son réseau !";
    $randomOrganization["description"] = "Trouvez des organisations partenaires !";
  }
?>
  <div class="panel panel-white">
    <div class="panel-heading border-light">
      <h4 class="panel-title text-blue">UNE ASSO AU HASARD </h4>
    </div>
    <div class="panel-body padding-20" id="orgaDetails">
      <i class='fa fa-spinner fa-pulse fa-4x center-block'></i>
      <!-- <div class="row">
        <div class="col-xs-6">
          <img class="img-responsive center-block" style="height:250px" src="<?php //echo (isset($randomOrganization['imagePath'])) ? $randomOrganization['imagePath'] : 'http://placehold.it/50x50' ?>"/>
        </div>
        <div class="col-xs-6">
          <div class="row center">
            <?php //echo (isset($randomOrganization['name'])) ? $randomOrganization['name'] : $randomOrganization['_id'] ?>
          </div>
          <div class="row" >
            <img class="img-circle pull-left" width="50px" height="50px" src="<?php //echo (isset($randomOrganization['imagePath'])) ? $randomOrganization['imagePath'] : 'http://placehold.it/50x50' ?>"/>
          </div>
          <hr>
          <div class="row">
            <?php //echo (isset($randomOrganization['description'])) ? $randomOrganization['description'] : "no description" ?>
          </div>
          
        </div>  
      </div> -->

    </div>
    <div class="panel-footer text-right"  >
      <a class="btn btn-default btn-sm" href="<?php echo (isset($randomOrganization['_id']) ? Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.(string)$randomOrganization['_id']) : '#')?>">
        En savoir <i class="fa fa-plus"></i> sur cette <?php echo $randomOrganization["type"]; ?></i>
      </a>
    </div>
  </div>

  <script type="text/javascript">
  	var randomOrganization = <?php echo json_encode($randomOrganization) ?>;
    console.log("rand orga : ", randomOrganization);

  jQuery(document).ready(function() {
    $.ajax({
        url: baseUrl+"/"+moduleId+"/organization/detail/id/"+randomOrganization._id.$id ,
        type: "POST",
        success: function(data){
          if(data != null){
            $("#orgaDetails").html(data);
          }else{
            toastr.error("random orga details not found");
          }
          
        },
      });
  });

  </script>