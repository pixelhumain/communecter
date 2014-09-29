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
	  $this->render("index",array("groups"=>$groups));
	}

  public function actionView($id) 
  {
        $asso = PHDB::findOne( PHType::TYPE_GROUPS,array("_id"=>new MongoId($id)));
        if(isset($asso["key"]) )
            $this->redirect(Yii::app()->createUrl('assocation/'.$asso["key"]));
        else    
	        $this->render("view",array('asso'=>$asso));
	}

  public function actionForm($type) 
  {
      $asso = ( isset(Yii::app()->session["userId"]) ) ? PHDB::findOne( PHType::TYPE_GROUPS,array("_id"=>new MongoId(Yii::app()->session["userId"]))) : null;
      $types = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"organisationTypes"), array('list'));
	    $this->renderPartial( "form" , array("asso"=>$asso,'type'=>$type,'types'=>$types['list']) );
	}

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
                    			'email'=>$email,
                    			"name" => $_POST['assoName'],
                                'type'=>PHType::TYPE_ASSOCIATION ,
                                'tobeactivated' => true,
                                'adminNotified' => false,
                                'created' => time()
                                );
                                
                    if(!empty($_POST['assoCP']))
                         $newAccount["cp"] = $_POST['assoCP'];
                    //admin can create association for other people 
                    if( !Citoyen::isAdminUser() ){     
                        $position = array(new MongoId(Yii::app()->session["userId"]));
                        if($_POST['assoPosition']==Association::$positionList[0])
                            $newAccount["membres"] = $position;
                        else if($_POST['assoPosition']==Association::$positionList[4])
                            $newAccount["conseilAdministration"] = $position;
                        else if(in_array($_POST['assoPosition'], array(Association::$positionList[1],Association::$positionList[2],Association::$positionList[3])))
                            $newAccount["bureau"] = $position;
                        else if($_POST['assoPosition']==Association::$positionList[5])
                            $newAccount["benevolesActif"] = $position;
                    }
                    PHDB::insert( PHType::TYPE_GROUPS,$newAccount);
                    
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
                    Notification::saveNotification(array("type"=>NotificationType::ASSOCIATION_SAVED,
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
	    if(Yii::app()->request->isAjaxRequest && Citoyen::isAdminUser())
		{
            $account = PHDB::findOne( PHType::TYPE_GROUPS,array("_id"=>new MongoId($_POST["id"])));
            if( $account )
            {
                  PHDB::remove( PHType::TYPE_GROUPS,array("_id"=>new MongoId($_POST["id"])));
                  //temporary for dev
                  //TODO : Remove the association from all Ci accounts
                  PHDB::update( PHType::TYPE_CITOYEN,array( "_id" => new MongoId(Yii::app()->session["userId"]) ) , array('$pull' => array("associations"=>new MongoId( $_POST["id"]))));
                  $result = array("result"=>true,"msg"=>"Donnée enregistrée.");
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
}