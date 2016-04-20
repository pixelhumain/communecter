<?php

$cssAnsScriptFilesModule = array(
	'/plugins/mixitup/src/jquery.mixitup.js' 
);

HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>
<!-- start: PAGE CONTENT -->
<style type="text/css">
	
	.panel-tools{
		filter: alpha(opacity=1);
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
		-moz-opacity: 1;
		-khtml-opacity: 1;
		opacity: 1;
	}

	.mix{ 
		min-height: 100px;
		/*width: 31.5%;*/
		background-color: white;
		display: inline-block;
		border:1px solid #bbb;
		margin-right : 1.5%;
		border-radius: 10px;
		padding:1%;
		margin:-1px;
		-webkit-box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
		-moz-box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
		box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
	}
	#grid .followers{
	display: none;
}
	.mix a{
		color:black;
		/*font-weight: bold;*/
	}
	.mix .imgDiv{
		float:left;
		width:30%;
		background: ;
		margin-top:0px;
	}
	.mix .detailDiv{
		float:right;
		width:70%;
		margin-top:0px;
		padding-left:10px;
		text-align: left;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
	}

	.mix .toolsDiv{
		float:right;
		width:20%;
		margin-top:0px;
		padding-left:10px;
		text-align: left;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		color:white;
	}
	
	.mix .text-xss{ font-size: 11px; }


	#btn-close-panell {
	    position: absolute;
	    right: 25px;
	    top: 20px;
	    font-size: 20px;
	}

	#Grid{
		margin-top: 20px;
		background-color: transparent;
		padding: 15px;
		border-radius: 4px;
		/*border-right: 1px solid #474747;*/
		padding: 0px;
		width:100%;
	}
	#Grid .mix{
		margin-bottom: -1px !important;
	}
	#Grid .item_map_list{
		padding:10px 10px 10px 0px !important; 
		margin-top:0px;
		text-decoration:none;
		background-color:white;
		border: 1px solid rgba(0, 0, 0, 0.08); /*rgba(93, 93, 93, 0.15);*/
	}
	#Grid .item_map_list .left-col .thumbnail-profil{
		width: 75px;
		height: 75px;
	}
	#Grid .ico-type-account i.fa{
		margin-left:11px !important;
	}
	#Grid .thumbnail-profil{
		margin-left:10px;
	}
	#Grid .detailDiv a.text-xss{
		font-size: 12px;
		font-weight: 300;
	}
	.marginbot{
		display: inline-block;
		margin-bottom: -1px;
		font-weight: 500;
		padding: 6px 7px;
		float: left;
		margin-right: -1px;
		border-radius: 0px;

	}
	.tagblock{
		width: 100%;
		max-width: 100%;
		padding: 5px;
		/*float: left;*/
		text-align: left;
		max-height: 28px;
		height: 28px;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		position: absolute;
		top: -2px;
		left: 9px;
	}
	.label.address.text-dark{
		padding:0.4em 0.1em 0.4em 0em !important;
	}
	.detailDiv a.thumb-info.item_map_list_panel{
		font-weight:500 !important;
	}
	.container_menu_directory{
		margin-right: -2px;
	}
	.menu_directory{
		background-color: transparent;
	    /*margin-right: 20px;*/
		margin-bottom: 20px;
	}
	.menu_directory li{
		/*width:100%;*/
		margin-left:2px;
	}
	.menu_directory li a{
		font-size: 13px;
		font-weight: 600;
		margin-bottom: 1px;
		margin-left: -2px;
		padding: 12px 12px 9px 12px;
		border-radius: 0px !important;
		box-shadow: 1px 1px 5px -2px #000;
		-moz-box-shadow: 1px 1px 5px -2px #000;
		-webkit-box-shadow: 1px 1px 5px -2px #000;
		-o-box-shadow: 1px 1px 5px -2px #000;
		box-shadow: 1px 1px 5px -2px #000;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#D1C5C5, Direction=NaN, Strength=3);
	}
	.menu_directory .badge{
		color: #315C6E !important;
		background-color: #E9E9E9 !important;
		
	}
	
	
	.menu_directory .filter.active a.text-dark{
		color:#3C5665 !important;
	}
	.menu_directory .filter.active .badge {
		/*background-color: #FFF !important;
		color: #315C6E !important;*/
	}
	.menu_directory i.fa{
		/*width:20px;*/
	}

	/*.detailDiv .scopes {
	    display: inline-block;
	    float: left;
	    padding-left: 10px;
	    text-align: left;
	}*/

	#tagsFilter{
		font-weight: 300;
		border-radius: 0px;
		padding: 3px 7px;
	}

	#tagFilters h4, #scopeFilters h4, #orgaTypesFilters h4{
		text-align: left;
		/*text-weight:;*/
	}
	#tagFilters i.fa, #scopeFilters i.fa, #orgaTypesFilters i.fa {
		width:auto !important;
	}

	#scopeFilters a{
		/*float:right;*/
	}
	#scopeFilters h4{
		/*text-align:right;*/
	}
	.panelLabel{
		margin-bottom:10px;
		margin-left:25px;
		color:#58879B;
		font-size:25px
	}
	.bg-light-red{
		color:white !important;
		background-color: #e25555 !important;
	}
	.active .bg-yellow, .active .bg-green, .active .bg-orange, 
	.active .bg-purple, .active .bg-dark, .active .bg-red, .active .bg-light-red{
		border-bottom: 3px solid rgba(96, 96, 96, 0.65);
	}

	.startDateEvent, .endDateEvent{
		display: block;
		line-height: 17px;
	}
	

	.container_menu_directory .bg-red, 
	.container_menu_directory .bg-dark, 
	.container_menu_directory .bg-yellow, 
	.container_menu_directory .bg-green, 
	.container_menu_directory .bg-orange, 
	.container_menu_directory .bg-purple{
	.container_menu_directory .bg-light-red{
		padding-top:10px;
		border-bottom: 3px solid transparent;
	}

	.bg-red:hover, .bg-dark:hover, .bg-yellow:hover, .bg-green:hover, .bg-orange:hover, .bg-purple:hover, .bg-light-red:hover{
		border-bottom: 3px solid rgba(255, 255, 255, 0.8);
	}
</style>

<?php 

/*
$this->renderPartial('../default/panels/toolbar',array("toolbarStyle"=>"width:50px")); */
$contextName = "";
$contextIcon = "bookmark fa-rotate-270";
$contextTitle = "";
$parentId="";
$parentType="";
$manage="";
if( isset($type) && $type == Organization::CONTROLLER && isset($organization) ){
	Menu::organization( $organization );
	$thisOrga = Organization::getById($organization["_id"]);
	$contextName = Yii::t("common","Organization")." : ".$thisOrga["name"];
	$contextIcon = "users";
	$contextTitle = Yii::t("common","Community of organization");
	if (isset($organization["_id"]) && isset(Yii::app()->session["userId"])
			 && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organization["_id"])) { 
		if(!isset($organization["disabled"]))
			$manage=1;
	}
	$parentName=$organization["name"];
	$parentId=$organization["_id"];
	$parentType=Organization::COLLECTION;
	$connectType="members";
	$contextData = $thisOrga;
	$projects=array();
}
else if( isset($type) && $type == City::CONTROLLER && isset($city) ){
	Menu::city( $city );
	$contextName = Yii::t("common","City")." : ".$city["name"];
	$contextIcon = "university";
	$contextTitle = Yii::t("common", "DIRECTORY Local network of")." ".$city["name"];
}
else if( isset($type) && $type == Person::CONTROLLER && isset($person) ){
	Menu::person( $person );
	$contextName = Yii::t("common","Person")." : ".$person["name"];
	$contextIcon = "user";
	$contextTitle =  Yii::t("common", "DIRECTORY of")." ".$person["name"];
	$connectType="network";
	$contextData = $person;
	$parentType=Person::COLLECTION;
}
else if( isset($type) && $type == PROJECT::CONTROLLER && isset($project) ){
	//Menu::project( $person );
	$contextName = Yii::t("common","Project")." : ".$project["name"];
	$contextIcon = "lightbulb-o";
	$contextTitle = Yii::t("common", "Community of project");//." ".$project["name"];
	if(isset($project["_id"]) && isset(Yii::app()->session["userId"])
			 && Authorisation::isProjectAdmin($project["_id"], Yii::app()->session["userId"]) == 1){
		$manage=1;
	}
	$parentName=$project["name"];
	$parentId=$project["_id"];
	$parentType=Project::COLLECTION;
	$connectType="contributors";
	$contextData = $project;
	$projects=array();
	$events=array();
}
/*else
	$this->toolbarMBZ = array(
	    array( 'tooltip' => "Add a Person, Organization, Event or Project", "iconClass"=>"fa fa-plus" , "iconSize"=>"" ,"href"=>"<a class='tooltips btn btn-default' href='#' onclick='showPanel(\"box-add\",null,\"ADD SOMETHING TO MY NETWORK\")' ")
	);*/
