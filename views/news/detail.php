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

	$cs = Yii::app()->getClientScript();

		//$cs->registerCssFile("//cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
		$cs->registerScriptFile($this->module->assetsUrl.'/js/news/newsHtml.js' , CClientScript::POS_END);
$cssAnsScriptFilesModule = array(
		'/js/news/newsHtml.js',
		'/js/news/index.js',
		'/css/news/index.css',
	
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
		<!-- start: TIMELINE PANEL -->
		<div id="newsHistory" class="padding-10">
		<!-- start: TIMELINE PANEL -->
			<div class="panel panel-white" style="padding-top:10px;box-shadow:inherit;">
				<div id="top" class="panel-body panel-white">
					<div id="timeline" class="col-md-12">
						<div class="timeline">
							<div class="newsList newsTL">
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
		<!-- end: TIMELINE PANEL -->
	</div>
</div>
<!-- end: PAGE CONTENT-->
<style type="text/css">
.timeline{
	float: left;
	min-width: 100%;
}
.date_separator span{
	font-family: "homestead";
	font-size: 21px;
	background-color: white !important;
	color: #315C6E !important;
	border: none !important;
	border-radius: 0px !important;
	border-bottom: 1px dashed #315C6E !important;

}

#newsHistory{
	overflow: scroll;
	overflow-x: hidden;

	/*padding-top:100px !important;*/
	bottom:0px;
	right:0px;
	left:70px;
}

#tagFilters a.filter, #scopeFilters a.filter{
	background-color: rgba(245, 245, 245, 0.7);
	font-size: 14px;
	padding: 5px;
	float: left;
	margin-right: 5px;
	margin-bottom: 5px;
	border-radius: 0px;
	-moz-box-shadow: -1px 1px 3px -2px #656565;
	-webkit-box-shadow: -1px 1px 3px -2px #656565;
	-o-box-shadow: -1px 1px 3px -2px #656565;
	box-shadow: -1px 1px 3px -2px #656565;
	filter:progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=224, Strength=3);
}


.optionFilter{
	margin-bottom:20px;
}

div.timeline .date_separator span{
	z-index: 3;
}
.editable-news{
	
}
.extract_url {
	font-family: 'lucida grande',tahoma,verdana,arial,sans-serif;
	font-size: 11px;
}
.extracted_url{
	min-height:100px;
	margin-top: 10px;
}
#get_url{
	max-width:100%; 
	resize: none;
}
#get_url:focus{
	background-color: white !important;
}
.get_url_input {
	width: 100%;
	border: 1px solid #8E9CA4;
	height: 25px;
	padding-left: 10px;
	font-family: Arial, Helvetica, sans-serif;
	padding-right: 30px;
	min-height: 50px;
}
.extracted_thumb {
	float: left;
	position:relative;
	margin-right: 10px;
}
.extracted_thumb_large{
	position:relative;
	max-height: 250px;
	overflow: hidden;
}
#loading_indicator{
	position: absolute;
    right: 10px;
    margin-top: 5px;
    display: none;
}
#results{
	display:none;
    border: 1px solid #eee;
}

.videoSignal{
	position: absolute;
    width: 100px;
    line-height: 100px;
    height: 100px;
    border: 3px solid;
    background-color: rgba(0,0,0,0.2);
    padding-top: 5px;
}

.thumb_sel {
	position: absolute;
    height: 22px;
    width: 55px;
    top: 0;
}
.thumb_sel .prev_thumb {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat -50px 0px;
	background-color: rgba(250,250,250,0.5);
	float: left;
	width: 26px;
	height: 22px;
	cursor: hand;
	cursor: pointer;
}
.thumb_sel .prev_thumb:hover {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat 0px 0px;
}
.thumb_sel .next_thumb {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat -76px 0px;
	background-color: rgba(250,250,250,0.5);
	float: left;
	width: 24px;
	height: 22px;
	cursor: hand; 
	cursor: pointer;
}
.thumb_sel .next_thumb:hover {
	background: url(<?php echo $this->module->assetsUrl ?>/images/news/thumb_selection.gif) no-repeat -26px 0px;
}
.small_text{
	font-size: 10px;
}


/*MISE EN PAGE SPECIALE POUR NOUVEAU DESIGN "SEARCH"*/
#newsHistory{
	top:110px !important;
	width: 100%;
	left: 16.62% !important;
	/*border-top: 1px solid #d4d4d4;*/
	padding: 0px !important;
}
#newsHistory .panel.panel-white{
	box-shadow: 0px 0px !important
}


.panel-scroll{
max-height: 250px !important;	
}
.blockUI{
	padding:inherit !important;
}

div.timeline .newsTL > .newsFeed {
    width: 100% !important;
	margin:auto;
}

div.timeline .newsTL > .newsFeed .timeline_element {
    /*float: right;*/
    left: 10%;
    margin-right: 30px;
    left: 0;
    opacity: 1;
}
div.timeline .newsTL > .newsFeed .timeline_element:after {
	display:none;
}
div.timeline .newsTL > .newsFeed .timeline_element:before {
	display:none;
}
.timeline_element {padding: 10px;}

.timeline_element {
	    max-width: unset !important;
	}
</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
var contextParentType = <?php echo json_encode(@$contextParentType) ?>;
var contextParentId = <?php echo json_encode(@$contextParentId) ?>;
var news = <?php echo json_encode($news) ?>;
var canManageNews="";
var mode="view";
var view = "detail";
var idSession = "<?php echo Yii::app()->session["userId"] ?>";
var months = ["<?php echo Yii::t('common','january') ?>", "<?php echo Yii::t('common','febuary') ?>", "<?php echo Yii::t('common','march') ?>", "<?php echo Yii::t('common','april') ?>", "<?php echo Yii::t('common','may') ?>", "<?php echo Yii::t('common','june') ?>", "<?php echo Yii::t('common','july') ?>", "<?php echo Yii::t('common','august') ?>", "<?php echo Yii::t('common','september') ?>", "<?php echo Yii::t('common','october') ?>", "<?php echo Yii::t('common','november') ?>", "<?php echo Yii::t('common','december') ?>"];
jQuery(document).ready(function() 
{
	$(".my-main-container").off(); 
	$(".moduleLabel").html("<i class='fa fa-rss'></i> L'actualité");
	newsTLLine=buildLineHTML(news,idSession);
	$(".newsList").append(newsTLLine);
	initXEditable();
	manageModeContext(news._id.$id);
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