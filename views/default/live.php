<style type="text/css">
	.border-dark{
		border:1px solid #ccc;
	}
</style>

<div class="col-sm-12 col-xs-12 col-md-6">
	
	<h1 class="col-sm-12">Live Stream <?php echo @$type?></h1>

	<?php foreach ($stream as $key => $v) { ?>
	<div class="col-md-12 col-sm-12 col-xs-12 margin-bottom-30 border-dark padding-5">
		<div class=" border-bottom">
			<?php echo date("d/m/Y",@$v["updated"])?> - <?php echo Element::getLink(@$v["organizerType"],@$v["organizerId"])?>  > <?php echo Element::getLink(@$v["parentType"],@$v["parentId"])?>
	    </div>
	    <div class=" border-bottom padding-bottom-10">
	    	<img src="http://placehold.it/450x200" class="img-responsive">
			<div class="text-bold text-extra-large">
				<i class="fa fa-<?php echo Element::getFaIcon(@$v["type"])?>"></i>			
				<?php echo Element::getLink(@$v["type"],(string)@$v["_id"])?>
			</div>
			<?php echo @$v["message"]?>
	    </div>
	    <div class=" padding-5">
	    	<div class="pull-left">
				<i class="fa fa-thumbs-up"></i> 540 
				<i class="fa fa-comment"></i> 54 
			</div>
			<div class="pull-right">
				<i class="fa fa-hand-grab-o"></i> 
				<i class="fa fa-share-alt"></i>
			</div>
	    </div>
	</div>
	<?php } ?>
	
</div>


<div class="col-sm-12 col-xs-12 col-md-6 ">
	<h1 class="col-sm-12">En ce moment</h1>
	<div class="col-sm-12 col-xs-12 col-md-6 ">
    	
    	<div class="border-dark margin-bottom-30">
			
		    <div class=" ">
				<img src="http://placehold.it/250x100" class="img-responsive">
		    </div>
		    <div class="padding-5 ">
				27/07/50 - Luke Rony 
				<br/><div class="text-right">Hacking Debout</div>
		    </div>
		</div>

		<div class="border-dark margin-bottom-30">
			
		    <div class=" ">
				<img src="http://placehold.it/250x100" class="img-responsive">
		    </div>
		    <div class="padding-5 ">
				27/07/50 - Luke Rony 
				<br/><div class="text-right">Hacking Debout</div>
		    </div>
		</div>

		<div class="border-dark margin-bottom-30">
			
		    <div class=" ">
				<img src="http://placehold.it/250x100" class="img-responsive">
		    </div>
		    <div class="padding-5 ">
				27/07/50 - Luke Rony 
				<br/><div class="text-right">Hacking Debout</div>
		    </div>
		</div>
	</div>




	<div class="col-sm-12 col-xs-12 col-md-6 ">
    	<div class="border-dark margin-bottom-30">
			
		    <div class=" ">
				<img src="http://placehold.it/250x100" class="img-responsive">
		    </div>
		    <div class="padding-5 ">
				27/07/50 - Luke Rony 
				<br/><div class="text-right">Hacking Debout</div>
		    </div>
		</div>

		<div class="border-dark margin-bottom-30">
			
		    <div class=" ">
				<img src="http://placehold.it/250x100" class="img-responsive">
		    </div>
		    <div class="padding-5  ">
				27/07/50 - Luke Rony 
				<br/><div class="text-right">Hacking Debout</div>
		    </div>
		</div>

		<div class="border-dark margin-bottom-30">
			
		    <div class=" ">
				<img src="http://placehold.it/250x100" class="img-responsive">
		    </div>
		    <div class="padding-5 ">
				27/07/50 - Luke Rony 
				<br/><div class="text-right">Hacking Debout</div>
		    </div>
		</div>
	</div>


</div>


<!-- end: PAGE CONTENT-->
<script>
jQuery(document).ready(function() {
	setTitle("Live'n'Direct","<i class='fa fa-heartbeat '></i>");
});
	
</script>