Idea : history log
- Add an history object to keep track of change on every objects (person, organization, event...)
	- CreatedBy : userId
	- CreatedDate : DateTime
	- logbook :
		- id : MongoId
		- updateDate : DateTime
		- updateBy : userId
	- EveryUpdate a hook keep track of the modification and add an entry in the logbook of the object

Organization or Person
- Add ContactPoints : http://schema.org/ContactPoint