<?php
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/mixitup/src/jquery.mixitup.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-gallery.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<style type="text/css">
	.gallery-img img{
		width: 100%;
		height: 175px;
	}

	.panel-tools{
		filter: alpha(opacity=1);
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
		-moz-opacity: 1;
		-khtml-opacity: 1;
		opacity: 1;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Invite tes amis</h4>
				<div class="panel-tools">
					<a href="javascript:;" id="backToDashboardBtn" class="btn btn-xs btn-blue">Back</a>
				</div>
			</div>
			<div class="panel-body">
					<!-- <a href=<?php //echo '"'.$login_url_FB . '"' ;?> 
				            class="btn btn-primary col-md-3 col-md-offset-2">
				            Facebook
				    </a> -->
				    
				    <a href=<?php echo '"'.Yii::app()->getRequest()->getBaseUrl(true) . '/communecter/person/google"' ;?> 
				            class="btn btn-primary col-md-3">
				            Google
				    </a>
				    
				   <!-- <a href=<?php //echo '"'.Yii::app()->getRequest()->getBaseUrl(true) . '/communecter/person/yahoo"' ;?> 
				            class="btn btn-primary col-md-3 col-md-offset-2">
				            Yahoo
				    </a> -->
				    <a href=<?php echo '"'.Yii::app()->getRequest()->getBaseUrl(true) . '/communecter/person/importfile"' ;?> 
				            class="btn btn-primary col-md-3 col-md-offset-1">
				            Import CSV
				    </a>
				    
				    <a href=<?php echo '"'.Yii::app()->getRequest()->getBaseUrl(true) . '/communecter/person/saisir"' ;?> 
				            class="btn btn-primary col-md-3 col-md-offset-1">
				            Saisir Email
				    </a>
				<hr/>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->

<script type="text/javascript">


</script>