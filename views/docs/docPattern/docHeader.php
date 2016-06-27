
<div class="panel-heading border-light text-dark partition-white no-padding pull-left col-md-12">
    <span class="tpl_shortDesc col-md-7">
      <span class="col-md-12 no-padding homestead">
    	  <span class=" text-red homestead tpl_title2 pull-left">
          <i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $title; ?>
        </span>
        <?php $this->renderPartial("../docs/docPattern/docIndex"); ?>
      </span>
      <br>
	    <span class=" text-dark homestead">
	    	<span class="text-dark"><?php echo $stitle; ?></span>
	    </span><br>
	    <?php echo $description; ?>
    </span>
</div>