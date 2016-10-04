<?php 
$cssAnsScriptFilesTheme = array(
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	'/assets/plugins/x-editable/css/bootstrap-editable.css',
	//X-editable...
	'/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/assets/plugins/x-editable/js/bootstrap-editable.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/assets/plugins/wysihtml5/wysihtml5.js',
	'/assets/plugins/moment/min/moment.min.js',
	'/assets/plugins/Chart.js/Chart.min.js',
	'/assets/plugins/jquery.qrcode/jquery-qrcode.min.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);
$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js',
	'/js/activityHistory.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
$cssAnsScriptFilesModuleSS = array(
	'/plugins/Chart.js/Chart.min.js',
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModuleSS,Yii::app()->theme->baseUrl."/assets");
?>

<style>
	.info-shortDescription a{
		font-size:14px;
		font-weight: 300;
	}
	a#shortDescription{
		font-size: 15px !important;
		font-weight: 200;
		/*color: white;*/
	}
progress[value] {
    /* Get rid of the default appearance */
    appearance: none;   
    /* This unfortunately leaves a trail of border behind in Firefox and Opera. We can remove that by setting the border to none. */
    border: none;
    /* Add dimensions */
	width: 100%; height: 20px;
    /* Although firefox doesn't provide any additional pseudo class to style the progress element container, any style applied here works on the container. */
    background-color: whiteSmoke;
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
    /* Of all IE, only IE10 supports progress element that too partially. It only allows to change the background-color of the progress value using the 'color' attribute. */
    color: royalblue;
    position: relative;
}
/*
Webkit browsers provide two pseudo classes that can be use to style HTML5 progress element.
-webkit-progress-bar -> To style the progress element container
-webkit-progress-value -> To style the progress element value.
*/

progress[value]::-webkit-progress-bar {
    background-color: whiteSmoke;
    border-radius: 3px;
    box-shadow: 0 2px 3px rgba(0,0,0,.5) inset;
}

progress[value]::-webkit-progress-value {
    position: relative;
    
    background-size: 35px 20px, 100% 100%, 100% 100%;
    border-radius:3px;
    
    /* Let's animate this */
    animation: animate-stripes 5s linear infinite;
}

@keyframes animate-stripes { 100% { background-position: -100px 0; } }

