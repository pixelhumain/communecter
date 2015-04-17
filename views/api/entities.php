<ul>
	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')" id="blocksaveGroup">Form</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/saveGroup">Create/Update Entité (Asso. , Entr. , Group, Events )</a>

		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/saveGroup<br/>
			method type : POST <br/>
			Form inputs : email,postalcode,pwd,phoneNumber(is optional)type<br/>
			return json object {"result":true || false}
		</div>
		<div class="apiForm saveGroup">
			name : <input type="text" name="namesaveGroup" id="namesaveGroup" value="Asso1" /><br/>
			email* : <input type="text" name="emailsaveGroup" id="emailsaveGroup" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /> (personne physique responsable )<br/>
			cp* : <input type="text" name="postalcodesaveGroup" id="postalcodesaveGroup" value="97421" /><br/>
			phoneNumber : <input type="text" name="phoneNumbersaveGroup" id="phoneNumbersaveGroup" value="1234" />(for SMS)<br/>
			type : <select name="typesaveGroup" id="typesaveGroup" onchange="typeChanged()">
						<option value="association">Association</option>
						<option value="entreprise">Entreprise</option>
						<option value="group">Groupe de personne</option>
						<option value="event">Evenement</option>
					</select><br/>
			<span class="whensaveGroup">
			when : <input type="text" name="whensaveGroup" id="whensaveGroup" value="" /><br/>
			where : <input  type="text" name="wheresaveGroup" id="wheresaveGroup" value="" /><br/>
			</span>
			<a href="javascript:saveGroup()">Test it</a><br/>
			<div id="saveGroupResult" class="result fss"></div>
			<script>
				function saveGroup(){
					params = { "email" : $("#emailsaveGroup").val() , 
					    	   "name" : $("#namesaveGroup").val() , 
					    	   "cp" : $("#postalcodesaveGroup").val() , 
					    	   "pwd" : $("#pwdsaveGroup").val(),
					    	   "type" : $("#typesaveGroup").val(),
					    	   "phoneNumber" : $("#phoneNumbersaveGroup").val()};
					if( $("#whensaveGroup").val() )
						paramas["when"] = $("#whensaveGroup").val();
					if( $("#wheresaveGroup").val() )
						paramas["where"] = $("#wheresaveGroup").val();
					
					ajaxPost("saveGroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/savegroup',params);
				}
				function typeChanged(){
					console.log( $("#typesaveGroup").val() );
					if ($("#typesaveGroup").val() == "event") {
						$(".whensaveGroup").show();
					} else {
						$(".whensaveGroup").hide();
					}
				}
				initT['datepickerInit'] = function(){
					$("#whensaveGroup").datepicker();
					typeChanged();
				};
			</script>
		</div>

	</li>
	
	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')" id="blockgetgroup">Get</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/getGroup">Get une Entité by email </a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getGroup/email/<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com<br/>
			method type : GET <br/>
			param : email<br/>
			email : <input type="text" name="getGroupemail" id="getGroupemail" value="<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com" /><br/>
			<a href="javascript:getGroup()">Test it</a><br/>
			<a href="javascript:confirmGroupRegistration()">Confirm User Registration</a><br/>
			<div id="getGroupResult" class="result fss"></div>
			<script>
				function getGroup(){
					ajaxGet("getGroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getGroup/email/'+$("#getGroupemail").val());
				}
				function confirmGroupRegistration(){
					ajaxGet("getGroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/confirmGroupRegistration/email/'+$("#getGroupemail").val());
				}
			</script>
		</div>
	
	</li>
	
	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')"  id="blocklinkUser2Group">Link Form</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/linkUser2Group">Lié un User a une Entité</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/linkUser2Group/email/<?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com<br/>
			method type : POST <br/>
			param : <br/>
			all <?php echo $this::$moduleKey?> groups  : 
			<select id="linkUser2GroupGroup">
				<option></option>
				<?php 
				$groups = Yii::app()->mongodb->groups->find( array( "applications.".$this::$moduleKey.".usertype" => Group::TYPE_ASSOCIATION ));
				foreach ($groups as $value) {
					echo '<option value="'.$value["name"].'">'.$value["name"].'</option>';
				}
				?>
				
			</select><br/>
			email(s) : <textarea type="text" name="linkUser2Groupemail" id="linkUser2Groupemail"><?php echo $this::$moduleKey?>@<?php echo $this::$moduleKey?>.com</textarea><br/>
			séparé par des virgules<br/>
			<a href="javascript:linkUser2Group()">Link it</a><br/>
			<a href="javascript:unlinkUser2Group()">Unlink it</a><br/>
			<div id="linkUser2GroupResult" class="result fss"></div>
			<script>
				function linkUser2Group(){
					params = { 
			    	   "email" : $("#linkUser2Groupemail").val() , 
			    	   "name" : $("#linkUser2GroupGroup").val() 
			    	   };
					ajaxPost("linkUser2GroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/linkUser2Group',params);
				}
				function unlinkUser2Group(){
					params = { 
			    	   "email" : $("#linkUser2Groupemail").val() , 
			    	   "name" : $("#linkUser2GroupGroup").val() 
			    	   };
					ajaxPost("linkUser2GroupResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/unlinkUser2Group',params);
				}
			</script>
		</div>
	</li>
	
	<li class="block">
		<a href="javascript:;" class="btn btn-primary" onclick="openModal('groupCreerForm','data',null,'dynamicallyBuild')" id="blockgetGroups">Get</a>
		<a href="/ph/<?php echo $this::$moduleKey?>/api/getgroupsby">Get all <?php echo $this::$moduleKey?> Entités</a><br/>
		<div class="fss">
			url : /ph/<?php echo $this::$moduleKey?>/api/getgroupsby<br/>
			method type : POST <br/>
			filter : <input type="text" name="getgroupsbyFilter" id="getgroupsbyFilter" value="email" />(comma seperated)<br/>
			<a href="javascript:getgroupsby()">Test it</a><br/>
			<div id="getgroupsbyResult" class="result fss"></div>
			<script>
				function getgroupsby(){
					filter = ($("#getgroupsbyFilter").val()) ? '/filter/'+$("#getgroupsbyFilter").val() : ""; 
					ajaxPost("getgroupsbyResult", baseUrl+'/<?php echo $this::$moduleKey?>/api/getgroupsby'+filter,{"app":"<?php echo $this::$moduleKey?>"});
				}
			</script>
		</div>
	</li>
</ul>