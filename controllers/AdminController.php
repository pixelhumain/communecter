<?php
/**
 * AdminController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class AdminController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'       => 'citizenToolKit.controllers.admin.IndexAction',
	        'directory'   => 'citizenToolKit.controllers.admin.DirectoryAction',
	    );
	}
}