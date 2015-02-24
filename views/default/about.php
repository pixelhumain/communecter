<?php 
echo "lang : ".Yii::app()->language."</br>";
echo Yii::t("organisation","test",null,$this->module->id)."</br>";
echo Yii::t("organisation","tester")."</br>";
?>
<img src="<?php echo $this->module->assetsUrl?>/images/about.jpg">
<br/><br/>
