<div class="panel-heading border-light center text-dark partition-white radius-10 ">
	<span class="panel-title homestead"> <i class='fa fa-support  fa-3x  '></i> <span style="font-size: 48px">HELP</span></span>
</div>
<div class="space20"></div>
<div class="keywordList"></div>

<script type="text/javascript">

var keywords = [
	{
		"icon" : "fa-support",
		"title":"I NEED SOME HELP",
		"body":"<a href='#' onclick='loadPage ()'>Contact us any time</a>"
	},
	{
		"icon" : "fa-support",
		"title":"I WANNA HELP",
		"body":"HELP US BUILD A BETTER PLACE"
	},
	{
		"icon" : "fa-hand-o-up",
		"title":"GET INVOLVED",
		"body":"All sorts of tasks : <br/>"+
				"<ul><li> DEVS : <a href='https://github.com/pixelhumain/pixelhumain' target='_blank'>GITHUB</a></li>"+
				"<li> ARTISTS : design, write a song, write for change</li>"+
				"<li> COMMUNICATION : </li>"+
				"<li> COMMONERS : </li>"+
				"<li> JURISTS : </li>"+
				"<li> BUILDERS : </li>"+
				"<li> THINKERS : </li>"+
				"<li> FINANCERS : </li>"+
				"<li> BUILDERS : </li>"+
				"<li> ARCHITECTS : </li>"+
				"<li> CONNECTORS : </li>"+
				"<li> INVENTORS : </li>"+
				"<li> TRAVELLERS : </li>"+
				"<li> MAKERS : </li>"+
				"</ul>"
	},
	{
		"icon" : "fa-users",
		"title":"MEETUP SESSIONS",
		"body":"Different sessions for different things : <br/>"+
				"We meet up on skype or Hangout <br/>"+
				"<ul><li>Scrum dev sessions : daylee</li>"+
				"<li>Sessions for all : every 15j to talk globally about the project</li>"+
				"<li>Demo session : specific sub milestones</li>"+
				"</ul>"
	},
];
	
jQuery(document).ready(function() 
{
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		var icon = (obj.icon) ? obj.icon : "fa-tag" ;
		var color = (obj.color) ? obj.color : "#E33551" ;
		var body = (obj.body) ? obj.body : null ;
		var str = '<div class="col-md-6 col-sm-12 "><div class="panel panel-white ">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> <i class="fa '+icon+'  fa-2x"></i> <span style="font-size: 35px; color:'+color+';">&nbsp;'+obj.title+'</span></span>'+
			'</div>';
		if(body)
			str += '<div class="panel-body">'+
				'<blockquote class="space20">'+
					body+
				 "</blockquote>"+
			"</div>"+
		"</div></div>";
		$(".keywordList").append(str);
	 });
});

</script>

