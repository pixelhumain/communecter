<?php
/**
 * NotificationController.php
 *
 * @author: Tibor Katelbach <oceatoon@gmail.com>
 * Date: 8/09/15
 * Time: 10:00 AM
 */
class NotificationController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'getnotifications'    => 'citizenToolKit.controllers.notification.GetAction',
	        'marknotificationasread'    => 'citizenToolKit.controllers.notification.RemoveAction',
	        'markallnotificationasread'    => 'citizenToolKit.controllers.notification.RemoveAllAction'
	    );
	}
}