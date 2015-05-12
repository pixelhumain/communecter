<?php
/**
 * EventController.php
 * 
 * contient tous ce qui concerne les utilisateurs / clietns TEEO
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 18/07/2014
 */
class PersonController extends CommunecterController {

  public $hasSocial = false;
  public $loginRegister = true;

  
  public function accessRules() {
    return array(
      // not logged in users should be able to login and view captcha images as well as errors
      array('allow', 'actions' => array('index','graph','register','register2')),
      // logged in users can do whatever they want to
      array('allow', 'users' => array('@')),
      // not logged in users can't do anything except above
      array('deny'),
    );
  }

  public function actions()
  {
      return array(
          'index'     =>'ctk.controllers.person.actionIndex',
      );
  }
  
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
	}

<<<<<<< HEAD
  //Still use ?
  public function actionIndex() 
  {
    //Redirect to the dashboard of the user
    $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/dashboard"));

    $person = Person::getById(Yii::app()->session["userId"]);
    //$person["tags"] = Tags::filterAndSaveNewTags($person["tags"]);
    $organizations = array();
    
    //Load organizations person is memberOf
    if (isset($person["links"]) && !empty($person["links"]["memberOf"])) 
    {
      foreach ($person["links"]["memberOf"] as $id => $e) 
      {
        $organization = Organization::getById($id);
        if (!empty($organization)) {
          $organization["linkType"] = "memberOf";
          array_push($organizations, $organization);
        } else {
         // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }

    $people = array();
    //Load people or organization I know
    if (isset($person["links"]) && !empty($person["links"]["knows"])) {
      foreach ($person["links"]["knows"] as $id => $e ) {
        if ( $e["type"] == PHType::TYPE_CITOYEN ) {
          $someoneIKnow = Person::getById($id);
          if (!empty($someoneIKnow)) {
            array_push($people, $someoneIKnow);
          } else {
          //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
          }
        } else if ($e["type"] == Organization::COLLECTION) {
            $someoneIKnow = Organization::getById($id);
            if (!empty($someoneIKnow)) {
              $someoneIKnow['linkType'] = "knows";
              array_push($organizations, $someoneIKnow);
            } else {
              //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
            }
        }
      }
    }

    $events= array();
    

    //Load people I know
    if (isset($person["links"]) && !empty($person["links"]["events"])) 
    {
      foreach ($person["links"]["events"]  as $id => $e ) 
      {
        $event = Event::getById($id);
        if (!empty($event)) {
          array_push($events, $event);
        } else {
         //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }

    $projects = array();
    //Load people I know
    if (isset($person["links"]) && !empty($person["links"]["projects"])) 
    {
      foreach ($person["links"]["projects"] as $id => $e) 
      {
        $project = Project::getById($id);
        if (!empty($project)) {
          array_push($projects, $project);
        } else {
         //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }
    
    $tags = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));

    if(!Yii::app()->session["userId"])
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));
    else 
      $this->render( "index" , array( "person"=>$person,
                                      "people"=>$people, 
                                      "organizations"=>$organizations, 
                                      "events"=>$events, 
                                      "projects"=>$projects, 
                                      'tags'=>json_encode($tags['list'] )) );
  }
  
=======
>>>>>>> 27f63b1e2fc03e8b8eafc123d7e20d9cbf9e18e1
  /**
   * @return [json Map] list
   */
  //Use for react proto ? Keep it ?
  public function actionUpdateName($name=null, $id=null){
  	Person::setNameById($name, $id);
  	$people = Person::getById($id);
	  Rest::json($people);
  }
  //Use for react proto ? Keep it ?
  public function actionGetById($id=null)
	{
	  $people = Person::getById($id);
	  Rest::json($people);
	}
  //Use for react proto ? Keep it ?
	public function actionGetOrganization($id=null){
	  	$organizations = Person::getOrganizationsById($id);
	    Rest::json($organizations);
	 }

	public function actionLogin() 
	{
    $this->layout = "//layouts/mainSimple";
    if(Yii::app()->session["userId"]) 
      $this->redirect(Yii::app()->homeUrl);
    else
      $detect = new Mobile_Detect;
    
    $isMobile = $detect->isMobile();
    
    if($isMobile) {
       $this->render( "loginMobile" );
    }
    else {
       $this->render( "login" );
    }
  }

  public function actionIndex() 
  {
    //Redirect to the dashboard of the user
    $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/dashboard"));
  }
  
  public function actionLogout() 
  {
    Person::clearUserSessionData();
    $this->redirect(Yii::app()->homeUrl);
  }

  /**
     * connect 2 people together 
     */
  public function actionConnect($id,$type) 
  {
      Rest::json( Link::connect(Yii::app()->session['userId'], PHType::TYPE_CITOYEN, $id, $type,Yii::app()->session['userId'], "knows" ));
  }
  /**
     * disconnect 2 people together 
     */
  public function actionDisconnect($id,$type) 
  {
      Rest::json( Link::disconnect(Yii::app()->session['userId'], PHType::TYPE_CITOYEN, $id, $type,Yii::app()->session['userId'], "knows" ));
  }

  /**
   * upon Registration a email is send to the new user's email 
   * he must click it to activate his account
   * This is cleared by removing the tobeactivated field in the pixelactifs collection
   */
  public function actionActivate($user) {
    $account = Person::getById($user);
    //TODO : move code below to the model Person
    if($account){
        Person::saveUserSessionData( $user, $account["email"],array("name"=>$account["name"]));
        //remove tobeactivated attribute on account
        PHDB::update(PHType::TYPE_CITOYEN,
                            array("_id"=>new MongoId($user)), 
                            array('$unset' => array("tobeactivated"=>""))
                            );
        /*Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_ACTIVATED,
                      "user"=>$account["_id"]));*/
    }
    //TODO : add notification to the cities,region,departement info panel
    //TODO : redirect to monPH page , inciter le rezotage local
    $this->redirect(Yii::app()->homeUrl);
                
  }
  
  /**
   * Register a new user for the application
   * Data expected in the post : name, email, postalCode and pwd
   * @return Array as json with result => boolean and msg => String
   */
  public function actionRegister() {
    $name = (!empty($_POST['name'])) ? $_POST['name'] : "";
    $email = (!empty($_POST['email'])) ? $_POST['email'] : "";
    $postalCode = (!empty($_POST['cp'])) ? $_POST['cp'] : "";
    $pwd = (!empty($_POST['pwd'])) ? $_POST['pwd'] : "";
    $city = (!empty($_POST['city'])) ? $_POST['city'] : "";

    //Get the person data
    $newPerson = array(
       'name'=> $name,
       'email'=>$email,
       'postalCode'=> $postalCode,
       'pwd'=>$pwd,
       'city'=>$city);

    try {
      $res = Person::insert($newPerson, false);
      
      Person::saveUserSessionData($res["id"],$email,array("name"=>$name));

    } catch (CommunecterException $e) {
      $res = array("result" => false, "msg"=>$e->getMessage());
    }

    //echo json_encode(Citoyen::login($_POST['registerEmail'] , $_POST['registerPwd'] ));
    Rest::json($res);
    exit;
  }
  /**
   * Register to a secure application, the unique pwd is linked to the application instance retreived by type
   * the appKey is saved in a sessionvariable loggedIn
   * for the moment works with a unique password for all users 
   * specified on the event instance 
   * Steps : 
   * 1- find the App (ex:event in group) exists in appType table
   * 2- check if email is valid
   * 3- test password matches
   * 4- find the user exists in "citoyens" table based on email
   * 5- save session information 
   */
  public function actionRegisterAppPwd()
  {
      if(Yii::app()->request->isAjaxRequest && isset($_POST['registerEmail']) && !empty($_POST['registerEmail']) 
                                            && isset($_POST['registerPwd']) && !empty($_POST['registerPwd']))
    {
        //check application exists
        if(isset($_POST['appKey']) && !empty($_POST['appKey']) 
             && isset($_POST['appType']) && !empty($_POST['appType']))
          {
             $type = Yii::app()->mongodb->selectCollection($_POST['appType']);
             $app = $type->findOne(array("_id"=>new MongoId($_POST['appKey'])));
               if($app)
               {
                    //validate isEmail
                    $email = $_POST['registerEmail'];
                    $name = "";
                   if(preg_match('#^([\w.-])/<([\w.-]+@[\w.-]+\.[a-zA-Z]{2,6})/>$#',$email, $matches)) 
                   {
                      $name = $matches[0];
                      $email = $matches[1];
                   }
                   if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) 
                   { 
                        //test pwd
                        if( $app["pwd"] == $_POST['registerPwd'] )
                        {
                            $account = PHDB::findOne(PHType::TYPE_CITOYEN,array("email"=>$_POST['registerEmail']));
                            if($account){
                                //TODO : check if account is participant in the app
                                Yii::app()->session["userId"] = $account["_id"];
                                Yii::app()->session["userEmail"] = $account["email"];
                                if ( !isset(Yii::app()->session["loggedIn"]) && !is_array(Yii::app()->session["loggedIn"]))
                                    Yii::app()->session["loggedIn"] =   array();
                                $tmp = Yii::app()->session["loggedIn"];
                                array_push( $tmp , $_POST['appKey'] );
                                
                                Yii::app()->session["loggedIn"] = $tmp;
                                echo json_encode(array("result"=>true, "msg"=>"Vous êtes connecté à présent, Amusez vous bien."));
                            }
                            else
                                 echo json_encode(array("result"=>false, "msg"=>"Compte inconnue."));
                        }else
                            echo json_encode(array("result"=>false, "msg"=>"Accés refusé."));
                    } else 
                       echo json_encode(array("result"=>false, "msg"=>"Email invalide"));
               } else 
                   echo json_encode(array("result"=>false, "msg"=>"Application invalide"));
        }else{
                echo json_encode(array("result"=>false, "msg"=>"Vous Pourrez pas accéder a cette application"));
            }
    } else
        echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
    
    exit;
  }
  
  public function actionInvite(){
      $this->renderPartial("invite");
  }
  /*public function actionInvitation()
  {
      if(Yii::app()->request->isAjaxRequest && isset($_POST['email']) && !empty($_POST['email']))
    {
            $account = Yii::app()->mongodb->citoyens->findOne(array("email"=>$_POST['email']));
            $sponsor = Person::getById(Yii::app()->session["userId"]);
            if($account){
                //the sponsored user allready exists 
                //simply add it to the sponsors conenctions 
                $where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
                $connect = (isset($sponsor["connect"])) ? array_push($sponsor["connect"], $account["_id"]) : array($account["_id"]);
                Yii::app()->mongodb->citoyens->update($where, array('$set' => array("connect"=>$connect )));
                echo json_encode(array("result"=>false, "id"=>"accountExist","msg"=>"Merci pour cette action de partage. "));
            }
            else 
            {
                //validate isEmail
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['email'])) { 
                    $newAccount = array(
                          'email'=>$_POST['email'],
                                'invitedBy'=>Yii::app()->session["userId"],
                                'tobeactivated' => true,
                                'adminNotified' => false,
                                'created' => time(),
                                'type'=>'citoyen'
                                );
                    if( isset($_POST['name']) )
                      $newAccount['name'] = $_POST['name'];
                      
                    Yii::app()->mongodb->citoyens->insert($newAccount);
                    //send validation mail
                    //TODO : make emails as cron jobs
                    /*$message = new YiiMailMessage;
                    $message->view = 'invitation';
                    $name = (isset($sponsor["name"])) ? "par ".$sponsor["name"] : "par ".$sponsor["email"];
                    $message->setSubject('Invitation au projet Pixel Humain '.$name);
                    $message->setBody(array("user"=>$newAccount["_id"],
                                            "sponsorName"=>$name), 'text/html');
                    $message->addTo("oceatoon@gmail.com");//$_POST['email']
                    $message->from = Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);*/
                    
                    //TODO : add an admin notification
                    /*Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_INVITATION,
                                             "user"=>Yii::app()->session["userId"],
                                             "invited"=>$newAccount["_id"]));
                    //simply add it to the sponsors conenctions 
                    $where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
                    $connect = (isset($sponsor["connect"])) ? array_push($connect["connect"], $account["_id"]) : array($account["_id"]);
                    Yii::app()->mongodb->citoyens->update($where, array('$set' => array("connect"=>$connect )));
                    
                    echo json_encode(array("result"=>true, "id"=>$newAccount["_id"],"msg"=>"Meci pour votre contribution.".
                                                        "<br/> Plus on est nombreux, mieux ca marchera.".
                                                        "<br/> Plus on est de fous, plus on rit.".
                                                                                            "<br/>« Plus on est nombreux plus on crie dans le désert. »"));
               }else
                   echo json_encode(array("result"=>false, "msg"=>"Vous devez remplir un email valide."));
            }
    } else
        echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
    exit;
  }*/

  public function actionInitDataPeople()
  {
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initModuleData( $this->module->id, "personNetworking", PHType::TYPE_CITOYEN,true );
    $import = Admin::initModuleData($this->module->id, "organizationNetworking", Organization::COLLECTION);

    $result = ( $import["errors"] > 0 ) ? false : true;
    Rest::json( $import );
    Yii::app()->end();
  }

  public function actionInitDataPeopleAll()
  {
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true );

    $result = ( $import["errors"] > 0 ) ? false : true;
    Rest::json( $import );
    Yii::app()->end();
  }

  public function actionImportMyData()
  {
    $base = 'upload'.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.Yii::app()->session["userId"].DIRECTORY_SEPARATOR;
    if( Yii::app()->session["userId"] && file_exists ( $base.Yii::app()->session["userId"].".json" ) )
    {
      //inject Data brute d'une liste de Person avec Id
      $res = array("result"=>true, "msg"=>"import success");//Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true );
      //$res["result"] = ( isset($res["errors"]) && $res["errors"] > 0 ) ? false : true;
    } else 
      $res = array("result"=>false, "msg"=>"no Data to Import");

    Rest::json( $res );
    Yii::app()->end();
  }

  public function actionClearInitDataPeopleAll()
  {
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true,true,true );

    Rest::json( $import );
    Yii::app()->end();
  }

  public function actionReact() 
  { 
    $person = Person::getById(Yii::app()->session["userId"]);
    //$person["tags"] = Tags::filterAndSaveNewTags($person["tags"]);
    $organizations = array();
    
    //Load organizations person is memberOf
    if (isset($person["links"]) && !empty($person["links"]["memberOf"])) 
    {
      foreach ($person["links"]["memberOf"] as $id => $e) 
      {
        $organization = PHDB::findOne( Organization::COLLECTION, array( "_id" => new MongoId($id)));
        if (!empty($organization)) {
          array_push($organization, array("linkType" => "memberOf"));
          array_push($organizations, $organization);
        } else {
         // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }

    //Load organizations person is following
    if (isset($person["links"]) && !empty($person["links"]["knows"])) 
    {
      foreach ($person["links"]["knows"] as $id => $e) 
      {
        $organization = PHDB::findOne( Organization::COLLECTION, array( "_id" => new MongoId($id)));
        if (!empty($organization)) {
          $organization["linkType"] = "knows";
          array_push($organizations, $organization);
        } else {
         // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }

    $people = array();
    //Load people or organization I know
    if (isset($person["links"]) && !empty($person["links"]["knows"])) {
      foreach ($person["links"]["knows"] as $id => $e ) {
        if ($e["type"] == PHType::TYPE_CITOYEN) {
          $someoneIKnow = Person::getById($id);
          if (!empty($someoneIKnow)) {
            array_push($people, $someoneIKnow);
          } else {
          //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
          }
        } else if ($e["type"] == Organization::COLLECTION) {
            $someoneIKnow = Organization::getById($id);
            if (!empty($someoneIKnow)) {
              $someoneIKnow['linkType'] = "knows";
              array_push($organizations, $someoneIKnow);
            } else {
              //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
            }
        }
      }
    }

    $events = array();
    //Load people I know
    if (isset($person["events"]) && !empty($person["events"])) 
    {
      foreach ($person["events"] as $id ) 
      {
        $el = PHDB::findOne( PHType::TYPE_EVENTS , array( "_id" => new MongoId($id)));
        if (!empty($el)) {
          array_push($events, $el);
        } else {
         //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }

    $projects = array();
    //Load people I know
    if (isset($person["projects"]) && !empty($person["projects"])) 
    {
      foreach ($person["projects"] as $id) 
      {
        $el = PHDB::findOne( PHType::TYPE_PROJECTS , array( "_id" => new MongoId($id)));
        if (!empty($el)) {
          array_push($projects, $el);
        } else {
         //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }
    
    $tags = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));

    if(!Yii::app()->session["userId"])
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));
    else 
      $this->render( "react" , array( "person"=>$person,
                                      "people"=>$people, 
                                      "organizations"=>$organizations, 
                                      "events"=>$events, 
                                      "projects"=>$projects, 
                                      'tags'=>json_encode($tags['list'] )) );
  }

    // To move and refractor
    public function actionGetUserAutoComplete(){
	  	$query = array( '$or' => array( array("email" => new MongoRegex("/".$_POST['search']."/i")),
	  					array( "name" => new MongoRegex("/".$_POST['search']."/i"))));
	  	$allCitoyens = PHDB::find ( PHType::TYPE_CITOYEN , $query);
		$allOrganization = PHDB::find( Organization::COLLECTION, $query, array("_id", "name", "type", "address", "email", "links", "imagePath"));
		$all = array(
			"citoyens" => $allCitoyens,
			"organizations" => $allOrganization,
		);		   
		Rest::json( $all );
		Yii::app()->end(); 
	 }


  public function actionInvitation(){
	 $res = array( "result" => false , "content" => "Something went wrong" );
	 if(Yii::app()->request->isAjaxRequest && isset( $_POST["parentId"]) )
	 {
	 	//test if group exist
		$organization = (isset($_POST["parentId"])) ? PHDB::findOne( Organization::COLLECTION,array("_id"=>new MongoId($_POST["parentId"]))) : null;
		$citoyen = (isset($_POST["parentId"])) ? PHDB::findOne( PHType::TYPE_CITOYEN,array("_id"=>new MongoId($_POST["parentId"]))) : null;
		if($citoyen || $organization)
		{
			$memberEmail = $_POST['email'];
			if($citoyen){
				$type =  PHType::TYPE_CITOYEN;
			}
			else if($organization){
				$type = Organization::COLLECTION;
			}
			
			if(isset($_POST["id"]) && $_POST["id"] != ""){
				$memberEmailObject = PHDB::findOne( $type , array("_id" =>new MongoId($_POST["id"])), array("email"));
				$memberEmail = $memberEmailObject['email'];
			}

		 	//check citizen exist by email
		 	if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$memberEmail))
			{
				$member = PHDB::findOne( $type , array("email"=>$memberEmail));
				if( !$member )
				{
					 //create an entry in the citoyens colelction
					 $member = array(
					 'name'=>$_POST['name'],
					 'email'=>$memberEmail,
					 'tobeactivated' => true,
					 'created' => time(),
					 'type'=>'citoyen',
					 "links" => array( 
					 	'knows'=>array( $_POST["parentId"] => array( "type" => $type) ),
					 	'invitedBy'=>array(Yii::app()->session["userId"] => array( "type" => $type)),
					 	),
					 );
					Person::createAndInvite($member);
					 //add the member into the organization map
					$member = PHDB::findOne( Person::COLLECTION , array("email"=>$memberEmail));
					PHDB::update( $type, 
							array("_id" => new MongoId($_POST["parentId"])) ,
							array('$set' => array( "links.knows.".(string)$member["_id"].".type" => $type ) ));
					$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
					 //TODO : background send email
					 //send validation mail
					 //TODO : make emails as cron jobs
					 /*$message = new YiiMailMessage;
					 $message>view = 'invitation';
					 $name = (isset($sponsor["name"])) ? "par ".$sponsor["name"] : "par ".$sponsor["email"];
					 $message>setSubject('Invitation au projet Pixel Humain '.$name);
					 $message>setBody(array("user"=>$member["_id"],
					 "sponsorName"=>$name), 'text/html');
					 $message>addTo("oceatoon@gmail.com");//$_POST['email']
					 $message>from = Yii::app()>params['adminEmail'];
					Yii::app()>mail>send($message);*/

					 //TODO : add an admin notification
					 Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_INVITATION,
					 "user"=>Yii::app()->session["userId"],
					 "invited"=>$member["_id"]));
					 
				}
				else
				{
				 //person exists with this email and is connected to this Organisation
					$memberType = "citoyens";
					if( isset($citoyen['links']["knows"]) && isset( $organization['links']["knows"][(string)$member["_id"]] ))

						$res = array( "result" => false , "content" => "allready in your contact" );
					else {
						PHDB::update( $type , array( "email" => $memberEmail) ,
							array('$set' => array( "links.knows.".$_POST["parentId"].".type" => "citoyens" ) ));
							
						PHDB::update( $type , 
							array("_id" => new MongoId($_POST["parentId"])) ,
							array('$set' => array( "links.knows.".(string)$member["_id"].".type" => $memberType  ) ));
						$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);	
					}	
				}
			} else
			$res = array( "result" => false , "content" => "email must be valid" );
		}
	 }
	 Rest::json( $res );
 }

 /**
  * Display the dashboard of the person
  * @param String $id Not mandatory : if specify, look for the person with this Id. 
  * Else will get the id of the person logged
  * @return type
  */
 public function actionDashboard($id = null)
  {
    //get The person Id
    if (empty($id)) {
        if (empty(Yii::app()->session["userId"])) {
            $this->redirect(Yii::app()->homeUrl);
        } else {
            $id = Yii::app()->session["userId"];
        }
    }

    $person = Person::getPublicData($id);
    $contentKeyBase = Yii::app()->controller->id.".".Yii::app()->controller->action->id;
 	$images =  Document::listMyDocumentByType($id, Person::COLLECTION, $contentKeyBase , array( 'created' => 1 ));
    $params = array( "person" => $person);
    $params['images'] = $images;
    $params["contentKeyBase"] = $contentKeyBase;
    $this->sidebar1 = array(
      array('label' => "ACCUEIL", "key"=>"home","iconClass"=>"fa fa-home","href"=>"communecter/person/dashboard/id/".$id),
    );

    $this->title = ((isset($person["name"])) ? $person["name"] : "")."'s Dashboard";
    $this->subTitle = (isset($person["description"])) ? $person["description"] : "";
    $this->pageTitle = "Communecter - Informations publiques de ".$this->title;

    //Get Projects
    $projects = array();
    if(isset($person["links"]["projects"])){
    	foreach ($person["links"]["projects"] as $key => $value) {
  			$project = Project::getPublicData($key);
  			array_push($projects, $project);
  		}
    }

    
    //Get the Events
  	$events = Authorisation::listEventsIamAdminOf($id);
  	$eventsAttending = Event::listEventAttending($id);
  	foreach ($eventsAttending as $key => $value) {
  		$eventId = (string)$value["_id"];
  		if(!isset($events[$eventId])){
  			$events[$eventId] = $value;
  		}
  	}
  	$tags = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));
    //TODO - SBAR : Pour le dashboard person, affiche t-on les événements des associations dont je suis memebre ?
  	//Get the organization where i am member of;
  	$organizations = array();
    if( isset($person["links"]) && isset($person["links"]["memberOf"])) {
    	
        foreach ($person["links"]["memberOf"] as $key => $member) {
            $organization;
            if( $member['type'] == Organization::COLLECTION )
            {
                $organization = Organization::getPublicData( $key );
                array_push($organizations, $organization );
            }
       
         	if(isset($organization["links"]["events"])){
	  			foreach ($organization["links"]["events"] as $keyEv => $valueEv) {
	  				$event = Event::getPublicData($keyEv);
	  				$events[$keyEv] = $event;	
	  			}
	  			
	  		}
        }        
        //$randomOrganizationId = array_rand($subOrganizationIds);
        //$randomOrganization = Organization::getById( $subOrganizationIds[$randomOrganizationId] );
        //$params["randomOrganization"] = $randomOrganization;
        
    }
    $people = array();
    if( isset($person["links"]) && isset($person["links"]["knows"])) {
    	foreach ($person["links"]["knows"] as $key => $member) {
    		$citoyen;
            if( $member['type'] == PHType::TYPE_CITOYEN )
            {
            	$citoyen = Person::getPublicData( $key );
            	array_push($people, $citoyen);
            }
    	}
    	
    }

   	$params["tags"] = $tags;
    $params["organizations"] = $organizations;
    $params["projects"] = $projects;
    $params["events"] = $events;
    $params["people"] = $people;

    $this->render( "dashboard", $params );
  }
	 public function actionGetNotification(){

	 }

  public function actionAbout(){

  	$person = PHDB::findOne(PHType::TYPE_CITOYEN, array( "_id" => new MongoId(Yii::app()->session["userId"]) ) );
  	$tags = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));
  	
  	$this->render( "about" , array("person"=>$person,'tags'=>json_encode($tags['list'])) );

  }

  	 /**
	  * Update an information field for a person
	  */
	public function actionUpdateField(){
	  	if (!empty($_POST["pk"])) {
	  		$personId = $_POST["pk"];
			if (! empty($_POST["name"]) && ! empty($_POST["value"])) {
				$personFieldName = $_POST["name"];
				$personFieldValue = $_POST["value"];
				Person::updatePersonField($personId, $personFieldName, $personFieldValue, Yii::app()->session["userId"] );
			}
	  	}else{
	  		$res = Rest::json(array("result"=>false, "error"=>"Something went wrong", $jobFieldName=>$jobFieldValue));
	  	}
	}
}