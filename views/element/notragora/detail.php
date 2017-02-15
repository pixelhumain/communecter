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
		background-color: #fff !important;
	    min-height: 100%;
	    position: absolute;
	    right: 0px;
	    -webkit-box-shadow: 0px 5px 5px -2px #656565 !important;
	    -o-box-shadow: 0px 5px 5px -2px #656565 !important;
	    /* box-shadow: 0px -5px 5px -2px #656565 !important; */
	    filter: progid:DXImageTransform.Microsoft.Shadow(color=#656565, Direction=NaN, Strength=5) !important;
	}
	.img-header{
		max-height: 350px;
		min-height: 350px;
		width:100%;
		overflow: hidden;
		/*background-image: url("<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/tropic.jpg");
		background-size: 100%;*/
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
		margin-top:0px;
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
	iframe.fullScreen {
	    width: 100%;
	    height: 100%;
	    position: absolute;
	    top: 0;
	    left: 0;
	}
	.contentEntity{
		padding: 0px !important;
		margin: 0px !important;
		border-top: solid rgba(128, 128, 128, 0.2) 1px;
		margin-left: 0% !important;
		width: 100%;
		box-shadow: 0px 0px 5px -1px #d3d3d3;
	}
	.contentEntity:hover {
   	 background-color: rgba(211, 211, 211, 0.2);
	}
	.container-img-parent {
	    display: block;
	    width: 100%;
	    max-width: 100%;
	    /*min-height: 90px;*/
	    max-height: 90px;
	    overflow: hidden;
	    background-color: #d3d3d3;
	    text-align: center;
    }
    .container-img-parent i.fa {
	    margin-top: 20px;
	    font-size: 50px;
	    color: rgba(255, 255,255, 0.8);
	}

	.fileupload, .fileupload-preview.thumbnail, .fileupload-new .thumbnail, 
	.fileupload-new .thumbnail img, .fileupload-preview.thumbnail img {
	    width: 100%!important;
	    max-height:unset!important;
	}

	#fileuploadContainer{
		margin:-1px!important;
	}
	#fileuploadContainer .thumbnail{
		border-radius: 0px!important
	}
	#profil_imgPreview{}
