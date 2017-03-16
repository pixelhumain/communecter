

<?php 

	$cssAnsScriptFilesModule = array(
		'/js/news/newsHtml.js'
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);

	HtmlHelper::registerCssAndScriptsFiles( 
		array(  '/css/onepage.css',
				'/css/profilSocial.css',
				'/vendor/colorpicker/js/colorpicker.js',
				'/vendor/colorpicker/css/colorpicker.css',
				'/css/news/index.css',	
				'/css/timeline2.css',
				'/css/circle.css',	
				'/css/default/directory.css',	
				'/js/comments.js',
			  ) , 
		Yii::app()->theme->baseUrl. '/assets');




	$imgDefault = $this->module->assetsUrl.'/images/thumbnail-default.jpg';
	
	//récupération du type de l'element
    $typeItem = (@$element["typeSig"] && $element["typeSig"] != "") ? $element["typeSig"] : "";
    if($typeItem == "") $typeItem = @$element["type"] ? $element["type"] : "item";
    if($typeItem == "people") $typeItem = "citoyens";
    
    $typeItemHead = $typeItem;
    if($typeItem == "organizations" && @$element["type"]) $typeItemHead = $element["type"];

    //icon et couleur de l'element
    $icon = Element::getFaIcon($typeItemHead) ? Element::getFaIcon($typeItemHead) : "";
    $iconColor = Element::getColorIcon($typeItemHead) ? Element::getColorIcon($typeItemHead) : "";

    $useBorderElement = false;

    if(@Yii::app()->params["front"]) $front = Yii::app()->params["front"];
?>
<style>
	.header{
		position: absolute;
		width:100%;
		height:300px;
	}
	.social-main-container, #central-container{
		background-color: #f8f8f8;
		min-height:1200px;
	}

	#shortDescription *{
		font-size:0px !important;
	}

	iframe.wysihtml5-sandbox{
		border:1px solid lightgrey!important;
		padding:10px!important;
	}

	section#timeline-social{
		/*position: absolute;*/
		/*top:300px;*/
	}

	.profilSocial{
		/*position: absolute;
		top:0px;*/
	}
	.sub-menu-social{
		/*margin-top: -55px;
		margin-bottom: 30px;*/
	}
	.sub-menu-social button{
		height:45px;
		margin-top: 5px;
	}
	footer{
        /*position: absolute!important;*/
        bottom: 0px;
    }

    #small_profil{
    	font-weight: 300;
    	text-transform: none;
    	font-size:13px;
    	margin-top:4px;
    }


#central-container .bg-dark {
    color: white !important;
    background-color: #3C5665 !important;
}
#central-container .bg-red{
    background-color:#E33551 !important;
    color:white!important;
}
#central-container .bg-blue{
    background-color: #5f8295 !important;
    color:white!important;
}
#central-container .bg-green{
    background-color:#93C020 !important;
    color:white!important;
}
#central-container .bg-orange{
    background-color:#FFA200 !important;
    color:white!important;
}
#central-container .bg-yellow{
    background-color:#FFC600 !important;
    color:white!important;
}
#central-container .bg-purple{
    background-color:#8C5AA1 !important;
    color:white!important;
}
#central-container #dropdown_search{
	min-height:500px;
    margin-top:30px;
}
#central-container .row.headerDirectory{
    margin-top: 20px;
    display: none;
}
#central-container p {
    font-size: 13px;
}

#listCollections .text-white{
  color:black!important;
}

.notif-column .alert{
	font-size:12px;
	border:none!important;
	border-radius: 0px;
}
.notif-column a .fa-times{
	margin-left:-5px;
}

<?php 
    $btnAnc = array("blue"      =>array("color1"=>"#ea4335", 
                                        "color2"=>"#ea4335"),
                    );
?>

