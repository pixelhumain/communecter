<?php
/**
 * 
 *
 * @author: Raphael RIVIERE
 * Date:
 */
class AdminpublicController extends CommunecterController {

  protected function beforeAction($action)
  {
	parent::initPage();
	return parent::beforeAction($action);
  }

	public function actions()
	{
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
		'index'   				=> 'citizenToolKit.controllers.adminpublic.IndexAction',
		);
	}	
}