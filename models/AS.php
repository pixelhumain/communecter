<?php
class AS {

	//All events taht can be loggued into the activity stream
	const ESO_TASK_ADDED = "esoTaskAdded"; 
	const ESO_TASK_MODIFIED = "esoTaskModified";
	const ESO_TASK_DELETED = "esoTaskDeleted";

	const ESO_ADDED = "esoAdded";
	const ESO_MODIFIED = "esoModified";	
	const ESO_DELETED = "esoDeleted";	

	const PERIMETER_ADDED = "perimeterAdded";
	const PERIMETER_MODIFIED = "perimeterModified";	
	const PERIMETER_DELETED = "perimeterDeleted";
	
	public static function buildEntry($params)
    {
        $action = array(
              "type" => $params["type"],
              "verb"=> $params["verb"],
              "date" => date("Y-m-d H:i:s"),
              "timestamp" => time(),
              "actor" =>  array( 
                "objectType" => $params["actorType"], 
                "id" => Yii::app()->session["userId"]
              ),
              "object"=> array(
                "objectType"=> $params["objectType"], 
                "displayName"=> $params["label"], 
                "id" => $params["id"]
              )
            );
        return $action;
    }
}