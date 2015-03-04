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
 	 * Description
 	 * @param type $userId 
 	 * @return type
 	 */
    public static function getAuthorisation($userId) {
        
        //TODO : think bout how to manage authentification
        //Authentification => Menu Access

        $result = array();
       
        return $result;
    } 
} 
?>