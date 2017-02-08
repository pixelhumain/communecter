<?php 
$cssAnsScriptFilesTheme = array(
	//X-editable
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/x-editable/js/bootstrap-editable.js' , 

	//DatePicker
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' ,
	'/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js' ,
	'/plugins/bootstrap-datepicker/css/datepicker.css',
	
	//DateTime Picker
	'/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.fr.js' , 
	'/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	//Wysihtml5
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5-editor.css',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/wysihtml5x-toolbar.min.js',
	'/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.js',
	'/plugins/wysihtml5/wysihtml5.js',
	
	//SELECT2
	'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , 

);
//if ($type == Project::COLLECTION)
//	array_push($cssAnsScriptFilesTheme, "/assets/plugins/Chart.js/Chart.min.js");
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme, Yii::app()->request->baseUrl);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js',
	'/js/activityHistory.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);


// Initialize $front array()
// - Define which element is visible following current theme (communecter, network, notragora)
if(@Yii::app()->params["front"]) $front = Yii::app()->params["front"];
else if(@$networkJson && @$networkJson["skin"]["front"]) $front = $networkJson["skin"]["front"];
if(@Yii::app()->params["menu"]) $menuConfig = Yii::app()->params["menu"];
else if(@$networkJson && @$networkJson["skin"]["menu"]) $menuConfig = $networkJson["skin"]["menu"];
?>

<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script type="text/javascript">
    $('head').append('<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/jquery-editable/css/jquery-editable.css" rel="stylesheet" />');
    $.fn.poshytip={defaults:null};
</script>
<script>
if($('#breadcum').length)
	$('#breadcum').html('<i class="fa fa-search fa-2x" style="padding-top: 10px;padding-left: 20px;"></i><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><a href="javascript:;" onclick="reverseToRepertory();">Répertoire</a><i class="fa fa-chevron-right fa-1x" style="padding: 10px 10px 0px 10px;""></i><?php echo addslashes($element["name"]); ?>');
</script>
<style>
.videoWrapper {
	position: relative;
	padding-bottom: 56.25%; /* 16:9 */
	padding-top: 25px;
	height: 0;
}
.videoWrapper iframe {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
}
	</style>
<?php 
	if($type != City::CONTROLLER && $type != Poi::COLLECTION && !@$_GET["renderPartial"])

		$this->renderPartial('../pod/headerEntity', array("entity"=>$element, "type" => $type, "openEdition" => $openEdition, "edit" => $edit, "firstView" => "detail","menuConfig"=>@$menuConfig, "users" => $members)); 
		//End isset renderPartial
