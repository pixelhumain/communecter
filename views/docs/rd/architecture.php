
<div class="panel-heading border-light center text-dark partition-white radius-10">
    <span class="panel-title text-red homestead"> <span style="font-size: 48px; "> Architecture</span></span>
</div>

<style type="text/css">
    ul li{list-style: none;}
</style>
<div class="col-sm-12 ">

    <div class="">
        
        <div class="panel-body">
           <div class="col-xs-12">
	        	<a class="thumb-info" href="<?php echo $this->module->assetsUrl; ?>/images/docs/MVC.png" data-title="Architecture Globale et repositories"  data-lightbox="all">
					<img src="<?php echo $this->module->assetsUrl; ?>/images/docs/MVC.png" class="col-md-6 col-xs-12 img-responsive ">
		        </a>
		        <a class="thumb-info" href="<?php echo $this->module->assetsUrl; ?>/images/docs/archi.png" data-title="Structure des pages Communecter"  data-lightbox="all">
					<img src="<?php echo $this->module->assetsUrl; ?>/images/docs/archi.png" class="col-md-6 col-xs-12 img-responsive ">
		        </a>
	        </div>
			<div class="col-sm-12" style="margin-top: 20px">	
				<div class="col-sm-12">
					<h2 class="text-red homestead">Communecter Stack </h2>
					<ul>
						<li><i class="fa fa-angle-right"></i> <a href="https://github.com/pixelhumain/communecter" target="_blank">sur GIT</a> </li>
						<li><i class="fa fa-angle-right"></i> Classic Model View Controller Architecture</li>
						<li><i class="fa fa-angle-right"></i> PHP5</li>
						<li><i class="fa fa-angle-right"></i> mongoDB</li>
						<li><i class="fa fa-angle-right"></i> A lot of Javascript</li>
						<li><i class="fa fa-angle-right"></i> JQuery</li>
						<li><i class="fa fa-angle-right"></i> Bootstrap</li>
						<li><i class="fa fa-angle-right"></i> Font Awesome</li>
						<li><i class="fa fa-angle-right"></i> API REST every where</li>
					</ul>
				</div>

				<div class="col-sm-12">
					<h2 class="text-red homestead">CommunEvent Stack</h2>
					<ul>
						<li><i class="fa fa-angle-right"></i> <a href="https://github.com/pixelhumain/communEvent" target="_blank">sur GIT</a></li>
						<li><i class="fa fa-angle-right"></i> Meteor (NodeJS) </li>
						<li><i class="fa fa-angle-right"></i> MongoDB </li>
						<li><i class="fa fa-angle-right"></i> API Communecter</li>
						<li><i class="fa fa-angle-right"></i> Cordova Android</li>
						<li><i class="fa fa-angle-right"></i> iOS </li>
					</ul>
				</div>
			</div>

			<?php if(!isset($renderPartial) || $renderPartial != true){ ?>
			<div class="col-sm-12">
            	<a href="javascript:window.history.back();" class="text-extra-large  bg-dark tooltips pull-left radius-5 padding-10 homestead" style="display: block;" ><i class="fa fa-arrow-left"></i> Retour  </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

