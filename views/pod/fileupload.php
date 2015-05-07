<style>
	
	#fileuploadContainer{
		position: relative;
		padding: 10px;
		width: 100%;
	}
	.fileupload-new .thumbnail, .fileupload-exists .thumbnail{
		height: auto;
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
	.fileupload-preview img{
		max-height:100%; 
	}
</style>

	<div class ="center" id="fileuploadContainer">
		<form  method="post" id="<?php echo $contentId ?>_photoAdd" enctype="multipart/form-data">
		<div class="fileupload fileupload-new" data-provides="fileupload" id="<?php echo $contentId ?>_fileUpload">
			<div class="user-image">
				<div class="fileupload-new thumbnail container-fluid" id="<?php echo $contentId ?>_imgPreview">
					
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
		var isSubmit = contentId+"_true";
		var resize = "<?php if(isset($resize)) echo $resize; else echo false; ?>";
		var imageName= "";
		var imageId= "";
		var showImage = '<?php if(isset($show)) echo $show; else echo "false"; ?>';
		var imagesPath = [];
		if("undefined" != typeof(contentKeyBase))
			var contentKey = contentKeyBase+"."+contentId;
		else
			contentKey = contentId;
		initFileUpload();



		$('#'+contentId+'_avatar').on('change.bs.fileinput', function () {

			if(isSubmit==contentId+"_true"){
				setTimeout(function(){
					if(resize){
						$(".fileupload-preview img").css("height", parseInt($("#"+contentId+"_fileUpload").css("width"))*45/100+"px");
						$(".fileupload-preview img").css("width", "auto");
					}
					$("#"+contentId+"_photoAdd").submit();}, 200);

			}else{
				isSubmit = contentId+"_true";
			}
		   
		});


		$("#"+contentId+"_photoAdd").on('submit',(function(e) {
			
			isSubmit = contentId+"_true";
			e.preventDefault();
			$("#"+contentId+"_fileUpload").css("opacity", "0.4");
			$("#"+contentId+"_photoUploading").css("display", "block");
			$(".btn").addClass("disabled");

			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/"+type+"/id/"+id+"/contentKey/"+contentKey+"/user/<?php echo Yii::app()->session["userId"]?>",
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
					console.log(data);
			  		if(data.result){
			  			imagesPath.push(baseUrl+data.imagePath);
			  			console.log(imagesPath);
			  			$(".fileupload-preview img").css("max-height", "100%");
			  			setTimeout(function(){
			  				$("#"+contentId+"_fileUpload").css("opacity", "1");
							$("#"+contentId+"_photoUploading").css("display", "none");
							$(".btn").removeClass("disabled");
			  				toastr.success(data.msg);

				  			imageName = data.imagePath.split("/")[data.imagePath.split("/").length-1]
				  			imageId = data.id['$id'];
					  		
					  		if(typeof(updateSlider) != "undefined" && typeof (updateSlider) == "function"){
			        			updateSlider(data.image, data.id["$id"]);
					  		}
					  		if(typeof(updateSliderImage) !="undefined" && typeof(updateSliderImage) == "function"){
					  			updateSliderImage(id, data.imagePath);
					  		}


			  			}, 2000) 
			  			
			  		}
			  		else
			  			toastr.error(data.msg);
			  },
			});
		}));
		
	


		$("#"+contentId+"_photoRemove").on("click", function(e){		
			isSubmit = contentId+"_false";
			e.preventDefault();

			$("#"+contentId+"_fileUpload").css("opacity", "0.4");
			$("#"+contentId+"_photoUploading").css("display", "block");
			$(".btn").addClass("disabled");

			$.ajax({
				url: baseUrl+"/templates/delete/dir/"+moduleId+"/type/"+type,
				type: "POST",
				dataType : "json",
				data: {"name":imageName, "parentId":id, "docId":imageId},
				success: function(data){
					console.log(data);
			  		if(data.result){
			  			dataImage = {};
			  			dataImage["imagePath"] = imagesPath[imagesPath.length-1];
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
			  						$('#'+contentId+'_avatar').val('');
			  						imagesPath.shift();
			  						setTimeout(function(){
						  				$("#"+contentId+"_fileUpload").css("opacity", "1");
										$("#"+contentId+"_photoUploading").css("display", "none");
										$(".btn").removeClass("disabled");

								  		if(typeof(removeSliderImage) != "undefined" && typeof (removeSliderImage) == "function"){
						        			removeSliderImage(imageId);
								  		}
						  				toastr.success(data.msg);
						  			}, 2000) 
			  						//$('#'+contentId+"_fileUpload").fileupload("reset");
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
		function initFileUpload(){
			var j = 0;
			if("undefined" != typeof(images) && showImage == "true"){
				$.each(images, function(k,v){
					if(v.doctype=="image"){
						console.log("contentKey", contentKey);
						if(v.contentKey == contentKey){
							imagesPath.push(baseUrl+"/upload/"+v.moduleId+v.folder+v.name);
							j= j+1;
						}
					}		
				})
				$("#"+contentId+"_imgPreview").html('<img class="img-responsive" src="'+imagesPath[imagesPath.length-1]+'" />');	
			}
			//console.log("initFileUpload", images, imagesPath);
			
			if(j == 0){
				var textBlock =  "<br>Click on <i class='fa fa-plus text-green'></i> for share your pictures";
				
				var defautText = "<li>" +
									"<div class='center'>"+
										"<i class='fa fa-picture-o fa-5x text-green'></i>"+
										textBlock+
									"</div>"+
								"</li>";
				$("#"+contentId+"_imgPreview").html(defautText);
			}
		}
		
	});


</script>