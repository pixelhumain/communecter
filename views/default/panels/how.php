<div class="box-how box">
	<h1><i class="fa fa-laptop"></i> <?php echo Yii::t("common","HOW",null,Yii::app()->controller->module->id) ?></h1>
	<section>
		<a href="#" onclick="showPanel('box-people')">People</a>, 
		<a href="#" onclick="showPanel('box-orga')">Organizations</a>, 
		<a href="#" onclick="showPanel('box-event')">Events</a> and 
		<a href="#" onclick="showPanel('box-projects')">Projects</a>
		<br/> Connected Smart <a href="#" onclick="showPanel('box-projects')">Cities & Territories</a>
		<br/> Computers and more people 
		<br/> Make a good mix 
		<br/> Build Great Things
		<br/> Societal Innovation
		<br/> Collective Imagination
		<br/> Open source 
	</section>
	<a href="#" onclick="showPanel('box-when','bgyellow')" class="homestead nextBtns pull-right"><?php echo Yii::t("common","WHEN",null,Yii::app()->controller->module->id) ?> <i class="fa fa-arrow-circle-o-right"></i></a>
</div>