<?php

$cssAnsScriptFilesTheme = array(

'/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);

$moduleId = Yii::app()->controller->module->id;
?>

<style>
	/*#main-pod-room .nav-tabs > li {
	    background-color: #dedede;
		font-size: 17px;
	}
    */
	#pod-room .panel-title a.text-white-hover:hover{
		color:white !important;
		text-decoration: underline !important;
	}

	.nav-menu-rooms{
		margin-top:-2px;
	}

	.nav-menu-rooms.nav-tabs > li{
  		background-color: #454545;
		font-size:17px !important;
	}
	.nav-menu-rooms.nav-tabs > li a{
  		color:white;
  	}
  	.nav-menu-rooms.nav-tabs > li.active a, .nav-menu-rooms.nav-tabs > li a:hover{
		color:#454545;
	}
	 
	#pod-room .panel-title a.helvetica, #pod-room .tooltip{
		font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-weight: 500;
		font-size:15px !important;
	}

	.tab-content {
      min-height: 250px;
    }

    .nav-menu-rooms #img-profil-tab{
    	height: 25px;
		width: 25px;
		border-radius: 50%;
		margin-top: -2px;
    }
    
</style>
<?php 
	
	$canEdit = true;
	$canParticipate = true;
	$surveyOpen = true;
	
	if($parentType != City::COLLECTION){
		if($parentType != Person::COLLECTION)
		$surveyOpen = !isset($empty); //(isset($organization["modules"]) && in_array("survey", $organization["modules"]));
	
		$canEdit = (isset($parentId) && isset($parentType) && isset(Yii::app()->session["userId"])
				&& Authorisation::canEditItem(Yii::app()->session["userId"], $parentType, $parentId));

		$canParticipate = (isset($parentId) && isset($parentType) && isset(Yii::app()->session["userId"])
				&& Authorisation::canParticipate(Yii::app()->session["userId"], $parentType, $parentId));
	}

	// echo $canEdit ? "true " : "false ";
	// echo $parentType." - ".Organization::COLLECTION;
	// echo " Auth : ";
	// echo Authorisation::canEditItem(Yii::app()->session["userId"], $parentType, $parentId) ? "true" : "false";
?>
<div id="pod-room" class="panel panel-white">

<?php 
	$parentTypeCreate = "";
	//echo $parentType;
	if($parentType == Project::COLLECTION) 		$parentTypeCreate = Project::CONTROLLER;
	if($parentType == Organization::COLLECTION) $parentTypeCreate = Organization::CONTROLLER; 
	if($parentType == Person::COLLECTION) 		$parentTypeCreate = Person::CONTROLLER; 
	if($parentType == City::COLLECTION) 		$parentTypeCreate = City::CONTROLLER; 
