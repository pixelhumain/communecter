<?php
/**
 * FundingController.php
 *
 * @author: oceatoon@gmail.com
 * Date: 25/7/15
 * Time: 11:25 PM
 */
class FundingController extends CommunecterController {
  

	protected function beforeAction($action) {
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index' => 'citizenToolKit.controllers.funding.RequestAction'
	    );
	}
}