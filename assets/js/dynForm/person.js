dynForm =  {
    jsonSchema : {
	    title : "Inviter quelqu'un",
	    icon : "user",
	    type : "object",
	    properties : {
	    	info : {
                inputType : "custom",
                html:"<p><i class='fa fa-info-circle'></i> Si vous voulez inviter quelqu'un à rejoindre Communecter ...</p>",
            },
            inviteSearch : typeObjLib.inviteSearch,
	        /*invitedUserName : typeObjLib.invitedUserName,
	        invitedUserEmail : typeObjLib.invitedUserEmail,*/
	        "preferences[publicFields]" : {
               inputType : "hidden",
                value : []
            },
            "preferences[privateFields]" : {
               inputType : "hidden",
                value : []
            },
            "preferences[isOpenData]" : {
               inputType : "hidden",
                value : false
            },
	    }
	}
};