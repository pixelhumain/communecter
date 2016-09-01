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
		bottom: 54%;
		right: -36%;
	    font-size: 20px;
	}
	.btn-go-home-sm {
		font-size: 15px;
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
		bottom: 30%;
		right: -36%;
	    font-size: 20px;
	}
	.btn-co-sm {
		font-size: 15px;
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
<div class="col-md-8 no-padding header-home">
	<img class="img-responsive" src="<?php echo $this->module->assetsUrl; ?>/images/headmug.png">

	<a href="#default.home" class="lbh btn bg-azure btn-go-home-sm homestead visible-sm">
		<i class="fa fa-angle-right"></i> En savoir plus
	</a>
	<a href="javascript:;" class="toggle-scope-dropdown btn btn-xs bg-red btn-co-sm homestead btn-geoloc-auto visible-sm tooltips"
		data-toggle="tooltip" data-placement="right" title="Communectez-moi">
		<i class="fa fa-crosshairs"></i>
	</a>
	
	<a href="#default.home" class="lbh btn bg-azure btn-go-home-xs homestead visible-xs">
		<i class="fa fa-angle-right"></i> En savoir plus
	</a>
	<a href="javascript:;" class="toggle-scope-dropdown btn btn-xs bg-red btn-co-xs homestead visible-xs btn-geoloc-auto tooltips"
		data-toggle="tooltip" data-placement="right" title="Communectez-vous">
		<i class="fa fa-home"></i>
	</a>

	<a href="#default.home" class="lbh btn bg-azure btn-go-home homestead hidden-sm hidden-xs">
		<i class="fa fa-angle-right"></i> En savoir plus
	</a>
	<a href="javascript:;" class="toggle-scope-dropdown btn bg-red btn-co homestead btn-geoloc-auto hidden-sm hidden-xs">
		<i class="fa fa-angle-right"></i> Communectez-vous <i class="fa fa-home"></i>
	</a>

</div>


<script type="text/javascript">

jQuery(document).ready(function() {
	/*
	$(".btn-geoloc-auto").click( function(e){
		e.preventDefault();
		console.log("cookie", $.cookie('inseeCommunexion'));
    	if($.cookie('inseeCommunexion')){
    		loadByHash("#city.detail.insee." + $.cookie('inseeCommunexion')+ ".postalCode." + $.cookie('cpCommunexion'));
    	}else{
    		if(geolocHTML5Done == false){
				//$(".search-loader").html("<i class='fa fa-spin fa-circle-o-notch'></i> Géolocalisation en cours ...");		
				
	    		initHTML5Localisation('communexion');
			}
    	}

    })*/

    $(".toggle-tag-dropdown").click(function(){ console.log("toogle");
		if(!$("#dropdown-content-multi-tag").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-tag").addClass('open'); }, 300);
		$("#dropdown-content-multi-tag").addClass('open');
	});

	$(".toggle-scope-dropdown").click(function(){ console.log("toogle");
		if(!$("#dropdown-content-multi-scope").hasClass('open'))
		setTimeout(function(){ $("#dropdown-content-multi-scope").addClass('open'); }, 300);
	});
});
</script>