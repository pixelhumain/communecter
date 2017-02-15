<?php 
$cssAnsScriptFilesTheme = array(
//X-editable...
//'/assets/plugins/x-editable/css/bootstrap-editable.css',
//'/assets/plugins/x-editable/js/bootstrap-editable.js',

//DatePicker
//'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' ,
//'/assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js' ,
//'/assets/plugins/bootstrap-datepicker/css/datepicker.css',

//DateTime Picker
//'/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
//'/assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.fr.js' , 
//'/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',

//Wysihtml5
//'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css',
//'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5-editor.css',
//'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/wysihtml5x-toolbar.min.js',
//'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.js',
//'/assets/plugins/wysihtml5/wysihtml5.js',

//'/assets/plugins/moment/min/moment.min.js' , 
//'/assets/plugins/jquery.qrcode/jquery-qrcode.min.js'
'/plugins/to-markdown/to-markdown.js',

);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);


/*$cssAnsScriptFilesModule = array(

	'/plugins/jquery.qrcode/jquery-qrcode.min.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);*/

//$cssAnsScriptFilesModule = array(
//	'/js/dataHelpers.js',
//	'/js/postalCode.js'
//);
//HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule , $this->module->assetsUrl);
?>
<style>
	.fileupload, .fileupload-preview.thumbnail, 
	.fileupload-new .thumbnail, 
	.fileupload-new .thumbnail img, 
	.fileupload-preview.thumbnail img {
	    width: initial;
	}
	.panelDetails .row{
		margin:0px !important;
	}
	
	.info-shortDescription a{
		font-size:14px;
		font-weight: 300;
	}
	#profil_imgPreview{
      max-height:400px;
      width:100%;
      border-radius: 5px;
      /*border:3px solid #93C020;*/
      /*border-radius:  4px 4px 0px 0px;*/
      margin-bottom:0px;
    }

    .titleField{
    	font-weight: 400;
    	font-size: 14px;
    }

    .entityTitle{
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      font-weight: 200;
      text-align: left;
    }
	/*.entityTitle{
      background-color: #FFF;
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      font-weight: 200;
    }*/
    /*.entityTitle h2{
    	font-size: 30px;
    	font-weight: 200;
      	margin:0px !important;
      	text-align: left;
    }*/

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
	    font-size: 16px;
	}

    /*.panel-title{
    	font-weight: 200;
    	font-size: 21px;
    	font-family: "homestead";
    }*/

    #ficheInfo #telegramAccount {
	    float: left;
		font-size: 13px;
		border-radius: 50px;
		background-color: rgb(43, 176, 198) !important;
		height: 26px;
		text-align: center;
		padding: 4px 10px 8px 7px;
		margin-top: 5px;
		color: white;
		font-weight: 200;
		cursor: pointer;
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

	.entityDetails i.fa.fa-circle {
	    margin-right: 0px;
	    font-size: 11px;
	}
	.entityDetails i.fa.fa-home {
	    margin: 0px;
	}

/*
@media screen and (max-width: 767px) {
	.wysihtml5-toolbar{
		display: none;
	}
}*/

</style>

