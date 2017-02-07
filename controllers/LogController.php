<?php
/**
 * LogController.php
 *
 * @author: Childéric THOREAU <childericthoreau@gmail.com>
 * Date: 7/29/15
 * Time: 12:25 AM
 */
class LogController extends CommunecterController {

	public function actions()
	{
	    return array(
	        'monitoring'    	 	 => 'citizenToolKit.controllers.log.MonitoringAction',
	        'cleanup'    			 => 'citizenToolKit.controllers.log.CleanUpAction'
	    );
	}

	public function actionDbaccess() 
	{
    	echo Yii::app()->session["dbAccess"];
  	}
  	public function actionClear() 
	{
    	Yii::app()->session["dbAccess"] = 0;
    	echo Yii::app()->session["dbAccess"];
  	}
}