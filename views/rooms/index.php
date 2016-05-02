<?php 
$cssAnsScriptFilesTheme = array(
	'/plugins/DataTables/media/css/DT_bootstrap.css',
	'/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js',
	'/plugins/DataTables/media/js/DT_bootstrap.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->theme->baseUrl."/assets");

Menu::rooms($_GET["id"],$_GET["type"]);
$this->renderPartial('../default/panels/toolbar');

$moduleId = Yii::app()->controller->module->id;
 ?>

<style>
.assemblyHeadSection {  
  background-image:url(<?php echo $this->module->assetsUrl; ?>/images/city/assemblyHead.png); 
  /*background-image: url(/ph/assets/449afa38/images/city/cityDefaultHead_BW.jpg);*/
  background-color: #fff;
  background-repeat: no-repeat;
  background-position: 0px -50px;
  background-size: 100% auto;
}

  h1.citizenAssembly-header{
    background-color: rgba(255, 255, 255, 0.63);
    padding: 30px;
    padding-top:0px;
    margin-bottom: -3px;
    font-size: 32px;
    margin-top:90px;
  }
#main-panel-room{
	/*margin-top:100px;*/
}

a.text-white {
    color: #FFF;
}

.tr-room{
	margin:5px 0px;
}


#thumb-profil-parent{
	margin-top:-60px;
	margin-bottom:20px;
	-moz-box-shadow: 0px 3px 10px 1px #656565;
	-webkit-box-shadow: 0px 3px 10px 1px #656565;
	-o-box-shadow: 0px 3px 10px 1px #656565;
	box-shadow: 0px 3px 10px 1px #656565;
}

