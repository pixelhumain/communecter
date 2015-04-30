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
		  return parent::beforeAction($action);
  	}

  	public function actionViewer() { $this->renderPartial("viewer");} 

  	public function actionGetData($id, $type) {
  		$item = PHDB::findOne( $type ,array("_id"=>new MongoId($id)));
  		echo Rest::json($item);
  	}
}
