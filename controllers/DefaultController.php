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

  public function actionAgenda() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->render("agenda");
  }

  public function actionNews() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->render("news");
  }

  public function actionDirectory() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->render("directory");
  }

  public function actionHome() 
  {
    //$this->layout = "//layouts/mainSearch";
    $this->renderPartial("home");
  }
  public function actionLogin() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->render("login");
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
  

    /*public function actionDirectory($type=null,$id=null) 
    {
      if( $type == "person" && !$id )
        $id = Yii::app()->session['userId'];

      $url = $type."/directory/id/".$id;
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/".$url));
    }*/
}