<!-- Modal -->
<div id="modal-confirm-delete-pending" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-dark"><?php echo Yii::t("common","Delete Pending")?></h4>
      </div>
      <div class="modal-body text-dark">
        <p>
        	<?php echo Yii::t('common',"This element is in status 'delete pending'. It will be deleted in {nbDaysBeforeDelete} days.", array("{nbDaysBeforeDelete}"=>Element::NB_DAY_BEFORE_DELETE)) ;?>
        </p>
        <br>
        <?php echo Yii::t('common',"As an admin of this element, if you think it's a mistake you can stop the process.") ;?>
        <br>
        <?php echo Yii::t('common',"Do you want to stop the delete process of this element ?") ;?>
      </div>
      <div class="modal-footer">
       <button id="stopDelete" type="button" class="btn btn-warning"><?php echo Yii::t('common','Stop the delete !');?></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo Yii::t('common','No : this element will be deleted');?></button>
      </div>
    </div>

  </div>
</div>

<script>
	$("#stopDelete").off().on("click", function(){
	    var url = baseUrl+"/"+moduleId+"/element/stopDelete/id/"+contextData.id+"/type/"+contextData.type;
	    mylog.log("stopDelete", url);
		var param = new Object;
		$.ajax({
	        type: "POST",
	        url: url,
	        data: param,
	       	dataType: "json",
	    	success: function(data){
		    	if(data.result){
					toastr.success(data.msg);
					loadByHash(location.hash);
		    	}else{
		    		toastr.error(data.msg);
		    	}
		    },
		    error: function(data){
		    	toastr.error("<?php echo Yii::t('common',"Something went really bad ! Please contact the administrator.") ;?>");
		    }
		});
	});

	$("#modal-confirm-delete-pending").modal();
</script>