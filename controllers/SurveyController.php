<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class SurveyController extends CommunecterController {

    protected function beforeAction($action)
  	{
      parent::initPage();
		  return parent::beforeAction($action);
  	}

    public function actions()
  {
      return array(
          'index'        => 'citizenToolKit.controllers.survey.IndexAction',
          'indexPod'     => 'citizenToolKit.controllers.survey.IndexAction',
          'entries'      => 'citizenToolKit.controllers.survey.EntriesAction',
          'entry'        => 'citizenToolKit.controllers.survey.EntryAction',
          'graph'        => 'citizenToolKit.controllers.survey.GraphAction',
          'savesession'  => 'citizenToolKit.controllers.survey.SaveSessionAction',
          'moderate'     => 'citizenToolKit.controllers.survey.ModerateAction',
          //'delete'       => 'citizenToolKit.controllers.survey.DeleteAction',
          'close'        => 'citizenToolKit.controllers.survey.CloseAction',
          'addaction'    => 'citizenToolKit.controllers.action.AddActionAction'
      );
  }
  


  public function actionTextarea() 
  {
    Yii::app()->theme  = "empty";
    $this->render( "textarea" );
  }
  public function actionEditList() 
  {
    Yii::app()->theme  = "empty";
    $this->render( "editList" );
  }
  public function actionMultiAdd() 
  {
    Yii::app()->theme  = "empty";
    $this->render( "multiadd" );
  }
}