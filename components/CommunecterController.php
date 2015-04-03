<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CommunecterController extends Controller
{
  public $title = "Communectez";
  public $subTitle = "se connecter à sa commune";
  public $pageTitle = "Communecter, se connecter à sa commune";
  public static $moduleKey = "communecter";
  public $keywords = "connecter, réseau, sociétal, citoyen, société, regrouper, commune, communecter, social";
  public $description = "Communecter : Connecter a sa commune, reseau societal, le citoyen au centre de la société.";
  public $projectName = "";
  public $projectImage = "/images/CTK.png";
  public $projectImageL = "/images/logo.png";
  public $footerImages = array(
      array("img"=>"/images/logoORD.PNG","url"=>"http://openrd.io"),
      array("img"=>"/images/logo_region_reunion.png","url"=>"http://www.regionreunion.com"),
      array("img"=>"/images/technopole.jpg","url"=>"http://technopole-reunion.com"),
      array("img"=>"/images/Logo_Licence_Ouverte_noir_avec_texte.gif","url"=>"https://data.gouv.fr"),
      array("img"=>'/images/blog-github.png',"url"=>"https://github.com/pixelhumain/pixelhumain"),
      array("img"=>'/images/opensource.gif',"url"=>"http://opensource.org/"));

  const theme = "ph-dori";
  public $person = null;
  public $themeStyle = "theme-style11";//3,4,5,7,9

	//TODO - Faire le tri des liens
  //TODO - Les children ne s'affichent pas dans le menu
  public $sidebar1 = array(
    array('label' => "Temporaire", "key"=>"temporary","iconClass"=>"fa fa-life-bouy",
                "children"=> array(
                  "login" => array( "label"=>"Login","key"=>"login", "href"=>"/communecter/person/login"),
                  "register" => array( "label"=>"REgister","key"=>"register", "href"=>"/communecter/person/login?box=register"),
                  "profile" => array( "label"=>"Profile","key"=>"profile", "href"=>"/communecter/person/profile"),
                  "group" => array( "label"=>"Group","key"=>"group", "href"=>"/communecter/default/group"),
                  "asso" => array( "label"=>"Asso","key"=>"asso", "href"=>"/communecter/default/asso"),
                  "company" => array( "label"=>"Company","key"=>"company", "href"=>"/communecter/default/company"),
                  "listing" => array( "label"=>"Listing","key"=>"listing", "href"=>"/communecter/default/listing"),
                )
          ),
    array('label' => "About", "key"=>"about","iconClass"=>"fa fa-book","href"=>"communecter/default/about"),
    array('label' => "Help Us", "key"=>"temporary","iconClass"=>"fa fa-money","href"=>"communecter/default/help"),
    array('label' => "Contact Us", "key"=>"contact","iconClass"=>"fa fa-envelope-o","href"=>"communecter/default/contact"),
  );


  public $toolbarMenuAdd = array(
     array('label' => "My Network", "key"=>"myNetwork",
            "children"=> array(
              //"myaccount" => array( "label"=>"My Account","key"=>"newContributor", "class"=>"new-contributor", "href"=>"#newContributor", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-pencil fa-stack-1x stack-right-bottom text-danger")),
              "showContributors" => array( "label"=>"Find People","class"=>"show-contributor","key"=>"showContributors", "href"=>"#showContributors", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
              "newInvite" => array( "label"=>"Invite Someone","key"=>"invitePerson", "class"=>"new-invite", "href"=>"#newInvite", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
            )
          ),
    array('label' => "Organisation", "key"=>"organization",
            "children"=> array(
              "addOrganization" => array( "label"=>"Add an Organisation","key"=>"addOrganization", "class"=>"ajaxSV", "onclick"=>"openSubView('Add an Organisation', '/communecter/organization/form',null)", "iconStack"=>array("fa fa-group fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger"))
            )
          ),
    array('label' => "News", "key"=>"note",
                "children"=> array(
                  "createNews" 	=> array( "label"=>"Create news",	"key"=>"newNote", 	 "class"=>"ajaxSV", "onclick"=>"openSubView('Create news', '/communecter/news/formCreateNews', null)", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "newsStream" 	=> array( "label"=>"News stream",	"key"=>"newsstream", "class"=>"ajaxSV", "onclick"=>"openSubView('News stream', '/communecter/news/newsstream', null)", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
                  //"newNote"		=> array( "label"=>"Add new note",	"class"=>"new-note",	  "key"=>"newNote",  "href"=>"#newNote",  "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                 // "readNote" 	=> array( "label"=>"Read All notes","class"=>"read-all-notes","key"=>"readNote", "href"=>"#readNote", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Event", "key"=>"event",
                "children"=> array(
                  "newEvent" => array( "label"=>"Add new event","key"=>"newEvent", "class"=>"new-event", "href"=>"#newEvent", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "showCalendar" => array( "label"=>"Show calendar","class"=>"show-calendar","key"=>"showCalendar", "href"=>"#showCalendar", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Projects", "key"=>"projects",
                "children"=> array(
                  "newProject" => array( "label"=>"Add new Project","key"=>"newProject", "class"=>"new-project", "href"=>"#newProject", "iconStack"=>array("fa fa-cogs fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  )
          )
  );
  
  public $subviews = array(
    "event.eventSV",
    "person.inviteSV",
    "project.projectSV",
    "event.addAttendeesSV",
    "project.addContributorSV"
  );

  public $toolbarMenuMaps = array(
      array('label' => "Your Network", 		'desc' => "People, Organisation, Events, Projects ", 		"key"=>"yourNetwork", 	"class"=>"ajaxSV", "onclick"=>"openSubView('Your Network', 	 	'/communecter/sig/network', null)", 	'extra' => "around You",  "iconClass"=>"fa-sitemap text-dark-green"),
      array('label' => "Local Companies", 	'desc' => "Discover Companies around you", 					"key"=>"localCompanies", "class"=>"ajaxSV", "onclick"=>"openSubView('Local Companies', 	'/communecter/sig/companies', null)", 	'extra' => "around You",  "iconClass"=>"fa-building text-dark-danger"),
      array('label' => "Local State", 		'desc' => "All the city hall public services",				"key"=>"localStates", 	"class"=>"ajaxSV", "onclick"=>"openSubView('Local States', 	 	'/communecter/sig/state', null)", 		'extra' => "around You",  "iconClass"=>"fa-university text-orange"),
      array('label' => "Calendar", 		'desc' => "Discover All sorts of local events around you", 	"key"=>"localEvents", 	"class"=>"ajaxSV", "onclick"=>"openSubView('Calendar', 	 	'/communecter/sig/events', null)",  	'extra' => "around You",  "iconClass"=>"fa-calendar text-purple"),

      array('label' => "Network Viewer",    'desc' => "Visualize your network", "key" =>"networkViewer", "class"=>"ajaxSV", "onclick"=>"openSubView('Network Viewer', '/communecter/graph/viewer', null,null,function(){clearViewer();})",    'extra' => "arround You",  "iconClass"=>"fa-share-alt text-yellow"),
  );

  public $pages = array(

    "default"=> array(
      "index"=>array("href"=>"/ph/communecter"),
      "about"=>array("href"=>"/ph/communecter/default/about"),
      "help"=>array("href"=>"/ph/communecter/default/help"),
      "contact"=>array("href"=>"/ph/communecter/default/contact"),

    ),

    "search"=>array(
    	"getmemberautocomplete" => array("href" => "/ph/communecter/search/getmemberautocomplete"),
    ),
    "person"=> array(
      "index"=>array("href"=>"/ph/communecter/person",'title' => "Person"),
      "getbyid"=>array("href"=>"/ph/communecter/person/getbyid"),
      "getorganization" =>array("href"=>"/ph/communecter/person/getorganization"),
      "updatename"=>array("href"=>"/ph/communecter/person/updatename"),
      "public"=>array("href" =>"/ph/communecter/person/public"),
      "clearinitdatapeopleall"=>array("href" =>"'/ph/communecter/person/clearinitdatapeopleall'"),
      "initdatapeopleall"=>array("href" =>"'/ph/communecter/person/initdatapeopleall'"),
      "login"=>array("href"=>"/ph/communecter/person/login",'title' => "Log me In"),
      "logout"=>array("href"=>"/ph/communecter/person/logout"),
      "invitation"=>array("href"=>"/ph/communecter/person/invitation"),
      "connect"=>array("href"=>"/ph/communecter/person/connect"),
      "removememberof"=>array("href"=>"/ph/communecter/person/removememberOf"),
      "disconnect"=>array("href"=>"/ph/communecter/person/disconnect"),
      "invite"=>array("href"=>"/ph/communecter/person/invite"),
      "react"=>array("href"=>"/ph/communecter/person/react", 'title' => "ReactTest"),
      "getuserautocomplete"=> array('href' => "/person/GetUserAutoComplete"),
      'getnotification' => array("href" => "/person/GetNotification"),
      "dashboard"=>array("href"=>"/ph/communecter/person/dashboard"),
    ),

    "organization"=> array(
      "index"=> array("href" =>"ph/Communecter/organization", "title" => "Person"),
      "edit"=>array("href@"=>"/ph/communecter/edit",'title' => "Organization", "subTitle"=>"Découvrez les organization locales","pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "form"=>array("href"=>"/ph/communecter/form",'title' => "Organization", "subTitle"=>"Découvrez les organization locales","pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),      
      "savenew"=>array("href"=>"/ph/communecter/saveNew",'title' => "Organization", "subTitle"=>"Découvrez les organization locales","pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "save"=>array("href"=>"/ph/communecter/save",'title' => "Organization", "subTitle"=>"Découvrez les organization locales","pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),       
      "addmembers"=>array("href"=>"/ph/communecter/organization/addmembers"),
      "getbyid"=>array("href"=>"/ph/communecter/organization/getbyid"),
      "public"=>array("href"=>"/ph/communecter/organization/public"),
      "dashboard"=>array("href"=>"/ph/communecter/organization/dashboard"),
      "savemember"=>array("href"=>"/ph/communecter/organization/savemember"),
      "join"=>array("href"=>"/ph/communecter/organization/join"),
      "savenewaddmember"=>array("href"=>"/ph/communecter/organization/savenewaddmember"),
      "getcalendar" => array("href" => "/ph/communecter/organization/getcalendar"),  
      "savefields"=>array("href"=>"/ph/communecter/organization/savefields"),
      "calendar"=>array("href"=>"/ph/communecter/organization/calendar"),  
    ),
    
    "event"=> array(
      "edit"=>array("href"=>"/ph/communecter/event/edit"),
      "public"=>array("href"=>"/ph/communecter/event/public"),
      "save"=>array("href"=>"/ph/communecter/event/save"),
      "saveattendees"=>array("href"=>"/ph/communecter/event/saveattendees"),
      "dashboard"=>array("href"=>"/ph/communecter/person/dashboard"),
    ),

    "project"=> array(
      "edit"=>array("href"=>"/ph/communecter/project/edit"),
      "public"=>array("href"=>"/ph/communecter/project/public"),
      "save"=>array("href"=>"/ph/communecter/project/save"),
      "savecontributor"=>array("href"=>"/ph/communecter/event/savecontributor"),
      "dashboard"=>array("href"=>"/ph/communecter/project/dashboard"),

    ),

    "job"=> array(
      "edit"=>array("href"=>"/ph/communecter/job/edit"),
      "public"=>array("href"=>"/ph/communecter/job/public"),
      "save"=>array("href"=>"/ph/communecter/job/save"),
      "delete"=>array("href"=>"/ph/communecter/job/delete"),
      "list"=>array("href"=>"/ph/communecter/job/list"),
    ),
    
  );

  function initPage(){
    $this->sidebar1 = array_merge(Menu::menuItems(),$this->sidebar1);

    $this->person = Person::getPersonMap(Yii::app() ->session["userId"]);

    $page = $this->pages[Yii::app()->controller->id][Yii::app()->controller->action->id];
    $this->title = (isset($page["title"])) ? $page["title"] : $this->title;
    $this->subTitle = (isset($page["subTitle"])) ? $page["subTitle"] : $this->subTitle;
    $this->pageTitle = (isset($page["pageTitle"])) ? $page["pageTitle"] : $this->pageTitle;

    CornerDev::addWorkLog("communecter","you@dev.com",Yii::app()->controller->id,Yii::app()->controller->action->id);
  }


}
