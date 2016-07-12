<?php 
$cs = Yii::app()->getClientScript();

$cssAnsScriptFilesModule = array(
  '/css/rooms/header.css'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl); ?>
 <style>

.assemblyHeadSection {  
	<?php $bg = (@$archived) ? "assemblyParisDayArchived" : "assemblyParisDay";?>
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/<?php echo $bg; ?>.jpg); 
  background-repeat: no-repeat !important;
  background-size: 100% 500px !important;
  background-position: 0px -60px !important;
 }
.contentProposal{
	background-color: white;
}
.header-parent-space{
	margin: -15px 10px;
	padding: 15px 8px 8px;
	border-radius: 7px 7px 0px 0px;
	box-shadow: 0px 3px 10px 1px rgb(101, 101, 101);
	background-color: rgba(255, 255, 255, 0.73);
	-moz-box-shadow: 0px 3px 10px 1px #656565;
	-webkit-box-shadow: 0px 3px 10px 1px #656565;
	-o-box-shadow: 0px 3px 10px 1px #656565;
}

.toolbar-DDA{
	position:absolute;
	top:115px;
	left:50px;
}

.toolbar-DDA .dropdown{
	display: inline-block;
}
</style>	

<?php if(isset($discussions) && false == true) { ?>
<div class="toolbar-DDA">
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="discuter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    <i class="fa fa-comments"></i> Discuter
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="discuter">
	    <?php foreach ($discussions as $key => $value) { ?>
	    	<li><a href="#"><?php echo $value["name"]; ?></a></li>
	    <?php } ?>
	  </ul>
	</div>
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="decider" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    <i class="fa fa-archive"></i> Décider
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="decider">
	    <?php foreach ($votes as $key => $value) { ?>
	    	<li><a href="#"><?php echo $value["name"]; ?></a></li>
	    <?php } ?>
	  </ul>
	</div>
	<div class="dropdown">
	  <button class="btn btn-default dropdown-toggle" type="button" id="agir" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
	    <i class="fa fa-cogs"></i> Agir
	    <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu" aria-labelledby="agir">
	    <?php foreach ($actions as $key => $value) { ?>
	    	<li><a href="#"><?php echo $value["name"]; ?></a></li>
	    <?php } ?>
	  </ul>
	</div>
</div>
<?php } ?>

