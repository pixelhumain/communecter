<style>
ol.slats li {
	margin: 0 0 10px 0;
	padding: 0 0 10px 0;
	border-bottom: 1px solid #eee;
	}
ol.slats li:last-child {
	margin: 0;
	padding: 0;
	border-bottom: none;
	}
ol.slats li h3 {
	font-size: 18px;
	font-weight: bold;
	line-height: 1.1;
	}
ol.slats li h3 a img {
	float: left;
	margin: 0 10px 0 0;
	padding: 4px;
	border: 1px solid #eee;
	}
ol.slats li h3 a:hover img {
	background: #eee;
	}
ol.slats li p {
	margin: 0 0 0 76px;
	font-size: 14px;
	line-height: 1.4;
	}
ol.slats li p span.meta {
	display: block;
	font-size: 12px;
	color: #999;
	}		
	h2 {
	font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}	
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
        <h2>Open Data Locale : Les sources de données libres</h2>
        <p>Toute les données qui permettent de faire tourner le PH sont ouverte est disponible a l'utilisation publique.<br/>
        Mais surtout elles sont crowd sourcer (rempli par les citoyens)
        </p>
        
        <ol class="slats">
        	<li class="group"><h3><a href="<?php echo Yii::app()->createUrl('/index.php/opendata/commune/ci/97411')?>">Structure Standard Json, de l'organisation d'une commune (ex:97411)</a></h3></li>
        	<li class="group"><h3>Structure Standard Json, de l'organisation d'une agglomeration / intercommune (ex:CINOR)</h3></li>
        	<li class="group"><h3>Structure Standard Json, de l'organisation d'une région (ex:974)</h3></li>
        	<li class="group"><h3>Structure Standard Json, de l'organisation d'un département (ex:974)</h3></li>
        	<li class="group"><h3>Json des pixels actifs par Code Postal</h3></li>
        	<li class="group"><h3>Json des pixels actifs par Métier</h3></li>
        	<li class="group"><h3>Json des pixels actifs par Centre D'interet</h3></li>
        	<li class="group"><h3><a href="<?php echo Yii::app()->createUrl('/index.php/opendata/microformats')?>">Référence des collections et documents de la base MongoDB PH</a></h3></li>
        </ol>	
    
	</div>
</div>	
	
<script type="text/javascript">
initT['animInit'] = function(){
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},1);
})();
};
</script>