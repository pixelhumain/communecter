
<style type="text/css">
	#menuPhoto{
		padding-top: 40px;
	}
	#addPhoto{
		display: none;
	}
	#addPhoto .thumbnail{
		border: 1px solid #ddd;
	}
	
</style>
<div class="panel panel-white">
	<div class="panel-heading border-light"></div>
	<div class="panel-tools">
		<?php if((isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"])  || (isset($itemId) && isset(Yii::app()->session["userId"]) && Authorisation::canEditItem(Yii::app()->session["userId"], $type, $itemId))) { ?>
			<a href="#addPhoto" class="add-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add image" alt="Add image"><i class="fa fa-plus"></i> Add image</a>
		<?php } ?>	
		<a href="#" class="btn btn-xs btn-link panel-close">
			<i class="fa fa-times"></i>
		</a>
	</div>
	<div class="panel-body">
		<div class="center">
			<div class="flexslider" id="flexsliderPhoto">
				<ul class="slides" id="slidesPhoto">
					
				</ul>
			  </div>
			
		</div>

		</hr>

		<div class="row center" id="menuPhoto">
			<a href="#galleryPhoto" class="gallery-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Show gallery" alt="Show gallery"><i class="fa fa-camera"></i> Show gallery</a>

		</div>
	</div>
</div>


<div id="addPhoto">
	<div class="noteWrap col-md-8 col-md-offset-2">
		
		<div class="row center">
			<h1>Add a photo</h1>
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
		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
	var id = "<?php if(isset($userId)) echo $userId; else if(isset($itemId)) echo $itemId; ?>";
	var type = '<?php if(isset($userId)) echo Person::COLLECTION; else if(isset($type)) echo $type; ?> '
 	var isSubmit = false;
	 jQuery(document).ready(function() {
		initDashboardPhoto();
		bindPhotoSubview();
		$("#flexslider2").flexslider();

		$("#uploadBtn").off().on("click",function(){
			if(isSubmit == false)
				$("#photoAddSV").submit();
		})
	});
	

	function initDashboardPhoto(){
		$.ajax({
			url: baseUrl+"/"+moduleId+"/api/getUserImages/type/"+type+"/id/"+id,
			type: "POST",
			contentType: false,
			cache: false, 
			processData: false,
			success: function(data){
		  		if(data) {
		  			console.log(data);
		  			i=0;
		  			if(data.length == 0){
		  				var htmlSlide = "<li><img src='http://placehold.it/350x180' /></li>";
						$("#slidesPhoto").append(htmlSlide);
		  			}
		  			$.each(data, function(k,v){
		  				if(i<5){
		  					var htmlSlide = "<li><img src='"+v+"' /></li>";
							$("#slidesPhoto").append(htmlSlide);
							i++;
		  				}
		  				
		  			})
					$("#flexsliderPhoto").flexslider();
				}
		  		else
		  			toastr.error(data.msg);
		  },
		});
		
	}

	function bindPhotoSubview(){
		$("#avatar").fileupload({allowedFileExtensions:['jpg', 'gif', 'png']})
		$(".add-photo").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					//openGallery();
				},
				onHide : function() {
					//hideGallery();
				}
			});
		});
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
	}

	//resetForm
	function hidePhotoSv(){
		isSubmit =false;
		$("#uploadBtn").empty();
		$("#uploadBtn").html("Upload File");
		$(".fileupload").fileupload("clear");
		$.hideSubview();
	}
</script>