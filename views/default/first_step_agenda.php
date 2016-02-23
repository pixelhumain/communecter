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
	<button class="btn bg-orange" onclick="loadByHash('#event.eventsv');"><i class="fa fa-calendar-plus-o"></i> Ajouter un événement</button></br>
	<label>Vous organisez un événement ? Paragez-le dans l'agenda !</label>
</div>

<?php } ?>