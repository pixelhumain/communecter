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
.cogFlag{
	position: absolute;
	top: 0px;
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
    color: white!important;
    border-radius: inherit;
}
.grayscale{
	filter:grayscale(100%);
	-webkit-filter:grayscale(100%);
}
</style>

<?php 
	$parentId="";
	$inviteRefuse="Refuse";
	$inviteAccept="Accept";
	$tooltipAccept="Join this ".Element::getControlerByCollection($contentType);
	if ($contentType == Project::COLLECTION){ 
		$tooltips = "La communauté du projet";
	}
	else if ($contentType == Organization::COLLECTION){
		$tooltips = "La communauté de l'organisation";							
	}
	else if ($contentType == Event::COLLECTION){
		$parentRedirect = "event";
		$inviteRefuse="Not interested";
		$inviteAccept="I go";
		$tooltipAccept="Go to the event";
		$parentId = (string)$event["_id"];	
		$tooltips = "La communauté de l'évènement";						
	}
	else if ($contentType == Person::COLLECTION){
		$tooltips = "La communauté de cette personne";						
	}


	$addLink = (empty($users[Yii::app()->session["userId"]])?false:true);
?>
	<div class="panel panel-white user-list">
		<div class="panel-heading border-light bg-yellow">
			<h4 class="panel-title"><i class="fa fa-connectdevelop"></i> <?php echo $userCategory ?></h4>
			
		</div> 
		<div class="panel-tools">
			<?php if ( @$admin && $contentType != ActionRoom::COLLECTION_ACTIONS ) { ?>
					<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="showElementPad('directory');" data-placement="bottom" data-original-title="<?php echo $tooltips ?>">
						<i class="fa fa-cog "></i> <?php echo Yii::t("common","Manage"); ?>
					</a>								
			<?php } else if ($contentType != ActionRoom::COLLECTION_ACTIONS){ ?>
				<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="showElementPad('directory');" data-placement="bottom" data-original-title="<?php echo $tooltips ?>">
						<i class="fa fa-eye"></i> <?php echo Yii::t("common","Visualize"); ?>
					</a>								

			<?php } 
			if ($contentType == Event::COLLECTION && $admin == true){ ?>
				<a href="javascript:" class=" btn btn-xs btn-default tooltips" data-placement="bottom" data-original-title="<?php echo Yii::t("event","Invite attendees to the event") ?>" 
				 data-toggle="modal" data-target="#modal-scope">
					<i class="fa fa-plus"></i> <?php echo Yii::t("common","Send invitations") ; ?>
				</a>			
			<?php } 
			
			if ($contentType == Organization::COLLECTION && $admin == true){ ?>
				<a href="javascript:" class="btn btn-xs btn-default tooltips" data-placement="bottom" data-original-title="<?php echo Yii::t('common','Add a member to this organization'); ?>" 
				 data-toggle="modal" data-target="#modal-scope">
					<i class="fa fa-plus"></i> <?php echo Yii::t("common",'Add member') ; ?>
				</a>			
			<?php }

			if ($contentType == Project::COLLECTION && $admin == true){ ?>
				<a href="javascript:" class="btn btn-xs btn-default tooltips" data-placement="bottom" data-original-title="<?php echo Yii::t('common','Add a contributor to this project'); ?>" 				 data-toggle="modal" data-target="#modal-scope">
					<i class="fa fa-plus"></i> <?php echo Yii::t("common",'Add contributor') ; ?>
				</a>			
			<?php } ?>

		</div>
		<?php
			if(@$invitedMe && !empty($invitedMe)){
				echo "<div class='no-padding' style='border-bottom: 1px solid lightgray;margin-bottom:10px !important;'>".
					"<div class='padding-5'>".
						"<a href='#element.detail.type.".Person::COLLECTION.".id.".$invitedMe["invitorId"]."' class='lbh'>".$invitedMe["invitorName"]."</a><span class='text-dark'> vous a invité: <br/>".
						'<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="validateConnection(\''.$contentType.'\',\''.$parentId.'\', \''.Yii::app()->session["userId"].'\',\''.Person::COLLECTION.'\',\''.Link::IS_INVITING.'\')" data-placement="bottom" data-original-title="'.Yii::t("common",$tooltipAccept).'">'.
							'<i class="fa fa-check "></i> '.Yii::t("common",$inviteAccept).
						'</a>'.
						'<a class="btn btn-xs btn-default tooltips" href="javascript:;" onclick="disconnectTo(\''.$contentType.'\',\''.$parentId.'\',\''.Yii::app()->session["userId"].'\',\''.Person::COLLECTION.'\',\'attendees\')" data-placement="bottom" data-original-title="Not interested by the invitation">'.
							'<i class="fa fa-remove"></i> '.Yii::t("common",$inviteRefuse).
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
							echo Yii::t("common","No member for this organization");
						else if ($contentType==Person::COLLECTION) 
							echo Yii::t("common","No member for this person"); ?>
					</blockquote>
				</div>
			<?php }
			else{
				foreach ($users as $e) { 
					if(!@$e["invitorId"]){
						$grayscale = "grayscale";
						$addCogFlag=true;
						$addCogFlag=15;
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
								$addCogFlag=false;
							}
						}
						else {
							$adminFlag="";
							$addCogFlag=1;
							if (@$e["toBeValidated"])
								$name.= " (".Yii::t("common","waiting for validation").")";
							else if (@$e["tobeactivated"])
								$name.= " (".Yii::t("common","not activated").")";
							else if (@$e["pending"])
								$name.= " (".Yii::t("common","unregistred").")";
							else{
								$grayscale = "";
								$addCogFlag=false;
							}
						}
						if($addCogFlag != false)
							$adminFlag.='<div class="cogFlag bg-dark" style="left:'.($addCogFlag--).'px;"><i class="fa fa-cog fa-white"></i></div>';
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
						$anId = isset($e["id"]) ? $e["id"] : ""; 
					?>
					<a href="#element.detail.type.<?php echo $e["type"] ?>.id.<?php echo $anId; ?>" title="<?php echo $name ?>" class=" lbh btn no-padding contentImg <?php echo $grayscale ?>">
	
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
				if(!empty($countLowLinks) || $countInvitations > 0 || $countStrongLinks > 11){ 
					$nbCommunity=$countLowLinks;
					$fontSize="";
					if($countStrongLinks>11)
						$nbCommunity+=($countStrongLinks-11);
					if($countInvitations)
						$nbCommunity+=$countInvitations;
					if($nbCommunity >= 1000){
						$nbCommunity=$nbCommunity/1000;
						$nbCommunity=number_format($nbCommunity, 1, ',',"")."K";
						$fontSize="font-size:14px;";
					}
				?>
				<a href="javascript:;" onclick="showElementPad('directory');" title="<?php echo Yii::t("common","See all") ?>" data-placement="top" data-original-title="<?php echo Yii::t("common","See all") ?>" class="btn no-padding contentImg count tooltips">
					<span style="line-height:50px;<?php echo $fontSize ?>">+ <?php echo $nbCommunity ?></span>
				</a>
				<?php } 
			} ?>
		</div>
		<?php
			// If event, see number of invitations and attendees
			if((@$countStrongLinks && $countStrongLinks != 0) || (@$countLowLinks && $countLowLinks != 0)){
				$text="";
					
					/*if(!empty($followers)){
						$text .= " ".Yii::t("common","and")." ";
						$text .= $followers." ".Yii::t("common","follower");
						if ($followers > 1)
							$text .="s";

					}*/
				echo "<div class='no-padding' style='border-top: 1px solid lightgray;margin-top:10px !important;'>";
				if (@$countStrongLinks && !empty($countStrongLinks)){
					if($contentType==Organization::COLLECTION)
						$strongLinksLabel=Yii::t("common","member");
					else if ($contentType==Project::COLLECTION || $contentType == ActionRoom::COLLECTION_ACTIONS)
						$strongLinksLabel=Yii::t("common","contributor");
					else if ($contentType==Event::COLLECTION)
						$strongLinksLabel=Yii::t("event","attendee");
					if($countStrongLinks>1)
						$strongLinksLabel .= "s";
					echo "<div class='col-md-4 inline' style='float:inherit;'>".
							"<span class='text-dark' style='font-size:16px;font-weight:bold'>".$countStrongLinks."</span><br/>".
							"<span class='text-dark'>".ucfirst(@$strongLinksLabel)."</span>".
						"</div>";
				}if (@$countInvitations && $countInvitations != 0){
					$style="";		
					$invitationsLabel = Yii::t("event","guest");
					if($countInvitations > 1)
						$invitationsLabel .= "s";
					if($countStrongLinks != 0)
						$style="padding-left:15px;";
					echo "<div class='col-md-4 inline' style='float:inherit;".$style."'>".
						"<span class='text-dark' style='font-size:16px;font-weight:bold'>".$countInvitations."</span><br/>".
						"<span class='text-dark'>".ucfirst($invitationsLabel)."</span>".
					"</div>";
				}
				if (@$countLowLinks && $countLowLinks != 0){
					$style="";
					$lowLinksLabel = Yii::t("common","follower");
					if($countLowLinks > 1)
						$lowLinksLabel .= "s";
					if($countStrongLinks != 0 || $countInvitations != 0)
						$style="padding-left:15px;";
					echo "<div class='col-md-4 inline' style='float:inherit;".$style."'>".
						"<span class='text-dark' style='font-size:16px;font-weight:bold'>".$countLowLinks."</span><br/>".
						"<span class='text-dark'>".ucfirst($lowLinksLabel)."</span>".
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
