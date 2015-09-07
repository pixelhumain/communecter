<?php
/**
 * GamificationController.php
 *
 * @author: Tibor Katelbach <oceatoon@gmail.com>
 * Date: 7/09/15
 * Time: 10:00 AM
 */
class GamificationController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'    => 'citizenToolKit.controllers.gamification.IndexAction'
	    );
	}
}