<?php
echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js');
echo CHtml::cssFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/css/DT_bootstrap.css');
echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/DT_bootstrap.js');

?>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title">
			<a href="javascript:;" onclick="applyStateFilter('goods')" class="filtergood btn btn-xs btn-default"><i class="fa fa-check fa-1x text-success"></i>Goods <span class="badge badge-warning"> <?php echo count(@$goods) ?></span></a>

			<a href="javascript:;" onclick="applyStateFilter('errors')" class="filtererror btn btn-xs btn-default"><i class="fa fa-close fa-1x text-danger"></i> Errors <span class="badge badge-warning"><?php echo count(@$errors) ?></span></a>

			<a href="javascript:;" onclick="applyStateFilter('news')" class="filtererror btn btn-xs btn-default"><i class="fa fa-warning fa-1x text-warning"></i> News <span class="badge badge-warning"> <?php echo count(@$news) ?></span></a>

			<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"><i class="fa fa-university fa-1x text-primary"></i> All</a></h4>
	</div>
	<div class="panel-tools">
		<a href="javascript:;" onclick="openSubView('Add an city', '/'+moduleId+'/organization/addorganizationform',null)" class="btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add an city"><i class="fa fa-plus"></i> <i class="fa fa-group"></i> </a>
	</div>
	<div class="panel-body">
		<div>
			<table class="table table-striped table-bordered table-hover  directoryTable">
				<thead>
					<tr>
						<th>Type</th>
						<th>Name</th>
						<th>Département</th>
						<th>Région</th>
						<th>Pays</th>
						<th>Errors</th>
						<th>Action</th>
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
					
					if(isset($goods)) 
					{ 
						foreach ($goods as $e) 
						{ 
							buildDirectoryLine($e, City::COLLECTION, City::CONTROLLER, City::ICON, $this->module->id,$tags,$scopes, "goods");
						};
					}

					if(isset($errors)) 
					{ 
						foreach ($errors as $e) 
						{ 
							buildDirectoryLine($e, City::COLLECTION, City::CONTROLLER, City::ICON, $this->module->id,$tags,$scopes, "errors");
						}
					}

					if(isset($news)) 
					{ 
						foreach ($news as $e) 
						{ 
							buildDirectoryLine($e, City::COLLECTION, City::CONTROLLER, City::ICON, $this->module->id,$tags,$scopes, "news");
						}
					}

					

					function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes, $goodsOrNot ){
							
							if(!isset( $e['_id'] ) || !isset( $e["name"]) || $e["name"] == "" )
								return;
							$actions = "";
							$classes = "";
							$id = @$e['_id'];

							/* **************************************
							* ADMIN STUFF
							***************************************** */
							if( Yii::app()->session["userIsAdmin"] ){
								$actions .= '<li>'.
												'<a href="javascript:;" onclick="updateCities(\''.$id.'\', \''.$goodsOrNot.'\');" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 validateThisBtn">'.
													'<span class="fa-stack">'.
														'<i class="fa fa-university fa-stack-1x"></i>'.
														'<i class="fa fa-pencil fa-stack-1x stack-right-bottom text-danger"></i>'.
													'</span> Update '.
												'</a>'.
											'</li>';
								$actions .= '<li>'.
												'<a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 validateThisBtn">'.
													'<span class="fa-stack">'.
														'<i class="fa fa-university fa-stack-1x"></i>'.
														'<i class="fa fa-trash fa-stack-1x stack-right-bottom text-danger"></i>'.
													'</span> Delete '.
												'</a>'.
											'</li>';								
							}

							/* **************************************
							* TYPE + ICON
							***************************************** */
						$strHTML = '<tr id="'.(string)$id.'">' ;
							$strHTML = '<td class="'.$collection.'Line '.$classes.'">';
											$strHTML .= '<span class="fa-stack"><i class="fa '.$icon.' fa-stack-2x"></i>';
											if($goodsOrNot == "goods")
												$strHTML .= '<i class="fa fa-check fa-stack-2x stack-right-bottom text-success"></i>';
											else if($goodsOrNot == "errors")
												$strHTML .= '<i class="fa fa-close fa-stack-2x stack-right-bottom text-danger"></i>';
											else if($goodsOrNot == "news")
												$strHTML .= '<i class="fa fa-warning fa-stack-2x stack-right-bottom text-warning"></i>';
											$strHTML .= '</span><span class="hidden">'.$goodsOrNot.'</span>';
									$strHTML .= '</td>';
							
							/* **************************************
							* NAME
							***************************************** */
							$strHTML .= '<td><a href="'.Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$id).'">'.((isset($e["name"]))? $e["name"]:"").'</a></td>';
							
							/* **************************************
							* EMAIL for admin use only
							***************************************** */
							$strHTML .= '<td>'.((isset($e["depName"]))? $e["depName"]:"").'</td>';
							$strHTML .= '<td>'.((isset($e["regionName"]))? $e["regionName"]:"").'</td>';
							$strHTML .= '<td>'.((isset($e["country"]))? $e["country"]:"").'</td>';
							$strHTML .= '<td>'.((isset($e["msgErrors"]))? $e["msgErrors"]:"").'</td>';

							/* **************************************
							* ACTIONS
							***************************************** */
							$strHTML .= '<td class="center">';
							if( !empty($actions) && Yii::app()->session["userIsAdmin"] ){
								$strHTML .= '<div class="btn-group">'.
											'<a href="#" data-toggle="dropdown" class="btn btn-red dropdown-toggle btn-sm"><i class="fa fa-cog"></i> <span class="caret"></span></a>'.
											'<ul class="dropdown-menu pull-right dropdown-dark" role="menu">'.
												$actions.
											'</ul></div>';
							
							}
							$strHTML .= '</td>';
						$strHTML .= '</tr>';
						echo $strHTML ;
					}
					?>

				</tbody>
			</table>


			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>

		</div>
	</div>
