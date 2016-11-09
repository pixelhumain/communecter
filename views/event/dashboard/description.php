<?php 

$cssAnsScriptFilesTheme = array(
//X-editable...
'/plugins/x-editable/css/bootstrap-editable.css',
'/plugins/x-editable/js/bootstrap-editable.js',

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
 
'/plugins/jquery.qrcode/jquery-qrcode.min.js'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);

$cssAnsScriptFilesModule = array(
	//Data helper
	'/js/dataHelpers.js',
	'/js/postalCode.js',
	'/js/activityHistory.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style type="text/css">
	.selectEv{
		min-width: 200px;
	}

	
	.entityTitle{
      background-color: #FFF; /*#EFEFEF; /*#2A3A45;*/
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      font-weight: 200;
    }
    .entityTitle h2{
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
    .entityDetails i.fa-tag{
      margin-left:10px;
    }
    .entityDetails i.fa{
      margin-right:7px;
      font-size: 17px;
		margin-top: 5px;
    }

    .fileupload{
    	margin-bottom:0px !important;
    }

    .lbl-betatest{
    	margin:10px;
    	position: absolute;
		right: 5px;
    }
    .panel-title{
    	font-weight: 200;
    	font-size: 21px;
    	font-family: "homestead";
    }
    #fileuploadContainer{
    	z-index:0 !important;
    }
    .tag_group{
    	font-size:14px;
    	font-weight: 300;
    }

    .editable-pre-wrapped {
	    white-space: normal;
	    padding:30px; 
	}

	 .lbl-info-details{
    	font-weight: 600;
	    border-bottom: 1px solid lightgray;
	    padding-bottom: 7px;
	    margin-bottom: 5px;
	    width:100%;
	    float:left;
	}
	#profil_imgPreview{
      max-height:400px;
      width:100%;
      border-radius: 5px;
      /*border:3px solid #93C020;*/
      /*border-radius:  4px 4px 0px 0px;*/
      margin-bottom:0px;
     

    }
    .entityDetails .ico-type-account {
    	margin-left: -10px;
		border-radius: 3px 0px 0px 3px;
	}
	.entityDetails .thumbnail-profil {
	   height:75px !important;
	   width:75px !important;
	}
