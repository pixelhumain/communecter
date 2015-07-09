<?php
/**
 * DiscussController.php
 *
 *
 * @author: Sylvain Barbot
 * Date: 24/06/2015
 */
class RoomsController extends CommunecterController {

    protected function beforeAction($action) {
    	parent::initPage();
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       	=> 'citizenToolKit.controllers.actionRoom.IndexAction',
			'saveroom'   	=> 'citizenToolKit.controllers.actionRoom.SaveRoomAction',
			'editroom'		=> 'citizenToolKit.controllers.actionRoom.EditRoomAction',
	    );
	}
}