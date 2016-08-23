<?php 
$cssAnsScriptFilesTheme = array(
	//X-editable
	'/assets/plugins/x-editable/css/bootstrap-editable.css',
	'/assets/plugins/x-editable/js/bootstrap-editable.js' , 
	//DatePicker
	'/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' ,
	'/assets/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.fr.js' ,
	'/assets/plugins/bootstrap-datepicker/css/datepicker.css',
	
	//DateTime Picker
	'/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/assets/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.fr.js' , 
	'/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	//Wysihtml5
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/assets/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/assets/plugins/wysihtml5/wysihtml5.js',
	
	'/assets/plugins/moment/min/moment.min.js',
	'/assets/plugins/Chart.js/Chart.min.js'
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
		<?php if(!empty($viewer)){ ?>
			background-image: url("<?php echo $this->module->assetsUrl; ?>/images/people.jpg");
			min-height:70px;
			background-position: center bottom 0px;
			
		<?php }else { ?>
			background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/dda-connexion-lines.jpg");
			background-repeat: repeat;
			background-size: 100%;
		<?php } ?>
		/*background-position: left bottom -40px;*/
		moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 0px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
		border-radius: 0px;
		margin-top:-10px;
		margin-bottom:10px;
		padding-bottom: 60px
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
</style>

<div class="row headerEntity bg-light">
	<?php if($type != "pixels" || !empty($viewer)){ ?>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4 padding-10 center">
			<?php   
				if(@$entity["profilMediumImageUrl"] && !empty($entity["profilMediumImageUrl"]))
					$images=array("profil"=> array($entity["profilMediumImageUrl"]));
				else 
					$images="";	
				$this->renderPartial('../pod/fileupload', array("itemId" => $entity["_id"],
																  "type" => $type,
																  "contentId" => Document::IMG_PROFIL,
																  "editMode" => false,
																  "image" => $images)); 
			
			//	$profilThumbImageUrl = Element::getImgProfil(@$entity, "profilMediumImageUrl", $this->module->assetsUrl);
			?>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">

			<div class="col-lg-12 col-md-12 col-sm-12 no-padding">
				<div class="col-md-12 no-padding margin-top-15">
					<?php if($type == Organization::COLLECTION || $type == Event::COLLECTION){ ?>
						<h2 class="text-left no-margin <?php if (!@$entity["type"] && !empty($entity["type"])) echo "hide" ?>" style="font-weight:100; font-size:19px;">
								<i class="fa fa-angle-right"></i> 
								<a href="#" id="type" data-type="select" data-title="Type" data-emptytext="Type" class="editable editable-click required">
								</a>
						</h2>
					<?php } ?>
					<span class="lbl-entity-name">
						<i class="fa fa-<?php echo Element::getFaIcon($type); ?>">
						</i> <a href="#" id="name" data-type="text" data-title="<?php echo Yii::t("common","Name") ?>" data-emptytext="<?php echo Yii::t("common","Name") ?>" 
								class="editable-context editable editable-click required">
						<?php echo @$entity["name"]; ?>
						</a>
					</span>
					<?php if($type==Event::COLLECTION && isset($element["parentId"])) {
						$parentEvent = Event::getSimpleEventById($event["parentId"]);
						echo Yii::t("event","Part of Event",null,Yii::app()->controller->module->id).' : <a href="#element.detail.type.'.Event::COLLECTION.'.id.'.$event["parentId"].'" class="lbh">'.$parentEvent["name"]."</a>";
					}
					?>
				</div>
				<div class="col-md-12 no-padding no-padding margin-bottom-10">
					<span class="lbl-entity-locality text-red">
						<i class="fa fa-globe"></i> 
						<?php echo @$entity["address"]["addressLocality"].", ".
									@$entity["address"]["postalCode"].", ".
									@$entity["address"]["addressCountry"]; ?>
					</span>
				</div>
			</div>
			<?php if($type == Project::COLLECTION){ ?>
			<div class="col-md-12 text-dark no-padding" style="margin-top:10px;">
					<a  href="#" id="avancement" data-type="select" data-title="avancement" 
						data-original-title="<?php echo Yii::t("project","Enter the project's maturity",null,Yii::app()->controller->module->id) ?>" data-emptytext="<?php echo Yii::t("common","Project maturity") ?>"
						class="entityDetails editable editable-click">
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
							echo Yii::t("project",$entity["properties"]["avancement"],null,Yii::app()->controller->module->id);
						} ?>
					</a>
					<?php if(isset($entity["properties"]["avancement"])){ ?>
					<progress max="100" value="<?php echo $val;?>" class="progressStyle">
					</progress>
					<?php } else { ?>
					<progress max="100" value="0" class="progressStyle hide">
					</progress>

					<?php } ?>
			</div>
			<?php } ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding hidden-xs">
				<a href="javascript:;" id="shortDescription" data-placement="bottom" data-type="wysihtml5" data-showbuttons="true" data-title="<?php echo Yii::t("common","Short Description") ?>" 
						data-emptytext="<?php echo Yii::t("common","Short Description") ?>" class="editable editable-click">
						<?php echo (isset($entity["shortDescription"])) ? $entity["shortDescription"] : null; ?>
					</a>

			</div>


		</div>
		  


		<?php 
		//var_dump($admin);
		//if(!empty($admin) && $admin == true){ ?>
		<div id="divBtnDetail" class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
			<a href="javascript:" id="editElementDetail" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Compléter ou corriger les informations de ce projet" alt=""><i class="fa fa-pencil"></i><span class="hidden-xs"> <?php echo Yii::t("common","Edit") ?></span></a>
			<a href="javascript:" id="editConfidentialityBtn" class="btn btn-sm btn-default tooltips" data-toggle="tooltip" data-placement="bottom" title="Compléter ou corriger les informations de ce projet" alt=""><i class='fa fa-cog'></i><span class="hidden-xs"> <?php echo Yii::t("common","Paramètres de confidentialité"); ?></span></a>
			<?php if($type == Person::COLLECTION){ ?>
			<a href='javascript:' id="changePasswordBtn" class='btn btn-sm btn-red tooltips' data-toggle="tooltip" data-placement="bottom" title="Changer votre mot de passe" alt="">
				<i class='fa fa-key'></i> 
				<span class="hidden-sm hidden-xs">
				<?php echo Yii::t("common","Change password") ?>
				</span>
			</a>
			<a href='javascript:' id="downloadProfil" class='btn btn-sm btn-default  tooltips' data-toggle="tooltip" data-placement="bottom" title="Télécharger votre profil" alt="">
				<i class='fa fa-download'></i> 
				<span class="hidden-sm hidden-xs">
				<?php //echo Yii::t("common","Télécharger votre profile"); ?>
				</span>
			</a>
			<?php } ?>
		</div>
		<?php //} ?>
		<?php 
			$colXS = "3";
			if(!isset($entity["tags"]) && !isset($entity["gamification"])) $colXS = "3 hidden";
		?>
		<div class="col-lg-3 col-md-3 col-sm-<?php echo $colXS; ?> col-xs-12 pull-right padding-10">
			<?php if(isset($entity["tags"]) || isset($entity["gamification"])){ ?>
			<div class="col-lg-12 col-md-12 col-sm-12 no-padding">
				<?php if ($type==Person::COLLECTION){ ?>
				<span class="tag label label-warning pull-right">
					<?php echo  @$entity["gamification"]['total'] ? 
								@$entity["gamification"]['total'] :
								"0"; 
					?> pts
				</span>
				<?php } ?>
				<?php if(isset($entity["tags"])){ ?>
					<?php $i=0; foreach($entity["tags"] as $tag){ if($i<6) { $i++;?>
					<div class="tag label label-danger pull-right" data-val="<?php echo  $tag; ?>">
						<i class="fa fa-tag"></i> <?php echo  $tag; ?>
					</div>
					<?php }} ?>
				<?php } ?>
			</div>
			<?php } ?>
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
	        		<strong><i class="fa fa-group"></i> Public</strong> : visible pour tout le monde<br/>
	        		<strong><i class="fa fa-user-secret"></i> Privé</strong> : visible pour mes contacts seulement<br/>
	        		<strong><i class="fa fa-ban"></i> Masqué</strong> : visible pour personne<br/>
	        		<?php } ?>

	        		<strong><i class="fa fa-group"></i> Open Data</strong> : Vous proposez vos données en accès libre, afin de contribuer au bien commun.<br/>
	        		<?php if ($type!=Person::COLLECTION){ ?>
	        		<strong><i class="fa fa-group"></i> Open Edition</strong> : Tous les utilisateurs ont la possibilité de participer / modifier les informations.<br/>
	        		<?php } ?>
	        	</div>
		    </div>
		    <div class="row text-dark panel-btn-confidentiality">
		    	<?php if ($type==Person::COLLECTION){ ?>
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
		        <?php } ?>
		        <div class="col-sm-4 text-right padding-10 margin-top-10">
		        	<i class="fa fa-message"></i> <strong>Open Data :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-isOpenData inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="true"><i class="fa fa-group"></i> Oui</button>
		        		<button class="btn btn-default confidentialitySettings" type="isOpenData" value="false"><i class="fa fa-user-secret"></i> Non</button>
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
		        	<i class="fa fa-message"></i> <strong>Open Edition :</strong>
		        </div>
		        <div class="col-sm-8 text-left padding-10">
		        	<div class="btn-group btn-group-isOpenEdition inline-block">
		        		<button class="btn btn-default confidentialitySettings" type="isOpenEdition" value="true"><i class="fa fa-group"></i> Oui</button>
		        		<button class="btn btn-default confidentialitySettings" type="isOpenEdition" value="false"><i class="fa fa-user-secret"></i> Non</button>
					</div>
		        </div>
		        <?php } ?>
	        </div>
	      </div>
	      <script type="text/javascript">
			<?php
				//Params Checked
				$typePreferences = array("privateFields", "publicFields");
				$fieldPreferences["email"] = true;
				$fieldPreferences["locality"] = true;
				$fieldPreferences["phone"] = true;
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
	        <button type="button" class="lbh btn btn-success btn-confidentialitySettings" data-dismiss="modal" aria-label="Close" data-hash="#element.detail.id.<?php echo $entity['_id'] ;?>">OK</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</div>
