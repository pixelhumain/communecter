<?php
/**
 * EventController.php
 * 
 * contient tous ce qui concerne les utilisateurs / clietns TEEO
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 18/07/2014
 */
class PersonController extends CommunecterController {

  public $hasSocial = false;
  public $loginRegister = true;

  protected function beforeAction($action)
	{
		Yii::app()->theme  = "rapidos";
    return parent::beforeAction($action);
	}
  /**
   * @return [json Map] list
   */
	public function actionLogin() 
	{
   $this->layout = "//layouts/mainSimple";
   $this->render( "login" );
	}

  public function actionAuthenticate() 
  {
        
  }
  public function actionLogout() 
  {
    Yii::app()->session["user"] = null;
    $this->redirect(Yii::app()->homeUrl);
  }
  public function actionProfile() 
  {
    if(!Yii::app()->session["user"])
      $this->redirect(Yii::app()->createUrl("/".$this->module->id."/person/login"));
    else 
      $this->render( "index" );
  }
}