<?php
/**
 * SiteController.php
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 * Date: 7/23/12
 * Time: 12:25 AM
 */
class DecouvrirController extends CommunecterController {
    const moduleTitle = "decouvrir";
    
	public function accessRules() {
		return array(
			// not logged in users should be able to login and view captcha images as well as errors
			array('allow', 'actions' => array('index','save')),
			// logged in users can do whatever they want to
			array('allow', 'users' => array('@')),
			// not logged in users can't do anything except above
			array('deny'),
		);
	}

	/**
	 * Declares class-based actions.
	 * @return array
	 */
	public function actions() {
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}

	/**
	 * opens on a country
	 * @param string $type : pays || region || commune
	 * @param $id : france || code postale
	 */
	public function actionIndex() {
	    $page = 'index';
	    $type = 'commune';
	    if(isset($_GET["type"])){
	        $page = $_GET["type"];
	        $type = $_GET["type"];
	    }

	    $id = null;
	    if(isset($_GET["id"]))
	        $id = $_GET["id"];

	    //prepare the data
	        
	    $this->render($page);
	}
    public function actionMap() {
	    $page = 'map';
	    
	    $this->render($page);
	}
	
    public function actionSave() {
        Yii::app()->mongodb->test->save(array('name'=>'titi'));
        $cursorNature = Yii::app()->mongodb->test->find();
		foreach ($cursorNature as $a)
		    echo $a['name'].'</br>';
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError() {
		if ($error = Yii::app()->errorHandler->error) {
			if (Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

}