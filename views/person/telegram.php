
<iframe src="<?php echo "https://web.telegram.org/#/im?p=@".$pseudo; ?>"></iframe> 

<script type="text/javascript">
var pseudo = "<?php echo $pseudo; ?>";
jQuery(document).ready(function() {
	setTitle("<span class='text-azure'>Telegram : </span>"+pseudo,"<i class='text-azure fa fa-send'></i>","Telegram : "+pseudo);
});	
</script>