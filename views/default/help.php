<div class="panel-heading border-light center ">
	<span class="panel-title homestead"> <i class='fa fa-support  fa-3x  '></i> <span style="font-size: 48px">HELP</span></span>
</div>
<div class="space20"></div>
<div class="keywordList"></div>

<script type="text/javascript">

var keywords = [
	
	{
		"icon" : "fa-support",
		"title":"I WANNA HELP",
		"body":"HELP US BUILD A BETTER PLACE"
	},
	{
		"icon" : "fa-support",
		"title":"I NEED SOME HELP",
		"body":"<a href='#' onclick='loadPage ()'>Contact us any time</a>"
	},
];
	
jQuery(document).ready(function() 
{
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		var icon = (obj.icon) ? obj.icon : "fa-tag" ;
		var color = (obj.color) ? obj.color : "#E33551" ;
		var body = (obj.body) ? obj.body : null ;
		var str = '<div class="panel panel-white">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> <i class="fa '+icon+'  fa-2x"></i> <span style="font-size: 35px; color:'+color+';"> '+obj.title+'</span></span>'+
			'</div>';
		if(body)
			str += '<div class="panel-body">'+
				'<blockquote class="space20">'+
					body+
				 "</blockquote>"+
			"</div>"+
		"</div>";
		$(".keywordList").append(str);
	 });
});

</script>

