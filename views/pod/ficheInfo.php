<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"> <?php echo (isset($context)) ? $context["name"] : null; ?></h4>
	</div>
	<div class="panel-body border-light">
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<img width="100%" src="<?php echo (isset($context["imagePath"])) ? $context["imagePath"] : null; ?>" />
			</div>
			<div class="col-sm-6 col-xs-6">
				<span><i class="fa fa-street"></i> <?php echo (isset( $context["address"]["streetAddress"])) ? $context["address"]["streetAddress"] : null; ?></span>
				<br>
				<span><i class="fa fa-street"></i> <?php echo (isset( $context["address"]["postalCode"])) ? $context["address"]["postalCode"] : null; ?>  <?php echo (isset( $context["address"]["addressCountry"])) ? $context["address"]["addressCountry"] : null; ?></span>
			</div>
		</div>
	</div>
</div>