<?php
/**
 * EventController.php
 * 
 * contient tous ce qui concerne les utilisateurs / clietns TEEO
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 18/07/2014
 */
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
	        'index'       => 'citizenToolKit.controllers.person.IndexAction',
	        'login'     	=> 'citizenToolKit.controllers.person.LoginAction',
	        'logout'     	=> 'citizenToolKit.controllers.person.LogoutAction',
	        'authenticate'=> 'citizenToolKit.controllers.person.AuthenticateAction',
	        'dashboard'  	=> 'citizenToolKit.controllers.person.DashboardAction',
	        'connect'  		=> 'citizenToolKit.controllers.person.ConnectAction',
	        'disconnect'  => 'citizenToolKit.controllers.person.DisonnectAction',
	        'activate'  	=> 'citizenToolKit.controllers.person.ActivateAction',
	        'register'  	=> 'citizenToolKit.controllers.person.RegisterAction',
	        'getnotification' => 'citizenToolKit.controllers.person.GetNotificationAction',
	        'invite'  		=> 'citizenToolKit.controllers.person.InviteAction',
	        'invitation'  => 'citizenToolKit.controllers.person.InvitationAction',
	        'updatefield'	=> 'citizenToolKit.controllers.person.UpdateFieldAction',
          'directory'   => 'citizenToolKit.controllers.person.DirectoryAction',
          'data'        => 'citizenToolKit.controllers.person.DataAction'
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
 

}