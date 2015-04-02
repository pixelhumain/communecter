<div style="display:none" id="genericGED">
	
	<div class="space20"></div>
	<div class="col-sm-10 col-sm-offset-1">
		
		<div class="space20"></div>

		<h3><?php echo Yii::t("misc","Manage Documents",null,Yii::app()->controller->module->id) ?></h3>
		<a href="javascript:;" class="btn btn-xs btn-info showDropZone"><i class="fa fa-download"></i></a>
		<!-- start: PAGE CONTENT -->
		<style type="text/css">
			.dropzoneInstance {
			    background: none repeat scroll 0 0 white;
			    border: 1px dashed rgba(0, 0, 0, 0.4);
			    min-height: 130px;
			}
		</style>

		<div class="row hide uploaderDiv">
			<div class="col-sm-12">
				<!-- start: DROPZONE PANEL -->
				<div class="panel panel-white">
					<div class="panel-heading">
						<h4 class="panel-title"><?php echo Yii::t("perimeter","Déposez vos",null,Yii::app()->controller->module->id) ?>  <span class="text-bold"><?php echo Yii::t("perimeter","fichiers",null,Yii::app()->controller->module->id) ?></span> (max. 2.0Mb))</h4>
					</div>
					<div class="panel-body uploadPanel">
						<?php echo Yii::t("perimeter","Catégories",null,Yii::app()->controller->module->id) ?> : <input type="text" id="genericDocCategory" name="genericDocCategory" type="hidden" style="width: 250px;">
						<br/><br/>
						<div class="dz-clickable dropzoneInstance" id="generic-dropzone"></div>
					</div>
				</div>
				<!-- end: DROPZONE PANEL -->
			</div>
		</div>
		<div class="space5"></div>
	
		<table class="table table-striped table-bordered table-hover genericFilesTable">

			<thead>
				<tr>
					<th><?php echo Yii::t("perimeter","Nom",null,Yii::app()->controller->module->id) ?></th>
					<th class="hidden-xs"><?php echo Yii::t("perimeter","Responsable",null,Yii::app()->controller->module->id) ?></th>
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
var docType = "ged";
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

var genericDocCategoryData = [];
var genericDocCategoryIndex = [];

function initDropZoneData(docs)
{
	console.log("initDropZoneData"); 
	$(".genericFiles").html("");
	/*if( $('.genericFilesTable').hasClass("dataTable") ){
		genericFilesTable.dataTable().fnDestroy();
		genericFilesTable = null;
	}*/
	
	genericDropzone = new Dropzone("#generic-dropzone", {
	  acceptedFiles: "image/*,"+
	  				 "application/pdf,"+
	  				 ".xls,.xlsx,.doc,.docx,ppt,.pptx",
	  url : baseUrl+"/templates/upload/dir/"+destinationFolder+"/collection/"+docType+"/input/file",
	  maxFilesize: 2.0, // MB
	  sending: function() { 
	  	$(".loader-subviews").show().css('opacity',1);
	  },
	  complete: function(response) { 
	  	//console.log(file.name); 
	  	$(".loader-subviews").hide();
	  	if(response.xhr)
	  	{
		  	docObj = JSON.parse(response.xhr.responseText);
		  	console.log(docObj.result); 
		  	
		  	var doc = { 
		  		"id":"",
		  		"type":docType,
		  		"moduleId":destinationFolder,

		  		"author" : '<?php echo (isset(Yii::app()->session["userId"])) ? Yii::app()->session["userId"] : "unknown"?>'  , 
		  		"name" : docObj.name , 
		  		"date" : new Date() , 
		  		"size" : docObj.size ,
		  		"category" : $("#genericDocCategory").val()
		  	};
		  	console.dir(doc); 
		  	if($.inArray( $("#genericDocCategory").val() , genericDocCategoryIndex ) < 0){
		  		genericDocCategoryIndex.push($("#genericDocCategory").val());
				genericDocCategoryData.push( { id:$("#genericDocCategory").val() , text:$("#genericDocCategory").val() } );
				$('#genericDocCategory').select2({
				    createSearchChoice : function(term, data) { 
				    	return {id:term, text:term};
				    },
				    data : genericDocCategoryData
				});
			}

		  	/*if( saveDoc != undefined && typeof saveDoc == "function" )
				saveDoc(doc);
		  	else */
		  		genericSaveDoc(doc);
		  	
		  	addFileLine(".genericFiles",doc,$(".genericFiles").children('tr').length+1);
			genericDropzone.removeAllFiles(true);
		}
	  },
	  error: function(response) 
	  { 
	  	toastr.error("Something went wrong!!"); 
	  }
	});

	if(docs && typeof docs == "object" && docs.length > 0)
	{
		genericDocCategoryData = [];
		$.each( docs ,function(i,docObj)
		{
			addFileLine(".genericFiles",docObj,i);
			if($.inArray( docObj.category , genericDocCategoryIndex ) < 0){
				genericDocCategoryData.push( { id:docObj.category , text:docObj.category } );
				genericDocCategoryIndex.push( docObj.category );
			}
		});
	}

	
	/*genericFilesTable = $('.genericFilesTable').dataTable({
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
		});*/
	$('#genericDocCategory').select2({
	    createSearchChoice : function(term, data) { 
	    	return {id:term, text:term};
	    },
	    data : genericDocCategoryData
	});
}