blockquote {border: 1px solid gray; cursor: pointer;}
blockquote:hover {border: 1px solid #E33551; }
blockquote.active {border: 1px solid #E33551; cursor: pointer;}
</style>


<h1 class="homestead text-dark center citizenAssembly-header" >
    <?php 
		$urlPhotoProfil = "";
		if(isset($parent['profilImageUrl']) && $parent['profilImageUrl'] != "")
	      $urlPhotoProfil = Yii::app()->createUrl($parent['profilImageUrl']);
	    else
	      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	
		$icon = "comments";	
	  	if($parentType == Project::COLLECTION) $icon = "lightbulb-o";
	  	if($parentType == Organization::COLLECTION) $icon = "group";
	  	if($parentType == Person::CONTROLLER) $icon = "user";
	?>
	<img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
    <br>
	<span style="padding:10px; border-radius:50px;">
		<i class="fa fa-<?php echo $icon; ?>"></i> 
		<?php echo $parent['name']; ?>
	</span>

</h1>

<div class="panel panel-white" id="main-panel-room">
	<div class="panel-heading">
		
		<div class="col-xs-6 light">
			<div class="panel-heading border-light bg-red">
		    	<h4 class="panel-title text-white"><i class="fa fa-archive"></i><span class="homestead"> <?php echo Yii::t('rooms', 'Rooms', null, $moduleId)?> </span> <span class="badge badge-white pull-right"> <?php echo count(@$rooms) ?></span></h4>
		    </div>
		  <blockquote class="roomsTableBtn infoTablesBtn active" onclick="toggle('.roomsTable','.infoTables',true)"> 
		    <?php echo Yii::t('rooms', 'Rooms are Thematic Think Tanks', null, $moduleId)?>
		    <br><?php echo Yii::t('rooms', "Make Proposals", null, $moduleId)?>
		    <br><?php echo Yii::t('rooms', 'Put ideas together', null, $moduleId)?>
		    <br><?php echo Yii::t('rooms', 'Think Thematicaly', null, $moduleId)?>

		  </blockquote>
		</div>

		<div class="col-xs-6">
			<div class="panel-heading border-light bg-orange">
		    	<h4 class=" text-white panel-title"><i class="fa fa-thumbs-up"></i><span class="homestead"> <?php echo Yii::t('rooms', 'Actions', null, $moduleId)?> </span> <span class="badge badge-white pull-right"> <?php echo count(@$actions) ?></span></h4>
		    </div>
		  <blockquote class="actionsTableBtn infoTablesBtn " onclick="toggle('.actionsTable','.infoTables',true)"> 
		    <?php echo Yii::t('rooms', 'Actions are your particiaptions', null, $moduleId)?>
		    <br><?php echo Yii::t('rooms', 'Be part of the change', null, $moduleId)?>
		    <br><?php echo Yii::t('rooms', 'Your Voice Count', null, $moduleId)?>
		    <br><?php echo Yii::t('rooms', 'Decide Collectivelly', null, $moduleId)?>
		  </blockquote>
		</div>

	</div>

	<div class="panel-body">
		<div class="roomsTable infoTables">	
			<h1 class="homestead text-red"><i class="fa fa-chevron-circle-down"></i>  <?php echo Yii::t("rooms", "All your Rooms", null, $moduleId); ?></h1>
			<table class="table table-striped table-bordered table-hover  directoryTable ">
				<thead>
					<tr>
						<th><i class="fa fa-archive"></i> <?php echo Yii::t("rooms", "Name", null, $moduleId); ?></th>
						<th><?php echo Yii::t("rooms", "Type", null, $moduleId); ?></th>
						<th><i class="fa fa-file-text"></i> <?php echo Yii::t("rooms", "Entries", null, $moduleId); ?></th>
						<th><?php echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
						<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Start Date", null, $moduleId); ?></th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;
					
					/* **************************************
					*	rooms
					***************************************** */
					if(isset($rooms)) 
					{ 
						foreach ($rooms as $e) 
						{ ?>
						<tr class="tr-room" id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
							<?php 
								$type = "rooms";
								error_log($e["type"]);
								if( $e["type"] == ActionRoom::TYPE_SURVEY ){
									$type = "survey.entries";
									$icon = "check-square";
								}else if( $e["type"] == ActionRoom::TYPE_DISCUSS ){
									$type = "comment.index.type.actionRooms";
									$icon = "comments";
								} else if ( $e["type"] == ActionRoom::TYPE_BRAINSTORM ){
									$type = "survey.entries";
									$icon = "lightbulb-o";
								} else if ( $e["type"] == ActionRoom::TYPE_VOTE ){
									$type = "survey.entries";
									$icon = "lightbulb-o";
								}
								
								//$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"])
								$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
								$link = 'href="javascript:;" onclick="'.$link.'"';
								?>
							<td><i class="fa fa-archive"></i> <a <?php echo $link;?> ><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<td class="center organizationLine ">
								<i class="fa fa-<?php echo @$icon ?> fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?> 
							</td>
							<td><i class="fa fa-file-text"></i> <?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
							<td><i class="fa fa-users"></i> <?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
							<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
						</tr>
					<?php
						};
					}
					?>
					
				</tbody>
			</table>
		</div>
		<div class="actionsTable infoTables hide">	
			<h1 class="homestead text-orange" style="text-align: right;"><?php echo Yii::t("rooms", "All your Actions", null, $moduleId); ?> <i class="fa  fa-chevron-circle-down"></i></h1>
			<table class="table table-striped table-bordered table-hover directoryTable  ">
				<thead>
					<tr>
						<th class="hidden"><?php echo Yii::t("rooms", "Titre", null, $moduleId); ?></th>
						<th><i class="fa fa-archive"></i> <?php echo Yii::t("rooms", "Actions", null, $moduleId); ?></th>
						<th><?php echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
						<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Start Date", null, $moduleId); ?></th>
						<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "End Date", null, $moduleId); ?></th>
						<th><?php echo Yii::t("rooms", "Action", null, $moduleId); ?></th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<?php
					/* **************************************
					*	rooms
					***************************************** */
					if(isset($actions)) 
					{ 
						foreach ($actions as $e) 
						{ ?>
						<tr id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
							<td class="center organizationLine hidden">
								<?php 
								$type = "survey.entry";
								$icon = "bookmark";
								//$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"]);
								$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
								$link = 'href="javascript:;" onclick="'.$link.'"';
								?>
								<a <?php echo $link;?>>
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-<?php echo $icon ?> fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?> 
									<?php } ?>
								</a>
							</td>
							<td ><a <?php echo $link;?>><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<?php 
							$participantCount = 0;
							if(isset( $e[Action::ACTION_VOTE_UP] ))
								$participantCount += count($e[Action::ACTION_VOTE_UP]);
							if(isset( $e[Action::ACTION_VOTE_DOWN] ))
								$participantCount += count($e[Action::ACTION_VOTE_DOWN]);
							if(isset( $e[Action::ACTION_VOTE_ABSTAIN] ))
								$participantCount += count($e[Action::ACTION_VOTE_ABSTAIN]);
							if(isset( $e[Action::ACTION_VOTE_UNCLEAR] ))
								$participantCount += count($e[Action::ACTION_VOTE_UNCLEAR]);
							if(isset( $e[Action::ACTION_VOTE_MOREINFO] ))
								$participantCount += count($e[Action::ACTION_VOTE_MOREINFO]);
							?>
							<td><?php echo $participantCount ?></td>
							<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
							<td><?php if(isset($e["dateEnd"]))echo date("d/m/y",$e["dateEnd"]) ?></td>
							<td class="center">
								<?php 
								if(isset($e["action"]))
								{
									$type = "";
									$choice = "";
									foreach ( $e["action"] as $key => $value) 
									{
										$type = $key;
										$choice = $value;
									}
								}

								if( $choice == Action::ACTION_COMMENT )
									$icon = "comment";
								else if( $choice == Action::ACTION_VOTE_UP )
									$icon = "thumbs-up";
								else if( $choice == Action::ACTION_VOTE_DOWN )
									$icon = "thumbs-down";
								 ?>
								<?php echo $type ?> <i class="fa fa-<?php echo $icon ?> fa-2x"></i> 

							</td>
						</tr>
					<?php
						};
					}

					?>

				</tbody>
			</table>
		
		</div>
			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
			<?php 
				if (isset($rooms) && count($rooms) == 0) {
			?>
				<div id="infoPodOrga" class="padding-10">
					<blockquote> 
						<?php echo Yii::t('rooms', 'Create Room', null, $moduleId)?>
						<br><?php echo Yii::t('rooms', 'Discussions', null, $moduleId)?> 
						<br><?php echo Yii::t('rooms', 'Decisions', null, $moduleId)?>
						<br><?php echo Yii::t('rooms', 'Brainstorms', null, $moduleId)?>
						<br><?php echo Yii::t('rooms', 'to think, develop, build and decide collaboratively', null, $moduleId)?>
					</blockquote>
				</div>
			<?php 
				};
			?>
	</div>
