<?php
class TestController extends CommunecterController {
  
  protected function beforeAction($action) {
	return parent::beforeAction($action);
  }

  public function actionTest() {
	var_dump(Link::addMember("551a5c00a1aa146d160041b0", PHType::TYPE_ORGANIZATIONS, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"], true));

	/*var_dump(Link::connect("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"]));
	 
	var_dump(Link::isConnected("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN));

	var_dump(Link::disconnect("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN, Yii::app()->session["userId"]));
	
	var_dump(Link::isConnected("54fed0eca1aa1411180041ae", PHType::TYPE_CITOYEN, 
	  "5374fc91f6b95c9c1b000871", PHType::TYPE_CITOYEN));
	*/
	//Rest::Json($res);

  }

  public function actionInsertNewPerson() {
	$res = Person::insert(array(
	  'name' => "Test", 'email' => "new@email.com", 'postalCode' => "97426", 'pwd' => "vlanlepass"
	  ));

	var_dump($res);

  }

  public function actionListEvent() {
	var_dump(Authorisation::listEventsIamAdminOf(Yii::app()->session["userId"]));

  }

  public function actionAddCron() {

  }
  
  public function actionMail() {
	//send validation mail
	echo "from : ".Yii::app()->params['adminEmail'];
	echo "<br/>";
	echo "to : ".Yii::app()->session['userEmail'];

    //Send Classic Email 
    Mail::send(array("tpl"=>'validation',
         "subject" => 'Confirmer votre compte  pour le site ',
         "from"=>Yii::app()->params['adminEmail'],
         "to" => Yii::app()->session['userEmail'],
         "tplParams" => array( "user"=>Yii::app()->session['userId'] ,
                               "title" => "TEst" ,
                               "logo"  => $this->module->assetsUrl."/images/logo.png" )
    ));

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
                        "codeInsee" => "97400",
                        "verb" => "add",
                        "actorType"=>"persons",
                        "objectType"=>"test",
                        "label" => "Testing Notification Push",
                        "id" => Yii::app()->session['userId']
                    );
        $action = ActStr::buildEntry($asParam);

        //LOGGING WHO TO NOTIFY
        $action["notify"] = ActivityStream::addNotification( array( 
                                                            "persons" => array( Yii::app()->session['userId'] ),
                                                             "label" => "Something Changed" , 
                                                             "icon"=> ActStr::ICON_QUESTION ,
                                                             "url" => 'javascript:alert(  "testing notifications"  );' 
                                                        ));
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
}