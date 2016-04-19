<?php
/**
 * AdminController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class AdminController extends CommunecterController {
  

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'       => 'citizenToolKit.controllers.admin.IndexAction',
	        'directory'   => 'citizenToolKit.controllers.admin.DirectoryAction',
	        'switchto'    => 'citizenToolKit.controllers.admin.SwitchtoAction',
	        'delete'      => 'citizenToolKit.controllers.admin.DeleteAction',
	        'activateuser'=> 'citizenToolKit.controllers.admin.ActivateUserAction',
	        'importdata'  => 'citizenToolKit.controllers.admin.ImportDataAction',
	        'previewdata'  => 'citizenToolKit.controllers.admin.PreviewDataAction',
	        'importinmongo'  => 'citizenToolKit.controllers.admin.ImportInMongoAction',
	        'assigndata'  => 'citizenToolKit.controllers.admin.AssignDataAction',
	        'checkdataimport'  => 'citizenToolKit.controllers.admin.CheckDataImportAction',
	        'openagenda'  => 'citizenToolKit.controllers.admin.OpenAgendaAction',
	        'checkventsopenagendaindb'  => 'citizenToolKit.controllers.admin.CheckEventsOpenAgendaInDBAction',
	        'importeventsopenagendaindb'  => 'citizenToolKit.controllers.admin.ImportEventsOpenAgendaInDBAction',
	        'checkgeocodage'  => 'citizenToolKit.controllers.admin.CheckGeoCodageAction',
	        'getentitybadlygeolocalited'  => 'citizenToolKit.controllers.admin.GetEntityBadlyGeoLocalitedAction',
	        'getdatabyurl' => 'citizenToolKit.controllers.admin.GetDataByUrlAction',
	        'adddata' => 'citizenToolKit.controllers.admin.AddDataAction',
	        'adddataindb' => 'citizenToolKit.controllers.admin.AddDataInDbAction',
	        'createfileforimport' => 'citizenToolKit.controllers.admin.CreateFileForImportAction',
	        'sourceadmin' => 'citizenToolKit.controllers.admin.SourceAdminAction',
	        'checkcities' => 'citizenToolKit.controllers.admin.CheckCitiesAction'
	    );
	}
}