<?php 
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->request->baseUrl.'/js/api.js' , CClientScript::POS_END);
$cs->registerScriptFile('http://visjs.org/dist/vis.js' , CClientScript::POS_END);

?>
 <style type="text/css">
    #mygraph {
      width: 400px;
      height: 400px;
      border: 1px solid lightgray;
    }
  </style>
<section class="mt80 stepContainer">

    <div class="step">
      <div id="mygraph"></div>
      <div id="info"></div>

      <script type="text/javascript">
      $(document).ready(function() { 
        // create an array with nodes
        var nodes = [
          {id: 1, label: 'Node 1'},
          {id: 2, label: 'Node 2'},
          {id: 3, label: 'Node 3'},
          {id: 4, label: 'Node 4'},
          {id: 5, label: 'Node 5'}
        ];

        // create an array with edges
        var edges = [
          {from: 1, to: 2},
          {from: 1, to: 3},
          {from: 2, to: 4},
          {from: 2, to: 5}
        ];

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
        graph.on('select', function(properties) {
          document.getElementById('info').innerHTML += 'selection: ' + JSON.stringify(properties) + '<br>';
        });

        // set initial selection (id's of some nodes)
        graph.setSelection([3, 4, 5]);
      });
      </script>

    </div>
</section>