
<?php
$cs = Yii::app()->getClientScript();

Menu::moderate();
$this->renderPartial('../default/panels/toolbar'); 

echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/jquery.dataTables.min.1.10.4.js');
echo CHtml::cssFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/css/DT_bootstrap.css');
echo CHtml::scriptFile(Yii::app()->request->baseUrl. '/plugins/DataTables/media/js/DT_bootstrap.js');

/* ************ PARAMS DISPLAY ********************** */
$typeParams['city'] = array("libelle" => "Citoyens","class" => "Person", "count" => 0, "tri" => 1);
$typeParams['projects'] = array("libelle" => "Projet","class" => "Project", "count" => 0, "tri" => 1);
$typeParams['events'] = array("libelle" => "Evénement","class" => "Event", "count" => 0, "tri" => 1);
$typeParams['organizations'] = array("libelle" => "Organisation","class" => "Organization", "count" => 0, "tri" => 1);
$typeParams['citoyens'] = array("libelle" => "Citoyens", "class" => "Person", "count" => 0, "tri" => 2);
$typeParams['comments'] = array("libelle" => "Commentaire", "class" => "Person", "count" => 0, "tri" => 3);
$typeParams['news'] = array("libelle" => "News", "class" => "News", "count" => 0, "tri" => 1);

$colCorrespondance['tri'] = 0;
$colCorrespondance['type'] = 1;
$colCorrespondance['propriétaire'] = 2;
$colCorrespondance['contenu'] = 3;
$colCorrespondance['avis'] = 4;
$colCorrespondance['tags'] = 5;
$colCorrespondance['scope'] = 6;
$colCorrespondance['actions'] = 7;


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
if(isset($news) && is_array($news)) 
{ 
	foreach ($news as $i => $e) 
	{ 

		$e['name'] = "";
		if(isset($e['target']['id'])){
			// if($e['target']['type'] == 'citoyens1'){
			// 	$tmp = $typeParams[$e['target']['type']]['class']::getSimpleCityById($typeParams[$e['target']['type']]['class']::getIdByInsee($e['_id']));
			// }
			// else{
			$tmp = $typeParams[$e['target']['type']]['class']::getById($e['target']['id']);
			// }
			$e['name'] = $tmp['name'];
		}
		$content .= buildNewsLine($e, News::CONTROLLER, $e['target']['type'], $typeParams[$e['target']['type']]['class']::ICON, $this->module->id,$tags,$scopes,$typeParams);
	};
}
/* ************ COMMENTS ********************** */
if(isset($comments) && is_array($comments))
{ 
	foreach ($comments as $c) 
	{ 
		$content .= buildCommentsLine($c, Comment::COLLECTION, $typeParams);
	};
}


					
?>
<!-- ************ DATATABLES ********************** -->
<div class="panel panel-white" style="margin-top:40px">
	<div class="panel-heading border-light">
		<h4 class="panel-title">
		<i class="fa fa-globe fa-2x text-green"></i>
		<?php foreach($typeParams as $type => $params){ 
			if($params['count'] > 0){?>
				<a href="javascript:;" onclick="applyStateFilter('<?php echo $type?>')" class="filter<?php echo $type?> btn btn-xs btn-default"> <?php echo $params['libelle'] ?><span class="badge badge-warning badge<?php echo $type?>"> <?php echo $params['count'] ?></span></a>
			<?php } ?>
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
						<th>Tri</th>
						<th>Type</th>
						<th>Propriétaire</th>
						<th>Contenu</th>
						<th>Avis</th>
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

<!-- ************ MODAL ********************** -->
<div class="modal fade" tabindex="-1" role="dialog" id="modalAbuseContents">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-title" id="modalText">Contenu de la news</div>
      </div>
      <div class="modal-body">
        <ul id='listReason'></ul>
      </div>
      <div class="modal-body">
      	<center><button id="toggle-detail" class="btn btn-info">+ de détail</button></center><br>
        <ul id='listDetail'></ul>
      </div>
      <div class="modal-footer">
      	<div id="modalAction" style="display:inline"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php 
function buildNewsLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes, &$typeParams ){
		
	//CountByType
	if(isset($typeParams[$type]['count'])) $typeParams[$type]['count'] += 1;


	if(!isset( $e['_id'] ) || !isset( $e["text"]) || $e["text"] == "" )
		return;
	$actions = "";
	$classes = "";
	$id = @$e['_id'];


	/*	
	* TYPE + ICON
	***************************************** */
	$strHTML = '<tr id="'.(string)$id.'">'.
		'<td>'.$typeParams[$type]['tri'].'</td>
		<td>'.$type.'</td>
		<td class="Line'.$classes.'">'.
			'<a target="_blank" href="'.Yii::app()->createUrl('/'.$moduleId.'/#news.index.type.'.$type.'.id.'.$e['target']['id']).'">';
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
	$strHTML .= '<td>'.((isset($e["text"]))? substr($e["text"],0,50) :"").'</td>';

	/* **************************************
	* AVIS
	*****************************************/
	$strHTML .= '<td>
		<i class="fa fa-thumbs-up text-green">'.((isset($e['voteUpCount']) ) ? $e['voteUpCount'] : '0').'</i>&nbsp; 
		<i class="fa fa-thumbs-down text-orange">'.((isset($e['voteDownCount']) ) ? $e['voteDownCount'] : '0').'</i>&nbsp;
		<i class="fa fa-flag text-red modalAbuseContentsBtn" style="cursor:pointer" data-context="News" data-id="'.$e['_id'].'">'.((isset($e['reportAbuseCount']) ) ? $e['reportAbuseCount'] : '0').'</i>&nbsp;
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
	$strHTML .= '<td>';
	if(isset($e['scope']['cities']))foreach ($e['scope']['cities'] as $value) {
		if(is_array($value))foreach($value as $ids => $city){
			if(isset($scopes[$ids])){
				$strHTML .= ' <a href="javascript::;" onclick="applyScopeFilter('.$city.')"><span class="label label-inverse">'.$city.'</span></a>';
				if( !in_array($city, $scopes[$ids]) ) 
					array_push($scopes[$ids], $city );
			}
		}
	}
	else{
		$strHTML .= ' <a href="javascript::;" onclick="applyScopeFilter(\''.trim($e['scope']['type']).'\')"><span class="label label-inverse">'.$e['scope']['type'].'</span></a>';
	}
	$strHTML .= '</td>';

	/* **************************************
	* ACTIONS
	***************************************** */
	$strHTML .= '<td class="center">';
	if(Yii::app()->session["userIsAdmin"] ) 
		$strHTML .= '<a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" data-value="true"  class="margin-right-5 declareAsAuthorizeBtn"><i class="fa fa-eye-slash text-red fa-2x"></i></a>
					<a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 declareAsAbuseBtn" data-value="false"><i class="fa fa-eye text-green fa-2x"></i></a>';
	$strHTML .= '</td>';
		
	$strHTML .= '</tr>';
	return $strHTML;
}


