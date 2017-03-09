<?php
/**
 * ActionController.php
 *
 * @author: Sylvain Barbot <sylvain.barbot@gmail.com>
 * Date: 7/29/15
 * Time: 12:25 AM
 */
class Co2Controller extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'     	=> 'citizenToolKit.controllers.co2.IndexAction',
	        'web'     		=> 'citizenToolKit.controllers.co2.WebAction',
	        'websearch'     => 'citizenToolKit.controllers.co2.WebSearchAction',
	        'live'    		=> 'citizenToolKit.controllers.co2.LiveAction',
	        'media'    		=> 'citizenToolKit.controllers.co2.MediaAction',
	        'referencement' => 'citizenToolKit.controllers.co2.ReferencementAction',
	        'savereferencement' => 'citizenToolKit.controllers.co2.SaveReferencementAction',
	        'freedom'  		=> 'citizenToolKit.controllers.co2.FreedomAction',
	        'agenda'  		=> 'citizenToolKit.controllers.co2.AgendaAction',
	        'mediacrawler'  => 'citizenToolKit.controllers.co2.MediaCrawlerAction',
	        'page' 			=> 'citizenToolKit.controllers.co2.PageAction',
	        'social' 		=> 'citizenToolKit.controllers.co2.SocialAction',
	        'agenda' 		=> 'citizenToolKit.controllers.co2.AgendaAction',
	        'power' 		=> 'citizenToolKit.controllers.co2.PowerAction',
	        'superadmin' 	=> 'citizenToolKit.controllers.co2.SuperAdminAction',
	        'info' 			=> 'citizenToolKit.controllers.co2.InfoAction'
	    );
	}
}