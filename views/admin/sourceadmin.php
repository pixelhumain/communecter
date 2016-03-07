<div class="panel panel-white">
	<div class="panel-heading text-center border-light">
		<h3 class="panel-title text-red"><i class="fa fa-map-marker"></i>   <?php echo Yii::t("common", "SOURCE ADMIN"); ?></h3>
	</div>
	<div class="panel-body">
		<h4 class="panel-title">Entité mal </h4>
		<br/>
		<table id="tableEntity" class="col-sm-12 col-xs-12">
			<tr>
				<th>Type</th>
				<th>Name</th>
				<th>Warnings</th>
			</tr>
			<?php 
				$chaine = "";
				//var_dump($entities);
				foreach ($entities as $keyEntities => $valueEntities) {
					//var_dump(count($valueEntities));
					foreach ($valueEntities as $key => $entity) {
						if(count($entity) > 0){
							//var_dump($entity);
							?>
							<tr>
								<td>
								</td>
								<td>
									<a  href='javascript:;' onclick='loadByHash("#<?php echo $key ; ?>.detail.id.<?php echo $entity['id'] ; ?>")' class=''>
										<?php echo $entity["name"]; ?> 
									</a>
								</td>
								<td> 
									<?php echo (empty($entity["warnings"])?"": Import::getMessagesWarnings($entity["warnings"])) ; ?>
								</td>
							</tr>
							<?php
						}
					}
					
				}
			?>

		</table>
	</div>
</div>

<script type="text/javascript">
$(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Import de données");
jQuery(document).ready(function() {
	bindCheckGeo();
});

function bindCheckGeo(){
	


}

</script>