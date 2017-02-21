
	<div class="panel panel-white user-list">
		<div class="panel-heading border-light bg-light">
			<h4 class="panel-title"><i class="fa fa-map-marker"></i> Collection</h4>		
		</div> 
		<div class="panel-tools">
			<a  href="javascript:collection.crud();" onclick="collection.new(contextData.type,contextData.id)" 
				class="btn btn-xs btn-default tooltips" data-placement="bottom" 
				data-original-title="<?php echo Yii::t("common","Add") ?>" >
					<i class="fa fa-plus"></i> <?php echo Yii::t("common","Add") ?>
			</a>
		</div>
		<div class="panel-scroll height-230 ps-container">
			<div class="">
			
			<?php 
			if(empty($collections)){ ?>
				<div class="padding-10">
					<blockquote class="no-margin">
					<?php echo Yii::t("common","Ajouter des collections");  ?>
					</blockquote>
				</div>
			<?php }
			else{
				foreach ($collections as $nom => $list) { ?>
					<div style="border-bottom:1px solid #ccc">
						<a class="btn-open-collection" href="javascript:smallMenu.openAjax(baseUrl+'/'+moduleId+'/collections/list/col/<?php echo $nom?>','<?php echo $nom?>','fa-folder-open','yellow')"><i class="fa fa-folder-open text-yellow"></i>  <?php echo $nom?> </a>
					</div>
			<?php }} ?>
			</div>
		</div>
	</div>
