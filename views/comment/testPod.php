<?php
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
?>

	<div class="col-lg-4 col-md-6 col-sm-12">
		<div class="row">
	    	<div class="col-sm-12 col-xs-12 documentPod">
	    		<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Blabla Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	    	</div>
	    </div>
	</div>

	<div class="col-lg-4 col-md-6 col-sm-12">
	 	<div class="row">
	 		<div class="col-sm-12 col-xs-12 commentPod">
	 			<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Comment Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	 		</div>
	 	</div>
	</div>
	
	<div class="col-lg-4 col-md-6 col-sm-12">
	 	<div class="row">
	 		<div class="col-sm-12 col-xs-12 photoVideoPod">
	 			<div class="panel panel-white pulsate">
					<div class="panel-heading border-light ">
						<h4 class="panel-title"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Survey Section</h4>
						<div class="space5"></div>
					</div>
				</div>
	 		</div>
	 	</div>
	</div>


<!-- end: PAGE CONTENT-->
<script>

	jQuery(document).ready(function() {
		getAjax(".commentPod",baseUrl+"/"+moduleId+"/comment/index/type/news/id/5591485d2336f28d290041ba",null,"html");
	});

</script>