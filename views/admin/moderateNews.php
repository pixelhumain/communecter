<?php 

$typeParams['city'] = array("libelle" => "Ville","class" => "City", "count" => 0);
$typeParams['projects'] = array("libelle" => "Projet","class" => "Project", "count" => 0);
$typeParams['events'] = array("libelle" => "Evénement","class" => "Event", "count" => 0);
$typeParams['organizations'] = array("libelle" => "Organisation","class" => "Organization", "count" => 0);
$typeParams['citoyens'] = array("libelle" => "Citoyens", "class" => "Person", "count" => 0);


$content = "";
$memberId = Yii::app()->session["userId"];
$memberType = Person::COLLECTION;
$tags = array();
$scopes = array(
	"codeInsee"=>array(),
	"postalCode"=>array(),
	"region"=>array(),
);

/* ************ NEWS ********************** */
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
			<a href="javascript:;" onclick="applyStateFilter('<?php echo $type?>')" class="filter<?php echo $type?> btn btn-xs btn-default"> <?php echo $params['libelle'] ?><span class="badge badge-warning"> <?php echo $params['count'] ?></span></a> 
		<?php } ?>
		<a href="javascript:;" onclick="clearAllFilters('')" class="btn btn-xs btn-default"> All</a>
		<div id="filterTag" style="float:right"></div>
		<div id="filterScope" style="float:right"></div>
		</h4>
	</div>
	<div class="panel-body">
		<div>	
			<?php //var_dump($projects) ?>
			<table class="table table-striped table-bordered table-hover moderateTable">
				<thead>
					<tr>
						<th>Type</th>
						<th>Propriétaire</th>
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
        <div class="modal-title" id="modalText">Contenu de la news</div>
      </div>
      <div class="modal-body">
        <ul id='listReason'>
        	
        </ul>
      </div>
      <div class="modal-footer">
      	<div id="modalAction" style="display:inline"></div>
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
		// $actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" data-value="true" class="margin-right-5 declareAsAuthorizeBtn"><i class="fa fa-check text-green"></i>Autoriser</a> </li>';
		// $actions .= '<li><a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" data-value="false" class="margin-right-5 declareAsAbuseBtn"><i class="fa fa-times text-red"></i>Ne plus afficher</a> </li>';
	}

	/* **************************************
	* TYPE + ICON
	***************************************** */
	$strHTML = '<tr id="'.(string)$id.'">'.
		'<td>'.$type.'</td>
		<td class="Line'.$classes.'">'.
			'<a target="_blank" href="'.Yii::app()->createUrl('/'.$moduleId.'/#news.index.type.'.$type.'.id.'.$e['id'].'?isSearchDesign=1').'">';
				if ($e && isset($e["imagePath"])){ 
					$strHTML .= '<img width="50" height="50" alt="image" class="img-circle" src="'.Yii::app()->createUrl('/'.$moduleId.'/document/resized/50x50'.$e['imagePath']).'">'.((isset($e["name"])) ? $e["name"] : "");
				} else { 
					$strHTML .= '<i class="fa '.$icon.' fa-2x"></i> '.$e['name'].'';
				} 
			$strHTML .= '</a>';
		$strHTML .= '<span></span></td>';
		
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
		***************************************** 
