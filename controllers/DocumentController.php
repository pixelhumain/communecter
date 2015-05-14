<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
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
	        'removebacktrack'		=> 'citizenToolKit.controllers.document.RemoveAndBacktractAction',

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

	public function actionIndex() 
    {
       $name = "index";
       if(isset($_GET["name"])) 
           $name = $_GET["name"];
       if(in_array($name,array("listPage","hexagon","formLarge","mapael_france","mapael_france2","hoverEffects","nodesLabels","scrollImages","menuVerticaleGch","blogPost","onePageNav",
       							"sondagRond","graphGroups"))) 
           $this->layout = "empty";
	   
       $this->render($name);
	}
    public function actionUpload($dir,$folder=null,$ownerId=null,$input,$rename=false) 
    {
        
        $upload_dir = 'upload/';
        if(!file_exists ( $upload_dir ))
            mkdir ( $upload_dir,0775 );
        
        //ex: upload/communecter
        $upload_dir = 'upload/'.$dir.'/';
        if(!file_exists ( $upload_dir ))
            mkdir ( $upload_dir,0775 );

        //ex: upload/communecter/person
        if( isset( $folder )){
            $upload_dir .= $folder.'/';
            if( !file_exists ( $upload_dir ) )
                mkdir ( $upload_dir,0775 );
        }

        //ex: upload/communecter/person/userId
        if( isset( $ownerId ))
        {
            $upload_dir .= $ownerId.'/';
            if( !file_exists ( $upload_dir ) )
                mkdir ( $upload_dir,0775 );
        }
        
        $allowed_ext = array('jpg','jpeg','png','gif',"pdf","xls","xlsx","doc","docx","ppt","pptx");
        
        if(strtolower($_SERVER['REQUEST_METHOD']) != 'post')
        {
    	    echo json_encode(array('result'=>false,'error'=>'Error! Wrong HTTP method!'));
	        exit;
        }

        if(array_key_exists($input,$_FILES) && $_FILES[$input]['error'] == 0 )
        {
        	
        	$pic = $_FILES[$input];
        	$ext = strtolower(pathinfo($pic['name'], PATHINFO_EXTENSION));
        	if(!in_array($ext,$allowed_ext))
            {
        		echo json_encode(array('result'=>false,'error'=>'Only '.implode(',',$allowed_ext).' files are allowed!'));
    	        exit;
        	}	
        
        	// Move the uploaded file from the temporary 
        	// directory to the uploads folder:
        	//we use a unique Id for the iamge name Yii::app()->session["userId"].'.'.$ext
            //renaming file
        	$name = ($rename) ? Yii::app()->session["userId"].'.'.$ext : $pic['name'];
            if( file_exists ( $upload_dir.$name ) )
                $name = time()."_".$name;
        	if( isset(Yii::app()->session["userId"]) && $name && move_uploaded_file($pic['tmp_name'], $upload_dir.$name))
            {   
        		echo json_encode(array('result'=>true,
                                        "success"=>true,
                                        'name'=>$name,
                                        'dir'=> $upload_dir,
                                        'size'=>self::human_filesize ( filesize ( $upload_dir.$name ) ) ));
    	        exit;
        	}
        }
        echo json_encode(array('result'=>false,'error'=>'Something went wrong with your upload!'));
    	exit;
	}

    public function actionUploads($dir,$collection=null,$input,$rename=false) 
    {
        
        $upload_dir = 'upload/';
        if(!file_exists ( $upload_dir ))
            mkdir ( $upload_dir );
        
        $upload_dir = 'upload/'.$dir.'/';
        if(!file_exists ( $upload_dir ))
            mkdir ( $upload_dir );

        if( isset( $collection ))
            $dir .= '/'.$collection.'/';
        $upload_dir = 'upload/'.$dir.'/';
        if(!file_exists ( $upload_dir ))
            mkdir ( $upload_dir );
        
        $allowed_ext = array('jpg','jpeg','png','gif',"pdf","xls","xlsx","doc","docx","ppt","pptx");
        
        if(strtolower($_SERVER['REQUEST_METHOD']) != 'post')
        {
            echo json_encode(array('result'=>false,'error'=>'Error! Wrong HTTP method!'));
            exit;
        }
        
        if(array_key_exists($input,$_FILES) && $_FILES[$input]['error'] == 0 )
        {
            foreach ( $_FILES[$input]["name"] as $key => $value ) 
            {
                $ext = pathinfo($_FILES[$input]['name'][$key], PATHINFO_EXTENSION);
                if(!in_array($ext,$allowed_ext))
                {
                    echo json_encode(array('result'=>false,'error'=>'Only '.implode(',',$allowed_ext).' files are allowed!'));
                    exit;
                }   
            
                // Move the uploaded file from the temporary 
                // directory to the uploads folder:
                // we use a unique Id for the iamge name Yii::app()->session["userId"].'.'.$ext
                // renaming file
                $name = ($rename) ? Yii::app()->session["userId"].'.'.$ext : $_FILES[$input]['name'][$key];
                if( isset(Yii::app()->session["userId"]) && $name && move_uploaded_file($_FILES[$input]['tmp_name'][$key], $upload_dir.$name))
                {   
                    echo json_encode(array('result'=>true,
                                            "success"=>true,
                                            'name'=>$name,
                                            'dir'=> $upload_dir,
                                            'size'=>self::human_filesize ( filesize ( $upload_dir.$name ) ) ));
                    exit;
                }
            }
        }
        
        echo json_encode(array('result'=>false,'error'=>'Something went wrong with your upload!'));
        exit;
    }

    public function actionDelete($dir,$type) 
    {
        $filepath = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$_POST['parentId'].DIRECTORY_SEPARATOR.$_POST['name'];
        if(isset(Yii::app()->session["userId"]) && file_exists ( $filepath ))
        {
            if(unlink($filepath))
            {
                Document::removeDocumentById($_POST['docId']);
                echo json_encode(array('result'=>true));
            }
            else
                echo json_encode(array('result'=>false,'error'=>'Something went wrong!'));

            if(isset($_POST['parentId']) && isset($_POST['parentType']) && isset($_POST['pictureKey']) && isset($_POST['path'])){
            	Document::setImagePath($_POST['parentId'], $_POST['parentType'], "", $_POST['pictureKey']);
            }
        } 
        else 
        {
            $doc = Document::getById( $_POST['docId'] );
            if( $doc )
                Document::removeDocumentById($_POST['docId']);
            echo json_encode(array('result'=>false,'error'=>'Something went wrong!',"filepath"=>$filepath));
        }
    }

    function human_filesize($bytes, $decimals = 2) {
      $sz = 'BKMGTP';
      $factor = floor((strlen($bytes) - 1) / 3);
      return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    function clean($string) {
       $string = preg_replace('/  */', '-', $string);
       $string = strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ','aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY'); // Replaces all spaces with hyphens.
       return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
    
    public function actionPage($name){
        $page = Yii::app()->mongodb->data->findOne(array("key"=>$name,
        												 "type"=>"page"));
        $this->pageTitle = ((isset($page["title"])) ? $page["title"] : strtoupper($name) ).", Pixel Humain : 1er Réseau Social Citoyen Libre";
        $this->inlinePageTitle = strtoupper($name);
        $this->render("active/".$name, array( "name" => $name ));
        
    }

    public function actionBrowser($folder){
        $this->layout = "empty";
        $this->render("browser", array( "folder" => $folder ));
    }
}