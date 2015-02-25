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

  public function actionAddmembers($id)
  {
    $organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS,array("_id"=>new MongoId($id)) );
    $this->renderPartial( "addMembers" , array( "organization" => $organization ));
  }

  /**
   * ajax called method to save a new participant user to a group
   */
  public function actionSaveMember(){
    $res = array( "result" => false , "content" => "Something went wrong" );
    if(Yii::app()->request->isAjaxRequest && isset( $_POST["parentOrganisation"]) ) 
    {
          //test if group exist
           $organization = (isset($_POST["parentOrganisation"])) ? PHDB::findOne( PHType::TYPE_ORGANIZATIONS,array("_id"=>new MongoId($_POST["parentOrganisation"]))) : null; 
           if($organization)
           {
                //check citizen exist by email 
                if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['memberEmail'])) 
                { 
                    $account = PHDB::findOne( PHType::TYPE_CITOYEN , array("email"=>$_POST['memberEmail']));
                    if( !$account )
                    {
                          //create an entry in the citoyens colelction
                          $account = array(
                            'name'=>$_POST['memberName'],
                            'email'=>$_POST['memberEmail'],
                            'invitedBy'=>Yii::app()->session["userId"],
                            'tobeactivated' => true,
                            'created' => time(),
                            'type'=>'citoyen',
                            'memberOf'=>array( $_POST["parentOrganisation"] )
                          );
                        
                          PHDB::insert( PHType::TYPE_CITOYEN , $account );
                          
                          //add the member into the organization map
                          PHDB::update( PHType::TYPE_ORGANIZATIONS , 
                                        array("_id" => new MongoId($_POST["parentOrganisation"])) , 
                                        array('$push' => array( "members" => (string)$account["_id"] ) ));
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
                    else 
                    {   
                        //person exists with this email 
                        if( in_array( $account["_id"], $organization["members"] ) )
                            $res = array( "result" => false , "content" => "member allready exists" );
                        else {

                            PHDB::update( PHType::TYPE_CITOYEN , 
                                          array( "email" => $_POST['memberEmail']) , 
                                          array('$push' => array( "memberOf" => $_POST["parentOrganisation"] ) ));

                            PHDB::update( PHType::TYPE_ORGANIZATIONS , 
                                          array("_id" => new MongoId($_POST["parentOrganisation"])) , 
                                          array('$push' => array( "members" => (string)$account["_id"] ) ));
                        }
                    }
                  
                  $res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
              } else
                $res = array( "result" => false , "content" => "email must be valid" );
           }
    } 
    echo json_encode( $res );  
  }
}