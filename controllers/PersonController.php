<?php
class PersonController extends CommunecterController {

  public $hasSocial = false;
  public $loginRegister = true;

  
  public function accessRules() {
    return array(
      // not logged in users should be able to login and view captcha images as well as errors
      array('allow', 'actions' => array('index','graph','register','register2')),
      // logged in users can do whatever they want to
      array('allow', 'users' => array('@')),
      // not logged in users can't do anything except above
      array('deny'),
    );
  }

	protected function beforeAction($action) {
	    parent::initPage();
	    return parent::beforeAction($action);
	}

	public function actions()
	{
	    return array(
	        'index'              => 'citizenToolKit.controllers.person.IndexAction',
	        'login'     	       => 'citizenToolKit.controllers.person.LoginAction',
          'sendemail'          => 'citizenToolKit.controllers.person.SendEmailAction',
	        'logout'     	       => 'citizenToolKit.controllers.person.LogoutAction',
	        'authenticate'       => 'citizenToolKit.controllers.person.AuthenticateAction',
	        'dashboard'  	       => 'citizenToolKit.controllers.person.DashboardAction',
          'detail'             => 'citizenToolKit.controllers.person.DetailAction',
	        'follows'  		       => 'citizenToolKit.controllers.person.FollowsAction',
	        'disconnect'         => 'citizenToolKit.controllers.person.DisconnectAction',
	        'activate'  	       => 'citizenToolKit.controllers.person.ActivateAction',
	        'register'  	       => 'citizenToolKit.controllers.person.RegisterAction',
	        'getnotification'    => 'citizenToolKit.controllers.person.GetNotificationAction',
          'getthumbpath'       => 'citizenToolKit.controllers.person.getThumbPathAction',
          'invite'  		       => 'citizenToolKit.controllers.person.InviteAction',
	        'invitation'         => 'citizenToolKit.controllers.person.InvitationAction',
	        'updatefield'	       => 'citizenToolKit.controllers.person.UpdateFieldAction',
          'update'             => 'citizenToolKit.controllers.person.UpdateAction',
          'directory'          => 'citizenToolKit.controllers.person.DirectoryAction',
          'data'               => 'citizenToolKit.controllers.person.DataAction',
          'chooseinvitecontact'      => 'citizenToolKit.controllers.person.ChooseInviteContactAction',
          'changepassword'     => 'citizenToolKit.controllers.person.ChangePasswordAction',
          'changerole'         => 'citizenToolKit.controllers.person.ChangeRoleAction',
          'checkusername'      => 'citizenToolKit.controllers.person.CheckUsernameAction',
          'checklinkmailwithuser'   => 'citizenToolKit.controllers.person.CheckLinkMailWithUserAction',
          'validateinvitation' => 'citizenToolKit.controllers.person.ValidateInvitationAction',
          'getuseridbymail'   => 'citizenToolKit.controllers.person.GetUserIdByMailAction',
          "updatesettings" => 'citizenToolKit.controllers.person.UpdateSettingsAction'
	    );
	}

public function actionAbout(){

  	$person = PHDB::findOne(PHType::TYPE_CITOYEN, array( "_id" => new MongoId(Yii::app()->session["userId"]) ) );
  	$tags = PHDB::findOne( PHType::TYPE_LISTS,array("name"=>"tags"), array('list'));
  	
  	$this->render( "about" , array("person"=>$person,'tags'=>json_encode($tags['list'])) );

}
public function actionInitDataPeople()
{
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initModuleData( $this->module->id, "personNetworking", PHType::TYPE_CITOYEN,true );
    $import = Admin::initModuleData($this->module->id, "organizationNetworking", Organization::COLLECTION);

    $result = ( $import["errors"] > 0 ) ? false : true;
    Rest::json( $import );
    Yii::app()->end();
}

  public function actionInitDataPeopleAll()
  {
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true );

    $result = ( $import["errors"] > 0 ) ? false : true;
    Rest::json( $import );
    Yii::app()->end();
  }

  public function actionImportMyData()
  {
    $base = 'upload'.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.Yii::app()->session["userId"].DIRECTORY_SEPARATOR;
    if( Yii::app()->session["userId"] && file_exists ( $base.Yii::app()->session["userId"].".json" ) )
    {
      //inject Data brute d'une liste de Person avec Id
      $res = array("result"=>true, "msg"=>"import success");//Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true );
      //$res["result"] = ( isset($res["errors"]) && $res["errors"] > 0 ) ? false : true;
    } else 
      $res = array("result"=>false, "msg"=>"no Data to Import");

    Rest::json( $res );
    Yii::app()->end();
  }

  public function actionClearInitDataPeopleAll()
  {
    //inject Data brute d'une liste de Person avec Id
    $import = Admin::initMultipleModuleData( $this->module->id, "personNetworkingAll", true,true,true );

    Rest::json( $import );
    Yii::app()->end();
  }
 
 public function actionSendMail()
  {
    foreach ($_POST['mails'] as $value) 
    {
      if (filter_var($value, FILTER_VALIDATE_EMAIL)) 
      {

        $params = array(
        "type" => Cron::TYPE_MAIL,
        "tpl"=>'sharePH',
          "subject" => 'Rejoint-nous sur PixelHumain',
          "from"=>Yii::app()->params['adminEmail'],
          "to" => $value,
          "tplParams" => array( "message"=>$_POST['textmail'],
                                "personne"=>Yii::app()->session['userId'])
          );
      
        Mail::schedule($params);



        /*$message = new YiiMailMessage;
        $message->setSubject("Communecte toi");
        $message->setBody($_POST['textmail']."<br/><a href='http://pixelhumain.com'>PixelHumain</a>", 'text/html');
        $message->addTo($value);
        $message->from = Yii::app()->params['adminEmail'];

        Yii::app()->mail->send($message);
       
        Yii::app()->session["mailsend"] = true;*/

      }
    
    }
    return Rest::json(array('result'=> true));
  }

}