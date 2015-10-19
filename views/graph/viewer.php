<?php

$themeAssetsUrl = Yii::app()->theme->baseUrl.'../../ph-dori';

$cssAnsScriptFilesTheme = array(
  '/assets/plugins/fluidlog/js/d3.v3.min.js',
  '/assets/plugins/fluidlog/js/mygraph.js',
  '/assets/plugins/fluidlog/js/mynodes.js',
  '/assets/plugins/fluidlog/js/mylinks.js',
  '/assets/plugins/fluidlog/js/mybackground.js',
  '/assets/plugins/fluidlog/js/semantic2.1.2.js',
  '/assets/plugins/fluidlog/css/loglink4.6.css',
  '/assets/plugins/fluidlog/css/semantic2.1.2.css',
);

HtmlHelper::registerCssAndScriptsFiles($cssAnsScriptFilesTheme, $themeAssetsUrl);

?>

<script>
var viewerMap = <?php if(isset($viewerMap)) echo json_encode($viewerMap); ?>;
</script>

<style>

#chart{
  width: 100%;
}

	.fObjectCircle{
	border: 0px;
	margin: 0px auto;
	padding: 0;
	background-color: white;
	z-index: 4;

	}
	.fObjectCircle_circle{
	border: 0px;
	margin: 0px auto;
	padding: 0;
	background-color: white;
	z-index: 5;

	}
	.intocircle{
	border: 0px;
	color : steelblue;
	text-align: center;
	display:table;
	height : 100%;
	width : 100%;
	}
	.middlespan{
	display:table-cell;
	vertical-align:middle;
	}

	/*.circle_type {
	    cursor: pointer;
	    fill: #eee;
	    pointer-events: none;
	    stroke: #ddd;
	    stroke-width: 3px;
	}*/

	.pop-div .popover-content {
	    max-width: 310px;
	    height: 250px;
	    overflow-y:scroll;
	}

	.panel_legend{
		position: absolute;
		top:10px;
		left:15px;
		background: none repeat scroll 0 0 #5f8295;
		width: 150px;
		border: 2px solid #5f8295;
		color : white;
		text-align: center;
	}
	p.item_panel_legend {
	  margin-bottom: 3px;
	}

	.item_panel_legend {
	  padding-bottom: 3px;
	  padding-left: 15px;
	  padding-top: 3px;
	  text-align: left !important;
	}

	p {
		font-family: "Lato",arial,sans-serif;
  		line-height: 1.3em;
	  	text-align: center !important;
	}

	.rectLegend{
		width: 20px;
		height: 10px
	}

	.text_id{
		text-anchor: middle;
	}
</style>

<!-- <div id="ajaxSV">
</div> -->
  <div id="chart">
	   <div class="center text-extra-large text-bold padding-20"  id="titre"></div>
  </div>


<div class="panel_legend" style="max-width: 250px;">
	<p name"].'"="" id="item_panel_legend_'.$tag[" class="item_panel_legend">
		<span>
		</span></p><center><i>Legends
		</i><center>

	<p></p>
</center></center></div>

<script>
var d3data = [];

jQuery(document).ready(function() {

  $(window).resize(function() {

    clearTimeout(timer);
    timer = setTimeout(function() {
      force.stop();
      // $("#svgNodes").empty();
      $("#chart").empty();
      initViewer();
    }, 200);
  });

  //Graph
  var datafile = getDataFile(viewerMap);

  if (datafile != null) {
    d3data = createFluidGraph(type, contextId, datafile)
    // var myGraph = new FluidGraph("#ajaxSV #chart", d3data)
    var myGraph = new FluidGraph("#chart", d3data)

    myGraph.initSgvContainer("bgElement");
    myGraph.config.force = "On";
    myGraph.config.elastic = "Off";
    myGraph.config.displayExternGraph = true;
    myGraph.config.linkDistance = 300;
    myGraph.config.charge = -500;
    myGraph.activateForce();
    myGraph.customNodes.displayId = true;
    myGraph.customNodes.listType = ["projects", "person", "organizations", "events", "citoyens"];
    myGraph.customNodes.colorType = {
                  "projects" : "#89A5E5",
                  "person" : "#F285B9",
                  "organizations" : "#FFD98D",
                  "events" : "#CDF989",
                  "citoyens" : "#999",
                  "xxx" : "gray"};

    myGraph.customNodes.colorTypeRgba = {
                      "projects" : "137,165,229",
                      "person" : "242,133,185",
                      "organizations" : "255,217,141",
                      "events" : "205,249,137",
                      "citoyens" : "255,255,255",
                      "xxx" : "200,200,200"};

    myGraph.customNodes.imageType = {"citoyens" : "child",
                                    "events" : "calendar",
                                    "organizations" : "world",
                                    "person" : "user",
                                    "projects" : "lab"};

    myGraph.customNodes.strokeColorType = {"projects" : "#CCC",
                  "person" : "#CCC",
                  "organizations" : "#CCC",
                  "events" : "#CCC",
                  "citoyens" : "#CCC",
                  "xxx" : "CCC"}

    myGraph.drawGraph();

    //Legend
    var legendHtml = "<div><p></p>"
    for (var i = 0; i < myGraph.customNodes.listType.length; i++) {
      legendHtml += "<div><p class='item_panel_legend'><i class='fa fa-square fa-1x' style='color:"
      + myGraph.customNodes.colorType[myGraph.customNodes.listType[i]] + "'></i><span class='filter_name' style='display: inline;'>"
      + myGraph.customNodes.listType[i] + "</span></p></div>";
    }
    legendHtml += "</div>"

    $(".panel_legend").html(legendHtml);

  } else {
    $("#titre").text("Pas de donnée à afficher");
    $(".panel_legend").remove();
  }

});


