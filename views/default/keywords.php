<div class="panel-heading border-light center text-dark partition-white radius-10">
	<span class="panel-title homestead"> <i class='fa fa-cube  faa-pulse animated fa-3x  '></i> <span style="font-size: 48px">KEY CONCEPTS</span></span>
</div>
<div class="space20"></div>
<div class="keywordList"></div>

<script type="text/javascript">

var keywords = [
	
	{
		"icon" : "fa-circle-o",
		"title":"Territoire Connecté",
		"body":"Terre de tradition adaptée aux échanges par les flux immatériel numériques et/ou matériels (aéroports, ports, gares, réseaux routiers) apportant à toute personne habitant ce territoire, même isolé, une capacité à établir des liens internationaux.."
	},
	{
		"icon" : "fa-cubes",
		"title":"OpenData",
		"body":"Domaine de la liberté de l’information au service du bien commun comprenant des publications ou dossiers d’intérêt général en libre accès et réutilisables par tous."
	},
	{
		"icon" : "fa-linux",
		"title":"OpenSource",
		"body":"Domaine des sources logicielles en accès libre permettant, d’une part, la libre utilisation du logiciel concerné et ses dérivés, d’autre part, les échanges amenant à l’optimisation ou le développement commun du produit utilisé avec ses concepteurs toujours mentionnés."
	},
	{
		"icon" : "fa-book",
		"title":"Code Logiciel",
		"body":"Appelé aussi Code Source, c’est une suite d’instructions sous forme de texte exploité/transformé en langage de programmation permettant l’utilisation du logiciel."
	},
	{
		"icon" : "fa-map-marker",
		"title":"Cartographie de réseau",
		"body":"Logiciel de mise en liens graphiques d’une complexité de données d’origines diverses permettant d’appréhender un ensemble par la visualisation, de faire apparaître des données cachées, mais aussi de procéder à des analyses fines, ou de compléter des statistiques."
	},
	{
		"icon" : "fa-share-alt-square",
		"title":"Proxicité : capacité à créer du lien",
		"body":"Développer des services de proximité par liens d’affinités, de compétences, de complémentarités, d’intérêts ou de valeurs communs."
	},
	{
		"icon" : "fa-user",
		"title":"Acteurs locaux",
		"body":"Institutions, organisations, entreprises, associations, citoyens dont le rôle social, économique ou politique leur confère une responsabilité pour intervenir dans la gestion du territoire."
	}, 
	{
		"icon" : "fa-group",
		"title":"Vivre ensemble",
		"body":"Espace virtuel/matériel de rencontre incluant un comportement éthique appelant le respect mutuel, la tolérance, l’inclusion, l’ouverture, permettant l’expression d’un lien social riche et harmonieux projetant ceux qui y adhèrent vers une construction positive."
	},
	{
		"icon" : "fa-sun-o",
		"title":"Economie collaborative",
		"body":"Activité citoyenne permettant de produire de la valeur, des produits éco-conçus, des richesses immatérielles et réalisées dans le cadre de nouvelles méthodes transversales et en réseaux avec une mutualisation des biens, espaces et outils."
	}, 
	{
		"icon" : "fa-legal",
		"title":"Transition",
		"body":"Période s’inscrivant dans un temps de changement accompagnée la méthode pour passer d’un système/d’un concept à un autre et permettant sa mise en œuvre opérationnelle."
	}, 
	{
		"icon" : "fa-smile-o",
		"title":"Biens communs",
		"body":"Les communs sont des ressources partagées entre une communauté d’utilisateurs qui déterminent eux-mêmes le cadre et les normes régulant la gestion et l’usage de leur ressource."+
				"« Il n’y a pas de commun sans « commoners ». (…) Il n’y a pas de commun sans agir en commun. » New to the Commons ? David Bollier."
	},
	{
		"icon" : "fa-users",
		"title":"Citoyens",
		"body":"Personne jouissant des droits civils et politiques du lieu où il vit et décidé à s’impliquer dans la vie de sa cité."
	},
	{
		"icon" : "fa-cubes",
		"title":"Association",
		"body":"Convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente, leurs connaissances, talents, activités dans un but utile à un objectif louable ou à la société, et non commercial."
	},
	{
		"icon" : "fa-file-text-o",
		"title":"La charte collaborative des partenaires",
		"body":"Ensemble des règles que des partenaires de la même organisation collaborative doivent observer pour garantir la pérennité de leur projet dans un respect mutuel et au mieux de leurs intérêts communs et personnels."
	},
	{
		"icon" : "fa-globe",
		"title":"Réseau sociétal",
		"body":"Maillage de toutes les informations concernant la vie publique, cela concerne tous les participants de la vie civile du citoyen jusqu’à l’organisation de l’Etat."
	},
	{
		"icon" : "fa-th",
		"title":"Citizen Tool Kit",
		"body":"Ensemble des outils mis à la disposition des citoyens pour aider à construire/utiliser les réseaux."
	},
	{
		"icon" : "fa-legal",
		"title":"Code Social",
		"body":"Ensemble des règles à observer pour permettre une vie sociale respectant les droits civiques."
	},
	{
		"icon" : "fa-globe",
		"title":"Glocal",
		"body":"Vision globale de l’action locale / Action simultanée sur un territoire global et local."
	}
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
				'<span class="panel-title homestead"> <i class="fa '+icon+' faa-pulse animated-hover fa-2x"></i> <span style="font-size: 35px; color:'+color+';"> '+obj.title.toUpperCase()+'</span></span>'+
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

