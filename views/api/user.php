<ul>
	<li class="block" id="blockCommunect">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/communect">Login</a><br/>
		<div class="fss">
			se communecter c'est juste suivre l'activité d'un CP <br/>
			Il suffit d'un email et d'un CP<br/>
			method type : POST <br/>
		</div>
		<div class="apiForm communect">
			email : <input type="text" name="emailCommunect" id="emailCommunect" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			code postal  : <input type="text" name="cpCommunect" id="cpCommunect" value="97421" /><br/>
			<a href="javascript:communect()">Communect</a><br/>
			<div id="communectResult" class="result fss"></div>
			<script>
				function communect(){
					params = { "email" : $("#emailCommunect").val() , 
					    	   "cp" : $("#cpCommunect").val()
					    	};
					ajaxPost("communectResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/communect',params);
				}
			</script>
			
		</div>
	</li>

	<li class="block" id="blockLogin">
		<a href="/ph/<?php echo $this::$moduleKey?>/api/login">Login</a><br/>
		<div class="fss">
			Il faut etre loguer par email, cp, et mot de passe<br/>
			method type : POST <br/>
		</div>
		<div class="apiForm login">
			email : <input type="text" name="emailLogin" id="emailLogin" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			pwd : <input type="password" name="pwdLogin" id="pwdLogin" value="1234" /><br/>
			<a href="javascript:login()">Test it</a><br/>
			<div id="loginResult" class="result fss"></div>
			<script>
				function login(){
					params = { "email" : $("#emailLogin").val() , 
					    	   "pwd" : $("#pwdLogin").val()
					    	};
					ajaxPost("loginResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/login',params);
					
				}
			</script>
			
		</div>
	</li>

	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/saveUser"  id="blockSaveUser">Create/Update user</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/saveUser<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm createUser">
			name : <input type="text" name="nameSaveUser" id="nameSaveUser" value="<?php echo $this::$moduleKey?> User" /><br/>
			email* : <input type="text" name="emailSaveUser" id="emailSaveUser" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			cp* : <input type="text" name="postalcodeSaveUser" id="postalcodeSaveUser" value="97421" /><br/>
			pwd* : <input type="text" name="pwdSaveUser" id="pwdSaveUser" value="1234" /><br/>
			phoneNumber : <input type="text" name="phoneNumberSaveUser" id="phoneNumberSaveUser" value="1234" />(for SMS)<br/>
			
			<a href="javascript:addUser()">Test it</a><br/>
			<div id="createUserResult" class="result fss"></div>
			<script>
				function addUser(){
					params = { "email" : $("#emailSaveUser").val() , 
					    	   "name" : $("#nameSaveUser").val() , 
					    	   "cp" : $("#postalcodeSaveUser").val() ,
					    	   "pwd":$("#pwdSaveUser").val() ,
					    	   "phoneNumber" : $("#phoneNumberSaveUser").val()};
					ajaxPost("createUserResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/saveUser',params);
				}
			</script>
		</div>
	</li>
	
	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/getUser/email/oceatoon@gmail.com"  id="blockGetUser">Get User</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getUser/email/oceatoon@gmail.com<br/>
			method type : GET <br/>
			param : email<br/>
			email : <input type="text" name="getUseremail" id="getUseremail" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			<a href="javascript:getUser()">Test it</a><br/>
			<div id="getUserResult" class="result fss"></div>
			<script>
				function getUser(){
					ajaxGet("getUserResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getUser/email/'+$("#getUseremail").val());
				}
				
			</script>
		</div>
	</li>


	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/getpeopleby"  id="blockgetPeople">Get People by codepostal </a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getpeopleby<br/>
			method type : POST <br/>
			cp* : <input type="text" name="postalcodegetPeople" id="postalcodegetPeople" value="97421" /><br/>
			<a href="javascript:getpeopleby()">Test it</a><br/>
			<a href="javascript:countpeopleby()">Count it</a><br/>
			<div id="getPeopleResult" class="result fss"></div>
			<script>
				function getpeopleby(){
					params = { "cp" : $("#postalcodegetPeople").val() };
					ajaxPost("getPeopleResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getpeopleby',params);
				}
				function countpeopleby(){
					params = { "cp" : $("#postalcodegetPeople").val() };
					ajaxPost("getPeopleResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getpeopleby/count/1',params);
				}
			</script>
		</div>

	</li>

	<li class="block"><a href="/ph/<?php echo $this::$moduleKey?>/api/inviteUser"  id="blockinviteUser">Invite User</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/inviteUser<br/>
			method type : POST <br/>
			param : email<br/>
			email : <input type="text" name="inviteUseremail" id="inviteUseremail" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			<a href="javascript:inviteUser()">Test it</a><br/>
			<div id="inviteUserResult" class="result fss"></div>
			<script>
				function inviteUser(){
					params = { "email" : $("#inviteUseremail").val() };
					ajaxPost("inviteUserResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/inviteUser',params);
				}
				
			</script>
		</div>
	</li>

</ul>	