<div class="panel-heading border-light center text-dark partition-white radius-10">
	<span class="panel-title homestead"> <i class='fa fa-envelope-o faa-pulse animated fa-3x  '></i> <span style="font-size: 48px">CONTACT</span></span>
</div>
<div class="space20"></div>
<div class="keywordList"></div>

<script type="text/javascript">

var keywords = [
	
	{
		"icon" : "fa-envelope-o",
		"title":"BY MAIL : contact @ pixelhumain.com"
	},
	{
		"icon" : "fa-envelope-o",
		"title":"BY PHONE : 00262-262343686"
	},
	{
		"icon" : "fa-paper-plane-o",
		"title":"BY PAPER AIRPLANE : good luck !!"
	},
	{
		"icon" : "fa-skype",
		"title":"BY SKYPE : user oceatoon"
	},
	{
		"icon" : "fa-paw",
		"title":"BY FOOT",
		"body" : "<br/> La Riviere ou Trois Bassins, Reunion Island, @PixelHumain"+
				"<br/> Bastille , Paris, @Assemblée Virtuelle"+
				"<br/> Auvergne, @ Chez Nous .coop"+
				"<br/> Lilles, @Livin.coop or @Unissons"+
				"<br/> in Noumea, New Caledonia, @PixelHumain"+
				"<br/> in Berlin, Germany @PLP Elf Pavlic or Alex Corbi"+
				"<br/> in Mauricius, Tony Lee Luen Len"+
				"<br/> in Madagascar, Severine Berthet"+
	},
	{
		"icon" : "fa-github",
		"size":"col-md-4 ",
		"title":" <a href='https://github.com/pixelhumain' target='_blank'>ON GITHUB</a>"
	},
	{
		"icon" : "fa-bookmark-o",
		"size":"col-md-4 ",
		"title":" <a href='https://groups.diigo.com/group/pixelhumain' target='_blank'>BY DIIGO</a> "
	},
	{
		"icon" : "fa-google-plus",
		"size":"col-md-4",
		"title":" <a href='https://plus.google.com/u/0/communities/111483652487023091469' target='_blank'>BY GOOGLE+ </a> "
	},
	{
		"icon" : "fa-facebook-square",
		"size":"col-md-4",
		"title":"<a href='https://www.facebook.com/groups/pixelhumain/' target='_blank'>BY FACEBOOK </a> "
	},
	{
		"icon" : "fa-twitter",
		"size":"col-md-4 ",
		"title":"<a href='https://www.twitter.com/pixelhumain/' target='_blank'>BY TWITTER</a> "
	}
];
	
jQuery(document).ready(function() 
{
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		var icon = (obj.icon) ? obj.icon : "fa-tag" ;
		var color = (obj.color) ? obj.color : "#E33551" ;
		var body = (obj.body) ? obj.body : null ;
		var size = (obj.size) ? obj.size : null ;
		var str = '<div class="'+size+' col-sm-12"><div class="panel panel-white ">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> <i class="fa '+icon+'  fa-2x"></i> <span style="font-size: 35px; color:'+color+';"> '+obj.title+'</span></span>'+
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

