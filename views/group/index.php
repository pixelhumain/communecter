
<!-- BLOCK HTML  -->

<div class="container ">
    <br/>
    <div class="">
		<h2>Mes Groupes</h2>
		<p>Toutes les entités groupés que je gere ou auquel je participe </p>
		
			<div class="row">
            
                <div class='col-md-6'>
                    <h2>Associations</h2>
                    <ul>
                        <?php 
                            $pa = Yii::app()->mongodb->groups->find(array("type"=>PHType::TYPE_ASSOCIATION));
                            foreach ($pa as $e){
                            ?>
                            <li class="group"><a href="<?php echo Yii::app()->createUrl('association/view/id/'.$e["_id"])?>"><?php echo $e["name"]?></a>
                            <?php 
                                echo ((Citoyen::isAdminUser()) ? '<a href="#'.$e["_id"].'" class="updateBtn  pull-right"><span class="icon-pencil-neg"></span></a>' : "");
                                echo ((Citoyen::isAdminUser()) ? '<a href="#'.$e["_id"].'" class="delBtn  pull-right"><span class="icon-cancel"></span></a>' : "");
                                ?>
                            </li>
                            <?php }?>
                    </ul>
                </div>

                <div class='col-md-6'>
                    <h2>Entreprises</h2>
                    <ul>
                        <?php 
                            $pa = Yii::app()->mongodb->groups->find(array("type"=>PHType::TYPE_ENTREPRISE));
                            foreach ($pa as $e){
                            ?>
                            <li class="group"><a href="<?php echo Yii::app()->createUrl('index.php/entreprise/view/id/'.$e["_id"])?>"><?php echo $e["name"]?></a>
                            <?php 
                                echo ((Citoyen::isAdminUser()) ? '<a href="#'.$e["_id"].'" class="updateBtn pull-right"><span class="icon-pencil"></span></a>' : "");
                                echo ((Citoyen::isAdminUser()) ? '<a href="#'.$e["_id"].'" class="delBtn pull-right"><span class="icon-cancel"></span></a>' : "");
                                ?>
                            </li>
                            <?php }?>
                    </ul>
                </div>
                
                <div class='col-md-6'>
                    <h2>Applications</h2>
                    <ul>
                        <?php 
                        $me = Yii::app()->mongodb->citoyens->findOne( array( "_id"=>new MongoId( Yii::app()->session["userId"] ) ) );
                        if( isset( $me["applications"] ) ){
                            foreach ($me["applications"] as $k=>$v){
                            ?>
                            <li class="group"><a href="<?php echo Yii::app()->createUrl($k)?>"><?php echo $k?></a></li>
                            <?php }
                        }?>
                    </ul>
                </div>

        		<div class='col-md-6'>
                    <h2>Je participe</h2>
                    <ul>
                        <?php 
                        $groups = Yii::app()->mongodb->groups->find(array('$or' => array( 
                                                                                    array("participants"=>new MongoId(Yii::app()->session["userId"])),
                                                                                    array("participants"=>Yii::app()->session["userId"]),
                                                                                    )
                                                                                ));
                        foreach ($groups as $g){
                        ?>
                        <li class="group"><a href="<?php echo Yii::app()->createUrl('group/view/id/'.$g["_id"])?>"><?php echo $g["name"]?></a></li>
                        <?php }?>
                    </ul>
                </div>
                
                <div class='col-md-6'>
                    <h2 class="">J'anime</h2>
                    <ul > 
                    <?php 
                    $groups = Yii::app()->mongodb->groups->find( array('$or' => array(
                                                                                array( "owner" => new MongoId( Yii::app()->session["userId"] ) ),
                                                                                array( "owner" => Yii::app()->session["userId"]  ),
                                                                                array( "organisateurs" => new MongoId( Yii::app()->session["userId"] ) ),
                                                                                array( "organisateurs" => Yii::app()->session["userId"]  )
                                                                                )
                                                                            ));
                    foreach ($groups as $g){
                    ?>
                    <li class="group"><a href="<?php echo Yii::app()->createUrl('group/view/id/'.$g["_id"])?>"><?php echo $g["name"]?></a></li>
                    <?php }?>
                    </ul>
                </div>
				
			</div>
			<div class="clear"></div>
		
	</div>
</div>

<!-- BLOCK JAVASCRIPT  -->

<script type="text/javascript"		>
initT['animInit'] = function(){

  
};
</script>