?>
<div class="row" id="detailPad">
	<div class=" col-xs-12">
		<div class="col-xs-12 col-md-12">
			<?php if ($type == "poi"){ ?>
			<?php if($element["type"]=="video" && @$element["medias"]){ 
				$videoLink=str_replace ( "autoplay=1" , "autoplay=0" , @$element["medias"][0]["content"]["videoLink"]  );
			?>
				<div class="col-xs-12">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="<?php echo @$videoLink ?>"></iframe>
					</div>
				</div>
				<?php } ?>
				<div class="col-md-12">
	    		<?php 
	    			//var_dump(@$modeEdit);
	    			$params = array(
	    				"element" => $element,
						"parent" => $parent,
						"tags" => $tags, 
						"images" => array("profil"=>array($element["profilImageUrl"])),
						"elementTypes" => @$listTypes,
						"countries" => $countries,
						"typeIntervention" => @$typeIntervention,
						"NGOCategories" => @$NGOCategories,
						"localBusinessCategories" => @$localBusinessCategories,
	    				"contextMap" => @$contextMap,
	    				"publics" => @$public,
						"type" => @$type,
						"organizer" =>@$organizer,
	    				"contentKeyBase" => "profil",
	    				"edit" => @$edit,
	    				"isLinked" => @$isLinked,
	    				"openEdition" => $openEdition,
	    				"modeEdit" => @$modeEdit,
	    				"controller" => $controller
	    			);
	    			$this->renderPartial('../poi/ficheInfo',$params); 
	    		?>
	    		</div>
			<?php } else { ?>
			<div class="col-md-8 no-padding">
	    		<?php 
	    			//var_dump(@$modeEdit);
	    			$params = array(
	    				"element" => $element,
						"tags" => $tags, 
						"images" => array("profil"=>array($element["profilImageUrl"])),
						"elementTypes" => @$listTypes,
						"countries" => $countries,
						"typeIntervention" => @$typeIntervention,
						"NGOCategories" => @$NGOCategories,
						"localBusinessCategories" => @$localBusinessCategories,
	    				"contextMap" => @$contextMap,
	    				"publics" => @$public,
						"type" => @$type,
						"organizer" =>@$organizer,
	    				"contentKeyBase" => "profil",
	    				"edit" => @$edit,
	    				"isLinked" => @$isLinked,
	    				"openEdition" => $openEdition,
	    				"modeEdit" => @$modeEdit,
	    				"controller" => $controller
	    			);
	    			$this->renderPartial('../pod/ficheInfoElement',$params); 
	    		?>
	    	</div>

	    	<?php if($type == Person::COLLECTION ){ ?>
				<style type="text/css">
							
					  #div-discover .btn-discover{
					    border-radius: 60px;
						font-size: 27px;
						font-weight: 200;
						border: 1px solid transparent;
						width: 60px;
						height: 60px;
						padding-top: 10px;
					  }
					  #div-discover .btn-discover.bg-red{
					    /*font-size: 43px;
					    padding-top: 12px;*/
					  }
					  #div-discover .btn-discover.bg-azure:hover{
					    background-color: white !important;
					    border-color: #2BB0C6 !important;
					    color: #2BB0C6 !important;
					  }
					  #div-discover .btn-discover.bg-red:hover{
					    background-color: white !important;
					    border-color: #E33551 !important;
					    color: #E33551 !important;
					  }
					  .btnSubTitle{
						  margin-bottom:10px; 
						  font-size:13px; 
						  font-weight: 300; height: 95px;
						}
						@media screen and (max-width: 768px) {
						    /*#div-discover .btn-discover.bg-red{
							    font-size: 30px;
							    padding-top: 3px;

							}
							#div-discover .btn-discover {
							    height: 50px;
							    width: 50px;
							    font-size: 25px;
							}
							.btnSubTitle{
							  font-size:14px; font-weight: 100;
							}*/
						}
				</style>
				<?php 
				//center col-xs-12 col-md-4

				if(Yii::app()->session["userId"] && (string)$element["_id"] == Yii::app()->session["userId"] ){ ?>
				<div id="div-discover" class="col-md-4 pull-right">
					<div class="panel panel-white no-padding">
			            <div class="panel-heading text-center border-light">
			                <h3 class="panel-title text-blue"> <i class="fa fa-cogs"></i> Paramètres</h3>
			            </div>
				        <div class="padding-10 text-left">
			               	<div class="panel-body no-padding ">
				                <div class="col-md-12 no-padding" style="margin-top:20px">

				                    <div class="col-xs-6 center text-azure btnSubTitle">
				                        <a href="javascript:;" onclick="$('#profil_avatar').trigger('click');return false;" id="open-multi-tag" class=" btn btn-discover bg-azure">

				                          <i class="fa fa-camera"></i>
				                        </a><br>
				                        <span class="text-azure discover-subtitle"> Image de profil</span>
				                    </div>

				                    <div class="col-xs-6 center text-red btnSubTitle">
					                    <?php if(@$element["address"]["codeInsee"] && !empty($element["address"]["codeInsee"])){ ?>
				                        	<a id="detailMyCity" href="#city.detail.insee.<?php echo $element['address']['codeInsee']; ?>.postalCode.<?php echo $element['address']['postalCode']; ?>" class="lbh btn btn-discover bg-red">
					                    <?php } else { ?>
					                       	<a id="detailMyCity" href="javascript:;" class="detailMyCity btn btn-discover bg-red" onclick="updateLocalityEntities()">
					                    <?php } ?>
				                          	<i class="fa fa-home"></i>
				                        </a><br>
				                        <span class="text-red discover-subtitle"> <?php if(@$element["address"]["codeInsee"] && !empty($element["address"]["codeInsee"])){ echo Yii::t("common","My city"); }  else echo "Communectez-vous"; ?></span>
				                    </div>

				                   
				                    <div class="col-xs-6 center text-dark btnSubTitle">
				                        <a href="javascript:;" class="toggle-scope-dropdown  btn btn-discover bg-dark">
				                          <i class="fa fa-bullseye"></i>
				                        </a><br><span class="text-dark discover-subtitle"> Mes lieux favoris</span>
				                    </div>
				                    <div class="col-xs-6 center text-dark btnSubTitle">
				                        <a href="javascript:;" class="toggle-tag-dropdown  btn btn-discover bg-dark">
				                          <i class="fa fa-tags"></i>
				                        </a><br><span class="text-dark discover-subtitle"> Mes tags favoris</span>
				                    </div>                    
				                </div>
			                </div>
				        </div>
			        </div>

			        <div class="panel panel-white no-padding margin-top-15 ">
				        <div class="panel-heading text-center border-light">
			                <h3 class="panel-title text-blue"> <i class="fa fa-plus"></i> Ajouter</h3>
			            </div>
				        <div class="padding-10">
				            <div id="local-actors-popup-sig">
				              
				              <div class="panel-body no-padding ">

				                <div class="col-md-12 no-padding" style="margin-top:20px">

				                    <div class="col-xs-6  center text-yellow btnSubTitle">
				                        <a href="javascript:elementLib.openForm('person')" class="btn btn-discover bg-yellow">

				                          <i class="fa fa-user"></i>
				                        </a><br/><span class="discover-subtitle">Une personne</span>
				                    </div>
				                    
				                    <div class="col-xs-6  center text-green btnSubTitle">
				                        <a href="javascript:elementLib.openForm('organization')" class="btn btn-discover bg-green">
				                          <i class="fa fa-group"></i>
				                        </a>
				                        <br/><span class="discover-subtitle">Organisation</span>
				                    </div>
									<?php if(!@$front || (@$front && $front["event"])){ ?>
				                    <div class="col-xs-6  center text-orange btnSubTitle">
				                        <a href="javascript:elementLib.openForm('event')" class="btn btn-discover bg-orange">
				                          <i class="fa fa-calendar"></i>
				                        </a><br/><span class="discover-subtitle">Évènement</span>
				                    </div>
				                    <?php } ?>
				                    <div class="col-xs-6  center text-purple btnSubTitle">
				                        <a href="javascript:elementLib.openForm('project')" class="btn btn-discover bg-purple">
				                          <i class="fa fa-lightbulb-o"></i>
				                        </a><br/><span class="discover-subtitle">Projet</span>
				                    </div>
				                </div>
				              </div>
				            </div>
				        </div>
				    </div>
					
					<?php if($type == Person::COLLECTION){ ?>
				    <div class="panel panel-white no-padding margin-top-15 ">	
						<?php $this->renderPartial('../pod/collections',array( 	"collections" => @$element["collections"] )); ?>
					</div>
					<?php } ?>

			    </div>
		<?php 	} 
			} ?>


		<div class="col-md-4 col-xs-12 no-padding pull-right">
			
			<?php if($type != Person::COLLECTION){ ?>
			<div class="col-xs-12">
				<?php $this->renderPartial('../pod/usersList', array(  $controller => $element,
														"users" => $members,
														"userCategory" => Yii::t("common","Community"), 
														"contentType" => $type,
														"countStrongLinks" => $countStrongLinks,
														"countLowLinks" => $countLowLinks,
														"admin" => $edit, 
														"invitedMe" => @$invitedMe,
														"openEdition" => $openEdition));

				/*$this->renderPartial('../pod/usersList', array(  "event"=> $event,
														"users" => $attending,
														"userCategory" => Yii::t("event","ATTENDEES",null,Yii::app()->controller->module->id), 
														"contentType" => Event::COLLECTION,
														"admin" => $admin,
														"countLowLinks" => $invitedNumber,
														"countStrongLinks"=> $attendeeNumber,
														"invitedMe" => @$invitedMe));*/
				?>
			</div>
			<?php } /*?>
			<div class="col-xs-12">
				<?php 
					$urls = ( empty($element["urls"]) ? array() : $element["urls"] ) ;
					$this->renderPartial('../pod/urlsList',array( 	"urls" => $urls, 
																	"contextId" => (String) $element["_id"],
																	"contextType" => $controller,
																	"authorised" => $edit,
																	"openEdition" => $openEdition));
				?>						  
			</div>

			<?php */ if (($type==Project::COLLECTION || $type==Organization::COLLECTION || $type==Event::COLLECTION)){ ?>
				<div class="col-xs-12">
					<?php 
						$contacts = ( empty($element["contacts"]) ? array() : $element["contacts"] ) ;
						$this->renderPartial('../pod/contactsList',array( 	"contacts" => $contacts, 
																			"contextId" => (String) $element["_id"],
																			"contextType" => $controller,
																			"authorised" => $edit,
																			"openEdition" => $openEdition
																		  ));
					?>						  
				</div>
			<?php } ?>


			


	    	<?php if (($type==Project::COLLECTION || $type==Organization::COLLECTION || $type==Event::COLLECTION)){ ?>
	    		<?php if(!@$front || (@$front && $front["event"]==true)){ ?>
				<div class="col-xs-12">
					<?php 
						$organizerImg=false;
						if($type==Event::COLLECTION){ 
							$organizerImg=true;
							if(empty($subEvents)) $subEvents = array();
							$events=$subEvents;
						}
						if(!isset($eventTypes)) $eventTypes = array();
						if(empty($subEvents)) $subEvents = array();
						$this->renderPartial('../pod/eventsList',array( 	"events" => $events, 
																			"contextId" => (String) $element["_id"],
																			"contextType" => $controller,
																			"list" => $eventTypes,
																			"authorised" => $edit,
																			"organiserImgs"=> $organizerImg,
																			"openEdition" => $openEdition
																		  ));
					?>						  
				</div>
				<?php } ?>
			<?php } ?>


			<?php if ($type==Project::COLLECTION || $type==Organization::COLLECTION){ ?>
			<div class="col-xs-12">
				<?php
					if(empty($element["properties"]["chart"])) $element["properties"]["chart"] = array();
					$this->renderPartial('../chart/index',array(
											"itemId" => (string)$element["_id"], 
											"itemName" => $element["name"], 
											"parentType" => $type, 
											"properties" => $element["properties"]["chart"],
											"admin" =>$edit,
											"isDetailView" => 1,
											"openEdition" => $openEdition));
				?>						  
			</div>
			<?php } ?>



			<?php if ($type==Organization::COLLECTION){ 
				if(!@$front || (@$front && $front["project"]))					{ 
			?>
			<div class="col-xs-12">
	 			<?php $this->renderPartial('../pod/projectsList',array( "projects" => @$projects, 
														"contextId" => (String) $element["_id"],
														"contextType" => $type,
														"authorised" =>	$edit,
														"openEdition" => $openEdition
				)); ?>
			</div>
			<?php }
			} ?>
			<?php if($type==Project::COLLECTION || $type==Organization::COLLECTION || $type==Event::COLLECTION  || $type==Person::COLLECTION ){ 
				if(!@$front || (@$front && $front["poi"]))					{ 
			?> 
			<div class="col-xs-12">
				<?php   
				$pois = PHDB::find(Poi::COLLECTION,array("parentId"=>(String) $element["_id"],"parentType"=>$type));
				$this->renderPartial('../pod/POIList', array( "pois"=>$pois));
				?>
	    	</div>	
	    	
			<div class="col-xs-12">
				<?php 
				//$classifieds = PHDB::find( Classified::COLLECTION,array("parentId"=>(String) $element["_id"],"parentType"=>$type));
				//$this->renderPartial('../pod/classifieds', array( "pois"=>$classifieds));
				?>
	    	</div>	
	    	<?php }

		    } ?>
	    	<?php if( $type!=Event::COLLECTION && ( !@$front || (@$front && $front["need"]==true))){ ?>
	    	<div class="col-xs-12 needsPod">	
				<?php $this->renderPartial('../pod/needsList',array( 	"needs" => @$needs, 
																		"parentId" => (String) $element["_id"],
																		"parentType" => $type,
																		"isAdmin" => @$edit,
																		"parentName" => $element["name"],
																		"openEdition" => $openEdition
																	  )); ?>

			</div>
			<?php } ?>

			
		</div>

		<div class="col-md-8 col-xs-12 no-padding pull-left">
			<?php if($type==Project::COLLECTION || $type==Organization::COLLECTION){ ?> 
			
			<?php 
				if(!@$front || (@$front && $front["dda"]==true)){ 
				$rooms = ActionRoom::getAllRoomsActivityByTypeId($type, (string)$element["_id"]);	
				$this->renderPartial('../pod/activityList2',array(    
	   					"parent" => $element, 
	                    "parentId" => (string)$element["_id"], 
	                    "parentType" => $type, 
	                    "title" => "Espace coopératif (activité récente)",
                    	"list" => @$rooms, 
	                    "renderPartial" => true
	                    ));
				}
			}
			?>
			<?php if($type==Project::COLLECTION){ ?> 
			    <hr>
			    <div class="timesheetphp"></div>
			<?php } ?>
			<?php if($type==Event::COLLECTION){ ?> 
			<div class="col-xs-12 no-padding calendar pull-left"></div>
			<div class="col-xs-12 no-padding timesheetphp pull-left"></div>
			<?php } ?>
		</div>
		<?php } ?>
    	
	</div>
</div>
<?php if(!isset($_GET["renderPartial"])){ ?>
</div>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function() {
	activeMenuElement("detail");
	<?php 
		if(empty($element["tasks"])) $element["tasks"] = array();
		if($type == Project::COLLECTION) {//|| $admin==true){ ?>
		getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo 
			$type ?>/id/<?php echo $element["_id"] ?>/isAdmin/false/isDetailView/1",null,"html");
	<?php } ?>


	<?php if($type == Event::COLLECTION){ ?>
		getAjax(".calendar",baseUrl+"/"+moduleId+"/event/calendarview/id/<?php echo $element["_id"] ?>/pod/1?date=1",null,"html");
	<?php } ?>

	<?php if($type == Person::COLLECTION && $element["_id"] == Yii::app()->session["userId"]){ ?>
	$("#menu-btn-my-profil").addClass("selected");
	<?php } ?>
});

/*$(".detailMyCity").click(function () { 
	updateLocalityEntities();
});*/

</script>
