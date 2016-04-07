<?php 
$this->renderPartial('newsSV');

$cssAnsScriptFilesModule = array(
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5-0.0.2.css',
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysiwyg-color.css',
	'/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
	'/plugins/x-editable/css/bootstrap-editable.css',
	'/plugins/select2/select2.css',
	//X-editable...
	'/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js' , 
	'/plugins/x-editable/js/bootstrap-editable.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/wysihtml5-0.3.0.min.js' , 
	'/plugins/wysihtml5/bootstrap-wysihtml5-0.0.2/bootstrap-wysihtml5.js' , 
	'/plugins/wysihtml5/wysihtml5.js',
	'/plugins/moment/min/moment.min.js',
	'/plugins/jquery.scrollTo/jquery.scrollTo.min.js',
	'/plugins/ScrollToFixed/jquery-scrolltofixed-min.js',
	'/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
	'/plugins/jquery.appear/jquery.appear.js',
	'/plugins/jquery.elastic/elastic.js',
	'/plugins/select2/select2.css',
	'/plugins/select2/select2.min.js',

);
HtmlHelper::registerCssAndScriptsFiles( $cssAnsScriptFilesModule ,Yii::app()->theme->baseUrl."/assets");
$cs = Yii::app()->getClientScript();

//$cs->registerCssFile("//cdn.leafletjs.com/leaflet-0.7.3/leaflet.css");
//$cs->registerScriptFile($this->module->assetsUrl.'/js/news/newsHtml.js' , CClientScript::POS_END);
$cssAnsScriptFilesModule = array(
	'/js/news/index.js',
	'/js/news/newsHtml.js',
	'/css/news/index.css'	
);
HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>	
	<!-- start: PAGE CONTENT -->
<?php 
	
	$contextName = "";
	$contextIcon = "bookmark fa-rotate-270";
	$contextTitle = "";
	$imgProfil = $this->module->assetsUrl . "/images/news/profile_default_l.png"; 
	if( isset($type) && $type == Organization::COLLECTION && isset($organization) ){
		Menu::organization( $organization );
		$thisOrga = Organization::getById($organization["_id"]);
		$contextName = Yii::t("common","Organization")." : ".$thisOrga["name"];
		$contextIcon = "users";
		$contextTitle = Yii::t("common","Participants");
	}
	else if( (isset($type) && $type == Person::COLLECTION) || (isset($person) && !@$type) ){
		Menu::person( $person );
		$contextName =$person["name"];
		$contextIcon = "user";
		$contextTitle =  Yii::t("common", "DIRECTORY of")." ".$person["name"];	
		$imgProfil = isset($person["profilThumbImageUrl"]) ? Yii::app()->createUrl('/'.$this->module->id.'/document/resized/50x50'.$person['profilImageUrl']) : $imgProfil;
	}
	else if( isset($type) && $type == Project::COLLECTION && isset($project) ){
		Menu::project( $project );
		$contextName = $project["name"];
		$contextIcon = "lightbulb-o";
		$contextTitle = Yii::t("common", "Contributors of project");//." ".$project["name"];
	}else if( isset($type) && $type == Event::COLLECTION && isset($event) ){
		Menu::event( $event );
		$contextName = $event["name"];
		$contextIcon = "calendar";
		$contextTitle = Yii::t("common", "Contributors of event");//." ".$project["name"];
	}

	else if( isset($type) && $type == City::COLLECTION && isset($city) ){
		Menu::city( $city );
		$contextName = Yii::t("common","City")." : ".$city["name"];
		$contextIcon = "university";
		$contextTitle = Yii::t("common", "DIRECTORY Local network of")." ".$city["name"];
	}
	else if( isset($type) && $type == "pixels"){
		$contextName = "Pixels : participez au projet";
		$contextTitle = Yii::t("common", "Contributors of project");//." ".$project["name"];
	}
	Menu::news($type);
	$this->renderPartial('../default/panels/toolbar'); 
?>

</style>

