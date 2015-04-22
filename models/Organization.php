<?php 
class Organization {

	const COLLECTION = "organizations";
	
	/**
	 * insert a new organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */
	public static function insert($organization, $userId) {
	    
		Organization::checkOrganizationData($organization);
		
		//Manage tags : save any inexistant tag to DB 
		if (isset($organization["tags"]))
			$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);

		//Add the user creator of the organization in the system
		$organization["creator"] = $userId;

		//Insert the organization
	    PHDB::insert( Organization::COLLECTION, $organization);
		
	    if (isset($organization["_id"])) {
	    	$newOrganizationId = (String) $organization["_id"];
	    } else {
	    	throw new CommunecterException("Problem inserting the new organization");
	    }
		
		//Add the creator as the first member and admin of the organization
	    Link::addMember($newOrganizationId, Organization::COLLECTION, $userId, PHType::TYPE_CITOYEN, $userId, "true");

	    //TODO ???? : add an admin notification
	    Notification::saveNotification(array("type"=>"Created",
	    						"user"=>$organization["_id"]));
	                  
	    $newOrganization = Organization::getById($newOrganizationId);
	    return array("result"=>true, "msg"=>"Votre organisation est communectée.", 
	    	"id"=>$newOrganizationId, "newOrganization"=> $newOrganization);
	}

	/* TODO Ajouter la position geo sur l'orga */
	public static function addGeoPos($organization){
		/*rechercher position par cp dans collec Cities
		si on trouve
		on recopie geo dans geoPos et on créé geo aussi
		s */
	}
	
	/**
	 * Apply organization checks and business rules before inserting
	 * @param array $organization : array with the data of the person to check
	 * @return 
	 */
	public static function checkOrganizationData($organization) {
		// Is There a association with the same name ?
	    $organizationSameName = PHDB::findOne( Organization::COLLECTION,array( "name" => $_POST['organizationName']));      
	    if($organizationSameName) { 
	      throw new CommunecterException("An organization with the same name already exist in the plateform");
	    }
	}

	/**
	 * get an Organisation By Id
	 * @param type $id : is the mongoId of the organisation
	 * @return type
	 */
	public static function getById($id) {

	  	$organization = PHDB::findOne(Organization::COLLECTION,array("_id"=>new MongoId($id)));
	  	
	  	if (empty($organization)) {
            //TODO Sylvain - Find a way to manage inconsistent data
            //throw new CommunecterException("The organization id ".$id." is unkown : contact your admin");
        } else {
			//add the public URL to the data structure
	  		$organization["publicURL"] = '/organization/public/id/'.$id;
        }

	  	return $organization;
	}

	/**
	 * get members an Organization By an organization Id
	 * @param String $id : is the mongoId (String) of the organization
	 * @param String $type : can be use to filter the member by type (all (default), person, organization)
	 * @return arrays of members (links.members)
	 */
	public static function getMembersByOrganizationId($id, $type="all") {
	  	$res = array();
	  	$organization = Organization::getById($id);
	  	
	  	if (empty($organization)) {
            throw new CommunecterException("The organization id is unkown : contact your admin");
        }
	  	if (isset($organization) && isset($organization["links"]) && isset($organization["links"]["members"])) {
	  		$members = $organization["links"]["members"];
	  		//No filter needed
	  		if ($type == "all") {
	  			return $members;
	  		} else {
	  			foreach ($organization["links"]["members"] as $key => $member) {
		            if ($member['type'] == $type ) {
		                $res[$key] = $member;
		            }
	        	}
	  		}
	  	}
	  	return $res;
	}

	/*
	 * Save an organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */
	public static function update($organizationId, $organization, $userId) {
		
		//Check if user is authorized to update
		if (! Authorisation::isOrganizationAdmin($userId, $organizationId)) {
			return Rest::json(array("result"=>false, "msg"=>"Unauthorized Access."));
		}

		//Manage tags : save any inexistant tag to DB 
		if(isset($organization["tags"]))
			$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);
	    
	    //update the organization
	    PHDB::update( Organization::COLLECTION,array("_id" => new MongoId($organizationId)), 
	                                          array('$set' => $organization));
    
	    //TODO ???? : add an admin notification
	    Notification::saveNotification(array("type"=>"Updated",
	    						"user"=>$organizationId));
	                  
	    return Rest::json(array("result"=>true, "msg"=>"Votre organisation a été mise à jour.", "id"=>$organizationId));
		
	}
	
	/**
	 * Happens when an Organisation is invited or linked as a member and doesn't exist in the system
	 * It is created in a temporary state
	 * This creates and invites the email to fill extra information 
	 * into the Organisation profile 
	 * @param type $param 
	 * @return type
	 */
	public static function createAndInvite($param) {
	  	PHDB::insert( Organization::COLLECTION , $param );

        //TODO TIB : mail Notification 
        //for the organisation owner to subscribe to the network 
        //and complete the Organisation Profile
	}

	/**
	 * Get an organization from an id and return filter data in order to return only public data
	 * @param type $id 
	 * @return organization structure
	 */
	public static function getPublicData($id) {
		//Public datas 
		$publicData = array (
			"imagePath",
			"name",
			"city",
			"socialAccounts",
			"url",
			"coi"
		);
		/*Photo de profil
		Centre d’intérêts
		Projets publics auxquels participe l’utilisateur
		Actualité publique
		Agenda public
		Réseau (cartographie)*/

		//TODO SBAR = filter data to retrieve only public data	
		$organization = Organization::getById($id);
		if (empty($organization)) {
			throw new CommunecterException("The organization id is unknown ! Check your URL");
		}

		return $organization;
	}

	/**
	 * When an initation to join an organization network is sent :
	 * this method will :
	 * 1. Create a new person and organization.
	 * 2. Make the new person a member and admin of the organization
	 * 3. Join the network of the organization inviting
	 * @param type $person the minimal data to create a person
	 * @param type $organization the minimal data to create an organization
	 * @param type $parentOrganizationId the organization Id to join the network of
	 * @return newPersonId ans newOrganizationId
	 */
	public static function createPersonOrganizationAndAddMember($person, $organization, $parentOrganizationId) {
		
		//Check person datas 
		Person::checkPersonData($person, false);
		//Check organization datas 
		Organization::checkOrganizationData($organization);
		
		//Create a new person
		$newPerson = Person::insert($person);

		//Create a new organization
		$newOrganization = Organization::insert($organization, $newPerson["id"]);

		//Link the person as an admin
		Link::addMember($newOrganization["id"], Organization::COLLECTION, $newPerson["id"], PHType::TYPE_CITOYEN, $newPerson["id"], true);

		//Link the organization as a member of the invitor
		
		//TODO SBAR - On GRANDDIR case, the parent organization can manage (data, event, project...) their organization members. 
		//Should be a parameter of the application.
		$isParentOrganizationAdmin = true;
		
		Link::addMember($parentOrganizationId, Organization::COLLECTION, $newOrganization["id"], Organization::COLLECTION, 
						$newPerson["id"], $isParentOrganizationAdmin);
		
		return array("result"=>true, "msg"=>"The invitation process completed with success", "id"=>$newOrganization["id"]);;
	}


	/**
	 * List all the event of an organization and his members
	 * @param type $organisationId : is the mongoId of the organisation
	 * @return all the event link with the organization
	 */
	public static function listEventsPublicAgenda($organizationId){
		$events = array();
		$organization = Organization::getById($organizationId);
		$subOrganization = Organization::getMembersByOrganizationId($organizationId, Organization::COLLECTION);
		if(isset($organization["links"]["events"])){
			foreach ($organization["links"]["events"] as $keyEv => $valueEv) {
				 $event = Event::getPublicData($keyEv);
           		 $events[$keyEv] = $event;
			}
		}
		if(Authorisation::canEditMembersData($organizationId)){
			foreach ($subOrganization as $key => $value) {
				 $newOrganization = Organization::getById($key);
				 if(!empty($newOrganization)&& isset($newOrganization["links"]["events"])){
				 	foreach ($newOrganization["links"]["events"] as $keyEv => $valueEv) {
				 		$event = Event::getPublicData($keyEv);
           		 		$events[$keyEv] = $event;
				 	}
				 }	 
			}
		}
		return $events;
	}

	/**
	 * Update the roles' list of an organization
	 * @param $roleTab is an array with all the roles
	 * @param type $organisationId : is the mongoId of the organisation
	 */
	public static function setRoles($roleTab, $organizationId){
		PHDB::update( Organization::COLLECTION,
						array("_id" => new MongoId($organizationId)), 
                        array('$set' => array( 'roles' => $roleTab))
                    );
	}

	/**
	 * Find organizations based on criteria (field contains value)
	 * By default the criterias will be separated bay a "OR"
	 * @param array $criterias array (field=>value)
	 * @param String $sortOnField sort on this field name
	 * @param integer $nbResultMax number of results max to return
	 * @return array of Organizations
	 */
	public static function findOrganizationByCriterias($criterias, $sortOnField="", $nbResultMax = 10){
	  	//TODO SBAR - add the collection as a parameter and make the function work on everything
	  	//TODO SBAR - move it to PHDB ?

	  	$seprator = '$or';
	  	$query = array();

	  	//Add the criterias 
	  	foreach ($criterias as $field => $value) {
	  		$query[$field] = new MongoRegex("/".$value."/i");
	  	}

	  	if (count($criterias) > 1) {
	  		$where = array($seprator => array($query));
	  	} else {
	  		$where = $query;
	  	}

	  	$res = PHDB::findAndSort(Organization::COLLECTION, $where, array($sortOnField => 1), $nbResultMax);

	  	return $res;
	 }
}
?>