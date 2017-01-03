
<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page"=>"power"
                            ) ); 
?>
<script>
jQuery(document).ready(function() {
    initKInterface();
    location.hash = "#co2.power";
});
</script>