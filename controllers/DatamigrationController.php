<?php
	
/* Author Bouboule (clement.damiens@gmail.com)
* Controller to update data with all bash done on db
* Documentation done before each function and in communecter/docs/devlog.md
*
*
*/
class DatamigrationController extends CommunecterController {
  
  protected function beforeAction($action) {
	return parent::beforeAction($action);
  }

  public function actionKnowsToFollows(){
	 $persons=PHDB::find(Person::COLLECTION);
	foreach($persons as $key => $data){
		if(isset($data["links"]["followers"]) || isset($data["links"]["follows"])){
			$followers=array();
			$follows=array();
			if(isset($data["links"]["followers"]) && !empty($data["links"]["followers"])){
				$followers=$data["links"]["followers"];
			}
			if(isset($data["links"]["follows"]) && !empty($data["links"]["follows"])){
				$follows=$data["links"]["follows"];
			}
			PHDB::update(Person::COLLECTION,
				array("_id" => $data["_id"]) , 
				array('$unset' => array("links.followers" => ""))
			);
			PHDB::update(Person::COLLECTION,
				array("_id" => $data["_id"]) , 
				array('$unset' => array("links.follows" => ""))
			);
			if(!empty($followers)){
				//foreach ($followers as $uid => $e){	
					PHDB::update(Person::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("links.follows" => $followers))
						);
				//}
			}
			if (!empty($follows)){
				foreach ($follows as $uid => $e){	
					if($e["type"]=="citoyens"){
					PHDB::update(Person::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("links.followers.".$uid => $e))
						);
					} else {
						PHDB::update(Person::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("links.follows.".$uid => $e))
						);
					}
				}
			}
			$newLinks=PHDB::findOneById(Person::COLLECTION ,$data["_id"]);
			echo "<br/>/////////////////////////// NEW LINK ////////////////////<br/>";
			print_r($newLinks["links"]);
			}	
		}
	
  }
	//Refactor permettant de mettre la size des doc en bytes type string 
	// Pas encore Passez en prod et dev
	// A lancer une fois pour que ce soit stocké en int32 ou int64
	public function actionChangeSizeDocumentToBytesNumber(){
		$document=PHDB::find(Document::COLLECTION);
		$nbDoc=count($document);
		echo "Nombre de documents appelés : ".$nbDoc;
		$i=0;
		foreach($document as $key => $data){
			if(@$data["size"]){
				$size="";
				echo "<br/>".$data["_id"]."//".$data["size"]."///";
				echo gettype($data["size"]);
				if(gettype($data["size"])=="double"){
					$size = (int)$data["size"];
				}
				if (strstr($data["size"], 'M', true)){
					$size=((float)$data["size"])*1048576;
				} 
				else if(strstr($data["size"], 'K', true)){
					$size = (float)($data["size"])*1024;
				}
				$i++;
				if(@$size && !empty($size)){
					echo "new size : ".$size;
					PHDB::update(Document::COLLECTION,
							array("_id" => $data["_id"]) , 
							array('$set' => array("size" => (int)$size))	
		
					);
				}	
			}
		}
		echo "</br>Nombre de documents traités pour la size : ".$i;  
	}
	//Refactor of contentKey
	//@param string contentKey type type.view.contentKey become contentKey
	//!!!!!!!!!!!! CAREFULLY THIS METHOD IS FOR COMMUNECTER AND NOT FOR GRANDDIR !!!!!!!!!!!!!!!!!//////
	// For the moment refactorContentKey change all contentKey to profil 
	// Function need to be change with an explode and $contentKey = $explode[2] for granddir
	public function actionRefactorContentKey(){
		$document=PHDB::find(Document::COLLECTION);
		$nbDoc=count($document);
		echo "Nombre de documents appelés : ".$nbDoc;
		$i=0;
		foreach($document as $key => $data){
			if(strstr($data["contentKey"],'.')){
				echo $data["contentKey"]."<br/>";
				PHDB::update(Document::COLLECTION,
					array("_id" => $data["_id"]) , 
					array('$set' => array("contentKey" => "profil"))	
				);
				$i++;
			}
		}
		echo "</br>Nombre de documents concerné par le refactor : ".$i;  
	}
	// Washing of docmuent
	// Wash data with array in params @size which could be string
	// Wash data with no type or no id, represent the target of the document
	// Wash data with no contentKey
	public function actionWashIncorrectAndOldDataDocument(){
		$document=PHDB::find(Document::COLLECTION);
		$nbDoc=count($document);
		echo "Nombre de documents appelés : ".$nbDoc;
		$nbDocSizeIsArray=0;
		$nbDocNoTypeOrNoId=0;
		$nbDocNoContentKey=0;
		foreach($document as $key => $data){
			if(gettype($data["size"])=="array"){
				echo "<br/>//////// This document content an array for size : <br/>";
				print_r($data);
				PHDB::remove(Document::COLLECTION,array("_id" => $data["_id"]));
				$nbDocSizeIsArray++;
			}
			if( !@$data["type"] || !@$data["id"] || empty($data["type"]) || empty($data["id"])){
				echo "<br/>//////// This document doesn't content any type or id : <br/>";
				print_r($data);
				PHDB::remove(Document::COLLECTION,array("_id" => $data["_id"]));
				$nbDocNoTypeOrNoId++;
			}
			if( !@$data["contentKey"] || empty($data["contentKey"])){
				echo "<br/>//////// This document doesn't content any contentKey : <br/>";
				print_r($data);
				PHDB::remove(Document::COLLECTION,array("_id" => $data["_id"]));
				$nbDocNoContentKey++;
			}
		}
		echo "</br>//////// <br/>Nombre de documents sans type ou id: ".$nbDocNoTypeOrNoId; 
		echo "</br>//////// <br/>Nombre de documents sans contentKey: ".$nbDocNoContentKey;
		echo "</br>//////// <br/>Nombre de documents avec size comme array: ".$nbDocSizeIsArray;  
	}
	/* 
	* Upload image from media type url content
	*	Condition: if not from communevent
	*	News uploadNewsImage
	*   Update link @param media.content.image in news collection
	*/
	public function actionUploadImageFromMediaUrlNews(){
	  $news=PHDB::find(News::COLLECTION);
	  $i=0;
	  foreach($news as $key => $data){
		  if(@$data["media"] && @$data["media"]["content"] && @$data["media"]["content"]["image"] && !@$data["media"]["content"]["imageId"]){
			  	if (strstr($data["media"]["content"]["image"],"upload/communecter/news/")==false){
			  		sleep(1);
			  		echo $data["media"]["content"]["image"]."<br/>";
			  		$returnUrl=News::uploadNewsImage($data["media"]["content"]["image"],$data["media"]["content"]["imageSize"],$data["author"]);
			  		$newUrl= Yii::app()->baseUrl."/".$returnUrl;
			  		echo 'Nouvelle url <br/>'.$newUrl."<br/>/////////////<br/>";
			  		PHDB::update(News::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("media.content.image" => $newUrl))			
					);
			  		$i++;
		 		}
			}
		}
		echo "nombre de news avec images provenant d'un autre site////////////// ".$i;
	}
	/* 
	* Scope public in news not well formated (ancient news)
	*	Condition: if not from communevent
	*	News uploadNewsImage
	*   Update link @param media.content.image in news collection
	*/
	public function actionBashNewsWrongScope(){
	  $news=PHDB::find(News::COLLECTION);
	  $i=0;
	  $nbCityCodeInsee=0;
	  $nbCityName=0;
	  $nbtodelete=0;
	  foreach($news as $key => $data){
		  if($data["scope"]["type"]=="public"){
			  if(@$data["scope"]["cities"]){
			  	//if(!@$data["scope"]["cities"][0]["postalCode"]){
				  //	echo "oui";
				  	$newScopeArray=array("type"=>"public","cities"=>array());
				  	if(gettype($data["scope"]["cities"][0])=="string"){

					  	  	echo "<br/>////////id News: ".$key. "/////////";				  	  						  	print_r($data["scope"]);
					  	foreach($data["scope"]["cities"] as $value){
						  	if(is_numeric($value)){
							  	echo "<br/>ici numérique:".$value;
							  	$city=Sig::getCityByCodeInsee($value);
							  	$newScopeArray["cities"][0]["codeInsee"]=$value;
							  	$newScopeArray["cities"][0]["postalCode"]=$city["postalCodes"][0]["postalCode"];
							  	if(@$data["geo"]){
								  	$newScopeArray["cities"][0]["geo"]=$data["geo"];
							  	}else{
								  	$newScopeArray["cities"][0]["geo"]=$city["geo"];
							  	}
							  	$nbCityCodeInsee++;
						  	} else {
							  	echo "<br/>ici non numérique mais string: ".$value;
							  	$city = PHDB::findOne(City::COLLECTION, array("alternateName" =>$value));
							  	$newScopeArray["cities"][0]["codeInsee"]=$city["insee"];
							  	$newScopeArray["cities"][0]["postalCode"]=$city["postalCodes"][0]["postalCode"];
							  	$newScopeArray["cities"][0]["geo"]=$city["geo"];
							  	$nbCityName++;
						  	}
						  	echo "<br/>===>News array scope: ///<br/>";

												  	print_r($newScopeArray);
						  	echo "<br/>";
					  	}
					  				  	$i++;
				  	}
			  	//}

			  } else{
				  echo "<br/>////news to delete avec wrong scope/////<br/>";
				  print_r($data["scope"]);
				  $nbtodelete++;
				  echo "<br/>";
				   $i++;
			  }
		}
		}
		echo "nombre de news avec insee enregistré: ".$nbCityCodeInsee."news";
		echo "nombre de news avec name enregistré: ".$nbCityName."news";
		echo "nombre de news à supprimer: ".$nbtodelete."news";
		echo "nombre de news avec data publique not well formated: ".$i."news";
	}
	/* First refactor à faire sur communecter.org 
	* Remove all id and type in and object target.id, target.type
	*	=> Modify target type city to target.id=author, target.type=Person::COLLECTION
	*	=> Add @params type string "news" OR "activityStream"
	*/
	public function actionRefactorNews(){
	  $news=PHDB::find(News::COLLECTION);
	  $i=0;
	  foreach($news as $key => $data){
		  if(@$data["type"] && $data["type"]!="activityStream"){
			  //print_r($data["_id"]);
			  // add une target au lieu de id et type et type devient news
			  // pour les type city => la target devient l'auteur
			  if($data["type"]!="news"){
				  if(@$data["id"]){
				  	$parentType=$data["type"];
				  	$parentId=$data["id"];
				  	if($parentType=="city"){
					  $parentType=Person::COLLECTION;
					  $parentId=$data["author"];
				  	}
				  PHDB::update(News::COLLECTION,
					array("_id" => $data["_id"]) , 
					array('$set' => array("target.type" => $parentType,"target.id"=>$parentId, "type" => "news"),'$unset' => array("id"=>""))			
					);
				$i++;
				} else if($data["type"]=="pixels"){
					PHDB::update(News::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("target.type" => "pixels","target.id"=>"", "type" => "news"),'$unset' => array("id"=>""))			
					);
					$i++;
				}
			}
			 // print_r($data);
		  }
		  if(@$data["type"] && $data["type"]=="activityStream"){
			  if(@$data["target"]){
			 	 //adapter le vocubulaire de target pour qu'il soit comment au news type "news"
			  	// passe target.objectType à target.type
				 $parentType=$data["target"]["objectType"];
				 // $parentId=$data["id"];
					  PHDB::update(News::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("target.type" => $parentType),'$unset' => array("target.objectType"=>""))			
					);
								$i++;
				}
		  }
		}
		echo "nombre de news ////////////// ".$i;
	}

   // Second refactor à faire sur communecter.org qui permet de netoyer les news sans scope
  public function actionWashingNewsNoScopeType(){
  $news=PHDB::find(News::COLLECTION);
  foreach($news as $key => $data){
		  if(!@$data["scope"]["type"]){
		  print_r($data);
		  PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
		  	
		}
		}
	}
   // Troisième refactor à faire sur communecter.org qui permet de netoyer les news sans target
   	
   	public function actionWashingNewsNoTarget(){
  		$news=PHDB::find(News::COLLECTION);
  		$i=0;
  		$nbNews=count($news);
		echo "Nombre de documents appelés : ".$nbNews;
  		foreach($news as $key => $data){
		  if($data["type"]=="news" && !@$data["target"]){
			  $i++;
			  print_r($data);
			  PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
		 // PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
		  	
			}
			else if ($data["type"]=="activityStream" && !@$data["target"]){
			$i++;
			  print_r($data);
			PHDB::update(News::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("target.type" => Person::COLLECTION,"target.id"=>$data["author"])));
			  //PHDB::update(News::COLLECTION, array("_id"=>new MongoId($key)));
		 // PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
		  	
			}
		}
		echo "nombre de news traitées ////////////// ".$i;
	}
	// Delete news with object gantts and needs
	public function actionDeleteNewsGanttsNeeds(){
	$newsNeeds=PHDB::find(News::COLLECTION,array("type"=>"activityStream","object.objectType"=>"needs"));
	$newsGantts=PHDB::find(News::COLLECTION,array("type"=>"activityStream","object.objectType"=>"gantts"));  		$i=0;	
  		foreach($newsNeeds as $key => $data){
		  //if(!@$data["target"]){
			  print_r($data);
			  PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
		 // PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
		 	$i++;
			//}
		}
		foreach($newsGantts as $key => $data){
			//if(!@$data["target"]){
			print_r($data);
			PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
			// PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key)));
			$i++;
			//}
		}
		echo "Nombre de news gantts ou needs suprimées : ".$i." news";
		
	}
	// Quatrième refactor à faire sur communecter.org qui permet de netoyer les news dont la target n'existe pas
	public function actionWashingNewsTargetNotExist(){
  		$news=PHDB::find(News::COLLECTION);
  		foreach($news as $key => $data){
		  	if(@$data["target"]){
				if(!@$data["target"]["type"]){
					if(@$data["target"]["objectType"]){
						$parentType=$data["target"]["objectType"];
						PHDB::update(News::COLLECTION,
							array("_id" => $data["_id"]) , 
							array('$set' => array("target.type" => $parentType),
								'$unset' => array("target.objectType"=>""))			
						);
					} else{
						PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
					}
			  }
			  else if($data["target"]["type"]==Person::COLLECTION){
			  	$target = Person::getById($data["target"]["id"]);
			  	if (empty($target)){
				  	print_r($data);
			  		PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
			  	}
			  }
			  else if($data["target"]["type"]==Event::COLLECTION){
			  	$target = Event::getById($data["target"]["id"]);
			  	if (empty($target)){
				  	print_r($data);
			  		PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
			  	}
			  }
			  else if($data["target"]["type"]==Organization::COLLECTION){
			  	$target = Organization::getById($data["target"]["id"]);
			  	if (empty($target)){
				  	print_r($data);
			  		PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
			  	}

			  }
			  else if($data["target"]["type"]==Project::COLLECTION){
			  	$target = Project::getById($data["target"]["id"]);
			  	if (empty($target)){
			  		print_r($data);
			  		PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
			  	}
			  }	  
			}
		  	else {
			  	print_r($data);
			  	PHDB::update(News::COLLECTION,
							array("_id" => $data["_id"]) , 
							array('$set' => array("target.type" => Person::COLLECTION,
											"target.id" => $data["author"])
								)
				);
		  	}
		}
	}
