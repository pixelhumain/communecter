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
padding:5px;
  background: #AAA;
  position: absolute;
  height: 50px;
  width: 100px;
}

.grid > div[data-ss-colspan="2"] { width: 210px; }
.grid > div[data-ss-colspan="3"] { width: 320px; }

.grid > .ss-placeholder-child {
  background: transparent;
  border: 1px dashed blue;
}	
.graph div.block{border:1px solid #666;text-align:center}

</style>

<div class="container graph">
    <br/>
    <div class="hero-unit">
        <?php if(isset(Yii::app()->session["userId"])){?>
		<h2><?php if(isset($user["name"]))echo $user["name"]; else echo "<a href='#participer' role='button' data-toggle='modal' title='mon compte'>Quel est votre nom ou pseudo?</a>"; ?></h2>
   		 <p> </p>
     	<div class="grid">
            <div data-ss-colspan="3">
            	<?php if(isset($user["cp"])){?>
            	<a href="<?php echo Yii::app()->createUrl('index.php/commune/cp/'.$user["cp"])?>"  > Ma Commune </a>
            	<?php } else { ?>
            		<a href="#participer" class="ml10 w60 yellow" role="button" data-toggle="modal" title="mon compte" >Se Communecter </a>( je me connecte à ma commune en donnant mon code postale)
            	<?php }?>
            </div>
            <?php /*?><div data-ss-colspan="2"><a href="#association"   target="_blank" role="button" data-toggle="modal"  > + Association </a></div>*/?>
            <div data-ss-colspan="2"><a href="<?php echo Yii::app()->createUrl('index.php/association/creer')?>"  > + Association </a></div>
            <div data-ss-colspan="3"><a href="#entreprise"   target="_blank" role="button" data-toggle="modal">+ Société</a></div>
            <div data-ss-colspan="3"><a href="#invitation"   target="_blank" role="button" data-toggle="modal">+ Invitation</a> </div>
            <div data-ss-colspan="2"><a href="#association"   target="_blank" role="button" data-toggle="modal"> Activité Citoyenne </a></div>
            <div data-ss-colspan="2"><a href="#connection"   target="_blank" role="button" data-toggle="modal">+ Connection</a></div>
            <div></div>
            <div></div>
            <div></div>
       </div>
		<?php } else {?>
		<h2><div data-ss-colspan="2"><a href="#loginForm"   target="_blank" role="button" data-toggle="modal"  > Connectez Vous  </a> Pour en voir plus</div></h2>
		<?php }?>
	</div>
</div>		

<?php if(isset(Yii::app()->session["userId"])){?>
<div class="container graph">
<div class="hero-unit">
	<div class="row-fluid">
		<?php if(isset($user["associations"])){?>
		<div class="span4 block">
			<h2>Mes Assocations</h2>
			<?php 
			
			foreach($user["associations"] as $a){
			    $entity = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($a),"type"=>PHType::TYPE_ASSOCIATION));
			    echo "<a href='".Yii::app()->createUrl('index.php/association/view/id/'.$entity["_id"])."' class='btn btn-warning'>".$entity["name"]."</a><br/>";
			}
			?>
			<br/>
		</div>
		<?php }?>
		
		<?php if(isset($user["entreprises"])){?>
		<div class=" actu span4 block">
			<h2>Liste Entreprise</h2>
			<?php 
			foreach($user["entreprises"] as $a){
			    $entity = Yii::app()->mongodb->groups->findOne(array("_id"=>new MongoId($a),"type"=>PHType::TYPE_ENTREPRISE));
			    echo "<a href='".Yii::app()->createUrl('index.php/entrepise/view/id/'.$entity["_id"])."' class='btn btn-warning'>".$entity["name"]."</a><br/>";
			}
			?>
			<br/>
		</div>
		<?php }?>
		
		<div class="span4 block">
			<h2>Liste Rezotage </h2>
			
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span8 block">
		<h2>-----------------</h2>
		
        
		</div>
		<div class="span4 block">
		<h2>-------- </h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4  block">
		<h2>---------</h2>
		</div>
		<div class="span4 block">
		<h2>-----------</h2>
		</div>
		<div class="span4 block">
		<h2>------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>-----------</h2>
		</div>
		<div class="span6 block ">
		<h2>------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span4 block">
		<h2>------------</h2>
		</div>
		
		<div class="span4 block">
		<h2>------------------</h2>
		</div>
		
		<div class="span4 block">
		<h2>----------------</h2>
		</div>
	</div>
	<br/>
	<div class="row-fluid">
		<div class="span6 block">
		<h2>---------------------</h2>
		</div>
		
		<div class="span6 block">
		<h2>---------------------</h2>
		</div>
	</div>
	
</div></div>
<?php } ?>


<script type="text/javascript"		>
initT['animInit'] = function(){

	$(".grid").shapeshift({
	    minColumns: 3
	  });
	
(function ani(){
	  TweenMax.staggerFromTo(".container h2", 4, {scaleX:0.4, scaleY:0.4}, {scaleX:1, scaleY:1},0.3);
})();

  
};
</script>