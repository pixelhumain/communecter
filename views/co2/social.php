<?php 

	//HtmlHelper::registerCssAndScriptsFiles( array('/css/default/directory.css', ) , Yii::app()->theme->baseUrl. '/assets');


	//$cssAnsScriptFilesModule = array(
	//	''
	//);
	//HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';

    $page = "social";
    if(@$type=="events") $page = "agenda";// : "social";
    if(@$type=="vote") $page = "power";// : "social";

    $subdomain = $page;
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                            array(  "layoutPath"=>$layoutPath ,
                                    "page" => $page,
                                    "type" => @$type) ); 
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
#page .row.headerDirectory{
    margin-top: 20px;
    display: none;
}

.homestead{
    font-family:unset!important;
}
/*
.main-btn-scopes{
    position: absolute;
    top: 85px;
    left: 18px;
    z-index: 10;
    border-radius: 0 50%;
}*/
.main-btn-scopes {
    position: absolute;
    top: -20px;
    left: 49%;
    z-index: 10;
    border-radius: 0 50%;
    -ms-transform: rotate(7deg);
    -webkit-transform: rotate(7deg);
    transform: rotate(-45deg);
}

.main-btn-scopes:hover{
    background-color: white!important;
    color:#ea4335!important;
    border: 2px solid #ea4335!important;

}

.btn-create-page{
    position: absolute;
    top: 0px;
    left: 49%;
    z-index: 10;
    border-radius: 0 50%;
    -ms-transform: rotate(7deg);
    -webkit-transform: rotate(7deg);
    transform: rotate(-45deg);
}
.btn-create-page:hover{
    background-color: white!important;
    color:#34a853!important;
    border: 2px solid #34a853!important;

}

.scope-min-header{
    position: absolute;
    top: 60px;
    left: 30%;
    width:40%;
    text-align: center;
    z-index: 10;
    border-radius: 0 50%;
}
</style>




<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding shadow" style="min-height:700px;">

    <button class="btn btn-default btn-circle-1 main-btn-scopes bg-red text-white tooltips" 
            data-target="#modalScopes" data-toggle="modal"
            data-toggle="tooltip" data-placement="top" 
                                title="Sélectionner des lieux de recherche">
            <i class="fa fa-bullseye" style="font-size:18px;"></i>
    </button><br>
    <h5 class="text-center letter-red">où ?</h5>
    <br>
    <div class="scope-min-header list_tags_scopes hidden-xs hidden-sm">
    </div>

	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 padding-top-50" id="page"></div>

    <div class="ol-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 ">
        <hr>
        <button class="btn btn-default btn-circle-1 btn-create-page bg-green-k text-white tooltips" 
                data-target="#modalScopes" data-toggle="modal"
                data-toggle="tooltip" data-placement="top" 
                                    title="Créer une nouvelle page">
                <i class="fa fa-times" style="font-size:18px;"></i>
        </button>
        <h5 class="text-center letter-green margin-top-25">Créer une page</h5>
        <h5 class="text-center">
            <small>             
                <span class="text-green">associations</span> 
                <span class="text-azure">entreprises</span> 
                <span class="text-purple">projets</span> 
                <span class="text-turq">groupes</span>
            </small>
        </h5><br>
    </div>

</div>


<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>"social")); ?>



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

        $("#main-search-bar").keyup(function(e){
            $("#searchBarText").val($(this).val());
            if(e.keyCode == 13){
                //var search = $(this).val();
                startSearch(0, indexStepInit);
                //KScrollTo("#page");
            }
        });
        $("#main-search-bar").change(function(){
            $("#searchBarText").val($(this).val());
        });

        $(".tooltips").tooltip();
    });

</script>