<?php
		$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>
	<div class="panel panel-white">
		<div class="panel-heading border-light">
			<h4 class="panel-title"><i class="fa fa-users fa-2x text-green"></i> <?php echo $userCategory ?></h4>
			<div class="panel-tools">
				<?php if ($admin){ ?>
				<?php if ($contentType == "projects"){ ?>
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
					if ($e["type"]=="citoyen"){
						$icon="<i class=\"fa fa-smile-o fa-2x\"></i></td>";
						$refIcon="fa-user";
						$redirect="person";
					}
					else{
						$icon="<i class=\"fa fa-group fa-2x\"></i></td>";
						$redirect="organization";
						$refIcon="fa-group";
					}
				?>
				
					<a href="#" onclick="openMainPanelFromPanel('/<?php echo $redirect; ?>/detail/id/<?php echo $e['_id']?>', '<?php echo $redirect; ?> : <?php echo $e["name"]?>','<?php echo $refIcon ?>', '<?php echo $e['_id']?>')" title="<?php echo $e["name"];?>">

					<?php if($e && isset($e["imagePath"])) { ?>
						<img width="50" height="50"  alt="image" class="tooltips" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>" data-placement="top" data-original-title="<?php echo $e["name"]?>"></td>
					<?php } else{ ?>
						<img height="50" width="50" class="tooltips" src="/pixelhumain/ph/assets/866ca41a/images/news/profile_default_l.png" data-placement="top" data-original-title="<?php echo $e["name"]?>">
					<?php	} ?>
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
