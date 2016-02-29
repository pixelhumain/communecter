<?php
/**
 * DiscussController.php
 *
 *
 * @author: Sylvain Barbot
 * Date: 24/06/2015
 */
class NeedController extends CommunecterController {

    protected function beforeAction($action) {
    	parent::initPage();
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       		=> 'citizenToolKit.controllers.need.IndexAction',
	        'dashboard'       	=> 'citizenToolKit.controllers.need.DashboardAction',
			'saveneed'       	=> 'citizenToolKit.controllers.need.SaveNeedAction',
			'updatefield'       => 'citizenToolKit.controllers.need.UpdateFieldAction',
			'addhelpervalidation'       => 'citizenToolKit.controllers.need.AddHelperValidationAction',
			'addneedsv'       => 'citizenToolKit.controllers.need.AddNeedSvAction',
			'detail'	=> 'citizenToolKit.controllers.need.DetailAction',
	    );
	}
}