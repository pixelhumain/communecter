<?php
/**
 * ActionController.php
 *
 * @author: Sylvain Barbot <sylvain.barbot@gmail.com>
 * Date: 7/29/15
 * Time: 12:25 AM
 */
class KController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'web'     		=> 'citizenToolKit.controllers.k.WebAction',
	        'websearch'     => 'citizenToolKit.controllers.k.WebSearchAction',
	        'live'    		=> 'citizenToolKit.controllers.k.LiveAction',
	        'referencement' => 'citizenToolKit.controllers.k.ReferencementAction',
	        'savereferencement' => 'citizenToolKit.controllers.k.SaveReferencementAction',
	        'agenda'  		=> 'citizenToolKit.controllers.k.AgendaAction'
	    );
	}
}