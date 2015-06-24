<?php
/**
 * DiscussController.php
 *
 *
 * @author: Sylvain Barbot
 * Date: 24/06/2015
 */
class DiscussController extends CommunecterController {

    protected function beforeAction($action) {
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       	=> 'citizenToolKit.controllers.discuss.IndexAction',
	    );
	}
}


