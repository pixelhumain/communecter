<?php 
class Job {

	const COLLECTION = "jobPosting";

	/**
	 * get a job By Id
	 * @param type $id : String as a mongoId of the job offer
	 * @return json format of a job
	 */
	public static function getById($id) {
	  	$job = PHDB::findOne( Job::COLLECTION,array("_id"=>new MongoId($id)));
	  	
	  	//get the details of the hiring organization
	  	if (!empty($job["hiringOrganization"])) {
			$organization = Organization::getById($job["hiringOrganization"]);
			$job["hiringOrganization"] = $organization;
		}

	  	return $job;
	}

	
	public static function insertJob($job) {  
		foreach ($job as $jobFieldName => $jobFieldValue) {
			if (! Job::checkFieldBeforeUpdate($jobFieldName, $jobFieldValue)) {
				throw new CommunecterException("Can not insert the job : unknown field ".$jobFieldName);
			}
		}
		//Manage tags : save any inexistant tag to DB 
		if (isset($job["tags"]))
			$job["tags"] = Tags::filterAndSaveNewTags($job["tags"]);

		//Insert the job
		$result = PHDB::updateWithOptions( Job::COLLECTION, array("_id" => new MongoId()), 
                          array('$set' => $job), array("upsert" => true));
		var_dump($result);
	    if (isset($result["upserted"])) {
	    	$newJobId = (String) $result["upserted"];
	    	$job = Job::getById($newJobId);
	    } else {
	    	throw new CommunecterException("Problem inserting the new job offer");
	    }
	                  
	    return array("result"=>true, "msg"=>"Votre Offre d'emploi a été ajoutée avec succès.", "id"=>$newJobId, "job"=>$job);
	}

	public static function updateJob($jobId, $job, $userId) {  
		
		if (! Authorisation::isJobAdmin($jobId, $userId)) {
			throw new CommunecterException("Can not update the job : you are not authorized to update that job offer !");	
		}

		foreach ($job as $jobFieldName => $jobFieldValue) {
			if (! Job::checkFieldBeforeUpdate($jobFieldName, $jobFieldValue)) {
				throw new CommunecterException("Can not insert the job : unknown field ".$jobFieldName);
			}
			//address
			if ($jobFieldName == "jobLocation.address") {
				if(!empty($jobFieldValue["postalCode"]) && !empty($jobFieldValue["codeInsee"])) {
					$insee = $jobFieldValue["codeInsee"];
					$address = SIG::getAdressSchemaLikeByCodeInsee($insee);
					$job["jobLocation"] = array("address" => $address);
				} else {
					throw new CTKException("Error updating the Organization : address is not well formated !");			
				}
				unset($job[$jobFieldName]);
			} else {
				$job[$jobFieldName] = $jobFieldValue;
			}
		}

		//Manage tags : save any inexistant tag to DB 
		if (isset($job["tags"]))
			$job["tags"] = Tags::filterAndSaveNewTags($job["tags"]);
		
		//update the job
		PHDB::update( Job::COLLECTION, array("_id" => new MongoId($jobId)), 
		                          array('$set' => $job));
	                  
	    return array("result"=>true, "msg"=>"Votre Offre d'emploi a été modifiée avec succès.", "id"=>$jobId);
	}

	/**
	 * Remove a job with his jobId
	 * @param String $jobId 
	 * @param String $userId 
	 * @return array of the result (result => bool, msg => String)
	 */
	public static function removeJob($jobId, $userId) {  

		if (! Authorisation::isJobAdmin($jobId, $userId)) {
			throw new CommunecterException("Can not remove the job : you are not authorized to update that job offer !");	
		}
		
		//update the job
		PHDB::remove(Job::COLLECTION, array("_id" => new MongoId($jobId)));
	                  
	    return array("result"=>true, "msg"=>"Votre Offre d'emploi a été supprimé avec succès.");
	}


	public static function updateJobField($jobId, $jobFieldName, $jobFieldValue, $userId) {  
		
		$job = array($jobFieldName => $jobFieldValue);
		$res = Job::updateJob($jobId, $job, $userId);
		/*if (! Job::checkFieldBeforeUpdate($jobFieldName, $jobFieldValue)) {
			throw new CommunecterException("Can not update the job : unknown field ".$jobFieldName);
		}

		if (! Authorisation::isJobAdmin($jobId, $userId)) {
			throw new CommunecterException("Can not update the job : you are not authorized to update that job offer !");	
		}

		//Specific case : tags
		if ($jobFieldName == "tags") {
			$jobFieldValue = Tags::filterAndSaveNewTags($jobFieldValue);
		}

		$job = array($jobFieldName => $jobFieldValue);
		
		//update the job
		PHDB::update( Job::COLLECTION, array("_id" => new MongoId($jobId)), 
		                          array('$set' => $job));
	                  
	    */
		return $res;
	}

	private static function checkFieldBeforeUpdate($jobFieldName, $jobFieldValue) {
		$res = false;
		$listFieldName = array(
		    "baseSalary",
		    "benefits",
		    "datePosted",
		    "description",
		    "educationRequirements",
		    "employmentType",
		    "experienceRequirements",
		    "incentives",
		    "industry",
		    "jobLocation.description",
		    "jobLocation.address",
		    "occupationalCategory",
		    "qualifications",
		    "responsibilities",
		    "salaryCurrency",
		    "skills",
		    "specialCommitments",
		    "title",
		    "workHours",
		    "hiringOrganization",
		    "startDate", 
		    "tags"
		);

		$res = in_array($jobFieldName, $listFieldName);
		
		//check for a composing fieldName
		//TODO SBAR - The choise could be to send json Data

		return $res;
	}

	public static function getJobsList($organizationId = null) {
		$res = array();
		//List all job offers or filter by organizationId
		if ($organizationId != null) {
			$where = array("hiringOrganization" => $organizationId);
		} else {
			$where = array();
		}
		$jobList = PHDB::findAndSort( Job::COLLECTION, $where, array("datePosted" => -1));

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