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
  public function actionObjectObjectTypeNewsToObjectType(){
  	// Check in mongoDB
  	//// db.getCollection('news').find({"object.objectType": {'$exists':true}})
  	// Check number of news to formated
  	//// db.getCollection('news').find({"object.objectType": {'$exists':true}}).count()
  	$news=PHDB::find(News::COLLECTION,array("object.objectType"=>array('$exists'=>true)));
  	$nbNews=0;
  	foreach($news as $key => $data){
  		$newObject=array("id"=>$data["object"]["id"], "type"=> $data["object"]["objectType"]);
		PHDB::update(News::COLLECTION,
			array("_id" => $data["_id"]) , 
			array('$set' => array("object" => $newObject))
		);
  		$nbNews++;
  	}
  	echo "nombre de news traitées:".$nbNews." news";
  }
  public function actionUpOldNotifications(){
  	// Update notify.id 
  	$notifications=PHDB::find(ActivityStream::COLLECTION,array("notify.id"=>array('$exists'=>true)));
  	$nbNotifications=0;
  	//print_r($notifications);
  	foreach($notifications as $key => $data){
  		//print_r($data["notify"]["id"]);
  		$update=false;
  		$newArrayId=array();
  		foreach($data["notify"]["id"] as $val){
			if(gettype($val)=="string"){
				//echo($val);
  				$newArrayId[$val]=array("isUnseen"=>true,"isUnread"=>true);
  				$update=true;
  			}
  		}
  		if($update){
  			//print_r($newArrayId);
			PHDB::update(ActivityStream::COLLECTION,
				array("_id" => $data["_id"]) , 
				array('$set' => array("notify.id" => $newArrayId))
			);
			$nbNotifications++;
		}
  		
  	}
  	echo "nombre de notifs traitées:".$nbNotifications." notifs";
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
	public function actionBashRepareBulshit(){
	  $news=PHDB::find(News::COLLECTION);
	  $nbNews=count($news);
	  $i=0;
	  $newsWrong=0;
	  $nbNewsGood=0;
	  foreach($news as $key => $data){
		  	if($data["scope"]["type"]=="public"){
			  	if(!@$data["scope"]["cities"][0]){
				  	$newScopeArray=array("type"=>"public","cities"=>array());
				  	if($data["type"]=="activityStream"){
					  	$object=PHDB::findOne($data["object"]["objectType"],array("_id"=>new MongoId($data["object"]["id"])));
							$newScopeArray["cities"][0]["codeInsee"]=$object["address"]["codeInsee"];
							$newScopeArray["cities"][0]["postalCode"]=$object["address"]["postalCode"];
							$newScopeArray["cities"][0]["geo"]=$object["geo"];
							PHDB::update(News::COLLECTION,
										array("_id" => $data["_id"]) , 
										array('$set' => array("scope" => $newScopeArray)	
						));
						$newsWrong++;
				  	}
				  	/*else{
						if($data["target"]["type"]=="pixels"){
							$author=PHDB::findOne(Person::COLLECTION,array("_id"=>new MongoId($data["author"])));
							$newScopeArray["cities"][0]["codeInsee"]=$author["address"]["codeInsee"];
							$newScopeArray["cities"][0]["postalCode"]=$author["address"]["postalCode"];
							$newScopeArray["cities"][0]["geo"]=$author["geo"];
						}else {
							$target=PHDB::findOne($data["target"]["type"],array("_id"=>new MongoId($data["target"]["id"])));
							$newScopeArray["cities"][0]["codeInsee"]=$target["address"]["codeInsee"];
							$newScopeArray["cities"][0]["postalCode"]=$target["address"]["postalCode"];
							$newScopeArray["cities"][0]["geo"]=$target["geo"];
						}
						PHDB::update(News::COLLECTION,
										array("_id" => $data["_id"]) , 
										array('$set' => array("scope" => $newScopeArray)	
						));
					}*/

				}
				else{
					$nbNewsGood++;
				}
			}
		}
		echo "nombre total de news: ".$nbNews."news";
		echo "nombre de news mauvaise: ".$newsWrong."news";
		echo "nombre de news good: ".$nbNewsGood."news";
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
	  $nbCityNotFindName=0;
	  foreach($news as $key => $data){
		  if($data["scope"]["type"]=="public"){
			  if(@$data["scope"]["cities"]){
				  	$newScopeArray=array("type"=>"public","cities"=>array());
				  	if(@$data["scope"]["cities"][0] && gettype($data["scope"]["cities"][0])=="string"){

					  	  	echo "<br/>////////id News: ".$key. "/////////";				  	  						  	print_r($data["scope"]);
					  	foreach($data["scope"]["cities"] as $value){
						  	if(is_numeric($value)){
							  	echo "<br/>ici numérique:".$value;
							  	$city=PHDB::findOne(City::COLLECTION, array("insee" => $value));
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
							  	if($value=="LA RIVIERE"){
								  	$newScopeArray["cities"][0]["codeInsee"]="97414";
								  	$newScopeArray["cities"][0]["postalCode"]="97421";
								  	$newScopeArray["cities"][0]["geo"]=array('@type' => 'GeoCoordinates','latitude'=>'-21.25833300','longitude'=>'55.44166700');
								  	$nbCityName++;
							  	}
							  	else{
							  	$city = PHDB::findOne(City::COLLECTION, array("alternateName" =>$value));
							  		if(!empty($city)){
								  		$newScopeArray["cities"][0]["codeInsee"]=$city["insee"];
								  		$newScopeArray["cities"][0]["postalCode"]=$city["postalCodes"][0]["postalCode"];
								  		$newScopeArray["cities"][0]["geo"]=$city["geo"];
							  		$nbCityName++;
							  		}else{
							  			echo "ici";
							  			$newScopeArray["cities"][0]="wrong";
							  			$nbCityNotFindName++;	
							  		}
							  	}
						  	}
						  	echo "<br/>===>News array scope: ///<br/>";
							print_r($newScopeArray);
						  	echo "<br/>";
					  	}
					  	PHDB::update(News::COLLECTION,
							array("_id" => $data["_id"]) , 
							array('$set' => array("scope" => $newScopeArray)			
						));
						$i++;
				  	} else {
					  	if (!@$data["scope"]["cities"][0])
						{
						 	echo "<br/>/////////////////// PAS DE 00000 ////////////////////<br/>";
						 	$insee=false;
						 	foreach($data["scope"]["cities"] as $value){
							 	if(is_numeric($value)){
								 	$insee=$value;
							 	}	
						 	}
						 	if($insee){
						 		echo "<br/>ici numérique:".$value;
								  	$city=PHDB::findOne(City::COLLECTION, array("insee" => $value));
								  	$newScopeArray["cities"][0]["codeInsee"]=$value;
								  	$newScopeArray["cities"][0]["postalCode"]=$city["postalCodes"][0]["postalCode"];
								  	if(@$data["geo"]){
									  	$newScopeArray["cities"][0]["geo"]=$data["geo"];
								  	}else{
									  	$newScopeArray["cities"][0]["geo"]=$city["geo"];
								  	}
								  	$nbCityCodeInsee++;
								  	$i++;
								print_r($newScopeArray);
								echo "<br/>";
								PHDB::update(News::COLLECTION,
									array("_id" => $data["_id"]) , 
									array('$set' => array("scope" => $newScopeArray)			
								));
						 	}
						}
						
				  	}
			  } 
			  else{
				  echo "<br/>////news to delete avec wrong scope/////<br/>";
				  print_r($data["scope"]);
				  $nbtodelete++;
				  echo "<br/>";
				   PHDB::remove(News::COLLECTION, array("_id"=>$data["_id"]));
				   $i++;
			  }
		}
		}
		echo "nombre de news avec insee enregistré: ".$nbCityCodeInsee."news";
		echo "nombre de news avec name enregistré: ".$nbCityName."news";
		echo "nombre de news à supprimer: ".$nbtodelete."news";
		echo "nombre de news avec city non trouvé: ".$nbCityNotFindName."news";
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



	public function actionUpdateRegion(){

		$newsRegions = array(
						//array("new_code","new_name","former_code","former_name"),
						array("01","Guadeloupe","01","Guadeloupe"),
						array("02","Martinique","02","Martinique"),
						array("03","Guyane","03","Guyane"),
						array("04","La Réunion","04","La Réunion"),
						array("06","Mayotte","06","Mayotte"),
						array("11","Île-de-France","11","Île-de-France"),
						array("24","Centre-Val de Loire","24","Centre"),
						array("27","Bourgogne-Franche-Comté","26","Bourgogne"),
						array("27","Bourgogne-Franche-Comté","43","Franche-Comté"),
						array("28","Normandie","23","Haute-Normandie"),
						array("28","Normandie","25","Basse-Normandie"),
						array("32","Nord-Pas-de-Calais-Picardie","31","Nord-Pas-de-Calais"),
						array("32","Nord-Pas-de-Calais-Picardie","22","Picardie"),
						array("44","Alsace-Champagne-Ardenne-Lorraine","41","Lorraine"),
						array("44","Alsace-Champagne-Ardenne-Lorraine","42","Alsace"),
						array("44","Alsace-Champagne-Ardenne-Lorraine","21","Champagne-Ardenne"),
						array("52","Pays de la Loire","52","Pays de la Loire"),
						array("53","Bretagne","53","Bretagne"),
						array("75","Aquitaine-Limousin-Poitou-Charentes","72","Aquitaine"),
						array("75","Aquitaine-Limousin-Poitou-Charentes","54","Poitou-Charentes"),
						array("75","Aquitaine-Limousin-Poitou-Charentes","74","Limousin"),
						array("76","Languedoc-Roussillon-Midi-Pyrénées","73","Midi-Pyrénées"),
						array("76","Languedoc-Roussillon-Midi-Pyrénées","91","Languedoc-Roussillon"),
						array("84","Auvergne-Rhône-Alpes","82","Rhône-Alpes"),
						array("84","Auvergne-Rhône-Alpes","83","Auvergne"),
						array("93","Provence-Alpes-Côte d'Azur","93","Provence-Alpes-Côte d'Azur"),
						array("94","Corse","94","Corse")
					);

		foreach ($newsRegions as $key => $region){

			echo "News : (".$region[0].") ".$region[1]." ---- Ancien : (".$region[2].") ".$region[3]."</br>" ;

			$cities = PHDB::find(City::COLLECTION,array("region" => $region[2]));
			$res = array("result" => false , "msg" => "La région (".$region[0].") ".$region[1]." n'existe pas");
			
			if(!empty($cities)){

				/*$res = PHDB::updateWithOption( City::COLLECTION, 
									  	array("region"=> $region[2]),
				                        array('$set' => array(	"region" => $region[0],
				                        						"regionName" => $region[1])),
				                        array("multi"=> true)
				                    );*/
				foreach ($cities as $key => $city) {
					$res = PHDB::update( City::COLLECTION, 
									  	array("_id"=>new MongoId($key)),
				                        array('$set' => array(	"region" => $region[0],
				                        						"regionName" => $region[1]))
				                    );

				}
				
				var_dump($res);
				echo "</br></br></br>";

			}
			else
				echo "Result : ".$res["result"]." | ".$res["msg"]."</br></br></br>";

		}

	}

	public function actionUpdateUserName() {
		//add a suffle username for pending users event if they got one
		$pendingUsers = PHDB::find(Person::COLLECTION, array("pending" => true));
		$nbPendingUser = 0;
		foreach ($pendingUsers as $key => $person) {
			$res = PHDB::update( Person::COLLECTION, 
									  	array("_id"=>new MongoId($key)),
				                        array('$set' => array(	
				                        			"username" => substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 32)), 
				                        			'$addToSet' => array("modifiedByBatch" => array("updateUserName" => new MongoDate(time()))))

				                    );
			$nbPendingUser++;
		}
		echo "Number of pending user with username modified : ".$nbPendingUser;
	}



	public function actionUpdatePreferences() {
		$nbUser = 0;
		$preferencesUsers = array(
							"publicFields" => array(),
							"privateFields" => array("email", "streetAddress", "phone", "directory", "birthDate"),
							"isOpenData" => false );
		$users = PHDB::find(Person::COLLECTION, array());
		foreach ($users as $key => $person) {
			$person["modifiedByBatch"][] = array("updatePreferences" => new MongoDate(time()));
			$res = PHDB::update(Person::COLLECTION, 
										  	array("_id"=>new MongoId($key)),
					                        array('$set' => array(	"seePreferences" => true,
					                        						"preferences" => $preferencesUsers,
					                        						"modifiedByBatch" => $person["modifiedByBatch"])
					                        					)
					                    );

			if($res["ok"] == 1){
				$nbUser++;
			}else{
				echo "<br/> Error with user id : ".$key;
			}
		}

		echo "Number of user with preferences modified : ".$nbUser;
	}

	public function actionUpdateCitiesBelgique() {
		/*$cities = PHDB::find(City::COLLECTION, array("country" => "BEL"));

		foreach ($cities as $key => $city) {
			$res = PHDB::update( City::COLLECTION, 
					  	array("_id"=>new MongoId($key)),
                        array('$set' => array(	"country" => "BE",
												"insee" => substr($city["insee"], 0, 5)."*BE",
												"dep" => substr($city["dep"], 0, 2)."*BE",
												"region" => substr($city["region"], 0, 2)."*BE"))

                    );
		}*/

		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);

		foreach ($types as $keyType => $type) {
			$elts = PHDB::find($type, array("address.addressCountry" => "BEL"));

			foreach ($elts as $key => $elt) {
				if(!empty($elt["address"]["codeInsee"])){
					$newAddress = $elt["address"];
					$newAddress["addressCountry"] = "BE";
					$newAddress["codeInsee"] = substr($newAddress["codeInsee"], 0, 5)."*BE";

					$res = PHDB::update($type, 
						  	array("_id"=>new MongoId($key)),
	                        array('$set' => array(	"address" => $newAddress ))
	                    );
				}
				
			}
		}
		echo "good" ;
		
	}


	public function actionCheckNameBelgique(){
		$cities = PHDB::find(City::COLLECTION, array("country" => "BE"));
		$nbcities = 0 ;
		foreach ($cities as $key => $city) {
			$name = $city["name"];
			$find = false ;
			if(count($city["postalCodes"]) == 1){
				

				foreach ($city["postalCodes"] as $keyCP => $cp) {
					if(trim($cp["name"]) != trim($name)){
						$find =true;
						$cp["name"] = $name ;
						$postalCodes[$keyCP] =  $cp ;
					}


				}

				if($find == true){
					$nbcities ++ ;
					$res = PHDB::update( City::COLLECTION, 
					  	array("_id"=>new MongoId($key)),
                        array('$set' => array(	"postalCodes" => $postalCodes ))

                    );
				}
			}			
		}
		echo  "NB Cities : " .$nbcities."<br>" ;

	}


	public function actionAddGeoPosition(){
		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		foreach ($types as $keyType => $type) {

			$elements = PHDB::find($type, array("geoPosition" => array('$exists' => 0), "geo" => array('$exists' => 1)));
			foreach ($elements as $key => $elt) {
				if(!empty($elt["geo"])){
					if(!empty($elt["geo"]["longitude"]) && !empty($elt["geo"]["latitude"])){
						$geoPosition = array("type"=>"Point", 
										"coordinates" => array(floatval($elt["geo"]["longitude"]), floatval($elt["geo"]["latitude"])));
						$elt["modifiedByBatch"][] = array("addGeoPosition" => new MongoDate(time()));
						$res = PHDB::update( $type, 
						  	array("_id"=>new MongoId($key)),
	                        array('$set' => array(	"geoPosition" => $geoPosition,
	                        						"modifiedByBatch" => $elt["modifiedByBatch"])), 
	                        array('upsert' => true ));
	                    $nbelement ++ ;
					}else{
						echo  $type." id : " .$key." : pas de longitude ou de latitude<br>" ;
					}	
				}else{
					echo  $type." id : " .$key." : pas de geo <br>" ;
				}

			}

		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;

	}


	public function actionDeleteLinksHimSelf(){
		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		foreach ($types as $keyType => $type) {
			$elements = PHDB::find($type, array("links" => array('$exists' => 1)));
			foreach ($elements as $keyElt => $elt) {
				if(!empty($elt["links"])){
					$find = false;
					$newLinks = array();
					foreach(@$elt["links"] as $typeLinks => $links){
						if(array_key_exists ($keyElt , $links)){
							$find = true;
		                    unset($links[$keyElt]);
						}
						$newLinks[$typeLinks] = $links;
					}

					if($find == true){
						$nbelement ++ ;
						$elt["modifiedByBatch"][] = array("deleteLinksHimSelf" => new MongoDate(time()));
						$res = PHDB::update( $type, 
						  	array("_id"=>new MongoId($keyElt)),
	                        array('$set' => array(	"links" => $newLinks,
	                        						"modifiedByBatch" => $elt["modifiedByBatch"])));
						echo "Suppression du link pour le type : ".$type." et l'id ".$keyElt;
					}
				}
			}
		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}


	public function actionUpdateCitiesBelgiqueGeo() {
		ini_set('memory_limit', '-1');
		$cities = PHDB::find(City::COLLECTION, array("country" => "BE"));
		$nbelement= 0 ;
		foreach ($cities as $key => $city) {
			$find = false ;
			$newCPs = array();
			foreach ($city["postalCodes"] as $keyPC => $cp) {
				if(empty($cp["geo"])){
					$find = true ;
					$cp["geo"] = $city["geo"];
					$cp["geoPosition"] = $city["geoPosition"];
				}
				$newCPs[] = $cp;
			}
			if($find == true){
				$nbelement ++ ;
				$res = PHDB::update( City::COLLECTION, 
			  		array("_id"=>new MongoId($key)),
                	array('$set' => array("postalCodes" => $newCPs)));
			}
		}
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}


	public function actionDeleteLinksDeprecated(){
		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		foreach ($types as $keyType => $type) {
			$elements = PHDB::find($type, array("links" => array('$exists' => 1)));
			foreach (@$elements as $keyElt => $elt) {
				if(!empty($elt["links"])){
					$find = false;
					$newLinks = array();
					foreach(@$elt["links"] as $typeLinks => $links){

						foreach(@$links as $keyLink => $link){
							if(!empty($link["type"])){
								$eltL = PHDB::find($link["type"], array("_id"=>new MongoId($keyLink)));
								if(empty($eltL)){
									$find = true;
				                    unset($links[$keyLink]);
								}
								$newLinks[$typeLinks] = $links;
							}
						}
					}
					if($find == true){
						$nbelement ++ ;
						$elt["modifiedByBatch"][] = array("deleteLinksDeprecated" => new MongoDate(time()));
						$res = PHDB::update( $type, 
						  	array("_id"=>new MongoId($keyElt)),
	                        array('$set' => array(	"links" => $newLinks,
	                        						"modifiedByBatch" => $elt["modifiedByBatch"])));
						echo "Suppression de link  deprecated pour le type : ".$type." et l'id ".$keyElt."<br>" ;
					}
				}
			}
		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}
	public function actionRefactorChartProjectData(){
		$projects = PHDB::find(Project::COLLECTION, array("properties.chart" => array('$exists' => 1)));
		foreach($projects as $data){
			echo "////////// <br/>";
			echo (string)$data["_id"]."<br/>";
			$chart=array();
			$chart["open"]=array();
			foreach($data["properties"]["chart"] as $key => $value){
				$values=array("description"=>"", "value" => $value);
				$chart["open"][$key]=array();
				$chart["open"][$key]=$values;
				//echo $value."<br/>";
			}
			echo "NEW OBJECT<br/>";
			print_r($chart);
			PHDB::update(Project::COLLECTION,
				array("_id" => new MongoId((string)$data["_id"])),
				array('$set' => array("properties.chart"=> $chart))
			);

			echo "////////// <br/>";
		}
	}

	public function actionFixBugCoutryReunion(){
		$nbelement = 0 ;
		$elements = PHDB::find(Organization::COLLECTION, array("address.addressCountry" => "Réunion"));
		foreach (@$elements as $keyElt => $elt) {
			if(!empty($elt["address"]["postalCode"]) || !empty($elt["address"]["cp"])){
				$cpElt = (!empty($elt["address"]["postalCode"])?$elt["address"]["postalCode"]:$elt["address"]["cp"]);
				$where = array("postalCodes.postalCode" => $cpElt);
				$cities = PHDB::find("cities",$where);
				foreach (@$cities as $keyCity => $city) {
						$address = array(
					        "@type" => "PostalAddress",
					        "codeInsee" => $city["insee"],
					        "addressCountry" => $city["country"],
					        "postalCode" => $cpElt,
					        "streetAddress" => ((@$elt["address"]["streetAddress"])?trim(@$fieldValue["address"]["streetAddress"]):""),
					        "depName" => $city["depName"],
					        "regionName" => $city["regionName"],
					    	);

						$find = false;
				   		foreach ($city["postalCodes"] as $keyCp => $cp) {
				   			if($cp["postalCode"] == $cpElt){
				   				$address["addressLocality"] = $cp["name"];
				   				$geo = $cp["geo"];
				   				$geoPosition = $cp["geoPosition"];
				   				$find = true;
				   				break;
				   			}
				   		}

				   		if($find == false){
				   			$address["addressLocality"] = $city["alternateName"];
				   			$geo = $city["geo"];
				   			$geoPosition = $city["geoPosition"];
				   		}
					break;  	
				}
				
				$nbelement ++ ;
				$elt["modifiedByBatch"][] = array("fixBugCoutryReunion" => new MongoDate(time()));
				$res = PHDB::update( Organization::COLLECTION, 
				  	array("_id"=>new MongoId($keyElt)),
                    array('$set' => array(	"address" => $address,
                    						"geo" => $geo,
                    						"geoPosition" => $geoPosition,
                    						"modifiedByBatch" => $elt["modifiedByBatch"])));
				echo "Update orga : l'id ".$keyElt."<br>" ;
				
			}else{
				$nbelement ++ ;
				$elt["modifiedByBatch"][] = array("fixBugCoutryReunion" => new MongoDate(time()));
				$res = PHDB::update( Organization::COLLECTION, 
				  	array("_id"=>new MongoId($keyElt)),
                    array('$unset' => array("address" => ""),
                    		'$set' => array( "modifiedByBatch" => $elt["modifiedByBatch"])));
				echo "Update orga : l'id ".$keyElt."<br>" ;
			}
			
		
		}
				
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}


	public function actionRefactorSource(){
		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		foreach ($types as $keyType => $type) {
			$elements = PHDB::find($type, array("source" => array('$exists' => 1)));
			if(!empty($elements)){
				foreach (@$elements as $keyElt => $elt) {

					if(!empty($elt["source"])){
						$newsource = array();
						if(!empty($elt["source"]["key"]) && empty($elt["source"]["keys"])){
							$newsource["insertOrign"] = "import" ;
							$newsource["key"] = $elt["source"]["key"];
							$newsource["keys"][] = $elt["source"]["key"];

							if(!empty($elt["source"]["url"]))
								$newsource["url"] = $elt["source"]["url"];
							if(!empty($elt["source"]["id"])){
								if(!empty($elt["source"]["id"]['$numberLong']))

									$newsource["id"] = $elt["source"]["id"]['$numberLong'];

								else
									$newsource["id"] = $elt["source"]["id"];
							}
							if(!empty($elt["source"]["update"]))
								$newsource["update"] = $elt["source"]["update"];
							
							$nbelement ++ ;
							$elt["modifiedByBatch"][] = array("RefactorSource" => new MongoDate(time()));

							try {
								$res = PHDB::update( $type, 
							  		array("_id"=>new MongoId($keyElt)),
		                        	array('$set' => array(	"source" => $newsource,
		                        							"modifiedByBatch" => $elt["modifiedByBatch"])));
							} catch (MongoWriteConcernException $e) {
								echo("Erreur à la mise à jour de l'élément ".$type." avec l'id ".$keyElt);
								die();
							}
							echo "Elt mis a jour : ".$type." et l'id ".$keyElt."<br>" ;


						}
					}
				}
			}
		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}

	/**
	 * Refactor events with no timezone depending on country
	 * Must be launch only once !
	 */
	public function actionAddTZOnEventDates(){
		$nbelement = 0 ;
		$nbelementPassed = 0 ;
		$nbelementRE = 0 ;
		$nbelementBE = 0 ;
		$nbelementFR = 0 ;
		$nbelementNC = 0 ;
		$nbelementUnknown = 0 ;
		$nbelementDateString = 0 ;
		$timezoneArray = array("RE" => 4, "FR" => 1, "NC" => 11, "BE" => 1);

		$elements = PHDB::find(Event::COLLECTION, array());
		foreach (@$elements as $keyElt => $elt) {
			if (isset($elt["modifiedByBatch"])) {
				$alreadyUpdated = false;
				foreach ($elt["modifiedByBatch"] as $value) {
					if (isset($value["addTZOnEventDates"])) {
						$nbelementPassed++;
						$alreadyUpdated = true;
						break;
					}
				}
				if ($alreadyUpdated) continue;
			}
			if(empty($elt["address"]["addressCountry"]) || 
			   empty($timezoneArray[$elt["address"]["addressCountry"]])) {
				echo "Pas de country ou country inconnu pour l'événement : ".$keyElt."</br>";
				$nbelementUnknown++;
				continue;
			}
			$timezone = $timezoneArray[$elt["address"]["addressCountry"]];
			if (isset($elt["startDate"]) && isset($elt["endDate"]) && (gettype($elt["startDate"]) == "object" && gettype($elt["endDate"]) == "object")) {
				//Set TZ to UTC in order to be the same than Mongo
				$startDate = new DateTime(date(DateTime::ISO8601, $elt["startDate"]->sec));
				$startDate = $startDate->sub(new DateInterval("PT".$timezone."H"));
				$endDate = new DateTime(date(DateTime::ISO8601, $elt["endDate"]->sec));
				$endDate = $endDate->sub(new DateInterval("PT".$timezone."H"));
				//$startDate = $elt["startDate"]->toDateTime()->sub(new DateInterval("PT".$timezone."H"));
				//$endDate = $elt["endDate"]->toDateTime()->sub(new DateInterval("PT".$timezone."H"));
				${'nbelement'.$elt["address"]["addressCountry"]}++;
			//On en profite pour revoir les dates des événements qui sont en string ou sans date
			} else {
				$nbelementDateString++;
				$startDate = new DateTime();
				$startDate->sub(new DateInterval("P1D"));
				$endDate = new DateTime();
				$endDate->sub(new DateInterval("P2D"));
			}
			//update the event
			$elt["modifiedByBatch"][] = array("addTZOnEventDates" => new MongoDate(time()));
			PHDB::update( Event::COLLECTION, array("_id" => new MongoId($keyElt)), 
		                          array('$set' => array(
		                          		"startDate" => new MongoDate($startDate->getTimestamp()), 
		                          		"endDate" => new MongoDate($endDate->getTimestamp()),
		                        		"modifiedByBatch" => $elt["modifiedByBatch"])));
			$nbelement++;
		}
				
		echo  "Event Reunion mis à jours: " .$nbelementRE."<br>" ;
		echo  "Event France mis à jours: " .$nbelementFR."<br>" ;
		echo  "Event Belgique mis à jours: " .$nbelementBE."<br>" ;
		echo  "Event NC mis à jours: " .$nbelementNC."<br>" ;
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
		echo  "NB Element passé : " .$nbelementPassed."<br>" ;
		echo  "NB Element inconnu : " .$nbelementUnknown."<br>" ;
		echo  "NB Element date en string : " .$nbelementDateString."<br>" ;
	}


	/*public function actionNameHtmlSpecialCaractere(){
		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		foreach ($types as $keyType => $type) {
			$elements = PHDB::find($type, array("name" => array('$exists' => 1)));
			if(!empty($elements)){
				foreach (@$elements as $keyElt => $elt) {
					if(!empty($elt["name"])){
						$nbelement ++ ;
						$elt["modifiedByBatch"][] = array("NameHtmlSpecialCaractere" => new MongoDate(time()));
						try {
							$res = PHDB::update( $type, 
						  		array("_id"=>new MongoId($keyElt)),
	                        	array('$set' => array(	"name" => htmlspecialchars($elt["name"]),
	                        							"modifiedByBatch" => $elt["modifiedByBatch"])));
						} catch (MongoWriteConcernException $e) {
							echo("Erreur à la mise à jour de l'élément ".$type." avec l'id ".$keyElt);
							die();
						}
						echo "Elt mis a jour : ".$type." et l'id ".$keyElt."<br>" ;
					}
				}
			}
		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}*/


	public function actionNameHtmlSpecialCharsDecode(){
		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		foreach ($types as $keyType => $type) {
			$elements = PHDB::find($type, array("name" => array('$exists' => 1)));
			if(!empty($elements)){
				foreach (@$elements as $keyElt => $elt) {
					if(!empty($elt["name"])){
						$nbelement ++ ;
						$elt["modifiedByBatch"][] = array("NameHtmlSpecialCharsDecode" => new MongoDate(time()));
						try {
							$res = PHDB::update( $type, 
						  		array("_id"=>new MongoId($keyElt)),
	                        	array('$set' => array(	"name" => htmlspecialchars_decode($elt["name"]),
	                        							"modifiedByBatch" => $elt["modifiedByBatch"])));
						} catch (MongoWriteConcernException $e) {
							echo("Erreur à la mise à jour de l'élément ".$type." avec l'id ".$keyElt);
							die();
						}
						echo "Elt mis a jour : ".$type." et l'id ".$keyElt."<br>" ;
					}
				}
			}
		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}


	public function actionAddDepAndRegionAndCountryInAddress(){


		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		$arrayDep = array("address.depName" => array('$exists' => 0));
		$arrayRegion = array("address.regionName" => array('$exists' => 0));
		$arrayCountry = array("address.addressCountry" => array('$exists' => 0));
		$arrayStreet = array("address.streetAddress" => array('$exists' => 0));
		$where = array('$and' => array(
						array("address" => array('$exists' => 1)), 
						array('$or' => array($arrayDep, $arrayRegion, $arrayCountry, $arrayStreet))
					));
		
		foreach ($types as $keyType => $type) {
			
			$elements = PHDB::find($type, $where);
			
			if(!empty($elements)){
				foreach (@$elements as $keyElt => $elt) {
					if(!empty($elt["name"])){
						$nbelement ++ ;
						$elt["modifiedByBatch"][] = array("AddDepAndRegionAndCountryInAddress" => new MongoDate(time()));
						$address = $elt["address"];

						if (isset($address["codeInsee"])) {
							$depAndRegion = City::getDepAndRegionByInsee($address["codeInsee"]);

							$address["depName"] = (empty($depAndRegion["depName"]) ? "" : $depAndRegion["depName"]);
							$address["regionName"] = (empty($depAndRegion["regionName"]) ? "" : $depAndRegion["regionName"]);
							$address["addressCountry"] = (empty($depAndRegion["country"]) ? "" : $depAndRegion["country"]);
							$address["streetAddress"] = (empty($elt["address"]["streetAddress"]) ? "" : $elt["address"]["streetAddress"]);
							try {
								$res = PHDB::update( $type, 
							  		array("_id"=>new MongoId($keyElt)),
		                        	array('$set' => array(	"address" => $address,
		                        							"modifiedByBatch" => $elt["modifiedByBatch"])));
							} catch (MongoWriteConcernException $e) {
								echo("Erreur à la mise à jour de l'élément ".$type." avec l'id ".$keyElt);
								die();
							}
							echo "Elt mis a jour : ".$type." et l'id ".$keyElt."<br>" ;
						} else {
							echo "Pas de mise a jour : ".$type." et l'id ".$keyElt."<br>" ;
						}
					}
				}
			}
		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;

	}

	public function actionHtmlToMarkdown(){
		$html = "<h3> TEst </h3>
				<p>Welcome to the demo:</p>
				<ol>
				<li>Write Markdown text on the left</li>
				<li>Hit the <strong>Parse</strong> button or <code>⌘ + Enter</code></li>
				<li>See the result to on the right</li>
				</ol>" ;

		echo $html ;

		echo "<br/><br/><br/><br/>";

		
		

		try {
            //$mailError = new MailError($_POST);
            $converter = new Htmlconverter();
			$mark = $converter->convert($html);
        } catch (CTKException $e) {
            Rest::sendResponse(450, "Webhook : ".$e->getMessage());
            die;
        }
		echo $mark;
	}

	public function actionDescInHtml(){
		$types = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$nbelement = 0 ;
		foreach ($types as $keyType => $type) {
			$elements = PHDB::find($type, array("description" => array('$exists' => 1)));
			if(!empty($elements)){
				foreach (@$elements as $keyElt => $elt) {
					if(!empty($elt["name"])){
						$nbelement ++ ;
						$elt["modifiedByBatch"][] = array("DescInHtml" => new MongoDate(time()));
						try {
							$res = PHDB::update( $type, 
						  		array("_id"=>new MongoId($keyElt)),
	                        	array('$set' => array(	"descriptionHTML" => true,
	                        							"modifiedByBatch" => $elt["modifiedByBatch"])));
						} catch (MongoWriteConcernException $e) {
							echo("Erreur à la mise à jour de l'élément ".$type." avec l'id ".$keyElt);
							die();
						}
						echo "Elt mis a jour : ".$type." et l'id ".$keyElt."<br>" ;
					}
				}
			}
		}		
		echo  "NB Element mis à jours: " .$nbelement."<br>" ;
	}

}

