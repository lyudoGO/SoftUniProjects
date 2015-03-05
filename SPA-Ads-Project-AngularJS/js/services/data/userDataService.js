'use strict';

adsApp.factory('userDataService', ['$http', '$resource', 'baseServiceUrl', 'authenticationService', function ($http, $resource, baseServiceUrl, authenticationService) {
	
/*	function registerUser(user) {
		return $resource(baseServiceUrl + 'user/register')
						.save(user)
						.$promise
						.then(function (data) {
							authenticationService.saveUser(angular.toJson(data));
							authenticationService.getHeaders();
						}, function(data) {
							console.log(data);
						});
	}*/

	function loginUser(user, success, error) {
		$http({
			method: 'POST',
			url: baseServiceUrl + 'user/login',
			data: JSON.stringify(user)
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			error(data);
		});
/*		var resource = $resource(baseServiceUrl + 'user/login')
						.save(user);
		resource.$promise
				.then(function (data) {
					authenticationService.saveUser(angular.toJson(data));
				}, function(data) {
					console.log(data);
				});
		return resource;*/
	}

	function logoutUser(userAccessToken, success, error) {
		$http({
			method: 'POST',
			headers: { Authorization: 'Bearer ' + userAccessToken },
			url: baseServiceUrl + 'user/logout'
			})
			.success(function(data, status, headers, config) {
				success(data);
			})
			.error(function(data, status, headers, config) {
				error(data);
			});
	}

	function registerUser(dataUser, success, error) {
		$http({
				method: 'POST',
				url: baseServiceUrl + 'user/register',
				data: JSON.stringify(dataUser)
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			error(data);
		});
	}

	return {
		registerUser: registerUser,
		loginUser: loginUser,
		logoutUser: logoutUser
	}
}]);