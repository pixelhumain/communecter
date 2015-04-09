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
}