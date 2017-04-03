<!-- Modal -->
<div id="modal-delete-element" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-dark"><?php echo Yii::t("common","Delete")?></h4>
      </div>
      <div class="modal-body text-dark">
        <p>
        	<?php echo Yii::t('common',"Are you sure you want to delete this element ? </br> The element will be deleted : it will not be referenced in all their projects or events. But these last ones will not be deleted. <span class=\"text-red\">Warning:</span> this action can not be cancelled") ;?>
        </p>
        <br>
        	<?php echo Yii::t('common','You can add bellow the reason why you want to delete this element :') ;?>
        <textarea id="reason" class="" rows="2" style="width: 100%" placeholder="Laisser une raison... (optionnel)"></textarea>
      </div>
      <div class="modal-footer">
       <button id="confirmDeleteElement" type="button" class="btn btn-warning"><?php echo Yii::t('common','I confim the delete !');?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Yii::t('common','No');?></button>
      </div>
    </div>

  </div>
</div>

<script>
	$("#confirmDeleteElement").off().on("click", function(){
	    var url = baseUrl+"/"+moduleId+"/element/delete/id/"+contextData.id+"/type/"+contextData.type;
	    mylog.log("deleteElement", url);
		var param = new Object;
		param.reason = $("#reason").val();
		$.ajax({
	        type: "POST",
	        url: url,
	        data: param,
	       	dataType: "json",
	    	success: function(data){
		    	if(data.result){
					toastr.success(data.msg);
					loadByHash("#default.live");
		    	}else{
		    		toastr.error(data.msg);
		    	}
		    },
		    error: function(data){
		    	toastr.error("Something went really bad ! Please contact the administrator.");
		    }
		});
	});
</script>