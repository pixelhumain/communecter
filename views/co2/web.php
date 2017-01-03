
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
    $cssAnsScriptFiles = array(
    '/assets/css/circle.css',
  //  '/assets/css/referencement.css'
    );
    HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles, Yii::app()->theme->baseUrl); 

       
?>

<style>
    #sectionSearchResults{
        min-height:700px;
        margin-left:80px;
        padding-bottom:50px;
    }
</style>


<?php 
    //$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $this->renderPartial('admin/modalEditUrl',  array( ) ); 
?>


<section class="padding-top-15 hidden" id="sectionSearchResults">
    <div class="row">
        <div class="col-md-8" id="searchResults"></div>
    </div>
</section>

<div id="mainCategories" class="shadow padding-bottom-50"></div>

<?php $this->renderPartial($layoutPath.'footer',  array( "subdomain"=>"web" ) ); ?>

<script>

var currentCategory = "";

jQuery(document).ready(function() {
    initKInterface();
    initWebInterface();
    buildListCategories();

    location.hash = "#co2.web";
});

function initWebInterface(){
    $("#main-btn-start-search, .menu-btn-start-search").click(function(){
        var search = $("#main-search-bar").val();
        startWebSearch(search, currentCategory);
    });
    $(".menu-btn-back-category").click(function(){
        $("#mainCategories").show();
        $("#searchResults").html("");
        $("#sectionSearchResults").addClass("hidden");
        KScrollTo("#main-input-group");
    });

    $("#second-search-bar").keyup(function(e){
        $("#main-search-bar").val($("#second-search-bar").val());
        $("#input-search-map").val($("#second-search-bar").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            startWebSearch(search, currentCategory);
         }
    });
    $("#main-search-bar").keyup(function(e){
        $("#second-search-bar").val($("#main-search-bar").val());
        $("#input-search-map").val($("#main-search-bar").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            startWebSearch(search, currentCategory);
         }
    });
    $("#input-search-map").keyup(function(e){
        $("#second-search-bar").val($("#input-search-map").val());
        $("#main-search-bar").val($("#input-search-map").val());
        if(e.keyCode == 13){
            var search = $(this).val();
            startWebSearch(search, currentCategory);
         }
    });

}

function startWebSearch(search, category){

    if(!notEmpty(search) && !notEmpty(category)) {
        toastr.info("Champ de recherche vide !");
        //return;
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
                // setTimeout(function(){ 
                //     showMapLegende("crosshairs", "Site web géolocalisés ...");
                // }, 1000);
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
        currentCategory = cat;
        console.log("currentCategory", currentCategory);
        startWebSearch("", cat);
    });
}




</script>