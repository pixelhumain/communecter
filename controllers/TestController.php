<?php
class TestController extends CommunecterController {
  
  protected function beforeAction($action) {
	return parent::beforeAction($action);
  }
  public function actionIndex() {
    $userNotifcations = ActivityStream::getNotifications( array( "notify.id" => Yii::app()->session["userId"] ) );//PHDB::find( ActivityStream::COLLECTION,array("notify.id"  => Yii::app()->session["userId"] ));
    echo count($userNotifcations);
  }
  

  // VoteDown
  public static function actionRefactorModerateVoteDown($collection){
  	echo "actionRefactorModerateVoteDown => ";
	$news=PHDB::find($collection, array('voteDown' => array('$exists' => 1),'refactorDownAction' => array('$exists' => 0)));
	$i=0;
	echo count($news)." $collection en base avec voteDown<br/>";
	foreach($news as $key => $data){
		$map = array();
		foreach ($data['voteDown'] as $j => $reason) {
			if(!is_array($reason))$map['voteDown.'.$reason] = array('date' => new MongoDate(time())); 
		}
		if(count($map)){
			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$set' => array('refactorDownAction' => new MongoDate(time()))));

			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$unset' => array('voteDown' => 1)));
			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$set' => $map, '$unset' => array('voteDownReason' => 1)));
			$i++;
		}
		elseif(isset($news['voteDownReason'])){
			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$unset' => array('voteDownReason' => 1)));
			$i++;
		}
	}

	echo "nombre de $collection modifié => ".$i."<br/>";
  }

  // VoteUp
  public static function actionRefactorModerateVoteUp($collection){
  	echo "actionRefactorModerateVoteUp => ";
	$news=PHDB::find($collection, array('voteUp' => array('$exists' => 1),'refactorUpAction' => array('$exists' => 0)));
	$i=0;
	echo count($news)." $collection en base avec voteUp<br/>";
	foreach($news as $key => $data){
		$map = array();
		foreach ($data['voteUp'] as $j => $reason) {
			if(!is_array($reason))$map['voteUp.'.$reason] = array('date' => new MongoDate(time())); 
		}
		if(count($map)){
			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$set' => array('refactorUpAction' => new MongoDate(time()))));
			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$unset' => array('voteUp' => 1)));
			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$set' => $map, '$unset' => array('voteUpReason' => 1)));
			$i++;
		}
		elseif(isset($news['voteUpReason'])){
			$res = PHDB::update($collection, array('_id' => $data['_id']), array('$unset' => array('voteUpReason' => 1)));
			$i++;
		}
	}

	echo "nombre de $collection modifié => ".$i."<br/>";
  }

