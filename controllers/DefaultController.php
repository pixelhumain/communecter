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
  		Yii::app()->theme  = "rapidos";
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

	    $this->render("index");
	}
  
}