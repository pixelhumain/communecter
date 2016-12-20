
<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "web",
                                // "subdomain"=>$subdomain,
                                // "subdomainName" => $subdomainName,
                                // "icon" => $icon, 
                                // "mainTitle"=>$mainTitle,
                                // "placeholderMainSearch"=>$placeholderMainSearch) 
                            )
                        ); 
?>

<style>
    #sectionSearchResults{
        min-height:1000px;
        margin-left:80px;
        padding-bottom:50px;
    }
</style>
<section class="padding-top-15 hidden" id="">
        <div class="row">
            <div class="col-md-12" id="">
                <h2>TODO pour CO2 :</h2>
                <p>Le green-web regroupe l'ensemble des sites à vocation alternatives, écologiques, sociales, solidaires, afin de faciliter l'accès à ces ressources</p>
                <h3 class="text-center">référencer un maximum de site web fournissant des info / actu / solutions / alternatives</h3>
                <h3 class="text-center">Définir une liste de catégorie spécifique pour faire des recherches simples et intuitives</h3>
            </div>
        </div>
</section>
<section class="padding-top-15 hidden" id="sectionSearchResults">
        <div class="row">
            <div class="col-md-6" id="searchResults"></div>

            <div class="row" style="min-height:800px;" id="refStart">
                <div class="col-md-5 pull-left" style="min-height:800px;position:fixed;top:90px;right:50px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label id="lbl-url">
                                <i class="fa fa-circle"></i> URL
                            </label>
                            <input type="text" class="form-control" placeholder="id" id="form-idurl"><br>
                            <input type="text" class="form-control" placeholder="exemple : http://kgougle.nc" id="form-url"><br>
                            <h5 class="letter-green pull-left" id="status-ref"></h5>                    
                            <!-- <button class="btn btn-success pull-right btn-scroll" data-targetid="#formRef" id="btn-start-ref-url">
                                <i class="fa fa-binoculars"></i> Lancer la recherche d'information
                            </button> -->
                        </div>
                    </div>
                    <div class="col-md-12 " id="refResult">
                        <label id="lbl-title">
                            <i class="fa fa-circle"></i> Nom de la page
                            <small class="pull-right text-light">
                                <code>&lttitle&gt&lt/title&gt</code>
                            </small>
                        </label>
                        <input type="text" class="form-control" placeholder="Nom de la page" id="form-title"><br>

                        <label id="lbl-description">
                            <i class="fa fa-circle"></i> Description
                            <small class="pull-right text-light">
                                <code>&ltmeta name="description"&gt</code>
                            </small>
                        </label>
                        <textarea class="form-control" placeholder="Description" id="form-description"></textarea><br>

                        <div class="col-md-12 no-padding">
                            <label id="lbl-keywords">
                                <i class="fa fa-circle"></i> Mots clés                      
                                <small class="pull-right text-light">
                                    <code>&ltmeta name="keywords"&gt</code>
                                </small><br>
                                <!-- <small class="text-light">
                                    <i class="fa fa-info-circle"></i> Les mots clés servent à optimiser les résultats de recherche, choisissez les avec soins<br>
                                    <i class="fa fa-signal fa-flip-horizontal"></i> Par ordre d'importance (1 > 2 > 3 > 4)</small><br><br> -->
                            </label>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 1" id="form-keywords1"><br>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 2" id="form-keywords2"><br>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 3" id="form-keywords3"><br>
                        </div>
                        <div class="col-md-3 padding-5">
                            <input type="text" class="form-control" placeholder="expression 4" id="form-keywords4"><br>
                        </div>
                        <button class="btn btn-success pull-right" id="btn-save-maj-metadata"><i class="fa fa-save"></i> Enregistrer</button>
                    </div>
                </div>
                
                <div class="col-md-6 pull-right text-right" id="nb-auto-scan"></div>
                <div class="col-md-6 pull-right" id="res-auto-scan"></div>
            </div>

        </div>
</section>

<div id="mainCategories" class="shadow"></div>

<?php $this->renderPartial($layoutPath.'footer',  array( "subdomain"=>"web" ) ); ?>

<script>
jQuery(document).ready(function() {
    initKInterface();
    initWebInterface();
    buildListCategories();

    location.hash = "#co2.web";
});

