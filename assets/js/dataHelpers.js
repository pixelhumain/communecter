//Retrieve the countries in ajax and return an array of value
//The selectType change the value key : 
//for select input : {"value":"FR", "text":"France"}
//for select2 input : {"id":"FR", "text":"France"}
function getCountries(selectType) {
	var result = new Array();
	$.ajax({
		url: baseUrl+'/'+moduleId+"/opendata/getcountries",
		type: 'post',
		global: false,
		async: false,
		dataType: 'json',
		success: function(data) {
			$.each(data, function(i,value) {
				if (selectType == "select2") {
					result.push({"id" : value.value, "text" :value.text});
				} else {
					result.push({"value" : value.value, "text" :value.text});
				}
			}) 
		}
	});
	return result;
}

function formatDataForSelect(data, selectType) {
	var result = new Array();
	$.each(data, function(key,value) {
		if (selectType == "select2") {
			result.push({"id" : key, "text" :value});
		} else {
			result.push({"value" : key, "text" :value});
		}
	});
	return result;
}

function getCitiesByPostalCode(postalCode, selectType) {
	var result =new Array();
	$.ajax({
		url: baseUrl+'/'+moduleId+"/opendata/getcitiesbypostalcode/",
		data: {postalCode: postalCode},
		type: 'post',
		global: false,
		async: false,
		dataType: 'json',
		success: function(data) {
			$.each(data, function(key,value) {
				if (selectType == "select2") {
					result.push({"id" : value.insee, "text" :value.name});
				} else {
					result.push({"value" : value.insee, "text" :value.name});
				}
			});
		}
	});
	return result;
}

/** added by tristan **/
function getCitiesGeoPosByPostalCode(postalCode, selectType) {
	var result =new Array();
	$.ajax({
		url: baseUrl+'/'+moduleId+"/opendata/getcitiesgeoposbypostalcode/",
		data: {postalCode: postalCode},
		type: 'post',
		global: false,
		async: false,
		dataType: 'json',
		success: function(data) { console.dir(data);
			result.push(data);
		}
	});
	return result;
}
function isUniqueUsername(username) {
	var response;
	$.ajax({
		url: baseUrl+'/'+moduleId+"/person/checkusername/",
		data: {username: username},
		type: 'post',
		global: false,
		async: false,
		dataType: 'json',
		success: function(data) {
		    response = data;
		}
	});
	console.log("isUniqueUsername=", response);
	return response;
}

function addCustomValidators() {
	//Validate a postalCode
	jQuery.validator.addMethod("validPostalCode", function(value, element) {
	    var response;
	    $.ajax({
			url: baseUrl+'/'+moduleId+"/opendata/getcitiesbypostalcode/",
			data: {postalCode: value},
			type: 'post',
			global: false,
			async: false,
			dataType: 'json',
			success: function(data) {
			    response = data;
			}
		});
	    if (Object.keys(response).length > 0) {
	    	return true;
	    } else {
	    	return false;
	    }
	}, "Unknown Postal Code");

	jQuery.validator.addMethod("validUserName", function(value, element) {
	    //Check authorized caracters
		var usernameRegex = /^[a-zA-Z0-9]+$/;
    	var validUsername = value.match(usernameRegex);
    	if (validUsername == null) {
        	return false;
    	} else {
    		return true;
    	}
    }, "Invalid username : Only characters A-Z, a-z, 0-9 and '-' are  acceptable.");

	jQuery.validator.addMethod("uniqueUserName", function(value, element) {
	    //Check unique username
	   	return isUniqueUsername(value);
	}, "A user with the same username already exists. Please choose an other one.");
}



function showLoadingMsg(msg){
	$("#main-title-public1").html("<i class='fa fa-refresh fa-spin'></i> "+msg+" ...");
	$("#main-title-public1").show(300);
}
function hideLoadingMsg(){
	$("#main-title-public1").html("");
	$("#main-title-public1").hide(300);
}
function dateToStr(date, lang, inline, fullMonth){ //work with date formated : yyyy-mm-dd hh:mm:ss ou millisecond

	if(typeof date == "undefined") return;
	if(fullMonth != true) fullMonth = false;

	//console.log("convert format date 1", date);
	if(typeof date.sec != "undefined"){
		date = new Date(date.sec);
		var yyyy = date.getFullYear().toString();
	    var mm = (date.getMonth()+1).toString(); // getMonth() is zero-based
	    var dd  = date.getDate().toString();
	    var min  = date.getMinutes().toString();
	    var ss  = date.getSeconds().toString();
	    date = yyyy + "-" + (mm[1]?mm:"0"+mm[0]) + "-" + (dd[1]?dd:"0"+dd[0]) + " " +
	    					(min[1]?min:"0"+min[0]) + ":" + (ss[1]?ss:"0"+ss[0]) + ":00"; // padding
	}

	if(lang == "fr"){
		//(year, month, day, hours, minutes, seconds, milliseconds) 
		//console.log("convert format date", date);
		var year 	= date.substr(0, 4);
		var month 	= date.substr(5, 2);//getMonthStr(date.substr(5, 2), lang);
		var day 	= date.substr(8, 2);
		var hours 	= date.substr(11, 2);
		var minutes = date.substr(14, 2);
		

		var str = day + "/" + month + "/" + year;

		if(fullMonth) str = day + " " + getMonthStr(month, "fr") + " " + year;


		if(!inline) str += "</br>";
		else str += " - ";
		str += hours + "h" + minutes;
		
		return str;
	}

	function getMonthStr(monthInt, lang){
		if(lang == "fr"){
			if(monthInt == "01") return "Janvier";
			if(monthInt == "02") return "Février";
			if(monthInt == "03") return "Mars";
			if(monthInt == "04") return "Avril";
			if(monthInt == "05") return "Mai";
			if(monthInt == "06") return "Juin";
			if(monthInt == "07") return "Juillet";
			if(monthInt == "08") return "Août";
			if(monthInt == "09") return "Septembre";
			if(monthInt == "10") return "Octobre";
			if(monthInt == "11") return "Novembre";
			if(monthInt == "12") return "Décembre";
		}
	}
}

function getObjectId(object){
	if(object === null) return null;
	if("undefined" != typeof object._id && "undefined" != typeof object._id.$id) 	return object._id.$id.toString();
	if("undefined" != typeof object.id) 	return object.id;
	if("undefined" != typeof object.$id) 	return object.$id;
	return null;
};

