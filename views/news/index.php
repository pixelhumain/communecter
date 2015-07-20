<?php 
$this->renderPartial('newsSV');
?>
<?php

if(Yii::app()->request->isAjaxRequest){
	echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js');
	echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');
}else{
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js' , CClientScript::POS_END);
}
?>	
	<!-- start: PAGE CONTENT -->
<div id="newsHistory">
	<div class="space20"></div>
	<div class="col-md-12">
		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading border-light">
				<h4 class="panel-title">News</h4>
				<ul class="panel-heading-tabs border-light">
		        	<li>
		        		<a class="new-news btn btn-info" href="#new-News">Add <i class="fa fa-plus"></i></a>
		        	</li>
			        <li class="panel-tools">
			          <div class="dropdown">
			            <a data-toggle="dropdown" class="btn btn-xs dropdown-toggle btn-transparent-grey">
			              <i class="fa fa-cog"></i>
			            </a>
			            <ul class="dropdown-menu dropdown-light pull-right" role="menu">
			              <li>
			                <a class="panel-collapse collapses" href="#"><i class="fa fa-angle-up"></i> <span>Collapse</span> </a>
			              </li>
			              <li>
			                <a class="panel-expand" href="#">
			                  <i class="fa fa-expand"></i> <span>Fullscreen</span>
			                </a>
			              </li>
			              </ul>
		          	  </div>
			        </li>
		        </ul>
			</div>
			<div class="panel-body panel-white">
				<ul class="timeline-scrubber inner-element newsTLmonthsList"></ul>
				<div id="timeline">
					<div class="timeline newsTL">
											
					</div>
				</div>
			</div>
		</div>
		<!-- end: TIMELINE PANEL -->
	</div>
</div>
<style type="text/css">
div.timeline .columns > li:nth-child(2n+2) {margin-top: 10px;}
.timeline_element {padding: 10px;}

</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
var news = <?php echo json_encode($news)?>;
var months = ["<?php echo Yii::t('common','january') ?>", "<?php echo Yii::t('common','febuary') ?>", "<?php echo Yii::t('common','march') ?>", "<?php echo Yii::t('common','april') ?>", "<?php echo Yii::t('common','may') ?>", "<?php echo Yii::t('common','june') ?>", "<?php echo Yii::t('common','july') ?>", "<?php echo Yii::t('common','august') ?>", "<?php echo Yii::t('common','september') ?>", "<?php echo Yii::t('common','october') ?>", "<?php echo Yii::t('common','november') ?>", "<?php echo Yii::t('common','december') ?>"];

jQuery(document).ready(function() 
{
	buildTimeLine();
});

function buildTimeLine()
{
	$(".newsTL").html('<div class="spine"></div>');
	$(".newsTLmonthsList").html('');
	console.log("buildTimeLine",Object.keys(news).length);
	
	currentMonth = null;
	countEntries = 0;
	$.each( news , function(key,newsObj)
	{
		if(newsObj.text && (newsObj.created || newsObj.created) && newsObj.name)
		{
			console.dir(newsObj);
			var date = new Date( parseInt(newsObj.created)*1000 );
			if(newsObj.date) {
				d = newsObj.date.split("/");
				month = parseInt(d[1])-1;
				date = new Date( d[2], month,d[0] ) ;
			}
			//console.dir(newsObj);
			var newsTLLine = buildLineHTML(newsObj);
			$(".newsTL"+date.getMonth()).append(newsTLLine);
			countEntries++;
		}
	});
	if(!countEntries)
		$(".newsTL").html("<div class='center text-extra-large'>Sorry, no news available</div>");
	bindEvent();
}

