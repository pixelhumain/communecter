
<div class="flexslider">
	<ul class="slides" id="slidesPhoto">
		
	</ul>
</div>


<script type="text/javascript" charset="utf-8">
	
	var containerSlider = "<?php if(isset($containerSlider)) echo $containerSlider; ?>";
	var id = "<?php if(isset($userId)) echo $userId; else if(isset($itemId)) echo $itemId; ?>";
	var type = '<?php if(isset($userId)) echo Person::COLLECTION; else if(isset($type)) echo $type; ?> '

	var constImgKey = "<?php echo Document::IMG_SLIDER ; ?>";
	var imagesTab;

	 jQuery(document).ready(function() {


	 	var widthSlider = $("#"+containerSlider+" .flexslider").css("width");


	 	$("#"+containerSlider+" .flexslider").css("height", parseInt(widthSlider)*45/100+"px");
	 	$("#"+containerSlider+" .flexslider .slides li").css("max-width", parseInt(widthSlider)+"px");
		initDashboardPhoto();


		$( window ).resize(function() {
			resizeSlider();
		})

		$(".validateSlider").off().on("click", function() {
			clearFileupload();
		})

	});
	

	 function initDashboardPhoto(){
		j=0;

		if("undefined" != typeof(images[constImgKey.toLowerCase()])){
			imagesTab = images[constImgKey.toLowerCase()];
			if(imagesTab.length != 0){
				
				for(i=0; i<=imagesTab.length-1; i++){
					if(j<5){
						path = baseUrl+imagesTab[i];
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
		
		$("#"+containerSlider+" .flexslider").flexslider({
			controlNav : false,
		});
		$(".podPhotoVideoTitle").html("Media");

		widthSlider = $("#"+containerSlider+" .flexslider").css("width");
		$("#"+containerSlider+" .flexslider").css("height", parseInt(widthSlider)*45/100+"px");
		$("#"+containerSlider+" .flexslider .slides li").css("height", parseInt(widthSlider)*45/100-10+"px");

	}

	function updateSlider(dir, id){
		if("undefined" == typeof images){
			images = {};
		}
		if("undefined" == typeof images[constImgKey.toLowerCase()] ){
			images[constImgKey.toLowerCase()] = [];
		}
		images[constImgKey.toLowerCase()].unshift(dir);
	}


	function resizeSlider(){
		removeSlider();
		initDashboardPhoto()
	}

	function removeSlider(){
		$("#"+containerSlider+" .flexslider").removeData("flexslider");
		$("#"+containerSlider+" .flexslider").empty();
		$("#"+containerSlider+" .flexslider").html('<ul class="slides" id="slidesPhoto">');
	}

	function updateShiftSlider(){
		images[constImgKey.toLowerCase()].shift();
	}
	

</script>