function buildCommentsLine($c, $type, &$typeParams){
		
	//CountByType
	if(isset($typeParams[$type]['count'])) $typeParams[$type]['count'] += 1;


	if(!isset( $c['_id'] ) || !isset( $c["text"]) || $c["text"] == "" )
		return;
	$actions = "";
	$classes = "";
	$id = @$c['_id'];
	$moduleId = $strHTML =  "";

	/* *************************************
	* TYPE + ICON
	***************************************** */
	$strHTML = '<tr id="'.(string)$id.'">'.
	'<td>'.$typeParams[$type]['tri'].'</td>
	<td>'.$type.'</td>
	<td class="Line'.$classes.'">'.
		'<a class="linkComment" data-contextid="'.@$c['contextId'].'">';
				$strHTML .= '<i class="fa fa-comment fa-2x"></i> Commentaire sur '.@$c['contextType'];
		$strHTML .= '</a>';
	$strHTML .= '<span></span></td>';
	
	/* **************************************
	* TEXT
	***************************************** */
	$strHTML .= '<td>'.((isset($c["text"]))? $c["text"]:"").'</td>';

	/* **************************************
	* Avis
	***************************************** /
	*/
	$strHTML .= '<td>
		<i class="fa fa-thumbs-up text-green">'.((isset($c['voteUpCount']) ) ? $c['voteUpCount'] : '0').'</i>&nbsp; 
		<i class="fa fa-thumbs-down text-orange">'.((isset($c['voteDownCount']) ) ? $c['voteDownCount'] : '0').'</i>&nbsp;
		<i class="fa fa-flag text-red modalAbuseContentsBtn" style="cursor:pointer" data-context="Comment" data-id="'.$c['_id'].'">'.((isset($c['reportAbuseCount']) ) ? $c['reportAbuseCount'] : '0').'</i>&nbsp;
	</td>';
	$strHTML .= '<td> - </td>';

	
	/* **************************************
	* TAGS
	***************************************** */
	$strHTML .= '<td>';
		if(isset($c["contextType"])){
			$strHTML .= ' <a href="#" onclick="applyScopeFilter(\''.$c["contextType"].'\')"><span class="label label-inverse">'.$c["contextType"].'</span></a>';
		}
	$strHTML .= '</td>';
	// $strHTML .= '<td></td>';

	/* **************************************
	* SCOPES
	***************************************** */
	// $strHTML .= '<td>';
	// foreach ($scopes as $ids => $value) {
	// 	if( isset($c["scope"]) && isset( $c["scope"]['cities']) ){
	// 		foreach($c["scope"]['cities'] as $city){
	// 			if(isset($city[$ids])){
	// 				$strHTML .= ' <a href="#" onclick="applyScopeFilter('.$city[$ids].')"><span class="label label-inverse">'.$city[$ids].'</span></a>';
	// 				if( !in_array($city[$ids], $scopes[$ids]) ) 
	// 					array_push($scopes[$ids], $city[$ids] );
	// 			}
	// 		}
	// 	}
	// }
	// $strHTML .= '</td>';

	/* **************************************
	* ACTIONS
	***************************************** */
	$strHTML .= '<td class="center">';
	if(Yii::app()->session["userIsAdmin"] ) 
		$strHTML .= '<a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" data-value="true"  class="margin-right-5 declareCommentAsAuthorizeBtn"><i class="fa fa-eye-slash text-red fa-2x"></i></a>
					<a href="javascript:;" data-id="'.$id.'" data-type="'.$type.'" class="margin-right-5 declareCommentAsAbuseBtn" data-value="false"><i class="fa fa-eye text-green fa-2x"></i></a>';
	$strHTML .= '</td>';
		
	$strHTML .= '</tr>';
	return $strHTML;
}