function addFileLine(id,doc,pos)
{
	console.log("addFileLine",doc); 
	date = new Date(doc.date);
	if(doc.name && doc.name.indexOf(".pdf") >= 0)
		link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+docType+'/'+doc.name+'" target="_blank"><i class="fa fa-file-pdf-o fa-3x icon-big"></i></a>';	
	else if((doc.name && (doc.name.indexOf(".jpg") >= 0 || doc.name.indexOf(".jpeg") >= 0 || doc.name.indexOf(".gif") >= 0 || doc.name.indexOf(".png") >= 0  )))
		link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+docType+'/'+doc.name+'" data-lightbox="docs"><img width="150" class="img-responsive" src="'+baseUrl+'/upload/'+destinationFolder+'/'+docType+'/'+doc.name+'"/></a>';	
	else
		link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+docType+'/'+doc.name+'" target="_blank"><i class="fa fa-file fa-3x icon-big"></i></a>';	
	category = (doc.category) ? doc.category : "Unknown";
	authorName = "Unknown";
	if(docType == "projects") 
		authorName = userNamesByGroupId[doc.author].firstName+' '+userNamesByGroupId[doc.author].lastName;
	else if(docType == "ged")  
		authorName = doc.authorName;
	lineHTML = '<tr class="file'+pos+'">'+
					'<td class="center">'+link+'</td>'+
					'<td class="hidden-xs">'+authorName+'</td>'+
					'<td>'+date.getDay()+"/"+(parseInt(date.getMonth())+1)+"/"+date.getFullYear()+" "+date.getHours()+":"+date.getMinutes()+'</td>'+
					'<td class="hidden-xs">'+doc.size+'</td>'+
					'<td class="center hidden-xs"><span class="label label-danger">'+category+'</span></td>'+
					'<td class="center">'+
						'<a href="#" class="btn btn-xs btn-red removeFileLine" data-pos="'+pos+'" ><i class="fa fa-times fa fa-white"></i></a>'+
					'</td>'+
				'</tr>';
	$(id).prepend(lineHTML);
	bindDocsEvents();
}

function bindDocsEvents()
{
	$(".removeFileLine").off().on( "click", function()
	{
		if( delDoc != undefined && typeof delDoc == "function" )
			delDoc($(this).data("pos"));
	  	else
	  		toastr.error('no delete method available!');
	});
}

function genericSaveDoc(doc)
{ 
	console.log("genericSaveDoc",doc);
	$.ajax({
	  type: "POST",
	  url: baseUrl+"/"+moduleId+"/ressource/save",
	  data: doc,
      dataType: "json"
	}).done( function(data){
        
        if( afterDynBuildSave && typeof afterDynBuildSave == "function" )
            afterDynBuildSave(data.map,data.id);
        console.info('saved successfully !');

	});
}
</script>