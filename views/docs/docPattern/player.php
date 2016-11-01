<?php 
$this->renderPartial("../docs/assets");
?>
<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#docCarousel" data-slide-to="1"></li>
    <li data-target="#docCarousel" data-slide-to="2"></li>
    <li data-target="#docCarousel" data-slide-to="3"></li>
    <li data-target="#docCarousel" data-slide-to="4"></li>
    <li data-target="#docCarousel" data-slide-to="5"></li>
    <li data-target="#docCarousel" data-slide-to="6"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/schemas/schema-global-12.png" class="col-sm-12 img-responsive ">
    </div>

    <div class="item">
      <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/schemas/schema-global-22.png" class="col-sm-12 img-responsive ">
    </div>

    <div class="item">
      <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/schemas/schema-global-32.png" class="col-sm-12 img-responsive ">
    </div>

    <div class="item">
      <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/schemas/schema-global-42.png" class="col-sm-12 img-responsive ">
    </div>
    <div class="item">
      <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/schemas/schema-global-52.png" class="col-sm-12 img-responsive ">
    </div>

    <div class="item">
      <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/schemas/schema-global-62.png" class="col-sm-12 img-responsive ">
    </div>

    <div class="item">
      <img src="<?php echo $this->module->assetsUrl; ?>/images/docs/schemas/schema-global-72.png" class="col-sm-12 img-responsive ">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#docCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#docCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<script type="text/javascript">
  
jQuery(document).ready(function() {
  setTitle("DOCUMENTATION","file");
});
</script>