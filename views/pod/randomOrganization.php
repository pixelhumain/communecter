<style>
    #profilImageRand{
      max-height:300px;
      max-width:100%;
      border-radius: 3px;
      /*border:3px solid #93C020;*/
      /*margin-bottom:10px;*/
    }
    .panel-green{
      background-image: linear-gradient(to bottom, #93C020 0px, #83AB1D 100%) !important;
    }
    .entityTitle{
      padding: 10px 20px;
      background-color: #2A3A45;
      color: #FFF;
      margin-left: -200px;
      margin-bottom: 10px;
      border-radius: 3px;
      margin-top: 15px;
    }
    .entityDetails span{
      font-weight: 300;
      font-size:15px;

    }
    .entityDetails{
      padding-bottom:10px;
      margin-bottom:10px;
      border-bottom:1px solid #DDD;

    }
    .entityDetails.bottom{
      /*border-top:1px solid #DDD;*/
      border-bottom:0px solid #DDD;
      padding: 5px;
      margin-top: 10px;
      margin-bottom: -13px;
    }
    @media screen and (max-width: 1000px) {
        .entityTitle{
          margin-left: 0px;
        }
      }
</style>

  <div class="panel panel-white">
    <div class="panel-heading border-light">
      <h4 class="panel-title text-blue"><i class="fa fa-random"></i> <?php echo Yii::t("common", "HAPHAZARD"); ?></h4>
    </div>
    <div class="panel-body" id="orgaDetails">
      <!-- <i class='fa fa-spinner fa-pulse fa-4x center-block'></i> -->
      
        <?php 
            $iconsEntityType = array("organizations"=>"group", 
                                     "people"=>"user",
                                     "projects"=>"lightbulb-o",
                                     "events"=>"calendar");
            $faIcon = "";
            $type = "";
            $name = isset($randomEntity["name"]) ? $randomEntity["name"] : "";
            if(isset($randomEntity["typeSig"])){
              $type = $randomEntity["typeSig"];
              $faIcon = isset($iconsEntityType[$type]) ? "<i class='fa fa-".$iconsEntityType[$type]."'></i> " : "";
            }
            
            $imgPath = "";
            if(isset($randomEntity["profilImageUrl"]) && $randomEntity["profilImageUrl"] != "")
            $imgPath = Yii::app()->createUrl('/'.$this->module->id).$randomEntity["profilImageUrl"];
        ?>

        <div class='col-md-8 col-xs-12 col-sm-12 pull-left no-padding <?php if($imgPath == ""){ echo "panel-green"; } ?>'>
          <?php if($imgPath != ""){ ?>
            <img id="profilImageRand" src='<?php echo $imgPath; ?>'>
          <?php }else{ ?>
            <i class="fa fa-group fa-4x"></i>
          <?php } ?>
        </div> 
        <div class='col-md-4 pull-left'>
          <h3 class="panel-title entityTitle"><?php echo $faIcon." ".Yii::t("common", $type)." : ".$name; ?></h3>
          <div class="entityDetails text-dark">
            <?php if(isset($randomEntity["email"])){ ?>
              <span><i class="fa fa-envelope"></i> <?php echo $randomEntity["email"]; ?></span></br>
            <?php } ?>
            <?php if(isset($randomEntity["telephone"])){ ?>
              <span><i class="fa fa-phone"></i> <?php echo $randomEntity["telephone"]; ?></span></br>
            <?php } ?>
            <?php if(isset($randomEntity["address"]["addressLocality"])){ ?>
              <span><i class="fa fa-home"></i> 
              <?php if(isset($randomEntity["address"]["postalCode"])){ ?>
                <span><?php echo $randomEntity["address"]["postalCode"]; ?></span>
              <?php } ?>
              <?php echo $randomEntity["address"]["addressLocality"]; ?></span></br>
            <?php } ?>
            
            <?php if(isset($randomEntity["address"]["codeInsee"])){ ?>
              <span><i class="fa fa-bullseye"></i> Insee <?php echo $randomEntity["address"]["codeInsee"]; ?></span></br>
            <?php } ?>  
          </div>

          <?php if(isset($randomEntity["shortDescription"])){ ?>
              <span>
                <?php echo substr($randomEntity["shortDescription"], 0, 100); echo (strlen($randomEntity["shortDescription"])>300) ? " ..." : ""; ?>
              </span>
              <?php } else if(isset($randomEntity["description"])){ ?>
              <span>
                <?php echo substr($randomEntity["description"], 0, 100); echo(strlen($randomEntity["description"])>300) ? " ..." : ""; ?>
              </span>
              <?php } ?>
        </div>
        
       <!--  <?php if(isset($randomEntity["shortDescription"])){ ?>
        <div class='col-md-12 col-lg-8 pull-left text-dark'>
          <h4 class="bold"><i class="fa fa-info-circle"></i> Who are we ?</h4>
          <?php echo substr($randomEntity["shortDescription"], 0, 300); echo (strlen($randomEntity["shortDescription"])>300) ? " ..." : ""; ?>
        </div>
        <?php } else if(isset($randomEntity["description"])){ ?>
        <div class='col-md-12 col-lg-8 pull-left text-dark'>
          <h4 class="bold"><i class="fa fa-info-circle"></i> Who are we ?</h4>
          <?php echo substr($randomEntity["description"], 0, 300); echo(strlen($randomEntity["description"])>300) ? " ..." : ""; ?>
        </div>
        <?php } ?> -->

          <?php if(isset($randomEntity["links"]["members"])){ ?>
          <div class="entityDetails bottom col-md-12 pull-left text-dark">
            <span class="pull-left col-md-6 no-padding"><i class="fa fa-link"></i> <?php echo count($randomEntity["links"]["members"]); ?> membre(s)</span>
            <?php if(isset($randomEntity["tags"])) { ?>
            <span class="pull-right col-md-6 no-padding">
              <?php foreach ($randomEntity["tags"] as $tag) { ?>
              <span class="pull-right text-red"><i class="fa fa-tag"></i> <?php echo $tag; ?></span>
            </span>
            <?php }} ?>

          </div>
          <?php } ?>
    </div>
    <div class="panel-footer text-right"  >
    <?php 
      $url = ( isset($randomEntity['_id']) ) ? "javascript:;" : '#';
      $onclick = (isset($randomEntity['_id']) ) ? "onclick='loadByHash(\"#organization.detail.id.".$randomEntity['_id']."\")'" : "";
    ?>
      <a class="btn btn-default btn-sm" href="<?php echo $url ?>" <?php echo $onclick ?> >
        En savoir <i class="fa fa-plus"></i>
      </a>
    </div>
  </div>

  <script type="text/javascript">
  	

  </script>