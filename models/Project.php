<?php 
class Project {

	/**
	 * get an project By Id
	 * @param type $id : is the mongoId of the project
	 * @return type
	 */
	public static function getById($id) {
	  	return PHDB::findOne( PHType::TYPE_PROJECTS,array("_id"=>new MongoId($id)));
	}

	/**
	 * Get an project from an id and return filter data in order to return only public data
	 * @param type $id 
	 * @return project structure
	 */
	public static function getPublicData($id) {
		//Public datas 
		$publicData = array (
		);

		//TODO SBAR = filter data to retrieve only publi data	
		$project = Project::getById($id);
		if (empty($project)) {
			throw new CommunecterException("The project id is unknown ! Check your URL");
		}

		return $project;
	}

	public static function saveProject($params){
		$id = Yii::app()->session["userId"];
	    $type = PHType::TYPE_CITOYEN;
	    $new = array(
			"name" => $params['title'],
			'url' => $params['url'],
			'version' => $params['version'],
			'licence' => $params['licence'],
			'created' => time(),
			"links" => array( 
				"contributors" => array( (string)$id =>array("type" => $type)), 
				"organizer" => array((string)$id =>array("type" => $type)),  
			),
	    );
	    PHDB::insert(PHType::TYPE_PROJECTS,$new);
	    $where = array("_id" => new MongoId(Yii::app()->session["userId"]));
	    PHDB::update(PHType::TYPE_CITOYEN,$where, array('$push' => array("projects"=>$new["_id"])));
	    return array("result"=>true, "msg"=>"Votre projet est communecté.", "id"=>$new["_id"]);	
	}
}
?>