<?php
/**
 * NewsController.php
 *
 *
 * @author: Tristan Goguet
 * Date: 09/11/2014
 */
class NewsController extends CommunecterController {

    protected function beforeAction($action) {
		  return parent::beforeAction($action);
  	}
  	
    public function actionFormCreateNews() { 
    	$this->renderPartial("formCreateNews"); 		
    } 
  	public function actionNewsstream() { 
  		$this->renderPartial("newsstream"); 		
  	} 
  	public function actionIndex() { 
  		
        $where = array("created"=>array('$exists'=>1) ) ;
		$news = News::getWhere( $where );

  		$this->render( "index" , array( "news"=>$news, "userCP"=>Yii::app()->session['userCP'] ) ); 		
  	} 
  	
  	
	
	//******************************************************************************
	//** NEWSSTREAM HTML
	//******************************************************************************
	public function actionGetNewsStream() //return News for news-stream
	{
		//$_POST['myPosition']
		$news = PHDB::find("articles", $where);
		//$news["origine"] = "ShowMyNetwork";
	
		$html = $this->getNewsStreamHtml($news);
		Rest::json( $html );
		Yii::app()->end();
	}

  	
  	//******************************************************************************
	//envoie la liste des contacts de l'utilisateur connecté
  	//(stoké dans variable -dataContact- js)
  	//******************************************************************************	
  	public function actionInitDataContact(){
  		$json_res = array();
  		
  		$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$user = PHDB::find(PHType::TYPE_CITOYEN, $where);
    	$me = $user[Yii::app()->session["userId"]];
	 	$res = "";
	 	
    	// foreach($user as $me)
    	if(isset($me["memberOf"])) {
    	  	$json_res["organizations"] = array();
	 		foreach($me["memberOf"] as $organization){
    	 		//récupère les data de l'organisation
    	 		$where = array(	'_id'  => $organization );
	 			$orga = PHDB::find("organizations", $where);
	 			
	 			foreach($orga as $ORGA){
    	 			$json_res["organizations"][] = $ORGA;
	 			}
    		}
    	
    	//si l'utilisateur n'a pas de champ "memberOf" => initialise le champ (pour les test)	
    	} else { $this->initMemberOf(); $res .= " - init MemberOf"; }
    	
    	if(isset($me["knows"])) {	
    		$json_res["knows"] = array();
	 		foreach($me["knows"] as $group){
	 		
	 			$members = array();
				foreach($group["members"] as $memberId){
	 		
	 				//récupère les data de chaque membre du groupe
					$where = array(	'_id'  => $memberId );
					$contact = PHDB::find(PHType::TYPE_CITOYEN, $where);
					
					foreach($contact as $c){
						if(isset($c["name"])) //{ Rest::json( "pas de name" ); Yii::app()->end(); }
						$members[] = array( "id" 	=> $c["_id"],
											"name" 	=> $c["name"]
										  );
						
					}
	 			}
	 			$json_res["knows"][] = array("type" => $group["type"],
	 							 			"name" => $group["name"],
	 							 			"members" => $members);
	 		}
    							 			
    	 	Rest::json( $json_res );
			Yii::app()->end();
			
        //si l'utilisateur n'a pas de champ "knows" => initialise le champ (pour les test)	
    	} else { $this->initKnows(); $res .= " - init Knows"; }
        
        
		Rest::json( $res );
		Yii::app()->end();
  	}
  	private function initMemberOf(){
  		
  		$org = PHDB::find("organizations");
  		if($org == null){ 
  			Yii::app()->mongodb->organizations->insert(array('name' => "Organisation n°1"));
  			Yii::app()->mongodb->organizations->insert(array('name' => "Organisation n°2"));
  			Yii::app()->mongodb->organizations->insert(array('name' => "Organisation n°3"));
  		}
  		
  		$members = array();
	 	
	 	//rajouter chaque user dans chaque groupe
	 	$organisations = iterator_to_array(Yii::app()->mongodb->selectCollection("organizations")->find()->limit(3));
	 	foreach($organisations as $orga){  $members[] = $orga["_id"]; }
	 	
	 	//$users = PHDB::find(PHType::TYPE_CITOYEN, $where).limit(5);
	 	$me = array( "memberOf" => $members );

	 	$where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
        Yii::app()->mongodb->citoyens->update($where, array('$set' => $me));
                
	 //	Rest::json( $me );
	//	Yii::app()->end();
  	}
	private function initKnows(){
	
		$famille = array(); $amis = array(); $all = array();
	 	
	 	//rajouter chaque user dans chaque groupe
	 	$users = iterator_to_array(Yii::app()->mongodb->selectCollection(PHType::TYPE_CITOYEN)->find()->skip(25)->limit(5));
	 	foreach($users as $user){  $famille[] = $user["_id"]; }
	 	$users = iterator_to_array(Yii::app()->mongodb->selectCollection(PHType::TYPE_CITOYEN)->find()->skip(30)->limit(5));
	 	foreach($users as $user){  $amis[] = $user["_id"];  }
	 	$users = iterator_to_array(Yii::app()->mongodb->selectCollection(PHType::TYPE_CITOYEN)->find()->skip(35)->limit(5));
	 	foreach($users as $user){  $all[] = $user["_id"];  }
	 	
	 	//$users = PHDB::find(PHType::TYPE_CITOYEN, $where).limit(5);
	 	$me = array("knows" => array(array("type" => "group", "name" => "*", "members" => $all),
	 								 array("type" => "group", "name" => "Famille", "members" => $famille),
	 								 array("type" => "group", "name" => "Amis", "members" => $amis)
	 								)
	 				);

	 	$where = array("_id" => new MongoId(Yii::app()->session["userId"]));  
        Yii::app()->mongodb->citoyens->update($where, array('$set' => $me));
                
	 	//Rest::json( $me );
		//Yii::app()->end();
  	}

	//******************************************************************************
	//** SAVE NEWS
	//******************************************************************************	
	public function actionSave() {
	    return Rest::json( News::save($_POST) );
	}
	
	//******************************************************************************
	//** IMPORT DATA (NEWS)
	//******************************************************************************	
	public function actionImportData()
	{
		//charge le fichier json en memoire
		$fp = fopen ("../".$this->module->assetsUrl."/data/news.json", "r");  	
		$contenu_du_fichier = fread ($fp, filesize("../".$this->module->assetsUrl."/data/news.json")); //charge le contenu du fichier
		fclose ($fp);
				
		//transforme le flux en structure json   
		$json = json_decode ($contenu_du_fichier); 
		$result = " loading news.json ok<br/>";
		
		
		foreach($json as $news) {
			$news->author = new MongoId(Yii::app()->session["userId"]);
		 	$result .= "</br> insert news Ok";
			PHDB::insert( "news", $news ); 
		}
		
		Rest::json( $result );
        Yii::app()->end();        
	}
	
}


