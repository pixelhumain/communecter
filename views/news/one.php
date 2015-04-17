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
<div class="row">
	<div class="col-md-12">
		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading">
				<h4 class="panel-title">Timeline</h4>
			</div>
			<div class="panel-body">
						<div class="partition-white">
							<div class="timeline_date">
								<div>
									<div class="inline-block">
										<span class="day text-bold">02</span>
									</div>
									<div class="inline-block">
										<span class="block week-day text-extra-large">Wensdey</span>
										<span class="block month text-large text-light">november 2014</span>
									</div>
								</div>
							</div>
							<div class="timeline_title">
								<i class="fa fa-check fa-2x pull-left fa-border"></i>
								<h4 class="light-text no-margin padding-5">Appointment</h4>
							</div>
							<div class="timeline_content">
								<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
							</div>
							<div class="readmore">
								<a href="#" class="btn btn-green">
									Read More <i class="fa fa-arrow-circle-right"></i>
								</a>
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
div.timeline .columns > li:nth-child(2n+2) {margin-top: 10px;}
.timeline_element {padding: 10px;}
</style>
<!-- end: PAGE CONTENT-->
<script type="text/javascript">
jQuery(document).ready(function() 
{
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
});
</script>