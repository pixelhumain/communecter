
<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    //header + menu
    $this->renderPartial($layoutPath.'header', 
                        array(  "layoutPath"=>$layoutPath , 
                                "page" => "web",
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
        /*margin-left:80px;*/
        padding-bottom:50px;
    }
    
<?php 
    $btnAnc = array("blue"      =>array("color1"=>"#4285f4", 
                                        "color2"=>"#1c6df5"),
                    );
?>

<?php foreach($btnAnc as $color => $params){ ?>
.btn-anc-color-<?php echo $color; ?>{
    background-color: <?php echo $params["color1"]; ?>;
    border-color: <?php echo $params["color1"]; ?>!important;
    color: #fff!important;
}

.btn-anc-color-<?php echo $color; ?>:hover{
    background-color: <?php echo $params["color2"]; ?>!important;
    border-color: <?php echo $params["color1"]; ?>!important;
}
.btn-anc-color-<?php echo $color; ?>.active{ 
    background-color:#fff!important;
    color:<?php echo $params["color1"]; ?>!important;
}
.btn-anc-color-<?php echo $color; ?>.active:hover{
    background-color: #fff;
    color: <?php echo $params["color1"]; ?>;
}
<?php } ?>


#btn-onepage-main-menu{
    position: fixed;
    top:110px;
    left:20px;
    border-radius: 1px;
    letter-spacing: 2px;
    border:2px solid white;
    border-radius:100px;
    height:40px;
    /*width:60px;*/
}

.siteurl_title{
    font-size:17px!important;
}
.siteurl_hostname{
    font-size:14px!important;
}
.siteurl_desc{
    font-size:13px!important;
    color:#606060;
}

@media screen and (max-width: 1024px) {
    
}

@media (max-width: 768px) {

    .category-search-link h4{
        font-size: 0.9em;
    }
    #mainCategories h3{
        font-size: 1.3em;
    }
}
</style>


<?php 
    $layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
    $this->renderPartial('admin/modalEditUrl',  array( ) ); 
    //var_dump($myWebFavorites);
    $this->renderPartial($layoutPath.'modals.favorites',  array("myWebFavorites"=>@$myWebFavorites ) ); 
?>

<button class="hidden btn letter-red btn-link font-montserrat dropdown-toggle" data-toggle="dropdown" id="btn-onepage-main-menu">
     <i class='fa fa-angle-right'></i> A propos
</button>

<section class="padding-top-15 hidden" id="sectionSearchResults">
    <div class="row">

        <div class="col-md-2 col-sm-2 text-right" id="sub-menu-left"></div>
        <div class=" col-lg-8 col-md-7 col-sm-7" id="searchResults"></div>
        <div class="col-md-2 col-sm-2 text-left" id="sub-menu-right">
            <a href="https://github.com/pixelhumain" target="_blank">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/anc/105.jpg" height=170>
            </a><br><br>
            <a href="https://github.com/pixelhumain" target="_blank">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/anc/105.jpg" height=170>
            </a><br><br>
        </div>
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

    $("#menu-map-btn-start-search").click(function(){
        var search = $("#input-search-map").val();
        startWebSearch(search, currentCategory);
    });

   $("#modalFavorites .btn-favory").click(function(){
        var id = $(this).data("idfav");
        deleteFavorites(id);
   });
}

