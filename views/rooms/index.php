<?php 
$cssAnsScriptFilesTheme = array(
	'/plugins/DataTables/media/css/DT_bootstrap.css',
	'/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js',
	'/plugins/DataTables/media/js/DT_bootstrap.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->theme->baseUrl."/assets");
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
		    margin-bottom: -3px;
		    font-size: 32px;
		    margin-top:90px;
		  }
		#main-panel-room{
			/*margin-top:100px;*/
		}
</style>


<h1 class="homestead text-red center citizenAssembly-header">
	<i class="fa fa-group"></i> <?php echo $nameParentTitle; ?><br>
	<small class="homestead text-dark center">
		Discussions, propositions, débats, sondages
	</small>
</h1>

<div class="panel panel-white" id="main-panel-room">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><!-- <i class="fa fa-comments fa-2x text-green"></i> ACTION ROOMS  -->
			<a href="javascript:;" onclick="applyStateFilter('survey')" class="btn btn-xs btn-default"> Rooms <span class="badge badge-warning"> <?php echo count(@$rooms) ?></span></a> 
			<a href="javascript:;" onclick="applyStateFilter('entry')" class="btn btn-xs btn-default"> Actions <span class="badge badge-warning"> <?php echo count(@$actions) ?></span></a>  
			<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"> All</a>
		</h4>
		<ul class="panel-heading-tabs border-light">
    	<li>
    		<?php  
    			$urlParams = ( isset( $_GET["type"] ) && isset($_GET["id"])) ? ".type.".$_GET["type"].".id.".$_GET["id"] : "" ;
    			?>
    		<a class=" btn btn-info" href="javascript:" onclick="loadByHash('#rooms.editroom<?php echo $urlParams ?>')" ><i class="fa fa-plus"></i> Room </a>
    	</li>
    	<li>
    		<a class=" btn btn-success" href="javascript:" onclick="loadByHash(location.hash)" ><i class="fa fa-refresh"></i> </a>
    	</li>
		
	</div>
	<div class="panel-body">
		<div>	
			<table class="table table-striped table-bordered table-hover  directoryTable">
				<thead>
					<tr>
						<th>Type / Action</th>
						<th>Name</th>
						<th>Entries</th>
						<th>Participants</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Actions</th>
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
						<tr id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
							<td class="center organizationLine">
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
								<a <?php echo $link;?> >
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-<?php echo @$icon ?> fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?> 
									<?php } ?>
								</a>
							</td>
							<td ><a <?php echo $link;?> ><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<td><?php echo PHDB::count(Survey::COLLECTION,array('survey'=>(string)$e["_id"])) ?></td>
							<td></td>
							<td><?php if(isset($e["created"]))echo date("d/m/y",$e["created"])?></td>
							<td><?php if(isset($e["dateEnd"]))echo $e["dateEnd"]?></td>
							<td class="center">
								<?php /*if(Yii::app()->session["userId"] ) { ?>
									<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-red tooltips " data-name="<?php echo $e["name"]?>" data-memberof-id="<?php echo $e["_id"]?>" data-member-type="<?php echo $memberType ?>" data-member-id="<?php echo $memberId ?>" data-placement="left" data-original-title="Remove from my rooms" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; */?>
							</td>
						</tr>
					<?php
						};
					}

					
					/* **************************************
					*	rooms
					***************************************** */
					if(isset($actions)) 
					{ 
						foreach ($actions as $e) 
						{ ?>
						<tr id="<?php echo ActionRoom::COLLECTION.(string)$e["_id"];?>">
							<td class="center organizationLine">
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
							<td></td>
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

			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
			<?php 
				if (isset($rooms) && count($rooms) == 0) {
			?>
				<div id="infoPodOrga" class="padding-10">
					<blockquote> 
						<?php echo Yii::t('rooms', 'Create Room', null, Yii::app()->controller->module->id)?>
						<br><?php echo Yii::t('rooms', 'Discussions', null, Yii::app()->controller->module->id)?> 
						<br><?php echo Yii::t('rooms', 'Decisions', null, Yii::app()->controller->module->id)?>
						<br><?php echo Yii::t('rooms', 'Brainstorms', null, Yii::app()->controller->module->id)?>
						<br><?php echo Yii::t('rooms', 'to think, develop, build and decide collaboratively', null, Yii::app()->controller->module->id)?>
					</blockquote>
				</div>
			<?php 
				};
			?>
		</div>
	</div>
</div>


<script type="text/javascript">
var nameParentTitle = "<?php echo $nameParentTitle; ?>";
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-comments text-red'></i> " + "espace citoyen");
	$(".main-col-search").addClass("assemblyHeadSection");
	resetDirectoryTable() ;
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
				"sLengthMenu" : "Show _MENU_ Rows",
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