<?php foreach($btnAnc as $color => $params){ ?>
.btn-anc-color-<?php echo $color; ?>{
    background-color: transparent;
    border-color: transparent;
    color: <?php echo $params["color1"]; ?>!important;
}

.btn-anc-color-<?php echo $color; ?>:hover{
    background-color:transparent!important;
    color:<?php echo $params["color1"]; ?>!important;
}
.btn-anc-color-<?php echo $color; ?>.active{ 
    background-color:#fff!important;
    color:<?php echo $params["color1"]; ?>!important;
    border-color: <?php echo $params["color1"]; ?>!important;
}
.btn-anc-color-<?php echo $color; ?>.active:hover{
    background-color: #fff;
    color: <?php echo $params["color1"]; ?>;
}

.favElBtn, .favAllBtn{
  padding: 5px 8px;
  font-weight: 800;
  margin-bottom:5px;
}

<?php } ?>

  </style>
	
    <section class="col-md-12 col-sm-12 col-xs-12 header" id="header"></section>
		    
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 margin-top-70 profilSocial">        
	    <?php 
	    	$params = array(    "element" => @$element, 
                                "type" => @$type, 
                                "edit" => @$edit,
                                "countries" => @$countries,
                                "tags" => @$tags,
                                "controller" => $controller,
                                "openEdition" => $openEdition,
                                "countStrongLinks" => $countStrongLinks,
                                "countLowLinks" => $countLowLinks,
                                );

	    	if(@$members) $params["members"] = $members;
	    	if(@$events) $params["events"] = $events;
	    	if(@$needs) $params["needs"] = $needs;
	    	if(@$projects) $params["projects"] = $projects;

	    	$this->renderPartial('../pod/ficheInfoElementCO2', $params ); 
	    ?>
	</div>
        
    <section class="col-md-8 col-sm-8 col-lg-9  margin-top-15 padding-15">
	    	
    	<!-- Header -->
	    <section class="col-md-12 col-sm-12 col-xs-12" id="social-header">
	    	<?php if(@$edit==true) { ?>
	    	<button class="btn btn-default btn-sm pull-right margin-right-15 margin-top-70 hidden-xs btn-edit-section" 
	    			data-id="#header">
		        <i class="fa fa-cog"></i>
		    </button>
		    <?php } ?>
	        <div class="col-md-9 col-sm-10 col-lg-10 text-left">
	        	
	        	<div class="col-md-12 padding-5 margin-bottom-10">
					<!-- <div class="link"><i class="fa fa-tag"></i> Tags</div> -->
					<?php if(@$element["tags"])
	            			foreach ($element["tags"]  as $key => $tag) { ?>
	            		<span class="badge letter-red bg-white"><?php echo $tag; ?></span>
	            	<?php } ?>
				</div>

				
				<h3 class="text-left margin-10 padding-left-15 pull-left" id="main-name-element">
					<?php echo @$element["name"]; ?>		
				</h3>
				<a href="#co2.page.type.citoyens.id.580827a8da5a3bca128b456b?tpl=onepage" target="_blank" class="font-blackoutM letter-red bold">
					  <i class="fa fa-external-link"></i> <span class="hidden-xs hidden-sm">Page</span> web
				</a>
				<br>

				<!-- <?php //if(@$element["shortDescription"]!="") { ?><i class="fa fa-quote-left pull-left "></i><?php //} ?> -->
				<div class="col-sm-10 col-md-10">
					<span class="" id="shortDescriptionHeader"><?php echo @$element["shortDescription"]; ?></span>
					
					<?php if(@$edit==true) { ?>
					<button class=" btn btn-default btn-xs tooltips editElementDetail margin-top-5" data-edit-id="shortDescription" 
							data-toggle="tooltip" data-placement="right" title="modifier ma description">
						<i class="fa fa-pencil"></i> en quelques mots
					</button>
					<a href="#" id="shortDescription" data-type="wysihtml5" 
						data-original-title="Décrivez <?php echo @$element["name"]; ?> en quelques mots (140)" 
						data-emptytext="<?php echo Yii::t("common","Short description",null,Yii::app()->controller->module->id); ?>" 
						class="editable editable-click" style="max-width: 0px; height:0px;font-size: 0px!important;">
						<?php echo (!empty($element["shortDescription"])) ? $element["shortDescription"] : ""; ?>
					</a>
					<?php } ?>
				</div>
		    </div>
	    </section>

	    <div class="col-md-12 col-sm-12 col-xs-12 sub-menu-social">
	    	<div class="btn-group">
			  <button type="button" class="btn btn-default bold" id="btn-start-newsstream"><i class="fa fa-rss"></i> Fil d'actu<span class="hidden-sm">alité</span>s</button>
			  <button type="button" class="btn btn-default bold" id="btn-start-mystream"><i class="fa fa-user-circle"></i> Journal</button>
			</div>

			<div class="btn-group margin-left-10">
			  <button type="button" class="btn btn-default bold">
			  	<i class="fa fa-bell"></i> 
			  	<span class="hidden-xs hidden-sm">
			  		Mes notif<span class="hidden-md">ications</span>
			  	</span><span class="badge badge-success">12</span>
			  </button>
			  <button type="button" class="btn btn-default bold">
			  	<i class="fa fa-envelope"></i> 
			  	<span class="hidden-xs hidden-sm hidden-md">
			  		Messagerie
			  	</span><span class="badge bg-azure">3</span>
			  </button>
			</div>

			<div class="btn-group margin-left-10">
			  <button type="button" class="btn btn-default bold">
			  	<i class="fa fa-cogs"></i> <span class="hidden-xs hidden-sm hidden-md">Paramètres</span>
			  </button>
			</div>

			<div class="btn-group margin-left-10">
			  <button type="button" class="btn btn-default bold">
			  	<i class="fa fa-user-secret"></i> <span class="hidden-xs hidden-sm hidden-md">Admin</span>
			  </button>
			  <?php if( Role::isSuperAdmin(Role::getRolesUserId(Yii::app()->session["userId"]) )) { ?>
			  <button type="button" class="btn btn-default bold" id="btn-superadmin">
			  	<i class="fa fa-grav letter-red"></i> <span class="hidden-xs hidden-sm hidden-md"></span>
			  </button>
			  <?php } ?>
			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-9 margin-top-50" id="central-container">
		</div>

		<div class="col-md-2 col-lg-3 hidden-sm hidden-xs margin-top-50" id="notif-column">
			<div class="alert alert-info">
				<a href="#..."><i class="fa fa-times text-dark padding-5"></i></a> 
				<span>
					<i class="fa fa-comment"></i> <b>Quelqu'un</b> a commenté votre message<br>
					<small class="margin-left-15">il y a 2 minutes</small><br>
				</span>
	    	</div>
			<div class="alert alert-info">
				<a href="#..."><i class="fa fa-times text-dark padding-5"></i></a> 
				<span>
					<i class="fa fa-comment"></i> <b>Quelqu'un</b> a commenté <b>votre message</b><br>
					<small class="margin-left-15">il y a 3h</small>
				</span>
	    	</div>
			<div class="alert alert-success">
				<a href="#..."><i class="fa fa-times text-dark padding-5"></i></a> 
				<a href="#...">
					<i class="fa fa-calendar"></i> <b>Quelqu'un</b> a vous invite à <b>un événement</b><br>
					<small class="margin-left-15">il y a 5h</small>
				</a>
	    	</div>
			<div class="alert alert-success">
				<a href="#..."><i class="fa fa-times text-dark padding-5"></i></a> 
				<a href="#...">
					<i class="fa fa-hand-rock-o"></i> <b>Conseil citoyen de votre ville :</b> une nouvelle <b>proposition</b> vient d'être publiée par <b>quelqu'un</b>.<br>
					<small class="margin-left-15">il y a 2 jours</small><br>
				</a>
	    	</div>
			<div class="alert alert-danger">
				<a href="#..."><i class="fa fa-times text-dark padding-5"></i></a> 
				<span>
					<i class="fa fa-flag"></i> <b>Quelqu'un</b> a signalé l'un de vos commentaires<br>
					<small class="margin-left-15">il y a 10 jours</small><br>
				</span>
	    	</div>
	    </div>
	</section>
	

	<?php 
		//$layoutPath = 'webroot.themes.'.Yii::app()->theme->name.'.views.layouts.';
		//$this->renderPartial($layoutPath.'footer',  array( "subdomain"=>"page" ) ); 
	?>
    

