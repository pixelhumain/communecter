<div class="portfolio-modal modal fade" id="modal-create-anc" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                <?php if(Yii::app()->params["CO2DomainName"] == "CO2"){ ?>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/CO2r.png" height="100" class="inline margin-bottom-15"><br>
                 <?php }else if(Yii::app()->params["CO2DomainName"] == "kgougle"){ ?>
                     <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="50" class="inline margin-top-25 margin-bottom-5"><br>
                 <?php } ?>

                    <h3 class="letter-red no-margin hidden">
                        <small class="text-dark">Un espace de <span class="letter-red">communication local</span>, au service du <span class="letter-red">bien commun</span></small>
                    </h3><br>
                    <h3 class="letter-red no-margin hidden-xs">
                        <i class="fa fa-plus-circle"></i> Publier une annonce<br>
                    </h3><br>
                    <!-- <button class="btn btn-default margin-bottom-5 margin-left-5 btn-select-type-anc" style="width:40%; margin-left:30%;"  
                            data-type-anc="cassifieds">
                        <i class="fa fa-credit-card hidden-xs"></i> Annonce sponsorisée
                    </button> -->
                </div>               
            </div>
            <div class="row links-create-element">
                <div class="col-lg-12">
                    <div class="modal-header text-dark ">
                        
                    </div>
                    
                    <div id="" class="modal-body text-center">
                        
                        <div class="col-md-12 col-sm-12" id="sub-menu-left">
                            <h4 class="text-dark no-margin hidden-xs">
                                <i class="fa fa-angle-down"></i> Sélectionnez un type d'annonce<br><br>
                            </h4>
                            <div class="col-md-2 padding-5"></div>
                            <div class="col-md-2 text-center padding-5">
                            <?php 
                                    $freedomTags = CO2::getFreedomTags();
                                    $currentSection = 1;
                                    $align="right";
                                    foreach ($freedomTags as $key => $tag) { ?>
                                        <?php if($currentSection > 1){ ?>
                                            <?php if($tag["section"] > $currentSection){ 
                                                    $currentSection++; 
                                                    $align = "center"; //$align=="left"?"left":"left";
                                            ?>
                                            </div>
                                            <div class="col-md-2 text-<?php echo $align; ?> padding-5">
                                            <?php } ?>
                                            <button class="btn btn-default margin-bottom-5 margin-left-5 btn-select-type-anc btn-anc-color-<?php echo @$tag["color"]; ?>" style="width:100%;"  
                                                    data-type-anc="<?php echo @$tag["key"]; ?>">
                                                <i class="fa fa-<?php echo @$tag["icon"]; ?> hidden-xs"></i> <?php echo @$tag["label"]; ?>
                                            </button><br>
                                        
                                        <?php   }else{ $currentSection++; } ?>
                            <?php   } ?>
                            </div>
                            
                           <br>
                           <div class="col-md-12 col-sm-12 ">
                           <hr>
                           </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 subsub text-center" id="sub-menu-left">
                            <h4 class="text-dark no-margin hidden-xs">
                                <i class="fa fa-angle-down"></i> Sélectionnez une catégorie<br><br>
                            </h4>
                            <div class="col-md-2 text-<?php $align="left"; echo $align; ?> padding-5 hidden">
                            <?php $categories = CO2::getAnnounceCategories();
                                  foreach ($categories as $key => $cat) {
                            ?>
                                    <?php if(is_array($cat)) { ?>
                                        </div>
                                        <div class="col-md-2 text-<?php echo $align; ?> padding-5">
                                        <button class="btn btn-default text-dark margin-bottom-5 btn-select-category-1 uppercase" style="width:100%;" 
                                                data-keycat="<?php echo $key; ?>">
                                            <i class="fa fa-chevron-circle-down hidden-xs"></i> <?php echo $key; ?>
                                        </button> 
                                    <?php } ?>
                                
                            <?php } ?>
                            </div>

                            <div class="col-md-12 col-sm-12 text-center">
                                <hr style="margin:10px;">
                                <?php $categories = CO2::getAnnounceCategories();
                                      foreach ($categories as $key => $cat) {
                                ?>
                                        <?php if(is_array($cat)) { ?>
                                            <?php foreach ($cat as $key2 => $cat2) { ?>
                                                <button class="btn btn-default text-dark margin-bottom-5 hidden  text-center keycat keycat-<?php echo $key; ?>">
                                                    <?php echo $cat2; ?>
                                                </button><br class="hidden">
                                            <?php } ?>
                                        <?php } ?>
                                    
                                <?php } ?>
                                <div class="col-md-12 col-sm-12 text-center margin-top-25">
                                    <h4 class="text-dark no-margin hidden-xs">
                                        <i class="fa fa-money"></i> Prix<br><br>
                                    </h4>
                                    <input class="input-control" placeholder="prix">
                                </div>
                                <hr>
                            </div>
                        </div>


                        </div>
                        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 margin-top-25">
                            
                        </div>

                        <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 margin-top-25">
                            <h4 class="text-dark no-margin hidden-xs">
                                <i class="fa fa-pencil"></i> Rédiger votre annonce<br><br>
                            </h4>
                            <div id="formCreateNews"></div>    
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <hr>
                            <h5 class="text-center letter-red">
                                <button class="btn btn-default main-btn-scopes text-white tooltips margin-bottom-5" 
                                    data-target="#modalScopes" data-toggle="modal"
                                    data-toggle="tooltip" data-placement="top" 
                                                        title="Sélectionner des lieux de recherche">
                                    <!-- <i class="fa fa-bullseye" style="font-size:18px;"></i> -->
                                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=42>
                                </button><br>
                                Cibler votre annonce
                            </h5>
                            
                            <div class="scope-min-header list_tags_scopes hidden-xs hidden-sm"></div>
                            <hr>
                            <button class="btn btn-success"><i class="fa fa-check-circle"></i> Publier votre annonce</button>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <hr>
                            <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #modal-create-anc #sub-menu-left.subsub .btn,
    #modal-create-anc .btn-select-category-1{
        width:16%;
        border-radius:40px;
        border:1px solid lightgrey;
        text-align: center;
    }

    .portfolio-modal .modal-content img{
        margin-bottom: unset;
    }
</style>