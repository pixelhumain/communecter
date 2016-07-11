<?php 
Menu::comments( $parentType, $parentId );
$this->renderPartial('../default/panels/toolbar');

if( @$url){?>
<style>
	iframe {width:100%; padding:0; border:0;}
</style> 
original : <a href="<?php echo $url?>" target="_blank"><?php echo $url?></a>
<iframe id='ifm' name='embed_readwrite' src='<?php echo $url?>?showControls=true&showChat=true&showLineNumbers=true&useMonospaceFont=false' allowfullscreen ></iframe>
	   
<?php } else { ?>
	<center>
		<h1 class="text-red text-bold"><?php echo Yii::t("common","You must specify a url") ?></h1>
	</center>
<?php } ?>

<script type="text/javascript">

jQuery(document).ready(function() {
	
	$(".moduleLabel").html("<i class='fa fa-file-text-o'></i> Framapad : <?php echo $name?>");
	resizeIframe() 
});	


	var buffer = 20; //scroll bar buffer
	var iframe = document.getElementById('ifm');

	function pageY(elem) {
	    return elem.offsetParent ? (elem.offsetTop + pageY(elem.offsetParent)) : elem.offsetTop;
	}

	function resizeIframe() {
	    var height = document.documentElement.clientHeight;
	    height -= pageY(document.getElementById('ifm'))+ buffer ;
	    height = (height < 0) ? 0 : height;
	    document.getElementById('ifm').style.height = height + 'px';
	}

	// .onload doesn't work with IE8 and older.
	if (iframe.attachEvent) {
	    iframe.attachEvent("onload", resizeIframe);
	} else {
	    iframe.onload=resizeIframe;
	}

	window.onresize = resizeIframe;
</script>