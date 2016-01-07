<?php
if( !isset($hideTexts) )
{
	if( @$survey["message"] || @$showName )
	{
	?>
	<blockquote style="border-left: 5px solid #E33551;">
		<?php 
		if(@$showName){
		 ?>
		<span class="text-extra-large text-bold text-red"> 
		<?php echo $survey["name"]; ?>
		</span>
		<?php } ?>
		<p>
		<?php
			$regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
			echo preg_replace_callback($regex, function ($matches) {
			    return "<a target='_blank' href='{$matches[0]}'>{$matches[0]}</a>";
			}, $survey["message"]);
		?>
		</p>
	</blockquote>
<?php } 
}
?>

<br/>
<?php 
if( !isset($hideTexts) )
{
	if( isset( $survey["urls"]) && count( $survey["urls"] )  ){
		echo "Url(s) : <br/>";
		foreach ($survey["urls"] as $u) {
			echo "<a href='".$u."' target='_blank'>".$u."</a><br/>";
	 }} 
}?>

<div class="<?php echo ( @$position ) ? $position : "pull-left"; ?> margin-10">
	<?php

		$voteLinksAndInfos = Action::voteLinksAndInfos( true , $survey );

		if( $voteLinksAndInfos["hasVoted"] )
			echo Yii::t("survey","Thank you for voting",null,Yii::app()->controller->module->id); 
		else
			echo Yii::t("survey","Feel Free to vote",null,Yii::app()->controller->module->id);

		echo "<div style='font-size:2em;color:red;padding:5px;border:1px solid #666'>".$voteLinksAndInfos["links"]."</div><div class='space1'></div>";

		if( $voteLinksAndInfos["totalVote"] )
			echo "<br/>".$voteLinksAndInfos["totalVote"]." ".Yii::t("survey","people voted",null,Yii::app()->controller->module->id); 
	 ?>
</div>

<div class="space10"></div>

<?php 
if(isset( Yii::app()->session["userId"]) )
{
	if(Yii::app()->session["userEmail"] != $survey["email"])
	{
		if(!(isset($survey[Action::ACTION_FOLLOW]) 
		    && is_array($survey[Action::ACTION_FOLLOW]) 
		    && in_array(Yii::app()->session["userId"], $survey[Action::ACTION_FOLLOW]))) {
?>
		<br/>
		<?php /* ?>
		<a class="btn btn-xs btn-default" href="#" onclick="addaction('<?php echo (string)$survey["_id"]?>','<?php echo Action::ACTION_FOLLOW ?>')">
			<i class='fa fa-rss' ></i> Follow 
		</a>
		*/ ?>
	<?php } else {?>
		<br/>
		<?php echo Yii::t("survey","You are Following this vote.",null,Yii::app()->controller->module->id) ?> <i class='fa fa-rss' ></i>
	<?php } 
	} else {?>
		<?php echo Yii::t("survey","You created this vote.",null,Yii::app()->controller->module->id) ?>
		<br/>
		<?php if( Yii::app()->request->isAjaxRequest && false){ ?>
		<a class="btn btn-xs btn-default" onclick="entryDetail('<?php echo Yii::app()->createUrl("/communecter/survey/entry/id/".(string)$survey["_id"])?>','edit')" href="javascript:;">
			<i class='fa fa-pencil' ></i> <?php echo Yii::t("survey","Edit this Entry",null,Yii::app()->controller->module->id) ?>
		</a>
	<?php } ?>
<?php }} ?>

<?php /* ?>
<a class="btn btn-xs btn-default share-button" href="javascript:;"><i class='fa fa-share' ></i> Share </a>



<br/>Views : <?php echo @$survey["viewCount"]; ?>
*/?>
