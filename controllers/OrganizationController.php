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
		'savenew'						=> 'citizenToolKit.controllers.organization.SaveNewAction',
		'updatefield'					=> 'citizenToolKit.controllers.organization.UpdateFieldAction',
		'delete'						=> 'citizenToolKit.controllers.organization.DeleteAction',
		'join'							=> 'citizenToolKit.controllers.organization.JoinAction',
		'addneworganizationasmember'	=> 'citizenToolKit.controllers.organization.AddNewOrganizationAsMemberAction',
		'dashboard'						=> 'citizenToolKit.controllers.organization.DashboardAction',
		'dashboard1'					=> 'citizenToolKit.controllers.organization.Dashboard1Action',
		'dashboardmember'				=> 'citizenToolKit.controllers.organization.DashboardMemberAction',
		'news'							=> 'citizenToolKit.controllers.organization.NewsAction',
		'sig'							=> 'citizenToolKit.controllers.organization.SigAction',
		);
	}	
}