
<style type="text/css">
.container-tool-vote{
	font-size:1.5em;
	font-weight: 300;
	/*color:red;*/
	padding:5px;
	/*border:1px solid rgb(206, 206, 206); 
	border-radius:50px;
	moz-box-shadow: 0px 3px 5px -2px #656565;
	-webkit-box-shadow: 0px 3px 5px -2px #656565;
	-o-box-shadow: 0px 3px 5px -2px #656565;
	box-shadow: 0px 3px 5px -2px #656565;
	filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);*/
}
.voteInfoBox{
	border-radius: 10px;
	font-weight: 300;
}
</style>

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
	
		if(!isset($voteLinksAndInfos)){
			$logguedAndValid = Person::logguedAndValid();
			$voteLinksAndInfos = Action::voteLinksAndInfos( $logguedAndValid , $survey );
		}
		
		$room = ActionRoom::getById($survey["survey"]);
		$canParticipate = Authorisation::canParticipate(Yii::app()->session['userId'],$room["parentType"],$room["parentId"]);

		//echo "<span class='msg-head-tool-vote'>";
		//if( $voteLinksAndInfos["hasVoted"] )
		//	echo Yii::t("rooms","Thank you for voting",null,Yii::app()->controller->module->id); 
		//else
		//	echo Yii::t("rooms","Feel Free to vote",null,Yii::app()->controller->module->id);
		//echo "</span>";
		if( $canParticipate && !$voteLinksAndInfos["hasVoted"] ) 
			$contentVote = $voteLinksAndInfos["links"]; 
		else if($canParticipate){
			$ctrl = Element::getControlerByCollection($room["parentType"]);
			$contentVote = $voteLinksAndInfos["links"]; 	
		}
		else{
			$ctrl = Element::getControlerByCollection($room["parentType"]);
			$contentVote = '<a href="javascript:;" class="btn btn-danger text-bold" onclick="loadByHash(\'#'.$ctrl.'.detail.id.'.$room["parentId"].'\')">'.Yii::t("rooms","You must login or join to vote",null,Yii::app()->controller->module->id).'<i class="fa fa-arrow-right-circle"></i></a>';
		}
		
		echo "<div class='container-tool-vote text-dark'>".$contentVote."</div>".
			"<div class='space1 voteInfoBox text-white bg-dark text-large'></div>";

		//	echo $voteLinksAndInfos["hasVoted"] ? "true" :"false";
		//if( $voteLinksAndInfos["totalVote"] )
			//echo "<br/>".$voteLinksAndInfos["totalVote"]." ".Yii::t("rooms","people voted",null,Yii::app()->controller->module->id); 
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
		    && in_array(Yii::app()->session["userId"], $survey[Action::ACTION_FOLLOW]))) 
		{
?>
		<br/>
		<?php /* ?>
		<a class="btn btn-xs btn-default" href="#" onclick="addaction('<?php echo (string)$survey["_id"]?>','<?php echo Action::ACTION_FOLLOW ?>')">
			<i class='fa fa-rss' ></i> Follow 
		</a>
		*/ ?>
	<?php } else {?>
		<br/>
		<?php echo Yii::t("rooms","You are Following this vote.",null,Yii::app()->controller->module->id) ?> <i class='fa fa-rss' ></i>
	<?php } 
	} else {?>
		<?php echo Yii::t("rooms","You created this vote.",null,Yii::app()->controller->module->id) ?>
		<br/>
		<?php if( Yii::app()->request->isAjaxRequest && false){ ?>
		<a class="btn btn-xs btn-default" onclick="entryDetail('<?php echo Yii::app()->createUrl("/communecter/survey/entry/id/".(string)$survey["_id"])?>','edit')" href="javascript:;">
			<i class='fa fa-pencil' ></i> <?php echo Yii::t("rooms","Edit this Entry",null,Yii::app()->controller->module->id) ?>
		</a>
	<?php } ?>
<?php }} ?>

<?php /* ?>
<a class="btn btn-xs btn-default share-button" href="javascript:;"><i class='fa fa-share' ></i> Share </a>



<br/>Views : <?php echo @$survey["viewCount"]; ?>
*/?>


<script type="text/javascript">

jQuery(document).ready(function() 
{
	$(".moduleLabel").html('<?php echo Yii::t("common","VOTE DECIDE ACT") ?>');
	$('.voteIcon').off().on("click",function() { 
		$(this).addClass("faa-bounce animated");
		clickedVoteObject = $(this).data("vote");
		console.log(clickedVoteObject);
	 });
	$(".voteUp").off().on( "mouseover",function() { $(".voteInfoBox").html("Voter Pour : Si vous etes d'accord avec la proposition"); });
	$(".voteUnclear").off().on( "mouseover",function() { $(".voteInfoBox").html("Voter Amender : La base est bonne mais il faut encore corriger, améliorer, la rendre meilleure"); });
	$(".voteAbstain").off().on( "mouseover",function() { $(".voteInfoBox").html("Voter Blanc : Si Vous ne souhaitez pas vous engagé, ni pour ni contre"); });
	$(".voteMoreInfo").off().on( "mouseover",function() { $(".voteInfoBox").html("Voter plus d'information : il manque des elements pour prendre une réélle décision"); });
	$(".voteDown").off().on( "mouseover",function() { $(".voteInfoBox").html("Voter Contre : Si vous etes pas d'accord avec la proposition"); });
	$(".voteinfoSection,.citizenAssembly-header ").off().on("mouseover",function() { $(".voteInfoBox").html(""); });
});

</script>