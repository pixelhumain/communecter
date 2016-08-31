
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
	border-radius: 5px;
	font-weight: 300;
	padding:6px;
}

.col-tool-vote {
    margin-bottom: 10px;
    height: 180px;
	border-radius: 6px;
	font-size: 15px;
	padding: 0px;
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
		else if(!isset( Yii::app()->session["userId"]) ){
			$ctrl = Element::getControlerByCollection($room["parentType"]);
			$contentVote = '<a href="javascript:;" class="btn btn-success" onclick="showPanel(\'box-login\');"><i class="fa fa-sign-in"></i> '.Yii::t("rooms","LOGIN TO VOTE",null,Yii::app()->controller->module->id).'</a>';
		}
		else{
			if( $room["parentType"] == City::COLLECTION  )
				$contentVote = Yii::t('rooms', 'Participation open to city residents only', null, Yii::app()->controller->module->id);
			else {
				$ctrl = Element::getControlerByCollection($room["parentType"]);
				$contentVote = '<a href="#'.$ctrl.'.detail.id.'.$room["parentId"].'" class="btn btn-success lbh"><i class="fa fa-sign-in"></i> '.Yii::t("rooms","JOIN TO VOTE",null,Yii::app()->controller->module->id).'</a>';
			}
		}
		
		echo "<div class='container-tool-vote text-dark'>";

		if( !$voteLinksAndInfos["hasVoted"] ) 
		echo 	"<h1 class='text-red homestead margin-bottom-10'><i class='fa fa-angle-down'></i> Voter</h1>";

		echo	$contentVote."</div>";
			 
		if( !$voteLinksAndInfos["hasVoted"] ) 
		echo "<div class='space1 voteInfoBox text-white bg-dark'></div>";

		//	echo $voteLinksAndInfos["hasVoted"] ? "true" :"false";
		//if( $voteLinksAndInfos["totalVote"] )
			//echo "<br/>".$voteLinksAndInfos["totalVote"]." ".Yii::t("rooms","people voted",null,Yii::app()->controller->module->id); 
	 ?>

</div>




<script type="text/javascript">

jQuery(document).ready(function() 
{
	setTitle("<?php echo Yii::t("common","VOTE DECIDE ACT") ?>","");
	$('.voteIcon').off().on("click",function() { 
		$(this).addClass("faa-bounce animated");
		clickedVoteObject = $(this).data("vote");
		console.log(clickedVoteObject);
	 });
	$(".voteUp").off().on( "mouseover",function() { $(".voteInfoBox").html("<strong>Pour</strong><br>Je suis d'accord avec la proposition"); });
	$(".voteUnclear").off().on( "mouseover",function() { $(".voteInfoBox").html("<strong>Amender</strong><br>Je souhaite que la proposition soit complétée"); });
	$(".voteAbstain").off().on( "mouseover",function() { $(".voteInfoBox").html("<strong>Blanc</strong><br>Je ne souhaite pas me prononcer"); });
	$(".voteMoreInfo").off().on( "mouseover",function() { $(".voteInfoBox").html("<strong>Plus d'informations</strong><br>Je manque d'informations pour prendre votre décision"); });
	$(".voteDown").off().on( "mouseover",function() { $(".voteInfoBox").html("<strong>Contre</strong><br>Je ne suis pas d'accord avec la proposition"); });
	$(".voteIcon").on("mouseout",function() { $(".voteInfoBox").html(""); $(".voteInfoBox").hide(); });
	$(".voteIcon").on("mouseover",function() { $(".voteInfoBox").show(); });
});

</script>