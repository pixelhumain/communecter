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

      if(!Yii::app()->session["userId"])
        $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));
      else  
		  return parent::beforeAction($action);
  	}

    /**
     * Home page
     */
	public function actionIndex() 
	{
	//Redirect to the dashboard of the user
	$this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/dashboard"));
	$detect = new Mobile_Detect;
	$isMobile = $detect->isMobile();

	if($isMobile) 
		$this->render("indexMob");
	else 
		$this->render("index");      
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
    public function actionView($page) 
    {
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

      $person = Person::getPublicData($id);
      $params = array( );
      
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
          //array_push($events, $value);
        }
      }
      
      //TODO - SBAR : Pour le dashboard person, affiche t-on les événements des associations dont je suis memebre ?
      //Get the organization where i am member of;
      $organizations = array();
      if( isset($person["links"]) && isset($person["links"]["memberOf"])) {

          foreach ($person["links"]["memberOf"] as $key => $member) {
              $organization;
              if( $member['type'] == Organization::COLLECTION )
              {
                  $organization = Organization::getPublicData( $key );
                  $profil = Document::getLastImageByKey($key, Organization::COLLECTION, Document::IMG_PROFIL);
          if($profil !="")
            $organization["imagePath"]= $profil;

                  array_push($organizations, $organization );
              }

            if(isset($organization["links"]["events"])){
              foreach ($organization["links"]["events"] as $keyEv => $valueEv) {
                $event = Event::getPublicData($keyEv);
                $events[$keyEv] = $event;
                //array_push($events, $event);
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
              if( $member['type'] == Person::COLLECTION )
              {
                $citoyen = Person::getPublicData( $key );
                $profil = Document::getLastImageByKey($key, Person::COLLECTION, Document::IMG_PROFIL);
          if($profil !="")
            $citoyen["imagePath"]= $profil;
                array_push($people, $citoyen);
              }
        }

      }

      $cleanEvents = array();
      foreach($events as $key => $event){
        array_push($cleanEvents, $event);
      }
      var_dump($params); 
      $params["organizations"] = $organizations;
      $params["projects"] = $projects;
      $params["events"] = $cleanEvents;
      $params["people"] = $people;
      
      $page = "directory";
      if(Yii::app()->request->isAjaxRequest){
        echo $this->renderPartial($page, null,true);
      }
      else {
        $this->sidebar2 = Menu::$infoMenu;
        $this->render($page);
      }
    }
}