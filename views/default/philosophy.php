<div class="panel-heading border-light center text-dark partition-white radius-10">
	<span class="panel-title homestead"> <i class='fa fa-heart  faa-pulse animated fa-3x  '></i> <span style="font-size: 48px">PHILOSOPHY</span></span>
</div>
<div class="space20"></div>
<div class="keywordList"></div>

<script type="text/javascript">

var keywords = [
	
	{
		"icon" : "fa-lightbulb-o",
		"title":"Reseau societal",
		"body":"Un reseau societal pour retrouver nos biens communs"+
			"<br>Voir la société par les communs"+
			"<br>Experimentons un autre vision du système"+
			"<br>Le système peut il fonctionner autrement"
	},
	{
		"icon" : "fa-lightbulb-o",
		"title":"C'est pas un parti politique",
		"body":"C'est pas un parti, c'est un projet"+
			"<br>qui veut 'juste' unir tous le monde."
	},
	{
		"icon" : "fa-lightbulb-o",
		"title":"Rien ne l'arrete",
		"body":"Quand l'objectif est le chagnement "+
			"<br>et que c'est pas juste un slogan "+
			"<br>rien ne l'arreter a tant qu'on ne le vivra pas "+
			"<br>on continuera a la chercher"
	},
	{
		"icon" : "fa-heart",
		"title":"Art is the heart of our culture",
		"body":""
	},
];
	
jQuery(document).ready(function() 
{
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		icon = (obj.icon) ? obj.icon : "fa-tag" ;
		color = (obj.color) ? obj.color : "#E33551" ;
		$(".keywordList").append(
		'<div class="panel panel-white">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> <i class="fa '+icon+'  fa-2x"></i> <span style="font-size: 35px; color:'+color+';"> '+obj.title.toUpperCase()+'</span></span>'+
			'</div>'+
			'<div class="panel-body">'+
				'<blockquote class="space20">'+
					obj.body+
				 "</blockquote>"+
			"</div>"+
		"</div>");
	 });
});

</script>

