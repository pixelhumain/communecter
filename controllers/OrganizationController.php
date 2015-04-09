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


  public function actionGetById($id=null)
  {
  	$organizations = Organization::getById($id);
  	Rest::json($organizations);
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
    
    $organizations = PHDB::find( Organization::COLLECTION,$params);
    
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
    
    $organizations = PHDB::find( Organization::COLLECTION,$params);
    $this->render("index",array("organizations"=>$organizations));
  }
    
    

  public function actionEdit($id) 
  {
    $organization = Organization::getById($id);
    $members = array();
    $followers = array();
    $memberOf = array();

    //Load members
    $organizationMembers = Organization::getMembersByOrganizationId($id);
    $i = 0;
    if (isset($organizationMembers)) {
      foreach ($organizationMembers as $id => $e) {
      		$i = $i + 1;
          if ($e["type"] == PHType::TYPE_CITOYEN) {
            $member = Person::getById($id);
          } else if ($e["type"] == Organization::COLLECTION) {
            $member = Organization::getById($id);
          }
          if (!empty($member)) array_push($members, $member);
        }
        //$members = array_push($members, $i);
    }

    //Load followers
    if (isset($organization["links"]) && !empty($organization["links"]["knows"])) {
    	foreach ($organization["links"]["knows"] as $id => $e) {
      		if($e["type"] == PHType::TYPE_CITOYEN){
              $follower = Person::getById($id);
            } else if($e["type"] == Organization::COLLECTION) {
              $follower = Organization::getById($id);
            }
            if (!empty($follower)) array_push($followers, $follower);
      	}	
    }

    //Load memberOf
    if (isset($organization["links"]) && !empty($organization["links"]["memberOf"])) {
      foreach ($organization["links"]["memberOf"] as $id => $e) {
          if($e["type"] == PHType::TYPE_CITOYEN){
              $aMemberOf = Person::getById($id);
            } else if($e["type"] == Organization::COLLECTION) {
              $aMemberOf = Organization::getById($id);
            }
            if (!empty($aMemberOf)) array_push($memberOf, $aMemberOf);
        } 
    }
    
    $this->title = $organization["name"];
    $this->subTitle = (isset($organization["description"])) ? $organization["description"] : ( (isset($organization["type"])) ? "Type ".$organization["type"] : "");
    $this->pageTitle = "Organization : Association, Entreprises, Groupes locales";

    $types = PHDB::findOne ( PHType::TYPE_LISTS,array("name"=>"organisationTypes"), array('list'));
    
    $tags = Tags::getActiveTags();

    $this->render("edit",
      array('organization'=>$organization, 'members'=>$members,
            'followers' => $followers, 'memberOf' => $memberOf,
            'types'=>$types['list'],'tags'=>json_encode($tags)));

	}

  public function actionForm($type=null,$id=null) 
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
    	  $this->render( "formMobile" , $params );
      }
      else {
	       $this->renderPartial( "form" , $params );
      }
	
  }

  /**
   * Save a new organization with the minimal information
   * @return an array with result and message json encoded
   */
  public function actionSaveNew() {
    // Retrieve data from form
    try {
      $newOrganization = $this->populateNewOrganizationFromPost();
    } catch (CommunecterException $e) {
      return Rest::json(array("result"=>false, "msg"=>$e->getMessage()));
    }
    
    //Save the organization
    return Organization::insert($newOrganization, Yii::app()->session["userId"] );;
	}

  /**
   * Update an existing organization
   * @return an array with result and message json encoded
   */
  public function actionSave() {
    // Minimal data
    try {
      $organization = $this->populateNewOrganizationFromPost();
    } catch (CommunecterException $e) {
      return Rest::json(array("result"=>false, "msg"=>$e->getMessage()));
    }

    if (! isset($_POST["organizationId"])) 
      throw new CommunecterException("You must specify an organization Id to update");
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

    //Save the organization
    echo Organization::update($organizationId, $organization, Yii::app()->session["userId"] );
  }

  public function actionSaveFields() {
    // Minimal data
    
    if (! isset($_POST["id"])) 
      throw new CommunecterException("You must specify an organization Id to update");
    else 
      $organizationId = $_POST['id'];
    
    $organizationFields = array();

    if(isset($_POST['description']))
      $organizationFields['description'] = $_POST['description'];

    //Save the organization
    echo Organization::update($organizationId, $organizationFields , Yii::app()->session["userId"] );
  }

  /**
  * Create and return new array with all the mandatory fields
  * @return array as organization
  */
  private function populateNewOrganizationFromPost() {
    //email : mandotory 
    if(Yii::app()->request->isAjaxRequest && empty($_POST['organizationEmail'])) {
      throw new CommunecterException("Vous devez remplir un email.");
    } else {
      //validate Email
      $email = $_POST['organizationEmail'];
      if (! preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) { 
        throw new CommunecterException("Vous devez remplir un email valide.");
      }
    }
       
    $newOrganization = array(
      'email'=>$email,
      "name" => $_POST['organizationName'],
      'created' => time()
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
    if (gettype($_POST['tagsOrganization']) == "array") {
      $tags = $_POST['tagsOrganization'];
    } else if (gettype($_POST['tagsOrganization']) == "string") {
      $tags = explode(",", $_POST['tagsOrganization']);
    }
    $newOrganization["tags"] = $tags;

    return $newOrganization;
  }

  public function actionGetNames() 
    {
       $assos = array();
       foreach( PHDB::find( Organization::COLLECTION, array("name" => new MongoRegex("/".$_GET["typed"]."/i") ),array("name","cp") )  as $a=>$v)
           $assos[] = array("name"=>$v["name"],"cp"=>$v["cp"],"id"=>$a);
       header('Content-Type: application/json');
       echo json_encode( array( "names"=>$assos ) ) ;
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
    echo Rest::json($result);
  }

  public function actionPublic($id){
    //get The organization Id
    if (empty($id)) {
      throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
    }

    $organization = Organization::getPublicData($id);
    
    $this->title = (isset($organization["name"])) ? $organization["name"] : "";
    $this->subTitle = (isset($organization["description"])) ? $organization["description"] : "";
    $this->pageTitle = "Communecter - Informations publiques de ".$this->title;


    $this->render("public", array("organization" => $organization));
  }


  public function actionSaveMember(){
	 $res = array( "result" => false , "content" => "Something went wrong" );
	 if(Yii::app()->request->isAjaxRequest && isset( $_POST["parentOrganisation"]) )
	 {
    
    $isAdmin = false;
    if (isset($_POST["memberIsAdmin"])) {
      $isAdmin = $_POST["memberIsAdmin"];
      if($isAdmin == "true"){
      	$isAdmin = true;
      }else if($isAdmin=="false"){
      	$isAdmin = false;
      }
    }
	 	//test if organization exists
		if (isset($_POST["parentOrganisation"])) {
      $organization = Organization::getById($_POST["parentOrganisation"]);
    }

		if($organization)
		{

			$memberEmail = $_POST['memberEmail'];

			if($_POST['memberType'] == "persons"){
				$memberType = PHType::TYPE_CITOYEN;
			}else{
				$memberType = Organization::COLLECTION;
			}
			if(isset($_POST["memberId"]) && $_POST["memberId"] != ""){
				$memberEmailObject = PHDB::findOne( $memberType , array("_id" =>new MongoId($_POST["memberId"])), array("email"));
				$memberEmail = $memberEmailObject['email'];
			}
		 	//check citizen exist by email
		 	if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$memberEmail))
			{
				
				$member = PHDB::findOne( $memberType , array("email"=>$memberEmail));
				
				if( !$member )
				{
					 //create an entry in the citoyens collection
					if($_POST['memberType'] == "persons"){
					 	$member = array(
						 'name'=>$_POST['memberName'],
						 'email'=>$_POST['memberEmail'],
						 'invitedBy'=>Yii::app()->session["userId"],
						 'tobeactivated' => true,
						 'created' => time(),
						 'type'=>'citoyen',
						 'memberOf'=>array( $_POST["parentOrganisation"] )
					);
					  	Person::createAndInvite($member);
					}else{
						$member = array(
						 'name'=>$_POST['memberName'],
						 'email'=>$_POST['memberEmail'],
						 'invitedBy'=>Yii::app()->session["userId"],
						 'tobeactivated' => true,
						 'created' => time(),
						 'type'=>'Group',
						 'memberOf'=>array( $_POST["parentOrganisation"] )
						);
						Organization::createAndInvite($member);
					}

					$member = PHDB::findOne( $memberType , array("email"=>$memberEmail));
					 //add the member into the organization map
					Link::addMember($_POST["parentOrganisation"], Organization::COLLECTION, $member["_id"], $memberType, Yii::app()->session["userId"], $isAdmin );
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
					 $message>addTo("oceatoon@gmail.com");//$_POST['inviteEmail']
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
					if( isset($organization['links']["members"]) && isset( $organization['links']["members"][(string)$member["_id"]] ))

						$res = array( "result" => false , "content" => "member allready exists" );
					else {
						Link::addMember($_POST["parentOrganisation"], Organization::COLLECTION, $member["_id"], $memberType, Yii::app()->session["userId"], $isAdmin );
						$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
	
					}	
				}
			} else
			$res = array( "result" => false , "content" => "email must be valid" );
		}
	 }
	 Rest::json( $res );
 }

