<?php
echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js');
echo CHtml::cssFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/css/DT_bootstrap.css');
echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/DataTables/media/js/DT_bootstrap.js');


$typeParams['city'] = array("class" => "City", "count" => 0);
$typeParams['projects'] = array("class" => "Project", "count" => 0);
$typeParams['events'] = array("class" => "Event", "count" => 0);
$typeParams['organizations'] = array("class" => "Organization", "count" => 0);

$content = "";
$memberId = Yii::app()->session["userId"];
$memberType = Person::COLLECTION;
$tags = array();
$scopes = array(
	"codeInsee"=>array(),
	"postalCode"=>array(),
	"region"=>array(),
);

/* ************ ORGANIZATIONS ********************** */
if(isset($news)) 
{ 
	foreach ($news as $e) 
	{ 
		$e['name'] = "";
		if(isset($e['id'])){
			if($e['type'] == 'city'){
				$tmp = $typeParams[$e['type']]['class']::getSimpleCityById($typeParams[$e['type']]['class']::getIdByInsee($e['id']));
			}
			else{
				$tmp = $typeParams[$e['type']]['class']::getById($e['id']);
			}
			$e['name'] = $tmp['name'];
		}
		$content .= buildDirectoryLine($e, News::CONTROLLER, $e['type'], $typeParams[$e['type']]['class']::ICON, $this->module->id,$tags,$scopes,$typeParams);
	};
}


					
?>

<div class="panel panel-white">
	<div class="panel-heading border-light">
		<h4 class="panel-title">
		<i class="fa fa-globe fa-2x text-green"></i>
		<?php foreach($typeParams as $type => $params){ ?>
			<a href="javascript:;" onclick="applyStateFilter('<?php echo $type?>')" class="filter<?php echo $type?> btn btn-xs btn-default"> <?php echo $params['class'] ?><span class="badge badge-warning"> <?php echo $params['count'] ?></span></a> 
		<?php } ?>
		<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"> All</a>
		</h4>
	</div>
	<div class="panel-body">
		<div>	
			<?php //var_dump($projects) ?>
			<table class="table table-striped table-bordered table-hover moderateTable">
				<thead>
					<tr>
						<th>Type</th>
						<th>Contenu</th>
						<th>Actions</th>
						<th>Tags</th>
						<th>Scope</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody class="directoryLines">
					<?php echo $content; ?>

				</tbody>
			</table>


			<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 0px; display: none;"><div class="ps-scrollbar-x" style="left: -10px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 230px; display: inherit;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div>
		</div>
	</div>
</div>

<!-- modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAbuseContents">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Contenu de la news</h4>
      </div>
      <div class="modal-body">
        <ul>
        	<li>Propos malveillants : XX</li>
        	<li>Incitation et glorification des conduites agressives : XX</li>
        	<li>Affichage de contenu gore et trash : XX</li>
        	<li>Contenu pornographique : XX</li>
        	<li>Liens fallacieux ou frauduleux : XX</li>
        	<li>Mention de source erronée : XX</li>
        	<li>Violations des droits d'auteur : XX</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php 
