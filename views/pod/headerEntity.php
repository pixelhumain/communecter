<?php 
$cssAnsScriptFilesTheme = array(
		
	'/plugins/Chart.js/Chart.min.js',
	'/plugins/jquery.qrcode/jquery-qrcode.min.js',
	'/plugins/Chart.js/Chart.min.js',
	'/plugins/showdown/showdown.min.js',
	//'/plugins/bootstrap-markdown/js/bootstrap-markdown.js',
	//'/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css'
	//'/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',
	//'/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js' , 

);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->request->baseUrl);
$cssAnsScriptFilesModule = array(
	//Data helper
	//'/js/dataHelpers.js',
	//'/js/postalCode.js',
	//'/js/activityHistory.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

$controler = Element::getControlerByCollection($type);

?>

<style>
	/*.headerEntity{
		margin-top:-10px;

		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/wavegrid.png");
		background-repeat: repeat;
		
		moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 2px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
	}*/

	.headerEntity{
		/*margin: 0px;*/
		
		background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/dda-connexion-lines.jpg");
		background-repeat: repeat;
		background-size: 200%;
		
		/*background-position: left bottom -40px;*/
		moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 0px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
		border-radius: 0px;
		margin-top:-10px;
		margin-bottom:10px;
		padding-bottom: 60px;
	}

	.headerEntity .thumbnail{
		margin-bottom:0px;
		max-height:150px;
		display:inline;
	}
	.headerEntity .lbl-entity-name{
		font-size:24px;
	}
	.headerEntity .lbl-entity-locality{
		font-size:14px;
	}
	.headerEntity hr{
		border-top: 1px solid rgba(186, 186, 186, 0.5);
		margin-top:7px;
		margin-bottom:7px;

	}
	.headerEntity .label.tag{
		margin-top:3px;
		margin-left:3px;

	}
	.box-ajaxTools{
		margin-top: -70px;
	}
	.box-ajaxTools .btn.tooltips, 
	.box-ajaxTools .btn.tooltips.active{
		margin-right:10px;
		margin-top:15px;
		border-radius: 10px !important;
	}
	.tag{
		cursor: pointer;
	}


	#shortDescriptionHeader{
		max-height: 75px;
		overflow: hidden;
		font-size: 15px;
	}




	@media screen and (max-width: 767px) {
		.headerEntity{
			background-size: 360%;
		}
	}
	@media screen and (max-width: 1024px) {
		.headerEntity .lbl-entity-name{
			font-size:20px;
		}
		.headerEntity .lbl-entity-locality{
			font-size:13px;
		}
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
	.fileupload, .fileupload-preview.thumbnail, .fileupload-new .thumbnail, .fileupload-new .thumbnail img, .fileupload-preview.thumbnail img{
		border:inherit !important;
	}
</style>

<div class="row headerEntity bg-light">
	<?php if($type != "pixels" || !empty($viewer)) { ?>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 padding-10 center">
			<?php   
				if(@$entity["profilMediumImageUrl"] && !empty($entity["profilMediumImageUrl"]))
					$images=array("profil"=> array($entity["profilMediumImageUrl"]));
				else 
					$images="";	
				$this->renderPartial('../pod/fileupload', array(  "itemId" => (string) $entity["_id"],
																  "type" => $type,
																  "resize" => false,
																  "contentId" => Document::IMG_PROFIL,
																  "show" => true,
																  "editMode" => $edit,
																  "image" => $images,
																  "openEdition" => $openEdition) ); 
			//	$profilThumbImageUrl = Element::getImgProfil(@$entity, "profilMediumImageUrl", $this->module->assetsUrl);
			?>
			<button class="col-xs-12 center btn btn-default text-azure" style="margin-left:10px;" onclick="showMap(true)">
				<i class="fa fa-map-marker"></i> <span class="hidden-xs hidden-sm">Afficher sur la carte</span>
			</button>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">

			<div class="col-lg-12 col-md-12 col-sm-12 no-padding">
				<div class="col-md-12 no-padding margin-top-15">
					<?php if($type == Organization::COLLECTION || $type == Event::COLLECTION){ ?>
						<h2 class="text-left no-margin <?php if (!@$entity["type"] && !empty($entity["type"])) echo "hide" ?>" style="font-weight:100; font-size:19px;">
								<i class="fa fa-angle-right"></i> 
								<label id="typeHeader" class="text-dark"><?php
								if($type == Event::COLLECTION)
									echo Yii::t(Element::getCommonByCollection($type), @$entity["type"], null, Yii::app()->controller->module->id); 
								else
									echo Yii::t("common", @$entity["type"]); 
								?></label>
						</h2>
					<?php } ?>
					<span class="lbl-entity-name">
						<i class="fa fa-<?php echo Element::getFaIcon($type); ?>">
						</i> <label id="nameHeader" class="">
								<?php echo @$entity["name"]; ?>
							</label>
					</span>
					<?php if(!empty($entity["parentId"]) && !empty($entity["parentType"])) {
							$parentEvent = Element::getElementSimpleById($entity["parentId"], $entity["parentType"]);
							echo "<br/>".Yii::t("common","Parenthood").' : <a href="#'.$entity["parentType"].'.detail.id.'.$entity["parentId"].'" class="lbh">'.$parentEvent["name"]."</a>";
							//echo Yii::t("event","Part of Event",null,Yii::app()->controller->module->id).' : <a href="#'.Event::COLLECTION.'.detail.id.'.$entity["parentId"].'" class="lbh">'.$parentEvent["name"]."</a>";	
						}
					?>
				</div>
				<div id="addressHeader" class="col-md-12 no-padding no-padding margin-bottom-10">
					<span class="lbl-entity-locality text-red">
						<?php if( ($type == Person::COLLECTION && Preference::showPreference($entity, $type, "locality", Yii::app()->session["userId"])) || $type!=Person::COLLECTION) { ?>
						<i id="iconLocalityyHeader" class="fa fa-globe <?php echo (empty($entity['address'])?'hidden':'');?>"></i>
						<label class="text-red" id="localityHeader"><?php echo (empty($entity["address"]["addressLocality"])?"":$entity["address"]["addressLocality"].","); ?></label> 
						<label class="text-red" id="pcHeader"><?php echo (empty($entity["address"]["postalCode"])?"":($entity["address"]["postalCode"].",")); ?></label>
						<label class="text-red" id="countryHeader"><?php echo (empty($entity["address"]["addressCountry"])?"":OpenData::$phCountries[ $entity["address"]["addressCountry"]]); ?></label> 
						<?php } ?>	
					</span>
				</div>
				<?php if($type==Person::COLLECTION && Yii::app()->session["userId"] == (string) $entity["_id"]) { ?>
					<div id="divCommunecterMoi" class="col-md-12 no-padding no-padding margin-bottom-10">
						<a href="javascript:;" class="cobtnHeader hidden btn bg-red"><i class="fa fa-home"></i> <?php echo Yii::t("common", "Connect to your city");?></a> 
						<a href="javascript:;" class="whycobtnHeader hidden btn btn-default explainLink" data-id="explainCommunectMe" ><?php echo Yii::t("common", "Why ?"); ?></a>
					</div>
					<?php if(@$entity["seePreferences"] && $entity["seePreferences"]==true){ ?>
						<div id="divSeePreferencesHeader" class="col-md-12 text-dark no-padding">
							<a href="javascript:;" id="confidentialityBtn" class="btn bg-red"><i class="fa fa-cog"></i> Vérifier <span class="hidden-xs">si</span> les paramètres<span class="hidden-xs"> vous conviennent</span></a> 
						</div>
					<?php }
				} ?>
			</div>
			<?php if($type == Project::COLLECTION){ ?>
			<div class="col-md-12 text-dark no-padding" >
				<?php if(isset($entity["properties"]["avancement"])){ 
					//idea => concept => Started => development => testing => mature
					if($entity["properties"]["avancement"]=="idea")
						$val=5;
					else if($entity["properties"]["avancement"]=="concept")
						$val=20;
					else if ($entity["properties"]["avancement"]== "started")
						$val=40;
					else if ($entity["properties"]["avancement"] == "development")
						$val=60;
					else if ($entity["properties"]["avancement"] == "testing")
						$val=80;
					else 
						$val=100;
					echo "<label id='labelProgressStyle'>".Yii::t("project",$entity["properties"]["avancement"],null,Yii::app()->controller->module->id)."</label>";
				}  
				if(isset($entity["properties"]["avancement"])){ ?>
					<progress id="progressStyle" max="100" value="<?php echo $val;?>" class="progressStyle">
					</progress>
				<?php } else { ?>
					<progress id="progressStyle" max="100" value="0" class="progressStyle hide">
					</progress>
				<?php } ?>
			</div>
			<?php } ?>

			<div id="shortDescriptionHeader" class="col-lg-12 col-xs-12 no-padding hidden-xs"><?php echo (isset($entity["shortDescription"])) ? $entity["shortDescription"] : null; ?></div>
			<input type="hidden" id="shortDescriptionMarkdown" name="shortDescriptionMarkdown" value="<?php echo (!empty($element['shortDescription'])) ? $element['shortDescription'] : ''; ?>">
			<?php if($edit==true || $openEdition==true ){?>
		  		<a href='javascript:;' id="btn-update-shortdesc" class="tooltips" data-toggle="tooltip" data-placement="bottom" title="<?php echo Yii::t("common","Update Description");?>"><i class="fa text-red fa-pencil"></i></a> <?php } ?>
		</div>
		

		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-8 pull-right padding-10">
			<div class="col-xs-12 no-padding">
				<?php 
				if(!empty($entity["badges"])){?>
					<?php if( Badge::checkBadgeInListBadges("opendata", $entity["badges"]) ){?>
						<div class="badgePH pull-right" data-title="OPENDATA">
							<span class="fa-stack tooltips opendata" style="maring-bottom:5px" data-toggle="tooltip" data-placement="bottom" title='<?php echo Yii::t("badge","opendata", null, Yii::app()->controller->module->id)?>'>
								<i class="fa fa-database main fa-stack-1x text-dark"></i>
								<i class="fa fa-share-alt  mainTop fa-stack-1x"></i>
							</span>
							<span class="text-dark inline" style="font-size: 15px; line-height: 30px;"> 
								<?php echo Yii::t("common","Open data") ?>						
							</span>
						</div>
				<?php } 
				} ?>
			</div>

			<div class="col-xs-12 no-padding">
				<?php 
				if ($openEdition == true) { ?>
					<div class="badgePH pull-right" data-title="OPENEDITION">
						<span class="pull-right tooltips" data-toggle="tooltip" data-placement="bottom" title="Tous les utilisateurs ont la possibilité de participer / modifier les informations." style="font-size: 15px; line-height: 30px;"><i class="fa fa-creative-commons"></i> <?php echo Yii::t("common","Open edition") ?></span>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right padding-10">
			<style type="text/css">
				.badgePH{ 
					cursor: pointer;
					display: inline-block;
					margin-top: 10px;
					/*margin-bottom: 10px;*/
				}
				/*.badgePH .fa-stack .main { font-size:2.2em;margin-left:10px;margin-top:20px}*/
				.badgePH .fa-stack .main { font-size:1.5em}
				.badgePH .fa-stack .mainTop { 
					/*margin-left:10px;*/
					text-shadow: 0px -1px #656565;;
					margin-top:-5px}
				.badgePH .fa-stack .fa-circle-o{ font-size:4em;}
				/* Tooltip container */
				.opendata .mainTop{
				    color: white;
				    font-size: 1em;
				    padding: 5px;
				}
				.opendata .main{
				    color: #00cc00;
				}
			</style>

			<div class="col-xs-12 no-padding">
				<?php if ($type==Person::COLLECTION){ ?>
				<span class="label label-warning pull-right">
					<i class="fa fa-bookmark"></i> <a href="javascript:;"  class="explainLink" data-id="explainGamification" style="color:inherit;"> 
					<?php echo Gamification::badge( (string)$entity["_id"] )." : " ?>
					<?php echo  @$entity["gamification"]['total'] ? 
								@$entity["gamification"]['total'] :
								"0"; 
					?> pts
					</a>
				</span><br>
				<?php } ?>
				<div id="divTagsHeader" class="badgePH pull-right">
					<?php if(isset($entity["tags"])){ ?>
						<?php 
							//$i=0; 
							foreach($entity["tags"] as $tag){ 
								//if($i<6) { 
									//$i++;?>
									<div class="tag label label-danger pull-right" data-val="<?php echo  $tag; ?>">
										<i class="fa fa-tag"></i> <?php echo  $tag; ?>
									</div>
					<?php 		//}
							} 
					} ?>
				</div>
			</div>
			
			
		</div>
	<?php }else{ ?>
		
	<?php } ?>

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
	        		<?php if ($type==Person::COLLECTION){ ?>
		        		<strong><i class="fa fa-group"></i> <?php echo Yii::t("common","Public"); ?></strong> : <?php echo Yii::t("common","Visible for everyone."); ?><br/>
		        		<strong><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","Private"); ?></strong> : <?php echo Yii::t("common","Visible for my contacts."); ?><br/>
		        		<strong><i class="fa fa-ban"></i> <?php echo Yii::t("common","Mask"); ?></strong> : <?php echo Yii::t("common","Not visible."); ?><br/>
	        		<?php } ?>
	        			<strong><i class="fa fa-group"></i> <?php echo Yii::t("common","Open Data"); ?></strong> : <?php echo Yii::t("common","You propose your data in free access, to contribut for commons."); ?><br/>
	        		<?php if ($type!=Person::COLLECTION){ ?>
	        			<strong><i class="fa fa-group"></i> <?php echo Yii::t("common","Open Edition") ;?></strong> : <?php echo Yii::t("common","All users can participed / modified the informations."); ?><br/>
	        		<?php } ?>
	        	</div>
		    </div>
		    <div class="row text-dark panel-btn-confidentiality">
		    	<?php if ($type==Person::COLLECTION){ ?>
		    		<div class="col-sm-4 text-right padding-10 margin-top-10">
			        	<i class="fa fa-message"></i> <strong><?php echo Yii::t("person","Birth date"); ?> :</strong>
			        </div>
			        <div class="col-sm-8 text-left padding-10">
			        	<div class="btn-group btn-group-birthDate inline-block">
			        		<button class="btn btn-default confidentialitySettings" type="birthDate" value="public"><i class="fa fa-group"></i> <?php echo Yii::t("common","Public"); ?></button>
			        		<button class="btn btn-default confidentialitySettings" type="birthDate" value="private"><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","Private"); ?></button>
			        		<button class="btn btn-default confidentialitySettings" type="birthDate" value="hide"><i class="fa fa-ban"></i> <?php echo Yii::t("common","Mask"); ?></button>
			        	</div>
			        </div>
		            <div class="col-sm-4 text-right padding-10 margin-top-10">
			        	<i class="fa fa-message"></i> <strong><?php echo Yii::t("common","My mail"); ?> :</strong>
			        </div>
			        <div class="col-sm-8 text-left padding-10">
			        	<div class="btn-group btn-group-email inline-block">
			        		<button class="btn btn-default confidentialitySettings" type="email" value="public"><i class="fa fa-group"></i> <?php echo Yii::t("common","Public"); ?></button>
			        		<button class="btn btn-default confidentialitySettings" type="email" value="private"><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","Private"); ?></button>
			        		<button class="btn btn-default confidentialitySettings" type="email" value="hide"><i class="fa fa-ban"></i> <?php echo Yii::t("common","Mask"); ?></button>
			        	</div>
			        </div>
			        <div class="col-sm-4 text-right padding-10 margin-top-10">
			        	<i class="fa fa-message"></i> <strong><?php echo Yii::t("common","Locality") ;?> :</strong>
			        </div>
			        <div class="col-sm-8 text-left padding-10">
			        	<div class="btn-group btn-group-locality inline-block">
			        		<button class="btn btn-default confidentialitySettings" type="locality" value="public" selected><i class="fa fa-group"></i> <?php echo Yii::t("common","Public") ;?></button>
			        		<button class="btn btn-default confidentialitySettings" type="locality" value="private"><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","Private"); ?></button>
			        		<button class="btn btn-default confidentialitySettings" type="locality" value="hide"><i class="fa fa-ban"></i> <?php echo Yii::t("common","Mask"); ?></button>
			        	</div>
			        </div>
			        <div class="col-sm-4 text-right padding-10 margin-top-10">
			        	<i class="fa fa-message"></i> <strong><?php echo Yii::t("common","My phone"); ?>  :</strong>
			        </div>
			        <div class="col-sm-8 text-left padding-10">
			        	<div class="btn-group btn-group-phone inline-block">
			        		<button class="btn btn-default confidentialitySettings" type="phone" value="public"><i class="fa fa-group"></i> <?php echo Yii::t("common","Public") ;?></button>
			        		<button class="btn btn-default confidentialitySettings" type="phone" value="private"><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","Private") ;?></button>
			        		<button class="btn btn-default confidentialitySettings" type="phone" value="hide"><i class="fa fa-ban"></i> <?php echo Yii::t("common","Mask"); ?></button>
			        	</div>
			        </div>
			        <div class="col-sm-4 text-right padding-10 margin-top-10">
			        	<i class="fa fa-message"></i> <strong><?php echo Yii::t("common","My directory"); ?>  :</strong>
			        </div>
			        <div class="col-sm-8 text-left padding-10">
			        	<div class="btn-group btn-group-directory inline-block">
			        		<button class="btn btn-default confidentialitySettings" type="directory" value="public"><i class="fa fa-group"></i> <?php echo Yii::t("common","Public") ;?></button>
			        		<button class="btn btn-default confidentialitySettings" type="directory" value="private"><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","Private") ;?></button>
			        		<button class="btn btn-default confidentialitySettings" type="directory" value="hide"><i class="fa fa-ban"></i> <?php echo Yii::t("common","Mask"); ?></button>
			        	</div>
			        </div>
			        

		        <?php } ?>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong><?php echo Yii::t("common","Open Data") ;?> :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-isOpenData inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="true"><i class="fa fa-group"></i> <?php echo Yii::t("common","Yes"); ?></button>
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="false"><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","No"); ?></button>
						<?php
							$url = Yii::app()->baseUrl.'/api/';
							if($type == Person::COLLECTION)
								$url .= Person::CONTROLLER;
							else if($type == Organization::COLLECTION)
								$url .= Organization::CONTROLLER;
							else if($type == Event::COLLECTION)
								$url .= Event::CONTROLLER;
							else if($type == Project::COLLECTION)
								$url .= Project::CONTROLLER;
						?>
						<a href="<?php echo $url.'/get/id/'.$entity['_id'] ;?>" data-toggle="tooltip" title='Visualiser la données' id="urlOpenData" class="urlOpenData" target="_blank"><i class="fa fa-eye"></i></a>
					</div>
		        </div>
		        <?php if($type != Person::COLLECTION){ ?>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong><?php echo Yii::t("common","Open Edition") ;?> :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-isOpenEdition inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="isOpenEdition" value="true"><i class="fa fa-group"></i> <?php echo Yii::t("common","Yes"); ?></button>
		        		<button class="btn btn-default confidentialitySettings" type="isOpenEdition" value="false"><i class="fa fa-user-secret"></i> <?php echo Yii::t("common","No"); ?></button>
					</div>
		        </div>
		        <?php } ?>
	        </div>
	      </div>
	      <script type="text/javascript">
			<?php
				//Params Checked
				$typePreferences = array("privateFields", "publicFields");
				$nameFields = array("email", "locality", "phone", "directory", "birthDate");
				foreach ($nameFields as $key => $value) {
					$fieldPreferences[$value] = true;
				}
				$typePreferencesBool = array("isOpenData", "isOpenEdition");

				//To checked private or public
				foreach($typePreferences as $typePref){
					foreach ($fieldPreferences as $field => $hidden) {
						if(isset($entity["preferences"][$typePref]) && in_array($field, $entity["preferences"][$typePref])){
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
					if(isset($entity["preferences"][$typePrefB]) && $entity["preferences"][$typePrefB] == true)
						echo "$('.btn-group-$typePrefB > button[value=\'true\']').addClass('active');";	
					else
						echo "$('.btn-group-$typePrefB > button[value=\'false\']').addClass('active');";
				}	
			?> 
	     </script>
	      <div class="modal-footer">
	        <button type="button" class="lbh btn btn-success btn-confidentialitySettings" data-dismiss="modal" aria-label="Close" data-hash="#element.detail.type.<?php echo $type ?>.id.<?php echo $entity['_id'] ;?>">OK</button>
	      </div>
	      <?php
		      //$addLink = (empty($users[Yii::app()->session["userId"]])?false:true); 
		      if($edit && $type != Person::COLLECTION) 
				$this->renderPartial('../element/addMembersFromMyContacts',array("type"=>$type, "parentId" =>(string)$entity['_id'], "users"=>@$users)); ?>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<?php 
Menu::element($entity,$type, @$menuConfig);
$this->renderPartial('../default/panels/toolbar');

$emptyAddress = (empty($entity["address"]["codeInsee"])?true:false);
$showOdesc = true ;
if(Person::COLLECTION == $type){
	$showLocality = (Preference::showPreference($entity, $type, "locality", Yii::app()->session["userId"])?true:false);
	$showOdesc = ((Preference::isOpenData($entity["preferences"]) && Preference::isPublic($entity, "locality"))?true:false);	
}
$odesc = "" ;
if($showOdesc == true){
	$controller = Element::getControlerByCollection($type) ;
	if($type == Person::COLLECTION)
		$odesc = $controller." : ".addslashes( strip_tags(json_encode(@$entity["shortDescription"]))).",".addslashes(json_encode(@$entity["address"]["streetAddress"])).",".@$entity["address"]["postalCode"].",".@$entity["address"]["addressLocality"].",".@$entity["address"]["addressCountry"] ;
	else if($type == Organization::COLLECTION)
		$odesc = $controller." : ".@$entity["type"].", ".addslashes( strip_tags(json_encode(@$entity["shortDescription"]))).",".addslashes(json_encode(@$entity["address"]["streetAddress"])).",".@$entity["address"]["postalCode"].",".@$entity["address"]["addressLocality"].",".@$entity["address"]["addressCountry"];
	else if($type == Event::COLLECTION)
		$odesc = $controller." : ".@$entity["startDate"].",".@$entity["endDate"].",".addslashes(json_encode(@$entity["address"]["streetAddress"])).",".@$entity["address"]["postalCode"].",". @$entity["address"]["addressLocality"].",".@$entity["address"]["addressCountry"].",".addslashes(strip_tags(json_encode(@$entity["shortDescription"])));
	else if($type == Project::COLLECTION)
		$odesc = $controller." : ".addslashes( strip_tags(json_encode(@$entity["shortDescription"]))).",".addslashes(json_encode(@$entity["address"]["streetAddress"])).",".@$entity["address"]["postalCode"].",".@$entity["address"]["addressLocality"].",".@$entity["address"]["addressCountry"];
}
	
?>

<script type="text/javascript">

var contextData = {
		name : "<?php echo addslashes($entity["name"]) ?>",
		id : "<?php echo (string)$entity["_id"] ?>",
		type : "<?php echo $type ?>",
		controller : <?php echo json_encode(Element::getControlerByCollection($type))?>,
		otags : "<?php echo addslashes($entity["name"]).",".$type.",communecter,".@$entity["type"].",".addslashes(@implode(",", $entity["tags"])) ?>",
		
		odesc : <?php echo json_encode($odesc) ?>,
		<?php 
		if( @$entity["startDate"] )
			echo "'startDate':'".$entity["startDate"]."',";
		if( @$entity["endDate"] )
			echo "'endDate':'".$entity["endDate"]."'"; ?>
};	

var contextMap = [];
// If come from directoryAction => contextMap is already load
<?php if(@$links){ ?>
	var loadAllLinks=false;
<?php } else { ?>
	var loadAllLinks=true;
<?php } ?>
//var elementLinks = <?php echo isset($entity["links"]) ? json_encode($entity["links"]) : "''"; ?>;
var contextType = <?php echo json_encode($type)?>;
var element = <?php echo isset($entity) ? json_encode($entity) : "''"; ?>;
if(contextType == "<?php echo Person::COLLECTION ?>")
	contextIcon = "circle text-yellow";
else if(contextType == "<?php echo Organization::COLLECTION ?>")
	contextIcon = "circle text-green";
else if(contextType == "<?php echo Event::COLLECTION ?>")
	contextIcon = "circle text-orange";
else if(contextType == "<?php echo Project::COLLECTION ?>")
	contextIcon = "circle text-purple";
else
	contextIcon = "circle";
var firstViewTitle = "<?php echo @$firstView ?>";
var currentView = "<?php echo @$firstView ?>";
var firstView = true;
// Views' array of element
var mapUrl = { 	
	"detail": 
		{ 
			"url"  : "element/detail/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
			"hash" : "<?php echo $controler ?>.detail.id.<?php echo (string)$entity["_id"] ?>",
			"data" : null
		} ,
	"detail.edit": 
		{ 
			"url"  : "element/detail/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
			//"hash" : "element.detail.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
			"hash" : "<?php echo $controler ?>.detail.id.<?php echo (string)$entity["_id"] ?>",
			"data" : {"modeEdit":true}
		},
	"news": 
		{ 
			"url"  : "news/index/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?isFirst=1&", 
			"hash" : "news.index.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
			"data" : null
		} ,
	"directory": 
		{ 
			"url"  : "element/directory/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?tpl=directory2&", 
			"hash" : "<?php echo $controler ?>.directory.id.<?php echo (string)$entity["_id"] ?>",
			"data" : null
		} ,
	"gallery" :
		{ 
			"url"  : "gallery/index/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
			"hash" : "gallery.index.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
			"data" : null
		} ,
	"addmembers" :
		{ 
			"url"  : "element/addmembers/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
			"hash" : "element.addmembers.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
			"data" : null
		} ,
	"addtimesheet":
		{
			"url"  : "gantt/addtimesheetsv/id/<?php echo (string)$entity["_id"] ?>/type/<?php echo $type ?>?", 
			"hash" : "gantt.addtimesheetsv.id.<?php echo (string)$entity["_id"] ?>.type.<?php echo $type ?>",
			"data" : null
		},
	"addchart":
		{
			"url"  : "chart/addchartsv/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
			"hash" : "chart.addchartsv.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
			"data" : null
	
		},
	"addneed":
		{
			"url"  : "need/addneedsv/id/<?php echo (string)$entity["_id"] ?>/type/<?php echo $type ?>?", 
			"hash" : "need.addneedsv.id.<?php echo (string)$entity["_id"] ?>.type.<?php echo $type ?>",
			"data" : null
	
		},
	"calendarview":
		{
			"url"  : "event/calendarview/id/<?php echo (string)$entity["_id"] ?>?", 
			"hash" : "event.calendarview.id.<?php echo (string)$entity["_id"] ?>",
			"data" : null							
		},
};
var listElementView = [	'detail', 'detail.edit', 'news', 'directory', 'gallery', 'addmembers', 'calendarview', 'addtimesheet', 'addchart', 'addneed', 'calendarview'];

jQuery(document).ready(function() {
	setTitle(decodeHtml(element.name),contextIcon);	
	mylog.log("loadAllLinks-------", loadAllLinks);
	
	if(loadAllLinks){
		$.ajaxSetup({ cache: true});
		$.ajax({
			url: baseUrl+"/"+moduleId+"/element/getalllinks/type/<?php echo $type ;?>/id/<?php echo (string)$entity["_id"] ?>",
			type: 'POST',
			//data:{ "links" : elementLinks },
			cache: true,
			dataType: "json",
			success: function (obj){
				mylog.log("conntext/////");
				mylog.log(obj);
				//Sig.restartMap();
				contextMap = obj;
				//mapUrl["directory"]["data"] = {"links" : contextMap};
				//$(".communityBtn").removeClass("hide");
				Sig.showMapElements(Sig.map, obj);	

				
				
			},
			error: function (error) {
				mylog.log("error findGeoposByInsee");
				callbackFindByInseeError(error);	
				$("#iconeChargement").hide();	
			}
		});	
	} else {
		//var elementLinks = <?php echo isset($entity["links"]) ? json_encode($entity["links"]) : "''"; ?>;
		contextMap = <?php echo isset($links) ? json_encode($links) : "''"; ?> ;
		//mapUrl["directory"]["data"] = {"links" : contextMap};
		//Sig.restartMap();
		mylog.log(contextMap);
		Sig.showMapElements(Sig.map, contextMap);	
		//$(".communityBtn").removeClass("hide");
	}

	if(typeof(element.address) != "undefined" && element.address.addressLocality == ""){
		$(".cobtnHeader,.whycobtnHeader").removeClass("hidden");
		$("#addressHeader").addClass("hidden");
		$(".cobtnHeader").click(function () {
			communecterUser();				
		});
	}

	$("#confidentialityBtn").on("click", function(){
    	$("#modal-confidentiality").modal("show");
    	param = new Object;
    	param.name = "seePreferences";
    	param.value = false;
    	param.pk = "<?php echo (string)$entity["_id"] ?>";
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
	        data: param,
	       	dataType: "json",
	    	success: function(data){
		    	//toastr.success(data.msg);
		    	if(data.result){
					$("#divSeePreferencesHeader").addClass("hidden");
					if($('#editConfidentialityBtn').length ){
						$('#editConfidentialityBtn').removeClass("btn-red");
					}
		    	}
		    }
		});
    });

    $("#btn-update-shortdesc").off().on( "click", function(){
		var dataUpdate = { value : $("#shortDescriptionMarkdown").val() } ;
		var properties = {
			value : typeObjLib["description"],
			pk : {
	            inputType : "hidden",
	            value : contextData.id
	        },
			name: {
	            inputType : "hidden",
	            value : "shortDescription"
	        }
		};

		var onLoads = null;
		var beforeSave = null ;
		var afterSave = function(data){
			$("#shortDescriptionHeader").val(data.shortDescription);
			elementLib.closeForm();
		};
		
		var saveUrl = baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType;
		elementLib.editDynForm("Modifier la description court", "fa-pencil", properties, null, dataUpdate, saveUrl, onLoads, beforeSave, afterSave);
	});


	

});



function showElementPad(type, id){
	currentView=type;
	/*if(firstView){
		if(firstViewTitle.substr(0,4) == "need"){
			mapUrl[firstViewTitle] = new Object;
			mapUrl[firstViewTitle]["url"] = "need/detail/id/"+firstViewTitle.substr(4,firstViewTitle.length)+"?"; 
			mapUrl[firstViewTitle]["hash"] = "need.detail.id."+firstViewTitle.substr(4,firstViewTitle.length);
			mapUrl[firstViewTitle]["data"] = null;
			listElementView.push(firstViewTitle);
		}
		mapUrl[firstViewTitle]["load"] = true;
		mapUrl[firstViewTitle]["html"] = $("#pad-element-container").html();
		firstView=false;
	}*/
	// If type is need, add "need+id" object view in mapUrl
	if(type=="need"){
		type=type+id;
		if(typeof(mapUrl[type]) == "undefined"){
			mapUrl[type] = new Object;
			mapUrl[type]["url"] = "need/detail/id/"+id+"?"; 
			mapUrl[type]["hash"] = "need.detail.id."+id;
			mapUrl[type]["data"] = null;
			listElementView.push("need"+id);
		}
	} 
	var url  = mapUrl[type]["url"];
	var hash = mapUrl[type]["hash"];
	var data = mapUrl[type]["data"];
	var type = type;
	$.blockUI({
		message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Chargement en cours ...</span></h4>"
	});
	// If type object content load = true, no ajax
	if(typeof(mapUrl[type]["load"]) != "undefined" && mapUrl[type]["load"] == true){
		mylog.log("no ajax load");
		mylog.log(mapUrl);
		$.each(listElementView, function(i,value) {
			$("#"+value+"Pad").hide();
		});
		history.pushState(null, "New Title", "#" + hash);	
		$("#"+type+"Pad").show();
		$("#pad-element-container").empty().html(mapUrl[type]["html"]);
		bindLBHLinks();
		$.unblockUI();
	}
	else{
		$("#pad-element-container").hide(200);
		ajaxPost('#pad-element-container',baseUrl+'/'+moduleId+'/'+url+"renderPartial=true", 
			data,
			function(){ 
				history.pushState(null, "New Title", "#" + hash);
				$("#pad-element-container").show(200);
				mapUrl[type]["load"] = true;
				mapUrl[type]["html"] = $("#pad-element-container").html();
				bindLBHLinks();
				$.unblockUI();
		},"html");
	}
}

</script>
<?php
if(!@$_GET["renderPartial"]){ 
?>
<div class="col-md-12 padding-15" id="pad-element-container">
<?php } ?>
