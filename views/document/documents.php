<?php 
$this->renderPartial('gedSV', array("categories" => $categories));
?>
<div class="row">

  <div class="col-xs-12 docsPanel">
    <div class="panel panel-white">
    	<div class="panel-heading border-light">
			<h4 class="panel-title">Documents</h4>
		</div>
		<div class="panel-tools">
			<?php if(isset($id) 
					&& isset(Yii::app()->session["userId"]) 
					&& Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $id) 
					&& !isset($organization["disabled"])){ ?>
				<a href="#genericGED" class="new-file btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add a File"><i class="fa fa-plus"></i></a>
			<?php }; ?>
		</div>
		
      <div class="panel-body no-padding">
        <div class="panel-scroll height-230">
          <table class="table table-striped table-hover">
            <tbody class="docsList">
            	<?php 
            	if(!empty($documents)){
	            	foreach ($documents as $doc) { ?>
	              	<tr class="file<?php echo $doc['_id'] ?>">
			                <td class="center">
			                	<?php
			                	$this->widget('ext.widgets.documentLink.DocumentLinkWidget', array(
	                							"document" => $doc,
	                							"text" => ""));
								?>
			                </td>
			                <td class="center hidden-xs"><?php echo $doc['name'] ?></td>
			                <?php $category = ( !empty ( $doc['category'] ) ) ? '<span class="label label-danger">'.$doc['category'].'</span>' : ''; ?>
			                <td  class="center hidden-xs"><?php echo $category ?> </td>
			                <td class="hidden-xs"><?php echo $doc['size'] ?> </td>
			                <td> 
			                	<a class="btn btn-xs delDocBtn tooltips" data-id="<?php echo (string)$doc['_id'] ?>" href="javascript:;" data-placement="top" data-original-title="Delete this File">
    								<i class="fa fa-times text-red"></i>
    							</a>
    						</td>
		               </tr>
	              <?php
		              } 
		          } else {?>
			          <blockquote class="padding-10 emptyDocsInfo">
			          	Share your Organizations Documents Simply
			          </blockquote>
		          <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</div>

<script type="text/javascript">

var documents = <?php echo (!empty($documents)) ? json_encode($documents) : "{}" ?>;
jQuery(document).ready(function() {
	/*$(".docsPanel").removeClass('hide').addClass("animated bounceIn").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated bounceIn");
	});*/
	docType = "<?php echo Organization::COLLECTION?>";
	folder = "<?php echo Organization::COLLECTION ?>";
	ownerId = "<?php echo $_GET['id'] ?>";
	bindDocsEvents ();
	
});

	function bindDocsEvents () { 
		if($(".tooltips").length) {
	 		$('.tooltips').tooltip();
	 	}
	 	$(".delDocBtn").off().on("click",function() { 
	 		delDoc( $(this).data('id') );
	 	});
	}
	function afterDocSave(doc){
		folderPath = folder+"/"+ownerId;
		console.log("afterDocSave",'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name); 
		console.log("addFileLine",doc); 
		date = new Date(doc.date);

		name = doc.name.toLowerCase();
		console.log("name",name); 
		if(doc.name && name.indexOf(".pdf") >= 0)
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" target="_blank"><i class="fa fa-file-pdf-o fa-3x icon-big"></i></a>';	
		else if( doc.name && ( name.indexOf(".jpg") >= 0 || name.indexOf(".jpeg") >= 0 || name.indexOf(".gif") >= 0 || name.indexOf(".png") >= 0  ))
			link =  '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" data-lightbox="docs">'+
						'<img width="50" src="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'"/>'+
					'</a>';	
		else
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" target="_blank"><i class="fa fa-file fa-3x icon-big"></i></a>';	

		category = (doc.category) ? '<span class="label label-danger">'+doc.category+'</span>' : "";
		docId = (doc._id['$id']) ? doc._id['$id'] : doc._id; 
		lineHTML = '<tr class="file'+docId+'">'+
						'<td class="center">'+link+'</td>'+
						'<td class="center hidden-xs">'+doc.name+'</td>'+
						'<td class="center hidden-xs">'+category+'</td>'+
						'<td class="hidden-xs">'+doc.size+'</td>'+
						'<td>'+
							'<a class="btn btn-xs delDocBtn" data-id="'+docId+'" href="javascript:;" >'+
    								'<i class="fa fa-times text-red"></i>'+
    							'</a>'+
						'</td>'+
					'</tr>';

		if( $(".docsList tr").length == 0 )
			$(".emptyDocsInfo").remove();

		$(".docsList").prepend(lineHTML);
		documents[docId] = doc;
		bindDocsEvents ();
	}

	function delDoc (docId) 
	{ 
		console.log("delDoc",docId);
		if(documents[docId])
		{
			var delname = documents[docId].name;
			bootbox.confirm("<?php echo Yii::t('project','Are you sure to delete',null,Yii::app()->controller->module->id) ?> : <span class='text-red text-bold'>"+delname+"</span>? ", function(result) {
				if(result)
				{
					console.log("removing doc ", docId, delname);
					$(".file"+docId).css("background-color","#FF3700").fadeOut(400, function(){
			            $(".file"+docId).remove();
			            delete documents[docId];
			            if(!Object.keys(documents).length)
			            	 $(".docsList").prepend('<blockquote class="padding-10 emptyDocsInfo">Share your Organizations Documents Simply</blockquote>');
			        });

			       $.ajax({
				        url: baseUrl+"/"+moduleId+"/document/delete/dir/"+moduleId+"/type/"+docType,
				        data:{
				        	"name":delname,
				        	"parentId" : ownerId,
				        	"docId" : docId,
				        },
					    type:"POST",
					    dataType:"json"})
				    .done(function (data) {
				        if (data.result) {               
				        	console.info("deleted file success!!");
				        	if( "undefined" != typeof resetGenericFilesTable )
								resetGenericFilesTable();
				        } else {
				            console.error("deleted file fail");
				        }
				    });
				}
			});
		} 
		else
			toastr.error('<?php echo Yii::t("project","No document at this position.",null,Yii::app()->controller->module->id); ?>');
	}
</script>