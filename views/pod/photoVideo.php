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
		max-width: 100%;
	}

	#editSliderPhotoVideo .fileupload .thumbail{
		max-width: 100%;
	}
	
	#photoVideo .flexslider .slides img {
	    position: relative;
	    height: 100%;
	    width: auto;
	    margin-left: auto;
	    margin-right: auto;
	    max-width: 100%;
	}

	#video iframe{
		width: 100%;
	}
	
</style>
<?php $canEdit = ((isset($photoVidId) && isset(Yii::app()->session["userId"]) && $photoVidId == Yii::app()->session["userId"])  
				|| (isset($photoVidId) && isset(Yii::app()->session["userId"] ) && strcmp($type, Organization::COLLECTION)==0 && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $photoVidId))
				|| (isset($insee)))?>
<div id="photoVideo">
    <div class="panel panel-white">
	    <div class="panel-heading border-light">
	        <h4 class="panel-title podPhotoVideoTitle"> <i class='fa fa-cog fa-spin fa-2x icon-big text-center'></i> Loading Media</h4>
	    </div>
	    <div class="panel-tools">
		   	<?php if ($canEdit) { ?>
			   <a href="#" class="add-photoSlider btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Add an image" alt="Add an image"><i class="fa fa-plus"></i></a>
		    <?php } ?>
		    <a href="<?php echo Yii::app()->createUrl("/".$this->module->id.'/gallery/index/id/'.$photoVidId.'/type/'.$type);?>" class="btn btn-xs btn-light-blue tooltips" data-toggle="tooltip" data-placement="top" title="Show gallery" alt=""><i class="fa fa-camera-retro"></i></a>
	    </div>
		<div class="panel-body border-light">
			
			<!--<div class="row center" id="sliderPhotoVideo">
				<div class="flexslider" id="flexsliderPhotoVideo">
					<ul class="slides" id="slidesPhoto">
						
					</ul>
				</div> -->
			<div class="row center" id="sliderPhotoVideo">
				<?php 
					$this->renderPartial('../pod/flexSlider', array("userId" => (string)$photoVidId,
																	  "type" => $type,
																	  "containerSlider" => "sliderPhotoVideo")); ?>

			</div>
			<div id="editSliderPhotoVideo">
				<div class="row">
					<?php 
						$this->renderPartial('../pod/fileupload', array("itemId" => (string)$photoVidId,
																		  "type" => $type,
																		  "resize" => true,
																		  "contentId" => Document::IMG_SLIDER,
																		  "editMode" => true)); ?>
				</div>
				<div class="row center">
					<a href="#" class="btn btn-light-blue validateSlider">Terminer </a>
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

<script type="text/javascript">
	var canEdit = <?php echo $canEdit ? $canEdit : "false" ?>;
 	jQuery(document).ready(function() {
 		

		$( window ).resize(function() {
			resizeSlider();
		})
		$(".validateSlider").off().on("click", function() {
			clearFileupload();
		})
		$(".add-photoSlider").off().on("click", function() {
			$("#sliderPhotoVideo").css("display", "none");
			$("#editSliderPhotoVideo").css("display", "block");
			$('#'+constImgKey+'_avatar').trigger("click");
		});

		if (canEdit) {
			activateVideoEditor();
		}

	});

	
	function clearFileupload(){
		$("#editSliderPhotoVideo").css("display", "none");
		$("#sliderPhotoVideo").css("display", "block");
		$('#'+constImgKey+'_avatar').val('');
		$('#'+constImgKey+'_fileUpload').fileupload("clear");
		removeSlider()
		initDashboardPhoto()
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

	function hideMediaSubview(){
		$('#'+constImgKey+'_avatar').val('');
		$('#'+constImgKey+'_fileUpload').fileupload("clear");
		$.hideSubview();
	}

	function activateVideoEditor() {
		$.fn.editable.defaults.mode = 'popup';

		$('#video').editable({
			pk: <?php echo json_encode($photoVidId) ?>,
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

	function removeSliderImage(imageId){
		delete images[imageId];
	}
</script>