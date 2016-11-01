
 <div class="panel-heading center text-dark partition-white radius-10" >
    <span class="tpl_shortDesc hidden">Communecter est système d'information territorial, au double facette<br/> une interface web classique et un Système d'information géographique riche</span>
</div>

<style type="text/css">
    ul li {list-style: none}
    .tpl_title{font-size: 48px;}
     .panel-title {font-size:25px;}
    .tpl_content img{width:33%; border:2px solid #ccc;margin-bottom: 5px;}
</style>
<div class="col-sm-12 tpl_content">

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

<script type="text/javascript">
    jQuery(document).ready(function() {
      setTitle("<span class='text-red'>MODULE</span> : Affiches</span>","cube","MODULE : Affiches");
    });
</script>