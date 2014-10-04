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
      $this->title = "Communectez vous";
      $this->subTitle = "se connecter à sa commune";
      $this->pageTitle = "Communecter, se connecter à sa commune";
      
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
      
      $detect = new Mobile_Detect;
      $isMobile = $detect->isMobile();
      
      if($isMobile) {
        $this->render("aboutMob");
      }
      else {
        $this->render("about");
      }
      
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