<?php 
class Job {

	/**
	 * get a job By Id
	 * @param type $id : String as a mongoId of the job offer
	 * @return json format of a job
	 */
	public static function getById($id) {
	  	$job = PHDB::findOne( PHType::TYPE_EVENTS,array("_id"=>new MongoId($id)));
	  	
	  	//get the details of the hiring organization
	  	if (!empty($job["hiringOrganization"])) {
			$organization = Organization::getById($job["hiringOrganization"]);
			$job["hiringOrganization"] = $organization;
		}

	  	return $job;
	}

	
	public static function insertJob($job) {  
		//Manage tags : save any inexistant tag to DB 
		if (isset($job["tags"]))
			$job["tags"] = Tags::filterAndSaveNewTags($job["tags"]);

		//Insert the job
	    PHDB::insert( PHType::TYPE_JOBS, $job);
		
	    if (isset($job["_id"])) {
	    	$newJobId = (String) $job["_id"];
	    } else {
	    	throw new CommunecterException("Problem inserting the new job offer");
	    }
	                  
	    return array("result"=>true, "msg"=>"Votre Offre d'emploi a été ajoutée avec succès.", "id"=>$newJobId);
	}

	public static function updateJob($jobId, $job, $userId) {  
		
		//Manage tags : save any inexistant tag to DB 
		if (isset($job["tags"]))
			$job["tags"] = Tags::filterAndSaveNewTags($job["tags"]);

		//update the job
		PHDB::update( PHType::TYPE_JOBS,array("_id" => new MongoId($jobId)), 
		                          array('$set' => $job));
	                  
	    return array("result"=>true, "msg"=>"Votre Offre d'emploi a été modifiée avec succès.", "id"=>$newJobId);
	}

	public static function getJobsList($organizationId = null) {
		$res = array();
		//List all job offers or filter by organizationId
		if ($organizationId != null) {
			$where = array("hiringOrganization" => $organizationId);
		} else {
			$where = array();
		}

		$jobList = PHDB::findAndSort( PHType::TYPE_JOBS, $where, array("datePosted" => -1));

		//Get the organization hiring detail
		if ($jobList != null) {
			foreach ($jobList as $jobId => $job) {
				if (!empty($job["hiringOrganization"])) {
					$organization = Organization::getById($job["hiringOrganization"]);
					$job["hiringOrganization"] = $organization;
					array_push($res, $job);
				}
			}
		}

		return $res;
	}
}
?>