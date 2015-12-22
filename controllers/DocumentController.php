<?php
/**
 * SiteController.php
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class DocumentController extends CommunecterController {
  
	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
  	}

	public function actions()
	{
	    return array(
	        //CTK actions
	        'list'					=> 'citizenToolKit.controllers.document.ListAction',
	        'save'					=> 'citizenToolKit.controllers.document.SaveAction',
	        'deletedocumentbytid'	=> 'citizenToolKit.controllers.document.DeleteDocumentByIdAction',
            'delete'                => 'citizenToolKit.controllers.document.DeleteAction',
            'upload'                => 'citizenToolKit.controllers.document.UploadAction',
            'uploads'               => 'citizenToolKit.controllers.document.UploadsAction',
            'getlistbyid'           => 'citizenToolKit.controllers.document.GetListByIdAction',

	        'resized' => array (
	            'class'   => 'ext.resizer.ResizerAction',
	            'options' => array(
	                // Tmp dir to store cached resized images 
	                'cache_dir'   => Yii::getPathOfAlias('webroot') . '/assets/',	 
	                // Web root dir to search images from
	                'base_dir'    => Yii::getPathOfAlias('webroot') . '/',
	            )
	        )
	    );
	}

    //Not use ???
    function clean($string) {
       $string = preg_replace('/  */', '-', $string);
       $string = strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'); // Replaces all spaces with hyphens.
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    

}