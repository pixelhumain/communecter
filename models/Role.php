<?php 
class Role {


	/**
	 * Update the roles' list of an organization
	 * @param $roleTab is an array with all the roles
	 * @param type $organisationId : is the mongoId of the organisation
	 */
	public static function setRoles($roleTab, $itemId, $itemType){
		PHDB::update( $itemType,
						array("_id" => new MongoId($itemId)), 
                        array('$set' => array( 'roles' => $roleTab))
                    );
	}
}
?>