<script type="text/javascript">

	var elementName = "<?php echo @$element["name"]; ?>";
    var contextType = "<?php echo @$type; ?>";
    var members = <?php echo json_encode(@$members); ?>;
    var params = <?php echo json_encode(@$params); ?>;
    var dateLimit = 0;
    var typeItem = "<?php echo $typeItem; ?>";

    console.log("params", params);

	jQuery(document).ready(function() {
		initSocial();
		bindButtonMenu();
		loadNewsStream(true);
	});


	function bindButtonMenu(){
		$("#btn-superadmin").click(function(){
			loadAdminDashboard();
		});
		$("#btn-start-newsstream").click(function(){
			loadNewsStream(true);
		});
		$("#btn-start-mystream").click(function(){
			loadNewsStream(false);
		});
	}

	function initSocial(){
		var Accordion = function(el, multiple) {
			this.el = el || {};
			this.multiple = multiple || false;

			// Variables privadas
			var links = this.el.find('.link');
			// Evento
			links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
		}

		Accordion.prototype.dropdown = function(e) {
			var $el = e.data.el;
				$this = $(this),
				$next = $this.next();

			$next.slideToggle();
			$this.parent().toggleClass('open');

			if (!e.data.multiple) {
				$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
			};
		}	

		var accordion = new Accordion($('#accordion'), false);
		var accordion2 = new Accordion($('#accordion2'), false);
		var accordion3 = new Accordion($('#accordion3'), false);
		var accordion4 = new Accordion($('#accordion4'), false);

		//ouvre le pod communauté
		$('#accordion4 .link').trigger("click");

   		$(".tooltips").tooltip();


   		
	}

	function loadAdminDashboard(){
		$('#central-container').html("<i class='fa fa-spin fa-refresh'></i>");
		getAjax('#central-container' ,baseUrl+'/'+moduleId+"/co2/superadmin/action/main",function(){ 
				
		},"html");
	}

	function loadNewsStream(isLiveBool){
		isLive = isLiveBool==true ? "/isLive/true" : ""; 
		dateLimit = 0;
		scrollEnd = false;

		toogleNotif(true);

		var url = "news/index/type/"+typeItem+"/id/<?php echo (string)$element["_id"] ?>"+isLive+"/date/"+dateLimit+
				  "?isFirst=1&tpl=co2&renderPartial=true";
		
		$('#central-container').html("<i class='fa fa-spin fa-refresh'></i>");
		ajaxPost('#central-container', baseUrl+'/'+moduleId+'/'+url, 
			null,
			function(){ 
				$(window).bind("scroll",function(){ 
				    if(!loadingData && !scrollEnd && colNotifOpen){
				          var heightWindow = $("html").height() - $("body").height();
				          if( $(this).scrollTop() >= heightWindow - 400){
				            loadStream(currentIndexMin+indexStep, currentIndexMax+indexStep, isLiveBool);
				          }
				    }
				});
		},"html");
	}


