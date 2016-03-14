
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
			<?php if((isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"])  || (isset($itemId) && isset(Yii::app()->session["userId"]) && Authorisation::canEditItem(Yii::app()->session["userId"], $type, $itemId)) || (isset($isAdmin))) { ?>
				<a href="#" class="add-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add image" alt="Add image"><i class="fa fa-plus"></i></a>
				<a href="#" class="setbgCustom btn btn-xs btn-light-blue " data-class="bgCustom"  title="Set as Background" alt="Set as Background">Set as Background</a>
			<?php } ?>
			<a href="#galleryPhoto" class="gallery-photo btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Show gallery" alt="Show gallery"><i class="fa fa-camera"></i> Show gallery</a>
		</div>
		<div class="panel-body">
			<div class="center">
				<!--<div class="flexslider" id="flexsliderPhoto">
					<ul class="slides" id="slidesPhoto">
						
					</ul>
				</div> -->
				<?php 
					if(isset($userId)){
						$itemId = $userId;
						$type = Person::COLLECTION;
					}
					$this->renderPartial('../pod/flexSlider', array("itemId" => $itemId,
																	  "type" => $type,
																	  "containerSlider" => "sliderPhotoPod")); ?>
				
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
																				  "resize" => true,
																				  "contentId" =>Document::IMG_SLIDER,
																				  "editMode" => true)); ?>
				</div>
				<div class="row center">
					<a href="#" class="btn btn-light-blue validateSlider">Terminer </a>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
	
 	var constImgKey = "<?php echo Document::IMG_SLIDER ; ?>";
 	var bgClasses = [
		{key : 'bggrey', name : "Grey"},
		{key : 'bgdark', name : "Dark"},
		{key : 'bgblack', name : "Black"},
		{key : 'bgblue', name : "Blue"},
		{key : 'bggreen', name : "Green"},
		{key : 'bgred', name : "Red"},
		{key : 'bgyellow', name : "Yellow"},

		{key : 'bgcity', name : "City"},
		{key : 'bgwave', name : "Wave"},
		{key : 'bgseasky', name : "Sea Sky"},
		{key : 'bggreenImg', name : "Leaf Drops"},

		{key : 'bgcloud', name : "Cloud"},
		{key : 'bgcrowd', name : "Crowd"},
		{key : 'bgcrowd2', name : "Crowd"},
		{key : 'bgfaces', name : "Faces"},

		{key : 'bgwater', name : "Water"},
		{key : 'bgeau', name : "Water"},
		{key : 'bgfrings', name : "Frings"},
		{key : 'bgtree', name : "Tree"},
		{key : 'bgtree1', name : "Tree"},
		//{key : 'bgCustom', name : "From my Gallery"},
	];
	var existingClasses = "";
	jQuery(document).ready(function() {
	 	$.each(bgClasses,function(i,v) { 
			existingClasses += " "+v.key;
		});
		bindPhotoSubview();

		$(".gallery-photo").on("click", function()
		{
			location.href = baseUrl+"/"+moduleId+"/gallery/index/id/"+id+"/type/"+type;
		})

		
		$(".validateSlider").off().on("click", function() 
		{
			clearFileupload();
		})

		$(".add-photo").off().on("click", function() 
		{
			$("#sliderPhotoPod .flexslider").css("display", "none");
			$("#addPhoto").css("display", "block");
			$('#'+constImgKey+'_avatar').trigger("click");
		});
		$(".setbgCustom").off().on("click", function() 
        {
        	if( $("#slidesPhoto > li.flex-active-slide > img").attr('src') ) 
        	{
        		setBg("bgCustom",$("#slidesPhoto > li.flex-active-slide > img").attr('src'));
                $(".main-container").attr("style","background-image:url('"+$("#slidesPhoto > li.flex-active-slide > img").attr('src')+"')");
            }
        })

	});
	function setBg( bg, url ) 
	{	
		$(".main-container").attr("style","");
		$(".main-container").removeClass(existingClasses).addClass(bg);
		
		$.ajax({
	        type: "POST",
	        url: baseUrl+"/"+moduleId+"/person/updatefield",
	        dataType : "json",
	        data: {
	        	"name" : "bgClass",
				"pk" : "<?php echo Yii::app()->session['userId']?>",
				"value" : bg,
				"url" : url
	        }
	    })
	    .done(function (data) 
	    {
	    	if(! data.result) 
	    		toastr.error(data.msg); 
	    });
	}

	function bindPhotoSubview(){
		$("#avatar").fileupload({allowedFileExtensions:['jpg', 'gif', 'png']})
	}

	//resetForm
	function hidePhotoSv(){
		
		$("#uploadBtn").empty();
		$("#uploadBtn").html("Upload File");
		$(".fileupload").fileupload("clear");
		//$.hideSubview();
	}

	function hideFileuploadSubview(){
		$('#'+constImgKey+'_avatar').val('');
		$('#'+constImgKey+'_fileUpload').fileupload("clear");
		//$.hideSubview();
	}

	function clearFileupload(){
		$("#addPhoto").css("display", "none");
		$("#sliderPhotoPod .flexslider").css("display", "block");
		$('#'+constImgKey+'_avatar').val('');
		$('#'+constImgKey+'_fileUpload').fileupload("clear");
		removeSlider()
		initDashboardPhoto()
	}
</script>