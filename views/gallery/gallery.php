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
</style>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Gallery</h4>
				<div class="panel-tools">
					<div class="dropdown">
						<a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
							<i class="fa fa-cog"></i>
						</a>
						<ul class="dropdown-menu dropdown-light pull-right" role="menu">
							<li>
								<a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
							</li>
							<li>
								<a class="panel-refresh" href="#">
									<i class="fa fa-refresh"></i> <span>Refresh</span>
								</a>
							</li>
							<li>
								<a class="panel-config" href="#panel-config" data-toggle="modal">
									<i class="fa fa-wrench"></i> <span>Configurations</span>
								</a>
							</li>
							<li>
								<a class="panel-expand" href="#">
									<i class="fa fa-expand"></i> <span>Fullscreen</span>
								</a>
							</li>
						</ul>
					</div>
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
					<li class="gap"></li>
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
var itemId = "<?php echo $itemId; ?>"
var itemType = "<?php echo $itemType; ?>"
var authorizationToEdit = "<?php if(isset(Yii::app()->session["userId"]) && Authorisation::canEditItem(Yii::app()->session["userId"], $itemType, $itemId)) echo 'true' ; else echo 'false'; ?>"; 

jQuery(document).ready(function() {
	initGrid();
	
	
});

function initGrid(){
	$.ajax({
		url: baseUrl+"/"+moduleId+"/gallery/getlistbyid/id/"+itemId+"/type/"+itemType,
		type: "POST",
		dataType : "json",
		success: function(data){
			$.each(data, function(k, v){
				if(v.doctype == "image"){
					var path = baseUrl+"/upload/"+v.moduleId+v.folder+v.name;
					var type = v.contentKey.split(".")[2];
					if($.inArray(type, tabButton)==-1){
						tabButton.push(type);
						var liHtml = '<li class="filter" data-filter=".'+type+'">'+
										'<a href="#">' + type + '</a>'+
									 '</li>';
						$(".nav-pills").append(liHtml);
					}
					var htmlBtn = "";
					if(authorizationToEdit=="true"){
						htmlBtn= ' <div class="tools tools-bottom">' +
									' <a href="#" class="btnRemove" data-id="'+v["_id"]["$id"]+'" data-name="'+v.name+'"  >' +
										' <i class="fa fa-trash-o"></i>'+
									' </a>'+
								' </div>'
						}
					var htmlThumbail = '<li class="col-md-3 col-sm-6 col-xs-12 mix '+type+' gallery-img" data-cat="1" id="'+v["_id"]["$id"]+'">'+
								' <div class="portfolio-item">'+
									' <a class="thumb-info" href="'+path+'" data-title="Website"  data-lightbox="'+v.contentKey+'">'+
										' <img src="'+path+'" class="img-responsive" alt="">'+
										' <span class="thumb-info-title">'+v.contentKey.split(".")[1]+'</span>' +
									' </a>' +
									' <div class="chkbox"></div>' +
									htmlBtn +
								' </div>' +
							'</li>' ;
					$("#Grid").append(htmlThumbail);
				}
			})
			bindBtnGallery();
			$('#Grid').mixItUp();
			$('.portfolio-item .chkbox').bind('click', function () {
		        if ($(this).parent().hasClass('selected')) {
		            $(this).parent().removeClass('selected').children('a').children('img').removeClass('selected');
		        } else {
		            $(this).parent().addClass('selected').children('a').children('img').addClass('selected');
		        }
		    });
		}
	})

}
function bindBtnGallery(){
	$(".portfolio-item .btnRemove").on("click", function(e){
		var imageId= $(this).data("id");
		var imageName= $(this).data("name");
		e.preventDefault();
		$.ajax({
			url: baseUrl+"/templates/delete/dir/"+moduleId+"/type/"+itemType,
			type: "POST",
			dataType : "json",
			data: {"name": itemId+"/"+imageName},
			success: function(data){
				$.ajax({
					url:  baseUrl+"/"+moduleId+"/gallery/removeById/id/"+imageId,
					type: "POST",
					dataType : "json",
					success: function(data){
						$("#"+imageId).remove();
						toastr.success("Image supprimé");
					}
				})
			}
		})
	})
}
</script>