</div>
<script type="text/javascript">
var openingFilter = "<?php echo ( isset($_GET['type']) ) ? $_GET['type'] : '' ?>";
var goods = <?php echo ( isset($goods) ) ? json_encode($goods) : '' ?>;
var errors = <?php echo ( isset($errors) ) ? json_encode($errors) : '' ?>;
var news = <?php echo ( isset($news) ) ? json_encode($news) : '' ?>;
var directoryTable = null;
/*var contextMap = {
	"tags" : <?php echo json_encode($tags) ?>,
	"scopes" : <?php echo json_encode($scopes) ?>,
};*/

jQuery(document).ready(function() {
	setTitle("Espace administrateur : Répertoire","cog");
	bindAdminBtnEvents();
	resetDirectoryTable();
	if(openingFilter != "")
		$('.filter'+openingFilter).trigger("click");
});	

function resetDirectoryTable() 
{ 
	mylog.log("resetDirectoryTable");

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
			mylog.log(" directoryTable fnClearTable");
			directoryTable.dataTable().fnClearTable();
		}
	}
}

function applyStateFilter(str)
{
	mylog.log("applyStateFilter",str);
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
}
function clearAllFilters(str){ 
	directoryTable.DataTable().column( 0 ).search( str , true , false ).draw();
	directoryTable.DataTable().column( 2 ).search( str , true , false ).draw();
	directoryTable.DataTable().column( 3 ).search( str , true , false ).draw();
}
function applyTagFilter(str)
{
	mylog.log("applyTagFilter",str);
	if(!str){
		str = "";
		sep = "";
		$.each($(".btn-tag.active"), function() { 
			mylog.log("applyTagFilter",$(this).data("id"));
			str += sep+$(this).data("id");
			sep = "|";
		});
	} else 
		clearAllFilters("");
	mylog.log("applyTagFilter",str);
	directoryTable.DataTable().column( 2 ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function applyScopeFilter(str)
{
	//mylog.log("applyScopeFilter",$(".btn-context-scope.active").length);
	if(!str){
		str = "";
		sep = "";
		$.each( $(".btn-context-scope.active"), function() { 
			mylog.log("applyScopeFilter",$(this).data("val"));
			str += sep+$(this).data("val");
			sep = "|";
		});
	} else 
		clearAllFilters("");
	mylog.log("applyScopeFilter",str);
	directoryTable.DataTable().column( 3 ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function bindAdminBtnEvents(){
	mylog.log("bindAdminBtnEvents");

}


function updateCities(id, goodsOrNot) {
	var city = {};
	if(goodsOrNot == "goods")
		city = generateDataForDynForm(goods[id]);
	else
		city = generateDataForDynForm(errors[id]);

	openForm ('cities', null, city);
}

function generateDataForDynForm(city) {
	mylog.log("city", city);
	var data = {
		id : city._id.$id,
		name : city.name,
		alternateName : city.alternateName,
		insee : city.insee,
		country : city.country,
		dep : city.dep,
		depName : city.depName,
		region : city.region,
		regionName : city.regionName,
		osmId : city.osmId,
		wikidataId : city.wikidataId,
		latitude : city.geo.latitude,
		longitude : city.geo.longitude,
		geoShape : city.geoShape,
		postalCodes : []
	};

	$.each(city.postalCodes,function(key,pc){
		mylog.log("city.postalCodes");
		console.dir(pc);
		var newPC = {
			postalCode : pc.postalCode,
			name : pc.name,
			latitude : pc.geo.latitude,
			longitude : pc.geo.longitude,
		}
		data.postalCodes.push(newPC);		
	});
	mylog.log("data", data);
	return data ;
}

</script>