<?php
/**
 * GroupController.php
 *
 * Managing Groups of people 
 * a Group   is a genereic container that can be of different types 
 * company, event, association , or simple a group of people 
 * groups allow to communicate within a group 
 * launch actions like brainstorming sessions 
 * voting 
 * discussions 
 * getting and/or working together 
 * ...etc
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 09/02/14
 */
class GroupController extends CommunecterController {
    
    const moduleTitle = "Groupes";
    
	public function actionIndex() {
	    array_push( $this->sidebar1, array( "label"=>"Creer", "iconClass"=>"icon-plus", "onclick"=>"openModal('groupCreerForm','group',null,'dynamicallyBuild')"));
	    $this->render("index");
	}
	
    public function actionView($id) {
        //menu sidebar
        array_push( $this->sidebar1, array( "label"=>"Creer", "iconClass"=>"icon-plus",
        								"children"=>array(
                                                        array( "label"=>"Sous Groupe Classer", "onclick"=>"openModal('groupCreerForm','group',null,'dynamicallyBuild')"),
                                                        array( "label"=>"Participant", "onclick"=>"openModal('simpleParticipantForm','group','$id','dynamicallyBuild','/group/saveParticipant',1)" ),
                                                        array( "label"=>"Brainstorm","onclick"=>"openModal('brainstormForm','brainstorm','$id','dynamicallyBuild')" ),
                                                        array( "label"=>"Discussion","onclick"=>"openModal('textareaForm','group','$id','dynamicallyBuild','/group/saveCommunication',1)" ),
                                                        array( "label"=>"Evenement", "onclick"=>"openModal('brainstormForm','brainstorm','$id','dynamicallyBuild')" ),
                                                        array( "label"=>"Projet","onclick"=>"openModal('brainstormForm','brainstorm','$id','dynamicallyBuild')" ),
                                                        array( "label"=>"Annonce", "onclick"=>"openModal('brainstormForm','brainstorm','$id','dynamicallyBuild')" )
                                                )
                                          ));
        array_push( $this->sidebar1, array( "label"=>"Modifier", "iconClass"=>"icon-pencil-neg","onclick"=>"openModal('groupCreerForm','group','$id','dynamicallyBuild')" ) );
        array_push( $this->sidebar1, array( "label"=>"Participant", "iconClass"=>"icon-users","onclick"=>"filterType('participant')" ) );
        array_push( $this->sidebar1, array( "label"=>"Discussion", "iconClass"=>"icon-chat","onclick"=>"filterType('discussion')" ) );
        array_push( $this->sidebar1, array( "label"=>"Brainstorm", "iconClass"=>"icon-lightbulb","onclick"=>"filterType('brainstorm')" ) );
        array_push( $this->sidebar1, array( "label"=>"Evenement", "iconClass"=>"icon-wifi","onclick"=>"filterType('event')" ) );
        array_push( $this->sidebar1, array( "label"=>"Projet", "iconClass"=>"icon-share","onclick"=>"filterType('project')" ) );
        array_push( $this->sidebar1, array( "label"=>"Annonce", "iconClass"=>"icon-megaphone blue","onclick"=>"filterType('post')" ) );
        
        $group = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
        if(!empty($group['pwd'])){
            $this->secure = true;
    	    $this->appKey = $group['_id'];
    	    $this->appType = 'group';
        }
        $controler = "group";
        if($group['type']=="event")
            $controler = "evenement";
        else if($group['type']=="association")
            $controler = "association";
        else if($group['type']=="entreprise")
            $controler = "entreprise";

        /*if ( !isset(Yii::app()->session["userId"]) 
            || !is_array(Yii::app()->session["loggedIn"]) 
            || !in_array($group["_id"],Yii::app()->session["loggedIn"]) 
            || !( self::checkParticipation($group) )) 
            $this->render("/common/appLogin",array("title"=>$group["name"]));
	    else {*/
            if(isset($group["key"]) )
                $this->redirect(Yii::app()->createUrl($controler.'/key/id/'.$group["key"]));
            else
    	        $this->render("view",array('group'=>$group));
	    
	}
	/**
	 * 
	 * Enter description here ...
	 * @param  $event
	 * @param  $type : participants, organisateurs, projects,jurys,coaches
	 */
	public function isParticipant($event,$type){
	    return in_array( new MongoId(Yii::app()->session["userId"]) , $event[$type] );
	}
    public function isParticipantEmail($event,$type){
	    return in_array( Yii::app()->session["userEmail"] , $event[$type] );
	}
	
