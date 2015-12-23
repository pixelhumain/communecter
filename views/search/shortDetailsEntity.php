<style>
    
    #profilImageRand{
      height:100%;
      width:100%;
      border-radius: 10px;
      /*border:3px solid #93C020;*/
      /*margin-bottom:10px;*/
    }
    .panel-green{
      background-image: linear-gradient(to bottom, #93C020 0px, #83AB1D 100%) !important;
    }
    .entityTitle{
      padding: 10px 20px;
      background-color: #EFEFEF; /*#2A3A45;*/
      color: #FFF;
      /*margin-left: -200px;*/
      margin-bottom: 10px;
      border-radius: 0px;
      margin-top: 0px;
      overflow-x: hidden; 
    }
    .entityTitle:hover{
      text-decoration: underline;
    }

    .entityDetails span{
      font-weight: 300;
      font-size:15px;
      text-overflow: ellipsis;
      max-width:100%;
    }
    .entityDetails{
      padding-bottom:10px;
      margin-bottom:10px;
      border-bottom:0px solid #DDD;

    }
    .entityDetails.bottom{
      /*border-top:1px solid #DDD;*/
      border-bottom:0px solid #DDD;
      padding: 5px;
      margin-top: 10px;
      margin-bottom: -13px;
    }
    .entityDetails i.fa-tag{
      margin-left:10px;
    }
    .lbl-tag{
      font-size:12px !important;
    }
    @media screen and (max-width: 1000px) {
      .entityDetails span{
        font-size: 1em;
      }
    }

    .corner-fa{
      left: -10px;
      font-size: 30px;
      position: absolute;
      color: #BABABA;
      top: 5px;
    }
</style>

<div class="panel panel-white no-margin">
   <!--  <div class="panel-heading border-light">
      <h4 class="panel-title text-blue"><i class="fa fa-random"></i> <?php //echo Yii::t("common", "HAPHAZARD"); ?></h4>
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
                                     "projects"=>"purple",
                                     "events"=>"orange");
            
            $entityTypeUrl = array("organizations"=>"organization", 
                                     "people"=>"person",
                                     "citoyens"=>"person",
                                     "projects"=>"project",
                                     "events"=>"event");
            $faIcon = "";
            $type = "";
            $color = "white";
            //var_dump($entity);
            //echo $entity["typeSig"];
            $name = isset($entity["username"]) ? $entity["username"] : "";
            if(isset($entity["name"])) $name = $name != "" ? $name : $entity["name"];
            if(isset($entity["typeSig"])){
              $type = $entity["typeSig"];
              $faIcon = isset($iconsEntityType[$type]) ? "<i class='fa fa-".$iconsEntityType[$type]."'></i> " : "";
              $color = isset($iconsEntityColor[$type]) ? $iconsEntityColor[$type] : "white";
            }
            
            $imgPath = "";
            if(isset($entity["profilImageUrl"]) && $entity["profilImageUrl"] != ""){
              $profilImageUrl = $entity["profilImageUrl"];
              $imgPath = Yii::app()->createUrl("/".$profilImageUrl);
            }
        ?>

        <?php 
          $url = ( isset($entity['_id']) ) ? "javascript:;" : '#';
          $onclick = (isset($entity['_id']) ) ? "onclick='loadByHash(\"#".$entityTypeUrl[$type].".detail.id.".$entity['_id']."\")'" : "";
        ?>
         
       <i class="fa fa-caret-left corner-fa"></i>
       <div class='col-md-12 no-padding bg-white'>
          <a href="<?php echo $url ?>" <?php echo $onclick ?> >
            <h3 class="panel-title entityTitle text-<?php echo $color; ?>">
              <?php echo $faIcon.$name; ?>
            </h3>
          </a>

         <div class='col-md-12'>
          <?php if(isset($entity["email"])){ ?>
              <span><i class="fa fa-envelope"></i> <?php echo $entity["email"]; ?></span></br>
            <?php } ?>
          </div>

          <?php if($imgPath != ""){ ?>
            <div class='col-lg-5 col-md-5 col-xs-12 col-sm-12 pull-left padding-15 center <?php if($imgPath == ""){ echo "panel-green"; } ?>'>
              <img id="profilImageRand" class="" src='<?php echo $imgPath; ?>'>
            </div> 
        
          <?php }else{ ?>
            <!-- <i class="fa fa-group fa-4x"></i> -->
          <?php } ?>


          <div class="col-lg-7 col-md-7 col-xs-12 col-sm-12 no-margin entityDetails text-dark padding-15" >            
            <?php if(isset($entity["telephone"])){ ?>
              <span><i class="fa fa-phone"></i> <?php echo $entity["telephone"]; ?></span></br>
            <?php } ?>
            <?php if(isset($entity["address"]["addressLocality"])){ ?>
              <span><i class="fa fa-home"></i> 
              <?php if(isset($entity["address"]["postalCode"])){ ?>
                <span><?php echo $entity["address"]["postalCode"]; ?></span>
              <?php } ?>
              <?php echo $entity["address"]["addressLocality"]; ?>
              </span></br>
            <?php } ?>
            
            <?php if(isset($entity["address"]["codeInsee"])){ ?>
              <span><i class="fa fa-bullseye"></i> Insee <?php echo $entity["address"]["codeInsee"]; ?></span></br>
            <?php } ?>  
            <?php if(isset($entity["links"]["members"])){ ?>
              <span class="pull-left col-md-12 no-padding">
                <i class="fa fa-link"></i> <?php echo count($entity["links"]["members"]); ?> membre(s)
              </span>
            <?php } ?>
          </div>

          <div class="entityDetails col-md-12">       
             <?php if(isset($entity["shortDescription"])){ ?>
              <div class="text-blue margin-top-15">
                <?php echo substr($entity["shortDescription"], 0, 200); echo (strlen($entity["shortDescription"])>200) ? " ..." : ""; ?>
              </div>
              <?php } if(isset($entity["description"])){ ?>
              <div class="text-dark margin-top-15">
                <?php echo substr($entity["description"], 0, 500); echo(strlen($entity["description"])>500) ? " ..." : ""; ?>
              </div>
              <?php } ?>
          </div>
   
          <div class="entityDetails pull-right  col-md-12 bottom text-dark padding-10 no-margin"> 
          <?php if(isset($entity["tags"])) { ?>
            <div class="pull-right col-md-12 no-padding" style="margin-top:5px;">
              <?php $total=0; 
              foreach ($entity["tags"] as $tag) { $total++;
                  if($total<8){
              ?>
              <span class="pull-right text-red lbl-tag"><i class="fa fa-tag"></i> <?php echo $tag; ?></span>
              <?php }} ?>
            </div>
          <?php } ?>
          </div>
          
      </div>
    </div>
    <div class="panel-footer text-right">
      <a class="btn btn-default btn-sm" href="<?php echo $url ?>" <?php echo $onclick ?> >
        En savoir <i class="fa fa-plus"></i>
      </a>
    </div>
  </div>