<div id="ficheInfo" class="panel panel-white">
	<div class="panel-heading border-light padding-15" style="background-color: #dee2e680;">
		<h4 class="panel-title text-dark"> 
			<i class="fa fa-info-circle"></i> <?php echo Yii::t("common","Account info") ?>
		</h4>
	</div>
	<div id="divBtnDetail" class="panel-tools" >
		<?php if(@Yii::app()->session["userId"]){ ?> 

			<?php if($edit==true) { ?>
				<a href="javascript:;" id="editConfidentialityBtn" class="btn btn-sm btn-default tooltips <?php if(@$element['seePreferences'] && $element['seePreferences']==true && $type==Person::COLLECTION) echo 'btn-red'; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php if ($type==Person::COLLECTION){ echo Yii::t("common", "Manage my parameters"); } else { echo Yii::t("common", "Manage the parameters of")." ".Yii::t("common","this ".$controller); } ?>" alt=""><i class='fa fa-cog'></i><span class="hidden-xs"> <?php echo Yii::t("common","Paramètres de confidentialité"); ?></span></a>
			<?php } ?>
			
			<?php if ($openEdition==true) { ?>
				<a href="javascript:" id="getHistoryOfActivities" class="btn btn-sm btn-light-blue tooltips" onclick="getHistoryOfActivities('<?php echo $element["_id"] ?>','<?php echo $type ?>');" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("activityList","See modifications"); ?>" alt=""><i class="fa fa-history"></i><span class="hidden-xs"> <?php echo Yii::t("common","History")?></span></a>
			<?php } ?>
	
			<?php if($type == Person::COLLECTION && $edit==true){ ?>
				<a href='javascript:' id="changePasswordBtn" class='btn btn-sm btn-red tooltips' data-toggle="tooltip" data-placement="bottom" title="Changer votre mot de passe" alt="">
					<i class='fa fa-key'></i> 
					<span class="hidden-sm hidden-xs">
					<?php echo Yii::t("common","Change password"); ?>
					</span>
				</a>
				<a href='javascript:' id="downloadProfil" class='btn btn-sm btn-default tooltips' data-toggle="tooltip" data-placement="bottom" title="Télécharger votre profil" alt="">
					<i class='fa fa-download'></i><span class="hidden-sm hidden-xs"></span>
				</a>
			<?php } ?>
		<?php } ?>
		<a class="btn btn-sm btn-default tooltips" href="javascript:;" onclick="showDefinition('qrCodeContainerCl',true)" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("common","Show the QRCode for ").Yii::t("common","this ".$controller); ?>'><i class="fa fa-qrcode"></i> <?php echo Yii::t("common","QR Code") ?></a>

		<a class="btn btn-sm btn-default tooltips star_<?php echo $type ?>_<?php echo $element["_id"] ?>" href="javascript:collection.add2fav('<?php echo $type ?>','<?php echo $element["_id"] ?>');" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("common","Add this my favorites ") ?>'><i class="fa fa-star-o"></i></a>
	</div>
	<div id="activityContent" class="panel-body no-padding hide">
		<h2 class="homestead text-dark" style="padding:40px;">
			<i class="fa fa-spin fa-refresh"></i> Chargement des activités ...
		</h2>
	</div>
	<div id="divInformation" class="col-sm-12 col-md-12 padding-15">
		<div class="col-md-12 col-lg-12 col-xs-12 no-padding text-dark lbl-info-details">
			<i class="fa fa-map-marker"></i>  <?php echo Yii::t("common","Information") ?>
			<?php if($edit==true || $openEdition==true ){?>
				<a href="javascript:;" id="btn-update-info" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Update Contact information");?>"><i class="fa text-red fa-pencil"></i></a>
				<?php } ?>
		</div>
		<div class="col-md-12">
			<div class="no-padding col-md-12">
				<div id="divName">
					<span class="titleField text-dark"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common", "Name"); ?> :</span>
					<span id="name" class=""><?php if(isset($element["name"])) echo $element["name"]; else echo ""; ?></span>
				</div>

				<?php if($type==Person::COLLECTION){ ?>
				<div id="divUserName">
					<span class="titleField text-dark"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common", "Username"); ?> :</span>
					<span id="username"><?php if(isset($element["username"]) && ! isset($element["pending"])) echo $element["username"]; else echo "";?></span>
				</div>
				<?php } ?>

				<?php if($type==Organization::COLLECTION || $type==Event::COLLECTION){ ?>
				<div id="divType">
					<!-- <i class="fa fa-smile-o fa_name hidden"></i> -->
					<span class="titleField text-dark"><i class="fa fa-angle-right"></i>  <?php echo Yii::t("common", "Type"); ?> :</span>
					<span id="type" class=""><?php if(isset($element["type"])) echo Yii::t("common", $element["type"]); else echo ""; ?></span>
				</div>
				<?php } ?>


			</div>
		</div>

		<?php if($type==Person::COLLECTION){ ?>
				<div class="socialNetwork col-md-12">
					<div class="col-md-12 no-padding">
						<?php 
							$facebook = (!empty($element["socialNetwork"]["facebook"])? $element["socialNetwork"]["facebook"]:"#") ;
							$skype = (!empty($element["socialNetwork"]["skype"])? $element["socialNetwork"]["skype"]:"#") ;
							$twitter =  (!empty($element["socialNetwork"]["twitter"])? $element["socialNetwork"]["twitter"]:"#") ;
							$googleplus =  (!empty($element["socialNetwork"]["googleplus"])? $element["socialNetwork"]["googleplus"]:"#") ;
							$github =  (!empty($element["socialNetwork"]["github"])? $element["socialNetwork"]["github"]:"#") ;
							$telegram =  (!empty($element["socialNetwork"]["telegram"])? $element["socialNetwork"]["telegram"]:"Telegram") ;
						?>
						<span class="titleField text-dark"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common","Socials") ?> :</span>
						<a href="<?php echo $skype ; ?>" id="skypeAccount" class="socialIcon"><?php echo ($skype=="#"?"": '<i class="fa fa-skype"></i>') ; ?></a>
						<a href="<?php echo $facebook ; ?>" target="_blank" id="facebookAccount" class="socialIcon"><?php echo ($facebook=="#"?"": '<i class="fa fa-facebook"></i>') ; ?></a>
						<a href="<?php echo $twitter ;?>" target="_blank" id="twitterAccount" class="socialIcon"><?php echo ($twitter=="#"?"":'<i class="fa fa-twitter"></i>') ; ?></a>
						<a href="<?php echo $googleplus ;?>" target="_blank" id="gpplusAccount" class="socialIcon"><?php echo ($googleplus=="#"?"":'<i class="fa fa-google-plus"></i>') ; ?></a>
						<a href="<?php echo $github ;?>" target="_blank" id="gitHubAccount" class="socialIcon"><?php echo ($github=="#"?"":'<i class="fa fa-github"></i>') ; ?></a>
					</div>
					<div class="col-md-12 no-padding">
						<?php if(!empty($telegram) || ((string)$element["_id"] == Yii::app()->session["userId"] )){ ?>
									<span class="text-azure pull-left titleField" style="margin:8px 5px 0px 0px;"><i class="fa fa-angle-right"></i> Discuter en privé via :</span>
									<a 	href='<?php echo (($telegram!="Telegram") ? "https://web.telegram.org/#/im?p=@".$telegram:"https://telegram.org/");?>' id="telegramAccount" class="socialIcon" target="_blank"><i class="fa fa-send"></i><?php echo $telegram; ?></a> 
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<!-- class="form-group tag_group no-margin"-->
			<!-- <div id="divTags" class="col-md-12 no-padding" >
				<label class="control-label  text-red">
					<i class="fa fa-tags"></i> <?php //echo Yii::t("common","Tags") ?> : 
				</label>
				
				<a href="#" id="tags" data-type="select2" data-emptytext="<?php //echo Yii::t("common","empty")?>" data-original-title="<?php //echo Yii::t("common","Enter tagsList") ?>" class="text-red">
					<?php 
						/* if(isset($element["tags"])){
							$stringTags = "" ;
							foreach ($element["tags"] as $tag) {
								if($stringTags != "")
									$stringTags .= ", ";
								$stringTags .= $tag ;
							}
							echo $stringTags;
						} */
					?>
				</a>
			</div> -->
	</div>		
	<?php 
	//var_dump($admin);
	//if(!empty($admin) && $admin == true){
	//<!-- class=" col-lg-6 col-md-6 col-sm-6 col-xs-8"--> ?>
	<div class="panel-body border-light panelDetails" id="contentGeneralInfos">	
		<?php if($type==Project::COLLECTION){ ?>
			<div id="divAvancement" class="col-md-12 text-dark no-padding" style="margin-top:10px;">
				<a  href="#" id="avancement" data-type="select" data-title="avancement" 
					data-original-title="<?php echo Yii::t("project","Enter the project's maturity",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("project","Project maturity",null,Yii::app()->controller->module->id) ?>"
					class="entityDetails pull-left">
					<?php if(isset($element["properties"]["avancement"])){ 
						//idea => concept => Started => development => testing => mature
						if($element["properties"]["avancement"]=="idea")
							$val=5;
						else if($element["properties"]["avancement"]=="concept")
							$val=20;
						else if ($element["properties"]["avancement"]== "started")
							$val=40;
						else if ($element["properties"]["avancement"] == "development")
							$val=60;
						else if ($element["properties"]["avancement"] == "testing")
							$val=80;
						else 
							$val=100;
						echo Yii::t("project",$element["properties"]["avancement"],null,Yii::app()->controller->module->id);
					} ?>
				</a>
			</div>
			<?php } ?>
			

		<?php if($type==Event::COLLECTION || $type==Project::COLLECTION){ ?>
			<div class="col-md-12 col-lg-12 col-xs-12 no-padding" style="padding-right:10px !important;">
				<div class="col-md-12 col-lg-12 col-xs-12 no-padding">
					<div class="text-dark lbl-info-details margin-top-10">
						<a id="dateTimezone" href="javascript:;" class="tooltips text-dark" data-original-title="" data-toggle="tooltip" data-placement="right"><i class="fa fa-clock-o"></i>&nbsp;<?php echo Yii::t("common","When") ?> ?</a>
						<?php if($edit==true || $openEdition==true ){?>
						<a href="javascript:;" id="btn-update-when" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Update When");?>"><i class="fa text-red fa-pencil"></i></a>
						<?php } ?>
					</div>
				</div>
				<div class="col-md-12 col-lg-12 col-xs-12 entityDetails no-padding">
					<?php if($type==Event::COLLECTION ) { ?>
					<div class="col-xs-12 no-padding">
						<span><?php echo Yii::t("common","All day")?> : </span> <span id="allDay" class="" ><?php echo (isset($element["allDay"]) ? Yii::t("common","Yes") : Yii::t("common","No") ); ?></span>
					</div>
					<?php } ?>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","From") ?></span><span id="startDate" class="" ><?php echo (isset($element["startDate"]) ? $element["startDate"] : "" ); ?></span>
					</div>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","To") ?></span> <span id="endDate" class=""><?php echo (isset($element["endDate"]) ? $element["endDate"] : "" ); ?></span> 
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="row info-coordonnees entityDetails text-dark" style="margin-top: 10px !important;">
			<div class="col-md-6 col-sm-6  no-padding" style="padding-right: 25px !important;">
				<div class="text-dark lbl-info-details margin-top-10">
					<?php if($type==Event::COLLECTION){?>
						<i class="fa fa-map-marker"></i> <?php echo Yii::t("common","Where"); ?> ? 
					<?php }else{ ?>
						<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Localities"); ?>
					<?php } ?>
				</div>
				
				
				<?php if( ($type == Person::COLLECTION && Preference::showPreference($element, $type, "locality", Yii::app()->session["userId"])) ||  $type!=Person::COLLECTION) { ?>
				<!-- <a href="javascript:" id="btn-view-map" class="btn btn-primary btn-sm col-xs-6 hidden" style="margin: 10px 0px;">
					<i class="fa fa-map-marker" style="margin:0px !important;"></i> <?php echo Yii::t("common","Show map"); ?>
				</a> -->
				
				<div class="col-xs-12 no-padding">

					<div class="col-xs-12 padding-10">
					<?php if(! empty($element["address"])) {?> <i class="fa fa-home"></i> <?php } ?>
					
					<?php 
						$address = "";
						
						$address .= '<span id="detailStreetAddress">'.
										(( @$element["address"]["streetAddress"]) ? 
											$element["address"]["streetAddress"]."<br/>": 
											((@$element["address"]["codeInsee"])?"":Yii::t("common","Unknown Locality"))).
									'</span>';

						$address .= '<span id="detailCity">'.
										(( @$element["address"]["postalCode"]) ?
										 $element["address"]["postalCode"] :
										 "")
										." ".(( @$element["address"]["addressLocality"]) ? 
												 $element["address"]["addressLocality"] : "")
									.'</span>';
						
						$address .= '<span id="detailCountry">'.
										(( @$element["address"]["addressCountry"]) ?
										 " ".OpenData::$phCountries[ $element["address"]["addressCountry"] ] 
						 				: "").
						 			'</span>';

						echo $address;

						?>
						

						<?php 
						
						if(empty($element["address"]) && $type!=Person::COLLECTION && ($edit==true || $openEdition==true )){
							echo '	<a href="javascript:;" class="addresses btn btn-danger btn-sm" id="btn-update-geopos">
										<i class="fa fa-map-marker"></i>
										<span class="hidden-sm">'.Yii::t("common","Add a primary address").'</span>
									</a>' ;
						}else if(empty($element["address"]["codeInsee"]) && $type==Person::COLLECTION && ($edit==true || $openEdition==true )) {
							echo '<br/><a href="javascript:;" class="cobtn btn btn-danger btn-sm" style="margin: 10px 0px;">'.Yii::t("common", "Connect to your city").'</a> <a href="javascript:;" class="whycobtn btn btn-default btn-sm explainLink" style="margin: 10px 0px;" data-id="explainCommunectMe" >'. Yii::t("common", "Why ?").'</a>';
						}else{
							echo '<a href="javascript:;" id="btn-remove-geopos" class="pull-right tooltips" data-toggle="tooltip" data-placement="bottom" title="'.Yii::t("common","Remove Locality").'">
										<i class="fa text-red fa-trash-o"></i>
									</a>
									<a href="javascript:;" id="btn-update-geopos" class="pull-right tooltips" data-toggle="tooltip" data-placement="bottom" title="'.Yii::t("common","Update Locality").'" >
										<i class="fa text-red fa-map-marker"></i>
									</a> ';	
						}
						?>
						

					</div>

				<?php if($type!=Person::COLLECTION && !empty($element["address"]) && ($edit==true || $openEdition==true )) { ?>
					<a href='javascript:updateLocalityEntities("<?php echo count(@$element["addresses"]) ; ?>");' id="btn-add-geopos" class="btn btn-danger btn-sm col-xs-12 addresses" style="margin: 10px 0px;">
						<i class="fa fa-plus" style="margin:0px !important;"></i> 
						<span class="hidden-sm"><?php echo Yii::t("common","Add a secondary address"); ?></span>
					</a>
				<?php }
					if( @$element["addresses"] ){ 
						foreach ($element["addresses"] as $ix => $p) { ?>
						<div id="addresses_<?php echo $ix ; ?>" class="col-xs-12 padding-10" style="border-bottom:1px solid #CCC">
							<?php 
							$address = '<i class="fa fa-circle"></i> <span id="detailStreetAddress_'.$ix.'">'.(( @$p["address"]["streetAddress"]) ? $p["address"]["streetAddress"]."<br/>" : "").'</span>';
							$address .= '<span id="detailCity">'.(( @$p["address"]["postalCode"]) ? $p["address"]["postalCode"] : "")." ".(( @$p["address"]["addressLocality"]) ? $p["address"]["addressLocality"] : "").'</span>';
							$address .= '<span id="detailCountry_'.$ix.'">'.(( @$p["address"]["addressCountry"]) ? " ".OpenData::$phCountries[ $p["address"]["addressCountry"] ] : "").'</span>';
							echo $address;?>

							<a href='javascript:removeAddresses("<?php echo $ix ; ?>");'  class="addresses pull-right hidden tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Remove Locality");?>"><i class="fa text-red fa-trash-o"></i></a>
							<a href='javascript:updateLocalityEntities("<?php echo $ix ; ?>", <?php echo json_encode($p);?>);' class=" pull-right tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Update Locality");?>"><i class="fa text-red fa-map-marker hidden addresses"></i></a>
							
							
						</div>
				<?php 	} 
					} ?>
				</div>
				<?php } ?>
				<br>
				<?php 
						$address = ( @$element["address"]["streetAddress"]) ? $element["address"]["streetAddress"] : "";
						$address2 = ( @$element["address"]["postalCode"]) ? $element["address"]["postalCode"] : "";
						$address2 .= ( @$element["address"]["addressCountry"]) ? ", ".OpenData::$phCountries[ $element["address"]["addressCountry"] ] : "";
						

						$tel = "";
						$fax = "";
						$fixe = "";
						$mobile = "";
						if( @$element["telephone"]["fixe"]){
							foreach ($element["telephone"]["fixe"] as $key => $num) {
								$tel .= ($tel != "") ? ", ".trim($num) : trim($num);
								$fixe .= ($fixe != "") ? ", ".trim($num) : trim($num);
							}
						}
						if( @$element["telephone"]["mobile"]){
							foreach ($element["telephone"]["mobile"] as $key => $num) {
								$tel .= ($tel != "") ? ", ".trim($num) : trim($num);
								$mobile .= ($mobile != "") ? ", ".trim($num) : trim($num);
							}
						}
						if( @$element["telephone"]["fax"]){
							foreach ($element["telephone"]["fax"] as $key => $num) {
								$tel .= ($tel != "") ? ", ".trim($num) : trim($num);
								$fax .= ($fax != "") ? ", ".trim($num) : trim($num);
							}
						}

						$this->renderPartial('../pod/qrcode',array(
																"type" => @$element['type'],
																"name" => @$element['name'],
																"address" => $address,
																"address2" => $address2,
																"email" => @$element['email'],
																"url" => @$element["url"],
																"tel" => $tel,
																"img"=>@$element['profilThumbImageUrl']));
				?>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="text-dark lbl-info-details margin-top-10">
					<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Contact information"); ?>
					<?php if( $edit==true || $openEdition==true ){?>
					<a href='javascript:;' id="btn-update-contact" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Update Contact information");?>"><i class="fa text-red fa-pencil"></i></a>
					<?php } ?>
				</div>
				
				<?php if($type==Person::COLLECTION){
					if(Preference::showPreference($element, $type, "birthDate", Yii::app()->session["userId"])){ ?>
						<i class="fa fa-birthday-cake fa_birthDate hidden"></i> 
						<a href="#" id="birthDate" data-type="date" data-title="<?php echo Yii::t("person","Birth date"); ?>" data-emptytext="<?php echo Yii::t("person","Birth date"); ?>" class=""><?php echo (isset($element["birthDate"])) ? date("d/m/Y", strtotime($element["birthDate"]))  : null; ?></a>
						<br>
					<?php } 
				} ?>
				<?php 
					if(($type==Person::COLLECTION && Preference::showPreference($element, $type, "email", Yii::app()->session["userId"])) || ($type!=Person::COLLECTION && $type!=Event::COLLECTION)){ ?>
							<i class="fa fa-envelope fa_email  hidden"></i> 
							<span id="email"><?php echo (isset($element["email"])) ? $element["email"] : null; ?></span>
							<br/>
				<?php } ?>

				<?php //If there is no http:// in the url
				$scheme = "";
				if(isset($element["url"])){
					if (!preg_match("~^(?:f|ht)tps?://~i", $element["url"])) $scheme = 'http://';

				}?>
				
				<i class="fa fa-desktop fa_url hidden"></i> 
				<a href="<?php echo (isset($element["url"])) ? $scheme.$element['url'] : '#'; ?>" target="_blank" id="url" data-type="text" data-title="<?php echo Yii::t("common","Website URL") ?>" 
					data-emptytext="<?php echo Yii::t("common","Website URL") ?>" style="cursor:pointer;"><?php echo (isset($element["url"])) ? $element["url"] : ""; ?></a> 
				<br>
				<?php if($type==Project::COLLECTION){ ?>
					<i class="fa fa-file-text-o"></i>
					<span id="licence" class=""><?php if(isset($element["licence"])) echo $element["licence"];?></span><br>
				<?php } ?>

				<?php  if($type==Organization::COLLECTION || $type==Person::COLLECTION){ ?>
					<i class="fa fa-phone fa_telephone hidden"></i>
					<span id="fixe" class="telephone"><?php echo $fixe; ?></span>
					<br/>

					<i class="fa fa-mobile fa_telephone_mobile hidden"></i>
					<span id="mobile" class="telephone"><?php echo $mobile; ?></span>
					<br/>

					<i class="fa fa-fax fa_telephone_fax hidden"></i> 
					<span id="fax" class="telephone"><?php echo $fax; ?></span>
					<br/>
				<?php } ?>	
			</div>			
		</div>

		<?php if($type == Event::COLLECTION){ ?>
			<div class="col-md-12 col-lg-12 col-xs-12 no-padding" style="padding-right:10px !important; padding-bottom:5px !important">
				<div class="text-dark lbl-info-details margin-top-10">
					<i class="fa fa-angle-down"></i> <?php echo ucfirst(Yii::t("common","organizer")) ?>
					<?php if( $edit==true || $openEdition==true ){?>
						<a href='javascript:;' id="btn-update-organizer" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("event","Update the organizer");?>"><i class="fa text-red fa-pencil"></i></a>
					<?php } ?>
				</div>
			</div>
			
			<div class="col-sm-6 entityDetails item_map_list">
				<?php
					if (!empty($organizer["type"])) {
						if(@$organizer["type"]=="project"){
							echo Yii::t("event","By the project",null,Yii::app()->controller->module->id);
							$icon="fa-lightbulb-o";
							$color = "purple";
						} else if(@$organizer["type"]=="organization"){
							$icon="fa-users";
							$color = "green";
						} else {
							$icon="fa-user";
							$color = "yellow";
						}

						$img = '';//'<i class="fa '.$icon.' fa-3x"></i> ';
						if ($organizer && !empty($organizer["profilThumbImageUrl"])){ 
							$img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/'.$organizer['profilThumbImageUrl']).'">';
						}else{
							$img = "<div class='thumbnail-profil'></div>";
						}
						$flag = '<div class="ico-type-account"><i class="fa '.$icon.' fa-'.$color.'"></i></div>';
						echo '<div class="imgDiv left-col" style="padding-right: 10px;width: 75px;">'.$img.$flag.'</div>';
				?> 
					<a 	href="javascript:;" 
						onclick="loadByHash('#<?php echo @$organizer["type"]; ?>.detail.id.<?php echo @$organizer["id"]; ?>')"><?php echo @$organizer["name"]; ?></a><br/>
						<span><?php echo ucfirst(Yii::t("common", @$organizer["type"])); if (@$organizer["type"]=="organization") echo " - ".Yii::t("common", $organizer["typeOrga"]); ?></span>
				<?php
					} else {
						echo "Inconnu";
					}

					/*if (! @$organizer["type"]) {
						echo '	<a href="javascript:;" class="hidden btn btn-danger btn-sm col-xs-12" style="margin: 10px 0px;" id="btn-add-organizer">
									<i class="fa fa-vcard"></i>
									<span class="hidden-sm">'.Yii::t("event","Add an organizer").'</span>
								</a>' ;
					} else {
						echo '	<a href="javascript:;" class="hidden btn btn-danger btn-sm col-xs-12" style="margin: 10px 0px;" id="btn-update-organizer">
									<i class="fa fa-vcard"></i>
									<span class="hidden-sm">'.Yii::t("event","Update the organizer").'</span>
								</a>' ;
					}*/
				?>
			</div>
		<?php } ?>
		<!-- <div id="divShortDescription" class="col-xs-12 no-padding">
			<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> 
			<?php //echo Yii::t("common","Short description",null,Yii::app()->controller->module->id); ?></div>
			<a href="#" id="shortDescription" data-type="wysihtml5" data-original-title="<?php //echo Yii::t($controller,"Write the ".$controller."'s short description",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php //echo Yii::t("common","Short description",null,Yii::app()->controller->module->id); ?>" class=""><?php //echo (!empty($element["shortDescription"])) ? $element["shortDescription"] : ""; ?></a>	
		</div> -->

		<div class="col-xs-12 no-padding margin-top-10">
		  	<div class="text-dark lbl-info-details">
		  		<i class="fa fa-angle-down"></i> Description
		  		<?php if($edit==true || $openEdition==true ){?>
		  		<a href='javascript:;' id="btn-update-desc" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Update Description");?>"><i class="fa text-red fa-pencil"></i></a> <?php } ?>
		  	</div>
				<span id="description"  class=""><?php  echo (!empty($element["description"])) ? $element["description"] : ""; ?></span>
				<input type="hidden" id="descriptionMarkdown" name="descriptionMarkdown" value="<?php echo (!empty($element['description'])) ? $element['description'] : ''; ?>">
					
		</div>
	</div>
</div>

<?php
$emptyAddress = (empty($element["address"]["codeInsee"])?true:false);
$showOdesc = true ;
if(Person::COLLECTION == $type){
	$showLocality = (Preference::showPreference($element, $type, "locality", Yii::app()->session["userId"])?true:false);
	$showOdesc = ((Preference::isOpenData($element["preferences"]) && Preference::isPublic($element, "locality"))?true:false);	
}
$odesc = "" ;
if($showOdesc == true){
	$controller = Element::getControlerByCollection($type) ;
	if($type == Person::COLLECTION)
		$odesc = $controller." : ".addslashes( strip_tags(json_encode(@$element["shortDescription"]))).",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",".@$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"] ;
	else if($type == Organization::COLLECTION)
		$odesc = $controller." : ".@$element["type"].", ".addslashes( strip_tags(json_encode(@$element["shortDescription"]))).",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",".@$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"];
	else if($type == Event::COLLECTION)
		$odesc = $controller." : ".@$element["startDate"].",".@$element["endDate"].",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",". @$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"].",".addslashes(strip_tags(json_encode(@$element["shortDescription"])));
	else if($type == Project::COLLECTION)
		$odesc = $controller." : ".addslashes( strip_tags(json_encode(@$element["shortDescription"]))).",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",".@$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"];
}
?>