    public function checkParticipation($event){
	    $res = false; 
	    foreach ($event["participantTypes"] as $t){
	        $res = self::isParticipant($event,$t);
	        if($res)break;
	    }
	    return $res;
	}
	
    public function actionKey($id) {
	    $this->layout = "swe";
	    $group = Yii::app()->mongodb->groups->findOne(array("key"=>$id)); 
	    $this->secure = $group['private'];
	    $this->appKey = $group['_id'];
	    $this->appType = 'group';
	    // for this event that is private 
	    // user must be loggued 
	    // and exist in the event user particpant list
	    if ( !isset(Yii::app()->session["userId"]) || !is_array(Yii::app()->session["loggedIn"]) || !in_array($group["_id"],Yii::app()->session["loggedIn"]) || !( self::checkParticipation($group) )) 
	        $this->render("/swe/sweLogin",array("title"=>$group["name"]));
	    else {
	        $sweThings = Yii::app()->mongodb->startupweekend->find(array('events'=> new MongoId( $group["_id"] ) )); 
	        $sweThings->sort(array('name' => 1));
	        $user = Yii::app()->mongodb->startupweekend->findOne(array("_id"=>new MongoId(Yii::app()->session["userId"]))); 
	        $this->render("/swe/swegraph",array("sweThings"=>$sweThings,
	        								   "user"=>$user,
	        								   "event"=>$group,
	        								   "key"=>$id));
	    }
	}
	/**
	 * ajax called method to save a new participant user to a group
	 */
	public function actionSaveParticipant(){
	    $res = array("result"=>false,"content"=>"Votre ne peut aboutir");
	    if(Yii::app()->request->isAjaxRequest && isset(Yii::app()->session["userId"]))
		{
	        //test if group exist
	         $group = (isset($_POST["id"])) ? Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($_POST["id"]))) : null; 
	         if($group){
    	        //check citizen exist by email 
    	        if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$_POST['email'])) { 
        		    $account = Yii::app()->mongodb->citoyens->findOne(array("email"=>$_POST['email']));
        		    if( !$account ){
    		            //create an entry in the citoyens colelction
    		        
                        $account = array(
                                    'name'=>$_POST['name'],
                        			'email'=>$_POST['email'],
                                    'invitedBy'=>Yii::app()->session["userId"],
                                    'tobeactivated' => true,
                                    'adminNotified' => false,
                                    'created' => time(),
                                    'type'=>'citoyen'
                                    );
                      
                        Yii::app()->mongodb->citoyens->insert($account);
                        
                        //TODO : background send email 
                        //send validation mail
                        //TODO : make emails as cron jobs
                        /*$message = new YiiMailMessage;
                        $message->view = 'invitation';
                        $name = (isset($sponsor["name"])) ? "par ".$sponsor["name"] : "par ".$sponsor["email"];
                        $message->setSubject('Invitation au projet Pixel Humain '.$name);
                        $message->setBody(array("user"=>$account["_id"],
                                                "sponsorName"=>$name), 'text/html');
                        $message->addTo("oceatoon@gmail.com");//$_POST['inviteEmail']
                        $message->from = Yii::app()->params['adminEmail'];
                        Yii::app()->mail->send($message);*/
                        
                        //TODO : add an admin notification
                        Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_INVITATION,
                        												 "user"=>Yii::app()->session["userId"],
                        												 "invited"=>$account["_id"]));
    		        }
    		        
    		        if(isset($_POST["id"]) && isset($_POST["collection"]) && isset($_POST["role"]) )
    		        {
        		        //push the citoyen id into the $subContainer array(defaults : particpant) 
        		        Yii::app()->mongodb->selectCollection($_POST["collection"])->update(array("_id" => new MongoId($_POST["id"])), 
        		                                                                            array('$push' => array($_POST["role"]."s" => new MongoId($account["_id"]))));
    		        }
    		        
    		        $res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true);
    		    }
	         }
		} 
		echo json_encode( $res );  
	}
}