$this->renderPartial('../default/panels/toolbar'); 

$countPeople = 0; $countOrga = 0; $countProject = 0; $countEvent = 0; $countFollowers = 0; $followsProject = 0; $followsPeople = 0 ; $followsOrga = 0;

foreach ($people as $key => $onePeople) { if(isset($onePeople["name"])) $countPeople++;}
foreach ($organizations as $key => $orga) { if(isset($orga["name"])) $countOrga++;	}
foreach ($projects as $key => $project) { if(isset($project["name"])) $countProject++;	}
foreach ($events as $key => $event) { if(isset($event["name"])) $countEvent++;	}
if (isset($followers)){
	foreach ($followers as $key => $follower) { if(isset($follower["name"])) $countFollowers++;}
}
if (isset($follows)){
	if(isset($follows[Person::COLLECTION])){ 
		foreach ($follows[Person::COLLECTION] as $e) {
			$followsPeople++;
			$countPeople++;
		}
	}
	if(isset($follows[Organization::COLLECTION])){ 
		foreach ($follows[Organization::COLLECTION] as $e) {
			$followsOrga++;
			$countOrga++;
		}
	}
	if(isset($follows[Project::COLLECTION])){ 
		foreach ($follows[Project::COLLECTION] as $e) {
			$followsProject++;
			$countProject++;
		}
	}

}
?>
<div class="row pull-left">
	<div class="col-md-12">
		<div class="panel panel-transparent">
			<div class="panel-body">
				<!-- <div class="col-md-12">
					Details proprietaire directory
				</div> -->
				
				<span class="homestead panelLabel pull-left"> 
					<i class="fa fa-bookmark fa-rotate-270"></i> 
					<?php echo $contextTitle; ?>
				</span>
				
				<div class="col-md-12 col-sm-12 col-xs-12 row">
					<ul class="nav nav-pills menu_directory container_menu_directory controls list-unstyled">
						<li class="filter active" data-filter="all">
							<a href="javascript:;" class="bg-dark" onclick="$('.optionFilter').hide();<?php if(($followsProject+$followsOrga) > 0){ ?>$('.labelFollows').show();<?php }else{ ?>$('.labelFollows').hide();<?php } ?>">
								<i class="fa fa-th-list"></i> <?php echo Yii::t("common","All") ?> 
								<span class="badge"><?php echo $countPeople + $countOrga + $countEvent + $countProject;  ?>
							</a>
						</li>
						<?php if($countPeople > 0){  ?>
						<li class="filter" data-filter=".citoyens">
							<a href="javascript:;" class="filtercitoyens bg-yellow" onclick="$('.optionFilter').hide();$('.labelFollows').hide();">
								<i class="fa fa-user fa-2"></i> <span class=" hidden-xs hidden-md hidden-sm"><?php echo Yii::t("common", "People"); ?></span> 
								<span class="badge"><?php echo $countPeople;  ?></span>
							</a>
						</li>
						<?php } ?>
						<?php if(count($organizations) > 0){  ?>
						<li class="filter" data-filter=".organizations">
							<a href="javascript:;" onclick="showFilters('#orgaTypesFilters', true)" class="filterorganizations bg-green">
								<i class="fa fa-users fa-2"></i> <span class="hidden-xs hidden-md hidden-sm"><?php echo Yii::t("common","Organizations") ?></span> 
								<span class="badge"><?php echo $countOrga;  ?></span>
							</a>
						</li>
						<?php } ?>
						<?php if(count($events) > 0){  ?>
						<li class="filter" data-filter=".events">
							<a href="javascript:"  class="filterevents bg-orange" onclick="$('.optionFilter').hide();$('.labelFollows').hide();">
								<i class="fa fa-calendar fa-2"></i> <span class="hidden-xs hidden-md hidden-sm"><?php echo Yii::t("common","Events") ?></span> 
								<span class="badge bg"><?php echo $countEvent;  ?></span>
							</a>
						</li>
						<?php } ?>
						<?php if(count($projects) > 0){  ?>
						<li class="filter" data-filter=".projects">
							<a href="javascript:;" class="filterprojects bg-purple" onclick="$('.optionFilter').hide();<?php if($followsProject > 0){ ?>$('.labelFollows').show();<?php }else{ ?>$('.labelFollows').hide();<?php } ?>"> 
								<i class="fa fa-lightbulb-o fa-2"></i> <span class="hidden-xs hidden-md hidden-sm"><?php echo Yii::t("common","Projects") ?></span> 
								<span class="badge bg"><?php echo $countProject;  ?></span>
							</a>
						</li>
						<?php } ?>
						<?php if($countFollowers > 0){  ?>
						<li class="filter" data-filter=".followers">
							<a href="javascript:;" class="filterfollowers bg-light-red" onclick="$('.optionFilter').hide();$('.labelFollows').hide()"> 
								<i class="fa fa-heart fa-2"></i> <span class="hidden"><?php echo Yii::t("common","Followers") ?></span> 
								<span class="badge bg"><?php echo $countFollowers;  ?></span>
							</a>
						</li>
						<?php } ?>
						<li  class="" style="margin-left:30px;">
							<a href="javascript:;" class="bg-red" onclick="toggleFilters('#tagFilters')"><i class="fa fa-tags  fa-2"></i> <span class="hidden"><?php echo Yii::t("common","Tags"); ?></span></a>
						</li>
						<li class="" style="margin-right:0px;">
							<a href="javascript:;" class="bg-red" onclick="toggleFilters('#scopeFilters')"><i class="fa fa-circle-o  fa-2"></i> <span class="hidden"><?php echo Yii::t("common","Places"); ?></span></a>
						</li>
						
						
					</ul>
				</div>
				<div class="col-md-12 pull-right">
					<div id="tagFilters" class="optionFilter  pull-left center" style="display:none;width:100%;" ></div>
					<div id="scopeFilters" class="optionFilter  pull-left center" style="display:none;width:100%;" ></div>
					<div id="orgaTypesFilters" class="optionFilter  pull-left center" style="display:none;width:100%;text-align:center;" >
						<h4 class='text-dark'><i class='fa fa-angle-down'></i> <?php echo Yii::t("common","Organizations types") ?></h4>
						<a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".NGO"><span><?php echo Yii::t("common","NGO") ?></span></a>
						<a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".LocalBusiness"><?php echo Yii::t("common","Local Business") ?></a>
						<a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".Group"><?php echo Yii::t("common","Group") ?></a>
						<a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".GovernmentOrganization"><?php echo Yii::t("common","Government Organization") ?></a>
					</div>
				</div>
				<ul id="Grid" class="pull-left  list-unstyled">
					<?php	if (@$manage){ ?> 
						<input type="hidden" id="parentType" value="<?php echo $parentType ?>"/>
						<input type="hidden" id="parentId" value="<?php echo $parentId ?>"/>
						<input type="hidden" id="connectType" value="<?php echo $connectType ?>"/>
					<?php } ?>
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;
					$tags = array();
					$tagsHTMLFull = "";
					$scopes = array(
						"codeInsee"=>array(),
						"postalCode"=>array(),
						"region"=>array(),
						"addressLocality"=>array(),
					);
					$scopesHTMLFull = "";
					/*if ($parentType==Person::COLLECTION){ 
						<div class="col-md-12 col-sm-12 col-xs-12 row">
							<span class="homestead panelLabel pull-left labelCommunity"> 
							<?php echo ucfirst(Yii::t("common",$connectType)) 
							</span>
						</div> 
					 */
					/* ************ ORGANIZATIONS ********************** */
					if(isset($organizations)) 
					{ 
						foreach ($organizations as $e) 
						{ 	
							buildDirectoryLine($e, Organization::COLLECTION, Organization::CONTROLLER, Organization::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage);
						};
					}

					/* ********** PEOPLE ****************** */
					if(isset($people)) 
					{ 
						foreach ($people as $e) 
						{
							buildDirectoryLine($e, Person::COLLECTION, Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage,$parentType,$parentId);
						}
					}

					/* ************ EVENTS ************************ */
					if(isset($events)) 
					{ 
						foreach ($events as $e) 
						{ 
							buildDirectoryLine($e, Event::COLLECTION, Event::CONTROLLER, Event::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage=null);
						}
					}
	
					/* ************ PROJECTS **************** */
					if( count($projects) ) 
					{ 
						foreach ($projects as $e) 
						{ 
							buildDirectoryLine($e, Project::COLLECTION, Project::CONTROLLER, Project::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage=null);
						}
					}
					function dateToStr($date, $lang, $inline){
						//echo $date;
						$year 	= substr($date, 0, 4);
						$month 	= substr($date, 5, 2);//getMonthStr(date.substr(5, 2), lang);
						$day 	= substr($date, 8, 2);
						$hours 	= substr($date, 11, 2);
						$minutes = substr($date, 14, 2);
						
						$str = $day . "/" . $month . "/" . $year;
						if(!$inline) $str .= "</br>";
						else $str .= " - ";
						$str .= $hours . "h" . $minutes;
						//echo "[[".$str."]]";
						return $str;
					}
					if(isset($follows[Person::COLLECTION])) 
						{ 
							foreach ($follows[Person::COLLECTION] as $e) 
							{
								buildDirectoryLine($e, Person::COLLECTION, Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage,$parentType,$parentId);
							}
					}	
					///// SHOW FOLLOWERS !!!!!
					if(isset($followers)){
						/*echo '<li id="" class="item_map_list col-lg-3  col-md-4 col-sm-6 col-xs-6 mix citoyensLine citoyens" data-cat="1" style="border: inset 1px white;display: inline-block;">'.
							'<div style="position:relative;">'.
										'<div class="portfolio-item" style="line-height: 75px;color: #e25555 !important;font-variant: small-caps;font-size: large;"> '.
										'<span><i class="fa fa-plus" style="float: inherit;"></i> '.$countFollowers.' '.Yii::t("common","followers").'</span>'.
								'</div></div></li>';*/
						foreach ($followers as $e) 
							{
								buildDirectoryLine($e, "followers", Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,false);
							}
						}
					///// SHOW FOLLOWS
					if (isset($follows) && ($followsProject+$followsOrga) > 0){ ?>
						<div class="col-md-12 col-sm-12 col-xs-12 row" style="margin-top:20px;">
							<span class="homestead panelLabel pull-left labelCommunity labelFollows"> 
							<?php echo ucfirst(Yii::t("common","follows")) ?>
							</span>
						</div>

					<?php 
						if(isset($follows[Organization::COLLECTION])) 
						{ 
							foreach ($follows[Organization::COLLECTION] as $e) 
							{ 	
								buildDirectoryLine($e, Organization::COLLECTION, Organization::CONTROLLER, Organization::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage);
							};
						}
	
						/* ********** PEOPLE ****************** */
						/* Intégrer au réseau en attendant un lien plus fort
							if(isset($follows[Person::COLLECTION])) 
						{ 
							foreach ($follows[Person::COLLECTION] as $e) 
							{
								buildDirectoryLine($e, Person::COLLECTION, Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage,$parentType,$parentId);
							}
						}	*/
						if(isset($follows[Project::COLLECTION])) 
						{ 
							foreach ($follows[Project::COLLECTION] as $e) 
							{ 
								buildDirectoryLine($e, Project::COLLECTION, Project::CONTROLLER, Project::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,$manage=null);
							}
						}
					} 
					
					
					function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes, &$tagsHTMLFull,&$scopesHTMLFull,$manage,$parentType=null,$parentId=null)
					{
						if((!isset( $e['_id'] ) && !isset($e["id"]) )|| !isset( $e["name"]) || $e["name"] == "" )
							return;
						$actions = "";
						if(@$e['_id'])
							$id = $e["_id"];
						else
							$id = $e["id"];

						/* **************************************
						* TYPE + ICON
						***************************************** */
						$img = '';//'<i class="fa '.$icon.' fa-3x"></i> ';
						if ($e && !empty($e["profilThumbImageUrl"])){ 
							$img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/'.$e['profilThumbImageUrl']).'">';
						}else{
							if(!empty($e["profilImageUrl"]))
								$img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/communecter/document/resized/50x50'.$e['profilImageUrl']).'">';
							else
							$img = "<div class='thumbnail-profil'></div>";
						}
						
						/* **************************************
						* TAGS FILTER
						***************************************** */							
						$tagsClasses = "";
						if(isset($e["tags"])){
							foreach ($e["tags"] as $key => $value) {
								$tagsClasses .= ' '.preg_replace("/[^A-Za-z0-9]/", "", $value) ;
							}
						}

						/* **************************************
						* SCOPES FILTER
						***************************************** */
						$scopesClasses = "";
						if( isset($e["address"]) && isset( $e["address"]['codeInsee']) )
							$scopesClasses .= ' '.$e["address"]['codeInsee'];
						if( isset($e["address"]) && isset( $e["address"]['postalCode']) )
							$scopesClasses .= ' '.$e["address"]['postalCode'];
						if( isset($e["address"]) && isset( $e["address"]['region']) )
							$scopesClasses .= ' '.$e["address"]['region'];
						if( isset($e["address"]) && isset( $e["address"]['addressLocality']) ){
							$locality = str_replace( " ", "", $e["address"]['addressLocality']);
							$scopesClasses .= ' '.$locality;
						}

						//$url = Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$id);
						$name = ( isset($e["name"]) ) ? $e["name"] : "" ;
						$url = "loadByHash('#".$type.".detail.id.".$id."')";
						$url = 'href="javascript:;" onclick="'.$url.'"';	
						$process = "";
						if(@$e["toBeValidated"])
							$process = " <color class='text-red'>(en attente de confirmation)</color>";
						else if(@$e["isAdminPending"])
							$process = " <color class='text-red'>(".Yii::t("common","Wait for confirmation").")</color>";
						
						if(@$e["tobeactivated"] || @$e["pending"]){
							$process= " (En cours d'inscription)";
							$processStyle='style="filter:grayscale(100%);-webkit-filter:grayscale(100%);"';
						}
						else{
							$processStyle="";
						}
						$entryType = ( isset($e["type"])) ? $e["type"] : "";
						$panelHTML = '<li id="'.$collection.(string)$id.'" class="item_map_list col-lg-3  col-md-4 col-sm-6 col-xs-6 mix '.$collection.'Line '.$collection.' '.$scopesClasses.' '.$tagsClasses.' '.$entryType.'" data-cat="1" '.$processStyle.'>'.
							'<div style="position:relative;">'.
										'<div class="portfolio-item">';
						$strHTML = '<a '.$url.' class="thumb-info item_map_list_panel" data-id="'.$id.'"  >'.$name.'</a>';
						
						if ($process) {
							$strHTML .= '<span class="text-xss">'.$process.'</span>';
						}
						
						/* **************************************
						* EMAIL for admin use only
						***************************************** */
						//$strHTML .= isset($e["email"]) ? '<br/><a class="text-xss" '.$url.'>'.$e["email"].'</a>' : "";

						/* **************************************
						* DATE for Event and PROJECT uses
						***************************************** */
						
						if(isset($e["startDate"]) && !isset($e["endDate"]) && $type == "event"){
						 	if(isset($e["startDate"]->sec)){
						 		$strHTML .=  '<br/>Le <a class="startDateEvent" '.$url.'>'.date('m/d/Y', $e["startDate"]->sec).'</a>';
							}else{
								$strHTML .=  '<br/>Le <a class="startDateEvent" '.$url.'>'.$e["startDate"].'</a>';
							}
						}
						if(isset($e["startDate"]) && isset($e["endDate"]) && $type == "event"){
						 	if(isset($e["startDate"]->sec)){
						 		$strHTML .=  '<br/>'.
						 					 '<a class="startDateEvent start double" '.$url.'>'.date('m/d/Y', $e["startDate"]->sec).'</a>';
						 		$strHTML .=  '<a class="startDateEvent end double" '.$url.'>'.date('m/d/Y', $e["endDate"]->sec).'</a>';
						 		
							}else{
								$start = dateToStr($e["startDate"], "fr", true);
								$end = dateToStr($e["endDate"], "fr", true);

								if(substr($start, 0, 10) != substr($end, 0, 10)){
									$strHTML .=  '<br/>'.
												 '<a class="startDateEvent start double" '.$url.'>'.$e["startDate"].'</a>';
									$strHTML .=  '<a class="startDateEvent end   double" '.$url.'>'.$e["endDate"].'</a>';
								}else{
									$hour1 = substr($start, strpos($start, "-")+2, strlen($start));
									$hour2 = substr($end,   strpos($end,   "-")+2, strlen($end));
									
									if($hour1 == "00h00" && $hour2 == "23h59") {
										$strHTML .=  '<br/>'.
													 '<a class="startDateEvent double" '.$url.' allday="true"> Le '.substr($start, 0, 10).'</a>';
										$strHTML .=  '<a class="startDateEvent double" '.$url.'>'.Yii::t("event","All day",null,Yii::app()->controller->module->id).'</a>';
									}else{
										$strHTML .=  '<br/>'.
													 '<a class="startDateEvent double" '.$url.' allday="true"> Le '.substr($start, 0, 10).'</a>';
										$strHTML .=  '<a class="startDateEvent double" '.$url.'>'.$hour1. " - ".$hour2.'</a>';
									}
								}
							}
						}


						/* **************************************
						* TAGS
						***************************************** */
						$tagsHTML = "";
						if(isset($e["tags"])){
							foreach ($e["tags"] as $key => $value) {
								$tagsHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.preg_replace("/[^A-Za-z0-9]/", "", $value).'"><span class="text-red text-xss">#'.$value.'</span></a>';
								if( $tags != "" && !in_array($value, $tags) ) {
									array_push($tags, $value);
									$tagsHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.preg_replace("/[^A-Za-z0-9]/", "", $value).'"><span>#'.$value.'</span></a>';
								}
							}
						}

						/* **************************************
						* SCOPES
						***************************************** */
						$scopeHTML = "";
						if( isset($e["address"]) && isset( $e["address"]['codeInsee'])){
							//$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['codeInsee'].'"><span class="label address text-dark text-xss">'.$e["address"]['codeInsee'].'</span></a>';
							if( !in_array($e["address"]['codeInsee'], $scopes['codeInsee']) ) {
								array_push($scopes['codeInsee'], $e["address"]['codeInsee'] );
								$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['codeInsee'].'"><span>insee '.$e["address"]['codeInsee'].'</span></a>';
							}
						}
						if( isset($e["address"]) && isset( $e["address"]['postalCode'])){
							$scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.$e["address"]['postalCode'].'"><span class="label address text-dark text-xss">'.$e["address"]['postalCode'].'</span></a>';
							if( !in_array($e["address"]['postalCode'], $scopes['postalCode']) ) {
								$insee = isset($e["address"]['codeInsee']) ? $e["address"]['codeInsee'] : $e["address"]['postalCode'];
								array_push($scopes['postalCode'], $e["address"]['postalCode'] );
								$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$insee.'"><span>cp '.$e["address"]['postalCode'].'</span></a>';
							}
						}
						if( isset($e["address"]) && isset( $e["address"]['region']) ){
							$scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.$e["address"]['region'].'" ><span class="label address text-dark text-xss">'.$e["address"]['region'].'</span></a>';
							if( !in_array($e["address"]['region'], $scopes['region']) ) {
								array_push($scopes['region'], $e["address"]['region'] );
								$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['region'].'"><span>region '.$e["address"]['region'].'</span></a>';
							}
						}
						if( isset($e["address"]) && isset( $e["address"]['addressLocality'])){
							if ($e["address"]['addressLocality']=="Unknown")
								$adresseLocality="Adresse non renseignée";
							else
								$adresseLocality=$e["address"]['addressLocality'];
							$scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.str_replace( " ", "", $e["address"]['addressLocality']).'" ><span class="label address text-dark text-xss">'.$adresseLocality.'</span></a>';
							if( !in_array($e["address"]['addressLocality'], $scopes['addressLocality']) ) {
								array_push($scopes['addressLocality'], $e["address"]['addressLocality'] );
								$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.str_replace( " ", "", $e["address"]['addressLocality']).'"><span>Locality  '.$e["address"]['addressLocality'].'</span></a>';
							}
						}

						//$strHTML .= '<div class="tools tools-bottom">'.$tagsHTML."<br/>".$scopeHTML.'</div>';
						$featuresHTML = "";
						if( $scopeHTML != "" ){
							$strHTML .= '<div class=" scopes'.$id.$type.' features">'.$scopeHTML.'</div>';
							//$featuresHTML .= ' <a href="#" onclick="showHideFeatures(\'scopes'.$id.$type.'\');"><i class="fa fa-circle-o text-red text-xss"></i></a>';
						}
						$strHTML .= '</div>';
						$strHTML .= "<br/><div>";//$tagsHTML."<br/>".$scopeHTML;
						if( isset( $e["tags"]) ){
							$strHTML .= '<div class="hide tags'.$id.$type.' features tagblock">'.$tagsHTML.'</div>';
							//$featuresHTML .= '<a href="#" onclick="showHideFeatures(\'tags'.$id.$type.'\');"><i class="fa fa-tags text-red text-xss"></i></a>';
						}
						if( isset($e["geo"]) && isset($e["geo"]["latitude"]) && isset($e["geo"]["longitude"]) ){
							//$featuresHTML .= ' <a href="#" onclick="$(\'.box-ajax\').hide(); toastr.error(\'show on map + label!\');"><i class="fa fa-map-marker text-red text-xss"></i></a>';
						}
						if($manage==1){
							$strHTML .= '<div class="dropdown" style="position:absolute;right: 0px;top: 0px;">'.
											'<a href="javascript:;" data-toggle="dropdown" class="btn btn-red dropdown-toggle btn-sm" style="padding:0px;">'.
												'<i class="fa fa-cog text-white"></i> <span class="caret" style="margin-right:4px;"></span>'.
											'</a>'.
											'<ul class="dropdown-menu pull-right dropdown-white" role="menu">';
							if(@$e["toBeValidated"]){
								$strHTML .= 	'<li>'.
													'<a href="javascript:;" class="acceptAsMemberBtn btn btn-xs tooltips text-left" data-placement="left"  data-type="'.$collection.'" data-id="'.$id.'" data-name="'.$name.'" data-placement="top" data-original-title="Add this '.$type.' to your '.$collection.'" style="padding-right:35px;">'.
														'<i class="confirmPendingUserBtnIcon fa fa-link"></i>'.
														Yii::t("common","Accept this ".$type."").
													'</a>'.
												'</li>';
							}
							if(@$e["isAdminPending"]){
								$strHTML .= 	'<li>'.
													'<a href="javascript:;" class="acceptAsAdminBtn btn btn-xs tooltips text-left" data-placement="left"  data-type="'.$collection.'" data-id="'.$id.'" data-name="'.$name.'" data-admin="false" data-placement="top" data-original-title="Add this '.$type.' as admin" style="padding-right:35px;">'.
														'<i class="confirmPendingUserBtnIcon fa fa-user-plus"></i>'.
														Yii::t("common","Accept as admin").
													'</a>'.
												'</li>';
							} else {
								if(!@$e["isAdmin"] && !@$e["toBeValidated"] && !@$e["isAdminPending"]){
								$strHTML .= 	'<li>'.
													'<a href="javascript:;" class="btn btn-xs text-left" style="padding-right:35px;" onclick="connectTo(\''.$parentType.'\',\''.$parentId.'\', \''.$id.'\', \''.Person::COLLECTION.'\', \'admin\',\'\',\'true\')">'.
														'<i class="confirmPendingUserBtnIcon fa fa-user-plus"></i>'.
														Yii::t("common","Add as admin").
													'</a>'.
												'</li>';
								}
							}
							$strHTML .=			'<li>'.
													'<a href="javascript:;" class="disconnectBtn btn btn-xs tooltips text-left" data-placement="left"  data-type="'.$collection.'" data-id="'.$id.'" data-name="'.$name.'" data-placement="top" data-original-title="Remove this '.$type.'" >'.
														'<i class="disconnectBtnIcon fa fa-unlink"></i>'.
														Yii::t("common","Unlink").
													'</a>'.
												'</li>';
							$strHTML .= 	'</ul>'.
							'			</div>';
						}
						$color = "";
						if($icon == "fa-users") $color = "green";
						if($icon == "fa-user") $color = "yellow";
						if($icon == "fa-calendar") $color = "orange";
						if($icon == "fa-lightbulb-o") $color = "purple";
						$flag = '<div class="ico-type-account"><i class="fa '.$icon.' fa-'.$color.'"></i>';
						if(@$e["isAdmin"] && !@$e["isAdminPending"])
							$flag .= "<i class='fa fa-bookmark fa-rotate-270 fa-red' style='left:-5px;'></i>";
						$flag.="</div>";
						echo $panelHTML.
							'<div class="imgDiv left-col">'.$img.$flag.$featuresHTML.'</div>'.
							'<div class="detailDiv">'.$strHTML.'</div></div></div></li>';
					}
					?>
				</ul>
				</div>
				
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->

