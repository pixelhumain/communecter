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
	  	return PHDB::findAndSort( self::COLLECTION,$params);
	}
	public static function getWhereSortLimit($params,$sort,$limit=1) {
	  	return PHDB::findAndSort( self::COLLECTION,$params,$sort,$limit);
	}
	

	public static function save($params)
	{
		//check a user is loggued 
	 	$user = Person::getById( Yii::app()->session["userId"] );
	 	//TODO : if type is Organization check the connected user isAdmin

	 	if(empty($user))
	 		throw new CommunecterException("You must be loggued in to add a news entry.");

	 	

	 	if( isset($_POST["name"]) && isset($_POST["text"]) )
	 	{
			$news = array("name" => $_POST["name"],
						  "text" => $_POST["text"],
						  "author" => Yii::app()->session["userId"],
						  "created"=>time());

			if(isset($_POST["tags"]))
				$news["tags"] = $_POST["tags"];
		 	if(isset($_POST["typeId"]))
				$news["id"] = $_POST["typeId"];
		 	if(isset($_POST["type"]))
		 	{
				$news["type"] = $_POST["type"];

				/*if( $_POST["type"] == Organization::COLLECTION && Authorisation::isOrganizationAdmin( Yii::app()->session["userId"], $_POST["typeId"]) )
	 				throw new CommunecterException("You must be admin of this organization to post.");*/
			}

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
		} else {
			return array("result"=>false, "msg"=>"Please Fill required Fields.");	
		}
	}
}
?>