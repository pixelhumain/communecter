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
     * Return an array with the organization the user is admin of
     * @param type the id of the user
     * @return array of Organization (simple)
     */
    public static function listUserOrganizationAdmin($userId) {
    	$res = array();
        
        //get the person links memberOf
        $personMemberOf = Person::getPersonMemberOfByPersonId($userId);

        foreach ($personMemberOf as $linkKey => $linkValue) {
            if (!empty($linkValue) && !empty($linkValue["isAdmin"])) {
                if ($linkValue["isAdmin"]) {
                    array_push($res, array($linkKey => $linkValue));
                }
            }
        }
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
} 
?>