// Cinquième refactor à faire sur communecter.org qui permet de netoyer les news type activityStream dont l'object n'existe pas
	public function actionWashingNewsObjectNotExist(){
  		$news=PHDB::find(News::COLLECTION);
  		$i=0;
  		$nbNews=count($news);
		echo "Nombre de documents appelés : ".$nbNews;
  		foreach($news as $key => $data){
	  		if($data["type"]=="activityStream"){
		  		if(@$data["object"]){
				  if($data["object"]["objectType"]==Event::COLLECTION){
				  	$target = Event::getById($data["target"]["id"]);
				  	if (empty($target)){
					  	print_r($data);
					  	$i++;
				  		//PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
				  	}
				  }
				  else if($data["object"]["objectType"]==Organization::COLLECTION){
				  	$target = Organization::getById($data["target"]["id"]);
				  	if (empty($target)){
					  	print_r($data);
					  						  	$i++;
				  		//PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
				  	}
	
				  }
				  else if($data["object"]["objectType"]==Project::COLLECTION){
				  	$target = Project::getById($data["target"]["id"]);
				  	if (empty($target)){
				  		print_r($data);
				  							  	$i++;
				  		//PHDB::remove(News::COLLECTION, array("_id"=>new MongoId($key))); 
				  	}
				  }	  
				 }
		  	}
		}
		echo "Nombre de news sans object traitées : ".$i." news";
	}
	public function actionNewsPixels(){
		$news=PHDB::find(News::COLLECTION);
  		$i=0;
  		$nbNews=count($news);
		echo "Nombre de documents appelés : ".$nbNews;
		foreach($news as $key => $data){
			if($data["type"]=="pixels"){
				PHDB::update(News::COLLECTION,
					array("_id" => $data["_id"]) , 
					array('$set' => array("target.type" => "pixels","target.id"=>"", "type" => "news"),'$unset' => array("id"=>""))			
				);
				$i++;
			}
		}
		echo "Nombre de news pixels traitées : ".$i." news";
	}
	// VoteDown
  	public function actionRefactorModerateVoteDown(){
	  	echo "actionRefactorModerateVoteDown => ";
		$news=PHDB::find(News::COLLECTION, array('voteDown' => array('$exists' => 1),'refactorAction' => array('$exists' => 0)));
		$i=0;
		echo count($news)." News en base avec voteDown<br/>";
		foreach($news as $key => $data){
			$map = array();
			foreach ($data['voteDown'] as $j => $reason) {
				if(!is_array($reason))$map['voteDown.'.$reason] = array('date' => new MongoDate(time())); 
			}
			if(count($map)){
				$res = PHDB::update('news', array('_id' => $data['_id']), array('$set' => array('refactorNews' => new MongoDate(time()))));

				$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('voteDown' => 1)));
				$res = PHDB::update('news', array('_id' => $data['_id']), array('$set' => $map, '$unset' => array('voteDownReason' => 1)));
				$i++;
			}
			elseif(isset($news['voteDownReason'])){
				$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('voteDownReason' => 1)));
				$i++;
			}
		}

		echo "nombre de news modifié => ".$i;
	}

	// VoteUp
  	public function actionRefactorModerateVoteUp(){
	  	echo "actionRefactorModerateVoteUp => ";
		$news=PHDB::find(News::COLLECTION, array('voteUp' => array('$exists' => 1),'refactorNews' => array('$exists' => 0)));
		$i=0;
		echo count($news)." News en base avec voteUp<br/>";
		foreach($news as $key => $data){
			$map = array();
			foreach ($data['voteUp'] as $j => $reason) {
				if(!is_array($reason))$map['voteUp.'.$reason] = array('date' => new MongoDate(time())); 
			}
			if(count($map)){
				$res = PHDB::update('news', array('_id' => $data['_id']), array('$set' => array('refactorNews' => new MongoDate(time()))));
				$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('voteUp' => 1)));
				$res = PHDB::update('news', array('_id' => $data['_id']), array('$set' => $map, '$unset' => array('voteUpReason' => 1)));
				$i++;
			}
			elseif(isset($news['voteUpReason'])){
				$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('voteUpReason' => 1)));
				$i++;
			}
		}

		echo "nombre de news modifié => ".$i;
  	}


	  // ReportAbuse
	public function actionRefactorModerateReportAbuse(){
	  	echo "actionRefactorModerateReportAbuse => ";  	
	  	$i = 0;
		$news=PHDB::find(News::COLLECTION, array('reportAbuseReason' => array('$exists' => 1)));
	  	foreach($news as $key => $data){
			$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('reportAbuseReason' => 1)));
			$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('reportAbuseCount' => 1)));
			$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('reportAbuse' => 1)));
			$i++;
		}

		echo count($news)." News en base avec reportAbuseReason<br/>";
	}






}

