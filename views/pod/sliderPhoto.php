
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
		<div class="dropdown">
			<a class="btn btn-xs dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
				<i class="fa fa-cog"></i>
			</a>
			<ul role="menu" class="dropdown-menu dropdown-light pull-right">
				<li>
					<a href="#" class="panel-collapse collapses"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
				</li>
			<?php if((isset($userId) && isset(Yii::app()->session["userId"]) && $userId == Yii::app()->session["userId"])  || (isset($organizationId) && isset(Yii::app()->session["userId"]) && Authorisation::isOrganizationAdmin(Yii::app()->session["userId"], $organizationId))) { ?>
				<li>
					<a href="#addPhoto" class="add-photo" data-toggle="tooltip" data-placement="top" title="Add image" alt="Add image"><i class="fa fa-plus"></i> Add image</a>
				</li>
			<?php } ?>
			</ul>
		</div>
		<a href="#" class="btn btn-xs btn-link panel-close">
			<i class="fa fa-times"></i>
		</a>
	</div>
	<div class="panel-body">
		<div class="center">
			<div class="flexslider" id="flexslider2">
				<ul class="slides" id="slides2">
					
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
							<input type="file" name="avatar" id="avatar">
						</span>
						<a href="#" class="btn fileupload-exists btn-red" data-dismiss="fileupload">
							<i class="fa fa-times"></i> Remove
						</a>
						<input class="btn fileupload-exists btn-light-blue" type="submit" value="Upload File" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" charset="utf-8">
	var id = "<?php if(isset($userId)) echo $userId; else if(isset($organizationId)) echo $organizationId; ?>";
	var type= '<?php if(isset($userId)) echo "person"; else if(isset($organizationId)) echo "organization"; ?>';

	 jQuery(document).ready(function() {
		initDashboardPhoto();
		bindPhotoSubview();
		$("#flexslider2").flexslider();


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
		  			for(var i=data.length-1; i>=0; i--){
						var htmlSlide = "<li><img src='"+data[i]+"' /></li>";
						$("#slides2").append(htmlSlide);
					}
					$("#flexslider2").flexslider();
				}
		  		else
		  			toastr.error(data.msg);
		  },
		});
		
	}

	function bindPhotoSubview(){
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
			e.preventDefault();
			$.ajax({
				url: baseUrl+"/"+moduleId+"/api/saveUserImages/type/"+type+"/id/"+id,
				type: "POST",
				data: new FormData(this),
				contentType: false,
				cache: false, 
				processData: false,
				success: function(data){
			  		if(data.result)
			  			toastr.success(data.msg);
			  		else
			  			toastr.error(data.msg);
			  },
			});
		}));
	}
</script>