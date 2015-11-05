<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class DefaultController extends CommunecterController {

    
    protected function beforeAction($action)
  	{

      parent::initPage();

      /*if(!Yii::app()->session["userId"])
        $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));
      else  */
		  return parent::beforeAction($action);
  	}

    /**
     * Home page
     */
	public function actionIndex() 
	{
        $this->layout = "//layouts/mainSimple";

         $params = array();
        if( isset( Yii::app()->session['userId']) )
        {
          //get The person Id
          $id = Yii::app()->session["userId"];

          /* **************************************
          *  PERSON
          ***************************************** */
          $person = Person::getPublicData($id);

          $this->title = ((isset($person["name"])) ? $person["name"] : "")."'s Directory";
          $this->subTitle = (isset($person["description"])) ? $person["description"] : "";
          $this->pageTitle = ucfirst($this->module->id)." - ".$this->title;

          /* **************************************
          *  EVENTS
          ***************************************** */
          $events = Authorisation::listEventsIamAdminOf($id);
          $eventsAttending = Event::listEventAttending($id);
          foreach ($eventsAttending as $key => $value) {
            $eventId = (string)$value["_id"];
            if(!isset($events[$eventId])){
              $events[$eventId] = $value;
            }
          }

          //TODO - SBAR : Pour le dashboard person, affiche t-on les événements des associations dont je suis memebre ?
          //Get the organization where i am member of;

          /* **************************************
          *  ORGANIZATIONS
          ***************************************** */
          $organizations = array();
          if( isset($person["links"]) && isset($person["links"]["memberOf"])) 
          {
            
              foreach ($person["links"]["memberOf"] as $key => $member) 
              {
                  $organization;
                  if( $member['type'] == Organization::COLLECTION )
                  {
                      $organization = Organization::getPublicData( $key );
                      $profil = Document::getLastImageByKey($key, Organization::COLLECTION, Document::IMG_PROFIL);
                      if($profil !="")
                        $organization["imagePath"]= $profil;
                      array_push($organizations, $organization );
                  }
             
                if(isset($organization["links"]["events"]))
                {
                  foreach ($organization["links"]["events"] as $keyEv => $valueEv) 
                  {
                    $event = Event::getPublicData($keyEv);
                    $profil = Document::getLastImageByKey( $keyEv, Event::COLLECTION, Document::IMG_PROFIL );
                    if($profil !="")
                        $event["imagePath"]= $profil;
                    $events[$keyEv] = $event; 
                  }
                }
              }        
              //$randomOrganizationId = array_rand($subOrganizationIds);
              //$randomOrganization = Organization::getById( $subOrganizationIds[$randomOrganizationId] );
              //$params["randomOrganization"] = $randomOrganization;
              
          }

          /* **************************************
          *  PEOPLE
          ***************************************** */
          $people = array();
          if( isset( $person["links"] ) && isset( $person["links"]["knows"] )) {
            foreach ( $person["links"]["knows"] as $key => $member ) {
                  if( $member['type'] == Person::COLLECTION )
                  {
                    $citoyen = Person::getPublicData( $key );
                    $profil = Document::getLastImageByKey( $key, Person::COLLECTION, Document::IMG_PROFIL );
                    if($profil !="" )
                        $citoyen["imagePath"]= $profil;
                    array_push( $people, $citoyen );
                  }
            }
          }

          /* **************************************
          *  PROJECTS
          ***************************************** */
          $projects = array();
          if(isset($person["links"]["projects"])){
            foreach ($person["links"]["projects"] as $key => $value) {
              $project = Project::getPublicData($key);
              array_push( $projects, $project );
            }
          }
          $params["person"]= $person;
          $params["organizations"] = $organizations;
          $params["projects"] = $projects;
          $params["events"] = $events;
          $params["people"] = $people;
        }

        $this->render("index",$params);      
    }

public function actionSimple() 
  {
        $this->layout = "//layouts/mainSimple";

         $params = array();
        
          //get The person Id
          $id = Yii::app()->session["userId"];

          /* **************************************
          *  PERSON
          ***************************************** */
          $person = Person::getPublicData($id);

          $this->title = ((isset($person["name"])) ? $person["name"] : "")."'s Directory";
          $this->subTitle = (isset($person["description"])) ? $person["description"] : "";
          $this->pageTitle = ucfirst($this->module->id)." - ".$this->title;

          /* **************************************
          *  EVENTS
          ***************************************** */
          $events = Authorisation::listEventsIamAdminOf($id);
          $eventsAttending = Event::listEventAttending($id);
          foreach ($eventsAttending as $key => $value) {
            $eventId = (string)$value["_id"];
            if(!isset($events[$eventId])){
              $events[$eventId] = $value;
            }
          }

          //TODO - SBAR : Pour le dashboard person, affiche t-on les événements des associations dont je suis memebre ?
          //Get the organization where i am member of;

          /* **************************************
          *  ORGANIZATIONS
          ***************************************** */
          $organizations = array();
          if( isset($person["links"]) && isset($person["links"]["memberOf"])) 
          {
            
              foreach ($person["links"]["memberOf"] as $key => $member) 
              {
                  $organization;
                  if( $member['type'] == Organization::COLLECTION )
                  {
                      $organization = Organization::getPublicData( $key );
                      $profil = Document::getLastImageByKey($key, Organization::COLLECTION, Document::IMG_PROFIL);
                      if($profil !="")
                        $organization["imagePath"]= $profil;
                      array_push($organizations, $organization );
                  }
             
                if(isset($organization["links"]["events"]))
                {
                  foreach ($organization["links"]["events"] as $keyEv => $valueEv) 
                  {
                    $event = Event::getPublicData($keyEv);
                    $profil = Document::getLastImageByKey( $keyEv, Event::COLLECTION, Document::IMG_PROFIL );
                    if($profil !="")
                        $event["imagePath"]= $profil;
                    $events[$keyEv] = $event; 
                  }
                }
              }        
              //$randomOrganizationId = array_rand($subOrganizationIds);
              //$randomOrganization = Organization::getById( $subOrganizationIds[$randomOrganizationId] );
              //$params["randomOrganization"] = $randomOrganization;
              
          }

          /* **************************************
          *  PEOPLE
          ***************************************** */
          $people = array();
          if( isset( $person["links"] ) && isset( $person["links"]["knows"] )) {
            foreach ( $person["links"]["knows"] as $key => $member ) {
                  if( $member['type'] == Person::COLLECTION )
                  {
                    $citoyen = Person::getPublicData( $key );
                    $profil = Document::getLastImageByKey( $key, Person::COLLECTION, Document::IMG_PROFIL );
                    if($profil !="" )
                        $citoyen["imagePath"]= $profil;
                    array_push( $people, $citoyen );
                  }
            }
          }

          /* **************************************
          *  PROJECTS
          ***************************************** */
          $projects = array();
          if(isset($person["links"]["projects"])){
            foreach ($person["links"]["projects"] as $key => $value) {
              $project = Project::getPublicData($key);
              array_push( $projects, $project );
            }
          }
          $params["person"]= $person;
          $params["organizations"] = $organizations;
          $params["projects"] = $projects;
          $params["events"] = $events;
          $params["people"] = $people;

        $this->render("index",$params);      
    }
    public function actionAbout() 
    {
        $this->title = "About";
        $this->subTitle = "Building commons for the people by the people";
        $this->pageTitle = "Communecter, se connecter à sa commune";
          
        //$this->sidebar2 = Menu::$infoMenu;

        $detect = new Mobile_Detect;
        $isMobile = $detect->isMobile();

        if($isMobile) 
            $this->render("aboutMob");
        else 
            $this->render("about");
    }
    public function actionHelp() 
    {
      $this->title = "Help Us Make it Happen";
      $this->subTitle = "se connecter à sa commune";
      $this->pageTitle = "Communecter, se connecter à sa commune";
      
      $detect = new Mobile_Detect;
      $isMobile = $detect->isMobile();
      
      if($isMobile) {
        $this->render("aboutMob");
      }
      else {
        $this->render("help");
      }
      
    }
    public function actionView($page,$dir=null) 
    {
      if(@$dir)
        $page = $dir."/".$page;
      if(Yii::app()->request->isAjaxRequest){
        $this->layout = "//layouts/empty";
        echo $this->renderPartial($page, null,true);
      }
      else {
        //$this->sidebar2 = Menu::$infoMenu;
        $this->render($page);
      }
      
    }
  public function actionContact() 
    {
      $this->title = "Contact us";
      $this->subTitle = "se connecter à sa commune";
      $this->pageTitle = "Communecter, se connecter à sa commune";
      
      $detect = new Mobile_Detect;
      $isMobile = $detect->isMobile();
      
      if($isMobile) {
        $this->render("contactusMob");
      }
      else {
        $this->render("contact");
      }
      
    }

    public function actionDirectory($type=null,$id=null) 
    {
      if( $type == "person" && !$id )
        $id = Yii::app()->session['userId'];

      $url = $type."/directory/id/".$id;
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/".$url));
    }
}