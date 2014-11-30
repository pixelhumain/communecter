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
	
		public function actionGetNewsNetwork() //return News for news-stream
		{
			//récupère uniquement les News dont l'auteur se trouve dans la zone que je suis en train de visualiser
			$whereGeo = $this->getGeoQuery($_POST, 'from');
	    	
	    	//récupère uniquement les News dont la zone de publication inclue ma position				  
			$where = array(	'scope.scopeType'  => "geoArea",
    				 	'scope.geoArea.latMinScope' => array('$lt' => floatval($_POST['myPosition'][0])),
 						'scope.geoArea.lngMinScope' => array('$lt' => floatval($_POST['myPosition'][1])),
 						'scope.geoArea.latMaxScope' => array('$gt' => floatval($_POST['myPosition'][0])),
 						'scope.geoArea.lngMaxScope' => array('$gt' => floatval($_POST['myPosition'][1]))
					  );
			//join les deux parties de la requette
			$where = array_merge($where, $whereGeo);
			$where = array();
						
			$news = PHDB::find("articles", $where);
			//$news["origine"] = "ShowMyNetwork";
		
			$html = $this->getNewsStreamHtml($news);
			Rest::json( $html );
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
	    				
    	$companies = PHDB::find(PHType::TYPE_GROUPS, $where);
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
	    				
    	$states = PHDB::find(PHType::TYPE_GROUPS, $where);
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
	//** NEWSSTREAM HTML
	//******************************************************************************
	
	
	//transforme une liste de News en format html
	private function getNewsStreamHtml($newsList){
		
		//return $this->renderPartial("newsstream");
		
		$html = '<div class="spine"></div><ul class="columns">'; $count=0;
		foreach($newsList as $post){
		
		/*
		$html .=	'<li>'.
					'<div class="timeline_element partition-red">'
						<div class="timeline_date">
							<div>
								<div class="inline-block">
									<span class="day text-bold">12</span>
								</div>
								<div class="inline-block">
									<span class="block week-day text-extra-large">Wensdey</span>
									<span class="block month text-large text-light">november 2014</span>
								</div>
							</div>
						</div>
						<div class="timeline_title">
							<i class="fa fa-check-circle-o fa-2x pull-left fa-border"></i>
							<h4 class="light-text no-margin padding-5">Test Solution</h4>
						</div>
						<div class="timeline_content"></div>
						<div class="readmore">
							<a href="#" class="btn btn-transparent-white">
								Read More <i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div>
				</li>			
		*/
		
		
		
		//récupère les infos sur l'auteur du post / News
		$where = array('_id' => $post['author'] );
		$author = PHDB::findOne(PHType::TYPE_CITOYEN, $where);
    	$color = "white";
    	
    	$natures = array( 	"free_msg" 			=> "white", 
							"help" 				=> "red", 
							"idea" 				=> "yellow", 
							"question" 			=> "purple", 
							"rumor" 			=> "orange", 
							"true_information" 	=> "green" );
		
		$color = $natures[$post['genre']];
		// 							
//     	if($post['nature'] == "free_msg") $color="red";
//     	if($post['nature'] == "") $color="red";
//     	if($post['nature'] == "") $color="red";
//     	if($post['nature'] == "") $color="red";
//     	if($post['nature'] == "") $color="red";
//     	if($post['nature'] == "") $color="red";
    	
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


