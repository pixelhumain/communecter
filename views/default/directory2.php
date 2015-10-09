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
		min-height: 110px;
		width: 23.5%;
		background-color: white;
		display: inline-block;
		border:1px solid #bbb;
		margin-right : 1.5%;
		border-radius: 10px;
		-webkit-box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
		-moz-box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
		box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
	}
	.mix a{
		color:black;
		font-weight: bold;
	}
	.mix .imgDiv{
		float:left;
		width:30%;
		background: ;
		margin-top:25px;
	}
	.mix .detailDiv{
		float:right;
		width:70%;
		margin-top:25px;
		padding-left:10px;
		text-align: left;
	}
	.mix .text-xss{ font-size: 10px; }
	#btn-close-panell {
	    position: absolute;
	    right: 25px;
	    top: 20px;
	    font-size: 20px;
	}

	#Grid .item_map_list{
		padding:0px !important; 
	}
	#Grid .ico-type-account i.fa{
		margin-left:11px !important;
	}
	#Grid .thumbnail-profil{
		margin-left:10px;
	}
</style>

<?php 
if( isset($_GET["isNotSV"])) {
	/*
	$this->renderPartial('../default/panels/toolbar',array("toolbarStyle"=>"width:50px")); */
	if( isset($type) && $type == Organization::CONTROLLER && isset($organization))
		Menu::organization( $organization );
	else if( isset($type) && $type == City::CONTROLLER && isset($city))
		Menu::city( $city );
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
				<div class="controls">
					<ul class="nav nav-pills">
						<li class="filter active" data-filter="all">
							<a href="#">Show All</a>
						</li>
						<li class="filter " data-filter=".citoyens">
							<a href="#" class="filterpersons"><i class="fa fa-user fa-2x"></i> People <?php echo "(".count($people).")";  ?></a>
						</li>
						<li class="filter" data-filter=".organizations">
							<a href="#" class="filterorganizations"><i class="fa fa-users fa-2x"></i> Organizations <?php echo "(".count($organizations).")";  ?></a>
						</li>
						<li class="filter" data-filter=".events">
							<a href="#"  class="filterevents"><i class="fa fa-calendar fa-2x"></i> Events <?php echo "(".count($events).")";  ?></a>
						</li>
						<li class="filter" data-filter=".projects">
							<a href="#" class="filterprojects"><i class="fa fa-lightbulb-o fa-2x"></i> Project <?php echo "(".count($projects).")";  ?></a>
						</li>
					</ul>
					<?php /* ?>
					<button class="button button-primary pull-right btn-close-panell"><i class="fa fa-close"></i></button>
					*/?>
				</div>
				<hr/>
				<!-- GRID -->
				<ul id="Grid" class="list-unstyled">
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;
					$tags = array();
					$scopes = array(
						"codeInsee"=>array(),
						"codePostal"=>array(),
						"region"=>array(),
					);
					
					/* ************ ORGANIZATIONS ********************** */
					if(isset($organizations)) 
					{ 
						foreach ($organizations as $e) 
						{ 
							buildDirectoryLine($e, Organization::COLLECTION, Organization::CONTROLLER, Organization::ICON, $this->module->id,$tags,$scopes);
						};
					}

					/* ********** PEOPLE ****************** */
					if(isset($people)) 
					{ 
						foreach ($people as $e) 
						{ 
							buildDirectoryLine($e, Person::COLLECTION, Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes);
						}
					}

					/* ************ EVENTS ************************ */
					if(isset($events)) 
					{ 
						foreach ($events as $e) 
						{ 
							buildDirectoryLine($e, Event::COLLECTION, Event::CONTROLLER, Event::ICON, $this->module->id,$tags,$scopes);
						}
					}
	
					/* ************ PROJECTS **************** */
					if( count($projects) ) 
					{ 
						foreach ($projects as $e) 
						{ 
							buildDirectoryLine($e, Project::COLLECTION, Project::CONTROLLER, Project::ICON, $this->module->id,$tags,$scopes);
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
					function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes )
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
								$tagsClasses .= ' '.str_replace(" ", "", $value) ;
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
						$url = ( isset($_GET["isNotSV"]))  ? "openMainPanelFromPanel( '/".$type."/detail/id/".$id."', '".$type." : ".$name."','".$icon."', '".$id."' )" : Yii::app()->createUrl('/'.$type.'/dashboard/id/'.$id);
						$url = ( isset($_GET["isNotSV"]))  ? 'href="#" onclick="'.$url.'"' : 'href="'.$url.'"';

						$panelHTML = '<li id="'.$collection.(string)$id.'" class="item_map_list col-md-3 col-sm-6 col-xs-12 mix '.$collection.'Line '.$collection.' '.$scopesClasses.' '.$tagsClasses.'" data-cat="1" >'.
							'<div class="portfolio-item">';
						$strHTML = '<a '.$url.' class="thumb-info item_map_list_panel" data-id="'.$id.'"  >'.$name.'</a>';
						
						/* **************************************
						* EMAIL for admin use only
						***************************************** */
						$strHTML .= '<br/><a class="text-xss" '.$url.'>'.((isset($e["email"]))? $e["email"]:"").'</a>';

						/* **************************************
						* TAGS
						***************************************** */
						$strHTML .= '</div>';
						$tagsHTML = "";
						if(isset($e["tags"])){
							foreach ($e["tags"] as $key => $value) {
								$tagsHTML .= ' <a href="#" class="filter" data-filter=".'.str_replace(" ", "", $value).'"><span class="text-red text-xss">#'.$value.'</span></a>';
								if( $tags != "" && !in_array($value, $tags) ) 
									array_push($tags, $value);
							}
						}

						/* **************************************
						* SCOPES
						***************************************** */
						$strHTML .= '<br/>';
						$scopeHTML = "";
						if( isset($e["address"]) && isset( $e["address"]['codeInsee']) ){
							$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['codeInsee'].'"><span class="label label-danger text-xss">'.$e["address"]['codeInsee'].'</span></a>';
							if( !in_array($e["address"]['codeInsee'], $scopes['codeInsee']) ) 
								array_push($scopes['codeInsee'], $e["address"]['codeInsee'] );
						}
						if( isset($e["address"]) && isset( $e["address"]['codePostal']) ){
							$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['codePostal'].'"><span class="label label-danger text-xss">'.$e["address"]['codePostal'].'</span></a>';
							if( !in_array($e["address"]['codePostal'], $scopes['codePostal']) ) 
								array_push($scopes['codePostal'], $e["address"]['codePostal'] );
						}
						if( isset($e["address"]) && isset( $e["address"]['region']) ){
							$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['region'].'" ><span class="label label-danger text-xss">'.$e["address"]['region'].'</span></a>';
							if( !in_array($e["address"]['region'], $scopes['region']) ) 
								array_push($scopes['region'], $e["address"]['region'] );
						}

						//$strHTML .= '<div class="tools tools-bottom">'.$tagsHTML."<br/>".$scopeHTML.'</div>';
						$strHTML .= "<br/><div class='pull-right'>";//$tagsHTML."<br/>".$scopeHTML;
						$featuresHTML = "";
						if( isset( $e["tags"]) ){
							$strHTML .= '<div class="hide tags'.$id.$type.' features">'.$tagsHTML.'</div>';
							$featuresHTML .= '<a href="#" onclick="showHideFeatures(\'tags'.$id.$type.'\');"><i class="fa fa-tags text-red text-xss"></i></a>';
						}
						if( $scopeHTML != "" ){
							$strHTML .= '<div class="hide scopes'.$id.$type.' features">'.$scopeHTML.'</div>';
							$featuresHTML .= ' <a href="#" onclick="showHideFeatures(\'scopes'.$id.$type.'\');"><i class="fa fa-circle-o text-red text-xss"></i></a>';
						}
						if( isset($e["geo"]) && isset($e["geo"]["latitude"]) && isset($e["geo"]["longitude"]) ){
							$featuresHTML .= ' <a href="#" onclick="$(\'.box-ajax\').hide(); toastr.error(\'show on map + label!\');"><i class="fa fa-map-marker text-red text-xss"></i></a>';
						}

						$color = "";
						if($icon == "fa-users") $color = "green";
						if($icon == "fa-user") $color = "yellow";
						if($icon == "fa-calendar") $color = "orange";
						if($icon == "fa-lightbulb-o") $color = "yellow";
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
<!-- end: PAGE CONTENT-->


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

jQuery(document).ready(function() {
	
	initGrid();

	console.log("change filter " + activeType);

	if( activeType != ""){
		 $('#item_panel_filter_'+activeType).trigger("click");
		 $('.filter'+activeType).trigger("click");
	}

	$('.btn-close-panell').click(function(){
		showMap(true);
	});

	
});

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
							"<i class='fa fa-picture-o fa-5x text-blue'></i>"+
							"<br>No picture to show"+
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



