<?php
class Link {

    const person2person = "links.knows";
    const person2organization = "links.memberOf";
    const organization2person = "links.members";
    const person2events = "links.events";
    const person2projects = "links.projects";
	
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
	 * @return result array with the result of the operation
	 */
    public static function addMember($memberOfId, $memberOfType, $memberId, $memberType, $userId, $userAdmin = false) {
        
        //0. Check if the $memberOfId and the $memberId exists
        $memberOf = Link::checkIdAndType($memberOfId, $memberOfType);
		$member = Link::checkIdAndType($memberId, $memberType);

        //1. Check if the $userId can manage the $memberOf
        if (!Authorisation::isOrganizationAdmin($userId, $memberOfId)) {
        	throw new CommunecterException("You are not admin of the Organization : ".$memberOfId);
        }

        //2. Create the links
        PHDB::update( $memberOfType, 
                   array("_id" => $memberOf["_id"]) , 
                   array('$set' => array( "links.members.".$memberId.".type" => $memberType,
                                          "links.members.".$memberId.".isAdmin" => $userAdmin  )));
        
        PHDB::update( $memberType, 
                   array("_id" => $member["_id"]) , 
                   array('$set' => array( "links.memberOf.".$memberOfId.".type" => $memberOfType, 
                                          "links.memberOf.".$memberOfId.".isAdmin" => $userAdmin )));

        //3. Send Notifications
	    //TODO - Send email to the member

        return array("result"=>true, "msg"=>"The member has been added with success", "memberOfid"=>$memberOfId, "memberid"=>$memberId);
    }

    /**
     * Remove a member of an organization
     * Delete a link between the 2 actors.
     * The memberOf should be an organization
     * The member can be an organization or a person
     * 2 entry will be deleted :
     * - $memberOf.links.members["$memberId"]
     * - $member.links.memberOf["$memberOfId"]
     * @param type $memberOfId The Id memberOf (organization) where a member will be deleted. 
     * @param type $memberOfType The Type (should be organization) memberOf where a member will be deleted. 
     * @param type $memberId The member Id to remove. It will be the member removed from the memberOf
     * @param type $memberType MemberType to remove : could be an organization or a person
     * @param type $userId $userId The userId doing the action
     * @return result array with the result of the operation
     */
    public static function removeMember($memberOfId, $memberOfType, $memberId, $memberType, $userId) {
        
        //0. Check if the $memberOfId and the $memberId exists
        $memberOf = Link::checkIdAndType($memberOfId, $memberOfType);
        $member = Link::checkIdAndType($memberId, $memberType);

        //1.1 the $userId can manage the $memberOf (admin)
        // Or the user can remove himself from a member list of an organization
        if (!Authorisation::isOrganizationAdmin($userId, $memberOfId)) {
            if ($memberId != $userId) {
                throw new CommunecterException("You are not admin of the Organization : ".$memberOfId);
            }
        }

        //2. Remove the links
        PHDB::update( $memberOfType, 
                   array("_id" => $memberOf["_id"]) , 
                   array('$unset' => array( "links.members.".$memberId => "") ));
 
        PHDB::update( $memberType, 
                       array("_id" => $member["_id"]) , 
                       array('$unset' => array( "links.memberOf.".$memberOfId => "") ));

        //3. Send Notifications
        //TODO - Send email to the member

        return array("result"=>true, "msg"=>"The member has been added with success", "memberOfid"=>$memberOfId, "memberid"=>$memberId);
    }

    private static function checkIdAndType($id, $type) {
		
		if ($type == PHType::TYPE_ORGANIZATIONS) {
        	$res = Organization::getById($id); 
        } else if ($type == PHType::TYPE_CITOYEN) {
        	$res = Person::getById($id);
        } else if ($type== PHType::TYPE_EVENTS){
        	$res = Event:: getById($id);
        } else if ($type== PHType::TYPE_PROJECTS){
        	$res = Project:: getById($id);
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
     * @return result array with the result of the operation
     */
    public static function connect($originId, $originType, $targetId, $targetType, $userId, $connectType) {
        
        //0. Check if the $originId and the $targetId exists
        $origin = Link::checkIdAndType($originId, $originType);
		$target = Link::checkIdAndType($targetId, $targetType);

        //2. Create the links
        PHDB::update( $originType, 
                       array("_id" => $origin["_id"]) , 
                       array('$set' => array( "links.".$connectType.".".$targetId.".type" => $targetType
                       						  //,"links.".$connectType.".".$targetId.".tobeconfirmed" => true
                                              )));
        
        //3. Send Notifications
	    //TODO - Send email to the member

        return array("result"=>true, "msg"=>"The link knows has been added with success", "originId"=>$originId, "targetId"=>$targetId);
    }

    /**
     * Disconnect 2 actors : organization or Person
     * Delete a link knows between the 2 actors.
     * 1 entry will be deleted :
     * - $origin.links.knows["$target"]
     * @param type $originId The Id of actor where a link with the $target will be deleted
     * @param type $originType The Type (Organization or Person) of actor where a link with the $target will be deleted
     * @param type $targetId The actor that will be unlinked
     * @param type $targetType The Type (Organization or Person) that will be unlinked
     * @param type $userId The userId doing the action
     * @return result array with the result of the operation
     */
    public static function disconnect($originId, $originType, $targetId, $targetType, $userId, $connectType) {
        
        //0. Check if the $originId and the $targetId exists
        $origin = Link::checkIdAndType($originId, $originType);
        $target = Link::checkIdAndType($targetId, $targetType);

        //2. Create the links
        PHDB::update( $originType, 
                       array("_id" => $origin["_id"]) , 
                       array('$unset' => array("links.".$connectType.".".$targetId => "") ));

        //3. Send Notifications
        //TODO - Send email to the member

        return array("result"=>true, "msg"=>"The link knows has been removed with success", "originId"=>$originId, "targetId"=>$targetId);
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
        $where = array(
                    "_id"=>new MongoId($originId),
                    "links.knows.".$targetId =>  array('$exists' => 1));

        $originLinksKnows = PHDB::findOne($originType, $where);
        
        $res = isset($originLinksKnows);     

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
	 * @return result array with the result of the operation
	 */
    public static function invite($invitorId, $invitorType, $guestId, $guestType, $userId) {
 
        $result = array();
       
        return $result;
    }
} 
?>