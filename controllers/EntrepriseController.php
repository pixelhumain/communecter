<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH pour les entrpises
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class EntrepriseController extends CommunecterController {
    const moduleTitle = "Entreprise";
    
	public function actionIndex() {
	    $this->layout = "swe";
	    $this->render("index");
	}
    public function actionView($id) {
        $this->layout = "swe";
        $asso = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
        if(isset($asso["key"]) )
            $this->redirect(Yii::app()->createUrl('index.php/entreprise/'.$asso["key"]));
        else    
	        $this->render("view",array('asso'=>$asso));
	}
    public function actionCreer() {
	    $this->render("form");
	}
}