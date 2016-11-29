<h3 id="titleWebSearch"><i class="fa fa-angle-down"></i> <?php echo sizeof($siteurls); ?> Résultat(s) - <?php echo @$category; ?></h3>

<style>
	.siteurl_title{
		font-size:17px!important;
	}
	.siteurl_hostname{
		font-size:14px!important;
	}
	.siteurl_desc{
		font-size:13px!important;
	}
</style>

<div class="col-md-8 margin-bottom-15" style="">
<?php  foreach ($siteurls as $key => $siteurl) { ?>
	<div class="col-md-12 margin-bottom-15">
		<a class="siteurl_title letter-blue" target="_blank" href="<?php echo $siteurl["url"]; ?>">
			<?php echo $siteurl["title"]; ?>
		</a><br>
		<span class="siteurl_hostname letter-green"><?php echo $siteurl["url"]; ?></span><br>
		<span class="siteurl_desc letter-grey"><?php echo $siteurl["description"]; ?></span>
	</div>
<?php } ?>
</div>

<script>
var siteurls = <?php echo json_encode($siteurls); ?>

jQuery(document).ready(function() {
   Sig.showMapElements(Sig.map, siteurls);
});
</script>