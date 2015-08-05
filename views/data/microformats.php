<style>
ol.slats li {
	margin: 0 0 10px 0;
	padding: 0 0 10px 0;
	border-bottom: 1px solid #eee;
	}
ol.slats li:last-child {
	margin: 0;
	padding: 0;
	border-bottom: none;
	}
ol.slats li h3 {
	font-size: 18px;
	font-weight: bold;
	line-height: 1.1;
	}
ol.slats li h3 a img {
	float: left;
	margin: 0 10px 0 0;
	padding: 4px;
	border: 1px solid #eee;
	}
ol.slats li h3 a:hover img {
	background: #eee;
	}
ol.slats li p {
	margin: 0 0 0 76px;
	font-size: 14px;
	line-height: 1.4;
	}
ol.slats li p span.meta {
	display: block;
	font-size: 12px;
	color: #999;
	}		
	h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}	
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>Référence des collections et document de la base Mongo</h2>
    <p>
    	L'objectif ici est d'etre transparent et garder une trace des differents microformats 
    	élaboré au cours du projet.</br>
    	La table microformat peut contenir plus de details, et devrait devenir l'unique reference des microformat du projet</br> 
    	<br/>Tout ce que vous voyez ci dessous vient directement de la base de donnée (WYSIWYG)
    	<br/>Bonne pratique : Chaque fois qu'un nouveau *microformat ou document est creer et inséré dans la base de donnée
    	<br/>il faut impérativement le lister ici, l'expliquer et coder la requete pour en voir le code exact.
    	<br/>De facon pratique, le code Json visible servira de copier coller pôur la réutilisation.  
    	<br/> Microformat : structure JSon décrivant ou modélisant quelque chose (action, person, event, concept , objet... )
    </p>
