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

      
		  return parent::beforeAction($action);
  	}

    /**
     * Home page
     */
	public function actionIndex() 
	{
    $this->layout = "//layouts/mainSearch";
    $this->render("index");
  }

  public function actionTwoStepRegister() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("two_step_register");
  }
  public function actionAgenda() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("agenda");
  }

  public function actionNews() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("news");
  }

  public function actionDirectory() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("directory");
  }

  public function actionDir() 
  {
    $this->layout = "//layouts/mainDirectory";
    $this->render("dir/indexDirectory");
  }

  public function actionSimplyDirectory() 
  {
    $this->layout = "//layouts/mainDirectory";
    $this->render("dir/simplyDirectory");
  }

  public function actionSimplyDirectory2() 
  {
    $this->layout = "//layouts/mainDirectory";
    $this->render("dir/simplyDirectory2");
  }

  public function actionLang() 
  {
    $this->render("index");
  }

  public function actionHome() 
  {
    //$this->layout = "//layouts/mainSearch";

    //Get the last global statistics
    $stats = Stat::getWhere(array(),null,1);
    if(is_array($stats)) $stats = array_pop($stats);

    $this->renderPartial("home", array("stats"=>$stats));
  }
  public function actionLogin() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("login");
  }

  public function actionView($page,$dir=null,$layout=null) 
  {
    if(@$dir){
      if(strpos($dir,"|")){
        $dir=str_replace("|", "/", $dir);
      }
      $page = $dir."/".$page;
	
    }
    if(Yii::app()->request->isAjaxRequest || $layout=="empty"){
      $this->layout = "//layouts/empty";
      echo $this->renderPartial($page, null,true);
    }
    else {
      //$this->sidebar2 = Menu::$infoMenu;
      $this->render($page);
    }
  }
  
    public function actionSwitch($lang)
    {
        $this->layout = "//layouts/empty";
        Yii::app()->session["lang"] = $lang;
        $this->redirect(Yii::app()->createUrl("/".$this->module->id));
    }
}