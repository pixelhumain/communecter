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
		echo "Url(s) de référence(s) : <br/>";
		foreach ($survey["urls"] as $u) {
			echo "<a href='".$u."' target='_blank'>".$u."</a><br/>";
	 }} 
}?>

<div class="<?php echo ( @$position ) ? $position : "pull-left"; ?> margin-10">
	<?php

		$voteLinksAndInfos = Action::voteLinksAndInfos( true , $survey );

		if( $voteLinksAndInfos["hasVoted"] )
			echo "Thank you for voting."; 
		else
			echo "Feel Free to vote.";

		echo "<div style='font-size:2em;color:red;padding:5px;border:1px solid #666'>".$voteLinksAndInfos["links"]."</div><div class='space1'></div>";

		if( $voteLinksAndInfos["totalVote"] )
			echo "<br/>".$voteLinksAndInfos["totalVote"]." people voted."; 
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
		You are Following this vote. <i class='fa fa-rss' ></i>
	<?php } 
	} else {?>
		You created this vote.
		<br/>
		<?php if( Yii::app()->request->isAjaxRequest && false){ ?>
		<a class="btn btn-xs btn-default" onclick="entryDetail('<?php echo Yii::app()->createUrl("/communecter/survey/entry/id/".(string)$survey["_id"])?>','edit')" href="javascript:;">
			<i class='fa fa-pencil' ></i> Edit this Entry
		</a>
	<?php } ?>
<?php }} ?>

<?php /* ?>
<a class="btn btn-xs btn-default share-button" href="javascript:;"><i class='fa fa-share' ></i> Share </a>
*/?>

<br/>Views : <?php echo @$survey["viewCount"]; ?>

