<?php
$cs = Yii::app()->getClientScript();

?>


<div><h2>Clean-up des tags de Communecter </h2></div>

<?php

	$m = new MongoClient();
    $db = $m->pixelhumain;
    $collections = $db->getCollectionNames();
    $col = $m->selectDB("pixelhumain")->organizations;

    $res = array();
    $nb_col_news=0;
    $nb_col_orga=0;
    $nb_col_actions=0;
    $nb_col_project=0;
    $nb_col_surveys=0;
    $nb_news=0;

    $tag_filter = array('tags' => 'Alimentation');

	$doublon = json_decode(file_get_contents("/home/damien/workspace/modules/communecter/data/temp/doublon.json"));

	foreach ($doublon as $key => $value) {

      	foreach ($value as $key2 => $value2) {
        	$tag_filter = array('tags' => $value2);
      
	        foreach ($collections as $collection) {

	          $cursor = PHDB::find($collection, $tag_filter);

	          foreach ($cursor as $doc) {

   	            array_push($res, $doc);

            	if(isset($doc['name'])) {
	           		print('<br/>Pour l\'élement : '. $doc['name'].'<br/>');
	           	} 

	            foreach ($doc['tags'] as $key3 => $value3) {

	             	if ($value3 == $value2) {

		                $phrase = 'Il faut changer '. $value3;
		                $phrase .= ' dans la collection '. $collection;
		                $phrase .= ' par le bon tag qui est : '. $key.'<br/>';

		                if ($collection == 'news') {
   			                $nb_col_news++;
		                } elseif ($collection == 'organizations') {
			                $nb_col_orga++;
		                } elseif ($collection == 'actions') {
		                	$nb_col_actions++;
		                } elseif ($collection == 'projects') {
		                	$nb_col_project++;
		                } elseif ($collection == 'surveys') {
		                	$nb_col_surveys++;
		                }
	          
		                echo $phrase;

		                //Ligne suivante à décommenté pour réaliser le Clean Up des tags 

		                CleanTags::cleanAllTags($collection, $doc, $key, $key3);

		                if(!isset($doc['name'])) {	

		         		 	$nb_news++;

		         		} 

		            }

   	            	
	         			
	            PHDB::update( $collection, array("_id" => $doc['_id']) , 
	                        array('$pull' => array("tags" => null)));
	            }

	          }

	        }
    
      	}

	}

?>

<div>
	<h3>AU FINAL : </h3>

	Il y a <?php echo $nb_news?> news qui vont voir leurs tags modifiés<br/>
	Il y a <?php echo $nb_col_orga?> organisations qui vont voir leurs tags modifiés<br/>
	Il y a <?php echo $nb_col_actions?> actions qui vont voir leurs tags modifiés<br/>
	Il y a <?php echo $nb_col_project?> projets qui vont voir leurs tags modifiés<br/>
	Il y a <?php echo $nb_col_surveys?> propositions qui vont voir leurs tags modifiés<br/>


</div>

<br/>

<div id="clean_tags_button" class="btn btn-primary">Clean-Up !</div>

<script type="text/javascript">

    alldata = <?php echo json_encode($res) ?>;
    console.dir(alldata);


    jQuery(document).ready(function() {
    setTitle("Espace administrateur","cog");

	});


  	function jscleanAllTags($collection, $doc) {

		console.log('TEST LANCEMENT FONCITON');

	}	

</script>