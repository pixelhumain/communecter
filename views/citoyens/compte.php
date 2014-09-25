<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile('http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.touch-punch.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->request->baseUrl. '/js/jquery.shapeshift.min.js' , CClientScript::POS_END);
?>
<style>
h2 {
    font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
  
}
.grid a{
display:block;
font-family: "Homestead";
  position:relative;
  top:0px;
  left:0px;
  color: #324553;
}
.grid {
      border: 1px dashed #CCC;
      position: relative;
    }

    .grid > div {
      background: #AAA;
      position: absolute;
      height: 100px;
      width: 100px;
    }

    .grid > div[data-ss-colspan="2"] { width: 210px; }
    .grid > div[data-ss-colspan="3"] { width: 320px; }

    .grid > .ss-placeholder-child {
      background: transparent;
      border: 1px dashed blue;
    }      
</style>
<div class="container graph">
    <br/>
    <div class="hero-unit">
    
    <h2>MON COMPTE</h2>
    <p>Gérer vos données personnelles, connectez vos association et entreprise<br/>
    déclarer un evennement </p>
    
   
    <div class="grid">
        <div></div>
        <div></div>
        <div data-ss-colspan="2"><a href="#participer"   target="_blank" role="button" data-toggle="modal">Mes données personnelles</a></div>
        <div data-ss-colspan="2"><a href="#association"   target="_blank" role="button" data-toggle="modal">Ma vie associative</a></div>
        <div data-ss-colspan="3"><a href="#entreprise"   target="_blank" role="button" data-toggle="modal">Entreprise</a></div>
        <div data-ss-colspan="3"></div>
        <div>Test</div>
        <div data-ss-colspan="2"><a href="#participer"   target="_blank" role="button" data-toggle="modal">Covoiturage</a></div>
        <div data-ss-colspan="2"><a href="#association"   target="_blank" role="button" data-toggle="modal">Petites Annonces</a></div>
        <div data-ss-colspan="3"><a href="#entreprise"   target="_blank" role="button" data-toggle="modal">Entreprise</a></div>
        <div data-ss-colspan="3"></div>
        <div>Test</div>
        <div data-ss-colspan="2"><a href="#participer"   target="_blank" role="button" data-toggle="modal">Mes données personnelles</a></div>
        <div data-ss-colspan="2"><a href="#association"   target="_blank" role="button" data-toggle="modal">Ma vie associative</a></div>
        <div data-ss-colspan="3"><a href="#entreprise"   target="_blank" role="button" data-toggle="modal">Entreprise</a></div>
        <div data-ss-colspan="3"></div>
      </div>
</div></div>
<script type="text/javascript"        >
initT['animInit'] = function(){
(function ani(){
      TweenMax.staggerFromTo(".grid a", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:0.8, scaleY:0.8},1);
})();

$(".grid").shapeshift({
    minColumns: 3
  });

};
</script>