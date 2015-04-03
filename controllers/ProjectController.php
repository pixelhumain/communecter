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
		      		$organization = PHDB::findOne( PHType::TYPE_ORGANIZATIONS, array( "_id" => new MongoId($id)));
		      		array_push($organizations, $organization);
		  		}
		    } else {
		     // throw new CommunecterException("Données inconsistentes pour le citoyen : ".Yii::app()->session["userId"]);
		    }  	
		  }
		}         
        $this->render("edit",array('project'=>$project, 'organizations'=>$organizations, 'citoyens'=>$citoyens));
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

	public function actionSave(){
		if( isset($_POST['title']) && !empty($_POST['title']))
      {
        //TODO check by key
            $project = PHDB::findOne(PHType::TYPE_PROJECTS ,array( "name" => $_POST['title']));
            if(!$project)
            { 
               //validate isEmail
               $res = Project::saveProject($_POST);
               echo json_encode($res);
            } else
                   echo json_encode(array("result"=>false, "msg"=>"Ce projet existe déjà."));
    } else
        echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
    exit;
	}


  public function actionSaveContributor(){
  	$res = array( "result" => false , "content" => "Something went wrong" );
	if(Yii::app()->request->isAjaxRequest && isset( $_POST["id"]) )
	{
		$event = (isset($_POST["id"])) ? PHDB::findOne( PHType::TYPE_PROJECTS,array("_id"=>new MongoId($_POST["id"]))) : null;
	
		if($event)
		{
			if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['email']))
			{
				if($_POST['type'] == "persons"){
					$member = PHDB::findOne( PHType::TYPE_CITOYEN , array("email"=>$_POST['email']));
					$memberType = PHType::TYPE_CITOYEN;
				}
				else
				{
					$member = PHDB::findOne( PHType::TYPE_ORGANIZATIONS , array("email"=>$_POST['email']));
					$memberType = PHType::TYPE_ORGANIZATIONS;
				}

				if( !$member )
				{
					if($_POST['type'] == "persons"){
					 $member = array(
					 'name'=>$_POST['name'],
					 'email'=>$_POST['email'],
					 'invitedBy'=>Yii::app()->session["userId"],
					 'tobeactivated' => true,
					 'created' => time(),
					 'links'=>array( 'projects' => array($_POST["id"] =>array("type" => $_POST["type"],
					 															"tobeconfirmed" => true,
					 															"invitedBy" => Yii::app()->session["userId"]
					 														)
					 									)
					 			)
					 );
					  Person::createAndInvite($member);
					 } else {
						 $member = array(
						 'name'=>$_POST['name'],
						 'email'=>$_POST['email'],
						 'invitedBy'=>Yii::app()->session["userId"],
						 'tobeactivated' => true,
						 'created' => time(),
						 'type'=>'Group',
						 'links'=>array( 'projects' => array($_POST["id"] =>array("type" => $_POST["type"],
					 															"tobeconfirmed" => true,
					 															"invitedBy" => Yii::app()->session["userId"]
					 														)
					 									)
					 			)
						 );

						 Organization::createAndInvite($member);
					 }

					Link::connect($_POST["id"], PHType::TYPE_PROJECTS,$member["_id"], $memberType, Yii::app()->session["userId"], "contributors" );
					
					$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);

				}else{

					if( isset($event['links']["contributors"]) && isset( $event['links']["contributors"][(string)$member["_id"]] ))
						$res = array( "result" => false , "content" => "member allready exists" );
					else {
						Link::connect($member["_id"], $memberType, $_POST["id"], PHType::TYPE_PROJECTS, Yii::app()->session["userId"], "projects" );
						Link::connect($_POST["id"], PHType::TYPE_PROJECTS, $member["_id"], $memberType, Yii::app()->session["userId"], "contributors" );
						$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);

					}
				}
			}else
				$res = array( "result" => false , "content" => "email must be valid" );
		}
	}
	 Rest::json( $res );
  }
}