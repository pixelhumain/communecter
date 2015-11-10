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
		min-height: 85px;
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
		width: 60px;
		height: 60px;
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
		border-radius: 0px !important;
		margin-bottom: 0px;
		font-weight: 600;
		background-color: #FCFCFC !important;
		padding: 15px  10px;
		margin-bottom: 1px;
		margin-left: -1px;
		-moz-box-shadow: 0px 0px 3px 0px #D1C5C5;
		-webkit-box-shadow: 0px 0px 3px 0px #D1C5C5;
		-o-box-shadow: 0px 0px 3px 0px #D1C5C5;
		box-shadow: 0px 0px 3px 0px #D1C5C5;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#D1C5C5, Direction=NaN, Strength=3);
	}
	.menu_directory .badge{
		color: #315C6E !important;
		background-color: #E9E9E9 !important;
		/*float: left;*/
		/*width: 35px;*/
		/*margin-right: 10px;*/
	}
	.menu_directory .filter.active a{
		background-color: #E9E9E9 !important;
	}
	.menu_directory li a:hover{
		/*color: #FFF !important;
		background-color: #315C6E !important;*/
		/*border: 1px solid #315C6E;
		background-color: #FFF !important;*/
		background-color: #E9E9E9 !important;
		/*-moz-box-shadow: 0px 0px 5px 0px #315C6E;
		-webkit-box-shadow: 0px 0px 5px 0px #315C6E;
		-o-box-shadow: 0px 0px 5px 0px #315C6E;
		box-shadow: 0px 0px 5px 0px #315C6E;
		filter:progid:DXImageTransform.Microsoft.Shadow(color=#315C6E, Direction=NaN, Strength=3);*/
	}
	.menu_directory .filter.active a.text-dark{
		color:#3C5665 !important;
	}
	.menu_directory .filter.active .badge {
		background-color: #FFF !important;
		color: #315C6E !important;
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

	ul{
		list-style: none;
	}
</style>

<?php 
if( isset($_GET["isNotSV"])) {
	/*
	$this->renderPartial('../default/panels/toolbar',array("toolbarStyle"=>"width:50px")); */
	$fatherName = "";
	if( isset($type) && $type == Organization::CONTROLLER && isset($organization) ){
		Menu::organization( $organization );
		$thisOrga = Organization::getById($organization["_id"]);
		$contextName = "Organization : ".$thisOrga["name"];
		$contextIcon = "users";
	}
	else if( isset($type) && $type == City::CONTROLLER && isset($city) ){
		Menu::city( $city );
		$contextName = "City : ".$city["name"];
		$contextIcon = "university";
	}
	else if( isset($type) && $type == Person::CONTROLLER && isset($person) ){
		Menu::person( $person );
		$contextName = "Person : ".$person["name"];
		$contextIcon = "user";
	}
	else if( isset($type) && $type == PROJECT::CONTROLLER && isset($project) ){
		//Menu::project( $person );
		$contextName = "Project : ".$project["name"];
		$contextIcon = "lightbulb-o";
	}
	/*else
		$this->toolbarMBZ = array(
		    array( 'tooltip' => "Add a Person, Organization, Event or Project", "iconClass"=>"fa fa-plus" , "iconSize"=>"" ,"href"=>"<a class='tooltips btn btn-default' href='#' onclick='showPanel(\"box-add\",null,\"ADD SOMETHING TO MY NETWORK\")' ")
		);*/
	$this->renderPartial('../default/panels/toolbar'); 
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-transparent">
			<div class="panel-body">
				<!-- <div class="col-md-12">
					Details proprietaire directory
				</div> -->
				
			<!-- 	<span class="homestead panelLabel pull-left"> 
					<i class="fa fa-bookmark fa-rotate-270"></i> DIRECTORY 
				</span> -->
				
				<div class="col-md-12 col-sm-12 col-xs-12 row">
					<ul class="nav nav-pills menu_directory container_menu_directory controls list-unstyled">
						<li class="filter active" data-filter="all">
							<a href="#" class="text-dark"><i class="fa fa-th-list"></i> <span class="">Show </span>All <span class="badge"><?php echo (count($people) + count($organizations) + count($events) + count($projects));  ?></a>
						</li>
						<li class="filter" data-filter=".citoyens">
							<a href="javascript:;" class="filtercitoyens text-yellow" onclick="$('.optionFilter').hide();"><i class="fa fa-user fa-2"></i> <span class=" ">People</span> <span class="badge"><?php echo count($people);  ?></span></a>
						</li>
						<li class="filter" data-filter=".organizations">
							<a href="javascript:;" onclick="showFilters('#orgaTypesFilters', true)" class="filterorganizations text-green"><i class="fa fa-users fa-2"></i> <span class="">Organizations</span> <span class="badge"><?php echo count($organizations);  ?></span></a>
						</li>
						<li class="filter" data-filter=".events">
							<a href="javascript:"  class="filterevents text-orange" onclick="$('.optionFilter').hide();"><i class="fa fa-calendar fa-2"></i> <span class="">Events</span> <span class="badge"><?php echo count($events);  ?></span></a>
						</li>
						<li class="filter" data-filter=".projects">
							<a href="javascript:;" class="filterprojects text-purple" onclick="$('.optionFilter').hide();"> <i class="fa fa-lightbulb-o fa-2"></i> <span class="">Project</span> <span class="badge"><?php echo count($projects);  ?></span></a>
						</li>
						<li  class="" style="">
							<a href="javascript:;" class="text-red" onclick="toggleFilters('#tagFilters')"><i class="fa fa-tags  fa-2"></i> About what ?</a>
						</li>
						<li class="" style="">
							<a href="javascript:;" class="text-red" onclick="toggleFilters('#scopeFilters')"><i class="fa fa-circle-o  fa-2"></i> Where ?</a>
						</li>
						
					</ul>
				</div>
				<div class="col-md-12 pull-right">
					<div id="tagFilters" class="optionFilter  pull-left center" style="display:none;width:100%;" ></div>
					<div id="scopeFilters" class="optionFilter  pull-left center" style="display:none;width:100%;" ></div>
					<div id="orgaTypesFilters" class="optionFilter  pull-left center" style="display:none;width:100%;text-align:center;" >
						<h4 class='text-dark'><i class='fa fa-angle-down'></i> Select organization type</h4>
						<a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".NGO"><span>N.G.O</span></a>
						<a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".LocalBusiness">Business</a>
						<a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".Group">Group</a>
						<a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".GovernmentOrganization">Government Organization</a>
					</div>
				</div>
				<ul id="Grid" class="pull-left  list-unstyled">
					
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;
					$tags = array();
					$tagsHTMLFull = "";
					$scopes = array(
						"codeInsee"=>array(),
						"codePostal"=>array(),
						"region"=>array(),
						"addressLocality"=>array(),
					);
					$scopesHTMLFull = "";
					
					/* ************ ORGANIZATIONS ********************** */
					if(isset($organizations)) 
					{ 
						foreach ($organizations as $e) 
						{ 
							buildDirectoryLine($e, Organization::COLLECTION, Organization::CONTROLLER, Organization::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull);
						};
					}

					/* ********** PEOPLE ****************** */
					if(isset($people)) 
					{ 
						foreach ($people as $e) 
						{ 
							buildDirectoryLine($e, Person::COLLECTION, Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull);
						}
					}

					/* ************ EVENTS ************************ */
					if(isset($events)) 
					{ 
						foreach ($events as $e) 
						{ 
							buildDirectoryLine($e, Event::COLLECTION, Event::CONTROLLER, Event::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull);
						}
					}
	
					/* ************ PROJECTS **************** */
					if( count($projects) ) 
					{ 
						foreach ($projects as $e) 
						{ 
							buildDirectoryLine($e, Project::COLLECTION, Project::CONTROLLER, Project::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull);
						}
					}
					/* 
					<li class="col-md-3 col-sm-6 col-xs-12 mix kiki gallery-img" data-cat="1" id="">
						<div class="portfolio-item">
							<a class="thumb-info" href="" data-title="Website"  data-lightbox="all">
								<i class="fa fa-user"></i>
								<span class="thumb-info-title">Tihdfhd fghdfh dg dfgh tle</span>
							</a>
							<br/><br/><br/>
							<div class="chkbox"></div>
							<div class="tools tools-bottom">
								<a href="#" class="btnRemove" data-id="" data-name="" data-key="" >
									<i class="fa fa-trash-o"></i>
								</a>
							</div>
						</div>
					</li>
					*/
					function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes, &$tagsHTMLFull,&$scopesHTMLFull )
					{
							
						if(!isset( $e['_id'] ) || !isset( $e["name"]) || $e["name"] == "" )
							return;
						$actions = "";
						$id = @$e['_id'];

						/* **************************************
						* TYPE + ICON
						***************************************** */
						$img = '';//'<i class="fa '.$icon.' fa-3x"></i> ';
						if ($e && isset($e["imagePath"])){ 
							$img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/'.$moduleId.'/document/resized/50x50'.$e['imagePath']).'">';
						}else{
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
						if( isset($e["address"]) && isset( $e["address"]['codePostal']) )
							$scopesClasses .= ' '.$e["address"]['codePostal'];
						if( isset($e["address"]) && isset( $e["address"]['region']) )
							$scopesClasses .= ' '.$e["address"]['region'];

						//$url = Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$id);
						$name = ( isset($e["name"]) ) ? $e["name"] : "" ;
						$url = ( isset($_GET["isNotSV"]))  ? "openMainPanelFromPanel( '/".$type."/detail/id/".$id."', '".$type." : ".$name."','".$icon."', '".$id."' )" : Yii::app()->createUrl('/communecter/'.$type.'/dashboard/id/'.$id);
						$url = ( isset($_GET["isNotSV"]))  ? 'href="#" onclick="'.$url.'"' : 'href="'.$url.'"';

						$entryType = ( isset($e["type"])) ? $e["type"] : "";
						$panelHTML = '<li id="'.$collection.(string)$id.'" class="item_map_list col-lg-3  col-md-4 col-sm-6 col-xs-6 mix '.$collection.'Line '.$collection.' '.$scopesClasses.' '.$tagsClasses.' '.$entryType.'" data-cat="1" >'.
							'<div class="portfolio-item">';
						$strHTML = '<a '.$url.' class="thumb-info item_map_list_panel" data-id="'.$id.'"  >'.$name.'</a>';
						
						/* **************************************
						* EMAIL for admin use only
						***************************************** */
						$strHTML .= '<br/><a class="text-xss" '.$url.'>'.((isset($e["email"]))? $e["email"]:"").'</a>';

						/* **************************************
						* TAGS
						***************************************** */
						$tagsHTML = "";
						if(isset($e["tags"])){
							foreach ($e["tags"] as $key => $value) {
								$tagsHTML .= ' <a href="#" class="filter" data-filter=".'.preg_replace("/[^A-Za-z0-9]/", "", $value).'"><span class="text-red text-xss">#'.$value.'</span></a>';
								if( $tags != "" && !in_array($value, $tags) ) {
									array_push($tags, $value);
									$tagsHTMLFull .= ' <a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.preg_replace("/[^A-Za-z0-9]/", "", $value).'"><span>#'.$value.'</span></a>';
								}
							}
						}

						/* **************************************
						* SCOPES
						***************************************** */
						$strHTML .= '<br/>';
						$scopeHTML = "";
						if( isset($e["address"]) && isset( $e["address"]['codeInsee']) ){
							$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['codeInsee'].'"><span class="label address text-dark text-xss">'.$e["address"]['codeInsee'].'</span></a>';
							if( !in_array($e["address"]['codeInsee'], $scopes['codeInsee']) ) {
								array_push($scopes['codeInsee'], $e["address"]['codeInsee'] );
								$scopesHTMLFull .= ' <a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['codeInsee'].'"><span>insee '.$e["address"]['codeInsee'].'</span></a>';
							}
						}
						if( isset($e["address"]) && isset( $e["address"]['codePostal']) ){
							$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['codePostal'].'"><span class="label address text-dark text-xss">'.$e["address"]['codePostal'].'</span></a>';
							if( !in_array($e["address"]['codePostal'], $scopes['codePostal']) ) {
								array_push($scopes['codePostal'], $e["address"]['codePostal'] );
								$scopesHTMLFull .= ' <a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['codeInsee'].'"><span>cp '.$e["address"]['codePostal'].'</span></a>';
							}
						}
						if( isset($e["address"]) && isset( $e["address"]['region']) ){
							$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['region'].'" ><span class="label address text-dark text-xss">'.$e["address"]['region'].'</span></a>';
							if( !in_array($e["address"]['region'], $scopes['region']) ) {
								array_push($scopes['region'], $e["address"]['region'] );
								$scopesHTMLFull .= ' <a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['region'].'"><span>region '.$e["address"]['region'].'</span></a>';
							}
						}
						if( isset($e["address"]) && isset( $e["address"]['addressLocality']) ){
							$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['addressLocality'].'" ><span class="label address text-dark text-xss">'.$e["address"]['addressLocality'].'</span></a>';
							if( !in_array($e["address"]['addressLocality'], $scopes['addressLocality']) ) {
								array_push($scopes['addressLocality'], $e["address"]['addressLocality'] );
								$scopesHTMLFull .= ' <a href="#" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['addressLocality'].'"><span>Locality  '.$e["address"]['addressLocality'].'</span></a>';
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
						
						$color = "";
						if($icon == "fa-users") $color = "green";
						if($icon == "fa-user") $color = "yellow";
						if($icon == "fa-calendar") $color = "orange";
						if($icon == "fa-lightbulb-o") $color = "purple";
						$flag = '<div class="ico-type-account"><i class="fa '.$icon.' fa-'.$color.'"></i></div>';
						echo $panelHTML.
							'<div class="imgDiv left-col">'.$img.$flag.$featuresHTML.'</div>'.
							'<div class="detailDiv">'.$strHTML.'</div></div></li>';
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
    if(isset($organizations))   $contextMap = array_merge($contextMap, $organizations);
    if(isset($people))          $contextMap = array_merge($contextMap, $people);
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
var contextName = "<?php echo $contextName; ?>";	
var contextIcon = "<?php echo $contextIcon; ?>";	
jQuery(document).ready(function() {

	//$(".moduleLabel").html("<i class='fa fa-"+contextIcon+"'></i> " + contextName);

	var tagFilters = <?php echo empty($tagsHTMLFull) ? "''" : json_encode($tagsHTMLFull) ?>;
	var scopeFilters = <?php echo empty($scopesHTMLFull) ? "''" : json_encode($scopesHTMLFull) ?>;
	$("#tagFilters").html("<h4 class='text-dark '><i class='fa fa-angle-down'></i> Select tags</h4>" + tagFilters);
	$("#scopeFilters").html("<h4 class='text-dark '>Select places <i class='fa fa-angle-down'></i></h4>" + scopeFilters);
	initGrid();

	console.log("change filter " + activeType);

	if( activeType != ""){
		 $('#item_panel_filter_'+activeType).trigger("click");
		 $('.filter'+activeType).trigger("click");
	}

	$('.btn-close-panell').click(function(){
		showMap(true);
	});
	
	Sig.restartMap();
	Sig.showMapElements(Sig.map, mapData);


	
});
 function toggleFilters(what){
 	if( !$(what).is(":visible") )
 		$('.optionFilter').hide();
 	$(what).slideToggle();
 }
 function showFilters(what, show){
 	if(show){
 		$(what).show('fast');
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
		$('#Grid').mixItUp();
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
	}
}

function bindBtnEvents(){
	$(".portfolio-item .btnRemove").on("click", function(e){
		var imageId= $(this).data("id");
		var imageName= $(this).data("name");
		var key = $(this).data("key")
		e.preventDefault();
		bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> ?", 
			function(result) {
				if(result){
					$.ajax({
						url: baseUrl+"/"+moduleId+"/document/delete/dir/"+moduleId+"/type/"+itemType+"/parentId/"+itemId,
						type: "POST",
						dataType : "json",
						data: {"name": imageName, "parentId": itemId, "docId":imageId, "parentType": itemType, "pictureKey" : key, "path" : ""},
						success: function(data){
							if(data.result){
								$("#"+imageId).remove();
								toastr.success(data.msg);
							}else{
								toastr.error(data.error)
							}
						}
					})
				}
			})
	})
}

</script>