<div id="formCreateNewsTemp" style="float: none;display:none;" class="center-block">
	<div class='no-padding form-create-news-container'>
		<h5 class='padding-10 partition-light no-margin text-left header-form-create-news' style="margin-bottom:-40px !important;"><i class='fa fa-pencil'></i> <?php echo Yii::t("news","Share a thought, an idea, a link",null,Yii::app()->controller->module->id) ?> </h5>
		<form id='form-news'>
			<input type="hidden" id="parentId" name="parentId" value="<?php echo $contextParentId ?>"/>
			<input type="hidden" id="parentType" name="parentType" value="<?php echo $contextParentType ?>"/> 
			<div class="extract_url">
				<div class="padding-10 bg-white">
					<img id="loading_indicator" src="<?php echo $this->module->assetsUrl ?>/images/news/ajax-loader.gif">
					<textarea id="get_url" placeholder="..." class="get_url_input form-control textarea" style="border:none;" name="getUrl" spellcheck="false" ></textarea>
					<div id="results" class="padding-10 bg-white"></div>
				</div>
			</div>
			<div class="form-group tagstags" style="">
			    <input id="tags" type="" data-type="select2" name="tags" placeholder="#Tags" value="" style="width:100%;">		    
			</div>
			<div class="form-actions" style="display: block;">
				<?php if(@$type && $type==Person::COLLECTION){ ?>
				<div class="dropdown">
					<a data-toggle="dropdown" class="btn btn-default" id="btn-toogle-dropdown-scope" href="#"><i class="fa fa-globe"></i> Public <i class="fa fa-caret-down" style="font-size:inherit;"></i></a>
					<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
						<li>
							<a href="#" id="scope-my-wall" class="scopeShare" data-value="public"><h4 class="list-group-item-heading"><i class="fa fa-globe"></i> Public</h4>
								<!--<div class="small" style="padding-left:12px;">-->
							<p class="list-group-item-text small">Ouvert au public et votre localité</p><!--</div>-->
							</a>
						</li>
						<li>
							<a href="#" id="scope-my-network" class="scopeShare" data-value="private"><h4 class="list-group-item-heading"><i class="fa fa-connectdevelop"></i> Mon réseau</h4>
								<p class="list-group-item-text small">Le réseau auquel vous êtes connecté</p>
							</a>
						</li>
						<!--<li>
							<a href="#" id="scope-select" data-toggle="modal" data-target="#modal-scope"><i class="fa fa-plus"></i> Selectionner</a>
						</li>-->
					</ul>
				</div>	
				<?php }else if($type=="city"){ ?>
					<input type="hidden" name="cityInsee" value="<?php echo $_GET["insee"]; ?>"/>
					<div class="badge"><i class="fa fa-university"></i> <?php //echo $city["name"]; ?></div>
				<?php } ?>
				<input type="hidden" name="scope" value="public"/>
				<button id="btn-submit-form" type="submit" class="btn btn-green pull-right">Envoyer <i class="fa fa-arrow-circle-right"></i></button>
			</div>
		</form>
	 </div>
</div>
<div id="newsHistory" class="padding-10">

	<div class="margin-top-10">
		<button class="btn bg-red" onclick="toggleFilters('#tagFilters');"># Rechercher par tag</button>
		<button class="btn bg-red" onclick="toggleFilters('#scopeFilters');"><i class="fa fa-circle-o"></i> Rechercher par lieu</button>
		<button class="btn btn-default text-red" onclick="showAllNews();"><i class="fa fa-times"></i> Annuler les filtres</button>
	</div>
	<div class="<?php if($type!="city") {?>col-md-12<?php } ?>">
		<!-- start: TIMELINE PANEL -->
		<div class="panel panel-white" style="padding-top:10px;box-shadow:inherit;">
			<div id="top" class="panel-body panel-white">
				<div id="tagFilters" class="optionFilter pull-left center col-md-10" style="display:none;" ></div>
				<div id="scopeFilters" class="optionFilter pull-left center col-md-10" style="display:none;" ></div>
	
				<div id="timeline" class="col-md-12">
					<?php if($type=="city"){ ?>
					<div class="panel-heading text-center">
						<h3 class="panel-title text-blue lbl-title-newsstream"><i class="fa fa-rss"></i> Les actualités locales</h3>
		  			</div>
		  			<?php } ?>
					<div class="timeline">
						<div class="newsTL">
						</div>
					</div>
				</div>
				<ul class="timeline-scrubber inner-element newsTLmonthsList col-md-2"></ul>
			</div>
			<div class="stream-processing center">
				<span class="search-loader text-dark" style="font-size:20px;"><i class="fa fa-spin fa-circle-o-notch"></i></span>
			</div>
		</div>
		<!-- end: TIMELINE PANEL -->
	</div>
</div>

<div id="modal_scope_extern" class="form-create-news-container hide"></div>


<?php 
foreach($news as $key => $oneNews){
	$news[$key]["typeSig"] = "news";	
}
?>

<!-- end: PAGE CONTENT-->
<script type="text/javascript">
/*
	Global Variables to initiate timeline
	- offset => represents measure of last newsFeed (element for each stream) to know when launch loadStrean
	- lastOffset => avoid repetition of scrolling event (unstable behavior)
	- dateLimit => date to know until when get new news
*/
<?php if(@$viewer){ ?>
	viewer="<?php echo $viewer ?>";
<?php } else{ ?>
	viewer="";
<?php } ?>
var news = <?php echo json_encode($news)?>;
var newsReferror={
		"news":{
			"offset":"",
			"dateLimit":0,
			"lastOffset":""
			},
		"activity":{
			"offset":"",
			"dateLimit":0,
			"lastOffset":""
			},
	};
