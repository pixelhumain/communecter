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
						$this->getGeoPositionByCp($me["cp"]));
			Rest::json( $res );
			Yii::app()->end();
        }
		Rest::json( $user );
		Yii::app()->end();
  	}
  	
	//******************************************************************************
	//** MENU NETWORK
	//******************************************************************************
	
	public function actionShowMyNetwork() //show element on map
    {
	    $whereGeo = $this->getGeoQuery($_POST, 'geo');
	    $where = array();//'cp' => array( '$exists' => true ));
	    
	    $where = array_merge($where, $whereGeo);
	    				
    	$citoyens = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	$citoyens["origine"] = "ShowMyNetwork";
    	
    	
        Rest::json( $citoyens );
        Yii::app()->end();
	}
	
	
	//******************************************************************************
	//** MENU COMPANIES
	//******************************************************************************
		
	public function actionShowNetworkMapping() //show element on map
    {
    	//début de la requete => scope geographique
    	$where = array( 'name' => $_POST["assoName"] );
		$asso = PHDB::findOne(Organization::COLLECTION, $where);
        
     	$orgaMembres = array();
    	
		foreach($asso["membres"] as $membre){
			if(in_array($membre["tag_rangement"], $_POST["types"])){
				$where = array( 'geo'  => array( '$exists' => true ),
								'_id' => new MongoId($membre["id"]) );
			
				$newMembre = PHDB::findOne(PHType::TYPE_CITOYEN, $where);
				$newMembre["type"] = $membre["tag_rangement"];
					
				foreach($asso["tags_rangement"] as $tagR){
					if($membre["tag_rangement"] == $tagR["name"]){
						$newMembre["ico"] = $tagR["ico"];
						$newMembre["color"] = $tagR["color"];
						break;
					}
				}
				$orgaMembres[] = $newMembre;
			}
		}
    	
    	Rest::json( $orgaMembres );
        Yii::app()->end();
    }
    
    
	//******************************************************************************
	//** MENU COMPANIES
	//******************************************************************************
	
	public function actionShowLocalCompanies() 
    {
	    $whereGeo = $this->getGeoQuery($_POST, 'geo');
	    $where = array('type' => "company");
	    
	    $where = array_merge($where, $whereGeo);
	    				
    	$companies = PHDB::find(Organization::COLLECTION, $where);
    	$companies["origine"] = "ShowLocalCompanies";
    	  	
        Rest::json( $companies );
        Yii::app()->end();
	}
	
	//******************************************************************************
	//** MENU LOCAL STATE
	//******************************************************************************
	
	public function actionShowLocalState() 
    {
    	$whereGeo = $this->getGeoQuery($_POST, 'geo');
	    $where = array('type' => "association");
	    
	    
	    $where = array_merge($where, $whereGeo);
	    				
    	$states = PHDB::find(Organization::COLLECTION, $where);
    	$states["origine"] = "ShowLocalState";
    	   	
        Rest::json( $states );
        Yii::app()->end();
	}
		public function actionGetNewsLocalState() //return News for news-stream
		{
		
		}
		
	//******************************************************************************
	//** MENU LOCAL EVENTS
	//******************************************************************************
	
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
		public function actionGetNewsLocalEvents() //return News for news-stream
		{
		
		}
		
		
	//******************************************************************************
	//** GET GEO-QUERY
	//******************************************************************************
		
	private function getGeoQuery($params, $att){
		return array(	$att  => array( '$exists' => true ),
    					$att.'.latitude' => array('$gt' => floatval($params['latMinScope']), '$lt' => floatval($params['latMaxScope'])),
						$att.'.longitude' => array('$gt' => floatval($params['lngMinScope']), '$lt' => floatval($params['lngMaxScope']))
					  );
	}
	
	
	public function actionInitDataNetworkMapping(){
		
		//liste des tags de rangements de l'asso
		$tags_rangements = array(
								array(	"name" => "Citoyens", 
										"ico" => "male", 
										"color" => "yellow"),
										
								array(	"name" => "Entreprises", 
										"ico" => "briefcase", 
										"color" => "blue"),
										
								array(	"name" => "Collaborateurs", 
										"ico" => "circle", 
										"color" => "purple"),
										
								array(	"name" => "Chercheurs", 
										"ico" => "male", 
										"color" => "green")
							);
		
		//liste des tags de rangements de chaque membre
		$tagsR = array( "Citoyens", "Citoyens", "Citoyens", "Entreprises", "Entreprises", 
						"Collaborateurs", "Chercheurs", "Chercheurs", "Chercheurs", "Chercheurs");
		
		$where = array('geo' => array( '$exists' => true ));				
    	$citoyens = PHDB::findAndSort(PHType::TYPE_CITOYEN, $where, array('name' => 1), 10);
    	
    	$membres = array(); $i = 0;
    	foreach($citoyens as $citoyen){
    		$membres[] = array("id" => $citoyen["_id"], "tag_rangement" => $tagsR[$i]);
    		$i++;
    	}
    	
    	$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$me = PHDB::findOne(PHType::TYPE_CITOYEN, $where);
    	
    	
    	$newAsso = array(
    	
        "@context" => array("@vocab" => "http://schema.org",
        					"ph" => "http://pixelhumain.com/ph/ontology/"
    						),
   		"email" => $me["email"],
    	"name" => "asso1",
    	"type" => "association",
    	"cp" => "75000",
    	"address" => array(	"@type" => "PostalAddress",
        					"postalCode" => "75000",
        					"addressLocality" => "France"
    					),
   		"description" => "Description de l'association",
    	"tags_rangement" => $tags_rangements,
    	"membres" => $membres
    	
    	);
    	
    	$res = PHDB::insert(Organization::COLLECTION, $newAsso);
    	
    	if($res["ok"] == 1) $res = "Initialisation des données : OK</br>Rechargez la carte !";
        Rest::json( $res );
        Yii::app()->end();
	}
	
	public function actionDashboard($id) {
		//get The organization Id
	    if (empty($id)) {
	      throw new CommunecterException("The organization id is mandatory to retrieve the organization !");
	    }

	    $organization = Organization::getPublicData($id);

	    $this->title = "Annuaire du réseau";
	    $this->subTitle = "Trouver une structure grâce à de multiples critères";
	    $this->pageTitle = "Communecter - ".$this->title;

	    //Get this organizationEvent
	    $events = array();
	    if(isset($organization["links"]["events"])){
	  		foreach ($organization["links"]["events"] as $key => $value) {
	  			$event = Event::getPublicData($key);
	  			$events[$key] = $event;
	  		}
	  	}

	    //Manage random Organization
	    $organizationMembers = Organization::getMembersByOrganizationId($id, Organization::COLLECTION);
        $randomOrganizationId = array_rand($organizationMembers);
	    $randomOrganization = Organization::getById($randomOrganizationId);

	    $this->render( "dashboard", array("randomOrganization" => $randomOrganization, "organization" => $organization, "events" => $events));
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


//{"54d9ff9bc0461f4414ff0844":{"_id":{"$id":"54d9ff9bc0461f4414ff0844"},"@context":{"@vocab":"http://schema.org","ph":"http://pixelhumain.com/ph/ontology/"},"email":"tg@mail.com","name":"asso1","type":"association","ph:created":1423572891,"ph:owner":"tg@mail.com","@type":"NGO","cp":"75000","address":{"@type":"PostalAddress","postalCode":"75000","addressLocality":"France"},"description":"dfhfdhfgh","membres":[{"id":"54265d58c0461fcf528e8d04","tag_rangement":"Citoyens"},{"id":"54daf98ab544492102580835","tag_rangement":"Citoyens"},{"id":"54daf98ab544492102580834","tag_rangement":"Entreprises"},{"id":"54daf98ab544492102580832","tag_rangement":"Chercheurs"}],"tags_rangement":[{"name":"Citoyens","ico":"circle","color":"yellow"},{"name":"Entreprises","ico":"stop","color":"blue"},{"name":"Collaborateurs","ico":"circle","color":"red"},{"name":"Chercheurs","ico":"rocket","color":"green"},{"name":"pixelActif","ico":"circle","color":"yellow"}]}}
/*
[{"54265d58c0461fcf528e8d04":{"_id":{"$id":"54265d58c0461fcf528e8d04"},"email":"tg@mail.com","pwd":"7ddeae63181559a4012005f3a2d1acabdf7f7d72b7b3fb272bd80e1420d60e19","tobeactivated":true,"adminNotified":false,"created":1411800408,"cp":"98800","name":"Tristan Calédonie 1","applications":{"communecter":{"usertype":"communecter"},"sig":{"isAdmin":true,"usertype":"sig"},"news":{"isAdmin":true,"usertype":"news"},"twh":{"isAdmin":true,"usertype":"twh"},"user":{"isAdmin":true,"usertype":"user"}},"geo":{"@type":"GeoCoordinates","latitude":-22.302959,"longitude":166.439087},"geoPosition":{"type":"Point","coordinates":[166.439087,-22.302959]},"memberOf":[{"$id":"5472c1e8c0461f190288cf96"},{"$id":"5472c1e8c0461f190288cf97"},{"$id":"5472c1e8c0461f190288cf98"}],"knows":[{"type":"group","name":"*","members":[{"$id":"542e0c6cc0461f1225892696"},{"$id":"542e0c6cc0461f1225892699"},{"$id":"542e0c6cc0461f122589269a"},{"$id":"542e0c6cc0461f122589269b"},{"$id":"542e0c6cc0461f122589269c"}]},{"type":"group","name":"Famille","members":[{"$id":"542e0c6cc0461f1225892689"},{"$id":"542e0c6cc0461f122589268a"},{"$id":"542e0c6cc0461f122589268b"},{"$id":"542e0c6cc0461f122589268c"},{"$id":"542e0c6cc0461f122589268d"}]},{"type":"group","name":"Amis","members":[{"$id":"542e0c6cc0461f122589268e"},{"$id":"542e0c6cc0461f122589268f"},{"$id":"542e0c6cc0461f1225892690"},{"$id":"542e0c6cc0461f1225892691"},{"$id":"542e0c6cc0461f1225892694"}]}],"associations":[{"$id":"54d9ff9bc0461f4414ff0844"},{"$id":"54db07b5b54449a90431bdd5"}],"city":"","tags":"","address":{"addressLocality":""}},"type":"Citoyens"},
{"54daf98ab544492102580835":{"_id":{"$id":"54daf98ab544492102580835"},"name":"Olivier Cortès","type":"pixelActif","created":1423636874,"geo":{"@type":"GeoCoordinates","longitude":-0.8349609,"latitude":45.2748864},"geoPosition":{"type":"Point","coordinates":[-0.8349609,45.2748864]}},"type":"Citoyens"},
{"54daf98ab544492102580834":{"_id":{"$id":"54daf98ab544492102580834"},"name":"Guillaume Libersat","type":"pixelActif","created":1423636874,"geo":{"@type":"GeoCoordinates","longitude":2.8125,"latitude":50.3174081},"geoPosition":{"type":"Point","coordinates":[2.8125,50.3174081]}},"type":"Entreprises"},
{"54daf98ab544492102580832":{"_id":{"$id":"54daf98ab544492102580832"},"name":"Elf Pavlik","type":"pixelActif","created":1423636874,"geo":{"@type":"GeoCoordinates","longitude":8.9648438,"latitude":51.179343},"geoPosition":{"type":"Point","coordinates":[8.9648438,51.179343]}},"type":"Chercheurs"}]

*/