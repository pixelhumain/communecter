<style>
  .carousel-control{
    /*background-image: unset !important;*/
  }
  .carousel-control{
    color:#000;
  }
  #docCarousel{
    box-shadow: 0px 0px 10px 0px rgb(95, 95, 95);
    padding: 0px 5%;
    margin-bottom:50px;
  }
  .carousel-indicators{
    bottom: -40px;
  }
  .carousel-indicators li {
    background-color: grey;
  }
  .carousel-indicators li.active {
    background-color: black;
  }
</style>
<div id="docCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#docCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#docCarousel" data-slide-to="1"></li>
    <li data-target="#docCarousel" data-slide-to="2"></li>
    <li data-target="#docCarousel" data-slide-to="3"></li>
    <li data-target="#docCarousel" data-slide-to="4"></li>
    <li data-target="#docCarousel" data-slide-to="5"></li>
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
  $(".moduleLabel").html("<i class='fa fa-file'></i> DOCUMENTATION");
});
</script>