?>

<script type="text/javascript">
	
var openingFilter = "<?php echo ( isset($_GET['type']) ) ? $_GET['type'] : '' ?>";
var moderateTable = null;

jQuery(document).ready(function() {

	//Datatables
	bindAdminBtnEvents();
	resetModerateTable() ;
	if(openingFilter != "")$('.filter'+openingFilter).trigger("click");

	//Title
	setTitle("Espace administrateur : Modération","cog");
	//Modal configuration
	bindModalEvent();

	$(".linkComment").off().on("click",function () {
		console.log("linkComment click "+$(this).data("contextid"));
	    var contextId = $(this).data("contextid");
	    var urlToSend = baseUrl+'/'+moduleId+"/comment/index/type/news/id/"+contextId;
		$.blockUI({
			message : '<div><a href="javascript:$.unblockUI();"><span class="pull-right text-dark"><i class="fa fa-share-alt"></span></a>'+
							'<div class="commentContent"></div></div>', 
			onOverlayClick: $.unblockUI,
			css: {"text-align": "left", "cursor":"default", "width":"50%", "left":"25%" }
		});

		getAjax('.commentContent',urlToSend,function(){

			$('.bar_tools_post').hide();
			$('.saySomething').hide();
			

		},"html");
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
				"aTargets" : [<?php echo $colCorrespondance['tri']; ?>,<?php echo $colCorrespondance['type']; ?>],
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
			"aaSorting" : [[<?php echo $colCorrespondance['tri']; ?>, 'asc']],
			"aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "Tout"] // change per page values here
			],
			// set the initial value
			"iDisplayLength" : -1,
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
	moderateTable.DataTable().column( <?php echo $colCorrespondance['type']; ?> ).search(str , true , false).draw();
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
	moderateTable.DataTable().column( <?php echo $colCorrespondance['type']; ?> ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function clearAllFilters(str){ 
	moderateTable.DataTable().column( <?php echo $colCorrespondance['type']; ?> ).search( str , true , false ).draw();
	moderateTable.DataTable().column( <?php echo $colCorrespondance['tags']; ?> ).search( str , true , false ).draw();
	moderateTable.DataTable().column( <?php echo $colCorrespondance['scope']; ?> ).search( str , true , false ).draw();
	$('#filterTag').html('');
	$('#filterScope').html('');
}

function clearTagFilters(){ 
	moderateTable.DataTable().column( <?php echo $colCorrespondance['tags']; ?>  ).search( '' , true , false ).draw();
	$('#filterTag').html('');
}

function clearScopeFilters(){ 
	$('#filterScope').html('');
	moderateTable.DataTable().column( <?php echo $colCorrespondance['scope']; ?>  ).search( '' , true , false ).draw();
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
		clearTagFilters();
	console.log("applyTagFilter",str);
	moderateTable.DataTable().column( <?php echo $colCorrespondance['tags']; ?> ).search( str, true , false ).draw();
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
		clearScopeFilters();
	console.log("applyScopeFilter",str);
	$('#filterScope').html('<a href="#" onclick="clearScopeFilters()"><span class="label label-inverse">'+str+'</span></a>');
	moderateTable.DataTable().column( <?php echo $colCorrespondance['scope']; ?> ).search( str , true , false ).draw();
	return $('.directoryLines tr').length;
}

function bindAdminBtnEvents(){
	console.log("bindAdminBtnEvents");
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
	        params.subAction = "saveModerate";
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
				        	if(moderateTable.$('#'+id).length > 0){

				        		//update the count
				        		var countToChange = moderateTable.fnGetData('#'+id)[1];
				        		$('.badge'+countToChange).html(($('.badge'+countToChange).text())-1);

				        		//Delete the row
				        		moderateTable.fnDeleteRow(moderateTable.$('#'+id)[0]);
				        	}
							
				        } else {
				           toastr.info("Erreur");
				        }
				    }
			    });

			});

		});

		$(".declareCommentAsAbuseBtn, .declareCommentAsAuthorizeBtn").off().on("click",function () 
		{
			console.log("declareCommentAsAbuseBtn / declareCommentAsAuthorizeBtn click");
			console.log("isAnAbuse",$(this).data("value"));
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var urlToSend = baseUrl+"/"+moduleId+"/comment/moderate/";
	        
	        var params = {};
	        params.subAction = "saveModerate";
	        params.id = id;
	        params.isAnAbuse = $(this).data("value");
	       
	        var message = "Ce commentaire restera affiché";
	        if(params.isAnAbuse == true) message = "Ce commentaire ne sera plus affiché";

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
				        	if(moderateTable.$('#'+id).length > 0){

				        		//update the count
				        		var countToChange = moderateTable.fnGetData('#'+id)[1];
				        		$('.badge'+countToChange).html(($('.badge'+countToChange).text())-1);

				        		//Delete the row
				        		moderateTable.fnDeleteRow(moderateTable.$('#'+id)[0]);
				        	}
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

function bindModalEvent(){
	//To dispkay abuse texts
	$('.modalAbuseContentsBtn').off().on("click",function (e) {
		console.log("modalAbuseContentsBtn click");
		var context = $(this).data("context");
		var urlToSend = baseUrl+"/"+moduleId+"/"+context+"/moderate/";
		var id = $(this).data("id");
		var subAction = "consolidateModerate"+context;

		var strReason =   '<li>Propos malveillants : XX</li>'+
		        	'<li>Incitation et glorification des conduites agressives : XX</li>'+
		        	'<li>Affichage de contenu gore et trash : XX</li>'+
		        	'<li>Contenu pornographique : XX</li>'+
		        	'<li>Liens fallacieux ou frauduleux : XX</li>'+
		        	'<li>Mention de source erronée : XX</li>'+
		        	'<li>Violations des droits d\'auteur : XX</li>';
		var strReason = "";
		var strDetail = "";
		$.getJSON( urlToSend, { "id" : id, "subAction" : subAction}, function(data) {
			$('#modalText').html(data.result.text);
			$.each(data.result.reason, function(reason, count){
				strReason += '<li>'+reason+' : '+count+'</li>';
			});
			$.each(data.result.detail, function(user, report){
				strDetail += '<li>'+report+'</li>';
			});

			//Display lists
			$('#listReason').html(strReason);
			$('#listDetail').html(strDetail);
		});

		//Display buttons
		$('#modalAction').html(
			'<button type="button" class="btn btn-success declareAsAuthorizeModalBtn" data-context="'+context+'" data-id="'+id+'" data-value="true" data-dismiss="modal"><i class="fa fa-eye text-white fa-1x" ></i>&nbsp;Laisser publié</button>'+
			'<button type="button" class="btn btn-danger declareAsAbuseModalBtn" data-context="'+context+'" data-id="'+id+'" data-value="true"><i class="fa fa-eye-slash text-white fa-1x" data-dismiss="modal"></i>&nbsp;C\'est un abus</button>'
			
		);


		$('#modalAbuseContents').modal('show');
	});

	$('#modalAbuseContents').on('show.bs.modal', function (event) {

		$('#listDetail').hide();

		$(document).off("click", ".declareAsAbuseModalBtn declareAsAuthorizeModalBtn");
		$(document).on("click", ".declareAsAbuseModalBtn, .declareAsAuthorizeModalBtn", function(event){
			console.log("isAnAbuse",$(this).data("value"), $(this).data("id"));
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var context = $(this).data("context");
	        var urlToSend = baseUrl+"/"+moduleId+"/"+context+"/moderate/";
	        
	        var params = {};
	        params.subAction = "saveModerate";
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
		        	if(moderateTable.$('#'+id).length > 0){

		        		//update the count
		        		var countToChange = moderateTable.fnGetData('#'+id)[1];
		        		$('.badge'+countToChange).html(($('.badge'+countToChange).text())-1);

		        		//Delete the row
		        		moderateTable.fnDeleteRow(moderateTable.$('#'+id)[0]);
		        	}
		        } else {
		           toastr.info("Erreur");
		        }
		    });
		    $('#modalAbuseContents').modal('hide');
		});

		$(document).on("click", "#toggle-detail", function(event){
			$('#listDetail').toggle();
			if($("#listDetail").is(":visible")){
				$("#toggle-detail").html('- de détail');
			}
			else{
				$("#toggle-detail").html('+ de détail');
			}
			
		});

	});
}


</script>