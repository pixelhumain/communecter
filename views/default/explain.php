<style>
.main-col-search{	padding:0px !important; }
.fa-caret-down{font-size:56px;line-height: 10px;}
.social-list{	padding: 0;}
.social-list li{	list-style-type: none;	display:inline;margin-right:10px;}
.social-list li a{ font-size:20px;}
.social-list .btn{	margin-top: 15px;}
a.btn.btn-social{	color: #FFF;	background-color: #2a3945; }
a.btn.btn-social:hover{	background: none;}
a.btn.btn-facebook:hover{	color: #3b5998;}
a.btn.btn-twitter:hover{	color: #00a0d1;	border-color: #00a0d1;}
a.btn.btn-google:hover{	color: #dd4b39;	border-color: #dd4b39;}
a.btn.btn-github:hover{	color: #4078C0;	border-color: #4078C0;}
.yellowph{color:#F6E201;}
.information{font-size:15px;color:#8b91a0;}
.explainTitle{cursor:pointer; background-color: #449D44; padding: 10px; text-align: center; color: #fff;margin:0px;border-top: 1px solid #666;}
.explainTitle.blue{background-color: #32454E}
.explainTitle:hover{opacity: 0.8}
.explainDesc{ padding: 10px; background-color: white; }
.caretExplain{position: relative;top: 0px;background-color: white;color:#449D44;}
.caretExplain.blue{background-color: white; color:#32454E}
</style>


<div class="home_page"  style="margin-top:50px">
	<?php echo $this->renderPartial('explainPanels',array("class"=>"explain2")); ?>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
	$(".moduleLabel").html('<?php echo Yii::t("common","Frequently Asked Questions") ?>');
	/*
	$(".explain").each(function(i,e) { 
		title = $(e).find(".explainTitle").text();
		//$(this).removeClass('explain');
		el = $(e);
		$(".home_page").append( el[0] );
		$(".home_page .explain").last().removeClass("explain");
		//console.dir($(e)[0]);
	});
	*/

	$(".explainDesc,.caretExplain").addClass("hide");

	$(".home_page .explain2").removeClass("hide").click( function() 
	{ 
		$(".explainDesc,.caretExplain").addClass("hide");
		if( $(this).find(".explainDesc,.caretExplain").hasClass("hide"))
			$(this).find(".explainDesc,.caretExplain").removeClass("hide");
		else
			$(this).find(".explainDesc,.caretExplain").addClass("hide");
	});
});
</script>