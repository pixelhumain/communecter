

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
		
		z-index: 1;
	}
	#chart2{
		width: 100%;
		z-index:1;

	}

	.pop-div .popover-content {
	    max-width: 310px;
	    height: 250px;
	    overflow-y:scroll;
	}

	.panel_map{
		position: absolute;
		top:10px;
		left:15px;
		background: none repeat scroll 0 0 #5f8295;
		width: 150px;
		border: 2px solid #5f8295;
		color : white;
		text-align: center;
	}
	p.item_panel_map {
	  margin-bottom: 3px;
	}

	.item_panel_map {
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
</style>

	
<div id="chart">
	<div id="titre"></div>
</div>
	
	
<div class="panel_map" style="max-width: 250px;">
	<p name"].'"="" id="item_panel_map_'.$tag[" class="item_panel_map">
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
	var datafile=mapPerson;
	var parentId;
	var tabLinks = [""];
	//var tabColor = ["black", 'red', 'yellow', 'green',' blue', '#66899B‏'];
	var tabColor = ["black", '#DD5A82‏', '#1FBBA6‏', '#00BDCC‏',' #F58A5C‏', '#66899B‏'];
	var tabType = [];
	var tabColorType = [];
	var fill;
	var fill2;
	var lastLevel;
	var maxLevel= 0;


	jQuery(document).ready(function() {

		$( window ).resize(function() { 
				
				clearTimeout(timer);
			    timer = setTimeout(function(){ 
			    	force.stop();
					$("#svgNodes").empty();
					$("#chart").empty();
					data = createDataFinal(type, "<?php echo Yii::app()->session['userId'] ?>", datafile);
					getNewData(data);
				} , 200);
			   	
			    //$("#svgNodes").remove();
			});	
			//data = createDataFinal("person", "<?php echo Yii::app()->session['userId'] ?>", datafile);
			data = createDataFinal(type, "<?php echo Yii::app()->session['userId'] ?>", datafile)
			//data=createData("person", "<?php echo Yii::app()->session['userId'] ?>", {"people":{"name":"name", "parentIdField":"links"}, "organizations":{"name":"name", "parentIdField":"links"}}, datafile);
			getNewData(data);
	});




	function createDataFinal(varname, id, data){
		var dataJson = [];
		var newData = {};
		var parentId = id;
	  	var children= [];
	  	var newNode = {};
	  	var name1;
	  	var linkParent, eventParent, projectParent;
	  	dataTab = datafile;
	  	var parent;
	  	//console.log("ok");
	  	$.each(datafile, function(key,obj){
	  		
	  		//console.log("ok");
	  		if(key==varname){
	  			//console.log("ok2");
	  			name1 = obj.name;
	  			//console.log(key, obj);
				newData["name"] = name1;
				newData["rayon"] = 31;
				newData["level"] = 1;
				newData["fixed"] = "true";
				newData["parent"] = "person";
				newData["parentId"] =parentId;
				newData["x"] = 0;
				newData["y"] = 0;
				linkParent = obj.links;
				
			}else{
				//console.log("ok3");
				var newChild ={};
				newChild["name"] = key;
				newChild["rayon"] = 23;
				newChild["level"] = 2;
				parent = key;
				if(parent == "people" || parent=="members")
					parent = "person";
				if(parent == "organizations")
					parent = "organization";
				if(parent == "projects")
					parent = "project"
				if(parent == "events")
					parent = "event";
				newChild["parent"] = parent;
				var childrenLevel = [];
				$.each(obj, function(key2, obj2){
					//console.log(key2, obj2);
					var id = obj2["_id"]["$id"];
					var newChildLevel = {};
					var link = "links";
					if(typeof(obj2.links)=="undefined"){
						link = "attendees";
					}
					if(typeof(obj2[link])=="undefined"){
						link = "contributors";
					}
					//console.log(parent);
					$.each(obj2[link], function(key, obj){
						var nameLink;
						console.log(parent);
						if(parent == "event"){
							
							nameLink="attendeeOf";
						}
						else if(parent =="project"){
							nameLink = "contributorOf";
						}else{
							$.each(linkParent, function(label, obj2){
								//console.log(obj2, label);
								$.each(obj2, function(label3, obj3){
									if(id==label3){
										nameLink = label;
									}
								})
							})	
						}
						console.log(nameLink);
						newChildLevel["link"] = nameLink;
						if($.inArray(nameLink, tabLinks)==-1 && typeof(nameLink)!= "undefined"){
							tabLinks.push(nameLink);
						}
					})
					newChildLevel["name"] = obj2.name;
					newChildLevel["rayon"] = 15;
					newChildLevel["level"] = 3;
					parent= key
					
					if(parent == "people" || parent=="members")
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
					newChildLevel["parent"] = parent;
					//console.log(obj2);
					var id = obj2["_id"]["$id"];
					newChildLevel["parentId"] = id;
					newChildLevel["url"] = baseUrl+"/<?php echo $this->module->id?>/"+parent+"/public/id/"+id;
					////console.log(newChildLevel);
					childrenLevel.push(newChildLevel);
				})
				////console.log(childrenLevel);
				newChild["children"]= childrenLevel;
				children.push(newChild);
				//console.log(children);
			}
		})
		newData["children"] = children;
		dataJson.push(newData);
		console.log("dataJson", dataJson);
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
	
	//console.log(tabType.length);
	for(var i = 0; i<tabType.length; i++){
		tabColorType.push(randomColor());
	}
	onTimeTick();
	//////console.log("data", data);
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
			.attr("xlink:href","http://fluidlog.com/img/comment_64.png")
			.on("click", function(d) { return getElem(d.parent, d.parentId, d);})
			

		 
		// set the options – read more on the Bootstrap page linked to above
		$('svg .ImageI').popover({
		   'trigger':'hover',
		   'container': '#chart',
		   'placement': 'top',
		   'white-space': 'nowrap',
		   'html':'true'
		});
		//////console.log(data);
		//Cercle sur lequel nous allons déposer le texte
		nodeEnter.append("circle")
			.attr("class", function(d) { return d.level ? "level" +d.level : "level" +5 ; })
      		.attr("r", function(d) {  return d.rayon; })
      		//.on("click", function(d) { return getElem(d.parent, d.parentId, d);})
			.attr("fill","white")
      		.style("stroke", function(d){return fill2(d.parent)})
      		.style("stroke-width", "2")
			.transition()
			
			.duration(500);
			
		//console.log(tabType, tabColorType);
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
			.attr("fill", function(d){return fill2(d.parent)})
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
        		//////console.log("input", inputtext);
				return inputtext;
			}

		})
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


		var legendHtml = "<div><p></p>"
		for(var i= 0; i<tabLinks.length; i++){
			if(tabLinks[i]!= "")
				legendHtml += "<div><p class='item_panel_map'><i class='fa fa-square fa-1x' style='color:"+fill(tabLinks[i])+"'></i><span class='filter_name' style='display: inline;'>"+tabLinks[i]+"</span></div></p>"
		}
		legendHtml +="</div>"

		$(".panel_map").html(legendHtml);


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
			////console.log("color", color, d3.select(this));
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
		//if (d.level==2)
		//	hover(d);
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


	function getDetails(d, datamap){
		
		var newChild = [];
		var children;
		$.each(datamap, function(key, obj){
			var objectId ="";
			var type = "";
			////console.log(key, obj);
			if(key == "links"){

				$.each(obj, function(key3, obj3){
					////console.log(key, key3, obj3);
					if(typeof(obj3.type)=="string"){
						////console.log("ok");
						ObjectId=key3;
						type = obj3.type;
					}else{
						////console.log('notOK');
						if($.inArray(key3, tabLinks)==-1){
							tabLinks.push(key3);
						}
						$.each(obj3, function(key4, obj4){
							objectId = key4;
							type = obj4.type;
						})
						////console.log(objectId, type);
					}
								
					children= {};
					children["name"] = objectId;
					if(type == "citoyens")
						type = 'person';
					if(type== "organizations")
						type = "organization";
					children["parent"] = type;
					children["parentId"] = objectId;
					children["rayon"] = 10;
					children["x"]= d.x- 50 -Math.random()*200;
					children["y"]= d.y- 50 -Math.random()*200;
					children["url"] =  baseUrl+"/<?php echo $this->module->id?>/"+type+"/view/id/"+objectId,
					children["level"] = d.level+1;
					////console.log("children", children);
					////console.log(children, "child")
					newChild.push(children);
					////console.log('newChild', newChild);
				
				})
			}
		})
		
		d["children"] = newChild;
		
			   		
		////console.log("DATAEND", datamap);
		onTimeTick();
		d.children.forEach(toggleAll);
		nodes = flatten(data);
		links = d3.layout.tree().links(nodes);
		
		update(d);
		////console.log(d)
		mouseover(d);
		
	}

	function getElem(type, id, d){
		////console.log(type, id);

		$.ajax({
  			type: "POST",
			 url: baseUrl+"/<?php echo $this->module->id?>/"+type+"/getbyid/id/"+id,
			 datatype: "json",
		}).done(function(data) {
			////console.log(data);
			clearTimeout(timer);
			getDetails(d, data);
		});
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
  
</script>