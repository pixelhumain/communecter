<?php
class Authorisation {
	
    /**
     * Return true if the user is admin of at least an organization 
     * @param type the id of the user
     * @return boolean true/false
     */
    public static function isUserOrganizationAdmin($userId) {
    	$res = false;
        
        //get the person links memberOf
        $personMemberOf = Person::getPersonMemberOfByPersonId($userId);

        foreach ($personMemberOf as $linkKey => $linkValue) {
            if (!empty($linkValue) && !empty($linkValue["isAdmin"])) {
                if ($linkValue["isAdmin"]) {
                    $res = true;
                    break;
                }
            }
        }

    	return $res;
    }

    /**
     * Return an array with the organizations the user is admin of
     * @param type the id of the user
     * @return array of Organization (organizationId => organizationValue)
     */
    public static function listUserOrganizationAdmin($userId) {
    	$res = array();
        
        //organization i'am admin 
        $where = array("links.members.".$userId.".isAdmin" => true);
        $res = PHDB::find(PHType::TYPE_ORGANIZATIONS, $where);

    	return $res;
    }

    /**
     * Return true if the user is admin of the organization or if it's a new organization
     * @param type the id of the user
     * @param type the id of the organization
     * @return array of Organization (simple)
     */
    public static function isOrganizationAdmin($userId, $organizationId) {
        $res = false;
        
        //Get the members of the organization : if there is no member then it's a new organization
        //We are in a creation process
        $organizationMembers = Organization::getMembersByOrganizationId($organizationId);
        if (count($organizationMembers) == 0) {
            $res = true;
        }
        //get the person links memberOf
        $personMemberOf = Person::getPersonMemberOfByPersonId($userId);

        if (isset($personMemberOf["$organizationId"])) {
            $link = $personMemberOf["$organizationId"];
            if (isset($link["isAdmin"]) && $link["isAdmin"]) {
                $res = true;
            }
        }
        
        return $res;
    }


 	/**
 	 * Description
 	 * @param type $userId 
 	 * @return type
 	 */
    public static function getAuthorisation($userId) {
        
        //TODO : think about how to manage authentification
        //Authentification => Menu Access

        $result = array();
       
        return $result;
    }

    /**
     * Return true if the organization can modify his members datas
     * @param String $organizationId An id of an organization
     * @return boolean True if the organization can edit his members data. False, else.
     */
    public static function canEditMembersData($organizationId) {
        $res = false;
        $organization = Organization::getById($organizationId);
        if (isset($organization["canEditMember"]) && $organization["canEditMember"])
            $res = true;
        return $res;
    }

    /**
     * Return true if the user is Admin of the event
     * A user can be admin of an event if :
     * 1/ He is attendee + admin of the event
     * 2/ He is admin of an organization organizing an event
     * 3/ He is admin of an organization that can edit it members (canEditMembers flag) 
     *      and the organizations members is organizing the event
     * @param String $eventId The eventId to check if the userId is admin of
     * @param String $userId The userId to get the authorisation of
     * @return boolean True if the user isAdmin, False else
     */
    public static function isEventAdmin($eventId, $userId) {
        $listEvent = Authorisation::listEventsIamAdminOf($userId);
        $res = array_key_exists($listEvent, $eventId);
        return $res;
    }

    /**
     * List all the event the userId is adminOf
     * A user can be admin of an event if :
     * 1/ He is attendee + admin of the event
     * 2/ He is admin of an organization organizing an event
     * 3/ He is admin of an organization that can edit it members (canEditMembers flag) 
     *      and the organizations members is organizing the event
     * @param String $userId The userId to get the authorisation of
     * @return array List of EventId (String) the user is admin of
     */
    public static function listEventsIamAdminOf($userId) {
        $eventList = array();

        //event i'am admin 
        $where = array("links.attendees.".$userId.".isAdmin" => true);
        $eventList = PHDB::find(PHType::TYPE_EVENTS, $where);

        //events of organization i'am admin 
        $listOrganizationAdmin = Authorisation::listUserOrganizationAdmin($userId);
        foreach ($listOrganizationAdmin as $organizationId => $organization) {
            $eventOrganization = Organization::listEventsPublicAgenda($organizationId);
            foreach ($eventOrganization as $eventId => $eventValue) {
                $eventList[$eventId] = $eventValue;
            }
        }

        return $eventList;
    }

    /**
    * Get the authorization for edit an organization
    * An user can edit an organization if :
    * 1/ he is admin of this organization
    * 2/ he is admin of an organization that can edit this orgarnisation
    * @param String $userId The userId to get the authorisation of
    * @param String $organizationId organization to get authorisation of
    * @return a boolean True if the user can edit and false else
    */
    public static function canEditOrganisation($userId, $organizationId){
    	$res = false;
    	$organization = Organization::getById($organizationId);
		if(isset($organization["links"]["members"])){
    		foreach ($organization["links"]["members"] as $key => $value) {
    			if($key ==  Yii::app()->session["userId"]){
    				if(isset($value["isAdmin"]) && $value["isAdmin"]==true){
    					$res = true;
    				}
    			}
    		}
    	}
    	if(isset($organization["links"]["memberOf"])){
    		foreach ($organization["links"]["memberOf"] as $key => $value) {
    			$organizationParent = Organization::getById($key);
    			$canEdit = Authorisation::canEditMembersData($key);
    			if(isset($organizationParent["links"]["members"]) && $canEdit){
		    		foreach ($organizationParent["links"]["members"] as $key => $value) {
		    			if($key ==  Yii::app()->session["userId"]){
		    				if(isset($value["isAdmin"]) && $value["isAdmin"]==true){
		    					$res = true;
		    				}
		    			}
		    		}
		    	}
    		}
    	}
    	return $res;
    }

} 
?>