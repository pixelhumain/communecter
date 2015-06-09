<?php
class TestController extends CommunecterController {
  
  protected function beforeAction($action) {
	return parent::beforeAction($action);
  }

  public function actionTest() {
	var_dump(Link::addMember("551a5c00a1aa146d160041b0", PHType::TYPE_ORGANIZATIONS, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"], true));

	/*var_dump(Link::connect("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"]));
	 
	var_dump(Link::isConnected("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN));

	var_dump(Link::disconnect("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"]));
	
	var_dump(Link::isConnected("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN));
	*/
	//Rest::Json($res);

  }

  public function actionInsertNewPerson() {
	$res = Person::insert(array(
	  'name' => "Test", 'email' => "new@email.com", 'postalCode' => "97426", 'pwd' => "vlanlepass"
	  ));

	var_dump($res);

  }

  public function actionListEvent() {
	var_dump(Authorisation::listEventsIamAdminOf(Yii::app()->session["userId"]));

  }

  public function actionMail() {
	//send validation mail
        //TODO : make emails as cron jobs
  		echo "from : ".Yii::app()->params['adminEmail'];
  		echo "<br/>";
  		echo "to : ".Yii::app()->session['userEmail'];
        Mail::send(array("tpl"=>'validation',
             "subject" => 'Confirmer votre compte  pour le site ',
             "from"=>Yii::app()->params['adminEmail'],
             "to" => Yii::app()->session['userEmail'],
             "tplParams" => array( "user"=>Yii::app()->session['userId'] ,
                                   "title" => "TEst" ,
                                   "logo"  => $this->module->assetsUrl."/images/logo.png" )
        ));
  }

  public function actionSearchOrganization() {
	$criterias = array("name" => "O.R", "email" => "O.R");
	var_dump(Organization::findOrganizationByCriterias($criterias, 10));
  }
  
  public function actionListOrganizationEvent() {
	$id = "54eed904a1aa1958b70041ef";
	var_dump(Organization::listEventsPublicAgenda($id));
  }

  public function actionInsertJob() {
  	$job = array("hiringOrganization" => "54eed4efa1aa1458b70041ac", "description" => "Job de Test");
  	$res = Job::insertJob($job);
  	var_dump($res);
  	$listjob = Job::getJobsList("54eed4efa1aa1458b70041ac");
  	var_dump($listjob);
  }

  public function actionPlaquette() {
  	$listPlaquette = Document::listDocumentByCategory("55509e082336f27ade0041aa", Organization::COLLECTION, Document::CATEGORY_PLAQUETTE, array( 'created' => 1 ));
  	var_dump(reset($listPlaquette));
  	$listCategory = Document::getAvailableCategories("55509e082336f27ade0041aa",Organization::COLLECTION);
  	var_dump($listCategory);
  }

  public function actionHelper() {
  	$cssAnsScriptFiles = array(
		//dropzone
		'/assets/plugins/dropzone/downloads/css/ph.css',
		'/assets/plugins/dropzone/downloads/dropzone.min.js',
		//lightbox
		'/assets/plugins/lightbox2/css/lightbox.css',
		'/assets/plugins/lightbox2/js/lightbox.min.js'
	);

	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles);
  }  
}