<?php
/**
 * LinkController.php
 *
 * Manage Links between Organization, Person, Projet and Event
 *
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 05/05/2015
 */
class FavoritesController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}
	public function actions()
	{
	    return array(
	    	'add'     	=> 'citizenToolKit.controllers.favorites.AddAction',
	        'list'     	=> 'citizenToolKit.controllers.favorites.ListAction',
	    );
	}
}