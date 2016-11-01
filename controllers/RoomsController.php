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
			'external'		=> 'citizenToolKit.controllers.actionRoom.ExternalAction',
			'actions'		=> 'citizenToolKit.controllers.actionRoom.ActionsAction',
			'action'		=> 'citizenToolKit.controllers.actionRoom.ActionAction',
			'editaction'	=> 'citizenToolKit.controllers.actionRoom.EditActionAction',
			'saveaction'	=> 'citizenToolKit.controllers.actionRoom.SaveActionAction',
			'closeaction'	=> 'citizenToolKit.controllers.actionRoom.CloseActionAction',
			'assignme'		=> 'citizenToolKit.controllers.actionRoom.AssignMeAction',
			"fastaddaction" => 'citizenToolKit.controllers.actionRoom.FastAddActionAction',
			'move'        => 'citizenToolKit.controllers.actionRoom.MoveAction',
	    );
	}
}