<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme de projet
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ProjetController extends Controller {
    const moduleTitle = "Projet";
    public function actionIndex() 
    {
	    $this->layout = "swe";
	    $this->render("index");
	}
    public function actionList($ownerId) 
    {
	    $this->layout = "swe";
	    $list = Yii::app()->mongodb->groups->find(array("type" => "projet", "owner" => new MongoId($ownerId) ));
	    $owner = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($ownerId)));
	    $this->render( "list" , array( 'owner'=>$owner, 'list' => $list ));
	}
    public function actionPeople($id,$type) 
    {
	    $this->layout = "swe";
	    $projet = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
	    $this->render( "people" , array( 'projet' => $projet,"typePeople"=>$type ));
	}
    public function actionOrganigrid($id,$type,$design="s") 
    {$this->layout = "blanck";
	    $projet = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
	    $this->render( "organigrid" , array( 'projet' => $projet,"typePeople"=>$type,"design"=>$design ));
	}
    public function actionView($id) 
    {
        $projet = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
        $this->render("view",array('projet'=>$projet));
	}
    public function actionCreer() 
    {
	    $this->render("new");
	}
	
}