

// Create Application Object
// -----------------------------------------
var LEA = SC.Application.create();



// Create Model
// -----------------------------------------
LEA.User = SC.Object.extend({
	firstname: null,
	lastname: null
});




// Create Controller
// -----------------------------------------
LEA.usersController = SC.ArrayProxy.create({
	content: [],

	createUser: function(firstname, lastname) {
		var user = LEA.User.create({
			firstname: firstname,
			lastname: lastname
		})
		this.pushObject(user);
	}
});




// Create View
// -----------------------------------------
LEA.UserView = SC.View.extend({
	templateName: 'user',
		
	firstnameView: SC.TextField.extend({}),
	lastnameView: SC.TextField.extend({}),
	saveButtonView: SC.Button.extend({
		mouseDown: function() {
			console.log('TODO');

			//var value = LEA.UserView.firstnameView.get('value');
			//console.log(value);

			/*var value = this.get('value');

			if (value) {
				LEA.usersController.createUser(value);
				this.set('value', '');
			}*/
		}
	})
});