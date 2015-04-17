<?php 
$this->renderPartial('newsSV');
?>
<?php
if(Yii::app()->request->isAjaxRequest){
	echo CHtml::scriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js');
}else{
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/ScrollToFixed/jquery-scrolltofixed-min.js' , CClientScript::POS_END);
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
}
function buildTimeLine()
{
	$(".newsTL").html('<div class="spine"></div>');
	$(".newsTLmonthsList").html('');
	console.log("buildTimeLine",Object.keys(news).length);
	
	currentMonth = null;
	$.each( news , function(key,newsObj)
	{
		if(newsObj.msg && newsObj.created)
		{
			var date = new Date( parseInt(newsObj.created)*1000 );
			var year = date.getFullYear();
			var month = months[date.getMonth()];
			var day = date.getDate();
			var hour = date.getHours();
			var min = date.getMinutes();
			var dateStr = day + ' ' + month + '' + year + ' ' + hour + ':' + min;
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
			iconStr = '<i class=" fa fa-pencil fa-2x pull-left fa-border"></i>';
			var content = newsObj.msg;
			var objectDetail = (newsObj.object && newsObj.object.displayName) ? '<div>Name : '+newsObj.object.displayName+'</div>'	 : "";
			var objectLink = (newsObj.object) ? ' <a '+url+'>'+iconStr+'</a>' : iconStr;
			
			var personName = "Unknown";
			//var dateString = date.toLocaleString();
			
			newsTLLine = '<li><div class="timeline_element partition-'+color+'">'+
								'<div class="timeline_title">'+
									objectLink+
									'<span class="text-large text-bold light-text no-margin padding-5">'+content+'</span>'+
								'</div>'+
								'<div class="space10"></div>'+	
								'<div class="pull-right"><i class="fa fa-clock-o"></i> '+dateStr+'</div>'+
								"<div class='bar_tools_post'>"+
								"<ul>"+
									"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-comment'></i></span></li>"+
									"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-thumbs-up'></i></span></li>"+
									"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-thumbs-down'></i></span></li>"+
									"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-share-alt'></i></span></li>"+
									"<li style='float:left; margin-top:2px;'>10 <i class='fa fa-eye'></i></span></li>"+
								"</ul>"+
								"</div>"+
							'</div></li>';

			$(".newsTL"+date.getMonth()).append(newsTLLine);
		}
	});
	bindEvent();
}

</script>