<?php
/**
 * CommentController.php
 *
 * @author: Sylvain Barbot
 * Date: 2/7/15
 * Time: 12:25 AM
 */
class CommentController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'       			=> 'citizenToolKit.controllers.comment.IndexAction',
	        'save'					=> 'citizenToolKit.controllers.comment.SaveAction',
	        'abuseprocess'			=> 'citizenToolKit.controllers.comment.AbuseProcessAction',
	    );
	}

	public function actionTestPod() {
		$params = array();
		$this->render( "testpod" , $params );
	}
}