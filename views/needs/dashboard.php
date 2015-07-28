<div class="row">
	<div class="col-md-12 no-padding">
		<div class="col-lg-4 col-md-12">
			<?php 
				$this->renderPartial('dashboard/informations',array());
			 ?>
		</div>
		<div class="col-lg-4 col-md-12">
			<?php 
				$this->renderPartial('dashboard/description',array());
			 ?>
		</div>
		<div class="col-lg-4 col-md-12">
			<?php 
				$this->renderPartial('dashboard/helpers',array());
			 ?>
		</div>
	</div>
	<div class="col-md-12 no-padding" id="commentNeed">
	</div>
</div>

<script>
jQuery(document).ready(function() {
	getAjax("#commentNeed",baseUrl+"/"+moduleId+"/comment/index/type/<?php echo $_GET["type"];?>/id/<?php echo $_GET["id"];?>",null,"html");

});
</script>
