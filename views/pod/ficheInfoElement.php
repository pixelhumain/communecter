<style>
	.fileupload, .fileupload-preview.thumbnail, 
	.fileupload-new .thumbnail, 
	.fileupload-new .thumbnail img, 
	.fileupload-preview.thumbnail img {
	    width: 100%;
	}
	.panelDetails .row{
		margin:0px !important;
	}
	
	.info-shortDescription a{
		font-size:14px;
		font-weight: 300;
	}
	a#shortDescription{
		font-size: 15px !important;
		font-weight: 200;
		/*color: white;*/
	}
	#profil_imgPreview{
      max-height:400px;
      width:100%;
      border-radius: 5px;
      /*border:3px solid #93C020;*/
      /*border-radius:  4px 4px 0px 0px;*/
      margin-bottom:0px;
     

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

    #fileuploadContainer{
    	z-index:0 !important;
    }
    .tag_group{
    	font-size:14px;
    	font-weight: 300;
    }
    .info-coordonnees{
    	/*background-color: rgb(239, 239, 239);*/
    }
    .lbl-info-details{
    	font-weight: 600;
	    border-bottom: 1px solid lightgray;
	    padding-bottom: 7px;
	    margin-bottom: 5px;
	    width:100%;
	    float:left;
	}

    .panel-title{
    	font-weight: 200;
    	font-size: 21px;
    	font-family: "homestead";
    }

