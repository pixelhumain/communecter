
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
	
	.flexslider .slides img {
	    height: 250px;
	}
</style>
<div class="panel panel-white">
	<div class="panel-heading border-light"></div>
	<div class="panel-tools">
		<?php if((isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"])  || (isset($itemId) && isset(Yii::app()->session["userId"]) && Authorisation::canEditItem(Yii::app()->session["userId"], $type, $itemId))) { ?>
			<a href="#addPhoto" class="add-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add image" alt="Add image"><i class="fa fa-plus"></i></a>
		<?php } ?>	
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
			<?php 
			if(isset($userId)){
					$itemId = $userId;
					$type = Person::COLLECTION;
				}
			$this->renderPartial('../pod/fileupload', array("itemId" => $itemId,
																	  "type" => $type,
																	  "contentKey" => "",
																	  "contentId" =>"sliderPhoto",
																	  "imagePath" => "",
																	  "editMode" => true)); ?>
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
	}

	function updateSlider(){
		$("#flexsliderPhoto").removeData("flexslider");
		$("#flexsliderPhoto").empty();
		$("#flexsliderPhoto").html('<ul class="slides" id="slidesPhoto">');
		$("#flexsliderPhoto").flexslider();
		initDashboardPhoto()

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