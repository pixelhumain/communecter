<?php
	$cs = Yii::app()->getClientScript();	
?>

<ul class="nav nav-tabs">
  <li class="active"><button class='btn btn-default' data-toggle="tab" data-target="tab-content" href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/admin/moderate/one')?>" id="one">Modérer un abus</button></li>
  <li><button class='btn btn-default' data-toggle="tab" data-target="tab-content"  href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/admin/moderate/all')?>">Global</button></li>
</ul>

<div class="tab-content"></div>


<script>
	jQuery(document).ready(function() {
		$('[data-toggle="tab"]').click(function(e) {
		    var $this = $(this),
		        loadurl = $this.attr('href'),
		        targ = $this.attr('data-target');

		    $.get(loadurl, function(data) {
		        $('.'+targ).html(data);
		    });

		    $this.tab('show');
		    return false;
		});

		$('#one').click();

	});
</script>