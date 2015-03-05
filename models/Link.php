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
        
        //0. Check if the $memberOfId and the $memberId exists
        $memberOf = Link::checkIdAndType($memberOfId, $memberOfType);
		$member = Link::checkIdAndType($memberId, $memberType);

        //1. Check if the $userId can manage the $memberOf
        if (!Authorisation::isOrganizationAdmin($userId, $memberOfId)) {
        	throw new CommunecterException("You are not admin of the Organization : ".$memberOfId);
        }

        //2. Create the links
        PHDB::update( PHType::TYPE_ORGANIZATIONS, 
                   array("_id" => $memberOf["_id"]) , 
                   array('$set' => array( "links.members.".$memberId.".type" => $memberType) ));
 
        if ($memberType == Link::MEMBER_TYPE_ORGANIZATION) {
	        PHDB::update( PHType::TYPE_ORGANIZATIONS, 
	                   array("_id" => $member["_id"]) , 
	                   array('$set' => array( "links.memberOf.".$memberOfId.".type" => $memberOfType ) ));
	    } else if ($memberType == Link::MEMBER_TYPE_PERSON) {
      		PHDB::update( PHType::TYPE_CITOYEN, 
	                   array("_id" => $member["_id"]) , 
	                   array('$set' => array( "links.memberOf.".$memberOfId.".type" => $memberOfType ) ));
	    }

        //3. Send Notifications
	    //TODO - Send email to the member

        return Rest::json(array("result"=>true, "msg"=>"The member has been added with success", "memberOfid"=>$memberOfId, "memberid"=>$memberId));
    }

    private static function checkIdAndType($id, $type) {
		
		if ($type == Link::MEMBER_TYPE_ORGANIZATION) {
        	$res = Organization::getById($id); 
        } else if ($type == Link::MEMBER_TYPE_PERSON) {
        	$res = Person::getById($id);
        } else {
        	throw new CommunecterException("Can not manage this type of MemberOf : ".$type);
        }
        if (empty($res)) throw new CommunecterException("The actor (".$id." / ".$type.") is unknown");

        return $res;
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
        
        //0. Check if the $memberOfId and the $memberId exists
        $origin = Link::checkIdAndType($originId, $originType);
		$target = Link::checkIdAndType($targetId, $targetType);

        //2. Create the links
        if ($originType == Link::MEMBER_TYPE_ORGANIZATION) {
	        PHDB::update( PHType::TYPE_ORGANIZATIONS, 
	                   array("_id" => $origin["_id"]) , 
	                   array('$set' => array( "links.knows.".$targetId.".type" => $targetType ) ));
	    } else if ($originType == Link::MEMBER_TYPE_PERSON) {
      		PHDB::update( PHType::TYPE_CITOYEN, 
	                   array("_id" => $origin["_id"]) , 
	                   array('$set' => array( "links.memberOf.".$targetId.".type" => $targetType ) ));
	    }

        //3. Send Notifications
	    //TODO - Send email to the member

        return Rest::json(array("result"=>true, "msg"=>"The link knows has been added with success", "originId"=>$originId, "targetId"=>$targetId));
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