/* Firefox provides a single pseudo class to style the progress element value and not for container. -moz-progress-bar */
progress[value]::-moz-progress-bar {
    /* Gradient background with Stripes */
    background-image:
    -moz-linear-gradient( 135deg,
	    transparent,
	    transparent 33%,
	    rgba(0,0,0,.1) 33%,
	    rgba(0,0,0,.1) 66%,
	    transparent 66%),
    -moz-linear-gradient( top,
        rgba(255, 255, 255, .25),
        rgba(0,0,0,.2)),
    -moz-linear-gradient( left, #09c, #f44);    
    background-size: 35px 20px, 100% 100%, 100% 100%;
    border-radius:3px;
    /* Firefox doesn't support CSS3 keyframe animations on progress element. Hence, we did not include animate-stripes in this code block */
}

.progressStyle::-webkit-progress-value
{
    /* Gradient background with Stripes */
    background-image:
    -webkit-linear-gradient( 135deg,
        transparent,
	    transparent 33%,
	    rgba(0,0,0,.1) 33%,
	    rgba(0,0,0,.1) 66%,
	    transparent 66%),
    -webkit-linear-gradient( top,
        rgba(255, 255, 255, .25),
        rgba(0,0,0,.2)),
    -webkit-linear-gradient( left, #09c, #ff0);
}

	/*.panel-title{
		font-weight: 200;
		font-size: 21px;
		font-family: "homestead";
	}*/

	.entityTitle{
      background-color: #FFF; /*#EFEFEF; /*#2A3A45;*/
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      overflow-x: hidden; 
      font-size: 30px;
	  font-weight: 200;
  	  margin:0px !important;
  	  text-align: left;
    }
    .entityDetails span{
      font-weight: 300;
      font-size:15px;

    }
    .entityDetails{
      padding-bottom:10px;
      margin-bottom:10px;
      border-bottom:0px solid #DDD;
      font-size: 15px;
	  font-weight: 300;
    }
    .entityDetails.bottom{
      /*border-top:1px solid #DDD;*/
      border-bottom:0px solid #DDD;
      padding: 5px;
      margin-top: 10px;
      margin-bottom: -13px;
    }
    /*.entityDetails i.fa-tag{
      margin-left:10px;
    }*/
    .entityDetails i.fa{
      margin-right:7px;
      font-size: 17px;
	  margin-top: 5px;
    }
    /*.panel-title{
    	font-weight: 200;
    	font-size: 21px;
    	font-family: "homestead";
    }*/
    #fileuploadContainer{
    	z-index:0 !important;
    }
    .tag_group{
    	font-size:14px;
    	font-weight: 300;
    }
    .lbl-info-details{
    	font-weight: 600;
	    border-bottom: 1px solid lightgray;
	    padding-bottom: 7px;
	    margin-bottom: 5px;
	    width:100%;
	    float:left;
	}
	 
    
    a.url-clickable{
    	text-decoration: underline !important;
    	cursor: pointer !important;
    }
    a.url-clickable:hover{
    	text-decoration: none !important;
    }

    blockquote {
	    margin: 0 0 10px;
	    font-size: 15px;
	    line-height: 1.2;
	}
    .panel-heading{
    	padding: 7px 10px 5px 10px;
		min-height: 25px;
    }
    .panel-title{
    	font-weight: 200;
    	font-size: 15px;
    	/*font-family: "homestead";*/
    }
    .panel-scroll {
	    height: unset !important;
	    min-height:25px;
	}

</style>

	<div class="panel-heading border-light">
		<h4 class="panel-title text-dark">
				<i class="fa fa-info-circle"></i> 
				<?php echo Yii::t("project","Project description",null,Yii::app()->controller->module->id) ?>
				<?php if ($openEdition==true) { ?>
					<span class="pull-right tooltips text-green" data-toggle="tooltip" data-placement="top" title="Tous les utilisateurs ont la possibilité de participer / modifier les informations." style=""><i class="fa fa-creative-commons"></i> <?php echo Yii::t("common","Open edition") ?></span>
					
				<?php } ?>
		</h4>
		<!-- <div class="navigator padding-0 text-right"> -->
			
		<!-- </div> -->
	</div>
	<div class="panel-tools">
		<?php if (($isAdmin || $openEdition) && isset(Yii::app()->session["userId"])) { ?>
			<a href="javascript:" id="editProjectDetail" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Compléter ou corriger les informations de ce projet" alt=""><i class="fa fa-pencil"></i><span class="hidden-xs"> <?php echo Yii::t("common","Edit") ?></span></a>
			<!--<a href="javascript:" id="editGeoPosition" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Modifier la position géographique" alt=""><i class="fa fa-map-marker"></i><span class="hidden-xs"> Modifiez la position géographique</span></a>-->
			<?php }

			if($isAdmin){ ?>
			<a href='javascript:' class='btn btn-sm btn-default editConfidentialityBtn tooltips' data-toggle="tooltip" data-placement="bottom" title="Paramètre de confidentialité" alt="">
				<i class='fa fa-cog'></i> 
				<span class="hidden-sm hidden-xs">
				<?php echo Yii::t("common","Settings"); ?>
				</span>
			</a>
		<?php }
			if ($openEdition) { ?>
			<a href="javascript:" id="getHistoryOfActivities" class="btn btn-sm btn-light-blue tooltips" onclick="getHistoryOfActivities('<?php echo (string)$project["_id"] ?>','<?php echo Project::COLLECTION ?>');" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("activityList","See modifications"); ?>" alt=""><i class="fa fa-history"></i><span class="hidden-xs"> <?php echo Yii::t("common","History")?></span></a>
		<?php } ?>
		
		<a class="btn btn-sm btn-default tooltips" href="javascript:;" onclick=" showDefinition('qrCodeContainerCl',true)" data-toggle="tooltip" data-placement="bottom" title="Show the QRCode for this organization"><i class="fa fa-qrcode"></i> QR Code</a>

		<style type="text/css">
			.badgePH{ 
				cursor: pointer;
				display: inline-block;
				margin-right: 10px;
				/*margin-bottom: 10px;*/
			}
			/*.badgePH .fa-stack .main { font-size:2.2em;margin-left:10px;margin-top:20px}*/
			.badgePH .fa-stack .main { font-size:2.2em}
			.badgePH .fa-stack .mainTop { 
				/*margin-left:10px;*/
				margin-top:-3px}
			.badgePH .fa-stack .fa-circle-o{ font-size:4em;}
			/* Tooltip container */
			.opendata .mainTop{
			    color: black;
			    font-size: 1.3em;
			    padding: 5px;
			}
			.opendata .main{
			    color: #00cc00;
			}
		</style>

		<?php if(!empty($project["badges"])){?>
			<?php if( Badge::checkBadgeInListBadges("opendata", $project["badges"]) ){?>
				<div class="badgePH pull-right" data-title="OPENDATA">
					<span class="fa-stack tooltips opendata" style="maring-bottom:5px" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("badge","opendata", null, Yii::app()->controller->module->id)?>'>
						<i class="fa fa-database main fa-stack-1x text-orange"></i>
						<i class="fa fa-share-alt  mainTop fa-stack-1x text-black"></i>
					</span>
				</div>
		<?php } 
		} ?>
	</div>


	<style type="text/css">
		.urlOpenData{
		    padding: 9px;
		}
	</style>
	<div class="modal fade" role="dialog" id="modal-confidentiality">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-cog"></i> Confidentialité de vos informations personnelles</h4>
	      </div>
	      <div class="modal-body">
	        <!-- <h3><i class="fa fa-cog"></i> Paramétrez la confidentialité de vos informations personnelles :</h3> -->
	        <div class="row">
	        	<div class="pull-left text-left padding-10" style="border: 1px solid rgba(128, 128, 128, 0.3); margin-left: 10px; margin-bottom: 20px;">
	        		<!--<strong><i class="fa fa-group"></i> Public</strong> : visible pour tout le monde<br/>
	        		<strong><i class="fa fa-user-secret"></i> Privé</strong> : visible pour mes contacts seulement<br/>
	        		<strong><i class="fa fa-ban"></i> Masqué</strong> : visible pour personne<br/>-->
	        		<strong><i class="fa fa-group"></i> Open Data</strong> : Vous proposez vos données en accès libre, afin de contribuer au bien commun.<br/>
	        		<strong><i class="fa fa-group"></i> Open Edition</strong> : Tous les utilisateurs ont la possibilité de participer / modifier les informations.<br/>
	        	</div>
		    </div>
		    <div class="row text-dark panel-btn-confidentiality">
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Open Data :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-isOpenData inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="true"><i class="fa fa-group"></i> Oui</button>
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="false"><i class="fa fa-user-secret"></i> Non</button>
						<a href="<?php echo Yii::app()->baseUrl.'/communecter/data/get/type/projects/id/'.$project['_id'] ;?>" data-toggle="tooltip" title='Visualiser la données' id="urlOpenData" class="urlOpenData" target="_blank"><i class="fa fa-eye"></i></a>
					</div>
		        </div>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Open Edition :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-isOpenEdition inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="isOpenEdition" value="true"><i class="fa fa-group"></i> Oui</button>
		        		<button class="btn btn-default confidentialitySettings" type="isOpenEdition" value="false"><i class="fa fa-user-secret"></i> Non</button>
					</div>
		        </div>
	        </div>
	      </div>
	      
	      <script type="text/javascript">
			<?php
				//Params Checked
				$typePreferences = array("privateFields", "publicFields");
				$fieldPreferences["isOpenData"] = true;
				$typePreferencesBool = array("isOpenData", "isOpenEdition");
				//To checked private or public
				foreach($typePreferences as $type){
					foreach ($fieldPreferences as $field => $hidden) {
						if(isset($project["preferences"][$type]) && in_array($field, $project["preferences"][$type])){
							echo "$('.btn-group-$field > button[value=\'".str_replace("Fields", "", $type)."\']').addClass('active');";
							$fieldPreferences[$field] = false;
						} 
					}
				}

				//To checked if there are hidden
				foreach ($fieldPreferences as $field => $hidden) {
					if($hidden) echo "$('.btn-group-$field > button[value=\'hide\']').addClass('active');";
				}
				foreach ($typePreferencesBool as $field => $typePrefB) {
					if(isset($project["preferences"][$typePrefB]) && $project["preferences"][$typePrefB] == true)
						echo "$('.btn-group-$typePrefB > button[value=\'true\']').addClass('active');";	
					else
						echo "$('.btn-group-$typePrefB > button[value=\'false\']').addClass('active');";
				}	
			?> 
	     </script>


	      <div class="modal-footer">
	        <button type="button" class="btn btn-success lbh" data-dismiss="modal" aria-label="Close" data-hash="#project.detail.id.<?php echo $project['_id'] ;?>">OK</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<div id="activityContent" class="panel-body no-padding hide">
		<h2 class="homestead text-dark" style="padding:40px;">
			<i class="fa fa-spin fa-refresh"></i> Chargement des activités ...
		</h2>
	</div>
	<div class="panel-body padding-20" id="contentGeneralInfos">
		<div class="col-sm-6 col-xs-6 text-dark padding-10">
			<?php
				$this->renderPartial('../pod/fileupload', array("itemId" => (string)$project["_id"],
																  "type" => Project::COLLECTION,
																  "resize" => false,
																  "contentId" => Document::IMG_PROFIL,
																  "editMode" => Authorisation::canEditItem(Yii::app()->session["userId"], Project::COLLECTION,(String) $project["_id"]),
																  "image" => $imagesD)); 
			?>
			<div class="col-md-12 text-dark no-padding" style="margin-top:10px;">
					<a  href="#" id="avancement" data-type="select" data-title="avancement" 
						data-original-title="<?php echo Yii::t("project","Enter the project's maturity",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Project maturity") ?>"
						class="entityDetails editable editable-click">
						<?php if(isset($project["properties"]["avancement"])){ 
							//idea => concept => Started => development => testing => mature
							if($project["properties"]["avancement"]=="idea")
								$val=5;
							else if($project["properties"]["avancement"]=="concept")
								$val=20;
							else if ($project["properties"]["avancement"]== "started")
								$val=40;
							else if ($project["properties"]["avancement"] == "development")
								$val=60;
							else if ($project["properties"]["avancement"] == "testing")
								$val=80;
							else 
								$val=100;
							echo Yii::t("project",$project["properties"]["avancement"],null,Yii::app()->controller->module->id);
						} ?>
					</a>
					<?php if(isset($project["properties"]["avancement"])){ ?>
					<progress max="100" value="<?php echo $val;?>" class="progressStyle">
					</progress>
					<?php } else { ?>
					<progress max="100" value="0" class="progressStyle hide">
					</progress>

					<?php } ?>
			</div>
		</div>
		<div class="col-sm-6 col-xs-6 text-dark padding-20" style="padding-top:0px!important;">
			<div class="row text-dark" style="margin-top:10px !important;">
				<div class="entityTitle">
					<h2  style="font-weight:100; font-size:17px;">
						<a href="#" id="name" data-type="text" 
								  data-original-title="<?php echo Yii::t("project","Enter the project's name",null,Yii::app()->controller->module->id) ?>" 
								  class="entityTitle editable-project editable editable-click">
									<?php if(isset($project["name"]))echo $project["name"];?>
						</a>
					</h2>
				</div>
				<div class="info-shortDescription" style="word-wrap:break-word;">
					<a href="javascript:;" id="shortDescription" data-placement="bottom" data-type="wysihtml5" data-showbuttons="true" data-title="<?php echo Yii::t("common","Short Description") ?>" 
						data-emptytext="<?php echo Yii::t("common","Short Description") ?>" class="editable editable-click">
						<?php echo (isset($project["shortDescription"])) ? $project["shortDescription"] : null; ?>
					</a>
				</div>

				<?php 
					$address = (isset( $project["address"]["streetAddress"])) ? $project["address"]["streetAddress"] : "";
					$address2 = (isset( $project["address"]["postalCode"])) ? $project["address"]["postalCode"] : "";
					$address2 .= (isset( $project["address"]["addressCountry"])) ? ", ".OpenData::$phCountries[ $project["address"]["addressCountry"] ] : "";

					$this->renderPartial('../pod/qrcode',array(
															"type" => @$project['type'],
															"name" => @$project['name'],
															"address" => $address,
															"address2" => $address2,
															"email" => @$project['email'],
															"img"=>@$project['profilThumbImageUrl']));
				?>

			</div>
		</div>
		<div class="col-md-12 no-padding">	
			<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Coordonnées</div>
			<div class="row info-coordonnees entityDetails text-dark" style="margin-top: 10px !important;">
				<div class="col-md-6 col-sm-6">	
					<i class="fa fa-road fa_streetAddress hidden"></i> 
					<a href="#" id="streetAddress" data-type="text" data-title="<?php echo Yii::t("common","Street Address") ?>" data-emptytext="<?php echo Yii::t("common","Street Address") ?>" class="editable-project editable editable-click">
						
						<?php echo (isset( $project["address"]["streetAddress"])) ? $project["address"]["streetAddress"] : null; ?>
					</a>
					<br>
					<i class="fa fa-bullseye"></i> 
					<a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom"></a>
					<br>
					<i class="fa fa-globe fa_addressCountry  hidden"></i> 
					<a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click"></a>
					<br>
					<a href="javascript:" id="btn-update-geopos" class="btn btn-primary btn-sm hidden" style="margin: 10px 0px;">
						<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner
					</a>
				</div>
				<div class="col-md-6 col-sm-6">
					<i class="fa fa-calendar"></i> 
					<?php if(!empty($project["startDate"])) echo Yii::t("common","From") ; ?> <a href="#" id="startDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's start",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a> 
					<label id="labelTo"><?php echo Yii::t("common","To"); ?></label> <a href="#" id="endDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's end",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a><br>
					<i class="fa fa-file-text-o"></i>
					<a href="#" id="licence" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's licence",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Project licence") ?>" class="editable-project editable editable-click"><?php if(isset($project["licence"])) echo $project["licence"];?></a><br>
					<i class="fa fa-desktop"></i> 
					<a href="<?php if(isset($project["url"])) echo $project["url"]; else echo "#";?>" target="_blank" id="url" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's url",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Website URL") ?>" class="editable-project editable editable-click <?php if(isset($project["url"])) echo "url-clickable";?>"><?php if(isset($project["url"])) echo $project["url"];?></a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
				<a href="#" id="description" data-type="wysihtml5" data-original-title="<?php echo Yii::t("project","Enter the project's description",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Description") ?>" class="editable editable-click"></a>	
			</div>
		</div>
		<div class="row tag_group">
			<div class="col-md-12 padding-20 text-red text-right pull-right">
				<i class="fa fa-tags"></i> Tags :
				<a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="text-red editable editable-click"></a>
			</div>
		</div>
	</div>
		<div class="hidden" id="entity-insee-value" 
			 insee-val="<?php echo (isset( $project["address"]["codeInsee"])) ? $project["address"]["codeInsee"] : ""; ?>">
		</div>
		<div class="hidden" id="entity-cp-value" 
			 cp-val="<?php echo (isset( $project["address"]["postalCode"])) ? $project["address"]["postalCode"] : ""; ?>">
		</div>



		

	
<script type="text/javascript">
var projectData = <?php echo json_encode($project)?>;
var mode = "update";
var projectId= "<?php echo (string) $project["_id"]; ?>";
var countries = <?php echo json_encode($countries); ?>;
var startDate = '<?php if(isset($project["startDate"])) echo $project["startDate"]; else echo ""; ?>';
var endDate = '<?php if(isset($project["endDate"])) echo $project["endDate"]; else echo "" ?>';
var imagesD = <?php echo(isset($imagesD)) ? json_encode($imagesD) : null; ?>;
//var contentKeyBase = "<?php echo isset($contentKeyBase) ? $contentKeyBase : ""; ?>";
if(imagesD != null){
	var images = imagesD;
}

jQuery(document).ready(function() 
{
    bindAboutPodProjects();
	initXEditable();
	manageModeContext();
	debugMap.push(projectData);
	console.log("endDate",$('#endDate').val());
	console.dir(projectData);
	$("#btn-update-geopos").click(function(){
		findGeoPosByAddress();
	});


	$(".panel-btn-confidentiality .btn").click(function(){
		var type = $(this).attr("type");
		var value = $(this).attr("value");
		$(".btn-group-"+type + " .btn").removeClass("active");
		$(this).addClass("active");
	});
	buildQRCode("project","<?php echo (string)$project["_id"]?>");
	
		//getAjax(".timesheetphp",baseUrl+"/"+moduleId+"/gantt/index/type/<?php echo Project::COLLECTION ?>/id/<?php echo (string)$project["_id"]?>/isAdmin/<?php echo $isAdmin?>",null,"html");
});



function bindAboutPodProjects() {
	$("#editProjectDetail").on("click", function(){
		if($("#getHistoryOfActivities").find("i").hasClass("fa-arrow-left"))
			getBackDetails(projectId,"<?php echo Project::COLLECTION ?>");
		switchMode();
	});

	$("#editGeoPosition").click(function(){
		Sig.startModifyGeoposition(projectId, "projects", projectData);
		showMap(true);
	});

	$(".editConfidentialityBtn").click(function(){
    	console.log("confidentiality");
    	$("#modal-confidentiality").modal("show");
    });

    $(".confidentialitySettings").click(function(){
    	param = new Object;
    	param.type = $(this).attr("type");
    	param.value = $(this).attr("value");
    	param.typeEntity = "projects";
    	param.idEntity = projectId;
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/project/updatesettings",
	        data: param,
	       	dataType: "json",
	    	success: function(data){
		    	toastr.success(data.msg);
		    }
		});
	});

}

