<?php
/**
 * EventController.php
 *
 * tous ce que propose le PH en terme de gestion d'evennement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class EventController extends CommunecterController {
    const moduleTitle = "Évènement";
    
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
  }

  public function actionEdit($id) {
      //menu sidebar
      /*array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
      array_push( $this->sidebar1, array( "label"=>"Modifier", "iconClass"=>"icon-pencil-neg","onclick"=>"openModal('eventForm','group','$id','dynamicallyBuild')" ) );
      array_push( $this->sidebar1, array( "label"=>"Participant", "iconClass"=>"icon-users","onclick"=>"openModal('eventParticipantForm','group','$id','dynamicallyBuild')" ) );
      */ 
      $event = Event::getById($id);
      $citoyens = array();
      $organizations = array();
       if (isset($event["links"]["attendees"]) && !empty($event["links"]["attendees"])) 
	    {
	      foreach ($event["links"]["attendees"] as $id => $e) 
	      {
	      	
	      	if (!empty($event)) {
	      		if($e["type"] == "citoyens"){
	      			$citoyen = PHDB::findOne( PHType::TYPE_CITOYEN, array( "_id" => new MongoId($id)));
	      			array_push($citoyens, $citoyen);
	      		}else if($e["type"] == "organizations"){
	          		$organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS, array( "_id" => new MongoId($id)));
	          		array_push($organizations, $organization);
	      		}
	        } else {
	         // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
	        }  	
	      }
	    }         
      if(isset($event["key"]) )
          $this->redirect(Yii::app()->createUrl('evenement/key/id/'.$event["key"]));
      else
        $this->render("edit",array('event'=>$event, 'organizations'=>$organizations, 'citoyens'=>$citoyens));
  }
  
  public function actionPublic($id){
    //get The event Id
    if (empty($id)) {
      throw new CommunecterException("The event id is mandatory to retrieve the event !");
    }

    $event = Event::getPublicData($id);
    
    $this->title = (isset($event["name"])) ? $event["name"] : "";
    $this->subTitle = (isset($event["description"])) ? $event["description"] : "";
    $this->pageTitle = "Communecter - Informations publiques de ".$this->title;


    $this->render("public", array("event" => $event));
  }

  //**********
  // Old - Still used ?
  //**********
  public function actionIndex() {
      //array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
      $this->render("index");
  }

  public function actionCreer() {
      //array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
	    $this->render("new2");
	}
	
	public function checkParticipation($event){
	    $res = false; 
	    foreach ($event["participantTypes"] as $t){
	        $res = self::isParticipant($event,$t);
	        if($res)break;
	    }
	    return $res;
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
	
    public function actionSave() {
      if( isset($_POST['title']) && !empty($_POST['title']))
      {
        //TODO check by key
            $event = PHDB::findOne(PHType::TYPE_EVENTS,array( "name" => $_POST['title']));
            if(!$event)
            { 
               //validate isEmail
               $email = (isset($_POST['email'])) ? $_POST['email'] : Yii::app()->session["userEmail"];
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) { 
                    $res = Event::saveEvent($_POST);
                    echo json_encode($res);
               } else
                   echo json_encode(array("result"=>false, "msg"=>"Vous devez remplir un email valide."));
            } else
                   echo json_encode(array("result"=>false, "msg"=>"Cette Evenement existe déjà."));
    } else
        echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
    exit;
  }
    public function actionGetNames() {
       $assos = array();
       foreach( Yii::app()->mongodb->groups->find( array("name" => new MongoRegex("/".$_GET["typed"]."/i") ),array("name","cp") )  as $a=>$v)
           $assos[] = array("name"=>$v["name"],"cp"=>$v["cp"],"id"=>$a);
       header('Content-Type: application/json');
       echo json_encode( array( "names"=>$assos ) ) ;
	}
	/**
	 * Delete an entry from the group table using the id
	 */
    public function actionDelete() {
	    if(Yii::app()->request->isAjaxRequest && Citoyen::isAdminUser())
		{
            $account = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($_POST["id"])));
            if( $account )
            {
                  Yii::app()->mongodb->groups->remove(array("_id"=>new MongoId($_POST["id"])));
                  //temporary for dev
                  //TODO : Remove the association from all Ci accounts
                  Yii::app()->mongodb->citoyens->update( array( "_id" => new MongoId(Yii::app()->session["userId"]) ) , array('$pull' => array("associations"=>new MongoId( $_POST["id"]))));
                  $result = array("result"=>true,"msg"=>"Donnée enregistrée.");
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
  public function actionAgenda() {
    $this->render("agenda");
  }
  public function actionTimeline() {
    $this->render("timeline");
  }


  public function actionSaveAttendees(){
  	$res = array( "result" => false , "content" => "Something went wrong" );
	if(Yii::app()->request->isAjaxRequest && isset( $_POST["id"]) )
	{
		$event = (isset($_POST["id"])) ? PHDB::findOne( PHType::TYPE_EVENTS,array("_id"=>new MongoId($_POST["id"]))) : null;
	
		if($event)
		{
			$memberEmail = $_POST['email'];

			if($_POST['type'] == "persons"){
				$memberType = PHType::TYPE_CITOYEN;
			}else{
				$memberType = PHType::TYPE_ORGANIZATIONS;
			}
			if(isset($_POST["id"]) && $_POST["id"] != ""){
				$memberEmailObject = PHDB::findOne( $type , array("_id" =>new MongoId($_POST["id"])), array("email"));
				$memberEmail = $memberEmailObject['email'];
			}

			if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$memberEmail))
			{
				
				$member = PHDB::findOne($memberType, array("email"=>$_POST['email']));
				
				if( !$member )
				{
					if($_POST['type'] == "persons"){
					 $member = array(
					 'name'=>$_POST['name'],
					 'email'=>$memberEmail,
					 'invitedBy'=>Yii::app()->session["userId"],
					 'tobeactivated' => true,
					 'created' => time(),
					 'links'=>array( 'events' => array($_POST["id"] =>array("type" => $type,
					 															"tobeconfirmed" => true,
					 															"invitedBy" => Yii::app()->session["userId"]
					 														)
					 									)
					 			)
					 );
					  Person::createAndInvite($member);
					 } else {
						 $member = array(
						 'name'=>$_POST['name'],
						 'email'=>$memberEmail,
						 'invitedBy'=>Yii::app()->session["userId"],
						 'tobeactivated' => true,
						 'created' => time(),
						 'type'=>'Group',
						 'links'=>array( 'events' => array($_POST["id"] =>array("type" => $type,
					 															"tobeconfirmed" => true,
					 															"invitedBy" => Yii::app()->session["userId"]
					 														)
					 									)
					 			)
						 );

						 Organization::createAndInvite($member);
					 }

					Link::connect($_POST["id"], PHType::TYPE_EVENTS,$member["_id"], $type, Yii::app()->session["userId"], "attendees" );
					$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);

				}else{

					if( isset($event['links']["events"]) && isset( $event['links']["events"][(string)$member["_id"]] ))
						$res = array( "result" => false , "content" => "member allready exists" );
					else {
						Link::connect($member["_id"], $type, $_POST["id"], PHType::TYPE_EVENTS, Yii::app()->session["userId"], "events" );
						Link::connect($_POST["id"], PHType::TYPE_EVENTS, $member["_id"], $type, Yii::app()->session["userId"], "attendees" );
						$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
					}
				}
			}else
				$res = array( "result" => false , "content" => "email must be valid" );
		}
	}
	 Rest::json( $res );
  }
}