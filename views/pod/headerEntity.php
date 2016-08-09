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
		<?php if($type != Person::COLLECTION || !empty($viewer)){ ?>
			background-image: url("<?php echo $this->module->assetsUrl; ?>/images/bg/dda-connexion-lines.jpg");
			background-repeat: repeat;
			background-size: 100%;
		<?php }else{ ?>
			background-image: url("<?php echo $this->module->assetsUrl; ?>/images/people.jpg");
			min-height:70px;
			background-position: center bottom 0px;
		<?php } ?>
		/*background-position: left bottom -40px;*/
		moz-box-shadow: 0px 2px 4px -1px #656565;
		-webkit-box-shadow: 0px 2px 4px -1px #656565;
		-o-box-shadow: 0px 2px 4px -1px #656565;
		box-shadow: 0px 0px 4px -1px #656565;
		filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=180, Strength=4);
		border-radius: 0px;
		margin-top:-10px;
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

</style>

<div class="row headerEntity bg-light">

	<?php if($type != Person::COLLECTION || !empty($viewer)){ ?>
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
					<h2 class="text-left no-margin <?php if (!@$entity["type"] && !empty($entity["type"])) echo "hide" ?>" style="font-weight:100; font-size:19px;">
							<i class="fa fa-angle-right"></i> 
							<a href="#" id="type" data-type="select" data-title="Type" data-emptytext="Type" class="editable editable-click required">
							</a>
					</h2>
					<span class="lbl-entity-name">
						<i class="fa fa-<?php echo Element::getFaIcon($type); ?>">
						<a href="#" id="name" data-type="text" data-title="<?php echo Yii::t("common","Name") ?>" data-emptytext="<?php echo Yii::t("common","Name") ?>" 
								class="editable-context editable editable-click required">
</i> <?php echo @$entity["name"]; ?>
						</a>
					</span>
					<?php if($type==Event::COLLECTION && isset($element["parentId"])) {
						$parentEvent = Event::getSimpleEventById($event["parentId"]);
						echo Yii::t("event","Part of Event",null,Yii::app()->controller->module->id).' : <a href="javascript:;" onclick="loadByHash(\'#element.detail.type.'.Event::COLLECTION.'.id.'.$event["parentId"].'\')" >'.$parentEvent["name"]."</a>";
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
			<?php if($type==Project::COLLECTION){ ?>
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
			<?php } ?>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding hidden-xs">
				<?php echo substr(@$entity["shortDescription"], 0, 140);
						if(strlen(@$entity["shortDescription"])>140) echo "...";
				 ?>
			</div>


		</div>
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
</div>
<?php 
Menu::element($entity,$type);
$this->renderPartial('../default/panels/toolbar');
if(!@$_GET["renderPartial"]){ 
?>
<div class="col-md-12 padding-15" id="pad-element-container">

<script type="text/javascript">
var elementLinks = <?php echo isset($entity["links"]) ? json_encode($entity["links"]) : "''"; ?>;
var contextMap = [];
var element = <?php echo isset($entity) ? json_encode($entity) : "''"; ?>;
console.log(elementLinks);
jQuery(document).ready(function() {
	setTimeout(function () {
		// Cette fonction s'exécutera dans 5 seconde (1000 millisecondes)
		$.ajax({
			url: baseUrl+"/"+moduleId+"/element/getalllinks/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>",
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
});

function showElementPad(type){
	var mapUrl = { 	"detail": 
						{ 
							"url"  : "element/detail/type/<?php echo $type ?>/id/<?php echo (string)$entity["_id"] ?>?", 
							"hash" : "element.detail.type.<?php echo $type ?>.id.<?php echo (string)$entity["_id"] ?>",
							"data" : null
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
	console.log(data);
	$("#pad-element-container").hide(200);
	$.blockUI({
				message : "<h4 style='font-weight:300' class='text-dark padding-10'><i class='fa fa-spin fa-circle-o-notch'></i><br>Chargement en cours ...</span></h4>"
			});
	
	ajaxPost('#pad-element-container',baseUrl+'/'+moduleId+'/'+url+"renderPartial=true", 
			data,
			function(){ 
				history.pushState(null, "New Title", "#" + hash);
				$("#pad-element-container").show(200);
				$.unblockUI();
			},"html");
}
</script>
<?php } ?>
