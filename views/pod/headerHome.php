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
	    position: absolute;
		bottom: 56%;
		right: -36%;
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
	.btn-co {
	    position: absolute;
		bottom: 29%;
		right: -44%;
	    font-size: 23px;
	}
	.btn-co-sm {
		font-size: 19px;
		font-weight: 100 !important;
		position: absolute;
		bottom: 45%;
		left: 2%;
	}
	.btn-co-xs {
		font-size: 11px;
		font-weight: 100 !important;
		position: absolute;
		bottom: 45%;
		left: 2%;
		padding: 1px 3px;
	}
</style>
<div class="col-md-8 no-padding">
	<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/headmug.png">

	<a href="#default.home" class="lbh btn bg-azure btn-go-home-sm homestead visible-sm"><i class="fa fa-angle-right"></i> En savoir plus</a>
	<a href="javascript:;" class="btn btn-xs bg-red btn-co-sm homestead btn-geo-auto visible-sm"> <i class="fa fa-crosshairs"></i></a>
	
	<a href="#default.home" class="lbh btn bg-azure btn-go-home-xs homestead visible-xs"><i class="fa fa-angle-right"></i> En savoir plus</a>
	<a href="javascript:;" class="btn btn-xs bg-red btn-co-xs homestead visible-xs btn-geo-auto"> <i class="fa fa-crosshairs"></i></a>

	<a href="#default.home" class="lbh btn bg-azure btn-go-home homestead hidden-sm hidden-xs"><i class="fa fa-angle-right"></i> En savoir plus</a>
	<a href="javascript:;" class="lbh btn bg-red btn-co homestead btn-geo-auto hidden-sm hidden-xs"><i class="fa fa-angle-right"></i> Communectez-moi <i class="fa fa-crosshairs"></i></a>

</div>


<script type="text/javascript">

jQuery(document).ready(function() {
	$(".btn-geo-auto").on("click",function(e){
		e.preventDefault();
		alert();
    	
    })
});
</script>