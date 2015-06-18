<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-globe fa-2x text-green"></i> My <a href="javascript:;" onclick="applyStateFilter('NGO|Group|LocalBusiness')" class="btn btn-xs btn-default"> Organizations <span class="badge badge-warning"> <?php echo count($organizations) ?></span></a> 
																				<a href="javascript:;" onclick="applyStateFilter('person')" class="btn btn-xs btn-default"> People <span class="badge badge-warning"> <?php echo count($people) ?></span></a>  
																				<a href="javascript:;" onclick="applyStateFilter('event')" class="btn btn-xs btn-default"> Events <span class="badge badge-warning"> <?php echo count($events) ?></span></a> 
																				<a href="javascript:;" onclick="applyStateFilter('project')" class="btn btn-xs btn-default"> Projects <span class="badge badge-warning"> <?php echo count($projects) ?></span></a>
																				<a href="javascript:;" onclick="applyStateFilter('')" class="btn btn-xs btn-default"> All</a></h4>
	</div>
	<div class="panel-tools">
		<?php if( Yii::app()->session["userId"] ) { ?>
		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/organization/addorganizationform',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an Organization"><i class="fa fa-plus"></i> <i class="fa fa-group"></i> </a>

		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/events/addeventform',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an Event"><i class="fa fa-plus"></i> <i class="fa fa-calendar"></i></a>

		<a href="javascript:;" onclick="openSubView('Add an Organisation', '/'+moduleId+'/person/inviteSomeone',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Invite Someone "><i class="fa fa-plus"></i> <i class="fa fa-user"></i></a>
		<?php } ?>

	</div>
	<div class="panel-body">
		<div>	

			<table class="table table-striped table-bordered table-hover  directoryTable">
				<thead>
					<tr>
						<th>Type</th>
						<th>Name</th>
						<th>Tags</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;

					/* **************************************
					*	ORGANIZATIONS
					***************************************** */
					if(isset($organizations)) 
					{ 
						foreach ($organizations as $e) 
						{ ?>
						<tr id="<?php echo Organization::COLLECTION.(string)$e["_id"];?>">
							<td class="<?php echo Organization::COLLECTION;?>Line">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-group fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } ?>
								</a>
							</td>
							<td ><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/organization/dashboard/id/'.$e["_id"]);?>"><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<td ><?php 
								if(isset($e["tags"])){
									foreach ($e["tags"] as $key => $value) {
										echo ' <span class="label label-inverse">'.$value.'</span>';
									}
								}
							?></td>
							<td class="center">
								<?php /*if(Yii::app()->session["userId"] ) { ?>
									<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-red tooltips " data-name="<?php echo $e["name"]?>" data-memberof-id="<?php echo $e["_id"]?>" data-member-type="<?php echo $memberType ?>" data-member-id="<?php echo $memberId ?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; */?>
							</td>
						</tr>
					<?php
						};
					}

					/* **************************************
					*	PEOPLE
					***************************************** */
					if(isset($people)) 
					{ 
						foreach ($people as $e) 
						{ ?>
						<tr id="<?php echo Person::COLLECTION.(string)$e["_id"];?>">
							<td class="<?php echo Person::COLLECTION;?>Line">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]);?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-user fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } ?> Person
								</a>
							</td>
							<td ><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/person/dashboard/id/'.$e["_id"]);?>"><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<td ><?php 
								if(isset($e["tags"])){
									foreach ($e["tags"] as $key => $value) {
										echo ' <span class="label label-inverse">'.$value.'</span>';
									}
								}
							?></td>
							<td class="center">
								<?php /*if(Yii::app()->session["userId"] ) { ?>
									<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-red tooltips " data-name="<?php echo $e["name"]?>" data-memberof-id="<?php echo $e["_id"]?>" data-member-type="<?php echo $memberType ?>" data-member-id="<?php echo $memberId ?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; */?>
							</td>
						</tr>
					<?php
						}
					}

					/* **************************************
					*	EVENTS
					***************************************** */
					if(isset($events)) 
					{ 
						foreach ($events as $e) 
						{ ?>
						<tr id="<?php echo Event::COLLECTION.(string)$e["_id"];?>">
							<td class="<?php echo Event::COLLECTION;?>Line">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/event/dashboard/id/'.$e["_id"]);?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-calendar fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } ?>
								</a>
							</td>
							<td ><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/event/dashboard/id/'.$e["_id"]);?>"><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<td ><?php 
								if(isset($e["tags"])){
									foreach ($e["tags"] as $key => $value) {
										echo ' <span class="label label-inverse">'.$value.'</span>';
									}
								}
							?></td>
							<td class="center">
								<?php /*if(Yii::app()->session["userId"] ) { ?>
									<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-red tooltips " data-name="<?php echo $e["name"]?>" data-memberof-id="<?php echo $e["_id"]?>" data-member-type="<?php echo $memberType ?>" data-member-id="<?php echo $memberId ?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; */?>
							</td>
						</tr>
					<?php
						}
					}
	
					/* **************************************
					*	PROJECTS
					***************************************** */
					if( isset($projects) ) 
					{ 
						foreach ($projects as $e) 
						{ ?>
						<tr id="<?php echo Project::COLLECTION.(string)$e["_id"];?>">
							<td class="<?php echo Project::COLLECTION;?>Line">
								<a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/dashboard/id/'.$e["_id"]);?>">
									<?php if ($e && isset($e["imagePath"])){ ?>
										<img width="50" height="50" alt="image" class="img-circle" src="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$e['imagePath']) ?>"> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } else { ?>
										<i class="fa fa-lightbulb-o fa-2x"></i> <?php if(isset($e["type"]))echo $e["type"]?>
									<?php } ?>
								</a>
							</td>
							<td><a href="<?php echo Yii::app()->createUrl('/'.$this->module->id.'/project/dashboard/id/'.$e["_id"]);?>"><?php if(isset($e["name"]))echo $e["name"]?></a></td>
							<td><?php 
								if(isset($e["tags"])){
									foreach ($e["tags"] as $key => $value) {
										echo ' <span class="label label-inverse">'.$value.'</span>';
									}
								}
							?></td>
							<td class="center">
								<?php /*if(Yii::app()->session["userId"] ) { ?>
									<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-red tooltips " data-name="<?php echo $e["name"]?>" data-memberof-id="<?php echo $e["_id"]?>" data-member-type="<?php echo $memberType ?>" data-member-id="<?php echo $memberId ?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; */?>
							</td>
						</tr>
					<?php
						}
					}
					?>

				</tbody>
			</table>


			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
			<?php 
				if (isset($organizations) && count($organizations) == 0) {
			?>
				<div id="infoPodOrga" class="padding-10">
					<blockquote> 
						Create or Connect 
						<br>an Organization, NGO,  
						<br>Local Business, Informal Group. 
						<br>Build links in your network, 
						<br>to create a connected local directory 
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
var directoryTable = null;
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
	directoryTable.DataTable().column( 0 ).search( str , true , true ).draw();
}
</script>