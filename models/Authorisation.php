<?php
class Authorisation {
	
    /**
     * Return true if the user is admin of at least an organization
     * @param type the id of the user
     * @return boolean true/false
     */
    public static function isUserOrganizationAdmin($userId) {
    	$res = false;

    	return $res;
    }

    /**
     * Return an array with the organization the user is admin of
     * @param type the id of the user
     * @return array of Organization (simple)
     */
    public static function listUserOrganizationAdmin($userId) {
    	$res = array();

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

        $result = array('' => , );
       
        return $result;
    } 
} 
?>