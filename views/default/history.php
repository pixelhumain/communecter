<div class="panel-heading border-light center text-dark partition-white radius-10 ">
	<span class="panel-title homestead"> <i class='fa fa-clock-o faa-pulse animated fa-3x  '></i> <span style="font-size: 48px">WHERE WE'RE GOING</span></span>
</div>
<div class="space20"></div>
<div class="keywordList bgcity"></div>

<script type="text/javascript">

var keywords = [
	{
		"icon" : "fa-child",
		"title":"ALPHA OPENING",
		"date" : "febuary - 2016",
		"body":"..."
	},
	{
		"icon" : "fa-money",
		"title":"OPEN DATA PLATEFORM SUBSUDY",
		"date" : "july - 2015",
		"body":"..."
	},
	{
		"icon" : "fa-video-camera",
		"title":"COMMUNECTER TRAILER",
		"date" : "july - 2015",
		"body":"..."
	},
	{
		"icon" : "fa-truck",
		"title":"FINISHED INCUBATION",
		"date" : "june - 2015",
		"body":"..."
	},
	{
		"icon" : "fa-cogs",
		"title":"FULL TIME DEVELOPMENT",
		"date" : "march - 2015",
		"body":"..."
	},
	{
		"icon" : "fa-money",
		"title":"REUNION REGION SUBSUDY",
		"date" : "january - 2015",
		"body":"..."
	},
	{
		"icon" : "fa-money",
		"title":"FIRST PRODUCT ORDER ON PLATEFORM",
		"date" : "september - 2014",
		"body":"..."
	},
	{
		"icon" : "fa-thumbs-o-up",
		"title":"PROJECT SELECTED FOR INCUBATION",
		"date" : "june - 2013",
		"body":"..."
	},
	{
		"icon" : "fa-video-camera",
		"title":"PIXEL HUMAIN TRAILER",
		"date" : "mars - 2014",
		"body":"..."
	},
	{
		"icon" : "fa-cogs",
		"title":"PROTOTYPING",
		"date" : "feb - 2013",
		"body":"..."
	},
	{
		"icon" : "fa-euro",
		"title":"SEARCHING FUNDING",
		"date" : "feb - 2013",
		"body":"..."
	},
	{
		"icon" : "fa-users",
		"title":"GETTING TOGETHER : START UP WEEK END 2012",
		"date" : "oct - 2012",
		"body":"..."
	},
	{
		"icon" : "fa-lightbulb-o",
		"title":"JUST AN IDEA",
		"date" : "2011",
		"body":"..."
	},
	{
		"icon" : "fa-globe",
		"title":"OPEN ATLAS",
		"date" : "2006",
		"body":"..."
	},
	
];
	
jQuery(document).ready(function() 
{
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		icon = (obj.icon) ? obj.icon : "fa-tag" ;
		color = (obj.color) ? obj.color : "#E33551" ;
		$(".keywordList").append(
		'<div class="col-md-4 col-sm-12"><div class="panel panel-white">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> <i class="fa '+icon+' faa-pulse animated-hover fa-2x"></i> <span style="font-size: 35px; color:'+color+';"> '+obj.title.toUpperCase()+'</span></span>'+
				'<br/>'+obj.date+
			'</div>'+
			/*'<div class="panel-body">'+
				'<blockquote class="space20">'+
					obj.body+
				 "</blockquote>"+
			"</div>"+*/
		"</div></div>");
	 });
});

</script>