</style>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title text-dark"> 
			<i class="fa fa-info-circle"></i> <?php echo Yii::t("common","Account info") ?>
		</h4>
	</div>
	<div id="activityContent" class="panel-body no-padding hide">
		<h2 class="homestead text-dark" style="padding:40px;">
			<i class="fa fa-spin fa-refresh"></i> Chargement des activités ...
		</h2>
	</div>
	<div class="panel-body border-light panelDetails" id="contentGeneralInfos">	
		<?php if($type==Event::COLLECTION){ ?>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 no-padding" style="padding-right:10px !important;">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding text-dark lbl-info-details">
					<i class="fa fa-clock-o"></i>  <?php echo Yii::t("common","When") ?> ?
				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 entityDetails no-padding">
					<div class="col-xs-12 no-padding">
						<span><?php echo Yii::t("common","All day") ?> : </span><a href="#" id="allDay" data-type="select" data-emptytext="<?php echo Yii::t("common","All day") ?> ?" class="editable editable-click" ></a>
					</div>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","From") ?> </span><a href="#" id="startDate" data-emptytext="Enter Start Date" class="editable editable-click" ></a>
					</div>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","To") ?> </span><a href="#" id="endDate" data-emptytext="Enter End Date" class="editable editable-click"></a> 
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 no-padding">
		<?php } ?>
		<div class="text-dark lbl-info-details <?php if($type==Event::COLLECTION){ ?>no-padding<?php } ?>">
			<?php if($type==Event::COLLECTION){?>
				<i class="fa fa-map-marker"></i> <?php echo Yii::t("common","Where") ?> ? 
			<?php }else{ ?>
				<i class="fa fa-angle-down"></i> Coordonnées
			<? } ?>
		</div>
		<div class="row info-coordonnees entityDetails text-dark" style="margin-top: 10px !important;">
			<div class="col-md-6 col-sm-6">	
				<i class="fa fa-road fa_streetAddress hidden"></i> 
				<a href="#" id="streetAddress" data-type="text" data-title="<?php echo Yii::t("common","Street Address") ?>" data-emptytext="<?php echo Yii::t("common","Street Address") ?>" class="editable-context editable editable-click">
					<?php echo (isset( $element["address"]["streetAddress"])) ? $element["address"]["streetAddress"] : null; ?>
				</a> 
				<br>
			
				<i class="fa fa-bullseye fa_postalCode  hidden"></i> 
				 <a href="#" id="address" data-type="postalCode" data-title="<?php echo Yii::t("common","Postal code") ?>" 
					data-emptytext="<?php echo Yii::t("common","Postal code") ?>" class="editable editable-click" data-placement="bottom">	
				</a> 
				<?php //echo (isset( $element["address"]["postalCode"])) ? $element["address"]["postalCode"] : null; ?>
				<br>
				
				<i class="fa fa-globe fa_addressCountry  hidden"></i> 
				<a href="#" id="addressCountry" data-type="select" data-title="<?php echo Yii::t("common","Country") ?>" 
					data-emptytext="<?php echo Yii::t("common","Country") ?>" data-original-title="" class="editable editable-click">
				</a> 
				<br>

				<a href="javascript:" id="btn-update-geopos" class="btn btn-primary btn-sm hidden" style="margin: 10px 0px;">
					<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner
				</a>
				<?php 
					$roles = Role::getRolesUserId(Yii::app()->session["userId"]);
					if($roles["superAdmin"] == true){
						?>
							<a href="javascript:" id="btn-update-geopos-admin" class="btn btn-danger btn-sm" style="margin: 10px 0px;">
								<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner Admin
							</a>
						<?php
					}
				?>

				
				


				<br>
				<!-- <hr style="margin:10px 0px;"> -->
			</div>
			<?php if($type != Event::COLLECTION){ ?>
			<div class="col-md-6 col-sm-6">
				<?php if($type==Organization::COLLECTION){
						$nbFixe = 0 ;
						$nbMobile = 0 ; 

						if(isset($element["telephone"]))
						{
							$telephone = "" ;

							if(is_array($element["telephone"]))
							{

								if(@$element["telephone"]["fixe"])
								{
									//.fixe.'.$nbFixe.'
									foreach ($element["telephone"]["fixe"] as $key => $value) {
										if(!empty($telephone))
											$telephone .= ", ";
										$telephone .= $value ;
									}
								}

								if(@$element["telephone"]["mobile"])
								{
									//telephone.mobile.'.$nbMobile.'
									foreach ($element["telephone"]["mobile"] as $key => $value) {
										if(!empty($telephone))
											$telephone .= ", ";
										$telephone .= $value ;
									}
								}
							}
							else
							{
								if(@$element["telephone"])
								{
									if(!empty($telephone))
											$telephone .= ", ";
										$telephone .= $element["telephone"] ;
								}
							}
							
							echo '<i class="fa fa-phone fa_telephone  hidden"></i>
						 							<a href="#" id="telephone" data-type="select2" data-type="text" data-title="'. Yii::t("common","Phone number").'" 
						 data-emptytext="'. Yii::t("common","Phone number") .'" class="tel editable editable-click">'.$telephone . "</a><br>" ;

							
						}
					}
				?>

				<?php if ($type==Organization::COLLECTION || $type==Person::COLLECTION){ ?>
				<i class="fa fa-envelope fa_email  hidden"></i> 
				<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-context editable editable-click required">
					<?php echo (isset($element["email"])) ? $element["email"] : null; ?>
				</a>
				<br>
				<?php } ?>
				<?php if ($type==Project::COLLECTION){ ?>
					<i class="fa fa-calendar"></i> 
					<?php if(!empty($element["startDate"])) echo Yii::t("common","From") ; ?> <a href="#" id="startDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's start",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a> 
					<label id="labelTo"><?php echo Yii::t("common","To"); ?></label><a href="#" id="endDate" data-type="date" data-original-title="<?php echo Yii::t("project","Enter the project's end",null,Yii::app()->controller->module->id) ?>" class="editable editable-click"></a><br>
				<?php } ?>
				<?php //If there is no http:// in the url
				$scheme = "";
				if(isset($element["url"])){
					if (!preg_match("~^(?:f|ht)tps?://~i", $element["url"])) $scheme = 'http://';
				}?>
				
				<i class="fa fa-desktop fa_url hidden"></i> 
				 <a href="<?php echo (isset($element["url"])) ? $scheme.$element['url'] : '#'; ?>" target="_blank" id="url" data-type="text" data-title="<?php echo Yii::t("common","Website URL") ?>" 
					data-emptytext="<?php echo Yii::t("common","Website URL") ?>" style="cursor:pointer;" class="editable-context editable editable-click">
					<?php echo (isset($element["url"])) ? $element["url"] : null; ?>
				</a> 
				<br>
				<?php if($type==Project::COLLECTION){ ?>
				<i class="fa fa-file-text-o"></i>
				<a href="#" id="licence" data-type="text" data-original-title="<?php echo Yii::t("project","Enter the project's licence",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Project licence") ?>" class="editable-context editable editable-click"><?php if(isset($element["licence"])) echo $element["licence"];?></a><br>
				<?php } ?>
			</div>	
			<?php } ?>		
		</div>
		<?php if($type==Event::COLLECTION){ ?>
			</div>
		<?php } ?>
		<?php if($type == Event::COLLECTION && @$organizer["type"]){ ?>
		<div class="col-md-12 col-sm-12 col-xs-12">
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
				 ?> <a href="javascript:;" onclick="loadByHash('#<?php echo @$organizer["type"]; ?>.detail.id.<?php echo @$organizer["id"]; ?>')"><?php echo @$organizer["name"]; ?></a><br/>
				<span><?php echo ucfirst(Yii::t("common", @$organizer["type"])); if (@$organizer["type"]=="organization") echo " - ".Yii::t("common", $organizer["typeOrga"]); ?></span>
			</div>
		</div>
		<?php } ?>
		<div class="col-sm-12 col-xs-12 col-md-12 no-padding">
			<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
			 <?php echo (isset($element["description"])) ? $element["description"] : ""; ?>
		</div>
	</div>
