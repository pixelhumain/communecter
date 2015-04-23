<style>
	.user-image .user-image-buttons{
		display: block;
	}
	#fileuploadContainer{
		position: relative;
		padding: 10px;
		width: 100%;
	}
	.fileupload, .fileupload-preview.thumbnail, .fileupload-new .thumbnail{
		width: 100%;
		min-height: 150px;
		max-width: 100%;
		max-height: 100%;
	}
</style>

	<div class ="center" id="fileuploadContainer">
		<form  method="post" id="photoAdd" enctype="multipart/form-data">
		<div class="fileupload fileupload-new" data-provides="fileupload">
			<div class="user-image">
				<div class="fileupload-new thumbnail">
				</div>
				<div class="fileupload-preview fileupload-exists thumbnail"></div>
				<?php if(isset($editMode) && $editMode){ ?>
				<div class="user-image-buttons">
					<span class="btn btn-azure btn-file btn-sm"><span class="fileupload-new"><i class="fa fa-pencil"></i></span><span class="fileupload-exists"><i class="fa fa-pencil"></i></span>
						<input type="file" accept=".gif, .jpg, .png" name="avatar" id="avatar">
					</span>
					<a href="#" class="btn fileupload-exists btn-red btn-sm" data-dismiss="fileupload">
						<i class="fa fa-times"></i>
					</a>
					<button id='uploadBtn' class="btn fileupload-exists btn-yellow btn-sm" type="button">
						<i class="fa fa-upload"></i>
					</button>
				</div>
				<?php }; ?>
			</div>
		</div>
		</form>
	</div>


<script type="text/javascript">
	var id = "<?php echo $itemId ?>";
	var type = "<?php echo $type ?>";
	var contentKey = "<?php echo $contentKey?>";
	var isSubmit = false;
	jQuery(document).ready(function() {


		$("#photoAdd").on('submit',(function(e) {
			isSubmit = true;
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
			  		}
			  		else
			  			toastr.error(data.msg);
			  },
			});
		}));
		
		$("#uploadBtn").on("click",function(){
			
			if(isSubmit == false)
				$("#photoAdd").submit();
		})

	});
	

</script>