<?php
class Link {
	
	const MEMBER_TYPE_PERSON 			= "person";
	const MEMBER_TYPE_ORGANIZATION 		= "organization";
	
	/**
	 * Add a member to an organization
	 * Create a link between the 2 actors. The link will be typed members and memberOf
	 * The memberOf should be an organization
	 * The member can be an organization or a person
	 * 2 entry will be added :
	 * - $memberOf.links.members["$memberId"]
	 * - $member.links.memberOf["$memberOfId"]
	 * @param type $memberOfId The Id memberOf (organization) where a member will be linked. 
	 * @param type $memberOfType The Type (should be organization) memberOf where a member will be linked. 
	 * @param type $memberId The member Id to add. It will be the member added to the memberOf
	 * @param type $memberType MemberType to add : could be an organization or a person
	 * @param type $userId $userId The userId doing the action
	 * @return result as Json with the result of the operation
	 */
    public static function addMember($memberOfId, $memberOfType, $memberId, $memberType, $userId) {
        
        //0. Check if the $memberOf and the $member exists
        if ($memberOfType == MEMBER_TYPE_ORGANIZATION) {
        	$member = Organization::getById($memberOfId); 
        } else if ($memberOfType == MEMBER_TYPE_PERSON) {
        	$member = Person::getById($memberOfId);
        } else {
        	throw new CommunecterException("Can not manage this type of MemberOf : ".$memberOfType);
        }

        if ($memberType == MEMBER_TYPE_ORGANIZATION) {
        	$member = Organization::getById($memberOfId); 
        } else if ($memberOfType == MEMBER_TYPE_PERSON) {
        	$member = Person::getById($memberOfId);
        } else {
        	throw new CommunecterException("Can not manage this type of MemberOf : ".$memberOfType);
        }
        //1. Check if the $userId can manage the $memberOf
        //2. Create the links
        //3. Send Notifications

        $result = array();
       
        return $result;
    }

    /**
     * Connect 2 actors : organization or Person
	 * Create a link between the 2 actors. The link will be typed as knows
	 * 1 entry will be added :
	 * - $origin.links.knows["$target"]
     * @param type $originId The Id of actor who wants to create a link with the $target
     * @param type $originType The Type (Organization or Person) of actor who wants to create a link with the $target
     * @param type $targetId The actor that will be linked
     * @param type $targetType The Type (Organization or Person) that will be linked
     * @param type $userId The userId doing the action
     * @return result as Json with the result of the operation
     */
    public static function connect($originId, $originType, $targetId, $targetType, $userId) {
        
        $result = array();
       
        return $result;
    }

    /**
     * Check if two actors are connected with a links knows
     * @param type $originId The Id of actor to check the link with the $target
     * @param type $originType The Type (Organization or Person) of actor to check the link with the $target
     * @param type $targetId The actor to check that is linked
     * @param type $targetType The Type (Organization or Person) to check that is linked
     * @return boolean : true if the actors are connected, false else
     */
    public static function isConnected($originId, $originType, $targetId, $targetType) {

        $res = false;
        $targetLinksKnows = PHDB::findOne($originType, array("_id"=>new MongoId($originId)) , array("links"));
        //var_dump($targetLinksKnows);
        if( isset($targetLinksKnows["links"]) && 
            isset($targetLinksKnows["links"]["knows"]) && 
            isset($targetLinksKnows["links"]["knows"][$targetId]) && 
            isset( $targetLinksKnows["links"]["knows"][$targetId]["type"][$targetType] ) )
            $res = true;

        return $res;

    }

    /** 
	 * 1 invitor invite a guest. The guest is not yet in the application
	 * Create a link between the invitor and the guest with the status toBeValidated
	 * The guest will receive a mail inviting him to create a ph account
	 * 1 entry will be added :
	 * - $invitor.links.knows["$guest"] = "status = toBeValidated"
	 * One Person or Organization will be created with basic information
	 * @param type $invitorId The actor Id who invite a guest
	 * @param type $invitorType The type (organization or person) who invite the guest
	 * @param type $guestId The actor Id that will invited
	 * @param type $guestType The type (organization or person) that will invited
	 * @param type $userId The userId doing the action
	 * @return result as Json with the result of the operation
	 */
    public static function invite($invitorId, $invitorType, $guestId, $guestType, $userId) {
 
        $result = array();
       
        return $result;
    }
} 
?>