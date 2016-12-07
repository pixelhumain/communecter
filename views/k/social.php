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
<style>
	
#page .bg-green{
    background-color:#93C020 !important;
    color:white!important;
}
#page .bg-orange{
    background-color:#FFA200 !important;
    color:white!important;
}
#page .bg-yellow{
    background-color:#FFC600 !important;
    color:white!important;
}
#page .bg-purple{
    background-color:#8C5AA1 !important;
    color:white!important;
}
#page #dropdown_search{
	min-height:500px;
    margin-top:30px;
}

</style>

<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding">
    <div class="col-md-10 col-md-offset-1" style="margin-top:-20px;">
        
    </div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding" style="min-height:700px;">
	<div class="col-md-10 col-md-offset-1" id="page"></div>
</div>

<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>$subdomain)); ?>

<script>

var type = "<?php echo @$type ? $type : 'persons'; ?>";

var TPL = "kgougle";


jQuery(document).ready(function() {
	initKInterface();

    if(type!='') type = "?type="+type;
	getAjax('#page' ,baseUrl+'/'+moduleId+"/default/directory"+type,function(){ 
				
        $(".btn-directory-type").click(function(){
            var type = $(this).data("type");
            searchType = [ type ];
            setHeaderDirectory(type);
            loadingData = false;
            startSearch(0, indexStepInit);
        });

	},"html");

    $("#main-search-bar").keyup(function(){
        $("#searchBarText").val($(this).val());
    });
    $("#main-search-bar").change(function(){
        $("#searchBarText").val($(this).val());
    });
});

</script>