<script type="text/javascript">
	
	var edit = '<?php echo (@$edit == true) ? "true" : "false"; ?>';
	var openEdition = '<?php echo (@$openEdition == true) ? "true" : "false"; ?>';
	var showLocality = (( "<?php echo @$showLocality; ?>" == "<?php echo false; ?>")?false:true);
	if(	( showLocality == true && "<?php echo Person::COLLECTION; ?>" == contextData.type ) 
		|| "<?php echo Person::COLLECTION; ?>" != contextData.type) {
		contextData.geo = <?php echo json_encode(@$element["geo"]) ?>;
		contextData.geoPosition = <?php echo json_encode(@$element["geoPosition"]) ?>;
		contextData.address = <?php echo json_encode(@$element["address"]) ?>;
		contextData.addresses = <?php echo json_encode(@$element["addresses"]) ?>;
	}

	if(	edit == "true" || openEdition == "true") {
		contextData.email = '<?php if(isset($element["email"])) echo $element["email"]; else echo ""; ?>';
		contextData.url = '<?php if(isset($element["url"])) echo $element["url"]; else echo ""; ?>';
		contextData.fixe =parsePhone(<?php echo json_encode((isset($element["telephone"]["fixe"]) ? $element["telephone"]["fixe"] : array())); ?>);
		contextData.mobile = parsePhone(<?php echo json_encode((isset($element["telephone"]["mobile"]) ? $element["telephone"]["mobile"] : array())); ?>);
		contextData.fax = parsePhone(<?php echo json_encode((isset($element["telephone"]["fax"]) ? $element["telephone"]["fax"] : array())); ?>);
		contextData.tags = <?php echo json_encode((isset($element["tags"]) ? $element["tags"] : array())); ?>;

		if(contextData.type == "<?php echo Person::COLLECTION; ?>" ){
			contextData.username = '<?php if(isset($element["username"])) echo $element["username"]; else echo ""; ?>';
			contextData.birthDate = '<?php if(isset($element["birthDate"])) echo $element["birthDate"]; else echo ""; ?>';
			contextData.twitterAccount = '<?php if(isset($element["socialNetwork"]["twitter"])) echo $element["socialNetwork"]["twitter"]; else echo ""; ?>';
			contextData.gpplusAccount = '<?php if(isset($element["socialNetwork"]["googleplus"])) echo $element["socialNetwork"]["googleplus"]; else echo ""; ?>';
			contextData.gitHubAccount = '<?php if(isset($element["socialNetwork"]["github"])) echo $element["socialNetwork"]["github"]; else echo ""; ?>';
			contextData.skypeAccount = '<?php if(isset($element["socialNetwork"]["skype"])) echo $element["socialNetwork"]["skype"]; else echo ""; ?>';
			contextData.telegramAccount = '<?php if(isset($element["socialNetwork"]["telegram"])) echo $element["socialNetwork"]["telegram"]; else echo ""; ?>';
			contextData.facebookAccount = '<?php if(isset($element["socialNetwork"]["facebook"])) echo $element["socialNetwork"]["facebook"]; else echo ""; ?>';
		}
	}


	if(contextData.type == "<?php echo Organization::COLLECTION; ?>" ){
		contextData.typeOrga = '<?php if(isset($element["type"])) echo $element["type"]; else echo ""; ?>';
	}
	contextData.descriptionHTML = '<?php if(isset($element["descriptionHTML"])) echo $element["descriptionHTML"]; else echo ""; ?>';
	

	if(contextData.type == "<?php echo Event::COLLECTION; ?>"){
		contextData.allDay = '<?php echo (@$element["allDay"] == true) ? "true" : "false"; ?>';
	}

	if(contextData.type == "<?php echo Event::COLLECTION; ?>" || contextData.type == "<?php echo Project::COLLECTION; ?>" ){
		contextData.startDate = '<?php if(isset($element["startDate"])) echo $element["startDate"]; else echo ""; ?>';
		contextData.endDate = '<?php if(isset($element["endDate"])) echo $element["endDate"]; else echo "" ?>';
	}

	if(contextData.type == "<?php echo Project::COLLECTION; ?>" )
		contextData.avancement = '<?php if(isset($element["properties"]["avancement"])) echo $element["properties"]["avancement"]; else echo "" ?>' ;

	var formatDateView = "DD MMMM YYYY à HH:mm" ;
	var formatDatedynForm = "DD/MM/YYYY HH:mm" ;
	if(typeof contextData.allDay != "undefined" && contextData.allDay == "true"){
		formatDateView = "DD MMMM YYYY" ;
		formatDatedynForm = "DD/MM/YYYY" ;
	}

	//var emptyAddress = ((typeof(contextData.address) == "undefined" || contextData.address == null || typeof(contextData.address.codeInsee) == "undefined" || (typeof(contextData.address.codeInsee) != "undefined" && contextData.address.codeInsee == ""))?true:false);
	var emptyAddress = (( "<?php echo $emptyAddress; ?>" == "<?php echo false; ?>")?false:true);

	//var mode = "view";
	//var types = <?php //echo json_encode(@$elementTypes) ?>;
	//var countries = <?php //echo json_encode($countries) ?>;
	//var startDate = '<?php //if(isset($element["startDate"])) echo $element["startDate"]; else echo ""; ?>';
	//var endDate = '<?php // if(isset($element["endDate"])) echo $element["endDate"]; else echo "" ?>';
	//var allDay = '<?php //echo (@$element["allDay"] == true) ? "true" : "false"; ?>';
	
	//var modeEdit = '<?php echo (@$modeEdit == true) ? "true" : "false"; ?>';
	//var birthDate = '<?php echo (isset($person["birthDate"])) ? $person["birthDate"] : null; ?>';
	//var NGOCategoriesList = <?php //echo json_encode($NGOCategories) ?>;
	//var localBusinessCategoriesList = <?php //echo json_encode($localBusinessCategories) ?>;
	var seePreferences = '<?php echo (@$element["seePreferences"] == true) ? "true" : "false"; ?>';
	//var color = '<?php //echo Element::getColorIcon($type); ?>';
	//var icon = '<?php echo Element::getFaIcon($type); ?>';
	var speudoTelegram = '<?php echo @$element["socialNetwork"]["telegram"]; ?>';
	var organizer = <?php echo json_encode($organizer) ?>;
	//var tags = <?php echo json_encode($tags)?>;

	//var contentKeyBase = "<?php echo isset($contentKeyBase) ? $contentKeyBase : ""; ?>";
	//By default : view mode
	//var images = <?php //echo json_encode($images) ?>;
	
	//var publics = <?php //echo json_encode($publics) ?>;

	jQuery(document).ready(function() {
		//activateEditableContext();
		bindDynFormEditable();
		initDate();
		inintDescs();
		//manageAllDayElement(allDay);
		//manageModeContextElement();
		changeHiddenIconeElement(true);
		//manageDivEditElement();
		bindAboutPodElement();
		collection.applyColor(contextData.type,contextData.id);
		/*
		$("#btn-update-locality").click(function(){
			Sig.showMapElements(Sig.map, mapData);
		});*/

		if(!emptyAddress)
			$("#btn-view-map").removeClass('hidden');

		$("#btn-update-geopos").off().on( "click", function(){
			updateLocalityEntities();
		});

		$("#btn-add-geopos").off().on( "click", function(){
			updateLocalityEntities();
		});

		

		$("#btn-update-organizer").off().on( "click", function(){
			updateOrganizer();
		});
		/*$("#btn-add-organizer").off().on( "click", function(){
			updateOrganizer();
		});*/


		$("#btn-remove-geopos").off().on( "click", function(){
			var msg = "<?php echo Yii::t('common','Are you sure you want to delete the locality') ;?>" ;
			if(contextData.type == "<?php echo Person::COLLECTION; ?>")
				msg = "<?php echo Yii::t('common',"Are you sure you want to delete the locality ? You can't vote anymore in the citizen council of your city."); ?> ";

			bootbox.confirm({
				message: msg + "<span class='text-red'></span>",
				buttons: {
					confirm: {
						label: "<?php echo Yii::t('common','Yes');?>",
						className: 'btn-success'
					},
					cancel: {
						label: "<?php echo Yii::t('common','No');?>",
						className: 'btn-danger'
					}
				},
				callback: function (result) {
					if (!result) {
						return;
					} else {
						param = new Object;
				    	param.name = "locality";
				    	param.value = "";
				    	param.pk = contextData.id;
						$.ajax({
					        type: "POST",
					        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
					        data: param,
					       	dataType: "json",
					    	success: function(data){
						    	//
						    	if(data.result){
									if(contextData.type == "<?php echo Person::COLLECTION ;?>"){
										//Menu Left
										$("#btn-geoloc-auto-menu").attr("href", "javascript:");
										$('#btn-geoloc-auto-menu > span.lbl-btn-menu').html("Communectez-vous");
										$("#btn-geoloc-auto-menu").attr("onclick", "communecterUser()");
										$("#btn-geoloc-auto-menu").off().removeClass("lbh");
										//Dashbord
										$("#btn-menuSmall-mycity").attr("href", "javascript:");
										$("#btn-menuSmall-citizenCouncil").attr("href", "javascript:");
										//Multiscope
										$(".msg-scope-co").html("<i class='fa fa-cogs'></i> Paramétrer mon code postal</a>");
										//MenuSmall
										$(".hide-communected").show();
										$(".visible-communected").hide();
									}
									toastr.success(data.msg);
									loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
						    	}
						    }
						});
					}
				}
			});	

		});

		

		/*$("#btn-update-geopos-admin").click(function(){
			findGeoPosByAddress();
		});

		$("#btn-view-map").click(function(){
			showMap(true);
		});*/

		buildQRCode(contextData.type,contextData.id);

		/*$(".toggle-tag-dropdown").click(function(){ mylog.log("toogle");
			if(!$("#dropdown-content-multi-tag").hasClass('open'))
			setTimeout(function(){ $("#dropdown-content-multi-tag").addClass('open'); }, 300);
			$("#dropdown-content-multi-tag").addClass('open');
		});
		$(".toggle-scope-dropdown").click(function(){ mylog.log("toogle");
			if(!$("#dropdown-content-multi-scope").hasClass('open'))
			setTimeout(function(){ $("#dropdown-content-multi-scope").addClass('open'); }, 300);
		});*/

		if(emptyAddress){
			$(".cobtn,.whycobtn").removeClass("hidden");
			$(".cobtn").click(function () { 
				updateLocalityEntities();
			});
			/*mylog.log("modeEdit",modeEdit);
			if(modeEdit == "true"){
				switchModeElement();
			}*/
		}

	});

	function bindDynFormEditable(){

		
		$("#btn-update-when").off().on( "click", function(){

			var properties = {
				block : typeObjLib["hidden"],
				typeElement : typeObjLib["hidden"],
				isUpdate : typeObjLib["hiddenTrue"]	
			};

			
			if(contextData.type == "<?php echo Event::COLLECTION; ?>"){
				properties.allDay = typeObjLib["allDay"];
			}

			properties.startDate = typeObjLib["startDateInput"];
			properties.endDate = typeObjLib["endDateInput"];
			
			var dataUpdate = {
				block : "when",
		        id : contextData.id,
		        typeElement : contextData.type,
			};
			//25/01/2014 08:30
			
			if(contextData.startDate.length > 0)
				dataUpdate.startDate = moment(contextData.startDate).local().format(formatDatedynForm);

			if(contextData.endDate.length > 0)
				dataUpdate.endDate = moment(contextData.endDate).local().format(formatDatedynForm);

			mylog.log("dataUpdate", dataUpdate);

			var onLoads = {
				initWhen : function(){
					if(typeof contextData.allDay != "undefined" && contextData.allDay == "true")
						$("#ajaxFormModal #allDay").attr("checked");
				}
			};

			var beforeSave = function(){
				mylog.log("beforeSave");
		    	if($("#ajaxFormModal #allDay").length && $("#ajaxFormModal #allDay").val() == contextData.allDay)
		    		$("#ajaxFormModal #allDay").remove();

		    	if($("#ajaxFormModal #startDate").length && $("#ajaxFormModal #startDate").val() ==  contextData.startDate)
		    		$("#ajaxFormModal #startDate").remove();

		    	if($("#ajaxFormModal #endDate").length && $("#ajaxFormModal #endDate").val() ==  contextData.endDate)
		    		$("#ajaxFormModal #endDate").remove();

		    	var allDay = $("#ajaxFormModal #allDay").is(':checked');
		    	var dateformat = "DD/MM/YYYY";
		    	if (! allDay) 
		    		var dateformat = "DD/MM/YYYY HH:mm"
		    	$("#ajaxFormModal #startDate").val( moment( $("#ajaxFormModal #startDate").val(), dateformat).format());
				$("#ajaxFormModal #endDate").val( moment( $("#ajaxFormModal #endDate").val(), dateformat).format());
		    };

			var afterSave = function(data){
				mylog.dir(data);
				if(data.result && data.resultGoods.result){
					if(typeof data.resultGoods.values.allDay != "undefined"){
						contextData.allDay = data.resultGoods.values.allDay;
						$("#contentGeneralInfos #allDay").html(contextData.allDay);
					}  
					if(typeof data.resultGoods.values.endDate != "undefined"){
						contextData.startDate = data.resultGoods.values.startDate;
						$("#contentGeneralInfos #startDate").html(moment(contextData.startDate).local().format(formatDateView));
					}  
					if(typeof data.resultGoods.values.endDate != "undefined"){
						contextData.endDate = data.resultGoods.values.endDate;
						$("#contentGeneralInfos #endDate").html(moment(contextData.endDate).local().format(formatDateView));
					}  
					updateCalendar();
				}

				elementLib.closeForm();
			};
			
			var saveUrl = baseUrl+"/"+moduleId+"/element/updateblock/type/"+contextType;
			elementLib.editDynForm("Modifier les dates", "fa-calendar", properties, "initWhen", dataUpdate, saveUrl, onLoads, beforeSave, afterSave);
		});


		$("#btn-update-info").off().on( "click", function(){

			var properties = {
				block : typeObjLib.hidden,
				name : typeObjLib.name,
				typeElement : typeObjLib.hidden,
				//shortDescription : typeObjLib.description,
				isUpdate : typeObjLib["hiddenTrue"]		
			};

			if(contextData.type == "<?php echo Person::COLLECTION; ?>" ){
				properties.username = typeObjLib["username"];
				properties.similarLink = typeObjLib["similarLink"];
				properties.tags = typeObjLib["tags"];
				properties.telegramAccount = typeObjLib["telegram"];
				properties.gitHubAccount = typeObjLib["github"];
				properties.skypeAccount = typeObjLib["skype"];
				properties.gpplusAccount = typeObjLib["googleplus"];
		        properties.twitterAccount = typeObjLib["twitter"];
		        properties.facebookAccount = typeObjLib["facebook"];
			}

			if(contextData.type == "<?php echo Organization::COLLECTION; ?>" ){
				properties.type = typeObjLib["typeOrga"];
				properties.tags = typeObjLib["tags"];
			}

			if(contextData.type == "<?php echo Project::COLLECTION; ?>" ){
				properties.avancement = typeObjLib["avancementProject"];
			}

			var dataUpdate = {
				block : "info",
		        id : contextData.id,
		        typeElement : contextData.type,
		        name : contextData.name,	
			};
			
			if(contextData.tags.length > 0)
				dataUpdate.tags = contextData.tags;

			/*if($("#shortDescriptionMarkdown").val().length > 0)
				dataUpdate.shortDescription = $("#shortDescriptionMarkdown").val();*/

			if(contextData.type == "<?php echo Person::COLLECTION; ?>" ){
				if(contextData.username.length > 0)
					dataUpdate.username = contextData.username;
				if(contextData.twitterAccount.length > 0)
					dataUpdate.twitterAccount = contextData.twitterAccount;
				if(contextData.gpplusAccount.length > 0)
					dataUpdate.gpplusAccount = contextData.gpplusAccount;
				if(contextData.gitHubAccount.length > 0)
					dataUpdate.gitHubAccount = contextData.gitHubAccount;
				if(contextData.skypeAccount.length > 0)
					dataUpdate.skypeAccount = contextData.skypeAccount;
				if(contextData.telegramAccount.length > 0)
					dataUpdate.telegramAccount = contextData.telegramAccount;
				if(contextData.facebookAccount.length > 0)
					dataUpdate.facebookAccount = contextData.facebookAccount;
			}

			if(contextData.type == "<?php echo Organization::COLLECTION; ?>" ){
				if(contextData.typeOrga.length > 0)
					dataUpdate.type = contextData.typeOrga;
			}
			if(contextData.type == "<?php echo Project::COLLECTION; ?>" ){
				if(contextData.avancement.length > 0)
					dataUpdate.avancement = contextData.avancement;
			}


			mylog.log("dataUpdate", dataUpdate);

			var onLoads = null;

			
			var beforeSave = function(){
				mylog.log("beforeSave");
		    	if($("#ajaxFormModal #name").length && $("#ajaxFormModal #name").val() == contextData.name)
		    		$("#ajaxFormModal #name").remove();

		    	if($("#ajaxFormModal #tags").length && $("#ajaxFormModal #tags").val() ==  contextData.tags)
		    		$("#ajaxFormModal #tags").remove();

		    	if(contextData.type == "<?php echo Person::COLLECTION; ?>" ){
			    	if($("#ajaxFormModal #username").length && $("#ajaxFormModal #username").val() == contextData.username)
			    		$("#ajaxFormModal #username").remove();

			    	if($("#ajaxFormModal #telegramAccount").length && $("#ajaxFormModal #telegramAccount").val() ==  contextData.telegramAccount)
			    		$("#ajaxFormModal #telegramAccount").remove();

			    	if($("#ajaxFormModal #gitHubAccount").length && $("#ajaxFormModal #gitHubAccount").val() == contextData.gitHubAccount)
			    		$("#ajaxFormModal #gitHubAccount").remove();

			    	if($("#ajaxFormModal #skypeAccount").length && $("#ajaxFormModal #skypeAccount").val() ==  contextData.skypeAccount)
			    		$("#ajaxFormModal #skypeAccount").remove();

			    	if($("#ajaxFormModal #twitterAccount").length && $("#ajaxFormModal #twitterAccount").val() ==  contextData.twitterAccount)
			    		$("#ajaxFormModal #twitterAccount").remove();

			    	if($("#ajaxFormModal #facebookAccount").length && $("#ajaxFormModal #facebookAccount").val() ==  contextData.facebookAccount)
			    		$("#ajaxFormModal #facebookAccount").remove();
			    }

			    if(contextData.type == "<?php echo Organization::COLLECTION; ?>" ){
					if($("#ajaxFormModal #type").length && $("#ajaxFormModal #type").val() ==  contextData.typeOrga)
			    		$("#ajaxFormModal #type").remove();
				}

				if(contextData.type == "<?php echo Project::COLLECTION; ?>" ){
					if($("#ajaxFormModal #avancement").length && $("#ajaxFormModal #avancement").val() ==  contextData.avancement)
			    		$("#ajaxFormModal #avancement").remove();
				}
				

		    };

			var afterSave = function(data){
				mylog.dir(data);
				if(data.result && data.resultGoods.result){

					if(typeof data.resultGoods.values.name != "undefined"){
						contextData.name = data.resultGoods.values.name;
						$("#nameHeader").html(contextData.name);
						$("#contentGeneralInfos #name").html(contextData.name);
					}

					if(typeof data.resultGoods.values.username != "undefined"){
						contextData.username = data.resultGoods.values.username;
						$("#contentGeneralInfos #username").html(contextData.username);
					}


					/*if(typeof data.resultGoods.values.shortDescription != "undefined"){
						$("#shortDescriptionMarkdown").val(data.resultGoods.values.shortDescription);
						$("#shortDescriptionHeader").html(markdownToHtml($("#shortDescriptionMarkdown").val()));
					}  */ 
						
					if(typeof data.resultGoods.values.tags != "undefined"){
						contextData.tags = data.resultGoods.values.tags;
						var str = "";
						if($('#divTagsHeader').length){
							$.each(contextData.tags, function (key, tag){
								str +=	'<div class="tag label label-danger pull-right" data-val="'+tag+'">'+
											'<i class="fa fa-tag"></i>'+tag+
										'</div>';
								if(typeof globalTheme == "undefined" || globalTheme != "network")
									addTagToMultitag(tag);
							});
						}
						$('#divTagsHeader').html(str);
					}

					if(typeof data.resultGoods.values.avancement != "undefined"){
						contextData.avancement = data.resultGoods.values.avancement.trim();
						val=0;
				    	if(contextData.avancement=="idea")
							val=5;
						else if(contextData.avancement=="concept")
							val=20;
						else if (contextData.avancement== "started")
							val=40;
						else if (contextData.avancement == "development")
							val=60;
						else if (contextData.avancement == "testing")
							val=80;
						else if (contextData.avancement == "mature")
							val=100;
						$('#progressStyle').val(val);
						$('#labelProgressStyle').html(contextData.avancement);
					}

					if(typeof data.resultGoods.values.telegramAccount != "undefined"){
						speudoTelegram = contextData.telegramAccount.trim();
						$('#contentGeneralInfos #telegramAccount').attr('href', 'https://web.telegram.org/#/im?p=@'+speudoTelegram);
						$('#contentGeneralInfos #telegramAccount').html('<i class="fa telegramAccount text-white"></i>'+speudoTelegram);
					}

					if(typeof data.resultGoods.values.facebookAccount != "undefined"){
						contextData.facebookAccount = data.resultGoods.values.facebookAccount.trim();
						var iconNetwork = ((contextData.facebookAccount=="")?"":'<i class="fa fa-facebook"></i>');
						changeNetwork('#contentGeneralInfos #facebookAccount', contextData.facebookAccount, iconNetwork);
					}

					if(typeof data.resultGoods.values.twitterAccount != "undefined"){
						contextData.twitterAccount = data.resultGoods.values.twitterAccount.trim();
						var iconNetwork = ((contextData.twitterAccount=="")?"":'<i class="fa fa-twitter"></i>');
						changeNetwork('#contentGeneralInfos #twitterAccount', contextData.twitterAccount, iconNetwork);
					}

					if(typeof data.resultGoods.values.gitHubAccount != "undefined"){
						contextData.gitHubAccount = data.resultGoods.values.gitHubAccount.trim();
						var iconNetwork = ((contextData.gitHubAccount=="")?"":'<i class="fa fa-github"></i>');
						changeNetwork('#contentGeneralInfos #gitHubAccount', contextData.gitHubAccount, iconNetwork);
					}

					if(typeof data.resultGoods.values.skypeAccount != "undefined"){
						contextData.skypeAccount = data.resultGoods.values.skypeAccount.trim();
						var iconNetwork = ((contextData.skypeAccount=="")?"":'<i class="fa fa-skype"></i>');
						changeNetwork('#contentGeneralInfos #skypeAccount', contextData.skypeAccount, iconNetwork);
					}

					if(typeof data.resultGoods.values.gpplusAccount != "undefined"){
						contextData.gpplusAccount = data.resultGoods.values.gpplusAccount.trim();
						var iconNetwork = ((contextData.gpplusAccount=="")?"":'<i class="fa fa-google-plus"></i>');
						changeNetwork('#contentGeneralInfos #gpplusAccount', contextData.gpplusAccount, iconNetwork);
					}

					if(typeof data.resultGoods.values.type != "undefined"){
						contextData.typeOrga = data.resultGoods.values.typeOrga;
						$("#typeHeader").html(contextData.typeOrga);
						$("#contentGeneralInfos #type").html(contextData.typeOrga);
					}
				}
				elementLib.closeForm();
				changeHiddenIconeElement(false);
			};
			
			var saveUrl = baseUrl+"/"+moduleId+"/element/updateblock/type/"+contextType;
			elementLib.editDynForm("Modifier les coordonnées", "fa-pencil", properties, "", dataUpdate, saveUrl, onLoads, beforeSave, afterSave);
		});

		$("#btn-update-contact").off().on( "click", function(){

			var properties = {
				email : typeObjLib["email"],
				url : typeObjLib["url"],
				birthDate : typeObjLib["birthDate"],
				fixe: typeObjLib["phone"],
				mobile: typeObjLib["mobile"],
				fax: typeObjLib["fax"],
		        typeElement : typeObjLib["hidden"],
		        block : typeObjLib["hidden"],
		        isUpdate : typeObjLib["hiddenTrue"]
			};

			var dataUpdate = {
				block : "contact",
		        id : contextData.id,
		        typeElement : contextData.type
			};
			if($("#contentGeneralInfos #email").html() != "") 
				dataUpdate.email = $("#contentGeneralInfos #email").html();
			if($("#contentGeneralInfos #url").html() != "") 
				dataUpdate.url = $("#contentGeneralInfos #url").html();
			if($("#contentGeneralInfos #birthDate").html().length > 0)
				dataUpdate.birthDate = $("#contentGeneralInfos #birthDate").html();
			if($("#contentGeneralInfos #fixe").html().length > 0)
				dataUpdate.fixe = $("#contentGeneralInfos #fixe").html();
			if($("#contentGeneralInfos #mobile").html().length > 0)
				dataUpdate.mobile = $("#contentGeneralInfos #mobile").html();
			if($("#contentGeneralInfos #fax").html().length > 0)
				dataUpdate.fax = $("#contentGeneralInfos #fax").html();

			

			mylog.log("dataUpdate", dataUpdate);

			var onLoads = {
				initUpdateInfo : function(){
					mylog.log("initUpdateInfo");
					$(".emailtext").slideToggle();
				}
			};

			;
			var beforeSave = function(){
				mylog.log("beforeSave");
		    	if($("#ajaxFormModal #url").length && $("#ajaxFormModal #url").val() == contextData.url)
		    		$("#ajaxFormModal #url").remove();

		    	if($("#ajaxFormModal #email").length && $("#ajaxFormModal #email").val() == contextData.email)
		    		$("#ajaxFormModal #email").remove();

		    	if($("#ajaxFormModal #birthDate").length && $("#ajaxFormModal #birthDate").val() ==  contextData.birthDate)
		    		$("#ajaxFormModal #birthDate").remove();

		    	if($("#ajaxFormModal #fixe").length && $("#ajaxFormModal #fixe").val() ==  contextData.fixe)
		    		$("#ajaxFormModal #fixe").remove();
		    	
		    	if($("#ajaxFormModal #mobile").length && $("#ajaxFormModal #mobile").val() == contextData.mobile)
		    		$("#ajaxFormModal #mobile").remove();

		    	if($("#ajaxFormModal #fax").length && $("#ajaxFormModal #fax").val() ==  contextData.fax)
		    		$("#ajaxFormModal #fax").remove();
		    };

			var afterSave = function(data){
				mylog.dir(data);
				if(data.result && data.resultGoods.result){
					if(typeof data.resultGoods.values.email != "undefined"){
						mylog.log("update email");
						contextData.email = data.resultGoods.values.email;
						$("#contentGeneralInfos #email").html(contextData.email);
					}

					if(typeof data.resultGoods.values.url != "undefined"){
						mylog.log("update url");
						contextData.url = data.resultGoods.values.url;
						$("#contentGeneralInfos #url").html(contextData.url);
						$("#contentGeneralInfos #url").attr("href", url);
					}  
						
					if(typeof data.resultGoods.values.birthDate != "undefined"){
						mylog.log("update birthDate");
						contextData.birthDate = data.resultGoods.values.birthDate;
						$("#contentGeneralInfos #birthDate").html(contextData.birthDate);
					}

					if(typeof data.resultGoods.values.fixe != "undefined"){
						mylog.log("update fixe");
						contextData.fixe = parsePhone(data.resultGoods.values.fixe);
						$("#contentGeneralInfos #fixe").html(str);
					}

					if(typeof data.resultGoods.values.mobile != "undefined"){
						mylog.log("update mobile");
						contextData.mobile = parsePhone(data.resultGoods.values.mobile);
						$("#contentGeneralInfos #mobile").html(contextData.mobile);
					}

					if(typeof data.resultGoods.values.fax != "undefined"){
						mylog.log("update fax");
						contextData.fax = parsePhone(data.resultGoods.values.fax);
						$("#contentGeneralInfos #fax").html(contextData.fax);
					}
				}
				elementLib.closeForm();
				changeHiddenIconeElement(false);
			};
			
			var saveUrl = baseUrl+"/"+moduleId+"/element/updateblock/type/"+contextType;
			elementLib.editDynForm("Modifier les coordonnées", "fa-pencil", properties, "initUpdateInfo", dataUpdate, saveUrl, onLoads, beforeSave, afterSave);
		});

		$("#btn-update-desc").off().on( "click", function(){
			var dataUpdate = { value : $("#descriptionMarkdown").val() } ;
			var properties = {
				value : typeObjLib["description"],
				pk : {
		            inputType : "hidden",
		            value : contextData.id
		        },
				name: {
		            inputType : "hidden",
		            value : "description"
		        }
			};

			var onLoads = {
				markdown : function(){
					mylog.log("#btn-update-desc #ajaxFormModal #description");
					activateMarkdown("#ajaxFormModal #value");
				}
			};
			var beforeSave = null ;

			var afterSave = function(data){
				$("#description").html(markdownToHtml(data.description));
				$("#descriptionMarkdown").val(data.description);
				elementLib.closeForm();		
			};
			
			var saveUrl = baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType;
			elementLib.editDynForm("Modifier la description", "fa-pencil", properties, "markdown", dataUpdate, saveUrl, onLoads, beforeSave, afterSave);
		});
	}

	function parsePhone(arrayPhones){
		var str = "";
		$.each(arrayPhones, function(i,num) {
			if(str != "")
				str += ", ";
			str += num.trim();
		});
		return str ;
	}

	function bindAboutPodElement() {
		/*$("#editGeoPosition").click(function(){
			Sig.startModifyGeoposition(contextData.id, "<?php echo $type ?>", contextData);
			showMap(true);
		});*/

		/*$("#editElementDetail").on("click", function(){
				switchModeElement();
		});*/

		$("#changePasswordBtn").click(function () {
			mylog.log("changePasswordbuttton");
			loadByHash('#person.changepassword.id.'+userId+'.mode.initSV', false);
		});

		$("#downloadProfil").click(function () {
			$.ajax({
				url: baseUrl + "/communecter/data/get/type/citoyens/id/"+contextData.id ,
				type: 'POST',
				dataType: 'json',
				async:false,
				crossDomain:true,
				complete: function () {},
				success: function (obj){
					mylog.log("obj", obj);
					$("<a/>", {
					    "download": "profil.json",
					    "href" : "data:application/json," + encodeURIComponent(JSON.stringify(obj))
					  }).appendTo("body")
					  .click(function() {
					    $(this).remove()
					  })[0].click() ;
				},
				error: function (error) {
					
				}
			});
		});

	    $(".confidentialitySettings").click(function(){
	    	param = new Object;
	    	param.type = $(this).attr("type");
	    	param.value = $(this).attr("value");
	    	param.typeEntity = "<?php echo $type; ?>";
	    	param.idEntity = contextData.id;
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

		$("#editConfidentialityBtn").on("click", function(){
	    	mylog.log("confidentiality", seePreferences);
	    	$("#modal-confidentiality").modal("show");
	    	if(seePreferences=="true"){
	    		param = new Object;
		    	param.name = "seePreferences";
		    	param.value = false;
		    	param.pk = contextData.id;
				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			        data: param,
			       	dataType: "json",
			    	success: function(data){
				    	//toastr.success(data.msg);
				    	if(data.result){
							$("#divSeePreferencesHeader").addClass("hidden");
							$('#editConfidentialityBtn').removeClass("btn-red");
				    	}
				    }
				});
	    	}
	    	
	    });

		$(".panel-btn-confidentiality .btn").click(function(){
			var type = $(this).attr("type");
			var value = $(this).attr("value");
			$(".btn-group-"+type + " .btn").removeClass("active");
			$(this).addClass("active");
		});


	}

	/*function switchModeElement() {
		mylog.log("-------------"+mode);
		if(mode == "view"){
			mode = "update";
			//$(".editProfilLbl").html(" Enregistrer les changements");
			//$("#editElementDetail").addClass("btn-red");
			if(!emptyAddress)
				$(".cobtn,.whycobtn,.cobtnHeader,.whycobtnHeader").addClass("hidden");
		}else{
			mode ="view";
			//$(".editProfilLbl").html(" Éditer");
			//$("#editElementDetail").removeClass("btn-red");
			if(emptyAddress)
				$(".cobtn,.whycobtn,.cobtnHeader,.whycobtnHeader").removeClass("hidden");

		}
		changeHiddenIconeElement(false);
	}*/


	function manageSocialNetwork(iconObject, value) {
		mylog.log("-----------------manageSocialNetwork----------------------");
		tabId2Icon = {"facebookAccount" : "fa-facebook", "twitterAccount" : "fa-twitter", 
				"gpplusAccount" : "fa-google-plus", "gitHubAccount" : "fa-github", 
				"skypeAccount" : "fa-skype", "telegramAccount" : "fa-send"}

		var fa = tabId2Icon[iconObject.attr("id")];
		iconObject.empty();
		if (value != "") {
			
			//else{
			if(iconObject.attr("id") != "telegramAccount"){
				iconObject.tooltip({title: value, placement: "bottom"});
				iconObject.html('<i class="fa '+fa+' fa-blue"></i>');
			}
		} 

		if(iconObject.attr("id") == "telegramAccount"){
			iconObject.tooltip({title: value, placement: "left"});
			if(speudoTelegram != "")
				iconObject.html('<i class="fa '+fa+' text-white"></i> '+speudoTelegram);
			else
				iconObject.html('<i class="fa '+fa+' text-white"></i> Telegram');
		}
	}

	function changeHiddenIconeElement(init) { 
		mylog.log("-----------------changeHiddenIconeElement----------------------");
		//
		listIcones = [	".fa_birthDate", ".fa_email", ".fa_telephone_mobile",
						".fa_telephone",".fa_telephone_fax",".fa_url" , ".fa-file-text-o"];

		listXeditablesId = ['#birthDate',"#email", "#mobile", "#fixe", "#fax","#url", "#licence"];
		$.each(listIcones, function(i,value) {
			mylog.log("listIcones", value, listXeditablesId[i]);
			if($("#contentGeneralInfos "+listXeditablesId[i]).text().length == 0)
				$(value).addClass("hidden");
			else
				$(value).removeClass("hidden"); 
		});
		
	}

	function updateCalendar() {
		if(contextData.type == "<?php echo Event::COLLECTION;?>"){
			getAjax(".calendar",baseUrl+"/"+moduleId+"/event/calendarview/id/"+contextData.id +"/pod/1?date=1",null,"html");
		}
	}

	/*function returnttags() {
		mylog.log("------------- returnttags -------------------");
		var tags = <?php echo (isset($element["tags"])) ? json_encode(implode(",", $element["tags"])) : "''"; ?>;
		//var tags = <?php echo (isset($element["tags"])) ? json_encode( $element["tags"]) : "''"; ?>;

		return tags ;
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

	    mylog.log(tel);
		return tel ;
	}*/
	//modification de la position geographique	

