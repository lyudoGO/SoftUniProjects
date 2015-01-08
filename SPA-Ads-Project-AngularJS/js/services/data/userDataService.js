'use strict';

adsApp.factory('userDataService', ['$resource', 'baseServiceUrl', 'authenticationService', function ($resource, baseServiceUrl, authenticationService) {
	
	function registerUser(user) {
		return $resource(baseServiceUrl + 'user/register')
						.save(user)
						.$promise
						.then(function (data) {
							authenticationService.saveUser(angular.toJson(data));
							authenticationService.getHeaders();
						});
	}

	function loginUser(user) {
		var resource = $resource(baseServiceUrl + 'user/login')
						.save(user);
		resource.$promise
				.then(function (data) {
					authenticationService.saveUser(angular.toJson(data));
				});
		return resource;
	}

	function logoutUser() {
		return $resource(baseServiceUrl + 'user/logout')
						.save(user)
						.$promise
						.then(function (data) {
							authenticationService.removeUser();
						});
	}

	return {
		registerUser: registerUser,
		loginUser: loginUser,
		logoutUser: logoutUser
	}
}]);