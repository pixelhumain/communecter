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
  public $footerImages = array("/images/logo_region_reunion.png","/images/technopole.jpg");

  const theme = "rapidos";
  public $themeStyle = "theme-style5";//3,4,5,7,9

	public $sidebar1 = array(
    array('label' => "Temporaire", "key"=>"temporary","iconClass"=>"fa fa-life-bouy","generate"=>true,
                "children"=> array(
                  "login" => array( "label"=>"Login","key"=>"login", "href"=>"/teeo/person/login"),
                  "register" => array( "label"=>"REgister","key"=>"register", "href"=>"/teeo/person/login?box=register"),
                  "profile" => array( "label"=>"Profile","key"=>"profile", "href"=>"/teeo/person/profile"),
                  "group" => array( "label"=>"Group","key"=>"group", "href"=>"/teeo/default/group"),
                  "asso" => array( "label"=>"Asso","key"=>"asso", "href"=>"/teeo/default/asso"),
                  "company" => array( "label"=>"Company","key"=>"company", "href"=>"/teeo/default/company"),
                  "listing" => array( "label"=>"Listing","key"=>"listing", "href"=>"/teeo/default/listing"),
                )
          ),
    );
}