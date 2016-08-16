<?php foreach ($result as $key => $v) { ?>
<div class="border-dark margin-bottom-30 col-xs-12 col-lg-6">
    <div class=" ">
        <img src="http://placehold.it/250x100" class="img-responsive">
    </div>
    <div class="padding-5 ">
        <?php echo date("d/m/Y",@$v["updated"]).$v["type"]?> 
        <?php if( @$v["organizerType"] && @$v["organizerId"] ) echo "-".Element::getLink( @$v["organizerType"],@$v["organizerId"] )?>
        <?php if( @$v["parentType"] && @$v["parentId"] ) echo ">".Element::getLink( @$v["parentType"],@$v["parentId"] )?>
        <?php if( @$v["parentType"] && @$v["parentId"] ) echo ">".Element::getLink( @$v["parentType"],@$v["parentId"] )?>
        <?php if( @$v["creator"] ) echo ">".Element::getLink( Person::COLLECTION,@$v["creator"] )?>
        <br/>
        <div class="text-right">
            <i class="fa fa-<?php echo Element::getFaIcon(@$v["type"])?>"></i> <?php echo Element::getLink(@$v["type"],(string)@$v["_id"])?>
        </div>
    </div>
</div>
<?php } ?>