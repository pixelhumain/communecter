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
    	parent::initPage();
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       	=> 'citizenToolKit.controllers.news.IndexAction',
	        'latest'     	=> 'citizenToolKit.controllers.news.LatestAction',
	        'save'     		=> 'citizenToolKit.controllers.news.SaveAction',
	        'delete'     	=> 'citizenToolKit.controllers.news.DeleteAction',
	        'updatefield'   => 'citizenToolKit.controllers.news.UpdateFieldAction',
	    );
	}
}


