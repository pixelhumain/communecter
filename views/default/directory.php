<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title"><i class="fa fa-globe fa-2x text-green"></i> My <a href="javascript:;" onclick="applyStateFilter('NGO|Group|LocalBusiness')" class="btn btn-xs btn-default"> Organizations <span class="badge badge-warning"> <?php echo count(@$organizations) ?></span></a> 
																				<a href="javascript:;" onclick="applyStateFilter('person')" class="btn btn-xs btn-default"> People <span class="badge badge-warning"> <?php echo count(@$people) ?></span></a>  
																				<a href="javascript:;" onclick="applyStateFilter('event|concert|meeting|dance')" class="btn btn-xs btn-default"> Events <span class="badge badge-warning"> <?php echo count(@$events) ?></span></a> 
																				<a href="javascript:;" onclick="applyStateFilter('project')" class="btn btn-xs btn-default"> Projects <span class="badge badge-warning"> <?php echo count(@$projects) ?></span></a>
																				<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"> All</a></h4>
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
			<?php //var_dump($projects) ?>
			<table class="table table-striped table-bordered table-hover  directoryTable">
				<thead>
					<tr>
						<th>Type</th>
						<th>Name</th>
						<th>Tags</th>
						<th>Scope</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<?php 
					$memberId = Yii::app()->session["userId"];
					$memberType = Person::COLLECTION;
					$tags = array();
					$scopes = array(
						"codeInsee"=>array(),
						"codePostal"=>array(),
						"region"=>array(),
					);
					
					/* ************ ORGANIZATIONS ********************** */
					if(isset($organizations)) 
					{ 
						foreach ($organizations as $e) 
						{ 
							buildDirectoryLine($e, Organization::COLLECTION, Organization::CONTROLLER, Organization::ICON, $this->module->id,$tags,$scopes);
						};
					}

					/* ********** PEOPLE ****************** */
					if(isset($people)) 
					{ 
						foreach ($people as $e) 
						{ 
							buildDirectoryLine($e, Person::COLLECTION, Person::CONTROLLER, Person::ICON, $this->module->id,$tags,$scopes);
						}
					}

					/* ************ EVENTS ************************ */
					if(isset($events)) 
					{ 
						foreach ($events as $e) 
						{ 
							buildDirectoryLine($e, Event::COLLECTION, Event::CONTROLLER, Event::ICON, $this->module->id,$tags,$scopes);
						}
					}
	
					/* ************ PROJECTS **************** */
					if( count($projects) ) 
					{ 
						foreach ($projects as $e) 
						{ 
							buildDirectoryLine($e, Project::COLLECTION, Project::CONTROLLER, Project::ICON, $this->module->id,$tags,$scopes);
						}
					}

					function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes ){
						$strHTML = '<tr id="'.$collection.(string)$e["_id"].'">'.
							'<td class="'.$collection.'Line">'.
								'<a href="'.Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$e["_id"]).'">';
									if ($e && isset($e["imagePath"])){ 
										$strHTML .= '<img width="50" height="50" alt="image" class="img-circle" src="'.Yii::app()->createUrl('/'.$moduleId.'/document/resized/50x50'.$e['imagePath']).'">'.((isset($e["type"])) ? $e["type"] : "");
									} else { 
										$strHTML .= '<i class="fa '.$icon.' fa-2x"></i> '.$type.'';
									} 
								$strHTML .= '</a>';
							$strHTML .= '</td>';
							
							$strHTML .= '<td><a href="'.Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$e["_id"]).'">'.((isset($e["name"]))? $e["name"]:"").'</a></td>';
							
							$strHTML .= '<td>';
							if(isset($e["tags"])){
								foreach ($e["tags"] as $key => $value) {
									$strHTML .= ' <a href="#" onclick="applyTagFilter(\''.$value.'\')"><span class="label label-inverse">'.$value.'</span></a>';
									if( $tags != "" && !in_array($value, $tags) ) 
										array_push($tags, $value);
								}
							}
							$strHTML .= '</td>';

							$strHTML .= '<td>';
							if( isset($e["address"]) && isset( $e["address"]['codeInsee']) ){
								$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$e["address"]['codeInsee'].')"><span class="label label-inverse">'.$e["address"]['codeInsee'].'</span></a>';
								if( !in_array($e["address"]['codeInsee'], $scopes['codeInsee']) ) 
									array_push($scopes['codeInsee'], $e["address"]['codeInsee'] );
							}
							if( isset($e["address"]) && isset( $e["address"]['codePostal']) ){
								$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$e["address"]['codePostal'].')"><span class="label label-inverse">'.$e["address"]['codePostal'].'</span></a>';
								if( !in_array($e["address"]['codePostal'], $scopes['codePostal']) ) 
									array_push($scopes['codePostal'], $e["address"]['codePostal'] );
							}
							if( isset($e["address"]) && isset( $e["address"]['region']) ){
								$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$e["address"]['region'].')"><span class="label label-inverse">'.$e["address"]['region'].'</span></a>';
								if( !in_array($e["address"]['region'], $scopes['region']) ) 
									array_push($scopes['region'], $e["address"]['region'] );
							}	
							$strHTML .= '</td>';

							$strHTML .= '<td class="center">';
								/*if(Yii::app()->session["userId"] ) { ?>
									<a href="javascript:;" class="removeMemberBtn btn btn-xs btn-red tooltips " data-name="<?php echo $e["name"]?>" data-memberof-id="<?php echo $e["_id"]?>" data-member-type="<?php echo $memberType ?>" data-member-id="<?php echo $memberId ?>" data-placement="left" data-original-title="Remove from my Organizations" ><i class=" disconnectBtnIcon fa fa-unlink"></i></a>
								<?php }; */
							$strHTML .= '</td>';
						
						$strHTML .= '</tr>';
						echo $strHTML;
					}
					?>

				</tbody>
			</table>


			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
			<?php 
				/*if (isset($organizations) && count($organizations) == 0) {
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
				};*/
			?>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {
	resetDirectoryTable() ;
});	
var directoryTable = null;
var contextMap = {
	"tags" : <?php echo json_encode($tags) ?>,
	"scopes" : <?php echo json_encode($scopes) ?>,
};
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
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : 10,
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
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
	directoryTable.DataTable().column( 2 ).search( str , true , false ).draw();
	directoryTable.DataTable().column( 3 ).search( str , true , false ).draw();
}
function applyTagFilter(str)
{
	console.log("applyTagFilter",str);
	if(!str){
		str = "";
		sep = "";
		$.each($(".btn-tag.active"), function() { 
			console.log("applyTagFilter",$(this).data("id"));
			str += sep+$(this).data("id");
			sep = "|";
		});
	} else 
		clearAllFilters("");
	console.log("applyTagFilter",str);
	directoryTable.DataTable().column( 2 ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function applyScopeFilter(str)
{
	//console.log("applyScopeFilter",$(".btn-context-scope.active").length);
	if(!str){
		str = "";
		sep = "";
		$.each( $(".btn-context-scope.active"), function() { 
			console.log("applyScopeFilter",$(this).data("val"));
			str += sep+$(this).data("val");
			sep = "|";
		});
	} else 
		clearAllFilters("");
	console.log("applyScopeFilter",str);
	directoryTable.DataTable().column( 3 ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}
</script>