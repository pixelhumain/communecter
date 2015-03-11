<?php 
class Person {
	public $jsonLD= array();

	/**
	 * get a Person By Id
	 * @param type $id : is the mongoId of the person
	 * @return type
	 */
	public static function getById($id) {
	  	$person = PHDB::findOne( PHType::TYPE_CITOYEN ,array("_id"=>new MongoId($id)));
	  	
	  	if (empty($person)) {
            throw new CommunecterException("The person id ".$id." is unkown : contact your admin");
        }

	  	$person["publicURL"] = '/organization/public/id/'.$id;

	  	return $person;
	}

	public static function setNameByid($name, $id) {
		PHDB::update(PHType::TYPE_CITOYEN,
			array("_id" => new MongoId($id)),
            array('$set' => array("name"=> $name))
            );
	}

	public static function getOrganizationById($id){
		$person = PHDB::findOne(PHType::TYPE_CITOYEN, array( "_id" => new MongoId(Yii::app()->session["userId"]) ) );
	    //$person["tags"] = Tags::filterAndSaveNewTags($person["tags"]);
	    $organizations = array();
	    
	    //Load organizations
	    if (isset($person["links"]) && !empty($person["links"]["memberOf"])) 
	    {
	      foreach ($person["links"]["memberOf"] as $id => $e) 
	      {
	        $organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS, array( "_id" => new MongoId($id)));
	        if (!empty($organization)) {
	          array_push($organizations, $organization);
	        } else {
	         // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
	        }
	      }
	    }
	    return $organizations;
	}
	/**
	 * get memberOf a Person By a person Id
	 * @param type $id : is the mongoId (String) of the person
	 * @return person document as in db
	 */
	public static function getPersonMemberOfByPersonId($id) {
	  	$res = array();
	  	$person = Person::getById($id);
	  	
	  	if (empty($person)) {
            throw new CommunecterException("The person id is unkown : contact your admin");
        }
	  	if (isset($person) && isset($person["links"]) && isset($person["links"]["memberOf"])) {
	  		$res = $person["links"]["memberOf"];
	  	}

	  	return $res;
	}

	/**
	 * Happens when a Person is invited or linked as a member and doesn't exist in the system
	 * It is created in a temporary state
	 * This creates and invites the email to fill extra information 
	 * into the Person profile 
	 * @param type $param 
	 * @return type
	 */
	public static function createAndInvite($param) {
	  	PHDB::insert( PHType::TYPE_CITOYEN , $param );

        //TODO TIB : mail Notification 
        //for the organisation owner to subscribe to the network 
        //and complete the Organisation Profile
	}

	/**
	 * Get a person from an id and return filter data in order to return only public data
	 * @param type $id 
	 * @return person
	 */
	public static function getPublicData($id) {
		//Public datas 
		$publicData = array (
			"imagePath",
			"name",
			"city",
			"socialAccounts",
			"positions",
			"url",
			"coi"
		);
		/*Photo de profil
		Centre d’intérêts
		Projets publics auxquels participe l’utilisateur
		Actualité publique
		Agenda public
		Réseau (cartographie)*/

		//TODO SBAR = filter data to retrieve only publi data	
		$person = Person::getById($id);
		if (empty($person)) {
			throw new CommunecterException("The person id is unknown ! Check your URL");
		}

		return $person;
	}
}
?>