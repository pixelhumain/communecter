
<?php foreach ($result as $key => $v) { ?>
<div class="border-dark margin-bottom-15 col-xs-12 col-lg-12 no-padding">
    <div class="pull-left">
        
        <?php 
             $type = null;
            if(@Element::getFaIcon(@$v["type"]))
                $type = @$v["type"];
            else if(@$v["typeSig"])
                $type = $v["typeSig"];

            $specs = Element::getElementSpecsByType(@$type);

            $classMin = "";
            $img = Element::getImgProfil($v, "profilMediumImageUrl", $this->module->assetsUrl);
            if(!@$v["profilMediumImageUrl"] || $v["profilMediumImageUrl"] == "") $classMin = "min";
        ?>
        <a href="<?php echo $specs["hash"].@$v["_id"]; ?>" class="lbh">
            <img src="<?php echo $img ?>" class="pull-left img-responsive elemt_img <?php echo $classMin; ?>">
        </a>
       
        <div class="elemt_name">
            <i class="fa fa-<?php echo Element::getFaIcon(@$type)?>"></i> 
            <?php 
            $id = null;
            if(@$v["_id"])
                $id = (string)@$v["_id"];
            else if(@$v["id"])
                $id = $v["id"];
            echo ($type) ? Element::getLink(@$type,$id) : "no type"?>
        </div>
    </div>
    <h4 class="pull-left text-dark no-margin padding-10">
        <i class="fa fa-clock"></i> 
        <?php 
           echo date("d/m/Y H:i",@$v["updated"]);
            //echo "<br/>".$type
        ?> 
        <?php //DDA : if( @$v["organizerType"] && @$v["organizerId"] ) echo "-".Element::getLink( @$v["organizerType"],@$v["organizerId"] )?>
        <?php //DDA : if( @$v["parentType"] && @$v["parentId"] ) echo ">".Element::getLink( @$v["parentType"],@$v["parentId"] )?>

        <?php //if( @$v["creator"] ) echo ">".Element::getLink( Person::COLLECTION,@$v["creator"] )?>
    </h4>
</div>
<?php } ?>