<?php
/**
 * DiscussController.php
 *
 *
 * @author: Sylvain Barbot
 * Date: 24/06/2015
 */
class NeedsController extends CommunecterController {

    protected function beforeAction($action) {
    	parent::initPage();
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       		=> 'citizenToolKit.controllers.needs.IndexAction',
	        'dashboard'       	=> 'citizenToolKit.controllers.needs.DashboardAction',
			'saveneed'       	=> 'citizenToolKit.controllers.needs.SaveNeedAction',
			'updatefield'       => 'citizenToolKit.controllers.needs.UpdateFieldAction',
	    );
	}
}