<i class="fa fa-comment" '.((isset($e['commentCount'])) ? 'onclick="showComments(\''.$e['_id'].'\')"' : '').'>&nbsp;'.((isset($e['commentCount'])) ? $e['commentCount'] : '0').'</i>&nbsp;
		*/
		$strHTML .= '<td>
			<i class="fa fa-thumbs-up text-green">'.((isset($e['voteUpCount']) ) ? $e['voteUpCount'] : '0').'</i>&nbsp; 
			<i class="fa fa-thumbs-down text-orange">'.((isset($e['voteDownCount']) ) ? $e['voteDownCount'] : '0').'</i>&nbsp;
			<i class="fa fa-flag text-red modalAbuseContentsBtn" data-id="'.$e['_id'].'">'.((isset($e['reportAbuseCount']) ) ? $e['reportAbuseCount'] : '0').'</i>&nbsp;
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
		foreach ($scopes as $ids => $value) {
			if( isset($e["scope"]) && isset( $e["scope"]['cities']) ){
				foreach($e["scope"]['cities'] as $city){
					if(isset($city[$ids])){
						$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$city[$ids].')"><span class="label label-inverse">'.$city[$ids].'</span></a>';
						if( !in_array($city[$ids], $scopes[$ids]) ) 
							array_push($scopes[$ids], $city[$ids] );
					}
				}
			}
		}
		$strHTML .= '</td>';

		/* **************************************
		* ACTIONS
		***************************************** */
		$strHTML .= '<td class="center">';
		if(Yii::app()->session["userIsAdmin"] ) 
			// $strHTML .= '<div class="btn-group">'.
			// 			'<a href="#" data-toggle="dropdown" class="btn btn-red dropdown-toggle btn-sm"><i class="fa fa-cog"></i> <span class="caret"></span></a>'.
			// 			'<ul class="dropdown-menu pull-right dropdown-dark" role="menu">'.
			// 				$actions.
			// 			'</ul></div>';
			$strHTML .= '<a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" data-value="true"  class="margin-right-5 declareAsAuthorizeBtn"><i class="fa fa-eye-slash text-red fa-2x"></i></a>
						<a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 declareAsAbuseBtn" data-value="false"><i class="fa fa-eye text-green fa-2x"></i></a>';
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
var moderateTable = null;

