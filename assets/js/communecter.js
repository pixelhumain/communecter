//In this javascript file you can find a bunk of functional functions
//Calling Actions in ajax. Can be used easily on views

function connectPerson(connectUserId, callback) {
	console.log("connect Person");
	$.blockUI({
		message : '<i class="fa fa-spinner fa-spin"></i> Processing... <br/> '+
	            '<blockquote>'+
	              '<p>la Liberté est la reconnaissance de la nécessité.</p>'+
	              '<cite title="Hegel">Hegel</cite>'+
	            '</blockquote> '
	});
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
			if(updateInvite != undefined && typeof updateInvite == "function"){
				updateInvite(data.invitedUser, false, false);
			}
		} else {
			$.unblockUI();
			toastr.error('Something Went Wrong !');
		}
		if (typeof callback == "function") callback();
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
						if(updateInvite != undefined && typeof updateInvite == "function"){
							updateInvite(idToDisconnect, false, true);
						}
					} else {
						toastr.error(data.msg);
					}
					if (typeof callback == "function") callback();
				},
				error: function(data) {
					toastr.error("Something went really bad !");
					if (typeof callback == "function") callback();
				}
			});
		}
	);
}