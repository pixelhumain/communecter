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
		$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);
	    
	    //Add the creator as the first member
	    $organization["membres"] = array(Yii::app()->session["userId"]);
	    PHDB::insert( PHType::TYPE_ORGANIZATIONS, $organization);
    
	    //add the association to the users association list
	    //TODO SBAR : Manage if the orgnization is already in the array memberOf
	    $where = array("_id" => new MongoId($userId));	
	    PHDB::update( PHType::TYPE_CITOYEN, $where, array('$push' => array("memberOf"=>$organization["_id"])));
             
	    //TODO ???? : add an admin notification
	    Notification::saveNotification(array("type"=>"Created",
	    						"user"=>$organization["_id"]));
	                  
	    return Rest::json(array("result"=>true, "msg"=>"Votre organisation est communectée.", "id"=>$organization["_id"]));
	}

	/**
	 * Save an organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */
	public static function update($organizationId, $organization, $userId) {
		
		//Manage tags : save any inexistant tag to DB 
		$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);
	    
	    //update the organization
	    PHDB::update( PHType::TYPE_ORGANIZATIONS,array("_id" => new MongoId($organizationId)), 
	                                          array('$set' => $organization));
    
	    //TODO ???? : add an admin notification
	    Notification::saveNotification(array("type"=>"Updated",
	    						"user"=>$organizationId));
	                  
	    return Rest::json(array("result"=>true, "msg"=>"Votre organisation a été mise à jour.", "id"=>$organizationId));
	}

}
?>