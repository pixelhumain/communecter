<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CommunecterController extends Controller
{
  public $version = "v0.098";
  public $versionDate = "13/04/2016 08:00";
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
      array("img"=>'/images/blog-github.png',"url"=>"https://github.com/orgs/pixelhumain/dashboard"),
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
              //"myaccount" => array( "label"=>"My Account","key"=>"newContributor", "class"=>"new-contributor", "href" => "#newContributor", "iconStack"=> array("fa fa-user fa-stack-1x fa-lg","fa fa-pencil fa-stack-1x stack-right-bottom text-danger")),
              "showContributors" => array( "label"=>"Find People","class"=>"show-contributor","key"=>"showContributors", "href" => "#showContributors", "iconStack"=> array("fa fa-user fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
              "newInvite" => array( "label"=>"Invite Someone","key"=>"invitePerson", "class"=>"ajaxSV", "onclick" => "", "iconStack"=> array("fa fa-user fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
            )
          ),
    array('label' => "Organisation", "key"=>"organization",
            "children"=> array(
              "addOrganization" => array( "label"=>"Add an Organisation","key"=>"addOrganization", "class"=>"ajaxSV", "onclick"=>"", "iconStack"=> array("fa fa-group fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger"))
            )
          ),
    array('label' => "News", "key"=>"note",
                "children"=> array(
                  "createNews"  => array( "label"=>"Create news", "key"=>"new-news",   "class"=>"new-news", "iconStack"=> array("fa fa-bullhorn fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  //"newsStream"  => array( "label"=>"News stream", "key"=>"newsstream", "class"=>"ajaxSV", "onclick"=>"openSubView('News stream', '/communecter/news/newsstream', null)", "iconStack"=> array("fa fa-list fa-stack-1x fa-lg","fa fa-search fa-stack-1x stack-right-bottom text-danger")),
                  //"newNote"   => array( "label"=>"Add new note",  "class"=>"new-note",    "key"=>"newNote",  "href" => "#newNote",  "iconStack"=> array("fa fa-list fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                 // "readNote"  => array( "label"=>"Read All notes","class"=>"read-all-notes","key"=>"readNote", "href" => "#readNote", "iconStack"=> array("fa fa-list fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Event", "key"=>"event",
                "children"=> array(
                  "newEvent" => array( "label"=>"Add new event","key"=>"newEvent",  "class"=>"init-event", "href" => "#newEvent", "iconStack"=> array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "showCalendar" => array( "label"=>"Show calendar","class"=>"show-calendar","key"=>"showCalendar", "href" => "/ph/communecter/event/calendarview", "iconStack"=> array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Projects", "key"=>"projects",
                "children"=> array(
                  "newProject" => array( "label"=>"Add new Project","key"=>"newProject", "class"=>"new-project", "href" => "#newProject", "iconStack"=> array("fa fa-cogs fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  )
          ),
     array('label' => "Rooms", "key"=>"rooms",
                "children"=> array(
                  "newRoom" => array( "label"=>"Add new Room","key"=>"newRoom", "class"=>"ajaxSV", "onclick"=>"", "iconStack"=> array("fa fa-comments fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  )
          )
  );
  public $subviews = array(
    //"news.newsSV",
    //"person.invite",
    //"event.addAttendeesSV"
  );
  public $pages = array(
    "admin" => array(
      "index"     => array("href" => "/ph/communecter/admin"),
      "directory" => array("href" => "/ph/communecter/admin/directory"),
      "switchto"  => array("href" => "/ph/communecter/admin/switchto"),
      "delete"    => array("href" => "/ph/communecter/admin/delete"),
      "activateuser"  => array("href" => "/ph/communecter/admin/activateuser"),
      "importdata"    => array("href" => "/ph/communecter/admin/importdata"),
      "previewdata"    => array("href" => "/ph/communecter/admin/previewdata"),
      "importinmongo"    => array("href" => "/ph/communecter/admin/importinmongo"),
      "assigndata"    => array("href" => "/ph/communecter/admin/assigndata"),
      "checkdataimport"    => array("href" => "/ph/communecter/admin/checkdataimport"),
      "openagenda"    => array("href" => "/ph/communecter/admin/openagenda"),
      "checkventsopenagendaindb"    => array("href" => "/ph/communecter/admin/checkventsopenagendaindb"),
      "importeventsopenagendaindb"    => array("href" => "/ph/communecter/admin/importeventsopenagendaindb"),
      "checkgeocodage"   => array("href" => "/ph/communecter/admin/checkgeocodage"),
      "getentitybadlygeolocalited"   => array("href" => "/ph/communecter/admin/getentitybadlygeolocalited"),
      "getdatabyurl"   => array("href" => "/ph/communecter/admin/getdatabyurl"),
      "adddata"    => array("href" => "/ph/communecter/admin/adddata"),
      "adddataindb"    => array("href" => "/ph/communecter/admin/adddataindb"),
      "createfileforimport"    => array("href" => "/ph/communecter/admin/createfileforimport"),
      "sourceadmin"    => array("href" => "/ph/communecter/admin/sourceadmin"),
      "checkcities"    => array("href" => "/ph/communecter/admin/checkcities"),
    ),
    "adminpublic" => array(
      "index"    => array("href" => "/ph/communecter/adminpublic/index"),
    ),
    "default" => array(
      "index"               => array("href" => "/ph/communecter/default/index", "public" => true),
      "directory"             => array("href" => "/ph/communecter/default/directory", "public" => true),
      "dir"                  => array("href" => "/ph/communecter/default/dir", "public" => true),
      "simplydirectory"       => array("href" => "/ph/communecter/default/simplydirectory", "public" => true),
      "simplydirectory2"       => array("href" => "/ph/communecter/default/simplydirectory2", "public" => true),
      "agenda"                => array("href" => "/ph/communecter/default/agenda", "public" => true),
      "news"                  => array("href" => "/ph/communecter/default/news", "public" => true),
      "home"                  => array("href" => "/ph/communecter/default/home", "public" => true),
      "add"                   => array("href" => "/ph/communecter/default/add"),
      "view"                  => array("href" => "/ph/communecter/default/view", "public" => true),
      "twostepregister"       => array("href" => "/ph/communecter/default/twostepregister"),
      "switch"               => array("href" => "/ph/communecter/default/switch"),
    ),
    "city"=> array(
      "index"               => array("href" => "/ph/communecter/city/index", "public" => true),
      "detail"              => array("href" => "/ph/communecter/city/detail", "public" => true),
      "dashboard"           => array("href" => "/ph/communecter/city/dashboard", "public" => true), 
      "directory"           => array("href" => "/ph/communecter/city/directory", "public" => true, "title"=>"City Directory", "subTitle"=>"Find Local Actors and Actions : People, Organizations, Events"),
      'statisticpopulation' => array("href" => "/ph/communecter/city/statisticpopulation", "public" => true),
      'getcitydata'         => array("href" => "/ph/communecter/city/getcitydata", "public" => true),
      'getcityjsondata'     => array("href" => "/ph/communecter/city/getcityjsondata", "public" => true),
      'statisticcity'       => array("href" => "/ph/communecter/city/statisticcity", "public" => true),
      'getcitiesdata'       => array("href" => "/ph/communecter/city/getcitiesdata"),
      'opendata'            => array("href" => "/ph/communecter/city/opendata","public" => true),
      'getoptiondata'       => array("href" => "/ph/communecter/city/getoptiondata"),
      'getlistoption'       => array("href" => "/ph/communecter/city/getlistoption"),
      'getpodopendata'      => array("href" => "/ph/communecter/city/getpodopendata"),
      'addpodopendata'      => array("href" => "/ph/communecter/city/addpodopendata"),
      'getlistcities'       => array("href" => "/ph/communecter/city/getlistcities"),
      'creategraph'         => array("href" => "/ph/communecter/city/creategraph"),
      'graphcity'           => array("href" => "/ph/communecter/city/graphcity"),
      'updatecitiesgeoformat' => array("href" => "/ph/communecter/city/updatecitiesgeoformat","public" => true),
      'getinfoadressbyinsee'  => array("href" => "/ph/communecter/city/getinfoadressbyinsee"),
    ),
    "news"=> array(
      "index"   => array( "href" => "/ph/communecter/news/index", "public" => true,'title' => "Fil d'actualités - N.E.W.S", "subTitle"=>"Nord.Est.West.Sud","pageTitle"=>"Fil d'actualités - N.E.W.S"),
      "latest"  => array( "href" => "/ph/communecter/news/latest"),
      "save"    => array( "href" => "/ph/communecter/news/save"),
      "detail"    => array( "href" => "/ph/communecter/news/detail"),
      "delete"    => array( "href" => "/ph/communecter/news/delete"),
      "updatefield"    => array( "href" => "/ph/communecter/news/updatefield"),
      "extractprocess" => array( "href" => "/ph/communecter/news/extractprocess"),
    ),
    "search"=> array(
      "getmemberautocomplete" => array("href" => "/ph/communecter/search/getmemberautocomplete"),
      "getshortdetailsentity" => array("href" => "/ph/communecter/search/getshortdetailsentity"),
      "index"                 => array("href" => "/ph/communecter/search/index"),
      "mainmap"               => array("href" => "/ph/communecter/default/mainmap", "public" => true)
    ),
    "rooms"=> array(
      "index"    => array("href" => "/ph/communecter/rooms/index"),
      "saveroom" => array("href" => "/ph/communecter/rooms/saveroom"),
      "editroom" => array("href" => "/ph/communecter/rooms/editroom"),
    ),
    "gantt"=> array(
      "index"            => array("href" => "/ph/communecter/gantt/index", "public" => true),
      "savetask"         => array("href" => "/ph/communecter/gantt/savetask"),
      "removetask"       => array("href" => "/ph/communecter/gantt/removetask"),
      "generatetimeline" => array("href" => "/ph/communecter/gantt/generatetimeline"),
      "addtimesheetsv"   => array("href" => "/ph/communecter/gantt/addtimesheetsv"),
    ),
    "need"=> array(
        "index" => array("href" => "/ph/communecter/need/index", "public" => true),
        "description" => array("href" => "/ph/communecter/need/dashboard/description"),
        "dashboard" => array("href" => "/ph/communecter/need/dashboard"),
        "detail" => array("href" => "/ph/communecter/need/detail", "public" => true),
        "saveneed" => array("href" => "/ph/communecter/need/saveneed"),
        "updatefield" => array("href" => "/ph/communecter/need/updatefield"),
        "addhelpervalidation" => array("href" => "/ph/communecter/need/addhelpervalidation"),
        "addneedsv" => array("href" => "/ph/communecter/need/addneedsv"),
      ),
    "person"=> array(
        "login"           => array("href" => "/ph/communecter/person/login",'title' => "Log me In"),
        "sendemail"       => array("href" => "/ph/communecter/person/sendemail"),
        "index"           => array("href" => "/ph/communecter/person/dashboard",'title' => "My Dashboard"),
        "authenticate"    => array("href" => "/ph/communecter/person/authenticate",'title' => "Authentication"),
        "dashboard"       => array("href" => "/ph/communecter/person/dashboard"),
        "detail"          => array("href" => "/ph/communecter/person/detail", "public" => true),
        "follows"         => array("href" => "/ph/communecter/person/follows"),
        "disconnect"      => array("href" => "/ph/communecter/person/disconnect"),
        "register"        => array("href" => "/ph/communecter/person/register"),
        "activate"        => array('href' => "/ph/communecter/person/activate"),
        "updatesettings"        => array('href' => "/ph/communecter/person/updatesettings"),
        "validateinvitation" => array('href' => "/ph/communecter/person/validateinvitation", "public" => true),
        "logout"          => array("href" => "/ph/communecter/person/logout"),
        'getthumbpath'    => array("href" => "/ph/communecter/person/getThumbPath"),
        'getnotification' => array("href" => "/person/getNotification"),
        'changepassword'  => array("href" => "/person/changepassword"),
        'changerole'      => array("href" => "/person/changerole"),
        'checkusername'   => array("href" => "/person/checkusername"),
        "invite"          => array("href" => "/ph/communecter/person/invite"),
        "invitation"      => array("href" => "/ph/communecter/person/invitation"),
        "updatefield"     => array("href" => "/person/updatefield"),
        "update"          => array("href" => "/person/update"),
        "getuserautocomplete" => array('href' => "/person/getUserAutoComplete"),
        'checklinkmailwithuser'   => array("href" => "/ph/communecter/checklinkmailwithuser"),
        'getuseridbymail'   => array("href" => "/ph/communecter/getuseridbymail"),
        "getbyid"         => array("href" => "/ph/communecter/person/getbyid"),
        "getorganization" => array("href" => "/ph/communecter/person/getorganization"),
        "updatename"      => array("href" => "/ph/communecter/person/updatename"),
        
        "chooseinvitecontact"=> array('href'    => "/ph/communecter/person/chooseinvitecontact"),
        "sendmail"=> array('href'   => "/ph/communecter/person/sendmail"),
        
        //Init Data
        "clearinitdatapeopleall"  => array("href" =>"'/ph/communecter/person/clearinitdatapeopleall'"),
        "initdatapeopleall"       => array("href" =>"'/ph/communecter/person/initdatapeopleall'"),
        "importmydata"            => array("href" =>"'/ph/communecter/person/importmydata'"),
        "about"                   => array("href" => "/person/about"),
        "data"                    => array("href" => "/person/scopes"),
        "directory"               => array("href" => "/ph/communecter/city/directory", "public" => true, "title"=>"My Directory", "subTitle"=>"My Network : People, Organizations, Events"),
    ),
    "organization"=> array(
      "addorganizationform" => array("href" => "/ph/communecter/organization/addorganizationform",
                                     'title' => "Organization", 
                                     "subTitle"=>"Découvrez les organization locales",
                                     "pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "save"             => array("href" => "/ph/communecter/organization/save",
                                     'title' => "Organization", 
                                     "subTitle"=>"Découvrez les organization locales",
                                     "pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "update"              => array("href" => "/ph/communecter/organization/update",
                                     'title' => "Organization", 
                                     "subTitle"=>"Découvrez les organization locales",
                                     "pageTitle"=>"Organization : Association, Entreprises, Groupes locales"),
      "getbyid"             => array("href" => "/ph/communecter/organization/getbyid"),
      "updatefield"         => array("href" => "/ph/communecter/organization/updatefield"),
      "join"                => array("href" => "/ph/communecter/organization/join"),
      "sig"                 => array("href" => "/ph/communecter/organization/sig"),
      //Links // create a Link controller ?
      "addneworganizationasmember"  => array("href" => "/ph/communecter/organization/AddNewOrganizationAsMember"),
      //Dashboards
      "dashboard"           => array("href"=>"/ph/communecter/organization/dashboard"),
      "dashboardmember"     => array("href"=>"/ph/communecter/organization/dashboardMember"),
      "dashboard1"          => array("href"=>"/ph/communecter/organization/dashboard1"),
      "directory"           => array("href"=>"/ph/communecter/organization/directory", "public" => true),
      "disabled"            => array("href"=>"/ph/communecter/organization/disabled"),
      "detail"              => array("href"=>"/ph/communecter/organization/detail", "public" => true),
      "simply"              => array("href"=>"/ph/communecter/organization/detail", "public" => true),
      "addmember"           => array("href"=>"/ph/communecter/organization/addmember"),
    ),
    "event"=> array(
      "save"            => array("href" => "/ph/communecter/event/save"),
      "update"          => array("href" => "/ph/communecter/event/update"),
      "saveattendees"   => array("href" => "/ph/communecter/event/saveattendees"),
      "removeattendee"  => array("href" => "/ph/communecter/event/removeattendee"),
      "dashboard"       => array("href" => "/ph/communecter/event/dashboard"),
      "detail"          => array("href" => "/ph/communecter/event/detail", "public" => true),
      "delete"          => array("href" => "ph/communecter/event/delete"),
      "updatefield"     => array("href" => "ph/communecter/event/updatefield"),
      "calendarview"    => array("href" => "ph/communecter/event/calendarview"),
      "eventsv"         => array("href" => "ph/communecter/event/eventsv" , "public" => true),
      "directory"       => array("href"=>"/ph/communecter/event/directory", "public" => true),
      "addattendeesv"   => array("href"=>"/ph/communecter/event/addattendeesv")
    ),
    "project"=> array(
      "edit"            => array("href" => "/ph/communecter/project/edit"),
      "get"          => array("href" => "/ph/communecter/project/get"),
      "save"            => array("href" => "/ph/communecter/project/save"),
      "update"            => array("href" => "/ph/communecter/project/update"),
      "savecontributor" => array("href" => "/ph/communecter/project/savecontributor"),
      "dashboard"       => array("href" => "/ph/communecter/project/dashboard"),
      "detail"          => array("href" => "/ph/communecter/project/detail", "public" => true),
      "simply"          => array("href" => "/ph/communecter/project/detail", "public" => true),
      "removeproject"   => array("href" => "/ph/communecter/project/removeproject"),
      "editchart"       => array("href" => "/ph/communecter/project/editchart"),
      "updatefield"     => array("href" => "/ph/communecter/project/updatefield"),
      "projectsv"       => array("href" => "/ph/communecter/project/projectsv"),
      "addcontributorsv" => array("href" => "/ph/communecter/project/addcontributorsv"),
      "addchartsv"      => array("href" => "/ph/communecter/project/addchartsv"),
      "directory"       => array("href"=>"/ph/communecter/project/directory", "public" => true)
    ),
    "job"=> array(
      "edit"    => array("href" => "/ph/communecter/job/edit"),
      "public"  => array("href" => "/ph/communecter/job/public"),
      "save"    => array("href" => "/ph/communecter/job/save"),
      "delete"  => array("href" => "/ph/communecter/job/delete"),
      "list"    => array("href" => "/ph/communecter/job/list"),
    ),
    "pod" => array(
      "slideragenda" => array("href" => "/ph/communecter/pod/slideragenda", "public" => true),
      "photovideo"   => array("href" => "ph/communecter/pod/photovideo"),
      "fileupload"   => array("href" => "ph/communecter/pod/fileupload"),
    ),
    "gallery" => array(
      "index"        => array("href" => "ph/communecter/gallery/index"),
      "removebyid"   => array("href" => "ph/communecter/gallery/removebyid"),
    ),
    "link" => array(
      "removemember"        => array("href" => "/ph/communecter/link/removemember"),
      "removecontributor"   => array("href" => "/ph/communecter/link/removecontributor"),
      "disconnect"        => array("href" => "/ph/communecter/link/disconnect"),
      "connect"           => array("href" => "/ph/communecter/link/connect"),
      "follow"           => array("href" => "/ph/communecter/link/follow"),
      "validate"          => array("href" => "/ph/communecter/link/validate"),
    ),
    "document" => array(
      "resized"             => array("href"=> "/ph/communecter/document/resized", "public" => true),
      "list"                => array("href"=> "/ph/communecter/document/list"),
      "save"                => array("href"=> "/ph/communecter/document/save"),
      "deleteDocumentById"  => array("href"=> "/ph/communecter/document/deleteDocumentById"),
      "removeAndBacktract"  => array("href"=> "/ph/communecter/document/removeAndBacktract"),
      "getlistbyid"         => array("href"=> "ph/communecter/document/getlistbyid"),
      "upload"              => array("href"=> "ph/communecter/document/upload"),
      "delete"              => array("href"=> "ph/communecter/document/delete")
    ),
    "survey" => array(
      "index"       => array("href" => "/ph/communecter/survey/index", "public" => true),
      "entries"     => array("href" => "/ph/communecter/survey/entries", "public" => true),
      "savesession" => array("href" => "/ph/communecter/survey/savesession"),
      "savesurvey"  => array("href" => "/ph/communecter/survey/savesurvey"),
      "delete"      => array("href" => "/ph/communecter/survey/delete"),
      "addaction"   => array("href" => "/ph/communecter/survey/addaction"),
      "moderate"    => array("href" => "/ph/communecter/survey/moderate"),
      "entry"       => array("href" => "/ph/communecter/survey/entry", "public" => true ),
      "graph"       => array("href" => "/ph/communecter/survey/graph"),
      "textarea"    => array("href" => "/ph/communecter/survey/textarea"),
      "editlist"    => array("href" => "/ph/communecter/survey/editList"),
      "multiadd"    => array("href" => "/ph/communecter/survey/multiadd"),
      "close"       => array("href" => "/ph/communecter/survey/close")
    ),
    "discuss"=> array(
      "index" => array( "href" => "/ph/communecter/discuss/index", "public" => true),
    ),
    "comment"=> array(
      "index"        => array( "href" => "/ph/communecter/comment/index", "public" => true),
      "save"         => array( "href" => "/ph/communecter/comment/save"),
      'abuseprocess' => array( "href" => "/ph/communecter/comment/abuseprocess"),
      "testpod"      => array("href" => "/ph/communecter/comment/testpod")
    ),
    "action"=> array(
       "addaction"   => array("href" => "/ph/communecter/action/addaction"),
    ),
    "notification"=> array(
      "getnotifications"          => array("href" => "/ph/communecter/notification/get"),
      "marknotificationasread"    => array("href" => "/ph/communecter/notification/remove"),
      "markallnotificationasread" => array("href" => "/ph/communecter/notification/removeall"),
    ),
    "gamification"=> array(
      "index" => array("href" => "/ph/communecter/gamification/index"),
    ),
    "graph"=> array(
      "viewer" => array("href" => "/ph/communecter/graph/viewer"),
    ),
    "log"=> array(
      "monitoring" => array("href" => "/ph/communecter/log/monitoring"),
    ),
    "stat"=> array(
      "createglobalstat" => array("href" => "/ph/communecter/stat/createglobalstat"),
    ),
    "directory"=> array(
      "simply" => array("href" => "/ph/communecter/directory/simply"),
    ),
  );
  function initPage(){
    
    //managed public and private sections through a url manager
    if( Yii::app()->controller->id == "admin" && !Yii::app()->session[ "userIsAdmin" ] )
      throw new CHttpException(403,Yii::t('error','Unauthorized Access.'));
    $page = $this->pages[Yii::app()->controller->id][Yii::app()->controller->action->id];
    $pagesWithoutLogin = array(
                            //Login Page
                            "person/login", 
                            "person/register", 
                            "person/authenticate", 
                            "person/activate", 
                            "person/sendemail",
                            "person/checkusername",
                            //Document Resizer
                            "document/resized");
    
    $prepareData = true;
    //if (true)//(isset($_SERVER["HTTP_ORIGIN"]) )//&& $_SERVER["REMOTE_ADDR"] == "52.30.32.155" ) //this is an outside call 
    //{ 
      //$host = "meteor.communecter.org";
      //if (strpos("http://".$host, $_SERVER["HTTP_ORIGIN"]) >= 0 || strpos("https://".$host, $_SERVER["HTTP_ORIGIN"]) >= 0 ){
    if( isset( $_POST["X-Auth-Token"]) && Authorisation::isMeteorConnected( $_POST["X-Auth-Token"] ) ){
      $prepareData = false;
    }
      //} 
    //}
    else if( (!isset( $page["public"] ) )
      && !in_array(Yii::app()->controller->id."/".Yii::app()->controller->action->id, $pagesWithoutLogin)
      && !Yii::app()->session[ "userId" ] )
    {
        Yii::app()->session["requestedUrl"] = Yii::app()->request->url;
        /*if( Yii::app()->request->isAjaxRequest){
          echo "<script type='text/javascript'> loadByHash('#panel.box-login'); </script>";*/
          /*$this->layout = '';
          Rest::json( array("action"=>"loadByHash('#panel.box-login')", "msg"=>"this page is not public, please log in first."  ) );*/
        /*}
        else
          $this->redirect(Yii::app()->createUrl("/".$this->module->id."#panel.box-login"));*/
    }
    if( isset( $_GET["backUrl"] ) )
      Yii::app()->session["requestedUrl"] = $_GET["backUrl"];
    /*if( !isset(Yii::app()->session['logguedIntoApp']) || Yii::app()->session['logguedIntoApp'] != $this->module->id)
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/logout"));*/
    if( $prepareData )
    {
      $this->sidebar1 = array_merge( Menu::menuItems(), $this->sidebar1 );
      $this->person = Person::getPersonMap(Yii::app() ->session["userId"]);
      $this->title = (isset($page["title"])) ? $page["title"] : $this->title;
      $this->subTitle = (isset($page["subTitle"])) ? $page["subTitle"] : $this->subTitle;
      $this->pageTitle = (isset($page["pageTitle"])) ? $page["pageTitle"] : $this->pageTitle;
      $this->notifications = ActivityStream::getNotifications( array( "notify.id" => Yii::app()->session["userId"] ) );
      CornerDev::addWorkLog("communecter","you@dev.com",Yii::app()->controller->id,Yii::app()->controller->action->id);
    }
  }
  protected function beforeAction($action){
    if( $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_NAME'] == "localhost" ){
      Yii::app()->assetManager->forceCopy = true;
    }

    $this->manageLog();

    return parent::beforeAction($action);
  }


  protected function afterAction($action){
    return parent::afterAction($action);
  }

  /**
   * Start the log process
   * Bring back log parameters, then set object before action and save it if there is no return
   * If there is return, the method save in session the log object which will be finished and save in db during the method afteraction
   */
  protected function manageLog(){
    //Bring back logs needed
    $actionsToLog = Log::getActionsToLog();
    $actionInProcess = Yii::app()->controller->id.'/'.Yii::app()->controller->action->id;

    //Start logs if necessary
    if(isset($actionsToLog[$actionInProcess])) {

      //To let several actions log in the same time
      if(!$actionsToLog[$actionInProcess]['waitForResult']){
        Log::save(Log::setLogBeforeAction($actionInProcess));
      }else if(isset(Yii::app()->session["logsInProcess"]) && is_array(Yii::app()->session["logsInProcess"])){
        Yii::app()->session["logsInProcess"] = array_merge(
          Yii::app()->session["logsInProcess"],
          array($actionInProcess => Log::setLogBeforeAction($actionInProcess))
        );
      }//just on action logging
      else{
         Yii::app()->session["logsInProcess"] = array($actionInProcess => Log::setLogBeforeAction($actionInProcess));
      }
    }
  }
}