<h1 class="homestead text-dark center citizenAssembly-header">
 	<?php 
    	$urlPhotoProfil = "";
		if(!@$parent){
			if($parentType == Project::COLLECTION) { $parent = Project::getById($parentId); }
		  	if($parentType == Organization::COLLECTION) { $parent = Organization::getById($parentId); }
		  	if($parentType == Person::COLLECTION) { $parent = Person::getById($parentId); }
	        if($parentType == City::COLLECTION) { $parent = City::getByUnikey($parentId); }
		}

		if(isset($parent['profilImageUrl']) && $parent['profilImageUrl'] != "")
	      $urlPhotoProfil = Yii::app()->getRequest()->getBaseUrl(true).$parent['profilImageUrl'];
	    else
	      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	
		$icon = "comments";	
		$colorName = "dark";
		if($parentType == Project::COLLECTION) { $icon = "lightbulb-o"; $colorName = "purple"; }
	  	if($parentType == Organization::COLLECTION) { $icon = "group"; $colorName = "green"; }
	  	if($parentType == Person::COLLECTION) { $icon = "user"; $colorName = "dark"; }
        if($parentType == City::COLLECTION) { $icon = "group"; $colorName = "red"; }
	?>
	<img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
    
    <br>
	
	<?php //création de l'url sur le nom du parent
		$urlParent = Element::getControlerByCollection($parentType).".detail.id.".$parentId; 
		if($parentType == City::COLLECTION) 
			$urlParent = Element::getControlerByCollection($parentType).".detail.insee.".$parent["insee"].".postalCode.".$parent["cp"]; 
	?>
	<div class="row header-parent-space">
		<a href="javascript:loadByHash('#<?php echo $urlParent; ?>');" class="text-<?php echo $colorName; ?>">
			<i class="fa fa-<?php echo $icon; ?>"></i> 
				<?php
					if($parentType == City::COLLECTION) echo "Conseil Citoyen - "; 
					echo $parent['name']; 
				?>
		</a>
		<br/>
		<?php 
			$btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("rooms","JOIN TO PARTICIPATE", null, Yii::app()->controller->module->id);
		    $ctrl = Element::getControlerByCollection($parentType);
		    $btnUrl = "loadByHash('#".$ctrl.".detail.id.".$parentId."')";
			
			if( $parentType == City::COLLECTION || 
				($parentType != Person::COLLECTION && 
				Authorisation::canParticipate(Yii::app()->session['userId'],$parentType,$parentId) ))
				{ 
					$btnLbl = "<i class='fa fa-plus'></i> ".Yii::t("rooms","Add an Action Room", null, Yii::app()->controller->module->id);
				    $btnUrl = "loadByHash('#rooms.editroom.type.".$parentType.".id.".$parentId."')";
				} 
			if(!isset(Yii::app()->session['userId'])){ 
				$btnLbl = "<i class='fa fa-sign-in'></i> ".Yii::t("rooms","LOGIN TO PARTICIPATE", null, Yii::app()->controller->module->id);
			    $btnUrl = "showPanel('box-login');";
			}

			$addBtn = ( $parentType != Person::COLLECTION ) ? ' <i class="fa fa-caret-right"></i> <a class="filter btn btn-xs btn-primary Helvetica" href="javascript:;" onclick="'.$btnUrl.'">'.$btnLbl.'</a>' : ""; 
		?>
		<span class="Helvetica breadscrum">
			<a class='text-dark' href='javascript:loadByHash("#rooms.index.type.<?php echo $parentType ?>.id.<?php echo $parentId ?>.tab.1")'>
				<i class="fa fa-connectdevelop"></i> <?php echo Yii::t("rooms","Action Rooms", null, Yii::app()->controller->module->id) ?>
			</a> 
			<?php 
				if( $parentType != Person::COLLECTION ){
					echo (@$textTitle) ? "/ ".$textTitle : 
						' <i class="fa fa-caret-right"></i> <a class="filter btn btn-xs btn-primary Helvetica" href="javascript:;" onclick="'.$btnUrl.'">'.$btnLbl.'</a>';
				}
			?>
		</span>
	</div>

	
	<?php if( $fromView != "rooms.index" ){ 
		if( !@$discussions && !@$votes && !@$actions ){
			$rooms = PHDB::find( ActionRoom::COLLECTION, array("parentType"=>$parentType,"parentId"=>$parentId,"status"=>array('$exists'=>0)));
			
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
		$discussLink = ($isRoomsIndex) ? "#discussions" : 'href="javascript:;" onclick="loadByHash(\'#rooms.index.type.'.$parentType.'.id.'.$parentId.'.tab.1\')"';
		$voteLink = ($isRoomsIndex) ? "#votes" : 'href="javascript:;" onclick="loadByHash(\'#rooms.index.type.'.$parentType.'.id.'.$parentId.'.tab.2\')"';
		$actionLink = ($isRoomsIndex) ? "#actions" : 'href="javascript:;" onclick="loadByHash(\'#rooms.index.type.'.$parentType.'.id.'.$parentId.'.tab.3\')"';
		?>
		<ul class="<?php echo @$hideMenu?> nav nav-tabs nav-justified homestead nav-menu-rooms" role="tablist">
		  <li <?php echo $discussClass?>><a href="<?php echo $discussLink?>" role="tab" data-toggle="tab"><i class="fa fa-comments"></i> <?php echo Yii::t("rooms", "Discuss", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo $discussionsCount;?> </span></a></li>
		  <li <?php echo $voteClass?>><a href="<?php echo $voteLink?>" role="tab" data-toggle="tab"><i class="fa fa-archive"></i> <?php echo Yii::t("rooms", "Decide", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo $votesCount?></span> </a></li>
		  <li <?php echo $actionClass?>><a href="<?php echo $actionLink?>" role="tab" data-toggle="tab"><i class="fa fa-cogs"></i> <?php echo Yii::t("rooms", "Act", null, Yii::app()->controller->module->id); ?> <span class="label label-default"><?php echo $actionsCount?></span> </a></li>
		  <!-- <li><a href="#settings" role="tab" data-toggle="tab">Settings</a></li> -->
		</ul>
		<?php 
		if(@$hideMenu)
			echo "<br/><div class='space20'></div>";
		?>

		
	<?php } ?>
	</h1>
