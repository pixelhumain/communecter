<?php 
$cssAnsScriptFilesTheme = array(
	//X-editable...
	'/assets/plugins/x-editable/js/bootstrap-editable.js',
	'/assets/plugins/x-editable/css/bootstrap-editable.css',
	//wysihtml5
	'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.css',
	'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5-editor.css',
	'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/wysihtml5x-toolbar.min.js',
	'/assets/plugins/wysihtml5/bootstrap3-wysihtml5/bootstrap3-wysihtml5.min.js',
	'/assets/plugins/wysihtml5/wysihtml5.js'
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme);

?>

<style type="text/css">
	#editSliderPhotoVideo{
		display:none;
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

	#video iframe{
		width: 100%;
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
					<div class="col-sm-12 col-xs-12 padding-20" style="min-height: 250px">
						<a href="#" id="video" data-title="video" data-type="wysihtml5" data-emptytext="Video" class="editable editable-click">
						</a>
					</div>
				 </div>
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
																  "contentId" =>Document::IMG_MEDIA,
																  "editMode" => true)); ?>														  						
		</div>
	</div>
	<hr>
	<div class="row center" id="showAllSlides">
		
	</div>
</div>

<script type="text/javascript">

	var widthSliderPhotoVideo = $("#sliderPhotoVideo .flexslider").css("width");
	var constImgKey = '<?php echo Document::IMG_MEDIA; ?>';
 	jQuery(document).ready(function() {
 		$("#sliderPhotoVideo .flexslider").css("height", parseInt(widthSliderPhotoVideo)*45/100+"px");
 		initPhotoVideo();

		$( window ).resize(function() {
			resizeSliderPhotoVideo();
		})
		activateVideoEditor();
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


	function updateSlider(image, id){
		if("undefined" != typeof images.length){
			images = {};
		}
		images[id] = image;
		removeSliderPhotoVideo()
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
					hideMediaSubview();
				}
			});
		});
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

	function activateVideoEditor() {
		$.fn.editable.defaults.mode = 'popup';

		$('#video').editable({
			pk: <?php echo json_encode($itemId) ?>,
			url: baseUrl+"/"+moduleId+"/organization/updatefield", 
			onblur: 'submit',
			value: contextMap.video,
			placement: 'left',
			wysihtml5: {
				"font-styles":  false, //Font styling, e.g. h1, h2, etc
    			"color":        false, //Button to change color of font
    			"emphasis":     false, //Italics, bold, etc
    			"textAlign":    false, //Text align (left, right, center, justify)
    			"lists":        false, //(Un)ordered lists, e.g. Bullets, Numbers
    			"blockquote":   false, //Button to insert quote
    			"link":         false, //Button to insert a link
    			"table":        false, //Button to insert a table
    			"image":        false, //Button to insert an image
    			"video":        true, //Button to insert YouTube video
    			"html":         true //Button which allows you to edit the generated HTML
			}
		});
	}

</script>