function loadStream(indexMin, indexMax, isLiveBool){ console.log("LOAD STREAM PROFILSOCIAL");
	loadingData = true;
	currentIndexMin = indexMin;
	currentIndexMax = indexMax;
	

	if(typeof dateLimit == "undefined") dateLimit = 0;

	isLive = isLiveBool==true ? "/isLive/true" : "";
	var url = "news/index/type/"+typeItem+"/id/<?php echo (string)$element["_id"] ?>"+isLive+"/date/"+dateLimit+"?tpl=co2&renderPartial=true";
	$.ajax({ 
        type: "POST",
        url: baseUrl+"/"+moduleId+'/'+url,
        data: { indexMin: indexMin, 
        		indexMax:indexMax, 
        		renderPartial:true 
        	},
        success:
            function(data) {
                if(data){ //alert(data);
                	$("#news-list").append(data);
                	//bindTags();
					
				}
				loadingData = false;
				$(".stream-processing").hide();
            },
        error:function(xhr, status, error){
            loadingData = false;
            $("#news-list").html("erreur");
        },
        statusCode:{
                404: function(){
                	loadingData = false;
                    $("#news-list").html("not found");
            }
        }
    });
}

var colNotifOpen = true;
function toogleNotif(open){
		if(typeof open == "undefined") open = false;
		
		if(open==false){
			$('#notif-column').removeClass("col-md-2 col-sm-3 col-lg-3").addClass("hidden");
			$('#central-container').removeClass("col-md-10 col-lg-9").addClass("col-md-12 col-lg-12");
		}else{
			$('#notif-column').addClass("col-md-2 col-sm-3 col-lg-3").removeClass("hidden");
			$('#central-container').addClass("col-sm-12 col-md-10 col-lg-9").removeClass("col-md-12 col-lg-12");
		}

		colNotifOpen = open;
	}
</script>


<?php $this->renderPartial('sectionEditTools');?>
