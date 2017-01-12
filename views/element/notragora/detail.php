<?php 
	HtmlHelper::registerCssAndScriptsFiles( 
		array(  '/css/onepage.css',
				'/css/news/index.css',	
				'/css/timeline2.css',	
			  ) , 
	Yii::app()->theme->baseUrl. '/assets');

	$cssAnsScriptFilesModule = array(
		'/js/news/index.js',
		'/js/news/autosize.js',
		'/js/news/newsHtml.js',
	);
	HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesModule, $this->module->assetsUrl);
?>

<style>
	.col-members{
		background-color: #f8f6f6;
		min-height: 100%;
		position: absolute;
		right: 0px;
	}
	.img-header{
		max-height: 300px;
		min-height: 300px;
		width:100%;
		background-image: url("<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/tropic.jpg");
		background-size: 100%;
	}
	.main-col-search{
		padding:0px;
	}
	.shadow {
	    -webkit-box-shadow: none;
	    -moz-box-shadow: none;
	    box-shadow: none;
	}
	#description .container{
		width: 60%;
		margin-left: 20%;
		font-size: 15px;
	}
	.section-title{
		text-transform: uppercase;
		font-weight: 700;
	}

	#description .btn-edit-section{
		display: none;

	}

	.col-members h3{
		text-transform: uppercase;
		color:grey;
		font-size: 0.7em;
		font-weight: 700;
	}
	.col-members h4{
		color:#b4b4b4;
		font-size: 0.9em;
		font-weight: 700;

	}
	.col-members .username-min{
		font-weight: 700;
		color:grey;
	}

	.elipsis{
		display: block;
	}

	.element-name{
		font-size:18px;
		padding:10px 20px;
		font-weight: 700;
		height:50px;
		margin-top:-50px;
		background-color: rgba(255, 255, 255, 0.8);
	}
	.btn-follow{
		font-weight: 700;
		font-size:13px;
		border-radius:40px;
		border:none;
	}
	.menubar{
		-webkit-box-shadow: 0px 5px -5px rgba(50, 50, 50, 0.75);
		-moz-box-shadow: 0px 5px -5px rgba(50, 50, 50, 0.75);
		box-shadow: 0px 5px 5px -5px rgba(50, 50, 50, 0.75);
		margin-bottom: 40px;
	}
	.btn-menubar{
		font-weight: 700;
		font-size: 12px;
		border-radius: 40px;
		border: none;
		background-color: white;
		padding: 13px 20px;
	}

	.btn-menubar:hover{
		background-color: #4a4a4a;
		color:white;
		-webkit-box-shadow: 0px 0px 5px -1px rgba(50, 50, 50, 0.75);
		-moz-box-shadow: 0px 0px 5px -1px rgba(50, 50, 50, 0.75);
		box-shadow: 0px 0px 5px -1px rgba(50, 50, 50, 0.75);
	}
