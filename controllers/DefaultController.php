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
    	//Yii::app()->theme = $theme;   
      //Yii::app()->session["theme"] = $theme; 
      
      
      //Yii::app()->theme = "notragora";
      //Yii::app()->theme = "CO2";
	    if(@$_GET["network"]){
	      Yii::app()->theme = "network";
	      Yii::app()->params['networkParams'] = $_GET["network"];
	    }
	    $this->render("index");
  }

  public function actionTwoStepRegister() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("two_step_register");
  }
  public function actionAgenda() 
  {
    $this->renderPartial("agenda");
  }

  public function actionLive($type=null) 
  {
    $stream = array();
    $now = array();
    /*if( !$type || $type == "dda" ){
      $stream = array_merge( $stream, ActionRoom::getAllRoomsActivityByTypeId( Person::COLLECTION, Yii::app()->session['userId'] ) );  
    }*/
    if( !$type || $type == Project::COLLECTION ){
      $stream = array_merge( $stream, Element::getActive( Project::COLLECTION ) );  
    }
    if( !$type || $type == Event::COLLECTION ){
      $stream = array_merge( $stream, Element::getActive( Event::COLLECTION ) );  
    }
    if( !$type || $type == Organization::COLLECTION ){
      $stream = array_merge( $stream, Element::getActive( Organization::COLLECTION ) );  
    }
    function mySort($a, $b){ 
          if( isset($a['updated']) && isset($b['updated']) ){
              return (strtolower(@$b['updated']) > strtolower(@$a['updated']));
          }else{
              return false;
          }
      }
      
      usort($stream,"mySort");
    $this->renderPartial("live", array( "stream"=>$stream,
                                        "now"=>$now,
                                        "type"=>$type ));
  }

  public function actionNews() 
  {
    $this->renderPartial("news");
  }

  public function actionDirectory() 
  {
    $this->renderPartial("directory");
  }
  public function actionDirectoryjs() 
  {
    $this->renderPartial("directoryjs");
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
    $tpl = "home";
    if(Yii::app()->theme != "ph-dori")
    	$tpl = "//layouts/default/home";

   // $tpl=(@$_GET["tpl"]) ? $_GET["tpl"]: "home";
    $this->renderPartial($tpl, array("stats"=>$stats));
  }
  public function actionApropos() 
  {
    //$this->layout = "//layouts/mainSearch";
    $tpl = "apropos";
    if(Yii::app()->theme != "ph-dori")
      $tpl = "//layouts/default/apropos";

   // $tpl=(@$_GET["tpl"]) ? $_GET["tpl"]: "home";
    $this->renderPartial($tpl);
  }
  public function actionLogin() 
  {
    $this->layout = "//layouts/mainSearch";
    $this->renderPartial("login");
  }

  public function actionView($page,$dir=null,$layout=null) 
  {
    if(@$dir){
      
      if( strpos($dir,"docs") !== false )
        $dir = "../".$dir;

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