</style>
	<div class="col-lg-10 col-md-10 col-sm-9 no-padding" id="onepage">

		<?php 
		if ($type == "poi"){ 
			if(@$element["type"]=="video" && @$element["medias"]){ 
				$videoLink=str_replace ( "autoplay=1" , "autoplay=0" , @$element["medias"][0]["content"]["videoLink"]  );
			?>
				<div class="col-xs-12">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item fullScreen" src="<?php echo @$videoLink ?>" allowfullscreen></iframe>
					</div>
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 text-dark center">
					<h1 class="center"> 
						<?php echo $element['name']; ?>
					</h1>
					<?php if(@Yii::app()->session["userId"]){ ?> 
						<?php if ($edit==true || ($openEdition == true )) { ?>
							<a href="javascript:;" class="btn btn-xs text-dark editThisBtn"  data-type="poi" data-id="<?php echo (string)$element["_id"] ?>" ><i class="fa fa-pencil-square-o"></i> <?php echo Yii::t("common","Edit") ?></a>.
							<a href="javascript:;" class="btn btn-xs text-red deleteThisBtn" data-type="poi" data-id="<?php echo (string)$element["_id"] ?>" ><i class="fa fa-trash"></i> <?php echo Yii::t("common","Delete") ?></a> 
							<div class="space1"></div>
						<?php } ?>
					<?php } ?>
				</div>
		<?php } ?>
		<?php }else{ ?>
				<div class="img-header">
					
					<?php 
						if(@$element["profilMediumImageUrl"] && !empty($element["profilMediumImageUrl"]))
							$images=array("profil"=> array($element["profilMediumImageUrl"]));
						else 
							$images="";	

						$this->renderPartial('../pod/fileupload', array(  "itemId" => (string) $element["_id"],
																		  "type" => $type,
																		  "resize" => false,
																		  "contentId" => Document::IMG_PROFIL,
																		  "show" => true,
																		  "editMode" => $edit,
																		  "image" => $images,
																		  "openEdition" => $openEdition)); 
					//	$profilThumbImageUrl = Element::getImgProfil(@$entity, "profilMediumImageUrl", $this->module->assetsUrl);
					?>

				</div>
		<div class="element-name text-dark">
			<?php echo @$element["name"]; ?>
			<!-- <button class="btn btn-default btn-follow"><i class="fa fa-star"></i> SUIVRE</button> -->
		</div>
		<div class="col-md-12 padding-15 menubar">
			<button class="btn btn-default btn-menubar" id="btn-menu-home">A PROPOS</button>
			<button class="btn btn-default btn-menubar" id="btn-menu-stream">CARNET DE BORD</button>
			<?php if( $type != Person::COLLECTION){?>
				<button class="btn btn-default btn-menubar" id="btn-menu-directory-poi">PRODUCTIONS</button>
			<?php } ?>

			<?php if(isset(Yii::app()->session["userId"]) && Yii::app()->session["userId"] == @$element["creator"]){ ?>
			<button onclick='javascript:elementLib.openForm("poi","subPoi")' class='btn btn-default pull-right btn-menubar'>
				<i class='fa fa-plus'></i> <i class='fa fa-video-camera'></i> Ajouter une production
			</button>
			<?php } ?>
		</div>
		<?php } ?>
		<div id="section-home">
			<?php   
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
				<div id="divTags" class="col-md-12 col-sm-12 col-xs-12 padding-10">
					<?php if(@$element["tags"]){ ?>
						<?php 
							$i=0; 
							foreach($element["tags"] as $tag){ 
								if($i<6) { 
									$i++;?>
									<div class="tag label label-default" data-val="<?php echo  $tag; ?>" style="margin:5px;">
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
		</div>

		<div id="section-stream" class="col-md-6 col-md-offset-1">
			
		</div>


		<div id="section-directory" class="col-md-12"></div>
	</div>



	<div class="col-lg-2 col-md-2 col-sm-3 col-members">
		<?php if($type=="poi"){ 
				//var_dump($parent);
				$spec = Element::getElementSpecsByType( @$parent["typeSig"] );
			?>
			<h3>Réalisé par</h3>
			<hr>
			<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 no-padding'>
				<div class="contentEntity">
				<a href="#<?php echo $spec["hash"]; echo @$parent["id"]?>" class="container-img-parent lbh add2fav">
					<?php
					$imgProfil = "<i class='fa fa-image fa-2x'></i>";
					if(@$parent["profilImageUrl"] && !empty($parent["profilImageUrl"])){
						$imgProfil= "<img class='img-responsive' src='".Yii::app()->createUrl($parent["profilImageUrl"])."'/>";
            		} 
					echo $imgProfil;
                	?>
				</a>
				<div class="padding-10 informations">
				<a href='#<?php echo $spec["hash"]; echo @$parent["id"]?>' class='entityName text-dark lbh add2fav text-light-weight margin-bottom-5'>
                    <?php echo @$parent["name"] ?> 
                </a>
                </div>
                </div>
			</div>
		<?php } else { ?>
			<h3>Membres du groupe (<span id="nbMemberTotal"></span>)</h3>
			<hr>
			<h4>Administrateurs (<span id="nbAdmin"></span>)</h4>

			<?php 
				$nbAdmin = 0;
				if(@$members && !empty($members)) {
					foreach($members as $key => $member){ 
						if(@$member["isAdmin"] == true){ $nbAdmin++;
						$profilThumbImageUrl = Element::getImgProfil($member, "profilThumbImageUrl", $this->module->assetsUrl);
						$spec = Element::getElementSpecsByType( @$member["type"] );
			?>
						<a href="#<?php echo $spec["hash"]; echo @$member["id"]?>"  class="lbh col-md-12 no-padding margin-top-5 elipsis">
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
					$spec = Element::getElementSpecsByType( @$member["type"] );
		?>
			<a href="#<?php echo $spec["hash"]; echo @$member["id"]?>"  class="lbh col-md-12 no-padding margin-top-5 elipsis">
				<img class="img-circle" src="<?php echo $profilThumbImageUrl; ?>" height=35 width=35> 
				<span class="username-min"><?php echo @$member["name"]; ?></span>
			</a>
		<?php }}}} ?>
	</div>	


<script type="text/javascript">

	var peopleReference = false;
  	var mentionsContact = [];
  	var contextType = "<?php echo $type ?>";
  	var contextId = "<?php echo (string)$element["_id"] ?>";
  	var nbMember = 0;
  	var nbAdmin = 0;

  	if(contextType=="projects"){
		nbMember = "<?php echo @$nbMember; ?>";
		nbAdmin = "<?php echo @$nbAdmin; ?>";
  	}
  	<?php
  	$showOdesc = true ;
	if(Person::COLLECTION == $type){
		$showLocality = (Preference::showPreference($element, $type, "locality", Yii::app()->session["userId"])?true:false);
		$showOdesc = ((Preference::isOpenData($element["preferences"]) && Preference::isPublic($element, "locality"))?true:false);	
	}
  	$odesc = "" ;
	if($showOdesc == true){
		$controller = Element::getControlerByCollection($type) ;
		if($type == Person::COLLECTION)
			$odesc = $controller." : ".addslashes( strip_tags(json_encode(@$element["shortDescription"]))).",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",".@$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"] ;
		else if($type == Organization::COLLECTION)
			$odesc = $controller." : ".@$element["type"].", ".addslashes( strip_tags(json_encode(@$element["shortDescription"]))).",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",".@$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"];
		else if($type == Event::COLLECTION)
			$odesc = $controller." : ".@$element["startDate"].",".@$element["endDate"].",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",". @$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"].",".addslashes(strip_tags(json_encode(@$element["shortDescription"])));
		else if($type == Project::COLLECTION)
			$odesc = $controller." : ".addslashes( strip_tags(json_encode(@$element["shortDescription"]))).",".addslashes(json_encode(@$element["address"]["streetAddress"])).",".@$element["address"]["postalCode"].",".@$element["address"]["addressLocality"].",".@$element["address"]["addressCountry"];
	}
		
	?>
  	var contextData = {
		name : "<?php echo addslashes($element["name"]) ?>",
		id : "<?php echo (string)$element["_id"] ?>",
		type : "<?php echo $type ?>",
		controller : <?php echo json_encode(Element::getControlerByCollection($type))?>,
		otags : "<?php echo addslashes($element["name"]).",".$type.",communecter,".@$element["type"].",".addslashes(@implode(",", $element["tags"])) ?>",
		creator : "<?php echo @$element["creator"] ?>",
		odesc : <?php echo json_encode($odesc) ?>,
		<?php 
		if( @$element["startDate"] )
			echo "'startDate':'".$element["startDate"]."',";
		if( @$element["endDate"] )
			echo "'endDate':'".$element["endDate"]."'"; ?>
		
	};	
  	<?php $entitiesPois = PHDB::find( Poi::COLLECTION, array("parentId"=>(String) $element["_id"],"parentType"=>$type)); ?>
  	
  	var pois = <?php echo json_encode($entitiesPois); ?>

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
		if(contextType=="projects" || contextType=="citoyens"){
			ajaxPost('#timeline-page', baseUrl+'/'+moduleId+'/'+url+"renderPartial=true&tpl=co2&nbCol=2", 
				null,
				function(){ 
					
			},"html");
		}
		if(contextType=="poi"){
			getAjax('#comment-page',baseUrl+'/'+moduleId+"/comment/index/type/"+contextType+"/id/"+contextId,function(){ 
					
			},"html");
		}
		$(".deleteThisBtn").off().on("click",function () 
		{
			mylog.log("deleteThisBtn click");
	        $(this).empty().html('<i class="fa fa-spinner fa-spin"></i>');
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var type = $(this).data("type");
	        var urlToSend = baseUrl+"/"+moduleId+"/element/delete/type/"+type+"/id/"+id;
	        
	        bootbox.confirm("confirm please !!",
        	function(result) 
        	{
				if (!result) {
					btnClick.empty().html('<i class="fa fa-trash"></i>');
					return;
				} else {
					$.ajax({
				        type: "POST",
				        url: urlToSend,
				        dataType : "json"
				    })
				    .done(function (data) {
				        if ( data && data.result ) {
				        	toastr.info("élément effacé");
				        	$("#"+type+id).remove();
				        	//window.location.href = "";
				        } else {
				           toastr.error("something went wrong!! please try again.");
				        }
				    });
				}
			});

		});
		$(".editThisBtn").off().on("click",function (){
	        $(this).empty().html('<i class="fa fa-spinner fa-spin"></i>');
	        var btnClick = $(this);
	        var id = $(this).data("id");
	        var type = $(this).data("type");
	        elementLib.editElement(type,id);
		});

		initMenuDetail();
	});

