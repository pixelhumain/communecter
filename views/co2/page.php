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
                                "page" => "page.type") ); 
?>


<div class="col-md-12 col-sm-12 col-xs-12 no-padding social-main-container">
	<div class="" id="onepage"></div>
</div>


<script>

var type = "<?php echo $type; ?>";
var id = "<?php echo $id; ?>";
    
jQuery(document).ready(function() {
	
	initKInterface({"affixTop":250});

	var tpl = '<?php echo @$_GET["tpl"] ? $_GET["tpl"] : "profilSocial"; ?>';
	

	getAjax('#onepage' ,baseUrl+'/'+moduleId+"/element/detail/type/"+type+"/id/"+id+"?tpl="+tpl,function(){ 
				
			},"html");
});

</script>