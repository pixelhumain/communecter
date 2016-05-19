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

	#pod-room .panel-title a.text-white-hover:hover{
		color:white !important;
		text-decoration: underline !important;
	}*/

	.nav-menu-rooms{
		margin-top:-2px;
	}

.nav-menu-rooms.nav-tabs > li a{
	font-size:17px !important;
}
#pod-room .panel-title a.helvetica{
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-weight: 500;
	font-size:15px !important;
}

</style>
<?php 
	$surveyOpen = !isset($empty); //(isset($organization["modules"]) && in_array("survey", $organization["modules"]));
	$canEdit = (isset($parentId) && isset($parentType) && isset(Yii::app()->session["userId"])
			&& Authorisation::canEditItem(Yii::app()->session["userId"], $parentType, $parentId));

	//echo $canEdit ? "true" : "false";
?>
<div id="pod-room" class="panel panel-white">

<?php 
	$parentTypeCreate = "";
	if($parentType == "projects") 		$parentTypeCreate = "project";
	if($parentType == "organizations") 	$parentTypeCreate = "organization"; 
?>

	<?php if($surveyOpen || $canEdit){ ?>	
		<div class="panel-heading border-light bg-azure">
			<h4 class="panel-title">
				<?php if($surveyOpen){ ?>
				<a href="javascript:" onclick="loadByHash('#rooms.index.type.<?php echo $parentType; ?>.id.<?php echo (string)$parentId; ?>');" class="text-white-hover homestead">
					<i class="fa fa-connectdevelop"></i> 
					<?php echo Yii::t("rooms","COOPERATIVE SPACE",null,Yii::app()->controller->module->id); ?>
				</a>
				<a href="javascript:" onclick="loadByHash('#rooms.editroom.type.<?php echo $parentType; ?>.id.<?php echo $parentId; ?>');" class="text-white pull-right homestead"> <i class="fa fa-plus-circle"></i></a>
				<?php } else { ?>
					<i class="fa fa-connectdevelop"></i> 
					<?php echo Yii::t("rooms","COOPERATIVE SPACE",null,Yii::app()->controller->module->id); ?>
					<a href="javascript:" onclick="updateField('<?php echo $parentTypeCreate; ?>','<?php echo (string)$parentId; ?>','modules',['survey'],true)" class="text-white pull-right helvetica"> <i class="fa fa-check-circle"></i> activer</a>
				
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
		<?php } else if($canEdit){ ?>
				
				<div class="panel-body no-padding">
					<div class="padding-20" id="main-pod-room">
						<blockquote class="">

			   				Vous n'avez pas encore activé votre espace coopératif.<br><br>

			   				<i class="fa fa-circle-o"></i> Discuter<br>
			   				<i class="fa fa-circle-o"></i> Débattre<br>
			   				<i class="fa fa-circle-o"></i> Proposer<br>
			   				<i class="fa fa-circle-o"></i> Voter<br>
			   				<i class="fa fa-circle-o"></i> Agir
			   			</blockquote>
			   			
			   		</div>
				</div>

		<?php } ?>

	<?php } ?>
</div>

<script type="text/javascript">
	
	jQuery(document).ready(function() {	 

		
	});

</script>