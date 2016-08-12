<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript">
    $('head').append('<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/jquery-editable/css/jquery-editable.css" rel="stylesheet" />');
    $.fn.poshytip={defaults:null};
</script>
<script>
if($('#breadcum').length)$('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><a href="javascript:;" onclick="reverseToRepertory();">Répertoire</a><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><?php echo addslashes($element["name"]); ?>');
</script>
<?php 
		if($type != City::CONTROLLER && !@$_GET["renderPartial"])
			$this->renderPartial('../pod/headerEntity', array("entity"=>$element, "type" => $type)); 
		//End isset renderPartial
?>
<div class="row">
	<div class=" col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12">
			<div class="panel panel-white col-md-8 no-padding">
    		<?php 
    			$params = array(
    				"element" => $element,
					"tags" => $tags, 
					"images" => array("profil"=>array($element["profilImageUrl"])),
					"elementTypes" => @$listTypes,
					"countries" => $countries,
					"typeIntervention" => @$typeIntervention,
					"NGOCategories" => @$NGOCategories,
					"localBusinessCategories" => @$localBusinessCategories,
    				"contextMap" => @$contextMap,
    				"publics" => @$public,
					"type" => @$type,
					"organizer" =>@$organizer,
    				"contentKeyBase" => "profil"
    			);
    			$this->renderPartial('../pod/ficheInfoElement',$params); 
    		?>
    	</div>
		<div class="col-md-4 no-padding pull-right">
			<?php if($type != Person::COLLECTION){ ?>
			<div class="col-md-12 col-xs-12">
				<?php   $this->renderPartial('../pod/usersList', array(  $controller => $element,
														"users" => $members,
														"userCategory" => Yii::t("common","COMMUNITY"), 
														"contentType" => $type,
														"countStrongLinks" => $countStrongLinks,
														"countLowLinks" => $countLowLinks,
														"admin" => false	));
				?>
			</div>
			<?php } ?>
	    	<?php if (($type==Project::COLLECTION || $type==Organization::COLLECTION || $type==Event::COLLECTION) && !empty($events)){ ?>
			<div class="col-md-12 col-xs-12">
				<?php 
					$organizerImg=false;
					if($type==Event::COLLECTION) $organizerImg=true;
					if(!isset($eventTypes)) $eventTypes = array();
					$this->renderPartial('../pod/eventsList',array( 	"events" => $events, 
																		"contextId" => (String) $element["_id"],
																		"contextType" => $controller,
																		"list" => $eventTypes,
																		"authorised" => false,
																		"organiserImgs"=> $organizerImg
																	  )); ?>
				<?php 
					if($type==Project::COLLECTION && @$element["properties"] && @$element["properties"]["chart"] && !empty($element["properties"]["chart"])){ //|| $admin==true){
						$this->renderPartial('../project/pod/projectChart',array("itemId" => (string)$element["_id"], "itemName" => $element["name"], "properties" => $element["properties"]["chart"],"admin" =>false,"isDetailView" => 1)); //"admin" =>$admin,"isDetailView" => 1)); 
					}
				?>						  
			</div>
			<?php } ?>
			<?php if ($type==Organization::COLLECTION && !empty($projects)){ ?>
			<div class="col-md-12 col-xs-12">
	 			<?php $this->renderPartial('../pod/projectsList',array( "projects" => $projects, 
														"contextId" => (String) $element["_id"],
														"contextType" => $type,
														"authorised" =>	false
				)); ?>
			</div>
			<?php } ?>
		</div>
    	<div class="col-md-8 col-sm-12 no-padding pull-left">
	    	<?php if($type==Project::COLLECTION){ ?> 
				<div class="row padding-15">
					<hr>
					<h1 class="text-azure pull-left homestead no-margin">
		        		<i class='fa fa-angle-down'></i> <i class='fa fa-thumb-tack'></i> Gestion des tâches
		        	</h1>        
			    	</div>
			    	<div class="timesheetphp">
				</div>
			<?php } ?>
    	</div>
	</div>
</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	<?php if($type == Project::COLLECTION && (@$element["tasks"] && !empty($element["tasks"]))) {//|| $admin==true){ ?>
		getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo 
			$type ?>/id/<?php echo $element["_id"]?>/isAdmin/false/isDetailView/1",null,"html");
	<?php } ?>
});
</script>
