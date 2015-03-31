<?php 
class Organization {

	/**
	 * insert a new organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */
	public static function insert($organization, $userId) {
	    // Is There a association with the same name ?
	    $organizationSameName = PHDB::findOne( PHType::TYPE_ORGANIZATIONS,array( "name" => $_POST['organizationName']));      
	    if($organizationSameName) { 
	      return Rest::json(array("result"=>false, "msg"=>"Cette Organisation existe déjà.", "id"=>$organizationSameName["_id"]));
	    }

		//Manage tags : save any inexistant tag to DB 
		if (isset($organization["tags"]))
			$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);
		$organization["canEdit"] = array( Yii::app()->session['userId'] );
		//Insert the organization
	    PHDB::insert( PHType::TYPE_ORGANIZATIONS, $organization);
		
	    if (isset($organization["_id"])) {
	    	$newOrganizationId = (String) $organization["_id"];
	    } else {
	    	throw new CommunecterException("Problem inserting the new organization");
	    }
		
		//Add the creator as the first member
	    Link::connect($newOrganizationId, PHType::TYPE_ORGANIZATIONS, $userId, PHType::TYPE_CITOYEN, $userId,"members");
	    Link::connect($userId, PHType::TYPE_CITOYEN, $newOrganizationId, PHType::TYPE_ORGANIZATIONS, $userId,"memberOf");
             
	    //TODO ???? : add an admin notification
	    Notification::saveNotification(array("type"=>"Created",
	    						"user"=>$organization["_id"]));
	                  
	    return array("result"=>true, "msg"=>"Votre organisation est communectée.", "id"=>$organization["_id"]);
	}
	/**
	 * get an Organisation By Id
	 * @param type $id : is the mongoId of the organisation
	 * @return type
	 */
	public static function getById($id) {

	  	$organization = PHDB::findOne(PHType::TYPE_ORGANIZATIONS,array("_id"=>new MongoId($id)));
	  	
	  	if (empty($organization)) {
            //TODO Sylvain - Find a way to manage inconsistente data
            //throw new CommunecterException("The organization id ".$id." is unkown : contact your admin");
        } else {
			//add the public URL to the data structure
	  		$organization["publicURL"] = '/organization/public/id/'.$id;
        }

	  	return $organization;
	}

	/**
	 * get members an Organization By an organization Id
	 * @param type $id : is the mongoId (String) of the organization
	 * @return arrays of members (links.members)
	 */
	public static function getMembersByOrganizationId($id) {
	  	$res = array();
	  	$organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS ,array("_id"=>new MongoId($id)));
	  	
	  	if (empty($organization)) {
            throw new CommunecterException("The organization id is unkown : contact your admin");
        }
	  	if (isset($organization) && isset($organization["links"]) && isset($organization["links"]["members"])) {
	  		$res = $organization["links"]["members"];
	  	}

	  	return $res;
	}

	/*
	 * Save an organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */
	public static function update($organizationId, $organization, $userId) {
		
		if(self::userCanEdit($organizationId)){
			//Manage tags : save any inexistant tag to DB 
			if(isset($organization["tags"]))
				$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);
		    
		    //update the organization
		    PHDB::update( PHType::TYPE_ORGANIZATIONS,array("_id" => new MongoId($organizationId)), 
		                                          array('$set' => $organization));
	    
		    //TODO ???? : add an admin notification
		    Notification::saveNotification(array("type"=>"Updated",
		    						"user"=>$organizationId));
		                  
		    return Rest::json(array("result"=>true, "msg"=>"Votre organisation a été mise à jour.", "id"=>$organizationId));
		} else
			return Rest::json(array("result"=>false, "msg"=>"Unauthorized Access."));
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
	  	PHDB::insert( PHType::TYPE_ORGANIZATIONS , $param );

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

		//TODO SBAR = filter data to retrieve only publi data	
		$organization = Organization::getById($id);
		if (empty($organization)) {
			throw new CommunecterException("The organization id is unknown ! Check your URL");
		}

		return $organization;
	}
	/**
   *
   * @return [json Map] list
   */
	public static function userCanEdit($id,$parentOrganisationId=null)
	{
		$res = false;
		$organization = Organization::getById($id);
		if( isset($organization["canEdit"]) && in_array( Yii::app()->session['userId'], $organization["canEdit"]) )
			$res = true;
		elseif(isset($parentOrganisationId)){
			$parentOrganisation = Organization::getById($parentOrganisationId);
			if($parentOrganisation["canEditMembers"] && isset($parentOrganisation["canEdit"]) && in_array( Yii::app()->session['userId'], $parentOrganisation["canEdit"]) )
				$res = true;
		}
	    return $res;
	}
}
?>