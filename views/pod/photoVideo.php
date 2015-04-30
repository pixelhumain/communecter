<style type="text/css">
	#editSliderPhotoVideo{
		display:none;
	}
	#photoVideo .flexslider .slides li {
	    height: 250px;   
	}
	#photoVideo .flexslider .slides img {
	    position: relative;
	    height: 100%;
	    width: auto;
	    margin-left: auto;
	    margin-right: auto;
	}
	#photoVideo .flexslider {
		height: 260px;
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
			   <a href="#editSliderPhotoVideo" class="add-photoSlider btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an image" alt="Add an image"><i class="fa fa-plus"></i></a>
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


<div id="editSliderPhotoVideo" >
	<div class="row center">
		<div class="col-md-6 col-md-offset-3">
			<?php 
				$this->renderPartial('../pod/fileupload', array("itemId" => (string)$itemId,
																  "type" => $type,
																  "contentId" =>"photoVideo",
																  "editMode" => true)); ?>														  						
		</div>
	</div>
	<hr>
	<div class="row center" id="showAllSlides">
		
	</div>
</div>

<script type="text/javascript">
 	jQuery(document).ready(function() {
 		initPhotoVideo();
		$("#flexsliderPhotoVideo").flexslider({
			controlNav : false,
		});
	});

	function initPhotoVideo(){
		i=0;
		if(images.length == 0){
			var htmlSlide = "<li><img src='http://placehold.it/350x180' /></li>";
			$("#slidesPhoto").append(htmlSlide);
		}else{
			var imagesTab = [];
			$.each(images, function(k,v){
				imagesTab.push(v);
			})
			j=0
			for(i=imagesTab.length-1; i>=0; i--){
				var contentTab = imagesTab[i].contentKey.split(".");
				var where = contentTab[contentTab.length-1];
				if(j<5 && imagesTab[i].doctype=="image"){
					if(where == "photoVideo"){
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
		$("#flexsliderPhotoVideo").flexslider();
		$(".podPhotoVideoTitle").html("Media");
	}


	function updateSlider(image, id){
		images[id] = image;
		$("#flexsliderPhotoVideo").removeData("flexslider");
		$("#flexsliderPhotoVideo").empty();
		$("#showAllSlides").empty();
		$("#flexsliderPhotoVideo").html('<ul class="slides" id="slidesPhoto">');
		$("#flexsliderPhotoVideo").flexslider();
		initPhotoVideo()

	}

	function bindPhotoSubview(){
		$( "#drag1" ).draggable();
		$( "#drag2" ).draggable();
		
		$(".add-photoSlider").off().on("click", function() {
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
</script>