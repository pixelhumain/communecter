<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CommunecterController extends Controller
{
  public $version = "v0.1.4";
  public $versionDate = "29/07/2016 19:12";
  public $title = "Communectez";
  public $subTitle = "se connecter à sa commune";
  public $pageTitle = "Communecter, se connecter à sa commune";
  public static $moduleKey = "communecter";
  public $keywords = "communecter,connecter, commun,commune, réseau, sociétal, citoyen, société, territoire, participatif, social, smarterre,tiers lieux, ";
  public $description = "Communecter : Connecter à sa commune, inter connecter les communs, un réseau sociétal pour un citoyen connecté et acteur au centre de sa société.";
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
      "moderate"    => array("href" => "/ph/communecter/admin/moderate"),
      "statistics"    => array("href" => "/ph/communecter/stat/chart"),
      "checkcities"    => array("href" => "/ph/communecter/admin/checkcities"),
      "checkcedex"    => array("href" => "/ph/communecter/admin/checkcedex"),
      "downloadfile" => array("href" => "/ph/communecter/admin/downloadfile"),
      "createfile" => array("href" => "/ph/communecter/admin/createfile"),
      "mailerrordashboard" => array("href" => "/ph/communecter/admin/mailerrordashboard"),
      "cities" => array("href" => "/ph/communecter/admin/cities"),
    ),
    
    "adminpublic" => array(
      "index"    => array("href" => "/ph/communecter/adminpublic/index"),
      "adddata"    => array("href" => "/ph/communecter/adminpublic/adddata"),
      "adddataindb"    => array("href" => "/ph/communecter/adminpublic/adddataindb"),
      "createfile" => array("href" => "/ph/communecter/adminpublic/createfile"),
      "sourceadmin" => array("href" => "/ph/communecter/adminpublic/sourceadmin"),
      "assigndata"    => array("href" => "/ph/communecter/adminpublic/assigndata"),
      "getdatabyurl"   => array("href" => "/ph/communecter/adminpublic/getdatabyurl"),
      "previewdata"    => array("href" => "/ph/communecter/adminpublic/previewdata"),
      
    ),
    "collections" => array(
      "add"    => array("href" => "/ph/communecter/collections/add"),
      "list"    => array("href" => "/ph/communecter/collections/list"),
      "crud"    => array("href" => "/ph/communecter/collections/crud"),
    ),
    "tool" => array(
      "get"    => array("href" => "/ph/communecter/tool/get")
    ),
    "default" => array(
      "index"                => array("href" => "/ph/communecter/default/index", "public" => true),
      "directory"            => array("href" => "/ph/communecter/default/directory", "public" => true),
      "directoryjs"            => array("href" => "/ph/communecter/default/directoryjs", "public" => true),
      "agenda"               => array("href" => "/ph/communecter/default/agenda", "public" => true),
      "news"                 => array("href" => "/ph/communecter/default/news", "public" => true),
      "home"                 => array("href" => "/ph/communecter/default/home", "public" => true),
      "apropos"              => array("href" => "/ph/communecter/default/apropos", "public" => true),
      "add"                  => array("href" => "/ph/communecter/default/add"),
      "view"                 => array("href" => "/ph/communecter/default/view", "public" => true),
      "dir"                  => array("href" => "/ph/communecter/default/dir", "public" => true),
      "twostepregister"      => array("href" => "/ph/communecter/default/twostepregister"),
      "switch"               => array("href" => "/ph/communecter/default/switch"),
      "live"                 => array("href" => "/ph/communecter/default/live"),
    ),
    "city"=> array(
      "index"               => array("href" => "/ph/communecter/city/index", "public" => true),
      "detail"              => array("href" => "/ph/communecter/city/detail", "public" => true),
      "dashboard"           => array("href" => "/ph/communecter/city/dashboard", "public" => true), 
      "directory"           => array("href" => "/ph/communecter/city/directory", "public" => true, 
                                     "title"=>"City Directory", "subTitle"=>"Find Local Actors and Actions : People, Organizations, Events"),
      'statisticpopulation' => array("href" => "/ph/communecter/city/statisticpopulation", "public" => true),
      'getcitydata'         => array("href" => "/ph/communecter/city/getcitydata", "public" => true),
      'getcityjsondata'     => array("href" => "/ph/communecter/city/getcityjsondata", "public" => true),
      'statisticcity'       => array("href" => "/ph/communecter/city/statisticcity", "public" => true),
      'statisticPopulation' => array("href" => "/ph/communecter/city/statisticPopulation", "public" => true),
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
      'cityexists'          => array("href" => "/ph/communecter/city/cityexists"),
      'autocompletemultiscope'          => array("href" => "/ph/communecter/city/autocompletemultiscope"),
      "save"               => array("href" => "/ph/communecter/city/save", "public" => true),
      'getdepandregion'          => array("href" => "/ph/communecter/city/getdepandregion"),
    ),
    "news"=> array(
      "index"   => array( "href" => "/ph/communecter/news/index", "public" => true,'title' => "Fil d'actualités - N.E.W.S", "subTitle"=>"Nord.Est.West.Sud","pageTitle"=>"Fil d'actualités - N.E.W.S"),
      "latest"  => array( "href" => "/ph/communecter/news/latest"),
      "save"    => array( "href" => "/ph/communecter/news/save"),
      "detail"    => array( "href" => "/ph/communecter/news/detail"),
      "delete"    => array( "href" => "/ph/communecter/news/delete"),
      "updatefield"    => array( "href" => "/ph/communecter/news/updatefield"),
      "extractprocess" => array( "href" => "/ph/communecter/news/extractprocess"),
      "moderate" => array( "href" => "/ph/communecter/news/moderate"),
    ),
    "search"=> array(
      "getmemberautocomplete" => array("href" => "/ph/communecter/search/getmemberautocomplete"),
      "getshortdetailsentity" => array("href" => "/ph/communecter/search/getshortdetailsentity"),
      "index"                 => array("href" => "/ph/communecter/search/index"),
      "mainmap"               => array("href" => "/ph/communecter/default/mainmap", "public" => true)
    ),
    "network" => array(
      "simplydirectory"    => array("href" => "/ph/communecter/network/simplydirectory")
    ),
    "rooms"=> array(
      "index"    => array("href" => "/ph/communecter/rooms/index"),
      "saveroom" => array("href" => "/ph/communecter/rooms/saveroom"),
      "editroom" => array("href" => "/ph/communecter/rooms/editroom"),
      "external" => array("href" => "/ph/communecter/rooms/external"),
      "actions"  => array("href" => "/ph/communecter/rooms/actions"),
      "action"   => array("href" => "/ph/communecter/rooms/action"),
      "editaction" => array("href" => "/ph/communecter/rooms/editaction"),
      'saveaction' => array("href" => "/ph/communecter/rooms/saveaction"),
      'closeaction' => array("href" => "/ph/communecter/rooms/closeaction"),
      'assignme' => array("href" => "/ph/communecter/rooms/assignme"),
      'fastaddaction' => array("href" => "/ph/communecter/rooms/fastaddaction"),
      'move' => array("href" => "/ph/communecter/rooms/move"),
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
        "logged"           => array("href" => "/ph/communecter/person/logged"),
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
        "updateprofil"      => array("href" => "/ph/communecter/person/updateprofil"),
        "updatewithjson"      => array("href" => "/ph/communecter/person/updatewithjson"),
        "updatemultitag"      => array("href" => "/ph/communecter/person/updatemultitag"),
        "updatemultiscope"      => array("href" => "/ph/communecter/person/updatemultiscope"),
        "sendinvitationagain"      => array("href" => "/ph/communecter/person/sendinvitationagain"),

        
        "chooseinvitecontact"=> array('href'    => "/ph/communecter/person/chooseinvitecontact"),
        "sendmail"=> array('href'   => "/ph/communecter/person/sendmail"),
        
        "telegram"               => array("href" => "/ph/communecter/person/telegram", "public" => true),
        
        //Init Data
        "clearinitdatapeopleall"  => array("href" =>"'/ph/communecter/person/clearinitdatapeopleall'"),
        "initdatapeopleall"       => array("href" =>"'/ph/communecter/person/initdatapeopleall'"),
        "importmydata"            => array("href" =>"'/ph/communecter/person/importmydata'"),
        "about"                   => array("href" => "/person/about"),
        "data"                    => array("href" => "/person/scopes"),
        "directory"               => array("href" => "/ph/communecter/city/directory", "public" => true, "title"=>"My Directory", "subTitle"=>"My Network : People, Organizations, Events"),
        

        "get"      => array("href" => "/ph/communecter/person/get"),
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
      "addmember"           => array("href"=>"/ph/communecter/organization/addmember"),
      "updatesettings"      => array('href'=>"/ph/communecter/organization/updatesettings"),
      "get"                 => array("href" => "/ph/communecter/organization/get"),
    ),
    "event"=> array(
      "save"            => array("href" => "/ph/communecter/event/save"),
      "update"          => array("href" => "/ph/communecter/event/update"),
      "saveattendees"   => array("href" => "/ph/communecter/event/saveattendees"),
      "removeattendee"  => array("href" => "/ph/communecter/event/removeattendee"),
      "detail"          => array("href" => "/ph/communecter/event/detail", "public" => true),
      "delete"          => array("href" => "ph/communecter/event/delete"),
      "updatefield"     => array("href" => "ph/communecter/event/updatefield"),
      "calendarview"    => array("href" => "ph/communecter/event/calendarview"),
      "eventsv"         => array("href" => "ph/communecter/event/eventsv" , "public" => true),
      "directory"       => array("href"=>"/ph/communecter/event/directory", "public" => true),
      "addattendeesv"   => array("href"=>"/ph/communecter/event/addattendeesv"),
      "updatesettings"      => array('href'=>"/ph/communecter/event/updatesettings")
    ),
    "project"=> array(
      "edit"            => array("href" => "/ph/communecter/project/edit"),
      "get"          => array("href" => "/ph/communecter/project/get"),
      "save"            => array("href" => "/ph/communecter/project/save"),
      "update"            => array("href" => "/ph/communecter/project/update"),
      "savecontributor" => array("href" => "/ph/communecter/project/savecontributor"),
      "dashboard"       => array("href" => "/ph/communecter/project/dashboard"),
      "detail"          => array("href" => "/ph/communecter/project/detail", "public" => true),
      "removeproject"   => array("href" => "/ph/communecter/project/removeproject"),
      "editchart"       => array("href" => "/ph/communecter/project/editchart"),
      "updatefield"     => array("href" => "/ph/communecter/project/updatefield"),
      "projectsv"       => array("href" => "/ph/communecter/project/projectsv"),
      "addcontributorsv" => array("href" => "/ph/communecter/project/addcontributorsv"),
      "addchartsv"      => array("href" => "/ph/communecter/project/addchartsv"),
      "directory"       => array("href"=>"/ph/communecter/project/directory", "public" => true),
      "updatesettings"  => array('href'=>"/ph/communecter/project/updatesettings"),
    ),
    "chart" => array(
	    "addchartsv"      => array("href" => "/ph/communecter/chart/addchartsv"),
		"index"      => array("href" => "/ph/communecter/chart/index"),
		"editchart"       => array("href" => "/ph/communecter/chart/editchart"),
		"get"       => array("href" => "/ph/communecter/chart/get"),
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
      "activitylist"   => array("href" => "ph/communecter/pod/activitylist"),
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
      "multiconnect"           => array("href" => "/ph/communecter/link/multiconnect"),
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
      "uploadsave"          => array("href"=> "ph/communecter/document/uploadsave"),
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
      "close"       => array("href" => "/ph/communecter/survey/close"),
      "editentry"   => array("href" => "/ph/communecter/survey/editentry"),
      "fastaddentry"=> array("href" => "/ph/communecter/survey/fastaddentry"),
    ),
    "discuss"=> array(
      "index" => array( "href" => "/ph/communecter/discuss/index", "public" => true),
    ),
    "comment"=> array(
      "index"        => array( "href" => "/ph/communecter/comment/index", "public" => true),
      "save"         => array( "href" => "/ph/communecter/comment/save"),
      'abuseprocess' => array( "href" => "/ph/communecter/comment/abuseprocess"),
      "testpod"      => array("href"  => "/ph/communecter/comment/testpod"),
      "moderate"     => array( "href" => "/ph/communecter/comment/moderate"),
      "delete"       => array( "href" => "/ph/communecter/comment/delete"),
      "updatefield"  => array( "href" => "/ph/communecter/comment/updatefield"),
      "countcommentsfrom" => array( "href" => "/ph/communecter/comment/countcommentsfrom"),
    ),
    "action"=> array(
       "addaction"   => array("href" => "/ph/communecter/action/addaction"),
    ),
    "notification"=> array(
      "getnotifications"          => array("href" => "/ph/communecter/notification/get","json" => true),
      "marknotificationasread"    => array("href" => "/ph/communecter/notification/remove"),
      "markallnotificationasread" => array("href" => "/ph/communecter/notification/removeall"),
      "update" => array("href" => "/ph/communecter/notification/update")
    ),
    "gamification"=> array(
      "index" => array("href" => "/ph/communecter/gamification/index"),
    ),
    "graph"=> array(
      "viewer" => array("href" => "/ph/communecter/graph/viewer"),
    ),
    "log"=> array(
      "monitoring" => array("href" => "/ph/communecter/log/monitoring"),
      "dbaccess"  => array("href" => "/ph/communecter/log/dbaccess"),
      "clear"  => array("href" => "/ph/communecter/log/clear"),
    ),
    "stat"=> array(
      "createglobalstat" => array("href" => "/ph/communecter/stat/createglobalstat"),
    ),
    "mailmanagement"=> array(
      "droppedmail" => array("href" => "/communecter/mailmanagement/droppedmail"),
    ),
    "element"=> array(
      "updatesettings"      => array('href' => "/ph/communecter/element/updatesettings"),
      "updatefield"         => array("href" => "/ph/communecter/element/updatefield"),
      "updatefields"        => array("href" => "/ph/communecter/element/updatefields"),
      "updateblock"        => array("href" => "/ph/communecter/element/updateblock"),
      "detail"              => array("href" => "/ph/communecter/element/detail", "public" => true),
      "getalllinks"         => array("href" => "/ph/communecter/element/getalllinks"),
      "simply"              => array("href" => "/ph/communecter/element/simply", "public" => true),
      "directory"           => array("href" => "/ph/communecter/element/directory", "public" => true),
      "directory2"          => array("href" => "/ph/communecter/element/directory2", "public" => true),
      "addmembers"          => array("href" => "/ph/communecter/element/addmembers", "public" => true),
      "aroundme"            => array("href" => "/ph/communecter/element/aroundme"),
      "save"                => array("href" => "/ph/communecter/element/save"),
      "savecontact"         => array("href" => "/ph/communecter/element/savecontact"),
      "saveurl"             => array("href" => "/ph/communecter/element/saveurl"),
      "get"                 => array("href" => "/ph/communecter/element/get"),
      "delete"              => array("href" => "/ph/communecter/element/delete"),
      "notifications"              => array("href" => "/ph/communecter/element/notifications"),
      "getnotifications"              => array("href" => "/ph/communecter/element/getnotifications"),
    ),
    "co2" => array(
      "index"             => array('href' => "/ph/communecter/co2/index",             "public" => true),
      "web"               => array('href' => "/ph/communecter/co2/web",               "public" => true),
      "websearch"         => array('href' => "/ph/communecter/co2/websearch",         "public" => true),
      "live"              => array('href' => "/ph/communecter/co2/live",              "public" => true),
      "media"             => array('href' => "/ph/communecter/co2/media",             "public" => true),
      "referencement"     => array('href' => "/ph/communecter/co2/referencement",     "public" => true),
      "savereferencement" => array('href' => "/ph/communecter/co2/savereferencement", "public" => true),
      "freedom"           => array('href' => "/ph/communecter/co2/freedom",           "public" => true),
      "agenda"            => array('href' => "/ph/communecter/co2/agenda",            "public" => true),
      "mediacrawler"      => array('href' => "/ph/communecter/co2/mediacrawler",      "public" => false),
      "page"              => array('href' => "/ph/communecter/co2/page",              "public" => true),
      "social"            => array('href' => "/ph/communecter/co2/social",            "public" => true),
      "agenda"            => array('href' => "/ph/communecter/co2/agenda",            "public" => true),
      "power"             => array('href' => "/ph/communecter/co2/power",             "public" => true),
      "superadmin"        => array('href' => "/ph/communecter/co2/superadmin",        "public" => false),
      "info"              => array('href' => "/ph/communecter/co2/info",              "public" => false),
      ),
    "siteurl" => array(
      "incnbclick"        => array('href' => "ph/communecter/siteurl/incnbclick")
    ),
  );

  function initPage(){
    
    //review the value of the userId to check loosing session
    //creates an issue with Json requests : to clear add josn:true on the page definition here 
    //if( Yii::app()->request->isAjaxRequest && (!isset( $page["json"] )) )
      //echo "<script type='text/javascript'> userId = '".Yii::app()->session['userId']."'; var blackfly = 'sosos';</script>";
    
    if( @$_GET["theme"] ){
      Yii::app()->theme = $_GET["theme"];
      Yii::app()->session["theme"] = $_GET["theme"];
    }
    else if(@Yii::app()->session["theme"])
      Yii::app()->theme = Yii::app()->session["theme"];
    /*else
      Yii::app()->theme = "ph-dori";*/

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
      //once the token is check => remove the token from the post
      unset($_POST["X-Auth-Token"]);
    } 
    //Api access through REST 
    //no need to prepare interface data
    else if (!Yii::app()->session[ "userId" ] &&  isset($_SERVER['PHP_AUTH_USER']) && Authorisation::isValidUser($_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'])) {
      $prepareData = false;
    }
    //}
    else if( (!isset( $page["public"] ) ) && (!isset( $page["json"] ))
      && !in_array(Yii::app()->controller->id."/".Yii::app()->controller->action->id, $pagesWithoutLogin)
      && !Yii::app()->session[ "userId" ] )
    {
        Yii::app()->session["requestedUrl"] = Yii::app()->request->url;
        //if( Yii::app()->request->isAjaxRequest)
          //echo "<script type='text/javascript'> checkIsLoggued('".Yii::app()->session['userId']."'); </script>";
         
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
      CornerDev::addWorkLog("communecter",Yii::app()->session["userId"],Yii::app()->controller->id,Yii::app()->controller->action->id);
    }
  }
  
  protected function beforeAction($action){
    if( $_SERVER['SERVER_NAME'] == "127.0.0.1" || $_SERVER['SERVER_NAME'] == "localhost" ){
      Yii::app()->assetManager->forceCopy = true;
      //if(Yii::app()->controller->id."/".Yii::app()->controller->action->id != "log/dbaccess")
        //Yii::app()->session["dbAccess"] = 0;
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
      } else{
         Yii::app()->session["logsInProcess"] = array($actionInProcess => Log::setLogBeforeAction($actionInProcess));
      }
    }
  }
}

