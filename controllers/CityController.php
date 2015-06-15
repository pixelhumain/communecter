<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class CityController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'       	=> 'citizenToolKit.controllers.city.IndexAction',
	        'directory'     => 'citizenToolKit.controllers.city.DirectoryAction',
	        'calendar'      => 'citizenToolKit.controllers.city.CalendarAction',
	    );
	}
}