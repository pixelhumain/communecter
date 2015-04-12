<style>

</style>

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
				<br>
				<span>Tél : </span>
				<br>
				<span><?php echo (isset($context["email"])) ? $context["email"] : null; ?></span>
				<br>
				<span> <?php echo (isset($context["url"])) ? $context["url"] : null; ?></span>
			</div>
		</div>
		<div class="row">
			<span> <?php echo (isset($context["description"])) ? $context["description"] : null; ?></span>
		</div>
		<div class="row" style="background-color:#E6E6E6">
			<div class="col-sm-6 col-xs-6">
				<h1> Activités</h1>
			</div>
			<div class="col-sm-6 col-xs-6">
				<h1> Thématiques</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<span> <?php echo (isset($context["typeIntervention"])) ? implode(",", $context["typeIntervention"]) : null; ?>
			</div>
			<div class="col-sm-6 col-xs-6">
				<span> <?php echo (isset($context["tags"])) ? implode(",", $context["tags"]) : null; ?>
			</div>
		</div>
		<div class="row" style="background-color:#E6E6E6">
			<div class="col-sm-6 col-xs-6">
				<h1> Public</h1>
			</div>
			<div class="col-sm-6 col-xs-6">
				<h1> Telechargement</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-6">
				<span>Tous public</span>
			</div>
			<div class="col-sm-6 col-xs-6">
				<a href="#">Plaquette de presentation</a>
			</div>
		</div>
	</div>
</div>