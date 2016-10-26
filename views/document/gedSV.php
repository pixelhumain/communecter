<?php
$cssAndScriptFiles = array(
	//dropzone
	'/plugins/dropzone/downloads/css/ph.css',
	'/plugins/dropzone/downloads/dropzone.min.js',
	//lightbox
	'/plugins/lightbox2/css/lightbox.css',
	'/plugins/lightbox2/js/lightbox.min.js'
);

HtmlHelper::registerCssAndScriptsFiles( $cssAndScriptFiles ,Yii::app()->theme->baseUrl."/assets");
?>
<div style="display:none" id="genericGED">

	<div class="space20"></div>
	<div class="col-sm-10 col-sm-offset-1">

		<div class="space20"></div>

		<h3><?php echo Yii::t("misc","Manage Documents",null,Yii::app()->controller->module->id) ?></h3>
		<!-- start: PAGE CONTENT -->
		<style type="text/css">
			.dropzoneInstance {
			    background: none repeat scroll 0 0 white;
			    border: 1px dashed rgba(0, 0, 0, 0.4);
			    min-height: 130px;
			}
		</style>

		<div class="row  uploaderDiv">
			<div class="col-sm-12">
				<!-- start: DROPZONE PANEL -->
				<div class="panel panel-white">
					<div class="panel-heading">
						<h4 class="panel-title">Add <span class="text-bold">Files</span></h4>
					</div>
					<div class="panel-body uploadPanel">
						<?php echo Yii::t("perimeter","Catégories",null,Yii::app()->controller->module->id) ?> : <input type="text" id="genericDocCategory" name="genericDocCategory" type="hidden" style="width: 250px;">
						<br/><br/>
						<div class="dz-clickable dropzoneInstance center" id="generic-dropzone">
							<span class="text-bold text-large uploadText">
								<br/>Click or Drag over
								<br/>max. 2.0Mb
								<span class="text-small">
									<br/>jpg, jpeg, png, gif
									<br/>pdf, xls, xlsx, doc, docx, ppt, pptx, odt
								</span>
							</span>
						</div>
					</div>
				</div>
				<!-- end: DROPZONE PANEL -->
			</div>
		</div>
		<div class="space5"></div>

		<table class="table table-striped table-bordered table-hover genericFilesTable">

			<thead>
				<tr>
					<th>Doc</th>
					<th class="hidden-xs center">Date</th>
					<th class="hidden-xs"><?php echo Yii::t("perimeter","Taille",null,Yii::app()->controller->module->id) ?></th>
					<th><?php echo Yii::t("perimeter","Categories",null,Yii::app()->controller->module->id) ?></th>
					<th class="hidden-xs center">Actions</th>
				</tr>
			</thead>

			<tbody class="genericFiles"></tbody>
		</table>

	</div>

</div>
<script type="text/javascript">
var genericDropzone = null;
var docType = "<?php echo PHType::TYPE_CITOYEN?>";
var folder = "<?php echo PHType::TYPE_CITOYEN ?>";
var ownerId = '<?php echo (isset(Yii::app()->session["userId"])) ? Yii::app()->session["userId"] : "unknown"?>';
var destinationFolder = moduleId;
jQuery(document).ready(function()
{

	$(".showDropZone").off().on( "click", function()
	{
		$(this).addClass("hide");
		$(".uploaderDiv").removeClass('hide').addClass('animated bounceIn');
	});
	$(".new-file").unbind("click").click(function()
	{
	    $.subview({
	        content : "#genericGED",
	        onShow : function() {
	        	initDropZoneData();
	        }
	    });
	});
});

var genericDocCategoryData = <?php echo isset($categories) ? json_encode($categories) : '""' ?>;
genericDocCategoryData = genericDocCategoryData.sort();

