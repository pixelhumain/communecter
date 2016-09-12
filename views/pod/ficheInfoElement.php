<?php 
	
/*$cssAnsScriptFilesModule = array(

	'/plugins/jquery.qrcode/jquery-qrcode.min.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");*/

$cssAnsScriptFilesModule = array(
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule , $this->module->assetsUrl);

?>
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

    .titleField{
    	font-weight: 400;
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
	}

    .panel-title{
    	font-weight: 200;
    	font-size: 21px;
    	font-family: "homestead";
    }

    #telegramAccount {
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

</style>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title text-dark"> 
			<i class="fa fa-info-circle"></i> <?php echo Yii::t("common","Account info") ?>
		</h4>
	</div>
	<div id="divBtnDetail" class="panel-tools" >
		<a href="javascript:;" id="editElementDetail" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Editer vos informations" alt=""><i class="fa fa-pencil"></i><span class="hidden-sm hidden-xs editProfilLbl"> <?php echo Yii::t("common","Edit") ?> </span></a>
		
		<a href="javascript:;" id="editConfidentialityBtn" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Compléter ou corriger les informations de ce projet" alt=""><i class='fa fa-cog'></i><span class="hidden-xs"> <?php echo Yii::t("common","Paramètres de confidentialité"); ?></span></a>
		<?php if($type == Person::COLLECTION){ ?>
		<a href='javascript:' id="changePasswordBtn" class='btn btn-sm btn-red tooltips' data-toggle="tooltip" data-placement="bottom" title="Changer votre mot de passe" alt="">
			<i class='fa fa-key'></i> 
			<span class="hidden-sm hidden-xs">
			<?php echo Yii::t("common","Change password") ?>
			</span>
		</a>
		<a href='javascript:' id="downloadProfil" class='btn btn-sm btn-default tooltips' data-toggle="tooltip" data-placement="bottom" title="Télécharger votre profil" alt="">
			<i class='fa fa-download'></i> 
			<span class="hidden-sm hidden-xs">
			<?php //echo Yii::t("common","Télécharger votre profile"); ?>
			</span>
		</a>
		<?php } ?>
		<a class="btn btn-sm btn-default tooltips" href="javascript:;" onclick="showDefinition('qrCodeContainerCl',true)" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("common","Show the QRCode for this ".Element::getControlerByCollection($type)); ?>'><i class="fa fa-qrcode"></i> <?php echo Yii::t("common","QR Code") ?></a>
	</div>
	<div id="activityContent" class="panel-body no-padding hide">
		<h2 class="homestead text-dark" style="padding:40px;">
			<i class="fa fa-spin fa-refresh"></i> Chargement des activités ...
		</h2>
	</div>
	<div id="divInformation" class="col-sm-12 col-md-12 padding-15">
		<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding text-dark lbl-info-details">
			<i class="fa fa-map-marker"></i>  <?php echo Yii::t("common","Information") ?>
		</div>
		<div class="col-md-12">
			<div class="no-padding col-md-12">
				<div id="divName">
					<span class="titleField text-dark"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common", "Name"); ?> :</span>
					<a href="#" id="name" data-type="text" data-original-title="<?php echo Yii::t("person","Enter your name"); ?>" data-emptytext="Enter your name" class="editable-context editable editable-click">
						<?php if(isset($element["name"])) echo $element["name"]; else echo "";?>
					</a>
				</div>

				<?php if($type==Person::COLLECTION){ ?>
				<div id="divUserName">
					<!-- <i class="fa fa-smile-o fa_name hidden"></i> -->
					<span class="titleField text-dark"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common", "Username"); ?> :</span>
							
					<a href="#" id="username" data-type="text" data-emptytext="<?php echo Yii::t("person","Username"); ?>"  data-original-title="<?php echo Yii::t("person","Enter your user name"); ?>" class="editable-context editable editable-click">
						<?php if(isset($element["username"]) && ! isset($element["pending"])) echo $element["username"]; else echo "";?>
					</a>
				</div>
				<?php } ?>

				<?php if($type==Organization::COLLECTION || $type==Event::COLLECTION){ ?>
				<div id="divType">
					<!-- <i class="fa fa-smile-o fa_name hidden"></i> -->
					<span class="titleField text-dark"><i class="fa fa-angle-right"></i>  <?php echo Yii::t("common", "Type"); ?> :</span>
					<a href="#" id="type" data-type="select" data-title="Type" data-emptytext="Type" class="editable editable-click required">
						<?php if(isset($element["type"])) echo Yii::t("common", $element["type"]); else echo "";?>
					</a>
				</div>
				<?php } ?>


			</div>
		</div>

		<?php if($type==Person::COLLECTION){ ?>
				<div class="socialNetwork col-md-12">
					<div class="col-md-12 no-padding">
						<span class="titleField text-dark"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common","Socials") ?> :</span>
						<a href="#" id="skypeAccount" data-emptytext='<i class="fa fa-skype"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php if (isset($element["socialNetwork"]["skype"])) echo $element["socialNetwork"]["skype"]; else echo ""; ?>
						</a>
						<?php $facebook =  (!empty($element["socialNetwork"]["facebook"])? $element["socialNetwork"]["facebook"]:"#") ;?>
						<a href="<?php echo $facebook ; ?>" target="_blank" id="facebookAccount" data-emptytext='<i class="fa fa-facebook"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php echo ($facebook=="#"?"":$facebook) ; ?>
						</a>
						<?php $twitter =  (!empty($element["socialNetwork"]["twitter"])? $element["socialNetwork"]["twitter"]:"#") ;?>
						<a href="<?php echo $twitter ;?>" target="_blank" id="twitterAccount" data-emptytext='<i class="fa fa-twitter"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php echo ($twitter=="#"?"":$twitter) ; ?>
						</a>
						<?php $googleplus =  (!empty($element["socialNetwork"]["googleplus"])? $element["socialNetwork"]["googleplus"]:"#") ;?>
						<a href="<?php echo $googleplus ;?>" target="_blank" id="gpplusAccount" data-emptytext='<i class="fa fa-google-plus"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php echo ($googleplus=="#"?"":$googleplus) ; ?>
						</a>
						<?php $github =  (!empty($element["socialNetwork"]["github"])? $element["socialNetwork"]["github"]:"#") ;?>
						<a href="<?php echo $github ;?>" target="_blank" id="gitHubAccount" data-emptytext='<i class="fa fa-github"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php echo ($github=="#"?"":$github) ; ?>
						</a>
					</div>

					<div class="col-md-12 no-padding">
						<?php if (  (isset($element["socialNetwork"]["telegram"]) && $element["socialNetwork"]["telegram"] != "")
								 || ((string)$element["_id"] == Yii::app()->session["userId"] ))
								 { ?>
							<span class="text-azure pull-left" style="margin:8px 5px 0px 0px;"><i class="fa fa-angle-right"></i> Discuter en privé via :</span>
							<a 	href="<?php if (isset($element["socialNetwork"]["telegram"]) && $element["socialNetwork"]["telegram"] != "") echo $element["socialNetwork"]["telegram"]; else echo "javascript:switchMode()"; ?>" 
								id="telegramAccount" data-emptytext='<i class="fa fa-send"></i> Telegram' 
								data-type="text" 

								<?php if (isset($element["socialNetwork"]["telegram"]) && $element["socialNetwork"]["telegram"] != ""){ ?> 
									<?php if ((string)$element["_id"] == Yii::app()->session["userId"]){ ?> 
										data-original-title="aller sur Telegram" 
									<?php }else{ ?>
										data-original-title="contacter via Telegram" 
									<?php } ?>
								<?php }else{ ?>
										data-original-title="votre pseudo sur Telegram ?" 
									<?php } ?>
								
								data-emptytext='<i class="fa fa-send"></i> Telegram'
								class="editable editable-click socialIcon" 
								<?php if (isset($element["socialNetwork"]["telegram"]) && $element["socialNetwork"]["telegram"] != ""){ ?> 
									target="_blank" 
								<?php } ?>
								>
								<?php if (isset($element["socialNetwork"]["telegram"])) echo $element["socialNetwork"]["telegram"]; else echo ""; ?>
							</a> 
							<a href="javascript:" onclick="" class="pull-right badge-question-telegram tooltips" data-toggle="tooltip" data-placement="right" title="comment ça marche ?" >
							 		<i class="fa fa-question-circle text-dark" style="">
							 		</i>
							</a> 

						<?php }else{ ?>
							<!-- s<div class="badge text-azure pull-right" style="margin-top:5px; margin-right:5px;"><i class="fa fa-ban"></i> <i class="fa fa-send"></i> Telegram</div> -->
							<?php } ?>
					</div>

				</div>
			<?php } ?>
			<!-- class="form-group tag_group no-margin"-->
			<div id="divTags" class="col-md-12 no-padding" >
				<label class="control-label  text-red">
					<i class="fa fa-tags"></i> <?php echo Yii::t("common","Tags") ?> : 
				</label>
				
				<a href="#" id="tags" data-type="select2" data-original-title="Enter tagsList" class="editable editable-click text-red">
					<?php if(isset($element["tags"])){
						foreach ($element["tags"] as $tag) {
							//echo " <a href='#' onclick='toastr.info(\"TODO : find similar people!\"+$(this).data((\"tag\")));' data-tag='".$tag."' class='btn btn-default btn-xs'>".$tag."</a>";
						}
					}?>
				</a>
			</div>
	</div>		
	<?php 
	//var_dump($admin);
	//if(!empty($admin) && $admin == true){
	//<!-- class=" col-lg-6 col-md-6 col-sm-6 col-xs-8"--> ?>

	<?php if($type==Project::COLLECTION){ ?>
	<div id="divAvancement" class="col-md-12 text-dark no-padding" style="margin-top:10px;">
		<a  href="#" id="avancement" data-type="select" data-title="avancement" 
			data-original-title="<?php echo Yii::t("project","Enter the project's maturity",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Project maturity") ?>"
			class="entityDetails">
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



	<div class="panel-body border-light panelDetails" id="contentGeneralInfos">	
		<?php if($type==Event::COLLECTION || $type==Project::COLLECTION){ ?>
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding" style="padding-right:10px !important;">
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 no-padding text-dark lbl-info-details">
					<i class="fa fa-clock-o"></i>  <?php echo Yii::t("common","When") ?> ?
				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 entityDetails no-padding">
					<?php if($type==Event::COLLECTION ) { ?>
					<div class="col-xs-12 no-padding">
						<span><?php echo Yii::t("common","All day") ?> : </span><a href="#" id="allDay" data-type="select" data-emptytext="<?php echo Yii::t("common","All day") ?> ?" class="editable editable-click" ></a>
					</div>
					<?php } ?>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","From") ?> </span><a href="#" id="startDate" data-emptytext="Enter Start Date" class="editable editable-click" ></a>
					</div>
					<div class="col-md-6 col-xs-12 no-padding">
						<span><?php echo Yii::t("common","To") ?> </span><a href="#" id="endDate" data-emptytext="Enter End Date" class="editable editable-click"></a> 
					</div>
				</div>
			</div>
		<?php } ?>

		<div class="text-dark lbl-info-details <?php if($type==Event::COLLECTION){ ?>no-padding<?php } ?>">
			<?php if($type==Event::COLLECTION){?>
				<i class="fa fa-map-marker"></i> <?php echo Yii::t("common","Where"); ?> ? 
			<?php }else{ ?>
				<i class="fa fa-angle-down"></i> <?php echo Yii::t("common","Contact information"); ?>
			<?php } ?>
		</div>
		<div class="row info-coordonnees entityDetails text-dark" style="margin-top: 10px !important;">
			<div class="col-md-6 col-sm-6">	
				<i class="fa fa-road fa_streetAddress hidden"></i> 
				<a href="#" id="streetAddress" data-type="text" data-title="<?php echo Yii::t("common","Street Address") ?>" data-emptytext="<?php echo Yii::t("common","Street Address") ?>" class="editable-context editable editable-click">
					<?php //echo (isset( $element["address"]["streetAddress"])) ? $element["address"]["streetAddress"] : null; ?>
					<?php echo Element::showField("address.streetAddress",$element, $isLinked);?>
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

				<?php 
						$address = ( @$element["address"]["streetAddress"]) ? $element["address"]["streetAddress"] : "";
						$address2 = ( @$element["address"]["postalCode"]) ? $element["address"]["postalCode"] : "";
						$address2 .= ( @$element["address"]["addressCountry"]) ? ", ".OpenData::$phCountries[ $element["address"]["addressCountry"] ] : "";
						/*if(isset(OpenData::$phCountries[ $element["address"]["addressCountry"] ]))
						$address2 .= (@$element["address"]["addressCountry"] && @OpenData::$phCountries[ $element["address"]["addressCountry"] ]) ? ", ".OpenData::$phCountries[ $element["address"]["addressCountry"] ] : "";
						*/

						$tel = "";
						if( @$element["telephone"]["fixe"]){
							foreach ($element["telephone"]["fixe"] as $key => $num) {
								$tel .= ($tel != "") ? ", ".$num : $num;
							}
						}
						if(isset($element["telephone"]["mobile"])){
							foreach ($element["telephone"]["mobile"] as $key => $num) {
								$tel .= ($tel != "") ? ", ".$num : $num;
							}
						}

						/*$this->renderPartial('../pod/qrcode',array("class"=>"col-sm-6 col-md-10",
																"name" => @$element['name'],
																"address" => $address,
																"address2" => $address2,
																"email" => @$element['email'],
																"img"=>@$element['profilThumbImageUrl']));*/

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

				<?php if($type==Person::COLLECTION){?>
					<i class="fa fa-birthday-cake fa_birthDate hidden"></i> 
					<a href="#" id="birthDate" data-type="date" data-title="<?php echo Yii::t("person","Birth date"); ?>" data-emptytext="<?php echo Yii::t("person","Birth date"); ?>" class="">
						<?php echo (isset($element["birthDate"])) ? date("d/m/Y", strtotime($element["birthDate"]))  : null; ?>
					</a>
					<br>	
				<?php } ?>
				<?php if ($type==Organization::COLLECTION || $type==Person::COLLECTION){ ?>
				<i class="fa fa-envelope fa_email  hidden"></i> 
				<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-context editable editable-click required">
					<?php //echo (isset($element["email"])) ? $element["email"] : null; ?>
					<?php echo Element::showField("email",$element, $isLinked);?>
				</a>
				<br>
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

				<?php  if($type==Organization::COLLECTION || $type==Person::COLLECTION){ ?>
				<i class="fa fa-phone fa_telephone hidden"></i>
					<a href="#" id="fixe" data-type="text" data-title="<?php echo Yii::t("person","Phone"); ?>" data-emptytext="<?php echo Yii::t("person","Phone"); ?>" class="telephone editable editable-click">
						<?php 
							if(isset($element["telephone"]["fixe"])){
								foreach ($element["telephone"]["fixe"] as $key => $tel) {
									if($key > 0)
										echo ", ";
									echo $tel;
								}
							}
						?>
					</a>
					<br>

					<i class="fa fa-mobile fa_telephone_mobile hidden"></i>
					<a href="#" id="mobile" data-type="text" data-emptytext="<?php echo Yii::t("person","Mobile"); ?>" data-title="<?php echo Yii::t("person","Enter your mobiles"); ?>" class="telephone editable editable-click">
						<?php if(isset($element["telephone"]["mobile"])){
							foreach ($element["telephone"]["mobile"] as $key => $tel) {
								if($key > 0)
									echo ", ";
								echo $tel;
							}
						}?>
					</a>
					<br>

					<i class="fa fa-fax fa_telephone_fax hidden"></i> 
					<a href="#" id="fax" data-type="text" data-emptytext="<?php echo Yii::t("person","Fax"); ?>" data-title="<?php echo Yii::t("person","Enter your fax"); ?>" class="telephone editable editable-click">
						<?php if(isset($element["telephone"]["fax"])){
							foreach ($element["telephone"]["fax"] as $key => $tel) {
								if($key > 0)
									echo ", ";
								echo $tel;
							}
						}?>
					</a>
					<br>
				<?php } ?>	
			</div>	
			<?php } ?>		
		</div>

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
		<div id="divShortDescription" class="col-sm-12 col-xs-12 col-md-12 no-padding">
			<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Short Description</div>
			<a href="#" id="shortDescription" data-type="wysihtml5" data-original-title="<?php echo Yii::t("project","Enter the project's description",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","shortDescription") ?>" class="editable editable-click">
				<?php echo (!empty($element["shortDescription"])) ? $element["shortDescription"] : ""; ?>
			</a>	
			
		</div>
		<div class="col-sm-12 col-xs-12 col-md-12 no-padding">
			<div class="text-dark lbl-info-details"><i class="fa fa-angle-down"></i> Description</div>
			<a href="#" id="description" data-type="wysihtml5" data-original-title="<?php echo Yii::t("project","Enter the project's description",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Description") ?>" class="editable editable-click">
				<?php  //echo (!empty($element["description"])) ? $element["description"] ; : ""; ?>
				<?php echo Element::showField("description",$element, $isLinked) ; ?>
			</a>	
		</div>
	</div>
</div>



<script type="text/javascript"> 

	var contextData = <?php echo json_encode($element)?>;
	var contextControler = <?php echo json_encode(Element::getControlerByCollection($type))?>;
	var contextId = "<?php echo isset($element["_id"]) ? $element["_id"] : ""; ?>";
	var contentKeyBase = "<?php echo isset($contentKeyBase) ? $contentKeyBase : ""; ?>";
	//By default : view mode
	var mode = "view";
	var images = <?php echo json_encode($images) ?>;
	var tags = <?php echo json_encode($tags)?>;
	var types = <?php echo json_encode($elementTypes) ?>;
	var countries = <?php echo json_encode($countries) ?>;
	var startDate = '<?php if(isset($element["startDate"])) echo $element["startDate"]; else echo ""; ?>';
	var endDate = '<?php if(isset($element["endDate"])) echo $element["endDate"]; else echo "" ?>';
	var allDay = '<?php echo (@$element["allDay"] == true) ? "true" : "false"; ?>'
	var edit = '<?php echo (@$edit == true) ? "true" : "false"; ?>'
	var birthDate = '<?php echo (isset($person["birthDate"])) ? $person["birthDate"] : null; ?>';
	var publics = <?php echo json_encode($publics) ?>;
	var NGOCategoriesList = <?php echo json_encode($NGOCategories) ?>;
	var localBusinessCategoriesList = <?php echo json_encode($localBusinessCategories) ?>;
	
	jQuery(document).ready(function() {
		console.log("edit",edit);
		if(edit == "true"){
			switchMode();
		}

		bindAboutPodElement();
		activateEditableContext();
		manageModeContext();
		changeHiddenIcone(true);
		manageDivEdit();

		$('#avatar').change(function() {
		  $('#photoAddEdit').submit();
		});

		$("#photoAddEdit").on('submit',(function(e) {
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/"+contextType+"/id/"+contextId,
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

		//buildQRCode(contextControler,contextId);

		$(".toggle-tag-dropdown").click(function(){ console.log("toogle");
			if(!$("#dropdown-content-multi-tag").hasClass('open'))
			setTimeout(function(){ $("#dropdown-content-multi-tag").addClass('open'); }, 300);
			$("#dropdown-content-multi-tag").addClass('open');
		});
		$(".toggle-scope-dropdown").click(function(){ console.log("toogle");
			if(!$("#dropdown-content-multi-scope").hasClass('open'))
			setTimeout(function(){ $("#dropdown-content-multi-scope").addClass('open'); }, 300);
		});



	});

	function bindAboutPodElement() {
		$("#editGeoPosition").click(function(){
			Sig.startModifyGeoposition(contextId, "<?php echo $type ?>", contextData);
			showMap(true);
		});

		$("#editElementDetail").on("click", function(){
				switchMode();
			//if($("#getHistoryOfActivities").find("i").hasClass("fa-arrow-left"))
			//	getBackDetails(contextId,"<?php echo $type ?>");
		});

		$("#changePasswordBtn").click(function () {
			console.log("changePasswordbuttton");
			loadByHash('#person.changepassword.id.'+userId+'.mode.initSV', false);
		});

		$("#downloadProfil").click(function () {
			$.ajax({
				url: baseUrl + "/communecter/data/get/type/citoyens/id/"+contextId ,
				type: 'POST',
				dataType: 'json',
				async:false,
				crossDomain:true,
				complete: function () {},
				success: function (obj){
					console.log("obj", obj);
					$("<a />", {
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

		$("#editConfidentialityBtn").on("click", function(){
	    	console.log("confidentiality");
	    	$("#modal-confidentiality").modal("show");
	    });

		$(".panel-btn-confidentiality .btn").click(function(){
			var type = $(this).attr("type");
			var value = $(this).attr("value");
			$(".btn-group-"+type + " .btn").removeClass("active");
			$(this).addClass("active");
		});
		//if(<?php echo isset($element["birthDate"]) 					? "true" : "false"; ?>){ $(".fa_birthDate").removeClass("hidden"); }


	}

	function switchMode() {
		console.log("switchMode");
		if(mode == "view"){
			mode = "update";
			$(".editProfilLbl").html(" Enregistrer les changements");
			$("#editElementDetail").addClass("btn-red");
		}else{
			mode ="view";
			$(".editProfilLbl").html(" Éditer");
			$("#editElementDetail").removeClass("btn-red");

		}
		manageModeContext();
		changeHiddenIcone(false);
		manageDivEdit();
	}

	function manageModeContext() {
		console.log("-----------------manageModeContext----------------------");
		listXeditables = [	'#birthDate', '#description', '#shortDescription', '#fax', '#fixe', '#mobile', 
							'#tags', '#address', '#addressCountry', '#facebookAccount', '#twitterAccount',
							'#gpplusAccount', '#gitHubAccount', '#skypeAccount', '#telegramAccount', 
							'#avancement', '#allDay', '#startDate', '#endDate', '#type'];
		if (mode == "view") {
			$('.editable-context').editable('toggleDisabled');
			$.each(listXeditables, function(i,value) {
				$(value).editable('toggleDisabled');
			});
			$("#btn-update-geopos").addClass("hidden");
		} else if (mode == "update") {
			// Add a pk to make the update process available on X-Editable
			$('.editable-context').editable('option', 'pk', contextId);
			$('.editable-context').editable('toggleDisabled');
			$.each(listXeditables, function(i,value) {
				//add primary key to the x-editable field
				$(value).editable('option', 'pk', contextId);
				$(value).editable('toggleDisabled');
			})
			$("#btn-update-geopos").removeClass("hidden");
		}
	}

	function manageDivEdit() {
		console.log("-----------------manageDivEdit----------------------");
		listXeditables = [	'#divName', '#divShortDescription' , '#divTags', "#divAvancement"];
		console.log(contextType);
		if(contextType != "citoyens")
			listXeditables.push('#divInformation');
		divInformation
		if (mode == "view") {
			$.each(listXeditables, function(i,value) {
				$(value).hide();
			});
		} else if (mode == "update") {
			$.each(listXeditables, function(i,value) {
				$(value).show();
			})
		}
	}

	function manageSocialNetwork(iconObject, value) {
		//console.log("-----------------manageSocialNetwork----------------------");
		tabId2Icon = {"facebookAccount" : "fa-facebook", "twitterAccount" : "fa-twitter", 
				"gpplusAccount" : "fa-google-plus", "gitHubAccount" : "fa-github", "skypeAccount" : "fa-skype", "telegramAccount" : "fa-send"}

		var fa = tabId2Icon[iconObject.attr("id")];
		console.log(value);
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
			iconObject.html('<i class="fa '+fa+' text-white"></i> Telegram');
		}

		console.log(iconObject);
	}

	function changeHiddenIcone(init) { 
		console.log("-----------------changeHiddenIcone----------------------");
		
		listIcones = [	'.fa_name', ".fa_birthDate", ".fa_email", ".fa_streetAddress", ".fa_postalCode", 
						".fa_addressCountry", ".fa_telephone_mobile",".fa_telephone",".fa_telephone_fax",
						".fa_url"];

		listXeditables = [	'#username','#birthDate',"#email", "#streetAddress", "#address",
						"#addressCountry", "#mobile", "#fixe", "#fax","#url"];
		if (init == true) {
			$.each(listIcones, function(i,value) {
				console.log("here");
				if($(listXeditables[i]).text().length != 0){
					console.log(listXeditables[i], " : ", value);
					$(value).removeClass("hidden");	
				}
					 
			});
		}
		else if (mode == "view") {
			$.each(listIcones, function(i,value) {
				if($(listXeditables[i]).text().length == 0)
					$(value).editable('toggleDisabled');
			});
		} else if (mode == "update") {
			$.each(listXeditables, function(i,value) {
				$(value).removeClass("hidden"); 
			});
		}
	}

	function activateEditableContext() {

		
		$.fn.editable.defaults.mode = 'popup';

		$('.editable-context').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			title : $(this).data("title"),
			onblur: 'submit',
			success: function(response, newValue) {
				console.log(response, newValue);
				if(! response.result) return response.msg; //msg will be shown in editable form
    		},
    		success : function(data) {
    			console.log(data);
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;

					if(typeof data.name != "undefined" && $('#nameHeader').length ){
						$('#nameHeader').html(data.name);
					}	
				}
				else 
					return data.msg;
			}

		});

		$('.socialIcon').editable({
			display: function(value) {
				manageSocialNetwork($(this), value);
			},
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			mode: 'popup'
		}); 


		//Type Organization
		 $('#type').editable({
		 	url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
		 	value: '<?php echo (isset($element["type"])) ? $element["type"] : ""; ?>',
		 	placement: 'bottom',
		 	source: function() {
		 		return types;
		 	},
		 	success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;
					if(typeof data.type != "undefined" && $('#typeHeader').length ){
						$('#typeHeader').html(data.type);
					}
				}
				else 
					return data.msg;
			}
		 });

		$('#birthDate').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
			mode: 'popup',
			placement: "right",
			format: 'yyyy-mm-dd',   
	    	viewformat: 'dd/mm/yyyy',
	    	datepicker: {
	            weekStart: 1,
	        },
	        showbuttons: true
		});
		//$('#birthDate').editable('setValue', moment(birthDate, "YYYY-MM-DD HH:mm").format("YYYY-MM-DD"), true);

		

		//Select2 tags
		$('#tags').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
		 	mode: 'popup',
		 	value: returnttag(),
		 	select2: {
		 		tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
		 		tokenSeparators: [","],
		 		width: 200
		 	},
		 	success : function(data) {
		 		console.log("TAGS", data);
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;
					var str = "";
					if($('#divTagsHeader').length ){
						
						$.each(data.tags, function (key, tag){
							str +=	'<div class="tag label label-danger pull-right" data-val="'+tag+'">'+
										'<i class="fa fa-tag"></i>'+tag+
									'</div>';
						});
						
					}
					$('#divTagsHeader').html(str);	
				}
				else 
					return data.msg;
			}
		});


		$('#telephone').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
			mode: 'popup',
			value: returntel(),
			select2: {
				tags:  <?php if(isset($telephone)) echo json_encode($telephone); else echo json_encode(array())?>,
				tokenSeparators: [",", "/", " "],
				width: 200,
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

		

		$('#category').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
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
			success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;	
				}
				else 
					return data.msg;
			}
		});

		$('#addressCountry').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
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
			validate: function(value) {
	            value.streetAddress=$("#streetAddress").text();
	            console.log(value);
	        },
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
			mode: 'popup',
			/*success: function(response, newValue) {
				console.log("success update postal Code : ");
				console.dir(newValue);
				$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
				$("#entity-cp-value").attr("cp-val", newValue.postalCode);
				$(".menuContainer #menu-city").attr("onclick", "loadByHash( '#city.detail.insee."+newValue.codeInsee+"', 'MA COMMUNE','university' )");
			},*/
			value : {
	        	postalCode: '<?php echo (isset( $element["address"]["postalCode"])) ? $element["address"]["postalCode"] : null; ?>',
            	codeInsee: '<?php echo (isset( $element["address"]["codeInsee"])) ? $element["address"]["codeInsee"] : ""; ?>',
            	addressLocality : '<?php echo (isset( $element["address"]["addressLocality"])) ? $element["address"]["addressLocality"] : ""; ?>'
	    	},
            success : function(data) {
            	console.log("data", data);
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;
					$('#localityHeader').html(data.address.addressLocality);
					$('#pcHeader').html(data.address.postalCode);	
				}
				else 
					return data.msg;
			}
		});


		$('#avancement').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
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
					$('#progressStyle').val(val);
					$('#labelProgressStyle').html(data.avancement);
				}
				else 
					return data.msg;
		    }
		});

		$('#shortDescription').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
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

					if(typeof data.shortDescription != "undefined" && $('#shortDescriptionHeader').length ){
						$('#shortDescriptionHeader').html(data.shortDescription);
					}
				}
				else 
					return data.msg;
			}
		});


		$('#avancement').editable({
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
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
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
			value: <?php echo (isset($element["description"])) ? json_encode($element["description"]) : "''"; ?>,
			placement: 'top',
			wysihtml5: {
				html: true,
				video: false
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
			url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
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
		    success : function(data) {
				if(data.result) {
					toastr.success(data.msg);
					loadActivity=true;	
				}
				else 
					return data.msg;
			}
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
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
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
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,  
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
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
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
				url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType, 
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