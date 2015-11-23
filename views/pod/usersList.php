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
.ico-type-account {
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
	border-radius: 0 0 6px 0px;
}
</style>
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title"><i class="fa fa-users fa-2x text-green"></i> <?php echo $userCategory ?></h4>
			<div class="panel-tools">
				<?php if ($admin){ ?>
				<?php if ($contentType == "projects"){ ?>
				<a class="btn btn-xs btn-light-blue tooltips" href="javascript:;" onclick="showAjaxPanel( '/project/directory/id/<?php echo (string)$project["_id"]; ?>?tpl=directory2&amp;isNotSV=1', 'Les contributeurs du projet','connectdevelop' )" data-placement="bottom" data-original-title="Les contributeurs du projet"><i class="fa fa-cog "></i> Manage</a>
									<a href="javascript:;" class="new-contributor btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="<?php echo Yii::t("project","Connect People or Organizations that are part of the project",null,Yii::app()->controller->module->id) ?>" onclick="showAjaxPanel( '/project/addcontributorsv?isNotSV=1&projectId=<?php echo (string)$project["_id"];?>', 'ADD CONTRIBUTORS','users' )"> <?php } else if ($contentType == "events"){ ?>
					<a href="javascript:;" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="<?php echo Yii::t("event","Invite participants to the event",null,Yii::app()->controller->module->id) ?>" onclick="showAjaxPanel( '/event/addattendeesv?isNotSV=1&eventId=<?php echo (string)$event["_id"];?>', 'ADD ATTENDEES','users' )">
				<?php }?><i class="fa fa-plus"></i></a>
				<?php } ?>
				<a href="#" class="btn btn-xs btn-link panel-close">
					<i class="fa fa-times"></i>
				</a>
			</div>
		</div> 
		<div class="padding-10">
		<?php	if(empty($users)){ ?>
				<div class="padding-10"><blockquote class="no-margin"><?php echo Yii::t("project","No contributor for this project",null,Yii::app()->controller->module->id); ?></blockquote></div>
			<?php }
			else{
				foreach ($users as $e) { 
					//print_r($e);
					if (@$e["isAdmin"]){
						$adminFlag='<div class="adminFlag"><i class="fa fa-cog fa-white"></i></div>';
						$name=$e["name"]." (admin)";
					}
					else {
						$adminFlag="";
						$name=$e["name"];
					}
					if ($e["type"]=="citoyen"){
						$icon='<img height="50" width="50" class="tooltips" src="/pixelhumain/ph/assets/866ca41a/images/news/profile_default_l.png" data-placement="top" data-original-title="'.$name.'">';
						$refIcon="fa-user";
						$redirect="person";
					}
					else{
						$icon="<div class='thumbnail-profil'><i class='fa fa-group tooltips avatarOrgaList' data-placement='top' data-original-title='".$name."'></i></div>";
						$redirect="organization";
						$refIcon="fa-group";
					}
					
				?>
				
					<a href="#" onclick="openMainPanelFromPanel('/<?php echo $redirect; ?>/detail/id/<?php echo $e['_id']?>', '<?php echo $redirect; ?> : <?php echo $e["name"]?>','<?php echo $refIcon ?>', '<?php echo $e['_id']?>')" title="<?php echo $name ?>" class="btn no-padding" style="margin-top:3px;height:50px;">

					<?php if($e && isset($e["imagePath"])) { ?>
						<img width="50" height="50"  alt="image" class="tooltips" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>" data-placement="top" data-original-title="<?php echo $name ?>"></td>
					<?php } else{ 
						echo $icon;
					} ?>
					<?php echo $adminFlag; ?>
					</a>
									
				<?php 
				}	
			} ?>
		</div>
	</div>

 <script type="text/javascript">

//
 	console.log("projectContributors");
 	//console.dir(projectContributors);
	jQuery(document).ready(function() {
		//bindBtnContributor();
	//	Sig.restartMap();
	//	Sig.showMapElements(Sig.map, projectContributors);
	});


</script>
