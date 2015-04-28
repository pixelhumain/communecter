<style type="text/css">
	#editSliderPhotoVideo{
		display:none;
	}
	.flexslider .slides img {
	    height: 250px;
	}
</style>

<div id="photoVideo">
    <div class="panel panel-white">
	    <div class="panel-heading border-light">
	        <h4 class="panel-title podPhotoVideoTitle"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Media</h4>
	    </div>
	    <div class="panel-tools">
		   	<?php if((isset($itemId) && isset(Yii::app()->session["userId"]) && $itemId == Yii::app()->session["userId"])  || (isset($itemId) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $itemId))) { ?>
			   <a href="#addPhoto" class="new-event btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an image" alt="Add an image"><i class="fa fa-plus"></i></a>
		    <?php } ?>
	    </div>
		<div class="panel-body border-light">
			<div class="row center" id="editSliderPhotoVideo">
				<?php 
					if(!isset($images["photoVideo"])){
							$images["photoVideo"] = "";
					}
					$this->renderPartial('../pod/fileupload', array("itemId" => (string)$itemId,
																	  "type" => $type,
																	  "contentKey" => $type.".dashboard.photoVideo",
																	  "contentId" =>"photoVideo",
																	  "imagePath" => $images["photoVideo"],
																	  "editMode" => true)); ?>
			</div>
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
<script type="text/javascript">
	
 	jQuery(document).ready(function() {
 		var images = <?php echo json_encode($images["photoVideo"]); ?>;
 		initPhotoVideo();
		$("#flexsliderPhotoVideo").flexslider();
	});

	function initPhotoVideo(){
		i=0;
		if(images.length == 0){
			var htmlSlide = "<li><img src='http://placehold.it/350x180' /></li>";
			$("#slidesPhoto").append(htmlSlide);
		}else{
			$.each(images, function(k,v){
				console.log(k, v);
				if(i<5){
					var htmlSlide = "<li><img src='"+v+"' /></li>";
					$("#slidesPhoto").append(htmlSlide);
					i++;
				}
				
			})
		}
		$("#flexsliderPhotoVideo").flexslider();
		$(".podPhotoVideoTitle").html("Media");
	}
</script>