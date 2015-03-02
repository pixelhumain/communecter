

<style>
				
	.fObjectCircle{
	border: 0px;
	margin: 0px auto;
	padding: 0;
	background-color: white;

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

	#chart{
		width: 100%;
		position: absolute;
	}

	.pop-div .popover-content {
	    max-width: 310px;
	    height: 250px;
	    overflow-y:scroll;
	}
</style>

	<div id="chart">
		<div id="titre"></div>
	</div>

  
<script type="text/javascript">
   	var oldW, oldH;
   	var force;
   	var testFile;

	jQuery(document).ready(function() {
	
	$( window ).resize(function() { 
			
			clearTimeout(timer);
		    timer = setTimeout(function(){ 
		    	force.stop();
				$("#svgNodes").empty();
				$("#chart").empty();
				getNewData("person", "<?php echo Yii::app()->session['userId'] ?>", {"people":{"name":"name", "parentIdField":"links"}, "organizations":{"name":"name", "parentIdField":"links"}}, datafile);
			} , 200);
		   	
		    //$("#svgNodes").remove();
		});	

	var data;
	var dataTab;
	var timer;
	var btnSelect;
	var datafile=mapPerson;
	var parentId;
	var parentTabId = [""];
	var thisVarname;
	var tabLinks = [""];
	var tabColor = ["black"];
	var fill;
	
	console.log(projects);
	getNewData("person", "<?php echo Yii::app()->session['userId'] ?>", {"people":{"name":"name", "parentIdField":"links"}, "organizations":{"name":"name", "parentIdField":"links"}}, datafile);


  	
 function getNewData(varname, id, child, datafile){

  	data = {};
    var color = d3.scale.category20();
 	var color_1 = randomColor();
 	var color_2 = randomColor();
 	var color_3 = randomColor();
    parentId = id;
  	var children= [];
  	var newNode = {};
  	var name1;
  	$.each(datafile, function(key, obj){
  		if(key==varname){
  			name1 = obj.name;
  		}
  	})
	dataTab = datafile;

	data["name"] = name1;
	data["rayon"] = 31;
	data["level"] = 1;
	data["fixed"] = "true";
	data["x"] = 0;
	data["y"] = 0;
	//console.log(child);

	$.each(child, function(key, obj){
		//console.log(child[i], i);
		var newChild ={};
		newChild["name"] = key;
		newChild["rayon"] = 23;
		newChild["level"] = 2;
		var childrenLevel = [];
		var name;
		var thisId;
		
		$.each(dataTab, function(key2, obj2){
			if(key== key2){
				$.each(obj2, function(key3, obj3){
					var link= "";
					if(typeof(obj["parentIdField"])=="string"){
						name=obj3[obj["name"]];
						thisId = obj3[obj["parentIdField"]];
						while(typeof(thisId)=="object"){
							$.each(thisId, function(key4, obj4){	
								link += " " +key4;
								thisId = obj4;
							});
						}
					}
					console.log(thisId);
					if(thisId ==id){
						var newChildLevel = {};
						newChildLevel["link"] = link;
						if($.inArray(link, tabLinks)==-1){
							tabLinks.push(link);
						}
						newChildLevel["name"] = name;
						newChildLevel["rayon"] = 15;
						newChildLevel["level"] = 3;
						childrenLevel.push(newChildLevel);
					}	
				})
					
					
			}	
		});
		newChild["children"]= childrenLevel;
		children.push(newChild);
	});
	data["children"] = children;

  	
  		//console.log(child,"3", dataTab);
  	//console.log(child,"4", dataTab);
  	//console.log(data);
  	//console.log(child, dataTab);
  	//console.log("data", data);
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
  		.size([width, height])
  	//.on("tick", tick) // Remplacé par une boucle dans update()
  	var svg = d3.select("#chart").append("svg")
  		.attr("id", "svgNodes")
  		.attr("width", width)
  		.attr("height", height)
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

	onTimeTick();
	//console.log("data", data);
	update();
//Initialize the display to show a few nodes.

	data.children.forEach(toggleAll);
	// Restart the force layout.
	nodes = flatten(data);
	links = d3.layout.tree().links(nodes);
	update();

	force.on("tick", tick);

	function update(){
		node = svg.selectAll(".node")
			.data(nodes, function(d) { return d.id });
		var nodeEnter = node.enter()
			.append("g")
			.attr("class", "node")
			.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
			.on("click", click)
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
			.append("title").text(function(d) { return d.name; })
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
			.attr('title', function(d){return d.name})
			.attr('data-content',"<ul><li>Test1</li><li>Test2</li></ul>")
			.style("visibility", "hidden")
			.style("cursor", "pointer")
			.attr("xlink:href","http://fluidlog.com/img/comment_64.png")
			.on("click", function(d){return getPanel(d);})

		 
		// set the options – read more on the Bootstrap page linked to above
		$('svg .ImageD').popover({
		   'trigger':'hover',
		   'container': '#chart',
		   'placement': 'top',
		   'white-space': 'nowrap',
		   'html':'true'
		});

		//Cercle sur lequel nous allons déposer le texte
		nodeEnter.append("circle")
			.attr("class", function(d) { return d.level ? "level" +d.level : "level" +4 ; })
      		.attr("r", function(d) {  return d.rayon; })
			.attr("fill","white")
      		.style("stroke", function(d){return getStrokeColor(d)})
      		.style("stroke-width", "2")
			.transition()
			.duration(500);
			

		nodeEnter.append("svg:image")
			.attr('x', -30)
			.attr('y', -30)
			.attr('width', function(d) { if (d.image) return 60; })
			.attr('height', function(d) { if (d.image) return 60; })
			.attr("xlink:href",function(d) { return d.image; })

		nodeEnter.append("foreignObject")
			.attr("x", function(d) { return -d.rayon-2; })
			.attr("y", function(d) { return -d.rayon-2; })
			.attr("width", function(d) { return d.rayon*2+4; })
			.attr("height", function(d) { return d.rayon*2+4; })
			.append("xhtml:body")
			.style("width",function(d) { return d.rayon*2+4+"px"; })
			.style("height",function(d) { return d.rayon*2+4+"px"; })
			.attr("class", "fObjectCircle")
			.html(function(d)
			{
			if (d.level > 0)
			{
				var textNodes = d.name;
				var fontsize = getFontSize(textNodes, d.rayon);
				var inputtext = '<div class="intocircle" style="color:steelblue; font-size: '+fontsize+';"><span class="middlespan">';
				inputtext += textNodes;
				inputtext += '</span></div>';
        		//console.log("input", inputtext);
				return inputtext;
			}
			svg.append('svg:foreignObject')
			   .attr('width', '300px')
			   .attr('height', '400px')
			   .append('xhtml:div')
			   .attr('class', 'pop-div')
			   .html('<a href="#" class="myid" rel="popover" >click me</a>');

		})
		node.exit().remove();
    $(".level3")
      .attr("r", 30)
      

      $(".level2").attr("r", 40);
      $(".level1").attr("r", 50);
      for(var i = 1; i<tabLinks.length; i++){
      	tabColor.push(randomColor());
      }

      fill = d3.scale.ordinal()
	        .domain(tabLinks)
	        .range(tabColor);
	// Update links.
		link = svg.selectAll(".link")
			.data(links, function(d) { return d.target.id; });
			link.enter().insert("line", ".node")
			.attr("class", "link")
			.attr("stroke-width", "0")
			.transition()
			.duration(500)
			.attr("stroke-width", "3")
			.attr("stroke", function(d){return fill(d.target.link)})
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

		var legend = svg.selectAll(".legend")
		    .data(fill.domain())
		    .enter().append("g")
		    .attr("class", "legend")
		    .attr("transform", function(d, i) { return "translate(0," + i * 20 + ")"; });

		legend.append("rect")
		    .attr("x", width - 20)
		    .attr("width", 20)
		    .attr("height", 15)
		    .style("fill", fill);

		legend.append("text")
		    .attr("x", width - 26)
		    .attr("class", "label label-default")
		    .attr("y", 9)
		    .attr("dy", ".35em")
		    .style("text-anchor", "end")
		    .text(function(d) { return d; });

		}

		function tick() {
			link.attr("x1", function(d) { return d.source.x; })
				.attr("y1", function(d) { return d.source.y; })
				.attr("x2", function(d) { return d.target.x; })
				.attr("y2", function(d) { return d.target.y; })
				node.attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; });
		}
		function openLink(d){
			window.open("//"+d.url)
		}

	    function openModal(d){
	      
	      var modHtml = "";
	      console.log(dataTab);
	      $.each(dataTab, function(key, obj){
	        if(obj.name == d){
	          $.each(obj, function(key, value){
	            modHtml=modHtml+"<li>"+key+ ":"+value+"</li>"
	          });
	        }
	         console.log("key", "value",d, key, modHtml );
	      });
	      $('#ajaxSV').html("<ul>"+modHtml+"</ul>")
	     
	    }
		function mouseover(d,i){
			if (d.level==2){
				hover(d);
				nodes = flatten(data);
				links = d3.layout.tree().links(nodes);
				update(d);
			}
			else if (d.level==3)
			{
				var color = randomColor();
				console.log("color", color, d3.select(this));
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
        //d3.select(this).tooltip.call();
			}
		}
		function mouseout(d)
		{
			if (d.level==2)
				hover(d);
			else if (d.level==3)
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

		function getPanel(tasksObject){

		  	
		}


		function getFontSize(text,r){
			//var fontsize = (4 * r) / text.length-5 + "px"; // algorithme à trouver...
			var fontsize = r/1.8 + "px";
			return fontsize ;
		}

		function click(d,i){
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

		function getStrokeColor(d){
			var color;
			if(d.level=="1"){
				color = color_1;
			}else if(d.level=="2"){
				color = color_2;
			}else{
				color = color_3;
			}
			return color;
		}

	}
});
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
  
	
	</script>
