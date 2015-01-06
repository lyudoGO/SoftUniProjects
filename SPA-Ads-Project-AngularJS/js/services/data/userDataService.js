'use strict';

adsApp.factory('userDataService', ['$resource', 'baseServiceUrl', 'authenticationService', function ($resource, baseServiceUrl, authenticationService) {
	
	function registerUser(user) {
		return $resource(baseServiceUrl + 'user/Register')
						.save(user)
						.$promise
						.then(function (data) {
							authenticationService.saveUser(data);
						});
	}

	function loginUser(user) {
		return resource.query();
	}

	function logoutUser() {
		return resource.query();
	}

	return {
		registerUser: registerUser,
		loginUser: loginUser,
		logoutUser: logoutUser
	}
}]);