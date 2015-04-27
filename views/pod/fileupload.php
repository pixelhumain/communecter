<style>
	
	#fileuploadContainer{
		position: relative;
		padding: 10px;
		width: 100%;
	}
	.fileupload-new .thumbnail{
		height: 100%;
	}
	.fileupload, .fileupload-preview.thumbnail, .fileupload-new .thumbnail, .fileupload-new .thumbnail img, .fileupload-preview.thumbnail img{
		width: 100%;
		min-height: 150px;
		max-width: 100%;
		max-height: 100%;
		
	}
</style>

	<div class ="center" id="fileuploadContainer">
		<form  method="post" id="<?php echo $contentId ?>_photoAdd" enctype="multipart/form-data">
		<div class="fileupload fileupload-new" data-provides="fileupload">
			<div class="user-image">
				<div class="fileupload-new thumbnail" id="<?php echo $contentId ?>_imgPreview">
					<img src="<?php if(isset($imagePath)&& $imagePath !='') echo $imagePath; else echo 'http://placehold.it/350x180'; ?> " />
				</div>
				<div class="fileupload-preview fileupload-exists thumbnail"></div>
				<?php if(isset($editMode) && $editMode){ ?>
				<div class="user-image-buttons">
					<span class="btn btn-azure btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
						<input type="file" accept=".gif, .jpg, .png" name="avatar" id="avatar">
					</span>
					<a href="#" class="btn fileupload-exists btn-red btn-sm" id="<?php echo $contentId ?>_photoRemove" data-dismiss="fileupload">
						<i class="fa fa-times"></i>
					</a>
					<button id='<?php echo $contentId ?>_uploadBtn' class="btn fileupload-exists btn-yellow btn-sm" type="button">
						<i class="fa fa-upload"></i>
					</button>
				</div>
				<?php }; ?>
			</div>
		</div>
		</form>
	</div>


<script type="text/javascript">
	
	
	
	jQuery(document).ready(function() {
		var id = "<?php echo $itemId ?>";
		var type = "<?php echo $type ?>";
		var contentId = "<?php echo $contentId ?>";
		var contentKey = "<?php echo $contentKey?>";
		var isSubmit = contentId+"_false";
		$("#"+contentId+"_photoAdd").on('submit',(function(e) {
			isSubmit = contentId+"_true";
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/"+type+"/id/"+id+"/contentKey/"+contentKey,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
					console.log(data);
			  		if(data.result){
				  		toastr.success(data.msg);
				  		if(typeof(updateSlider) != "undefined" && typeof (updateSlider) == "function")
		        			updateSlider( data.imagePath);
			  		}
			  		else
			  			toastr.error(data.msg);
			  },
			});
		}));
		
		$("#"+contentId+"_uploadBtn").on("click",function(){
			
			if(isSubmit == contentId+"_false")
				$("#"+contentId+"_photoAdd").submit();
		})

		$("#"+contentId+"_photoRemove").on("click",function(){
			 isSubmit = contentId+"_false";
		})

	});
	

</script>