var mode = "view";
var canPostNews = <?php echo json_encode(@$canPostNews) ?>;
var idSession = "<?php echo Yii::app()->session["userId"] ?>";
var contextParentType = <?php echo json_encode(@$contextParentType) ?>;
var contextParentId = <?php echo json_encode(@$contextParentId) ?>;
var countEntries = 0;
var offset="";
var	dateLimit = 0;	
var lastOffset="";
var streamType="news";
var months = ["<?php echo Yii::t('common','january') ?>", "<?php echo Yii::t('common','febuary') ?>", "<?php echo Yii::t('common','march') ?>", "<?php echo Yii::t('common','april') ?>", "<?php echo Yii::t('common','may') ?>", "<?php echo Yii::t('common','june') ?>", "<?php echo Yii::t('common','july') ?>", "<?php echo Yii::t('common','august') ?>", "<?php echo Yii::t('common','september') ?>", "<?php echo Yii::t('common','october') ?>", "<?php echo Yii::t('common','november') ?>", "<?php echo Yii::t('common','december') ?>"];
var contextMap = {
	"tags" : [],
	"scopes" : {
		codeInsee : [],
		codePostal : [], 
		region :[],
		addressLocality : []
	},
};
var formCreateNews;
var indexStep = 15;
var currentIndexMin = 0;
var currentIndexMax = indexStep;
var currentMonth = null;
var scrollEnd = false;
var totalEntries = 0;
var timeout = null;
var tagsFilterListHTML = "";
var scopesFilterListHTML = "";
var loadingData = false;


var trad = {
	"No more news" : '<?php echo Yii::t("common", "No more news"); ?>',
	"Are you sure you want to delete this news" : '<?php echo Yii::t("common", "Are you sure you want to delete this news"); ?>',
	"News has been successfully delated" : '<?php echo Yii::t("common", "News has been successfully delated"); ?>',
	"Something went wrong!" : '<?php echo Yii::t("common", "Something went wrong!"); ?>',
	"Please try again" : "<?php echo Yii::t('common', 'Please try again'); ?>",
	"Something went wrong with the url": "<?php echo Yii::t('common', 'Something went wrong with the url'); ?>",
	"News added successfully!" : '<?php echo Yii::t("common", "News added successfully!"); ?>',
};

function t(lang, phrase){
	if(typeof trad[phrase] != "undefined")
	return trad[phrase];
	else return phrase;
}
//var userId = <?php echo isset(Yii::app()->session['userId']) ? Yii::app()->session['userId'] : "null"; ?>

jQuery(document).ready(function() 
{
	$(".my-main-container").off(); 
	if(contextParentType=="pixels"){
		tagsNews=["bug","idea"];
	}
	else {
		tagsNews = <?php echo json_encode($tags); ?>
	}
	/////// A réintégrer pour la version last
	var $scrollElement = $(".my-main-container");
	$('#tags').select2({tags:tagsNews});
	$("#tags").select2('val', "");
	if(contextParentType!="city"){
		if(contextParentId == idSession)
		$(".moduleLabel").html("<i class='fa fa-rss'></i> Mon fil d'actus" + 
								"<img class='img-profil-parent' src='<?php echo $imgProfil; ?>'>");
		else
		$(".moduleLabel").html("<span class='text-red'><i class='fa fa-rss'></i> Fil d'actus</span> <?php echo addslashes(@$contextName); ?>" + 
								"<img class='img-profil-parent' src='<?php echo $imgProfil; ?>'>");
		
		Sig.restartMap();
		//Sig.showMapElements(Sig.map, news);
	}else{
		
	}
	// SetTimeout => Problem of sequence in js script reader
	setTimeout(function(){
		loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
		$(".my-main-container").scroll(function(){
	    if(!loadingData && !scrollEnd){
	          var heightContainer = $(".my-main-container")[0].scrollHeight;
	          var heightWindow = $(window).height();
	          if( ($(this).scrollTop() + heightWindow) == heightContainer){
	            console.log("scroll in news/index MAX");
	            loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep);
	          }
	    }
	});
	},100);
		
	getUrlContent();
	setTimeout(function(){
		saveNews();
	},500);
 	//Construct the first NewsForm
	//buildDynForm();
	//déplace la modal scope à l'exterieur du formulaire
 	$('#modal-scope').appendTo("#modal_scope_extern") ;
});

</script>
