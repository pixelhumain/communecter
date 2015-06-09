<?php
class ActStr {

	//All events taht can be loggued into the activity stream
	const TEST = "test"; 
	const ICON_QUESTION = "fa-question";
	
	public static function buildEntry($params)
    {
        $action = array(
              "type" => $params["type"],
              "codeInsee" => $params["codeInsee"],
              "verb"=> $params["verb"],
              "date" => date("Y-m-d H:i:s"),
              "timestamp" => time(),
              "actor" =>  array( 
                "objectType" => $params["actorType"], 
                "id" => ( isset(Yii::app()->session["userId"]) ) ? Yii::app()->session["userId"] : "unknown"
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