function initXEditable() {
	$.fn.editable.defaults.mode = 'popup';
	$('.editable-project').editable({
    	url: baseUrl+"/"+moduleId+"/project/updatefield", //this url will not be used for creating new job, it is only for update
    	showbuttons: false,
    	success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);
				loadActivity=true;	
	        }
	        else
	        	toastr.error(data.msg);  
	    }
	});
    //make jobTitle required
	$('#name').editable('option', 'validate', function(v) {
    	if(!v) return 'Required field!';
	});

	$('#description').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		value: <?php echo (isset($project["description"])) ? json_encode($project["description"]) : "''"; ?>,
		placement: 'bottom',
		mode: 'popup',
		wysihtml5: {
			html: true,
			video: false,
			image: false
		},
		success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);
				loadActivity=true;	
	        }else
	        	toastr.error(data.msg);  
	    },
	});
	$('#shortDescription').editable({
			url: baseUrl+"/"+moduleId+"/project/updatefield",
			wysihtml5: {
				color: false,
				html: false,
				video: false,
				image: false,
				table : false
			},
			validate: function(value) {
			    console.log(value);
			    if($.trim(value).length > 140) {
			        return 'La description courte ne doit pas dépasser 140 caractères.';
			    }
			},
			success : function(data) {
		        if(data.result) {
		        	toastr.success(data.msg);
					loadActivity=true;	
		        }else {
					return (data.msg);
			    }  
		    }
		});
	$('#startDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		type: "date",
		mode: "popup",
		placement: "bottom",
		format: 'yyyy-mm-dd',
		viewformat: 'dd/mm/yyyy',
		datepicker: {
			weekStart: 1,
		},
		success : function(data) {
			if(data.result) {
				toastr.success(data.msg);
				loadActivity=true;	
			}else 
				return data.msg;
	    }
	});

	$('#endDate').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		type: "date",
		mode: "popup",
		placement: "bottom",
		format: 'yyyy-mm-dd',   
    	viewformat: 'dd/mm/yyyy',
    	datepicker: {
            weekStart: 1,
       },
       success : function(data) {
	        if(data.result) {
	        	toastr.success(data.msg);
				loadActivity=true;	
	        }else 
				return data.msg;
	    }
    });
    var formatDate = "YYYY-MM-DD";
    $('#startDate').editable('setValue', moment(startDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
	$('#endDate').editable('setValue', moment(endDate, "YYYY-MM-DD HH:mm").format(formatDate), true);


    //Select2 tags
	$('#tags').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		mode: 'popup',
		value: <?php echo (isset($project["tags"])) ? json_encode(implode(",", $project["tags"])) : "''"; ?>,
		select2: {
			width: 200,
			tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
			tokenSeparators: [","]
		},
		success : function(data) {
			if(data.result) {
				toastr.success(data.msg);
				loadActivity=true;	
			}else 
				return data.msg;
	    }
	});

	$('#address').editable({
		validate: function(value) {
                value.streetAddress=$("#streetAddress").text();
                console.log(value);
        },
		url: baseUrl+"/"+moduleId+"/project/updatefield",
		mode: 'popup',
		// success: function(response, newValue) {
		// 	console.log("success update postal Code : "+newValue);
			
		// },
		value : {
        	postalCode: '<?php echo (isset( $project["address"]["postalCode"])) ? $project["address"]["postalCode"] : null; ?>',
        	codeInsee: '<?php echo (isset( $project["address"]["codeInsee"])) ? $project["address"]["codeInsee"] : ""; ?>',
        	addressLocality : '<?php echo (isset( $project["address"]["addressLocality"])) ? $project["address"]["addressLocality"] : ""; ?>',
    	},
    	success : function(data, newValue) {
			if(data.result) {
				toastr.success(data.msg);
				$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
				$("#entity-cp-value").attr("cp-val", newValue.postalCode);
				loadActivity=true;	
			}
			else {
				return data.msg;
			}
	    }
	});

	$('#addressCountry').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		value: '<?php echo (isset( $project["address"]["addressCountry"])) ? $project["address"]["addressCountry"] : ""; ?>',
		source: function() {
			return countries;
		},
		success : function(data) {
			if(data.result) {
				toastr.success(data.msg);
				loadActivity=true;	
			}
			else 
				return data.msg;
	    }
	});
	$('#avancement').editable({
		url: baseUrl+"/"+moduleId+"/project/updatefield", 
		source: function() {
			//idea => concept => Started => development => testing => mature
			avancement=["idea","concept","started","development","testing","mature"];
			return avancement;
		},
		success : function(data) {
			if(data.result) {
				toastr.success(data.msg);
				loadActivity=true;	
				if(data.avancement=="idea")
					val=5;
				else if(data.avancement=="concept")
					val=20;
				else if (data.avancement== "started")
					val=40;
				else if (data.avancement == "development")
					val=60;
				else if(data.avancement == "testing")
					val=80;
				else
					val=100;
				$('.progressStyle').val(val);
			}
			else 
				return /*data.msg*/ "erreur";
	    }
	});

}

