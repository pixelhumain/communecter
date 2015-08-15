<div class="row">
	<div class="col-md-12">
		<div class="page-error animated shake">
			<div class="error-number text-azure">
				<?php echo $error["code"]?>
			</div>
			<div class="error-details col-sm-6 col-sm-offset-3">
				<h3>
					<?php 
					if( isset($error["message"]) )
						echo $error["message"];
					else
						echo "Oops! You are stuck at ".$error["code"];
					?>
				</h3>
				<p>
					Unfortunately the page you were looking for could not be found.
					<br>
					It may be temporarily unavailable, moved or no longer exist.
					<br>
					Check the URL you entered for any mistakes and try again.
					<br>
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id);?>" class="btn btn-red btn-return">
						Return home
					</a>
				</p>
				
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->
