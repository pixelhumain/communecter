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
    padding-bottom: 70px;
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

.panel-heading .panel-heading-tabs {
    list-style: none;
    top: 0;
    right: 0;
    position: absolute;
    margin: 0;
    padding: 0;
}
.rate .value {
    font-size: 30px !important;
    font-weight: 600;
}
.panel-heading .panel-heading-tabs > li {
    float: left;
    padding: 0 15px;
    border-left-width: 1px;
    border-left-style: solid;
    border-left-color: inherit;
    height: 50px;
    line-height: 50px;
}
.panel-title{
	font-size:18px !important;
	font-weight: 600;
}

.directoryLines a.entryname {
    font-size: 1.4em;
    font-weight: 200;
    margin-left: 4px;
}

.directoryLines a.entryname_vote {
    font-size: 1.2em;
    font-weight: 300;
    margin-left: 4px;
}

.nav-menu-rooms{
	margin-top: -50px;
	background-color: rgba(0, 0, 0, 0.55);
}
.nav-menu-rooms li{
	color:white;
}
.nav-menu-rooms > li > a {
    border: 0 none;
	border-radius: 0;
	color: #FFF;
	min-width: 70px;
	padding: 11px 20px;
	margin-top: -3px;
	font-size: 20px;
}

.nav-menu-rooms > li > a:hover {
	color:rgb(0, 123, 128);
}

.tab-pane{
	background-color: white;
}

