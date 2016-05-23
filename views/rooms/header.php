 <style>

.assemblyHeadSection {  
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/assemblyParisDay.jpg); 
  background-repeat: no-repeat !important;
  background-size: 100% 500px !important;
 }
.contentProposal{
	background-color: white;
}
 </style>	

 	<?php 
    	$urlPhotoProfil = "";
		
		if(isset($parent['profilThumbImageUrl']) && $parent['profilThumbImageUrl'] != "")
	      $urlPhotoProfil = Yii::app()->createUrl($parent['profilThumbImageUrl']);
	    else
	      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	
		$icon = "comments";	
		$colorName = "dark";
		if($parentType == Project::COLLECTION) { $icon = "lightbulb-o"; $colorName = "purple"; }
	  	if($parentType == Organization::COLLECTION) { $icon = "group"; $colorName = "green"; }
	  	if($parentType == Person::COLLECTION) { $icon = "user"; $colorName = "dark"; }
        if($parentType == City::COLLECTION) { $icon = "university"; $colorName = "red"; }
	?>
	<img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
    
    <br>
	
	<?php //création de l'url sur le nom du parent
		$urlParent = Element::getControlerByCollection($parentType).".detail.id.".$parentId; 
		if($parentType == City::COLLECTION) 
			$urlParent = Element::getControlerByCollection($parentType).".detail.insee.".$parent["insee"].".postalCode.".$parent["cp"]; 
	?>
	<span class="homestead" style="padding:10px;">
		<a href="javascript:loadByHash('#<?php echo $urlParent; ?>');" class="text-<?php echo $colorName; ?>">
			<i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $parent['name']; ?>
		</a>
	</span>

	<br>

	<span class="homestead text-dark" style="padding:10px; font-size:0.8em;">
		<i class='fa fa-<?php echo $faTitle?>'></i> 
		<?php echo $textTitle; ?>
	</span>
	
	<?php if( $fromView == "rooms.index" ){ ?>
		<?php 
			$btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("rooms","JOIN TO PARTICPATE", null, Yii::app()->controller->module->id);
		    $ctrl = Element::getControlerByCollection($parentType);
		    $btnUrl = "#".$ctrl.".detail.id.".$parentId;
			
			if( $parentType == City::COLLECTION || 
				($parentType != Person::COLLECTION && 
				Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId) ))
				{ 
					$btnLbl = "<i class='fa fa-plus'></i> ".Yii::t("rooms","Add an Action Room", null, Yii::app()->controller->module->id);
				    $btnUrl = "#rooms.editroom.type.".$parentType.".id.".$parentId;
				} 
		?>

		<?php if( $parentType != Person::COLLECTION ){ ?>
		<div class="col-md-12 center">
			<button class='btn btn-sm btn-success' style='margin-top:10px;margin-bottom:10px;' onclick='loadByHash("<?php echo $btnUrl?>")'><?php echo $btnLbl?></button>
		</div>
		<?php } ?>
	<?php } ?>

	<?php if( $fromView != "rooms.index" ){ 
		if( !@$discussions && !@$votes && !@$actions ){
			$rooms = PHDB::find( ActionRoom::COLLECTION, array("parentType"=>$parentType,"parentId"=>$parentId));
			
			$discussionsCount = 0;
			$votesCount = 0;
			$actionsCount = 0;
			foreach ($rooms as $value) {
				if($value["type"] == ActionRoom::TYPE_DISCUSS)
					$discussionsCount++;
				else if($value["type"] == ActionRoom::TYPE_VOTE)
					$votesCount++;
				else if($value["type"] == ActionRoom::TYPE_ACTIONS)
					$actionsCount++;
			}
		} else {
			$discussionsCount = count($discussions) ;
			$votesCount = count($votes);
			$actionsCount = count($actions);
		}
		$actionClass = ( in_array(Yii::app()->controller->id."/".Yii::app()->controller->action->id, array( "rooms/actions" ,"rooms/action" ))  ) ? "class='active'" : "";
		$voteClass = ( in_array(Yii::app()->controller->id."/".Yii::app()->controller->action->id, array( "survey/entries" ,"survey/entry" ))  )  ? "class='active'" : "";
		$discussClass = ( $voteClass == "" && $actionClass == "" ) ? "class='active'" : "";

		$isRoomsIndex = (Yii::app()->controller->id."/".Yii::app()->controller->action->id == "rooms/index" ) ? true : false;
		$discussLink = ($isRoomsIndex) ? "#discussions" : 'href="javascript:;" onclick="loadByHash(\'#rooms.index.type.organizations.id.'.$parentId.'.tab.1\')"';
		$voteLink = ($isRoomsIndex) ? "#votes" : 'href="javascript:;" onclick="loadByHash(\'#rooms.index.type.organizations.id.'.$parentId.'.tab.2\')"';
		$actionLink = ($isRoomsIndex) ? "#actions" : 'href="javascript:;" onclick="loadByHash(\'#rooms.index.type.organizations.id.'.$parentId.'.tab.3\')"';
		?>
		<ul class="nav nav-tabs nav-justified homestead nav-menu-rooms" role="tablist">
		  <li <?php echo $discussClass?>><a href="<?php echo $discussLink?>" role="tab" data-toggle="tab"><i class="fa fa-comments"></i> <?php echo Yii::t("rooms", "Discuss", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo $discussionsCount.(PHDB::count( ActionRoom::CONTROLLER, array("parentType"=>$parentType,"parentId"=>$parentId,"type"=>ActionRoom::TYPE_DISCUSS)))?> </span></a></li>
		  <li <?php echo $voteClass?>><a href="<?php echo $voteLink?>" role="tab" data-toggle="tab"><i class="fa fa-archive"></i> <?php echo Yii::t("rooms", "Decide", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo $votesCount?></span> </a></li>
		  <li <?php echo $actionClass?>><a href="<?php echo $actionLink?>" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo Yii::t("rooms", "Act", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo $actionsCount?></span> </a></li>
		  <!-- <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li> -->
		</ul>

		
	<?php } ?>

	<?php if( isset($parentSpace) ){ ?>
	<div class="row vote-row parentSpaceName">
		<div class="col-md-12">
			<a href="javascript:"  onclick="loadByHash('#survey.entries.id.<?php echo $parentSpace["_id"]; ?>')">
				<h1 class="homestead text-dark center"><i class=" fa fa-archive"></i> <?php echo $parentSpace["name"]; ?></h1>
			</a>
		</div>
	</div>
	<?php } ?>
