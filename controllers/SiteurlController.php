<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Alpha Tango
 * Date: 29/11/2016
 */
class SiteurlController extends CommunecterController {

    protected function beforeAction($action) {
		  return parent::beforeAction($action);
  	}

  	public function actions()
  	{
      return array(
          'incnbclick'          => 'citizenToolKit.controllers.siteurl.IncNbClickAction',
      );
  	}
	
}