<?php 
    //rajoute un attribut typeSig sur chaque donnée pour déterminer quel icon on doit utiliser sur la carte
    //et pour ouvrir le panel info correctement
    foreach($people           as $key => $data) { $people[$key]["typeSig"] = PHType::TYPE_CITOYEN; }
    foreach($organizations    as $key => $data) { $organizations[$key]["typeSig"] = PHType::TYPE_ORGANIZATIONS; }
    foreach($events           as $key => $data) { $events[$key]["typeSig"] = PHType::TYPE_EVENTS; }
    foreach($projects         as $key => $data) { $projects[$key]["typeSig"] = PHType::TYPE_PROJECTS; }
    
    $contextMap = array();
    if(isset($contextData)) $contextMap = array("context" => $contextData);
    if(isset($people))          $contextMap = array_merge($contextMap, $people);
    if(isset($organizations))   $contextMap = array_merge($contextMap, $organizations);
    if(isset($events))          $contextMap = array_merge($contextMap, $events);
    if(isset($projects))        $contextMap = array_merge($contextMap, $projects);
?>
<script type="text/javascript">

var tabButton = [];
var mapButton = {"media": "Media", "slider": "Slider", "profil" : "Profil", "banniere" : "Banniere", "logo" : "Logo"};
var itemId = "";
var itemType = "";
var controllerId = ""

