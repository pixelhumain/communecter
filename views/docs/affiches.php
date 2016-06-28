
 <div class="panel-heading center text-dark partition-white radius-10" >
    <span class="tpl_shortDesc">Communecter est système d'information territorial, au double facette<br/> une interface web classique et un Système d'information géographique riche</span>
</div>

<style type="text/css">
    ul li {list-style: none}
    .tpl_title{font-size: 48px;}
     .panel-title {font-size:25px;}
    .tpl_content img{width:33%; border:2px solid #ccc;}
</style>
<div class="col-sm-12 ">

    <div class="panel panel-white ">
        
        <div class="panel-body tpl_content">
         
            <div class="col-xs-12">
        	<?php 
                    if(file_exists ( "../../modules/communecter/assets/images/affiches" ))
                    {
                        $files = glob('../../modules/communecter/assets/images/affiches/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
                        foreach ($files as $key => $value)
                        {
                            $img = str_replace("../../modules/communecter/assets", Yii::app()->controller->module->assetsUrl, $value);
                            echo '<a class="thumb-info" href="'.$img.'"  data-lightbox="all">';
                                echo "<img src='".$img."'/>";
                            echo "</a>";
                        }
                    } 
                ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
      $(".moduleLabel").html( "<i class='fa fa-cube'></i> <span class='text-red'>MODULE</span> : Affiches</span>");
    });
</script>