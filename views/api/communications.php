	<ul>
	<li class="block">
		<a href="/ph/egpc/api/sendMessage"  id="blocksendMessage">Send a Message to people</a><br/>
		<div class="fss">
			url : /ph/egpc/api/sendMessage<br/>
			method type : POST <br/>
			params : <br/>
			message  : <textarea name="sendMessagemsg" id="sendMessagemsg"></textarea> <br/>
			email(s) : <textarea type="text" name="sendMessageemail" id="sendMessageemail">egpc@egpc.com</textarea><br/>
			séparé par des virgules<br/>
			<a href="javascript:sendMessage()">Send it</a><br/>
			<select id="sendMessagePeople">
				<option></option>
				<?php 
				$groups = Yii::app()->mongodb->groups->find( array( "type" => new MongoRegex("/.*/") ));
				foreach ($groups as $value) {
					echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
				}
				?>
			</select>
			<a href="javascript:setPeople()">Get People </a><br/>
			<div id="sendMessageResult" class="result fss"></div>
			<script>
				function sendMessage(){
					params = { 
			    	   "email" : $("#sendMessageemail").val() , 
			    	   "msg" : $("#sendMessagemsg").val() 
			    	   };
					ajaxPost("sendMessageResult", baseUrl+'/egpc/api/sendMessage',params);
				}
				function setPeople(){
					$("#sendMessageemail").val("");
					$.ajax({
					    url:'/ph/egpc/api/getPeopleBy',
					    type:"POST",
					    data:{ "groupname":$("#sendMessagePeople").val()},
					    datatype : "json",
					    success:function(data) {
					    	list = "";
						    $.each(data,function(k,v){
						      	list += (list == "") ? v.email : ","+v.email ;
						    })
					      	console.log(list);
					      	$("#sendMessageemail").val(list);
						      	
					    },
					    error:function (xhr, ajaxOptions, thrownError){
					      $("#"+id).html(data);
					    } 
					  });
				}
			</script>
		</div>
	</li>
	</ul>