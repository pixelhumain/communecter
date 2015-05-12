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

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'       	=> 'citizenToolKit.controllers.person.IndexAction',
	        'login'     	=> 'citizenToolKit.controllers.person.LoginAction',
	        'logout'     	=> 'citizenToolKit.controllers.person.LogoutAction',
	        'authenticate'  => 'citizenToolKit.controllers.person.AuthenticateAction',
	        'dashboard'  	=> 'citizenToolKit.controllers.person.DashboardAction',
	        'connect'  		=> 'citizenToolKit.controllers.person.ConnectAction',
	        'disconnect'  	=> 'citizenToolKit.controllers.person.DisonnectAction',
	        'activate'  	=> 'citizenToolKit.controllers.person.ActivateAction',
	        'register'  	=> 'citizenToolKit.controllers.person.RegisterAction',
	        'getnotification'  	=> 'citizenToolKit.controllers.person.GetNotificationAction',
	        'invite'  		=> 'citizenToolKit.controllers.person.InviteAction',
	        'invitation'  		=> 'citizenToolKit.controllers.person.InvitationAction',

	    );
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
         // throw new CTKException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
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
         // throw new CTKException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
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
          //throw new CTKException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
          }
        } else if ($e["type"] == Organization::COLLECTION) {
            $someoneIKnow = Organization::getById($id);
            if (!empty($someoneIKnow)) {
              $someoneIKnow['linkType'] = "knows";
              array_push($organizations, $someoneIKnow);
            } else {
              //throw new CTKException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
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
         //throw new CTKException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
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
         //throw new CTKException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
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

}