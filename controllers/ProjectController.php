<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH pour les associations
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class ProjectController extends CommunecterController {
  	const moduleTitle = "Projet";
  	protected function beforeAction($action)
  	{
		parent::initPage();
		return parent::beforeAction($action);
  	}
  	public function actionIndex() 
    {
	    $this->render("index");
	}
	public function actions()
	{
		return array(
		// captcha action renders the CAPTCHA image displayed on the contact page
		'captcha'=>array(
		 	'class'=>'CCaptchaAction',
		 	'backColor'=>0xFFFFFF,
		),
		'edit'       				=> 'citizenToolKit.controllers.project.EditAction',
		'removeproject'				=> 'citizenToolKit.controllers.project.RemoveProjectAction',
		'save'						=> 'citizenToolKit.controllers.project.SaveAction',
		'update'					=> 'citizenToolKit.controllers.project.UpdateAction',
		'dashboard'					=> 'citizenToolKit.controllers.project.DashboardAction',
		'detail'					=> 'citizenToolKit.controllers.project.DetailAction',
		'simply'					=> 'citizenToolKit.controllers.project.DetailAction',
		'savecontributor'			=> 'citizenToolKit.controllers.project.SaveContributorAction',
		'editchart'					=> 'citizenToolKit.controllers.project.EditChartAction',
		'updatefield'				=> 'citizenToolKit.controllers.project.UpdateFieldAction',
		'projectsv'					=> 'citizenToolKit.controllers.project.ProjectSVAction',
		'addcontributorsv'			=> 'citizenToolKit.controllers.project.AddContributorSvAction',
		'addchartsv'				=> 'citizenToolKit.controllers.project.AddChartSvAction',
		'directory'   				=> 'citizenToolKit.controllers.project.DirectoryAction',
		'get'   					=> 'citizenToolKit.controllers.project.GetAction',
		/*'delete'						=> 'citizenToolKit.controllers.organization.DeleteAction',
		'join'							=> 'citizenToolKit.controllers.organization.JoinAction',
		'addneworganizationasmember'	=> 'citizenToolKit.controllers.organization.AddNewOrganizationAsMemberAction',
		'dashboard'						=> 'citizenToolKit.controllers.organization.DashboardAction',
		'dashboard1'					=> 'citizenToolKit.controllers.organization.Dashboard1Action',
		'dashboardmember'				=> 'citizenToolKit.controllers.organization.DashboardMemberAction',
		'news'							=> 'citizenToolKit.controllers.organization.NewsAction',
		'sig'							=> 'citizenToolKit.controllers.organization.SigAction',*/
		);
	}	
//}
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme de projet
 * comment agir localeement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
//class ProjectController extends CommunecterController {
  //  const moduleTitle = "Projet";
    
   /* protected function beforeAction($action) {
    	parent::initPage();
    	return parent::beforeAction($action);
  	}

    public function actionIndex() 
    {
	    $this->render("index");
	}*/

  /*  public function actionEdit($id) 
    {
        $project = Project::getById($id);
        $citoyens = array();
		$organizations = array();
		if (isset($project['links']["contributors"]) && !empty($project['links']["contributors"])) 
		{
		  foreach ($project['links']["contributors"] as $id => $e) 
		  {
		  	
		  	if (!empty($project)) {
		  		if($e["type"] == "citoyens"){
		  			$citoyen = PHDB::findOne( PHType::TYPE_CITOYEN, array( "_id" => new MongoId($id)));
		  			array_push($citoyens, $citoyen);
		  		}else if($e["type"] == "organizations"){
		      		$organization = PHDB::findOne( Organization::COLLECTION, array( "_id" => new MongoId($id)));
		      		array_push($organizations, $organization);
		  		}
		    } else {
		     // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
		    }  	
		  }
		}
        $this->render("edit",array('project'=>$project, 'organizations'=>$organizations, 'citoyens'=>$citoyens));
	}*/
	// A voir si utile
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
   /* public function actionList($ownerId) 
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
	}*/

}