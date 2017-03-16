<!-- <div class="space20"></div> -->

<div class="<?php echo (@$class) ? $class : 'row' ?> hidden margin-5 qrCodeContainerCl center" id="qrCodeContainer"> 
	<h1 class="homestead text-red">Cartes de visites connectée</h1>
	<div class="space20"></div>
	<div class="pull-left" style="border:1px dashed #666; width:400px;min-height:160px;padding:5px;margin:5px;">
		<?php if(false && @$img){ ?>
		<img class="pull-left" width="150" src="<?php echo $img ?>">
		<?php } ?>
		<div  class="pull-left qrCode"> </div>
			
		<ul class="pull-left" style="list-style: none;margin-top:10px;">
			<?php echo (@$type && @OpenData::$elementTypes[$type]) ? 
				"<li class='btn btn-sm'>".OpenData::$elementTypes[$type]."</li>" : '' ?>
			<?php echo (@$name) ? "<li>".$name."</li>" : '' ?>
			<?php echo (@$address) ? "<li>".$address."</li>" : '' ?>
			<?php echo (@$address2) ? "<li>".$address2."</li>" : '' ?>
			<?php echo (@$email) ? "<li>".$email."</li>" : '' ?>
			<?php echo (@$url) ? "<li>".$url."</li>" : '' ?>
			<?php echo (@$tel) ? "<li>".$tel."</li>" : '' ?>m
		</ul>
		
	</div>
	<div class="space20"></div>
	<span class="text-red"><i class="fa fa-warning "></i> Ce QR Code ne marche qu'avec l'application <a href="https://play.google.com/store/apps/details?id=org.communevent.meteor.pixelhumain&ah=lVN3mXqHKQjIOg3qHn0YzhiUebc&hl=fr" target="_blank">communEvent</a></span>
	<br/>
	<a class="explainLink btn btn-default btn-sm" data-id="qrCodeExplain" href="">En savoir plus <i class="fa fa-question-circle"></i></a>

</div>