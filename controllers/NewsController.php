<?php
/**
 * NewsController.php
 *
 *
 * @author: Tristan Goguet
 * Date: 09/11/2014
 */
class NewsController extends CommunecterController {

    protected function beforeAction($action) {
		  return parent::beforeAction($action);
  	}

    public function actionFormCreateNews()  	{ $this->renderPartial("formCreateNews"); 		} 
  	
  	//envoie la liste des contacts de l'utilisateur connecté
  	//(stoké dans variable -dataContact- js)
  	public function actionInitDataContact(){
  		$json_res = array();
  		
  		$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$user = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	$me = $user[Yii::app()->session["userId"]];
	 	$res = "";
	 	
    	// foreach($user as $me)
    	if(isset($me["memberOf"])) {
    	  	$json_res["organizations"] = array();
	 		foreach($me["memberOf"] as $organization){
    	 		//récupère les data de l'organisation
    	 		$where = array(	'_id'  => $organization );
	 			$orga = PHDB::find("organizations", $where);
	 			
	 			foreach($orga as $ORGA){
    	 			$json_res["organizations"][] = $ORGA;
	 			}
    		}
    	
    	//si l'utilisateur n'a pas de champ "memberOf" => initialise le champ (pour les test)	
    	} else { $this->initMemberOf(); $res .= " - init MemberOf"; }
    	
    	if(isset($me["knows"])) {	
    		$json_res["knows"] = array();
	 		foreach($me["knows"] as $group){
	 		
	 			$members = array();
				foreach($group["members"] as $memberId){
	 		
	 				//récupère les data de chaque membre du groupe
					$where = array(	'_id'  => $memberId );
					$contact = PHDB::find(PHType::TYPE_CITOYEN, $where);
					
					foreach($contact as $c){
						if(isset($c["name"])) //{ Rest::json( "pas de name" ); Yii::app()->end(); }
						$members[] = array( "id" 	=> $c["_id"],
											"name" 	=> $c["name"]
										  );
						
					}
	 			}
	 			$json_res["knows"][] = array("type" => $group["type"],
	 							 			"name" => $group["name"],
	 							 			"members" => $members);
	 		}
    							 			
    	 	Rest::json( $json_res );
			Yii::app()->end();
			
        //si l'utilisateur n'a pas de champ "knows" => initialise le champ (pour les test)	
    	} else { $this->initKnows(); $res .= " - init Knows"; }
        
        
		Rest::json( $res );
		Yii::app()->end();
  	}
  	
	private function initMemberOf(){
  		
  		$org = PHDB::find("organizations");
  		if($org == null){ 
  			Yii::app()->mongodb->organizations->insert(array('name' => "Organisation n°1"));
  			Yii::app()->mongodb->organizations->insert(array('name' => "Organisation n°2"));
  			Yii::app()->mongodb->organizations->insert(array('name' => "Organisation n°3"));
  		}
  		
  		$members = array();
	 	
	 	//rajouter chaque user dans chaque groupe
	 	$organisations = iterator_to_array(Yii::app()->mongodb->selectCollection("organizations")->find()->limit(3));
	 	foreach($organisations as $orga){  $members[] = $orga["_id"]; }
	 	
	 	//$users = PHDB::find(PHType::TYPE_CITOYEN, $where).limit(5);
	 	$me = array( "memberOf" => $members );

	 	$where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
        Yii::app()->mongodb->citoyens->update($where, array('$set' => $me));
                
	 //	Rest::json( $me );
	//	Yii::app()->end();
  	}
	private function initKnows(){
	
		$famille = array(); $amis = array(); $all = array();
	 	
	 	//rajouter chaque user dans chaque groupe
	 	$users = iterator_to_array(Yii::app()->mongodb->selectCollection(PHType::TYPE_CITOYEN)->find()->skip(25)->limit(5));
	 	foreach($users as $user){  $famille[] = $user["_id"]; }
	 	$users = iterator_to_array(Yii::app()->mongodb->selectCollection(PHType::TYPE_CITOYEN)->find()->skip(30)->limit(5));
	 	foreach($users as $user){  $amis[] = $user["_id"];  }
	 	$users = iterator_to_array(Yii::app()->mongodb->selectCollection(PHType::TYPE_CITOYEN)->find()->skip(35)->limit(5));
	 	foreach($users as $user){  $all[] = $user["_id"];  }
	 	
	 	//$users = PHDB::find(PHType::TYPE_CITOYEN, $where).limit(5);
	 	$me = array("knows" => array(array("type" => "group", "name" => "*", "members" => $all),
	 								 array("type" => "group", "name" => "Famille", "members" => $famille),
	 								 array("type" => "group", "name" => "Amis", "members" => $amis)
	 								)
	 				);

	 	$where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
        Yii::app()->mongodb->citoyens->update($where, array('$set' => $me));
                
	 	//Rest::json( $me );
		//Yii::app()->end();
  	}

