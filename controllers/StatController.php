<?php
/**
 * StatController.php
 *
 * @author: Childéric THOREAU <childericthoreau@gmail.com>
 * Date: 3/18/16
 * Time: 12:25 AM
 */
class StatController extends CommunecterController {

	public function actions()
	{
	    return array(
	        'createglobalstat'    	 => 'citizenToolKit.controllers.stat.CreateGlobalStatAction',
	        'getstatjson'    	 	 => 'citizenToolKit.controllers.stat.GetStatJsonAction',
	        'chartglobal'    	 	 => 'citizenToolKit.controllers.stat.ChartGlobalAction',
	        'chartlogs'    	 	 	 => 'citizenToolKit.controllers.stat.ChartLogsAction',
	    );
	}
}