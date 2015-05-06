<style type="text/css">
	#editSliderPhotoVideo{
		display:none;
		max-width: 100%;
	}

	#editSliderPhotoVideo .fileupload .thumbail{
		width: 100%;
	}
	
	#photoVideo .flexslider .slides img {
	    position: relative;
	    height: 100%;
	    width: auto;
	    margin-left: auto;
	    margin-right: auto;
	    max-width: 100%;
	}
	#showAllSlides img{
		width: 75%;
	}
	
</style>

<div id="photoVideo">
    <div class="panel panel-white">
	    <div class="panel-heading border-light">
	        <h4 class="panel-title podPhotoVideoTitle"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Media</h4>
	    </div>
	    <div class="panel-tools">
		   	<?php if((isset($itemId) && isset(Yii::app()->session["userId"]) && $itemId == Yii::app()->session["userId"])  || (isset($itemId) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $itemId))) { ?>
			   <a href="#" class="add-photoSlider btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an image" alt="Add an image"><i class="fa fa-plus"></i></a>
		    <?php } ?>
		    <a href="<?php echo Yii::app()->createUrl("/".$this->module->id.'/gallery/index/id/'.$itemId.'/type/'.Organization::COLLECTION);?>" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Show gallery" alt=""><i class="fa fa-camera-retro"></i></a>
	    </div>
		<div class="panel-body border-light">
			
			<div class="row center" id="sliderPhotoVideo">
				<div class="flexslider" id="flexsliderPhotoVideo">
					<ul class="slides" id="slidesPhoto">
						
					</ul>
				</div>
			</div>
			<div id="editSliderPhotoVideo">
				<div class="row">
					<?php 
						$this->renderPartial('../pod/fileupload', array("itemId" => (string)$itemId,
																		  "type" => $type,
																		  "resize" => "true",
																		  "contentId" =>Document::IMG_MEDIA,
																		  "editMode" => true)); ?>
				</div>
				<div class="row center">
					<a href="#" class="btn btn-light-blue validateSlider">Terminer </a>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="center">
					<div class="flexslider" id="flexslider2">
						<ul class="slides" id="slidesPhoto">
							<li>
								<img src="http://placehold.it/350x180" style="height:250px" class="img-responsive center-block"/>
							</li>
						</ul>
				  	</div>
				 </div>
				 <a href="#">Voir la gallerie Photo</a>
			</div>
		</div>
	</div>
</div>


<!--<div id="editSliderPhotoVideo" >
	<div class="row center">
		<div class="col-md-6 col-md-offset-3">
			<?php 
				/*$this->renderPartial('../pod/fileupload', array("itemId" => (string)$itemId,
																  "type" => $type,
																  "contentId" =>Document::IMG_MEDIA,
																  "editMode" => true)); */?>														  						
		</div>
	</div>
	<hr>
	<div class="row center" id="showAllSlides">
		
	</div>
</div> -->



<script type="text/javascript">

	var widthSliderPhotoVideo = $("#sliderPhotoVideo .flexslider").css("width");
	var constImgKey = '<?php echo Document::IMG_MEDIA; ?>';
 	jQuery(document).ready(function() {
 		$("#sliderPhotoVideo .flexslider").css("height", parseInt(widthSliderPhotoVideo)*45/100+"px");
 		initPhotoVideo();

		$( window ).resize(function() {
			resizeSliderPhotoVideo();
		})

		$(".validateSlider").off().on("click", function() {
			clearFileupload();
		})
		$(".add-photoSlider").off().on("click", function() {
			$("#sliderPhotoVideo").css("display", "none");
			$("#editSliderPhotoVideo").css("display", "block");
			$('#'+constImgKey+'_avatar').trigger("click");
		});
	});

	function initPhotoVideo(){
		j=0
		if(images.length != 0){
			var imagesTab = [];
			$.each(images, function(k,v){
				imagesTab.push(v);
			})
			
			for(i=imagesTab.length-1; i>=0; i--){
				var contentTab = imagesTab[i].contentKey.split(".");
				var where = contentTab[contentTab.length-1];
				if(j<5 && imagesTab[i].doctype=="image"){
					if(where == constImgKey){
						path = baseUrl+"/upload/"+imagesTab[i].moduleId+imagesTab[i].folder+imagesTab[i].name;
						var htmlSlide = "<li><img src='"+path+"' /></li>";
						var htmlSlide2 = "<div class='col-md-2 sliderPreview'><img src='"+path+"' /></div>";
						$("#showAllSlides").append(htmlSlide2);
						$("#slidesPhoto").append(htmlSlide);
						j++;
					}
				}
			}			
		}

		if(j==0){
			var htmlSlide = "<li>" +
								"<div class='center'>"+
									"<i class='fa fa-picture-o fa-5x text-green'></i>"+
									"<br>Click on <i class='fa fa-plus'></i> for share your pictures"+
								"</div>"+
							"</li>";
			$("#slidesPhoto").append(htmlSlide);
		}


		$("#flexsliderPhotoVideo").flexslider({
			controlNav : false,
		});
		$(".podPhotoVideoTitle").html("Media");

		widthSliderPhotoVideo = $("#sliderPhotoVideo .flexslider").css("width");
		$("#sliderPhotoVideo .flexslider").css("height", parseInt(widthSliderPhotoVideo)*45/100+"px");
		$("#sliderPhotoVideo .flexslider .slides li").css("height", parseInt(widthSliderPhotoVideo)*45/100-10+"px")
	}

	function clearFileupload(){
		$("#editSliderPhotoVideo").css("display", "none");
		$("#sliderPhotoVideo").css("display", "block");
		$('#'+constImgKey+'_avatar').val('');
		$('#'+constImgKey+'_fileUpload').fileupload("clear");
		removeSliderPhotoVideo()
		initPhotoVideo()
	}

	function updateSlider(image, id){
		
		if("undefined" != typeof images.length){
			images = {};
		}
		images[id] = image;
		

	}

	function bindPhotoSubview(){
		$( "#drag1" ).draggable();
		$( "#drag2" ).draggable();
		
		/*$(".add-photoSlider").off().on("click", function() {
			subViewElement = $(this);
			subViewContent = subViewElement.attr('href');
			$.subview({
				content : subViewContent,
				onShow : function() {
					//openGallery();
				},
				onHide : function() {
					hideMediaSubview();
				}
			});
		});*/
	}

	function removeSliderPhotoVideo(){
		$("#flexsliderPhotoVideo").removeData("flexslider");
		$("#flexsliderPhotoVideo").empty();
		$("#showAllSlides").empty();
		$("#flexsliderPhotoVideo").html('<ul class="slides" id="slidesPhoto">');
		$("#flexsliderPhotoVideo").flexslider();
	}

	function resizeSliderPhotoVideo(){
		removeSliderPhotoVideo();
		initPhotoVideo();
	}

	function hideMediaSubview(){
		$('#'+constImgKey+'_avatar').val('');
		$('#'+constImgKey+'_fileUpload').fileupload("clear");
		$.hideSubview();
	}
	function removeSliderImage(imageId){
		delete images[imageId];
	}
</script>