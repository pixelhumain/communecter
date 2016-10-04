<div class="panel panel-white">
	<div class="panel-heading text-center border-light">
		<h3 class="panel-title text-red"><i class="fa fa-map-marker"></i>   <?php echo Yii::t("common", "SOURCE ADMIN"); ?></h3>
	</div>
	<div class="panel-body">
		<h4 class="panel-title"><span id="nbWarnings"></span> Eléments </h4>
		<br/>
		<div></div>
		<table id="tableEntity" class="col-xs-12 table table-striped">
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
							if(Person::CONTROLLER == $typeEntities){
		                        $contextIcon = "user text-yellow";
		                    }
		                    else if(Organization::CONTROLLER == $typeEntities){
		                        $contextIcon = "users text-green";
		                    }
		                    else if(Event::CONTROLLER == $typeEntities){
		                        $contextIcon = "calendar text-orange";
		                    }
		                    else if(Project::CONTROLLER == $typeEntities){
		                        $contextIcon = "lightbulb-o text-purple";
		                    } 
							?>
							<tr>
								<td>
									<i class='fa fa-<?php echo $contextIcon;?> '></i> 

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
var mapData = <?php echo json_encode($contextMap) ?>;
jQuery(document).ready(function() {
	setTitle("Espace administrateur : Import de données","cog");
	var nbWarnings = "<?php echo $nb ?>" ;
	console.log(nbWarnings);
	$("#nbWarnings").html(nbWarnings);
	bindCheckGeo();
	console.log("herrerer");
	console.dir(mapData);
	Sig.restartMap();
	Sig.showMapElements(Sig.map, mapData);
});

function bindCheckGeo(){
	


}

</script>