var currentMonth = null;
function buildLineHTML(newsObj)
{
	var date = new Date( parseInt(newsObj.created)*1000 );
	if(newsObj.date) {
		d = newsObj.date.split("/");
		month = parseInt(d[1])-1;
		date = new Date( d[2], month,d[0] ) ;
	}
	var year = date.getFullYear();
	var month = months[date.getMonth()];
	var day = (date.getDate() < 10) ?  "0"+date.getDate() : date.getDate();
	var hour = (date.getHours() < 10) ?  "0"+date.getHours() : date.getHours();
	var min = (date.getMinutes() < 10) ?  "0"+date.getMinutes() : date.getMinutes();
	var dateStr = day + ' ' + month + ' ' + year + ' ' + hour + ':' + min;
	console.log("date",dateStr);
	if( currentMonth != date.getMonth() )
	{
		currentMonth = date.getMonth();
		linkHTML =  '<li class="">'+
						'<a href="#month'+date.getMonth()+date.getFullYear()+'" data-separator="#month'+date.getMonth()+date.getFullYear()+'">'+months[date.getMonth()]+' '+date.getFullYear()+'</a>'+
					'</li>';
		$(".newsTLmonthsList").append(linkHTML);

		titleHTML = '<div class="date_separator" id="month'+date.getMonth()+date.getFullYear()+'" data-appear-top-offset="-400">'+
						'<span>'+months[date.getMonth()]+' '+date.getFullYear()+'</span>'+
					'</div>'+
					'<ul class="columns newsTL'+date.getMonth()+'"></ul>';
		$(".newsTL").append(titleHTML);
	}

	var color = "white";
	var icon = "fa-user";
	var url = baseUrl+'/'+moduleId+'/rpee/projects/perimeterid/';
	
	url = 'href="javascript:;" onclick="'+url+'"';	
	iconStr = '<i class=" fa fa-rss fa-2x pull-left fa-border"></i>';
	var title = newsObj.name;
	var text = newsObj.text;
	var tags = "";
	
	if( "object" == typeof newsObj.tags && newsObj.tags )
	{
		$.each( newsObj.tags , function(i,tag){
			tags += "<span class='label label-inverse'>"+tag+"</span> ";
		});
		tags = '<div class="pull-right"><i class="fa fa-tags"></i> '+tags+'</div>';
	}
	var objectDetail = (newsObj.object && newsObj.object.displayName) ? '<div>Name : '+newsObj.object.displayName+'</div>'	 : "";
	var objectLink = (newsObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;
	
	var personName = "Unknown";
	//var dateString = date.toLocaleString();
	var commentCount = 0;
	if ("undefined" != typeof newsObj.commentCount) 
		commentCount = newsObj.commentCount;
	
	newsTLLine = '<li><div class="timeline_element partition-'+color+'">'+
					tags+
					'<div class="timeline_title">'+
						objectLink+
						'<span class="text-large text-bold light-text no-margin padding-5">'+title+'</span>'+
					'</div>'+
					'<div class="space10"></div>'+
					text+	
					'<div class="space10"></div>'+
					
					'<hr><div class="pull-right"><i class="fa fa-clock-o"></i> '+dateStr+'</div>'+
					"<div class='bar_tools_post'>"+
					"<a href='javascript:;' class='newsAddComment' data-count='"+commentCount+"' data-id='"+newsObj._id['$id']+"'><span class='label label-info'>"+commentCount+" <i class='fa fa-comment'></i></span></a> "+
					"<a href='javascript:;' class='newsVoteUp' data-count='10' data-id='"+newsObj._id['$id']+"'><span class='label label-info'>10 <i class='fa fa-thumbs-up'></i></span></a> "+
					"<a href='javascript:;' class='newsVoteDown' data-count='10' data-id='"+newsObj._id['$id']+"'><span class='label label-info'>10 <i class='fa fa-thumbs-down'></i></span></a> "+
					"<a href='javascript:;' class='newsShare' data-count='10' data-id='"+newsObj._id['$id']+"'><span class='label label-info'>10 <i class='fa fa-share-alt'></i></span></a> "+
					"<span class='label label-info'>10 <i class='fa fa-eye'></i></span>"+
					"</div>"+
				'</div></li>';

	return newsTLLine;
}


function bindEvent(){
	var separator, anchor;
	$('.timeline-scrubber').scrollToFixed({
		marginTop: $('header').outerHeight() + 100
	}).find("a").on("click", function(e){			
		anchor = $(this).data("separator");
		$("body").scrollTo(anchor, 300);
		e.preventDefault();
	});
	$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.timeline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.timeline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});
	$('.newsAddComment').off().on("click",function(){
		window.location.href = baseUrl+"/<?php echo $this->module->id?>/comment/index/type/news/id/"+$(this).data("id");
		/*toastr.info('TODO : COMMENT this news Entry');
		console.log("newsAddComment",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-comment'></i>");*/
	});
	$('.newsVoteUp').off().on("click",function(){
		toastr.info('TODO : VOTE UP this news Entry');
		console.log("newsVoteUp",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-thumbs-up'></i>");
	});
	$('.newsVoteDown').off().on("click",function(){
		toastr.info('TODO : VOTE DOWN this news Entry');
		console.log("newsVoteDown",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-thumbs-down'></i>");
	});
	$('.newsShare').off().on("click",function(){
		toastr.info('TODO : SHARE this news Entry');
		console.log("newsShare",$(this).data("id"));
		count = parseInt($(this).data("count"));
		$(this).data( "count" , count+1 );
		$(this).children(".label").html($(this).data("count")+" <i class='fa fa-share-alt'></i>");
	});
}

function updateNews(newsObj)
{
	var date = new Date( parseInt(newsObj.created)*1000 );
	if(newsObj.date) {
		d = newsObj.date.split("/");
		month = parseInt(d[1])-1;
		date = new Date( d[2], month,d[0] ) ;
	}
	var newsTLLine = buildLineHTML(newsObj);
	$(".newsTL"+date.getMonth()).prepend(newsTLLine);
}

</script>
