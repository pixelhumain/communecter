<?php 
//if( isset($_GET["isNotSV"])) 
$this->renderPartial('../default/panels/toolbar'); 
?>
<div class="row">
	<div class=" col-md-12">
		<?php 
			$this->renderPartial('dashboard/description',array( "project" => $project, 
																"tags" => $tags, 
																"countries" => $countries,
																"isAdmin"=> $admin)); ?>
	</div>
</div>

<script type="text/javascript">
	
jQuery(document).ready(function() {

});
</script>