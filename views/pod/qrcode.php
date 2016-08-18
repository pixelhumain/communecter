<div class="space20"></div>
<div class="<?php echo (@$class) ? $class : 'row' ?> hidden margin-5 qrCodeContainerCl" id="qrCodeContainer"> 
	
	<div  class="col-xs-12 col-md-6">
		<div class="col-xs-12 col-md-3 qrCode"> </div>
		<div  class="col-xs-12 col-md-9 padding-5">
			<ul style="list-style: none">
				<?php echo (@$name) ? "<li>".$name."</li>" : '' ?>
				<?php echo (@$address) ? "<li>".$address."</li>" : '' ?>
				<?php echo (@$email) ? "<li>".$email."</li>" : '' ?>
				<?php echo (@$url) ? "<li>".$url."</li>" : '' ?>
				<?php echo (@$tel) ? "<li>".$tel."</li>" : '' ?>
			</ul>
		</div>
	</div>

	<?php if(@$img){ ?>
		<div  class="col-xs-12 col-md-6">
			<div class="col-xs-12 col-md-3">
				<img width="150" src="<?php echo (@$img) ?$img : '' ?>">
			</div>
			<div  class="col-xs-12 col-md-9 padding-5">
				<ul style="list-style: none">
					<?php echo (@$name) ? "<li>".$name."</li>" : '' ?>
					<?php echo (@$address) ? "<li>".$address."</li>" : '' ?>
					<?php echo (@$email) ? "<li>".$email."</li>" : '' ?>
					<?php echo (@$url) ? "<li>".$url."</li>" : '' ?>
					<?php echo (@$tel) ? "<li>".$tel."</li>" : '' ?>
				</ul>
			</div>
		</div>
	<?php } ?>

	<a class="explainLink btn btn-default btn-sm" data-id="qrCodeExplain" href="">En savoir plus <i class="fa fa-question-circle"></i></a>

</div>