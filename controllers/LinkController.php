<?php
/**
 * LinkController.php
 *
 * Manage Links between Organization, Person, Projet and Event
 *
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 05/05/2015
 */
class LinkController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}
	public function actions()
	{
	    return array(
	        'removemember'     	=> 'citizenToolKit.controllers.link.RemoveMemberAction',
	        "removerole"		=> 'citizenToolKit.controllers.link.RemoveRoleAction',
			'removecontributor' => 'citizenToolKit.controllers.link.RemoveContributorAction',
			'disconnect' 		=> 'citizenToolKit.controllers.link.DisconnectAction',
			//New Actions
			'connect' 			=> 'citizenToolKit.controllers.link.ConnectAction',
			'follow' 			=> 'citizenToolKit.controllers.link.FollowAction',
			'validate' 			=> 'citizenToolKit.controllers.link.ValidateAction',
	    );
	}
}