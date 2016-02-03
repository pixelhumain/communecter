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
	        'savemember'       	=> 'citizenToolKit.controllers.link.SaveMemberAction',
	        'removemember'     	=> 'citizenToolKit.controllers.link.RemoveMemberAction',
	        "removerole"		=> 'citizenToolKit.controllers.link.RemoveRoleAction',
			'removecontributor' => 'citizenToolKit.controllers.link.RemoveContributorAction',
			'removeuser' => 'citizenToolKit.controllers.link.RemoveUserAction',
			'declaremeadmin' => 'citizenToolKit.controllers.link.DeclareMeAdminAction',
			'addasadmin' => 'citizenToolKit.controllers.link.AddAsAdminAction',
			'addasmember' => 'citizenToolKit.controllers.link.AddAsMemberAction',
			'connectmeas' => 'citizenToolKit.controllers.link.ConnectAction'
	    );
	}

	public function actionDisconnect($id, $type, $idTo, $typeTo) {
		throw new CommunecterException("TODO !");
	}

}