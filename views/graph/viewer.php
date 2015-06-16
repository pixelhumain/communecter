 

<style>
				
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

	.circle_type {
	    cursor: pointer;
	    fill: #eee;
	    pointer-events: none;
	    stroke: #ddd;
	    stroke-width: 3px;
	}

	#chart{
		width: 100%;
	}

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
<script type="text/javascript">

   	var force;
   	var data;
	var dataTab;
	var timer;
	var dataAjax;
	var datafile;
	var parentId;
	var zoomScale = 1;
	var tabLinks = [""];
	var tabColor = ["#00bdcc", '#dd5a82', '#1fbba6', '#66899B', '#f58a5c', 'black'];
	var tabType = [];
	var tabTypebis = [];
	var tabColorType = [];
	var fill;
	var fill2;
	var lastLevel;
	var maxLevel= 0;
	var type;
	var contextId;
	var mapIconOrga = {"NGO":" fa-building-o", "LocalBusiness":"fa-home", "GovernmentOrganization":"fa-institution", "Group":"fa-group", "":"fa-dollar"};
	var viewerMap = <?php if(isset($viewerMap)) echo json_encode($viewerMap); ?>;
	var mapText ;

	function getDataFile(){
		console.log("getDataFile");
		var map = null;
		if("undefined" != typeof viewerMap){
			map=viewerMap;
			if("undefined" != typeof viewerMap.person){
				contextId = viewerMap.person["_id"]["$id"];
				type = 'person';
			}else if("undefined" != typeof viewerMap.organization){
				contextId = viewerMap.organization["_id"]["$id"];
				type = 'organization';
			}else if("undefined" != typeof viewerMap.event){
				contextId = viewerMap.event["_id"]["$id"];
				type = "event";
			}else if("undefined" != typeof viewerMap.project){
				contextId = viewerMap.project["_id"]["$id"];
				type ="project";
			}
			
		}
		return map;
	}
	
	function initViewer(){
		if(datafile!=null){
			data = createDataGraph(type, contextId, datafile)
			getNewData(data);
		}
		else{
			$("#titre").text("Pas de donnée à afficher");
			$(".panel_legend").remove();
		}
	}

	
	
	function createDataGraph(varname, id, data){
		
		var firstNode;
		
		
		var typeArray = [];
		var firstNodeChildren = [];
	  	$.each(datafile, function(key,obj){
	  		var isType = false;
	  		var typeObject = {};
	  		if(key==varname){
				firstNode = createDataNode(obj, 1);
				firstNode['parent'] = key;
			}else if(obj.length>0){
				console.log(key);
				var parent = key;
				if(parent == "people" || parent=="citoyens")
					parent = "person";
				if(parent == "organizations")
					parent = "organization";
				if(parent == "projects")
					parent = "project"
				if(parent == "events")
					parent = "event";
				if($.inArray(parent, tabType)==-1){
					tabType.push(parent);
				}
				var newNode = createDataNode(obj, 2);
				newNode['parent'] = parent;
				newNode['name'] = key;
				var newNodeChildren= [];
				console.log("obj2", obj, key);
				$.each(obj, function(key2, obj2){
					var newNodeChild;
					var id = obj2["_id"]["$id"];
					if('undefined' != typeof obj2.type ){
						if('undefined' != typeof typeObject[obj2.type]){
							typeObject[obj2.type].push(obj2);
						}else{
							typeObject[obj2.type] = [];
							typeObject[obj2.type].push(obj2);
						}
						isType = true;
					}else{

						newNodeChild = createDataNode(obj2, 3);
						newNodeChild["link"] = getLink(id,datafile, varname);
						newNodeChild["url"] = baseUrl+"/<?php echo $this->module->id?>/"+parent+"/dashboard/id/"+id;
						newNodeChildren.push(newNodeChild);
					}
					
				})
				if(isType){
					$.each(typeObject, function(key2, obj2){
						var typeNode = {};
						typeNode['name'] = key2;
						typeNode["type"] = key2;
						typeNode['level'] = 3;
						typeNode["rayon"] = 15;
						typeNode["parent"] = parent;
						var typeArrayChildren = [];
						$.each(obj2, function(key3, obj3){
							var typeNodeChild = createDataNode(obj3, 4);
							var id = obj3['_id']['$id'];
							typeNodeChild['parent'] = parent;
							typeNodeChild['type'] = key2;
							typeNodeChild['link'] = getLink(id, datafile, varname);
							typeNodeChild["url"] = baseUrl+"/<?php echo $this->module->id?>/"+parent+"/dashboard/id/"+id;
							typeArrayChildren.push(typeNodeChild);
						})
						typeNode["children"] = typeArrayChildren;
						newNodeChildren.push(typeNode);
					})
					console.log("newNodeChildren", newNodeChildren);
				}
				newNode['children'] = newNodeChildren;
				firstNodeChildren.push(newNode);
			}
		});
		firstNode['children']=firstNodeChildren;
		console.log("firstNode", firstNode);
		mapText = firstNode;
		return firstNode;
	}


