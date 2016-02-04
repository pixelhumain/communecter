<div class="row">
	<div class="col-md-12">
		<div class="page-error animated shake ">
			<div class="space20"></div>
			<div class="error-details col-sm-6 col-sm-offset-3  panel-white padding-20">
				<div class="error-number text-azure">
					<?php echo $error["code"]?>
				</div>
				<h3>
					<?php 
					if( isset($error["message"]) )
						echo $error["message"];
					else
						echo Yii::t("common","Oops! You are stuck at",null,Yii::app()->controller->module->id).$error["code"];
					?>
				</h3>
				<p>
					<?php echo Yii::t("common","Unfortunately the page you were looking for could not be found.",null,Yii::app()->controller->module->id);?>
					<br>
					<?php echo Yii::t("common","It may be temporarily unavailable, moved or no longer exist.",null,Yii::app()->controller->module->id);?>
					<br>
					<?php echo Yii::t("common","Check the URL you entered for any mistakes and try again.",null,Yii::app()->controller->module->id);?>
					<br>
					<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id);?>" class="btn btn-red btn-return">
						<?php echo Yii::t("common","Return home",null,Yii::app()->controller->module->id);?>
					</a>
				</p>
				
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->
