<style>
    
    .elemt_name, .elemt_date {
        font-size: 13px;
        height: 25px;
        padding: 5px 10px;
        width: 100%;
        float: left;
        text-overflow: ellipsis;
        overflow: hidden;
        max-width: 100%;
        font-weight: 600;
    }
    .elemt_date {
        font-weight: 200;
        padding-top: 2px;
        font-size: 11px;
    }
    .elemt_name a{
        color:#3C5665;

    }
    .elemt_name a:hover{
       text-decoration: underline !important;
    }
    .elemt_name i.fa{
        font-size: 19px;
    }
    .col-updated .border-dark {
        border: 0;
        box-shadow: 0px 0px 6px rgba(0, 0, 0, 0.3);
    }
    
    .elemt_img{
        max-height:150px;
        overflow: hidden;
        width:100%;
        text-align:center;
        float:left;
        background: #cfcfcf;

    }
    .elemt_img img{
        min-height: 150px;
    }

    .elemt_img .img-responsive{
        display:inline-block;
    }
</style>
<div class="col-xs-12 no-padding col-nowList"  data-tpl="pod.nowList">
    <?php foreach ($result as $key => $v) { 
        $specs = Element::getElementSpecsByType(@$v["type"]."s");

        $type = null;
        if(@$specs) $type = @$v["type"];
        else if(@$v["typeSig"]) $type = $v["typeSig"];
    ?>
    <div class="border-dark margin-bottom-15 col-xs-12 no-padding el-nowList <?php echo $type?>">
        <div class="pull-left col-xs-12 no-padding">
            <?php 
                $classMin = "";
                $img = Element::getImgProfil($v, "profilMediumImageUrl", $this->module->assetsUrl);
                if(!@$v["profilMediumImageUrl"] || $v["profilMediumImageUrl"] == "") 
                    $classMin = "min";
            
                $style = "";
               // if(@$v["profilMediumImageUrl"] && @$v["profilMediumImageUrl"] != ""){
               //var_dump($v); ?>
                    <a href="#<?php echo $specs["hash"].(@$v["_id"]?$v["_id"]:@$v["id"]); ?>" class="lbh add2fav elemt_img">
                    <img src="<?php echo $img ?>" class="img-responsive <?php echo $classMin; ?>">
                    </a>
                <?php //$style = "margin-top: -32px;"; } ?> 
        </div>
        <div class="elemt_name" style="<?php echo $style ?>">
            <i style="color:<?php echo @$specs["color"]?>" class="fa fa-<?php echo $specs["icon"]?>"></i> 
            <?php 
            $id = null;
            if(@$v["_id"])
                $id = (string)@$v["_id"];
            else if(@$v["id"])
                $id = $v["id"];
            echo ($type) ? Element::getLink(@$type."s",$id) : "no type"; //echo @$type;?>
        </div>
        <div class="elemt_date pull-left margin-top-5 text-left">
            <i class="fa fa-flash"></i> actif 
            <span class="dateTZ"><?php echo @$v["updatedLbl"];?> </span>            
            <?php //DDA : if( @$v["organizerType"] && @$v["organizerId"] ) echo "-".Element::getLink( @$v["organizerType"],@$v["organizerId"] )?>
            <?php //DDA : if( @$v["parentType"] && @$v["parentId"] ) echo ">".Element::getLink( @$v["parentType"],@$v["parentId"] )?>

            <?php //if( @$v["creator"] ) echo ">".Element::getLink( Person::COLLECTION,@$v["creator"] )?>
        </div>
    </div>
    <?php } ?>
</div>

<script type="text/javascript" >

jQuery(document).ready(function() {
    // $(".elemt_date").each(function() {
    //     var elementTime = $(this).children(".dateTZ").attr("data-time");
    //     var elementDate = new Date(elementTime * 1000);
    //     $(this).children(".dateTZ").text(elementDate.toLocaleDateString() + " " + elementDate.toLocaleTimeString());
    // });
});

function enlargeNow() { 
    if(!$(".col-feed.closed").length){
        $(".titleNowEvents .btnhidden").show();
        $("#enlargeNow").attr("class","fa fa-caret-right");
        $(".col-feed").attr("class","hidden col-feed closed");
        $(".col-updated").attr("class","col-xs-12 col-updated");
        $("#nowList").attr("class","col-xs-12 no-padding");
        $(".el-nowList").removeClass("col-xs-12").addClass('col-xs-3');
        
    } else {
        $(".titleNowEvents .btnhidden").hide();
        $("#enlargeNow").attr("class","fa fa-caret-left");
        $(".col-feed").attr("class","col-xs-12 col-md-9 col-feed");
        $(".col-updated").attr("class","col-xs-12 col-md-3 col-updated");
        $("#nowList").attr("class","col-xs-12 no-padding");
        $(".el-nowList").removeClass('col-xs-3').addClass("col-xs-12");
    }
}

</script>