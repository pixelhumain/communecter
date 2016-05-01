<?php
echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js');
echo CHtml::cssFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/css/DT_bootstrap.css');
echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/DT_bootstrap.js');
?>

<!-- <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#news">News</a></li>
  <li><a data-toggle="tab" href="#comments">Comments</a></li>
</ul>

<div class="tab-content">
	<div id="news" class="tab-pane fade in active">
		<?php //$this->renderPartial('moderateNews', array("news" => $news)); ?>
	</div>
  	<div id="comments" class="tab-pane fade">
  		<?php //$this->renderPartial('moderateComments', array("comments" => $comments)); ?>
  	</div>
</div> -->

<?php $this->renderPartial('moderateNews', array("news" => $news)); ?>