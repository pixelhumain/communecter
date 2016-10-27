<?php 
	
$cssAnsScriptFilesModule = array(
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',

	'/plugins/x-editable/js/bootstrap-editable.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' ,
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js',

	'/plugins/jquery.qrcode/jquery-qrcode.min.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);

$cssAnsScriptFilesModule = array(
	'/js/dataHelpers.js',
	'/js/postalCode.js'
);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule , $this->module->assetsUrl);
	//My profil page or visitor ?
	$canEdit = Yii::app()->session['userId'] == (string)$person["_id"];
	$contextMapPerson = null;
	if(isset($person["_id"])){
		$personId = $person["_id"];
		$contextMapPerson = Person::getPersonLinksByPersonId($personId);
		//var_dump($contextMapPerson);
	}
?>
<style>
.socialIcon{
	padding-right: 10px;
}

/* from randomOrga */

	.panel-white .border-light{
		/*border:0 !important;*/
	}
	#profil_imgPreview{
      max-height:400px;
      width:100%;
      border-radius: 5px;
      /*border:3px solid #93C020;*/
      /*border-radius:  4px 4px 0px 0px;*/
      margin-bottom:0px;
     

    }
	.panel-green{
      background-image: linear-gradient(to bottom, #93C020 0px, #83AB1D 100%) !important;
    }
    .entityTitle{
      background-color: #FFF; /*#EFEFEF; /*#2A3A45;*/
      margin-bottom: 10px;
      border-radius: 0px 0px 4px 4px;
      margin-top: -10px;
      font-weight: 200;
      margin:0px !important;
      font-size: 30px;
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

	.btn-default.selected{
		background-color: rgb(182, 200, 210);
	}

    @media screen and (max-width: 1000px) {
      .entityDetails span{
        font-size: 1em;
      }
    }

    #panel-add {
	    padding-bottom: 15px;
	    padding-top: 10px;
	    box-shadow: 0px 0px 6px 2px rgba(0, 0, 0, 0.37);
	    border-radius: 3px;
	}
	#panel-add .btn{
		margin-bottom: 4px;
	}
	#panel-add .btn:hover{
		box-shadow: 0px 0px 6px 2px rgba(255, 255, 255, 0.48);
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

	.badge-question-telegram {
	    font-size: 22px;
	    z-index: 6;
	    /*position: absolute;
	    right: 1px;
	    top: -6px;*/
	    border-radius: 30px;
	}

	.socialNetwork{
		padding: 7px;
		/*margin-left: 10px;
		margin-top: -11px;*/
		background-color: rgba(0, 0, 0, 0.85);
		border-radius: 0px 0px 5px 5px;
		height: 67px;
		width: 100%;
	}
	i.fa-blue{
		color:white !important;
		font-size:20px;
	}

	.container-info-perso{
		/*margin-top:70px;*/
	}

	#fileuploadContainer, #profil_imgPreview{
		border-radius: 5px 5px 0px 0px !important;
		border-width:0px !important;
	}

	@media screen and (max-width: 1060px) {
		  .container-info-perso{
			margin-top:10px;
		}
	}

	@media screen and (max-width: 767px) {
		  .container-info-perso{
			margin-top:0px;
		}
	}

	.select2-hidden {
	    display:none !important;
	}

</style>

