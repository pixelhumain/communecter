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
class ProjectController extends CommunecterController {
    const moduleTitle = "Projet";
    
    protected function beforeAction($action) {
    	parent::initPage();
    	return parent::beforeAction($action);
  	}

    public function actionIndex() 
    {
	    $this->render("index");
	}

    public function actionEdit($id) 
    {
        $project = Project::getById($id);
        $this->render("edit",array('projet'=>$projet));
	}

	public function actionPublic($id){
	    //get The project Id
	    if (empty($id)) {
	      throw new CommunecterException("The project id is mandatory to retrieve the project !");
	    }

	    $project = Project::getPublicData($id);
	    
	    $this->title = (isset($project["name"])) ? $project["name"] : "";
	    $this->subTitle = (isset($project["description"])) ? $project["description"] : "";
	    $this->pageTitle = "Communecter - Informations publiques de ".$this->title;


	    $this->render("public", array("project" => $project));
  	}

    //**********
	// Old - Still used ?
	//**********
    public function actionList($ownerId) 
    {
	    $list = Yii::app()->mongodb->groups->find(array("type" => "projet", "owner" => new MongoId($ownerId) ));
	    $owner = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($ownerId)));
	    $this->render( "list" , array( 'owner'=>$owner, 'list' => $list ));
	}
    public function actionPeople($id,$type) 
    {
	    $projet = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
	    $this->render( "people" , array( 'projet' => $projet,"typePeople"=>$type ));
	}
    public function actionOrganigrid($id,$type,$design="s") 
    {
	    $projet = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
	    $this->render( "organigrid" , array( 'projet' => $projet,"typePeople"=>$type,"design"=>$design ));
	}
    public function actionCreer() 
    {
	    $this->render("new");
	}
}