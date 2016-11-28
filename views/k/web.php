
<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "subdomain"=>$subdomain,
                                "mainTitle"=>$mainTitle,
                                "placeholderMainSearch"=>$placeholderMainSearch) ); 
?>

<div id="mainCategories"></div>

<?php $this->renderPartial($layoutPath.'footer'); ?>

<script>
jQuery(document).ready(function() {
    initKInterface();
    buildListCategories();
});

function buildListCategories(){
    console.log(mainCategories);
    var html = "";
    $.each(mainCategories, function(name, params){
        var classe="";
        if(params.color == "green") classe="search-eco";

        html    += '<section id="portfolio" class="'+classe+'">'+
                        '<div class="container">'+
                            '<div class="row">'+
                                '<div class="col-lg-12 text-center">'+
                                    '<h2 class="text-'+params.color+'">'+
                                        'Recherche '+name+
                                    '</h2>'+
                                    '<hr class="angle-down">'+
                                '</div>'+
                            '</div>'+
                            '<div class="row text-'+params.color+'">';

        $.each(params.items, function(keyC, val){
            console.log(keyC, val);
            html +=             '<div class="col-sm-4 portfolio-item">'+
                                    '<a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">'+
                                        '<div class="caption">'+
                                            '<div class="caption-content">'+
                                            '</div>'+
                                        '</div>'+
                                        '<i class="fa fa-'+val.faIcon+' fa-3x"></i>'+
                                        '<h3>'+val.name+'</h3>'+
                                    '</a>'+
                                '</div>'
        });

        html +=             '</div>' + 
                        '</div>' + 
                    '</section>';

    });

    $("#mainCategories").html(html);
}
</script>