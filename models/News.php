<?php 
class News {

	const COLLECTION = "news";
	/**
	 * get an project By Id
	 * @param type $id : is the mongoId of the project
	 * @return type
	 */
	public static function getById($id) {
	  	return PHDB::findOne( self::COLLECTION,array("_id"=>new MongoId($id)));
	}

	public static function getWhere($params) {
	  	return PHDB::find( self::COLLECTION,$params);
	}

	public static function save($params){
		//$id = Yii::app()->session["userId"];
		$news = array("name" => $_POST["name"],
					  "text" => $_POST["text"],
					  "author" => Yii::app()->session["userId"],
					  "created"=>time());

		if(isset($_POST["tags"]))
			$news["tags"] = $_POST["tags"];
	 	//Rest::json( array("msg" => "every thing all right" ) );
		//Rest::json( $news );
		//Yii::app()->end();
		
		//recupere les donnes de l'utilisateur
		$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$user = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 	$user = $user[Yii::app()->session["userId"]];
	 	if( isset($_POST["scope"]))
	 	{
			foreach($_POST["scope"] as $scope)
			{
				
				//dans le cas d'un groupe
				//ajoute un à un chaque membre du groupe demandé (=> contact)
				if($scope->scopeType == "groupe"){				 
		 			//pour chacun de ses groupes de contact
	    			foreach($user["knows"] as $groupe){
	    				//pour chaque membre du groupe demandé
	    				if($groupe["name"] == $scope->id)
	    				foreach($groupe["members"] as $contact){
	    					//recupere les donnes du contact
							$where = array(	'_id'  => $contact );
		 					$allContact = PHDB::find(PHType::TYPE_CITOYEN, $where);
		 					$allContact = $allContact[$contact->__toString()];
		 					//ajoute un scope de type "contact" dans la news
							$news["scope"][] = array("scopeType" => "contact",
						  						 	"at" => "@".$allContact["name"],
						  						 	"id" => $contact);
						}	
					}
				}
				//cas de tous les contact
				else if($scope->id == "all_contact" && $scope->scopeType == "contact"){
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
						  						 	"id" => $contact);
							
						}
						
					}	
				}
				//cas de toutes les organisations
				else if($scope->id == "all_organisation" && $scope->scopeType == "organisation"){
					//pour chacun de ses organisations
	    			foreach($user["memberOf"] as $organization){
	    					//recupere les donnes de l'organisation
							$where = array(	'_id'  => $organization );
		 					$allOrga = PHDB::find("organizations", $where);
		 					$allOrga = $allOrga[$organization->__toString()];
		 					//ajoute un scope de type "organisation" dans la news
							$news["scope"][] = array("scopeType" => $scope->scopeType,
						  						 	"at" => "@".$allOrga["name"],
						  						 	"id" => $organization);
						}	
				}
				//par défaut ajoute le scope telquel
				else{
					$news["scope"][] = $scope;
				}
			}
		}

	    PHDB::insert(self::COLLECTION,$news);
	    //Link::connect($id, $type, $new["_id"], PHType::TYPE_PROJECTS, $id, "projects" );
	    return array("result"=>true, "msg"=>"Votre news est enregistré.", "id"=>$news["_id"],"object"=>$news);	
	}
}
?>