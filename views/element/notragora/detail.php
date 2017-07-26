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
	.acceptBtn{
		border-radius:3px !important;
		color: white;
		background-color: #71CE4E;
		padding: 5px 10px;
		margin-top: 5px;
	}
	.acceptBtn:hover{
		color: #71CE4E !important;
		background-color: white;
		border: 1px solid #71CE4E;
	}
	.acceptBtn i{
		font-size:12px;
	}
	.refuseBtn{
		border-radius:3px !important;
		color: white;
		background-color: #E33551;
		padding: 5px 10px;
		margin-top: 5px;

	}
	.refuseBtn:hover{
		color: #E33551 !important;
		background-color: white;
		border: 1px solid #E33551;
	}
	.refuseBtn i{
		font-size:12px;
	}
	.waitAnswer{
		position:absolute;
		left:38px;
	}
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
		width:100%;
		overflow: hidden;
		/*background-image: url("<?php echo Yii::app()->theme->baseUrl; ?>/assets/images/tropic.jpg");
		background-size: 100%;*/
	}
	.main-col-search{
		padding:0px;
	}
	.mix{
		min-height: 100px;
		/*width: 31.5%;*/
		background-color: white;
		display: inline-block;
		border:1px solid #bbb;
		margin-right : 1.5%;
		border-radius: 10px;
		padding:1%;
		margin:-1px;
		-webkit-box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
		-moz-box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
		box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.55);
	}
	#grid .followers{
	display: none;
}
	.mix a{
		color:black;
		/*font-weight: bold;*/
	}
	.mix .imgDiv{
		float:left;
		width:30%;
		background: ;
		margin-top:0px;
	}
	.mix .detailDiv{
		float:right;
		width:70%;
		margin-top:0px;
		padding-left:10px;
		text-align: left;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
	}

	.mix .toolsDiv{
		float:right;
		width:20%;
		margin-top:0px;
		padding-left:10px;
		text-align: left;
		text-overflow: ellipsis;
		white-space: nowrap;
		overflow: hidden;
		color:white;
	}

	.mix .text-xss{ font-size: 11px; }

	#Grid{
		margin-top: 20px;
		background-color: transparent;
		padding: 15px;
		border-radius: 4px;
		/*border-right: 1px solid #474747;*/
		padding: 0px;
		width:100%;
	}
	#Grid .mix{
		margin-bottom: -1px !important;
	}
	#Grid .item_map_list{
		padding:10px 10px 10px 0px;
		margin-top:0px;
		text-decoration:none;
		background-color:white;
		border: 1px solid rgba(0, 0, 0, 0.08); /*rgba(93, 93, 93, 0.15);*/
	}
	#Grid .item_map_list .left-col .thumbnail-profil{
		width: 75px;
		height: 75px;
	}
	#Grid .ico-type-account i.fa{
		margin-left:11px !important;
	}
	#Grid .thumbnail-profil{
		margin-left:10px;
	}
	#Grid .detailDiv a.text-xss{
		font-size: 12px;
		font-weight: 300;
	}

	.label.address.text-dark{
		padding:0.4em 0.1em 0.4em 0em !important;
	}
	.detailDiv a.thumb-info.item_map_list_panel{
		font-weight:500 !important;
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
		color: rgb(92,75,62) !important;
	}

	#description .btn-edit-section{
		display: none;

	}

	.col-members h3{
		text-transform: uppercase;
		color:rgb(92,75,62);
		font-size: 0.7em;
		font-weight: 700;
	}
	.col-members h4{
		color:rgb(92,75,62);
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
	    width: auto !important;
	}
	.user-image{
		background-color: white;
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
			<?php } ?>
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

			<?php
			if(@Yii::app()->session["userId"]) {
				if (!@$deletePending) {
					if(  Authorisation::canEditItem( Yii::app()->session["userId"], $_GET["type"], (string)$_GET["id"]) || Yii::app()->session["userId"] == @$element["creator"] ){?>
					<a href='javascript:' class="btn" onclick='elementLib.editElement("<?php echo @$_GET["type"]; ?>","<?php echo (string)@$element["_id"]; ?>")' ><i class="fa fa-pencil"></i> Editer</a>

					<?php if ((string)$_GET["id"]==Yii::app()->session["userId"]){ ?>
						<a href='javascript:' id="changePasswordBtn" class='btn btn-default text-red pull-right'>
							<i class='fa fa-key'></i> <?php echo Yii::t("common","Change password"); ?>
						</a>
					<?php	}
					}
					if ($type == Organization::COLLECTION || $type == Project::COLLECTION ) {
						if (Authorisation::canDeleteElement((String)$element["_id"], $type, Yii::app()->session["userId"])) { ?>
					<?php  /*a href="javascript:;" data-toggle="modal" data-target="#modal-delete-element" class="btn text-red"><i class="fa fa-trash" ></i> <?php echo Yii::t("common","Delete")?></a>*/?>
					<?php }
					}
				} else {
					echo " (Suppression en cours)";
				}
			}
			?>
			<?php if(@Yii::app()->session["userId"] && $type==Organization::COLLECTION){ ?>
			<div class="linkBtn pull-right">
			<?php if($type != Person::COLLECTION && isset($element["_id"]) && isset(Yii::app()->session["userId"]) &&
	                Link::isLinked((string)$element["_id"], $type, Yii::app()->session["userId"])){ ?>
		            <a href="javascript" class="btn text-red tooltips pull-right"
		            		data-placement="bottom"
		            		data-toggle='modal'
							data-original-title="Quitter ce groupe de travail"
							onclick="disconnectTo('<?php echo $type ?>','<?php echo (string)$element["_id"] ?>','<?php echo Yii::app()->session["userId"] ?>','<?php echo Person::COLLECTION ?>','members')">
		            	<i class="fa fa-unlink disconnectBtnIcon"></i> <?php echo Yii::t( "common", "Leave") ?>
		            </a>
		  	    <?php }
		  	    if(!@$element["links"]["members"][Yii::app()->session["userId"]]){ ?>
	            	<a href="javascript" class="btn tooltips pull-right"
		            		data-placement="bottom"
		            		data-toggle='modal'
							data-original-title="<?php echo Yii::t( "common", "Devenir membre de ce groupe de travail") ?>"
							onclick="connectTo('<?php echo $type ?>','<?php echo (string)$element["_id"] ?>','<?php echo Yii::app()->session["userId"] ?>','<?php echo Person::COLLECTION ?>','member','<?php echo addslashes($element["name"]) ?>')">
		            	<i class="fa fa-user-plus becomeAdminBtn"></i> <?php echo Yii::t( "common", "Become member") ?>
		            </a>
	           <?php }else{
	                //Ask Admin button
	                if ($type != Person::COLLECTION
	                    && !in_array(Yii::app()->session["userId"], Authorisation::listAdmins((string)$element["_id"], $type,true)) ) { ?>
	                	<a href="javascript" class="btn tooltips pull-right"
		            		data-placement="bottom"
		            		data-toggle='modal'
							data-original-title="<?php echo Yii::t( "common", "Devenir administrateur de ce groupe de travail") ?>"
							onclick="connectTo('<?php echo $type ?>','<?php echo (string)$element["_id"] ?>','<?php echo Yii::app()->session["userId"] ?>','<?php echo Person::COLLECTION ?>','admin','<?php echo addslashes($element["name"]) ?>')">
		            	<i class="fa fa-user-plus becomeAdminBtn"></i> <?php echo Yii::t( "common", "Become admin") ?>
		            	</a>
	                <?php }
	            } ?>
	            </div>
	        <?php } ?>
		</div>
		<div class="col-md-12 padding-15 menubar">
			<button class="btn btn-default btn-menubar" id="btn-menu-home">A PROPOS</button>
			<button class="btn btn-default btn-menubar" id="btn-menu-stream">CARNET DE BORD</button>
			<?php if( $type == Organization::COLLECTION){?>
				<button class="btn btn-default btn-menubar" id="btn-menu-gallery">GALERIE PHOTOS</button>
			<?php } ?>
			<?php if( $type != Person::COLLECTION){?>
				<button class="btn btn-default btn-menubar" id="btn-menu-directory-poi">PRODUCTIONS</button>
			<?php } ?>
			<?php	if($type == Person::COLLECTION && Yii::app()->session['userId']==(String)$element["_id"]){ ?>
				<button class="btn btn-default btn-menubar" id="btn-menu-directory-all">MES GROUPES</button>
			<?php	} ?>

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
		<div id="section-gallery" class="col-md-12">

		</div>

		<div id="section-directory" class="col-md-12">

	</div>

	<div id="section-directory-all" class="col-md-12">
	<ul id="Grid" class="pull-left  list-unstyled" style="display:none;">
	<?php $organizations = Person::getOrganizationsById(Yii::app()->session["userId"]);//PHDB::find(Organization::COLLECTION);
	$memberId = Yii::app()->session["userId"];
	$memberType = Person::COLLECTION;
	$tags = array();
	$tagsHTMLFull = "";
	$scopes = array(
		"codeInsee"=>array(),
		"postalCode"=>array(),
		"region"=>array(),
		"addressLocality"=>array(),
	);
	$scopesHTMLFull = "";
	foreach ($organizations as $e)
		{
			buildDirectoryLine($e, Organization::COLLECTION, Organization::CONTROLLER, Organization::ICON, $this->module->id,$tags,$scopes,$tagsHTMLFull,$scopesHTMLFull,1,"memberOf", $type, $_GET["id"]);
		}


	function buildDirectoryLine( $e, $collection, $type, $icon, $moduleId, &$tags, &$scopes, &$tagsHTMLFull,&$scopesHTMLFull,$manage, $connectType=null, $elementType=null,$elementId=null)
	{
		if((!@$e['_id']  && !@$e["id"] ) || !@$e['id'] || !@$e["name"] || $e["name"] == "" )
			//return;
		$actions = "";
		$id = (@$e['_id']) ? $e["_id"] : "";

		// Don't consider context element
		if($id==$elementId && $collection==$elementType)
			//return;

		/* **************************************
		* TYPE + ICON
		***************************************** */
		$img = '';
		if ($e && !empty($e["profilThumbImageUrl"])){
			$img = '<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.Yii::app()->createUrl('/'.$e['profilThumbImageUrl']).'">';
		}else{
			$defaultImg=$collection;
			$assetsUrl= Yii::app()->controller->module->assetsUrl;
			if($collection == "followers" || $collection == "attendees" || $collection == "guests")
				$defaultImg = Person::COLLECTION;
			$img ='<img class="thumbnail-profil" width="50" height="50" alt="image" src="'.$assetsUrl.'/images/thumb/default_'.$defaultImg.'.png">';
		}

		/* **************************************
		* TAGS FILTER
		***************************************** */
		$tagsClasses = "";
		if(@$e["tags"]){
			foreach ($e["tags"] as $key => $value) {
				$tagsClasses .= ' '.preg_replace("/[^A-Za-z0-9]/", "", $value) ;
			}
		}

		/* **************************************
		* SCOPES FILTER
		***************************************** */
		$scopesClasses = "";
		if( @$e["address"] && @$e["address"]['codeInsee'] )
			$scopesClasses .= ' '.$e["address"]['codeInsee'];
		if( @$e["address"] && @$e["address"]['postalCode'] )
			$scopesClasses .= ' '.$e["address"]['postalCode'];
		if( @$e["address"] && @$e["address"]['region'] )
			$scopesClasses .= ' '.$e["address"]['region'];
		if( @$e["address"] && @$e["address"]['addressLocality'] ){
			$locality = str_replace( " ", "", $e["address"]['addressLocality']);
			$scopesClasses .= ' '.$locality;
		}

		//$url = Yii::app()->createUrl('/'.$moduleId.'/'.$type.'/dashboard/id/'.$id);
		$name = ( @$e["name"] ) ? $e["name"] : "" ;
		if($type=="person")
			$type="citoyen";
		$url = "#element.detail.type.".$type."s.id.".$id;
		$url = 'href="'.$url.'" class="lbh"';
		$process = "";
		if(@$e["isAdminPending"])
			$process = " <color class='text-red'>(".Yii::t("common","Wait for confirmation").")</color>";
		else if(!@$e["isAdmin"] && @$e["toBeValidated"])
			$process = " <color class='text-red'>(en attente de confirmation)</color>";

		if(@$e["tobeactivated"] || @$e["pending"]){
			$process= " (En cours d'inscription)";
			$processStyle='style="filter:grayscale(100%);-webkit-filter:grayscale(100%);"';
		}
		else{
			$processStyle="";
		}
		$entryType = ( @$e["type"]) ? $e["type"] : "";
		$panelHTML = '<li id="'.$collection.(string)$id.'" class="item_map_list col-lg-3  col-md-4 col-sm-6 col-xs-6 mix '.$collection.'Line '.$collection.' '.$scopesClasses.' '.$tagsClasses.' '.$entryType.'" data-cat="1" style="display: inline-block;">'.
			'<div style="position:relative;">'.
						'<div class="portfolio-item">';
		$strHTML = '<a '.$url.' class="thumb-info item_map_list_panel" data-id="'.$id.'"  >'.$name.'</a>';

		if ($process) {
			$strHTML .= '<span class="text-xss">'.$process.'</span>';
		}

		/* **************************************
		* DATE for Event and PROJECT uses
		***************************************** */

		if(isset($e["startDate"]) && !isset($e["endDate"]) && $type == "event"){
			$strHTML .=  '<br/>Le <a class="startDateEvent" '.$url.'>'.date("d/m/y H:i",(isset($e["startDate"]->sec))  ? $e["startDate"]->sec : strtotime($e["startDate"]) ).'</a>';
		}
		if(isset($e["startDate"]) && isset($e["endDate"]) && $type == "event"){
			if(isset($e["startDate"]->sec)){
				$strHTML .=  '<br/>'.
							 '<a class="startDateEvent start double" '.$url.'>'.date('m/d/Y', $e["startDate"]->sec).'</a>';
				$strHTML .=  '<a class="startDateEvent end double" '.$url.'>'.date('m/d/Y', $e["endDate"]->sec).'</a>';

			}else{
				if (!empty($e["startDate"]) && !empty($e["endDate"])) {
					if (gettype($e["startDate"]) == "object" && gettype($e["endDate"]) == "object") {
						//Set TZ to UTC in order to be the same than Mongo
						date_default_timezone_set('UTC');
						$e["startDate"] = date('Y-m-d H:i:s', $e["startDate"]->sec);
						$e["endDate"] = date('Y-m-d H:i:s', $e["endDate"]->sec);
					} else {
						//Manage old date with string on date event
						$now = time();
						$yesterday = mktime(0, 0, 0, date("m")  , date("d")-1, date("Y"));
						$yester2day = mktime(0, 0, 0, date("m")  , date("d")-2, date("Y"));
						$e["endDate"] = date('Y-m-d H:i:s', $yesterday);
						$e["startDate"] = date('Y-m-d H:i:s',$yester2day);
					}
				}

				$start = dateToStr($e["startDate"], "fr", true);
				$end = dateToStr($e["endDate"], "fr", true);

				if(substr($start, 0, 10) != substr($end, 0, 10)){
					$strHTML .=  '<br/>'.
								 '<a class="startDateEvent start double" '.$url.'>'.$e["startDate"].'</a>';
					$strHTML .=  '<a class="startDateEvent end   double" '.$url.'>'.$e["endDate"].'</a>';
				}else{
					$hour1 = substr($start, strpos($start, "-")+2, strlen($start));
					$hour2 = substr($end,   strpos($end,   "-")+2, strlen($end));

					if($hour1 == "00h00" && $hour2 == "23h59") {
						$strHTML .=  '<br/>'.
									 '<a class="startDateEvent double" '.$url.' allday="true"> Le '.substr($start, 0, 10).'</a>';
						$strHTML .=  '<a class="startDateEvent double" '.$url.'>'.Yii::t("event","All day",null,Yii::app()->controller->module->id).'</a>';
					}else{
						$strHTML .=  '<br/>'.
									 '<a class="startDateEvent double" '.$url.' allday="true"> Le '.substr($start, 0, 10).'</a>';
						$strHTML .=  '<a class="startDateEvent double" '.$url.'>'.$hour1. " - ".$hour2.'</a>';
					}
				}
			}
		}


		/* **************************************
		* TAGS
		***************************************** */
		$tagsHTML = "";
		if(isset($e["tags"]) && !empty($e["tags"])){
			foreach ($e["tags"] as $key => $value) {
				$tagsHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.preg_replace("/[^A-Za-z0-9]/", "", $value).'"><span class="text-red text-xss">#'.$value.'</span></a>';
				if( $tags != "" && !in_array($value, $tags) ) {
					array_push($tags, $value);
					$tagsHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.preg_replace("/[^A-Za-z0-9]/", "", $value).'"><span>#'.$value.'</span></a>';
				}
			}
		}

		/* **************************************
		* SCOPES
		***************************************** */
		$scopeHTML = "";
		if( isset($e["address"]) && isset( $e["address"]['codeInsee'])){
			//$scopeHTML .= ' <a href="#" class="filter" data-filter=".'.$e["address"]['codeInsee'].'"><span class="label address text-dark text-xss">'.$e["address"]['codeInsee'].'</span></a>';
			if( !in_array($e["address"]['codeInsee'], $scopes['codeInsee']) ) {
				array_push($scopes['codeInsee'], $e["address"]['codeInsee'] );
				$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['codeInsee'].'"><span>insee '.$e["address"]['codeInsee'].'</span></a>';
			}
		}
		if( isset($e["address"]) && isset( $e["address"]['postalCode'])){
			$scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.$e["address"]['postalCode'].'"><span class="label address text-dark text-xss">'.$e["address"]['postalCode'].'</span></a>';
			if( !in_array($e["address"]['postalCode'], $scopes['postalCode']) ) {
				$insee = isset($e["address"]['codeInsee']) ? $e["address"]['codeInsee'] : $e["address"]['postalCode'];
				array_push($scopes['postalCode'], $e["address"]['postalCode'] );
				$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$insee.'"><span>cp '.$e["address"]['postalCode'].'</span></a>';
			}
		}
		if( isset($e["address"]) && isset( $e["address"]['region']) ){
			$scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.$e["address"]['region'].'" ><span class="label address text-dark text-xss">'.$e["address"]['region'].'</span></a>';
			if( !in_array($e["address"]['region'], $scopes['region']) ) {
				array_push($scopes['region'], $e["address"]['region'] );
				$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.$e["address"]['region'].'"><span>region '.$e["address"]['region'].'</span></a>';
			}
		}
		if( isset($e["address"]) && isset( $e["address"]['addressLocality'])){
			if ($e["address"]['addressLocality']=="Unknown")
				$adresseLocality="Adresse non renseignée";
			else
				$adresseLocality=$e["address"]['addressLocality'];
			$scopeHTML .= ' <a href="javascript:;" class="filter" data-filter=".'.str_replace( " ", "", $e["address"]['addressLocality']).'" ><span class="label address text-dark text-xss">'.$adresseLocality.'</span></a>';
			if( !in_array($e["address"]['addressLocality'], $scopes['addressLocality']) ) {
				array_push($scopes['addressLocality'], $e["address"]['addressLocality'] );
				$scopesHTMLFull .= ' <a href="javascript:;" class="filter btn btn-xs btn-default text-red marginbot" data-filter=".'.str_replace( " ", "", $e["address"]['addressLocality']).'"><span>Locality  '.$e["address"]['addressLocality'].'</span></a>';
			}
		}

		//$strHTML .= '<div class="tools tools-bottom">'.$tagsHTML."<br/>".$scopeHTML.'</div>';
		$featuresHTML = "";
		if( $scopeHTML != "" ){
			$strHTML .= '<div class=" scopes'.$id.$type.' features">'.$scopeHTML.'</div>';
			//$featuresHTML .= ' <a href="#" onclick="showHideFeatures(\'scopes'.$id.$type.'\');"><i class="fa fa-circle-o text-red text-xss"></i></a>';
		}
		$strHTML .= '</div>';
		$strHTML .= "<br/><div>";//$tagsHTML."<br/>".$scopeHTML;
		if( isset( $e["tags"]) ){
			$strHTML .= '<div class="hide tags'.$id.$type.' features tagblock">'.$tagsHTML.'</div>';
			//$featuresHTML .= '<a href="#" onclick="showHideFeatures(\'tags'.$id.$type.'\');"><i class="fa fa-tags text-red text-xss"></i></a>';
		}
		if( isset($e["geo"]) && isset($e["geo"]["latitude"]) && isset($e["geo"]["longitude"]) ){
			//$featuresHTML .= ' <a href="#" onclick="$(\'.box-ajax\').hide(); toastr.error(\'show on map + label!\');"><i class="fa fa-map-marker text-red text-xss"></i></a>';
		}
		$strBtnHTML="";
		$color = "";
		if($icon == "fa-users") $color = "green";
		if($icon == "fa-user") $color = "yellow";
		if($icon == "fa-calendar") $color = "orange";
		if($icon == "fa-lightbulb-o") $color = "purple";
		$flag = '<div class="ico-type-account"><i class="fa '.$icon.' fa-'.$color.'"></i>';
		if(@$e["isAdmin"] && !@$e["isAdminPending"])
			$flag .= "<i class='fa fa-bookmark fa-rotate-270 fa-red' style='left:-5px;'></i>";
		$flag.="</div>";
		echo $panelHTML.
			'<div class="imgDiv left-col">'.$img.$flag.$featuresHTML.'</div>'.
			'<div class="detailDiv">'.$strHTML.'</div></div></div>'.$strBtnHTML.'</li>';
	} ?>
