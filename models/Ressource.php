<?php 
class Ressource {

	const collection = "ressources";
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

	public static function save($params){
		//$id = Yii::app()->session["userId"];
	    $new = array(
			"id" => $params['id'],
	  		"type" => $params['type'],
	  		"moduleId" => $params['moduleId'],

	  		"author" => $params['author'],
	  		"name" => $params['name'],
	  		"size" => $params['size'],
	  		"category" => $params['category'],
	  		'created' => time()
	    );

	    PHDB::insert(self::collection,$new);
	    //Link::connect($id, $type, $new["_id"], PHType::TYPE_PROJECTS, $id, "projects" );
	    return array("result"=>true, "msg"=>"Votre ressource est enregistré.", "id"=>$new["_id"]);	
	}
}
?>