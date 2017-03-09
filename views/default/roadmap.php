<div class="panel-heading border-light center  text-dark partition-white radius-10">
	<span class="panel-title homestead"> <i class='fa fa-compass faa-pulse animated fa-3x  '></i> <span style="font-size: 48px">WHERE WE'RE GOING</span></span>
</div>
<div class="space20"></div>
<div class="keywordList"></div>

<script type="text/javascript">

var keywords = [
	{
		"icon" : "fa-calendar",
		"title":"MILESTONE 0.1",
		"body":"september 2015"
	},
	{
		"icon" : "fa-university",
		"title":"MY CITY",
		"body":"COMING SOON"
	},
	{
		"icon" : "fa-user",
		"title":"PERSON",
		"body":"COMING SOON"
	},
	{
		"icon" : "fa-users",
		"title":"ORGANIZATIONS",
		"body":"COMING SOON"
	},
	{
		"icon" : "fa-calendar",
		"title":"EVENTS",
		"body":"COMING SOON"
	},
	{
		"icon" : "fa-lightbulb-o",
		"title":"PROJECT",
		"body":"COMING SOON"
	},
	{
		"icon" : "fa-legal",
		"title":"VOTING",
		"body":"COMING SOON"
	},
	{
		"icon" : "fa-comments",
		"title":"DISCUSSING",
		"body":"COMING SOON"
	},
	
];
	
jQuery(document).ready(function() 
{
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		icon = (obj.icon) ? obj.icon : "fa-tag" ;
		color = (obj.color) ? obj.color : "#E33551" ;
		$(".keywordList").append(
		'<div class="col-md-6 col-sm-12"><div class="panel panel-white">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> <i class="fa '+icon+' faa-pulse animated-hover fa-2x"></i> <span style="font-size: 35px; color:'+color+';"> '+obj.title.toUpperCase()+'</span></span>'+
			'</div>'+
			'<div class="panel-body">'+
				'<blockquote class="space20">'+
					obj.body+
				 "</blockquote>"+
			"</div>"+
		"</div></div>");
	 });
});

</script>