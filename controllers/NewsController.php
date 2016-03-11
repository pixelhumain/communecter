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
	        'detail'       	=> 'citizenToolKit.controllers.news.DetailAction',
	        'latest'     	=> 'citizenToolKit.controllers.news.LatestAction',
	        'save'     		=> 'citizenToolKit.controllers.news.SaveAction',
	        'delete'     	=> 'citizenToolKit.controllers.news.DeleteAction',
	        'updatefield'   => 'citizenToolKit.controllers.news.UpdateFieldAction',
	        'extractprocess' => array (
	            'class'   => 'ext.extract-url-content.ExtractProcessAction',
	            'options' => array(
	                // Tmp dir to store cached resized images 
	                'cache_dir'   => Yii::getPathOfAlias('webroot') . '/assets/',	 
	                // Web root dir to search images from
	                'base_dir'    => Yii::getPathOfAlias('webroot') . '/',
	            )
	        )
	    );
	}
}