function requestFullScreen(element) {
    // Supports most browsers and their versions.
    var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullscreen;

    if (requestMethod) { // Native full screen.
        requestMethod.call(element);
    } else if (typeof window.ActiveXObject !== "undefined") { // Older IE.
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}

function makeFullScreen() {
    document.getElementsByTagName("iframe")[0].className = "fullScreen";
    var elem = document.body;
    requestFullScreen(elem);
}

function initMenuDetail(){
	$("#btn-menu-home").click(function(){
    	hideAllSections();
    	$("#section-home").show();
    });

    $("#btn-menu-stream").click(function(){
    	hideAllSections();
    	$("#section-stream").show();
    	var url = "news/index/type/"+contextType+"/id/"+contextId+"?isFirst=1&";
		console.log("URL", url);
		ajaxPost('#section-stream', baseUrl+'/'+moduleId+'/'+url+"renderPartial=true&tpl=co2&nbCol=1", 
			null,
			function(){ 
				
		},"html");
    });

    $("#btn-menu-directory-poi").click(function(){
    	hideAllSections();
    	$("#section-directory").show();

    	var poisHtml = directory.showResultsDirectoryHtml(pois, "poi");

    	//if( userId && userId == contextData.creator )
    	//	poisHtml = poisHtml;
    	
    	$("#section-directory").html(poisHtml);
    	bindLBHLinks();
		
		// 	var type = "?type=poi";
 		//  ajaxPost('#section-directory', baseUrl+'/'+moduleId+"/default/directory"+type, 
		// 	null,
		// 	function(){ 
				
		// },"html");
    });
}


function hideAllSections(){
	$("#section-home").hide();
	$("#section-stream").hide().html("");
	$("#section-directory").hide();
}
</script>