<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH pour les associations
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class OrganizationController extends CommunecterController {

  protected function beforeAction($action)
  {
	parent::initPage();
	return parent::beforeAction($action);
  }

	public function actions()
	{
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
		'captcha'=>array(
		 	'class'=>'CCaptchaAction',
		 	'backColor'=>0xFFFFFF,
		),
		'getbyid'       				=> 'citizenToolKit.controllers.organization.GetByIdAction',
		'addorganizationform'			=> 'citizenToolKit.controllers.organization.AddOrganizationFormAction',
		'save'						=> 'citizenToolKit.controllers.organization.SaveAction',
		'updatefield'					=> 'citizenToolKit.controllers.organization.UpdateFieldAction',
		'update'						=> 'citizenToolKit.controllers.organization.UpdateAction',
		'disabled'						=> 'citizenToolKit.controllers.organization.DisableAction',
		'join'							=> 'citizenToolKit.controllers.organization.JoinAction',
		'addneworganizationasmember'	=> 'citizenToolKit.controllers.organization.AddNewOrganizationAsMemberAction',
		'dashboard'						=> 'citizenToolKit.controllers.organization.DashboardAction',
		'dashboard1'					=> 'citizenToolKit.controllers.organization.Dashboard1Action',
		'detail'						=> 'citizenToolKit.controllers.organization.DetailAction',
		'simply'						=> 'citizenToolKit.controllers.organization.DetailAction',
		'dashboardmember'				=> 'citizenToolKit.controllers.organization.DashboardMemberAction',
		'news'							=> 'citizenToolKit.controllers.organization.NewsAction',
		'sig'							=> 'citizenToolKit.controllers.organization.SigAction',
		'directory'   					=> 'citizenToolKit.controllers.organization.DirectoryAction',
		'addmember'   					=> 'citizenToolKit.controllers.organization.AddMemberAction',
		'declaremeadmin'   				=> 'citizenToolKit.controllers.organization.DeclareMeAdminAction',
		);
	}	
}