<ol class="slats">
	
	<li class="group">
		<h3>Microformats </h3>
		<p> Cette collections est une librairie de schema de microformat <br/>
		on ajoute un type qu'on veut decrire, dont on veut construire une formulaire dynamiquemnt </br>
		contrsuire un menu dynamiquement et generiquement </p>
		
		<?php 
		$entry = Yii::app()->mongodb->microformats->findOne(array("_id"=>new MongoId("52ef3d3ac073ef404cc85803")));
	    array_shift($entry);
		?>
		<pre id="mfjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 

		$("#mfjson").html(JSON.stringify(obj, null, 4));
		</script>
	</li>
	
	<li class="group">
		<h3>Citoyen</h3>
		<p> 
		Ces documents enregistrent toute l'information correspondant aux citoyens
		</p>
		<?php 
		$entry = Yii::app()->mongodb->citoyens->findOne(array("email"=>"oceatoon@gmail.com"));
	    array_shift($entry);
	    $entry["associations"]=array();
	    $entry["events"]=array();
	    $entry["positions"]=array();
	    $entry["img"]="";
		?>
		<pre id="citoyenjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 

		$("#citoyenjson").html(JSON.stringify(obj, null, 4));
		</script>
	</li>
	
	<li class="group">
	    <?php 
		$entries = Yii::app()->mongodb->groups->find();
		$listNames = "";
		$listNamesA = array(); 
		foreach($entries as $e){
		    if(isset($e["type"]) && !in_array($e["type"], $listNamesA)){
		        $listNames .= $e["type"].", ";
		        array_push($listNamesA, $e["type"]);
		    }
		}
		?>
		<h3>Group ( Types : <?php echo $listNames?> )</h3>
		<p> 
		Toute structure qui regroupe des citoyens
		</p>
		
		<h4>Association</h4>
		<?php 
		$entry = Yii::app()->mongodb->groups->findOne(array("name"=>"Open Atlas"));
	    array_shift($entry);
		?>
		<pre id="assojson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#assojson").html(JSON.stringify(obj, null, 4));
		</script>
		
		<h4>Entreprise</h4>
		<?php 
		$entry = Yii::app()->mongodb->groups->findOne(array("name"=>"Oceatoon - Tibor Katelbach"));
	    array_shift($entry);
		?>
		<pre id="entreprisejson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#entreprisejson").html(JSON.stringify(obj, null, 4));
		</script>
		
		<h4>Event</h4>
		<?php 
		$entry = Yii::app()->mongodb->groups->findOne(array("key"=>"StartupWeekEnd2012"));
	    array_shift($entry);
	    
	    $entry["adminEmail"]=array();
	    $entry["coaches"]=array();
	    $entry["jurys"]=array();
	    $entry["organisateurs"]=array();
	    $entry["participants"]=array();
	    $entry["projects"]=array();
	    $entry["pwd"]="";
		?>
		<pre id="eventjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#eventjson").html(JSON.stringify(obj, null, 4));
		</script>
		
		<h4>Projet</h4>
		<?php 
		$entry = Yii::app()->mongodb->groups->findOne(array("name"=>"Pixel Humain"));
	    array_shift($entry);
	    
	    $entry["team"]=array();
	    $entry["mentors"]=array();
	    $entry["events"]=array();
	    $entry["owner"]=array();
		?>
		<pre id="projetjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#projetjson").html(JSON.stringify(obj, null, 4));
		</script>
	</li>
	
	<li class="group">
		<?php 
		$entries = Yii::app()->mongodb->data->find();
		$listNames = "";
		$listNamesA = array(); 
		foreach($entries as $e){
		    if(!in_array($e["type"], $listNamesA)){
		        $listNames .= $e["type"].", ";
		        array_push($listNamesA, $e["type"]);
		    }
		}
		?>
		<h3>Data ( Types : <?php echo $listNames?> ) </h3>
		<p> Certaines pages sont construitent avec données structurés </p>
		
		
		<h4>Page</h4>
		<?php 
		$entry = Yii::app()->mongodb->data->findOne(array("key"=>"positivons","type"=>"page"));
	    array_shift($entry);
		?>
		<pre id="pagejson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 

		$("#pagejson").html(JSON.stringify(obj, null, 4));
		</script>
		
		<h4>Question Réponse</h4>
		<?php 
		$entry = Yii::app()->mongodb->data->findOne(array("question"=>"Objet de l’association Open Atlas"));
	    array_shift($entry);
	    $entry["question"]="";
	    $entry["answer"]="";
		?>
		<pre id="qajson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 

		$("#qajson").html(JSON.stringify(obj, null, 4));
		</script>
		
		<h4>RSS</h4>
		<?php 
		$entry = Yii::app()->mongodb->data->findOne(array("url"=>"http://www.saintjoseph.re/spip.php?page=rss_nouveautes"));
	    array_shift($entry);
		?>
		<pre id="rssjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#rssjson").html(JSON.stringify(obj, null, 4));
		</script>
		<h4>Post</h4>
		<?php 
		$entry = Yii::app()->mongodb->data->findOne(array("title"=>"Proverbe-- Abbé Pierre"));
	    array_shift($entry);
		?>
		<pre id="postjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#postjson").html(JSON.stringify(obj, null, 4));
		</script>
		
	</li>
	
	<li class="group">
		<?php 
		$entries = Yii::app()->mongodb->notifications->find();
		$listNames = "";
		$listNamesA = array(); 
		foreach($entries as $e){
		    if(!in_array($e["type"], $listNamesA)){
		        $listNames .= $e["type"].", ";
		        array_push($listNamesA, $e["type"]);
		    }
		}
		?>
		<h3>Notification ( Types : <?php echo $listNames?> )</h3>
		<p> Servent à informer tout les acteurs du systeme (personnes physique) </p>
		
		<?php 
		$entry = Yii::app()->mongodb->notifications->findOne(array("_id"=>new MongoId("52382468f6b95c6c20000867")));
	    array_shift($entry);
		?>
		<pre id="notificationjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#notificationjson").html(JSON.stringify(obj, null, 4));
		</script>
	</li>
	
	<li class="group">
		<?php 
		$entries = Yii::app()->mongodb->codespostaux->find();
		$listNames = "";
		$listNamesA = array(); 
		foreach($entries as $e){
		    if(!in_array($e["type"], $listNamesA)){
		        $listNames .= $e["type"].", ";
		        array_push($listNamesA, $e["type"]);
		    }
		}
		?>
		<h3>CodesPostaux ( Types : <?php echo $listNames?> )</h3>
		<p> Récolte toute les infos concernant une collectivités : quartier,ville,commune,agglo,département, région et plus si affinité</p>
		
		<?php 
		$entry = Yii::app()->mongodb->codespostaux->findOne(array("_id"=>new MongoId("5264ea2ff6b95c942700573e")));
	    array_shift($entry);
	    $entry["demographie"] = array();
	    $entry["structure"] = array();
	    $entry["servicesMunicipaux"] = array();
	    $entry["annuaireElu"] = array();
		?>
		<pre id="cpjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#cpjson").html(JSON.stringify(obj, null, 4));
		</script>
		
	</li>
	
	<li class="group">
		<h3>Candidats par CodesPostaux </h3>
		<p> Format Standard d'un candidat au municipale</p>
		<?php 
		$entry = Yii::app()->mongodb->codespostauxCandidats->findOne(array("_id"=>new MongoId("528467d9c073ef2528e188f8")));
	    array_shift($entry);
	    $entry["2014"][0]["program"] = array();
		?>
		<pre id="candidatsjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 
		$("#candidatsjson").html(JSON.stringify(obj, null, 4));
		</script>
	</li>
	
	<li class="group">
	    <?php 
		$entries = Yii::app()->mongodb->lists->find();
		$listNames = "";
		foreach($entries as $e){
		    $listNames .= $e["name"].", ";
		}
		?>
		<h3>Lists ( Names : <?php echo $listNames?> )</h3>
		
		<p> Contient tou les listings du PH :  </p>
		
		<?php 
		$entry = Yii::app()->mongodb->lists->findOne(array("name"=>"types"));
	    array_shift($entry);
		?>
		<pre id="listsjson"></pre>
		<script>
		var obj = <?php echo json_encode($entry)?>; 

		$("#listsjson").html(JSON.stringify(obj, null, 4));
		</script>
	</li>
	
</ol>	
</div></div>		
<script type="text/javascript">
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();
};
</script>