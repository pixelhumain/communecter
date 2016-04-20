<?php
		$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
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
	}
	else if ($contentType == Organization::COLLECTION){
		$parentRedirect = "organization";
		$parentId = (string)$organization["_id"];							
	}
?>
	<div class="panel panel-white user-list">
		<div class="panel-heading border-light text-white bg-yellow">
			<h4 class="panel-title"><i class="fa fa-connectdevelop"></i> <?php echo $userCategory ?></h4>
			
		</div> 
		<div class="panel-tools">
				<?php if ($admin && $contentType != "events"){ ?>
						<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="loadByHash('#<?php echo $parentRedirect ?>.directory.id.<?php echo $parentId ?>?tpl=directory2')" data-placement="bottom" data-original-title="Les contributeurs du projet">
							<i class="fa fa-cog "></i> <?php echo Yii::t("common","Manage"); ?>
						</a>								
				<?php } 
				if ($contentType == "events"){ ?>
					<a href="javascript:;" class="btn btn-xs btn-default tooltips" data-placement="bottom" data-original-title="<?php echo Yii::t("event","Invite participants to the event",null,Yii::app()->controller->module->id) ?>" onclick="loadByHash( '#event.addattendeesv.eventId.<?php echo (string)$event["_id"];?>')">
						<i class="fa fa-plus"></i> <?php echo Yii::t("common","Sent invitations") ?>
					</a>			
				<?php } ?>
			</div>
		<div class="padding-10">
		<?php	if(empty($users)){ ?>
				<div class="padding-10"><blockquote class="no-margin"><?php if ($contentType==Event::COLLECTION) echo Yii::t("common","No attendee for this event"); else if ($contentType==Project::COLLECTION) echo Yii::t("common","No contributor for this project"); else if ($contentType==Organization::COLLECTION) echo Yii::t("common","No member for this organization"); ?></blockquote></div>
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
						else
							$name.= " (admin)";
					}
					else {
						$adminFlag="";
						if (@$e["toBeValidated"])
							$name.= " (".Yii::t("common","waiting for validation").")";
						else if (@$e["tobeactivated"])
							$name.= " (".Yii::t("common","not activated").")";
						else if (@$e["pending"])
							$name.= " (".Yii::t("common","unregistred").")";					
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
				
					<a href="javascript:;" onclick="loadByHash('#<?php echo $redirect; ?>.detail.id.<?php if (@$e["_id"]) echo $e['_id']; else echo $e["id"]?>')" title="<?php echo $name ?>" class="btn no-padding contentImg <?php if (@$e["isAdminPending"] || @$e["toBeValidated"] || @$e["tobeactivated"] || @$e["pending"]) echo "grayscale" ?>">

					<?php if($e && isset($e["imagePath"])) {
						// Utiliser profilThumbImageUrl && createUrl(/.$profilThumbUrl.)
						 ?>
						<img width="50" height="50"  alt="image" class="tooltips" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>" data-placement="top" data-original-title="<?php echo $name ?>">
					<?php } else if ($e && isset($e["profilImageUrl"]) && !empty($e["profilImageUrl"])){ ?>
						<img width="50" height="50"  alt="image" class="tooltips" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['profilImageUrl']) ?>" data-placement="top" data-original-title="<?php echo $name ?>">
					<?php }else{ 
						echo $icon;
					} ?>
					<?php echo $adminFlag; ?>
					</a>
									
				<?php 
				}
				if(!empty($followers)){ ?>
				<a href="javascript:;" onclick="loadByHash('#<?php echo $parentRedirect ?>.directory.id.<?php echo $parentId ?>?tpl=directory2')" title="<?php echo Yii::t("common","See all") ?>" data-placement="top" data-original-title="<?php echo Yii::t("common","See all") ?>" class="btn no-padding contentImg count tooltips">
					<span style="line-height:50px;">+ <?php echo $followers ?></span>
				</a>
		<?php } } ?>
		</div>
	</div>

 <script type="text/javascript">

	jQuery(document).ready(function() {
		var usersLinks = <?php echo isset($users) ? json_encode($users) : "''"; ?>;
	});


</script>