</ul>
</div>
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
		<?php } else if($type==Organization::COLLECTION) { ?>
			<h3>Membres du groupe (<span id="nbMemberTotal"></span>)</h3>
			<hr>
			<h4>Administrateurs (<span id="nbAdmin"></span>)</h4>

			<?php
				$nbAdmin = 0;
				$nbAdminPending=0;
				if(@$members && !empty($members)) {
					foreach($members as $key => $member){
						if(@$member["isAdmin"] == true && !@$member["isAdminPending"]){ $nbAdmin++;
						$profilThumbImageUrl = Element::getImgProfil($member, "profilThumbImageUrl", $this->module->assetsUrl);
						$spec = Element::getElementSpecsByType( @$member["type"] );
			?>
						<a href="#<?php echo $spec["hash"]; echo @$member["id"]?>"  class="lbh col-md-12 no-padding margin-top-5 elipsis">
							<img class="img-circle" src="<?php echo $profilThumbImageUrl; ?>" height=35 width=35>
							<span class="username-min"><?php echo @$member["name"]; ?></span>
							<?php if (@$member["pending"]){ ?>
								<br/><span style="font-style: italic;font-size: 10px;position: absolute;bottom: 0px;left: 38px;">En attente d'inscription</span>
							<?php } ?>
						</a>
			<?php 		} else if(@$member["isAdmin"] == true && @$member["isAdminPending"]) $nbAdminPending++;
					}
			}
			if($nbAdmin==0){ ?>
					<span style="font-style: italic;">Pas d'admin sur ce groupe de travail</span>
			<?php } ?>

			<div class="col-md-12 no-padding margin-top-5">
				<hr>
				<h4>Membres (<span id="nbMember"></span>)</h4>
			</div>

		<?php
			//var_dump($members);
			$nbMember = 0;
			$nbMemberPending=0;
			if(@$members && !empty($members)) {
				foreach($members as $key => $member){
					if((!isset($member["isAdmin"]) || @$member["isAdmin"]==false) && !@$member["toBeValidated"]){ $nbMember++;
					$profilThumbImageUrl = Element::getImgProfil($member, "profilThumbImageUrl", $this->module->assetsUrl);
					$spec = Element::getElementSpecsByType( @$member["type"] );
		?>
			<a href="#<?php echo $spec["hash"]; echo @$member["id"]?>"  class="lbh col-md-12 no-padding margin-top-5 elipsis">
				<img class="img-circle" src="<?php echo $profilThumbImageUrl; ?>" height=35 width=35>
				<span class="username-min"><?php echo @$member["name"]; ?></span>
				<?php if (@$member["pending"]){ ?>
					<br/><span style="font-style: italic;font-size: 10px;position: absolute;bottom: 0px;left: 38px;">En attente d'inscription</span>
				<?php } ?>
			</a>
		<?php }else if((!isset($member["isAdmin"]) || @$member["isAdmin"]==false) && @$member["toBeValidated"]) $nbMemberPending++;
		}}
			if($nbMember==0){ ?>
				<span style="font-style: italic;">Pas de membres sur ce groupe de travail</span>
			<?php }
			if($nbMemberPending > 0 || $nbAdminPending > 0){ ?>
				<div class="col-md-12 no-padding margin-top-5">
					<hr>
					<h4>En attente de réponse (<span id="nbPending"></span>)</h4>
				</div>
				<?php if($nbAdminPending > 0){ ?>
					<span style="font-style:italic;"> Pour administrer </span>
				<?php foreach($members as $key => $member){
						if(@$member["isAdmin"] == true && @$member["isAdminPending"]){
						$profilThumbImageUrl = Element::getImgProfil($member, "profilThumbImageUrl", $this->module->assetsUrl);
						$spec = Element::getElementSpecsByType( @$member["type"] );
				?>
						<div class="col-md-12 no-padding margin-top-5 elipsis">
							<img class="img-circle" src="<?php echo $profilThumbImageUrl; ?>" height=35 width=35>
							<a href="#<?php echo $spec["hash"]; echo @$member["id"]?>"  class="lbh username-min waitAnswer"><?php echo @$member["name"]; ?></a>
							<?php if(@Yii::app()->session["userId"] && $type != Person::COLLECTION && Authorisation::canEditItem(Yii::app()->session['userId'], $type, (String)$element["_id"])){ ?>
							<div style="font-style: italic;font-size: 10px;position: absolute;bottom: 0px;left: 38px;">
								<a href='javascript:;' class='label refuseBtn pull-right'
									onclick='var $this=$(this); disconnectTo("<?php echo $type ?>",
									"<?php echo (string)$element["_id"] ?>",
									"<?php echo $key ?>",
									"<?php echo Person::COLLECTION ?>",
									"members",
									function() {
										toastr.success("<?php echo Yii::t("common", "Answer well registered") ?>!!");
										$this.parents().eq(1).remove();
								},
								"<?php echo Link::IS_ADMIN_PENDING ?>");'
								style='margin-right: 5px;'>
									<i class="fa fa-remove"></i> Refuser
								</a>
								<a href='javascript:;'
									class='label acceptBtn pull-right'
									onclick='var $this=$(this); validateConnection("<?php echo $type ?>",
										"<?php echo (string)$element["_id"] ?>",
										"<?php echo $key ?>",
										"<?php echo Person::COLLECTION ?>",
										"isAdminPending",
										function() {
											toastr.success("<?php echo Yii::t("common", "New admin well register") ?>!!");
											loadByHash(location.hash);
										});'
									style='margin-right: 5px;'>
										<i class="fa fa-check"></i> Accepter
								</a>
							 </div>
							 <?php } ?>
						</div>
				<?php 	}
					}
				?>
				<?php } ?>
				<?php if($nbMemberPending > 0){ ?>
					<span style="font-style:italic;"> Pour rejoindre </span>
				<?php foreach($members as $key => $member){
						if(!@$member["isAdminPending"] && @$member["toBeValidated"]){
						$profilThumbImageUrl = Element::getImgProfil($member, "profilThumbImageUrl", $this->module->assetsUrl);
						$spec = Element::getElementSpecsByType( @$member["type"] );
				?>
						<div class="col-md-12 no-padding margin-top-5 elipsis">
							<img class="img-circle" src="<?php echo $profilThumbImageUrl; ?>" height=35 width=35>
							<a href="#<?php echo $spec["hash"]; echo @$member["id"]?>"  class="lbh username-min waitAnswer"><?php echo @$member["name"]; ?></a>
							<?php if(@Yii::app()->session["userId"] && $type != Person::COLLECTION && Authorisation::canEditItem(Yii::app()->session['userId'], $type, (String)$element["_id"])){ ?>
							<div style="font-style: italic;font-size: 10px;position: absolute;bottom: 0px;left: 38px;">
								<a href='javascript:;' class='label refuseBtn pull-right'
									onclick='var $this=$(this); disconnectTo("<?php echo $type ?>",
									"<?php echo (string)$element["_id"] ?>",
									"<?php echo $key ?>",
									"<?php echo Person::COLLECTION ?>",
									"members",
									function() {
										toastr.success("<?php echo Yii::t("common", "Answer well registered") ?>!!");
										$this.parents().eq(1).remove();
								},
								"<?php echo Link::IS_ADMIN_PENDING ?>");'
								style='margin-right: 5px;'>
									<i class="fa fa-remove"></i> Refuser
								</a>
								<a href='javascript:;'
									class='label acceptBtn pull-right'
									onclick='var $this=$(this); validateConnection("<?php echo $type ?>",
										"<?php echo (string)$element["_id"] ?>",
										"<?php echo $key ?>",
										"<?php echo Person::COLLECTION ?>",
										"<?php echo Link::TO_BE_VALIDATED; ?>",
										function() {
											toastr.success("<?php echo Yii::t("common", "New member well register") ?>!!");
											loadByHash(location.hash);
										});'
									style='margin-right: 5px;'>
										<i class="fa fa-check"></i> Accepter
								</a>
							 </div>
							 <?php } ?>
						</div>
				<?php 	}
					}
				?>
				<?php } ?>
			<?php }
			if(@Yii::app()->session["userId"] && $type != Person::COLLECTION && Authorisation::canEditItem(Yii::app()->session['userId'], $type, (String)$element["_id"])){ ?>
			<div class="col-md-12 no-padding margin-top-5">
				<hr>
				<button class="btn btn-default btn-menubar btn-menu-element btn-menu-element-addmembers tooltips"
						data-toggle='modal'
						data-placement="bottom"
						data-original-title="Ajouter des membres à ce groupe de travail"
						data-target='#modal-scope' >
					<i class="fa fa-send"></i> Inviter des membres
				</button>
				</div>
			<?php
  				$this->renderPartial('../element/addMembersFromMyContacts',array("type"=>$type, "parentId" =>(string)$element['_id'], "users"=>@$members));
				}
			}
		?>
	</div>