?>

	<?php if($surveyOpen || $canParticipate){ ?>	
		<div class="panel-heading border-light bg-azure">
			<h4 class="panel-title">
				<?php if($surveyOpen){ ?>
					<a href="#rooms.index.type.<?php echo $parentType; ?>.id.<?php echo (string)$parentId; ?>" class="lbh text-white-hover homestead">
						<i class="fa fa-connectdevelop"></i> 
						<?php echo Yii::t("rooms","COOPERATIVE SPACE",null,Yii::app()->controller->module->id); ?>
					</a>
					<?php if($canParticipate){ ?>
						<a  href="#rooms.editroom.type.<?php echo $parentType; ?>.id.<?php echo $parentId; ?>" 
							class="text-white pull-right helvetica tooltips lbh"
							data-toggle="tooltip" data-placement="left" title="Créer un nouvel espace"
						> 
							<i class="fa fa-plus-circle"></i> nouveau
						</a>
					<?php } ?>
				<?php } else { ?>
					<i class="fa fa-connectdevelop"></i> 
					<span class="homestead"><?php echo Yii::t("rooms","COOPERATIVE SPACE",null,Yii::app()->controller->module->id); ?></span>
					<?php if($canParticipate){ ?>
						<a  href="javascript:" onclick="updateField('<?php echo $parentTypeCreate; ?>','<?php echo (string)$parentId; ?>','modules',['survey'],true)" 
							class="text-white pull-right helvetica tooltips"
							data-toggle="tooltip" data-placement="left" title="Activer l'espace coopératif"

						> 
							<i class="fa fa-check-circle"></i> activer
						</a>				
					<?php } ?>
				
				<?php } ?>

			</h4>		
		</div>

		<?php if($surveyOpen){ ?>	
			<div class="panel-body no-padding">
				<div class="" id="main-pod-room">
					<?php $this->renderPartial('../pod/roomTable',array(    
					   					"history" => $history, 
				                        "moduleId" => $moduleId, 
				                        "discussions" => $discussions, 
				                        "votes" => $votes, 
				                        "actions" => $actions, 
				                        "nameParentTitle" => $nameParentTitle, 
				                        "parent" => $parent, 
				                        "parentId" => $parentId, 
				                        "parentType" => $parentType )
				                    ); 
				?>
		   		</div>
			</div>
		<?php } else if($canParticipate){ ?>
				
				<div class="panel-body no-padding">
					<div class="padding-20" id="main-pod-room">
						<blockquote class="">

			   				<i class="fa fa-info-circle"></i> Vous n'avez pas encore activé votre espace coopératif.<br>
			   				<strong><i class="fa fa-angle-down"></i> A quoi ça sert ?</strong><br><br>
			   				<span class="text-azure">
			   				<i class="fa fa-check-circle"></i> Discuter<br>
			   				<i class="fa fa-check-circle"></i> Débattre<br>
			   				<i class="fa fa-check-circle"></i> Proposer<br>
			   				<i class="fa fa-check-circle"></i> Voter<br>
			   				<i class="fa fa-check-circle"></i> Agir
			   				</span>
			   			</blockquote>
			   			
			   		</div>
				</div>
				<?php if($canEdit && !$surveyOpen && $parentType == Person::COLLECTION){ ?>
					<div class="panel-footer text-right">
						<button class="btn btn-primary" 
								onclick="loadByHash('#<?php echo $parentTypeCreate; ?>.detail.id.<?php echo $parentId; ?>')">
								<i class="fa fa-arrow-circle-left"></i> Retour
						</button>
						<button class="btn btn-success" 
								onclick="updateField('<?php echo $parentTypeCreate; ?>','<?php echo (string)$parentId; ?>','modules',['survey'],true)">
								<i class="fa fa-check"></i> Activer
						</button>
					</div>
				<?php } ?>
					
		<?php } ?>

	<?php } else if(!$canParticipate){ ?>
		<div id="pod-room" class="panel panel-white">

			<div class="panel-heading border-light bg-azure">
				<h4 class="panel-title">
						<i class="fa fa-connectdevelop"></i> 
						<span class="homestead"><?php echo Yii::t("rooms","COOPERATIVE SPACE",null,Yii::app()->controller->module->id); ?></span>
				</h4>		
			</div>

			<div class="panel-body no-padding">
				<blockquote>
				<?php if($parentType == Organization::COLLECTION){ ?>Accès réservé aux <strong>membres</strong> de l'organisation.<br><?php } ?>
				<?php if($parentType == Project::COLLECTION){ ?>Accès réservé aux <strong>contributeurs</strong> du projet.<br><?php } ?>
				<span class="text-azure">
	   				<i class="fa fa-check-circle"></i> Discuter<br>
	   				<i class="fa fa-check-circle"></i> Débattre<br>
	   				<i class="fa fa-check-circle"></i> Proposer<br>
	   				<i class="fa fa-check-circle"></i> Voter<br>
	   				<i class="fa fa-check-circle"></i> Agir
	   			</span>
	   			</blockquote>
			</div>   
				
		</div>

	<?php } ?>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		//change le titre global uniquement si on est sur le pod d'activation d'un citoyen
		<?php if($canEdit && !$surveyOpen && ($parentType == Person::COLLECTION || $parentType == City::COLLECTION)){ ?>
			setTitle("Activer votre espace coopératif","<i class='fa fa-connectdevelop'></i> <i class='fa fa-plus'></i>");
		<?php } ?>

		if($(".tooltips").length) {
	        $('.tooltips').tooltip();
	      }
	});
</script>
