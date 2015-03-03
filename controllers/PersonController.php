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
  public function actionViewer() { $this->renderPartial("viewer"); 	}
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
  
  protected function beforeAction($action)
	{
    return parent::beforeAction($action);
	}
  /**
   * @return [json Map] list
   */

  	 public function actionGetById($id=null)
	  {
	  	$people = Person::getById($id);
	  	Rest::json($people);
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
  public function actionLogout() 
  {
    Yii::app()->session["userId"] = null;
    $this->redirect(Yii::app()->homeUrl);
  }
  public function actionIndex() 
  {
    $person = PHDB::findOne(PHType::TYPE_CITOYEN, array( "_id" => new MongoId(Yii::app()->session["userId"]) ) );
    //$person["tags"] = Tags::filterAndSaveNewTags($person["tags"]);
    $organizations = array();
    
    //Load organizations
    if (isset($person["links"]) && !empty($person["links"]["memberOf"])) 
    {
      foreach ($person["links"]["memberOf"] as $id => $e) 
      {
        $organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS, array( "_id" => new MongoId($id)));
        if (!empty($organization)) {
          array_push($organizations, $organization);
        } else {
         // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
        }
      }
    }

    $people = array();
    //Load people I know
    if (isset($person["links"]) && !empty($person["links"]["knows"])) 
    {
      foreach ($person["links"]["knows"] as $id => $e ) 
      {
        $personIKnow = PHDB::findOne( PHType::TYPE_CITOYEN , array( "_id" => new MongoId($id)));
        if (!empty($personIKnow)) {
          array_push($people, $personIKnow);
        } else {
         //throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
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
      $this->render( "index" , array( "person"=>$person,
                                      "people"=>$people, 
                                      "organizations"=>$organizations, 
                                      "events"=>$events, 
                                      "projects"=>$projects, 
                                      'tags'=>json_encode($tags['list'] )) );
  }

  /**
     * Listing de tout les citoyen locaux filtrable et cherchable
     * par thématique
     */
  public function actionList() {
      $this->render("list");
  }
  /**
   * Point d'entrée pour gérer son compte 
   */
  public function actionMoi() {
      $this->render("compte");
  }
  /**
   * upon Registration a email is send to the new user's email 
   * he must click it to activate his account
   * This is cleared by removing the tobeactivated field in the pixelactifs collection
   */
  public function actionActivate($user) {
    $account = PHDB::findOne(PHType::TYPE_CITOYEN,array("_id"=>new MongoId($user)));
    if($account){
        Yii::app()->session["userId"] = $user;
        Yii::app()->session["userEmail"] = $account["email"];
        //remove tobeactivated attribute on account
        Yii::app()->mongodb->citoyens->update(array("_id"=>new MongoId($user)), array('$unset' => array("tobeactivated"=>"")));
        /*Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_ACTIVATED,
                      "user"=>$account["_id"]));*/
    }
    //TODO : add notification to the cities,region,departement info panel
    
    
    //TODO : redirect to monPH page , inciter le rezotage local
    $this->redirect(Yii::app()->homeUrl);
                
  }
  
  public function actionRegister()
  {
    echo json_encode(Citoyen::login($_POST['registerEmail'] , $_POST['registerPwd'] ));
    exit;
  }
  /**
   * Register to a secuure application, the unique pwd is linked to the application instance retreived by type
   * the appKey is saved in a sessionvariable loggedIn
   * for the moment works with a unique password for all users 
   * specified on the event instance 
   * Steps : 
   * 1- find the App (ex:event in group) exists in appType table
   * 2 - check if email is valid
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
  public function actionSave(){
      echo Rest::json(array("msg"=>"test  ok "));
  }
  /**
   * More details added to the user s registration account
   */
    public function actionRegister2()
  {
      if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
    {
            $account = PHDB::findOne(PHType::TYPE_CITOYEN,array("_id"=>new MongoId(Yii::app()->session["userId"])));
            if($account)
            {
                  $result = array("result"=>true,"msg"=>"Vos Données ont bien été enregistrées.");
                  $newInfos = array();
                  if( !empty($_POST['registerName']) )
                      $newInfos['name'] = $_POST['registerName'];
                  if( !empty($_POST['registerCP']) )
                      $newInfos['cp'] = $_POST['registerCP'];
                  if( isset($_POST['registerHelpout']) )
                      $newInfos['activeOnProject'] = $_POST['registerHelpout'];
                  if( !empty($_POST['helpJob']) )
                      $newInfos['positions'] = explode(",", $_POST['helpJob']);
                  if( !empty($_POST['registeroldpwd']) && !empty($_POST['registernewpwd']) ){
                      if( $account["pwd"] == hash( 'sha256', Yii::app()->session["userEmail"].$_POST['registeroldpwd'] ) )
                        $newInfos['pwd'] = hash('sha256', Yii::app()->session["userEmail"].$_POST['registernewpwd']); 
                      else
                        $result["msg"] .= ", mais votre ancien mot passe ne correspond pas"; 
                    }
                  /*if( isset($_POST['registerVieAssociative']) ){
                      //demande validation du responsable 
                      $newInfos['associations'] = explode(",", $_POST['listAssociation']);
                  }*/
                      
                  if( !empty($_POST['tagsPA']) )
                      $newInfos['tags'] = explode(",", $_POST['tagsPA']);
                  if( !empty($_POST['imageCitoyen']) )
                      $newInfos['img'] = $_POST['imageCitoyen'];
                  $newInfos['type']=$_POST['typePA'];
                  $newInfos['country']=$_POST['countryPA'];
                  
                  //if a job in the list doesn't exist is new , add it to the jobType collection
                  if( !empty($_POST['helpJob']) ){
                    $jobList = Yii::app()->mongodb->jobTypes->findOne(array("_id"=>new MongoId("5202375bc073efb084a9d2aa")));
                    foreach( explode(",", $_POST['helpJob']) as $job)
                    {
                        if(!in_array($job, $jobList['list']))
                        {
                            array_push($jobList['list'], $job);
                            Yii::app()->mongodb->jobTypes->update(array("_id"=>new MongoId("5202375bc073efb084a9d2aa")), array('$set' => array("list"=>$jobList['list'])));
                        }
                    }
                  }
                  //if a job in the list doesn't exist is new , add it to the jobType collection
                  
                  if( !empty($_POST['helpJob']) ){
                    $tagsList = Yii::app()->mongodb->tags->findOne(array("_id"=>new MongoId("51b972ebe4b075a9690bbc5b")));
                    foreach( explode(",", $_POST['tagsPA']) as $tag)
                    {
                        if(!in_array($tag, $tagsList['list']))
                        {
                            array_push($tagsList['list'], $tag);
                            Yii::app()->mongodb->tags->update(array("_id"=>new MongoId("51b972ebe4b075a9690bbc5b")), array('$set' => array("list"=>$tagsList['list'])));
                        }
                    }
                  }
                  
                  //if a job in the list doesn't exist is new , add it to the group collection
                 /* $newAsso = false;
                  foreach( explode(",", $_POST['listAssociation']) as $asso)
                  {
                      if(!Yii::app()->mongodb->groups->findOne(array("name"=>$asso)))
                          Yii::app()->mongodb->groups->insert(array("name"=>$asso,
                                                 "type"=>"association",
                                                                   'tobeValidated' => true,
                                                   'adminNotified' => false));
                      $newAsso = $asso;
                  }*/
                  
                  $where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
                  Yii::app()->mongodb->citoyens->update($where, array('$set' => $newInfos));
                  
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false, "id"=>"accountNotExist ".Yii::app()->session["userId"],"msg"=>"Ce compte n'existe plus."));
                
    } else
        echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
    exit;
  }
  
  public function actionFind($email){
      $account = Yii::app()->mongodb->citoyens->findOne(array("email"=>$email));
        if($account){
            echo json_encode($account);
        }
        else
             echo "Compte inconnue.";
  }
  public function actionInvite(){
      $this->renderPartial("invite");
  }
  public function actionInvitation()
  {
      if(Yii::app()->request->isAjaxRequest && isset($_POST['inviteEmail']) && !empty($_POST['inviteEmail']))
    {
            $account = Yii::app()->mongodb->citoyens->findOne(array("email"=>$_POST['inviteEmail']));
            $sponsor = Yii::app()->mongodb->citoyens->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"])));
            if($account){
                //the sponsored user allready exists 
                //simply add it to the sponsors conenctions 
                $where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
                $connect = (isset($sponsor["connect"])) ? array_push($connect["connect"], $account["_id"]) : array($account["_id"]);
                Yii::app()->mongodb->citoyens->update($where, array('$set' => array("connect"=>$connect )));
                echo json_encode(array("result"=>false, "id"=>"accountExist","msg"=>"Merci pour cette action de partage. "));
            }
            else 
            {
                //validate isEmail
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['inviteEmail'])) { 
                    $newAccount = array(
                          'email'=>$_POST['inviteEmail'],
                                'invitedBy'=>Yii::app()->session["userId"],
                                'tobeactivated' => true,
                                'adminNotified' => false,
                                'created' => time(),
                                'type'=>'citoyen'
                                );
                    if( isset($_POST['inviteName']) )
                      $newAccount['name'] = $_POST['inviteName'];
                      
                    Yii::app()->mongodb->citoyens->insert($newAccount);
                    //send validation mail
                    //TODO : make emails as cron jobs
                    /*$message = new YiiMailMessage;
                    $message->view = 'invitation';
                    $name = (isset($sponsor["name"])) ? "par ".$sponsor["name"] : "par ".$sponsor["email"];
                    $message->setSubject('Invitation au projet Pixel Humain '.$name);
                    $message->setBody(array("user"=>$newAccount["_id"],
                                            "sponsorName"=>$name), 'text/html');
                    $message->addTo("oceatoon@gmail.com");//$_POST['inviteEmail']
                    $message->from = Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);*/
                    
                    //TODO : add an admin notification
                    Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_INVITATION,
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
  }

  public function actionInitDataPeople(){
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initModuleData( $this->module->id, "personNetworking", PHType::TYPE_CITOYEN,true );
    $import = Admin::initModuleData($this->module->id, "organizationNetworking", PHType::TYPE_ORGANIZATIONS);

    $result = ( $import["errors"] > 0 ) ? false : true;
    Rest::json( $import );
    Yii::app()->end();
  }
  public function actionInitDataPeopleAll(){
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true );

    $result = ( $import["errors"] > 0 ) ? false : true;
    Rest::json( $import );
    Yii::app()->end();
  }

  public function actionClearInitDataPeopleAll(){
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true,true,true );

    Rest::json( $import );
    Yii::app()->end();
  }

  public function actionPublic($id){
    //get The person Id
    if (empty($id)) {
      throw new CommunecterException("The person id is mandatory to retrieve the person !");
    }

    $person = Person::getPublicData($id);
    
    $this->title = (isset($person["name"])) ? $person["name"] : "";
    $this->subTitle = (isset($person["description"])) ? $person["description"] : "";
    $this->pageTitle = "Communecter - Informations publiques de ".$this->title;


    $this->render("public", array("person" => $person));
  }
}