</style>
	<div class="col-lg-10 col-md-10 col-sm-9 no-padding" id="onepage">
		<div class="img-header"></div>
		<div class="element-name text-dark">
			<?php echo @$element["name"]; ?>
			<!-- <button class="btn btn-default btn-follow"><i class="fa fa-star"></i> SUIVRE</button> -->
		</div>
		<?php if ($type == "poi"){ ?>
			<?php if($element["type"]=="video" && @$element["medias"]){ 
				$videoLink=str_replace ( "autoplay=1" , "autoplay=0" , @$element["medias"][0]["content"]["videoLink"]  );
			?>
				<div class="col-xs-12">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="<?php echo @$videoLink ?>"></iframe>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 text-dark center">
					<h1 class="center"> 
						<?php echo $element['name']; ?>
					</h1>
					<?php if(@Yii::app()->session["userId"]){ ?> 
						<?php if ($edit==true || ($openEdition == true )) { ?>
							<a href="javascript:;" class="btn btn-xs text-dark editThisBtn"  data-type="poi" data-id="<?php echo (string)$element["_id"] ?>" ><i class="fa fa-pencil-square-o"></i> <?php echo Yii::t("common","Edit") ?></a>
							<a href="javascript:;" class="btn btn-xs text-red deleteThisBtn" data-type="poi" data-id="<?php echo (string)$element["_id"] ?>" ><i class="fa fa-trash"></i> <?php echo Yii::t("common","Delete") ?></a> 
							<div class="space1"></div>
						<?php } ?>
					<?php } ?>
				</div>

		<div class="col-md-12 padding-15 menubar">
			<button class="btn btn-default btn-menubar" id="btn-menu-home">A PROPOS</button>
			<button class="btn btn-default btn-menubar" id="btn-menu-stream">CARNET DE BORD</button>
			<button class="btn btn-default btn-menubar" id="btn-menu-directory-poi">PRODUCTIONS</button>
		</div>

		<div id="section-home">
			<?php   
				var_dump(@$poi);
	    		$desc = array( array("shortDescription"=>@$element["description"]),
	    					);

	    		if(@$desc && sizeOf(@$desc)>0)
	    		$this->renderPartial('../pod/sectionElements', 
	    								array(  "items" => $desc,
												"sectionKey" => "description",
												"sectionTitle" => "Présentation",
												"sectionShadow" => true,
												"msgNoItem" => "Aucune description",
												"imgShape" => "square",
												"useImg" => false,
												"fullWidth" => true, //only for 1 element
												"useBorderElement"=>false,

											"styleParams" => array(	"bgColor"=>"#FFF",
															  		"textBright"=>"dark",
															  		"fontScale"=>3),
											));
    	?>
		<?php if ($type == "poi"){ ?>
		<div id="divTags" class="col-md-12 col-sm-12 col-xs-12">
			<?php if(@$element["tags"]){ ?>
				<?php 
					$i=0; 
					foreach($element["tags"] as $tag){ 
						if($i<6) { 
							$i++;?>
							<div class="tag label label-default" data-val="<?php echo  $tag; ?>">
								<i class="fa fa-tag"></i> <?php echo  $tag; ?>
							</div>
			<?php 		}
					} 
			} ?>		
		</div>
		<section id="timeline" class="inline-block col-md-12"  style="background-color: #f8f6f6;">
    		<h2 class="section-title text-dark">Commentaires</h2>
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<ul class="inline-block" id="comment-page">
				</ul>
			</div>
		</section>
		<?php } else { ?>
    	<section id="timeline" class="bg-white inline-block col-md-12"  style="background-color: #f8f6f6;">
    		<h2 class="section-title text-dark">Historique</h2>
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<ul class="timeline inline-block" id="timeline-page">
				</ul>
			</div>
		</section>
		<?php } ?>

		<div id="section-stream" class="col-md-12">
			
		</div>

		<div id="section-directory" class="col-md-12">
		
		</div>
	</div>



	<div class="col-lg-2 col-md-2 col-sm-3 col-members">
		<h3>Membres du groupe (<span id="nbMemberTotal"></span>)</h3>
		<hr>
		<h4>Administrateurs (<span id="nbAdmin"></span>)</h4>

		<?php 
			//var_dump($members);
			$nbAdmin = 0;
			if(@$members && !empty($members)) {
				foreach($members as $key => $member){ 
					if(@$member["isAdmin"] == true){ $nbAdmin++;
					$profilThumbImageUrl = Element::getImgProfil($member, "profilThumbImageUrl", $this->module->assetsUrl);
		?>
			<a href="#"  class="lbh col-md-12 no-padding margin-top-5 elipsis">
				<img class="img-circle" src="<?php echo $profilThumbImageUrl; ?>" height=35 width=35> 
				<span class="username-min"><?php echo @$member["name"]; ?></span>
			</a>
		<?php }}} ?>

		<div class="col-md-12 no-padding margin-top-5">
			<hr>
			<h4>Membres (<span id="nbMember"></span>)</h4>
		</div>

		<?php 
			//var_dump($members);
			$nbMember = 0;
			if(@$members && !empty($members)) {
				foreach($members as $key => $member){ 
					if(!isset($member["isAdmin"]) || @$member["isAdmin"]==false){ $nbMember++;
					$profilThumbImageUrl = Element::getImgProfil($member, "profilThumbImageUrl", $this->module->assetsUrl);
		?>
			<a href="#"  class="lbh col-md-12 no-padding margin-top-5 elipsis">
				<img class="img-circle" src="<?php echo $profilThumbImageUrl; ?>" height=35 width=35> 
				<span class="username-min"><?php echo @$member["name"]; ?></span>
			</a>
		<?php }}} ?>
	</div>	


<script type="text/javascript">

	var peopleReference = false;
  	var mentionsContact = [];

  	var nbMember = <?php echo $nbMember; ?>;
  	var nbAdmin = <?php echo $nbAdmin; ?>;
  	var contextType = "<?php echo $type ?>";
  	var contextId = "<?php echo (string)$element["_id"] ?>";
  	
	jQuery(document).ready(function() {
	
		$(".btn-full-desc").click(function(){
            var sectionKey = $(this).data("sectionkey");
            if($("section#"+sectionKey+" .item-desc").hasClass("fullheight")){
                $("section#"+sectionKey+" .item-desc").removeClass("fullheight");
                $(this).html("<i class='fa fa-plus-circle'></i>");
            }else{
                $("section#"+sectionKey+" .item-desc").addClass("fullheight");
                $(this).html("<i class='fa fa-minus-circle'></i>");
            }
        });

		$("#nbAdmin").html(nbAdmin);
		$("#nbMember").html(nbMember);
		$("#nbMemberTotal").html(nbAdmin+nbMember);

		var url = "news/index/type/"+contextType+"/id/"+contextId+"?isFirst=1&";
		console.log("URL", url);
		if(contextType=="projects"){
			ajaxPost('#timeline-page', baseUrl+'/'+moduleId+'/'+url+"renderPartial=true&tpl=co2&nbCol=2", 
				null,
				function(){ 
					
			},"html");
		}
		if(contextType=="poi"){
			getAjax('#comment-page',baseUrl+'/'+moduleId+"/comment/index/type/"+contextType+"/id/"+contextId,function(){ 
					
			},"html");
		}

	});


	function initMenuDetail(){
		$("#btn-menu-home").click(function(){
        	hideAllSections();
        	$("#section-home").show();
        });

        $("#btn-menu-stream").click(function(){
        	hideAllSections();
        	$("#section-stream").show();
        	var url = "news/index/type/citoyens/id/<?php echo (string)$element["_id"] ?>?isFirst=1&";
			console.log("URL", url);
			ajaxPost('#section-stream', baseUrl+'/'+moduleId+'/'+url+"renderPartial=true&tpl=co2&nbCol=1", 
				null,
				function(){ 
					
			},"html");
        });

        $("#btn-menu-directory-poi").click(function(){
        	hideAllSections();
        	$("#section-directory").show();

 		// 	var type = "?type=poi";
	  //   	ajaxPost('#section-directory', baseUrl+'/'+moduleId+"/default/directory"+type, 
			// 	null,
			// 	function(){ 
					
			// },"html");
        });
	}


	function hideAllSections(){
		$("#section-home").hide();
		$("#section-stream").hide();
		$("#section-directory").hide();
	}
</script>