/* function findGeoPosByAddress(){
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
		mylog.log(request);
		findGeoposByNominatim(request);
	}
}

//quand la recherche nominatim a fonctionné
function callbackNominatimSuccess(obj){
	mylog.log("callbackNominatimSuccess");
	//si nominatim a trouvé un/des resultats
	if (obj.length > 0) {
		//on utilise les coordonnées du premier resultat
		var coords = L.latLng(obj[0].lat, obj[0].lon);
		//et on affiche le marker sur la carte à cette position
		mylog.log("showGeoposFound coords", coords);
		mylog.dir("showGeoposFound obj", obj);

		//si la donné n'est pas geolocalisé
		//on lui rajoute les coordonées trouvés
		//if(typeof contextData["geo"] == "undefined")
		contextData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };

		showGeoposFound(coords, contextData.id, "organizations", contextData);
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
	mylog.log("callbackFindByInseeSuccess");
	//si on a bien un résultat
	if (typeof obj != "undefined" && obj != "") {
		//récupère les coordonnées
		var coords = Sig.getCoordinates(obj, "markerSingle");
		//si on a une geoShape on l'affiche
		if(typeof obj.geoShape != "undefined") Sig.showPolygon(obj.geoShape);
		
		contextData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
		//on affiche le marker sur la carte
		showGeoposFound(coords, contextData.id, "organizations", contextData);
	}
	else {
		mylog.log("Erreur getlatlngbyinsee vide");
	}
}


//en cas d'erreur nominatim
function callbackNominatimError(error){
	mylog.log("callbackNominatimError", error);
}

//quand la recherche par code insee n'a pas fonctionné
function callbackFindByInseeError(){
	mylog.log("erreur getlatlngbyinsee", error);
}
*/