function getLink(id, map, varname){
	var link = "";
	$.each(map, function(key, obj){
		if(key == varname){
			console.log(obj)
			if('undefined' != typeof(obj.links)){
				$.each(obj.links, function(key2, obj2){
					if($.inArray(key2, tabLinks)==-1){
						tabLinks.push(key2);
					}
					$.each(obj2, function(key3, obj3){
						console.log(key3, obj3);
						if(key3==id){
							console.log('ok');
							link=key2;
						}
					})				
				})
			}
		}
	});
	console.log(link);
	return link;
}
function createDataNode(object, level){
	var newData = {};
	$.each(object, function(key, obj){
		newData[key]= obj;
	})
	if(level>3){
		newData["rayon"] = 14;
	}else{
		newData["rayon"] = 31-8*(level-1);
	}
	newData["level"] = level;
	if(level == 1){
		newData["fixed"] = "true";
		newData["x"] = 0;
		newData["y"] = 0;
	}
	return newData;

}

function getNewData(data){
    var color = d3.scale.category20();
 	var color_1 = randomColor();
 	var color_2 = randomColor();
 	var color_3 = randomColor();
  	var n = 100,
  	node,
  	link,
  	nodes,
  	links,
  	width = $("#chart").width(),
  	height = width*60/100;
  	data.x = window.innerWidth /2,
  	data.y = window.innerHeight /2;
  	var FontFamily = "Helvetica Neue, Helvetica, Arial, sans-serif;"
  	force = d3.layout.force()
  		.linkDistance(100)
  		.charge(-2500)
  		//.gravity(1)
  		.size([width, height])
  	var zoom = d3.behavior.zoom()
          .scaleExtent([-5, 10])
          .on("zoom", zoomed);	
  	//.on("tick", tick) // Remplacé par une boucle dans update()
  	var svg = d3.select("#ajaxSV #chart").append("svg")
  		.attr("id", "svgNodes")
  		.attr("width", width)
  		.attr("height", height)
  		.call(zoom);
  	var node_drag = d3.behavior.drag()
  		.on("dragstart", dragstart)
  		.on("drag", dragmove)
  		.on("dragend", dragend)
  	nodes = flatten(data);
  	links = d3.layout.tree().links(nodes);

  	
  	
	function onTimeTick(){
		force.nodes(nodes)
			.links(links)
		// Run the layout a fixed number of times.
		// The ideal number of times scales with graph complexity.
		force.start();
		for (var i = n * n; i > 0; --i) force.tick();
		force.stop();
	}
	
	for(var i = 0; i<tabType.length; i++){
		tabColorType.push(randomColor());
	}
	onTimeTick();
	
	update();

	//Initialize the display to show a few nodes.
	
	data.children.forEach(toggleAll);

	// Restart the force layout.
	nodes = flatten(data);
	links = d3.layout.tree().links(nodes);
	update();

	force.on("tick", tick);

	function update(){



		fill2 = d3.scale.ordinal()
			.domain(tabType)
			.range(tabColorType);

		fill = d3.scale.ordinal()
		    .domain(tabLinks)
		    .range(tabColor);
		node = svg.selectAll(".node")
			.data(nodes, function(d) { return d.id });
		var nodeEnter = node.enter()
			.append("g")
			.attr("class", "node")
			.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
			.on("click", click)
			//.on("click", mouseover)
			.on("mouseover", mouseover)
			.on("mouseout", mouseout)
			.call(node_drag)
		/* Cercle qui apparait sur le hover */
		nodeEnter.append("circle")
			.attr("r", 0)
			.attr("class", "CircleOptions")
			.style("fill", "transparent")
			
			.style("stroke-opacity", ".5")
			.style("stroke-width", "15")
			.style("stroke-dasharray", "10,5")
			.on("mouseout", mouseout)
		/* Option de déplacement */
		nodeEnter.append("circle")
			.attr("cx", function(d) { return -d.rayon-20; })
			.attr("cy", function(d) { return -d.rayon-20; })
			.attr("r", 0)
			.attr("class", "CircleF")
			.style("stroke-opacity", ".5")
			.style("stroke", "steelblue")
			.attr("fill", "white")
			.style("fill-opacity", "1")
			.style("stroke-width", "2")
		nodeEnter.append("svg:image")
			.attr("class", "ImageF")
			.attr('x', function(d) { return -d.rayon-30; })
			.attr('y', function(d) { return -d.rayon-30; })
			.attr('width', 20)
			.attr('height', 20)
			.style("visibility", "hidden")
			.attr("xlink:href","http://fluidlog.com/img/move_64.png")
			.style("cursor", "move")
			.append("title").text("Drag'n drop\nClic to free")
		/* Option de lien */
		nodeEnter.append("circle")
			.attr("cx", function(d) { return d.rayon+20; })
			.attr("cy", function(d) { return -d.rayon-20; })
			.attr("r", 0)
			.attr("class", "CircleL")
			.style("stroke-opacity", ".5")
			.style("stroke", "steelblue")
			.attr("fill", "white")
			.style("fill-opacity", "1")
			.style("stroke-width", "2")
		nodeEnter.append("svg:image")
			.attr("class", "ImageL")
			.attr('x', function(d) { return d.rayon+10; })
			.attr('y', function(d) { return -d.rayon-30; })
			.attr('width', 20)
			.attr('height', 20)
			.style("visibility", "hidden")
			.style("cursor", "pointer")
			.attr("xlink:href","http://fluidlog.com/img/arrow_full_upperright_64.png")
			.on("click", function(d){openLink(d);})
			.append("title").text(function(d) { return d.url; })
		/* Option d'information */
		nodeEnter.append("circle")
			.attr("cx", function(d) { return -d.rayon-20; })
			.attr("cy", function(d) { return d.rayon+20; })
			.attr("r", 0)
			.attr("class", "CircleI")
			.style("stroke-opacity", ".5")
			.style("stroke", "steelblue")
			.attr("fill", "white")
			.style("fill-opacity", "1")
			.style("stroke-width", "2")
		nodeEnter.append("svg:image")
			.attr("class", "ImageI")
			.attr('x', function(d) { return -d.rayon-30; })
			.attr('y', function(d) { return d.rayon+10; })
			.attr('width', 20)
			.attr('height', 20)
			.style("visibility", "hidden")
			.attr("xlink:href","http://fluidlog.com/img/information_64.png")
			.attr('title', function(d){return d.name})
			.attr('data-content',"<ul><li>Test1</li><li>Test2</li></ul>")
			
		/* Option de description */
		nodeEnter.append("circle")
			.attr("cx", function(d) { return d.rayon+20; })
			.attr("cy", function(d) { return d.rayon+20; })
			.attr("r", 0)
			.attr("class", "CircleD")
			.style("stroke-opacity", ".5")
			.style("stroke", "steelblue")
			.attr("fill", "white")
			.style("fill-opacity", "1")
			.style("stroke-width", "2")
		nodeEnter.append("svg:image")
			.attr("class", "ImageD pop-div")
			.attr('x', function(d) { return d.rayon+10; })
			.attr('y', function(d) { return d.rayon+10; })
			.attr('width', 20)
			.attr('height', 20)
			.style("visibility", "hidden")
			.style("cursor", "pointer")
			.attr("xlink:href","http://fluidlog.com/img/comment_64.png");
			
		/* cercle entourant le type du noeud*/
		nodeEnter.append("circle")
				.attr("cx", 0)
				.attr("cy", function(d){return +d.rayon;})
				.attr("r", 13)
				.style("stroke", function(d){return fill2(d.parent)})
				.attr("fill", "white")
				.style("z-index", "3000")
			    .attr("class", "circle_type")
		nodeEnter.append("foreignObject")
			.attr("x", -7.5)
			.attr("y", function(d) { return +d.rayon-8; })
			.attr("width", 20)
			.attr("height", 20)
			.append("xhtml:body")
			.style("width",20)
			.style("height",20)
			.attr("fill", function(d){return fill2(d.parent)})
			.attr("class", "fObjectCircle_circle")
			.html(function(d)
			{
			switch (d.parent)
				{
					case "event" :
						return "<div class='intocircle' style='color: black;'><span class='middlespan'><i class='fa fa-smile-o fa-lg'></i></span></div>";
						break;
					case "organization" :
						return "<div class='intocircle' style='color: black;'><span class='middlespan'><i class='fa "+mapIconOrga[d.type]+" fa-lg'></i></span></div>";
						break;
					case "person" :
						return "<div class='intocircle' style='color: black;'><span class='middlespan'><i class='fa fa-child fa-lg'></i></span></div>";
						break;
					case "project" :
						return "<div class='intocircle' style='color: black;'><span class='middlespan'><i class='fa fa-tasks fa-lg'></i></span></div>";
						break;
					default :
						return "<div class='intocircle' style='color: black;'><span class='middlespan'><i class='fa fa-meh-o fa-lg'></i></span></div>";
						break;
				}

		})
		/* Image du type du noeud */
		nodeEnter.append("svg:image")
		    		.attr("class", "image_type")
					.attr('x', -8)
					.attr('y', function(d){return +d.rayon-55;})
					.attr('width', 15)
					.attr('height', 15)
					.attr("xlink:href",function(d){
						switch (d.type)
						{
							case "project" :
								return "img/project.png";
								break;
							case "actor" :
								return "img/actor.png";
								break;
							case "idea" :
								return "img/idea.png";
								break;
							case "ressource" :
								return "img/ressource.png";
								break;
							case "without" :
								return "img/without.png";
								break;
						}

					})
					.style("cursor", "pointer")
		 
		// set the options – read more on the Bootstrap page linked to above
		$('svg .ImageI').popover({
		   'trigger':'hover',
		   'container': '#chart',
		   'placement': 'top',
		   'white-space': 'nowrap',
		   'html':'true',
		   
		});
		//Cercle sur lequel nous allons déposer le texte
		nodeEnter.append("circle")
			.attr("class", function(d) { return d.level ? "level" +d.level : "level" +5 ; })
      		.attr("r", function(d) {  return d.rayon; })
			.attr("fill","white")
      		.style("stroke", function(d){return fill2(d.parent)})
      		.style("stroke-width", "2")
			.transition()
			
			.duration(500);
			
		nodeEnter.append("svg:image")
			.attr('x', -30)
			.attr('y', -30)
			.attr('width', function(d) { if (d.image) return 60; })
			.attr('height', function(d) { if (d.image) return 60; })
			.attr("xlink:href",function(d) { return d.image; })

		nodeEnter.append("text")
			.attr("x", 0)
			.attr("y", function(d) { return d.rayon/2-4; })
			.attr("fill", function(d){return fill2(d.parent)})
			.attr("class", "text_id")
			.style("font-size", function(d){ return getFontSize(d.name, d.rayon);})
			.text(function(d)
			{
				return d.name;
			
			})


		//})
		node.exit().remove();
	    $(".level3, .level4")
	      	.attr("r", 30)
	      

		$(".level2").attr("r", 40);
		$(".level1").attr("r", 50);
		
		// Update links.
		link = svg.selectAll(".link")
			.data(links, function(d) { return d.target.id; });
			link.enter().insert("line", ".node")
			.attr("class", "link")
			.attr("stroke-width", "0")
			.transition()
			.duration(500)
			.attr("stroke-width", "3")
			.attr("stroke", function(d){console.log("target",d.target.link); return fill(d.target.link)})
			.attr("x1", function(d) { return d.source.x; })
			.attr("y1", function(d) { return d.source.y; })
			.attr("x2", function(d) { return d.target.x; })
			.attr("y2", function(d) { return d.target.y; });
			
		link.append("svg:text")
      		.attr("class", "linktext")
	      	.attr("dx", function(d) { return d.source.x; })
	      	.attr("dy", function(d) { return d.source.y; })
	      	.attr("text-anchor", "middle")
	      	.text(function(d){return d.target.link;});

		link.exit().remove();


		var legendHtml = "<div><p></p>"
		for(var i= 0; i<tabLinks.length; i++){
			if(tabLinks[i]!= "")
				legendHtml += "<div><p class='item_panel_legend'><i class='fa fa-square fa-1x' style='color:"+fill(tabLinks[i])+"'></i><span class='filter_name' style='display: inline;'>"+tabLinks[i]+"</span></div></p>"
		}
		legendHtml +="</div>"

		$(".panel_legend").html(legendHtml);


	}
	

	

	function tick() {
		link.attr("x1", function(d) { return d.source.x; })
			.attr("y1", function(d) { return d.source.y; })
			.attr("x2", function(d) { return d.target.x; })
			.attr("y2", function(d) { return d.target.y; })
			node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
	}

	function openLink(d){
		window.open(d.url)
	}

	    
	function mouseover(d,i){
		
		if (d.level>=3)
		{
			var color = randomColor();
			d3.select(this).select('.CircleOptions').transition().duration(300)
			.attr("r", function(d) { return d.rayon + 30; })
			.style("stroke", function(d){return color})
   
			d3.select(this).select('.CircleF').transition().duration(300).attr("r", 15)
			d3.select(this).select('.ImageF').transition().duration(300).style("visibility", "visible")
			d3.select(this).select('.ImageL').transition().duration(300).style("visibility", "visible")
			d3.select(this).select('.CircleL').transition().duration(300).attr("r", 15)
			d3.select(this).select('.ImageI').transition().duration(300).style("visibility", "visible")
			d3.select(this).select('.CircleI').transition().duration(300).attr("r", 15)
			d3.select(this).select('.ImageD').transition().duration(300).style("visibility", "visible")
			d3.select(this).select('.CircleD').transition().duration(300).attr("r", 15)
		}
	}
		
			
		
	function mouseout(d)
	{
		if (d.level>=3)
		{
			d3.select(this).select('.CircleOptions').transition().duration(300).attr("r", 0)

			d3.select(this).select('.CircleF').transition().duration(300).attr("r", 0)
			d3.select(this).select('.ImageF').transition().duration(300).style("visibility", "hidden")
			d3.select(this).select('.ImageL').transition().duration(300).style("visibility", "hidden")
			d3.select(this).select('.CircleL').transition().duration(300).attr("r", 0)
			d3.select(this).select('.ImageI').transition().duration(300).style("visibility", "hidden")
			d3.select(this).select('.CircleI').transition().duration(300).attr("r", 0)
			d3.select(this).select('.ImageD').transition().duration(300).style("visibility", "hidden")
			d3.select(this).select('.CircleD').transition().duration(300).attr("r", 0)
		}
	}
	//Returns a list of all nodes under the root.
	function flatten(root) {
		var nodes = [], i = 0;

		function recurse(node){
			if (node.children)
				node.children.forEach(recurse);
			if (!node.id)
				node.id = ++i;
			nodes.push(node);
		}

		recurse(root);
		return nodes;
	}

	
	function getSize(d) {
	  var bbox = this.getBBox(),
	      cbbox = this.parentNode.getBBox(),
	      scale = Math.min(cbbox.width/bbox.width, cbbox.height/bbox.height);
	      console.log("scale", scale);
	  d.scale = scale;
	}
	function getFontSize(text,r){
		//var fontsize = (4 * r) / text.length-5 + "px"; // algorithme à trouver...
		var fontsize = r/1.8+ "px";		return fontsize ;
	}

	function click(d,i){
		if (d.level>=2){
			hover(d);
			nodes = flatten(data);
			links = d3.layout.tree().links(nodes);
			update(d);
		}
		if (d3.event.defaultPrevented) return;
		d3.select(this).classed("fixed", d.fixed = false);
	}

	function dragstart(d, i){
		force.stop()
	}

	function dragmove(d, i) {
		d.px += d3.event.dx;
		d.py += d3.event.dy;
		d.x += d3.event.dx;
		d.y += d3.event.dy;
		tick(); // this is the key to make it work together with updating both px,py,x,y on d !
	}

	function dragend(d, i) {
		d3.select(this).classed("fixed", d.fixed = true);
		tick();
		force.resume();
	}
	function zoomed() {
		zoomScale = d3.event.scale;
		console.log(d3.event.translate);
        svg.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
    }

   

	function toggleAll(d) {
		if (d.children) {
			d.children.forEach(toggleAll);
			toggle(d);
		}
	}
	//Toggle children.
	function toggle(d) {
		if (d.children) {
			d._children = d.children;
			d.children = null;
		} else {
			d.children = d._children;
			d._children = null;
		}
	}
	//Toggle children.
	function hover(d) {
		if (d3.event.defaultPrevented) return; // ignore drag
			toggle(d);
	}

}

	
	function randomColor(){
		  var golden_ratio_conjugate = 0.618033988749895;
		  var h = Math.random();

		  var hslToRgb = function (h, s, l){
		      var r, g, b;

		      if(s == 0){
		          r = g = b = l; // achromatic
		      }else{
		          function hue2rgb(p, q, t){
		              if(t < 0) t += 1;
		              if(t > 1) t -= 1;
		              if(t < 1/6) return p + (q - p) * 6 * t;
		              if(t < 1/2) return q;
		              if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
		              return p;
		          }

		          var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
		          var p = 2 * l - q;
		          r = hue2rgb(p, q, h + 1/3);
		          g = hue2rgb(p, q, h);
		          b = hue2rgb(p, q, h - 1/3);
		      }

		      return '#'+Math.round(r * 255).toString(16)+Math.round(g * 255).toString(16)+Math.round(b * 255).toString(16);
		  };
			h += golden_ratio_conjugate;
			h %= 1;
			return hslToRgb(h, 0.5, 0.60);
	}
  function clearViewer(){
		if('undefined' != typeof force){
			force.stop();
		};
		$("#svgNodes").empty();
		$("#chart").empty();
	}

	 function addZoom(){
    	zoomScale = zoomScale +1;
    	$("#svgNodes").attr("transform", "scale(" + zoomScale + ")");
    }

    function subZoom(){
    	zoomScale = zoomScale/2;
    	
    	$("#svgNodes").attr("transform", "scale(" + zoomScale + ")");
    }
    function resetZoom(){
    	zoomScale = 1;
    	$("#svgNodes").attr("transform", "scale(" + zoomScale + ")");
    }



    jQuery(document).ready(function() {

		$( window ).resize(function() { 
				
				clearTimeout(timer);
			    timer = setTimeout(function(){ 
			    	force.stop();
					$("#svgNodes").empty();
					$("#chart").empty();
					initViewer();
				} , 200);
		});

		/*
		var itemId = "<?php //if(isset($_GET["id"])) echo $_GET["id"]; else if(isset($person["_id"])) echo $person["_id"]; ?>";
		var itemType = "<?php //if(isset($person["_id"])) echo Person::COLLECTION; else if(isset($organization["_id"])) echo Organization::COLLECTION; ?>";


		$.ajax({
			url: baseUrl+"/graph/getData/id/"+itemId+"/type/"+itemType,
			type: "POST",
			dataType : "json",
			success: function(data){
				viewerMap=data;
			}
		})*/
		datafile = getDataFile();
		initViewer();
	});
</script>