
<style type="text/css">
	#menuPhoto{
		padding-top: 40px;
	}
	#addPhoto{
		display: none;
		max-width: 100%;
	}
	#addPhoto .thumbnail{
		border: 1px solid #ddd;
		width: 100%;
	}

	#sliderPhotoPod .flexslider .slides img {
	    position: relative;
	    height: 100%;
	    width: auto;
	    margin-left: auto;
	    margin-right: auto;
	    max-width: 100%;
	}

	
</style>
<div id="sliderPhotoPod" onresize="javascript:resizeSlider()">
	<div class="panel panel-white">
		<div class="panel-heading border-light"></div>
		<div class="panel-tools">
			<?php if((isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"])  || (isset($itemId) && isset(Yii::app()->session["userId"]) && Authorisation::canEditItem(Yii::app()->session["userId"], $type, $itemId))) { ?>
				<a href="#" class="add-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add image" alt="Add image"><i class="fa fa-plus"></i></a>
			<?php } ?>
			<a href="#galleryPhoto" class="gallery-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Show gallery" alt="Show gallery"><i class="fa fa-camera"></i> Show gallery</a>
		</div>
		<div class="panel-body">
			<div class="center">
				<div class="flexslider" id="flexsliderPhoto">
					<ul class="slides" id="slidesPhoto">
						
					</ul>
				</div>
				
			</div>

			<div id="addPhoto">
				<div class="row">
					<?php 
						if(isset($userId)){
								$itemId = $userId;
								$type = Person::COLLECTION;
							}
						$this->renderPartial('../pod/fileupload', array("itemId" => $itemId,
																				  "type" => $type,
																				  "resize" => "true",
																				  "contentId" =>Document::IMG_SLIDER,
																				  "editMode" => true)); ?>
				</div>
				<div class="row center">
					<a href="#" class="btn btn-light-blue validateSlider">Terminer </a>
				</div>
			</div>

			</hr>
		</div>
	</div>
</div>



<script type="text/javascript" charset="utf-8">
	var id = "<?php if(isset($userId)) echo $userId; else if(isset($itemId)) echo $itemId; ?>";
	var type = '<?php if(isset($userId)) echo Person::COLLECTION; else if(isset($type)) echo $type; ?> '
 	var isSubmit = false;
 	var constImgName = "<?php echo Document::IMG_SLIDER ; ?>";
 	var imagesTab = [];
 	var widthSlider = $("#sliderPhotoPod .flexslider").css("width");
	 jQuery(document).ready(function() {
	 	$("#sliderPhotoPod .flexslider").css("height", parseInt(widthSlider)*45/100+"px");
	 	$("#sliderPhotoPod .flexslider .slides li").css("max-width", parseInt(widthSlider)+"px");
		initDashboardPhoto();
		bindPhotoSubview();

		$(".gallery-photo").on("click", function(){
			location.href = baseUrl+"/"+moduleId+"/gallery/index/id/"+id+"/type/"+type;
		})

		$( window ).resize(function() {
			resizeSlider();
		})

		$(".validateSlider").off().on("click", function() {
			clearFileupload();
		})
		$(".add-photo").off().on("click", function() {
			$("#flexsliderPhoto").css("display", "none");
			$("#addPhoto").css("display", "block");
			$('#'+constImgName+'_avatar').trigger("click");
		});

	});
	

	function initDashboardPhoto(){
		j=0;

		if(images.length != 0){
			$.each(images, function(k,v){
				imagesTab.push(v)
			})
			
			for(i=imagesTab.length-1; i>=0; i--){
				var contentTab = imagesTab[i].contentKey.split(".");
				var where = contentTab[contentTab.length-1];
				if(j<5 && imagesTab[i].doctype=="image"){
					if(where == constImgName){
						path = baseUrl+"/upload/"+imagesTab[i].moduleId+"/"+imagesTab[i].folder+"/"+imagesTab[i].name;
						var htmlSlide = "<li><img src='"+path+"' /></li>";
						$("#slidesPhoto").append(htmlSlide);
						j++;
					}
				}
			}
		}
		if(j == 0){
			var htmlSlide = "<li>" +
								"<div class='center'>"+
									"<i class='fa fa-picture-o fa-5x text-green'></i>"+
									"<br>Click on <i class='fa fa-plus'></i> for share your pictures"+
								"</div>"+
							"</li>";
			$("#slidesPhoto").append(htmlSlide);
		}
		$("#flexsliderPhoto").flexslider();
		$(".podPhotoVideoTitle").html("Media");
		widthSlider = $("#sliderPhotoPod .flexslider").css("width");
		$("#sliderPhotoPod .flexslider").css("height", parseInt(widthSlider)*45/100+"px");
		$("#sliderPhotoPod .flexslider .slides li").css("height", parseInt(widthSlider)*45/100-10+"px");
		imagesTab = [];

	}


	function bindPhotoSubview(){
		$("#avatar").fileupload({allowedFileExtensions:['jpg', 'gif', 'png']})
		/*$(".add-photo").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					//openGallery();
				},
				onHide : function() {
					hideFileuploadSubview();
				}
			});
		});*/
	}

	function updateSlider(image, id){
		console.log(images, images.length);
		if("undefined" != typeof images.length){
			images = {};
		}
		images[id] = image;
		//console.log(images);
		removeSlider();
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

	function resizeSlider(){
		removeSlider();
		initDashboardPhoto()
	}

	function removeSlider(){
		$("#flexsliderPhoto").removeData("flexslider");
		$("#flexsliderPhoto").empty();
		$("#flexsliderPhoto").html('<ul class="slides" id="slidesPhoto">');
	}

	function hideFileuploadSubview(){
		$('#'+constImgName+'_avatar').val('');
		$('#'+constImgName+'_fileUpload').fileupload("clear");
		$.hideSubview();
	}

	function clearFileupload(){
		$("#addPhoto").css("display", "none");
		$("#flexsliderPhoto").css("display", "block");
		$('#'+constImgName+'_avatar').val('');
		$('#'+constImgName+'_fileUpload').fileupload("clear");
		removeSlider()
		initDashboardPhoto()
	}
</script>