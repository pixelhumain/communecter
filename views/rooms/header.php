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
		if($parentType == Project::COLLECTION) { $icon = "lightbulb-o"; $colorName = "purple"; }
	  	if($parentType == Organization::COLLECTION) { $icon = "group"; $colorName = "green"; }
	  	if($parentType == Person::COLLECTION) { $icon = "user"; $colorName = "dark"; }
        if($parentType == City::COLLECTION) { $icon = "university"; $colorName = "red"; }
	?>
	<img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
    
    <br>
	
	<?php //création de l'url sur le nom du parent
		$urlParentName = Element::getControlerByCollection($parentType).".detail.id.".$parentId; 
		if($parentType == City::COLLECTION) 
			$urlParentName = Element::getControlerByCollection($parentType).".detail.insee.".$parent["insee"].".postalCode.".$parent["cp"]; 
	?>
	<span class="homestead" style="padding:10px;">
		<a href="javascript:loadByHash('#<?php echo $urlParentName; ?>');" class="text-<?php echo $colorName; ?>">
			<i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $parent['name']; ?>
		</a>
	</span>

	<br>

	<span class="homestead text-<?php echo $colorTitle;?>" style="padding:10px; font-size:0.8em;">
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




	<?php if( $fromView != "rooms.index" ){ ?>
		<ul class="nav nav-tabs nav-justified homestead nav-menu-rooms" role="tablist">
		  <li class="active"><a href="#discussions" role="tab" data-toggle="tab"><i class="fa fa-comments"></i> <?php echo Yii::t("rooms", "Discuss", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo (isset($discussions)) ? count($discussions)  : 0?> </span></a></li>
		  <li><a href="#votes" role="tab" data-toggle="tab"><i class="fa fa-archive"></i> <?php echo Yii::t("rooms", "Decide", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo (isset($votes)) ? count($votes) : 0?></span> </a></li>
		  <li><a href="#actions" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo Yii::t("rooms", "Act", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo (isset($actions)) ? count($actions) : 0?></span> </a></li>
		  <!-- <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li> -->
		</ul>
	<?php } ?>

	<!-- <div class="col-sm-12 bg-dark padding-5">

			<div class="col-md-4 bg-dark">
			 <a href="javascript:;" onclick="loadByHash('#rooms.index.type.organizations.id.<?php echo $parentId?>.tab.1')" class=" homestead center"> <i class="fa fa-comments"></i> <?php echo Yii::t("rooms", "Discussion", null, Yii::app()->controller->module->id); ?></a>
			</div>

			<div class="col-sm-4 bg-dark">
			  <a href="javascript:;" onclick="loadByHash('#rooms.index.type.organizations.id.<?php echo $parentId?>.tab.2')" class=" homestead center"><i class="fa fa-archive"></i> <?php echo Yii::t("rooms", "Decision", null, Yii::app()->controller->module->id); ?></a>
			</div>

			<div class="col-sm-4 bg-dark">
			  <a href="javascript:;" onclick="loadByHash('#rooms.index.type.organizations.id.<?php echo $parentId?>.tab.3')" class="text-white homestead center"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Action", null, Yii::app()->controller->module->id); ?> </a>
			</div>

		
		</div> -->


	<?php if( isset($parentSpace) ){ ?>
	<div class="row vote-row parentSpaceName">
		<div class="col-md-12">
			<a href="javascript:"  onclick="loadByHash('#survey.entries.id.<?php echo $parentSpace["_id"]; ?>')">
				<h1 class="homestead text-dark center"><i class=" fa fa-archive"></i> <?php echo $parentSpace["name"]; ?></h1>
			</a>
		</div>
	</div>
	<?php } ?>
