<?php
class ActStr {

	//All events taht can be loggued into the activity stream
	const TEST = "test"; 
	const ICON_QUESTION = "fa-question";

  const VIEW_PAGE = "viewPage";

  const VERB_VIEW = "view";
  const VERB_ADD = "add";
  const VERB_UPDATE = "update";
  const VERB_CREATE = "create";
  const VERB_DELETE = "delete";

  const TYPE_URL = "url";
	
	public static function buildEntry($params)
    {
        $action = array(
            "type" => $params["type"],
            "verb" => $params["verb"],
            "date" => date("Y-m-d H:i:s"),
            "timestamp" => time(),
            "actor" =>  array( 
              "objectType" => $params["actorType"], 
              "id" => ( isset(Yii::app()->session["userId"]) ) ? Yii::app()->session["userId"] : null
            ),
            "object"=> array(
              "objectType"=> $params["objectType"],
              "id" => $params["id"]
            )
        );

        if( isset( $params["ip"] ))
            $action["actor"]["ip"] = $params["ip"];
        if( isset( $params["codeInsee"] ))
            $action["codeInsee"] = $params["codeInsee"];
        if( isset( $params["label"] ))
            $action["object"]["displayName"] = $params["label"];

      return $action;
    }

    public static function viewPage ($url)
    {
        $asParam = array("type" => ActStr::VIEW_PAGE, 
                      "verb" => ActStr::VERB_VIEW,
                      "actorType" => Person::COLLECTION,
                      "objectType" => ActStr::TYPE_URL,
                      "id" => $url,
                      "ip" => $_SERVER['REMOTE_ADDR']
                  );
        $action = self::buildEntry($asParam);
        ActivityStream::addEntry($action);
    }
    
}