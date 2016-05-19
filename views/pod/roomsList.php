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

</style>

<div id="pod-room" class="panel panel-white">
	<div class="panel-heading border-light bg-azure">
		<h4 class="panel-title">
			<a href="javascript:" onclick="loadByHash('#rooms.index.type.organizations.id.<?php echo (string)$parentId; ?>');" class="text-white-hover">
				<i class="fa fa-connectdevelop"></i> 
				<?php echo Yii::t("rooms","COOPERATIVE SPACE",null,Yii::app()->controller->module->id); ?>
			</a>
			<a href="javascript:" onclick="updateField('organizations','<?php echo (string)$parentId; ?>','modules',['survey'],true)');" class="text-white pull-right homestead"> <i class="fa fa-plus-circle"></i></a>
		</h4>
		
	</div>
	<div class="panel-tools">
		<?php if( false ) { ?>
			<a class="tooltips btn btn-xs btn-light-blue" href="javascript:;" data-placement="top" data-toggle="tooltip" data-original-title="<?php echo Yii::t("event","Add new event",null,Yii::app()->controller->module->id) ?>" onclick="loadByHash('#event.eventsv.contextId.<?php echo $contextId ?>.contextType.<?php echo $contextType ?>')">
	    		
	    		<i class="fa fa-plus"></i> <?php echo Yii::t("event","Add new event",null,Yii::app()->controller->module->id) ?>
	    	</a>
		
		<?php
		 } ?>
	</div>
	
	<div class="panel-body no-padding">
		<div class="" id="main-pod-room">
			<?php 
				if($actions)
			   	$this->renderPartial('../pod/roomTable',array(    
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
</div>

<script type="text/javascript">
	
	jQuery(document).ready(function() {	 

		
	});

</script>