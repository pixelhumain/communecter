<?php 
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->getModule('githubs')->assetsUrl."/jquerymobile-editablelistview/css/jquery.mobile.css");
$cs->registerCssFile(Yii::app()->getModule('githubs')->assetsUrl."/jquerymobile-editablelistview/css/editable-listview.css");
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/jquerymobile-editablelistview/js/jquery-2.1.1.js" , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/jquerymobile-editablelistview/js/jquery.mobile.js" , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/jquerymobile-editablelistview/js/collapsible-patched.js" , CClientScript::POS_HEAD);
$cs->registerScriptFile(Yii::app()->getModule('githubs')->assetsUrl."/jquerymobile-editablelistview/js/editable-listview.js" , CClientScript::POS_HEAD);
?>

<ul data-role="listview" data-editable="true" data-editable-type="complex" data-editable-form="editing-form" data-title="Fruits" data-empty-title="No Fruits">
<li>
    <a>
        <h3>Apple</h3>
        <p><em>Shape:</em> <strong>round</strong></p>
        <p><em>Color:</em> <strong>red</strong></p>
    </a>
</li>
<li>
    <a>
        <h3>Pineapple</h3>
        <p><em>Shape:</em> <strong>oval</strong></p>
        <p><em>Color:</em> <strong>yellow</strong></p>
    </a>
</li>
<li>
    <a>
        <h3>Orange</h3>
        <p><em>Shape:</em> <strong>round</strong></p>
        <p><em>Color:</em> <strong>orange</strong></p>
    </a>
</li>
</ul>
