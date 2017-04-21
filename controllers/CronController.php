<?php
/**
 * CronController.php
 *
 * @author: Sylvain Barbot <sylvain.barbot@gmail.com>
 * Date: 10/04/16
 * Time: 12:25 AM
 */
class CronController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'doCron'    			=> 'citizenToolKit.controllers.cron.DoCronAction',
	        'checkdeletepending'    => 'citizenToolKit.controllers.cron.CheckDeletePendingAction',
	    );
	}
}