var activeType = "<?php echo ( isset( $_GET['type'] ) ? $_GET['type'] : "" )  ?>";
var authorizationToEdit = <?php echo (isset($canEdit) && $canEdit) ? 'true': 'false'; ?>; 
var images = [];
var actions = [];
var mapData = <?php echo json_encode($contextMap) ?>;
var contextName = "<?php echo addslashes($contextName); ?>";	
var contextIcon = "<?php echo $contextIcon; ?>";	
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-"+contextIcon+"'></i> " + contextName);

	var tagFilters = <?php echo empty($tagsHTMLFull) ? "''" : json_encode($tagsHTMLFull) ?>;
	var scopeFilters = <?php echo empty($scopesHTMLFull) ? "''" : json_encode($scopesHTMLFull) ?>;
	$("#tagFilters").html("<h4 class='text-dark '><i class='fa fa-angle-down'></i> <?php echo Yii::t('common','What are you looking for ?') ?></h4>" + tagFilters);
	$("#scopeFilters").html("<h4 class='text-dark '><i class='fa fa-angle-down'></i> <?php echo Yii::t('common','Where are you looking ?') ?></h4>" + scopeFilters);
	initGrid();

	if( activeType != ""){
		 $('#item_panel_filter_'+activeType).trigger("click");
		 $('.filter'+activeType).trigger("click");
	}

	$('.btn-close-panell').click(function(){
		showMap(true);
	});
	
	
	convertAllStartDateEvent();
	console.dir(mapData);
	Sig.restartMap();
	Sig.showMapElements(Sig.map, mapData);


	
});

 function convertAllStartDateEvent(){ console.log("convertAllStartDateEvent");
 	$.each($(".startDateEvent.start"), function(){
 		var date = dateToStr($(this).html(), "fr", true);
 		if($(this).attr("allday") == "true"){
 			$(this).html("Le " + date);
 		}else{
	 		$(this).html("Du " + date);
	 	}
 	});
 	$.each($(".startDateEvent.end"), function(){
 		var date = dateToStr($(this).html(), "fr", true);
 		$(this).html("Au " + date);
 	});
 }

 function toggleFilters(what){
 	if( !$(what).is(":visible") ){
 		$('.optionFilter').hide();
 		}
 	$(what).slideToggle();
 }
 function showFilters(what, show){
 	if(show){
 		$(what).show('fast');
 		<?php if ($followsOrga > 0){?>
 		$(".labelFollows").show('fast');
 		<?php } else { ?>
 		 	$(".labelFollows").hide('fast');
 		<?php } ?>
 	}else{
 		$(what).hide('fast');
 	}

 }
