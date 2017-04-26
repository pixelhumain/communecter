<?php
	$cssAnsScriptFilesModule = array(
	'/plugins/mixitup/src/jquery.mixitup.js',
	);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->request->baseUrl);
	$cssAnsScriptFilesModule = array(
	'/js/pages-gallery.js',
	);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule,Yii::app()->theme->baseUrl."/assets");

$contextIcon = "photo";

if( isset($parent) ){
	$contextName = $parent["name"];
	$parentName=$parent["name"];
}
if(!@$_GET["renderPartial"])
		$this->renderPartial('../pod/headerEntity', array("entity"=>$parent, "type" => $itemType, "openEdition" => $openEdition, "edit" => $edit, "firstView" => "gallery")); 

?>
<!-- start: PAGE CONTENT -->
<style type="text/css">
	.gallery-img img{
		width: 200px;
		height: 200px;
	}

	.panel-tools{
		filter: alpha(opacity=1);
		-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=1)";
		-moz-opacity: 1;
		-khtml-opacity: 1;
		opacity: 1;
	}
	#Grid .mix {
		margin: 2px !important;
	}
	.content_image_album{
		float:left;
		width:200px;
		height:200px;
	}
	.portfolio-item > .tools.tools-bottom {
	    background-color: rgba(0,0,0,0.3);
	    bottom: 40px;
	    height: 40px;
	    line-height: 40px;
	    left: 0;
	    right: 0;
	    top: auto;
	    width: auto;
	    display: none;
	    position:relative;
	}
	.portfolio-item:hover > .tools.tools-bottom {
	    bottom:40px !important;
	    top:auto;
	  }
	.portfolio-item .tools.tools-bottom > a, .portfolio-item .tools.tools-top > a {
	    position: absolute;
	    right: 15px;
    	padding:inherit;
		color: white !important;
	}
	.portfolio-item .tools.tools-bottom > span, .portfolio-item .tools.tools-top > span {
	    position: absolute;
	    left: 15px;
    	padding:inherit;
		color: white !important;
	}
</style>
<div class="row" id="galleryPad">
	<div class="col-xs-12">
		<div class="">
			<div class="panel-body">
				<div class="controls">
					<ul class="nav nav-pills">
						<?php  if( Authorisation::canParticipate( Yii::app()->session['userId'], $itemType, $itemId ) ) {  ?>
						<li>
							<a class="btn btn-danger" href="javascript:elementLib.openForm('addPhoto')"><i class="fa fa-upload"></i> <?php echo Yii::t("common","Add Photos"); ?></a>
						</li>
						<?php  }  ?>
						<li class="filter active" data-filter="all">
							<a href="#"><?php echo Yii::t("common","Show All"); ?></a>
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
<?php if(!@$_GET["renderPartial"]){ 
	// End div .pad-element-container if newspaper of orga, project, event and person 
	// Present in pod/headerEntity.php
?>
</div>
<?php } ?>
<script type="text/javascript">

var images;
var tabButton = [];
var mapButton = {"media": "Media", "slider": "Album", "profil" : "Profil", "banniere" : "Banniere", "logo" : "Logo"};
var itemId = "<?php echo $itemId; ?>";
var itemType = "<?php echo $itemType; ?>";

var authorizationToEdit = <?php echo (isset($canEdit) && $canEdit) ? 'true': 'false'; ?>; 
var images = <?php echo json_encode($images); ?>;
var contextName = "<?php echo addslashes(@$contextName); ?>";	
var contextIcon = "<?php echo $contextIcon; ?>";
jQuery(document).ready(function() {
 	activeMenuElement("gallery");
	setTitle("Galerie photos de " + contextName,contextIcon);
	initGrid();
	$(".portfolio-item").mouseenter(function(){
		$(this).find(".tools.tools-bottom").show();
	}).mouseleave(function(){
		$(this).find(".tools.tools-bottom").hide();
	});

});

function initGrid(){
	mylog.log(images);
	j = 0;
	$.each(images, function(k, v){
		j++;
		if(k=="profil" || k=="slider"){
			if($.inArray(k, tabButton)==-1){
				tabButton.push(k);
				var liHtml = '<li class="filter" data-filter=".'+k+'">'+
								'<a href="#">' + mapButton[k] + '</a>'+
							 '</li>';
				$(".nav-pills").append(liHtml);
			}
			//$.each(v, function(docId, document) {
			for(var i = 0; i<v.length; i++){
				var	htmlBtn = ' <div class="tools tools-bottom">' +
								'<span>'+mapButton[k];
					if(authorizationToEdit)
						htmlBtn	+= '<small> - '+v[i].size+'</small>';
					htmlBtn+= '</span>';
					if(authorizationToEdit){
						htmlBtn	+= 	' <a href="#" class="btnRemove" data-id="'+v[i].id+'" data-name="'+v[i].name+'" data-key="';
						if(v[i].moduleId=="communevent")
							htmlBtn += v[i].moduleId;
						else
							htmlBtn += v[i].contentKey;
						htmlBtn += '" >' +
								' <i class="fa fa-trash-o"></i>'+
							' </a>';
					}
				htmlBtn+= 	' </div>';

				var htmlThumbail = '<li class="content_image_album mix '+k+' gallery-img no-padding" data-cat="1" id="'+v[i].id+'">'+
							' <div class="portfolio-item">'+
								' <a class="thumb-info" href="'+v[i].imagePath+'" data-lightbox="all">'+
									' <img src="'+v[i].imageThumbPath+'" class="img-responsive" alt="">'+
								' </a>' +
								//' <div class="chkbox"></div>' +
								htmlBtn +
							' </div>' +
						'</li>' ;
				$("#Grid").append(htmlThumbail);
			}
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
		var key = $(this).data("key");
		var path="";
		if(key == "slider")
			var path="album";
		else if(key=="communevent")
			var path=key;
//		var path = $(this).data("path");
		e.preventDefault();
		bootbox.confirm("<?php echo Yii::t('common','Are you sure you want to delete') ?> <span class='text-red'>"+$(this).data("name")+"</span> ?", 
			function(result) {
				if(result){
					$.ajax({
						url: baseUrl+"/"+moduleId+"/document/delete/dir/"+moduleId+"/type/"+itemType+"/parentId/"+itemId,
						type: "POST",
						dataType : "json",
						data: {"name": imageName, "parentId": itemId, "docId":imageId, "parentType": itemType, "path" : path, "source":"gallery"},
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