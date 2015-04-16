<?php
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/mixitup/src/jquery.mixitup.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-gallery.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Gallery</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li>
								<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a class="panel-refresh" href="#">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a class="panel-expand" href="#">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="controls">
					<h5>Filter Controls</h5>
					<ul class="nav nav-pills">
						<li class="filter active" data-filter="all">
							<a href="#">
								Show All
							</a>
						</li>
						<li class="filter" data-filter=".category_1">
							<a href="#">
								Category 1
							</a>
						</li>
						<li class="filter" data-filter=".category_2">
							<a href="#">
								Category 2
							</a>
						</li>
						<li class="filter" data-filter=".category_3">
							<a href="#">
								Category 3
							</a>
						</li>
						<li class="filter" data-filter=".category_3, .category_1">
							<a href="#">
								Category 1 &amp; 3
							</a>
						</li>
					</ul>
				</div>
				<hr/>
				<!-- GRID -->
				<ul id="Grid" class="list-unstyled">
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_1 gallery-img" data-cat="1">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image01.jpg" data-lightbox="gallery" data-title="Website">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image01.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Website </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_2 gallery-img" data-cat="2">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image02.jpg" data-lightbox="gallery" data-title="Brand">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image02.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Brand </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_3 gallery-img" data-cat="3">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image03.jpg" data-lightbox="gallery" data-title="Logo">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image03.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Logo </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_3 gallery-img" data-cat="3">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image04.jpg" data-lightbox="gallery" data-title="Website">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image04.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Website </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_1 gallery-img" data-cat="1">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image05.jpg" data-lightbox="gallery" data-title="Brand">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image05.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Website </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_3 gallery-img" data-cat="3">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image06.jpg" data-lightbox="gallery" data-title="Brand">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image06.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Website </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_2 gallery-img" data-cat="2">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image07.jpg" data-lightbox="gallery" data-title="Website">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image07.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Brand </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="col-md-3 col-sm-6 col-xs-12 mix category_1 gallery-img" data-cat="1">
						<div class="portfolio-item">
							<a class="thumb-info" href="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image08.jpg" data-lightbox="gallery" data-title="Logo">
								<img src="<?php echo Yii::app()->theme->baseUrl?>/assets/images/image08.jpg" class="img-responsive" alt="">
								<span class="thumb-info-title"> Logo </span>
							</a>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#">
									<i class="fa fa-link"></i>
								</a>
								<a href="#">
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#">
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					<li class="gap"></li>
					<!-- "gap" elements fill in the gaps in justified grid -->
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->

<script type="text/javascript">
jQuery(document).ready(function() {
	$('#Grid').mixItUp();
	$('.portfolio-item .chkbox').bind('click', function () {
        if ($(this).parent().hasClass('selected')) {
            $(this).parent().removeClass('selected').children('a').children('img').removeClass('selected');
        } else {
            $(this).parent().addClass('selected').children('a').children('img').addClass('selected');
        }
    });
});
</script>