function showHideFeatures(classId){
	$(".features").addClass('hide');
	console.log(classId);
	$("."+classId).removeClass('hide');
}
function initGrid(){
	if( $(".mix").length ){
		bindBtnEvents();
		///// MixItUp is a plugin from jQuery to customize element filtering and sortering
		///// https://mixitup.kunkalabs.com
		
		$('#Grid').mixItUp({
			callbacks: {
				onMixEnd: function(state){
					// console.log(state);
					if (state.activeFilter != ".followers")
						$(".followers").hide();
				}	
			}
		});
		/*$('.portfolio-item .chkbox').bind('click', function () {
	        if ($(this).parent().hasClass('selected')) {
	            $(this).parent().removeClass('selected').children('a').children('img').removeClass('selected');
	        } else {
	            $(this).parent().addClass('selected').children('a').children('img').addClass('selected');
	        }
	    });*/
	}else{
		var htmlDefault = "<div class='center'>"+
							"<i class='fa fa-share-alt fa-5x text-blue'></i>"+
							"<br>No Connections yet"+
						"</div>";
		$('#Grid').append(htmlDefault);
		$(".labelCommunity").hide();
	}
}

function bindBtnEvents(){
	$(".disconnectBtn").off().on("click",function () {
	        //$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
	        var userId = $(this).data("id");
	        var userType = $(this).data("type");
	        var parentType = $("#parentType").val();
	        var parentId = $("#parentId").val();
	        var connectType = $("#connectType").val();

	        console.log(userId+"/"+userType+"/"+parentType+"/"+parentId+"/"+connectType);
	        bootbox.confirm("<?php echo Yii::t("common", "Are you sure you want to delete") ?> <span class='text-red'>"+$(this).data("name")+"</span> <?php echo Yii::t("common", "from your community") ?> ?", 
				function(result) {
					if (result) {
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/link/disconnect",
					       	dataType: "json",
					       	data: {"parentType": parentType, "parentId": parentId, "childId":userId, "childType": userType,"connectType":connectType},
				        	success: function(data){
					        	if ( data && data.result ) {               
						       	 	toastr.success("<?php echo Yii::t("common", "Link divorced successfully") ?>!!");
						        	$("#"+data.collection+userId).remove();
						        	//if(userType == "organizations")
						        	badge=$(".menu_directory li[data-filter='."+userType+"']").find(".badge");
						        	badgeAll=$(".menu_directory li[data-filter='all']").find(".badge");
						        	count=Number(badge.text());
						        	countAll=Number(badgeAll.text());
						        	//    active = $(this).hasClass('active');
									//    $label.text(active ? 'Like' : 'Liked');
									badgeAll.fadeIn().text(countAll - 1);
									if((count-1)==0){
										$(".menu_directory li[data-filter='."+userType+"']").fadeOut();
									}
									else{
    									badge.fadeIn().text(count - 1);
    								}
    								if(data.removeMeAsAdmin){
										loadByHash(location.hash);
    								}
									//  $(this).toggleClass('active');
									//	alert(nbItem);
						        } else {
						            toastr.error("<?php echo Yii::t("common", "Something went wrong!")." ".Yii::t("common","Please try again")?>.");

						           //$(".disconnectBtnIcon").removeClass("fa-spinner fa-spin").addClass("fa-unlink");
						        }
						    }
						});
					}
				}
			)
	});
	$(".acceptAsAdminBtn").off().on("click",function () {
		var childId = $(this).data("id");
        var childType = $(this).data("type");
		actionAdmin = $(this).data("admin");
        bootbox.confirm("<?php echo Yii::t("common","Are you sure you want to confirm") ?> <span class='text-red'>"+$(this).data("name")+"</span> <?php echo Yii::t("common","as admin") ?> ?", 
			function(result) {
				if (result) {
					linkOption = "<?php echo Link::IS_ADMIN_PENDING; ?>";
					validateConnection($("#parentType").val(), $("#parentId").val(), childId, childType, linkOption, 
						function() {
							toastr.success("<?php echo Yii::t("common", "New admin well register") ?>!!");
							loadByHash(location.hash);
						}
					);
				}
			}
		)
	});
	
	$(".acceptAsMemberBtn").off().on("click",function () {
        //$(".disconnectBtnIcon").removeClass("fa-unlink").addClass("fa-spinner fa-spin");
        var childId = $(this).data("id");
        var childType = $(this).data("type");
        var linkOption = "<?php echo Link::TO_BE_VALIDATED; ?>";
        bootbox.confirm("<?php echo Yii::t("common","Are you sure you want to confirm") ?> <span class='text-red'>"+$(this).data("name")+"</span> <?php echo Yii::t("common","as member") ?> ?", 
			function(result) {
				if (result) {
					validateConnection($("#parentType").val(), $("#parentId").val(), childId, childType, linkOption, 
						function() {
							toastr.success("<?php echo Yii::t("common", "New member well register") ?>!!");
							loadByHash(location.hash);
						}
					);
				}
			}
		)
	});
}

</script>