function switchMode() {
	if(mode == "view"){
		mode = "update";
		manageModeContext();
	} else {
		mode ="view";
		manageModeContext();
	}
	
}

function manageModeContext() {
	listXeditables = ['#description', '#startDate', '#endDate', '#tags', '#address', '#addressCountry','#avancement',"#shortDescription"];
	if (mode == "view") {
		$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		});
		if(endDate == "")
			$("#labelTo").removeClass("hidden");
		$("#btn-update-geopos").removeClass("hidden");
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-project').editable('option', 'pk', projectId);
		$('.editable-project').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			//alert(listXeditables[i]);
			$(value).editable('option', 'pk', projectId);
			$(value).editable('toggleDisabled');
		});

		
		if(endDate == "")
			$("#labelTo").addClass("hidden");
			$("#btn-update-geopos").addClass("hidden");
		}
		if($('#streetAddress').html() != "")	{ 
			$(".fa_streetAddress").removeClass("hidden"); } else { $(".fa_streetAddress").addClass("hidden"); }
		if($('#postalCode').html() != "")		
			{ $(".fa_postalCode").removeClass("hidden"); } else { $(".fa_postalCode").addClass("hidden"); }
		if($('#addressCountry').html() != "")	
			{ $(".fa_addressCountry").removeClass("hidden"); } else { $(".fa_addressCountry").addClass("hidden"); }
}

	
	//modification de la position geographique	

	function findGeoPosByAddress(){
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			if ($("#entity-insee-value").attr("insee-val") != ""){
				var insee = $("#entity-insee-value").attr("insee-val");
				var postalCode = $("#entity-cp-value").attr("cp-val");
			}
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee, null,postalCode);
		//si on a une streetAddress
		}else{
			var request = "";

			//recuperation des données de l'addresse
			var street 			= ($("#streetAddress").html()  != $("#streetAddress").attr("data-emptytext"))  ? $("#streetAddress").html() : "";
			var address 		= ($("#address").html() 	   != $("#address").attr("data-emptytext")) 	   ? $("#address").html() : "";
			var addressCountry 	= ($("#addressCountry").html() != $("#addressCountry").attr("data-emptytext")) ? $("#addressCountry").html() : "";
			
			//construction de la requete
			request = addToRequest(request, street);
			request = addToRequest(request, address);
			request = addToRequest(request, addressCountry);

			request = transformNominatimUrl(request);
			request = "?q=" + request;
			console.log(request);
			findGeoposByNominatim(request);
		}
	
	}

	//quand la recherche nominatim a fonctionné
	function callbackNominatimSuccess(obj){
		console.log("callbackNominatimSuccess");
		console.log(obj);
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//met à jour la nouvelle position dans la donnée
			projectData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };
			//et on affiche le marker sur la carte à cette position
			showGeoposFound(coords, projectId, "projects", projectData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			if ($("#entity-insee-value").attr("insee-val") != ""){
				var insee = $("#entity-insee-value").attr("insee-val");
				var postalCode = $("#entity-cp-value").attr("cp-val");
			}
			//console.log(postalCode);
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee, null,postalCode);
		}
	}

	//en cas d'erreur nominatim
	function callbackNominatimError(error){
		console.log("callbackNominatimError");
	}

	//quand la recherche par code insee a fonctionné
	function callbackFindByInseeSuccess(obj){
		console.log("callbackFindByInseeSuccess");
		//si on a bien un résultat
		if (typeof obj != "undefined" && obj != "") {
			//récupère les coordonnées
			var coords = Sig.getCoordinates(obj, "markerSingle");
			//si on a une geoShape on l'affiche
			if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
			console.log(obj);
			projectData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, projectId, "projects", projectData);
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		console.log("erreur getlatlngbyinsee");
	}
	
</script>