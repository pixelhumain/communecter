
	<div class="panel panel-white user-list">
		<div class="panel-heading border-light bg-dark">
			<h4 class="panel-title"><i class="fa fa-marker-map"></i> Point d'intéret</h4>		
		</div> 
		<div class="panel-tools">
			<a  href="javascript:;" onclick="openForm('poi','subPoi')" 
				class="btn btn-xs btn-default tooltips" data-placement="bottom" 
				data-original-title="<?php echo Yii::t("event","Create new POI") ?>" >
					<i class="fa fa-plus"></i> <?php echo Yii::t("common","Create new POI") ?>
			</a>
		</div>
		<div class="panel-scroll height-230 ps-container">
			<div class="padding-10">
			
				<?php 
				$pois = PHDB::find(Poi::COLLECTION,array("parentId"=>$parentId,"parentType"=>$parentType));
				if(empty($pois)){ ?>
				<div class="padding-10">
					<blockquote class="no-margin">
					<?php echo Yii::t("common","Ajouter des points d'interets à cet élément");  ?>
					</blockquote>
				</div>
			<?php }
			else{
				
				foreach ($pois as $p) { 
					?>
					<div style="border-bottom:1px solid #ccc">
						<?php 
						echo $p["name"];
						if(@$p["geo"]){
						?>
						<a href="javascript:showMap(true);"><i class="fa fa-map-marker"></i></a>
						<?php }?>
					</div>
					<?php
				}
			}?>
			</div>
		</div>
	</div>