<?php 
$urlServer =$_SERVER['REQUEST_URI'];
Menu::element($entity,$type);
$this->renderPartial('../default/panels/toolbar');
if(!@$_GET["renderPartial"]){ 
?>
<div class="col-md-12 padding-15" id="pad-element-container">

<script type="text/javascript">
var elementLinks = <?php echo isset($entity["links"]) ? json_encode($entity["links"]) : "''"; ?>;
var contextType = <?php echo json_encode($type)?>;
var contextMap = [];
var element = <?php echo isset($entity) ? json_encode($entity) : "''"; ?>;
var urlServer = "<?php echo $urlServer ; ?>";
var mode = "view";
var isDetail = -1 ;

 if(document.URL.indexOf("element.detail") != -1)
		isDetail = 	document.URL.indexOf("element.detail") ;
/*if(urlServer.indexOf("element/detail") == -1)
	$("#divBtnDetail").hide();
else
	$("#divBtnDetail").show();*/

jQuery(document).ready(function() {
	setTimeout(function () {
		// Cette fonction s'exécutera dans 5 seconde (1000 millisecondes)
		$.ajax({
			url: baseUrl+"/"+moduleId+"/element/getalllinks/type/<?php echo $type ;?>/id/<?php echo (string)$entity["_id"] ?>",
			type: 'POST',
			data:{ "links" : elementLinks },
			async:false,
			dataType: "json",
			complete: function () {},
			success: function (obj){
				console.log("conntext/////");
				console.log(obj);
				Sig.restartMap();
				Sig.showMapElements(Sig.map, obj);	
				contextMap = obj;	
				$(".communityBtn").removeClass("hide");
			},
			error: function (error) {
				console.log("error findGeoposByInsee");
				callbackFindByInseeError(error);	
				$("#iconeChargement").hide();	
			}
		});	
	}, 1000);

	bindHeaderElement();
	activateEditableContextHeader();
	manageModeContextHeader();
	

});

function switchMode() {
	console.log("switchMode");
	if(mode == "view"){
		mode = "update";
		manageModeContextHeader();
		manageModeContext();
	}else{
		mode ="view";
		manageModeContextHeader();
		manageModeContext();
	}
}

function bindHeaderElement() {
	$("#editElementDetail").on("click", function(){
		console.log("editElementDetail", document.URL);
		if(isDetail == -1){
			showElementPad("detail.edit");
		}else{
			switchMode();
		}

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

}

function showElementPad(type){
	var mapUrl = { 	"detail": 
						{ 
							"url"  : "element/detail/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
							"hash" : "element.detail.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
							"data" : null
						} ,
					"detail.edit": 
						{ 
							"url"  : "element/detail/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
							"hash" : "element.detail.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
							"data" : {"edit":true}
						} ,
					"news": 
						{ 
							"url"  : "news/index/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?isFirst=1&", 
							"hash" : "news.index.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
							"data" : null
						} ,
					"directory": 
						{ "url"  : "element/directory/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?tpl=directory2&", 
						  "hash" : "element.directory.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
						  "data" : {"links":contextMap, "element":element}
						} ,
					"gallery" :
						{ 
							"url"  : "gallery/index/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
							"hash" : "gallery.index.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
							"data" : null
						}
					}

	var url  = mapUrl[type]["url"];
	var hash = mapUrl[type]["hash"];
	var data = mapUrl[type]["data"];
	//console.log(data);
	$("#pad-element-container").hide(200);
	$.blockUI({
		message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Chargement en cours ...</span></h4>"
	});

	/*if(type == "detail")
		$("#divBtnDetail").show();
	else
		$("#divBtnDetail").hide();*/

	ajaxPost('#pad-element-container',baseUrl+'/'+moduleId+'/'+url+"renderPartial=true", 
			data,
			function(){ 
				history.pushState(null, "New Title", "#" + hash);
				$("#pad-element-container").show(200);
				bindLBHLinks();
				$.unblockUI();
			},"html");
}


function manageModeContextHeader() {
	console.log("manageModeContextHeader", mode);
	if (mode == "view") {
		$('#name').editable('toggleDisabled');
		$('#shortDescription').editable('toggleDisabled');		
	
	} else if (mode == "update") {
		// Add a pk to make the update process available on X-Editable
		$('#name').editable('option', 'pk', contextId);
		$('#shortDescription').editable('option', 'pk', contextId);
		
	}
	//alert($('#url').html() );
	if($('#name').html() != "")				{ $(".fa_name").removeClass("hidden"); } else { $(".fa_name").addClass("hidden"); }
	
	
}

function activateEditableContextHeader(){
	$.fn.editable.defaults.mode = 'popup';
	$('.editable-context').editable({
		url: baseUrl+"/"+moduleId+"/element/updatefields/type/"+contextType,
		title : $(this).data("title"),
		onblur: 'submit',
		success: function(response, newValue) {
			console.log("yo");
    		if(! response.result) return response.msg; //msg will be shown in editable form
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
				}
				else 
					return data.msg;
			}
		});
}
</script>
<?php } ?>
