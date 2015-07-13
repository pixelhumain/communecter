<div class="panel-heading border-light center text-dark partition-white radius-10">
	<span class="panel-title homestead"> <i class='fa fa-globe faa-pulse animated fa-3x  '></i> <span style="font-size: 48px; ">A NETWORK OF NETWORKS</span></span>
	<br/>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('builder');">BUILDERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('partner');">PARTNERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('financer');">FINANCERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('thinker');">THINKERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('networkActor');">ALL</a>
</div>


<div class="space20"></div>
<div class="keywordList"></div>

<script type="text/javascript">

var keywords = [
	/* **************************************
	*
	*	PARTNERS
	*
	***************************************** */
	{
		"icon" : "fa-users",
		"title": "CHEZ NOUS.coop",
		"link" : "cheznous.coop",
		"class" : "partner"
	},
	{
		"icon" : "fa-users",
		"title": "ASSEMBLEE VIRTUELLE",
		"link" : "http://www.virtual-assembly.org/",
		"class" : "partner"
	},
	{
		"icon" : "fa-users",
		"title": "UNISSONS",
		"link" : "",
		"class" : "partner"
	},
	{
		"icon" : "fa-users",
		"title": "GGOUV",
		"link" : "",
		"class" : "partner"
	},
	/* **************************************
	*
	*	FINANCERS
	*
	***************************************** */
	{
		"icon" : "fa-money",
		"title": "Région Réunion",
		"link" : "",
		"class" : "financer"
	},
	{
		"icon" : "fa-money",
		"title": "Technopole Réunion",
		"link" : "",
		"class" : "financer"
	},
	{
		"icon" : "fa-money",
		"title": "GRANDDIR",
		"link" : "",
		"class" : "financer"
	},
	/* **************************************
	*
	*	BUILDERS
	*
	***************************************** */
	{
		"icon" : "fa-user",
		"title": "Tibor",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Sylvain",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Stephanie",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Jerome",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Xavier",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Jeremy",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Clement",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Tristan",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Mathieu",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Johnson",
		"link" : "",
		"class" : "builder"
	},
	{
		"icon" : "fa-user",
		"title": "Raphael",
		"link" : "",
		"class" : "builder"
	},
	/* **************************************
	*
	*	THINKERS
	*
	***************************************** */
	{
		"icon" : "fa-lightbuld-o",
		"title": "Pierre",
		"link" : "",
		"class" : "thinker"
	},
	{
		"icon" : "fa-lightbuld-o",
		"title": "Mathieu Coste",
		"link" : "",
		"class" : "thinker"
	},
	{
		"icon" : "fa-lightbuld-o",
		"title": "Guillaume Rouyer",
		"link" : "",
		"class" : "thinker"
	},
	{
		"icon" : "fa-lightbuld-o",
		"title": "Simon Sarazin",
		"link" : "",
		"class" : "thinker"
	},
];
	
jQuery(document).ready(function() 
{
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		icon = (obj.icon) ? obj.icon : "fa-tag" ;
		color = (obj.color) ? obj.color : "#E33551" ;
		$(".keywordList").append(
		'<div class="col-md-4 col-sm-12 networkActor '+obj.class+'"><div class="panel panel-white">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> <i class="fa '+icon+' faa-pulse animated-hover fa-2x"></i> <span style="font-size: 35px; color:'+color+';"> '+obj.title.toUpperCase()+'</span></span>'+
			'</div>'+
			/*'<div class="panel-body">'+
				'<blockquote class="space20">'+
					obj.body+
				 "</blockquote>"+
			"</div>"+*/
		"</div></div>");
	 });
	$(".networkActor").addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});
});
function filterPartners(type) { 
	$('.networkActor').hide();
	$('.'+type).show().addClass("animated flipInX").on('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$(this).removeClass("animated flipInX");
	});
}
</script>