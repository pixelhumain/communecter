<?php
class ActStr {

	//All events taht can be loggued into the activity stream
	const TEST = "test"; 
	const ICON_QUESTION = "fa-question";
    const ICON_SHARE = "fa-share-alt";
    const ICON_COMMENT = "fa-comment";
    const ICON_CLOSE = "fa-times";

    const VIEW_PAGE = "viewPage";

    const VERB_VIEW = "view";
    const VERB_ADD = "add";
    const VERB_UPDATE = "update";
    const VERB_CREATE = "create";
    const VERB_DELETE = "delete";
      
    const VERB_JOIN = "join";
    const VERB_LEAVE = "leave";
    const VERB_INVITE = "invite";
    const VERB_ACCEPT = "accept";
    const VERB_CLOSE = "close";
      
    const VERB_HOST = "host";
    const VERB_FOLLOW = "follow";
    const VERB_CONFIRM = "confirm";
    const VERB_AUTHORIZE = "authorize";
    const VERB_ATTEND = "attend";
    
    const VERB_POST = "post";

    const TYPE_URL = "url";
	
	public static function buildEntry($params)
    {
        $action = array(
            "type" => $params["type"],
            "verb" => $params["verb"],
            "date" => date("Y-m-d H:i:s"),
            "timestamp" => time()
        );

        if( isset( $params["actor"] )){
            $action["actor"] = array( 
                "objectType" => $params["actor"]['type'],
                "id" => $params["actor"]['id']
            );
        }

        if( isset( $params["object"] )){
            $action["object"] = array( 
                "objectType" => $params["object"]['type'],
                "id" => $params["object"]['id']
            );
        }

        if( isset( $params["target"] )){
            $action["target"] = array( 
                "objectType" => $params["target"]['type'],
                "id" => $params["target"]['id']
            );
        }

        if( isset( $params["ip"] ))
        	$action["actor"]["ip"] = $params["ip"];

        if( isset( $params["codeInsee"] ))
        	$action["codeInsee"] = $params["codeInsee"];
		if( isset( $params["geo"] ))
        	$action["geo"] = $params["geo"];

        if( isset( $params["label"] ))
        	$action["object"]["displayName"] = $params["label"];
		if (isset ($params["tags"]))
			$action["tags"] = $params["tags"];
      return $action;
    }

    public static function viewPage ($url)
    {
        $asParam = array(
            "type" => ActStr::VIEW_PAGE, 
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