<?php
$cs = Yii::app()->getClientScript();

$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/plugins/jquery.pulsate/jquery.pulsate.min.js' , CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->theme->baseUrl. '/assets/js/pages-user-profile.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl. '/js/react-0.13.0/build/react.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl. '/js/react-0.13.0/build/es5-shim.min.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl. '/js/react-0.13.0/build/es5-sham.min.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl. '/js/react-0.13.0/build/console-polyfill.js' , CClientScript::POS_END);
$cs->registerScriptFile($this->module->assetsUrl. '/js/react-0.13.0/build/JSXTransformer.js' , CClientScript::POS_END);
?>
<div id='content'></div>
<div id ="organization">
	<h1>Organization</h1>
	<a href="javascript:openSubView('Add an Organisation', '/communecter/organization/addorganizationform',null)"  class="btn btn-xs btn-light-blue tooltips pull-right" data-placement="top" data-original-title="Edit"><i class="fa fa-plus"></i> Add an Organization</a>
	<button onclick="javascript:getData()">ShowData</button>
	
</div>

<button value="Switch" onclick='javascript:switchData()'>Switch</button>

<script type="text/jsx">
	/*** @jsx React.DOM */
	var url = baseUrl+"/<?php echo $this->module->id?>/person/getbyid/id/<?php echo Yii::app()->session['userId'] ?>";
	console.log(url);
	var data = <?php echo json_encode($person) ?>;
	var dataOrganisation =<?php echo json_encode($organizations) ?>;
	
	var PersonApp = React.createClass({
		getInitialState : function(){
			return {data:[]}
		},
		
		componentDidMount : function(){
			$.ajax({
				url: url,
				dataType : 'json',
				success : function(data) {
					console.log(data);
					this.setState({data:[data]});

				}.bind(this),
				error: function(xhr, status, err){
					console.error(url, status, err.toString());
				}.bind(this)
			});
		},
		onChangeName: function(e){
			
			this.setState({name: e.target.value})
		},
		onChangeEmail: function(e){
			if(e.target.value!='')
			this.setState({email : e.target.value})
		},
		handleSubmit: function(e){
			e.preventDefault();
			var name = this.state.name;
			console.log(name);
			$.ajax({
				url: baseUrl+"/<?php echo $this->module->id?>/person/updatename/name/"+name+"/id/<?php echo Yii::app()->session['userId'] ?>",
				dataType : 'json',
				success : function(data) {
					console.log(data);
					this.setState({data:[data]});
				}.bind(this),
				error: function(xhr, status, err){
					console.error(url, status, err.toString());
				}.bind(this)
			});
			
			
			//this.state.data[0].name=this.state.name;
			//this.state.data[0].email=this.state.email;
			this.setState({name:'', email:''});
			
		},
		render: function(){
			return(
				<div>
					<h1> test</h1>
					<form onSubmit={this.handleSubmit}>
						<input type='text' value={this.state.name} onChange={this.onChangeName}/>
						<input type='text' value={this.state.email} onChange={this.onChangeEmail}/>
						<button>Update</button>
					</form>
					<PersonList data={this.state.data}/>
				</div>
			)
		}
	})
	var Person = React.createClass({
		render: function(){
			return(
				<div>
					<h2>{this.props.name}, {this.props.email}</h2>
				</div>
			)
		}
	})

	var PersonList = React.createClass({
		render: function(){
			var people = this.props.data.map(function(person){
				return <Person name= {person.name} email={person.email} />
			})
			return (
				<div>{people}</div>
			)
		}
	})


	var OrganizationApp = React.createClass({
		getInitialState : function(){
			return {data:[]}
		},
		loadOrganisationFromServer : function(){
			$.ajax({
				url: baseUrl+"/<?php echo $this->module->id?>/person/getorganization/id/<?php echo Yii::app()->session['userId'] ?>",
				dataType : 'json',
				success : function(data) {
					console.log(data);
					this.setState({data:data});

				}.bind(this),
				error: function(xhr, status, err){
					console.error(url, status, err.toString());
				}.bind(this)
			});
		},
		componentDidMount : function(){
			this.loadOrganisationFromServer();
    		setInterval(this.loadOrganisationFromServer, this.props.pollInterval);
		},
		addOrga : function(e){
			e.preventDefault();
			data = getData();
			console.log('datasub', data);
			$.ajax({
				url: baseUrl+"/<?php echo $this->module->id?>/person/getorganization/id/<?php echo Yii::app()->session['userId'] ?>",
				dataType : 'json',
				success : function(data) {
					console.log(data);
					this.setState({data:data});

				}.bind(this),
				error: function(xhr, status, err){
					console.error(url, status, err.toString());
				}.bind(this)
			});
		},
		render: function(){
			return(
				<table >
					<thead>
						<tr>
							<th>Name</th>
							<th class="hidden-xs">Type</th>
							<th class="hidden-xs center">Tags</th>
							<th></th>
						</tr>
					</thead>
					<tbody id="orgacontent">
						<OrganizationsList data={this.state.data}/>
					</tbody>
				</table>
				
			)
		}
	})

	var Organization = React.createClass({
		render : function(){
			return(
				<tr>
					<td>{this.props.name}</td>
					<td>{this.props.type}</td>
					<td>{this.props.tags}</td>
				</tr>
			)
		}
	})
	var OrganizationsList = React.createClass({
		render: function(){
			var organizations = this.props.data.map(function(organization){
				console.log(organization);
				return <Organization name= {organization.name} type={organization.type} tags={organization.tags} />
			})
			return (
				<div>{organizations}</div>
			)
		}
	})
	React.render(<PersonApp />, document.getElementById('content'))
	React.render(<OrganizationApp pollInterval={20000} />, document.getElementById('organization'))
</script>
