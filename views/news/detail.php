<?php 
$this->renderPartial('newsSV');

$cssAnsScriptFilesModule = array(
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/select2/select2.css',
	//X-editable...
	'/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/plugins/x-editable/js/bootstrap-editable.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/plugins/wysihtml5/wysihtml5.js',
	'/plugins/moment/min/moment.min.js',
	'/plugins/jquery.scrollTo/jquery.scrollTo.min.js',
	'/plugins/ScrollToFixed/jquery-scrolltofixed-min.js',
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'/plugins/jquery.appear/jquery.appear.js',
	'/plugins/jquery.elastic/elastic.js',
	'/plugins/select2/select2.css',
	'/plugins/select2/select2.min.js',

);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
?>	
<?php 
$this->renderPartial('newsSV');
$cs = Yii::app()->getClientScript();

		//$cs->registerCssFile("//cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
		$cs->registerScriptFile($this->module->assetsUrl.'/js/news/newsHtml.js' , CClientScript::POS_END);
$cssAnsScriptFilesModule = array(
		'/js/news/newsHtml.js'	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading border-light">
				<h4 class="panel-title">News</h4>
			</div>
			<div class="panel-body newsList">

			</div>
		</div>		
		<!-- end: TIMELINE PANEL -->
	</div>
</div>
<!-- end: PAGE CONTENT-->
<style type="text/css">
div.timeline .columns > li:nth-child(2n+2) {margin-top: 10px;}
.timeline_element {padding: 10px;}
</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
var news = <?php echo json_encode($news) ?>;
var idUser = "<?php echo Yii::app()->session["userId"] ?>";
jQuery(document).ready(function() 
{
	alert(idUser);
	newsTLLine=buildLineHTML(news,idUser);
	$(".newsList").append(newsTLLine);
	/*var separator, anchor;
	$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.timeline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.timeline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});
	$(".openNewsEntry").off().on("click",function(){
		toastr.info('TODO : open this news entry as a Subview or something');
	});*/

});

/*function updateNews(newsObj)
{
	var date = new Date( parseInt(newsObj.created)*1000 );
	var newsTLLine = buildNewsLineHTML(newsObj);
	$(".newsList").prepend(newsTLLine);
}*/

</script>