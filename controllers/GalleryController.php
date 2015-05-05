<?php
/**
 * EventController.php
 * 
 * contient tous ce qui concerne les utilisateurs / clietns TEEO
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 18/07/2014
 */
class GalleryController extends CommunecterController {

		protected function beforeAction($action) {
			parent::initPage();
			return parent::beforeAction($action);
		}

	public function actionIndex($id, $type){
		$params = array();
		$params["itemId"] = $id;
		$params['itemType'] = $type;
		$this->title = "My Gallery";
		$this->subTitle = "";
		$this->render("gallery", $params);
	}
	public function actionGetListById($id, $type){
		$result = Document::getWhere(array("id" => $id,
											"type" => $type));
		Rest::json($result);
	}

	public function actionRemoveById($id){
		
		Document::removeDocumentById($id);
		return Rest::json(array("result" => true));
	}
}