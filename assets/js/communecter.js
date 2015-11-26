//In this javascript file you can find a bunk of functional functions
//Calling Actions in ajax. Can be used easily on views

function connectPerson(connectUserId, callback) {
	console.log("connect Person");
	$.ajax({
		type: "POST",
		url: baseUrl+"/"+moduleId+'/person/connect',
		dataType : "json",
		data : {
			connectUserId : connectUserId,
		}
	})
	.done(function (data) {
		$.unblockUI();
		if (data &&  data.result) {
			var name = $("#newInvite #ficheName").text();
			toastr.success('You are now following '+name);
			if (typeof callback == "function") callback(data.invitedUser);
		} else {
			$.unblockUI();
			toastr.error('Something Went Wrong !');
		}
		
	});
	
}


function disconnectPerson(idToDisconnect, typeToDisconnect, nameToDisconnect, callback) {

	bootbox.confirm("Are you sure you want to delete <span class='text-red'>"+nameToDisconnect+"</span> connection ?", 
		function(result) {
			if (!result) {
				return;
			}
			var urlToSend = baseUrl+"/"+moduleId+"/person/disconnect/id/"+idToDisconnect+"/type/"+typeToDisconnect+"/ownerLink/knows";
			$.ajax({
				type: "POST",
				url: urlToSend,
				dataType: "json",
				success: function(data){
					if ( data && data.result ) {               
						toastr.info("You are not following this person anymore.");
						if (typeof callback == "function") callback(idToDisconnect, typeToDisconnect, nameToDisconnect);
					} else {
						toastr.error(data.msg);
					}
				},
				error: function(data) {
					toastr.error("Something went really bad !");
				}
			});
		}
	);
}

function declareMeAsAdmin(organizationId, personId, organizationName, callback) {
	bootbox.confirm("You are going to ask to become an admin of the organization <span class='text-red'>"+organizationName+"</span>. Please confirm ?", 
		function(result) {
			$.ajax({
				type: "POST",
				url: baseUrl+"/"+moduleId+'/organization/declareMeAdmin',
				dataType : "json",
				data : {
					idOrganization : organizationId, 
					idPerson : personId
				}
			})
			.done(function (data) {
				//$.unblockUI();
				if (data &&  data.result) {
					toastr.success(data.msg);
					if (typeof callback == "function") callback(organizationId, personId, organizationName);
				} else {
					toastr.error('Something Went Wrong ! ' + data.msg);
				}
				
			});
		})
}

