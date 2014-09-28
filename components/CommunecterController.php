<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class CommunecterController extends Controller
{
	//array_push( $this->sidebar1 , TeeoApi::getUserMap() );
  public $title = "Communectez vous";
  public $subTitle = "se connecter à sa commune";
  public $pageTitle = "Communecter, se connecter à sa commune";
  public static $moduleKey = "communecter";
  public $keywords = "connecter, réseau, sociétal, citoyen, société, regrouper, commune, communecter, social";
  public $description = "Communecter : Connecter a sa commune, reseau societal, le citoyen au centre de la société.";
  public $projectName = "";
  public $projectImage = "/images/CTK.png";
  public $projectImageL = "/images/logo.png";
  public $footerImages = array(
      array("img"=>"/images/logoORD.png","url"=>"http://openrd.io"),
      array("img"=>"/images/logo_region_reunion.png","url"=>"http://www.regionreunion.com"),
      array("img"=>"/images/technopole.jpg","url"=>"http://technopole-reunion.com"),
      array("img"=>"/images/Logo_Licence_Ouverte_noir_avec_texte.gif","url"=>"https://data.gouv.fr"),
      array("img"=>'/images/blog-github.png',"url"=>"https://github.com/pixelhumain/pixelhumain"),
      array("img"=>'/images/opensource.gif',"url"=>"http://opensource.org/"));

  const theme = "rapidos";
  public $themeStyle = "theme-style5";//3,4,5,7,9

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
    );
  public $toolbarMenuAdd = array(
    array('label' => "Note", "key"=>"note",
                "children"=> array(
                  "test" => array( "label"=>"testAjax","key"=>"test", "class"=>"test", "href"=>"#ajaxSV", "onclick"=>"alert('')", "iconClass"=>"fa fa-warning"),
                  "newNote" => array( "label"=>"Add new note","key"=>"newNote", "class"=>"new-note", "href"=>"#newNote", "iconStack"=>array("fa fa-file-text-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "readNote" => array( "label"=>"Read All notes","class"=>"read-all-notes","key"=>"readNote", "href"=>"#readNote", "iconStack"=>array("fa fa-file-text-o fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
     array('label' => "Calendar", "key"=>"calendar",
                "children"=> array(
                  "newEvent" => array( "label"=>"Add new event","key"=>"newEvent", "class"=>"new-event", "href"=>"#newEvent", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "showCalendar" => array( "label"=>"Show calendar","class"=>"show-calendar","key"=>"showCalendar", "href"=>"#showCalendar", "iconStack"=>array("fa fa-calendar-o fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
    array('label' => "Contributors", "key"=>"contributors",
                "children"=> array(
                  "newNote" => array( "label"=>"Add new contributor","key"=>"newContributor", "class"=>"new-contributor", "href"=>"#newContributor", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-plus fa-stack-1x stack-right-bottom text-danger")),
                  "showContributors" => array( "label"=>"Show all contributor","class"=>"show-contributor","key"=>"showContributors", "href"=>"#showContributors", "iconStack"=>array("fa fa-user fa-stack-1x fa-lg","fa fa-share fa-stack-1x stack-right-bottom text-danger")),
                )
          ),
  );
};
