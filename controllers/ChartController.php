<?php
/**
 * ChartController.php
 *
 *
 * @author: Bouboule
 * Date: 24/06/2015
 */
class ChartController extends CommunecterController {

    protected function beforeAction($action) {
    	parent::initPage();
    	return parent::beforeAction($action);
  	}
  	public function actions()
	{
	    return array(
	        'index'       		=> 'citizenToolKit.controllers.chart.IndexAction',
			'addchartsv'       => 'citizenToolKit.controllers.chart.AddChartSvAction',
			'editchart'       => 'citizenToolKit.controllers.chart.EditChartAction',
			'get'       => 'citizenToolKit.controllers.chart.GetJsonAction',
	    );
	}
}