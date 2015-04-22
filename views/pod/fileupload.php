<form  method="post" id="photoAddSV" enctype="multipart/form-data">
	<div class="fileupload fileupload-new" data-provides="fileupload">
		<div class="fileupload-new thumbnail">
			<img src="<?php //if ($person && isset($person["imagePath"])) echo $person["imagePath"]; else echo Yii::app()->theme->baseUrl.'/assets/images/avatar-1-xl.jpg'; ?>" alt="">	
		</div>
		<div class="fileupload-preview fileupload-exists thumbnail"></div><br>
		<div class="user-edit-image-buttons">
			<span class="btn btn-azure btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
				<input type="file" accept=".gif, .jpg, .png" name="avatar" id="avatar">
			</span>
			<a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
				<i class="fa fa-times"></i> Remove
			</a>
			<button id='uploadBtn' class="btn fileupload-exists btn-light-blue" type="button">Upload File</button>
		</div>
	</div>
</form>

<script type="text/javascript">
	jQuery(document).ready(function() {
		
		$("#photoAddSV").on('submit',(function(e) {
			isSubmit = true;
			$("#uploadBtn").empty();
			$("#uploadBtn").html("<i class='fa fa-spinner fa-spin'></i> Upload File");
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/"+type+"/id/"+id,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
					console.log(data);
			  		if(data.result){
			  			setTimeout(function(){
				  			toastr.success(data.msg);
				  			if(typeof(data.imagePath)!="undefined"){
				  				$('#flexsliderPhoto').removeData("flexslider")
				  				$('#flexsliderPhoto').empty();
				  				$('#flexsliderPhoto').append('<ul class="slides" id="slidesPhoto">');
				  				initDashboardPhoto();
				  			}
				  		}, 3000);
				  		clearTimeout();
				  		setTimeout(function(){
				  			hidePhotoSv();
				  		}, 4000);
			  		}
			  		else
			  			setTimeout(function(){
			  				toastr.error(data.msg);
			  			}, 3000);
			  },
			});
		}));
		
		$("#uploadBtn").off().on("click",function(){
			if(isSubmit == false)
				$("#photoAddSV").submit();
		})

	});
	

</script>