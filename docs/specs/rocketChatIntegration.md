# Integrating Rocket Chat into Communecter  
> The main idea is to get a real time private messaging system into Communecter (CO²)
> something similare to FB messenger, but for our open source context with an open source partner
> as we allready use RC for our organization, it seems very well adapted to the plateforms
> and we'd like to offer it to the people 
> to enable 
- P2P : person to person exchanges 
- P2G : private group chat rooms

## Our side specificationson CO² 
- we run on a mongoDB
	- we have a user collection 
	- and a collection for any ELEMENT
		- organizations 
		- projects 
	- events
	- city 
	- classifieds

## Integration			
- ultimetly RC would sit inside the plateform in 2 forms : 
	- small bottom popin 
	- chat page, grouping all different conversations
	- open to suggestions ???

## Use cases
- Login will be transparent between our panels
- RC notifications should also be hooked up with our notification system or the other way around
- a user can go on any users page and start a discussion, identicall to a P2P converstaion in RC 
	- the conversation is not accessible to other users
- ELEMENTs always have group or people associated 
	- any ELEMENT has a "create chat room" feature 
	- channels are only accessible to the group's members
	- only admins can open a channel 
	- a group can have many channels 
- see all "my chatRooms" in one place

## Relation 
- we are interested in a close relation with other open source project like RC 
- our interoperabilty will be the first of a long list

##Questions 
- How is RC's security ? have you 

