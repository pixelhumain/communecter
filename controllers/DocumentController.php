<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class DocumentController extends CommunecterController {
  

	/**
	 * opens on a country
	 * @param string $type : pays || region || commune
	 * @param $id : france || code postale
	 */
	public function actionSave() {
	      return Rest::json( Document::save($_POST) );
	}

	/**
	* delete a document
	* @param $id id of the document that we went to delete
	*/
	public function actionDeleteDocumentById($id){
		return Rest::json( Document::removeDocumentById($id));
	}

	/**
	*
	*
	*/

	public function actionRemoveAndBacktract(){
		$result = array("result"=>false,"msg"=>"Vos données n'ont pas pu être modifier");
		if(isset($_POST["_id"])){
			Document::removeDocumentById($_POST["_id"]);
			Document::setImagePath($_POST["id"], $_POST["type"], $_POST["imagePath"], $_POST["contentKey"]);
			$result = array("result"=>true,"msg"=>"Vos données ont bien été modifier");
		}
		return Rest::json($result);
	}
}