function initDropZoneData(docs)
{
	console.log("initDropZoneData");
	$(".genericFiles").html("");

	if(!genericDropzone){
		genericDropzone = new Dropzone("#generic-dropzone", {
		  acceptedFiles: "image/*,"+
		  				 "application/pdf,"+
		  				 ".xls,.xlsx,.doc,.docx,ppt,.pptx, .odt",
		  url : baseUrl+"/"+moduleId+"/document/upload/dir/"+destinationFolder+"/folder/"+folder+"/ownerId/"+ownerId+"/input/file",
		  maxFilesize: 2.0, // MB
		  sending: function() {
		  	$(".uploadText").hide();
		  	$.blockUI({
  				message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
  	            '<blockquote>'+
  	              "<p>Rien n'est plus proche du vrai que le faux</p>"+
  	              '<cite title="Einstein">Einstein</cite>'+
  	            '</blockquote> '
  			});
		  },
		  complete: function(response) {
		  	//console.log(file.name);
		  	$(".loader-subviews").hide();
		  	var category = $("#genericDocCategory").val();
		  	if(response.xhr)
		  	{
		  		docObj = JSON.parse(response.xhr.responseText);
		  		if( docObj.result ){
				  	$.unblockUI();
				  	console.log(docObj.result);

				  	var doc = {
				  		"id":ownerId,
				  		"type":docType,
				  		"folder":folder+"/"+ownerId,
				  		"moduleId":destinationFolder,
				  		"author" : '<?php echo (isset(Yii::app()->session["userId"])) ? Yii::app()->session["userId"] : "unknown"?>'  ,
				  		"name" : docObj.name ,
				  		"date" : new Date() ,
				  		"size" : docObj.size ,
				  		"category" : category
				  	};
				  	console.dir(doc);

				  	/*if( saveDoc != undefined && typeof saveDoc == "function" )
						saveDoc(doc);
				  	else */
				  		genericSaveDoc(doc , function(data){
				  			if (genericDocCategoryData.indexOf(category) < 0) {
				  				genericDocCategoryData.push(category);
				  			}
				  			doc._id = data.id;
							genericFilesTable.DataTable().destroy();
						  	addFileLine(".genericFiles",doc,data.id['$id']);
							genericDropzone.removeAllFiles(true);
							$(".uploadText").show();
							resetGenericFilesTable();
							if(afterDocSave && $.isFunction(afterDocSave))
								afterDocSave(doc);
						});
			  	} else {
			  		toastr.error('Something went wrong!');
			  		$.unblockUI();
			  	}
			}
		  },
		  error: function(response)
		  {
		  	toastr.error("Something went wrong!!");
		  	genericDropzone.removeAllFiles(true);
		  }
		});
	}

	resetGenericFilesTable();

	if( !$('.genericFilesTable').hasClass("genericFilesTable") ){
		genericFilesTable = $('.genericFilesTable').dataTable({
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
				"bDestroy": true
			});
	} else
		genericFilesTable.DataTable().draw();

	//Init Select2 of Categories
	$('#genericDocCategory').select2({
		tags : genericDocCategoryData,
		maximumSelectionSize: 1});
	$('#genericDocCategory').select2("val","");
}

function resetGenericFilesTable()
{
	console.log("resetGenericFilesTable");

	if( !$('.genericFilesTable').hasClass("dataTable") ){
		genericFilesTable = $('.genericFilesTable').dataTable({
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
	} else {
		if( $(".projectFiles").children('tr').length > 0 )
		{
			genericFilesTable.dataTable().fnDestroy();
			genericFilesTable.dataTable().fnDraw();
		} else {
			console.log(" projectFilesTable fnClearTable");
			genericFilesTable.dataTable().fnClearTable();
		}
	}
}

function addFileLine(id,doc,docId)
{
	folderPath = folder+"/"+ownerId;
	console.log("addFileLine",'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name);
	console.log("addFileLine",doc);
	date = new Date(doc.date);
	if(doc.name && doc.name.indexOf(".pdf") >= 0)
		link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" target="_blank"><i class="fa fa-file-pdf-o fa-3x icon-big"></i></a>';
	else if((doc.name && (doc.name.indexOf(".jpg") >= 0 || doc.name.indexOf(".jpeg") >= 0 || doc.name.indexOf(".gif") >= 0 || doc.name.indexOf(".png") >= 0  )))
		link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" data-lightbox="docs">'+
					'<img width="150" class="img-responsive" src="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'"/>'+
				'</a>';
	else
		link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" target="_blank"><i class="fa fa-file fa-3x icon-big"></i></a>';
	category = (doc.category) ? doc.category : "Unknown";
	lineHTML = '<tr class="file'+docId+'">'+
					'<td class="center">'+link+'</td>'+
					'<td class="hidden-xs">'+date.getDay()+"/"+(parseInt(date.getMonth())+1)+"/"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+'</td>'+
					'<td class="hidden-xs">'+doc.size+'</td>'+
					'<td class="center hidden-xs"><span class="label label-danger">'+category+'</span></td>'+
					'<td class="center ">'+
						'<a href="#" class="btn btn-xs btn-red removeFileLine" data-pos="'+docId+'" ><i class="fa fa-times fa fa-white"></i></a>'+
					'</td>'+
				'</tr>';
	$(id).prepend(lineHTML);

	$(".removeFileLine").off().on( "click", function()
	{
		if( "undefined" != typeof delDoc ){
			delDoc($(this).data("pos"));
		}
	  	else
	  		toastr.error('no delete method available!');
	});
}

function genericSaveDoc(doc, callback)
{
	console.log("genericSaveDoc",doc);
	$.ajax({
	  type: "POST",
	  url: baseUrl+"/"+moduleId+"/document/save",
	  data: doc,
      dataType: "json"
	}).done( function(data){
        	if(data.result){
		        toastr.success(data.msg);
			callback(data);
		} else
			toastr.error(data.msg);

	});
}

</script>