<div class="panel panel-white">
	<div class="panel-heading border-light">
        <h4 class="panel-title text-dark"><i class="fa fa-info-circle text-dark"></i> <?php echo Yii::t("common","Account info") ?></h4>
    </div>
	<div class="panel-tools">
 		<?php    
			if ( $canEdit ) { ?>
				<a href="javascript:;" id="editProfil" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Editer vos informations" alt=""><i class="fa fa-pencil"></i><span class="hidden-sm hidden-xs editProfilLbl"> Editer</span></a>
				<a href="javascript:;" id="editGeoPosition" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Modifiez votre position sur la carte" alt=""><i class="fa fa-map-marker"></i><span class="hidden-sm hidden-xs"> Déplacer</span></a>
		<?php } ?>	

		<?php
			//if connected user and pageUser are allready connected
			$base = 'upload'.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.Yii::app()->session["userId"].DIRECTORY_SEPARATOR;
			if( Yii::app()->session["userId"] && file_exists ( $base.Yii::app()->session["userId"].".json" ) )
			{  /* ?>
				<a href="javascript:;" class="btn btn-xs btn-red importMyDataBtn" ><i class="fa fa-download"></i> Import my data</a>
			<?php */ } 
			if (Person::logguedAndValid() && $canEdit) {
			?>
				<a href='javascript:' class='btn btn-sm btn-default editConfidentialityBtn tooltips' data-toggle="tooltip" data-placement="bottom" title="Paramètre de confidentialité" alt="">
					<i class='fa fa-cog'></i> 
					<span class="hidden-sm hidden-xs">
					<?php echo Yii::t("common","Paramètres de confidentialité"); ?>
					</span>
				</a>
				<a href='javascript:' class='btn btn-sm btn-red changePasswordBtn tooltips' data-toggle="tooltip" data-placement="bottom" title="Changer votre mot de passe" alt="">
					<i class='fa fa-key'></i> 
					<span class="hidden-sm hidden-xs">
					<?php echo Yii::t("common","Change password") ?>
					</span>
				</a>
				<a href='javascript:' class='btn btn-sm btn-default downloadProfil tooltips' data-toggle="tooltip" data-placement="bottom" title="Télécharger votre profil" alt="">
					<i class='fa fa-download'></i> 
					<span class="hidden-sm hidden-xs">
					<?php //echo Yii::t("common","Télécharger votre profile"); ?>
					</span>
				</a>
				<!--<a href="#person.updateprofil" class='btn btn-sm btn-default updateProfil tooltips' data-toggle="tooltip" data-placement="bottom" title="Télécharger votre profil" alt="">
					<i class='fa fa-update'></i> 
					<span class="hidden-sm hidden-xs">
					<?php //echo Yii::t("common","Mettre à jour votre profil"); ?>
					</span>
				</a>-->
			<?php } /*?>
			<a href="javascript:;" class="btn btn-xs btn-red exportMyDataBtn" ><i class="fa fa-upload"></i> Export my data</a>
			*/ 
		?>
		
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
		<?php   if (Role::isUserBetaTester(@$person["roles"])) { ?>
					<div class="badge badge-danger pull-right" style="margin-top:5px; margin-right:5px;"><i class="fa fa-user"></i> Beta Tester</div>
		<?php 	} ?>
		<?php if(!empty($person["badges"])){?>
				<?php if( Badge::checkBadgeInListBadges("crowdfunder", $person["badges"]) ){?>
					<div class="badgePH pull-right" data-title="CROWDFUNDER">
						<span class="fa-stack tooltips" style="maring-bottom:5px" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("badge","crowdfunder", null, Yii::app()->controller->module->id)?>'>
							<i class="fa fa-bookmark main fa-2x fa-stack-1x text-green"></i>
							<i class="fa fa-euro mainTop fa-stack-1x text-white"></i>
						</span>
					</div>
				<?php } ?>
				<?php if( Badge::checkBadgeInListBadges("developper", $person["badges"]) ){?>
					<div class="badgePH pull-right" data-title="DEVELOPPER">
						<span class="fa-stack tooltips" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("badge","developper", null, Yii::app()->controller->module->id)?>'>
							<i class="fa fa-keyboard-o main fa-2x fa-stack-1x text-red"></i>
							<?php /* ?><i class="fa fa-circle-o fa-4x stack-right-bottom text-yellow"></i>*/?>
						</span>
					</div>
				<?php } ?>
				<?php if( Badge::checkBadgeInListBadges("opendata", $person["badges"]) ){?>
					<div class="badgePH pull-right" data-title="OPENDATA">
						<span class="fa-stack tooltips opendata" style="maring-bottom:5px" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("badge","opendata", null, Yii::app()->controller->module->id)?>'>
							<i class="fa fa-database main fa-stack-1x text-orange"></i>
							<i class="fa fa-share-alt  mainTop fa-stack-1x text-black"></i>
						</span>
					</div>
				<?php } ?>


			<?php } ?>
  	</div>

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
	        		<strong><i class="fa fa-group"></i> Public</strong> : visible pour tout le monde<br/>
	        		<strong><i class="fa fa-user-secret"></i> Privé</strong> : visible pour mes contacts seulement<br/>
	        		<strong><i class="fa fa-ban"></i> Masqué</strong> : visible pour personne<br/>
	        	</div>
		    </div>
		    <div class="row text-dark panel-btn-confidentiality">
	            <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Mon e-mail :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-email inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="email" value="public"><i class="fa fa-group"></i> Public</button>
		        		<button class="btn btn-default confidentialitySettings" type="email" value="private"><i class="fa fa-user-secret"></i> Privé</button>
		        		<button class="btn btn-default confidentialitySettings" type="email" value="hide"><i class="fa fa-ban"></i> Masqué</button>
		        	</div>
		        </div>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Ma localité :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-locality inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="locality" value="public" selected><i class="fa fa-group"></i> Public</button>
		        		<button class="btn btn-default confidentialitySettings" type="locality" value="private"><i class="fa fa-user-secret"></i> Privé</button>
		        		<button class="btn btn-default confidentialitySettings" type="locality" value="hide"><i class="fa fa-ban"></i> Masqué</button>
		        	</div>
		        </div>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Mon téléphone :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-phone inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="phone" value="public"><i class="fa fa-group"></i> Public</button>
		        		<button class="btn btn-default confidentialitySettings" type="phone" value="private"><i class="fa fa-user-secret"></i> Privé</button>
		        		<button class="btn btn-default confidentialitySettings" type="phone" value="hide"><i class="fa fa-ban"></i> Masqué</button>
		        	</div>
		        </div>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Open Data :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-isOpenData inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="true"><i class="fa fa-group"></i> Oui</button>
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="false"><i class="fa fa-user-secret"></i> Non</button>

		        	</div>
		        </div>
	        </div>
	      </div>
	      <script type="text/javascript">
			<?php
				//Params Checked
				$typePreferences = array("privateFields", "publicFields");
				$fieldPreferences["email"] = true;
				$fieldPreferences["locality"] = true;
				$fieldPreferences["phone"] = true;

				//To checked private or public
				foreach($typePreferences as $type){
					foreach ($fieldPreferences as $field => $hidden) {
						if(isset($person["preferences"][$type]) && in_array($field, $person["preferences"][$type])){
							echo "$('.btn-group-$field > button[value=\'".str_replace("Fields", "", $type)."\']').addClass('active');";
							$fieldPreferences[$field] = false;
						}
					}
				}
				//To checked if there are hidden
				foreach ($fieldPreferences as $field => $hidden) {
					if($hidden) echo "$('.btn-group-$field > button[value=\'hide\']').addClass('active');";
				}
				if(isset($person["preferences"]["isOpenData"]) && $person["preferences"]["isOpenData"] == true)
					echo "$('.btn-group-isOpenData > button[value=\'true\']').addClass('active');";	
				else
					echo "$('.btn-group-isOpenData > button[value=\'false\']').addClass('active');";	
			?> 
	     </script>


	      <div class="modal-footer">
	        <button type="button" class="lbh btn btn-success btn-confidentialitySettings" data-dismiss="modal" aria-label="Close" data-hash="#person.detail.id.<?php echo $person['_id'] ;?>">OK</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->


  	<div class="panel-body" style="padding-top: 0px">
		<div class="col-md-8 col-xs-12" >

				
			<div class="padding-10">
					<h2 class="entityTitle">
						<!-- <i class="fa fa-user fa_username"></i>  -->
						<a href="#" id="name" data-type="text" data-original-title="<?php echo Yii::t("person","Enter your name"); ?>" data-emptytext="Enter your name" class="editable-person editable editable-click">
							<?php if(isset($person["name"])) echo $person["name"]; else echo "";?>
						</a>
					</h2>

					<?php 
					$isLinked = Link::isLinked((string)$person["_id"],Person::COLLECTION, Yii::app()->session['userId']);
					?>
					<i class="fa fa-smile-o fa_name hidden"></i> 		
					<a href="#" id="username" data-type="text" data-emptytext="<?php echo Yii::t("person","Username"); ?>"  data-original-title="<?php echo Yii::t("person","Enter your user name"); ?>" class="editable-person editable editable-click">
						<?php if(isset($person["username"]) && ! isset($person["pending"])) echo $person["username"]; else echo "";?>
					</a>
					<div class="form-group tag_group no-margin">
						<label class="control-label  text-red">
							<i class="fa fa-tags"></i> <?php echo Yii::t("common","Tags") ?> : 
						</label>
						
						<a href="#" id="tags" data-type="select2" data-original-title="Mes tags perso (liste des mot-clés qui vous définissent)" class="editable editable-click text-red">
							<?php if(isset($person["tags"])){
								foreach ($person["tags"] as $tag) {
									//echo " <a href='#' onclick='toastr.info(\"TODO : find similar people!\"+$(this).data((\"tag\")));' data-tag='".$tag."' class='btn btn-default btn-xs'>".$tag."</a>";
								}
							}?>
						</a>
					</div>
				</div>

			<div class="col-sm-12 col-md-5 col-lg-5 no-padding">
				<?php $this->renderPartial('../pod/fileupload', array(  "itemId" => (string) $person["_id"],
																	  "type" => Person::COLLECTION,
																	  "resize" => false,
																	  "contentId" => Document::IMG_PROFIL,
																	  "show" => true,
																	  "editMode" => $canEdit,
																	  "image" => $imagesD )); 
				?>
				<div class="socialNetwork col-md-12">

					<div class="col-md-12 no-padding">

						<span class="text-white"><i class="fa fa-angle-right"></i> <?php echo Yii::t("common","Socials") ?> :</span>
						<a href="#" id="skypeAccount" data-emptytext='<i class="fa fa-skype"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php if (isset($person["socialNetwork"]["skype"])) echo $person["socialNetwork"]["skype"]; else echo ""; ?>
						</a>
						<a href="<?php if (isset($person["socialNetwork"]["facebook"])) echo $person["socialNetwork"]["facebook"]; else echo "#"; ?>" target="_blank" id="facebookAccount" data-emptytext='<i class="fa fa-facebook"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php if (isset($person["socialNetwork"]["facebook"])) echo $person["socialNetwork"]["facebook"]; else echo ""; ?>
						</a>
						<a href="<?php if (isset($person["socialNetwork"]["twitter"])) echo $person["socialNetwork"]["twitter"]; else echo "#"; ?>" target="_blank" id="twitterAccount" data-emptytext='<i class="fa fa-twitter"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php if (isset($person["socialNetwork"]["twitter"])) echo $person["socialNetwork"]["twitter"]; else echo ""; ?>
						</a>
						<a href="<?php if (isset($person["socialNetwork"]["googleplus"])) echo $person["socialNetwork"]["googleplus"]; else echo "#"; ?>" target="_blank" id="gpplusAccount" data-emptytext='<i class="fa fa-google-plus"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php if (isset($person["socialNetwork"]["googleplus"])) echo $person["socialNetwork"]["googleplus"]; else echo ""; ?>
						</a>
						<a href="<?php if (isset($person["socialNetwork"]["github"])) echo $person["socialNetwork"]["github"]; else echo "#"; ?>" target="_blank" id="gitHubAccount" data-emptytext='<i class="fa fa-github"></i>' data-type="text" data-original-title="" class="editable editable-click socialIcon">
							<?php if (isset($person["socialNetwork"]["github"])) echo $person["socialNetwork"]["github"]; else echo ""; ?>
						</a>

					</div>

					<div class="col-md-12 no-padding">
					
						<?php if (  (isset($person["socialNetwork"]["telegram"]) && $person["socialNetwork"]["telegram"] != "")
								 || ((string)$person["_id"] == Yii::app()->session["userId"] ))
								 { ?>
							<span class="text-azure pull-left" style="margin:8px 5px 0px 0px;"><i class="fa fa-angle-right"></i> Discuter en privé via :</span>
							<a 	href="<?php if (isset($person["socialNetwork"]["telegram"]) && $person["socialNetwork"]["telegram"] != "") echo $person["socialNetwork"]["telegram"]; else echo "javascript:switchMode()"; ?>" 
								id="telegramAccount" data-emptytext='<i class="fa fa-send"></i> Telegram' 
								data-type="text" 

								<?php if (isset($person["socialNetwork"]["telegram"]) && $person["socialNetwork"]["telegram"] != ""){ ?> 
									<?php if ((string)$person["_id"] == Yii::app()->session["userId"]){ ?> 
										data-original-title="aller sur Telegram" 
									<?php }else{ ?>
										data-original-title="contacter via Telegram" 
									<?php } ?>
								<?php }else{ ?>
										data-original-title="votre pseudo sur Telegram ?" 
									<?php } ?>
								
								data-emptytext='<i class="fa fa-send"></i> Telegram'
								class="editable editable-click socialIcon" 
								<?php if (isset($person["socialNetwork"]["telegram"]) && $person["socialNetwork"]["telegram"] != ""){ ?> 
									target="_blank" 
								<?php } ?>
								>
								<?php if (isset($person["socialNetwork"]["telegram"])) echo $person["socialNetwork"]["telegram"]; else echo ""; ?>
							</a> 
							<a href="javascript:" onclick="" class="pull-right hidden badge-question-telegram tooltips" data-toggle="tooltip" data-placement="right" title="comment ça marche ?" >
							 		<i class="fa fa-question-circle text-dark" style="">
							 		</i>
							</a> 

						<?php }else{ ?>
							<!-- s<div class="badge text-azure pull-right" style="margin-top:5px; margin-right:5px;"><i class="fa fa-ban"></i> <i class="fa fa-send"></i> Telegram</div> -->
						<?php } ?>
					</div>
					
				</div>
				<?php 
						$roles = Role::getRolesUserId(Yii::app()->session["userId"]);
						if(Role::isSuperAdmin($roles)){
							?>
								<a href="javascript:" id="btn-update-geopos-admin" class="btn btn-danger btn-sm" style="margin-top:10px;">
									<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner Admin
								</a>
							<?php
						}
					?>
			</div>
			<div class="col-sm-6 col-md-7 container-info-perso">
				<div class="entityDetails text-dark">

					<i class="fa fa-birthday-cake fa_birthDate hidden"></i> 
					<a href="#" id="birthDate" data-type="date" data-title="<?php echo Yii::t("person","Birth date"); ?>" data-emptytext="<?php echo Yii::t("person","Birth date"); ?>" class="editable editable-click required">
					</a>
					<br/>
					<i class="fa fa-envelope fa_email"></i> 
					<a href="#" id="email" data-type="text" data-title="Email" data-emptytext="Email" class="editable-person editable editable-click required">
						<?php echo Person::showField("email",$person, $isLinked);?>
					</a>
					<br/>
					<i class="fa fa-bookmark"></i> <a href="#define.Gamification"  class="lbh">Gamification</a> : <span class="badge badge-warning badgeText text-black"><?php echo Gamification::badge( (string)$person["_id"] )?> <?php echo (isset($person["gamification"]['total'])) ? $person["gamification"]['total'] : 0; ?> pts</span>
					
					<hr style="margin:10px 0px 3px 0px;">
					
					<i class="fa fa-road fa_streetAddress hidden"></i> 		
					<a href="#" id="streetAddress" data-type="text" data-title="<?php echo Yii::t("person","Address"); ?>" data-emptytext="<?php echo Yii::t("person","Address"); ?>" class="editable-person editable editable-click">
						<?php echo Person::showField("address.streetAddress",$person, $isLinked)?>
					</a>

					<br/>
					<i class="fa fa-bullseye fa_postalCode hidden"></i> 
					<a href="#" id="address" data-type="postalCode" data-title="<?php echo Yii::t("person","Postal Code"); ?>" data-emptytext="<?php echo Yii::t("person","Postal Code"); ?>" class="editable editable-click" data-placement="bottom"></a>
					<?php if (@Yii::app()->session["userId"] && Yii::app()->session["userId"]==(string)$person["_id"]){ ?>
					<a href="javascript:;" class="cobtn hidden btn bg-red">Communectez-moi</a> <a href="javascript:;" class="whycobtn hidden btn btn-default explainLink" data-id="explainCommunectMe" >Pourquoi ?</a>
					<?php } ?>
					<br/>
					<i class="fa fa-globe fa_addressCountry hidden"></i> 
					<a href="#" id="addressCountry" data-type="select" data-title="<?php echo Yii::t("person","Country"); ?>" data-emptytext="<?php echo Yii::t("person","Country"); ?>" data-original-title="" class="editable editable-click">					
					</a>
					<br/>
					
					<i class="fa fa-phone fa_telephone hidden"></i>
					<a href="#" id="fixe" data-type="text" data-title="<?php echo Yii::t("person","Phone"); ?>" data-emptytext="<?php echo Yii::t("person","Phone"); ?>" class="telephone editable editable-click">
						<?php 
							if(isset($person["telephone"]["fixe"])){
								foreach ($person["telephone"]["fixe"] as $key => $tel) {
									if($key > 0)
										echo ", ";
									echo $tel;
								}
							}
						?>
					</a>
					<br/>

					<i class="fa fa-mobile fa_telephone_mobile hidden"></i>
					<a href="#" id="mobile" data-type="text" data-emptytext="<?php echo Yii::t("person","Mobile"); ?>" data-title="<?php echo Yii::t("person","Enter your mobiles"); ?>" class="telephone editable editable-click">
						<?php if(isset($person["telephone"]["mobile"])){
							foreach ($person["telephone"]["mobile"] as $key => $tel) {
								if($key > 0)
									echo ", ";
								echo $tel;
							}
						}?>
					</a>
					<br/>

					<i class="fa fa-fax fa_telephone_fax hidden"></i> 
					<a href="#" id="fax" data-type="text" data-emptytext="<?php echo Yii::t("person","Fax"); ?>" data-title="<?php echo Yii::t("person","Enter your fax"); ?>" class="telephone editable editable-click">
						<?php if(isset($person["telephone"]["fax"])){
							foreach ($person["telephone"]["fax"] as $key => $tel) {
								if($key > 0)
									echo ", ";
								echo $tel;
							}
						}?>
					</a>
					<br/>
					
					<a href="javascript:" id="btn-update-geopos" class="btn btn-primary btn-sm hidden" style="margin: 10px 0px;">
						<i class="fa fa-map-marker" style="margin:0px !important;"></i> Repositionner
					</a>
					
				</div>
					
					
					
					<div class="hidden" id="entity-insee-value" 
						 insee-val="<?php echo (isset( $person["address"]["codeInsee"])) ? $person["address"]["codeInsee"] : ""; ?>">
					</div>
					<div class="hidden" id="entity-cp-value" 
							 cp-val="<?php echo (isset( $person["address"]["postalCode"])) ? $person["address"]["postalCode"] : ""; ?>">
						</div>

					<?php 
						$address = ( @$person["address"]["streetAddress"]) ? $person["address"]["streetAddress"] : "";
						$address2 = ( @$person["address"]["postalCode"]) ? $person["address"]["postalCode"] : "";
						$address2 .= ( @$person["address"]["addressCountry"]) ? ", ".OpenData::$phCountries[ $person["address"]["addressCountry"] ] : "";

						$this->renderPartial('../pod/qrcode',array("class"=>"col-sm-6 col-md-10",
																"name" => @$person['name'],
																"address" => $address,
																"address2" => $address2,
																"email" => @$person['email'],
																"img"=>@$person['profilThumbImageUrl']));?>
				</div>

				
				<div class="col-xs-12 text-dark">
					<div class="no-padding margin-top-10 col-sm-12 col-md-12 border-light" style="border-width: 1px">
						<!-- Description -->
						<a href="#" id="shortDescription" data-type="wysihtml5" data-showbuttons="true" data-title="<?php echo Yii::t("person","Short Description"); ?>" data-emptytext="<?php echo Yii::t("person","Short Description"); ?>" class="editable-person editable editable-click">
							<?php echo (isset( $person["shortDescription"])) ? $person["shortDescription"] : ""; ?>
						</a>
					</div>
				</div>
			</div>
		
		
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
			<?php if(Yii::app()->session["userId"] && (string)$person["_id"] == Yii::app()->session["userId"] ){ ?>
			<div id="div-discover" class="center col-xs-12 col-md-4">
				<div class="panel no-padding margin-top-15">
		            
					<div class="panel-heading text-center border-light">
		                <h3 class="panel-title text-blue"> <i class="fa fa-cogs"></i> Paramètres</h3>
		            </div>
			        <div class="panel panel-white padding-10 text-left">
		               	<div class="panel-body no-padding ">
			                <div class="col-md-12 no-padding" style="margin-top:20px">

			                    <div class="col-xs-6 center text-azure btnSubTitle hidden">
			                        <a href="javascript:;" onclick="$('#profil_avatar').trigger('click');return false;" id="open-multi-tag" class=" btn btn-discover bg-azure">

			                          <i class="fa fa-camera"></i>
			                        </a><br>
			                        <span class="text-azure discover-subtitle"> Image de profil</span>
			                    </div>
			                    
			                    <div class="col-xs-6 center text-red btnSubTitle">
			                        <a href="javascript:;" onclick="$('#editProfil').trigger('click');setTimeout( function () { $('#tags').trigger('click'); }, 500);return false;" class=" btn btn-discover bg-red">
			                          <i class="fa fa-tags"></i>
			                        </a><br>
			                        <span class="text-red discover-subtitle"> Mes tags perso</span>
			                    </div>

			                    <div class="col-xs-6 center text-red btnSubTitle">
			                        <a href="javascript:;" onclick="$('#editProfil').trigger('click');setTimeout( function () { $('#address').trigger('click'); }, 500);return false;" class=" btn btn-discover bg-red">
			                          <i class="fa fa-home"></i>
			                        </a><br>
			                        <span class="text-red discover-subtitle"> Ma commune</span>
			                    </div>

			                   
			                    <div class="col-xs-6 center text-dark btnSubTitle">
			                        <a href="javascript:;" class="toggle-tag-dropdown  btn btn-discover bg-dark">
			                          <i class="fa fa-tags"></i>
			                        </a><br><span class="text-dark discover-subtitle"> Mes tags favoris</span>
			                    </div>    
			                    <div class="col-xs-6 center text-dark btnSubTitle">
			                        <a href="javascript:;" class="toggle-scope-dropdown  btn btn-discover bg-dark">
			                          <i class="fa fa-bullseye"></i>
			                        </a><br><span class="text-dark discover-subtitle"> Mes lieux favoris</span>
			                    </div>
			                                    
			                </div>
		                </div>
			        </div>
		        </div>

		        <div class="panel no-padding margin-top-15 ">
			        <div class="panel-heading text-center border-light">
		                <h3 class="panel-title text-blue"> <i class="fa fa-plus"></i> Ajouter</h3>
		            </div>
			        <div class="panel panel-white padding-10">
			            <div id="local-actors-popup-sig">
			              
			              <div class="panel-body no-padding ">

			                <div class="col-md-12 no-padding" style="margin-top:20px">

			                    <div class="col-xs-6  center text-yellow btnSubTitle">
			                        <a href="#person.invite" class="lbh btn btn-discover bg-yellow">

			                          <i class="fa fa-user"></i>
			                        </a><br/><span class="discover-subtitle">Une personne</span>
			                    </div>
			                    
			                    <div class="col-xs-6  center text-green btnSubTitle">
			                        <a href="#organization.addorganizationform" class="lbh btn btn-discover bg-green">
			                          <i class="fa fa-group"></i>
			                        </a>
			                        <br/><span class="discover-subtitle">Organisation</span>
			                    </div>

			                    <div class="col-xs-6  center text-purple btnSubTitle">
			                        <a href="#event.eventsv" class="lbh btn btn-discover bg-purple">
			                          <i class="fa fa-calendar"></i>
			                        </a><br/><span class="discover-subtitle">Évènement</span>
			                    </div>
			                    
			                    <div class="col-xs-6  center text-orange btnSubTitle">
			                        <a href="#project.projectsv" class="lbh btn btn-discover bg-orange">
			                          <i class="fa fa-lightbulb-o"></i>
			                        </a><br/><span class="discover-subtitle">Projet</span>
			                    </div>

			                </div>

			              </div>
			            </div>
			           
			        </div>
			    </div>

			    <div class="col-md-12 col-xs-12">
					<?php   $this->renderPartial('../pod/POIList', array( "parentId" => (String) $person["_id"],
																			"parentType" => Person::CONTROLLER));
					?>
		    	</div>
		    </div>
		    <?php } ?>
		</div>
		
		
		


		<?php /* if( (string)$person["_id"] == Yii::app()->session["userId"] ){ ?>
		<div class="text-dark">
			<div class="col-md-12 center bg-dark" id="panel-add">
				
				<h1 class="homestead text-white">
					<i class="fa fa-plus-circle" style="margin-left: 6px;"></i> ajouter
				</h1>
				<a class="btn bg-yellow lbh" href="#person.invite">
					<i class="fa fa-user"></i>
					<span class="lbl-btn-menu-name-add">quelqu'un</span>
				</a>
				<a class="btn bg-green lbh" href="#organization.addorganizationform">
					<i class="fa fa-group"></i>
					<span class="lbl-btn-menu-name-add">une organisation</span>
				</a>
				<a class="btn bg-purple lbh" href="#project.projectsv">
					<i class="fa fa-lightbulb-o"></i>
					<span class="lbl-btn-menu-name-add">un projet</span>
				</a>
				<a class="btn bg-orange lbh" href="#event.eventsv">
					<i class="fa fa-calendar"></i>
					<span class="lbl-btn-menu-name-add">un événement</span>
				</a>
			</div>
		</div>
		<?php } */ ?>
		
	</div>
