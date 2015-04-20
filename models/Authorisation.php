<?php
class Authorisation {
	
    //**************************************************************
    // Organization Authorisation
    //**************************************************************

    /**
     * Return true if the user is admin of at least an organization 
     * @param String the id of the user
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
     * @param String the id of the user
     * @return array of Organization (organizationId => organizationValue)
     */
    public static function listUserOrganizationAdmin($userId) {
    	$res = array();
        
        //organization i'am admin 
        $where = array("links.members.".$userId.".isAdmin" => true);

        $organizations = PHDB::find(Organization::COLLECTION, $where);
        $res = $organizations;
        foreach ($organizations as $e) {
        	$res[(string)new MongoId($e['_id'])] = $e;
        	if(Authorisation::canEditMembersData(new MongoId($e['_id']))){
        		if(isset($e["links"]["members"])){
        			foreach ($e["links"]["members"] as $key => $value) {
        				if(isset($value["type"]) && $value["type"] == Organization::COLLECTION){
        					$subOrganization = Organization::getById($key);
        					$res[$key] = $subOrganization;
        				}
        			}
        		}
        	}
        }
    	return $res;
    }

    /**
     * Return true if the user is admin of the organization or if it's a new organization
     * @param String the id of the user
     * @param String the id of the organization
     * @return array of Organization (simple)
     */
    public static function isOrganizationAdmin($userId, $organizationId) {
        $res = false;
        
        //Get the members of the organization : if there is no member then it's a new organization
        //We are in a creation process
        $organizationMembers = Organization::getMembersByOrganizationId($organizationId);
        if (count($organizationMembers) == 0) {
            return true;
        } 

        $myOrganizations = Authorisation::listUserOrganizationAdmin($userId);
       	$res = array_key_exists((string)$organizationId, $myOrganizations);    
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

    //**************************************************************
    // Event Authorisation
    //**************************************************************

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
    	$res = false;
        $listEvent = Authorisation::listEventsIamAdminOf($userId);
        if(isset($listEvent[(string)$eventId])){
       		$res=true;
       	} 
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

    //**************************************************************
    // Job Authorisation
    //**************************************************************

    /**
     * Return true if the user is Admin of the job
     * A user can be admin of an job if :
     * 1/ He is admin of the organization posting the job offer
     * 3/ He is admin of an organization that can edit it members (canEditMembers flag) 
     *      and the organizations members is offering the job
     * @param String $jobId The jobId to check if the userId is admin of
     * @param String $userId The userId to get the authorisation of
     * @return boolean True if the user isAdmin, False else
     */
    public static function isJobAdmin($jobId, $userId) {
        $job = Job::getById($jobId);
        if (!empty($job["hiringOrganization"])) {
            $organizationId = (String) $job["hiringOrganization"]["_id"];
        } else {
            throw new CommunecterException("The job ". $jobId." is not well format : contact your admin.");
        }
        
        $res = Authorisation::isOrganizationAdmin($userId, $organizationId);

        return $res;
    }

    /**
    * Get the authorization for edit an event
    * An user can edit an event if :
    * 1/ he is admin of this event
    * 2/ he is admin of an organisation, which is the creator of an event
    * 3/ he is admin of an organisation witch can edit an organisation creator 
    * @param String $userId The userId to get the authorisation of
    * @param String $eventId event to get authorisation of
    * @return a boolean True if the user can edit and false else
    */
    public static function canEditEvent($userId, $eventId){
    	$res = false;
    	$event = EventId::getById($eventId);
    	if(!empty($event)){

    		// case 1

    		if(isset($event["links"]["attendees"])){
    			foreach ($event["links"]["attendees"] as $key => $value) {
    				if($key ==  $userId){
	    				if(isset($value["isAdmin"]) && $value["isAdmin"]==true){
	    					$res = true;
	    				}
	    			}
    			}
    		}

    		// case 2 and 3

    		if(isset($event["links"]["organizer"])){
    			foreach ($event["links"]["organizer"] as $key => $value) {
    				if( Authorisation::canEditOrganisation($userId, $key)){
    					$res = true;
    				}
    			}
    		}	
    	}
    	return $res;
    }

    /**
    * Get the authorization for edit an item
    * @param type is the type of item, (organization or event)
    * @param itemId id of the item we want to edits
    * @return a boolean
    */
    public static function canEditItem($userId, $type, $itemId){
    	$res=false;
    	if($type==PHType::TYPE_EVENTS){
    		$res = Authorisation::isEventAdmin($itemId, $userId);
    	}else if($type == Organization::COLLECTION){
    		$res = Authorisation::isOrganizationAdmin($userId, $itemId);
    	}

    	return $res;
    }


} 
?>