<?php
/**
 * DefaultController.php
 *
 * azotlive application
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 18/07/2014
 */
class ErrorController extends CommunecterController {

  protected function beforeAction($action)
	{
	  return parent::beforeAction($action);
	}

  /**
   * 
   * @return [json Map] list
   */
	public function actionIndex() 
	{
    $this->pageTitle = "ERREUR";
    if($error=Yii::app()->errorHandler->error)
    {
      if(Yii::app()->request->isAjaxRequest)
        echo $error['message'];
      else
        $this->render('error', array("error"=>$error));
    }else 
      $this->render( "index");
	}
}