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
  const moduleTitle = "Organization";
    
	

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
    
    $groups = PHDB::find( PHType::TYPE_GROUPS,$params);
    
    
    $detect = new Mobile_Detect;
    $isMobile = $detect->isMobile();
    if($isMobile) 
	$this->layout = "//layouts/mainSimple";
    
    
    $this->render("index",array("groups"=>$groups));
  }
	
	
  public function actionTags($type=null)
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
     $params =  array("tags"=>$type);
    
    $groups = PHDB::find( PHType::TYPE_GROUPS,$params);
    $this->render("index",array("groups"=>$groups));
  }
    
    

  public function actionView($id) 
  {
    $organization = PHDB::findOne( PHType::TYPE_GROUPS,array("_id"=>new MongoId($id)));
    $this->title = $organization["name"];
    $this->subTitle = (isset($organization["description"])) ? $organization["description"] : "Type ".$organization["type"];
    $this->pageTitle = "Organization : Association, Entreprises, Groupes locales";
    if(isset($asso["key"]) )
        $this->redirect(Yii::app()->createUrl('organization/'.$asso["key"]));
    else    
      $this->render("view",array('organization'=>$organization));
	}

  public function actionForm($type=null,$id=null) 
  {
      $organization = null;
      if(isset($id)){
        $organization = PHDB::findOne( PHType::TYPE_GROUPS,array("_id"=>new MongoId($id)));
        //make sure conected user is the owner
        if( $organization["email"] != Yii::app()->session["userEmail"] || ( isset($organization["ph:owner"]) && $organization["ph:owner"] != Yii::app()->session["userEmail"] ) ) {
          $organization = null;
        }
          
      }
      $types = PHDB::findOne ( PHType::TYPE_LISTS,array("name"=>"organisationTypes"), array('list'));
      $tags = PHDB::findOne ( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));
      
      $detect = new Mobile_Detect;
      $isMobile = $detect->isMobile();
      
      $params = array( "organization" => $organization,'type'=>$type,'types'=>$types['list'],'tags'=>json_encode($tags['list']));
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