function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes, &$typeParams ){
		
		//CountByType
		if(isset($typeParams[$type]['count'])) $typeParams[$type]['count'] += 1;


		if(!isset( $e['_id'] ) || !isset( $e["text"]) || $e["text"] == "" )
			return;
		$actions = "";
		$classes = "";
		$id = @$e['_id'];

		/* **************************************
		* ADMIN STUFF
		***************************************** */
		if( Yii::app()->session["userIsAdmin"] )
		{
			$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 declareAsAuthorizeBtn"><i class="fa fa-check text-green"></i>Autoriser</a> </li>';
			$actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 declareAsAbuseBtn"><i class="fa fa-times text-red"></i>Ne plus afficher</a> </li>';
		}

	/* **************************************
	* TYPE + ICON
	***************************************** */
	$strHTML = '<tr id="'.$type.(string)$id.'">'.
		'<td class="'.$type.'Line'.$classes.'">'.
			'<a target="_blank" href="'.Yii::app()->createUrl('/'.$moduleId.'/#news.index.type.'.$type.'.id.'.$e['id'].'?isSearchDesign=1').'">';
				if ($e && isset($e["imagePath"])){ 
					$strHTML .= '<img width="50" height="50" alt="image" class="img-circle" src="'.Yii::app()->createUrl('/'.$moduleId.'/document/resized/50x50'.$e['imagePath']).'">'.((isset($e["name"])) ? $e["name"] : "");
				} else { 
					$strHTML .= '<i class="fa '.$icon.' fa-2x"></i> '.$e['name'].'';
				} 
			$strHTML .= '</a>';
		$strHTML .= '<span>'.$type.'</span></td>';
		
		/* **************************************
		* TEXT
		***************************************** */
		$strHTML .= '<td>'.((isset($e["text"]))? $e["text"]:"").'</td>';
		
		/* **************************************
		* EMAIL for admin use only
		***************************************** */
		// if( Yii::app()->session[ "userIsAdmin"] && Yii::app()->controller->id == "admin" ){
		// 	$strHTML .= '<td><a href="'.Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$id).'">'.((isset($e["email"]))? $e["email"]:"").'</a></td>';
		// }

		/* **************************************
		* Actions
		***************************************** */
		$strHTML .= '<td>
			<i class="fa fa-comment" '.((isset($e['commentCount'])) ? 'onclick="showComments(\''.$e['_id'].'\')"' : '').'>'.((isset($e['commentCount'])) ? $e['commentCount'] : '0').'</i> 
			<i class="fa fa-thumbs-up text-green">'.((isset($e['voteUpCount']) ) ? $e['voteUpCount'] : '0').'</i> 
			<i class="fa fa-thumbs-down text-orange">'.((isset($e['voteDownCount']) ) ? $e['voteDownCount'] : '0').'</i> 
			<i class="fa fa-flag text-red modalAbuseContentsBtn" data-id="'.$e['_id'].'">'.((isset($e['reportAbuseCount']) ) ? $e['reportAbuseCount'] : '0').'</i> 
		</td>';
		
		/* **************************************
		* TAGS
		***************************************** */
		$strHTML .= '<td>';
		if(isset($e["tags"])){
			foreach ($e["tags"] as $key => $value) {
				$strHTML .= ' <a href="#" onclick="applyTagFilter(\''.$value.'\')"><span class="label label-inverse">'.$value.'</span></a>';
				if( $tags != "" && !in_array($value, $tags) ) 
					array_push($tags, $value);
			}
		}
		$strHTML .= '</td>';

		/* **************************************
		* SCOPES
		***************************************** */
		// $strHTML .= '<td>';
		// if( isset($e["address"]) && isset( $e["address"]['codeInsee']) ){
		// 	$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$e["address"]['codeInsee'].')"><span class="label label-inverse">'.$e["address"]['codeInsee'].'</span></a>';
		// 	if( !in_array($e["address"]['codeInsee'], $scopes['codeInsee']) ) 
		// 		array_push($scopes['codeInsee'], $e["address"]['codeInsee'] );
		// }
		// if( isset($e["address"]) && isset( $e["address"]['codePostal']) ){
		// 	$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$e["address"]['codePostal'].')"><span class="label label-inverse">'.$e["address"]['codePostal'].'</span></a>';
		// 	if( !in_array($e["address"]['codePostal'], $scopes['codePostal']) ) 
		// 		array_push($scopes['codePostal'], $e["address"]['codePostal'] );
		// }
		// if( isset($e["address"]) && isset( $e["address"]['region']) ){
		// 	$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$e["address"]['region'].')"><span class="label label-inverse">'.$e["address"]['region'].'</span></a>';
		// 	if( !in_array($e["address"]['region'], $scopes['region']) ) 
		// 		array_push($scopes['region'], $e["address"]['region'] );
		// }	
		// $strHTML .= '</td>';
		$strHTML .= '<td>';
		foreach ($scopes as $id => $value) {
			if( isset($e["scope"]) && isset( $e["scope"]['cities']) ){
				foreach($e["scope"]['cities'] as $city){
					if(isset($city[$id])){
						$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$city[$id].')"><span class="label label-inverse">'.$city[$id].'</span></a>';
						if( !in_array($city[$id], $scopes[$id]) ) 
							array_push($scopes[$id], $city[$id] );
					}
				}
			}
		}
		$strHTML .= '</td>';

		/* **************************************
		* ACTIONS
		***************************************** */
		$strHTML .= '<td class="center">';
		if( !empty($actions) && Yii::app()->session["userIsAdmin"] ) 
			$strHTML .= '<div class="btn-group">'.
						'<a href="#" data-toggle="dropdown" class="btn btn-red dropdown-toggle btn-sm"><i class="fa fa-cog"></i> <span class="caret"></span></a>'.
						'<ul class="dropdown-menu pull-right dropdown-dark" role="menu">'.
							$actions.
						'</ul></div>';
		$strHTML .= '</td>';
		
	$strHTML .= '</tr>';
	return $strHTML;
}

?>

<script type="text/javascript">

function showComments(id){
	$.blockUI({
			message : '<div><a href="javascript:$.unblockUI();"><span class="pull-right text-dark"><i class="fa fa-share-alt"></span></a>'+
							'<div class="commentContent"></div></div>', 
			onOverlayClick: $.unblockUI,
			css: {"text-align": "left", "cursor":"default", "width":"50%", "left":"25%" }
		});
		getAjax('.commentContent',baseUrl+'/'+moduleId+"/comment/index/type/news/id/"+id,function(){ 
		},"html");
}


