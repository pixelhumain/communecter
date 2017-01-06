<?php 
	$cssAnsScriptFiles = array(
		'/assets/css/circle.css',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles, Yii::app()->theme->baseUrl);
?>

<h1 class="letter-"><i class="fa fa-grav letter-red"></i> Bonjour <span class="letter-red">Super Admin</span></h1>
<h5 class="letter-">Quelle partie du site souhaitez-vous administrer ?</h5>

<div class="col-md-4">
	<button class="btn btn-default btn-lg font-blackoutM letter-red col-md-12 padding-10 btn-superadmin" data-action="web">
		<i class="fa fa-search letter-red"></i><br>WEB
	</button>
</div>
<div class="col-md-4">
	<button class="btn btn-default btn-lg font-blackoutM letter-red col-md-12 padding-10 btn-superadmin" data-action="live">
		<i class="fa fa-newspaper-o letter-red"></i><br>LIVE
	</button>
</div>
<div class="col-md-4">
	<button class="btn btn-default btn-lg font-blackoutM letter-red col-md-12 padding-10 btn-superadmin" data-action="power">
		<i class="fa fa-comments letter-red"></i><br>POWER
	</button>
</div>

<?php 
	$visits = CO2Stat::getStatsByHash(); 
	$days = array("Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun");
?>
<style>
	.stat-week .col-md-1{
		width:12%!important;
		margin:1%!important;
	}
</style>
<div class="col-md-12 stat-week padding-bottom-50">
<hr>
<h2 class="text-left text-azure"><i class="fa fa-angle-down"></i> Nombre de visites - Semaine <?php echo date("W"); ?></span></h2>
<?php foreach ($visits["hash"] as $domain => $stats) { $totalLoad = 0; ?>
		<div class="col-md-12 text-center">
			<?php foreach ($days as $key => $day) { $totalLoad += $stats[$day]["nbLoad"]; } ?>
			<h3 class="text-left">#<?php echo $domain; ?> <small class="letter-azure">(<?php echo $totalLoad; ?>)</small></h3>
			<?php foreach ($days as $key => $day) { ?>
				<?php 	
					$bg = "white";
					$text = "dark";
					if($stats[$day]["nbLoad"] > 0) { $text = "azure"; }
					if($stats[$day]["nbLoad"] > 50) { $text = "green"; }
					if($stats[$day]["nbLoad"] > 100) { $text = "orange"; }
					if($stats[$day]["nbLoad"] > 300) { $text = "red"; }

					
				?>
				<div class="col-md-1 bg-<?php echo $bg;?> letter-<?php echo $text;?> padding-10 radius-5 border-white-2">
					<h3 class="no-margin"><?php echo $stats[$day]["nbLoad"]; ?></h3>
					<?php echo $day; ?> 
				</div>
			<?php } ?>
		</div>
<?php } ?>
</div>


<script type="text/javascript">

	jQuery(document).ready(function() {
		$(".btn-superadmin").click(function(){
			var action = $(this).data("action");
				getAjax('#central-container' ,baseUrl+'/'+moduleId+"/co2/superadmin/action/"+action,function(){ 
					
			},"html");
		});
	});

</script>