"@context": "http://schema.org",
  "@type": "NGO",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Paris, France",
    "postalCode": "F-75002",
    "streetAddress": "38 avenue de l'Opera"
  },
  "email": "secretariat(at)google.org",
  "faxNumber": "( 33 1) 42 68 53 01",
  "member": [
    {
      "@type": "Organization"
    },
    {
      "@type": "Organization"
    }
  ],
  "name": "Google.org (GOOG)",
  "telephone": "( 33 1) 42 68 53 00"
  }
   */
  public function actionSave() 
  {
	    if(Yii::app()->request->isAjaxRequest && isset($_POST['assoEmail']) && !empty($_POST['assoEmail']))
		{
            $account = PHDB::findOne( PHType::TYPE_GROUPS,array( "name" => $_POST['assoName']));
            if(!$account)
            { 
               //validate isEmail
               $email = $_POST['assoEmail'];
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) { 
 
                    $newAccount = array(
                      "@context"=> array(
                        "@vocab"=>"http://schema.org",
                        "ph"=>"http://pixelhumain.com/ph/ontology/",
                			),
                      'email'=>$email,
                			"name" => $_POST['assoName'],
                      "type" => $_POST['type'],
                      'ph:created' => time(),
                      'ph:owner' => Yii::app()->session["userEmail"]
                    );

                    if($_POST['type'] == "association")
                      $newAccount["@type"] = "NGO";
                    elseif ($_POST['type'] == "entreprise") 
                      $newAccount["@type"] = "LocalBusiness";
                    else 
                      $newAccount["@type"] = "Organization";
                    
                    if(!empty($_POST['assoCP']))
                    {
                         $newAccount["cp"] = $_POST['assoCP'];
                         $newAccount["address"] = array(
                         "@type"=>"PostalAddress",
                         "postalCode"=> $_POST['assoCP'],
                         "addressLocality"=> $_POST['countryAsso']);
                    }
                    if(!empty($_POST['description']))
                      $newAccount["description"] = $_POST['description'];
                    
                    //TODO : admin can create association for other people 
                       
                    //if($_POST['assoPosition']==Association::$positionList[0]) //"Membre"
                    $newAccount["membres"] = array(Yii::app()->session["userId"]);
                    /*else if($_POST['assoPosition']==Association::$positionList[4]) //"Secrétaire"
                        $newAccount["conseilAdministration"] = $position;
                    else if(in_array($_POST['assoPosition'], array(Association::$positionList[1],Association::$positionList[2],Association::$positionList[3])))
                        $newAccount["bureau"] = $position;
                    else if($_POST['assoPosition']==Association::$positionList[5])
                        $newAccount["benevolesActif"] = $position;
                    */
                    //save any inexistant tag to DB 
                    if( !empty($_POST['tagsAsso']) ){
                      $tagsList = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));
                      foreach( explode(",", $_POST['tagsAsso']) as $tag)
                      {
                        if(!in_array($tag, $tagsList['list']))
                          PHDB::update( PHType::TYPE_LISTS,array("name"=>"tags"), array('$push' => array("list"=>$tag)));
                      }
                      $newAccount["tags"] = $_POST['tagsAsso'];
                    }
                    if(!isset($_POST['AssoId']))
                      PHDB::insert( PHType::TYPE_GROUPS,$newAccount);
                    else {
                        //if there's an email change 
                        PHDB::update( PHType::TYPE_GROUPS,array("_id" => new MongoId($_POST['AssoId'])), 
                                                            array('$set' => $newAccount ) 
                                                          );
                    }
                    //add the association to the users association list
                    $where = array("_id" => new MongoId(Yii::app()->session["userId"]));	
                    PHDB::update( PHType::TYPE_CITOYEN,$where, array('$push' => array("associations"=>$newAccount["_id"])));
                  
                    
                    //send validation mail
                    //TODO : make emails as cron jobs
                    /*$message = new YiiMailMessage;
                    $message->view = 'validation';
                    $message->setSubject('Confirmer votre compte Pixel Humain');
                    $message->setBody(array("user"=>$newAccount["_id"]), 'text/html');
                    $message->addTo("oceatoon@gmail.com");//$_POST['registerEmail']
                    $message->from = Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);*/
                    
                    //TODO : add an admin notification
                    Notification::saveNotification(array("type"=>"Saved",
                    						"user"=>$newAccount["_id"]));
                    
                    echo json_encode(array("result"=>true, "msg"=>"Votre association est communecté.", "id"=>$newAccount["_id"]));
               } else
                   echo json_encode(array("result"=>false, "msg"=>"Vous devez remplir un email valide."));
            } else
                   echo json_encode(array("result"=>false, "msg"=>"Cette Association existe déjà."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}

  public function actionGetNames() 
    {
       $assos = array();
       foreach( PHDB::find( PHType::TYPE_GROUPS, array("name" => new MongoRegex("/".$_GET["typed"]."/i") ),array("name","cp") )  as $a=>$v)
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
    
      $account = PHDB::findOne( PHType::TYPE_GROUPS,array("_id"=>new MongoId($_POST["id"])));
      if( $account && Yii::app()->session["userEmail"] == $account['ph:owner'])
      {
        
        PHDB::remove( PHType::TYPE_GROUPS,array("_id"=>new MongoId($_POST["id"])));
        //temporary for dev
        //TODO : Remove the association from all Ci accounts
        PHDB::update( PHType::TYPE_CITOYEN,array( "_id" => new MongoId(Yii::app()->session["userId"]) ) , array('$pull' => array("associations"=>new MongoId( $_POST["id"]))));
        
        $result = array("result"=>true,"msg"=>"Donnée enregistrée.");

      }
	  }
    echo Rest::json($result);
  }

}