</style>
<div class="panel panel-white" id="globProchEvent">
	<div class="panel-heading border-light">
		<h4 class="panel-title text-left text-dark ficheInfoTitle">
			<i class="fa fa-info-circle"></i> <?php echo Yii::t("common","General infos") ?>
			<?php if ($openEdition==true) { ?>
				<span class="pull-right tooltips" data-toggle="tooltip" data-placement="top" title="Tous les utilisateurs ont la possibilité de participer / modifier les informations." style="font-family:initial;font-size: 15px; line-height: 30px;"><i class="fa fa-creative-commons"></i> <?php echo Yii::t("common","Open edition") ?></span>

			<?php } ?>
		</h4>
	</div>
	<div class="navigator padding-0 text-right">
		<div class="panel-tools">
		<?php 
			if( ($edit || $openEdition ) && isset(Yii::app()->session["userId"])) { ?>
				<a href="javascript:" id="editEventDetail" class="btn btn-sm btn-light-blue tooltips" data-toggle="tooltip" data-placement="bottom" title="Editer l'événement" alt=""><i class="fa fa-pencil"></i><span class="hidden-xs"> <?php echo Yii::t("common","Edit") ?></span></a>
			<!--<a href="javascript:" id="editGeoPosition" class="btn btn-sm btn-light-blue tooltips" data-toggle="tooltip" data-placement="bottom" title="Modifiez la position sur la carte" alt=""><i class="fa fa-map-marker"></i><span class="hidden-xs"> Modifier la position</span></a>-->
		<?php }

			if($edit){ ?>
				<a href='javascript:' class='btn btn-sm btn-default editConfidentialityBtn tooltips' data-toggle="tooltip" data-placement="bottom" title="Paramètres de confidentialité" alt="">
					<i class='fa fa-cog'></i> 
					<span class="hidden-sm hidden-xs">
					<?php echo Yii::t("common","Settings"); ?>
					</span>
				</a>
			<!--<a href="javascript:" id="removeEvent" class="btn btn-sm btn-red btn-light-red tooltips removeEventBtn" data-toggle="tooltip" data-placement="bottom" title="Delete this event" alt=""><i class="fa fa-times"></i><span class="hidden-xs"> Annuler l'événement</span></a>-->
    	<?php } 

    		if ($openEdition==true) { ?>
				<a href="javascript:" id="getHistoryOfActivities" class="btn btn-sm btn-light-blue tooltips" onclick="getHistoryOfActivities('<?php echo $itemId ?>','<?php echo $type ?>');" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("activityList","See modifications"); ?>" alt=""><i class="fa fa-history"></i><span class="hidden-xs"> <?php echo Yii::t("common","History")?></span></a>
		<?php } ?>
		<a class="btn btn-sm btn-default tooltips" href="javascript:;" onclick="showDefinition('qrCodeContainerCl',true)" data-toggle="tooltip" data-placement="bottom" title="Show the QRCode for this organization"><i class="fa fa-qrcode"></i> QR Code</a>
		
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

			<?php if(!empty($event["badges"])){?>
				<?php if( Badge::checkBadgeInListBadges("opendata", $event["badges"])){?>
					<div class="badgePH pull-right" data-title="OPENDATA">
						<span class="fa-stack tooltips opendata" style="maring-bottom:5px" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("badge","opendata", null, Yii::app()->controller->module->id)?>'>
							<i class="fa fa-database main fa-stack-1x text-orange"></i>
							<i class="fa fa-share-alt  mainTop fa-stack-1x text-black"></i>
						</span>
					</div>
			<?php } 
			} ?>
		</div>
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
						<a href="<?php echo Yii::app()->baseUrl.'/communecter/data/get/type/events/id/'.$event['_id'] ;?>" data-toggle="tooltip" title='Visualiser la données' id="urlOpenData" class="urlOpenData" target="_blank"><i class="fa fa-eye"></i></a>
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
				$fieldPreferences= array();

				$typePreferencesBool = array("isOpenData", "isOpenEdition");

				//To checked private or public
				foreach($typePreferences as $typePref){
					foreach ($fieldPreferences as $field => $hidden) {
						if(isset($event["preferences"][$typePref]) && in_array($field, $event["preferences"][$typePref])){
							echo "$('.btn-group-$field > button[value=\'".str_replace("Fields", "", $typePref)."\']').addClass('active');";
							$fieldPreferences[$field] = false;
						} 
					}
				}
				//To checked if there are hidden
				foreach ($fieldPreferences as $field => $hidden) {
					if($hidden) echo "$('.btn-group-$field > button[value=\'hide\']').addClass('active');";
				}

				foreach ($typePreferencesBool as $field => $typePrefB) {
					if(isset($event["preferences"][$typePrefB]) && $event["preferences"][$typePrefB] == true)
						echo "$('.btn-group-$typePrefB > button[value=\'true\']').addClass('active');";	
					else
						echo "$('.btn-group-$typePrefB > button[value=\'false\']').addClass('active');";
				}	

			?> 
	     </script>


	      <div class="modal-footer">
	        <button type="button" class="btn btn-success lbh" data-dismiss="modal" aria-label="Close" data-hash="#event.detail.id.<?php echo $event['_id'] ;?>">OK</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->




	<!--<div class="panel-body no-padding">
			<a href="javascript:" id="editEventDetail" class="btn btn-sm btn-light-blue tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("event","Edit Event",null,Yii::app()->controller->module->id); ?>" alt=""><i class="fa fa-pencil"></i><span class="hidden-xs"> <?php echo Yii::t("common","Edit Information") ?></span></a>
			<a href="javascript:" id="editGeoPosition" class="btn btn-sm btn-light-blue tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Modify Position on the map") ?>" alt=""><i class="fa fa-map-marker"></i><span class="hidden-xs"> <?php echo Yii::t("common","Modify Position") ?></span></a>
			<?php /*?>
			<a href="javascript:" id="removeEvent" class="btn btn-sm btn-red btn-light-red tooltips removeEventBtn" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("event","Delete this event",null,Yii::app()->controller->module->id); ?>" alt=""><i class="fa fa-times"></i><span class="hidden-xs"> <?php echo Yii::t("event","Cancel Event",null,Yii::app()->controller->module->id); ?></span></a>
			*/ ?>
	</div>-->
	<div id="activityContent" class="panel-body no-padding hide"><h2 class="homestead text-dark" style="padding:40px;"><i class="fa fa-spin fa-refresh"></i> Chargement des activités ...</h2></div>
	<div id="contentGeneralInfos" class="panel-body no-padding">

		<div class="col-sm-6 col-xs-12 padding-10">
			<div class="item" id="imgAdherent">
				<?php 
					$this->renderPartial('../pod/fileupload', array("itemId" => $itemId,
																		  "type" => $type,
																		  "contentId" =>Document::IMG_PROFIL,
																		  "show" => "true" ,
																		  "resize" => false,
																		  "editMode" => $edit,
																		  "openEdition" => $openEdition,
																		  "image" => $imagesD )); ?>
			</div>
		</div>
		<div class="col-sm-6 col-xs-12 sectionBlockAdherent" id="infoEvent">
			<div class="row padding-20" >
				<div class="entityTitle">
					<h2 style="font-weight:100; font-size:19px;">
						<i class="fa fa-angle-right"></i> 
						<a href="#" id="type" data-type="select" data-title="Type" data-emptytext="Type" class="editable editable-click required"></a><br>
					</h2>
					<h2>
						<a href="#" id="name" data-type="text" data-title="Event name" data-emptytext="Event name" class="editable-event editable editable-click" >
							<?php if(isset($event["name"])) echo $event["name"];?>
						</a>
					</h2>
					
					<?php if(isset($event["parentId"])) {
						$parentEvent = Event::getSimpleEventById($event["parentId"]);
						echo Yii::t("event","Part of Event",null,Yii::app()->controller->module->id).' : <a class="lbh" href="#event.detail.id.'.$event["parentId"].'" >'.$parentEvent["name"]."</a>";
					}
					?>
						
				</div>
				<div class="col-sm-12 no-padding text-dark lbl-info-details">
					<i class="fa fa-clock-o"></i>  <?php echo Yii::t("common","When") ?> ?
				</div>
				<div class="col-sm-12 entityDetails no-padding">
					<div class="col-xs-12 no-padding">
						<span><?php echo Yii::t("common","All day") ?> : </span><a href="#" id="allDay" data-type="select" data-emptytext="<?php echo Yii::t("common","All day") ?> ?" class="editable editable-click" ></a>
					</div>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","From") ?> </span><a href="#" id="startDate" data-emptytext="Enter Start Date" class="editable editable-click" ></a>
					</div>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","To") ?> </span><a href="#" id="endDate" data-emptytext="Enter End Date" class="editable editable-click"></a> 
					</div>
					<?php 
						$address = (isset( $event["address"]["streetAddress"])) ? $event["address"]["streetAddress"] : "";
						$address2 = (isset( $event["address"]["postalCode"])) ? $event["address"]["postalCode"] : "";
						$address2 .= (isset( $event["address"]["addressCountry"])) ? ", ".OpenData::$phCountries[ $event["address"]["addressCountry"] ] : "";

						$this->renderPartial('../pod/qrcode',array(
																"type" => @$event['type'],
																"name" => @$event['name'],
																"address" => $address,
																"address2" => $address2,
																"email" => @$event['email'],
																"img"=>@$event['profilThumbImageUrl']));?>
				</div>
			</div>
		</div>
		<div class="col-xs-12">
			<?php 
			if( @$organizer["type"])
			{ ?>
			<div class="col-md-6 no-padding">
				<div class="col-sm-12 no-padding text-dark lbl-info-details">
					<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Organisateur") ?>
				</div>
				<div class="col-sm-12 entityDetails item_map_list">
					<?php
					if(@$organizer["type"]=="project"){ 
						 echo Yii::t("event","By the project",null,Yii::app()->controller->module->id);
						 $icon="fa-lightbulb-o";
					} else if(@$organizer["type"]=="organization"){
						 	$icon="fa-users";
					} else {
						 	$icon="fa-user";
					}

					$img = '';//'<i class="fa '.$icon.' fa-3x"></i> ';
					if ($organizer && !empty($organizer["profilThumbImageUrl"])){ 
						$img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/'.$organizer['profilThumbImageUrl']).'">';
					}else{
						if(!empty($organizer["profilImageUrl"]))
							$img = '<img class="thumbnail-profil" width="75" height="75" alt="image" src="'.Yii::app()->createUrl('/communecter/document/resized/50x50'.$organizer['profilImageUrl']).'">';
						else
							$img = "<div class='thumbnail-profil'></div>";
					}
					$color = "";
					if($icon == "fa-users") $color = "green";
					if($icon == "fa-user") $color = "yellow";
					if($icon == "fa-lightbulb-o") $color = "purple";
					$flag = '<div class="ico-type-account"><i class="fa '.$icon.' fa-'.$color.'"></i></div>';
						echo '<div class="imgDiv left-col" style="padding-right: 10px;width: 75px;">'.$img.$flag.'</div>';
					 ?> <a href="#<?php echo @$organizer["type"]; ?>.detail.id.<?php echo @$organizer["id"]; ?>" class="lbh"><?php echo @$organizer["name"]; ?></a><br/>
					<span><?php echo ucfirst(Yii::t("common", @$organizer["type"])); if (@$organizer["type"]=="organization") echo " - ".Yii::t("common", $organizer["typeOrga"]); ?></span>
				</div>
			</div>
			<?php } ?>
			<div class="col-md-6" style="padding-right:0px !important;">
				<div class="col-sm-12 no-padding text-dark lbl-info-details">
					<i class="fa fa-map-marker"></i> <?php echo Yii::t("common","Where") ?> ?
				</div>
				<div class="col-sm-12 entityDetails no-padding">
					<i class="fa fa-road fa_streetAddress hidden"></i> 
					<a href="#" id="streetAddress" data-type="text" data-title="Street Address" data-emptytext="Address" class="editable-event editable editable-click">
						<?php echo (isset( $event["address"]["streetAddress"])) ? $event["address"]["streetAddress"] : null; ?>
					</a>
					<br>
					<i class="fa fa-bullseye fa_postalCode  hidden"></i> 
					<a href="#" id="address" data-type="postalCode" data-title="Postal Code" data-emptytext="Postal Code" class="editable editable-click" data-placement="bottom">
					</a>
					<br>
					<i class="fa fa-globe fa_addressCountry  hidden"></i> 
					<a href="#" id="addressCountry" data-type="select" data-title="Country" data-emptytext="Country" data-original-title="" class="editable editable-click">					
					</a>
					<br>
					<a href="javascript:;" id="btn-update-geopos" class="btn btn-primary btn-sm hidden" style="margin: 10px 0px;">
						<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner
					</a>
					<div class="hidden" id="entity-insee-value" 
						 insee-val="<?php echo isset($event["address"]["codeInsee"]) ? $event["address"]["codeInsee"] : ""; ?>">
					</div>
					<div class="hidden" id="entity-cp-value" 
							 cp-val="<?php echo (isset( $event["address"]["postalCode"])) ? $event["address"]["postalCode"] : ""; ?>">
						</div>

				</div>
			</div>
		</div>
		<!--<div class="col-sm-12">
            <div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
        </div>
		<div class="col-sm-12 hidden-xs padding-20">
			<a href="#" id="description" data-title="Description" data-type="wysihtml5" data-emptytext="Description" class="editable editable-click">
			</a>
		</div>-->
		<div class="row">
			<div class="col-xs-12">
				<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
				<a href="#" id="description" data-title="Description" data-type="wysihtml5" data-emptytext="Description" class="editable editable-click">
				</a>
			</div>
		</div>
		<div class="row tag_group">
			<!-- <div class="col-sm-6 col-xs-6 padding-20 text-dark">
				<h3><i class="fa fa-angle-down"></i> Activités</h3>
				<a href="#" id="category" data-title="Categories" data-type="checklist" data-emptytext="Catégories" class="editable editable-click"></a>
			</div> -->
			<div class="col-md-12 padding-20 text-red text-right pull-right">
				<!-- <h3><i class="fa fa-angle-down"></i> Thématiques</h3> -->
				<i class="fa fa-tags"></i> Tags : 
				<a href="#" id="tags" data-type="select2" data-type="Tags" data-emptytext="Tags" class="text-red editable editable-click">
				</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var itemId = "<?php echo $event["_id"] ?>";
	var typeEvents = <?php echo json_encode($eventTypes) ?>;
	var eventData = <?php echo json_encode($event) ?>;
	var countries = <?php echo json_encode($countries) ?>;
	//By default : view mode
	var mode = "view";
	var allDay = '<?php echo (@$event["allDay"] == true) ? "true" : "false"; ?>'
	var startDate = '<?php echo $event["startDate"]; ?>';
	//alert(startDate);
	var endDate = '<?php echo $event["endDate"]; ?>';
	var imagesD = <?php echo(isset($imagesD)) ? json_encode($imagesD) : 'null'; ?>;
	var loadActivity = true;	
	if(imagesD != 'null'){
		var images = imagesD;
	}
	
	jQuery(document).ready(function() {
		$("#editEventDetail").on("click", function(){
			if($("#getHistoryOfActivities").find("i").hasClass("fa-arrow-left"))
				getBackDetails(itemId,"<?php echo Event::COLLECTION ?>");
			switchMode();
		});
		$("#editGeoPosition").click(function(){
			Sig.startModifyGeoposition(itemId, "events", eventData);
			showMap(true);
		});

		$("#btn-update-geopos").click(function(){ console.log("findGeoPosByAddress");
			findGeoPosByAddress();
		});

		activateEditable();
		manageModeContext();

		$(".removeEventBtn").off().on("click", function(e){
			bootbox.confirm("<?php echo Yii::t("common","Are you sure you want to delete")?> <?php echo Yii::t("event","this event",null,Yii::app()->controller->module->id)?> ?", function(result) {
				if (result) {
					//if this event has children , ask if we keep or delete them
					$.ajax({
						type: "POST",
						url: baseUrl+"/"+moduleId+"/event/delete/eventId/"+itemId,
						dataType: "json",
						success: function(data){
							if ( data && data.result ) {               
								toastr.info(data.msg);
								showAjaxPanel( '/person/directory?tpl=directory2&type=events', 'MES ÉVÉNEMENTS','calender' );
							}else{
								toastr.error("Something went wrong");
							}
						}
					})
				}
			})
		});


		$(".editConfidentialityBtn").click(function(){
	    	console.log("confidentiality");
	    	$("#modal-confidentiality").modal("show");
	    });

	    $(".confidentialitySettings").click(function(){
	    	param = new Object;
	    	param.type = $(this).attr("type");
	    	param.value = $(this).attr("value");
	    	param.typeEntity = "events";
	    	param.idEntity = itemId;
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/event/updatesettings",
		        data: param,
		       	dataType: "json",
		    	success: function(data){
			    	toastr.success(data.msg);
			    }
			});
    	});


		$(".panel-btn-confidentiality .btn").click(function(){
			var type = $(this).attr("type");
			var value = $(this).attr("value");
			$(".btn-group-"+type + " .btn").removeClass("active");
			$(this).addClass("active");
		});

		buildQRCode("event","<?php echo (string)$event["_id"]?>");
		
	})

	function activateEditable() {
		$.fn.editable.defaults.mode = 'inline';

		$('.editable-event').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield",
			onblur: 'submit',
			mode: "popup",
			success : function(data) {
		       if(data.result) {
		        	toastr.success(data.msg);
					loadActivity=true;	
		        } else
		        	return (data.msg);
		    },
			showbuttons: false
		});

		//Type Event
		$('#type').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", 
			value: '<?php echo (isset($event["type"])) ? $event["type"] : ""; ?>',
			mode: "popup",
			source: function() {
				return typeEvents;
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
		
		$('#allDay').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", 
			mode: "popup",
			value: allDay,
			source:[{value: "true", text: "Oui"}, {value: "false", text: "Non"}],
			success : function(data, newValue) {
		        if(data.result) {
		        	manageAllDayEvent(newValue);
		        	toastr.success(data.msg);
					loadActivity=true;	
		        }
		        else
		        	return data.msg;  
		    },
		});
		manageAllDayEvent(allDay);

		$('#address').editable({
			validate: function(value) {
                value.streetAddress=$("#streetAddress").text();
                console.log(value);
            },
			url: baseUrl+"/"+moduleId+"/event/updatefield",
			mode: 'popup',
			success: function(response, newValue) {
				if(debug)console.log("success update postal Code",newValue);
				$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
				$("#entity-cp-value").attr("cp-val", newValue.postalCode);
				loadActivity=true;	
				
			},
			value : {
            	postalCode: '<?php echo (isset( $event["address"]["postalCode"])) ? $event["address"]["postalCode"] : null; ?>',
            	codeInsee: '<?php echo (isset( $event["address"]["codeInsee"])) ? $event["address"]["codeInsee"] : ""; ?>',
            	addressLocality : '<?php echo (isset( $event["address"]["addressLocality"])) ? $event["address"]["addressLocality"] : ""; ?>'
        	}
		});

		$('#addressCountry').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", 
			value: '<?php echo (isset( $event["address"]["addressCountry"])) ? $event["address"]["addressCountry"] : ""; ?>',
			source: function() {
				return countries;
			},
			success : function(data) {
		        if(data.result) {
		        	toastr.success(data.msg);
					loadActivity=true;	
		        }else
		        	toastr.error(data.msg);  
		    },
		});

		$('#description').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", 
			value: <?php echo (isset($event["description"])) ? json_encode($event["description"]) : "''"; ?>,
			placement: 'top',
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


		//Select2 tags
		$('#tags').editable({
			url: baseUrl+"/"+moduleId+"/event/updatefield", 
			mode: 'popup',
			value: returnttag(),
			select2: {
				tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
				tokenSeparators: [","],
				width: 200
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


	}

	function switchMode() {
		if(mode == "view"){
			mode = "update";
			manageModeContext();
		}else{
			mode ="view";
			manageModeContext();
		}
	}

	function manageModeContext() {
		if (mode == "view") {
			$('.editable-event').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#allDay').editable('toggleDisabled');
			$('#startDate').editable('toggleDisabled');
			$('#endDate').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$("#btn-update-geopos").addClass("hidden");
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-event').editable('option', 'pk', itemId);
			$('#type').editable('option', 'pk', itemId);
			$('#allDay').editable('option', 'pk', itemId);
			$('#startDate').editable('option', 'pk', itemId);
			$('#endDate').editable('option', 'pk', itemId);
			$('#addressCountry').editable('option', 'pk', itemId);
			$('#address').editable('option', 'pk', itemId);
			$('#description').editable('option', 'pk', itemId);
			$('#tags').editable('option', 'pk', itemId);

			$('.editable-event').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#allDay').editable('toggleDisabled');
			$('#startDate').editable('toggleDisabled');
			$('#endDate').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');

			$("#btn-update-geopos").removeClass("hidden");
		}
		if($('#streetAddress').html() != "")	{ $(".fa_streetAddress").removeClass("hidden"); } else { $(".fa_streetAddress").addClass("hidden"); }
		if($('#postalCode').html() != "")		{ $(".fa_postalCode").removeClass("hidden"); } else { $(".fa_postalCode").addClass("hidden"); }
		if($('#addressCountry').html() != "")	{ $(".fa_addressCountry").removeClass("hidden"); } else { $(".fa_addressCountry").addClass("hidden"); }
	}

	function manageAllDayEvent(isAllDay) {
		console.warn("Manage all day event ", isAllDay);

		$('#startDate').editable('destroy');
		$('#endDate').editable('destroy');
		if (isAllDay == 'true') {
			$('#startDate').editable({
				url: baseUrl+"/"+moduleId+"/event/updatefield", 
				pk: itemId,
				type: "date",
				mode: "popup",
				placement: "bottom",
				format: 'dd/mm/yyyy',
				viewformat: 'dd/mm/yyyy',
				datepicker: {
					weekStart: 1
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
				url: baseUrl+"/"+moduleId+"/event/updatefield", 
				pk: itemId,
				type: "date",
				mode: "popup",
				placement: "bottom",
				format: 'dd/mm/yyyy',   
	        	viewformat: 'dd/mm/yyyy',
	        	datepicker: {
	                weekStart: 1
	           },
	           success : function(data) {
			        if(data.result) {
			        	toastr.success(data.msg);
						loadActivity=true;	
			        }else 
						return data.msg;
			    }
	        });

			formatDate = "DD/MM/YYYY";
		} else {
			$('#startDate').editable({
				url: baseUrl+"/"+moduleId+"/event/updatefield", 
				pk: itemId,
				type: "datetime",
				mode: "popup",
				placement: "bottom",
				format: 'dd/mm/yyyy hh:ii',
				viewformat: 'dd/mm/yyyy hh:ii',
				datetimepicker: {
					weekStart: 1,
					minuteStep: 30,
					language: 'fr'
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
				url: baseUrl+"/"+moduleId+"/event/updatefield", 
				pk: itemId,
				mode: "popup",
				type: "datetime",
				placement: "bottom",
				format: 'dd/mm/yyyy hh:ii',
	        	viewformat: 'dd/mm/yyyy hh:ii',
	        	datetimepicker: {
	                weekStart: 1,
	                minuteStep: 30,
	                language: 'fr'
	           },
	           success : function(data) {
			        if(data.result) {
			        	toastr.success(data.msg);
						loadActivity=true;	
			        }else 
						return data.msg;
			    }
	        });

			formatDate = "DD/MM/YYYY HH:mm";
		}

		$('#startDate').editable('setValue', moment(startDate, "DD/MM/YYYY HH:mm").format(formatDate), true);
		$('#endDate').editable('setValue', moment(endDate, "DD/MM/YYYY HH:mm").format(formatDate), true);
	}


	//modification de la position geographique	

	function findGeoPosByAddress(){ //console.log("allo 1");
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//console.log("allo 2");
			//on récupère la valeur du code insee s'il existe
			if ($("#entity-insee-value").attr("insee-val") != ""){
				var insee = $("#entity-insee-value").attr("insee-val");
				var postalCode = $("#entity-cp-value").attr("cp-val");
			}
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee, null, postalCode);
			console.log(insee);
		//si on a une streetAddress
		}else{
			//console.log("allo 3");
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
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//met à jour la nouvelle position dans la donnée
			eventData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };
			//et on affiche le marker sur la carte à cette position
			console.log("-------obj lenght ok ---------");
			console.log(eventData);
			showGeoposFound(coords, itemId, "events", eventData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			if ($("#entity-insee-value").attr("insee-val") != ""){
				var insee = $("#entity-insee-value").attr("insee-val");
				var postalCode = $("#entity-cp-value").attr("cp-val");
			}
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee,null,postalCode);
		}
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
			
			eventData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, itemId, "events", eventData);
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}


	//en cas d'erreur nominatim
	function callbackNominatimError(error){
		console.log("callbackNominatimError", error);
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		console.log("erreur getlatlngbyinsee", error);
	}
	function getHistoryOfActivities(id,type){
		$("#contentGeneralInfos").hide();
		$("#activityContent").removeClass("hide");
		$("#getHistoryOfActivities").html("<i class='fa fa-arrow-left'></i> <span class='hidden-xs'>Revenir aux détails</span>").attr("onclick","getBackDetails('"+id+"','"+type+"')");
		//if($("#activityContent").html()=='<h2 class="homestead text-dark" style="padding:40px;"><i class="fa fa-spin fa-refresh"></i> Chargement des activités ...</h2>')
		if(loadActivity==true){
			getAjax('#activityContent',baseUrl+'/'+moduleId+"/pod/activitylist/type/"+type+"/id/"+id,function(){ 
		},"html");
		}
		
	}
	function getBackDetails(id,type){
		$("#contentGeneralInfos").fadeOut();
		$("#activityContent").removeClass("hide");
		$("#getHistoryOfActivities").html("<i class='fa fa-history'></i> <span class='hidden-xs'>Historique</span>").attr("onclick","getHistoryOfActivities('"+id+"','"+type+"')");
		$("#activityContent").addClass("hide");
		$("#contentGeneralInfos").show();
		loadActivity=false;
	}

	function returnttag() {
		var tag = <?php echo (isset($event["tags"])) ? json_encode(implode(",", $event["tags"])) : "''"; ?>;
		console.log("tag", tag);
		return tag ;
	}
</script>