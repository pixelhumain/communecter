
<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class NetworkController extends CommunecterController {

    
    protected function beforeAction($action){
    	parent::initPage();
    	return parent::beforeAction($action);
    }

	public function actionSimplyDirectory(){
		//$params = self::getParams(@$_GET['params']);
		$this->layout = "//layouts/mainSearch";
		$this->render("simplyDirectory");
	}
}
 ?>