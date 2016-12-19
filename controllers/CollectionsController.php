<?php
/**
 * LinkController.php
 *
 * Manage Links between Organization, Person, Projet and Event
 *
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 05/05/2015
 */
class CollectionsController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}
	public function actions()
	{
	    return array(
	    	'add'     	=> 'citizenToolKit.controllers.collections.AddAction',
	        'list'     	=> 'citizenToolKit.controllers.collections.ListAction',
	        'new'     	=> 'citizenToolKit.controllers.collections.NewAction',
	    );
	}
}