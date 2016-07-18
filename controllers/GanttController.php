<?php
/**
 * DiscussController.php
 *
 *
 * @author: Sylvain Barbot
 * Date: 24/06/2015
 */
class GanttController extends CommunecterController {

    protected function beforeAction($action) {
    	parent::initPage();
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       		=> 'citizenToolKit.controllers.gantt.IndexAction',
			'savetask'  		=> 'citizenToolKit.controllers.gantt.SaveTaskAction',
			'removetask'   		=> 'citizenToolKit.controllers.gantt.RemoveTaskAction',
			'generatetimeline'  => 'citizenToolKit.controllers.gantt.GenerateTimelineAction',
			'addtimesheetsv'	=> 'citizenToolKit.controllers.gantt.AddTimesheetSvAction',
	    );
	}
}