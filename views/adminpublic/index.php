<div class="panel panel-white">
	<div class="panel-heading text-center border-light">
		<h3 class="panel-title text-red"><i class="fa fa-map-marker"></i>   <?php echo Yii::t("common", "SOURCE ADMIN"); ?></h3>
	</div>
	<div class="panel-body">
		<h4 class="panel-title">Entité mal </h4>
		<br/>
		<div><span id="nbWarnings"></span></div>
		<table id="tableEntity" class="col-sm-12 col-xs-12 table table-striped">
			<tr>
				<th>Name</th>
				<th>Warnings</th>
			</tr>
			<?php
				$nb = 0 ;
				$chaine = "";
				//var_dump($entitiesSourceAdmin);
				foreach ($entitiesSourceAdmin as $typeEntities => $entities) {
					$nb += count($entities);
					foreach ($entities as $key => $entity) {
						//var_dump($entity);
						if(count($entity) > 0){
							//var_dump($entity["warnings"]);
							?>
							<tr>
								<td>
									<a  href='javascript:;' onclick='loadByHash("#<?php echo $typeEntities ; ?>.detail.id.<?php echo $entity['id'] ; ?>")' class=''>
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

	var nbWarnings = "<?php echo $nb ?>" ;
	console.log(nbWarnings);
	$("#nbWarnings").html(nbWarnings);
	bindCheckGeo();
});

function bindCheckGeo(){
	


}

</script>