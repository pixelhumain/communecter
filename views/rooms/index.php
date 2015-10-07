<?php 
$cssAnsScriptFilesTheme = array(
	'/plugins/DataTables/media/css/DT_bootstrap.css',
	'/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js',
	'/plugins/DataTables/media/js/DT_bootstrap.js'
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme,Yii::app()->theme->baseUrl."/assets");
 ?>
<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-comments fa-2x text-green"></i> ACTION ROOMS 
			<a href="javascript:;" onclick="applyStateFilter('survey')" class="btn btn-xs btn-default"> Rooms <span class="badge badge-warning"> <?php echo count(@$rooms) ?></span></a> 
			<a href="javascript:;" onclick="applyStateFilter('entry')" class="btn btn-xs btn-default"> Actions <span class="badge badge-warning"> <?php echo count(@$actions) ?></span></a>  
			<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"> All</a>
		</h4>
		<ul class="panel-heading-tabs border-light">
    	<li>
    		<?php  
    			$urlParams = ( isset( $_GET["type"] ) && isset($_GET["id"])) ? "/type/".$_GET["type"]."/id/".$_GET["id"] : "" ;
    			?>
    		<a class=" btn btn-info" href="#" onclick="openSubView('Add a Room', '/communecter/rooms/editroom<?php echo $urlParams ?>',null,function(){editRoomSV ();})" ><i class="fa fa-plus"></i> Room </a>
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
								if( $e["type"] == ActionRoom::TYPE_SURVEY ){
									$type = "survey/entries";
									$icon = "check-square";
								}else if( $e["type"] == ActionRoom::TYPE_DISCUSS ){
									$type = "comment/index/type/actionRooms";
									$icon = "comments";
								} else if ( $e["type"] == ActionRoom::TYPE_BRAINSTORM ){
									$type = "survey/entries";
									$icon = "lightbulb-o";
								}
								
								$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"])
								?>
								<a href="<?php echo $link;?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-<?php echo @$icon ?> fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?> 
									<?php } ?>
								</a>
							</td>
							<td ><a href="<?php echo $link;?>"><?php if(isset($e["name"]))echo $e["name"]?></a></td>
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
								$type = "survey/entry";
								$icon = "bookmark";
								$link = Yii::app()->createUrl('/'.$this->module->id.'/'.$type.'/id/'.$e["_id"])
								?>
								<a href="<?php echo $link;?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-<?php echo $icon ?> fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?> 
									<?php } ?>
								</a>
							</td>
							<td ><a href="<?php echo $link;?>"><?php if(isset($e["name"]))echo $e["name"]?></a></td>
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
						Create Room
						<br>Discussions  
						<br>Decisions
						<br>Brainstorms
						<br>to think, develop, build and decide collaboratively
					</blockquote>
				</div>
			<?php 
				};
			?>
		</div>
	</div>
</div>


<script type="text/javascript">
jQuery(document).ready(function() {
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