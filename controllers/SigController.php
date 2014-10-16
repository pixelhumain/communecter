<?php
/**
 * DefaultController.php
 *
 * OneScreenApp for Communecting people
 *
 * @author: Tibor Katelbach <tibor@pixelhumain.com>
 * Date: 14/03/2014
 */
class SigController extends CommunecterController {

    protected function beforeAction($action) {
		  return parent::beforeAction($action);
  	}

    public function actionNetwork()  	{ $this->renderPartial("network"); 		} 
  	public function actionCompanies() 	{ $this->renderPartial("companies"); 	} 
  	public function actionState() 		{ $this->renderPartial("state"); 		}  
  	public function actionEvents() 		{ $this->renderPartial("events"); 		}
  
  	private function getGeoPositionByCp($cp){
  		$where = array(	'cp'  => $cp );
	 		$city = PHDB::find("cities", $where, array("geo" => true));	 		
	 		foreach($city as $myCity){
				return array("geo" => 
							array(	"longitude" => $myCity["geo"]["coordinates"][0], 
									"latitude" => $myCity["geo"]["coordinates"][1]
								 )
						);
			}
  	}
  
  	public function actionGetMyPosition(){ //Yii::app()->session["userId"]
  		$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$user = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	 
    	 //si l'utilisateur connecté n'a pas enregistré sa position geo
    	 //on prend la position de son CP
    	 foreach($user as $me)
    	 if(!isset($me["geo"]) && isset($me["cp"])) {
    		$res = array(Yii::app()->session["userId"] => 
						getGeoPositionByCp($me["cp"]));
			Rest::json( $res );
			Yii::app()->end();
        }
		Rest::json( $user );
		Yii::app()->end();
  	}
  	
  	public function actionShowMapByOrigine() 
    {
    	$phType = PHType::TYPE_CITOYEN;
    	$where = array(	'geo'  => array( '$exists' => true ),
    					'geo.latitude'  => array('$gt' => floatval($_POST['latMinScope']), '$lt' => floatval($_POST['latMaxScope'])),
						'geo.longitude' => array('$gt' => floatval($_POST['lngMinScope']), '$lt' => floatval($_POST['lngMaxScope']))
					  );	
					  
    	switch(true){
    	
    		case ($_POST['origine'] == "ShowMyNetwork"):
    				array_merge($where, array('cp' => array( '$exists' => true )));
    				$phType = PHType::TYPE_CITOYEN;
    				break;
    				
    		case ($_POST['origine'] == "ShowMyCompanies"):
    				array_merge($where, array('cp' => array( '$exists' => true )));
    				//$phType = PHType::TYPE_GROUPS;
    				break;
    				
    		case ($_POST['origine'] == "ShowMyState"):
    				array_merge($where, array('cp' => array( '$exists' => true )));
    				//$phType = PHType::TYPE_CITOYEN;
    				break;
    				
    		case ($_POST['origine'] == "ShowMyEvent"):
    				array_merge($where, array('cp' => array( '$exists' => true )));
    				//$phType = PHType::TYPE_CITOYEN;
    				break;
    		
		}	
    					
    	$users = PHDB::find($phType, $where);
    	$users["origine"] = $_POST['origine'];
    	   	
        Rest::json( $users );
        Yii::app()->end();
	}

	public function actionShowMyNetwork() 
    {
	    $whereGeo = $this->getGeoQuery($_POST);
	    $where = array();//'cp' => array( '$exists' => true ));
	    
	    $where = array_merge($where, $whereGeo);
	    				
    	$citoyens = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	$citoyens["origine"] = "ShowMyNetwork";
    	
    	
        Rest::json( $citoyens );
        Yii::app()->end();
	}
	
	public function actionShowLocalCompanies() 
    {
	    $whereGeo = $this->getGeoQuery($_POST);
	    $where = array('type' => "company");
	    
	    $where = array_merge($where, $whereGeo);
	    				
    	$companies = PHDB::find(PHType::TYPE_GROUPS, $where);
    	$companies["origine"] = "ShowLocalCompanies";
    	  	
        Rest::json( $companies );
        Yii::app()->end();
	}
	
	public function actionShowLocalState() 
    {
    	$whereGeo = $this->getGeoQuery($_POST);
	    $where = array('type' => "association");
	    
	    
	    $where = array_merge($where, $whereGeo);
	    				
    	$states = PHDB::find(PHType::TYPE_GROUPS, $where);
    	$states["origine"] = "ShowLocalState";
    	   	
        Rest::json( $states );
        Yii::app()->end();
	}
	
	public function actionShowLocalEvents() 
    {
	    $whereGeo = array();//$this->getGeoQuery($_POST);
	    $where = array('geo' => array( '$exists' => true ));
	    
	    $where = array_merge($where, $whereGeo);
	    				
    	$events = PHDB::find(PHType::TYPE_EVENTS, $where);
    	
    	foreach($events as $event){
    	//dans le cas où un événement n'a pas de position geo, 
    	//on lui ajoute grace au CP
    	//il sera visible sur la carte au prochain rechargement
    	if(!isset($event["geo"])){
    				$cp = $event["location"]["address"]["addressLocality"];
    				$queryCity = array( "cp" => strval(intval($cp)),
										"geo" => array('$exists' => true) ); 
					$city =  Yii::app()->mongodb->cities->findOne($queryCity); //->limit(1)
					if($city!=null){ 
						$newPos = array('geo' => array("@type" => "GeoCoordinates",	
											"longitude" => floatval($city['geo']['coordinates'][0]),
											"latitude"  => floatval($city['geo']['coordinates'][1]) ),
										'geoPosition' => $city['geo']
								  );
						Yii::app()->mongodb->events->update( array("_id" => $event["_id"]), 
                    	                                   	 array('$set' => $newPos ) );
            		}
    	}
    	}
    	$events["origine"] = "ShowLocalEvents";
    	Rest::json( $events );
        Yii::app()->end();
	}
	
	private function getGeoQuery($params){
		return array(	'geo'  => array( '$exists' => true ),
    					'geo.latitude' => array('$gt' => floatval($params['latMinScope']), '$lt' => floatval($params['latMaxScope'])),
						'geo.longitude' => array('$gt' => floatval($params['lngMinScope']), '$lt' => floatval($params['lngMaxScope']))
					  );
	}
	
	/* modele de requette geoWithin */
	/*'geoPosition' =>  array('$geoWithin' => 
									array( '$box' => array(array(floatval($_POST['lngMinScope']), 
															  	 floatval($_POST['latMinScope']) 
															 ),
																
														array(floatval($_POST['lngMaxScope']), 
															  floatval($_POST['latMaxScope']) 
															 ),
												 		),
										)
									),
					  */
	
}


