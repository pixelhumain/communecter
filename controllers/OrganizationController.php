<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH pour les associations
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class OrganizationController extends CommunecterController {

  protected function beforeAction($action)
  {
	parent::initPage();
	return parent::beforeAction($action);
  }

  public function actions()
  {
   return array(
	// captcha action renders the CAPTCHA image displayed on the contact page
	'captcha'=>array(
	 'class'=>'CCaptchaAction',
	 'backColor'=>0xFFFFFF,
	),
   );
  }

  public function actionGetById($id=null)
  {
	$organizations = Organization::getById($id);
	Rest::json($organizations);
  }
	
  public function actionAddOrganizationForm($type=null,$id=null) 
  {
	  $organization = null;
	  if(isset($id)){
		$organization = Organization::getById($id);
		//make sure conected user is the owner
		if( $organization["email"] != Yii::app()->session["userEmail"] || ( isset($organization["ph:owner"]) && $organization["ph:owner"] != Yii::app()->session["userEmail"] ) ) {
		  $organization = null;
		}
		  
	  }
	  $types = PHDB::findOne ( PHType::TYPE_LISTS,array("name"=>"organisationTypes"), array('list'));
	  $tags = Tags::getActiveTags();
	  
	  $detect = new Mobile_Detect;
	  $isMobile = $detect->isMobile();
	  
	  $params = array( 
		"organization" => $organization,'type'=>$type,
		'types'=>$types['list'],
		'tags'=>json_encode($tags));

	  if($isMobile) {
		  $this->layout = "//layouts/mainSimple";
		  $this->render( "addOrganizationMobile" , $params );
	  }
	  else {
		   $this->renderPartial( "addOrganizationSV" , $params );
	  }
	
  }

	/**
	* Save a new organization with the minimal information
	* @return an array with result and message json encoded
	*/
	public function actionSaveNew() {
		// Retrieve data from form
		$newOrganization = Organization::newOrganizationFromPost($_POST);
		try {
			//Save the organization
			Rest::json(Organization::insert($newOrganization, Yii::app()->session["userId"]));
		} catch (CTKException $e) {
			return Rest::json(array("result"=>false, "msg"=>$e->getMessage()));
		}
	}

  /**
   * Update an existing organization
   * @return an array with result and message json encoded
   */
  //TODO SBAR => deprecated and not used
  public function actionSave() {
	// Minimal data
	$organization = Organization::newOrganizationFromPost($_POST);

	if (! isset($_POST["organizationId"])) 
	  throw new CTKException("You must specify an organization Id to update");
	else 
	  $organizationId = $_POST['organizationId'];
	
	//Complementary Data
	if (isset($_POST["shortName"])) $organization["shortName"] = $_POST["shortName"];
	if (isset($_POST["phone"])) $organization["phone"] = $_POST["phone"];
	if (isset($_POST["creationDate"])) $organization["creationDate"] = $_POST["creationDate"];
	if (isset($_POST["city"])) $organization["address"]["addressLocality"] = $_POST["city"];

	//Social Network info
	$socialNetwork = array();
	if (isset($_POST["twitterAccount"])) $socialNetwork["twitterAccount"] = $_POST["twitterAccount"];
	if (isset($_POST["facebookAccount"])) $socialNetwork["facebookAccount"] = $_POST["facebookAccount"];
	if (isset($_POST["gplusAccount"])) $socialNetwork["gplusAccount"] = $_POST["gplusAccount"];
	if (isset($_POST["gitHubAccount"])) $socialNetwork["gitHubAccount"] = $_POST["gitHubAccount"];
	if (isset($_POST["linkedInAccount"])) $socialNetwork["linkedInAccount"] = $_POST["linkedInAccount"];
	if (isset($_POST["skypeAccount"])) $socialNetwork["skypeAccount"] = $_POST["skypeAccount"];
	$organization["socialNetwork"] = $socialNetwork;

	try {
	  //Save the organization
	  $res = Organization::update($organizationId, $organization, Yii::app()->session["userId"] );
	} catch (CTKException $e) {
	  $res = array("result"=>false, "msg"=>$e->getMessage());
	}

	Rest::json($res);
  }

	/**
	  * Update an information field for an organization
	  */
	public function actionUpdateField(){
		$organizationId = "";
		$res = array("result"=>false, "msg"=>"Something went wrong");
		if (!empty($_POST["pk"])) {
			$organizationId = $_POST["pk"];
		} else if (!empty($_POST["id"])) {
			$organizationId = $_POST["id"];
		}

		if ($organizationId != "") {
			if (! empty($_POST["name"]) && ! empty($_POST["value"])) {
				$organizationFieldName = $_POST["name"];
				$organizationFieldValue = $_POST["value"];
				try {
					Organization::updateOrganizationField($organizationId, $organizationFieldName, $organizationFieldValue, Yii::app()->session["userId"] );
					$res = array("result"=>true, "msg"=>"The organization has been updated", $organizationFieldName=>$organizationFieldValue);
				} catch (CTKException $e) {
					$res = array("result"=>false, "msg"=>$e->getMessage(), $organizationFieldName=>$organizationFieldValue);
				}
			}
		} 
		Rest::json($res);
	}

	/**
	 * Delete an entry from the organization table using the id
	 */
  public function actionDelete() 
  {
	$result = array("result"=>false, "msg"=>"Cette requete ne peut aboutir.");
	  if(Yii::app()->session["userId"])
		{
	
		  $account = Organization::getById($_POST["id"]);
		  if( $account && Yii::app()->session["userEmail"] == $account['ph:owner'])
		  {
			
			PHDB::remove( Organization::COLLECTION,array("_id"=>new MongoId($_POST["id"])));
			//temporary for dev
			//TODO : Remove the association from all Ci accounts
			PHDB::update( PHType::TYPE_CITOYEN,array( "_id" => new MongoId(Yii::app()->session["userId"]) ) , array('$pull' => array("associations"=>new MongoId( $_POST["id"]))));
			
			$result = array("result"=>true,"msg"=>"Donnée enregistrée.");

		  }
	  }
	Rest::json($result);
  }

  /* **************************************
   *  MEMBERS
   ***************************************** */
  public function actionJoin($id)
  {
	$params = array();
	//get The organization Id
	if (empty($id)) {
	  throw new CTKException("The Parent organization doesn't exist !");
	}
	
	$params["parentOrganization"] = Organization::getPublicData($id);
	
	$lists = Lists::get(array("organisationTypes","typeIntervention","public"));

	if ( !isset($lists["organisationTypes"]) || !isset($lists["typeIntervention"]) || !isset($lists["public"]) ) {
	  throw new CTKException("Missing List data in 'lists' collection, must have organisationTypes, typeIntervention, public");
	}

	$params["types"] = $lists["organisationTypes"];
	$params["listTypeIntervention"] = $lists["typeIntervention"];
	$params["listPublic"] = $lists["public"];
	
	$params["tags"] = Tags::getActiveTags();

	$this->layout = "//layouts/mainSimple";
	$this->render("join", $params);
  }

  public function actionAddNewOrganizationAsMember() 
  {
	//validate Captcha 
	//no need to check Captcha twice
	//$captcha = ( isset( Yii::app()->session["checkCaptcha"] ) && Yii::app()->session["checkCaptcha"] ) ? true : false;
	$captcha = false;
	if( isset($_POST['g-recaptcha-response']) && isset( Yii::app()->params["captcha"] ) )
	{
	    Yii::import('recaptcha.ReCaptcha', true);
		Yii::import('recaptcha.RequestMethod', true);
		Yii::import('recaptcha.RequestParameters', true);
		Yii::import('recaptcha.Response', true);
		Yii::import('recaptcha.RequestMethod.Post', true);
		Yii::import('recaptcha.RequestMethod.Socket', true);
		Yii::import('recaptcha.RequestMethod.SocketPost', true);
	    $recaptcha = new \ReCaptcha\ReCaptcha( Yii::app()->params["captcha"] );
	    $resp = $recaptcha->verify( $_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'] );  
	    if ($resp && $resp->isSuccess())
	    {
			$captcha = true;
			//Yii::app()->session["checkCaptcha"] = true;;
		}
	}
	
	if($captcha){
	  //Get the person data
	  $newPerson = array(
			 'name'=>$_POST['personName'],
			 'email'=>$_POST['personEmail'],
			 'postalCode'=>$_POST['personPostalCode'],
			 'pwd'=>$_POST['password'],
			 'city'=>$_POST['personCity']);

	  // Retrieve data from form
	  try {
		$newOrganization = Organization::newOrganizationFromPost($_POST);
		$res = Organization::createPersonOrganizationAndAddMember($newPerson, $newOrganization, $_POST['parentOrganization']);
		unset(Yii::app()->session["checkCaptcha"]);
	  } catch (CTKException $e) {
		return Rest::json(array("result"=>false, "msg"=>$e->getMessage()));
	  } catch (CommunecterException $e) {
	  	return Rest::json(array("result"=>false, "msg"=>$e->getMessage()));
	  }
	  return Rest::json(array("result"=>true, "msg"=>"Your organization has been added with success. Check your mail box : you will recieive soon a mail from us."));
	} else 
	  return Rest::json(array("result"=>false, "msg"=>"invalid Captcha Test"));
  }

	/**********************************************************************/
	/* Dashboards
	/**********************************************************************/
	public function actionDashboard($id){
		if (empty($id)) {
		  throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
		}

		$organization = Organization::getPublicData($id);
		$events = Organization::listEventsPublicAgenda($id);
		$members = array( 
		  "citoyens"=> array(),
		  "organizations"=>array()
		);

		$contentKeyBase = Yii::app()->controller->id.".".Yii::app()->controller->action->id;
		$images = Document::listMyDocumentByType($id, Organization::COLLECTION, $contentKeyBase , array( 'created' => 1 ));

		$params = array( "organization" => $organization);
		$params["contentKeyBase"] = $contentKeyBase;
		$params["images"] = $images;
		$params["events"] = $events;
		$contextMap = array();
		$contextMap["organization"] = $organization;
		$contextMap["events"] = array();
		$contextMap["organizations"] = array();
		$contextMap["people"] = array();
		$organizations = Organization::getMembersByOrganizationId($id, Organization::COLLECTION);
		$people = Organization::getMembersByOrganizationId($id, Person::COLLECTION);
		foreach ($organizations as $key => $value) {
			$newOrga = Organization::getById($key);
			array_push($contextMap["organizations"], $newOrga);
			array_push($members["organizations"], $newOrga);
		}

		foreach ($events as $key => $value) {
			$newEvent = Event::getById($key);
			array_push($contextMap["events"], $newEvent);
		}
		foreach ($people as $key => $value) {
			$newCitoyen = Person::getById($key);
			array_push($contextMap["people"], $newCitoyen);
			array_push($members["citoyens"], $newCitoyen);
		}
		$params["members"] = $members;
		$params["contextMap"] = $contextMap;
		//list
		$params["tags"] = Tags::getActiveTags();
		$lists = Lists::get(array("public", "typeIntervention", "organisationTypes"));
		$params["public"] = $lists["public"];
		$params["organizationTypes"] = $lists["organisationTypes"];
		$params["typeIntervention"] = $lists["typeIntervention"];
		$params["countries"] = OpenData::getCountriesList();

		//Plaquette de présentation
		$listPlaquette = Document::listDocumentByCategory($id, Organization::COLLECTION, Document::CATEGORY_PLAQUETTE, array( 'created' => 1 ));
		$params["plaquette"] = reset($listPlaquette);
		$this->title = (isset($organization["name"])) ? $organization["name"] : "";
		$this->render( "dashboard", $params );
	}
	
	/***************************************
	* Dashboard Specifique
	***************************************** */

	public function actionDashboard1($id){
		if (empty($id)) {
		  throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
		}

		$organization = Organization::getPublicData($id);
		$events = Organization::listEventsPublicAgenda($id);
		
		$params = array( "organization" => $organization);
		$params["events"] = $events;
		$contentKeyBase = Yii::app()->controller->id.".".Yii::app()->controller->action->id;
		$params["contentKeyBase"] = $contentKeyBase;
		$images = Document::listMyDocumentByType($id, Organization::COLLECTION, $contentKeyBase , array( 'created' => 1 ));
		$params["images"] = $images;

		$documents = Document::getWhere( array( "type" => Organization::COLLECTION , "id" => $id) );
		$params["documents"] = $documents;
		$contextMap = array();
		$contextMap["organization"] = $organization;
		$contextMap["events"] = array();
		$contextMap["organizations"] = array();
		$contextMap["people"] = array();
		$organizations = Organization::getMembersByOrganizationId($id, Organization::COLLECTION);
		$people = Organization::getMembersByOrganizationId($id, Person::COLLECTION);
		foreach ($organizations as $key => $value) {
			$newOrga = Organization::getById($key);
			array_push($contextMap["organizations"], $newOrga);
		}

		foreach ($events as $key => $value) {
			$newEvent = Event::getById($key);
			array_push($contextMap["events"], $newEvent);
		}
		foreach ($people as $key => $value) {
			$newCitoyen = Person::getById($key);
			array_push($contextMap["people"], $newCitoyen);
		}
		$params["contextMap"] = $contextMap;
		
		$lists = Lists::get(array("organisationTypes"));
		$params["organizationTypes"] = $lists["organisationTypes"];

		$this->title = (isset($organization["name"])) ? $organization["name"] : "";
		$this->render( "dashboard1", $params );
	 }

public function actionDashboardMember($id)
  {
	//get The organization Id
	if (empty($id)) {
	  throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
	}

	$organization = Organization::getPublicData($id);
	$params = array( "organization" => $organization);
	$this->title = (isset($organization["name"])) ? $organization["name"] : "";
	$this->subTitle = (isset($organization["description"])) ? $organization["description"] : "";
	$this->pageTitle = "Communecter - Informations publiques de ".$this->title;

	if( isset($organization["links"]) && isset($organization["links"]["members"])) {
		
		$memberData;
		$subOrganizationIds = array();
		$members = array( 
		  "citoyens"=> array(),
		  "organizations"=>array()
		);
		
		foreach ($organization["links"]["members"] as $key => $member) {
		  
			if( $member['type'] == Organization::COLLECTION )
			{
				array_push($subOrganizationIds, $key);
				$memberData = Organization::getPublicData( $key );
				array_push( $members[Organization::COLLECTION], $memberData );
			}
			elseif($member['type'] == PHType::TYPE_CITOYEN )
			{
				$memberData = Person::getPublicData( $key );
				array_push( $members[PHType::TYPE_CITOYEN], $memberData );
			}
		}

		if (count($subOrganizationIds) != 0 ) {
			$randomOrganizationId = array_rand($subOrganizationIds);
			$randomOrganization = Organization::getById( $subOrganizationIds[$randomOrganizationId] );
			$params["randomOrganization"] = $randomOrganization;
		} 
		$params["members"] = $members;
	}
	$contentKeyBase = Yii::app()->controller->id.".".Yii::app()->controller->action->id;
	$params["contentKeyBase"] = $contentKeyBase;
	$images = Document::listMyDocumentByType($id, Organization::COLLECTION, $contentKeyBase , array( 'created' => 1 ));
	
	$events = Organization::listEventsPublicAgenda($id);
	$params["events"] = $events;
	$params["images"] = $images;

	$lists = Lists::get(array("organisationTypes"));
	$params["organizationTypes"] = $lists["organisationTypes"];
	
	$contextMap = array();
	$contextMap["organization"] = $organization;
	$contextMap["events"] = array();
	$contextMap["organizations"] = array();
	$contextMap["people"] = array();
	$organizations = Organization::getMembersByOrganizationId($id, Organization::COLLECTION);
	$people = Organization::getMembersByOrganizationId($id, Person::COLLECTION);
	foreach ($organizations as $key => $value) {
		$newOrga = Organization::getById($key);
		array_push($contextMap["organizations"], $newOrga);
	}

	foreach ($events as $key => $value) {
		$newEvent = Event::getById($key);
		array_push($contextMap["events"], $newEvent);
	}
	foreach ($people as $key => $value) {
		$newCitoyen = Person::getById($key);
		array_push($contextMap["people"], $newCitoyen);
	}
	$params["contextMap"] = $contextMap;

	$this->render( "dashboardMember", $params );
  }

   /* **************************************
   *  DOCUMENTS
   ***************************************** */
   //TODO SBAR - Move to document controller
	public function actionDocuments($id) {
	  $documents = Document::getWhere( array( "type" => Organization::COLLECTION , 
											  "id" => $id ,
											  "contentKey" => array( '$exists' => false)
											  ) );
	  if(Yii::app()->request->isAjaxRequest)
		echo $this->renderPartial("../documents/documents",array("documents"=>$documents, "id" => $id),true);
	  else
		$this->render("../documents/documents",array("documents"=>$documents, "id" => $id));
	}

	

   /* **************************************
   *  NEWS
   ***************************************** */

	public function actionNews($id) {
	  $news = News2::getWhere( array( "type" => Organization::COLLECTION , "id" => $id) );
	  $this->render("news",array("news"=>$news));
	}
	
	
	public function actionSig($id) {
		//get The organization Id
		if (empty($id)) {
		  throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
		}

		$organization = Organization::getPublicData($id);

		$this->title = "Annuaire du réseau";
		$this->subTitle = "Trouver une structure grâce à de multiples critères";
		$this->pageTitle = "Communecter - ".$this->title;

		//Get this organizationEvent
		$events = array();
		if(isset($organization["links"]["events"])){
			foreach ($organization["links"]["events"] as $key => $value) {
				$event = Event::getPublicData($key);
				$events[$key] = $event;
			}
		}

		//récupère les données de certains type de membres (TODO : à compléter)
		if(isset($organization["links"]["members"])){
			foreach ($organization["links"]["members"] as $key => $value) {
					
				if( $value["type"] == 'organizations' ||
					$value["type"] == 'organization' ||
					$value["type"] == 'association'	 ||
					$value["type"] == 'NGO')			 { $publicData = Organization::getPublicData($key); }
					
				if($value["type"] == 'citoyens')		 { $publicData = Person::getPublicData($key); }
				
				$addData = array("geo", "tags", "name", "description");
				foreach($addData as $data){
					if(!empty($publicData[$data]))
						$organization["links"]["members"][$key][$data] = $publicData[$data];
				}
			}
		}

		//Manage random Organization
		$organizationMembers = Organization::getMembersByOrganizationId($id, Organization::COLLECTION);
		$randomOrganizationId = array_rand($organizationMembers);
		$randomOrganization = Organization::getById($randomOrganizationId);

		$this->render( "sig", array("randomOrganization" => $randomOrganization, "organization" => $organization, "events" => $events));
	  }
	
	/**********************************************************************
	/* Search Organization
	/**********************************************************************/
	public function actionSearchOrganizationByCriteria() {
		$criterias = array();
		foreach ($_POST as $key => $value) {
			$criterias[$key] = $value;
		}

		$listOrganization = Organization::findOrganizationByCriterias($criterias, "name", 10);

		return Rest::json(array("result" => true, "list" => $listOrganization));
	}

}