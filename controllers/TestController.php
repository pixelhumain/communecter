<?php
class TestController extends CommunecterController {
  
  protected function beforeAction($action) {
	return parent::beforeAction($action);
  }
  public function actionIndex() {
    $userNotifcations = ActivityStream::getNotifications( array( "notify.id" => Yii::app()->session["userId"] ) );//PHDB::find( ActivityStream::COLLECTION,array("notify.id"  => Yii::app()->session["userId"] ));
    echo count($userNotifcations);
  }
  public function actionKnowsToFollows(){
	 $persons=PHDB::find(Person::COLLECTION);
	foreach($persons as $key => $data){
		if(isset($data["links"]["followers"]) || isset($data["links"]["follows"])){
			$followers=array();
			$follows=array();
			if(isset($data["links"]["followers"]) && !empty($data["links"]["followers"])){
				$followers=$data["links"]["followers"];
			}
			if(isset($data["links"]["follows"]) && !empty($data["links"]["follows"])){
				$follows=$data["links"]["follows"];
			}
			PHDB::update(Person::COLLECTION,
				array("_id" => $data["_id"]) , 
				array('$unset' => array("links.followers" => ""))
			);
			PHDB::update(Person::COLLECTION,
				array("_id" => $data["_id"]) , 
				array('$unset' => array("links.follows" => ""))
			);
			if(!empty($followers)){
				//foreach ($followers as $uid => $e){	
					PHDB::update(Person::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("links.follows" => $followers))
						);
				//}
			}
			if (!empty($follows)){
				foreach ($follows as $uid => $e){	
					if($e["type"]=="citoyens"){
					PHDB::update(Person::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("links.followers.".$uid => $e))
						);
					} else {
						PHDB::update(Person::COLLECTION,
						array("_id" => $data["_id"]) , 
						array('$set' => array("links.follows.".$uid => $e))
						);
					}
				}
			}
			$newLinks=PHDB::findOneById(Person::COLLECTION ,$data["_id"]);
			echo "<br/>/////////////////////////// NEW LINK ////////////////////<br/>";
			print_r($newLinks["links"]);
			/*	if(isset($data["links"]["follows"])
				echo $data["name"]. "=>=>+>=>+>+><br/><br/>";
				$follows = [];
				foreach ($data["links"]["followers"] as $uid => $e){
					PHDB::update(Person::COLLECTION,
								 array("_id" => $data["_id"]) , 
								 array('$set' => array("links.follows" => $follows)));
					$child=array("childId"=>$uid,"childType"=> Person::COLLECTION);
					$follows[$uid] = $e;
					Link::follow($key, Person::COLLECTION, $child);
				}
				//print_r($data["links"]);

				print_r($follows);
				echo "<br/><br/>";


				PHDB::update(Person::COLLECTION,
								 array("_id" => $data["_id"]) , 
								 array('$unset' => array("links.knows" => "")));*/

				
				
			}	
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
  	echo hash('sha256', "mc420011@gmail.com"."communecter974");
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
		'/assets/plugins/dropzone/downloads/css/ph.css',
		'/assets/plugins/dropzone/downloads/dropzone.min.js',
		//lightbox
		'/assets/plugins/lightbox2/css/lightbox.css',
		'/assets/plugins/lightbox2/js/lightbox.min.js'
	);

	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFiles);
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
}