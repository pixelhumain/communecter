<?php
	/**
 * PodController.php
 *
 */

class PodController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'slideragenda'      => 'citizenToolKit.controllers.pod.SliderAgendaAction',
	        'photovideo'     	=> 'citizenToolKit.controllers.pod.PhotoVideoAction',
	        'fileupload'     	=> 'citizenToolKit.controllers.pod.FileUploadAction'
	    );
	}

}
?>