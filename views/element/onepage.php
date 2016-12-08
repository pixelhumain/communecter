
<?php 
	HtmlHelper::registerCssAndScriptsFiles( array('/css/onepage.css') , Yii::app()->theme->baseUrl. '/assets');

	$imgDefault = $this->module->assetsUrl.'/images/news/profile_default_l.png';
	
	//récupération du type de l'element
    $typeItem = (@$element["typeSig"] && $element["typeSig"] != "") ? $element["typeSig"] : "";
    if($typeItem == "") $typeItem = @$element["type"] ? $element["type"] : "item";
    if($typeItem == "people") $typeItem = "citoyens";

    //icon et couleur de l'element
    $icon = Element::getFaIcon($typeItem) ? Element::getFaIcon($typeItem) : "";
    $iconColor = Element::getColorIcon($typeItem) ? Element::getColorIcon($typeItem) : "";
?>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <?php //var_dump($element["address"]); ?>

                    <div class="col-md-12 col-sm-12">
	                    <div class="col-md-3 col-sm-4 hidden-xs text-right btn-tools">
	                    	<?php if(@$edit == true){ ?>
	                    	<button class="btn btn-default">Editer les informations <i class="fa fa-pencil"></i></button><br>
	                    	<button class="btn btn-default"> Paramétrer la page <i class="fa fa-cog"></i></button>
		                    <?php } ?>
	                    </div>
	                    <div class="col-md-6 col-sm-4 col-xs-12 text-center" style="margin-top:-20px;">

	                    	<?php if(@$typeItem){ ?>
	                    		<span class="col-md-12 col-sm-12 name bold">
	                    			<?php echo ucfirst(Yii::t("common", @$typeItem)); 
	                    				  if (@$element["typeSig"]=="organizations") 
	                    				  	echo " - ".Yii::t("common", $element["type"]); ?>
	                    		</span><br>
	                    	<?php } ?>

	                    	<?php if(@$element['profilMediumImageUrl'] && @$element['profilMediumImageUrl'] != "") { ?>
	                        
	                        	<img class="img-responsive thumbnail thumb-type-color-<?php echo $iconColor; ?>" 
	                    		 src="<?php echo @$element['profilMediumImageUrl'] ? Yii::app()->createUrl('/'.@$element['profilMediumImageUrl']) : $imgDefault; ?>" 
	                    		 alt="">

		                    	<?php if($icon != "" && $iconColor != ""){ ?>
			                    <div class="col-md-12 col-sm-12 no-padding text-center i-item">
			                        <i class="fa fa-<?php echo $icon; ?> i-type-color-<?php echo $iconColor; ?>"></i>
			                    </div>
			                    <?php } ?>

		                    <?php } ?>
	                    </div>
	                    <div class="col-md-3 col-sm-4 col-xs-12 text-left btn-tools pull-right">
	                    	
	                    	<button class="btn btn-default"><i class="fa fa-link"></i> <span class="hidden-xs">Suivre cette page</span></button><br>
	                    	<?php if($type == Organization::COLLECTION ){ ?>
	                    	<button class="btn btn-default"><i class="fa fa-plus-circle"></i> <span class="hidden-xs">Devenir membre</span></button><br>
	                    	<?php } ?>

	                    	<?php if($type == Project::COLLECTION ){ ?>
	                    	<button class="btn btn-default"><i class="fa fa-plus-circle"></i> <span class="hidden-xs">Devenir contributeur</span></button><br>
	                    	<?php } ?>

	                    	<?php if($type == Event::COLLECTION ){ ?>
	                    	<button class="btn btn-default"><i class="fa fa-plus-circle"></i> <span class="hidden-xs">Je participe</span></button><br>
	                    	<?php } ?>

	                    	<button class="btn btn-default"><i class="fa fa-star"></i> <span class="hidden-xs">Favoris</span></button>
	                    </div>
	                    <div class="col-md-12 col-sm-12 intro-text">
	                        <span class="name"><?php echo @$element["name"]; ?></span>
	                        <span class="email"><?php echo @$element["email"]; ?></span>
	                        <hr class="bold-hr">
	                        <span class="skills"><?php echo @$element["shortDescription"]; ?></span>
	                    </div>
	                    
                    </div>

                    <div class="col-md-12 col-sm-12">		                
	                    <div class="tags">
	                    	<?php if(@$element["tags"])
	                    			foreach ($element["tags"]  as $key => $tag) { ?>
	                    		<span class="badge bg-red"><?php echo $tag; ?></span>
	                    	<?php } ?>
	                    </div>
	                    <div class="commune text-red homestead margin-top-10">
	                		<?php if(@$element["address"] && @$element["address"]["addressLocality"]) {
	                				echo "<i class='fa fa-university'></i> ".$element["address"]["addressLocality"];
	                				if(@$element["address"]["postalCode"]) echo ", ";
	                			  }
	                			  if(@$element["address"] && @$element["address"]["postalCode"]) 
	                			  	echo $element["address"]["postalCode"];
	                		?>
	                    </div>
	                </div>

                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <?php if(isset($element["description"])){ ?>
    <section class="darkblue padding-bottom-50 shadow hidden" id="description">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Description</h2>
                    <hr class="bold-hr">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-description">
                    <p><?php echo $element["description"]; ?></p>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

    <!-- COMMUNAUTE Section -->

    <?php   
    		$desc = array( array("shortDescription"=>@$element["description"]),
    					);

    		if(@$desc && sizeOf(@$desc)>0)
    		$this->renderPartial('../pod/sectionElements', 
    								array(  "items" => $desc,
											"sectionKey" => "description",
											"sectionTitle" => "DESCRIPTION",
											"sectionShadow" => true,
											"msgNoItem" => "Aucune description",
											"imgShape" => "square",
											"useImg" => false,
											"fullWidth" => true, //only for 1 element

											"styleParams" => array(	"bgColor"=>"#FFF",
															  		"textBright"=>"dark",
															  		"fontScale"=>3),
											));
    ?>

    <!-- COMMUNAUTE Section -->

    <?php   if(@$members && sizeOf(@$members)>0)
    		$this->renderPartial('../pod/sectionElements', 
    								array(  "items" => $members,
											"sectionKey" => "directory",
											"sectionTitle" => "COMMUNAUTÉ",
											"sectionShadow" => true,
											"msgNoItem" => "Aucun contact à afficher",
											"imgShape" => "square",
											"useDesc" => false,

											"styleParams" => array(	"bgColor"=>"#94D4DA",
															  		"textBright"=>"dark",
															  		"fontScale"=>3),
											));
    ?>

    <!-- EVENTS Section -->

    <?php   if(@$events && sizeOf(@$events)>0)
    		$this->renderPartial('../pod/sectionElements', 
    								array(  "items" => $events,
											"sectionKey" => "events",
											"sectionTitle" => "ÉVÉNEMENTS À VENIR",
											"sectionShadow" => false,
											"msgNoItem" => "Aucun événement à afficher",
											"imgShape" => "square",
											"useDesc" => true,

											"styleParams" => array(	"bgColor"=>"#60BCC5",
															  		"textBright"=>"dark",
															  		"fontScale"=>3),
											));
    ?>

    <!-- PROJETS Section -->

    <?php   if(@$projects && sizeOf(@$projects)>0)
    		$this->renderPartial('../pod/sectionElements', 
    								array(  "items" => $projects,
											"sectionKey" => "projects",
											"sectionTitle" => "NOS PROJETS",
											"sectionShadow" => true,
											"msgNoItem" => "Aucun projet à afficher",
											"imgShape" => "square",
											"useDesc" => false,

											"styleParams" => array(	"bgColor"=>"#222E2F",
															  		"textBright"=>"light",
															  		"fontScale"=>3),
											));
	?>

	<!-- PROJETS Section -->

    <?php  
    	$items = array( array("name"=>"Lorem enim", "shortDescription"=>"Ut enim ad minima oemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet veniam, quis nostrum exercitationem"),
    						array("name"=>"Utiliser les POI ?", "shortDescription"=>"Pour construire les block libres ?<br>Textes<br>Images<br>Video<br>GeoPos<br>Url<br>etc"),
    						array("name"=>"Lorem ratione", "shortDescription"=>"Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet"),
    					);

    		$this->renderPartial('../pod/sectionElements', 
    								array(  "items" => $items,
											"sectionKey" => "freep",
											"sectionTitle" => "Un paragraphe libre",
											"sectionShadow" => false,
											"msgNoItem" => "Aucun projet à afficher",
											"imgShape" => "circle",
											"useImg" => false,

											"styleParams" => array(	"bgColor"=>"#222E2F",
															  		"textBright"=>"light",
															  		"fontScale"=>3),
											));
	/*  
		$items2 = array( array("name"=>"Lorem enim", "shortDescription"=>"Ut enim ad minima oemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet veniam, quis nostrum exercitationem"),
    							);
			$items = array_merge($items, $items2);
    		$this->renderPartial('../pod/sectionElements', 
    								array(  "items" => $items,
											"sectionTitle" => "",
											"sectionShadow" => false,
											"msgNoItem" => "Aucun projet à afficher",
											"imgShape" => "circle",
											"useImg" => false,
											));
		*/
	?>

	<?php if (($type==Project::COLLECTION) && !empty($element["properties"]["chart"])){ ?>
	<section id="projects-values" class="portfolio shadow">
		<div class="container">
			<div class="row">
	            <div class="col-lg-12 text-center">
	                <h2>Les valeurs du projet<br><i class="fa fa-angle-down"></i></h2>
	            </div>
	        </div>
            <div class="row">
        		<div class="no-padding col-md-8 col-md-offset-2">
					<?php

						if(empty($element["properties"]["chart"])) $element["properties"]["chart"] = array();
						$this->renderPartial('../project/pod/projectChart',array(
												"itemId" => (string)$element["_id"], 
												"itemName" => $element["name"], 
												"properties" => $element["properties"]["chart"],
												"admin" =>$edit,
												"isDetailView" => 1,
												"openEdition" => $openEdition,
												"chartAlone" => true));
					?>						  
				</div>
			</div>
		</div>
	</section>
	<?php } ?>

    

    <!-- Contact Section -->
    <section id="contact" class="hidden">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Me</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above bg-section-dark2">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Nous trouver</h3>
                        <p>
                        	<?php if(@$element["address"] && @$element["address"]["streetAddress"]) 
	                			  	echo $element["address"]["streetAddress"]."<br>";

	                			  if(@$element["address"] && @$element["address"]["addressLocality"]) {
	                				echo "<i class='fa fa-map-marker'></i> ".$element["address"]["addressLocality"];
	                				if(@$element["address"]["postalCode"]) echo ", ";
	                			  }
	                			  if(@$element["address"] && @$element["address"]["postalCode"]) 
	                			  	echo $element["address"]["postalCode"];

	                			  if(@$element["address"] && @$element["address"]["addressCountry"]) 
	                			  	echo "<br>".$element["address"]["addressCountry"];

	                			  if(!@$element["address"]){ echo "Addresse non renseignée"; }
	                		?>
                        </p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Contacts</h3>
                        <ul class="list-inline">
                        	<?php if(@$element["socialNetwork"]){ ?>
	                            <?php if(@$element["socialNetwork"]["facebook"] && @$element["socialNetwork"]["facebook"] != ""){ ?>
		                            <li>
		                                <a href="<?php echo @$element["socialNetwork"]["facebook"]; ?>" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
		                            </li>
		                        <?php } ?>
	                            <?php if(@$element["socialNetwork"]["googleplus"] && @$element["socialNetwork"]["googleplus"] != ""){ ?>
	                            <li>
	                                <a href="<?php echo @$element["socialNetwork"]["googleplus"]; ?>" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
	                            </li>
		                        <?php } ?>
	                            <?php if(@$element["socialNetwork"]["twitter"] && @$element["socialNetwork"]["twitter"] != ""){ ?>
	                            <li>
	                                <a href="<?php echo @$element["socialNetwork"]["twitter"]; ?>" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
	                            </li>
		                        <?php } ?>
	                            <?php if(@$element["socialNetwork"]["github"] && @$element["socialNetwork"]["github"] != ""){ ?>
	                            <li>
	                                <a href="<?php echo @$element["socialNetwork"]["github"]; ?>" class="btn-social btn-outline"><i class="fa fa-fw fa-github"></i></a>
	                            </li>
		                        <?php } ?>
	                        <?php } ?>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>A propos</h3>
                        <p><?php echo @$element["shortDescription"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
	                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/kgougle_social.png" height=50><br><br>
	                    <span class="font-blackoutT text-yellow-PH" style="font-size:20px;">by</span> 
	                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/img/LOGO_PIXEL_HUMAIN.png" height=70>
	                </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/cabin.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/cake.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/circus.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/game.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/safe.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Project Title</h2>
                            <hr class="star-primary">
                            <img src="img/portfolio/submarine.png" class="img-responsive img-centered" alt="">
                            <p>Use this area of the page to describe your project. The icon above is part of a free icon set by <a href="https://sellfy.com/p/8Q9P/jV3VZ/">Flat Icons</a>. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!</p>
                            <ul class="list-inline item-details">
                                <li>Client:
                                    <strong><a href="http://startbootstrap.com">Start Bootstrap</a>
                                    </strong>
                                </li>
                                <li>Date:
                                    <strong><a href="http://startbootstrap.com">April 2014</a>
                                    </strong>
                                </li>
                                <li>Service:
                                    <strong><a href="http://startbootstrap.com">Web Development</a>
                                    </strong>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php 
    	$mapData = array();
    	$mapData = array_merge($members, $mapData);
    	$mapData = array_merge($projects, $mapData);
    	$mapData = array_merge($events, $mapData);
    ?>

    <script>
    
    var elementName = "<?php echo @$element["name"]; ?>";
    var mapData = <?php echo json_encode(@$mapData) ?>;

	jQuery(document).ready(function() {
		$("#main-page-name, title").html(elementName);

		Sig.showMapElements(Sig.map, mapData);
	});
    	
    </script>