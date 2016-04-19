<div class="panel-heading border-light center text-dark partition-white radius-10">
	<span class="panel-title homestead"> <i class='fa fa-globe faa-pulse animated fa-3x  '></i> <span style="font-size: 48px; ">A NETWORK OF NETWORKS</span></span>
	<br/>
	People & Organizations get together to build a common
	<br/>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('builder');">BUILDERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('partner');">PARTNERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('financer');">FINANCERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('thinker');">THINKERS</a>
	<a class="btn btn-xs btn-default" href="javascript:;" onclick="filterPartners('crowdfunder');">CROWDFUNDERS</a>
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
	{
		"icon" : "fa-users",
		"title": "LIVING.COOP",
		"link" : "",
		"class" : "partner"
	},
	{
		"icon" : "fa-users",
		"title": "ASSEMBLEE VIRTUELLE",
		"link" : "http://www.virtual-assembly.org/",
		"class" : "partner"
	},
	/* **************************************
	*
	*	FINANCERS
	*
	***************************************** */
	{
		"icon" : "fa-university",
		"title": "Région Réunion",
		"link" : "",
		"class" : "financer"
	},
	{
		"icon" : "fa-university",
		"title": "Technopole Réunion",
		"link" : "",
		"class" : "financer"
	},
	{
		"icon" : "fa-university",
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

/* **************************************
	*
	*	CROWDFUNDERS
	*
	***************************************** */
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marie FARES","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thomas N'saispo","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "aurelie knafo","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "La petite école qui regarde la montagne","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Benjamin DUHENOIS","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Benjamin Coulon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Mundhi Gunawan","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Didier Tranchier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Aurélie Larcy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Eglantine Herban","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Camille Paillet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Carole Buges","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "emmanuel dayde","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gaelle RIVIERE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Daniel Membrives","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas Oppenot","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Romuald Schuller","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Alisson Delahaye","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "odile lebon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Cécile DAMBREVILLE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sophie Ishak","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Alix Horsch","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": " Jean Damiens","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Hélène Houplain","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Julien Fezandelle","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Cyrille Liegeois","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Mey Low","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Benoît Alessandroni","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sylvain Barbot","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Antoine Planquette","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Hervé Crosnier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "yves lusson","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas BOHL","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "florence hamel","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sybille Saint Girons","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sylvie Depeyre","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Paul Richard","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Simon Fourthin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Céline DEROUIN","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Floriane Leva","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Benoît CAZEAUDUMEC","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "mathieu dattee","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Barthélemy GARDEL","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "PÔPÖ popo","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Claudine FOUGNET","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Joanna Gabas","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Guillaume THEROUDE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gilles MASBERNAT","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "alain renk","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Claude Henry","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Michel ABADIE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas Kulpinski","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Caroline Ludger","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Eric Tescher","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anatole Landrein","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Tristan Schmitt","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gianni ZOCCHEDDU","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Louis Gaillard","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Eliane FIQUET","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Florian Damour","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Dominique Hebert","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Martine Ternisien","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Livin'Coop Livin'Coop","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Céline Lobjoy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Alexandra Nowak","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jean-Christophe Debaty","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jean-Christophe Debaty","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gregory Veulemans","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Benoit Véler","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Wojtek Kulpinski","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "garlann nizon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Mélanie Blasco","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Enrico Campaner","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Guillaume Daoulas","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Richard Marion","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "margot katelbach","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Rémi Val","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Raphaël Bodin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Zé Zette","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Dan Percy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anne Sophie Koudsi","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Geoffrey SERIGNAC","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marion Rousseaux","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Pedro Prieto Martín","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "hagalazlaurence barth","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Johnny Lousy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Julien Chopin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "laurence botte","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas Grondin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "CHARLENE DE VARGAS","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Amélie RUPPRECHT","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Patrick RIVIERE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Victor Payen","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "julien debarnot","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Françoise Pipon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jean-Luc Coulon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Fabrice Alcindor","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thomas Gabas","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Vincent Bergeot","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marie Tatibouet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "David Fontaine","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "romain lalande","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sonia M Cazaux","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Maria Maga","link" : "","class" : "crowdfunder"},

{"icon" : "fa-user","title": "Brieuc Le Marec","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anne Fabier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "johan ducros","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gérard ZASSO","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Maxime Le Hung","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anita Montier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Coryse Boissou","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thierry Denys","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Clément Pouillaude","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Quentin Josseron","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Boris Aubligine","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "denis-pierre SIMON","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thibaud Godet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Valentin Le Tellier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Mamèremadi Antoine","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "anne caillaud","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "delphine salingue","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "pierre ACQUAVIVA","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Morgan Duhaze","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "sarah frechet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "thierry richard","link" : "","class" : "crowdfunder"},

{"icon" : "fa-user","title": "olivier seguin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "teddy jamois","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marc SALINGUE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marie Poussin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Loïc Meunier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Laureline Matha","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Bernard Vatrican","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "LAETITIA ALBERT","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "valerie salingue","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Picart Arthur","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Dj Iloun","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "remy poirel","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gaëtan Severac","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "thi thanh","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sophie Annette","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Mallorie ALBERT","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "pablo vioque","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "sebastien provence","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Vivijer Cyril","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "estelle dotti","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Stéphanie jacqueau","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Benjamin ORECCHIONI","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "antoine laurence","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Michel Coudroy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "ERIC NOWAK","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Alain Mouetaux","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Matthieu Ramage","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "emilie neilz","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas ANDRES","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Julien Duprat","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Ken Tsisandaina","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Vanessa Miranville","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Emmanuel POIRRIEZ","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marion Lamorycz","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "thibault mangeard","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Dominique Despert","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Frédérique Schuller","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Yannik DARGUESSE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Patrick Cannet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "steph leveque","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thierry Le Pesant","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Maud Rt","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thomas Wolff","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Rémi Voluer","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anne Lechvien","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Pascal FENET","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Manon Le Chevallier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Camille Arnaud","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Dominique Duthilleul","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sylvain Héraut","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Paula. Gallego","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Cédric Leprette","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Pauline Cachera","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas Patte","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marie-Aline Dejoux","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "laurent gleyse","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jean Subtil","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "stève bonin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Adrien Fabre","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gilda NOURRY","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "joan pons","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thomas Carrere","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Philippe Vincent","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Guillaume Libersat","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sabine Pleers","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jerome Medeville","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Matthieu Regnauld","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Rieul Techer","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "guillaume doukhan","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Christophe Triollet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Lucas Zint","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "xitobal none","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sabine LOUBIERE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anita Montier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Pascal Goguet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Edith Edlinger","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "jocelyne stephen","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "luc franc","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "jerome lambilliotte","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "jacky HERBINIERE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Pierre Magnin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Caroline KAPLAN","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Bernard STAUFFER","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Frederic Viollet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gilles Presti","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "claire crosse","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Bernard Veyrat","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Etienne BOUCHE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Guillaume BENRARDIN","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Ambre Godin Sagi","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marie Lechevallier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Yann FLANDRIN","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Laurent Lo","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Bastien Karikakou","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Laurent Max","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Fabien MEURET","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Fabrice Doublet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Childéric THOREAU","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marine Damiens","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Monique Houplain","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Olivier Cortès","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "vladimir katelbach","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jérémie Contan","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Philippe Fabing","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Laurent Dennemont","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Myriam Bouré","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "frédéric dussoulier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Chris Baudia","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Patrick MALOD","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Benjamin Roux","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Arnaud Famchon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anne-Marie Grenier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "nicolas enault","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Johnson Robert","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anna Kedzierska","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "DOMINIQUE ROUX","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Améla ALIHODZIC","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sophie Bureau","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Olivier Gruié","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "xavier canal","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Ludovic NARAYANIN","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Cécile Capo","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Frédéric BOSQUE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gabriel Terrien","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Kévin TAOCHY","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jean-Marc TAGLIAFERRI","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sébastien Cohéléach","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "gilles gallois","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thierry Perrau","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Céline MAUFRAS","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Raphaël RIVIERE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas Muzette","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "juanito ligdamis","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Quentin Bonnet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Perrine Stoll","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Emiline Messeguer","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Simon CHAUVAT","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Iara Le Saux","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Chatterley Epaminondas","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nathalie BENOIST","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "andre ganter","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "héléne Houplain","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "pierre pongerard","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thomas BOUICHET","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "OPEN ATLAS","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Fanny Monod","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "guillaume rouyer","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "JB Pamard","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Lynda Pony","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Philippe MARSEILLE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Joseph DESCOURS-LÉAU","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Joseph Leroy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Bilquis Naceur","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Laetitia Saffroy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Ludovic Micaud","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Julien Lecaille","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Loïc Damey","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marine Martineau","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Martin Vigneau","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jean Avinée","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Maya Cesari","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "colette barillon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Kévin Laîné","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "GILLES SCHACHERER","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Guillaume De Vargas","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "marie ardouin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Corinne Le Dû","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Audrey Maur Court","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Chloé RAYMOND","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Raphael Guille","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Caroline Hodak de L Epine","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "thibauld favre","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "sabine chapoulart","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Enguerran Colson","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Laurent Favia","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "lilian ricaud","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Armel LE COZ","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Victor Pouillaude","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Alex brun","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Richard BLOT","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sébastien Mas","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Véronique Corbin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "clemence le nir","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "alix accad","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Mélodine ElleSonne","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Romain Lefebvre","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Isabelle Delannoy","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Clovis Bonnemason","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "noémie grandsire","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Fabiennne Denoual","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Pilou Dix Joues","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Milène BONIN","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Philippe BONNIN","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Luc LAVIELLE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Aurélie Bonnin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Luc Bonnin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Daniel Pallas","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Philippe Arnaud","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Armand Daydé","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Michel Briand","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Sarah MEUNIER","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Johan Richer","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Rachid Ouchsouf","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Yannick DUTHE","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Isabelle Blaquart","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Julien CANTONI","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Anne Barbelanne","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Quitterie de Villepin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Aurelie Lecolier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Estelle BERGERARD","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Cyril Durand","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "adrien labaeye","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas Vivier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Thomas Rougier","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Laetitia Sanchez","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Christopher Liénard","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Aurélien Masse","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Angie Gaudion","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "arlette barbot","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marie-Christine COULON","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Catrin Boss","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "jean sallantin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Marion BERGERET","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Rémi Bocquet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Michel Bernand-Mantel","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Justine LANDAIS","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Mathieu Coste","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Alain THIREL-DAILLY","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Gautier Demouveaux","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "delphine ballet","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Jean Noel Rouchon","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "emilie bonin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Salim CHAOUI ROQAI","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Bernard BRUNET","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Vincent Mak-yuen","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Dahoo Durand","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Francis Morel","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "mathias lahiani","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Hafid El Mehdaoui","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Aurélia Petragallo","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Alexis Pujo","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nanoug Dan","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Simon Sarazin","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Nicolas Maréchal","link" : "","class" : "crowdfunder"},
{"icon" : "fa-user","title": "Maïa Dereva","link" : "","class" : "crowdfunder"}
];
	
jQuery(document).ready(function() 
{
	$(".moduleLabel").html('<?php echo Yii::t("common","Project Partners") ?>');
	$(".keywordList").html('');
	$.each(keywords,function(i,obj) { 
		icon = (obj.icon) ? obj.icon : "fa-tag" ;
		icon = '<i class="fa '+icon+' faa-pulse animated-hover fa-2x"></i>';

		if( obj.class == "crowdfunder")
			icon =  '<span class="fa-stack fa-lg"><i class="fa fa-user fa-stack-2x"></i><i class="fa fa-euro fa-stack-1x text-danger"></i></span>';
			
		color = (obj.color) ? obj.color : "#E33551" ;
		$(".keywordList").append(
		'<div class="col-md-4 col-sm-12 networkActor '+obj.class+'"><div class="panel panel-white">'+
			'<div class="panel-heading border-light ">'+
				'<span class="panel-title homestead"> '+icon+' <span style="font-size: 35px; color:'+color+';"> '+obj.title.toUpperCase()+'</span></span>'+
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
<style type="text/css">
	.fa-euro{margin-top: 8px; margin-left: 14px;}
</style>