  // ReportAbuse
  public static function actionRefactorModerateReportAbuse(){
  	echo "actionRefactorModerateReportAbuse => ";  	
  	$i = 0;
	$news=PHDB::find(News::COLLECTION, array('reportAbuseReason' => array('$exists' => 1)));
  	foreach($news as $key => $data){
		$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('reportAbuseReason' => 1)));
		$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('reportAbuseCount' => 1)));
		$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('reportAbuse' => 1)));
		$i++;
	}

	echo count($news)." News en base avec reportAbuseReason<br/>";
  }

  // ReportAbuse
  public static function actionDeleteCommentReportAbuse(){
  	echo "actionCommentRefactorModerateReportAbuse => ";  	
  	$i = 0;
	$news=PHDB::find(Comment::COLLECTION, array('reportAbuse' => array('$exists' => 1)));
  	foreach($news as $key => $data){
		$res = PHDB::remove('comments', array('_id' => $data['_id']));
		$i++;
	}

	echo count($news)." Comments en base avec reportAbuseReason<br/>";
  }

  public function actionRefactorNewsCommentsActions(){
  	TestController::actionRefactorModerateVoteDown('news');
  	TestController::actionRefactorModerateVoteUp('news');
  	TestController::actionRefactorModerateVoteDown('comments');
  	TestController::actionRefactorModerateVoteUp('comments');
  	TestController::actionRefactorModerateReportAbuse();
  	TestController::actionDeleteCommentReportAbuse();
  }

  // Efface le champs refactorAction
  public static function actionDeleteAttributRefactorAction(){
  	echo "actionDeleteAttributRefactorAction => ";  	
  	$i = 0;
	$news=PHDB::find(News::COLLECTION, array('refactorUpAction' => array('$exists' => 1)));
  	foreach($news as $key => $data){
		$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('refactorUpAction' => 1)));
		$i++;
	}
	$news=PHDB::find(News::COLLECTION, array('refactorDownAction' => array('$exists' => 1)));
  	foreach($news as $key => $data){
		$res = PHDB::update('news', array('_id' => $data['_id']), array('$unset' => array('refactorDownAction' => 1)));
		$i++;
	}
	echo $i." News update<br/>";
	$i = 0;
	$comments=PHDB::find(Comment::COLLECTION, array('refactorUpAction' => array('$exists' => 1)));
  	foreach($comments as $key => $data){
		$res = PHDB::update('comments', array('_id' => $data['_id']), array('$unset' => array('refactorUpAction' => 1)));
		$i++;
	}
	$comments=PHDB::find(Comment::COLLECTION, array('refactorDownAction' => array('$exists' => 1)));
  	foreach($comments as $key => $data){
		$res = PHDB::update('comments', array('_id' => $data['_id']), array('$unset' => array('refactorDownAction' => 1)));
		$i++;
	}
	echo $i." comments update<br/>";


  }
  
    public function actionRemoveOrgaAdminOfProject() {
	    $projects=PHDB::find(Project::COLLECTION);
	    foreach($projects as $projectId => $data){
		    $orgaWasAdmin=false;
		    $orgahasmemberadmin=false;
		    if(@$data["links"] && @$data["links"]["contributors"]){
			    foreach($data["links"]["contributors"] as $key => $e){
				    if(@$e["type"]==Organization::COLLECTION && @$e["isAdmin"]){
					   	echo 'Modification du liens entre le projet : '.$projectId." et l'organisation ".$key;
					   	//echo json_encode($data["links"]["contributors"]);
					   	PHDB::update(Project::COLLECTION,
					   		array("_id" => new MongoId($projectId)) , 
					   		array('$unset' => array("links.contributors.".$key.".isAdmin" => ""))
					   	);
					   	PHDB::update(Organization::COLLECTION,
					   		array("_id" => new MongoId($key)) , 
					   		array('$unset' => array("links.projects.".$projectId.".isAdmin" => ""))
					   	);
					   	$orgaWasAdmin=true;
				    }
			    }
			    if($orgaWasAdmin){
				    foreach($data["links"]["contributors"] as $key => $e){
					   if(@$e["type"]==Person::COLLECTION && @$e["isAdmin"] && @$e["isAdminPending"]){
						   	PHDB::update(Project::COLLECTION,
					   		array("_id" => new MongoId($projectId)) , 
					   		array('$unset' => array("links.contributors.".$key.".isAdminPending" => ""))
						   	);
						   	PHDB::update(Person::COLLECTION,
						   		array("_id" => new MongoId($key)) , 
						   		array('$unset' => array("links.projects.".$projectId.".isAdminPending" => ""))
						   	);
						  //echo "ici<br/>";
						  //echo json_encode($data["links"]["contributors"]);
						   $orgahasmemberadmin=true;
					   }
				    }
			    }
			    if($orgaWasAdmin && !$orgahasmemberadmin){
				    $creator = $data["creator"];
				    $creator=Person::getById($creator);
				    if($creator){
					    echo "Creator est reelement une person on project : ".$projectId;
				    }else{
					    echo "Creator is an orga on project : ".$projectId;
				    }
			    }
		    }
		    echo "<br/>";
	    }

    }
    public function actionAddExplain() {
		$persons=PHDB::find(Person::COLLECTION);
		foreach($persons as $key => $data){
			PHDB::update(Person::COLLECTION,
				array("_id" => $data["_id"]) , 
				array('$set' => array("preferences.seeExplanations" => true))
			);
		}
    }
  public function actionTest() {
  	$allOrganizations = PHDB::findAndSort ( Organization::COLLECTION ,array("disabled" => array('$exists' => false)), 
	  												array("updated" => -1, "name" => 1), 100, 

	  												array("name", "address", "shortDescription", "description","updated"));
  	foreach ($allOrganizations as $key => $value) 
  	{
  		echo $value['name']." > ".$value['updated']."<br/>";
  	}
  	echo "*************************************";
  	$all = PHDB::findAndSort ( Event::COLLECTION ,array(), 
	  												array("updated" => -1, "startDate" => 1), 100, 
													array("name","updated",'startDate'));
  	foreach ($all as $key => $value) 
  	{
  		echo $value['name']." > ".date("d/m/Y",$value['updated'])." > ".$value['startDate']."<br/>";
  	}
  	//echo hash('sha256', "mc420011@gmail.com"."communecter974");
    //echo $_SERVER["X-Auth-Token"];
    //Authorisation::isMeteorConnected( "TCvdPtAVCkkDvrBDtICLUfRIi93L3gOG+MwT4SvDK0U=", true );
	//var_dump(Link::addMember("551a5c00a1aa146d160041b0", PHType::TYPE_ORGANIZATIONS, 
	  //"5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"], true));

	/*var_dump(Link::connect("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"]));
	 
	var_dump(Link::isConnected("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN));

	var_dump(Link::disconnect("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"]));
	
	var_dump(Link::isConnected("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN));
	*/
	/*$person=PHDB::find(Person::COLLECTION);
	foreach($person as $key => $data){
		if(@$data["geoPosition"]){
			echo $data["name"]."//";
			print_r($data["geoPosition"]);
			$geoPosition=array("type"=> "Point", "coordinates" => array("0" => $data["geoPosition"]["coordinates"][1], "1" => $data["geoPosition"]["coordinates"][0]));
			print_r($geoPosition);
			$res = PHDB::update(Person::COLLECTION,
		                            array("_id"=>new MongoId($key)), 
		                            array('$set' => array("geoPosition" => $geoPosition)));
		                            echo "</br>";
				print_r($res);
				echo '</br>';
		}
	}*/
	/*$index=PHDB::createIndex (Person::COLLECTION) ;
	$res=$index::find(Person::COLLECTION,array('geoPosition.coordinates' => array ('$nearSphere' => array(
               '$geometry' => array(
                   "type" => "Point",
                   "coordinates" => array(3.06388688609426, 50.6333596221436)
               ),
               '$maxDistance' => 5000
           )
)));*///.createIndex( { 'geoPosition.coordinates' : "2dsphere" } );
//print_r($res);
/*	.getCollection('citoyens').createIndex( { 'geoPosition.coordinates' : "2dsphere" } );
db.getCollection('citoyens').find({'geoPosition.coordinates': {
           $nearSphere: {
               $geometry: {
                   type: "Point",
                   coordinates: [3.06388688609426, 50.6333596221436]
               },
               $maxDistance: 5000
           }
       }
   })*/
	//Rest::Json($res);
	/*$news=PHDB::find(News::COLLECTION);
	foreach ($news as $key => $data){
		if (@$data["created"]){	
			if (is_int($data["created"])){
				echo $data["created"];
				$dateCreated= new MongoDate($data["created"]);
				echo "::".date(DATE_ISO8601, $dateCreated->sec)."</br>";
				$res = PHDB::update(News::COLLECTION,
				    array("_id"=>new MongoId($key)), 
				    array('$set' => array("created" => $dateCreated)));
				echo "</br>";
				print_r($res);
				echo '</br>';
	        }
        }
		//echo $data["date"];
		//$dateCreated= new MongoDate($data["date"]);
		//echo "::".date(DATE_ISO8601, $dateCreated->sec)."</br>";
		//$dateDate =  new MongoDate( strtotime($data["date"], '%d/%m/%y') );
		if (@$data["date"]){	
			if (is_int($data["date"])){
				echo $data["date"];
				$dateDate= new MongoDate($data["date"]);
				echo "::".date(DATE_ISO8601, $dateDate->sec)."</br>";
				$res = PHDB::update(News::COLLECTION,
		                            array("_id"=>new MongoId($key)), 
		                            array('$set' => array("created" => $dateCreated)));
				echo "</br>";
				print_r($res);
				echo '</br>';
			}
			else if (is_string($data["date"])){
				echo $data["date"];
				echo "//".strtotime(str_replace('/', '-', $data["date"]));
				$dateDate= new MongoDate(strtotime(str_replace('/', '-', $data["date"])));
				echo "::".date(DATE_ISO8601, $dateDate->sec)."</br>";
			
				$res = PHDB::update(News::COLLECTION,
		                            array("_id"=>new MongoId($key)), 
		                            array('$set' => array("date" => $dateDate)));
				echo "</br>";
				print_r($res);
				echo '</br>';
		     }
		
		}
	}
	$activity=PHDB::find(ActivityStream::COLLECTION);
	foreach ($activity as $key => $data){
		if (@$data["created"]){	
			if (is_int($data["created"])){
				echo $data["created"];
				$dateCreated= new MongoDate($data["created"]);
				echo "::".date(DATE_ISO8601, $dateCreated->sec)."</br>";
				$res = PHDB::update(ActivityStream::COLLECTION,
		                            array("_id"=>new MongoId($key)), 
		                            array('$set' => array("created" => $dateCreated)));
				echo "</br>";
				print_r($res);
				echo '</br>';
	        }
        }
        if (@$data["timestamp"]){	
			if (is_int($data["timestamp"])){
				echo $data["timestamp"];
				$dateTimestamp= new MongoDate($data["timestamp"]);
				echo "::".date(DATE_ISO8601, $dateTimestamp->sec)."</br>";
				$res = PHDB::update(ActivityStream::COLLECTION,
		                            array("_id"=>new MongoId($key)), 
		                            array('$set' => array("timestamp" => $dateTimestamp)));
				echo "</br>";
				print_r($res);
				echo '</br>';
	        }
        }
		if (@$data["date"]){	
			if (is_int($data["date"])){
				echo $data["date"];
				$dateDate= new MongoDate($data["date"]);
				echo "::".date(DATE_ISO8601, $dateDate->sec)."</br>";
				$res = PHDB::update(ActivityStream::COLLECTION,
		                            array("_id"=>new MongoId($key)), 
		                            array('$set' => array("created" => $dateDate)));
				echo "</br>";
				print_r($res);
				echo '</br>';
		                     
		
			}
			else if (is_string($data["date"])){
				echo $data["date"];
				echo "//".strtotime($data["date"]);
				$dateDate= new MongoDate(strtotime($data["date"]));
				echo "::".date(DATE_ISO8601, $dateDate->sec)."</br>";
			
				$res = PHDB::update(ActivityStream::COLLECTION,
		                            array("_id"=>new MongoId($key)), 
		                            array('$set' => array("date" => $dateDate)));
				echo "</br>";
				print_r($res);
				echo '</br>';
			}
		}
	}*/
}

  public function actionInsertNewPerson() {
  $params = array(
    'name' => "Test", 'email' => "new14@email.com", 'postalCode' => "97426", "city"=> "97401" ,'pwd' => "vlanlepass"
    );
  $res = Person::insert($params);

  var_dump($params);

  }

  public function actionListEvent() {
	var_dump(Authorisation::listEventsIamAdminOf(Yii::app()->session["userId"]));

  }

  public function actionAddCron() {
  	$params = array(
  		"type" => Cron::TYPE_MAIL,
  		"tpl"=>'validation',
        "subject" => 'TEST Confirmer votre compte pour le site ',
        "from"=>Yii::app()->params['adminEmail'],
        "to" => "oceatoon@gmail.com",
        "tplParams" => array( "user"=>Yii::app()->session['userId'] ,
                               "title" => "Test" ,
	                           "logo"  => "/images/logo.png" )
    );
  	
    Mail::schedule($params);

  	$params = array(
  		"type" => Cron::TYPE_MAIL,
  		"tpl"=>'newOrganization',
        "subject" => 'TEST Nouvelle Organization de créer ',
        "from"=>Yii::app()->params['adminEmail'],
        "to" => "oceatoon@gmail.com",
        "tplParams" => array( "user"=>Yii::app()->session['userId'] ,
                               "title" => "Test" ,
                               "creatorName" => "Tib Kat",
	                           "url"  => "/organization/" )
        );
    Mail::schedule($params);
  }

  public function actionDoCron() {
  	Cron::processCron();
  }
  
  public function actionMail() {
  	//send validation mail
  	echo "from : ".Yii::app()->params['adminEmail'];
  	echo "<br/>";
  	echo "to : ".Yii::app()->session['userEmail'];
  	echo "<br/>";
  	echo "img : ".$this->module->assetsUrl."/images/logo.png";

    //Send Classic Email 
    $res = Mail::send(array("tpl"=>'validation',
         "subject" => 'TEST Confirmer votre compte pour le site ',
         "from"=>Yii::app()->params['adminEmail'],
         "to" => Yii::app()->session['userEmail'],
         "tplParams" => array( "user"=>Yii::app()->session['userId'] ,
                               "title" => "Test" ,
                               "logo"  => $this->module->assetsUrl."/images/logo.png" )) , true);
    
	  echo "<br/>";
    echo "result: ".$res; 
	}
	
	public function actionNotif() 
	{
		echo "Push a notication <br/>";
		//push an activity Stream Notification 
		/* **********************************
    Activity Stream and Notifications
    */
    //$type,$perimetre,$verb,$label,$id
    $asParam = array("type" => ActStr::TEST, 
                    "codeInsee" => "97400",//option
                    // IP //option
                    "verb" => "add",
                    "actorType"=>"persons",
                    "objectType"=>"test",
                    "label" => "Testing Notification Push 2", //option
                    "id" => Yii::app()->session['userId']
                );
    $action = ActStr::buildEntry($asParam);

    //LOGGING WHO TO NOTIFY
    $notif = array( "persons" => array( Yii::app()->session['userId'] ),
                    "label"   => "Something Changed Again " , 
                    "icon"    => ActStr::ICON_QUESTION ,
                    "url"     => 'javascript:alert( "testing notifications"  );' 
                  );
    $action["notify"] = ActivityStream::addNotification( $notif );
    ActivityStream::addEntry($action);
	}

	public function actionMandrill() {
	//test Mandrill async mailing system
	Yii::import('mandrill.Mandrill', true);
	
	try {
    $mandrill = new Mandrill(Yii::app()->params['mandrill']);

    /*$mandrill = new Mandrill(Yii::app()->params['mandrill']);
    $name = 'Example Template';
    $from_email = Yii::app()->params['adminEmail'];
    $from_name = 'Association Granddir',
    $subject = 'example subject Granddir',y
    $code = '<div>example code</div>';
    $text = 'Example text content';
    $publish = false;
    $labels = array('example-label');
    $result = $mandrill->templates->add($name, $from_email, $from_name, $subject, $code, $text, $publish, $labels);
    print_r($result);
*/
    //https://mandrillapp.com/
    //https://mandrillapp.com/api/docs/templates.php.html
    $message = array(
        'html' => '<p>Example HTML content</p>',
        'text' => 'Example text content',
        'subject' => 'example subject Granddir',
        'from_email' => Yii::app()->params['adminEmail'],
        'from_name' => 'Association Granddir',
        'to' => array(
            array(
                'email' => "oceatoon@gmail.com",
                'name' => 'Destinataire XXX',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'message.reply@granddir.re'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'bcc_address' => 'pixelhumain@gmail.com',
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
        'global_merge_vars' => array(
            array(
                'name' => 'merge1',
                'content' => 'merge1 content'
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => 'recipient.email@granddir.re',
                'vars' => array(
                    array(
                        'name' => 'merge2',
                        'content' => 'merge2 content'
                    )
                )
            )
        ),
        'tags' => array('newOrganization'),
        /*'subaccount' => 'oceatoon',
        'google_analytics_domains' => array('granddir.re'),
        'google_analytics_campaign' => 'contact@granddir.re',
        'metadata' => array('website' => 'www.granddir.re'),
        'recipient_metadata' => array(
            array(
                'rcpt' => 'recipient.email@granddir.re',
                'values' => array('user_id' => 123456)
            )
        ),*/
        /*'attachments' => array(
            array(
                'type' => 'text/plain',
                'name' => 'myfile.txt',
                'content' => 'ZXhhbXBsZSBmaWxl'
            )
        ),
        'images' => array(
            array(
                'type' => 'image/png',
                'name' => 'IMAGECID',
                'content' => 'ZXhhbXBsZSBmaWxl'
            )
        )*/
    );
    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = "";
    $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
    print_r($result);
	    /*
	    Array
	    (
	        [0] => Array
	            (
	                [email] => recipient.email@example.com
	                [status] => sent
	                [reject_reason] => hard-bounce
	                [_id] => abc123abc123abc123abc123abc123
	            )
	    
	    )
	    */
	} catch(Mandrill_Error $e) {
	    // Mandrill errors are thrown as exceptions
	    echo 'A mandrill error occurred: ' . get_class($e) . ' - ' . $e->getMessage();
	    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
	    throw $e;
	}
  }

  public function actionSearchOrganization() {
	$criterias = array("name" => "O.R", "email" => "O.R");
	var_dump(Organization::findOrganizationByCriterias($criterias, 10));
  }
  
  public function actionListOrganizationEvent() {
	$id = "54eed904a1aa1958b70041ef";
	var_dump(Organization::listEventsPublicAgenda($id));
  }

  public function actionInsertJob() {
  	$job = array("hiringOrganization" => "54eed4efa1aa1458b70041ac", "description" => "Job de Test");
  	$res = Job::insertJob($job);
  	var_dump($res);
  	$listjob = Job::getJobsList("54eed4efa1aa1458b70041ac");
  	var_dump($listjob);
  }

  public function actionPlaquette() {
  	$listPlaquette = Document::listDocumentByCategory("55509e082336f27ade0041aa", Organization::COLLECTION, Document::CATEGORY_PLAQUETTE, array( 'created' => 1 ));
  	var_dump(reset($listPlaquette));
  	$listCategory = Document::getAvailableCategories("55509e082336f27ade0041aa",Organization::COLLECTION);
  	var_dump($listCategory);
  }

  public function actionHelper() {
  	$cssAnsScriptFiles = array(
		//dropzone
		'/plugins/dropzone/downloads/css/ph.css',
		'/plugins/dropzone/downloads/dropzone.min.js',
		//lightbox
		'/plugins/lightbox2/css/lightbox.css',
		'/plugins/lightbox2/js/lightbox.min.js'
	);

	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles, Yii::app()->request->baseUrl);
  }  

  public function actionAverageComment() {
    var_dump(Comment::getCommunitySelectedComments("5596a29b88aee0c4d97da608", Survey::COLLECTION, null));
  }

  public function actionActivationURL() {
    $userId = "55e5c4722336f2d8580041e5";
    
    $validationKey =Person::getValidationKeyCheck($userId);
    $url = Yii::app()->getRequest()->getBaseUrl(true)."/".$this->module->id."/person/activate/user/".$userId.'/validationKey/'.$validationKey;
    var_dump($url);
  }

  public function actionTestEmail() {    
    var_dump(Utils::getServerInformation());
    //$person = Person::getById("555a124b126e9a6f6600000d");
    $text = "yes mamamamamamamammamama";
    $params = array(   
                       "title" => Yii::app()->session["user"]["username"] ,
                        "logo"  => "/images/logo.png",
                        "url" => "href='javascript:;' onclick='loadByHash(\'#news.index.type.pixels?isNotSV=1\')'",
                        "content"=> $text);
    
    $this->renderPartial('application.views.emails.helpAndDebugNews', $params);
  }

  public function actionImageMarker() {
    //$profilImage = Yii::app()->params['uploadDir']."communecter/slide1.png";
    $profilImage = Yii::app()->params['uploadDir']."communecter/photoProfil.jpg";
    $srcEmptyMarker = Yii::app()->params['uploadDir']."communecter/marker-citizen.png";
    
    $imageUtils = new ImagesUtils($profilImage);
    // $imageUtils->resizeImage(40,40)->display();
    //$imageUtils->createCircleImage(40,40)->display();
    $imageUtils->createMarkerFromImage($srcEmptyMarker)->display();
  }

  public function actionGenerateThumbs() {
    $docId = "561bb2ca2336f2e70c0041ab";
    //$docId = "5608ca102336f2b4040041af";
    $document = Document::getById($docId);
    Document::generateProfilImages($document);
  }

  public function actionGetImages() {
    $itemId = "55c0c1a72336f213040041ee";
    $itemType = Person::COLLECTION;
    $limit = array(Document::IMG_PROFIL => 1, Document::IMG_SLIDER => 5);
    var_dump(Document::getImagesByKey($itemId, $itemType, $limit));
  }

  public function actionTestMarker() {
    $itemId = "55c0c1a72336f213040041e";
    $itemType = Person::COLLECTION;
    var_dump(Document::getGeneratedImageUrl($itemId, $itemType, Document::GENERATED_THUMB_PROFIL));
    var_dump(Document::getGeneratedImageUrl($itemId, $itemType, Document::GENERATED_MARKER));
  }

  public function actionTestMailAdmin() {
   var_dump(Utils::getServerInformation());
    $person = Person::getById("55c0c1a72336f213040041ee");
    $organization = Organization::getById("55797ceb2336f25c0c0041a8");
    var_dump($organization);
    $params = array(  "organization" => $organization,
                      "newPendingAdmin"   => $person ,
                       "title" => Yii::app()->name ,
                       "logo"  => "/images/logo.png");
    
    $this->renderPartial('application.views.emails.askToBecomeAdmin', $params);
  }  

  public function actionTestMailInvitation() {
    var_dump(Utils::getServerInformation());
    $person = Person::getById("56cc5a0c94ef47ae237b23d6");
    var_dump($person);
    $params = array( "invitorName"   => "Invitation Man !",
                     "title" => Yii::app()->name ,
                     "logo"  => "/images/logo.png",
                     "invitedUserId" => $person["_id"],
                     "message" => "Bah alors ramène toi sur Communecter ma couille !");
    $this->renderPartial('application.views.emails.invitation', $params);
  } 

  public function actionTestBecomeAnAdmin() {
    $person = Person::getById("55c0c1a72336f213040041ee");
    $organization = Organization::getById("55797ceb2336f25c0c0041a8");
    var_dump($organization);
    $params = array(  "organization" => $organization,
                      "newPendingAdmin"   => $person ,
                       "title" => Yii::app()->name ,
                       "logo"  => "/images/logo.png");
    
    $this->renderPartial('application.views.emails.askToBecomeAdmin', $params);
  }

  public function actionTestValidation() {
    $person = Person::getById("5703b8bd2336f250520041c2");
    var_dump($person);
    $params = array(   "person"   => $person ,
                        "title" => Yii::app()->name ,
                        "logo"  => "/images/logoLTxt.jpg");
    
    $this->renderPartial('application.views.emails.notifAdminNewUser', $params);
  }

  public function actionTestAddPersonAdmin() {
    $organizationId = "55797ceb2336f25c0c0041a8";
    $personId = "5577d525a1aa1458540041b0";
    var_dump(Organization::addPersonAsAdmin($organizationId, $personId, $personId));
  }

  public function actionTestUpdateOrganization() {
    $organizationId = "55794e302336f240060041a8";
    $userId = "55c0c1a72336f213040041ee";
    $organization = array("name" => "Ekopratik");

    var_dump(Organization::update($organizationId, $organization, $userId));
  }

  public function actionTestUpdatePerson() {
    $personId = "56cedff02336f2a17a0041df";
    $userId = "56cedff02336f2a17a0041df";
    $person = array("address" => 
		    	array(
			    	"streetAddress" => "45X Chemin des Cactus",
				    "postalCode" => "97426",
				    "codeInsee" => "97423",
				    "addressCountry" => "RE")
		    	);

    var_dump(Person::update($personId, $person, $userId));
  }

  public function actionTestIsAdminOrganization($id) {
    var_dump(Authorisation::isOrganizationAdmin("55c0c1a72336f213040041ee", $id));
  }

  public function actionDisplayMail($id) {
  	$cron = PHDB::findOne("cron", array( "_id" => new MongoId($id)));
  	var_dump( $cron);
  	$params = $cron["tplParams"];
  	$this->renderPartial('application.views.emails.'.$cron["tpl"], $params);
  }



  	public function actionUploadDocument() {
		$dir = "communecter" ;
		$folder = Person::COLLECTION ;
		$ownerId = "56eff58e94ef47451c7b23d6" ;
		$input = "avatar" ;
		$rename = false ;
		$pathFile = "http://www.lescolporteurs.info/medias/images/" ;
		$nameFile = "nuit-debout-dijon.jpg" ;

		$res = Document::uploadDocument($dir,$folder,$ownerId,$input,$rename, $pathFile, $nameFile);
        var_dump($res);
	}


	public function actionSaveImage() {
		$dir = "communecter" ;
		$folder = Person::COLLECTION ;
		$ownerId = "56eff58e94ef47451c7b23d6" ;
		$input = "avatar" ;
		$rename = false ;
		$pathFile = "http://www.placetob.org/wp-content/uploads/2016/04/NuitDebout-sebM.jpg" ;
		$nameFile = "NuitDebout-sebM.jpg" ;

		$res = Document::uploadDocument($dir,$folder,$ownerId,$input,$rename, $pathFile, $nameFile);
        var_dump($res);
	}
	public function actionAddPersonMediumImage(){
		$people=PHDB::find(Person::COLLECTION);
		foreach ($people as $key => $value){
			if(@$value["profilImageUrl"]){
				$tabImage=explode("/", $value["profilImageUrl"]);
				$countTabImage=count($tabImage);
				$nameImage=$tabImage[$countTabImage-1];
				$i=0;
				$urlImage="";
				foreach($tabImage as $data){
					if($i != 0 && $i<($countTabImage-1))
						$urlImage.= $data."/";
					$i++;
				}
				$upload_dir_medium = $urlImage.Document::GENERATED_MEDIUM_FOLDER ;
				echo $upload_dir_medium;
				if(!file_exists ($upload_dir_medium )) {       
					mkdir($upload_dir_medium, 0777);
				}
				$imageMediumUtils = new ImagesUtils(substr($value["profilImageUrl"],1));
				$destPathMedium = $upload_dir_medium."/".$nameImage;
				$profilMediumUrl = "/".$upload_dir_medium."/".$nameImage;
				$imageMediumUtils->resizePropertionalyImage(400,400)->save($destPathMedium,100);
				echo '/////////////'.$key.'////////////<br/>';
				echo 'destPath : '.$destPathMedium.'<br/>';
				echo 'profilPath : '.$profilMediumUrl.'<br/>';
				PHDB::update(Person::COLLECTION, array("_id" => new MongoId($key)), array('$set' => array("profilMediumImageUrl" => $profilMediumUrl)));
				//if(!file_exists ( $upload_dir_medium )) {       
				//	mkdir($upload_dir_medium, 0777);
				//}

			}
		}
	}
	public function actionAddOrgaMediumImage(){
		$organization=PHDB::find(Organization::COLLECTION);
		foreach ($organization as $key => $value){
			if(@$value["profilImageUrl"]){
				$tabImage=explode("/", $value["profilImageUrl"]);
				$countTabImage=count($tabImage);
				$nameImage=$tabImage[$countTabImage-1];
				$i=0;
				$urlImage="";
				foreach($tabImage as $data){
					if($i != 0 && $i<($countTabImage-1))
						$urlImage.= $data."/";
					$i++;
				}
				$upload_dir_medium = $urlImage.Document::GENERATED_MEDIUM_FOLDER ;
				if(!file_exists ( $upload_dir_medium )) {       
					mkdir($upload_dir_medium, 0777);
				}
				$imageMediumUtils = new ImagesUtils(substr($value["profilImageUrl"],1));
				$destPathMedium = $upload_dir_medium."/".$nameImage;
				$profilMediumUrl = "/".$upload_dir_medium."/".$nameImage;
				$imageMediumUtils->resizePropertionalyImage(400,400)->save($destPathMedium,100);
				echo '/////////////'.$key.'////////////<br/>';
				echo 'destPath : '.$destPathMedium.'<br/>';
				echo 'profilPath : '.$profilMediumUrl.'<br/>';
				PHDB::update(Organization::COLLECTION, array("_id" => new MongoId($key)), array('$set' => array("profilMediumImageUrl" => $profilMediumUrl)));
				//if(!file_exists ( $upload_dir_medium )) {       
				//	mkdir($upload_dir_medium, 0777);
				//}

			}
		}
	}
	public function actionAddProjectMediumImage(){
		$project=PHDB::find(Project::COLLECTION);
		foreach ($project as $key => $value){
			if(@$value["profilImageUrl"]){
				$tabImage=explode("/", $value["profilImageUrl"]);
				$countTabImage=count($tabImage);
				$nameImage=$tabImage[$countTabImage-1];
				$i=0;
				$urlImage="";
				foreach($tabImage as $data){
					if($i != 0 && $i<($countTabImage-1))
						$urlImage.= $data."/";
					$i++;
				}
				$upload_dir_medium = $urlImage.Document::GENERATED_MEDIUM_FOLDER ;
				if(!file_exists ( $upload_dir_medium )) {       
					mkdir($upload_dir_medium, 0777);
				}
				$imageMediumUtils = new ImagesUtils(substr($value["profilImageUrl"],1));
				$destPathMedium = $upload_dir_medium."/".$nameImage;
				$profilMediumUrl = "/".$upload_dir_medium."/".$nameImage;
				$imageMediumUtils->resizePropertionalyImage(400,400)->save($destPathMedium,100);
				echo '/////////////'.$key.'////////////<br/>';
				echo 'destPath : '.$destPathMedium.'<br/>';
				echo 'profilPath : '.$profilMediumUrl.'<br/>';
				PHDB::update(Project::COLLECTION, array("_id" => new MongoId($key)), array('$set' => array("profilMediumImageUrl" => $profilMediumUrl)));
				//if(!file_exists ( $upload_dir_medium )) {       
				//	mkdir($upload_dir_medium, 0777);
				//}

			}
		}
	}
	public function actionAddEventMediumImage(){	
		$event=PHDB::find(Event::COLLECTION);
		foreach ($event as $key => $value){
			if(@$value["profilImageUrl"]){
				$tabImage=explode("/", $value["profilImageUrl"]);
				$countTabImage=count($tabImage);
				$nameImage=$tabImage[$countTabImage-1];
				$i=0;
				$urlImage="";
				foreach($tabImage as $data){
					if($i != 0 && $i<($countTabImage-1))
						$urlImage.= $data."/";
					$i++;
				}
				$upload_dir_medium = $urlImage.Document::GENERATED_MEDIUM_FOLDER ;
				if(!file_exists ( $upload_dir_medium )) {       
					mkdir($upload_dir_medium, 0777);
				}
				$imageMediumUtils = new ImagesUtils(substr($value["profilImageUrl"],1));
				$destPathMedium = $upload_dir_medium."/".$nameImage;
				$profilMediumUrl = "/".$upload_dir_medium."/".$nameImage;
				$imageMediumUtils->resizePropertionalyImage(400,400)->save($destPathMedium,100);
				echo '/////////////'.$key.'////////////<br/>';
				echo 'destPath : '.$destPathMedium.'<br/>';
				echo 'profilPath : '.$profilMediumUrl.'<br/>';
				PHDB::update(Event::COLLECTION, array("_id" => new MongoId($key)), array('$set' => array("profilMediumImageUrl" => $profilMediumUrl)));
				//if(!file_exists ( $upload_dir_medium )) {       
				//	mkdir($upload_dir_medium, 0777);
				//}

			}
		}
	}
	// Log
	public function actionLogDeletePasswordCitoyen(){
	  	echo "actionLogDeletePasswordCitoyen => ";  	
	  	$i = 0;
	  	$res1 = PHDB::find('logs',
	  		array('params.pwd' => array('$exists' => 1)));
	  	foreach ($res1 as $key => $value) {
	  		$res = PHDB::updateWithOptions('logs',
		  		array('params.pwd' => array('$exists' => 1)),
		  		array('$unset' => array('params.pwd' => 1)),
		  		array('multi'=>true));
	  		$i++;
	  	}
	  	
		echo $i." Logs modifiés<br/>";
	}

	public function actionMailKKBB(){
		Mail::inviteKKBB(Person::getById("55c0c1a72336f213040041ee"), false);

	}

	//Stat sur les logs
	public function actionCreateLastLogStatistics(){
	  	echo "actionCreateLastLogStatistics => ";  	
	  	$i = 0;
	  	$lastUpdate = new MongoDate('1458733145');

	  	//We get all the stats documents to get periode
	  	$allStats = PHDB::findAndSort('stats',array(), array("created" =>1), 10000, array("created", '_id'));
	  	foreach ($allStats as $key => $stat) {
	  		$i++;
			$where = array('created' => array('$gt' => $lastUpdate, '$lt' => $stat['created']));
			$allLogs = Log::getWhere($where);
			
			echo $i." ".@$stat['_id']." ".date('d-m-Y H:i', $lastUpdate->sec)." -> ".date('d-m-Y H:i', $stat['created']->sec)." -> Logs concerné : ".count($allLogs)."<BR/>"; 
			$datas = array();
			if(count($allLogs)){
				foreach ($allLogs as $key => $value) {
					$action = @$value['action'];

					//If result => Consolidate by result
					if(!empty($action)){
						if(isset($value['result'])){
							$res_res = @$value['result']['result'];
							if(!isset($datas[$action][$res_res])){
								$datas[$action][0] = 0;
								$datas[$action][1] = 0;
							}
							$datas[$action][$res_res] += 1 ;
						} 
						else{
							if(!isset($datas[$action])) $datas[$action] = 0;
							$datas[$action] += 1;
						}
					}
				}
				$lastUpdate = $value['created'];
				ksort($datas);
				PHDB::update('stats',
					   		array("_id" => $stat['_id']) , 
					   		array('$set' => array("logs" => $datas))
					   	);
			}
	  	}
	  
		echo $i." stats crééés<br/>";
	}

	public function actionupdateAlternatiba(){

		$content = "AREC, Association pour le Respect de l'Environnement et du Cadre de vie;Agriculture;Alimentation;
arTerre;Agriculture;Alimentation;
AVAB, Association pour la Valorisation d'une Agriculture Biologique;Agriculture;Alimentation;
Biodynamie Réunion;Agriculture;Alimentation;
C tout bio;Agriculture;Alimentation;
Cacao péi;Agriculture;Alimentation;
Domaine du café grillé;Agriculture;Biodiversité;
Ecole du Jardin Planétaire ;Agriculture;Alimentation;Biodiversité 
GAB, Groupement des Agricultures Biologiques;Agriculture;Alimentation;Biodiversité 
GCEIP, Militan pou la tèr;Agriculture;Alimentation;
GERME;Agriculture;Alimentation;
Latitude fruitière;Agriculture;Alimentation;
Le Labyrinthe En Champ Thé;Agriculture;Alimentation;
Le lien végétal;Agriculture;Alimentation;
Le verger de la chapelle;Agriculture;Alimentation;
AD2R, Association Développement Rural Réunion;Agriculture ;;
Agro&co;Agriculture ;;
Passages formation;Agriculture ;Alimentation ;
SAFER, Société d'Aménagement Foncier et d'Etablissement Rural ;Agriculture ;;
La Part des Anges ;Alimentation;;
La Ruche qui dit Oui;Alimentation;;
la z'olie crèpe;Alimentation;;
Tisane héritage tradition;Alimentation ;;
Acquatiris;Aménagement, Transport, Construction;;
ATR-FNAUT, Alternatives Transport Réunion;Aménagement, Transport, Construction;;
Bambou, Régis Brinsinger;Aménagement, Transport, Construction;;
Bambouseraie du Guillaume;Aménagement, Transport, Construction;;
CAUE 974, Conseil d'Architecture, d'Urbanisme et de l'Environnement ;Aménagement, Transport, Construction;;
CRPV, Comité Réunionnais pour la Promotion du Vélo ;Aménagement, Transport, Construction;;
Globice, Groupe Local d'Observation et d'Identification des Cetacés;Biodiversité;;
Réserve Naturel Marine;Biodiversité;;
APE, Association d'aménagement et de protection de l'environnement;Biodiversité ;;
APLAMEDOM Réunion, Association pour les PLantes Aromatiques et MEdicinales de la Réunion;Biodiversité ;;
APN, Amis des Plantes et de la Nature;Biodiversité ;;
APPER, Association Promotion Patrimoine Écologie Réunion;Biodiversité ;;
ARDA, Association Réunionnaise de Développement de l'Aquaculture (Hydrô Réunion);Biodiversité ;;
Kelonia;Biodiversité ;;
Le conservatoire du littoral;Biodiversité ;;
Le Parc National ;Biodiversité ;;
Nature Océan Indien;Biodiversité ;;
SEOR, Société d'Etude Ornitologiques de la Réunion;Biodiversité ;;
SREPEN, Société Réunionnaise pour l'Etue et la Protection de l'ENvironnement;Biodiversité ;;
Surfrider Foundation;Biodiversité ;Citoyenneté ;
Vie océane;Biodiversité ;;
EMMAUS;Citoyenneté;;
GRANDDIR, Groupement Régional des Acteurs de l’éducation à l’eNvironnement pour un Développement Durable de l’Ile de La Réunion;Citoyenneté;;
Libre974;Citoyenneté;;
Réseau WARN-ZIG;Citoyenneté;;
Unit métis;Citoyenneté ;;
Yourte en scène;Citoyenneté ;;
Ecomanifestation;Déchets;;
Titang recup;Déchets;;
AIR, Association des Inclassables Réunionnais ;Déchets ;Aménagement, Transport, Construction;
ART Récup';Déchets ;;
Carto d'O ;Déchets ;;
Collectif zéro déchet;Déchets ;;
Les palettes de Marguerite;Déchets ;;
Les rencontres alternatives ;Déchets ;;
OCRE, Organisation des Consommateurs Respectueux de l'Environnement;Déchets ;;
Poc Poc;Economie Sociale et Solidaire ;;
Réunion équitable;Economie Sociale et Solidaire ;;
Réunisel ;Economie Sociale et Solidaire ;;
Béb' écolo;Education;;
Ekolo tipa tipa;Education;;
ADEME, Agence De l'Environnement et de la Maîtrise de l'Energie;Energie;;
AKUO Fondation;Energie;;
Robin des mers;Energie;;
ANPCEN, Association Nationale pour la Protection du Ciel et de l'Environnement Nocturne ;Energie ;;
ARMSE, Association Réunionnaise Médicale Santé Environnement;Santé;;
La vie en santé;Santé;;
";
		$i = 0;
		$array_rows = str_getcsv($content, "\n");
		foreach ($array_rows as $row) {
			
			$contentRow = str_getcsv($row, ";");
			$name = "";

			//Name
			if(isset($contentRow[0])){
				$name = $contentRow[0];
				unset($contentRow[0]);

				//tag
				$result = Organization::getWhere(array('name' => new MongoRegex("/".$name."/i"), 'source.key' => 'AlternatibaPei'));
				if(is_array($result) && $result){
					foreach ($result as $id => $value) {

						//Format
						foreach ($value["tags"] as $keyTag => $valueTag) {
							$value["tags"][$keyTag] = TextHelper::createHashTag($valueTag);
						}

						//merge
						$value["tags"]= Tags::filterAndSaveNewTags(array_unique(array_merge($value["tags"], $contentRow)));

						//case vide
						foreach ($value["tags"] as $k => $v) {
				       		if (empty($v)) unset($value["tags"][$k]);
				    	}
					}

					//update
					$i++;
					// echo "<br>$i ".$name." ";
					// print_r($value["tags"]);
					Organization::updateOrganizationField($id, 'tags', $value["tags"], "5534fd9da1aa14201b0041cb");
					// die();
				}
			}
			else{
				// echo "<br> attention => ".$name;
			}

		}

			die('OK');

	}

	public function actionAddBadgeOpenData(){
		$types = array(Event::COLLECTION, Organization::COLLECTION, Project::COLLECTION);
		$res = array();
		foreach ($types as $key => $type) {
			$entities = PHDB::find($type,array("preferences.isOpenData" => true), 0, array("_id"));
			$eeeee = array();
			foreach ($entities as $key => $entity) {
				$eeeee[] = Badge::addAndUpdateBadges("opendata", (String)$entity["_id"], $type);
			}
			$res[$type] = $eeeee;

		}

		//var_dump(count($res));

		foreach ($res as $key => $val) {
			echo "</br> </br>".$key;
			foreach ($val as $key2 => $val2) {
				echo "</br> </br>";
				echo "-------------------</br>";
				var_dump($val2);
			}		
		}
	}


	public function actionAddOpenEdition(){
		$types = array(Event::COLLECTION, Organization::COLLECTION, Project::COLLECTION);
		$res = array();
		foreach ($types as $key => $type) {
			$entities = PHDB::find($type,array("preferences.isOpenEdition" => array('$exists' => 0)), array("_id", "links", "preferences"));
			$eeeee = array();
			foreach ($entities as $key => $entity) {
				if(!empty($entity["links"])){
					$isAdmin = false;
					if($type == Project::COLLECTION){
						if (!empty($entity["links"]["contributors"])) {
							foreach ($entity["links"]["contributors"] as $key => $contributors) {
								if(!empty($contributors["isAdmin"]) && $contributors["isAdmin"] == true){
									$isAdmin = true;
									break;
								}	
							}
						}
					}
					if($type == Event::COLLECTION){
						if (!empty($entity["links"]["attendees"])) {
							foreach ($entity["links"]["attendees"] as $key => $attendees) {
								if( !empty($attendees["isAdmin"]) && $attendees["isAdmin"] == true){
									$isAdmin = true;
									break;
								}	
							}
						}
							
					}

					if($type == Organization::COLLECTION){
						if (!empty($entity["links"]["members"])) {
							foreach ($entity["links"]["members"] as $key => $members) {
								if( !empty($members["isAdmin"]) && $members["isAdmin"] == true){
									$isAdmin = true;
									break;
								}	
							}
						}	
					}

					if($isAdmin == false){
						$entity["preferences"]["isOpenEdition"] = true ;
					}else{
						$entity["preferences"]["isOpenEdition"] = false ;
					}
				}else{
					$entity["preferences"]["isOpenEdition"] = true ;	
				}

				PHDB::update($type,
					   		array("_id" => $entity['_id']) , 
					   		array('$set' => array("preferences" => $entity["preferences"]))
					   	);
				$eeeee[] = $entity;
			}
			$res[$type] = $eeeee;

		}
		foreach ($res as $key => $val) {
			echo "</br> </br>".$key;
			foreach ($val as $key2 => $val2) {
				echo "</br> </br>";
				echo "-------------------</br>";
				var_dump($val2);
			}		
		}
	}



	public function actionRecherche(){
		$Citoyen = PHDB::findAndSortAndLimitAndIndex(Person::COLLECTION , array(), array("name" => 1), 10, 0);
		$allCitoyen = PHDB::findAndSortAndLimitAndIndex(Person::COLLECTION , array(),array("name" => 1), 5, 0);
		$allCitoyen2 = PHDB::findAndSortAndLimitAndIndex(Person::COLLECTION , array(), array("name" => 1), 5, 5);


		foreach ($Citoyen as $key => $value) {
			var_dump(@$value["name"]);
			echo "<br/>";
		}
		echo "<br/><br/>-------------------------------<br/><br/>";
		foreach ($allCitoyen as $key => $value) {
			var_dump(@$value["name"]);
			echo "<br/>";
		}
		echo "<br/><br/>-------------------------------<br/><br/>";
		foreach ($allCitoyen2 as $key => $value) {
			var_dump(@$value["name"]);
			echo "<br/>";
		}
	}


	public function actionCheckGeoShape(){
		Import::checkGeoShape();
	}

	public function actionCheckGeo(){
		Import::checkGeo();
	}

	public function actionCheckGeoPostalCodes(){
		Import::checkGeoPostalCode();
	}

	public function actionDepRegion(){
		$where = array("country" => "BEL");
        $cities = PHDB::find(City::COLLECTION, $where);

        $dep = array() ;
        $region = array() ;

        $depS = "" ;
        $regionS = "" ;

        foreach ($cities as $key => $value) {
        	if(!in_array($value["region"], $region)){
        		$region[] = $value["region"];
        		$regionS .= '"'.$value["regionName"].'" => array("'.$value["regionName"].'","'.$value["region"].'"), <br/>';
        	}

        	if(!in_array($value["dep"], $dep)){
        		$dep[] = $value["dep"];
        		$depS .= '"'.$value["depName"].'" => array("'.$value["depName"].'","'.$value["dep"].'"), <br/>';
        	}
        }

        echo $depS ;
        echo "<br><br>";
        echo $regionS;
	}


	public function actionCheckNameBelgique(){
		$cities = PHDB::find(City::COLLECTION, array("country" => "BE"));
		$nbcities = 0 ;
		$str = "" ;
		foreach ($cities as $key => $city) {
			$name = $city["name"];
			$find = false ;
			if(count($city["postalCodes"]) > 1){
				foreach ($city["postalCodes"] as $keyCP => $cp) {
					//echo  $cp["name"]." : " .$name."<br>" ;
					if(trim($cp["name"]) == trim($name)){
						$find =true;
					}
				}

				if($find == false){
					$nbcities++;
					$str .=  $key." : ".$name."<br>" ;
				}
			}
			

			
		}
		echo  "NB Cities : " .$nbcities."<br>" ;
		echo $str;
	}

	/*"latitude": "46.493621",
"longitude": 
"62301"*/

	public function actionTestCityByLatLngGeoShape(){
		$lat = "48.873479";
		$lon = "2.3302237";
		$cp = "75599";
		$city = SIG::getCityByLatLngGeoShape($lat, $lon,$cp);
		$city2 = SIG::getCityByLatLngGeoShape($lat, $lon,null);
        var_dump($city);
        echo "<br><br>--------------------------<br><br>";
        var_dump($city2);
	}

	public function actionWikidata(){
		$cities = PHDB::find(City::COLLECTION, array("wikidataID" => array('$exists' => false) , 'country' => array('$ne' => "BE")));
		$nbcities = count($cities) ;
		$str = "id;name;insee;country" ;
		foreach ($cities as $key => $city) {
			$name = $city["name"];
			$str .=  $key." ; ".$name." ; ".$city["insee"]." ; ".$city["country"]."<br>" ;
		}
		echo  "NB Cities : " .$nbcities."<br>" ;
		echo $str;
	}
}