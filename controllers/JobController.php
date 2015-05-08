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
				$collectionName = $this->getCollectionFieldName($fieldName);
				$job[$collectionName] = $fieldValue;
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
				$collectionName = $this->getCollectionFieldName($jobFieldName);
				Job::updateJobField($jobId, $collectionName, $jobFieldValue, Yii::app()->session["userId"] );
		  	} else {
				return Rest::json(array("result"=>false,"msg"=>"Uncorrect request"));  
		  	}	
		}
	  	
	  	return Rest::json(array("result"=>true, "msg"=>"Votre Offre d'emploi a été modifiée avec succès.", $jobFieldName=>$jobFieldValue));
	}

	private function getCollectionFieldName($fieldName) {
		if ($fieldName == "address") 
			return "jobLocation.address";
		else if ($fieldName == "jobLoc") 
			return "jobLocation.description";
		//specific case for tagsJob
		else if ($fieldName == "tagsJob") 
			return "tags";
		else
			return $fieldName;
	}

	/**
	 * Delete an entry from the job table using the id
	 */
	public function actionDelete($id) {
		//get The job Id
		if (empty($id)) {
		  throw new CommunecterException("The job posting id is mandatory to retrieve the job posting !");
		}

		$res = Job::removeJob($id, Yii::app()->session["userId"]);
		Rest::json($res);
	}

  public function actionList($organizationId = null){

	$jobList = Job::getJobsList($organizationId);
  
	if(Yii::app()->request->isAjaxRequest){
		$this->renderPartial("jobList", array("jobList" => $jobList, "id" => $organizationId));
	} else {
		$this->render("jobList", array("jobList" => $jobList, "id" => $organizationId));
	}
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
		"content" => $this->renderPartial("jobSV", array("job" => $job, "tags" => $tags, "organizations" => $organizations, "mode" => $mode), true)));	
  }

}