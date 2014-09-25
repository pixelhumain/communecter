<?php
/**
 * ActionLocaleController.php
 *
 * tous ce que propose le PH en terme de gestion d'evennement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class EvenementController extends CommunecterController {
    const moduleTitle = "Évènement";
    
    
	public function actionIndex() {
	    array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
	    $this->render("index");
	}
    public function actionView($id) {
        //menu sidebar
        array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
        array_push( $this->sidebar1, array( "label"=>"Modifier", "iconClass"=>"icon-pencil-neg","onclick"=>"openModal('eventForm','group','$id','dynamicallyBuild')" ) );
        array_push( $this->sidebar1, array( "label"=>"Participant", "iconClass"=>"icon-users","onclick"=>"openModal('eventParticipantForm','group','$id','dynamicallyBuild')" ) );
        
        $event = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($id)));
                 
        if(isset($event["key"]) )
            $this->redirect(Yii::app()->createUrl('evenement/key/id/'.$event["key"]));
        else
	        $this->render("view",array('event'=>$event));
	}
    public function actionCreer() {
        array_push( $this->sidebar1, array("href"=>Yii::app()->createUrl('evenement/creer'), "iconClass"=>"icon-plus", "label"=>"Ajouter"));
	    $this->render("new2");
	}
	
	public function checkParticipation($event){
	    $res = false; 
	    foreach ($event["participantTypes"] as $t){
	        $res = self::isParticipant($event,$t);
	        if($res)break;
	    }
	    return $res;
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
	
    public function actionSave() {
	    if(Yii::app()->request->isAjaxRequest && isset($_POST['eventName']) && !empty($_POST['eventName']))
		{
		    //TODO check by key
            $account = Yii::app()->mongodb->groups->findOne(array( "name" => $_POST['eventName']));
            if(!$account)
            { 
               //validate isEmail
               $email = Yii::app()->session["userEmail"];//$_POST['assoEmail'];
               if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$email)) { 
                    $new = array(
                    			'email'=>$email,
                    			"name" => $_POST['eventName'],
                                'type'=>PHType::TYPE_EVENT ,
                    			'country'=>$_POST['countryEvent'],
                    			'public'=>$_POST['public'],
                                'created' => time()
                                );
                                
                    if(!empty($_POST['eventCP']))
                         $new["cp"] = $_POST['eventCP'];
                    if(!empty($_POST['eventWhen']))
                         $new["date"] = $_POST['eventWhen'];
                    
                    Yii::app()->mongodb->groups->insert($new);
                    
                    //add the association to the users association list
                    $where = array("_id" => new MongoId(Yii::app()->session["userId"]));	
                    Yii::app()->mongodb->citoyens->update($where, array('$push' => array("associations"=>$new["_id"])));
                  
                    //send validation mail
                    //TODO : make emails as cron jobs
                    /*$message = new YiiMailMessage;
                    $message->view = 'validation';
                    $message->setSubject('Confirmer votre compte Pixel Humain');
                    $message->setBody(array("user"=>$new["_id"]), 'text/html');
                    $message->addTo("oceatoon@gmail.com");//$_POST['registerEmail']
                    $message->from = Yii::app()->params['adminEmail'];
                    Yii::app()->mail->send($message);*/
                    
                    //TODO : add an admin notification
                    Notification::saveNotification(array("type"=>NotificationType::ASSOCIATION_SAVED,
                    						"user"=>$new["_id"]));
                    
                    echo json_encode(array("result"=>true, "msg"=>"Votre evenement est communecté.", "id"=>$new["_id"]));
               } else
                   echo json_encode(array("result"=>false, "msg"=>"Vous devez remplir un email valide."));
            } else
                   echo json_encode(array("result"=>false, "msg"=>"Cette Evenement existe déjà."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
    public function actionGetNames() {
       $assos = array();
       foreach( Yii::app()->mongodb->groups->find( array("name" => new MongoRegex("/".$_GET["typed"]."/i") ),array("name","cp") )  as $a=>$v)
           $assos[] = array("name"=>$v["name"],"cp"=>$v["cp"],"id"=>$a);
       header('Content-Type: application/json');
       echo json_encode( array( "names"=>$assos ) ) ;
	}
	/**
	 * Delete an entry from the group table using the id
	 */
    public function actionDelete() {
	    if(Yii::app()->request->isAjaxRequest && Citoyen::isAdminUser())
		{
            $account = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($_POST["id"])));
            if( $account )
            {
                  Yii::app()->mongodb->groups->remove(array("_id"=>new MongoId($_POST["id"])));
                  //temporary for dev
                  //TODO : Remove the association from all Ci accounts
                  Yii::app()->mongodb->citoyens->update( array( "_id" => new MongoId(Yii::app()->session["userId"]) ) , array('$pull' => array("associations"=>new MongoId( $_POST["id"]))));
                  $result = array("result"=>true,"msg"=>"Donnée enregistrée.");
                  
                  echo json_encode($result); 
            } else 
                  echo json_encode(array("result"=>false,"msg"=>"Cette requete ne peut aboutir."));
		} else
		    echo json_encode(array("result"=>false, "msg"=>"Cette requete ne peut aboutir."));
		exit;
	}
}