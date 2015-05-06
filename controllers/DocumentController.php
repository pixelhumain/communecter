<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class DocumentController extends CommunecterController {
  
	public function actions()
	{
	    return array(
	        'resized' => array(
	            'class'   => 'ext.resizer.ResizerAction',
	            'options' => array(
	                // Tmp dir to store cached resized images 
	                'cache_dir'   => Yii::getPathOfAlias('webroot') . '/assets/',
	 
	                // Web root dir to search images from
	                'base_dir'    => Yii::getPathOfAlias('webroot') . '/',
	            )
	        ),
	    );
	}


	public function actionSave() {
	      return Rest::json( Document::save($_POST) );
	}

	/**
	* delete a document
	* @param $id id of the document that we want to delete
	*/
	public function actionDeleteDocumentById($id){
		return Rest::json( Document::removeDocumentById($id));
	}

	public function actionRemoveAndBacktract(){
		$result = array("result"=>false,"msg"=>"Vos données n'ont pas pu être modifiées");
		if(isset($_POST["_id"])){
			Document::removeDocumentById($_POST["_id"]);
			Document::setImagePath($_POST["id"], $_POST["type"], $_POST["imagePath"], $_POST["contentKey"]);
			$result = array("result"=>true,"msg"=>"Vos données ont bien été modifiées");
		}
		return Rest::json($result);
	}
}