var openingFilter = "<?php echo ( isset($_GET['type']) ) ? $_GET['type'] : '' ?>";
jQuery(document).ready(function() {
	$(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Répertoire");

	//To dispkay abuse texts
	$('.modalAbuseContentsBtn').on("click",function (e) {
		console.log("modalAbuseContentsBtn click");
		$('#modalAbuseContents').modal('show');
	});

	bindAdminBtnEvents();
	resetModerateTable() ;
	if(openingFilter != "")
		$('.filter'+openingFilter).trigger("click");
});	

var moderateTable = null;
var contextMap = {
	"tags" : <?php echo json_encode($tags) ?>,
	"scopes" : <?php echo json_encode($scopes) ?>,
};

function resetModerateTable() 
{ 
	console.log("resetModerateTable");

	if( !$('.moderateTable').hasClass("dataTable") )
	{
		moderateTable = $('.moderateTable').dataTable({
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
			moderateTable.dataTable().fnDestroy();
			moderateTable.dataTable().fnDraw();
		} else {
			console.log(" moderateTable fnClearTable");
			moderateTable.dataTable().fnClearTable();
		}
	}
}

function applyStateFilter(str)
{
	console.log("applyStateFilter",str);
	moderateTable.DataTable().column( 0 ).search(str , true , false).draw();
}
function clearAllFilters(str){ 
	moderateTable.DataTable().column( 0 ).search( str , true , false ).draw();
	moderateTable.DataTable().column( 2 ).search( str , true , false ).draw();
	moderateTable.DataTable().column( 3 ).search( str , true , false ).draw();
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
	moderateTable.DataTable().column( 2 ).search( str , true , false ).draw();
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
	moderateTable.DataTable().column( 4 ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function bindAdminBtnEvents(){
	console.log("bindAdminBtnEvents");
	
	<?php 
	/* **************************************
	* ADMIN STUFF
	***************************************** */
	if( Yii::app()->session["userIsAdmin"] ) {?>		

		$(".declareAsAbuseBtn").off().on("click",function () 
		{
			console.log("declareAsAbuseBtn click");
	        $(this).empty().html('<i class="fa fa-spinner fa-spin"></i>');
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var type = $(this).data("type");
	        var urlToSend = baseUrl+"/"+moduleId+"/news/save/news/"+id;
	        
	        bootbox.confirm("Cette actualité ne sera plus affichée",
        	function(result) 
        	{
				if (!result) {
					btnClick.empty().html('<i class="fa fa-thumbs-down"></i>');
					return;
				}
				$.ajax({
			        type: "POST",
			        url: urlToSend,
			        dataType : "json"
			    })
			    .done(function (data)
			    {
			        if ( data && data.result ) {
			        	toastr.info("Activated User!!");
			        	btnClick.empty().html('<i class="fa fa-thumbs-up"></i>');
			        } else {
			           toastr.info("something went wrong!! please try again.");
			        }
			    });

			});

		});

	<?php } ?>
	$(".banThisBtn").off().on("click",function () 
		{
			console.log("banThisBtn click");
		});
}

function changeRole(button, action) {
	console.log(button," click");
    //$(this).empty().html('<i class="fa fa-spinner fa-spin"></i>');
    var urlToSend = baseUrl+"/"+moduleId+"/person/changerole/";
    var res = false;

	$.ajax({
        type: "POST",
        url: urlToSend,
        data: {
        	"id" : button.data("id"),
			"action" : action
        },
        dataType : "json"
    })
    .done(function (data) {
        if ( data && data.result ) {
        	toastr.success("Change has been done !!");
        	changeButtonName(button, action);
        	bindAdminBtnEvents();
        } else {
           toastr.error("Something went wrong!! please try again. " + data.msg);
        }
    });
}

function changeButtonName(button, action) {
	console.log(action);
	var icon = '<span class="fa-stack"> <i class="fa fa-user fa-stack-1x"></i><i class="fa fa-check fa-stack-1x stack-right-bottom text-danger"></i></span>';
	if (action=="addBetaTester") {
		button.removeClass("addBetaTesterBtn");
		button.addClass("revokeBetaTesterBtn");
		button.html(icon+" Revoke this beta tester");
	} else if (action=="revokeBetaTester") {
		button.removeClass("revokeBetaTesterBtn");
		button.addClass("addBetaTesterBtn");
		button.html(icon+" Add this beta tester");
	} else if (action=="addSuperAdmin") {
		button.removeClass("addSuperAdminBtn");
		button.addClass("revokeSuperAdminBtn");
		button.html(icon+" Revoke this super admin");
	} else if (action=="revokeSuperAdmin") {
		button.removeClass("revokeSuperAdminBtn");
		button.addClass("addSuperAdminBtn");
		button.html(icon+" Add this super admin");
	} else {
		console.warn("Unknown action !");
	}
}

</script>