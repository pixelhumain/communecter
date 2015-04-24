<?php
	/**
 * PodController.php
 *
 */

	class PodController extends CommunecterController {

		protected function beforeAction($action) {
			parent::initPage();
			return parent::beforeAction($action);
		}

		public function actionSliderAgenda($id, $type){
			if($type == Organization::COLLECTION){
				$events = Organization::listEventsPublicAgenda($id);
			}
			else if($type == Person::COLLECTION){
				$events = Authorisation::listEventsIamAdminOf($id);
			  	$eventsAttending = Event::listEventAttending($id);
			  	foreach ($eventsAttending as $key => $value) {
			  		$eventId = (string)$value["_id"];
			  		if(!isset($events[$eventId])){
			  			$events[$eventId] = $value;
			  		}
			  	}
			}
			$params= array();
			$params["events"] = $events;
			$params["itemId"] = $id;
			if(Yii::app()->request->isAjaxRequest)
		        echo $this->renderPartial("sliderAgenda", $params,true);
		    else
		        $this->render("sliderAgenda",$params);
			}
	}
?>