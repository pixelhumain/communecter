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
  
  protected function beforeAction($action)
  {
    parent::initPage();
    return parent::beforeAction($action);
  }

  public function actionEdit($id) 
  {
    $job = Job::getById($id);
    
    $this->title = $job["name"];
    $this->subTitle = (isset($job["description"])) ? $job["description"] : ( (isset($job["type"])) ? "Type ".$job["type"] : "");
    $this->pageTitle = "Job Posting";

    $tags = Tags::getActiveTags();

    $this->render("edit",
      array('job'=>$job, 'tags'=>json_encode($tags)));

	}

  /**
   * Save a job
   * @return an array with result and message json encoded
   */
  public function actionSave() {
    //insert a new job
    if (empty($_POST["pk"])) {
      return Rest::json(array("msg"=>"insertion ok ", "id"=>"abcd"));
    //update an existing job
    } else {
      return Rest::json(array("msg"=>"update ok "));
    }
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

    $job = Job::getById($id);
    
    $this->title = (isset($job["title"])) ? $job["title"] : "";
    $this->pageTitle = "Communecter - Job Offer ".$this->title;


    $this->render("public", array("job" => $job));
  }

}