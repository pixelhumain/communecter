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
		$isAdmin = false;

		if($memberType == Person::COLLECTION) {
			$class = "Person";
			$isAdmin = (isset($_POST["memberIsAdmin"])) ? $_POST["memberIsAdmin"] : false;
			if ($isAdmin == "1") {
				$isAdmin = true;
			} else {
				$isAdmin = false;
			}
		} else if ($memberType == Organization::COLLECTION) {
			$class = "Organization";
			$isAdmin = false;
		} else {
			throw new CTKException("Can not manage the type ".$memberType);
		}

		//The member does not exist we have to create a new member
		if ($memberId == "") {
			$memberName = (isset($_POST['memberName'])) ? $_POST['memberName'] : "";
			$memberEmail = (isset($_POST['memberEmail'])) ? $_POST['memberEmail'] : "";

			$member = array(
				 'name'=>$memberName,
				 'email'=>$memberEmail,
				 'invitedBy'=>Yii::app()->session["userId"]);			
			
			//Type d'organization
			if ($memberType == Organization::COLLECTION) { 
				$member["type"] = (isset($_POST["organizationType"])) ? $_POST["organizationType"] : "";
			}

			//create an entry in the right type collection
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

	public function actionRemoveMember($memberId, $memberType, $memberOfId, $memberOfType) {
		$res = array( "result" => false , "msg" => "Something went wrong" );
		try {
			$res = Link::removeMember($memberOfId, Organization::COLLECTION, $memberId, $memberType, Yii::app()->session['userId']);
		} catch (CommunecterException $e) {
			$res = array( "result" => false , "msg" => $e->getMessage() );
		}

		return Rest::json($res);
		
	}

	public function actionDisconnect($id, $type, $idTo, $typeTo) {

	}

}