function removeAddresses (index){

	bootbox.confirm({
		message: "<?php echo Yii::t('common','Are you sure you want to delete the locality') ?><span class='text-red'></span>",
		buttons: {
			confirm: {
				label: "<?php echo Yii::t('common','Yes');?>",
				className: 'btn-success'
			},
			cancel: {
				label: "<?php echo Yii::t('common','No');?>",
				className: 'btn-danger'
			}
		},
		callback: function (result) {
			if (!result) {
				return;
			} else {
				var addresses = { addressesIndex : index };
				var param = new Object;
				param.name = "addresses";
				param.value = addresses;
				param.pk = contextData.id;
				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			        data: param,
			       	dataType: "json",
			    	success: function(data){
				    	if(data.result){
							toastr.success(data.msg);
							loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
				    	}
				    }
				});
			}
		}
	});		
}

function updateOrganizer() {
	bootbox.confirm({
		message: 
			"<?php echo Yii::t("event","Update the organizer") ?>"+
			buildSelect("organizerId", "organizerId", {"inputType" : "select", "options" : firstOptions(), "groupOptions":myAdminList( ["organizations","projects"] )}, ""),
		buttons: {
			confirm: {
				label: "<?php echo Yii::t("event","Update the organizer");?>",
				className: 'btn-success'
			},
			cancel: {
				label: "<?php echo Yii::t('common','Annuler');?>",
				className: 'btn-danger'
			}
		},
		
		callback: function (result) {
			if (!result) {
				return;
			} else {
				var organizer = { "organizerId" : organizerId, "organizerType" : organizerType };

				var param = new Object;
				param.name = "organizer";
				param.value = organizer;
				param.pk = contextData.id;
				$.ajax({
			        type: "POST",
			        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			        data: param,
			       	dataType: "json",
			    	success: function(data){
				    	if(data.result){
							toastr.success(data.msg);
							loadByHash("#"+contextData.controller+".detail.id."+contextData.id);
				    	} else {
				    		toastr.error(data.msg);
				    	}
				    }
				});
			}
		}
	}).init(function(){
    	console.log("init de la bootbox !");
    	$("#organizerId").off().on("change",function(){
    		organizerId = $(this).val();
    		if(organizerId == "dontKnow" )
    			organizerType = "dontKnow";
    		else if( $('#organizerId').find(':selected').data('type') && typeObj[$('#organizerId').find(':selected').data('type')] )
    			organizerType = typeObj[$('#organizerId').find(':selected').data('type')].col;
    		else
    			organizerType = typeObj["person"].col;

    		mylog.warn( "organizer",organizerId,organizerType );
    		$("#ajaxFormModal #organizerType ").val( organizerType );
    	});
    })
}
	
