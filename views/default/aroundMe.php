
<div id="grid_around"></div>
<script>

var mapElements = new Array();
var elementsMap = <?php echo json_encode($all) ?>;
jQuery(document).ready(function() {
	
	setTitle("Autour de moi",
			 "<i class='fa fa-crosshairs'></i>", 
			 "Autour de moi");

	showMap(true);
	//Sig.showMyPosition();
	Sig.showMapElements(Sig.map, elementsMap);
	showGridResult(elementsMap);
	//console.dir(elementsMap);
});


function showGridResult(data){
	$.each(data, function(i, o) {
                  var typeIco = i;
                  var ico = mapIconTop["default"];
                  var color = mapColorIconTop["default"];

                  mapElements.push(o);

  				  typeIco = typeof o.typeSig != "undefined" ? o.typeSig : null;
                  ico = ("undefined" != typeof mapIconTop[typeIco]) ? mapIconTop[typeIco] : mapIconTop["default"];
                  color = ("undefined" != typeof mapColorIconTop[typeIco]) ? mapColorIconTop[typeIco] : mapColorIconTop["default"];
                  
                  var htmlIco ="<i class='fa "+ ico +" fa-2x bg-"+color+"'></i>";
                 	if("undefined" != typeof o.profilThumbImageUrl && o.profilThumbImageUrl != ""){
                    htmlIco= "<img width='80' height='80' alt='' class='img-circle bg-"+color+"' src='"+baseUrl+o.profilThumbImageUrl+"'/>"
                  }

                  city="";

                  var postalCode = o.cp
                  if (o.address != null) {
                    city = o.address.addressLocality;
                    postalCode = o.cp ? o.cp : o.address.postalCode ? o.address.postalCode : "";
                  }
                  
                  //console.dir(o);
                  var id = getObjectId(o);
                  var insee = o.insee ? o.insee : ""; console.log(typeIco);
                  type = typeObj[typeIco].col;
                  // var url = "javascript:"; // baseUrl+'/'+moduleId+ "/default/simple#" + type + ".detail.id." + id;
                  //type += "s";
                  var url = '#news.index.type.'+type+'.id.' + id;
                  if(type == "citoyens") url += '.viewer.' + userId;
                  if(type == "cities") url = "#city.detail.insee."+o.insee+".postalCode."+o.cp;

                  //if(type=="citoyen") type = "person";
                 
                  var onclick = 'loadByHash("' + url + '");';

                  var onclickCp = "";
                  var target = " target='_blank'";
                  var dataId = "";
                  if(type == "city"){
                  	url = "javascript:"; //#main-col-search";
                  	onclick = 'setScopeValue($(this))'; //"'+o.name.replace("'", "\'")+'");';
                  	onclickCp = 'setScopeValue($(this));';
                  	target = "";
                    dataId = o.name; //.replace("'", "\'");
                  }

                  var tags = "";
                  if(typeof o.tags != "undefined" && o.tags != null){
          					$.each(o.tags, function(key, value){
          						if(value != "")
  		                tags +=   "<a href='javascript:' class='badge bg-white text-red btn-tag tag' data-tag-value='"+value+"'>#" + value + "</a> ";
  		              });
                  }

                  var name = typeof o.name != "undefined" ? o.name : "";
                  var postalCode = (typeof o.address != "undefined" &&
                  				  typeof o.address.postalCode != "undefined") ? o.address.postalCode : "";
                  
                  if(postalCode == "") postalCode = typeof o.cp != "undefined" ? o.cp : "";
                  var cityName = (typeof o.address != "undefined" &&
                  				typeof o.address.addressLocality != "undefined") ? o.address.addressLocality : "";
                  
                  var fullLocality = postalCode + " " + cityName;

                  var description = (typeof o.shortDescription != "undefined" &&
                  					o.shortDescription != null) ? o.shortDescription : "";
                  if(description == "") description = (typeof o.description != "undefined" &&
                  									 o.description != null) ? o.description : "";
           
                  var startDate = (typeof o.startDate != "undefined") ? "Du "+dateToStr(o.startDate, "fr", true, true) : null;
                  var endDate   = (typeof o.endDate   != "undefined") ? "Au "+dateToStr(o.endDate, "fr", true, true)   : null;

                  //template principal
                  str += "<div class='col-md-12 searchEntity no-padding'>";

                    
                    if(userId != null){
                        isFollowed=false;
                        str += "<div class='col-md-1 col-sm-1 col-xs-1' style='max-width:40px;'>";
                        if(typeof o.isFollowed != "undefined" ) isFollowed=true;
                        if(type!="cities" && id != userId && userId != null && userId != ""){
                          tip = (type == "events") ? "Participer" : 'Suivre';
                          str += "<a href='javascript:;' class='btn btn-default btn-sm btn-add-to-directory bg-white tooltips followBtn'" + 
                                'data-toggle="tooltip" data-placement="left" data-original-title="'+tip+'"'+
                                " data-ownerlink='follow' data-id='"+id+"' data-type='"+type+"' data-name='"+name+"' data-isFollowed='"+isFollowed+"'>"+
                                    "<i class='fa fa-chain'></i>"+ //fa-bookmark fa-rotate-270
                                  "</a>";
                        }
                        str += '</div>';
                      }

                    
  	                str += "<div class='col-md-2 col-sm-2 col-xs-3 entityCenter no-padding'>";

                    str += "<a href='"+url+"' class='lbh'>" + htmlIco + "</a>";
  	                str += "</div>";
  					         target = "";

                     

                      
  	                str += "<div class='col-md-8 col-sm-9 col-xs-6 entityRight no-padding'>";
  	                	
                      str += "<a href='"+url+"' "+target+" class='entityName text-dark lbh'>" + name + "</a>";
                      
                      if(fullLocality != "" && fullLocality != " ")
  	                	str += "<a href='"+url+"' "+target+ ' data-id="' + dataId + '"' + "  class='entityLocality lbh'><i class='fa fa-home'></i> " + fullLocality + "</a>";
  	                	if(startDate != null)
  	                	str += "<div class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + startDate + "</div>";
  	                	if(endDate != null)
  	                	str += "<div  class='entityDate bg-azure badge'><i class='fa fa-caret-right'></i> " + endDate + "</div>";
  	                	if(description != "")
  	                	str += "<div class='entityDescription'>" + description + "</div>";
  	                //str += "</div>";

                    //str += "<div class='col-md-8 col-sm-10 entityRight no-padding'>";
                      
                      str += tags;
              
                    str += "</div>";

                    
  	                					
  				        str += "</div>";
              }); //end each

	$("#grid_around").html(str);
}

</script>