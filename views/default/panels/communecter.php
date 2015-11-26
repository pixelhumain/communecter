<div class="box-communecter box">
	
	<section>
		<?php /* ?>
		<br/><u><a href="#" class="text-white" onclick="showVideo('133636468')">En image <i class="fa fa-2x fa-youtube-play"></i></a> </u>
		php*/?>
		<style type="text/css">
		#communectMe{
			line-height: 35px;
			height : 60px;
			opacity : 0.6;
			border:none;
			width: 450px;
			font-weight: bold;
			font-size: 1.5em;
			border-radius: 10px;
			border-bottom : 1px solid #666;
		}
		</style>
		
		<div class="partition-white padding-20 radius-10">
			<br/><input type="text" class="center" name="communectMe" id="communectMe" placeholder="Your city or postal code"/>
			<div class="space20"></div>
			<span class="homestead text-red" >Communect</span> is part of <a href="#" class="text-red">the commons</a>
			<br/> Get together to build 
			<br/> <a href="#" class="text-red">smart, democratic and connected territories</a>
			<br/> Organize, develop and innovate 
			<br/> Localy, socialy and massively.

			<?php if( false && !isset( Yii::app()->session['userId']) ){?>
			<div class="space10"></div>
			<div class="row radius-10 padding-20" style="background-color: black">
				<iframe class=" col-sm-6" src="https://player.vimeo.com/video/133636468" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				<iframe class="col-sm-6" src="https://player.vimeo.com/video/74212373" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
			</div>
			<?php } ?>

			<div class="space20"></div>
			<div class="col-sm-6">
				Connected Cities
				<br/>
				<a href="javascript:;" onclick="loadByHash('#city.detail.insee.97408')" class="text-red btn btn-xs btn-default">La Possession</a> 
				<a href="javascript:;" onclick="loadByHash('#city.detail.insee.97414')" class="text-red btn btn-xs btn-default">St Louis</a> 
				<a href="javascript:;" onclick="loadByHash('#city.detail.insee.97411')" class="text-red btn btn-xs btn-default">Camélias</a> 
			</div>
			<div class="col-sm-6">
				Connected People
				<br/>
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Tango</a> 
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Maroual</a> 
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Mr Green</a> 
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Oceatoon</a> 
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Jeronimo</a> 
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Dori</a>
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Rap pha</a>
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Xabi</a>
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Pierrot</a>
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Pif</a>     
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Chlorofib</a>    
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">JR</a>   
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Costa</a>   
				<a href="javascript:;" onclick="loadByHash('#person.detail.id.97411')" class="text-red btn btn-xs btn-default">Ontologist</a>   
			</div>
		</div>
		
	</section>
	<div class="space20"></div>
	<hl/>
	<a href="#"  onclick="startIntro()" class="homestead nextBtns pull-left"><i class="fa fa-arrow-circle-o-left"></i> GUIDED TOUR  </a>
	<a href="#" onclick="showPanel('box-why','bggreen')" class="homestead nextBtns pull-right">WHY <i class="fa fa-arrow-circle-o-right"></i> </a>
</div>

<script type="text/javascript">

	jQuery(document).ready(function()
	{
		
	});
	
</script>