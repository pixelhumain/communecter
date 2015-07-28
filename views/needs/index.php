<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-cubes fa-2x text-blue"></i> NEEDS </h4>
	</div>
	<div class="panel-body">
		<div>	
			<div>	
			<table class="table table-striped table-bordered table-hover  directoryTable">
				<thead>
					<tr>
						<th>Type</th>
						<th>Name</th>
						<th>Quantity</th>
						<th>Benefits</th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<tr id="">
						<td class="organizationLine">
							<i class="fa fa-gears fa-2x text-blue"></i> Services and Competences
						</td>
						<td ><a href="#showNeed">Recherche développeur</a></td>
						<td>
							2
						</td>
						<td>
							Bénévoles
						</td>
						<td>
							<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/needs/dashboard/type/".$_GET["type"]."/id/".$_GET["id"]."") ?>" class="btn showNeed"><i class="fa fa-chevron-circle-right"></i></a>						</td>

					</tr>
					<tr id="">
						<td class="organizationLine">
							<i class="fa fa-bullhorn fa-2x text-blue"></i> Materials
						</td>
						<td ><a href="#showNeed" class="showNeed">Tables</a></td>
						<td>	
							4
						</td>
						<td>
							30-40 €
						</td>
						<td>
							<a href="<?php echo Yii::app()->createUrl("/".$this->module->id."/needs/dashboard/type/".$_GET["type"]."/id/".$_GET["id"]."") ?>" class="btn showNeed"><i class="fa fa-chevron-circle-right"></i></a>
						</td>
					</tr>
				</tbody>
			</table>
						<!--//Conditipon zéro 
				<div id="infoPodOrga" class="padding-10">
				<blockquote> 
					Create needs
					<br>Materials  
					<br>Knowledge
					<br>Skills
					<br>to call ressources that you need
				</blockquote>
			</div>
			-->
		</div>
	</div>
</div>
<?php
//  $this->renderPartial('description', array());
?>
<script>
jQuery(document).ready(function() {
	$(".showNeed").click(function(){
		getAjax(".showNeed",baseUrl+"/"+moduleId+"/needs/dashboard/type/<?php echo Project::COLLECTION ?>/id/<?php echo $_GET["id"]?>",null,"html");
	});
});
</script>