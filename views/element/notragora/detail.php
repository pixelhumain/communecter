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
							<a href="javascript:;" data-toggle="modal" data-target="#modal-delete-element" class="btn text-red"><i class="fa fa-trash" ></i> <?php echo Yii::t("common","Delete")?></a>
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
}


function hideAllSections(){
	$("#section-home").hide();
	$("#section-gallery").hide();
	$("#section-stream").hide().html("");
	$("#section-directory").hide();
}
</script>
