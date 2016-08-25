<style>
	.headerHome{
		margin-top:-11px;
		background-color:#f2f3f4;
		moz-box-shadow: 0px 2px 4px -3px #656565;
		-webkit-box-shadow: 0px 2px 4px -3px #656565;
		-o-box-shadow: 0px 2px 4px -3px #656565;
		box-shadow: 0px 2px 4px -3px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
	}
	.btn-go-home {
	    margin-top: 33%;
	    font-size: 23px;
	}
	.btn-go-home-sm {
		font-size: 19px;
		font-weight: 100 !important;
		position: absolute;
		bottom: 23%;
		right: 20%;
	}
	.btn-go-home-xs {
		font-size: 11px;
		font-weight: 100 !important;
		position: absolute;
		bottom: 23%;
		right: 20%;
		padding: 1px 3px;
	}
</style>
<div class="col-md-8 no-padding">
	<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/headmug.png">

	<a href="#default.home" class="lbh btn bg-azure btn-go-home-sm homestead visible-sm">
		<i class="fa fa-angle-right"></i> En savoir plus
	</a>
	<a href="#default.home" class="lbh btn bg-azure btn-go-home-xs homestead visible-xs">
		<i class="fa fa-angle-right"></i> En savoir plus
	</a>

</div>

<div class="col-md-4 no-padding center hidden-sm hidden-xs">
	<a href="#default.home" class="lbh btn bg-azure btn-go-home homestead"><i class="fa fa-angle-right"></i> En savoir plus</a>
</div>