	public function actionSaveNews(){
		
		$json_news = json_decode($_POST["json"]);
		
		$news = array("name" => $json_news->name,
					  "text" => $json_news->text,
					  "genre" => $json_news->genre,
					  "about" => $json_news->about);
	
		//recupere les donnes de l'utilisateur
		$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$user = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 	$user = $user[Yii::app()->session["userId"]];
	 			
		foreach($json_news->scope as $scope){
			
			//dans le cas d'un groupe
			//ajoute un à un chaque membre du groupe demandé (=> contact)
			if($scope->scopeType == "groupe"){				 
	 			//pour chacun de ses groupes de contact
    			foreach($user["knows"] as $groupe){
    				//pour chaque membre du groupe demandé
    				if($groupe["name"] == $scope->refId)
    				foreach($groupe["members"] as $contact){
    					//recupere les donnes du contact
						$where = array(	'_id'  => $contact );
	 					$allContact = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 					$allContact = $allContact[$contact->__toString()];
	 					//ajoute un scope de type "contact" dans la news
						$news["scope"][] = array("scopeType" => "contact",
					  						 	"at" => "@".$allContact["name"],
					  						 	"refId" => $contact,
					  						 	"countrycodes" => $scope->countrycodes);
					}	
				}
			}
			//cas de tous les contact
			else if($scope->refId == "all_contact" && $scope->scopeType == "contact"){
				//pour chacun de ses groupes de contact
    			foreach($user["knows"] as $groupe){
    				//pour chaque membre d'un groupe
    				foreach($groupe["members"] as $contact){
    					//recupere les donnes du contact
						$where = array(	'_id'  => $contact );
	 					$allContact = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 					$allContact = $allContact[$contact->__toString()];
	 					//if(!isset($allContact["name"])) {Rest::json( "pas de name" ); Yii::app()->end(); }
	 					//ajoute un scope de type "contact" dans la news
						if(isset($allContact["name"]))
						$news["scope"][] = array("scopeType" => "contact",
					  						 	"at" => "@".$allContact["name"],
					  						 	"refId" => $contact,
					  						 	"countrycodes" => $scope->countrycodes);
						
					}
					
				}	
			}
			//cas de toutes les organisations
			else if($scope->refId == "all_organisation" && $scope->scopeType == "organisation"){
				//pour chacun de ses organisations
    			foreach($user["memberOf"] as $organization){
    					//recupere les donnes de l'organisation
						$where = array(	'_id'  => $organization );
	 					$allOrga = PHDB::find("organizations", $where);
	 					$allOrga = $allOrga[$organization->__toString()];
	 					//ajoute un scope de type "organisation" dans la news
						$news["scope"][] = array("scopeType" => $scope->scopeType,
					  						 	"at" => "@".$allOrga["name"],
					  						 	"refId" => $organization,
					  						 	"countrycodes" => $scope->countrycodes);
					}	
			}
			//par défaut ajoute le scope telquel
			else{
				$news["scope"][] = $scope;
			}
		}
		
						
		Yii::app()->mongodb->news->insert($news);
        
        //Rest::json( array("msg" => "every thing all right" ) );
		Rest::json( $news );
		Yii::app()->end();            
	}
	
	

  	/*
  	private function getGeoPositionByCp($cp){
  		$where = array(	'cp'  => $cp );
	 		$city = PHDB::find("cities", $where, array("geo" => true));	 		
	 		foreach($city as $myCity){
				return array("geo" => 
							array(	"longitude" => $myCity["geo"]["coordinates"][0], 
									"latitude" => $myCity["geo"]["coordinates"][1]
								 )
						);
			}
  	}
  	*/
	
}


