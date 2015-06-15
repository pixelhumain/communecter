<?php
$cs = Yii::app()->getClientScript();

$cs->registerCssFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/css/lightbox.css');
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/lightbox2/js/lightbox.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/mixitup/src/jquery.mixitup.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-gallery.js' , CClientScript::POS_END);
?>
<!-- start: PAGE CONTENT -->
<style type="text/css">
	.gallery-img img{
		width: 100%;
		height: 175px;
	}

	.panel-tools{
		filter: alpha(opacity=1);
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
		-moz-opacity: 1;
		-khtml-opacity: 1;
		opacity: 1;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Gallery</h4>
				<div class="panel-tools">
					<a href="javascript:;" id="backToDashboardBtn" class="btn btn-xs btn-blue">Back</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="controls">
					<h5>Filter Controls</h5>
					<ul class="nav nav-pills">
						<li class="filter active" data-filter="all">
							<a href="#">
								Show All
							</a>
						</li>
					</ul>
				</div>
				<hr/>
				<!-- GRID -->
				<ul id="Grid" class="list-unstyled">
					<!-- "gap" elements fill in the gaps in justified grid -->
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- end: PAGE CONTENT-->

<script type="text/javascript">

var images;
var tabButton = [];
var mapButton = {"media": "Media", "slider": "Slider", "profil" : "Profil", "banniere" : "Banniere", "logo" : "Logo"};
var itemId = "<?php echo $itemId; ?>"
var itemType = "<?php echo $itemType; ?>"
var controllerId = "<?php echo $controllerId; ?>"

var authorizationToEdit = <?php echo (isset($canEdit) && $canEdit) ? 'true': 'false'; ?>; 
var images = <?php echo json_encode($images); ?>;

jQuery(document).ready(function() {
	
	initGrid();


	$("#backToDashboardBtn").off().on("click", function(){
		document.location.href=baseUrl+"/"+moduleId+"/"+controllerId+"/dashboard/id/"+itemId;
	})
});

function initGrid(){
	console.log(images);
	j = 0;
	$.each(images, function(k, v){
		j++;
		
		if($.inArray(k, tabButton)==-1){
			tabButton.push(k);
			var liHtml = '<li class="filter" data-filter=".'+k+'">'+
							'<a href="#">' + mapButton[k] + '</a>'+
						 '</li>';
			$(".nav-pills").append(liHtml);
		}
		//$.each(v, function(docId, document) {
		for(var i = 0; i<v.length; i++){
			var htmlBtn = "";
			if(authorizationToEdit){
				htmlBtn= ' <div class="tools tools-bottom">' +
								' <a href="#" class="btnRemove" data-id="'+v[i]["_id"]["$id"]+'" data-name="'+v[i].name+'" data-key="'+v[i].contentKey+'" >' +
									' <i class="fa fa-trash-o"></i>'+
								' </a>'+
							' </div>'
			}
			var path = baseUrl+v[i]["imageUrl"];
			var htmlThumbail = '<li class="col-md-3 col-sm-6 col-xs-12 mix '+k+' gallery-img" data-cat="1" id="'+v[i]["_id"]["$id"]+'">'+
						' <div class="portfolio-item">'+
							' <a class="thumb-info" href="'+path+'" data-title="Website"  data-lightbox="all">'+
								' <img src="'+path+'" class="img-responsive" alt="">'+
								' <span class="thumb-info-title">'+k+'</span>' +
							' </a>' +
							' <div class="chkbox"></div>' +
							htmlBtn +
						' </div>' +
					'</li>' ;
			$("#Grid").append(htmlThumbail);
		}
	})
	if(j>0){
		bindBtnGallery();
		$('#Grid').mixItUp();
		$('.portfolio-item .chkbox').bind('click', function () {
	        if ($(this).parent().hasClass('selected')) {
	            $(this).parent().removeClass('selected').children('a').children('img').removeClass('selected');
	        } else {
	            $(this).parent().addClass('selected').children('a').children('img').addClass('selected');
	        }
	    });
	}else{
		var htmlDefault = "<div class='center'>"+
							"<i class='fa fa-picture-o fa-5x text-blue'></i>"+
							"<br>No picture to show"+
						"</div>";
		$('#Grid').append(htmlDefault);
	}
}

function bindBtnGallery(){
	$(".portfolio-item .btnRemove").on("click", function(e){
		var imageId= $(this).data("id");
		var imageName= $(this).data("name");
		var key = $(this).data("key")
		e.preventDefault();
		bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+$(this).data("name")+"</span> ?", 
			function(result) {
				if(result){
					$.ajax({
						url: baseUrl+"/"+moduleId+"/document/delete/dir/"+moduleId+"/type/"+itemType+"/parentId/"+itemId,
						type: "POST",
						dataType : "json",
						data: {"name": imageName, "parentId": itemId, "docId":imageId, "parentType": itemType, "pictureKey" : key, "path" : ""},
						success: function(data){
							if(data.result){
								$("#"+imageId).remove();
								toastr.success(data.msg);
							}else{
								toastr.error(data.error)
							}
						}
					})
				}
			})
	})
}
</script>