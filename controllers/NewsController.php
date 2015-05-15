<?php
/**
 * NewsController.php
 *
 *
 * @author: Tristan Goguet
 * Date: 09/11/2014
 */
class NewsController extends CommunecterController {

    protected function beforeAction($action) {
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       	=> 'citizenToolKit.controllers.news.IndexAction',
	        'latest'     	=> 'citizenToolKit.controllers.news.LatestAction'
	    );
	}
}


