<style>
    
</style>

  <div class="panel panel-white">
   <!--  <div class="panel-heading border-light">
      <h4 class="panel-title text-blue"><i class="fa fa-random"></i> <?php echo Yii::t("common", "HAPHAZARD"); ?></h4>
    </div> -->
    <div class="panel-body no-padding" class="entityShortDetails">
      <!-- <i class='fa fa-spinner fa-pulse fa-4x center-block'></i> -->
      
        <?php 
            $iconsEntityType = array("organizations"=>"group", 
                                     "people"=>"user",
                                     "citoyens"=>"user",
                                     "projects"=>"lightbulb-o",
                                     "events"=>"calendar");

            $iconsEntityColor = array("organizations"=>"green", 
                                     "people"=>"yellow",
                                     "citoyens"=>"yellow",
                                     "projects"=>"orange",
                                     "events"=>"purple");
            
            $entityTypeUrl = array("organizations"=>"organization", 
                                     "people"=>"person",
                                     "citoyens"=>"person",
                                     "projects"=>"project",
                                     "events"=>"event");
            $faIcon = "";
            $type = "";
            $color = "white";
            //echo $randomEntity["typeSig"];
            $name = isset($randomEntity["name"]) ? $randomEntity["name"] : "";
            if(isset($randomEntity["typeSig"])){
              $type = $randomEntity["typeSig"];
              $faIcon = isset($iconsEntityType[$type]) ? "<i class='fa fa-".$iconsEntityType[$type]."'></i> " : "";
              $color = isset($iconsEntityColor[$type]) ? $iconsEntityColor[$type] : "white";
            }
            
            $imgPath = "";
            if(isset($randomEntity["profilImageUrl"]) && $randomEntity["profilImageUrl"] != "")
            $imgPath = Yii::app()->createUrl('/'.$this->module->id).$randomEntity["profilImageUrl"];
        ?>

          <?php if($imgPath != ""){ ?>
            <div class='col-lg-12 col-md-12 col-xs-12 col-sm-12 pull-left no-padding center <?php if($imgPath == ""){ echo "panel-green"; } ?>'>
              <img id="profilImageRand" src='<?php echo $imgPath; ?>'>
            </div> 
        
          <?php }else{ ?>
            <!-- <i class="fa fa-group fa-4x"></i> -->
          <?php } ?>
       <div class='col-md-12 pull-left no-padding'>
          <h3 class="panel-title entityTitle text-<?php echo $color; ?>" style=" <?php //if($imgPath == ""){ echo "margin-top:0px !important;"; } ?>"><?php echo $faIcon/*." ".Yii::t("common", $type)." : "*/.$name; ?></h3>
          <div class="entityDetails text-dark padding-15" >
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
          
          <?php if(isset($randomEntity["shortDescription"])){ ?>
          <div class="text-blue margin-top-15">
            <?php echo substr($randomEntity["shortDescription"], 0, 100); echo (strlen($randomEntity["shortDescription"])>300) ? " ..." : ""; ?>
          </div>
          <?php } else if(isset($randomEntity["description"])){ ?>
          <div class="text-blue margin-top-15">
            <?php echo substr($randomEntity["description"], 0, 100); echo(strlen($randomEntity["description"])>300) ? " ..." : ""; ?>
          </div>
          <?php } ?>
          </div>

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
          <div class="entityDetails bottom col-md-12 text-dark padding-10 no-margin">
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
      $onclick = (isset($randomEntity['_id']) ) ? "onclick='loadByHash(\"#".$entityTypeUrl[$type].".detail.id.".$randomEntity['_id']."\")'" : "";
    ?>
      <a class="btn btn-default btn-sm" href="<?php echo $url ?>" <?php echo $onclick ?> >
        En savoir <i class="fa fa-plus"></i>
      </a>
    </div>
  </div>

  <script type="text/javascript">
  	

  </script>