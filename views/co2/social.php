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
#page .bg-dark {
    color: white !important;
    background-color: #3C5665 !important;
}
#page .bg-red{
    background-color:#E33551 !important;
    color:white!important;
}
#page .bg-blue{
    background-color: #5f8295 !important;
    color:white!important;
}
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
#page p {
    font-size: 13px;
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

.btn-create-page{
    margin-top:0px;
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

.links-create-element .btn-create-elem{
    margin-top:25px;
}
</style>




<div class="col-md-12 col-sm-12 col-xs-12 bg-white no-padding shadow" style="min-height:700px;">

    <h5 class="text-center letter-red">
        <button class="btn btn-default main-btn-scopes text-white tooltips margin-bottom-5" 
            data-target="#modalScopes" data-toggle="modal"
            data-toggle="tooltip" data-placement="top" 
                                title="Sélectionner des lieux de recherche">
            <!-- <i class="fa fa-bullseye" style="font-size:18px;"></i> -->
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/cible3.png" height=42>
        </button><br>
        recherche ciblée
    </h5>
    <br>
    <div class="scope-min-header list_tags_scopes hidden-xs hidden-sm">
    </div>

	<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 padding-top-50" id="page"></div>

    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 text-center">
        <hr style="margin-bottom:-20px;">
        <!-- data-target="#modalScopes" data-toggle="modal" -->
        
        <button class="btn btn-default btn-circle-1 btn-create-page bg-green-k text-white tooltips" 
            data-target="#dash-create-modal" data-toggle="modal"
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


<div class="portfolio-modal modal fade" id="dash-create-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-content padding-top-15">
        <div class="close-modal" data-dismiss="modal">
            <div class="lr">
                <div class="rl">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/KGOUGLE-logo.png" height="50" class="inline margin-top-25 margin-bottom-5"><br>
                    
                    <h3 class="letter-red no-margin hidden-xs">
                        <small class="text-dark">Un réseau social <span class="letter-red">citoyen</span>, au service du <span class="letter-red">bien commun</span></small>
                    </h3><br>
                    <h3 class="letter-red no-margin hidden-xs">
                        <i class="fa fa-plus-circle"></i> Créer une page<br>
                    </h3>
                   <!-- <hr> -->
                </div>               
            </div>
            <div class="row links-create-element">
                <div class="col-lg-12">
                    <div class="modal-header text-dark">
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Partage de messages</label> 
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Partage d'événements</label> 
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Gestion de contacts</label>  
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Messagerie privées</label>  
                       <label class="label label-lg bg-green-k padding-5"><i class="fa fa-check"></i> Notifications</label> 
                    </div>
                    
                    <div id="" class="modal-body">
                        <div class="col-md-12 hidden">
                            
                        </div>
                         <h4 class="modal-title text-center hidden">
                            Choisissez le type de page qui vous correspond le mieux
                            <hr>
                        </h4>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="NGO" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-green"><i class="fa fa-group padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> Association</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Resserrer les liens du tissu associatif
                                        <small class="hidden-xs"><br>
                                            Le monde associatif est basé sur l'entraide et la solidarité.<br>
                                            Plus que jamais, les associations ont besoin de se relier entre-elles,<br> 
                                            pour faire plus et mieux, ensemble.
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-green margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer ma page</button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="LocalBusiness" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-azure"><i class="fa fa-industry padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> Entreprise</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Dynamiser le monde de l'entreprise
                                        <small class="hidden-xs"><br>
                                            Rester connecté à vos contacts, vos clients, vos fournisseurs...<br>
                                            Le réseau vous apportera une visibilité incomparable<br>
                                            auprès de tous les internautes Calédoniens.
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-azure margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer ma page</button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="Group" data-type="organization"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-turq"><i class="fa fa-circle-o padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> Groupe</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Mettre en valeur les liens humains
                                        <small class="hidden-xs"><br>
                                            La vie c'est des rencontres, des amitiés, des liens qui nous unissent<br>
                                            à travers nos activités, nos centres d'intérêts, nos plaisirs.<br>
                                            Les vivres c'est bien, les partager c'est encore mieux !
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-turq margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer ma page</button>
                                </div>
                            </div>
                        </a>
                        <a href="javascript:" class="btn-create-elem col-lg-6 col-sm-6 col-xs-6" data-ktype="project" data-type="project"
                            date-target="#modalMainMenu" data-dismiss="modal">
                            <div class="modal-body text-left">
                                <h2 class="text-purple"><i class="fa fa-lightbulb-o padding-bottom-10"></i><br>
                                    <span class="font-blackoutT"> Projet</span>
                                </h2>
                                
                                <div class="col-md-12 no-padding text-center hidden-xs">
                                    <h5>Ce sont les petites initiatives<br>qui donnent naissance aux projets hors du commun
                                        <small class="hidden-xs"><br>
                                            N'hésitez jamais à faire connaître vos envies, vos projets, vos rêves.<br>
                                            C'est comme ça qu'ils grandissent !
                                        </small>
                                    </h5>
                                    <button class="btn btn-default text-purple margin-bottom-15"><i class="fa fa-plus-circle"></i> Créer ma page</button>
                                </div>
                            </div>
                        </a>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <hr>
                            <a href="javascript:" style="font-size: 13px;" type="button" class="" data-dismiss="modal"><i class="fa fa-times"></i> Retour</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->renderPartial($layoutPath.'footer', array("subdomain"=>"social")); ?>



<script>

var type = "<?php echo @$type ? $type : 'persons'; ?>";

var TPL = "kgougle";

var currentKFormType = "";

jQuery(document).ready(function() {
	initKInterface();

    if(type!='') type = "?type="+type;
	getAjax('#page' ,baseUrl+'/'+moduleId+"/default/directoryjs"+type,function(){ 

        $(".btn-directory-type").click(function(){
            var type = $(this).data("type");
            searchType = [ type ];
            setHeaderDirectory(type);
            loadingData = false;
            startSearch(0, indexStepInit, searchCallback);
        });

    },"html");

    $("#main-search-bar").keyup(function(e){
        $("#searchBarText").val($(this).val());
        if(e.keyCode == 13){
            //var search = $(this).val();
            startSearch(0, indexStepInit, searchCallback);
            //KScrollTo("#page");
        }
    });
    $("#main-search-bar").change(function(){
        $("#searchBarText").val($(this).val());
    });

    $(".btn-create-elem").click(function(){
        currentKFormType = $(this).data("ktype");
        var type = $(this).data("type");
        setTimeout(function(){
                    elementLib.openForm(type);
                 },500);
        
    });

    $(".tooltips").tooltip();

    //currentKFormType = "Group";
    //elementLib.openForm ("organization");
});

</script>