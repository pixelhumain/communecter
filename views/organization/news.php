<?php 
$this->renderPartial('../news/newsSV');
?>
<div class="row">

  <div class="col-sm-8 col-xs-12 docsPanel hide">
    <div class="panel panel-white">
      <div class="panel-heading border-light">
        <h4 class="panel-title">NEWS </h4>
        <ul class="panel-heading-tabs border-light">
        	<li>
        		<a class="new-file btn btn-info" href="#genericGED">Add Files <i class="fa fa-download"></i></a>
        	</li>
	        <li class="panel-tools">
	          <div class="dropdown">
	            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
	              <i class="fa fa-cog"></i>
	            </a>
	            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
	              <li>
	                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
	              </li>
	              <li>
	                <a class="panel-expand" href="#">
	                  <i class="fa fa-expand"></i> <span>Fullscreen</span>
	                </a>
	              </li>
	              </ul>
          	  </div>
	          <a class="btn btn-xs btn-link panel-close" href="#">
	            <i class="fa fa-times"></i>
	          </a>
	        </li>
        </ul>
      </div>
      <div class="panel-body no-padding">
        <div class="">
          <table class="table table-striped table-hover">
            <tbody class="docsList">
            	<?php foreach ($news as $article) { ?>
              <tr>
                <td class="center">
                	<?php
                	if(strrpos($article['name'], ".pdf") != false)
						echo '<a href="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$article['folder']."/".$article['name'].'" target="_blank">'.
								'<i class="fa fa-file-pdf-o fa-3x icon-big"></i></a>';	
					else if( strrpos( $article['name'], ".jpg" ) != false || strrpos($article['name'], ".jpeg") != false || strrpos($article['name'], ".gif")  != false || strrpos($article['name'], ".png")  != false  )
						echo '<a href="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$article['folder']."/".$article['name'].'" data-lightbox="docs">'.
									'<img width="50" class="img-responsive" src="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$article['folder']."/".$article['name'].'"/>'.
								'</a>';	
					else
						echo '<a href="'.Yii::app()->request->baseUrl."/upload/".$this->module->id."/".$article['folder']."/".$article['name'].'" target="_blank">'.
								'<i class="fa fa-file fa-3x icon-big"></i></a>';	
					?>
                </td>
                <td class="center"><span class="text-large"><?php echo $article['name'] ?> </span></td>
                <?php $category = ( !empty ( $article['category'] ) ) ? '<span class="label label-danger">'.$article['category'].'</span>' : ''; ?>
                <td  class="center hidden-xs"><?php echo $category ?> </td>
                <td class="hidden-xs"><?php echo $article['size'] ?> </td>
               </tr>
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
		$(".docsPanel").removeClass('hide').addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$(this).removeClass("animated flipInX");
		});
		docType = "<?php echo Organization::COLLECTION?>";
		folder = "<?php echo Organization::COLLECTION.'_'.$_GET['id'] ?>";
		ownerId = "<?php echo $_GET['id'] ?>";
	});

	function afterDocSave(doc){

		console.log("afterDocSave",'/upload/'+destinationFolder+'/'+folder+'/'+doc.name); 
		console.log("addFileLine",doc); 
		date = new Date(doc.date);
		if(doc.name && doc.name.indexOf(".pdf") >= 0)
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folder+'/'+doc.name+'" target="_blank"><i class="fa fa-file-pdf-o fa-3x icon-big"></i></a>';	
		else if((doc.name && (doc.name.indexOf(".jpg") >= 0 || doc.name.indexOf(".jpeg") >= 0 || doc.name.indexOf(".gif") >= 0 || doc.name.indexOf(".png") >= 0  )))
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folder+'/'+doc.name+'" data-lightbox="docs">'+
						'<img width="50" class="img-responsive" src="'+baseUrl+'/upload/'+destinationFolder+'/'+folder+'/'+doc.name+'"/>'+
					'</a>';	
		else
			link = '<a href="'+baseUrl+'/upload/'+destinationFolder+'/'+folder+'/'+doc.name+'" target="_blank"><i class="fa fa-file fa-3x icon-big"></i></a>';	

		category = (doc.category) ? '<span class="label label-danger">'+doc.category+'</span>' : "";
		lineHTML = '<tr>'+
						'<td class="center">'+link+'</td>'+
						'<td class="center">'+doc.name+'</td>'+
						'<td class="center hidden-xs">'+category+'</td>'+
						'<td class="hidden-xs">'+doc.size+'</td>'+
					'</tr>';

		$(".docsList").prepend(lineHTML);
	}
</script>