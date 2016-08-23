
<div class="panel-heading border-light text-dark partition-white no-padding pull-left col-md-12">
    <span class="tpl_shortDesc col-md-12 no-padding pull-left">
      <span class="col-md-12 no-padding homestead pull-left">
    	  <span class=" text-red homestead tpl_title2 pull-left">
          <a href="#default.view.page.index.dir.docs"><i class="lbh fa fa-arrow-circle-left text-dark"></i></a> 
          <i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $title; ?>
        </span>
        <?php $this->renderPartial("../docs/docPattern/docIndex", array("icon"=>$icon)); ?>
      </span>
      <br>
	    <span class=" col-md-12 text-dark pull-left">
	    	<span class="text-dark homestead"><?php echo $stitle; ?></span><br>
	      <?php echo $description; ?>
      </span>
      
    </span>
</div>