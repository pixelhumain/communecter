<?php 
Menu::comments( @$room['parentType'], @$room['parentId'],$room );
$this->renderPartial('../default/panels/toolbar');

if( @$room['url']){?>
<style>
	iframe {width:100%; padding:0; border:0;}
</style> 
original : <a href="<?php echo @$room['url']?>" target="_blank"><?php echo @$room['url']?></a>
<iframe id='ifm' name='embed_readwrite' src='<?php echo @$room['url']?>?showControls=true&showChat=true&showLineNumbers=true&useMonospaceFont=false' allowfullscreen ></iframe>
	   
<?php } else { ?>
	<center>
		<h1 class="text-red text-bold"><?php echo Yii::t("common","You must specify a url") ?></h1>
	</center>
<?php } ?>

<script type="text/javascript">

jQuery(document).ready(function() {
	
	setTitle("Framapad : <?php echo @$room['name']?>","<i class='fa fa-file-text-o'></i>");
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


function archive(collection,id){
  mylog.warn("--------------- archive ---------------------",collection,id);
    
  bootbox.confirm("Vous êtes sûr ? ",
      function(result) {
        if (result) {
          params = { 
             "id" : id ,
             "type":collection,
             "name":"status",
             "value":"<?php echo ( @$context["status"] != ActionRoom::STATE_ARCHIVED ) ? ActionRoom::STATE_ARCHIVED : "" ?>",
          };
          ajaxPost(null,'<?php echo Yii::app()->createUrl(Yii::app()->controller->module->id."/element/updatefield")?>',params,function(data){
            loadByHash(window.location.hash);
          });
      } else {
        $("."+clickedVoteObject).removeClass("faa-bounce animated");
      }
  });
}
</script>