<?php 
class Organization {

	/**
	 * Save an organization in database
	 * @param array A well format organization 
	 * @return a json result as an array. 
	 */

	public static function save($organization, $userId) {
		
		//Manage tags : save any inexistant tag to DB 
		$organization["tags"] = Tags::filterAndSaveNewTags($organization["tags"]);
	    
	    //Save the organization
	    if(!isset($organization['organizationId'])) {
	      //Add the creator as the first member
	      $organization["membres"] = array(Yii::app()->session["userId"]);
	      PHDB::insert( PHType::TYPE_ORGANIZATIONS, $organization);
	    } else {
	      //update the organization
	      PHDB::update( PHType::TYPE_ORGANIZATIONS,array("_id" => new MongoId($_POST['organizationId'])), 
	                                          array('$set' => $organization));
	    }
    
	    //add the association to the users association list
	    //TODO : Manage if the orgnization is already in the array memberOf
	    $where = array("_id" => new MongoId($userId));	
	    PHDB::update( PHType::TYPE_CITOYEN, $where, array('$push' => array("memberOf"=>$organization["_id"])));
	                
	                  
	      //send validation mail
	      //TODO : make emails as cron jobs
	      /*$message = new YiiMailMessage;
	      $message->view = 'validation';
	      $message->setSubject('Confirmer votre compte Pixel Humain');
	      $message->setBody(array("user"=>$newAccount["_id"]), 'text/html');
	      $message->addTo("oceatoon@gmail.com");//$_POST['registerEmail']
	      $message->from = Yii::app()->params['adminEmail'];
	      Yii::app()->mail->send($message);*/
		                  
	    //TODO : add an admin notification
	    Notification::saveNotification(array("type"=>"Saved",
	    						"user"=>$organization["_id"]));
	                  
	    return Rest::json(array("result"=>true, "msg"=>"Votre organisation est communectée.", "id"=>$organization["_id"]));
	}

}
?>