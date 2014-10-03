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

    protected function beforeAction($action)
  	{
		  return parent::beforeAction($action);
  	}

    /**
     * List all the latest observations
     * @return [json Map] list
     */
	public function actionIndex() 
	{
		$this->render("index");
    }
  
  	public function actionGetMyPosition(){ //Yii::app()->session["userId"]
  		$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$user = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	 
    	 //si l'utilisateur connecté n'a pas enregistré sa position geo
    	 //on prend la position de son CP
    	 foreach($user as $me)
    	 if(!isset($me["geo"]) && isset($me["cp"])) {
    		$where = array(	'cp'  => $me["cp"] );
	 		$city = PHDB::find("cities", $where, array("geo" => true));
	 		
	 		foreach($city as $myCity){
				$res = array(Yii::app()->session["userId"] => 
						array("geo" => 
							array(	"longitude" => $myCity["geo"]["coordinates"][0], 
									"latitude" => $myCity["geo"]["coordinates"][1]
								 )
						));
				Rest::json( $res );
				Yii::app()->end();
        	}
    	}
    	 	
        Rest::json( $user );
        Yii::app()->end();
  	}
  	
  	public function actionShowMyNetwork() 
    {
	    $where = array(	//'cp'  => array( '$exists' => true ),
    					'geo'  => array( '$exists' => true ),
    					'geo.latitude' => array('$gt' => floatval($_POST['latMinScope']), '$lt' => floatval($_POST['latMaxScope'])),
						'geo.longitude' => array('$gt' => floatval($_POST['lngMinScope']), '$lt' => floatval($_POST['lngMaxScope']))
					  
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
					  
	 					);
	 					
    	$users = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	$users["origine"] = "ShowMyNetwork";
    	
    	
        Rest::json( $users );
        Yii::app()->end();
	}
	
	
}


