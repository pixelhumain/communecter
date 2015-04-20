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
			<div class="panel-body">
					<?php 
					$compteur = 0;
					foreach ($news as $key => $value) 
					{
						$classNews = ($compteur) ? "blockquote-reverse" : "";
						$iconNews = ($compteur) ? "pull-right" : "pull-left";
					?>
						<blockquote class=" <?php echo $classNews ?> ">
							<div class="partition-white border-dark">
								<div class="timeline_date">
									<div>
										<div class="inline-block">
											<span class="block month text-large text-light"><?php echo date('d F Y H:i', $value["created"]); ?></span>
										</div>
									</div>
								</div>
								<div class="timeline_title text-blue">
									<i class="fa fa-rss fa-2x <?php echo $iconNews ?> fa-border"></i>
									<h4 class="light-text no-margin padding-5">type : News</h4>
								</div>
								<div class="timeline_content">
									<?php echo $value["text"]; echo "<br/>".date("Y-m-d H:i:s", $value["created"]);?>
								</div>
								<div class="readmore">
									<a href="#" class="btn btn-green">
										<i class="fa fa-arrow-circle-right"></i>
									</a>
								</div>
							</div>
						</blockquote>
						<div class="space20"></div>
					<?php 
						$compteur = ($compteur) ? 0 : 1;
					} ?>
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