jQuery(document).ready(function() {

	//Datatables
	bindAdminBtnEvents();
	resetModerateTable() ;
	if(openingFilter != "")$('.filter'+openingFilter).trigger("click");

	//modal
	$(".moduleLabel").html("<i class='fa fa-cog'></i> Espace administrateur : Répertoire");

	//To dispkay abuse texts
	$('.modalAbuseContentsBtn').off().on("click",function (e) {
		console.log("modalAbuseContentsBtn click");
		var urlToSend = baseUrl+"/"+moduleId+"/news/moderate/";
		var id = $(this).data("id");
		var str =   '<li>Propos malveillants : XX</li>'+
		        	'<li>Incitation et glorification des conduites agressives : XX</li>'+
		        	'<li>Affichage de contenu gore et trash : XX</li>'+
		        	'<li>Contenu pornographique : XX</li>'+
		        	'<li>Liens fallacieux ou frauduleux : XX</li>'+
		        	'<li>Mention de source erronée : XX</li>'+
		        	'<li>Violations des droits d\'auteur : XX</li>';
		$.getJSON( urlToSend, { "id" : id,"consolidateModerateNews": "true"}, function(data) {
			$.each(data, function(key, val){
				$.each(val, function(reason, count){
					if(reason == 'text'){
						$('#modalText').html(count);
					}
					else{
						str += '<li>'+reason+' : '+count+'</li>';
					}
				});
			});

			//Display contents
			$('#modalAction').html(
				'<button type="button" class="btn btn-default declareAsAbuseModalBtn" data-id="'+id+'" data-value="true"><i class="fa fa-eye-slash text-red fa-1x" data-dismiss="modal"></i></button>'+
				'<button type="button" class="btn btn-default declareAsAuthorizeModalBtn" data-id="'+id+'" data-value="true" data-dismiss="modal"><i class="fa fa-eye text-green fa-1x" ></i></button>'
			);
			$('#listReason').html(str);
		});
		// $('#modalAbuseContents').html($(this).data("id"));
		$('#modalAbuseContents').modal('show');
	});

	$('#modalAbuseContents').on('show.bs.modal', function (event) {
		$(document).off("click", ".declareAsAbuseModalBtn");
		$(document).on("click", ".declareAsAbuseModalBtn", function(event){
			console.log("isAnAbuse",$(this).data("value"), $(this).data("id"));
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var urlToSend = baseUrl+"/"+moduleId+"/news/moderate/news/";
	        
	        var params = {};
	        params.saveModerate = true;
	        params.id = id;
	        params.isAnAbuse = $(this).data("value");
	       
			$.ajax({
		        type: "POST",
		        url: urlToSend,
		        data:params,
		        dataType : "json"
		    })
		    .success(function (data)
		    {
		        if ( data && data.result ) {
		        	toastr.info(data.msg);
		        	if(moderateTable.$('#'+id).length)moderateTable.fnDeleteRow( moderateTable.$('#'+id)[0]);
		        } else {
		           toastr.info("Erreur");
		        }
		    });
		    $('#modalAbuseContents').modal('hide');
		});

		$(document).off("click", ".declareAsAuthorizeModalBtn");
		$(document).on("click", ".declareAsAuthorizeModalBtn", function(event){
			console.log("isAnAbuse",$(this).data("value"), $(this).data("id"));
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var urlToSend = baseUrl+"/"+moduleId+"/news/moderate/news/";
	        
	        var params = {};
	        params.saveModerate = true;
	        params.id = id;
	        params.isAnAbuse = $(this).data("value");
	       
			$.ajax({
		        type: "POST",
		        url: urlToSend,
		        data:params,
		        dataType : "json"
		    })
		    .success(function (data)
		    {
		        if ( data && data.result ) {
		        	toastr.info(data.msg);
		        	if(moderateTable.$('#'+id).length)moderateTable.fnDeleteRow( moderateTable.$('#'+id)[0]);
		        } else {
		           toastr.info("Erreur");
		        }
		    });
		    $('#modalAbuseContents').modal('hide');
		});
	});
});	


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
				"aTargets" : [0],
				"visible" : false,
				"searchable" : true,
			}],
			"oLanguage" : {
				// "sLengthMenu" : "Show _MENU_ Rows",
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

function applyTypeFilter(str)
{
	if(!str){
		str = "";
		sep = "";
		$.each($("."+str), function() { 
			console.log("applyTypeFilter",$(this).data("id"));
			str += sep+$(this).data("id");
			sep = "|";
		});
	} else 
		clearAllFilters("");
	console.log("applyTypeFilter",str);
	moderateTable.DataTable().column( 0).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function clearAllFilters(str){ 
	moderateTable.DataTable().column( 0 ).search( str , true , false ).draw();
	moderateTable.DataTable().column( 4 ).search( str , true , false ).draw();
	moderateTable.DataTable().column( 5 ).search( str , true , false ).draw();
	$('#filterTag').html('');
	$('#filterScope').html('');
}

function clearTagFilters(){ 
	moderateTable.DataTable().column( 4 ).search( '' , true , false ).draw();
	$('#filterTag').html('');
}

function clearScopeFilters(){ 
	$('#filterScope').html('');
	moderateTable.DataTable().column( 5 ).search( '' , true , false ).draw();
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
	moderateTable.DataTable().column( 4 ).search( str, true , false ).draw();
	$('#filterTag').html('<a href="#" onclick="clearTagFilters()"><span class="label label-inverse">'+str+'</span></a>');
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
	$('#filterScope').html('<a href="#" onclick="clearScopeFilters()"><span class="label label-inverse">'+str+'</span></a>');
	moderateTable.DataTable().column( 5 ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function bindAdminBtnEvents(){
	console.log("bindAdminBtnEvents");
	console.log($(".declareAsAbuseBtn, .declareAsAuthorizeBtn"));
	<?php 
	/* **************************************
	* ADMIN STUFF
	***************************************** */
	if( Yii::app()->session["userIsAdmin"] ) {?>		

		$(".declareAsAbuseBtn, .declareAsAuthorizeBtn").off().on("click",function () 
		{
			console.log("declareAsAbuseBtn / declareAsAuthorizeBtn click");
			console.log("isAnAbuse",$(this).data("value"));
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var urlToSend = baseUrl+"/"+moduleId+"/news/moderate/news/";
	        
	        var params = {};
	        params.saveModerate = true;
	        params.id = id;
	        params.isAnAbuse = $(this).data("value");
	       
	        var message = "Cette actualité restera affichée";
	        if(params.isAnAbuse == true) message = "Cette actualité ne sera plus affichée";

	        bootbox.confirm(message,function(result){
				if (!result) {
					// btnClick.empty().html('<i class="fa fa-thumbs-down"></i>');
					return;
				}
				$.ajax({
			        type: "POST",
			        url: urlToSend,
			        data:params,
			        dataType : "json",
			        success:function (data){
				        if( data && data.result ) {
				        	toastr.info(data.msg);
				        	if(moderateTable.$('#'+id).length > 0)moderateTable.fnDeleteRow( moderateTable.$('#'+id)[0]);
				        	// btnClick.empty().html('<i class="fa fa-thumbs-up"></i>');
				        } else {
				           toastr.info("Erreur");
				        }
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


</script>