/* **************************************
*
*  Devrait peut etre partir dans le module organisation
*
***************************************** */
  public function actionDashboardMember($id)
  {
    //get The organization Id
    if (empty($id)) {
      throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
    }

    $organization = Organization::getPublicData($id);
    $params = array( "organization" => $organization);

    $this->sidebar1 = array(
      array('label' => "ACCUEIL", "key"=>"home","iconClass"=>"fa fa-home","href"=>"communecter/organization/dashboard/id/".$id),
      array('label' => "GRANDDIR ? KISA SA ?", "key"=>"temporary","iconClass"=>"fa fa-question-circle","href"=>"communecter/organization/dashboard/id/".$id),
      array('label' => "ANNUAIRE DU RESEAU", "key"=>"contact","iconClass"=>"fa fa-map-marker","href"=>"communecter/sig/dashboard/id/".$id),
      array('label' => "AGENDA PARTAGE", "key"=>"about","iconClass"=>"fa fa-calendar", "class"=>"show-calendar", "href" =>"#showCalendar"),
      array('label' => "EMPLOIS & FORMATION", "key"=>"temporary","iconClass"=>"fa fa-group","href"=>"communecter/job/list"),
      array('label' => "RESSOURCES", "key"=>"contact", "iconClass"=>"fa fa-folder-o","href"=>"communecter/organization/resources/id/".$id),
      array('label' => "LETTRE D'INFORMATION", "key"=>"about","iconClass"=>"fa fa-file-text-o ","href"=>"communecter/organization/infos/id/".$id),
      array('label' => "ADHERER", "key" => "temporary","iconClass"=>"fa fa-check-circle-o ","href"=>"communecter/organization/join/id/".$id),
      array('label' => "CONTACTEZ NOUS", "key"=>"contact","iconClass"=>"fa fa-envelope-o","href"=>"communecter/organization/contact/id/".$id)
    );

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

      $events = Organization::listEventsPublicAgenda($id);
      $params["events"] = $events;

		if (count($subOrganizationIds) != 0 ) {
			$randomOrganizationId = array_rand($subOrganizationIds);
			$randomOrganization = Organization::getById( $subOrganizationIds[$randomOrganizationId] );
			$params["randomOrganization"] = $randomOrganization;
		} 
		$params["members"] = $members;
    }

    $this->render( "dashboardMember", $params );
  }

  /* **************************************
   *  MEMBERS
   ***************************************** */
  public function actionJoin($id)
  {
    $params = array();
    //get The organization Id
    if (empty($id)) {
      throw new CommunecterException("The Parent organization doesn't exist !");
    }
    
    $params["parentOrganization"] = Organization::getPublicData($id);
    
    $types = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"organisationTypes"), array('list'));
    $params["types"] = $types["list"];
    
    $params["tags"] = Tags::getActiveTags();

    $this->layout = "//layouts/mainSimple";
    $this->render("join", $params);
  }

  public function actionAddNewOrganizationAsMember() {
    //Get the person data
    $newPerson = array(
           'name'=>$_POST['personName'],
           'email'=>$_POST['personEmail'],
           'postalCode'=>$_POST['postalCode'],
           'pwd'=>$_POST['password']);

    // Retrieve data from form
    try {
      $newOrganization = $this->populateNewOrganizationFromPost();
      $res = Organization::createPersonOrganizationAndAddMember($newPerson, $newOrganization, $_POST['parentOrganization']);
    } catch (CommunecterException $e) {
      return Rest::json(array("result"=>false, "msg"=>$e->getMessage()));
    }

    return Rest::json(array("result"=>true, "msg"=>"Your organization has been added with success. Check your mail box : you will recieive soon a mail from us."));
  }

