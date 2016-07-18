
<iframe src="<?php echo "https://web.telegram.org/#/im?p=@".$pseudo; ?>"></iframe> 

<script type="text/javascript">
var pseudo = "<?php echo $pseudo; ?>";
jQuery(document).ready(function() {
	$(".moduleLabel").html("<span class='text-azure'><i class='fa fa-send'></i> " + "Telegram : </span>"+pseudo);
});	
</script>