function startWebSearch(search, category){

    if(!notEmpty(search) && !notEmpty(category)) {
        toastr.info("Champ de recherche vide !");
        return;
    }

    $("#second-search-bar").val(search);
    $("#mainCategories").hide();
    $("#sectionSearchResults").removeClass("hidden");
    $("#searchResults").html("<i class='fa fa-spin fa-refresh'></i> recherche en cours. Merci de patienter quelques instants...");

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
                                    '<h3 class="letter-'+params.color+'">'+
                                        'Recherche '+name+
                                    '</h3>'+
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
                                        '<h4>'+val.name+'</h4>'+
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



function incNbClick(url){
    console.log("incrémentation nbClick essai");
    $.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+"/siteurl/incnbclick/",
        data: { url : url },
        dataType: "json",
        success:
            function(data) {
            console.log("incrémentation nbClick ok", data);
                // $("#searchResults").html(html);
                // $("#sectionSearchResults").removeClass("hidden");
                // KScrollTo("#sectionSearchResults");
            },
        error:function(xhr, status, error){
            console.log("erreur lors de l'incrémentation nbClick");
            //$("#searchResults").html("erreur");
        },
        statusCode:{
                404: function(){
                    console.log("404 erreur lors de l'incrémentation nbClick");
            }
        }
    });
}

function initKeywords(){
    var html = "";
    $.each(mainCategories, function(name, params){
        $.each(params.items, function(keyC, val){
            if(val.name == currentCategory){
                $("#fa-category").addClass("fa-"+val.faIcon);
                if(typeof val.keywords != "undefined"){
                    $.each(val.keywords, function(keyK, keyword){
                        var classe="";
                        if(search==keyword) classe="active";
                        html += '<button class="btn btn-success btn-sm margin-bottom-5 margin-left-10 btn-keyword btn-anc-color-blue '+classe+'" data-keyword="'+keyword+'">'+
                                    keyword+
                                '</button><br class="hidden-xs">';
                    });
                }
            }
        });
    });
    $("#sub-menu-left").html(html);

    $(".btn-keyword").click(function(){
        var key = $(this).data("keyword");
        $("#main-search-bar").val(key);
        $("#second-search-bar").val(key);
        startWebSearch(key, currentCategory);

        $(".btn-keyword").removeClass("active");
        $(this).addClass("active");
    });
}


function addToFavorites(id){ //utilise les cookies

    var myFavorites = $.cookie('webFavorites');
    console.log("myFavorites", myFavorites);

    if(typeof myFavorites == "undefined"){
        myFavorites = new Array(id);
        $("#modalFavorites #listFav").html("");
        showInFavory(myFavorites, id)
    }else{
        if(myFavorites != ""){
            myFavorites = myFavorites.split(",");
        }else{
            myFavorites = new Array(id);
            $("#modalFavorites #listFav").html("");
            showInFavory(myFavorites, id)
        }
        if(myFavorites.indexOf(id)==-1){
            myFavorites.push(id);
            showInFavory(myFavorites, id)
        }
    }

    console.log("myFavorites", myFavorites);

    var path = location.pathname;
    $.cookie('webFavorites', myFavorites,   { expires: 365, path: path });

    

    toastr.success("Ajouté à vos favoris");
}
function deleteFavorites(id){ //utilise les cookies

    var myFavorites = $.cookie('webFavorites');
    console.log("deleteFavorites1", myFavorites);

    if(typeof myFavorites != "undefined"){
        myFavorites = myFavorites.split(",");
        if(myFavorites.indexOf(id)>-1){
            myFavorites.splice(myFavorites.indexOf(id),1);
        }
    }
    console.log("deleteFavorites2", myFavorites, myFavorites.length);

    var path = location.pathname;
    $.cookie('webFavorites', myFavorites,   { expires: 365, path: path });
    
    $("#fav"+id).remove();
    toastr.success("deleteFavorites : "+id);
}

function showInFavory(myFavorites, id){
    var htmlFav = $(".url-"+id+" .addToFavInfo").html();

    htmlFav = '<div class="col-md-6 div-fav margin-bottom-15 text-left" id="fav'+id+'">'+htmlFav+"</div>";

    $("#modalFavorites #listFav").append(htmlFav);
    $("#modalFavorites .tooltip.fade.in").remove();

    $("#modalFavorites .btn-favory").off().click(function(){
        var id = $(this).data("idfav");
        deleteFavorites(id);
    });
}

</script>