/* **************************************
   *  CALENDAR
   ***************************************** */

 //Get the events for create the calendar
  public function actionGetCalendar($id){
  	$events = array();
  	$organization = Organization::getPublicData($id);
  	if(isset($organization["links"]["events"])){
  		foreach ($organization["links"]["events"] as $key => $value) {
  			$event = Event::getPublicData($key);
  			$events[$key] = $event;
  		}
  	}
  	foreach ($organization["links"]["members"] as $newId => $e) {
  		if($e["type"] == Organization::COLLECTION){
  			$member = Organization::getPublicData($newId);
  		}else{
  			$member = Person::getPublicData($newId);
  		}
  		if(isset($member["links"]["events"])){
  			foreach ($member["links"]["events"] as $key => $value) {
  				$event = Event::getPublicData($key);
  				$events[$key] = $event;	
  			}
  			
  		}
  	}
  	Rest::json($events);
  }


	 public function actionCalendar($id){
	  	 if (empty($id)) {
		      throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
		}

		$organization = Organization::getPublicData($id);
		$params = array( "organization" => $organization);
	 }


	 public function actionDashboard($id){
	 	if (empty($id)) {
	      throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
	    }

	    $organization = Organization::getPublicData($id);
	    $params = array( "organization" => $organization);

	    $this->sidebar1 = array(
	      array('label' => "ACCUEIL", "key"=>"home","iconClass"=>"fa fa-home","href"=>"communecter/organization/dashboard/id/".$id),
	      array('label' => "GRANDDIR ? KISA SA ?", "key"=>"temporary","iconClass"=>"fa fa-question-circle","href"=>"communecter/organization/dashboard/id/".$id),
	      array('label' => "ANNUAIRE DU RESEAU", "key"=>"contact","iconClass"=>"fa fa-map-marker","href"=>"communecter/sig/dashboard/id/".$id),
	      array('label' => "AGENDA PARTAGE", "key"=>"about","iconClass"=>"fa fa-calendar", "class"=>"show-calendar", "href" =>"#showCalendar"),
	      array('label' => "EMPLOIS & FORMATION", "key"=>"temporary","iconClass"=>"fa fa-group","href"=>"communecter/job/list"),
	      array('label' => "RESSOURCES", "key"=>"contact", "iconClass"=>"fa fa-folder-o","href"=>"communecter/organization/resources/id/".$id),
	      array('label' => "LETTRE D'INFORMATION", "key"=>"about","iconClass"=>"fa fa-file-text-o ","href"=>"communecter/organization/infos/id/".$id),
	      array('label' => "ADHERER", "key" => "temporary","iconClass"=>"fa fa-check-circle-o ","href"=>"communecter/organization/join/id/".$id),
	      array('label' => "CONTACTEZ NOUS", "key"=>"contact","iconClass"=>"fa fa-envelope-o","href"=>"communecter/organization/contact/id/".$id)
	    );

	    $this->title = (isset($organization["name"])) ? $organization["name"] : "";
	 	$this->render( "dashboard", $params );
	 }

   /* **************************************
   *  DOCUMENTS
   ***************************************** */

    public function actionDocuments($id) {
      $documents = Document::getWhere( array( "type" => Organization::COLLECTION , "id" => $id) );
      $this->render("documents",array("documents"=>$documents));
    }

}