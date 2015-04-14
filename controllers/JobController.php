<?php
/**
 * JobController.php
 *
 * Create, update and manage Jobs offers
 *
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 31/03/2015
 */
class JobController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}

	/**
	* Save a job
	* @return an array with result and message json encoded
	*/
	public function actionSave() {

		//insert a new job
		if (empty($_POST["pk"])) {
			foreach ($_POST as $fieldName => $fieldValue) {
				if ($fieldName == "postalCode") 
					$job["jobLocation.address.postalCode"] = $fieldValue;
				else if ($fieldName == "jobLoc") 
					$job["jobLocation.description"] = $fieldValue;
				else
					$job[$fieldName] = $fieldValue;
			}
			$res = Job::insertJob($job);
			if ($res["result"]) {
				return Rest::json(array("msg"=>"insertion ok ", "id"=>$res["id"], "job"=>$res["job"]));
			}
		//update an existing job
		} else {
			$jobId = $_POST["pk"];
			
			if (! empty($_POST["name"]) && ! empty($_POST["value"])) {
				$jobFieldName = $_POST["name"];
				$jobFieldValue = $_POST["value"];
			
				//specific case for tagsJob
				if ($jobFieldName == "tagsJob") $jobFieldName = "tags";

				Job::updateJobField($jobId, $jobFieldName, $jobFieldValue, Yii::app()->session["userId"] );
		  	} else {
				return Rest::json(array("result"=>false,"msg"=>"Uncorrect request"));  
		  	}	
		}
	  	
	  	return Rest::json(array("result"=>true, "msg"=>"Votre Offre d'emploi a été modifiée avec succès.", $jobFieldName=>$jobFieldValue));
	}

	/**
	 * Delete an entry from the job table using the id
	 */
  public function actionDelete($id) 
  {

  }

  public function actionList($organizationId = null){

	$jobList = Job::getJobsList($organizationId);
  
	$this->render("jobList", array("jobList" => $jobList));
  }

  public function actionPublic($id){
	//get The job Id
	if (empty($id)) {
	  throw new CommunecterException("The job posting id is mandatory to retrieve the job posting !");
	}

	if (empty($_POST["mode"])) {
		$mode = "view";
	} else {
		$mode = $_POST["mode"];
	}

	if ($mode == "insert") {
		$job = array();
		$this->title = "New Job Offer";
		$this->subTitle = "Fill the form";
	
	} else {
		$job = Job::getById($id);
		$this->title = $job["title"];
		$this->subTitle = (isset($job["description"])) ? $job["description"] : ( (isset($job["type"])) ? "Type ".$job["type"] : "");
	}

	$tags = json_encode(Tags::getActiveTags());
	$organizations = Authorisation::listUserOrganizationAdmin(Yii::app()->session["userId"]);

	$this->pageTitle = "Job Posting";

	Rest::json(array("result"=>true, 
		"content" => $this->renderPartial("public", array("job" => $job, "tags" => $tags, "organizations" => $organizations, "mode" => $mode), true)));
	
  }

}