<?php if (Authorisation::canDeleteElement((String)$element["_id"], $type, Yii::app()->session["userId"]) && !@$deletePending) $this->renderPartial('../element/confirmDeleteModal'); ?>
<?php if (@$deletePending && (Authorisation::isElementAdmin((String)$element["_id"], $type, Yii::app()->session["userId"]) || Authorisation::isUserSuperAdmin(Yii::app()->session["userId"]))) $this->renderPartial('../element/confirmDeletePendingModal'); ?>

<script type="text/javascript">

	var peopleReference = false;
  	var mentionsContact = [];
  	var contextType = "<?php echo $type ?>";
  	var contextId = "<?php echo (string)$element["_id"] ?>";
  	var nbMember = 0;
  	var nbAdmin = 0;
  	var nbMemberPending = 0;
  	var nbPending = 0;

  	if(contextType=="organizations"){
		nbMember = "<?php echo @$nbMember; ?>";
		nbAdmin = "<?php echo @$nbAdmin; ?>";
		nbPending= "<?php echo @$nbMemberPending+@$nbAdminPending ?>";
  	}
  	if(contextType=="poi"){
		parentId = "<?php echo @$element["parentId"]; ?>";
		parentType = "<?php echo @$element["parentType"]; ?>";
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
		var elementName = "<?php echo addslashes($element["name"])?>";
		setTitle("<span id='main-title-menu'>"+elementName+"</span>",elementName, elementName);
		$("#changePasswordBtn").click(function () {
  			mylog.log("changePasswordbuttton");
  	 		loadByHash('#person.changepassword.id.'+userId+'.mode.initSV', false);
  	  	});
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
		$(".tooltips").tooltip();
		$("#nbAdmin").html(nbAdmin);
		$("#nbMember").html(nbMember);
		$("#nbPending").html(nbPending);
		$("#nbMemberTotal").html(parseInt(nbAdmin)+parseInt(nbMember));

		/*var url = "news/index/type/"+contextType+"/id/"+contextId+"?isFirst=1&";
		console.log("URL", url);
		if(contextType=="projects" || contextType=="citoyens"){
			ajaxPost('#timeline-page', baseUrl+'/'+moduleId+'/'+url+"renderPartial=true&tpl=co2&nbCol=2",
				null,
				function(){

			},"html");
		}*/
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

	        bootbox.confirm("Etes vous sur de vouloir supprimer cet élément ?",
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
				        	toastr.info("Cet élément a été effacé avec succès.");
				        	$("#"+type+id).remove();
				        	loadByHash("#"+parentType.substr(0, parentType.length - 1)+".detail.id."+parentId);
				        } else {
				           toastr.error("Une erreur est survenue : ".data.msg);
				        }
				    });
				}
			});

		});
		$(".editThisBtn").off().on("click",function (){
	        $(this).empty(t).html('<i class="fa fa-spinner fa-spin"></i>');
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
	$("#btn-menu-gallery").click(function(){
    	hideAllSections();
    	$("#section-gallery").show();
    	var url = "gallery/index/type/"+contextType+"/id/"+contextId;
		console.log("URL", url);
		ajaxPost('#section-gallery', baseUrl+'/'+moduleId+'/'+url+"?renderPartial=true",
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

		$("#btn-menu-directory-all").click(function(){
	    	hideAllSections();
	    	$("#section-directory-all").show();
				$("#Grid").show();
	    });

}


function hideAllSections(){
	$("#section-home").hide();
	$("#section-gallery").hide();
	$("#section-stream").hide().html("");
	$("#section-directory").hide();
	$("#section-directory-all").hide();
	$("#Grid").hide();
}
</script>
