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
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
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
        $this->subTitle = "se connecter à sa commune";
        $this->pageTitle = "Communecter, se connecter à sa commune";
          
        $this->sidebar2 = array(
            array('label' => "Direct Links", "key"=>"temporary","iconClass"=>"fa fa-life-bouy",
                    "children"=> array(
                      "login" => array( "label"=>"Login","key"=>"login", "href"=>"/communecter/person/login",),
                      "register" => array( "label"=>"REgister","key"=>"register", "href"=>"/communecter/person/login?box=register"),
                      "profile" => array( "label"=>"Profile","key"=>"profile", "href"=>"/communecter/person"),
                      "group" => array( "label"=>"Group","key"=>"group", "href"=>"/communecter/default/group"),
                      "asso" => array( "label"=>"Asso","key"=>"asso", "href"=>"/communecter/default/asso"),
                      "company" => array( "label"=>"Company","key"=>"company", "href"=>"/communecter/default/company"),
                      "listing" => array( "label"=>"Listing","key"=>"listing", "href"=>"/communecter/default/listing"),
                    )
            )
        );

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
}