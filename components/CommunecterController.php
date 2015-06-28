<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CommunecterController extends Controller
{
  public $version = "v0.0.3";
  public $versionDate = "27/04/2015";
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
  public $notifications = array();
	//TODO - Faire le tri des liens
  //TODO - Les children ne s'affichent pas dans le menu
 
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
              "addOrganization" => array( "label"=>"Add an Organisation","key"=>"addOrganization", "class"=>"ajaxSV", "onclick"=>"openSubView('Add an Organisation', '/communecter/organization/addorganizationform',null)", "iconStack"=>array("fa fa-group fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger"))
            )
          ),
    array('label' => "News", "key"=>"note",
                "children"=> array(
                  "createNews" 	=> array( "label"=>"Create news",	"key"=>"new-news", 	 "class"=>"new-news", "iconStack"=>array("fa fa-bullhorn fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  //"newsStream" 	=> array( "label"=>"News stream",	"key"=>"newsstream", "class"=>"ajaxSV", "onclick"=>"openSubView('News stream', '/communecter/news/newsstream', null)", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
                  //"newNote"		=> array( "label"=>"Add new note",	"class"=>"new-note",	  "key"=>"newNote",  "href"=>"#newNote",  "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                 // "readNote" 	=> array( "label"=>"Read All notes","class"=>"read-all-notes","key"=>"readNote", "href"=>"#readNote", "iconStack"=>array("fa fa-list fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Event", "key"=>"event",
                "children"=> array(
                  "newEvent" => array( "label"=>"Add new event","key"=>"newEvent", "class"=>"new-event", "href"=>"#newEvent", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "showCalendar" => array( "label"=>"Show calendar","class"=>"show-calendar","key"=>"showCalendar", "href"=>"/ph/communecter/event/calendarview", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Projects", "key"=>"projects",
                "children"=> array(
                  "newProject" => array( "label"=>"Add new Project","key"=>"newProject", "class"=>"new-project", "href"=>"#newProject", "iconStack"=>array("fa fa-cogs fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  )
          )
  );
  
  public $subviews = array(
    "news.newsSV",
    "person.inviteSV",
    "event.addAttendeesSV",
  );

  public $pages = array(

    "default"=> array(
      "index"=>array("href"=>"/ph/communecter","api"=>""),
      "about"=>array("href"=>"/ph/communecter/default/about"),
      "help"=>array("href"=>"/ph/communecter/default/help"),
      "contact"=>array("href"=>"/ph/communecter/default/contact"),
    ),

    "city"=>array(
    	"index" => array("href" => "/ph/communecter/city/index"),
    	"directory" => array("href" => "/ph/communecter/city/directory", "title"=>"City Directory", "subTitle"=>"Find Local Actors and Actions : People, Organizations, Events"),
    ),
    "news"=>array(
      "index" => array( "href" => "/ph/communecter/news/index",'title' => "Fil d'actualités - N.E.W.S", "subTitle"=>"Nord.Est.West.Sud","pageTitle"=>"Fil d'actualités - N.E.W.S"),
      "save" => array( "href" => "/ph/communecter/news/save"),
    ),
    
    "search"=>array(
    	"getmemberautocomplete" => array("href" => "/ph/communecter/search/getmemberautocomplete"),
    ),

    "person"=> array(
      "login"=>array("href"=>"/ph/communecter/person/login",'title' => "Log me In"),
      "index"=>array("href"=>"/ph/communecter/person/dashboard",'title' => "My Dashboard"),
      "authenticate"=>array("href"=>"/ph/communecter/person/authenticate",'title' => "Authentication"),
      "dashboard"=>array("href"=>"/ph/communecter/person/dashboard"),
      "connect"=>array("href"=>"/ph/communecter/person/connect"),
      "disconnect"=>array("href"=>"/ph/communecter/person/disconnect"),
      "register" => array("href" => "/ph/communecter/person/register"),
      "logout"=>array("href"=>"/ph/communecter/person/logout"),
      'getnotification' => array("href" => "/person/getNotification"),
      "invite"=>array("href"=>"/ph/communecter/person/invite"),
      "invitation"=>array("href"=>"/ph/communecter/person/invitation"),
      "updatefield" =>array("href"=>"/person/updatefield"),
      "getuserautocomplete"=> array('href' => "/person/getUserAutoComplete"),

      "getbyid"=>array("href"=>"/ph/communecter/person/getbyid"),
      "getorganization" =>array("href"=>"/ph/communecter/person/getorganization"),
      "updatename"=>array("href"=>"/ph/communecter/person/updatename"),
      
      //Init Data
      "clearinitdatapeopleall"=>array("href" =>"'/ph/communecter/person/clearinitdatapeopleall'"),
      "initdatapeopleall"=>array("href" =>"'/ph/communecter/person/initdatapeopleall'"),
      "importmydata"=>array("href" =>"'/ph/communecter/person/importmydata'"),
      "about" =>array("href"=>"/person/about"),
      "data" =>array("href"=>"/person/scopes"),
      "directory" => array("href" => "/ph/communecter/city/directory", "title"=>"My Directory", "subTitle"=>"My Network : People, Organizations, Events"),
    ),

    "organization"=> array(
      "addorganizationform"=>array("href"=>"/ph/communecter/organization/addorganizationform",'title' => "Organization", "subTitle"=>"Découvrez les organization locales","pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),      
      "savenew"=>array("href"=>"/ph/communecter/organization/saveNew",'title' => "Organization", "subTitle"=>"Découvrez les organization locales","pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "save"=>array("href"=>"/ph/communecter/organization/save",'title' => "Organization", "subTitle"=>"Découvrez les organization locales","pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),       
      "getbyid"=>array("href"=>"/ph/communecter/organization/getbyid"),
      "updatefield" =>array("href"=>"/ph/communecter/organization/updatefield"),
      "join"=>array("href"=>"/ph/communecter/organization/join"),
      "sig"=>array("href"=>"/ph/communecter/organization/sig"),
      //Links // create a Link controller ?
      "addneworganizationasmember"=>array("href"=>"/ph/communecter/organization/AddNewOrganizationAsMember"),
      //Dashboards
      "dashboard"=>array("href"=>"/ph/communecter/organization/dashboard"),  
      "dashboardmember"=>array("href"=>"/ph/communecter/organization/dashboardMember"),
      "dashboard1"=>array("href"=>"/ph/communecter/organization/dashboard1"),
    ),
    
    "event"=> array(
      "save"=>array("href"=>"/ph/communecter/event/save"),
      "saveattendees"=>array("href"=>"/ph/communecter/event/saveattendees"),
      "dashboard"=>array("href"=>"/ph/communecter/event/dashboard"),
      "delete" => array("href" => "ph/communecter/event/delete"),
      "updatefield" => array("href" => "ph/communecter/event/updatefield"),
      "calendarview" => array("href" => "ph/communecter/event/calendarview"),
      "eventsv" => array("href" => "ph/communecter/event/eventsv"),
    ),

    "project"=> array(
      "edit"=>array("href"=>"/ph/communecter/project/edit"),
      "public"=>array("href"=>"/ph/communecter/project/public"),
      "save"=>array("href"=>"/ph/communecter/project/save"),
      "savecontributor"=>array("href"=>"/ph/communecter/project/savecontributor"),
      "dashboard"=>array("href"=>"/ph/communecter/project/dashboard"),
	    "removeproject"=>array("href"=>"/ph/communecter/project/removeproject"),
	    "editchart"=>array("href"=>"/ph/communecter/project/editchart"),
	    "updatefield"=>array("href"=>"/ph/communecter/project/updatefield"),
      "projectsv"=>array("href"=>"/ph/communecter/project/projectsv"),
    ),

    "job"=> array(
      "edit"=>array("href"=>"/ph/communecter/job/edit"),
      "public"=>array("href"=>"/ph/communecter/job/public"),
      "save"=>array("href"=>"/ph/communecter/job/save"),
      "delete"=>array("href"=>"/ph/communecter/job/delete"),
      "list"=>array("href"=>"/ph/communecter/job/list"),
    ),

    "pod" => array(
    	"slideragenda" => array("href" => "/ph/communecter/pod/slideragenda"),
    	"photovideo" => array("href" => "ph/communecter/pod/photovideo"),
    	"fileupload" => array("href" => "ph/communecter/pod/fileupload"),
    ),
    "gallery" => array(
    	"index" => array("href" => "ph/communecter/gallery/index"),
    	"removebyid" => array("href"=>"ph/communecter/gallery/removebyid"),
    ),

    "link" => array(
      "savemember" => array("href" => "/ph/communecter/link/savemember"),
      "removemember" => array("href" => "/ph/communecter/link/removemember"),
      "removecontributor" => array("href" => "/ph/communecter/link/removecontributor")
    ),

    "document" => array(
      "resized"=>array("href"=> "/ph/communecter/document/resized"),
      "list"=>array("href"=> "/ph/communecter/document/list"),
      "save"=>array("href"=> "/ph/communecter/document/save"),
      "deleteDocumentById"=>array("href"=> "/ph/communecter/document/deleteDocumentById"),
      "removeAndBacktract"=>array("href"=> "/ph/communecter/document/removeAndBacktract"),
      "getlistbyid" => array("href"=> "ph/communecter/document/getlistbyid"),
      "upload" => array("href"=> "ph/communecter/document/upload"),
      "delete" => array("href"=> "ph/communecter/document/delete")
    ),

    "survey" => array(
      "index" => array("href" => "/ph/communecter/survey/index"),
      "entries" => array("href" => "/ph/communecter/survey/entries"),
      "savesession" => array("href" => "/ph/communecter/survey/savesession"),
      "delete" => array("href" => "/ph/communecter/survey/delete"),
      "addaction" => array("href" => "/ph/communecter/survey/addaction"),
      "moderate" => array("href" => "/ph/communecter/survey/moderate"),
      "entry" => array("href" => "/ph/communecter/survey/entry"),
      "graph" => array("href" => "/ph/communecter/survey/graph"),
      "textarea" => array("href" => "/ph/communecter/survey/textarea"),
      "editlist" => array("href" => "/ph/communecter/survey/editList"),
      "multiadd" => array("href" => "/ph/communecter/survey/multiadd"),
    ),
    "discuss"=>array(
      "index" => array( "href" => "/ph/communecter/discuss/index"),
    ),
    
  );

  function initPage(){
    
    //managed public and private sections through a url manager 
    if( Yii::app()->controller->id."/".Yii::app()->controller->action->id != "person/login" 
      && Yii::app()->controller->id."/".Yii::app()->controller->action->id != "person/register" 
      && Yii::app()->controller->id."/".Yii::app()->controller->action->id != "person/authenticate" 
      && !Yii::app()->session["userId"] )
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));

    /*if( !isset(Yii::app()->session['logguedIntoApp']) || Yii::app()->session['logguedIntoApp'] != $this->module->id)
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/logout"));*/
    
    //Granddir
    //$id = "54eed95ea1aa143e020041c8";
    //Larges
    
    $this->sidebar1 = array_merge( Menu::menuItems(), $this->sidebar1 );

    $this->person = Person::getPersonMap(Yii::app() ->session["userId"]);

    $page = $this->pages[Yii::app()->controller->id][Yii::app()->controller->action->id];
    $this->title = (isset($page["title"])) ? $page["title"] : $this->title;
    $this->subTitle = (isset($page["subTitle"])) ? $page["subTitle"] : $this->subTitle;
    $this->pageTitle = (isset($page["pageTitle"])) ? $page["pageTitle"] : $this->pageTitle;

    $this->notifications = ActivityStream::getNotifications(array("notify.id"=>Yii::app()->session["userId"]));

    CornerDev::addWorkLog("communecter","you@dev.com",Yii::app()->controller->id,Yii::app()->controller->action->id);
  }


}