</div>

<script type="text/javascript"> 

	var contextData = <?php echo json_encode($element)?>;
	var contextType = <?php echo json_encode($type)?>;
	var contextId = "<?php echo isset($element["_id"]) ? $element["_id"] : ""; ?>";
	var contentKeyBase = "<?php echo isset($contentKeyBase) ? $contentKeyBase : ""; ?>";
	//By default : view mode
	var mode = "view";
	var images = <?php echo json_encode($images) ?>;
	var types = <?php echo json_encode($elementTypes) ?>;
	var countries = <?php echo json_encode($countries) ?>;
	var startDate = '<?php if(isset($element["startDate"])) echo $element["startDate"]; else echo ""; ?>';
	var endDate = '<?php if(isset($element["endDate"])) echo $element["endDate"]; else echo "" ?>';
	var allDay = '<?php echo (@$element["allDay"] == true) ? "true" : "false"; ?>'
	var publics = <?php echo json_encode($publics) ?>;
	var NGOCategoriesList = <?php echo json_encode($NGOCategories) ?>;
	var localBusinessCategoriesList = <?php echo json_encode($localBusinessCategories) ?>;
	
	jQuery(document).ready(function() {
		$("#editFicheInfo").on("click", function(){
			switchMode();
		});
		// activateEditableContext();
		bindAboutPodElement() 
		activateEditableContext();
		manageModeContext();

		$('#avatar').change(function() {
		  $('#photoAddEdit').submit();
		});

		$("#photoAddEdit").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/organizations/id/"+contextId,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
					if(data.result){
						toastr.success(data.msg);
						if('undefined' != typeof data.imagePath){
							$("#imgView").attr("src", data.imagePath);
						}
					}else{
						toastr.error(data.msg);
					}
			  },
			});
		}));

		$("#btn-update-geopos").click(function(){
			findGeoPosByAddress();
		});

		$("#btn-update-geopos-admin").click(function(){
			findGeoPosByAddress();
		});

	});
	function bindAboutPodElement() {
		$("#editElementDetail").on("click", function(){
			if($("#getHistoryOfActivities").find("i").hasClass("fa-arrow-left"))
				getBackDetails(contextId,"<?php echo $type ?>");
			switchMode();
		});
	
		$("#editGeoPosition").click(function(){
			Sig.startModifyGeoposition(contextId, "<?php echo $type ?>", contextData);
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
	    	param.typeEntity = "<?php echo $type; ?>";
	    	param.idEntity = contextId;
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/element/updatesettings",
		        data: param,
		       	dataType: "json",
		    	success: function(data){
			    	toastr.success(data.msg);
			    }
			});
		});
	}


	function manageModeContext() {
		if (mode == "view") {
			$('.editable-context').editable('toggleDisabled');
			$('#type').editable('toggleDisabled');
			$('#shortDescription').editable('toggleDisabled');
			$('#description').editable('toggleDisabled');
			$('#tags').editable('toggleDisabled');
			$('#addressCountry').editable('toggleDisabled');
			$('#address').editable('toggleDisabled');
			$('#category').editable('toggleDisabled');
			$('#typeOfPublic').editable('toggleDisabled');
			$('#telephone').editable('toggleDisabled');
			$('#avancement').editable('toggleDisabled');
			$('#startDate').editable('toggleDisabled');
			$('#endDate').editable('toggleDisabled');
			$("#btn-update-geopos").addClass("hidden");
			$("#add-phone").addClass("hidden");
			$("#url").css('cursor', 'pointer');
			$('#allDay').editable('toggleDisabled');
		
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('#type').editable('option', 'pk', contextId);
			$('#shortDescription').editable('option', 'pk', contextId);
			$('#description').editable('option', 'pk', contextId);
			$('#type').editable('option', 'pk', contextId);
			$('#address').editable('option', 'pk', contextId);
			$('#addressCountry').editable('option', 'pk', contextId);
			$('#tags').editable('option', 'pk', contextId);
			$('#category').editable('option', 'pk', contextId);
			$('#typeOfPublic').editable('option', 'pk', contextId);
			$('#avancement').editable('option', 'pk', contextId);
			$('#telephone').editable('option', 'pk', contextId);			
			$('#startDate').editable('option', 'pk', contextId);
			$('#endDate').editable('option', 'pk', contextId);
			$('#allDay').editable('option', 'pk', contextId);

			$("#btn-update-geopos").removeClass("hidden");
			$("#add-phone").removeClass("hidden");
			$("#url").css('cursor', 'default');
		}
		//alert($('#url').html() );
		if($('#name').html() != "")				{ $(".fa_name").removeClass("hidden"); } else { $(".fa_name").addClass("hidden"); }
		if($('#url').html() != "")				{ $(".fa_url").removeClass("hidden"); } else { $(".fa_url").addClass("hidden"); }
		if($('#email').html() != "")			{ $(".fa_email").removeClass("hidden"); } else { $(".fa_email").addClass("hidden"); }
		if($('#streetAddress').html() != "")	{ $(".fa_streetAddress").removeClass("hidden"); } else { $(".fa_streetAddress").addClass("hidden"); }
		if($('#postalCode').html() != "")		{ $(".fa_postalCode").removeClass("hidden"); } else { $(".fa_postalCode").addClass("hidden"); }
		if($('#addressCountry').html() != "")	{ $(".fa_addressCountry").removeClass("hidden"); } else { $(".fa_addressCountry").addClass("hidden"); }
		if($('#telephone').html() != "")		{ $(".fa_telephone").removeClass("hidden"); } else { $(".fa_telephone").addClass("hidden"); }
		if(endDate == ""){
			$("#labelTo").addClass("hidden");
			$("#btn-update-geopos").addClass("hidden");
		}
		
	}

	function activateEditableContext() {

		
		$.fn.editable.defaults.mode = 'popup';
		$('.editable-context').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield",
			title : $(this).data("title"),
			onblur: 'submit',
			success: function(response, newValue) {
				console.log("yo");
        		if(! response.result) return response.msg; //msg will be shown in editable form
    		}
		});
		
		//Type Organization
		 $('#type').editable({
		 	url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType, 
		 	value: '<?php echo (isset($element["type"])) ? $element["type"] : ""; ?>',
		 	source: function() {
		 		return types;
		 	},
		 });

		$('#shortDescription').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType, 
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
			}
		});

		//Select2 tags
		// $('#tags').editable({
		// 	url: baseUrl+"/"+moduleId+"/organization/updatefield", 
		// 	mode: 'popup',
		// 	value: returnttag(),
		// 	select2: {
		// 		tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
		// 		tokenSeparators: [","],
		// 		width: 200
		// 	}
		// });


		$('#telephone').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType, 
			mode: 'popup',
			value: returntel(),
			select2: {
				tags:  <?php if(isset($telephone)) echo json_encode($telephone); else echo json_encode(array())?>,
				tokenSeparators: [",", "/", " "],
				width: 200,
			}
		});

		

		$('#category').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType, 
			mode: 'popup',
			value: <?php echo (isset($element["category"])) ? json_encode(implode(",", $element["category"])) : "''"; ?>,
			source: function() {
				var result = new Array();
				var categorySource = null;

				console.log("contextData.type",contextData.type);
				if (contextData.type == "<?php echo Organization::TYPE_NGO ?>") categorySource = NGOCategoriesList;
				if (contextData.type == "<?php echo Organization::TYPE_BUSINESS ?>") categorySource = localBusinessCategoriesList;
				
				if(categorySource != null)
				$.each(categorySource, function(i,value) {
					result.push({"value" : value, "text" : value}) ;
				});
				return result;
			},
		});

		$('#addressCountry').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType,  
			value: '<?php echo (isset( $element["address"]["addressCountry"])) ? $element["address"]["addressCountry"] : ""; ?>',
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

		$('#address').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType, 
			mode: 'popup',
			success: function(response, newValue) {
				console.log("success update postal Code : "+newValue);
				console.dir(newValue);
				$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
				//updateGeoPosEntity("CP", newValue);
			},
			value : {
            	postalCode: '<?php echo (isset( $element["address"]["postalCode"])) ? $element["address"]["postalCode"] : null; ?>',
            	codeInsee: '<?php echo (isset( $element["address"]["codeInsee"])) ? $element["address"]["codeInsee"] : ""; ?>',
            	addressLocality : '<?php echo (isset( $element["address"]["addressLocality"])) ? $element["address"]["addressLocality"] : ""; ?>'
            }
		});
		$('#avancement').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType,  
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
					return data.msg;
		    }
		});
		

		$('#description').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType,  
			value: <?php echo (isset($element["description"])) ? json_encode($element["description"]) : "''"; ?>,
			placement: 'top',
			wysihtml5: {
				html: true,
				video: false
			}
		});
		/*$('#startDate').editable({
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
		});*/
		$('#allDay').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType,  
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

	
		manageAllDayElement(allDay);
	   
		//Validation Rules
		//Mandotory field
		$('.required').editable('option', 'validate', function(v) {
			var intRegex = /^\d+$/;
			if (!v)
				return 'Field is required !';
		});
	
		
	} 
	function manageAllDayElement(isAllDay) {
		console.warn("Manage all day event ", isAllDay);

		$('#startDate').editable('destroy');
		$('#endDate').editable('destroy');
		if (isAllDay == '') {
			$('#startDate').editable({
				url: baseUrl+"/"+moduleId+"/element/updatefiel/type/"+contextType,  
				pk: contextId,
				type: "date",
				mode: "popup",
				placement: "bottom",
				format: 'yyyy-mm-dd',
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
				url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType,  
				pk: contextId,
				type: "date",
				mode: "popup",
				placement: "bottom",
				format: 'yyyy-mm-dd',   
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

			formatDate = "YYYY-MM-DD";
		} else {
			$('#startDate').editable({
				url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType, 
				pk: contextId,
				type: "datetime",
				mode: "popup",
				placement: "bottom",
				format: 'yyyy-mm-dd hh:ii',
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
				url: baseUrl+"/"+moduleId+"/element/updatefield/type/"+contextType, 
				pk: contextId,
				mode: "popup",
				type: "datetime",
				placement: "bottom",
				format: 'yyyy-mm-dd hh:ii',
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

			formatDate = "YYYY-MM-DD HH:mm";
		}

		$('#startDate').editable('setValue', moment(startDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
		$('#endDate').editable('setValue', moment(endDate, "YYYY-MM-DD HH:mm").format(formatDate), true);
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

	function returnttag() {
		var tel = <?php echo (isset($element["tags"])) ? json_encode(implode(",", $element["tags"])) : "''"; ?>;
		

	    console.log("trefreevfre", tel);
		return tel ;
	}

	function returntel() {
		var tel = "";
		$(".tel").each(function(){
			
			if($(this).text().trim() != "")
	        {
	        	if(tel != "")
	        		tel += ", ";

	        	tel += $(this).text().trim();
	        }	
	        	
	    });

	    console.log(tel);
		return tel ;
	}
	//modification de la position geographique	

	function findGeoPosByAddress(){
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
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
		//si nominatim a trouvé un/des resultats
		if (obj.length > 0) {
			//on utilise les coordonnées du premier resultat
			var coords = L.latLng(obj[0].lat, obj[0].lon);
			//et on affiche le marker sur la carte à cette position
			console.log("showGeoposFound coords", coords);
			console.dir("showGeoposFound obj", obj);

			//si la donné n'est pas geolocalisé
			//on lui rajoute les coordonées trouvés
			//if(typeof contextData["geo"] == "undefined")
			contextData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };

			showGeoposFound(coords, contextId, "organizations", contextData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			var insee = ($("#entity-insee-value").attr("insee-val") != "") ? 
						 $("#entity-insee-value").attr("insee-val") : "";
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee);
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
			
			contextData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, contextId, "organizations", contextData);
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
	

</script>