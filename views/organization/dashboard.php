<?php
/*$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/weather-icons/css/weather-icons.min.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-progressbar/bootstrap-progressbar.min.js' , CClientScript::POS_END);
*/
?>
<!-- start: PAGE CONTENT -->
<div class="row">

  <div class="col-sm-7 col-xs-12">
    <?php 
    $this->renderPartial('dashboard/about',array( "organization" => $organization));
    ?>
  </div>

  <div class="col-sm-5 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">AGENDA PARTAGEE </h4>
      </div>
      <div class="panel-body no-padding center"  >
        <img class="img-responsive center-block" style="height:250px" src="http://placehold.it/350x150"/>
      </div>
      <div class="panel-footer "  >
        <a href="">En savoir+ <i class="fa fa-angle-right"></i> </a>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-sm-7 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">ANNUAIRE DU RESEAU </h4>
      </div>
      <div class="panel-body no-padding center">
        <img class="img-responsive center-block"style="height:250px" src="http://placehold.it/350x150"/>
      </div>
      <div class="panel-footer center"   >
        <a href="">TROUVER PAR THEME</a>
      </div>
    </div>
  </div>

  <div class="col-sm-5 col-xs-12">
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
              ASSOCIATION 1
            </div>
            <div class="row" >
              <img class="img-circle pull-left" src="http://placehold.it/50x50"/>
            </div>
            <hr>
            <div class="row">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde iste voluptates magni, doloribus officia aperiam provident nihil repudiandae perspiciatis in expedita cumque et, qui perferendis ex facilis eveniet quae laudantium.
            </div>
            
          </div>  
        </div>
        
      </div>
      <div class="panel-footer "  >
        <a href="">En savoir+ <i class="fa fa-angle-right"></i> </a>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-sm-10 col-xs-12">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">LETTRE D'INFORMATION </h4>
      </div>
      <div class="panel-body no-padding ">
          <img class="pull-left" class="img-responsive center-block" style="height:120px" src="http://placehold.it/100x120"/>
          <div class="padding-10">
            ASSOCIATION ACTU
            <br/>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus, earum, debitis. Consectetur inventore quaerat aperiam nihil minima, vitae laudantium, ut animi illum blanditiis cum earum, fugiat nisi ipsam dolore possimus.
            <br/>
            <a href="" class="btn btn-success">DERNIER N°</a> <a href="" class="btn btn-success">JE M'INSCRIS</a>
          </div>
      </div>
    </div>
  </div>

  <div class="col-sm-2 col-xs-12">
    <div class="panel panel-blue">
      <div class="panel-heading border-light center">
          <i class="fa fa-check-circle fa-3x"></i>
      </div>
      <div class="panel-body no-padding center" style="max-height:120px" >
        <h4 class="text-bold">J'ADHERE </h4>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
      </div>
    </div>
  </div>

</div>
<!-- end: PAGE CONTENT-->
<script>
  jQuery(document).ready(function() {
   
  });

</script>