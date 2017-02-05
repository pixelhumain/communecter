
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
    '/assets/js/web.js',
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
.portfolio.p1{
    padding-top:20px;
}

.btn-fast-access{
    font-size: 24px;
}

#section-fav{
    max-height: 40px;
    overflow: hidden;
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

<section class="padding-top-5 text-center margin-bottom-10" id="section-fav">
    <a href="#co2.media" target="_blank" class="tooltips btn-fast-access" data-placement="bottom" data-toggle="tooltip" 
       title="Aller sur KgougleActu"><i class="fa fa-newspaper-o fa-2 padding-10 text-dark"></i></a> 
    
    <?php if(!empty($myWebFavorites)){ ?>
    <i class="fa fa-ellipsis-v btn-fast-access padding-10 letter-yellow hidden-xs hidden"></i>
    <?php } ?>   

    <a href="https://www.youtube.com" target="_blank" class="tooltips btn-fast-access" data-placement="bottom" data-toggle="tooltip" 
       title="Aller sur YouTube"><i class="fa fa-youtube-play fa-2 padding-10 letter-red"></i></a> 
    <a href="https://www.facebook.com/" target="_blank" class="tooltips btn-fast-access" data-placement="bottom" data-toggle="tooltip" 
       title="Aller sur Facebook"><i class="fa fa-facebook-square fa-2 padding-10 letter-blue"></i></a>
       
    <?php if(!empty($myWebFavorites)){ ?>
       <i class="fa fa-ellipsis-v btn-fast-access padding-10 letter-yellow hidden-xs hidden"></i>
       
        <?php  

            foreach ($myWebFavorites as $key => $siteurl) { 
                if(@$siteurl["favicon"]){ 

                    $file_headers = @get_headers($siteurl["favicon"]);
                    //echo $siteurl["favicon"]."-".$file_headers[0];
                    if($file_headers[0] == "HTTP/1.1 200 OK") {
        ?>
            <a class="siteurl_title letter-blue elipsis tooltips" target="_blank" href="<?php echo $siteurl["url"]; ?>"
                data-placement="bottom" data-toggle="tooltip" title="<?php echo $siteurl["title"]; ?>">
                    <img src='<?php echo $siteurl["favicon"]; ?>' alt="o" height=18 class="margin-right-5" style="margin:0 10px;margin-top:4px;" alt="">
            </a>
                
        <?php   }}
            } 
        ?>

        <i class="fa fa-ellipsis-v btn-fast-access padding-10 letter-yellow pull-right" style='margin-left:-10px;'></i>
        <button class="btn btn-link tooltips pull-right no-padding" data-placement="bottom" title="Afficher vos favoris"
           data-target="#modalFavorites" data-toggle="modal">
            <i class="fa fa-star btn-fast-access padding-10 letter-yellow" style="font-size: 18px;margin-top: 3px;"></i>
        </button>
    
    <?php } ?>
</section>

<section class="no-padding hidden" id="sectionSearchResults">
    <div class="row">

        <div class="col-md-2 col-sm-2 text-right" id="sub-menu-left"></div>
        <div class=" col-lg-8 col-md-7 col-sm-7" id="searchResults"></div>
        <div class="col-md-2 col-sm-2 text-left" id="sub-menu-right">
            <!-- <a href="https://github.com/pixelhumain" target="_blank">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/anc/105.jpg" height=170>
            </a><br><br>
            <a href="https://github.com/pixelhumain" target="_blank">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/anc/105.jpg" height=170>
            </a><br><br> -->
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


</script>