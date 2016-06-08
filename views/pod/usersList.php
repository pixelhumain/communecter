<?php
$cssAnsScriptFilesModule = array(
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>
<style>
.avatarOrgaList{
	font-size: 46.5px;
    background-color: lightgray;
    height: 50px;
	color: whitesmoke;	
}
.user-list.ico-type-account {
    background-image: url("flag.png");
    text-align: center;
    height: 20px;
    width: 40px;
    font-size: 13px;
    padding: 0px;
    float: left;
    margin-left: -24px;
    border-radius: 3px 0px 0px 3px;
    margin-top: 0px;
    margin-right: 37px;
}
.adminFlag{
	position: relative;
	top: -50px;
	left: 0px;
	background-color: red;
	width: 15px;
	border-radius: 0 0 5px 0px;
}

.contentImg{
	margin-top:3px;
	height:50px;
	width:50px;
}
.count{
	margin-left: 1px;
    margin-top: 4px;
    font-size: large;
    background-color: #e25555 !important;
    color: white;
    border-radius: inherit;
}
.grayscale{
	filter:grayscale(100%);
	-webkit-filter:grayscale(100%);
}
</style>
<?php if ($contentType == Project::COLLECTION){ 
		$parentRedirect = "project";
		$parentId = (string)$project["_id"];
		$tooltips = "La communauté du projet";
	}
	else if ($contentType == Organization::COLLECTION){
		$parentRedirect = "organization";
		$parentId = (string)$organization["_id"];
		$tooltips = "La communauté de l'organisation";							
	}
	else if ($contentType == Event::COLLECTION){
		$parentRedirect = "event";
		$parentId = (string)$event["_id"];	
		$tooltips = "La communauté de l'évènement";						
	}
?>
	<div class="panel panel-white user-list">
		<div class="panel-heading border-light text-white bg-yellow">
			<h4 class="panel-title"><i class="fa fa-connectdevelop"></i> <?php echo $userCategory ?></h4>
			
		</div> 
		<div class="panel-tools">
			<?php if ( @$admin && $contentType != ActionRoom::COLLECTION_ACTIONS ) { ?>
					<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="loadByHash('#<?php echo $parentRedirect ?>.directory.id.<?php echo $parentId ?>?tpl=directory2')" data-placement="bottom" data-original-title="<?php echo $tooltips ?>">
						<i class="fa fa-cog "></i> <?php echo Yii::t("common","Manage"); ?>
					</a>								
			<?php } else if ($contentType != ActionRoom::COLLECTION_ACTIONS){ ?>
				<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="loadByHash('#<?php echo $parentRedirect ?>.directory.id.<?php echo $parentId ?>?tpl=directory2')" data-placement="bottom" data-original-title="<?php echo $tooltips ?>">
						<i class="fa fa-eye"></i> <?php echo Yii::t("common","Visualize"); ?>
					</a>								

			<?php } 
			if ($contentType == "events" && !@$noAddLink){ ?>
				<a href="javascript:;" class="btn btn-xs btn-default tooltips" data-placement="bottom" data-original-title="<?php echo Yii::t("event","Invite attendees to the event") ?>" onclick="loadByHash( '#event.addattendeesv.eventId.<?php echo (string)$event["_id"];?>')">
					<i class="fa fa-plus"></i> <?php echo Yii::t("common","Send invitations") ?>
				</a>			
			<?php } ?>
		</div>
		<?php
			if(@$invitedMe && !empty($invitedMe)){
				echo "<div class='no-padding' style='border-bottom: 1px solid lightgray;margin-bottom:10px !important;'>".
					"<div class='padding-5'>".
						"<a href='javascript:;' onclick='loadByHash(\'#person.detail.id.".$invitedMe["invitorId"]."\')'>".$invitedMe["invitorName"]."</a><span class='text-dark'> vous a invité: <br/>".
						'<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="connectTo(\''.Event::COLLECTION.'\',\''.(string)$event["_id"].'\', \''.Yii::app()->session["userId"].'\',\''.Person::COLLECTION.'\',\'attendee\')" data-placement="bottom" data-original-title="Go to the event">'.
							'<i class="fa fa-check "></i> '.Yii::t("event","I go").
						'</a>'.
						'<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="disconnectTo(\''.Event::COLLECTION.'\',\''.(string)$event["_id"].'\',\''.Yii::app()->session["userId"].'\',\''.Person::COLLECTION.'\',\'attendees\')" data-placement="bottom" data-original-title="Not interested by the invitation">'.
							'<i class="fa fa-remove"></i> '.Yii::t("event","Not interested").
						'</a>'.
					"</div>".
				"</div>";
			}
		?>
		<div class="padding-10">
		<?php if(empty($users) || @$attendeeNumber===0){ ?>
				<div class="padding-10">
					<blockquote class="no-margin">
					<?php if ($contentType==Event::COLLECTION) 
							echo Yii::t("common","No attendee for this event"); 
						else if ($contentType==Project::COLLECTION) 
							echo Yii::t("common","No contributor for this project"); 
						else if ($contentType==Organization::COLLECTION) 
							echo Yii::t("common","No member for this organization"); ?>
					</blockquote>
				</div>
			<?php }
			else{
				//print_r($followers);
				if(isset($followers)){
					$text="";
					if($contentType==Organization::COLLECTION)
						$userTitle=Yii::t("common","member");
					else if ($contentType==Project::COLLECTION)
						$userTitle=Yii::t("common","contributor");
					$text .= count($users)." ".$userTitle;
					if(count($users)>1)
						$text .= "s";
					if(!empty($followers)){
						$text .= " ".Yii::t("common","and")." ";
						$text .= $followers." ".Yii::t("common","follower");
						if ($followers > 1)
							$text .="s";

					}
					echo "<div class='no-padding text-dark entityTitle' style='font-size:18px;'><span class='text'>".$text."</span></div>";
				} 
				foreach ($users as $e) { 
					if(!@$e["invitorId"]){
						$grayscale = "grayscale";
						//print_r($e);
						$name = $e["name"];
						if (@$e["isAdmin"]){
							$adminFlag='<div class="adminFlag"><i class="fa fa-bookmark-o fa-white"></i></div>';
							if (@$e["isAdminPending"])
								$name.= " (".Yii::t("common","waiting for validation").")";
							else if (@$e["tobeactivated"])
								$name.= " (".Yii::t("common","not activated").")";
							else if (@$e["pending"])
								$name.= " (".Yii::t("common","unregistred").")";	
							else {
								$name.= " (admin)";
								$grayscale = "";
							}
						}
						else {
							$adminFlag="";
							if (@$e["toBeValidated"])
								$name.= " (".Yii::t("common","waiting for validation").")";
							else if (@$e["tobeactivated"])
								$name.= " (".Yii::t("common","not activated").")";
							else if (@$e["pending"])
								$name.= " (".Yii::t("common","unregistred").")";
							else
								$grayscale = "";
						}
						if ($e["type"]==Person::COLLECTION){
							$icon='<img height="50" width="50" class="tooltips" src="'.$this->module->assetsUrl.'/images/news/profile_default_l.png" data-placement="top" data-original-title="'.$name.'">';
							$refIcon="fa-user";
							$redirect="person";
						}
						else{
							$icon="<div class='thumbnail-profil'><i class='fa fa-group tooltips avatarOrgaList' data-placement='top' data-original-title='".$name."'></i></div>";
							$redirect="organization";
							$refIcon="fa-group";
						}
						
					?>
					
						<a href="javascript:;" onclick="loadByHash('#<?php echo $redirect; ?>.detail.id.<?php if (@$e["_id"]) echo $e['_id']; else echo $e["id"]?>')" title="<?php echo $name ?>" class="btn no-padding contentImg <?php echo $grayscale ?>">
	
						<?php if($e && !empty($e["profilThumbImageUrl"])) {
							// Utiliser profilThumbImageUrl && createUrl(/.$profilThumbUrl.)
							 ?>
							<img width="50" height="50"  alt="image" class="tooltips" src="<?php echo Yii::app()->createUrl('/'.$e['profilThumbImageUrl']) ?>" data-placement="top" data-original-title="<?php echo $name ?>">
						<?php }else{ 
							echo $icon;
						} ?>
						<?php echo $adminFlag; ?>
					</a>
									
				<?php 
					}
				}
				if(!empty($followers)){ ?>
				<a href="javascript:;" onclick="loadByHash('#<?php echo $parentRedirect ?>.directory.id.<?php echo $parentId ?>?tpl=directory2')" title="<?php echo Yii::t("common","See all") ?>" data-placement="top" data-original-title="<?php echo Yii::t("common","See all") ?>" class="btn no-padding contentImg count tooltips">
					<span style="line-height:50px;">+ <?php echo $followers ?></span>
				</a>
				<?php } 
			} ?>
		</div>
		<?php
			// If event, see number of invitations and attendees
			if((@$attendeeNumber && $attendeeNumber != 0) || (@$invitedNumber && $invitedNumber != 0)){
				echo "<div class='no-padding' style='border-top: 1px solid lightgray;margin-top:10px !important;'>";
				if ($attendeeNumber != 0){
					echo "<div class='col-md-4 inline' style='float:inherit;'>".
							"<span class='text-dark' style='font-size:16px;font-weight:bold'>".$attendeeNumber."</span><br/>".
							"<span class='text-dark'>".Yii::t("event","Attendees")."</span>".
						"</div>";
					
				}if ($invitedNumber != 0){
					$style="";
					if($attendeeNumber != 0)
						$style="padding-left:15px;";
					echo "<div class='col-md-4 inline' style='float:inherit;".$style."'>".
						"<span class='text-dark' style='font-size:16px;font-weight:bold'>".$invitedNumber."</span><br/>".
						"<span class='text-dark'>".Yii::t("event","Guests")."</span>".
					"</div>";
				}
				echo "</div>";
			}
		?>
	</div>

 <script type="text/javascript">

	jQuery(document).ready(function() {
		var usersLinks = <?php echo isset($users) ? json_encode($users) : "''"; ?>;
	});


</script>
