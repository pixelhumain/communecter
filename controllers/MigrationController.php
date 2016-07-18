<?php
/**
 * MigrationController.php
 *
 * @author: Sylvain Barbot <sylvain.barbot@gmail.com>
 * Date: 25/03/2016
 * Time: 16:14 
 */
class MigrationController extends CController {
  

	protected function beforeAction($action) {
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'citiespostalcodes'       			=> 'citizenToolKit.controllers.migration.CitiesPostalCodesAction',
	    );
	}
}