function buildSelect(id, field, fieldObj,formValues) {
	var fieldClass = (fieldObj.class) ? fieldObj.class : '';
	var placeholder = (fieldObj.placeholder) ? fieldObj.placeholder+required : '';
	var fieldHTML = "";
	if ( fieldObj.inputType == "select" || fieldObj.inputType == "selectMultiple" ) 
    {
   		var multiple = (fieldObj.inputType == "selectMultiple") ? 'multiple="multiple"' : '';
   		mylog.log("build field "+field+">>>>>> select selectMultiple");
   		var isSelect2 = (fieldObj.isSelect2) ? "select2Input" : "";
   		fieldHTML += '<select class="'+isSelect2+' '+fieldClass+'" '+multiple+' name="'+field+'" id="'+field+'" style="width: 100%;height:30px;" data-placeholder="'+placeholder+'">';
		if(placeholder)
			fieldHTML += '<option class="text-red" style="font-weight:bold" disabled selected>'+placeholder+'</option>';
		else
			fieldHTML += '<option></option>';

		var selected = "";
		
		//initialize values
		if(fieldObj.options)
			fieldHTML += buildSelectOptions(fieldObj.options, fieldObj.value);
		
		if( fieldObj.groupOptions ){
			fieldHTML += buildSelectGroupOptions(fieldObj.groupOptions, fieldObj.value);
		} 
		fieldHTML += '</select>';
    }
    return fieldHTML;
}