blockquote {border: 1px solid gray; cursor: pointer;}
blockquote:hover {border: 1px solid #E33551; }
blockquote.active {border: 1px solid #E33551; cursor: pointer;}
</style>


<h1 class="homestead text-dark center citizenAssembly-header" style="font-size:27px;">
    <?php 
		$urlPhotoProfil = "";
		if(isset($parent['profilImageUrl']) && $parent['profilImageUrl'] != "")
	      $urlPhotoProfil = Yii::app()->createUrl($parent['profilImageUrl']);
	    else
	      $urlPhotoProfil = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	
		$icon = "comments";	
		if($parentType == Project::COLLECTION) $icon = "lightbulb-o";
	  	if($parentType == Organization::COLLECTION) $icon = "group";
	  	if($parentType == Person::COLLECTION) $icon = "user";
	?>
	<img class="img-circle" id="thumb-profil-parent" width="120" height="120" src="<?php echo $urlPhotoProfil; ?>" alt="image" >
    <br>
	<span style="padding:10px;">
		<a href="javascript:loadByHash('#<?php echo Element::getControlerByCollection($_GET["type"]); ?>.detail.id.<?php echo $_GET["id"]; ?>');" class="text-dark"><i class="fa fa-<?php echo $icon; ?>"></i> <?php echo $parent['name']; ?></a>
	</span><br>
	<span style="padding:10px; font-size:0.8em; color:rgb(57, 57, 57)">
		Espaces coopératifs
	</span>

</h1>
	    
<div class="" id="main-panel-room">
	
		    <!-- Nav tabs -->
			<ul class="nav nav-tabs nav-justified homestead nav-menu-rooms" role="tablist">
			  <li class="active"><a href="#discuter" role="tab" data-toggle="tab"><i class="fa fa-comments"></i> Discuter</a></li>
			  <li><a href="#decider" role="tab" data-toggle="tab"><i class="fa fa-archive"></i> Décider</a></li>
			<li><a href="#historique" role="tab" data-toggle="tab"><i class="fa fa-clock-o"></i> Historique</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			  <div class="tab-pane active col-lg-12 col-md-12" id="discuter">
			  	<div class="alert alert-info">
			  	<ul>
			  		<li>Les <strong>espaces de discussion</strong> servent à discuter de différents sujets, créer des débats, approfondir des questions.</li>
			  		<li>Ces discussions peuvent déboucher sur des <strong>propositions</strong>, que vous pouvez reporter dans la section <strong>DÉCIDER</strong>, afin de procéder à une séance de vote.</li>
			  	</ul> 		
			  	</div>
				<table class="table table-striped table-bordered table-hover directoryTable ">
					<thead class="">
						<tr>
							<th><i class="fa fa-caret-down"></i> <?php echo Yii::t("rooms", "Espaces de discussions", null, $moduleId); ?></th>
							<th class="hidden"><?php echo Yii::t("rooms", "Type", null, $moduleId); ?></th>
							<th class="hidden"><i class="fa fa-file-text"></i> <?php echo Yii::t("rooms", "Entries", null, $moduleId); ?></th>
							<th class="hidden"><i class="fa fa-group"></i> <?php echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
							<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Created", null, $moduleId); ?></th>
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
							{ if( $e["type"] == ActionRoom::TYPE_DISCUSS ){ ?>
							<tr class="tr-room" id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
								<?php 
									$type = "comment.index.type.actionRooms";
									$icon = "comments";
									//$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"])
									$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
									$link = 'href="javascript:;" onclick="'.$link.'"';
									?>
								<td class="center organizationLine hidden">
									<i class="fa fa-<?php echo @$icon ?> fa-2x"></i> <?php //if(isset($e["type"]))echo $e["type"]?> 
								</td>
								<td><i class="fa fa-<?php echo @$icon ?> fa-2x text-dark" style="width:25px;text-align:center;"></i> <a class="entryname" <?php echo $link;?> ><?php if(isset($e["name"]))echo $e["name"]?></a></td>
								<td class="hidden"><i class="fa fa-file-text"></i> <?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								<td class="hidden"><i class="fa fa-users"></i> //<?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
							</tr>
						<?php
							};
						}}
						?>
						
					</tbody>
				</table>
			  </div>
			  <div class="tab-pane" id="decider">
			  	<div class="alert alert-info">
			  	<ul>
			  		<li>Les <strong>espaces de décisions</strong> servent à voter des <strong>propositions</strong>.</li>
			  		<li>Seuls les membres d'une organisation ou d'un projet peuvent faire des <strong>propositions</strong> et participer aux <strong>votes</strong></li>
			  	</ul> 		
			  	</div>
			  	<table class="table table-striped table-bordered table-hover  directoryTable ">
					<thead class="">
						<tr>
							<th><i class="fa fa-caret-down"></i> <?php echo Yii::t("rooms", "Espaces de décisions", null, $moduleId); ?></th>
							<th class="hidden"><?php echo Yii::t("rooms", "Type", null, $moduleId); ?></th>
							<th class=""><i class="fa fa-file-text"></i> <?php echo Yii::t("rooms", "Entries", null, $moduleId); ?></th>
							<th class="hidden"><i class="fa fa-group"></i> <?php //echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
							<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Created", null, $moduleId); ?></th>
						</tr>
					</thead>
					<tbody class="directoryLines">
						<?php 
						/* **************************************
						*	rooms
						***************************************** */
						if(isset($rooms)) 
						{ 
							foreach ($rooms as $e) 
							{ if ( $e["type"] == ActionRoom::TYPE_VOTE ){ ?>
							<tr class="tr-room" id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
								<?php 
									$type = "survey.entries";
									$icon = "archive";
									
									
									//$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"])
									$link = "loadByHash('#".$type.".id.".$e["_id"]."')";
									$link = 'href="javascript:;" onclick="'.$link.'"';
									?>
								<td class="center organizationLine hidden">
									<i class="fa fa-<?php echo @$icon ?> fa-2x"></i> <?php //if(isset($e["type"]))echo $e["type"]?> 
								</td>
								<td><i class="fa fa-<?php echo @$icon ?> fa-2x text-dark" style="width:25px;text-align:center;"></i> <a class="entryname" <?php echo $link;?> ><?php if(isset($e["name"]))echo $e["name"]?></a></td>
								<td class=""><i class="fa fa-file-text"></i> <?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								<td class="hidden"><i class="fa fa-users"></i> //<?php //echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?> <?php //echo Yii::t("rooms", "propositions", null, $moduleId); ?></td>
								<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
							</tr>
						<?php
							};
						}}
						?>
						
					</tbody>
				</table>	
			  </div>
			  <div class="tab-pane col-lg-12 col-md-12" id="historique">
			  	<div class="actionsTable infoTables" style="padding-top:7px;">	
					<div class="alert alert-info">
				  	<ul>
				  		<li>La section <strong>HISTORIQUE</strong> vous permet de retrouver facilement les <strong>votes</strong> auxquels vous avez participé.</li>
				  	</ul> 		
				  	</div>
				
			  	<?php if(count(@$actions)){ ?>
							<!-- <h1 class="homestead text-orange" style="text-align: right;"><?php echo Yii::t("rooms", "All your Actions", null, $moduleId); ?> <i class="fa  fa-chevron-circle-down"></i></h1> -->
							<table class="table table-striped table-bordered table-hover directoryTable  ">
								<thead>
									<tr>
										<th class="hidden"><?php echo Yii::t("rooms", "Titre", null, $moduleId); ?></th>
										<th><i class="fa fa-caret-down"></i> <?php echo Yii::t("rooms", "Propositions", null, $moduleId); ?></th>
										<th class=""><i class="fa fa-group"></i> <?php echo Yii::t("rooms", "Participants", null, $moduleId); ?></th>
										<th class="hidden"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "Start Date", null, $moduleId); ?></th>
										<th class="hidden-xs"><i class="fa fa-clock-o"></i> <?php echo Yii::t("rooms", "End Date", null, $moduleId); ?></th>
										<th class="hidden"><?php echo Yii::t("rooms", "Action", null, $moduleId); ?></th>
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
												else if( $choice == Action::ACTION_VOTE_ABSTAIN )
													$icon = "circle";
												else if( $choice == Action::ACTION_VOTE_UNCLEAR )
													$icon = "pencil";
												else if( $choice == Action::ACTION_VOTE_MOREINFO )
													$icon = "question-circle ";
												 ?>
												
											<td ><a class="entryname_vote" <?php echo $link;?>><i class="fa fa-<?php echo $icon ?> text-dark"></i> <?php if(isset($e["name"]))echo $e["name"]?></a></td>
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
											<td class=""><?php echo $participantCount ?></td>
											<td class="hidden"><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
											<td><?php if(isset($e["dateEnd"]))echo date("d/m/y",$e["dateEnd"]) ?></td>
											<td class="center hidden">
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

												 ?>
												<?php //echo $type ?> <i class="fa fa-<?php echo $icon ?> text-green"></i> 

											</td>
										</tr>
									<?php
										};
									}

									?>

								</tbody>
							</table>
						
				<?php }else{ ?>
					<div class="alert alert-danger">
					  	<ul>
					  		<li>Votre historique est vide</li>
					  	</ul> 		
				  	</div>
				<?php } ?>
				</div>
			  </div>
			</div>
</div>




<script type="text/javascript">
var nameParentTitle = "<?php echo $nameParentTitle; ?>";
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-comments'></i> " + "espaces coopératifs");
	$(".main-col-search").addClass("assemblyHeadSection");
	resetDirectoryTable() ;
	$(".DataTables_Table_1_wrapper").addClass("hide");

	$(".explainLink").click(function() {
		    $(".removeExplanation").parent().hide();
			showDefinition( $(this).data("id") );
			return false;
		});

	$(".dataTables_length").append("<button class='btn btn-sm btn-success pull-left' style='margin-left:10px;' onclick='loadByHash(\"#rooms.editroom.type.<?php echo $_GET["type"] ?>.id.<?php echo $_GET["id"] ?>\")'><i class='fa fa-plus'></i> Créer un nouvel espace</button>");
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
				"sLengthMenu" : "_MENU_",
				//"sLengthMenu" : "Montrer _MENU_ lignes",
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