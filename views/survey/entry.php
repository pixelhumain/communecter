<?php 
$regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
echo preg_replace_callback($regex, function ($matches) {
    return "<a target='_blank' href='{$matches[0]}'>{$matches[0]}</a>";
}, $survey["message"]);

?>
<br/><br/>
<?php if(isset( $survey["urls"])){
	echo "Url(s) de référence(s) : <br/>";
	foreach ($survey["urls"] as $u) {
		echo "<a href='".$u."' target='_blank'>".$u."</a><br/>";
 }} ?>
<br/>
<?php 
if(isset( Yii::app()->session["userId"])){
	if(Yii::app()->session["userEmail"] != $survey["email"]){
	if(!(isset($survey[Action::ACTION_FOLLOW]) 
	    && is_array($survey[Action::ACTION_FOLLOW]) 
	    && in_array(Yii::app()->session["userId"], $survey[Action::ACTION_FOLLOW]))) {
	    	?>
	<br/><a class="btn" href="javascript:addaction('<?php echo (string)$survey["_id"]?>','<?php echo Action::ACTION_FOLLOW ?>')"><i class='fa fa-rss' ></i> Suivre cette loi</a>
	<?php } else {?>
	<br/>Vous suivez actuellement cette loi. <i class='fa fa-rss' ></i>
	<?php } 
} else {?>
	<br/>Vous etes a l'origine de cette loi.
	<br/><a class="btn" onclick="entryDetail('<?php echo Yii::app()->createUrl("/pppm/default/entry/id/".(string)$survey["_id"])?>','edit')" href="javascript:;"><i class='fa fa-pencil' ></i> Editer votre loi</a>

<?php }} ?>

