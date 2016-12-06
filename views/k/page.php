<?php 

	//HtmlHelper::registerCssAndScriptsFiles( array('', ) , Yii::app()->theme->baseUrl. '/assets');


	//$cssAnsScriptFilesModule = array(
	//	''
	//);
	//HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "subdomain"=>$subdomain,
                                "mainTitle"=>$mainTitle,
                                "placeholderMainSearch"=>$placeholderMainSearch) ); 
?>


<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding">
	<div class="container" style="margin-top:90px;" id="page"></div>
</div>

<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>$subdomain)); ?>

<script>

var type = "<?php echo $type; ?>";
var id = "<?php echo $id; ?>";

jQuery(document).ready(function() {
	initKInterface();

	getAjax('#page' ,baseUrl+'/'+moduleId+"/element/detail/type/"+type+"/id/"+id,function(){ 
				
			},"html");
});

</script>