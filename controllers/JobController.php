<?php
/**
 * JobController.php
 *
 * Create, update and manage Jobs offers
 *
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 31/03/2015
 */
class JobController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}
	
	public function actions()
	{
	    return array(
	        'save'       	=> 'citizenToolKit.controllers.job.SaveAction',
	        'delete'		=> 'citizenToolKit.controllers.job.DeleteAction',
	        'list'			=> 'citizenToolKit.controllers.job.ListAction',
	        'public'		=> 'citizenToolKit.controllers.job.PublicAction',
	    );
	}

	public function getCollectionFieldName($fieldName) {
		if ($fieldName == "address") 
			return "jobLocation.address";
		else if ($fieldName == "jobLoc") 
			return "jobLocation.description";
		//specific case for tagsJob
		else if ($fieldName == "tagsJob") 
			return "tags";
		else
			return $fieldName;
	}
}