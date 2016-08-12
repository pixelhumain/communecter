<style>
	#panel-first-step{
		text-align: center;
		margin-top:20px;
	}
	#panel-first-step button{
		margin-bottom:5px;
	}
</style>

<?php if(isset(Yii::app()->session['userId'])) { ?>

<div class="col-md-12" id="panel-first-step">
	<button class="btn bg-orange lbh" data-hash="#event.eventsv"><i class="fa fa-calendar-plus-o"></i> <?php echo Yii::t("event","Add an event") ?></button></br>
	<label><?php echo Yii::t("event","You organize an event ? Share it in the agenda !")?> </label>
</div>

<?php } ?>