function initWebInterface(){
    $("#main-btn-start-search, .menu-btn-start-search").click(function(){
        var search = $("#main-search-bar").val();
        startWebSearch(search);
    });
    $(".menu-btn-back-category").click(function(){
        $("#mainCategories").show();
        $("#searchResults").html("");
        $("#sectionSearchResults").addClass("hidden");
        KScrollTo("#mainCategories");
    });

    $("#second-search-bar").keyup(function(e){
        $("#main-search-bar").val($("#second-search-bar").val());
        $("#input-search-map").val($("#second-search-bar").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            startWebSearch(search);
         }
    });
    $("#main-search-bar").keyup(function(e){
        $("#second-search-bar").val($("#main-search-bar").val());
        $("#input-search-map").val($("#main-search-bar").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            startWebSearch(search);
         }
    });
    $("#input-search-map").keyup(function(e){
        $("#second-search-bar").val($("#input-search-map").val());
        $("#main-search-bar").val($("#input-search-map").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            startWebSearch(search);
         }
    });

    $("#btn-save-maj-metadata").click(function(){
        sendReferencement("validated");
    });
}

function startWebSearch(search, category){

    if(!notEmpty(search) && !notEmpty(category)) {
        toastr.info("Champ de recherche vide !");
        return;
    }

    $("#second-search-bar").val(search);
    $("#mainCategories").hide();
    $("#searchResults").html("recherche en cours. Merci de patienter quelques instants...");

    var params = {
        search:search,
        category:category
    };

    $.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/co2/websearch/",
        data: params,
        //dataType: "json",
        success:
            function(html) { 
                $("#searchResults").html(html); 
                $("#sectionSearchResults").removeClass("hidden");
                KScrollTo("#sectionSearchResults");
            },
        error:function(xhr, status, error){
            $("#searchResults").html("erreur");
        },
        statusCode:{
                404: function(){
                    $("#searchResults").html("not found");
            }
        }
    });
}

function buildListCategories(){
    //console.log(mainCategories);
    var html = "";
    $.each(mainCategories, function(name, params){
        var classe="";
        if(params.color == "green") classe="search-eco";

        html    += '<section class="portfolio '+classe+'">'+

                        '<div class="container">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 text-center">'+
                                    '<h2 class="letter-'+params.color+'">'+
                                        'Recherche '+name+
                                    '</h2>'+
                                    '<hr class="angle-down">'+
                                '</div>'+
                            '</div>'+
                            '<div class="text-'+params.color+'">';

        $.each(params.items, function(keyC, val){
            //console.log(keyC, val);
            html +=             '<div class="col-sm-3 col-xs-6 portfolio-item">'+
                                    '<button class="portfolio-link category-search-link" data-category="'+val.name+'">'+
                                        '<div class="caption">'+
                                            '<div class="caption-content">'+
                                            '</div>'+
                                        '</div>'+
                                        '<i class="fa fa-'+val.faIcon+' fa-2x"></i>'+
                                        '<h3>'+val.name+'</h3>'+
                                    '</button>'+
                                '</div>'
        });

        html +=             '</div>' + 
                        '</div>' + 
                    '</section>';

    });

    $("#mainCategories").html(html);

    $(".category-search-link").click(function(){
        var cat = $(this).data("category");
        startWebSearch("", cat);
    });
}




function sendReferencement(status){
    console.log("start referencement");

    var id = $("#form-idurl").val();
    
    var url = $("#form-url").val();
    var title = $("#form-title").val();
    var description = $("#form-description").val();

    var keywords1 = $("#form-keywords1").val();
    var keywords2 = $("#form-keywords2").val();
    var keywords3 = $("#form-keywords3").val();
    var keywords4 = $("#form-keywords4").val();

    var keywords = new Array();

    if(notEmpty(keywords1)) keywords.push(keywords1);
    if(notEmpty(keywords2)) keywords.push(keywords2);
    if(notEmpty(keywords3)) keywords.push(keywords3);
    if(notEmpty(keywords4)) keywords.push(keywords4);
    
    if(typeof status == "undefined") status = "uncomplet";
         var urlObj = {
                url : url,
                title: title, 
                description: description,
                tags: keywords,
                //categories : categoriesSelected,
                status: status
        };

        console.log("UPDATE THIS URL DATA ?", urlObj, id);
       // if(false)
        $.ajax({
            type: "POST",
            url: baseUrl+"/"+moduleId+"/co2/superadmin/action/updateurlmetadata",
            data: { "id" : id,
                    "values" : urlObj },
            dataType: "json",
            success: function(data){
                //if(data.valid == true) 
                toastr.success("Votre demande a bien été enregistrée");
                $("#form-idurl").val("");
                $("#form-url").val("");
                $("#form-title").val("");
                $("#form-description").val("");

                $("#form-keywords1").val("");
                $("#form-keywords2").val("");
                $("#form-keywords3").val("");
                $("#form-keywords4").val("");
                //else toastr.error("Une erreur est survenue pendant le référencement");
                console.log("save referencement success");
            },
            error: function(data){
                toastr.error("Une erreur est survenue pendant l'envoi de votre demande", data);
                console.log("save referencement error");
            }
        });
    //}else{
    //  toastr.error("Merci de remplir toutes les options");
    //}
}
</script>