</div>

<script type="text/javascript">
var personData = <?php echo json_encode($person)?>;
var personId = "<?php echo isset($person["_id"]) ? $person["_id"] : ""; ?>";
var personConnectId = "<?php echo Yii::app()->session["userId"]; ?>"
var countries = <?php echo json_encode($countries) ?>;
var birthDate = '<?php echo (isset($person["birthDate"])) ? $person["birthDate"] : null; ?>';
var tags = <?php echo json_encode($tags)?>;
var imagesD = <?php echo(isset($imagesD)  ) ? json_encode($imagesD) : "null"; ?>;
var contextMapPerson = <?php echo(isset($contextMapPerson)  ) ? json_encode($contextMapPerson) : "null"; ?>;


//By default : view mode
var mode = "view";

jQuery(document).ready(function() 
{
	if(imagesD != null){
		var images = imagesD;
	}

    bindAboutPodEvents();
    initXEditable();
	manageModeContext();
	changeHiddenIcone();
	debugMap.push(personData);

	//console.dir(contextMapPerson);

	if(contextMapPerson != null){
		var elementsMap = new Array();
		elementsMap.push(personData);
		$.each(contextMapPerson, function (key, value){
			$.each(value, function (key2, value2){
				elementsMap.push(value2);
			});
		});
		
		$("#btn-update-geopos").click(function(){
			findGeoPosByAddress();
		});
		$("#btn-update-geopos-admin").click(function(){
			findGeoPosByAddress();
		});

		/*$(".badgePH").hover(function(){
			$(".badgeText").html($(this).data('title'));
		});*/
		if(personData.address.addressLocality == ""){
			$(".cobtn,.whycobtn").removeClass("hidden");
			$(".cobtn").click(function () { 
				$(".cobtn,.whycobtn").hide();
				$('#editProfil').trigger('click');
				setTimeout( function () { 
					$('#address').trigger('click'); 
					}, 500);
				return false;
			});
		}
		$(".panel-btn-confidentiality .btn").click(function(){
			var type = $(this).attr("type");
			var value = $(this).attr("value");
			$(".btn-group-"+type + " .btn").removeClass("active");
			$(this).addClass("active");
		});

		Sig.currentPersonData = personData;
		Sig.contextData = contextMapPerson;
		Sig.restartMap();
		Sig.showMapElements(Sig.map, elementsMap);
	}
	buildQRCode("person","<?php echo (string)$person["_id"]?>");
	
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

function buildBgClassesList() 
{ 
	console.log("-----------------buildBgClassesList----------------------");
	if( $(".bgClassesContainer").html() == "" )
	{
		$.each(bgClasses,function(i,v) { 
			$(".bgClassesContainer").append('<a class="btn btn-xs btn-default bgChangeBtn" href="javascript:;" data-class="'+v.key+'" >'+v.name+'</a>');
			existingClasses += " "+v.key;
		});
		$(".bgChangeBtn").off().on("click", function(){
			setBg( $(this).data("class") );
		});
	}
}
function bindAboutPodEvents() 
{
	console.log("-----------------bindAboutPodEvents----------------------");
	$(".changePasswordBtn").click(function () {
		console.log("changePasswordbuttton");
		loadByHash('#person.changepassword.id.'+userId+'.mode.initSV', false);
	});

	$(".downloadProfil").click(function () {
		
		$.ajax({
			url: baseUrl + "/communecter/data/get/type/citoyens/id/"+personId ,
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

	$("#editProfil").click( function(){
		switchMode();
	});
	
	//console.log("personData");
	//console.dir(personData);

	$("#editGeoPosition").click(function(){
		Sig.startModifyGeoposition(personId, "citoyens", Sig.currentPersonData);
		showMap(true);
	});

	$('.exportMyDataBtn').click("click",function () { 
    	console.log("exportMyDataBtn");
    	$.ajax({
	        type: "GET",
	        url: baseUrl+"/"+moduleId+"/data/exportinitdata/id/<?php echo Yii::app()->session["userId"] ?>/module/communecter"
	        //dataType : "json"
	        //data: params
	    })
	    .done(function (data) 
	    {
	        if (data.result) {               
	        	toastr.success('Export successfull');
	        } else {
	           toastr.error('Something Went Wrong');
	        }
	    });
    });

    $(".editConfidentialityBtn").click(function(){
    	console.log("confidentiality");
    	$("#modal-confidentiality").modal("show");
    });

    $(".confidentialitySettings").click(function(){
	    	param = new Object;
	    	param.type = $(this).attr("type");
	    	param.value = $(this).attr("value");
			$.ajax({
		        type: "POST",
		        url: baseUrl+"/"+moduleId+"/person/updatesettings",
		        data: param,
		       	dataType: "json",
		    	success: function(data){
			    	toastr.success(data.msg);
			    }
			});
    	});

    

    $(".btn-confidentialitySettings").click(function(){
    	
	});


}

function initXEditable() {
	console.log("-----------------initXEditable----------------------");
	$.fn.editable.defaults.mode = 'inline';
	$('.editable-person').editable({
    	url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new job, it is only for update
    	onblur: 'submit',
    	showbuttons: false,
    	mode: 'popup',
    	success : function(data, newValue) {
	        if(data.result) {
	        	toastr.success(data.msg);
				loadActivity=true;	
	        }
	        else
	        	return data.msg;  
	    }
	});

	$('.socialIcon').editable({
		display: function(value) {
			manageSocialNetwork($(this), value);
		},
		url: baseUrl+"/"+moduleId+"/person/updatefield",
		mode: 'popup'
	})

    //username of the person
	$('#username').editable('option', 'validate', function(v) {
    	if (!v) return 'Required field!';
    	//Check if dirty
    	if (personData["username"] != null && personData["username"] != v) {
    		if (! isUniqueUsername(v)) {return 'This username is already used by another citizen !';}
    	}
	});

    //name of the person
	$('#name').editable('option', 'validate', function(v) {
    	if (!v) return 'Required field!';
	});

	//Select2 tags
    $('#tags').editable({
        url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new user, it is only for update
        mode : 'popup',
        value: <?php echo (isset($person["tags"])) ? json_encode(implode(",", $person["tags"])) : "''"; ?>,
        select2: {
            tags: <?php if(isset($tags)) echo json_encode($tags); else echo json_encode(array())?>,
            tokenSeparators: [","],
            width: 200,
            dropdownCssClass: 'select2-hidden'
        }
    });


    $('#mobile').editable({
        url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new user, it is only for update
        mode : 'popup',
        value: <?php echo (isset($person["telephone"]["mobile"])) ? json_encode(implode(",", $person["telephone"]["mobile"])) : "''"; ?>,
       /* select2: {
            tags: <?php if(isset($person["telephone"]["mobile"])) echo json_encode($person["telephone"]["mobile"]); else echo json_encode(array())?>,
            tokenSeparators: [","],
            width: 200,
            dropdownCssClass: 'select2-hidden'
        }	*/	
    });

    $('#fax').editable({
        url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new user, it is only for update
        mode : 'popup',
        value: <?php echo (isset($person["telephone"]["fax"])) ? json_encode(implode(",", $person["telephone"]["fax"])) : "''"; ?>,
        /*select2: {
            tags: <?php if(isset($person["telephone"]["fax"])) echo json_encode($person["telephone"]["fax"]); else echo json_encode(array())?>,
            tokenSeparators: [","],
            width: 200,
            dropdownCssClass: 'select2-hidden'
        }*/
    }); 

    /*$('#fixe').editable({
        url: baseUrl+"/"+moduleId+"/person/updatefield", //this url will not be used for creating new user, it is only for update
        mode : 'popup',
        value: <?php echo (isset($person["telephone"]["fixe"])) ? json_encode(implode(",", $person["telephone"]["fixe"])) : "''"; ?>,
        select2: {
        	tags : [],
        	//tags: <?php if(isset($person["telephone"]["fixe"])) echo json_encode($person["telephone"]["fixe"]); else echo json_encode(array())?>,
            tokenSeparators: [","],
            width: 200
        }
    }); */

	$('#fixe').editable({
		url: baseUrl+"/"+moduleId+"/person/updatefield",
		mode: 'popup',
		value: <?php echo (isset($person["telephone"]["fixe"])) ? json_encode(implode(",", $person["telephone"]["fixe"])) : "''"; ?>,
	});

    $('#addressCountry').editable({
		url: baseUrl+"/"+moduleId+"/person/updatefield",
		mode : 'popup',
		value: '<?php echo (isset( $person["address"]["addressCountry"])) ? $person["address"]["addressCountry"] : ""; ?>',
		source: function() {
			return countries;
		},
	});

	$('#birthDate').editable({
		url: baseUrl+"/"+moduleId+"/person/updatefield", 
		mode: 'popup',
		placement: "right",
		format: 'yyyy-mm-dd',   
    	viewformat: 'dd/mm/yyyy',
    	datepicker: {
            weekStart: 1,
        },
        showbuttons: true
	});
	$('#birthDate').editable('setValue', moment(birthDate, "YYYY-MM-DD HH:mm").format("YYYY-MM-DD"), true);

	$('#address').editable({
		validate: function(value) {
            value.streetAddress=$("#streetAddress").text();
            console.log(value);
        },
		url: baseUrl+"/"+moduleId+"/person/updatefield",
		mode: 'popup',
		success: function(response, newValue) {
			console.log("success update postal Code : ");
			console.dir(newValue);
			
			var country = notEmpty(response.user.address.addressCountry) ? response.user.address.addressCountry : null;
			var depName = notEmpty(response.user.address.depName) ? response.user.address.depName : null;
			var regionName = notEmpty(response.user.address.regionName) ? response.user.address.regionName : null;

			currentScopeType = "cp";
			addScopeToMultiscope(newValue.postalCode,newValue.postalCode);
			currentScopeType = "city";
			var unikey = response.user.address.addressCountry + "_" + newValue.codeInsee + "-" + newValue.postalCode; 
			addScopeToMultiscope(unikey, newValue.addressLocality);
			currentScopeType = "dep";
			if(notEmpty(depName)) addScopeToMultiscope(depName, depName);
			currentScopeType = "region";
			if(notEmpty(regionName)) addScopeToMultiscope(regionName, regionName);

			$("#entity-insee-value").attr("insee-val", newValue.codeInsee);
			$("#entity-cp-value").attr("cp-val", newValue.postalCode);
			//$(".menuContainer #menu-city").attr("onclick", "loadByHash( '#city.detail.insee."+newValue.codeInsee+"' )");

			$("#btn-geoloc-auto-menu").attr("href", "#city.detail.insee."+newValue.codeInsee+".postalCode"+newValue.postalCode);

			$('#btn-geoloc-auto-menu > span.lbl-btn-menu').html(newValue.addressLocality);
			$("#btn-menuSmall-mycity").attr("href", "#city.detail.insee."+newValue.codeInsee+".postalCode."+newValue.postalCode);
			$("#btn-menuSmall-citizenCouncil").attr("href", "#rooms.index.type.cities.id."+unikey);
			
			$(".msg-scope-co").html("<i class='fa fa-home'></i> Vous êtes communecté à " + newValue.addressLocality);
			$(".hide-communected").hide();
			$(".visible-communected").show();
		},
		value : {
        	postalCode: '<?php echo (isset( $person["address"]["postalCode"])) ? $person["address"]["postalCode"] : null; ?>',
        	codeInsee: '<?php echo (isset( $person["address"]["codeInsee"])) ? $person["address"]["codeInsee"] : ""; ?>',
        	addressLocality : '<?php echo (isset( $person["address"]["addressLocality"])) ? $person["address"]["addressLocality"] : ""; ?>'
    	}
	});


	if(<?php echo isset($person["name"]) 						? "true" : "false"; ?>){ $(".fa_name").removeClass("hidden"); }
	if(<?php echo isset($person["birthDate"]) 					? "true" : "false"; ?>){ $(".fa_birthDate").removeClass("hidden"); }
	if(<?php echo isset($person["email"]) 						? "true" : "false"; ?>){ $(".fa_email").removeClass("hidden"); }
	if(<?php echo isset($person["address"]["streetAddress"]) 	? "true" : "false"; ?>){ $(".fa_streetAddress").removeClass("hidden"); }
	if(<?php echo isset($person["address"]["postalCode"]) 		? "true" : "false"; ?>){ $(".fa_postalCode").removeClass("hidden"); }
	if(<?php echo isset($person["address"]["addressCountry"]) 	? "true" : "false"; ?>){ $(".fa_addressCountry").removeClass("hidden"); }
	if(<?php echo isset($person["telephone"]["mobile"]) 		? "true" : "false"; ?>){ $(".fa_telephone_mobile").removeClass("hidden"); }
	if(<?php echo isset($person["telephone"]["fixe"]) 			? "true" : "false"; ?>){ $(".fa_telephone").removeClass("hidden"); }
	if(<?php echo isset($person["telephone"]["fax"]) 			? "true" : "false"; ?>){ $(".fa_telephone_fax").removeClass("hidden"); }
}

function manageModeContext() {
	console.log("-----------------manageModeContext----------------------");
	listXeditables = [	'#birthDate', '#description', '#fax', '#fixe', '#mobile', '#tags', '#address', 
						'#addressCountry', '#facebookAccount', '#twitterAccount',
						'#gpplusAccount', '#gitHubAccount', '#skypeAccount', '#telegramAccount'];

	if (mode == "view") {
		$('.editable-person').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			$(value).editable('toggleDisabled');
		});
		$("#btn-update-geopos").addClass("hidden");
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('.editable-person').editable('option', 'pk', personId);
		$('.editable-person').editable('toggleDisabled');
		$.each(listXeditables, function(i,value) {
			//add primary key to the x-editable field
			$(value).editable('option', 'pk', personId);
			$(value).editable('toggleDisabled');
		})
		$("#btn-update-geopos").removeClass("hidden");
	}
}

function switchMode() {
	console.log("-----------------switchMode----------------------");
	if(mode == "view"){
		mode = "update";
		manageModeContext();
		changeHiddenIcone() ;
		$("#btn-validate-changes").show();
		$(".editProfilLbl").html(" Enregistrer les changements");
		$("#editProfil").addClass("btn-red");
		$(".cobtn,.whycobtn").addClass("hidden");
	} else {
		mode ="view";
		manageModeContext();
		changeHiddenIcone() ;
		$("#btn-validate-changes").hide();
		$(".editProfilLbl").html(" Éditer");
		$("#editProfil").removeClass("btn-red");
		if(personData.address.addressLocality == "")
			$(".cobtn,.whycobtn").removeClass("hidden");

	}
}



function changeHiddenIcone() 
{ 
	console.log("-----------------changeHiddenIcone----------------------");
	/*console.log("------------", $("#fax").text().length, $("#fax").val());*/
	console.log("------------", mode);
	if(mode == "view"){
		if($("#username").text().length == 0){ $(".fa_name").addClass("hidden"); }
		if($("#birthDate").text().length == 0){ $(".fa_birthDate").addClass("hidden"); }
		if($("#email").text().length == 0){ $(".fa_email").addClass("hidden"); }
		if($("#streetAddress").text().length == 0){ $(".fa_streetAddress").addClass("hidden"); }
		if($("#address").text().length == 0){ $(".fa_postalCode").addClass("hidden"); }
		if($("#addressCountry").text().length == 0){ $(".fa_addressCountry").addClass("hidden"); }
		if($("#mobile").text().length == 0){ $(".fa_telephone_mobile").addClass("hidden"); }
		if($("#fixe").text().length == 0){ $(".fa_telephone").addClass("hidden"); }
		if($("#fax").text().length == 0){ $(".fa_telephone_fax").addClass("hidden"); }
	} else {
		$(".fa_name").removeClass("hidden"); 
		$(".fa_birthDate").removeClass("hidden"); 
		$(".fa_email").removeClass("hidden"); 
		$(".fa_streetAddress").removeClass("hidden"); 
		$(".fa_postalCode").removeClass("hidden"); 
		$(".fa_addressCountry").removeClass("hidden"); 
		$(".fa_telephone_mobile").removeClass("hidden"); 
		$(".fa_telephone").removeClass("hidden"); 
		$(".fa_telephone_fax").removeClass("hidden"); 
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



	//modification de la position geographique	

	function findGeoPosByAddress(){
		console.log("-----------------findGeoPosByAddress----------------------");
		//si la streetAdress n'est pas renseignée
		if($("#streetAddress").html() == $("#streetAddress").attr("data-emptytext")){
			//on récupère la valeur du code insee s'il existe
			if ($("#entity-insee-value").attr("insee-val") != ""){
				var insee = $("#entity-insee-value").attr("insee-val");
				var postalCode = $("#entity-cp-value").attr("cp-val");
			}
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			if(insee != "") findGeoposByInsee(insee, null, postalCode);
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
			personData["geo"] = { "latitude" : obj[0].lat, "longitude" : obj[0].lon };
			//et on affiche le marker sur la carte à cette position
			showGeoposFound(coords, personId, "person", personData);
		}
		//si nominatim n'a pas trouvé de résultat
		else {
			//on récupère la valeur du code insee s'il existe
			if ($("#entity-insee-value").attr("insee-val") != ""){
				var insee = $("#entity-insee-value").attr("insee-val");
				var postalCode = $("#entity-cp-value").attr("cp-val");
			}
			//si on a un codeInsee, on lance la recherche de position par codeInsee
			console.log("recherche by insee", insee);
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
			
			personData["geo"] = { "latitude" : obj.geo.latitude, "longitude" : obj.geo.longitude };
			//on affiche le marker sur la carte
			showGeoposFound(coords, personId, "person", personData);
		}
		else {
			console.log("Erreur getlatlngbyinsee vide");
		}
	}

	//quand la recherche par code insee n'a pas fonctionné
	function callbackFindByInseeError(){
		console.log("erreur getlatlngbyinsee");
		toastr.error('');
	}

</script>