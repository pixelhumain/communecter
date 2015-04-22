<?php 
$this->renderPartial('newsSV');
?>

<!-- start: PAGE CONTENT -->
<div class="row">
	<div class="col-md-12">
		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white">
			<div class="panel-heading border-light">
				<h4 class="panel-title">News</h4>
				<ul class="panel-heading-tabs border-light">
		        	<li>
		        		<a class="new-news btn btn-info" href="#new-News">Add <i class="fa fa-plus"></i></a>
		        	</li>
		        </ul>
			</div>
			<div class="panel-body newsList">
					<?php 
					$compteur = 0;
					foreach ($news as $key => $value) 
					{
						$classNews = ($compteur) ? "blockquote-reverse" : "";
						$iconNews = ($compteur) ? "pull-right" : "pull-left";
						$gotoNews = (!$compteur) ? "pull-right" : "pull-left";
						$gotoNewsIcon = (!$compteur) ? "fa-arrow-circle-right" : "fa-arrow-circle-left";
					?>
						<blockquote class=" <?php echo $classNews ?> ">
							<div class="partition-white border-dark">
								<div class="timeline_title text-blue">
									<i class="fa fa-rss fa-2x <?php echo $iconNews ?> fa-border"></i>
									<h4 class="light-text no-margin padding-5">type : News</h4>
									<span class="block month text-small text-light"><?php echo date('d F Y H:i', $value["created"]); ?></span>
								</div>
								<div class="space10"></div>
								<?php echo ((strlen($value["text"]) > 250 ) ? substr($value["text"],0,250)."..." : $value["text"]).'<a href="javascipt:;" class=" openNewsEntry '.$gotoNews.'"><i class="fa '.$gotoNewsIcon.'"></i></a>';?>
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
	$(".date_separator").appear().on('appear', function(event, $all_appeared_elements) {
		separator = '#' + $(this).attr("id");
		$('.timeline-scrubber').find("li").removeClass("selected").find("a[href = '" + separator + "']").parent().addClass("selected");
	}).on('disappear', function(event, $all_disappeared_elements) {   				
		separator = $(this).attr("id");
		$('.timeline-scrubber').find("a").find("a[href = '" + separator + "']").parent().removeClass("selected");
	});
	$(".openNewsEntry").off().on("click",function(){
		toastr.info('TODO : open this news entry as a Subview or something');
	});

});

function updateNews(newsObj)
{
	var date = new Date( parseInt(newsObj.created)*1000 );
	var newsTLLine = buildNewsLineHTML(newsObj);
	$(".newsList").prepend(newsTLLine);
}

</script>