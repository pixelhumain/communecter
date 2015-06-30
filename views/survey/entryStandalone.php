<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery-validation/dist/jquery.validate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);

//Data helper
$cs->registerScriptFile($this->module->assetsUrl. '/js/dataHelpers.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/okvideo/okvideo.min.js' , CClientScript::POS_END);

?>
<style type="text/css">

  a.btn{margin:3px;}

  /*.infolink{border-top:1px solid #fff}*/
  .leftlinks a.btn{color:black;background-color: yellow;border: 1px solid yellow;}
  /*.rightlinks a.btn{background-color: beige;border: 1px solid beige;}*/
  a.btn.alertlink{background-color:red;color:white;border: 1px solid red;}
  a.btn.golink{background-color:green;color:white;border: 1px solid green;}
  a.btn.voteUp{background-color: #93C22C;border: 1px solid green;}
  a.btn.voteUnclear{background-color: yellow;border: 1px solid yellow;}
  a.btn.voteMoreInfo{background-color: #789289;border: 1px solid #789289;}
  a.btn.voteAbstain{color: black;background-color: white;border: 1px solid white;}
  a.btn.voteDown{background-color: #db254e;border: 1px solid #db254e;}
</style>
<div class="pull-right" style="padding:20px;">
	<a href="#" onclick="showMenu()">
		<i class="menuBtn fa fa-bars fa-3x text-white "></i>
	</a>
</div>

<div class="row">
	<div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
	<a class="byPHRight" href="http://pixelhumain.com" target="_blank"><img style="height: 39px;position: absolute;right: -157px;top: 203px;z-index: 2000;" class="pull-right" src="<?php echo $this->module->assetsUrl?>/images/byPH.png"/></a>
		<!-- start: LOGIN BOX -->
		<?php 
			$this->renderPartial('../person/menuTitle',array( "actionTitle" => "VOTE", 
														 	  "actionIcon"  => "download" ));
		?>
		
		<div class="box-login box radius-20">

			<span class="text-extra-large text-bold"> INVITATION TO VOTE </span> 
			<p> Invited by --- <?php //echo $parentOrganization['name'] ?> </p>
			<blockquote style="border-left: 5px solid #E33551;">
				<span class="text-extra-large text-bold">
				<?php
				echo $survey["name"]; 
				echo "</span><p>";
				$regex = '#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#';
				echo preg_replace_callback($regex, function ($matches) {
				    return "<a target='_blank' href='{$matches[0]}'>{$matches[0]}</a>";
				}, $survey["message"]);
				?>
				</p>
			</blockquote>
			<div class="center margin-10">
				<?php 
					$logguedAndValid = Person::logguedAndValid();
					$voteLinksAndInfos = Action::voteLinksAndInfos($logguedAndValid,$survey);
      				$leftLinks = $voteLinksAndInfos["links"];
      				
      				if( $voteLinksAndInfos["hasVoted"] )
      					echo "Thank you for your."; 
      				else
      					echo "Feel Free to vote.";
      				echo "<div>".$leftLinks."</div>";
      				if( $voteLinksAndInfos["totalVote"] )
      					echo "<br/>".$voteLinksAndInfos["totalVote"]." people voted."; 
				 ?>
			</div>

			<br/>
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
				<br/><a class="btn" href="javascript:addaction('<?php echo (string)$survey["_id"]?>','<?php echo Action::ACTION_FOLLOW ?>')"><i class='fa fa-rss' ></i> Follow this vote</a>
				<?php } else {?>
				<br/>You are Following this vote. <i class='fa fa-rss' ></i>
				<?php } 
			} else {?>
				<br/>You started this vote.
				<br/><a class="btn" onclick="entryDetail('<?php echo Yii::app()->createUrl("/pppm/default/entry/id/".(string)$survey["_id"])?>','edit')" href="javascript:;"><i class='fa fa-pencil' ></i> Edit this Entry</a>

			<?php }} ?>

		</div>
		<!-- end: LOGIN BOX -->
	</div>
</div>
<script type="text/javascript">

	jQuery(document).ready(function() {

		
		$(".titleRed").html("VOTER");
		$(".titleWhite").html("");
		$(".titleWhite2").html("");
		$(".subTitle").html("C'est un bien commun.");

		$('.box-login').show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated flipInX");
		});
	});
function addaction(id,action){
    console.warn("--------------- addaction ---------------------");
    if(confirm("Vous êtes sûr ? Vous ne pourrez pas changer votre vote")){
      params = { 
           "email" : '<?php echo Yii::app()->session["userEmail"]?>' , 
           "id" : id ,
           "collection":"surveys",
           "action" : action 
           };
      ajaxPost(null,'<?php echo Yii::app()->createUrl($this->module->id."/survey/addaction")?>',params,function(data){
        window.location.reload();
      });
    }
  }

</script>


