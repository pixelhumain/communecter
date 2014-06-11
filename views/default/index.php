<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://visjs.org/dist/vis.js' , CClientScript::POS_END);
$this->pageTitle=$this::moduleTitle;
?>
<style type="text/css">
  body {background: url("<?php echo Yii::app()->theme->baseUrl;?>/img/crowd.jpg") repeat;}
</style>
<section class="mt80 stepContainer">

    <div class="step home">
      <div class="stepTitle">5s Pour tenter une nouvelle experience : <?php echo Yii::app()->session["userId"]?></div>
      se Communecter == Se connecter à sa commune pour etre informer, partager et agir<br>
      un habitant en connecte un autre et ainsi de suite<br>
      Pour mieux comprendre la société<br>
      Sommes nous capable de l'organiser et l'améliorer <br>
      
    </div>
    
    <div class="step home">
      <div class="stepTitle">L'objectif</div>
      nous comptons déja <span id="communeCount" class="highlight"><?php echo count(Yii::app()->mongodb->citoyens->distinct( "cp" ));?></span> communes, et <span id="peopleCount" class="highlight"><?php echo count(Yii::app()->mongodb->citoyens->distinct( "email" ));?></span> communectés<br>
      1- Symboliquement, Nous aimerions atteindre 1% de la population réunionaise (env. 8000)<br>
      2- Lancer notre campagnes de méiose = chaque communecté amène un nouveau connecté par mois<br>
      3- Atteindre 2% de la pop, soit 16000 communectés.<br>
      4- Lancer la dynamique nationalement.<br>
      5- Defi : Combien de temps pour communecté la france ?<br>
    </div>

    <div class="step home">
      <div class="fr">
        <div class="communectedcp">97421</div>
        <div class="communected "><?php echo Yii::app()->mongodb->citoyens->count( array( "cp" => "97421" ));?></div>
      </div>

      <div class="stepTitle">5s pour participer</div>
      s'incrire : <input type="text" name="codepostal" id="codepostal" onblur="countpeopleby()" placeholder="code postal(ex:97421)"/> <input type="text" id="email" placeholder="email"/>
      <a href="javascript:communectme()" class="btn">Communectez moi</a> <br>
       Communiquer sans intermediare avec toute votre commune<br><br>
       <div class="fr" style="margin-right:20px;" id="communectResult">combien etes vous communecter dans votre commune?  </div>
       <div style="clear:both;"></div>
     </div>
    
    

    <div class="step invite hidden">
      <style type="text/css">
        #mygraph {
          float:right;
          width: 300px;
          height: 300px;
          border: 1px solid lightgray;
        }
      </style>
      <div id="mygraph"></div>
      <div id="info"></div>
      <div class="stepTitle">Participer c'est bien, etre plusieur, c'est mieux : Creer son reseau</div>
      Faire du buzz, 
      inviter des gens de votre commune et d'ailleurs<br>
      Connecter Quelqu'un : <input type="text" id="inviteEmail" placeholder="email"/> <a href="javascript:;" onclick="inviteUser()" class="btn">Envoyer L'invitation</a><br>
      Cette action a plus d'impact que vous n'imaginez.
      <div class="fr" style="margin-right:20px;" id="inviteResult"> </div>

      <div style="clear:both;"></div>
    </div>

    <div class="step home" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Future : boite à outils citoyens</div>
      <a href="http://pixelhumain.com" class="btn">le Pixel Humain</a><br>
      un reseau sociétal vous attends pour agir<br>
      interagir localement<br>
      organiser des actions<br>
       ... l'histoire ne fait que commencer
      <div style="clear:both;"></div>
    </div>

    <div class="step why hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Pourquoi ?</div>
      Parce qu'il est temps<br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>

    <div class="step what hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Quoi ?</div>
      De Réunir nos réfléxions individuelles au service de l'intelligence collective.<br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>

    <div class="step how hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Comment ?</div>
      Ensemble !!<br>
      se communecter , c'est se connecter a sa commune <br>
      La plus petite unité de l'état la plus proche de chacun d'entre nous<br>
      La toile est l'outil qui portera la solution<br>
      mais seul la masse que nous pouvons etre en sera l'action.<br>
      <br>
      <br>
    </div>

    <div class="step who hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Qui ?</div>
      Nous devons tous nous réunir pour essayer<br>
      C'est le minimum demandé<br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>

    <div class="step when hidden" >
      <img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bdb.png" style="width:120px;float:right;">
      <div class="stepTitle">Quand ?</div>
      De suite, si vous etes là , c'est un des endroit parmis d'autre<br>
      c'est maintement et pour le future<br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </section>

<script type="text/javascript">
function countpeopleby(){
  params = { "cp" : $("#codepostal").val() };
  testitpost("communected",'/ph/<?php echo $this::$moduleKey?>/api/getpeopleby/count/1',params, 
              function(data){ $(".communectedcp").html($("#codepostal").val());$(".communected").html(data.count)} );
}
function communectme(){
  params = { "email" : $("#email").val() , 
            "cp" : $("#codepostal").val()
          };
  testitpost("communectResult",'/ph/<?php echo $this::$moduleKey?>/api/communect',params,
            function(data){
              if(!data.isNewUser)
              {
                $("#communectResult").html( "Vous étiez deja connecté a votre commune" );
              }
              else
              {
                $("#communectResult").html( "Bienvenue, vous etes communecté à présent." );
                nodecount++;
                nodes.push({id: nodecount, label: $("#codepostal").val()});
                nodecount++;
                nodes.push({id: nodecount, label: 'Vous'});
                edges.push({from: 1, to: 2});
              }
              $(".invite").slideDown();
              
              drawGraph();
            });
  countpeopleby();
}
function inviteUser(){
  params = { "email" : $("#inviteEmail").val() };
  testitpost("inviteResult",'/ph/<?php echo $this::$moduleKey?>/api/inviteUser',params,
            function(data){
              email = $("#inviteEmail").val();
              name = email.substr(0,email.indexOf("@"));
              nodecount++;
              nodes.push({id: nodecount, label: name});
              
              txt = "";
              if(data.invitedButNotLinked == "noUserLogguedin")
                txt = "But no one is loggued in, so no link is possible.";
              else if(data.link2Users_Call!=null && data.link2Users_Call.result)
              {
                edges.push({from: 2, to: nodecount});
                txt = "The user was connected to your account";
              }
              if(data.userAdded)
                txt = "The User was created. "+txt;
              else if(data.userAllreadyExists)
                txt = "The User allready exists. "+txt;
              $("#inviteResult").html( txt+JSON.stringify(data, null, 4) );
              drawGraph();
            });
}
function hideShow(ids){
  $(".step").slideUp();
  $(ids).slideDown();
}
var nodecount = 0;
var nodes = [];
var edges = [];
function drawGraph(){
        // create a graph
        var container = document.getElementById('mygraph');
        var data = {
          nodes: nodes,
          edges: edges
        };
        var options = {
          nodes: {
            shape: 'box'
          }
        };
        graph = new vis.Graph(container, data, options);

        // add event listener
        /*graph.on('select', function(properties) {
          document.getElementById('info').innerHTML += 'selection: ' + JSON.stringify(properties) + '<br>';
        });*/

        // set initial selection (id's of some nodes)
        graph.setSelection([3, 4, 5]);
}

</script>