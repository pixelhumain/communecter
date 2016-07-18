<?php 
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->getModule('githubs')->assetsUrl."/bootstrap-wysihtml5/lib/css/bootstrap.min.css");
$cs->registerCssFile(Yii::app()->getModule('githubs')->assetsUrl."/bootstrap-wysihtml5/src/bootstrap-wysihtml5.css");
$cs->registerCssFile(Yii::app()->getModule('githubs')->assetsUrl."/bootstrap-wysihtml5/lib/css/wysiwyg-color.css");
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.js" , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/bootstrap-wysihtml5/lib/js/jquery-1.7.2.min.js" , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/bootstrap-wysihtml5/lib/js/bootstrap.min.js" , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/bootstrap-wysihtml5/src/bootstrap-wysihtml5.js" , CClientScript::POS_HEAD);
?>
<input type="text" value="" name="title" id="title">
<textarea class="textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>

<script>
	$('.textarea').wysihtml5();
</script>