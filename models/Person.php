<?php 
class Person {
	public $jsonLD= array();

	/**
	 * get a Person By Id
	 * @param type $id : is the mongoId of the person
	 * @return type
	 */
	public static function getById($id) {
	  	return PHDB::findOne( PHType::TYPE_CITOYEN ,array("_id"=>new MongoId($id)));
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
}
?>