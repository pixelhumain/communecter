<?php
class Links {
	
	/** 
	 * Add a member to an organization
	 * Create a link between the 2 actors. The link will be typed members and memberOf
	 * The memberOf should be an organization
	 * The member can be an organization or a person
	 * 2 entry will be added :
	 * - $memberOf.link.members["$memberId"]
	 * - $member.link.memberOf["$memberOfId"]
	 * @param type $memberOf The memberOf (organization) where a member will be linked.
	 * @param type $member The member could be an organization or a person. It will be the member added to the memberOf
	 * @param type $userId The userId doing the action
	 * @return result as Json with the result of the operation
	 */
    public static function addMember($memberOf, $member, $userId) {
        
        //0. Check if the $memberOf and the $member exists
        //1. Check if the $userId can manage the $memberOf
        //2. Create the links
        //3. Send Notifications

        $result = array('' => , );
       
        return $result;
    }

    /** 
	 * Connect 2 actors : organization or Person
	 * Create a link between the 2 actors. The link will be typed as knows
	 * 1 entry will be added :
	 * - $origin.link.knows["$target"]
	 * The $target will receive a notification saying that the $origin is now linked with him
	 * @param type $origin The organization or Personn who wants to create a link with the $target
	 * @param type $target The organization or Person that will be linked
	 * @param type $userId The userId doing the action
	 * @return result as Json with the result of the operation
	 */
    public static function connect($origin, $target, $userId) {
        
        $result = array('' => , );
       
        return $result;
    }

    /** 
	 * 1 invitor invite a guest. The guest is not yet in the application
	 * Create a link between the invitor and the guest with the status toBeValidated
	 * The guest will receive a mail inviting him to create a ph account
	 * 1 entry will be added :
	 * - $invitor.link.knows["$guest"] = "status = toBeValidated"
	 * One Person or Organization will be created with basic information
	 * @param type $invitor The organization or Personn who invite a guest
	 * @param type $guest The organization or Person that will invited
	 * @param type $userId The userId doing the action
	 * @return result as Json with the result of the operation
	 */
    public static function invite($invitor, $guest, $userId) {
 
        $result = array('' => , );
       
        return $result;
    }
} 
?>