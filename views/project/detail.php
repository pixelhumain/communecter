<?php 
//if( isset($_GET["isNotSV"])) 
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-md-12">
		<div class="col-md-12">
		<?php 
			$this->renderPartial('pod/ficheInfo', array( "project" => $project, 
																"tags" => $tags, 
																"countries" => $countries,
																"isAdmin"=> $admin,
																"tasks" =>$tasks,
																"contributors" => $contributors,
																"properties" => $properties,
																"needs"=> $needs,
																"events" => $events
																));
			?>
			
		</div>
		<div class="col-md-4">
		<?php //$this->renderPartial('pod/contributors',array( "contributors" => $contributors, "organizationTypes" => $organizationTypes, "project" => $project, "admin" => $admin)); ?>
		</div>
		
	
	</div>
</div>

<script type="text/javascript">
	
jQuery(document).ready(function() {
getAjax(".needsPod",baseUrl+"/"+moduleId+"/needs/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo $project["_id"]?>/isAdmin/<?php echo $admin?>",null,"html");

});
</script>