function getDataFile(dataMap) {
  console.log("getDataFile");
  var map = null;
  if (typeof dataMap != "undefined") {
    map = dataMap;
    if (typeof dataMap.person != "undefined") {
      contextId = dataMap.person["_id"]["$id"];
      type = 'person';
    } else if (typeof dataMap.organization != "undefined") {
      contextId = dataMap.organization["_id"]["$id"];
      type = 'organization';
    } else if (typeof dataMap.event != "undefined") {
      contextId = dataMap.event["_id"]["$id"];
      type = "event";
    } else if (typeof dataMap.project != "undefined") {
      contextId = dataMap.project["_id"]["$id"];
      type = "project";
    }

  }
  return map;
}

function searchIndexOfNodeId(o, searchTerm) {
  for (var i = 0, len = o.length; i < len; i++) {
    if (o[i].identifier === searchTerm) return i;
  }
  return -1;
}


function createFluidGraph(type, contextId, datafile) {
  console.log("createFluidGraph");
  console.log("type = " + type);
  console.log("contextid = " + contextId);
  console.log("datafile = " + datafile);

  var nodes= [];
  var edges= [];

  // var sousTypeMap = {
  //   "NGO" : "organizations",
  //   "Group" : "organizations",
  //   "LocalBusiness" : "organizations",
  //   "GovernmentOrganization" : "organizations",
  //   "getTogether" : "events",
  //   "projects" : "projects",
  //   "person" : "person",
  // };

  var index = 0;
  $.each(datafile, function(type, obj) {
    console.log("index = " + index + " ,type = " + type + ", obj = " + obj + ", typeOf obj = " + typeof obj);

    var typeMap = {
      "organization" : "organizations",
      "event" : "events",
      "project" : "projects",
      "person" : "person",
    };

    if (obj["_id"])
    {
      nodes.push({id : index, type : typeMap[type], label : obj.name, identifier : obj._id.$id})
      index++;
    }
    else {
      if (obj.length)
      {
        obj.forEach(function(sousobj, i)
        {
          var soustype;

          switch (sousobj.type)
          {
            case "NGO" : soustype = "organizations"; break;
            case "Group" : soustype = "organizations"; break;
            case "LocalBusiness" : soustype = "organizations"; break;
            case "GovernmentOrganization" : soustype = "organizations"; break;
            case "getTogether" : soustype = "events"; break;
            case "citoyens" : soustype = "citoyens"; break;
            case "projects" : soustype = "projects"; break;
            case "person" : soustype = "person"; break;
            default : soustype = "xxx"; break;
          }

          nodes.push({id : index, type : soustype, label : sousobj.name, identifier : sousobj._id.$id})
          index++;
        });
      }
    }
  });

  var index = 0;
  //links
  $.each(datafile, function(type, obj) {
    if (!obj["_id"])
    {
      if (obj.length)
      {
        obj.forEach(function(sousobj, i)
        {
          var linkIndex = {};
          var indexSource = searchIndexOfNodeId(nodes,sousobj._id.$id)
          $.each(sousobj.links, function(linkType, linkObj)
          {
            var linkIndexTemp = [];
            $.each(linkObj, function(id, object)
            {
              linkIndexTemp.push(id);
            });
            linkIndex[linkType] = linkIndexTemp;
          });

          $.each(linkIndex, function(linkIndexType, linkIndexTargetTab)
          {
            linkIndexTargetTab.forEach(function(linkIndexTarget, i)
            {
              indexTarget = searchIndexOfNodeId(nodes,linkIndexTarget)
              if (indexTarget != -1)
                edges.push({source : indexSource, target : indexTarget})
            });
          });
        });
      }
    }
  });

  d3data.nodes = nodes;
  d3data.edges = edges;
  return d3data;
}
</script>