function changeNetwork(id, url, str){
	mylog.log("changeNetwork", id, url, str);
	$(id).attr('href', url);
	$(id).html(str);
}

function initDate() {//DD/mm/YYYY hh:mm
	if($("#contentGeneralInfos #startDate").html() != "")
    	$("#contentGeneralInfos #startDate").html(moment($("#contentGeneralInfos #startDate").html()).local().format(formatDateView));
    if($("#contentGeneralInfos #endDate").html() != "")
    	$("#contentGeneralInfos #endDate").html(moment($("#contentGeneralInfos #endDate").html()).local().format(formatDateView));
    $('#dateTimezone').attr('data-original-title', "Fuseau horaire : GMT " + moment().local().format("Z"));
}

function descHtmlToMarkdown() {
	mylog.log("htmlToMarkdown");
	if(typeof contextData.descriptionHTML != "undefined" && contextData.descriptionHTML == "1"){
		if($("#contentGeneralInfos #description").html() != ""){
			var descToMarkdown = toMarkdown($("#contentGeneralInfos #descriptionMarkdown").val()) ;
			mylog.log("descToMarkdown", descToMarkdown);
    		$("#contentGeneralInfos #descriptionMarkdown").html(descToMarkdown);
			var param = new Object;
			param.name = "description";
			param.value = descToMarkdown;
			param.id = contextData.id;
			param.typeElement = contextType;
			param.block = "toMarkdown";
    		$.ajax({
		        type: "POST",
		       	url : baseUrl+"/"+moduleId+"/element/updateblock/type/"+contextType,
		        data: param,
		       	dataType: "json",
		    	success: function(data){
		    		mylog.log("here");
			    	toastr.success(data.msg);
			    }
			});
			mylog.log("param", param);
		}
	}
}


function inintDescs() {
	mylog.log("inintDescs");
	descHtmlToMarkdown();
	mylog.log("after");
	$("#description").html(markdownToHtml($("#descriptionMarkdown").val()));
	//$("#shortDescriptionHeader").html(markdownToHtml($("#shortDescriptionMarkdown").val()));
}

</script>