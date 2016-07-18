<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class GraphController extends CommunecterController {

    protected function beforeAction($action) {
        parent::initPage();
		    return parent::beforeAction($action);
  	}

  	public function actions()
	{
	    return array(
	        'getdata'  => 'citizenToolKit.controllers.graph.GetDataAction',
	        'viewer'   => 'citizenToolKit.controllers.graph.ViewerAction'
	    );
	}
}
