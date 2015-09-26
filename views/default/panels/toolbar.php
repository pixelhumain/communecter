<a href="#" onclick="gotToPrevNav()" class="pull-left"><i class="fa fa-arrow-circle-left fa-2x"> </i></a>
<?php /* <div class="pull-left center text-bold text-extra-large box-ajaxTitle" style="width:90%">TIT TIT TITIT ITI TIT IT TI TI </div>  */?>
<div class="pull-right center box-ajaxTools" style="width:90%">
	<?php 
		if(isset($this->toolbarMBZ)){
			foreach ($this->toolbarMBZ as $value) {
				if( stripos( $value, "</li>" ) != "")
					echo $value;
				else
					echo $value;
			}
		} ?>
</div>
<a href="#" onclick="$('.box-ajax').hide()" class="pull-right text-red btn-close-panel"><i class="fa fa-times "> </i></a>
<div class="space20"></div>