<?php
/**
 * LinkController.php
 *
 * Manage Links between Organization, Person, Projet and Event
 *
 * @author: Sylvain Barbot <sylvain@pixelhumain.com>
 * Date: 05/05/2015
 */
class LinkController extends CommunecterController {

	protected function beforeAction($action) {
		parent::initPage();
		return parent::beforeAction($action);
	}

	public function actionSaveMember() {
		$res = array( "result" => false , "msg" => "Something went wrong" );
		
		$memberId = (isset($_POST['memberId'])) ? $_POST['memberId'] : "";
		$memberType = (isset($_POST['memberType'])) ? $_POST['memberType'] : "";
		$memberOfId = $_POST["parentOrganisation"];
		$memberOfType = Organization::COLLECTION;

		//The member does not exist we have to create a new member
		if ($memberId == "") {
			$memberName = (isset($_POST['memberName'])) ? $_POST['memberName'] : "";
			$memberEmail = (isset($_POST['memberEmail'])) ? $_POST['memberEmail'] : "";

			$member = array(
				 'name'=>$memberName,
				 'email'=>$memberEmail,
				 'invitedBy'=>Yii::app()->session["userId"]);			
			
			//create an entry in the right type collection
			if($memberType == Person::COLLECTION) {
				$class = "Person";
				$isAdmin = (bool)(isset($_POST["memberIsAdmin"])) ? $_POST["memberIsAdmin"] : false;
			} else if ($memberType == Organization::COLLECTION) { 
				$class = "Organization";
				$isAdmin = false;
				$member["type"] = (isset($_POST["organizationType"])) ? $_POST["organizationType"] : "";
			} else {
				throw new CTKException("Can not manage the type ".$memberType);
			}

			$result = $class::createAndInvite($member);
			if ($result["result"]) {
				$memberId = $result["id"];
			} else {
				return Rest::json($result);
			}
		}

		//Manage Role : see with JR : maybe to move on the model
		if(isset($_POST["memberRoles"])){
			if (gettype($_POST['memberRoles']) == "array") {
				$roles = $_POST['memberRoles'];
			} else if (gettype($_POST['memberRoles']) == "string") {
				$roles = explode(",", $_POST['memberRoles']);
			}
			$rolesOrgTab = array();
			if(isset($organization["roles"])){
				$rolesOrgTab = $organization["roles"];
			}
			foreach ($roles as $value) {
				if(!in_array($value, $rolesOrgTab)){
					array_push($rolesOrgTab, $value);
				}
			}

			Role::setRoles($rolesOrgTab, $memberOfId, Organization::COLLECTION);
		}

		try {
			$res = Link::addMember($memberOfId, $memberOfType, $memberId, $memberType, Yii::app()->session["userId"], $isAdmin, $roles );
			$res["member"] = $class::getById($memberId);
		} catch (CommunecterException $e) {
			$res = array( "result" => false , "msg" => $e->getMessage() );
		}

		return Rest::json($res);
	}

	public function actionRemoveMember($memberId, $memberType, $memberOfId, $memberOfIdType) {
		$res = array( "result" => false , "msg" => "Something went wrong" );
		$typesManaged = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$res = Link::removeMember($organizationId, Organization::COLLECTION, $id, $type, Yii::app()->session['userId']);
		return Rest::json($res);
		
	}

	public function actionConnect($id, $type, $idTo, $typeTo) {
		$typesManaged = array(Person::COLLECTION, Organization::COLLECTION, Project::COLLECTION, Event::COLLECTION);
		$res = array( "result" => false , "msg" => "Something went wrong" );


	}

	public function actionDisconnect($id, $type, $idTo, $typeTo) {

	}

  //TODO SBAR => part of controls done has been done on the Link model. 
  //TODO SBAR => remove the search of members on email.
  public function actionSaveMemberbck(){
	 $res = array( "result" => false , "msg" => "Something went wrong" );
	 if(Yii::app()->request->isAjaxRequest && isset( $_POST["parentOrganisation"]) )
	 {
	
	$isAdmin = false;
	if (isset($_POST["memberIsAdmin"])) {
	  $isAdmin = $_POST["memberIsAdmin"];
	  if($isAdmin == "true"){
		$isAdmin = true;
	  }else if($isAdmin=="false"){
		$isAdmin = false;
	  }
	}
		//test if organization exists
		if (isset($_POST["parentOrganisation"])) {
	  $organization = Organization::getById($_POST["parentOrganisation"]);
	}

		if($organization)
		{

			$memberEmail = $_POST['memberEmail'];

			if($_POST['memberType'] == "citoyens"){
				$memberType = PHType::TYPE_CITOYEN;
			}else{
				$memberType = Organization::COLLECTION;
			}
			if(isset($_POST["memberId"]) && $_POST["memberId"] != ""){
				$memberEmailObject = PHDB::findOne( $memberType , array("_id" =>new MongoId($_POST["memberId"])), array("email"));
				$memberEmail = $memberEmailObject['email'];
			}
			//check citizen exist by email
			if(preg_match('#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#',$memberEmail))
			{
				
				$member = PHDB::findOne( $memberType , array("email"=>$memberEmail));

				
				

				if( !$member )
				{
					//create an entry in the citoyens collection
					if($_POST['memberType'] == "citoyens"){
						$member = array(
						 'name'=>$_POST['memberName'],
						 'email'=>$_POST['memberEmail'],
						 'invitedBy'=>Yii::app()->session["userId"],
						 'tobeactivated' => true,
						 'created' => time(),
						 'type'=>'citoyen',
					);
						Person::createAndInvite($member);
					}else{
						$member = array(
						 'name'=>$_POST['memberName'],
						 'email'=>$_POST['memberEmail'],
						 'invitedBy'=>Yii::app()->session["userId"],
						 'tobeactivated' => true,
						 'created' => time(),
						 'type'=>'Group',
						);
						Organization::createAndInvite($member);
					}

					$member = PHDB::findOne( $memberType , array("email"=>$memberEmail));
					 //add the member into the organization map
					Link::addMember($_POST["parentOrganisation"], Organization::COLLECTION, $member["_id"], $memberType, Yii::app()->session["userId"], $isAdmin, $roles );
					$member = PHDB::findOne( $memberType , array("email"=>$memberEmail));
					$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true, "member" => $member);
					
		  //TODO : background send email
					//send validation mail

					 //TODO : add an admin notification
					 Notification::saveNotification(array("type"=>NotificationType::NOTIFICATION_INVITATION,
					 "user"=>Yii::app()->session["userId"],
					 "invited"=>$member["_id"]));
					 
				}
				else
				{
				 //person exists with this email and is connected to this Organisation
					if( isset($organization['links']["members"]) && isset( $organization['links']["members"][(string)$member["_id"]] ))

						$res = array( "result" => false , "msg" => "Member allready exists" );
					else {
						Link::addMember($_POST["parentOrganisation"], Organization::COLLECTION, $member["_id"], $memberType, Yii::app()->session["userId"], $isAdmin, $roles );
						$member = PHDB::findOne( $memberType , array("email"=>$memberEmail));
						$res = array("result"=>true,"msg"=>"Vos données ont bien été enregistré.","reload"=>true, "member" => $member);
	
					}	
				}
			} else
			$res = array( "result" => false , "msg" => "Email must be valid" );
		}
	 }
	 Rest::json( $res );
 }
	
}