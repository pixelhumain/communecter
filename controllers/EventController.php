<?php
/**
 * EventController.php
 *
 * tous ce que propose le PH en terme de gestion d'evennement
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 15/08/13
 */
class EventController extends CommunecterController {
    const moduleTitle = "Évènement";
    
  protected function beforeAction($action) {
    parent::initPage();
    return parent::beforeAction($action);
  }
  public function actions()
  {
      return array(
          'edit'         => 'citizenToolKit.controllers.event.SaveAttendees',
          'saveattendees' => 'citizenToolKit.controllers.event.DashboardAction',
          'save'         => 'citizenToolKit.controllers.event.SaveAction',
      );
  }

 
  /* **************************************
   *  CALENDAR
   ***************************************** */

 //Get the events for create the calendar
  //TODO JR => refactor it
  public function actionGetCalendar($type, $id){
  	$events = array();
  	$organization = Organization::getPublicData($id);
  	if(isset($organization["links"]["events"])){
  		foreach ($organization["links"]["events"] as $key => $value) {
  			$event = Event::getPublicData($key);
  			$events[$key] = $event;
  		}
  	}
  	foreach ($organization["links"]["members"] as $newId => $e) {
  		if($e["type"] == Organization::COLLECTION){
  			$member = Organization::getPublicData($newId);
  		}else{
  			$member = Person::getPublicData($newId);
  		}
  		if(isset($member["links"]["events"])){
  			foreach ($member["links"]["events"] as $key => $value) {
  				$event = Event::getPublicData($key);
  				$events[$key] = $event;	
  			}
  			
  		}
  	}
  	Rest::json($events);
  }
}