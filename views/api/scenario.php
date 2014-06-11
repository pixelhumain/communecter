<?php foreach ($blocks as  $b) { ?>

	<!-- ////////////////////////////////////////////////////////////////////////////// -->

	<h4  class="blocky"><?php if(isset($b["iconClass"])) { ?><i class="<?php  echo $b["iconClass"]?>"></i> <?php }?><?php echo $b["label"]?></h4>
	
	<ul class="blocki">
		<?php foreach ($b["children"] as  $bl) { ?>
		<li><?php echo $bl?></li>
		<?php }?>
	</ul>

	<!-- ////////////////////////////////////////////////////////////////////////////// -->

<?php }?>
