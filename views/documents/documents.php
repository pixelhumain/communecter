<?php 
$this->renderPartial('../documents/gedSV');
?>
<div class="row">

  <div class="col-xs-12 docsPanel">
    <div class="panel panel-white">
    	<div class="panel-heading border-light">
			<h4 class="panel-title">Documents</h4>
		</div>
		<div class="panel-tools">
			<a href="#genericGED" class="new-file btn btn-xs btn-light-blue tooltips" data-placement="top" data-original-title="Add a File"><i class="fa fa-plus"></i></a>
		</div>
		
      <div class="panel-body no-padding">
        <div class="panel-scroll height-230">
          <table class="table table-striped table-hover">
            <tbody class="docsList">
            	<?php 
            	if(!empty($documents)){
	            	foreach ($documents as $doc) { ?>
	              	<tr>
			                <td class="center">
			                	<?php
			                	if(strrpos($doc['name'], ".pdf") != false)
									echo '<a href="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$doc['folder']."/".$doc['name'].'" target="_blank">'.
											'<i class="fa fa-file-pdf-o fa-3x icon-big"></i></a>';	
								else if( strrpos( $doc['name'], ".jpg" ) != false || strrpos($doc['name'], ".jpeg") != false || strrpos($doc['name'], ".gif")  != false || strrpos($doc['name'], ".png")  != false  )
									echo '<a href="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$doc['folder']."/".$doc['name'].'" data-lightbox="docs">'.
											'<img width="50" class="" src="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$doc['folder']."/".$doc['name'].'"/></a>';	
								else
									echo '<a href="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$doc['folder']."/".$doc['name'].'" target="_blank">'.
											'<i class="fa fa-file fa-3x icon-big"></i></a>';	
								?>
			                </td>
			                <td class="center"><span class="text-large"><?php echo $doc['name'] ?> </span></td>
			                <?php $category = ( !empty ( $doc['category'] ) ) ? '<span class="label label-danger">'.$doc['category'].'</span>' : ''; ?>
			                <td  class="center hidden-xs"><?php echo $category ?> </td>
			                <td class="hidden-xs"><?php echo $doc['size'] ?> </td>
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
	jQuery(document).ready(function() {
		/*$(".docsPanel").removeClass('hide').addClass("animated bounceIn").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated bounceIn");
		});*/
		docType = "<?php echo Organization::COLLECTION?>";
		folder = "<?php echo Organization::COLLECTION ?>";
		ownerId = "<?php echo $_GET['id'] ?>";

		if($(".tooltips").length) {
     		$('.tooltips').tooltip();
     	}
	});

	function afterDocSave(doc){
		folderPath = folder+"/"+ownerId;
		console.log("afterDocSave",'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name); 
		console.log("addFileLine",doc); 
		date = new Date(doc.date);
		if(doc.name && doc.name.indexOf(".pdf") >= 0)
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" target="_blank"><i class="fa fa-file-pdf-o fa-3x icon-big"></i></a>';	
		else if((doc.name && (doc.name.indexOf(".jpg") >= 0 || doc.name.indexOf(".jpeg") >= 0 || doc.name.indexOf(".gif") >= 0 || doc.name.indexOf(".png") >= 0  )))
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" data-lightbox="docs">'+
						'<img width="50" class="img-responsive" src="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'"/>'+
					'</a>';	
		else
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folderPath+'/'+doc.name+'" target="_blank"><i class="fa fa-file fa-3x icon-big"></i></a>';	

		category = (doc.category) ? '<span class="label label-danger">'+doc.category+'</span>' : "";
		lineHTML = '<tr>'+
						'<td class="center">'+link+'</td>'+
						'<td class="center">'+doc.name+'</td>'+
						'<td class="center hidden-xs">'+category+'</td>'+
						'<td class="hidden-xs">'+doc.size+'</td>'+
					'</tr>';

		if( $(".docsList tr").length == 0 )
			$(".emptyDocsInfo").remove();

		$(".docsList").prepend(lineHTML);
	}

	/*function delDoc (pos) 
	{ 
		console.log("delDoc",pos);
		if(docType.indexOf("tasks") == 0 && tasks[editTaskId].documents[pos])
		{
			if( isListPage && editProjectId )
				tasks =  projectTasks[ editProjectId ];
			var delname = tasks[editTaskId].documents[pos].name;
			bootbox.confirm("<?php echo Yii::t('project','Are you sure to delete',null,Yii::app()->controller->module->id) ?> : <span class='text-red text-bold'>"+delname+"</span>? ", function(result) {
				if(result)
				{
					console.log("removing doc ", pos, delname);
					taskFilesTable.DataTable().destroy();
					$(".file"+pos).css("background-color","#FF3700").fadeOut(400, function(){
			            $(".file"+pos).remove();
			            //decrement all higher file positions in the documents array 
			            $.each($(".taskFiles tr td:nth-child(6) a"),function(i,val) { 
						  	if( parseInt( $(this).data('pos')) > pos ){
							 	newPos = parseInt($(this).data('pos'))-1;
							 	$(this).parent().parent().removeClass("file"+$(this).data('pos')).addClass("file"+newPos);
							 	$(this).data('pos', newPos); 
							}
						});
			            tasks[editTaskId].documents.splice(pos,1);
				        saveTask(tasks[editTaskId],false);
				        resetTaskFilesTable();
			        });
			        

			       $.ajax({
				        url: baseUrl+"/templates/delete/dir/"+moduleId+"/type/"+docType,
				        data:{"name":delname},
					    type:"POST",
					    dataType:"json",
				    })
				    .done(function (data) {
				        if (data.result) {               
				        	console.info("deleted file");
				        } else {
				            console.error("deleted file fail");
				        }
				    });
				}
			});
		} 
		else
			toastr.error('<?php echo Yii::t("project","No document at this position.",null,Yii::app()->controller->module->id); ?>');
	}*/
</script>