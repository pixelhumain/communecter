<style>
	
	#fileuploadContainer{
		position: relative;
		padding: 10px;
		width: 100%;
	}
	.fileupload-new .thumbnail, .fileupload-exists .thumbnail{
		height: 100%;
	}
	.fileupload, .fileupload-preview.thumbnail, .fileupload-new .thumbnail, .fileupload-new .thumbnail img, .fileupload-preview.thumbnail img{
		width: 100%;
		min-height: 150px;
		max-width: 100%;
		max-height: 100%;
		
	}

	.photoUploading{
		position: absolute;
		width: 100%;
		display: none;
		top:40%;
		left: 0%;
		opacity: 0.4;
    	filter: alpha(opacity=40); /* For IE8 and earlier */
	}
</style>

	<div class ="center" id="fileuploadContainer">
		<form  method="post" id="<?php echo $contentId ?>_photoAdd" enctype="multipart/form-data">
		<div class="fileupload fileupload-new" data-provides="fileupload" id="<?php echo $contentId ?>_fileUpload">
			<div class="user-image">
				<div class="fileupload-new thumbnail container-fluid" id="<?php echo $contentId ?>_imgPreview">
					<img class="img-responsive" src="<?php if(isset($imagePath)&& $imagePath !='') echo $imagePath; else echo 'http://placehold.it/350x180'; ?> " />
				</div>
				<div class="fileupload-preview fileupload-exists thumbnail container-fluid" id="<?php echo $contentId ?>_imgNewPreview"></div>
				<?php if(isset($editMode) && $editMode){ ?>
				<div class="user-image-buttons">
					<span class="btn btn-azure btn-file btn-sm" id="<?php echo $contentId ?>_photoAddBtn" ><span class="fileupload-new"><i class="fa fa-plus"></i></span><span class="fileupload-exists"><i class="fa fa-plus"></i></span>
						<input type="file" accept=".gif, .jpg, .png" name="avatar" id="<?php echo $contentId ?>_avatar">
					</span>
					<a href="#" class="btn fileupload-exists btn-red btn-sm" id="<?php echo $contentId ?>_photoRemove" data-dismiss="fileupload">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="photoUploading" id="<?php echo $contentId ?>_photoUploading">
					<div class="center">
						<i class="fa fa-spinner fa-spin fa-5x"></i>
					</div>
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
		var imagePath = "<?php echo $imagePath?>"
		var isSubmit = contentId+"_true";
		var imageName= "";
		var imageId= "";

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
			  			$("#"+contentId+"_fileUpload").css("opacity", "0.4");
						$("#"+contentId+"_photoUploading").css("display", "block");
			  			setTimeout(function(){
			  				$("#"+contentId+"_fileUpload").css("opacity", "1");
							$("#"+contentId+"_photoUploading").css("display", "none");
			  				toastr.success(data.msg);
			  			}, 2000) 
			  			imageName = data.imagePath.split("/")[data.imagePath.split("/").length-1]
			  			imageId = data.id['$id'];
				  		
				  		if(typeof(updateSlider) != "undefined" && typeof (updateSlider) == "function")
		        			updateSlider( data.imagePath);
			  		}
			  		else
			  			toastr.error(data.msg);
			  },
			});
		}));
		
	

		$('#'+contentId+'_avatar').on('change.bs.fileinput', function () {
			if(isSubmit==contentId+"_true"){

				setTimeout(function(){$("#"+contentId+"_photoAdd").submit();}, 1000);
			}else{
				isSubmit = contentId+"_true";
			}
		   
		});

		$("#"+contentId+"_photoRemove").on("click", function(e){		
			isSubmit = contentId+"_false";
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/templates/delete/dir/"+moduleId+"/type/"+type,
				type: "POST",
				dataType : "json",
				data: {"name": id+"/"+imageName},
				success: function(data){
					console.log(data);
			  		if(data.result){
			  			dataImage = {};
			  			dataImage["imagePath"] = imagePath;
			  			dataImage["type"] = type;
			  			dataImage["id"] = id;
			  			dataImage["contentKey"] = contentKey;
			  			dataImage["_id"] = imageId;
			  			$.ajax({
			  				url: baseUrl+"/"+moduleId+"/document/removeandbacktract",
			  				type: "POST",
			  				dataType: "json",
			  				data: dataImage,
			  				success: function(data){
			  					if(data.result){
			  						toastr.success(data.msg);
			  						$('#'+contentId+'_avatar').val('');
			  						$('#'+contentId+"_fileUpload").fileupload("reset");
			  					}
			  					else
			  						toastr.error(data.msg);
			  				}
			  			})
			  		}
			  		else
			  			toastr.error(data.msg);
			  	},
			});
		});
	});
</script>