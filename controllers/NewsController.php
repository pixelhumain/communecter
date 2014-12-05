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

    public function actionFormCreateNews()  { $this->renderPartial("formCreateNews"); 		} 
  	public function actionNewsstream()  	{ $this->renderPartial("newsstream"); 		} 
  	
  	
	
	//******************************************************************************
	//** NEWSSTREAM HTML
	//******************************************************************************
	public function actionGetNewsStream() //return News for news-stream
	{
		//$_POST['myPosition']
		$where = array();
					
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
	public function actionSaveNews(){
		
		$json_news = json_decode($_POST["json"]);
		$news = array("name" => $json_news->name,
					  "text" => $json_news->text,
					  "genre" => $json_news->genre,
					  "about" => $json_news->about,
					  "author" => new MongoId(Yii::app()->session["userId"]));
	 //Rest::json( array("msg" => "every thing all right" ) );
		//Rest::json( $news );
		//Yii::app()->end();
		
		//recupere les donnes de l'utilisateur
		$where = array(	'_id'  => new MongoId(Yii::app()->session["userId"]) );
	 	$user = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 	$user = $user[Yii::app()->session["userId"]];
	 			
		foreach($json_news->scope as $scope){
			
			//dans le cas d'un groupe
			//ajoute un à un chaque membre du groupe demandé (=> contact)
			if($scope->scopeType == "groupe"){				 
	 			//pour chacun de ses groupes de contact
    			foreach($user["knows"] as $groupe){
    				//pour chaque membre du groupe demandé
    				if($groupe["name"] == $scope->id)
    				foreach($groupe["members"] as $contact){
    					//recupere les donnes du contact
						$where = array(	'_id'  => $contact );
	 					$allContact = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 					$allContact = $allContact[$contact->__toString()];
	 					//ajoute un scope de type "contact" dans la news
						$news["scope"][] = array("scopeType" => "contact",
					  						 	"at" => "@".$allContact["name"],
					  						 	"id" => $contact);
					}	
				}
			}
			//cas de tous les contact
			else if($scope->id == "all_contact" && $scope->scopeType == "contact"){
				//pour chacun de ses groupes de contact
    			foreach($user["knows"] as $groupe){
    				//pour chaque membre d'un groupe
    				foreach($groupe["members"] as $contact){
    					//recupere les donnes du contact
						$where = array(	'_id'  => $contact );
	 					$allContact = PHDB::find(PHType::TYPE_CITOYEN, $where);
	 					$allContact = $allContact[$contact->__toString()];
	 					//if(!isset($allContact["name"])) {Rest::json( "pas de name" ); Yii::app()->end(); }
	 					//ajoute un scope de type "contact" dans la news
						if(isset($allContact["name"]))
						$news["scope"][] = array("scopeType" => "contact",
					  						 	"at" => "@".$allContact["name"],
					  						 	"id" => $contact);
						
					}
					
				}	
			}
			//cas de toutes les organisations
			else if($scope->id == "all_organisation" && $scope->scopeType == "organisation"){
				//pour chacun de ses organisations
    			foreach($user["memberOf"] as $organization){
    					//recupere les donnes de l'organisation
						$where = array(	'_id'  => $organization );
	 					$allOrga = PHDB::find("organizations", $where);
	 					$allOrga = $allOrga[$organization->__toString()];
	 					//ajoute un scope de type "organisation" dans la news
						$news["scope"][] = array("scopeType" => $scope->scopeType,
					  						 	"at" => "@".$allOrga["name"],
					  						 	"id" => $organization);
					}	
			}
			//par défaut ajoute le scope telquel
			else{
				$news["scope"][] = $scope;
			}
		}
		
						
		Yii::app()->mongodb->articles->insert($news);
        
        //Rest::json( array("msg" => "every thing all right" ) );
		Rest::json( $news );
		Yii::app()->end();            
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
	
	
	//******************************************************************************
	//** GET NEWS STREAM HTML (transforme une liste de ARTICLES en format html)
	//** $newsList == Mongo.Articles
	//******************************************************************************	
	private function getNewsStreamHtml($newsList){
		
		//return $this->renderPartial("newsstream");
		
		$html = '<div class="spine"></div><ul class="columns">'; $count=0;
		foreach($newsList as $post){
		
		//récupère les infos sur l'auteur du post / News
		$where = array('_id' => $post['author'] );
		$author = PHDB::findOne(PHType::TYPE_CITOYEN, $where);
    	$color = "white";
    		
		$color = NEWS::get_GENRE_COLOR($post['genre']);
    	
    	//$html .=  "<div class='post'>";
		$html .=  "<li>".
					'<div class="timeline_element partition-white">';
		
			$html .=  "<div class='info_author_post'>";
								
				//PHOTO PROFIL
				$html .= "<div class='pic_profil_author_post'>".
						 "<img class='img_profil_round'  src='".Yii::app()->theme->baseUrl."/assets/images/avatar-1.jpg' height=55>".
						 "</div>";
			
				//ICO TYPE ACCOUNT
				$html .= "<div class='ico_type_account_author_post'>".
						 //"<img src='application/pictures/account_type/User-M_24_B.png' height=30>".
						 "</div>";
			
				//PSEUDO AUTHOR
				if(isset($author['name']))
				$html .= "<a href='' class='pseudo_author_post'>".
							$author['name'].
						 "</a>";
	
				//CITY AUTHOR
				if(isset($author['cp']))
				$html .= "<a href class='city_author_post'>- ".
							$author['cp'].
						 "</a>";
	
			$html .= "</div>"; //info_author_post
			
	
			$html .=  "<div class='header_post ".$color."'>";
			
				//IL Y A
				$html .= 	"<div class='ilya' style='float:left; max-width:100%; min-width:100%;'>".
								"<center><i class='fa fa-clock-o'></i>".
								"</br>il y a 18 minutes<center>".
							"</div>";
		
				//ILLUSTRATION POST 
				//if(isset($post['id_illustration']))
				if($count == 0)
				$html .= 	"<div style='float:left; max-width:100%; min-width:100%;'>".
								"<center><img src='".$this->module->assetsUrl."/images/news/test_illu/illu_test.jpg' class='illustration_post'/></center>".
							"</div>";
				$count++;
			$html .= "</div>";
		
			
			//GENRE
			$html .= "<div class='nature_post'>".
					 "<img src='".$this->module->assetsUrl."/images/news/natures/".$post['genre'].".png' class='img_illu_publication_nature' style='margin-top:0px;' title='nature du message : ".News::get_NATURES_NAMES($post['genre'])."' id='".$post['genre']."' height=50>".
					 "</div>";
				 
			//FAVORITES
			$html .= "<a href='' class='btn_circle_post' id='btn_circle_favorites' style='margin-left:12px; color:#23D1B9'>".
					 "<i class='fa fa-star' title='garder en favoris'></i>".
					 "</a>";
	
			//ARLERT MODERATION
			$html .= "<a href='' class='btn_circle_post' id='btn_circle_moderation' style='color:#E66B6B'>".
					 "<i class='fa fa-bell' title='signaler le contenu'></i>".
					 "</a>";
					 
								 
			//LIST THEMES	
			$html .= "<div class='list_themes_post'>";
			if(isset($post['about'])){
				foreach($post['about'] as $theme){
					$html .= "<div class='theme_post'>".
								"<img src='".$this->module->assetsUrl."/images/news/themes/".$theme.".png' class='img_illu_publication_theme' title='thème : ".News::get_THEMES_NAMES($theme)."' id='".$theme."' style='margin-top:0px;' height=30>".
							 "</div>";
				}
			}
			$html .= "</div>";
			
			$html .= "<div class='panel-title' style='float:left; min-width:100%;'>".
						"<h4 style='font-size:15px; margin:0px; margin-left:10px; padding:0px;'><b>".News::get_NATURES_NAMES($post['genre'])."</b></h4>".
					"</div>";
		
			
			//TITLE
			if(isset($post['name']))
			$html .= "<div class='panel-title' style='float:left; min-width:100%;'>".
						"<h3 style='font-size:18px; margin:0px; margin-left:10px; padding:0px;'>".$post['name']."</h3>".
					"</div>";
		
			//CONTENT
			if(isset($post['text']))
			$html .= "<div class='panel-body' style='float:left;  margin-bottom:10px;'><p>".$post['text']."</p></div>";
		
			//BAR TOOL
			$html .= "<div class='bar_tools_post'>".
				"<ul>	
						<li><a href=''>j'aime</a></li>
						<li><a href=''>partager</a></li>						
				</ul>".
				"<ul style='float:left;'>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-comment'></i></span></li>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-thumbs-up'></i></span></li>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-share-alt'></i></span></li>".
						"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-eye'></i></span></li>".
				
				"</ul>".
				"</div>";
					
		//$html .= "</div>"; //post
		$html .= "</li>"; //post
		
		}	
		
		$html.='</ul>';
		
		return $html;
	}
	
	
}