</div>


<script type="text/javascript">
var nameParentTitle = "<?php echo $nameParentTitle; ?>";
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-comments'></i> " + "espaces collaboratifs");
	$(".main-col-search").addClass("assemblyHeadSection");
	resetDirectoryTable() ;
	$(".DataTables_Table_1_wrapper").addClass("hide");
});	

function resetDirectoryTable() 
{ 
	console.log("resetDirectoryTable");

	if( !$('.directoryTable').hasClass("dataTable") )
	{
		directoryTable = $('.directoryTable').dataTable({
			"aoColumnDefs" : [{
				"aTargets" : [0]
			}],
			"oLanguage" : {
				"sLengthMenu" : "Montrer _MENU_ lignes",
				"sSearch" : "",
				"oPaginate" : {
					"sPrevious" : "",
					"sNext" : ""
				}
			},
			"aaSorting" : [[1, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] ],
			"iDisplayLength" : 10,
			"destroy": true
		});
	} 
	else 
	{
		if( $(".directoryLines").children('tr').length > 0 )
		{
			directoryTable.dataTable().fnDestroy();
			directoryTable.dataTable().fnDraw();
		} else {
			console.log(" directoryTable fnClearTable");
			directoryTable.dataTable().fnClearTable();
		}
	}
}

function applyStateFilter(str)
{
	console.log("applyStateFilter",str);
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
}
function clearAllFilters(str){ 
	$( "input[type='search']" ).val("");
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
}
</script>