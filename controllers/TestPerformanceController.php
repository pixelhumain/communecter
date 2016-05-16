<?php
class TestPerformanceController extends CommunecterController {
  
	protected function beforeAction($action) {
		return parent::beforeAction($action);
	}
 
 	public function actionListEntities($type) {

 		$managedType = array("Person", "Organization", "Project", "Event");

 		if (! in_array($type, $managedType)) {
 			echo "The type ".$type." is unknown or not managed by the test yet ! <br>";
 			die();
 		}
 		$timeStart = microtime(true);
 		$nbEntities = 0;
 		$res = PHDB::findAndSort($type::COLLECTION, array(), array("_id" => 1), 1000);
 		foreach ($res as $id => $value) {
 			$functionName = "getSimple".$type."ById";
 			$element = $type::$functionName($id);
 			if (!empty($element["profilImageUrl"])) {
 				echo $id." ".$element["profilImageUrl"]."<br>";
 			}
 			$nbEntities++;
 		}

 		$timeSpend = microtime(true) - $timeStart;
 		echo "<br><b>************ End of execution ! ************</b><br>";
 		echo "Total time spent : ".$timeSpend."<br>";
 		echo "To retrieve : ".$nbEntities." entities <br>";
 		echo "Avg time by entity : ".$timeSpend/$nbEntities." <br>";

 	}

}