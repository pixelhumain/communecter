<?php foreach ($result as $key => $v) { ?>
<div class="border-dark margin-bottom-30 col-xs-12 col-lg-6">
    <div class=" ">
        
        <?php 
            $img = "";
            if(@$v["profilMediumImageUrl"] && $v["profilMediumImageUrl"] != ""){
                $img = $v["profilMediumImageUrl"];?>
                <img src="<?php echo $img ?>" class="img-responsive">
        <?php
            }
        ?> 
        
    </div>
    <div class="padding-5 ">
        <?php 
            $type = null;
            if(@Element::getFaIcon(@$v["type"]))
                $type = @$v["type"];
            else if(@$v["typeSig"])
                $type = $v["typeSig"];

            echo date("d/m/Y H:i",@$v["updated"]);
            echo "<br/>".$type?> 
        <?php //DDA : if( @$v["organizerType"] && @$v["organizerId"] ) echo "-".Element::getLink( @$v["organizerType"],@$v["organizerId"] )?>
        <?php //DDA : if( @$v["parentType"] && @$v["parentId"] ) echo ">".Element::getLink( @$v["parentType"],@$v["parentId"] )?>

        <?php //if( @$v["creator"] ) echo ">".Element::getLink( Person::COLLECTION,@$v["creator"] )?>
        <br/>
        <div class="text-right">
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
</div>
<?php } ?>