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

  public function actionIndex($type=null)
  {
    $this->title = "Organization";
    if($type){
      $params =  array("type"=>$type);
      $this->subTitle = "Découvrez les <b>$type</b> locales";
    } else
      $this->subTitle = "Découvrez les organization locales";
    $this->pageTitle = "Organization : Association, Entreprises, Groupes locales";
    $params = array();
    if($type)
     $params =  array("type"=>$type);
    
    $organizations = PHDB::find( PHType::TYPE_ORGANIZATIONS,$params);
    
    $detect = new Mobile_Detect;
    $isMobile = $detect->isMobile();
    if($isMobile) 
	$this->layout = "//layouts/mainSimple";
    
    
    $this->render("index",array("organizations"=>$organizations));
  }
	
	
  public function actionTags($type=null)
  {
    if($type){
      $params =  array("type"=>$type);
      //$this->subTitle = Yii::t("organisation","Découvrez les <b>$type</b> locales");
      $this->subTitle = Yii::t("organisation","Discover local Organisations",null,$this->module->id);
    } 
    $params = array();
    if($type)
     $params =  array("tags"=>$type);
    
    $organizations = PHDB::find( PHType::TYPE_ORGANIZATIONS,$params);
    $this->render("index",array("organizations"=>$organizations));
  }
    
    

  public function actionView($id) 
  {
    $organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS,array("_id"=>new MongoId($id)));
    $this->title = $organization["name"];
    $this->subTitle = (isset($organization["description"])) ? $organization["description"] : ( (isset($organization["type"])) ? "Type ".$organization["type"] : "");
    $this->pageTitle = "Organization : Association, Entreprises, Groupes locales";

    $types = PHDB::findOne ( PHType::TYPE_LISTS,array("name"=>"organisationTypes"), array('list'));
    
    $tags = Tags::getActiveTags();

    $this->render("view",array('organization'=>$organization,'types'=>$types['list'],'tags'=>json_encode($tags)));
	}

  public function actionForm($type=null,$id=null) 
  {
      $organization = null;
      if(isset($id)){
        $organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS,array("_id"=>new MongoId($id)));
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
    	  $this->render( "formMobile" , $params );
      }
      else {
	       $this->renderPartial( "form" , $params );
      }
	
  }
  /*
  {
  "@context": "http://schema.org",
  "@type": "LocalBusiness",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Mexico Beach",
    "addressRegion": "FL",
    "streetAddress": "3102 Highway 98"
  },
  "description": "A superb collection of fine gifts and clothing to accent your stay in Mexico Beach.",
  "name": "Beachwalk Beachwear & Giftware",
  "telephone": "850-648-4200"
}
*/

  //TODO : Move all model logic in model Organization
  public function actionSave() 
  {
    //email : mandotory 
    if(Yii::app()->request->isAjaxRequest && empty($_POST['organizationEmail'])) {
      Rest::json(array("result"=>false, "msg"=>"Vous devez remplir un email."));
      return;
    } else {
      //validate Email
      $email = $_POST['organizationEmail'];
      if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) { 
        Rest::json(array("result"=>false, "msg"=>"Vous devez remplir un email valide."));
        return;
      }
    }
    
    // Is There a association with the same name ?
    $organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS,array( "name" => $_POST['organizationName']));      
    if($organization) { 
      Rest::json(array("result"=>false, "msg"=>"Cette Organisation existe déjà."));
      return;
    }
       
    $newOrganization = array(
      'email'=>$email,
			"name" => $_POST['organizationName'],
      'created' => time(),
      'owner' => Yii::app()->session["userEmail"]
    );

    $newOrganization["type"] = $_POST['type'];
                  
    if(!empty($_POST['postalCode'])) {
       $newOrganization["address"] = array(
         "postalCode"=> $_POST['postalCode'],
         "addressCountry"=> $_POST['organizationCountry']
       );
    } 
                  
    if (!empty($_POST['description']))
      $newOrganization["description"] = $_POST['description'];
                  
    //Tags
    $newOrganization["tags"] = explode(",", $_POST['tagsOrganization']);
    
    //Save the organization
    echo Organization::save($newOrganization, Yii::app()->session["userId"] );
	}

  public function actionGetNames() 
    {
       $assos = array();
       foreach( PHDB::find( PHType::TYPE_ORGANIZATIONS, array("name" => new MongoRegex("/".$_GET["typed"]."/i") ),array("name","cp") )  as $a=>$v)
           $assos[] = array("name"=>$v["name"],"cp"=>$v["cp"],"id"=>$a);
       header('Content-Type: application/json');
       echo json_encode( array( "names"=>$assos ) ) ;
	}
	/**
	 * Delete an entry from the group table using the id
	 */
  public function actionDelete() 
  {
    $result = array("result"=>false, "msg"=>"Cette requete ne peut aboutir.");
	  if(Yii::app()->session["userId"])
		{
    
      $account = PHDB::findOne( PHType::TYPE_ORGANIZATIONS,array("_id"=>new MongoId($_POST["id"])));
      if( $account && Yii::app()->session["userEmail"] == $account['ph:owner'])
      {
        
        PHDB::remove( PHType::TYPE_ORGANIZATIONS,array("_id"=>new MongoId($_POST["id"])));
        //temporary for dev
        //TODO : Remove the association from all Ci accounts
        PHDB::update( PHType::TYPE_CITOYEN,array( "_id" => new MongoId(Yii::app()->session["userId"]) ) , array('$pull' => array("associations"=>new MongoId( $_POST["id"]))));
        
        $result = array("result"=>true,"msg"=>"Donnée enregistrée.");

      }
	  }
    echo Rest::json($result);
  }

  public function actionAddmembers()
  {
      $this->renderPartial("addMembers");
  }

  /**
   * 
   * Enter description here ...
   * @param  $event
   * @param  $type : participants, organisateurs, projects,jurys,coaches
   */
  public function isParticipant($event,$type){
      return in_array( new MongoId(Yii::app()->session["userId"]) , $event[$type] );
  }
    public function isParticipantEmail($event,$type){
      return in_array( Yii::app()->session["userEmail"] , $event[$type] );
  }
  
    public function checkParticipation($event){
      $res = false; 
      foreach ($event["participantTypes"] as $t){
          $res = self::isParticipant($event,$t);
          if($res)break;
      }
      return $res;
  }
  
    public function actionKey($id) {
      $this->layout = "swe";
      $group = Yii::app()->mongodb->groups->findOne(array("key"=>$id)); 
      $this->secure = $group['private'];
      $this->appKey = $group['_id'];
      $this->appType = 'group';
      // for this event that is private 
      // user must be loggued 
      // and exist in the event user particpant list
      if ( !isset(Yii::app()->session["userId"]) || !is_array(Yii::app()->session["loggedIn"]) || !in_array($group["_id"],Yii::app()->session["loggedIn"]) || !( self::checkParticipation($group) )) 
          $this->render("/swe/sweLogin",array("title"=>$group["name"]));
      else {
          $sweThings = Yii::app()->mongodb->startupweekend->find(array('events'=> new MongoId( $group["_id"] ) )); 
          $sweThings->sort(array('name' => 1));
          $user = Yii::app()->mongodb->startupweekend->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))); 
          $this->render("/swe/swegraph",array("sweThings"=>$sweThings,
                             "user"=>$user,
                             "event"=>$group,
                             "key"=>$id));
      }
  }
  /**
   * ajax called method to save a new participant user to a group
   */
  public function actionSaveParticipant(){
      $res = array("result"=>false,"content"=>"Votre ne peut aboutir");
      if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
    {
          //test if group exist
           $group = (isset($_POST["id"])) ? Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($_POST["id"]))) : null; 
           if($group){
              //check citizen exist by email 
              if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['email'])) { 
                $account = Yii::app()->mongodb->citoyens->findOne(array("email"=>$_POST['email']));
                if( !$account ){
                    //create an entry in the citoyens colelction
                
                        $account = array(
                                    'name'=>$_POST['name'],
                              'email'=>$_POST['email'],
                                    'invitedBy'=>Yii::app()->session["userId"],
                                    'tobeactivated' => true,
                                    'adminNotified' => false,
                                    'created' => time(),
                                    'type'=>'citoyen'
                                    );
                      
                        Yii::app()->mongodb->citoyens->insert($account);
                        
                        //TODO : background send email 
                        //send validation mail
                        //TODO : make emails as cron jobs
                        /*$message = new YiiMailMessage;
                        $message->view = 'invitation';
                        $name = (isset($sponsor["name"])) ? "par ".$sponsor["name"] : "par ".$sponsor["email"];
                        $message->setSubject('Invitation au projet Pixel Humain '.$name);
                        $message->setBody(array("user"=>$account["_id"],
                                                "sponsorName"=>$name), 'text/html');
                        $message->addTo("oceatoon@gmail.com");//$_POST['inviteEmail']
                        $message->from = Yii::app()->params['adminEmail'];
                        Yii::app()->mail->send($message);*/
                        
                        //TODO : add an admin notification
                        Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_INVITATION,
                                                 "user"=>Yii::app()->session["userId"],
                                                 "invited"=>$account["_id"]));
                }
                
                if(isset($_POST["id"]) && isset($_POST["collection"]) && isset($_POST["role"]) )
                {
                    //push the citoyen id into the $subContainer array(defaults : particpant) 
                    Yii::app()->mongodb->selectCollection($_POST["collection"])->update(array("_id" => new MongoId($_POST["id"])), 
                                                                                        array('$push' => array($_POST["role"]."s" => new MongoId($account["_id"]))));
                }
                
                $res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
            }
           }
    } 
    echo json_encode( $res );  
  }
}